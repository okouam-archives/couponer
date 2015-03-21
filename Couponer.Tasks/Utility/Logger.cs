using log4net;

namespace Couponer.Tasks.Utility
{
    public abstract class Logger
    {
        protected static readonly ILog log = LogManager.GetLogger(typeof(Logger));
    }
}
