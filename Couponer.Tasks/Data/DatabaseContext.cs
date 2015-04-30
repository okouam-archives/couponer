using System.Data.Entity;

namespace Couponer.Tasks.Data
{
    public class DatabaseContext : DbContext
    {
        public DatabaseContext(string connectionString) : base(nameOrConnectionString: connectionString) { }

        public DbSet<wp_term>  WP_Terms { get; set; }

        public DbSet<wp_option> WP_Options { get; set; }

        public DbSet<wp_post> WP_Posts { get; set; }

        public DbSet<wp_user> WP_Users { get; set; }

        public DbSet<wp_postmeta> WP_PostMeta { get; set; }

        public DbSet<wp_term_relationship> WP_Term_Relationship { get; set; }

        public DbSet<wp_term_taxonomy> WP_Term_Taxonomy { get; set; }
    }
}
