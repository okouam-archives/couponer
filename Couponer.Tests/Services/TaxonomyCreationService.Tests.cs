using System.Linq;
using Couponer.Tasks.Data;
using Couponer.Tasks.Domain;
using Couponer.Tasks.Utility;
using NUnit.Framework;

namespace Couponer.Tests.Services
{
    [TestFixture]
    class TaxonomyServiceTests
    {
        [Test]
        public void When_getting_products_updates_the_database_tables()
        {
            TaxonomyCreationService.Clear();
            TaxonomyCreationService.Initialize();
            TaxonomyCreationService.GetProduct("random-product");

            using (var ctx = new DatabaseContext(Config.DB_CONNECTION_STRING))
            {
                var item = ctx.WP_Terms.FirstOrDefault(x => x.name == "random-product");
                Assert.That(item, Is.Not.Null);
            }
        }

        [Test]
        public void When_getting_products_updates_the_options_table()
        {
            const string PREFIX = "taxonomy_";
            TaxonomyCreationService.Clear();
            TaxonomyCreationService.Initialize();
            var id = TaxonomyCreationService.GetProduct("random-product");

            using (var ctx = new DatabaseContext(Config.DB_CONNECTION_STRING))
            {
                var results = ctx.WP_Options.Where(x => x.option_name.StartsWith(PREFIX)).ToList();
                Assert.That(results, Is.Not.Empty);
                Assert.That(results.FirstOrDefault(x => x.option_name == PREFIX + id), Is.Not.Null);
            }
        }

        [Test]
        public void When_initializating_creates_the_product_code_category()
        {
            TaxonomyCreationService.Clear();
            TaxonomyCreationService.Initialize();

            using (var ctx = new DatabaseContext(Config.DB_CONNECTION_STRING))
            {
                var item = ctx.WP_Terms.FirstOrDefault(x => x.name == "product");
                Assert.That(item, Is.Not.Null);
            }
        }

        [Test]
        public void When_initializating_creates_the_geography_code_category()
        {
            TaxonomyCreationService.Clear();
            TaxonomyCreationService.Initialize();

            using (var ctx = new DatabaseContext(Config.DB_CONNECTION_STRING))
            {
                var item = ctx.WP_Terms.FirstOrDefault(x => x.name == "geography");
                Assert.That(item, Is.Not.Null);
            }
        }
    }
}
