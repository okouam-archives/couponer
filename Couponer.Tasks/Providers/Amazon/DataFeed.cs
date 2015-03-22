using System;
using System.Net;
using System.Net.Http;
using Couponer.Tasks.Providers.ShopWindow;
using Couponer.Tasks.Services;
using Couponer.Tasks.Utility;

namespace Couponer.Tasks.Providers.Amazon
{
    public class DataFeed : Logger
    {
        public static string Download(MERCHANT merchant)
        {
            var credCache = new CredentialCache
            {
                {
                    new Uri(DIGEST_URI), "Digest",
                    new NetworkCredential(Config.AMAZON_USERNAME, Config.AMAZON_PASSWORD)
                }
            };

            var client = new HttpClient(new HttpClientHandler { Credentials = credCache });
            var inFile = AbstractDataFeed.DownloadFeed(URL, client);
            return AbstractDataFeed.ExtractContents(inFile);
        }

        private const string DIGEST_URI = "https://assoc-datafeeds-eu.amazon.com/";
        private const string URL = "https://assoc-datafeeds-eu.amazon.com/datafeed/getFeed?filename=GB_localdeals.json.gz";
    }
}
