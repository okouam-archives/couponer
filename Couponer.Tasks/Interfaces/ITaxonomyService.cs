using System.Collections.Generic;
using WordPressSharp.Models;

namespace Couponer.Tasks.Domain
{
    public interface ITaxonomyService
    {
        IEnumerable<Term> NewGeographies(IEnumerable<string> terms, IWordpressApi api);
        IEnumerable<Term> NewProducts(IEnumerable<string> terms, IWordpressApi api);
    }
}