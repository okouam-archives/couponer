using System.Threading;
using Couponer.Tasks.Domain;
using Couponer.Tasks.Providers.ShopWindow;
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
            ThreadPool.SetMinThreads(10, 10);
            TaxonomyService.Initialize();
            Provider.GetDeals();
        }
    }
}

/* 
 DELETE FROM `wordpress813`.`wp_posts` WHERE ID > 0;
 DELETE FROM `wordpress813`.`wp_terms` WHERE term_id > 1;
 DELETE FROM `wordpress813`.`wp_term_taxonomy` WHERE term_taxonomy_id > 0;
 DELETE FROM `wordpress813`.`wp_term_relationships` WHERE object_id > 0;
 DELETE FROM `wordpress813`.`wp_postmeta` WHERE meta_id > 0;
*/