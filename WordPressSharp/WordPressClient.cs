using System;
using System.Linq;
using WordPressSharp.Models;
using XmlRpcLight;
using XmlRpcLight.DataTypes;

namespace WordPressSharp
{
    public class WordPressClient : XmlRpcService, IDisposable
    {
        protected WordPressSiteConfig WordPressSiteConfig { get; set; }

        /// <summary>
        /// The interface extension for the CookComputing.XmlRpc proxy
        /// </summary>
        public IWordPressService WordPressService { get; internal set; }

        /// <summary>
        /// Initialize a new instance of the WordPress Client class
        /// </summary>
        /// <param name="siteConfig">WordPress Site Config</param>
        public WordPressClient(WordPressSiteConfig siteConfig)
        {
            WordPressSiteConfig = siteConfig;

            WordPressService = (IWordPressService)XmlRpcProxyGen.Create(typeof(IWordPressService));
            WordPressService.Url = WordPressSiteConfig.FullUrl;
        }

        public Post GetPost(int postId)
        {
            return WordPressService.GetPost(WordPressSiteConfig.BlogId, WordPressSiteConfig.Username, WordPressSiteConfig.Password, postId);
        }

        public Post[] GetPosts(PostFilter filter)
        {
            return WordPressService.GetPosts(WordPressSiteConfig.BlogId, WordPressSiteConfig.Username,
                WordPressSiteConfig.Password, filter);
        }

        public Taxonomy GetTaxonomy(string taxonomy, int termId)
        {
            return WordPressService.GetTaxonomy(WordPressSiteConfig.BlogId, WordPressSiteConfig.Username,
                WordPressSiteConfig.Password, taxonomy, termId);
        }

        public Taxonomy[] GetTaxonomies(string taxonomy, TermFilter filter)
        {
            return WordPressService.GetTaxonomies(WordPressSiteConfig.BlogId, WordPressSiteConfig.Username,
                WordPressSiteConfig.Password, taxonomy, filter);
        }

        public Term GetTerm(string taxonomy, int termId)
        {
            return WordPressService.GetTerm(WordPressSiteConfig.BlogId, WordPressSiteConfig.Username,
                WordPressSiteConfig.Password, taxonomy, termId);
        }

        public Term[] GetTerms(string taxonomy, TermFilter filter)
        {
            return WordPressService.GetTerms(WordPressSiteConfig.BlogId, WordPressSiteConfig.Username,
                WordPressSiteConfig.Password, taxonomy, filter);
        }

        public string NewPost(Post post)    
        {
            var post_put = new Post_Put();
            CopyPropertyValues(post, post_put);

            var terms = new XmlRpcStruct();
            var termTaxes = post.Terms.GroupBy(t => t.Taxonomy);
            foreach (var grp in termTaxes)
            {
                var termIds = grp.Select(g => g.Id).ToArray();
                terms.Add(grp.Key, termIds);
            }


            post_put.Terms = terms;


            return WordPressService.NewPost(WordPressSiteConfig.BlogId, WordPressSiteConfig.Username, WordPressSiteConfig.Password, post_put);
        }

        public bool EditPost(Post post)
        {
            var post_put = new Post_Put();
            CopyPropertyValues(post, post_put);

            var terms = new XmlRpcStruct();
            var termTaxes = post.Terms.GroupBy(t => t.Taxonomy);
            foreach (var grp in termTaxes)
            {
                var termIds = grp.Select(g => g.Id).ToArray();
                terms.Add(grp.Key, termIds);
            }

            
            post_put.Terms = terms;


            return WordPressService.EditPost(WordPressSiteConfig.BlogId, WordPressSiteConfig.Username, WordPressSiteConfig.Password, int.Parse(post_put.Id), post_put);
        }

        public string NewTerm(Term term)
        {
            return WordPressService.NewTerm(WordPressSiteConfig.BlogId, WordPressSiteConfig.Username,
                WordPressSiteConfig.Password, term);
        }

        public void Dispose()
        {
            WordPressService = null;
        }

        public static void CopyPropertyValues(object source, object destination)
        {
            var destProperties = destination.GetType().GetProperties();

            foreach (var sourceProperty in source.GetType().GetProperties())
            {
                foreach (var destProperty in destProperties)
                {
                    if (destProperty.Name == sourceProperty.Name &&
                destProperty.PropertyType.IsAssignableFrom(sourceProperty.PropertyType))
                    {
                        destProperty.SetValue(destination, sourceProperty.GetValue(
                            source, new object[] { }), new object[] { });

                        break;
                    }
                }
            }
        }
    }
}
