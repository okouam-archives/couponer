using System.Collections.Generic;
using WordPressSharp;
using WordPressSharp.Models;

namespace Couponer.Tasks
{
    public class WordpressApi : IWordpressApi
    {
        /* Constructors. */

        public WordpressApi(string url, string username, string password)
        {
            this.wpClient = new WordPressClient(new WordPressSiteConfig
                                                {
                Username = username, 
                Password = password,
                BaseUrl = url,
                BlogId = 0
            });
        }

        /* Public Methods. */

        public Post[] GetPosts(int number = 10000)
        {
            return wpClient.GetPosts(new PostFilter { Number = number });
        }

        public IEnumerable<Term> RetrieveTerms(int number = 10000)
        {
            return wpClient.GetTerms("category", new TermFilter { Number = number });
        }

        public string CreateTerm(string name, string parentId = null)
        {
            return wpClient.NewTerm(new Term {Parent = parentId, Name = name, Taxonomy = "category"});
        }

        public void CreatePost(Post post)
        {
            wpClient.NewPost(post);
        }

        /* Private. */

        private readonly WordPressClient wpClient;
    }
}
