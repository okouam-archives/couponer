namespace Couponer.Tasks.Domain
{
    public interface IDatabase
    {
        void Save(IDailyOfferCache cache, ITaxonomyService taxonomyService, IWordpressApi api, params DailyOffer[] offers);
    }
}