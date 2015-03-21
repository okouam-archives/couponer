namespace Couponer.Tasks
{
    public interface IDataFeed
    {
        string Download(string url);
    }
}