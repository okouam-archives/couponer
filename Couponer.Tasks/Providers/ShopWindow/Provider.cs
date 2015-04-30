using Couponer.Tasks.Data;
using Couponer.Tasks.Services;
using log4net;

namespace Couponer.Tasks.Providers.ShopWindow
{
    public class Provider
    {
        /* Public Methods. */

        public static void GetDeals(wp_user user)
        {
            log.Info("Getting deals for Shop Window.");
            GetDeals(MERCHANT.KGB, user);
            GetDeals(MERCHANT.LIVING_SOCIAL, user);
            GetDeals(MERCHANT.MIGHTY_DEALS, user);
            GetDeals(MERCHANT.WOWCHER, user);
        }

        public static void GetDeals(MERCHANT merchant, wp_user user)
        {
            AbstractProvider.Execute(merchant, user, DataFeed.Download, Parser.GetDeals);
        }

        private static readonly ILog log = LogManager.GetLogger(typeof(Provider));
    }
}
