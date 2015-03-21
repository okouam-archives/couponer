using Couponer.Tasks;
using Couponer.Tasks.Domain;
using NUnit.Framework;
using StructureMap;

namespace Couponer.Sandbox
{
    [TestFixture]
    class TaxonomyCacheTests
    {
        [Test]
        public void When_populating_gets_all_terms()
        {
            var container = new Container(new ServiceLocator());
            new TaxonomyCache().Populate(container.GetInstance<WordpressApi>(), null);
        }
    }
}
