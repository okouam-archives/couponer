using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Couponer.Tasks.Domain;
using Couponer.Tasks.Providers;
using Couponer.Tasks.Providers.ShopWindow;
using log4net;

namespace Couponer.Tasks.Services
{
    class AbstractProvider
    {
        public static String Execute(
            MERCHANT merchant, 
            Func<MERCHANT, string> getDataFeed, 
            Func<string, MERCHANT, IEnumerable<DailyOffer>> getOffers,
            Func<string, MERCHANT, IEnumerable<Shop>> getShops = null)
        {
            var file = Download(merchant, getDataFeed);

            if (getShops != null)
            {
                SaveShops(merchant, getShops, file);
            }

            if (getOffers != null)
            {
                SaveOffers(merchant, getOffers, file);
            }

            return file;
        }
        
        private static void SaveOffers(IEnumerable<DailyOffer> dailyOffers, MERCHANT merchant)
        {
            log.DebugFormat("Saving deals for <{0}>.", merchant);
            
            Parallel.ForEach(GetBatches(dailyOffers), offers =>
            {
                Database.Save(offers.ToArray());
            });

            log.DebugFormat("Finished saving deals for <{0}>.", merchant);
        }

        private static void SaveOffers(MERCHANT merchant, Func<string, MERCHANT, IEnumerable<DailyOffer>> callback, string file)
        {
            log.DebugFormat("Getting deals for <{0}>.", merchant);
            var dailyOffers = callback(file, merchant);
            log.DebugFormat("Parsing deals for <{0}>.", merchant);
            SaveOffers(dailyOffers, merchant);
        }

        private static void SaveShops(IEnumerable<Shop> shops, MERCHANT merchant)
        {
            log.DebugFormat("Saving redemption locations for <{0}>.", merchant);

            Parallel.ForEach(GetBatches(shops), locations =>
            {
                Database.Save(locations.ToArray());
            });

            log.DebugFormat("Finished saving redemption locations for <{0}>.", merchant);
        }

        private static void SaveShops(MERCHANT merchant, Func<string, MERCHANT, IEnumerable<Shop>> callback, string file)
        {
            log.DebugFormat("Getting redemption locations for <{0}>.", merchant);
            var shops = callback(file, merchant);
            log.DebugFormat("Parsing redemption locations for <{0}>.", merchant);
            SaveShops(shops, merchant);
        }

        private static string Download(MERCHANT merchant, Func<MERCHANT, string> getDataFeed)
        {
            log.DebugFormat("Downloading feed for <{0}>.", merchant);
            var file = getDataFeed(merchant);
            log.DebugFormat("Downloaded feed for <{0}> to <{1}>.", merchant, file);
            return file;
        }
        
        private static IEnumerable<T[]> GetBatches<T>(IEnumerable<T> items)
        {
            var batchSize = CalculateBatchSize(items);

            return items.Batch(batchSize).Select(x => x.ToArray()).ToList();
        }

        private static int CalculateBatchSize<T>(IEnumerable<T> items)
        {
            var numItems = items.Count();
            log.DebugFormat("{0} items have been found.", numItems);

            var batchSize = (numItems / 10) + 1;
            log.DebugFormat("Each thread will handle {0} items.", batchSize);
            return batchSize;
        }

        private static readonly ILog log = LogManager.GetLogger(typeof(Provider));
    }
}
