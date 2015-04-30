using System;
using System.Collections.Generic;
using System.Linq;
using System.Xml.Linq;
using Couponer.Tasks.Domain;
using Couponer.Tasks.Utility;

namespace Couponer.Tasks.Providers.ShopWindow
{
    public class Parser : Logger
    {
        /* Public Methods. */

        public static IEnumerable<DailyOffer> GetDeals(string fileContents, MERCHANT merchant)
        {
            var doc = XDocument.Load(fileContents);
            return from product in doc.Descendants("prod")
                   where product.Attribute("in_stock").Value == "yes"
                   select new ShopWindowDailyOffer
                   {
                       Language = GetAttribute(product, "lang"),
                       AWThumb = GetChild(product, "awThumb"),
                       MerchantThumbnail = GetChild(product, "mThumb"),
                       MerchantLink = GetChild(product, "mLink"),
                       MerchantImage = GetChild(product, "mImage"),
                       WebOffer = GetAttribute(product, "web_offer"),
                       InStock = GetAttribute(product, "in_stock"),
                       StockQuantity = GetAttribute(product, "stock_quantity"),
                       ProductMerchantId = GetChild(product, "pId"),
                       PreOrder = GetAttribute(product, "pre_order"),
                       BrandName = GetChild(product, "brandName"),
                       Description = GetChild(product, "desc"),
                       Warranty = GetChild(product, "warranty"),
                       Spec = GetChild(product, "spec"),
                       Title = GetChild(product, "name"),
                       ImageUrl = GetChild(product, "awImage"),
                       Merchant = merchant.ToString(),
                       Source = "SHOP_WINDOW",
                       Promo = GetChild(product, "promo"),
                       UniqueId = product.Attribute("id").Value,
                       OfferEndTime = GetChild(product, "valTo"),
                       OfferStartTime = GetChild(product, "valFrom"),
                       BuyNowPrice = GetChild(product, "buynow"),
                       StorePrice = GetChild(product, "store"),
                       RecommendedRetailPrice = GetChild(product, "rrp"),
                       Delivery = GetChild(product, "delivery"),
                       PurchaseUrl = GetChild(product, "awTrack"),
                       Value = GetValue(product),
                       Products = new List<string> { GetChild(product, "awCat").Replace("&", "and") }
                   };
        }

        static string GetAttribute(XElement product, string name)
        {
            var attribute = product.Attributes(name).FirstOrDefault();
            return attribute != null ? attribute.Value : null;
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
