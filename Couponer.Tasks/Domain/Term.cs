namespace WordPressSharp.Models
{
    public class Term
    {
        public ulong Id { get; set; }

        public string Name { get; set; }

        public string Slug { get; set; }

        public ulong Parent { get; set; }
    }
}
