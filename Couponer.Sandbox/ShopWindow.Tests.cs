using System.Threading;
using Couponer.Tasks;
using Couponer.Tasks.Providers.ShopWindow;
using NUnit.Framework;
using StructureMap;

namespace Couponer.Sandbox
{
    [TestFixture]
    class ShopWindowTests
    {
        [Test]
        public void Sandbox()
        {
            ThreadPool.SetMinThreads(10, 10);
            Provider.GetDeals(new Container(new ServiceLocator()));
        }
    }
}
