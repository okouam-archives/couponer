using System.Linq;
using Couponer.Tasks.Data;
using Couponer.Tasks.Utility;

namespace Couponer.Tasks.Services
{
    public class UserCreationService
    {
        public static wp_user CreateOrUpdate(string username, string password)
        {
            using (var ctx = new DatabaseContext(Config.DB_CONNECTION_STRING))
            {
                var user = ctx.WP_Users.FirstOrDefault(x => x.user_login == username);

                if (user != null)
                {
                    user.user_pass = password;
                }
                else
                {
                    user = new wp_user
                    {
                        user_login = username,
                        user_pass = password
                    };

                    ctx.WP_Users.Add(user);
                }

                ctx.SaveChanges();

                return user;
            }
        }
    }
}
