using System;
using System.Collections.Generic;
using System.Linq;
using Couponer.Tasks.Data;

namespace Couponer.Tasks.Domain
{
    public abstract class DailyOffer : Entity
    {
        /* Public Properties. */

        public string DatabaseIdentifier
        {
            get { return Source + "-" + UniqueId; }
        }

        public string Source { get; set; }

        public string Description { get; set; }

        public string Merchant { get; set; }

        public string UniqueId { get; set; }

        public string ImageUrl { get; set; }

        public string FinePrint { get; set; }

        public string OfferEndTime { get; set; }

        public string Price { get; set; }

        public string Currency { get; set; }

        public string Value { get; set; }

        public IEnumerable<String> Products { get; set; }

        public string Title { get; set; }

        /* Public Methods. */

        public abstract IEnumerable<wp_term_relationship> GetTerms();
        
        public abstract IEnumerable<wp_postmeta> GetCustomFields();

        /* Protected Methods. */

        protected IEnumerable<wp_postmeta> GetCommonCustomFields()
        {
            yield return GetCustomField(DateTime.Parse(OfferEndTime).Ticks.ToString(), "code_expire");
            yield return GetCustomField("all_users", "code_for");
            yield return GetCustomField("2", "code_type");
            yield return GetCustomField("coupon", "coupon_label");
            yield return GetCustomField(Description, "description");
            yield return GetCustomField(DatabaseIdentifier, "dbid");
            yield return GetCustomField(Source, "source");
            yield return GetCustomField(UniqueId, "uniqueid");
            yield return GetCustomField(FinePrint, "finePrint");
            yield return GetCustomField(Merchant, "merchant");
            yield return GetCustomField(ImageUrl, "imageUrl");
            yield return GetCustomField(OfferEndTime, "offerEndTime");
            yield return GetCustomField(Price, "price");
        }

        protected List<wp_term_relationship> GetProducts(List<wp_term_relationship> terms)
        {
            if (Products != null && Products.Any())
            {
                terms.AddRange(Products.Select(x => new wp_term_relationship { term_taxonomy_id = TaxonomyCreationService.GetProduct(x) }));
            }

            return terms;
        }
    }
}
