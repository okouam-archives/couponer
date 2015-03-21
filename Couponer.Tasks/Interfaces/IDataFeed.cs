using Couponer.Tasks.Providers.ShopWindow;

namespace Couponer.Tasks
{
    public interface IDataFeed
    {
        string Download(MERCHANTS url);
    }
}