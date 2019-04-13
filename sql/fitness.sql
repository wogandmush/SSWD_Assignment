-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: s2995020
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.16.04.2-log

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `email` varchar(60) NOT NULL DEFAULT '',
  `password` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES ('dan@pff.ie','$2y$10$HiKf323BrEBpnkjCTEwlveJZmA7Np/Kc1SSWkvFEmPN3feoIa3nNW'),('dan@swole.ie','$2y$10$pMiGMMGVcblQsMP2Ty61ZeuC2hMOX42Jus35lseQp6LxHFY89BqFC'),('martin@pff.ie','$2y$10$0bikTnLB0WDIdRNJp6/q7ekE5R1FskJ9cA2MUX1x2wDYwh348lVwS'),('martin@swole.ie','$2y$10$QN9iC/oWbH/0K0FB15uoae4SgEHmCW9.WpUl4KzOH3owvIb5K23PC'),('oisin@pff.ie','$2y$10$vx2hITXI8vNhpG8Atn.OseYap3veSfJe3CYpiSTQaDwQyLDcQxs.u'),('oisin@swole.ie','$2y$10$nT4rrTBrD8mbwLh0Ohxcvesayb/AWzh6zCNAXN1wfbB2EKZIWPUjW');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `benefit`
--

DROP TABLE IF EXISTS `benefit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `benefit` (
  `benefit` varchar(120) NOT NULL,
  PRIMARY KEY (`benefit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `benefit`
--

LOCK TABLES `benefit` WRITE;
/*!40000 ALTER TABLE `benefit` DISABLE KEYS */;
/*!40000 ALTER TABLE `benefit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class`
--

DROP TABLE IF EXISTS `class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class` (
  `class_title` varchar(30) NOT NULL DEFAULT '',
  `summary` varchar(200) DEFAULT NULL,
  `photo_url` varchar(999) DEFAULT NULL,
  PRIMARY KEY (`class_title`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class`
--

LOCK TABLES `class` WRITE;
/*!40000 ALTER TABLE `class` DISABLE KEYS */;
INSERT INTO `class` VALUES ('Cardio','Can\'t stop won\'t stop!','images/cardio.jpg'),('Strength','Unlimited power!!!','images/strength.jpg'),('Yoga','Yoga fire','images/yoga.jpg');
/*!40000 ALTER TABLE `class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `message` varchar(999) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feature`
--

DROP TABLE IF EXISTS `feature`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feature` (
  `feature_title` varchar(30) NOT NULL,
  `details` varchar(999) NOT NULL,
  `photo_url` varchar(999) DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feature`
--

LOCK TABLES `feature` WRITE;
/*!40000 ALTER TABLE `feature` DISABLE KEYS */;
/*!40000 ALTER TABLE `feature` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fees`
--

DROP TABLE IF EXISTS `fees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fees` (
  `membership_type` varchar(60) NOT NULL,
  `cost` varchar(30) NOT NULL,
  PRIMARY KEY (`membership_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fees`
--

LOCK TABLES `fees` WRITE;
/*!40000 ALTER TABLE `fees` DISABLE KEYS */;
INSERT INTO `fees` VALUES ('Adult Monthly','39.00'),('Adult Yearly','379.00'),('Student Monthly','29.00');
/*!40000 ALTER TABLE `fees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fees_benefit`
--

DROP TABLE IF EXISTS `fees_benefit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fees_benefit` (
  `membership_type` varchar(60) NOT NULL DEFAULT '',
  `benefit` varchar(120) NOT NULL DEFAULT '',
  PRIMARY KEY (`membership_type`,`benefit`),
  KEY `benefit` (`benefit`),
  CONSTRAINT `fees_benefit_ibfk_1` FOREIGN KEY (`membership_type`) REFERENCES `fees` (`membership_type`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fees_benefit_ibfk_2` FOREIGN KEY (`benefit`) REFERENCES `benefit` (`benefit`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fees_benefit`
--

LOCK TABLES `fees_benefit` WRITE;
/*!40000 ALTER TABLE `fees_benefit` DISABLE KEYS */;
/*!40000 ALTER TABLE `fees_benefit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member` (
  `user_no` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(20) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `home_tel` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `membership` varchar(60) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`user_no`),
  KEY `membership` (`membership`),
  CONSTRAINT `member_ibfk_1` FOREIGN KEY (`membership`) REFERENCES `fees` (`membership_type`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8003 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` VALUES (4,'Student','Monthly','0000-00-00','female','','','sm@swole.ie','','Student Monthly','password'),(5,'Adult','Monthly','0000-00-00','female','','','am@swole.ie','','Adult Monthly','password'),(6,'Adult','Yearly','0000-00-00','female','','','ay@swole.ie','','Adult Yearly','password');
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_class`
--

DROP TABLE IF EXISTS `member_class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `member_class` (
  `user_no` int(11) DEFAULT NULL,
  `class_title` varchar(30) DEFAULT NULL,
  KEY `user_no` (`user_no`),
  KEY `class_title` (`class_title`),
  CONSTRAINT `member_class_ibfk_1` FOREIGN KEY (`user_no`) REFERENCES `member` (`user_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `member_class_ibfk_2` FOREIGN KEY (`class_title`) REFERENCES `class` (`class_title`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_class`
--

LOCK TABLES `member_class` WRITE;
/*!40000 ALTER TABLE `member_class` DISABLE KEYS */;
/*!40000 ALTER TABLE `member_class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonial`
--

DROP TABLE IF EXISTS `testimonial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testimonial` (
  `first_name` varchar(30) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `class_title` varchar(30) DEFAULT NULL,
  `message` varchar(400) DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`first_name`,`date`),
  KEY `class_title` (`class_title`),
  CONSTRAINT `testimonial_ibfk_1` FOREIGN KEY (`class_title`) REFERENCES `class` (`class_title`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonial`
--

LOCK TABLES `testimonial` WRITE;
/*!40000 ALTER TABLE `testimonial` DISABLE KEYS */;
INSERT INTO `testimonial` VALUES ('Dan','2019-04-13 08:50:58','Yoga','A whole new me!',1);
/*!40000 ALTER TABLE `testimonial` ENABLE KEYS */;
UNLOCK TABLES;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-13 18:50:09
