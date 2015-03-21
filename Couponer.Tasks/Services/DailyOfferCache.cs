using System.Collections.Generic;
using System.Linq;
using Couponer.Tasks.Utility;
using log4net;

namespace Couponer.Tasks
{
    public class DailyOfferCache : Logger, IDailyOfferCache
    {
        public bool IsPopulated
        {
            get { return existingOfferIds != null && existingOfferIds.Any(); }
        }

        public void Populate(IWordpressApi api)
        {
            log.Debug("Populating the daily offer cache.");

            var posts = api.GetPosts();

            var merchants = posts
                .Where(post => post.CustomFields != null && post.CustomFields.Any(x => x.Key == "source"))
                .Select(post => post.CustomFields.First(x => x.Key == "source").Value)
                .Distinct();

            existingOfferIds = new Dictionary<string, List<string>>();

            var counter = 0;

            foreach (var merchant in merchants)
            {
                var offerIds = posts
                    .Where(post => post.CustomFields.Any(x => x.Key == "source" && x.Value == merchant))
                    .Select(post => post.CustomFields.First(x => x.Key == "uniqueid").Value)
                    .ToList();

                existingOfferIds.Add(merchant, offerIds);

                counter = counter + offerIds.Count;
            }

            log.DebugFormat("Finished populating the daily offer cache with {0} offers.", posts.Count());
        }

        public bool Contains(string uniqueId, string source)
        {
            return existingOfferIds.ContainsKey(source) && existingOfferIds[source].Contains(uniqueId);
        }

        private Dictionary<string, List<string>> existingOfferIds; 
    }
}
