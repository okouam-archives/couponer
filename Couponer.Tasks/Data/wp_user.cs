using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace Couponer.Tasks.Data
{
    [Table("wp_users")]
    public class wp_user
    {
        [Key, Column("ID")]
        public long ID { get; set; }

        public string user_login { get; set; }

        public string user_pass { get; set; }

        public string user_nicename { get; set; }

        public string user_email { get; set; }

        public string user_url { get; set; }

        public string user_registered { get; set; }

        public string user_activation_key { get; set; }

        public int user_status { get; set; }

        public string display_name { get; set; }
    }
}

//CREATE TABLE `wp_users` (
//  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
//  `user_login` varchar(60) NOT NULL DEFAULT '',
//  `user_pass` varchar(64) NOT NULL DEFAULT '',
//  `user_nicename` varchar(50) NOT NULL DEFAULT '',
//  `user_email` varchar(100) NOT NULL DEFAULT '',
//  `user_url` varchar(100) NOT NULL DEFAULT '',
//  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
//  `user_activation_key` varchar(60) NOT NULL DEFAULT '',
//  `user_status` int(11) NOT NULL DEFAULT '0',
//  `display_name` varchar(250) NOT NULL DEFAULT '',
//  PRIMARY KEY (`ID`),
//  KEY `user_login_key` (`user_login`),
//  KEY `user_nicename` (`user_nicename`)
//) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8