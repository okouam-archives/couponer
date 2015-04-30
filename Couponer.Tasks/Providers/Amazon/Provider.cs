using Couponer.Tasks.Data;
using Couponer.Tasks.Providers.ShopWindow;
using Couponer.Tasks.Services;
using Couponer.Tasks.Utility;
using log4net;

namespace Couponer.Tasks.Providers.Amazon
{
    public class Provider 
    {
        public static void GetDeals(wp_user user)
        {
            log.Info("Getting deals for Amazon.");
            log.InfoFormat("Using value <{0}> for the configuration key DB_CONNECTION_STRING.", Config.DB_CONNECTION_STRING);
            AbstractProvider.Execute(MERCHANT.AMAZON, user, DataFeed.Download, Parser.GetDeals, Parser.GetShops);
        }

        private static readonly ILog log = LogManager.GetLogger(typeof(Provider));
    }
}
