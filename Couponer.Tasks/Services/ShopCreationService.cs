using System.Collections.Generic;
using Couponer.Tasks.Data;
using Couponer.Tasks.Domain;
using Couponer.Tasks.Utility;
using WordPressSharp.Models;

namespace Couponer.Tasks.Services
{
    public class ShopCreationService : Logger
    {
        /* Public Methods. */

        public static bool Contains(Shop shop)
        {
            return PostCreationService.Contains(shop.DatabaseIdentifier);
        }

        public static void Save(wp_user user, params Shop[] shops)
        {
            if (shops != null)
            {
                foreach (var shop in shops)
                {
                    if (!Contains(shop))
                    {
                        var id = PostCreationService.CreatePost(user, shop.Title, shop.DatabaseIdentifier, shop.Description, "shop");
                        
                        PostCreationService.CreatePostMetadata(id, shop.GetCustomFields());
                        PostCreationService.CreatePostTaxonomy(id, new[] { new wp_term_relationship { term_taxonomy_id = TaxonomyCreationService.GetGeography(shop.Geography) } });
                        
                        log.DebugFormat("Created shop with ID <{0}> for source <{1}>.", shop.UniqueId, shop.Source);
                    }
                    else
                    {
                        log.DebugFormat("Skipping shop with ID <{0}> for source <{1}>.", shop.UniqueId, shop.Source);

                    }
                }
            }
        }
    }
}
