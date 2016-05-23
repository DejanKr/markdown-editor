/*
SQLyog Ultimate v12.2.1 (64 bit)
MySQL - 5.7.9 : Database - editor
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`editor` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `editor`;

/*Table structure for table `documents` */

DROP TABLE IF EXISTS `documents`;

CREATE TABLE `documents` (
  `DocumentID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `DocumentName` varchar(60) DEFAULT NULL,
  `Alias` varchar(60) DEFAULT NULL,
  `Tags` varchar(40) DEFAULT NULL,
  `Text` text,
  `UserID` int(11) unsigned DEFAULT NULL,
  `LastUpdate` datetime DEFAULT NULL,
  `IsDeleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`DocumentID`),
  UNIQUE KEY `UNIQE_ALIAS` (`Alias`),
  KEY `FK_UserID_UserID` (`UserID`),
  CONSTRAINT `FK_UserID_UserID` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=564 DEFAULT CHARSET=utf8;

/*Data for the table `documents` */

insert  into `documents`(`DocumentID`,`DocumentName`,`Alias`,`Tags`,`Text`,`UserID`,`LastUpdate`,`IsDeleted`) values 
(544,'dfgretg','rthrtghbrfghnbr','nrtnrtnr','                                  dfgrheghrthrthr',NULL,'2016-05-04 02:02:00',1),
(545,'dqfqew','fgrethrt','bhrthbas','                  #13 \n##1123                ',NULL,'2016-05-05 12:33:00',1),
(546,'sfwe','gfvervgbrebt','verbve','                                  rfvedfvewrverbverberber',NULL,'2016-05-05 10:40:00',1),
(547,NULL,NULL,NULL,NULL,NULL,NULL,0),
(548,NULL,NULL,NULL,NULL,NULL,NULL,0),
(549,NULL,NULL,NULL,NULL,NULL,NULL,0),
(550,NULL,NULL,NULL,NULL,NULL,NULL,0),
(551,'a xs','saxas','asx','                                  asx',NULL,'2016-05-05 12:28:00',1),
(552,'aaaaaaa','ssssssssssss','wwwwwwwwwwww','                                  aaaaaaaaaaaaaaaaaaaa',NULL,'2016-05-05 12:36:00',1),
(553,'asdqwef','erbg','ertbe','                                  erberb',NULL,'2016-05-05 12:51:00',1),
(554,'jbsdfubvgerv','orktnboirnbt0','rtbgerbt','                                  rebtrtbrtb',NULL,'2016-05-05 12:08:00',1),
(555,'rvnkeoerver','rtb','scdvserver','                                                                      rfverberberb  ascasc                               ',NULL,'2016-05-05 12:45:00',1),
(556,'rnkevoe','erpvgmerv','ervmer','eprkmfeprgme                                  ',NULL,'2016-05-05 12:55:00',0),
(557,'erverfv','dcvw','dvsfrver','                                  dfberber',NULL,'2016-05-05 12:03:00',0),
(558,'acwecvw','vefbvervbewrbv','defberbe','                                  erbebreb',NULL,'2016-05-05 12:13:00',0),
(559,'qweqs','dwqedfsadvf','wvsd','                                  vsdvewrverv',NULL,'2016-05-05 12:19:00',0),
(560,'ddddddddddd','sssssssssssssss','wwwwwwwwwww','                                                    ssssssssssssss                 ',NULL,'2016-05-06 12:24:00',0),
(561,'asdfqwef','evfewr','ververv','                                  ervgfervervg',NULL,'2016-05-06 12:31:00',1),
(562,'erge','bgrtgb','rthrth','                         rthrth        ',NULL,'2016-05-06 12:05:00',0),
(563,'erge','grege','bretb',NULL,NULL,'2016-05-06 12:04:00',0);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `UserID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Username` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL,
  `LastInsert` datetime DEFAULT NULL,
  `IsDeleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `users` */

insert  into `users`(`UserID`,`Username`,`Password`,`LastInsert`,`IsDeleted`) values 
(2,'Lojze','',NULL,0),
(3,'Boštjan','',NULL,0),
(4,'Miha','',NULL,0),
(5,'Lojze','',NULL,0),
(6,'Boštjan','',NULL,0),
(7,'Miha','',NULL,0),
(8,'Lojze','',NULL,0),
(9,'Boštjan','',NULL,0),
(10,'Miha','',NULL,0),
(11,'Lojze','',NULL,0),
(12,'Jan','',NULL,0),
(13,'Boštjan','',NULL,0),
(14,'Miha','',NULL,0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
