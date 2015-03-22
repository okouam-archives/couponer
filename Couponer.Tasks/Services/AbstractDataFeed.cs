using System.IO;
using System.Net.Http;
using ICSharpCode.SharpZipLib.Core;
using ICSharpCode.SharpZipLib.GZip;

namespace Couponer.Tasks.Services
{
    class AbstractDataFeed
    {
        public static string DownloadFeed(string url, HttpClient client)
        {
            var contents = client.GetByteArrayAsync(url).Result;
            var inFile = Path.GetTempFileName();
            File.WriteAllBytes(inFile, contents);
            return inFile;
        }

        public static string ExtractContents(string inFile)
        {
            var outFile = Path.GetTempFileName();

            using (Stream fs = new FileStream(inFile, FileMode.Open, FileAccess.Read))
            {
                using (var gzipStream = new GZipInputStream(fs))
                {
                    using (var fsOut = File.Create(outFile))
                    {
                        var buffer = new byte[4096];
                        StreamUtils.Copy(gzipStream, fsOut, buffer);
                    }
                }
            }
            return outFile;
        }
    }
}
