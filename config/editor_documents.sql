CREATE DATABASE  IF NOT EXISTS `editor` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `editor`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win32 (AMD64)
--
-- Host: localhost    Database: editor
-- ------------------------------------------------------
-- Server version	5.7.11

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
INSERT INTO `documents` VALUES (1,'abc','ascqw','cwe','                   asdsadasdwq               ',NULL,'2016-05-11 09:26:00',0),(2,'asdqw','ebebe','rberberber',NULL,NULL,'2016-05-11 09:01:00',1),(3,'sdfsdv','svwev','wvewvew',NULL,NULL,'2016-05-11 09:54:00',0),(4,'asdq','wdqw','dqwdqw',NULL,NULL,'2016-05-11 09:38:00',0),(5,'svwev','wevwev','wevwe',NULL,NULL,'2016-05-11 09:21:00',0),(6,'asdqwdq','wdqwdq','wdqwdq',NULL,NULL,'2016-05-13 12:29:00',0),(7,'asdqw','dqwdqwdqwdq','qwdqwd',NULL,NULL,'2016-05-13 04:42:00',0),(8,'eveg','vrever','erver',NULL,NULL,'2016-05-13 04:11:00',0),(9,'scq','cqcqcw','qcqccw',NULL,NULL,'2016-05-13 04:09:00',0),(10,'qwdqw','qwdqw','dqwd',NULL,NULL,'2016-05-13 04:14:00',0),(11,'asdqw','dqwdqw','dqwd',NULL,NULL,'2016-05-13 05:26:00',0),(12,'qwdqwd','wefwef','wefwefwef',NULL,NULL,'2016-05-13 05:32:00',0),(13,'qwdqw','dqwdq','wdqwd',NULL,NULL,'2016-05-13 05:25:00',0),(14,'qwq','dqd','ssa',NULL,NULL,'2016-05-13 05:43:00',0),(15,NULL,NULL,NULL,NULL,NULL,NULL,0),(16,NULL,NULL,NULL,NULL,NULL,NULL,0),(17,'qwdqwd','qwdqwd','qwdqwdqdqwqd',NULL,NULL,'2016-05-14 09:01:00',0),(18,'dqawdq','fqwfqwqwf','wq',NULL,NULL,'2016-05-14 09:56:00',0),(19,'qweqwe','asdasd','asdqwdqw',NULL,NULL,'2016-05-14 09:56:00',0),(20,'qwdqw','wdqwd','qwdqwd',NULL,NULL,'2016-05-14 09:27:00',0),(21,NULL,NULL,NULL,NULL,NULL,NULL,0),(22,'aa','ss','sss',NULL,NULL,'2016-05-14 09:27:00',0),(23,'qq','ww','eee',NULL,NULL,'2016-05-14 09:38:00',0),(24,NULL,NULL,NULL,NULL,NULL,NULL,0),(25,'ascq','cqwc','qwcqwc',NULL,NULL,'2016-05-14 09:02:00',0),(26,'qwqw','dqwdqwdqwd','qwdq','                                                 acsas a qw qwcq          <yxAXa<yyx          #A',NULL,'2016-05-14 11:58:00',0),(27,NULL,NULL,NULL,NULL,NULL,NULL,0),(28,NULL,NULL,NULL,NULL,NULL,NULL,0),(29,'scq','wcqwwq','eqwdqwd',NULL,NULL,'2016-05-14 10:25:00',0),(30,'asdqw','acas','cascqwc',NULL,NULL,'2016-05-14 11:47:00',0),(31,'qwd','asdqwd','qwdqwdqwd',NULL,NULL,'2016-05-14 11:02:00',0),(32,'asda','asdwq','dqwd',NULL,NULL,'2016-05-14 11:23:00',0),(33,'asdqw','dqwd','qwdqwd',NULL,NULL,'2016-05-14 11:43:00',0),(34,NULL,NULL,NULL,NULL,NULL,NULL,0),(35,'asc','qcqwcqw','cqwcqwcq',NULL,NULL,'2016-05-14 11:28:00',0),(36,'dejan ','Â¸je ','tii',NULL,NULL,'2016-05-14 11:56:00',0),(37,'sadas','dsada','sdasdas',NULL,NULL,'2016-05-14 11:13:00',0),(38,NULL,NULL,NULL,NULL,NULL,NULL,0),(39,NULL,NULL,NULL,NULL,NULL,NULL,0),(40,'qwdw','efwefw','efewf',NULL,NULL,'2016-05-14 11:13:00',0),(41,'ergerg','rzrt','trhr',NULL,NULL,'2016-05-14 11:13:00',0),(42,NULL,NULL,NULL,NULL,NULL,NULL,0),(43,'asc','qwqweq','sqcqw',NULL,NULL,'2016-05-14 01:16:00',0),(44,'asdasas','dasdasdas','dasdqsqdsdqwd','                                  qwdqwdqwd',NULL,'2016-05-14 01:40:00',0),(45,NULL,NULL,NULL,'                                  v',NULL,'2016-05-14 01:12:00',0),(46,'wdqwd','qwq','asd',NULL,NULL,'2016-05-14 01:04:00',0),(47,NULL,NULL,NULL,NULL,NULL,NULL,0),(48,NULL,NULL,NULL,NULL,NULL,NULL,0),(49,NULL,NULL,NULL,NULL,NULL,NULL,0),(50,'qef','qefq','efqw',NULL,NULL,'2016-05-14 01:42:00',0),(51,NULL,NULL,NULL,NULL,NULL,NULL,0),(52,NULL,NULL,NULL,NULL,NULL,NULL,0),(53,'avq','vqwv','qwvqwv',NULL,NULL,'2016-05-14 01:21:00',0),(54,'qwdqw','dqwf','wgvewrver',NULL,NULL,'2016-05-14 01:21:00',0),(55,'asd','qwdqd','wqdqwdw',NULL,NULL,'2016-05-14 01:34:00',0),(56,'asda','sdqw','qwqw',NULL,NULL,'2016-05-14 01:50:00',0),(57,'vwev','wevw','evqev',NULL,NULL,'2016-05-14 05:51:00',0),(58,'asdq','wdq','wdqwd',NULL,NULL,'2016-05-14 05:11:00',0),(59,NULL,NULL,NULL,NULL,NULL,NULL,0),(60,'ssss','sssss','ssss',NULL,NULL,'2016-05-14 05:12:00',0),(61,'qweqwe','qwasdas','dasdasdqwd',NULL,NULL,'2016-05-14 05:09:00',0),(62,'ssss','ddd','www',NULL,NULL,'2016-05-14 05:39:00',0),(63,NULL,NULL,NULL,NULL,NULL,NULL,0),(64,NULL,NULL,NULL,NULL,NULL,NULL,0),(65,'asd','ccc','sss',NULL,NULL,'2016-05-14 06:42:00',0),(66,NULL,NULL,NULL,NULL,NULL,NULL,0),(67,'qwd','sdadqwd','asdqwdqw',NULL,NULL,'2016-05-14 06:54:00',0),(68,'ycs','cascqwc','qwcqw',NULL,NULL,'2016-05-14 06:59:00',0),(69,'qdwasd','asdwdw','dsdwd',NULL,NULL,'2016-05-14 06:30:00',0),(70,'acwq','dasdqwdqwqsd','sdwdw',NULL,NULL,'2016-05-14 06:40:00',0),(71,'asc','qwea','sdddddd',NULL,NULL,'2016-05-14 06:14:00',0),(72,'asdwqd','sdw','dwaxx',NULL,NULL,'2016-05-14 06:16:00',0),(73,'ascas','asd','qwdqwdqwd',NULL,NULL,'2016-05-14 06:47:00',0),(74,NULL,NULL,NULL,NULL,NULL,NULL,0),(75,NULL,NULL,NULL,NULL,NULL,NULL,0),(76,'asdas','dqwq','qwdqwdqwd',NULL,NULL,'2016-05-14 06:39:00',0),(77,NULL,NULL,NULL,NULL,NULL,NULL,0),(78,'ac','ascwq','cqwc',NULL,NULL,'2016-05-14 07:55:00',0),(79,'qwd','qwd','qwdqwdq',NULL,NULL,'2016-05-14 07:38:00',0),(80,'ac','asc','qwcqw',NULL,NULL,'2016-05-14 07:12:00',0),(81,'asdqwd','asca','scas',NULL,NULL,'2016-05-14 07:39:00',0),(82,'asc','qwc','dqwdqwd',NULL,NULL,'2016-05-14 08:09:00',0),(83,'ascqw','qevev','wevwev',NULL,NULL,'2016-05-15 08:09:00',1),(84,'dejan','deja','aaaassssssssss',NULL,NULL,'2016-05-15 08:26:00',0),(85,NULL,NULL,NULL,NULL,NULL,NULL,0),(86,'aaaa','dejan','mcd',NULL,NULL,'2016-05-15 08:49:00',0),(87,NULL,NULL,NULL,NULL,NULL,NULL,0),(88,NULL,NULL,NULL,NULL,NULL,NULL,0),(89,NULL,NULL,NULL,NULL,NULL,NULL,0),(90,NULL,NULL,NULL,NULL,NULL,NULL,0),(91,'marko','novak','nekaj',NULL,NULL,'2016-05-15 08:25:00',0),(92,'mne','axaxxxxxx','qweqeq',NULL,NULL,'2016-05-15 08:59:00',0),(93,'mne','eere','scsdc',NULL,NULL,'2016-05-15 08:00:00',0),(94,NULL,NULL,NULL,NULL,NULL,NULL,0),(95,'eeeeeeeeeeeeeee','eeeeeeeeeeeeeeee','eeeeqqqqqqqq',NULL,NULL,'2016-05-15 08:50:00',0),(96,'asdqw','aaaa','everver',NULL,NULL,'2016-05-15 09:53:00',0),(97,'aaaa','sssssssssssss','bbbbbbbbbbb',NULL,NULL,'2016-05-15 09:02:00',0),(98,'casc','qwcq','wcqwc',NULL,NULL,'2016-05-15 06:14:00',0),(99,'jwdws','erger','wrgwergew',NULL,NULL,'2016-05-15 07:06:00',0),(100,NULL,NULL,NULL,'                                  wqdqwdqw',NULL,'2016-05-17 08:30:00',0);
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-23 10:16:48
