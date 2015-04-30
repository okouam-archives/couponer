using System.Threading;
using Couponer.Tasks.Domain;
using Couponer.Tasks.Providers.ShopWindow;
using Couponer.Tasks.Services;
using NUnit.Framework;

namespace Couponer.Sandbox
{
    [TestFixture]
    class ShopWindowTests
    {
        [Test]
        public void Sandbox()
        {
            log4net.Config.XmlConfigurator.Configure();
            PostCreationService.Clear();
            TaxonomyCreationService.Clear();
            TaxonomyCreationService.Initialize();
            var user = UserCreationService.CreateOrUpdate("couponer", "$P$BWJW/XnJo3sQg6CNqsrt1zHYMo4H7b1");
            Provider.GetDeals(user);
        }
    }
}