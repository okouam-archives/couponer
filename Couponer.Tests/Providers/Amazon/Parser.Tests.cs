using System.Linq;
using Couponer.Tasks.Providers.ShopWindow;
using NUnit.Framework;
using Parser = Couponer.Tasks.Providers.Amazon.Parser;

namespace Couponer.Tests.Providers.Amazon
{
    [TestFixture]
    class ParserTests
    {
        [Test]
        public void When_getting_shops_retrieves_all_the_properties()
        {
            var shops = Parser.GetShops("Fixtures/Amazon.json", MERCHANT.AMAZON).ToList();
            var shop = shops[3];
        }

        [Test]
        public void When_getting_shops_retrieves_all_available_shops()
        {
            var shops = Parser.GetShops("Fixtures/Amazon.json", MERCHANT.AMAZON).ToList();
            Assert.That(shops.Count, Is.EqualTo(5));
        }


        [Test]
        public void When_getting_deals_creates_daily_offers_for_each_option()
        {

        }

        [Test]
        public void When_getting_deals_retrieves_all_the_properties()
        {
            var deals = Parser.GetDeals("Fixtures/Amazon.json", MERCHANT.AMAZON).ToList();
            var deal = deals[10];
            Assert.That(deal.Description, Is.EqualTo("<b>Prices include all fees and charges</b><a href=\"http://bit.ly/1G5JAbh\" target=\"_blank\"> </a><br><p>Brace yourself for one of the biggest artists in the world, as Paul McCartney brings his incredible â€˜Out Thereâ€™ tour to Britain. The legendary Beatle will be performing many of his iconic smash hits from his solo, Wings and Beatles back catalogue, including the likes of â€˜Hey Judeâ€™, â€˜Yesterdayâ€™, â€˜Let It Beâ€™, â€˜Let Me Roll Itâ€™ and â€˜Maybe Iâ€™m Amazedâ€™. This is the first show Paul McCartney has performed in London for three years, bringing home the show thatâ€™s been seen by nearly 2 million people across 12 countries. Whether youâ€™re a fan of the Beatles, Wings or his solo work, make sure you donâ€™t miss this special career-spanning show, and get your tickets for the London O2 concert here. </p><ul><li>Â£51 (face value Â£45, booking fee Â£4.50, facility fee Â£1.50) for one Fourth Price ticket to Paul McCartneyâ€™s â€˜Out Thereâ€™ tour at Londonâ€™s O2 Arena<br></li><li>Â£74.10 (face value Â£66, booking fee Â£6.60, facility fee Â£1.50) for one Third Price ticket to Paul McCartneyâ€™s â€˜Out Thereâ€™ tour at Londonâ€™s O2 Arena</li></ul><ul><li>Â£89.50 (face value Â£80, booking fee Â£8, facility fee Â£1.50) for a Second Price ticket to Paul McCartneyâ€™s â€˜Out Thereâ€™ tour at Londonâ€™s O2 Arena</li></ul><ul><li>Â£139 (face value Â£125, booking fee Â£12.50, facility fee Â£1.50) for a Top Price ticket to Paul McCartneyâ€™s â€˜Out Thereâ€™ tour at Londonâ€™s O2 Arena</li><li>Tickets for are also available for <a target=\"_blank\" href=\"https://local.amazon.co.uk/National-UK/B00WQXO1NG\">Birmingham</a> <br></li></ul><ul><li>Buy Paul McCartney music <a href=\"http://www.amazon.co.uk/Paul-McCartney/e/B000APEVO6/ref=sr_tc_img_2_0?qid=1429629617&amp;sr=8-2-acs \" target=\"_blank\">here</a> <br></li></ul><ul><li>Watch a video for the â€˜Out Thereâ€™ tour <a href=\"http://bit.ly/1G5JAbh\" target=\"_blank\">here</a><br></li></ul>"));
            Assert.That(deal.Price, Is.EqualTo("8950"));
            Assert.That(deal.Title, Is.EqualTo("One Ticket to Paul McCartney at the O2 Arena on Sunday 24th May 2015 - Block 409"));
            Assert.That(deal.Merchant, Is.EqualTo("Marshall Arts"));
            Assert.That(deal.UniqueId, Is.EqualTo("B00WQZ56C4/10"));
            Assert.That(deal.DatabaseIdentifier, Is.EqualTo("AMAZON-B00WQZ56C4/10"));
        }

        [Test]
        public void When_getting_deals_retrieves_all_available_options()
        {
            var deals = Parser.GetDeals("Fixtures/Amazon.json", MERCHANT.AMAZON).ToList();
            Assert.That(deals.Count, Is.EqualTo(32));
        }
    }
}
