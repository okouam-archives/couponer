using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Xml.Linq;
using Couponer.Tasks.Domain;

namespace Couponer.Tasks.Providers.ShopWindow
{
    public class Parser
    {
        /* Public Methods. */

        public static IEnumerable<DailyOffer> GetDeals(string fileContents, MERCHANTS merchant)
        {
            var doc = XDocument.Load(fileContents);

            return from product in doc.Descendants("prod")
                   where product.Attribute("in_stock").Value == "yes"
                   select new DailyOffer
                   {
                       Description = GetChild(product, "desc"),
                       Name = GetChild(product, "name"),
                       ImageUrl = GetChild(product, "awImage"),
                       Merchant = merchant.ToString(),
                       Source = "SHOP_WINDOW",
                       UniqueId = product.Attribute("id").Value,
                       OfferEndTime = GetChild(product, "valTo"),
                       OfferStartTime = GetChild(product, "valFrom"),
                       Price = GetChild(product, "buynow"),
                       PurchaseUrl = GetChild(product, "awTrack"),
                       Value = GetValue(product),
                       Products = new List<string> { GetChild(product, "awCat").Replace("&", "and") }
                   };
        }

        /* Private. */

        private static string GetValue(XContainer product)
        {
            var rrp = product.Descendants("rrp").FirstOrDefault();

            if (rrp != null && !String.IsNullOrEmpty(rrp.Value))
            {
                return rrp.Value;
            }
            else
            {
                return product.Descendants("store").FirstOrDefault().Value;
            }
        }

        private static string GetChild(XContainer product, string name)
        {
            return product.Descendants(name).First().Value;
        }
    }
}
