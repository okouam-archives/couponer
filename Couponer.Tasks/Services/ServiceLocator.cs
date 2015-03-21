namespace Couponer.Tasks
{
    public class ServiceLocator : StructureMap.Configuration.DSL.Registry
    {
        public ServiceLocator()
        {
            log4net.Config.XmlConfigurator.Configure();
            For<WordpressApi>().Use(new WordpressApi("http://www.dealleague.com", "couponer", "com99123"));
            //For<WordpressApi>().Use(new WordpressApi("http://localhost/wordpress", "couponer", "com99123"));
        }
    }
}
