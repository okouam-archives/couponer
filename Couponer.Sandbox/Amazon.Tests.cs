using System.Threading;
using Couponer.Tasks.Domain;
using Couponer.Tasks.Providers.Amazon;
using NUnit.Framework;

namespace Couponer.Sandbox
{
    [TestFixture]
    class AmazonTests
    {
        [Test]
        public void Sandbox()
        {
            log4net.Config.XmlConfigurator.Configure();
            ThreadPool.SetMinThreads(10, 10);
            TaxonomyService.Initialize();
            Provider.GetDeals();
        }
    }
}
