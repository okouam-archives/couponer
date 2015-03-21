using System.Threading;
using Couponer.Tasks;
using Couponer.Tasks.Providers.ShopWindow;
using StructureMap;

namespace Couponer.Daemon
{
    class Program
    {
        static void Main()
        {
            ThreadPool.SetMinThreads(10, 10);
            Provider.GetDeals(new Container(new ServiceLocator()));
            Tasks.Providers.Amazon.Provider.GetDeals(new Container(new ServiceLocator()));
        }
    }
}

