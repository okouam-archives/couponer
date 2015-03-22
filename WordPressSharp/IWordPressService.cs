using WordPressSharp.Models;
using XmlRpcLight;
using XmlRpcLight.Attributes;

namespace WordPressSharp
{
    public interface IWordPressService : XmlRpcService 
    {
        // GET
        [XmlRpcMethod("wp.getPost")]
        Post GetPost(int blog_id, string username, string password, int post_id);

        [XmlRpcMethod("wp.getPosts")]
        Post[] GetPosts(int blog_id, string username, string password, PostFilter postFilter);

        [XmlRpcMethod("wp.getTaxonomy")]
        Taxonomy GetTaxonomy(int blog_id, string username, string password, string taxonomy, int term_id);

        [XmlRpcMethod("wp.getTaxonomies")]
        Taxonomy[] GetTaxonomies(int blog_id, string username, string password, string taxonomy, TermFilter filter);

        [XmlRpcMethod("wp.getTerm")]
        Term GetTerm(int blog_id, string username, string password, string taxonomy, int term_id);

        [XmlRpcMethod("wp.getTerms")]
        Term[] GetTerms(int blog_id, string username, string password, string taxonomy, TermFilter filter);

        [XmlRpcMethod("wp.newPost")]
        string NewPost(int blog_id, string username, string password, Post_Put post);

        [XmlRpcMethod("wp.editPost")]
        bool EditPost(int blog_id, string username, string password, int post_id, Post_Put post);
        
        [XmlRpcMethod("wp.newTerm")]
        string NewTerm(int blog_id, string username, string password, Term term);
    }
}
