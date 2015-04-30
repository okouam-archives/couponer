using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace Couponer.Tasks.Data
{
    [Table("wp_terms")]
    public class wp_term
    {
        [Key, Column("term_id")]
        public long term_id { get; set; }

        public string name { get; set; }

        public string slug { get; set; }

        public long term_group { get; set; }
    }
}
