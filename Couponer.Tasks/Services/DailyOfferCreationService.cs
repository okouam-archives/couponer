using System;
using System.Collections.Generic;
using System.Linq;
using Couponer.Tasks.Data;
using Couponer.Tasks.Domain;
using Couponer.Tasks.Utility;
using WordPressSharp.Models;

namespace Couponer.Tasks.Services
{
    public class DailyOfferCreationService : Logger
    {
        /* Public Methods. */

        public static void Save(wp_user user, params DailyOffer[] offers)
        {
            foreach (var offer in offers)
            {
                if (!PostCreationService.Contains(offer.DatabaseIdentifier))
                {
                    var terms = offer.GetTerms();
                    var customFields = offer.GetCustomFields();
                    
                    var id = PostCreationService.CreatePost(user, offer.Title, offer.DatabaseIdentifier, offer.Description, "code");
                    
                    PostCreationService.CreatePostMetadata(id, customFields);
                    PostCreationService.CreatePostTaxonomy(id, terms);

                    log.DebugFormat("Created daily offer with ID <{0}> for merchant <{1}>.", offer.UniqueId, offer.Merchant);
                }
                else
                {
                    log.DebugFormat("Skipping daily offer with ID <{0}> for merchant <{1}>.", offer.UniqueId, offer.Merchant);
                }
            }
        }
    }
}
