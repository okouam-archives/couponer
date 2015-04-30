using System.Collections.Generic;
using Couponer.Tasks.Data;

namespace Couponer.Tasks.Domain
{
    public class Shop : Entity
    {
        /* Public Properties. */

        public string DatabaseIdentifier
        {
            get { return UniqueId; }
        }

        public string Title
        {
            get { return UniqueId; }
        }

        public string Description
        {
            get { return Street1 + ", " + Street2 + ", " + PostalCode + ", " + StateOrProvince + " for " + UniqueId; }
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

        public string UniqueId { get; set; }
        
        /* Public Methods. */

        public IEnumerable<wp_postmeta> GetCustomFields()
        {
            yield return GetCustomField(PostalCode, "postalCode");
            yield return GetCustomField(PhoneNumber, "phoneNumber");
            yield return GetCustomField(Longitude, "longitude");
            yield return GetCustomField(Latitude, "latitude");
            yield return GetCustomField(DatabaseIdentifier, "dbid");
            yield return GetCustomField(UniqueId, "uniqueId");
            yield return GetCustomField(StateOrProvince, "stateOrProvince");
            yield return GetCustomField(Street1, "street1");
            yield return GetCustomField(Street2, "street2");
            yield return GetCustomField(Source, "source");
        }
    }
}
