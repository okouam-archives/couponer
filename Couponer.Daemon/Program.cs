using System.Threading;
using Couponer.Tasks.Domain;

namespace Couponer.Daemon
{
    class Program
    {
        static void Main()
        {
            log4net.Config.XmlConfigurator.Configure();
            TaxonomyService.Initialize();
            ThreadPool.SetMinThreads(10, 10);
            Tasks.Providers.Amazon.Provider.GetDeals();
            Tasks.Providers.ShopWindow.Provider.GetDeals();
        }
    }
}

