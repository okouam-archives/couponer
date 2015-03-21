using System;
using System.Collections.Generic;
using System.Linq;
using Couponer.Tasks.Utility;
using WordPressSharp.Models;
using Metadata = System.Collections.Generic.Dictionary<string, System.Collections.Generic.KeyValuePair<string, string>>;

namespace Couponer.Tasks.Domain
{
    public class Database : Logger, IDatabase
    {
        /* Public Methods. */

        public void Save(IDailyOfferCache cache, ITaxonomyService taxonomyService, IWordpressApi api, params DailyOffer[] offers)
        {
            foreach (var offer in offers)
            {
                if (!cache.Contains(offer.UniqueId, offer.Source))
                {
                    var terms = new List<Term>();

                    if (offer.Geographies != null && offer.Geographies.Any())
                    {
                        terms.AddRange(taxonomyService.NewGeographies(offer.Geographies, api));
                    }

                    if (offer.Products != null && offer.Products.Any())
                    {
                        terms.AddRange(taxonomyService.NewProducts(offer.Products, api));
                    }

                    var post = new Post
                               {
                                   Name = offer.Name,
                                   Title = offer.Name,
                                   Status = "publish",
                                   Content = offer.Description,
                                   CustomFields = GetCustomFields(offer).ToArray(),
                                   Terms = terms.ToArray()
                               };

                    api.CreatePost(post);
                    log.DebugFormat("Created daily offer with ID <{0}> for merchant <{1}>.", offer.UniqueId, offer.Merchant);
                }
                else
                {
                    log.DebugFormat("Skipping daily offer with ID <{0}> for merchant <{1}>.", offer.UniqueId, offer.Merchant);
                }
            }
           
        }

        /* Private. */

        private static IEnumerable<CustomField> GetCustomFields(DailyOffer dailyOffer)
        {
            if (!String.IsNullOrEmpty(dailyOffer.Source)) yield return new CustomField { Key = "source", Value = dailyOffer.Source };
            if (!String.IsNullOrEmpty(dailyOffer.UniqueId)) yield return new CustomField {Key = "uniqueid", Value = dailyOffer.UniqueId};
            if (!String.IsNullOrEmpty(dailyOffer.FinePrint)) yield return new CustomField {Key = "finePrint", Value = dailyOffer.FinePrint};
            if (!String.IsNullOrEmpty(dailyOffer.Merchant)) yield return new CustomField { Key = "merchant", Value = dailyOffer.Merchant };
            if (!String.IsNullOrEmpty(dailyOffer.ImageUrl)) yield return new CustomField { Key = "imageUrl", Value = dailyOffer.ImageUrl };
            if (!String.IsNullOrEmpty(dailyOffer.OfferStartTime)) yield return new CustomField { Key = "offerStartTime", Value = dailyOffer.OfferStartTime };
            if (!String.IsNullOrEmpty(dailyOffer.OfferEndTime)) yield return new CustomField { Key = "offerEndTime", Value = dailyOffer.OfferEndTime };
            if (!String.IsNullOrEmpty(dailyOffer.Price)) yield return new CustomField { Key = "price", Value = dailyOffer.Price };
            if (!String.IsNullOrEmpty(dailyOffer.PurchaseUrl)) yield return new CustomField { Key = "purchaseUrl", Value = dailyOffer.PurchaseUrl };
        }
    }
}
