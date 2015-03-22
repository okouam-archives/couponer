namespace Couponer.Tasks.Services
{
    class AbstractParser
    {
        public static string CreateName(string source, string uniqueId)
        {
            return source + "-" + uniqueId;
        }

        public static string NormalizeProduct(string product)
        {
            return product.Replace("&", "and");
        }
    }
}
