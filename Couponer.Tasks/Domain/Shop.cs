namespace Couponer.Tasks.Domain
{
    public class Shop
    {
        public string DatabaseIdentifier
        {
            get { return OfferName + "-" + Longitude + "-" + Latitude; }
        }

        public string Title
        {
            get { return "Redemption Location for " + OfferName; }
        }

        public string Description
        {
            get { return Street1 + ", " + Street2 + ", " + PostalCode + ", " + StateOrProvince + " for " + OfferName; }
        }

        public string PostalCode { get; set; }

        public string StateOrProvince { get; set; }

        public string Street1 { get; set; }

        public string Street2 { get; set; }

        public string Geography { get; set; }

        public string Latitude { get; set; }

        public string Longitude { get; set; }

        public string PhoneNumber { get; set; }

        public string Source { get; set; }

        public string OfferName { get; set; }
    }
}
