using Newtonsoft.Json;

namespace WordPressSharp.Models
{
    public class Post
    {
        [JsonProperty("name")]
        public string Name { get; set; }

        [JsonProperty("title")]
        public string Title { get; set; }

        [JsonProperty("status")]
        public string Status { get; set; }

        [JsonProperty("content_raw")]
        public string Content { get; set; }

        [JsonProperty("x-categories")]
        public string[] Terms { get; set; }

        [JsonProperty("post_meta")]
        public CustomField[] CustomFields { get; set; }
    }
}
