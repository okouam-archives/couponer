using System.Threading;

namespace Couponer.Daemon
{
    class Program
    {
        static void Main()
        {
            ThreadPool.SetMinThreads(10, 10);
            Tasks.Providers.Amazon.Provider.GetDeals();
            Tasks.Providers.ShopWindow.Provider.GetDeals();
        }
    }
}

