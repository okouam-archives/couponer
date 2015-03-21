using WordPressSharp.Models;

namespace Couponer.Tasks.Domain
{
    public interface ITaxonomyCache
    {
        bool IsPopulated { get; }

        void Populate(IWordpressApi api, string file);

        Term Get(string parentId, string term);
    }
}