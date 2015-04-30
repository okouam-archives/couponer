using System.Configuration;

namespace Couponer.Tasks.Utility
{
    public static class Config
    {
        public static string AMAZON_USERNAME
        {
            get { return ConfigurationManager.AppSettings["AMAZON_USERNAME"]; }
        }

        public static string AMAZON_PASSWORD
        {
            get { return ConfigurationManager.AppSettings["AMAZON_PASSWORD"]; }
        }

        public static string DB_CONNECTION_STRING
        {
            get { return ConfigurationManager.AppSettings["DB_CONNECTION_STRING"]; }
        }
    }
}
