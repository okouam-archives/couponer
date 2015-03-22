using System;
using System.Collections.Generic;
using System.Linq;
using Couponer.Tasks.Utility;
using Dapper;
using MySql.Data.MySqlClient;
using WordPressSharp.Models;
using Metadata = System.Collections.Generic.Dictionary<string, System.Collections.Generic.KeyValuePair<string, string>>;

namespace Couponer.Tasks.Domain
{
    public class Database : Logger
    {
        /* Public Methods. */

        public static void Save(params Shop[] shops)
        {
            if (shops != null)
            {
                foreach (var shop in shops)
                {
                    if (!Contains(shop))
                    {
                        CreatePost(shop);

                        log.DebugFormat("Created redemption location with ID <{0}> for source <{1}>.", shop.OfferName, shop.Source);
                    }
                    else
                    {
                        log.DebugFormat("Skipping redemption location with ID <{0}> for source <{1}>.", shop.OfferName, shop.Source);
                        
                    }
                }
            }
        }

        public static void Save(params DailyOffer[] offers)
        {
            foreach (var offer in offers)
            {
                if (!Contains(offer.DatabaseIdentifier))
                {
                    var terms = GetTerms(offer);

                    CreatePost(offer, terms);

                    log.DebugFormat("Created daily offer with ID <{0}> for merchant <{1}>.", offer.UniqueId, offer.Merchant);
                }
                else
                {
                    log.DebugFormat("Skipping daily offer with ID <{0}> for merchant <{1}>.", offer.UniqueId, offer.Merchant);
                }
            }
        }

        /* Private. */

        private static void CreatePost(Shop shop)
        {
            var post = new Post
            {
                Title = shop.Title,
                Name = shop.DatabaseIdentifier,
                Status = "publish",
                Content = shop.Description,
                CustomFields = GetCustomFields(shop).Where(x => !String.IsNullOrEmpty(x.Value)).ToArray(),
                Terms = new []{TaxonomyService.GetGeography(shop.Geography).Id.ToString()}
            };
            
            WordpressApi.CreatePost(post);
        }

        private static void CreatePost(DailyOffer offer, IEnumerable<ulong> terms)
        {
            var post = new Post
            {
                Title = offer.Title,
                Name = offer.DatabaseIdentifier,
                Status = "publish",
                Content = offer.Description,
                CustomFields = GetCustomFields(offer).Where(x => !String.IsNullOrEmpty(x.Value)).ToArray(),
                Terms = terms.Select(x => x.ToString()).ToArray()
            };

            WordpressApi.CreatePost(post);
        }

        private static IEnumerable<ulong> GetTerms(DailyOffer offer)
        {
            var terms = new List<ulong>();

            if (offer.Geographies != null && offer.Geographies.Any())
            {
                terms.AddRange(offer.Geographies.Select(TaxonomyService.GetGeography).Select(x=> x.Id));
            }

            if (offer.Products != null && offer.Products.Any())
            {
                terms.AddRange(offer.Products.Select(TaxonomyService.GetProduct).Select(x => x.Id));
            }

            return terms;
        }

        private static IEnumerable<CustomField> GetCustomFields(DailyOffer dailyOffer)
        {
            if (!String.IsNullOrEmpty(dailyOffer.Source)) yield return new CustomField { Key = "spec", Value = dailyOffer.Spec };
            if (!String.IsNullOrEmpty(dailyOffer.Source)) yield return new CustomField { Key = "warranty", Value = dailyOffer.Warranty };
            if (!String.IsNullOrEmpty(dailyOffer.Source)) yield return new CustomField { Key = "promo", Value = dailyOffer.Promo };
            if (!String.IsNullOrEmpty(dailyOffer.Source)) yield return new CustomField { Key = "description", Value = dailyOffer.Description };
            if (!String.IsNullOrEmpty(dailyOffer.Source)) yield return new CustomField { Key = "dbid", Value = dailyOffer.DatabaseIdentifier };
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
        
        private static IEnumerable<CustomField> GetCustomFields(Shop shop)
        {
            if (!String.IsNullOrEmpty(shop.PostalCode)) yield return new CustomField { Key = "postalCode", Value = shop.PostalCode };
            if (!String.IsNullOrEmpty(shop.PhoneNumber)) yield return new CustomField { Key = "phoneNumber", Value = shop.PhoneNumber };
            if (!String.IsNullOrEmpty(shop.Longitude)) yield return new CustomField { Key = "longitude", Value = shop.Longitude };
            if (!String.IsNullOrEmpty(shop.Latitude)) yield return new CustomField { Key = "latitude", Value = shop.Latitude };
            if (!String.IsNullOrEmpty(shop.DatabaseIdentifier)) yield return new CustomField { Key = "dbid", Value = shop.DatabaseIdentifier };
            if (!String.IsNullOrEmpty(shop.OfferName)) yield return new CustomField { Key = "offerName", Value = shop.OfferName };
            if (!String.IsNullOrEmpty(shop.StateOrProvince)) yield return new CustomField { Key = "stateOrProvince", Value = shop.StateOrProvince };
            if (!String.IsNullOrEmpty(shop.Street1)) yield return new CustomField { Key = "street1", Value = shop.Street1 };
            if (!String.IsNullOrEmpty(shop.Street2)) yield return new CustomField { Key = "street2", Value = shop.Street2 };
            if (!String.IsNullOrEmpty(shop.Source)) yield return new CustomField { Key = "source", Value = shop.Source };
        }
        
        private static bool Contains(Shop shop)
        {
            return Contains(shop.OfferName + "-" + shop.Longitude + "-" + shop.Latitude);
        }

        private static bool Contains(string identifier)
        {
            var connection = new MySqlConnection(Config.DB_CONNECTION_STRING);
            const string sql = "SELECT COUNT(*) FROM wp_postmeta WHERE meta_key = 'dbid' AND meta_value = '{0}'";

            var count = connection.Query<int>(String.Format(sql, identifier)).First();

            if (count > 1)
            {
                throw new Exception(String.Format("Duplicate entry for identifier <{0}>.", identifier));
            }

            return count == 1;
        }
    }
}
