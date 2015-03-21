using System;
using System.Collections.Generic;
using System.Data.Common;
using System.Linq;
using Couponer.Tasks.Utility;
using Dapper;
using log4net;
using MySql.Data.MySqlClient;

namespace Couponer.Tasks
{
    public class DailyOfferCache : Logger, IDailyOfferCache
    {
        public bool IsPopulated
        {
            get { return existingOfferIds != null && existingOfferIds.Any(); }
        }

        /* Public Methods. */

        public void Populate()
        {
            log.Debug("Populating the daily offer cache.");

            var posts = GetFromDatabase().ToList();

            existingOfferIds = new Dictionary<string, List<string>>();

            foreach (var post in posts)
            {
                if (!existingOfferIds.ContainsKey(post.Key))
                {
                    existingOfferIds.Add(post.Key, new List<string>());
                }

                existingOfferIds[post.Key].Add(post.Value);
            }

            log.DebugFormat("Finished populating the daily offer cache with {0} offers.", posts.Count());
        }

        public bool Contains(string uniqueId, string source)
        {
            if (existingOfferIds == null) return false;
            
            return existingOfferIds.ContainsKey(source) && existingOfferIds[source].Contains(uniqueId);
        }

        /* Private. */

        private IEnumerable<KeyValuePair<string, string>> GetFromDatabase()
        {
            var connection = new MySqlConnection(Config.DB_CONNECTION_STRING);
            var sources = connection.Query<dynamic>("SELECT DISTINCT post_id, meta_value FROM wp_postmeta WHERE meta_key = 'source'");
            var uniqueids = connection.Query<dynamic>("SELECT DISTINCT post_id, meta_value FROM wp_postmeta WHERE meta_key = 'uniqueid'");

            return from source in sources 
                   let uniqueid = uniqueids.FirstOrDefault(x => x.post_id == source.post_id) 
                   where uniqueid != null 
                   select new KeyValuePair<string, string>(source.meta_value, uniqueid.meta_value);
        }
        
        private Dictionary<string, List<string>> existingOfferIds; 
    }
}
