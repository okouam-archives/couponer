using System;
using System.Net.Http;
using System.Net.Http.Headers;
using System.Text;
using Couponer.Tasks.Utility;
using Newtonsoft.Json;
using WordPressSharp.Models;

namespace Couponer.Tasks
{
    public static class WordpressApi
    {
        /* Public Methods. */

        public static void CreatePost(Post post)
        {
            var client = new HttpClient();
            var byteArray = Encoding.ASCII.GetBytes(Config.WP_USERNAME + ":" + Config.WP_PASSWORD);
            client.DefaultRequestHeaders.Authorization = new AuthenticationHeaderValue("Basic", Convert.ToBase64String(byteArray));
            var response = client.PostAsync(Config.WP_HOST + "?json_route=/posts", new StringContent(JsonConvert.SerializeObject(post))).Result;
        }
    }
}
