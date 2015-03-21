using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Xml.Linq;
using Couponer.Tasks.Domain;
using Couponer.Tasks.Utility;

namespace Couponer.Tasks.Providers.ShopWindow
{
    public class Parser : Logger
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
                       Warranty = GetChild(product, "warranty"),
                       Spec = GetChild(product, "spec"),
                       Name = GetChild(product, "name"),
                       ImageUrl = GetChild(product, "awImage"),
                       Merchant = merchant.ToString(),
                       Source = "SHOP_WINDOW",
                       Promo = GetChild(product, "promo"),
                       UniqueId = product.Attribute("id").Value,
                       OfferEndTime = GetChild(product, "valTo"),
                       OfferStartTime = GetChild(product, "valFrom"),
                       BuyNow = GetChild(product, "buynow"),
                       Store = GetChild(product, "store"),
                       RRP = GetChild(product, "rrp"),
                       Delivery = GetChild(product, "delivery"),
                       PurchaseUrl = GetChild(product, "awTrack"),
                       Value = GetValue(product),
                       Products = new List<string> { GetChild(product, "awCat").Replace("&", "and") }
                   };
        }

        public static string GetValue(XContainer product)
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

        public static string GetChild(XContainer product, string name)
        {
            try
            {
                var child = product.Descendants(name).FirstOrDefault();
                return child != null ? child.Value : String.Empty;
            }
            catch
            {
                log.Error(product.ToString());
                log.ErrorFormat("Unable to find in <{0}> in the preceding document.", name);
                throw;
            }
         
        }
    }
}
