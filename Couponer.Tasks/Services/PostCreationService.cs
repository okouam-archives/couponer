using System;
using System.Collections.Generic;
using System.Linq;
using System.Net.Mail;
using System.Security.Cryptography;
using Couponer.Tasks.Data;
using Couponer.Tasks.Services;
using Couponer.Tasks.Utility;
using Dapper;
using MySql.Data.MySqlClient;
using WordPressSharp.Models;
using Metadata = System.Collections.Generic.Dictionary<string, System.Collections.Generic.KeyValuePair<string, string>>;

namespace Couponer.Tasks.Domain
{
    public class PostCreationService : Logger
    {
        /* Public Methods. */

        public static void Clear()
        {
            using (var ctx = new DatabaseContext(Config.DB_CONNECTION_STRING))
            {
                ctx.Database.ExecuteSqlCommand("TRUNCATE TABLE wp_postmeta");
                ctx.Database.ExecuteSqlCommand("TRUNCATE TABLE wp_posts");
                ctx.SaveChanges();
            }
        }

        public static void CreatePostTaxonomy(long id, IEnumerable<wp_term_relationship> relationships)
        {
            if (relationships == null || !relationships.Any()) return;

            using (var ctx = new DatabaseContext(Config.DB_CONNECTION_STRING))
            {
                foreach (var relationship in relationships)
                {
                    relationship.object_id = id;
                    ctx.WP_Term_Relationship.Add(relationship);
                }

                ctx.SaveChanges();
            }
        }

        public static void CreatePostMetadata(long id, IEnumerable<wp_postmeta> customFields)
        {
            if (customFields == null || !customFields.Any()) return;

            using (var ctx = new DatabaseContext(Config.DB_CONNECTION_STRING))
            {
                foreach (var customField in customFields.Where(x => x != null))
                {
                    customField.post_id = id;
                    ctx.WP_PostMeta.Add(customField);
                }

                ctx.SaveChanges();
            }
        }

        public static long CreatePost(wp_user user, string title, string dbid, string description, string type)
        {
            using (var ctx = new DatabaseContext(Config.DB_CONNECTION_STRING))
            {
                var post = new wp_post
                {
                    post_title = title,
                    post_type = type,
                    post_name = dbid,
                    post_status = "publish",
                    post_content = description,
                    post_excerpt = String.Empty,
                    to_ping = String.Empty,
                    pinged = String.Empty,
                    post_content_filtered = String.Empty,
                    comment_status = "open",
                    ping_status = "open",
                    post_password = String.Empty,
                    post_parent = 0,
                    guid = String.Empty,
                    menu_order = 0,
                    post_mime_type = String.Empty,
                    comment_count = 0,
                    post_author = user.ID,
                    post_date = DateTime.Now,
                    post_date_gmt = DateTime.Now,
                    post_modified = DateTime.Now,
                    post_modified_gmt = DateTime.Now
                };

                ctx.WP_Posts.Add(post);

                ctx.SaveChanges();

                return post.ID;

            }
        }

        /* Private. */



        public static bool Contains(string identifier)
        {
            var connection = new MySqlConnection(Config.DB_CONNECTION_STRING);
            const string sql = "SELECT COUNT(*) FROM wp_postmeta WHERE meta_key = 'dbid' AND meta_value = '{0}'";

            var count = connection.Query<int>(String.Format(sql, identifier)).First();

            if (count > 1)
            {
                throw new Exception(String.Format("Duplicate entry for identifier <{0}>.", identifier));
            }

            return count == 1;
        }
    }
}
