using System;
using System.Collections.Generic;
using System.Linq;
using Couponer.Tasks.Data;
using Couponer.Tasks.Domain;

namespace Couponer.Tasks.Providers.Amazon
{
    public class AmazonDailyOffer : DailyOffer
    {
        public IEnumerable<String> Geographies { get; set; }

        public override IEnumerable<wp_term_relationship> GetTerms()
        {
            var terms = new List<wp_term_relationship>();

            if (Geographies != null && Geographies.Any())
            {
                terms.AddRange(Geographies.Select(x => new wp_term_relationship { term_taxonomy_id = TaxonomyCreationService.GetGeography(x) }));
            }

            GetProducts(terms);

            return terms;
        }

        public override IEnumerable<wp_postmeta> GetCustomFields()
        {
            return GetCommonCustomFields();
        }
    }
}