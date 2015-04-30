namespace WordPressSharp.Models
{
    public class Term
    {
        public long Id { get; set; }

        public string Name { get; set; }

        public string Slug { get; set; }

        public long Parent { get; set; }
    }
}
