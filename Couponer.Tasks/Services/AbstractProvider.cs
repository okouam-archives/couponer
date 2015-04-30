using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using Couponer.Tasks.Data;
using Couponer.Tasks.Domain;
using Couponer.Tasks.Providers;
using Couponer.Tasks.Providers.ShopWindow;
using log4net;

namespace Couponer.Tasks.Services
{
    class AbstractProvider
    {
        /* Public Methods. */

        public static String Execute(
            MERCHANT merchant, 
            wp_user user,
            Func<MERCHANT, string> getDataFeed, 
            Func<string, MERCHANT, IEnumerable<DailyOffer>> getOffers,
            Func<string, MERCHANT, IEnumerable<Shop>> getShops = null)
        {
            var file = Download(merchant, getDataFeed);

            if (getShops != null)
            {
                SaveShops(user, merchant, getShops, file);
            }

            if (getOffers != null)
            {
                SaveOffers(user, merchant, getOffers, file);
            }

            return file;
        }
        
        /* Private. */

        private static void SaveOffers(wp_user user, IEnumerable<DailyOffer> dailyOffers, MERCHANT merchant)
        {
            log.DebugFormat("Saving deals for <{0}>.", merchant);

            try
            {
                DailyOfferCreationService.Save(user, dailyOffers.ToArray());
            }
            catch (Exception e)
            {
                log.FatalFormat(e.Message);
                log.FatalFormat(e.StackTrace);
                throw;
            }

            log.DebugFormat("Finished saving deals for <{0}>.", merchant);
        }

        private static void SaveOffers(wp_user user, MERCHANT merchant, Func<string, MERCHANT, IEnumerable<DailyOffer>> callback, string file)
        {
            log.DebugFormat("Getting deals for <{0}>.", merchant);
            var dailyOffers = callback(file, merchant);
            log.DebugFormat("Parsing deals for <{0}>.", merchant);
            SaveOffers(user, dailyOffers, merchant);
        }

        private static void SaveShops(wp_user user, IEnumerable<Shop> shops, MERCHANT merchant)
        {
            log.DebugFormat("Saving shops for <{0}>.", merchant);

            ShopCreationService.Save(user, shops.ToArray());
            
            log.DebugFormat("Finished saving shops for <{0}>.", merchant);
        }

        private static void SaveShops(wp_user user, MERCHANT merchant, Func<string, MERCHANT, IEnumerable<Shop>> callback, string file)
        {
            log.DebugFormat("Getting shops for <{0}>.", merchant);
            var shops = callback(file, merchant);
            log.DebugFormat("Parsing shops for <{0}>.", merchant);
            SaveShops(user, shops, merchant);
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

        private static readonly ILog log = LogManager.GetLogger(typeof(AbstractProvider));
    }
}
