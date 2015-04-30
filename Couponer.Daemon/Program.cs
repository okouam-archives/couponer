using System;
using System.Threading;
using Couponer.Tasks.Domain;
using Couponer.Tasks.Services;
using Fclp;

namespace Couponer.Daemon
{
    class Program
    {
        static void Main(string[] args)
        {
            log4net.Config.XmlConfigurator.Configure();
            TaxonomyCreationService.Initialize();
            ThreadPool.SetMinThreads(10, 10);

            var provider = GetProvider(args);
            var user = UserCreationService.CreateOrUpdate("couponer", "$P$BWJW/XnJo3sQg6CNqsrt1zHYMo4H7b1");

            switch (provider)
            {
                case Provider.ShopWindow:
                    Tasks.Providers.ShopWindow.Provider.GetDeals(user);
                    break;
                case Provider.Amazon:
                    Tasks.Providers.Amazon.Provider.GetDeals(user);
                    break;
                case null:
                    throw new Exception("No provider was selected.");
                default:
                    throw new ArgumentOutOfRangeException();
            }
        }

        private static Provider? GetProvider(string[] args)
        {
            var p = new FluentCommandLineParser();

            Provider? provider = null;

            p.Setup<Provider>('p', "provider")
                .Callback(val => provider = val)
                .Required();

            p.Parse(args);
            return provider;
        }
    }
}

