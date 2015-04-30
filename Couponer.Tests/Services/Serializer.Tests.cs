using System.Collections;
using Couponer.Tasks.Services;
using NUnit.Framework;

namespace Couponer.Tests.Services
{
    [TestFixture]
    class SerializerTests
    {
        [Test]
        public void fuckThis()
        {
            var serializer = new Serializer();
            var result = serializer.Deserialize("a:2:{i:776;a:2:{i:0;i:778;i:1;i:780;}i:777;a:1:{i:0;i:779;}}");  
            Assert.That(result, Is.InstanceOf<Hashtable>());

            var table = (Hashtable) result;
            Assert.That(table.ContainsKey(776), Is.True);
            Assert.That(table[776], Is.InstanceOf<ArrayList>());
        }
    }
}
