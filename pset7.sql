-- MySQL dump 10.13  Distrib 5.5.28, for Linux (i686)
--
-- Host: localhost    Database: pset7
-- ------------------------------------------------------
-- Server version	5.5.28

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
-- Table structure for table `history`
--

DROP TABLE IF EXISTS `history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `history` (
  `id` int(10) unsigned NOT NULL,
  `symbol` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `shares` int(10) unsigned NOT NULL,
  `price` decimal(10,4) unsigned NOT NULL,
  `sellorbuy` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `timedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `history`
--

LOCK TABLES `history` WRITE;
/*!40000 ALTER TABLE `history` DISABLE KEYS */;
INSERT INTO `history` VALUES (18,'AAPL',100,400.0000,'BUY','2013-03-12 00:54:15'),(18,'GOOG',25,830.0000,'BUY','2013-03-12 00:55:35'),(18,'IBM',20,210.0000,'BUY','2013-03-12 00:57:08'),(18,'MSFT',100,28.0000,'BUY','2013-03-12 00:57:54'),(18,'ORCL',50,35.0000,'BUY','2013-03-12 00:58:25'),(18,'AAPL',20,437.8700,'BUY','2013-03-12 02:42:30'),(18,'IBM',3,210.0800,'BUY','2013-03-12 02:44:56'),(18,'AAPL',120,437.8700,'SELL','2013-03-12 03:20:28'),(18,'ORCL',50,35.8800,'SELL','2013-03-12 04:35:28'),(18,'GOOG',50,834.8200,'BUY','2013-03-12 06:25:18'),(18,'MSFT',100,27.8700,'SELL','2013-03-12 06:55:44'),(18,'MSFT',100,27.8700,'BUY','2013-03-12 06:55:59'),(18,'AAPL',20,437.8700,'BUY','2013-03-12 12:54:27'),(18,'AAPL',2,437.8700,'BUY','2013-03-12 13:07:32'),(18,'AAPL',2,437.8700,'SELL','2013-03-12 13:13:15'),(18,'MSFT',10,27.8700,'SELL','2013-03-12 13:26:20');
/*!40000 ALTER TABLE `history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portfolio`
--

DROP TABLE IF EXISTS `portfolio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `portfolio` (
  `id` int(10) unsigned NOT NULL,
  `symbol` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `shares` int(10) unsigned NOT NULL,
  `price` decimal(10,4) unsigned NOT NULL,
  PRIMARY KEY (`id`,`symbol`),
  KEY `id` (`id`,`symbol`),
  KEY `id_2` (`id`,`symbol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolio`
--

LOCK TABLES `portfolio` WRITE;
/*!40000 ALTER TABLE `portfolio` DISABLE KEYS */;
INSERT INTO `portfolio` VALUES (18,'AAPL',20,400.0000),(18,'GOOG',75,830.0000),(18,'IBM',23,210.0000),(18,'MSFT',90,28.0000),(18,'ORCL',0,35.0000);
/*!40000 ALTER TABLE `portfolio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cash` decimal(65,4) unsigned NOT NULL DEFAULT '0.0000',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `id` (`id`,`username`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'caesar','$1$V/zMd1x6$TUtvu0kiIXADaQnyhycnc.',10000.0000),(2,'cs50','$1$V/zMd1x6$TUtvu0kiIXADaQnyhycnc.',0.0000),(3,'jharvard','$1$V/zMd1x6$TUtvu0kiIXADaQnyhycnc.',10000.0000),(4,'malan','$1$V/zMd1x6$TUtvu0kiIXADaQnyhycnc.',0.0000),(5,'nate','$1$V/zMd1x6$TUtvu0kiIXADaQnyhycnc.',0.0000),(6,'rbowden','$1$V/zMd1x6$TUtvu0kiIXADaQnyhycnc.',0.0000),(7,'skroob','$1$V/zMd1x6$TUtvu0kiIXADaQnyhycnc.',10000.0000),(8,'tmacwilliam','$1$V/zMd1x6$TUtvu0kiIXADaQnyhycnc.',0.0000),(9,'zamyla','$1$V/zMd1x6$TUtvu0kiIXADaQnyhycnc.',0.0000),(10,'zanti','$1$V/zMd1x6$TUtvu0kiIXADaQnyhycnc.',10000.0000),(11,'test','$1$V/zMd1x6$TUtvu0kiIXADaQnyhycnc.',10000.0000),(12,'test2','$1$V/zMd1x6$TUtvu0kiIXADaQnyhycnc.',10000.0000),(13,'test3','$1$V/zMd1x6$TUtvu0kiIXADaQnyhycnc.',10000.0000),(14,'test4','$1$V/zMd1x6$TUtvu0kiIXADaQnyhycnc.',10000.0000),(15,'test5','$1$V/zMd1x6$TUtvu0kiIXADaQnyhycnc.',10000.0000),(16,'test6','$1$V/zMd1x6$TUtvu0kiIXADaQnyhycnc.',10000.0000),(17,'test7','$1$V/zMd1x6$TUtvu0kiIXADaQnyhycnc.',10000.0000),(18,'test8','$1$V/zMd1x6$TUtvu0kiIXADaQnyhycnc.',4731.0600);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-03-12  9:50:08
