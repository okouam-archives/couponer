using System;
using System.Collections.Generic;
using Couponer.Tasks.Domain;
using Couponer.Tasks.Services;
using log4net;

namespace Couponer.Tasks.Providers.ShopWindow
{
    public class Provider
    {
        /* Public Methods. */

        public static void GetDeals()
        {
            log.Info("Getting deals for Shop Window.");
            GetDeals(MERCHANT.KGB);
            GetDeals(MERCHANT.LIVING_SOCIAL);
            GetDeals(MERCHANT.MIGHTY_DEALS);
            GetDeals(MERCHANT.WOWCHER);
        }

        public static void GetDeals(MERCHANT merchant)
        {
            AbstractProvider.Execute(merchant, DataFeed.Download, Parser.GetDeals);
        }

        private static readonly ILog log = LogManager.GetLogger(typeof(Provider));
    }
}
