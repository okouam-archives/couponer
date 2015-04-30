using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace Couponer.Tasks.Data
{
    [Table("wp_term_relationships")]
    public class wp_term_relationship
    {
        [Key, Column(Order = 0)]
        public long object_id { get; set; }

        [Key, Column(Order = 1)]
        public long term_taxonomy_id { get; set; }

        public long term_order { get; set; }
    }
}
