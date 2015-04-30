using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace Couponer.Tasks.Data
{
    [Table("wp_options")]
    public class wp_option
    {
        public wp_option()
        {
            autoload = "yes";
        }

        [Key, Column("option_id")]
        public long option_id { get; set; }
        public string option_name { get; set; }
        public string option_value { get; set; }
        public string autoload { get; set; }
    }
}
