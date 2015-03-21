namespace Couponer.Tasks
{
    public interface IDailyOfferCache
    {
        bool IsPopulated { get; }

        void Populate();

        bool Contains(string uniqueId, string source);
    }
}