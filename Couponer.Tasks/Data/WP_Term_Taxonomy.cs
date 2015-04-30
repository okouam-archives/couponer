using System;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace Couponer.Tasks.Data
{
    [Table("wp_term_taxonomy")]
    public class wp_term_taxonomy
    {
        public wp_term_taxonomy()
        {
            description = String.Empty;
        }

        [Key]
        public long term_taxonomy_id { get; set; }

        public string description { get; set; }

        public long term_id { get; set; }

        public long parent { get; set; }

        public string taxonomy { get; set; }

        public long count { get; set; }
    }
}
