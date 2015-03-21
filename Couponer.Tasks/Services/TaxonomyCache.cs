using System;
using System.Collections.Generic;
using System.Linq;
using Couponer.Tasks.Utility;
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

        public void Populate(IWordpressApi api)
        {
            log.Debug("Populating the taxonomy cache.");

            var terms = api.RetrieveTerms();

            Refresh("geography", terms, api);
            Refresh("product", terms, api);

            var parents = new List<String> {FindParent("geography"), FindParent("product")};
            
            foreach (var term in terms.Where(term => parents.Contains(term.Parent)))
            {
                taxonomy.First(x => x.Key.Id == term.Parent).Value.Add(term);
            }

            log.DebugFormat("The taxonomy cache has been populated with {0} terms.", terms.Count());
        }

        public string FindParent(string name)
        {
            return taxonomy.Keys.First(x => x.Name == name).Id;
        }

        public Term Get(string parentId, string term)
        {
            var parent = GetParent(parentId);
            return taxonomy[parent].FirstOrDefault(x => x.Name == term);
        }

        public void Add(string parentId, Term term)
        {
            taxonomy.First(x => x.Key.Id == parentId).Value.Add(term);
        }

        /* Private. */

        private Term GetParent(string parentId)
        {
            var parent = taxonomy.Keys.First(x => x.Id == parentId);
            return parent;
        }

        private void Refresh(string name, IEnumerable<Term> availableTerms, IWordpressApi api)
        {
            var term = availableTerms.FirstOrDefault(x => x.Name == name);
            var id = term != null ? term.Id : api.CreateTerm(name);
            taxonomy.Add(new Term {Id = id, Name =  name}, new List<Term>());
        }

        private readonly Dictionary<Term, List<Term>> taxonomy = new Dictionary<Term, List<Term>>(); 
    }
}
