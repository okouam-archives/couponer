using System;
using System.Collections.Generic;

namespace Couponer.Tasks.Domain
{
    public class DailyOffer
    {
        public string Name { get; set; }

        public string Source { get; set; }

        public string Description { get; set; }

        public string Merchant { get; set; }

        public string UniqueId { get; set; }

        public string ImageUrl { get; set; }

        public string FinePrint { get; set; }

        public string OfferStartTime { get; set; }

        public string OfferEndTime { get; set; }

        public string Price { get; set; }

        public string PurchaseUrl { get; set; }

        public string Value { get; set; }

        public IEnumerable<String> Geographies { get; set; } 

        public IEnumerable<String> Products { get; set; } 
    }
}
