using Couponer.Tasks.Domain;
using Couponer.Tasks.Utility;

namespace Couponer.Tasks
{
    public class ServiceLocator : StructureMap.Configuration.DSL.Registry
    {
        public ServiceLocator()
        {
            log4net.Config.XmlConfigurator.Configure();
            For<IDailyOfferCache>().Use<DailyOfferCache>();
            For<IDataFeed>().Use<DataFeed>();
            For<ITaxonomyCache>().Use<TaxonomyCache>();
            For<IWordpressApi>().Use(new WordpressApi(Config.WP_HOST, Config.WP_USERNAME, Config.WP_PASSWORD));
        }
    }
}
