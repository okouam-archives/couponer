using System.Configuration;

namespace Couponer.Tasks.Utility
{
    static class Config
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

        public static string WP_PASSWORD
        {
            get { return ConfigurationManager.AppSettings["WP_PASSWORD"]; }
        }

        public static string WP_USERNAME
        {
            get { return ConfigurationManager.AppSettings["WP_USERNAME"]; }
        }

        public static string WP_HOST
        {
            get { return ConfigurationManager.AppSettings["WP_HOST"]; }
        }
    }
}
