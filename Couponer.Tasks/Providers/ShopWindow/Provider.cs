using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using System.Xml.Linq;
using Couponer.Tasks.Domain;
using Couponer.Tasks.Utility;
using log4net;
using StructureMap;

namespace Couponer.Tasks.Providers.ShopWindow
{
    public class Provider
    {
        /* Public Methods. */

        public static void GetDeals(Container container)
        {
            GetDeals(MERCHANTS.KGB, container);
            GetDeals(MERCHANTS.LIVING_SOCIAL, container);
            GetDeals(MERCHANTS.MIGHTY_DEALS, container);
            //GetDeals(MERCHANTS.GROUPON, container);
            GetDeals(MERCHANTS.WOWCHER, container);
        }

        public static void GetDeals(MERCHANTS merchant, Container container)
        {
            log.DebugFormat("Download feed for <{0}>.", merchant);
            var file = container.GetInstance<IDataFeed>().Download(merchant);
            Console.WriteLine(file);
            GetDeals(merchant, container, file);
        }

        public static void GetDeals(MERCHANTS merchant, Container container, string file)
        {
            var api = container.GetInstance<IWordpressApi>();

            var dailyOfferCache = container.GetInstance<IDailyOfferCache>();
            dailyOfferCache.Populate();

            var taxonomyCache = container.GetInstance<ITaxonomyCache>();
            taxonomyCache.Populate(api, file);

            GetDeals(merchant, file, dailyOfferCache, taxonomyCache, container.GetInstance<IWordpressApi>());
        }

        public static void GetDeals(MERCHANTS merchant, string file, IDailyOfferCache dailyOfferCache, ITaxonomyCache taxonomyService,  IWordpressApi api)
        {
            log.DebugFormat("Getting deals for <{0}>.", merchant);
            var dailyOffers = Parser.GetDeals(file, merchant);
            log.DebugFormat("Parsing deals for <{0}>.", merchant);
 
            log.DebugFormat("Saving deals for <{0}>.", merchant);
            SaveDeals(dailyOffers, dailyOfferCache, taxonomyService, api);
            log.DebugFormat("Finished saving deals for <{0}>.", merchant);
        }

        /* Private. */

        private static void SaveDeals(IEnumerable<DailyOffer> dailyOffers, IDailyOfferCache dailyOfferCache, ITaxonomyCache taxonomyService, IWordpressApi api)
        {
            var batches = dailyOffers.Batch(40).Select(x => x.ToArray()).ToList();

            Parallel.ForEach(batches, offers =>
            {
                new Database().Save(dailyOfferCache, taxonomyService, api, offers.ToArray());
            });
        }

        private static readonly ILog log = LogManager.GetLogger(typeof(Provider));
    }
}
