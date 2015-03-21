using System.Configuration;

namespace Couponer.Tasks.Utility
{
    class Config
    {
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
