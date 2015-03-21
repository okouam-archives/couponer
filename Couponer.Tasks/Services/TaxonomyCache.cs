using System;
using System.Collections.Generic;
using System.Linq;
using System.Xml.Linq;
using Couponer.Tasks.Providers.ShopWindow;
using Couponer.Tasks.Utility;
using Dapper;
using MySql.Data.MySqlClient;
using WordPressSharp.Models;

namespace Couponer.Tasks.Domain
{
    public class TaxonomyCache : Logger, ITaxonomyCache
    {
        /* Properties. */

        public bool IsPopulated
        {
            get { return taxonomy.Count > 0; }
        }

        /* Public Methods. */

        public void Populate(IWordpressApi api, string file)
        {
            log.Debug("Populating the taxonomy cache.");

            var geography = EnsureTaxonomyExists("geography", api, file, (doc, parent) =>
            {
                return Enumerable.Empty<Term>();
            });

            var productCategory = EnsureTaxonomyExists("product", api, file, (doc, parent) =>
            {
                return from product in doc.Descendants("prod")
                where product.Attribute("in_stock").Value == "yes"
                select new Term {Parent  = parent.Id, Taxonomy = "category", Name = Parser.GetChild(product, "awCat").Replace("&", "and")};
            });

            log.DebugFormat("The taxonomy cache has been populated with {0} terms.", taxonomy[geography].Count() + taxonomy[productCategory].Count());
        }

        public Term Get(string parentId, string term)
        {
            var parent = taxonomy.Keys.First(x => x.Name == parentId);
            return taxonomy[parent].FirstOrDefault(x => x.Name == term);
        }

        /* Private. */

        private Term EnsureTaxonomyExists(string name, IWordpressApi api, string file, Func<XDocument, Term, IEnumerable<Term>> callback)
        {
            var parent = Refresh(name, api);
            taxonomy.Add(parent, new List<Term>());
            taxonomy[parent].AddRange(callback(XDocument.Load(file), parent));
            EnsureDatabaseEquivalency(taxonomy[parent], api);
            return parent;
        }

        private void EnsureDatabaseEquivalency(IEnumerable<Term> terms, IWordpressApi api)
        {
            foreach (var term in terms)
            {
                var id = GetTermId(term) ?? CreateTerm(term, api);
                term.Id = id;
            }
        }

        string CreateTerm(Term term, IWordpressApi api)
        {
            return api.CreateTerm(term.Name, term.Parent);
        }

        string GetTermId(Term term)
        {
            var connection = new MySqlConnection(Config.DB_CONNECTION_STRING);
            return connection.Query<string>("SELECT term_id FROM wp_terms WHERE name = '" + term.Name.Replace("'", "''") + "'").FirstOrDefault();
        }

        private Term Refresh(string name, IWordpressApi api)
        {
            var terms = api.RetrieveTerms();
            var term = terms.FirstOrDefault(x => x.Name == name);
            var id = term != null ? term.Id : api.CreateTerm(name);
            return new Term {Id = id, Name = name, Taxonomy = "category"};
        }

        private readonly Dictionary<Term, List<Term>> taxonomy = new Dictionary<Term, List<Term>>(); 
    }
}
