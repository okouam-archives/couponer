using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using Couponer.Tasks.Domain;
using Couponer.Tasks.Providers.ShopWindow;
using Couponer.Tasks.Services;
using log4net;
using Newtonsoft.Json;
using Newtonsoft.Json.Linq;

namespace Couponer.Tasks.Providers.Amazon
{
    class Parser
    {
        public static IEnumerable<Shop> GetShops(string file, MERCHANT merchant)
        {
            var doc = JsonConvert.DeserializeObject<JObject>(File.ReadAllText(file));

            return doc["deals"].Select(deal => new Shop
            {
                Source = "AMAZON",
                Longitude =  null,
                Latitude = null,
                PostalCode = null,
                PhoneNumber = null,
                Geography = null, 
                OfferName = null,
                StateOrProvince = null,
                Street1 = null,
                Street2 = null
            });
        }

        public static IEnumerable<DailyOffer> GetDeals(string file, MERCHANT merchant)
        {
            var doc = JsonConvert.DeserializeObject<JObject>(File.ReadAllText(file));

            return doc["deals"].Select(deal => new DailyOffer
            {
                Title = GetProperty(deal, "websiteTitle"),
                Description = GetProperty(deal, "description"),
                ImageUrl = GetProperty(deal, "imageUrl"),
                FinePrint = GetProperty(deal, "finePrint"),
                Price = GetProperty(deal.SelectToken("options")[0], "price.amountInBaseUnit"),
                Value = GetProperty(deal.SelectToken("options")[0], "value.amountInBaseUnit"),
                Source = merchant.ToString(),
                UniqueId = GetProperty(deal, "asin"),
                OfferEndTime = new DateTime(long.Parse(GetProperty(deal, "offerEndTime")) / 1000).ToString(),
                Merchant = GetProperty(deal, "merchant.displayName"),
                Products = new List<string> {GetProperty(deal, "category.name")},
                Geographies = deal.SelectToken("geographies").Select(x => x.SelectToken("displayName").Value<String>())
            });
        }

        private static string GetProperty(JToken deal, string path)
        {
            var token = deal.SelectToken(path);
            return token != null ? token.Value<string>() : null;
        }
    }
}
