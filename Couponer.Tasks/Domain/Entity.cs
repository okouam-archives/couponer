using System;
using Couponer.Tasks.Data;

namespace Couponer.Tasks.Domain
{
    public class Entity
    {
        protected wp_postmeta GetCustomField(string prop, string name)
        {
            return String.IsNullOrEmpty(prop) ? null : new wp_postmeta { meta_key = name, meta_value = prop };
        }
    }
}
