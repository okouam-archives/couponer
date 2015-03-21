namespace Couponer.Tasks.Domain
{
    public interface IDatabase
    {
        void Save(IDailyOfferCache dailyOfferCache, ITaxonomyCache taxonomyCache, IWordpressApi api, params DailyOffer[] offers);
    }
}