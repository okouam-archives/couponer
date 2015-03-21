using WordPressSharp.Models;

namespace Couponer.Tasks.Domain
{
    public interface ITaxonomyCache
    {
        bool IsPopulated { get; }

        void Populate(IWordpressApi api);

        string FindParent(string name);

        Term Get(string parentId, string term);

        void Add(string parentId, Term term);
    }
}