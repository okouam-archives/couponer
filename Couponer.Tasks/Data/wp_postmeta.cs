using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace Couponer.Tasks.Data
{
    [Table("wp_postmeta")]
    public class wp_postmeta
    {
        [Key, Column("meta_id")]
        public long meta_id { get; set; }

        public long post_id { get; set; }

        public string meta_key { get; set; }

        public string meta_value { get; set; }
    }
}
