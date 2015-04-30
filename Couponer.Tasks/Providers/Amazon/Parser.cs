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
    public class Parser
    {
        public static IEnumerable<Shop> GetShops(string file, MERCHANT merchant)
        {
            var doc = JsonConvert.DeserializeObject<JObject>(File.ReadAllText(file));

            var deals = doc["deals"];

            foreach (var deal in deals)
            {
                var counter = 0;

                foreach (var location in deal.SelectToken("redemptionLocations"))
                {
                    var shop = new Shop
                    {
                        Source = "AMAZON",
                        Longitude = GetProperty(location, "longitude"),
                        Latitude =  GetProperty(location, "latitude"),
                        PostalCode = GetProperty(location, "addressPostalCode"),
                        PhoneNumber = GetProperty(location, "phoneNumber"),
                        Geography = GetProperty(location, "geography.displayName"),
                        UniqueId = GetProperty(deal, "asin") + "/SHOP/" + counter,
                        StateOrProvince = GetProperty(location, "addressStateOrProvince"),
                        Street1 = GetProperty(location, "addressStreet1"),
                        Street2 = GetProperty(location, "addressStreet2"),
                    };


                    counter++;

                    yield return shop;
                }
            }

          
        }

        public static IEnumerable<DailyOffer> GetDeals(string file, MERCHANT merchant)
        {
            var doc = JsonConvert.DeserializeObject<JObject>(File.ReadAllText(file));

            var deals = doc["deals"];

            foreach (var deal in deals)
            {
                var counter = 0;

                foreach (var option in deal.SelectToken("options"))
                {
                    var dailyOffer = new AmazonDailyOffer
                    {
                        Title = GetProperty(option, "title"),
                        Description = GetProperty(deal, "description"),
                        ImageUrl = GetProperty(deal, "imageUrl"),
                        FinePrint = GetProperty(deal, "finePrint"),
                        Price = GetProperty(option, "price.amountInBaseUnit"),
                        Value = GetProperty(option, "value.amountInBaseUnit"),
                        Source = merchant.ToString(),
                        UniqueId = GetProperty(deal, "asin") + "/CODE/" + counter,
                        OfferEndTime = new DateTime(long.Parse(GetProperty(deal, "offerEndTime")) / 1000).ToString(),
                        Merchant = GetProperty(deal, "merchant.displayName"),
                        Products = new List<string> { GetProperty(deal, "category.name") },
                        Geographies = deal.SelectToken("geographies").Select(x => x.SelectToken("displayName").Value<String>())
                    };

                    counter ++;

                    yield return dailyOffer;
                }
            }
        }

        private static string GetProperty(JToken deal, string path)
        {
            var token = deal.SelectToken(path);
            return token != null ? token.Value<string>() : null;
        }
    }
}
