using System.Collections;
using System.Linq;
using System.Security.Policy;
using Couponer.Tasks.Data;
using Couponer.Tasks.Services;
using Couponer.Tasks.Utility;
using Slugify;

namespace Couponer.Tasks.Domain
{
    public class TaxonomyCreationService : Logger
    {
        static Hashtable tree;

        /* Public Methods. */

        public static void Initialize()
        {
            EnsureCategory("geography");
            EnsureCategory("product");
        }

        public static long GetProduct(string name)
        {
            var id = Get(name);
            return id.HasValue ? id.Value : Create(name, "code_category", "product");
        }

        public static long GetGeography(string name)
        {
            var id = Get(name);
            return id.HasValue ? id.Value : Create(name, "geography");
        }

        public static void Clear()
        {
            using (var ctx = new DatabaseContext(Config.DB_CONNECTION_STRING))
            {
                foreach (var row in ctx.WP_Term_Taxonomy)
                {
                    ctx.WP_Term_Taxonomy.Remove(row);
                }

                ctx.SaveChanges();

                foreach (var row in ctx.WP_Options.Where(x => x.option_name.StartsWith("taxonomy_") || x.option_name == "code_category_children"))
                {
                    ctx.WP_Options.Remove(row);
                }

                ctx.SaveChanges();
                
                foreach (var row in ctx.WP_Terms)
                {
                    ctx.WP_Terms.Remove(row);
                }

                ctx.SaveChanges();
            }
        }

        /* Private. */

        private static void EnsureCategory(string name)
        {
            if (Get(name) == null)
            {
                log.InfoFormat("Creating the category <{0}>.", name);
                var id = Create(name);
                log.InfoFormat("The category <{0}> has been created.", name);
                AddRootOption(id);
            }
            else
            {
                log.InfoFormat("The category <{0}> is present in the database.", name);
            }
        }

        private static void AddRootOption(long id)
        {
            var serializer = new Serializer();

            using (var ctx = new DatabaseContext(Config.DB_CONNECTION_STRING))
            {
                var option = ctx.WP_Options.FirstOrDefault(x => x.option_name == "code_category_children");

                if (option == null)
                {
                    option = new wp_option {option_name = "code_category_children"};
                    ctx.WP_Options.Add(option);
                    tree = new Hashtable();
                }
                else
                {
                    tree = (Hashtable) serializer.Deserialize(option.option_value);
                }

                if (!tree.ContainsKey(id))
                {
                    tree.Add(id, new ArrayList());
                }

                option.option_value = serializer.Serialize(tree);
                ctx.SaveChanges();
            }
        }

        private static void AddOptionEntry(long id, long parentId)
        {
            using (var ctx = new DatabaseContext(Config.DB_CONNECTION_STRING))
            {
                var wp_option = new wp_option
                {
                    option_name = "taxonomy_" + id,
                    option_value = "a:1:{s:13:\"category_icon\";s:0:\"\";}"
                };

                ctx.WP_Options.Add(wp_option);

                ((ArrayList) tree[parentId]).Add(id);

                var option = ctx.WP_Options.First(x => x.option_name == "code_category_children");
                option.option_value = new Serializer().Serialize(tree);
                ctx.SaveChanges();

                // if not root nodes and not contained in root nodes then add to relevant root node
            }
        }

        private static long? Get(string name)
        {
            using (var ctx = new DatabaseContext(Config.DB_CONNECTION_STRING))
            {
                var slug = new SlugHelper().GenerateSlug(name);
                var term = ctx.WP_Terms.FirstOrDefault(x => x.slug == slug);
                return term != null ? term.term_id : (long?) null;
            }
        }

        private static long Create(string name, string taxonomy = "code_category", string parent = null)
        {
            using (var ctx = new DatabaseContext(Config.DB_CONNECTION_STRING))
            {
                var wp_term = new wp_term { name = name, slug = new SlugHelper().GenerateSlug(name) };
                ctx.WP_Terms.Add(wp_term);
                ctx.SaveChanges();

              var wp_term_taxonomy = new wp_term_taxonomy
                 {
                     taxonomy = taxonomy,
                     term_id = wp_term.term_id,
                     parent = parent == null ? 0 : Get(parent).Value
                 };

                ctx.WP_Term_Taxonomy.Add(wp_term_taxonomy);
                ctx.SaveChanges();

                if (parent != null)
                {
                    AddOptionEntry(wp_term.term_id, Get(parent).Value);
                }
         
                return wp_term.term_id;
            }
        }
    }
}
