using Couponer.Tasks.Providers.ShopWindow;
using Couponer.Tasks.Services;
using log4net;

namespace Couponer.Tasks.Providers.Amazon
{
    public class Provider 
    {
        public static void GetDeals()
        {
            log.Info("Getting deals for Amazon.");
            //AbstractProvider.Execute(MERCHANT.AMAZON, DataFeed.Download, Parser.GetDeals, Parser.GetShops);
            AbstractProvider.Execute(MERCHANT.AMAZON, DataFeed.Download, Parser.GetDeals);
        }

        private static readonly ILog log = LogManager.GetLogger(typeof(Provider));
    }
}
