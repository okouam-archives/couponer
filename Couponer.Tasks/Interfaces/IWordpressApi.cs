using System.Collections.Generic;
using WordPressSharp.Models;

namespace Couponer.Tasks
{
    public interface IWordpressApi
    {
        IEnumerable<Term> RetrieveTerms(int number = 10000);

        string CreateTerm(string name, string parentId = null);

        void CreatePost(Post post);
    }
}