using System.Linq;
using Couponer.Tasks.Utility;
using Dapper;
using MySql.Data.MySqlClient;
using Slugify;
using WordPressSharp.Models;

namespace Couponer.Tasks.Domain
{
    public class TaxonomyService : Logger
    {
        /* Public Methods. */

        public static void Initialize()
        {
            var geography = Get("geography") ?? Create("geography");
            var product = Get("product") ?? Create("product");
        }

        public static Term GetProduct(string name)
        {
            return Get(name) ?? Create(name, "product");
        }

        public static Term GetGeography(string name)
        {
            return Get(name) ?? Create(name, "geography");
        }

        /* Private. */

        private static Term Get(string name)
        {
            var connection = new MySqlConnection(Config.DB_CONNECTION_STRING);
            var result = connection.Query<dynamic>("SELECT term_id, name, slug FROM wp_terms WHERE name = '" + name.Replace("'", "''") + "'").FirstOrDefault();
            return result != null ? new Term { Slug = result.slug, Name = result.name, Id = result.term_id } : Create(name);
        }

        private static Term Create(string name, string parent = null)
        {
            var term = new Term
            {
                Slug = new SlugHelper().GenerateSlug(name),
                Name = name,
                Parent = parent == null ? 0 : Get(parent).Id
            };

            var connection = new MySqlConnection(Config.DB_CONNECTION_STRING);
            connection.Execute("INSERT INTO wp_terms (name, slug) VALUES (@Name, @Slug)", term);

            term.Id = ulong.Parse(connection.Query<string>("SELECT term_id FROM wp_terms WHERE slug = @Slug",  term).First());
            connection.Execute("INSERT INTO wp_term_taxonomy(term_id, taxonomy, parent, description, count) VALUES (@Id, 'category', @Parent, '', 0)", term);
            return term;
        }
    }
}
