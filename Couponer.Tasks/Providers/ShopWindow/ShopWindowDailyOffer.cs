using System.Collections.Generic;
using System.Linq;
using Couponer.Tasks.Data;
using Couponer.Tasks.Domain;

namespace Couponer.Tasks.Providers.ShopWindow
{
    public class ShopWindowDailyOffer : DailyOffer
    {
        /* Public Properties. */

        public string Spec { get; set; }
        
        public string Promo { get; set; }

        public string Delivery { get; set; }

        public string Warranty { get; set; }
        
        public string PurchaseUrl { get; set; }

        public string OfferStartTime { get; set; }

        public string Language { get; set; }

        public string AWThumb { get; set; }

        public string MerchantThumbnail { get; set; }

        public string MerchantLink { get; set; }

        public string MerchantImage { get; set; }

        public string BuyNowPrice { get; set; }

        public string StorePrice { get; set; }

        public string RecommendedRetailPrice { get; set; }

        public string WebOffer { get; set; }

        public string InStock { get; set; }

        public string StockQuantity { get; set; }

        public string ProductMerchantId { get; set; }

        public string PreOrder { get; set; }

        public string BrandName { get; set; }

        /* Public Methods. */

        public override IEnumerable<wp_term_relationship> GetTerms()
        {
            return GetProducts(new List<wp_term_relationship>());
        }

        public override IEnumerable<wp_postmeta> GetCustomFields()
        {
            foreach (var field in GetCommonCustomFields())
            {
                yield return field;
            }

            yield return GetCustomField(Warranty, "warranty");
            yield return GetCustomField(Promo, "promo");
            yield return GetCustomField(PurchaseUrl, "purchaseUrl");
            yield return GetCustomField(OfferStartTime, "offerStartTime");
            yield return GetCustomField(AWThumb, "aw_thumb");
            yield return GetCustomField(MerchantThumbnail, "m_thumb");
            yield return GetCustomField(MerchantLink, "m_link");
            yield return GetCustomField(MerchantImage, "m_image");
            yield return GetCustomField(BuyNowPrice, "price_buynow");
            yield return GetCustomField(StorePrice, "price_store");
            yield return GetCustomField(RecommendedRetailPrice, "price_rrp");
            yield return GetCustomField(WebOffer, "web_offer");
            yield return GetCustomField(InStock, "in_stock");
            yield return GetCustomField(StockQuantity, "stock_quantity");
            yield return GetCustomField(ProductMerchantId, "pid");
            yield return GetCustomField(PreOrder, "pre_order");
            yield return GetCustomField(BrandName, "brandname");
        }
    }
}