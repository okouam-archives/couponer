using System;
using System.Collections.Generic;
using System.Linq;
using Couponer.Tasks.Utility;
using WordPressSharp.Models;

namespace Couponer.Tasks.Domain
{
    public class TaxonomyService : Logger, ITaxonomyService
    {
        /* Constructors. */

        public TaxonomyService(ITaxonomyCache cache)
        {
            this.cache = cache;
        }

        /* Public Methods. */

        public IEnumerable<Term> NewGeographies(IEnumerable<string> terms, IWordpressApi api)
        {
            if (terms != null && terms.Any())
            {
                return Insert("geography", terms, api);
            }

            return null;
        }

        public IEnumerable<Term> NewProducts(IEnumerable<string> terms, IWordpressApi api)
        {
            return Insert("product", terms, api);
        }

        /* Private. */

        private IEnumerable<Term> Insert(string parent, IEnumerable<string> terms, IWordpressApi api)
        {
            if (terms.Any())
            {
                var parentId = GetParentId(parent);

                foreach (var term in terms)
                {
                    var existingTerm = cache.Get(parentId, term);
                   
                    if (existingTerm == null)
                    {

                        yield return Insert(term, parentId, api);
                    }
                    else
                    {
                        existingTerm.Taxonomy = "category";
                        yield return existingTerm;
                    }
                }
            }
        }

        private Term Insert(string identifier, string parentId, IWordpressApi api)
        {
            log.DebugFormat("Adding the term <{0}>.", identifier);

            var term = CreateTermInWordpress(identifier, parentId, api);
            term.Taxonomy = "category";

            cache.Add(parentId, term);

            return term;
        }

        private string GetParentId(string parent)
        {
            var parentId = cache.FindParent(parent);

            if (parentId == null)
            {
                throw new Exception("Parent term <XX> does not exist.");
            }

            return parentId;
        }

        private Term CreateTermInWordpress(string term, string parentId, IWordpressApi api)
        {
            var id = api.CreateTerm(term, parentId);
            return new Term {Name = term, Parent = parentId, Id = id};
        }

        private readonly ITaxonomyCache cache;
    }
}
