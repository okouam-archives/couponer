namespace Couponer.Tasks
{
    public interface IDailyOfferCache
    {
        bool IsPopulated { get; }

        void Populate(IWordpressApi api);

        bool Contains(string uniqueId, string source);
    }
}