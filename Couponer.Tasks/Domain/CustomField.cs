using Newtonsoft.Json;

namespace WordPressSharp.Models
{
    public class CustomField
    {
        [JsonIgnore]
        public string Id { get; set; }

        [JsonProperty("key")]
        public string Key { get; set; }

        [JsonProperty("value")]
        public string Value { get; set; }
    }
}
