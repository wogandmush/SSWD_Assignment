-- MySQL dump 10.13  Distrib 5.6.33, for debian-linux-gnu (x86_64)
--
-- Host: 0.0.0.0    Database: fitness
-- ------------------------------------------------------
-- Server version	5.6.33-0ubuntu0.14.04.1

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
INSERT INTO `benefit` VALUES ('7 day money back guarantee'),('Coaches who care'),('Free parking'),('Open 7 days per week');
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
  `name` varchar(80) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `mobile` varchar(20) NOT NULL,
  `message` varchar(999) DEFAULT NULL,
  `hashkey` varchar(100) NOT NULL DEFAULT '',
  `subject` varchar(100) DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`hashkey`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES ('Dan','quinnd6@tcd.ie','23456789','Need to have a second testimonial for ','2805828b53f48a1d00e259722ac46121','Placeholder','2019-05-10 09:25:13'),('oisin','oisinmacsweeney@hotmail.com','0852725567','I just wanted to tell you that I love this gym and the website is so sexy and who ever was behind making it are very smart and handsome and intelligent individuals ','a08a3797d067ed1f58cce0ab4823159a','Well done','2019-05-09 18:57:21');
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feature`
--

DROP TABLE IF EXISTS `feature`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feature_title` varchar(100) NOT NULL,
  `detail` varchar(999) DEFAULT NULL,
  `img_url` varchar(999) DEFAULT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `link` varchar(999) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feature`
--

LOCK TABLES `feature` WRITE;
/*!40000 ALTER TABLE `feature` DISABLE KEYS */;
INSERT INTO `feature` VALUES (8,'Special Offer To New Members','6-Day Introductory Personal Training Plan\r\nGet the results you want  with our FREE 6-Day Personal Training Plan. The plan includes\r\n\r\nFree personal training assessment and goal setting, \r\ncustomized fitness plans\r\nregular gym instruction\r\nand all the help and guidance you need to keep you on track.','https://sswd-assignment-wogandmush.c9users.io/SSWD_Assignment/images/pilates/Cardio1.jpg','2019-04-23 11:14:46','https://youtube.com'),(9,'Personal Toning Plan','At PerfectForm Fitness  you don’t have to be a fitness expert to get a toned, slim, strong body.\r\n\r\nIf you want to get toned, our personal trainers help you every step of the way.\r\n\r\nWhen you start, you get a personalised body-toning programme to target the areas you want. You get full instruction on how to use all toning equipment. You get a few sessions of free personal training. And you get your programme changed as often you like. Everything you need to start getting results as quickly as possible.','https://sswd-assignment-wogandmush.c9users.io/SSWD_Assignment/images/yoga/yogacard.jpg','2019-04-23 11:26:25',NULL),(10,'Build Strength and Power','Is strength and conditioning your number one goal? Are you looking to build stronger chest, shoulders, and arms?\r\n\r\nDo you want stronger, more powerful leg muscles?\r\n\r\nDo you need to increase strength for your chosen sport? To run faster, to lift heavier, to drive further, to punch harder. Or do you want to compete in powerlifting, weightlifting, or cross-fit?\r\n\r\nOr maybe you just want to have the strength to do every day tasks.','https://sswd-assignment-wogandmush.c9users.io/SSWD_Assignment/images/strength/strength1.jpg','2019-04-24 02:55:45','https://sswd-assignment-wogandmush.c9users.io/SSWD_Assignment/strengthclass.php'),(11,'Own Your Potential','At PerfectForm Fitness, we believe there is strength in numbers (of participants, that is!). If you are ready to make your health, fitness and performance goals a reality, join our awesome community of members and coaches and begin your journey today. We believe strongly that everyone has an inner athlete and we would like to introduce you to yours!','https://sswd-assignment-wogandmush.c9users.io/SSWD_Assignment/images/strength/strength2.jpg','2019-04-24 03:11:01',NULL),(12,'Yoga Special Offer','PerfectForm Fitness , Rathmines is delighted to continue offer a summer special during the month of August . 10 euro off a 10 class pass ( now 100 euro ) and 5 euro off a 5 class pass ( now 60 euro ).These passes can be used at any of our 10 regularly scheduled classes which include Hot Yoga , Yoga Flow , Hatha Yoga , Vinyasa Yoga & Ashtanga Yoga .\r\nWe have classes every day including Saturday and Sunday Mornings.','https://sswd-assignment-wogandmush.c9users.io/SSWD_Assignment/images/yoga/what%20happen.jpg','2019-04-24 03:21:41','https://sswd-assignment-wogandmush.c9users.io/SSWD_Assignment/yogaclass.php');
/*!40000 ALTER TABLE `feature` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `featured`
--

DROP TABLE IF EXISTS `featured`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `featured` (
  `feature_id` int(11) DEFAULT NULL,
  `feature_number` enum('1','2','3') NOT NULL DEFAULT '1',
  PRIMARY KEY (`feature_number`),
  KEY `feature_id` (`feature_id`),
  CONSTRAINT `featured_ibfk_1` FOREIGN KEY (`feature_id`) REFERENCES `feature` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `featured`
--

LOCK TABLES `featured` WRITE;
/*!40000 ALTER TABLE `featured` DISABLE KEYS */;
INSERT INTO `featured` VALUES (8,'1'),(10,'2');
/*!40000 ALTER TABLE `featured` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fees`
--

DROP TABLE IF EXISTS `fees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fees` (
  `membership_type` varchar(60) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `period` varchar(30) NOT NULL,
  PRIMARY KEY (`membership_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fees`
--

LOCK TABLES `fees` WRITE;
/*!40000 ALTER TABLE `fees` DISABLE KEYS */;
INSERT INTO `fees` VALUES ('Adult Monthly',25.00,'month'),('Adult Yearly',245.45,'year'),('Student Monthly',31.00,'month'),('Student Yearly',200.00,'week'),('Tensai',253.00,'year');
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
INSERT INTO `fees_benefit` VALUES ('Adult Monthly','7 day money back guarantee'),('Adult Yearly','7 day money back guarantee'),('Adult Monthly','Coaches who care'),('Adult Yearly','Coaches who care'),('Student Monthly','Coaches who care'),('Student Yearly','Coaches who care'),('Adult Monthly','Free parking'),('Adult Yearly','Free parking'),('Student Monthly','Free parking'),('Student Yearly','Free parking'),('Tensai','Free parking'),('Adult Yearly','Open 7 days per week'),('Student Monthly','Open 7 days per week'),('Student Yearly','Open 7 days per week');
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
  `home_tel` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `membership` varchar(60) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_no`),
  KEY `membership` (`membership`),
  CONSTRAINT `member_ibfk_1` FOREIGN KEY (`membership`) REFERENCES `fees` (`membership_type`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` VALUES (4,'Student','Monthly','0000-00-00','female','','sm@swole.ie','','Student Monthly','password'),(5,'Adult','Monthly','0000-00-00','female','','am@swole.ie','','Adult Monthly','password'),(6,'Adult','Yearly','0000-00-00','female','','ay@swole.ie','','Adult Yearly','password'),(7,'New','User','1990-01-01','male','76543245','test@pff.ie','Long Address','Student Monthly','$2y$10$NxNZssRuxjmzgRh8v.KNb..xCYe00uHhd8HvH3SFsc0PcdMxYR5Mq');
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
INSERT INTO `testimonial` VALUES ('Amanda','2019-04-24 02:46:19','Strength','Superb facilities &amp; excellent staff. Real results too. I\'ve been using other gyms for years on and off and never had the guidance I received here. At 42 probably in the best shape I\'ve ever been and it\'s all thanks to the no nonsense approach of the PerfectForm Fitness team.&quot;',1),('Dan','2019-04-23 11:45:30','Cardio','PerfectForm Fitness is the only gym I have trained at where I stuck to the program and got results. My personal fitness plan is practical, easy to follow and takes account of my busy schedule. My personal trainer Carl is a very motivational and keeps me on track. I have also recommended Carl to some of my colleagues who have gone on to get similar result. Perfectform Fitness is great gym choice!',1),('Ivana','2019-04-24 03:07:44','Strength','I have worked out in many gyms using different methods and programmes. I must say that PFF is by far, The BEST! Their expertise and skill is top class. The ambiance in the gym is clean, organized and the equipment is diverse, interesting and most of all, FUN! Customer service is superb. I truly have seen a huge improvement in my overall mobility and strength.',1),('James','2019-04-24 09:33:34','Yoga','Liz’s teaching flows from her heart.  She has a natural and intuitive understanding of the subject of yoga and a disciplined self practice and excellent training. She conducts her classes with compassion and grace. I have visited many yoga classes in many countries throughout the world and I have found Liz’s classes to be among the most inspiring  I\'ve attended.',1),('James','2019-05-08 08:44:22','Strength','I have been coming to Perfect Form Fitness for about seven months, and the most noticeable changes are that I have lost 7% body fat and over 20 pounds of scale weight. I have gained lean muscle mass, feel more energetic, and sleep better.  I also believe I have better posture, because I am more aware of my body.',1),('Nhan','2019-04-23 10:51:28','Cardio','I have been a regular member of PerfectForm Fitness ever since I came to Dublin 8 years ago and I find it excellent as well as being convenient to where I work. I am a long distance runner so I use it for strength and conditioning and it has all the equipment I need for that. I would definitely recommend it to anyone looking around for a good gym in Dublin 6',1),('Oisin','2019-04-23 10:34:19','Cardio','If you are looking for a gym near the South Circular Road that that offers personal fitness classes and trainers that care about getting you into great shape, PerfectForm Fitness really is a great choice!',1),('Sarah','2019-04-24 02:24:29','Yoga','&quot;Lovely and knowledgeable staff! As a first time gym-goer, it was very important to me that I find a trainer who listens, understands and knows what\'s best for me. I\'m already starting to see the results and I couldn\'t be happier. This gym is one of those places that you go to, where people always greet you with a smile and are always kind and helpful.',1);
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

-- Dump completed on 2019-05-10 10:37:23
