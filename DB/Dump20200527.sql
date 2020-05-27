-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: smacpage
-- ------------------------------------------------------
-- Server version	5.7.29-log

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
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_admin` (
  `adminid` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(100) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `email_id` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `admin_type` tinyint(1) DEFAULT NULL COMMENT '1=Super Admin / 2=Admin',
  `status` tinyint(1) DEFAULT '1' COMMENT 'Inactive=0, Active=1',
  `temp_password` varchar(200) DEFAULT NULL,
  `pwd_created` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`adminid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_admin`
--

LOCK TABLES `tbl_admin` WRITE;
/*!40000 ALTER TABLE `tbl_admin` DISABLE KEYS */;
INSERT INTO `tbl_admin` VALUES (1,'Smac Admin','123456789','info@smacpage.com','$2y$10$B/gtjmNv/.6JtipNjEGhc.CiDMSIMmmp13Cd6gRCR0ukdx9U98rxW',1,1,NULL,NULL,'2017-12-14 05:43:52',1,NULL,NULL);
/*!40000 ALTER TABLE `tbl_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_admin_modules`
--

DROP TABLE IF EXISTS `tbl_admin_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_admin_modules` (
  `amid` int(11) NOT NULL AUTO_INCREMENT,
  `adminid` int(11) DEFAULT NULL,
  `moduleid` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`amid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_admin_modules`
--

LOCK TABLES `tbl_admin_modules` WRITE;
/*!40000 ALTER TABLE `tbl_admin_modules` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_admin_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT 'Inactive=0,Active=1',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_category`
--

LOCK TABLES `tbl_category` WRITE;
/*!40000 ALTER TABLE `tbl_category` DISABLE KEYS */;
INSERT INTO `tbl_category` VALUES (3,'Category 1',1,'2020-05-17 09:37:37',1,NULL,NULL);
/*!40000 ALTER TABLE `tbl_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_city`
--

DROP TABLE IF EXISTS `tbl_city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_city` (
  `cityid` int(11) NOT NULL AUTO_INCREMENT,
  `countryid` int(11) NOT NULL,
  `city_name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT 'Inactive=0, Active=1',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`cityid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_city`
--

LOCK TABLES `tbl_city` WRITE;
/*!40000 ALTER TABLE `tbl_city` DISABLE KEYS */;
INSERT INTO `tbl_city` VALUES (3,12,'Mumbai',1,'2020-05-17 09:37:27',1,NULL,NULL);
/*!40000 ALTER TABLE `tbl_city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_contents`
--

DROP TABLE IF EXISTS `tbl_contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_contents` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(50) DEFAULT NULL,
  `page_content` text,
  `seo_title` text,
  `seo_description` text,
  `seo_keywords` text,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_contents`
--

LOCK TABLES `tbl_contents` WRITE;
/*!40000 ALTER TABLE `tbl_contents` DISABLE KEYS */;
INSERT INTO `tbl_contents` VALUES (1,'Why Us','<div class=\"section-title\">\r\n<h2>Why Us</h2>\r\n</div>\r\n\r\n<div class=\"col-md-10 col-md-offset-1 mb30 text-center\">\r\n<p class=\"desc\">Why Us Contents</p>\r\n</div>','Why Us | Smac Page','Why Us | Smac Page','Why Us | Smac Page','2018-01-20 00:00:00',1),(2,'Our Team','<div class=\"section-title\">\r\n<h2>Our Team</h2>\r\n</div>\r\n\r\n<div class=\"col-md-10 col-md-offset-1 mb30 text-center\">\r\n<p class=\"desc\">Our Team Contents</p>\r\n</div>','',NULL,NULL,'2018-01-20 00:00:00',1),(3,'Portfolio','<div class=\"section-title\">\r\n<h2>Portfolio</h2>\r\n</div>\r\n\r\n<div class=\"col-md-10 col-md-offset-1 mb30 text-center\">\r\n<p class=\"desc\">Portfolio Contents</p>\r\n</div>','',NULL,NULL,'2018-01-27 00:00:00',1),(4,'Blog','<div class=\"section-title\">\r\n<h2>Blog</h2>\r\n</div>\r\n<div class=\"col-md-10 col-md-offset-1 mb30 text-center\">\r\n<p class=\"desc\">Blog Contents</p>\r\n</div>','',NULL,NULL,NULL,NULL),(5,'Contact',NULL,NULL,NULL,NULL,NULL,NULL),(6,'Services','<div class=\"section-title\">\r\n<h2>Services</h2>\r\n</div>\r\n\r\n<div class=\"col-md-10 col-md-offset-1 mb30 text-center\">\r\n<p class=\"desc\">Services Contents</p>\r\n</div>','',NULL,NULL,NULL,NULL),(7,'Terms of Service','<div class=\"section-title\">\r\n<h2>Terms of Service</h2>\r\n</div>\r\n\r\n<div class=\"col-md-10 col-md-offset-1 mb30 text-center\">\r\n<p class=\"desc\">Terms of Services</p>\r\n</div>','',NULL,NULL,NULL,NULL),(8,'Privacy Policy','<div class=\"section-title\">\r\n<h2>Privacy Policy</h2>\r\n</div>\r\n\r\n<div class=\"col-md-10 col-md-offset-1 mb30 text-center\">\r\n<p class=\"desc\">Privacy Policy Contents</p>\r\n</div>','',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `tbl_contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_country`
--

DROP TABLE IF EXISTS `tbl_country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_country` (
  `countryid` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL COMMENT 'Inactive=0,Active=1',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`countryid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_country`
--

LOCK TABLES `tbl_country` WRITE;
/*!40000 ALTER TABLE `tbl_country` DISABLE KEYS */;
INSERT INTO `tbl_country` VALUES (12,'India',1,'2020-05-17 09:37:12',1,NULL,NULL);
/*!40000 ALTER TABLE `tbl_country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_enquiry`
--

DROP TABLE IF EXISTS `tbl_enquiry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_enquiry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `subject` varchar(128) DEFAULT NULL,
  `message` text,
  `created_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_enquiry`
--

LOCK TABLES `tbl_enquiry` WRITE;
/*!40000 ALTER TABLE `tbl_enquiry` DISABLE KEYS */;
INSERT INTO `tbl_enquiry` VALUES (1,'Shahnawaz','atiqueshahnawaz@gmail.com','Contact enquiry','Contact enquiry message','2020-05-20 16:19:15'),(2,'shahnawaz','shahnawz@gmail.com','test','teststes seuta ar','2020-05-20 16:21:21');
/*!40000 ALTER TABLE `tbl_enquiry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_service`
--

DROP TABLE IF EXISTS `tbl_service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_service` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(150) DEFAULT NULL,
  `page_url` varchar(200) DEFAULT NULL,
  `description` text,
  `status` smallint(4) DEFAULT '1',
  `created_date` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_service`
--

LOCK TABLES `tbl_service` WRITE;
/*!40000 ALTER TABLE `tbl_service` DISABLE KEYS */;
INSERT INTO `tbl_service` VALUES (1,'Apps Development','apps-development','<p><strong>Apps Development</strong></p>\r\n',1,'2020-05-19 13:46:21',1,'2020-05-19 13:50:52',1),(2,'Software Development','software-development','<p><strong>Software Development</strong></p>\r\n',1,'2020-05-19 13:51:29',1,NULL,NULL),(3,'Web Development','web-development','<p><strong>Web Development</strong></p>\r\n',1,'2020-05-20 15:57:40',1,NULL,NULL),(4,'Web Designing','web-designing','<p><strong>Web Designing</strong></p>\r\n',1,'2020-05-20 15:58:03',1,NULL,NULL),(5,'Content Writing','content-writing','<p><strong>Content Writing</strong></p>\r\n',1,'2020-05-20 15:58:22',1,NULL,NULL),(6,'Social Media Optimization','social-media-optimization','<p><strong>Social Media Optimization</strong></p>\r\n',1,'2020-05-20 15:58:48',1,NULL,NULL),(7,'Local SEO','local-seo','<p><strong>Local SEO</strong></p>\r\n',1,'2020-05-20 15:59:02',1,NULL,NULL),(8,'Multilingual SEO','multilingual-seo','<p><strong>Multilingual SEO</strong></p>\r\n',1,'2020-05-20 15:59:23',1,NULL,NULL),(9,'Search Engine Optimization','search-engine-optimization','<p><strong>Search Engine Optimization</strong></p>\r\n',1,'2020-05-20 15:59:47',1,NULL,NULL),(10,'PPC Management','ppc-management','<p><strong>PPC Management</strong></p>\r\n',1,'2020-05-20 16:00:02',1,NULL,NULL),(11,'Digital Marketing','digital-marketing','<style type=\"text/css\"><!--\r\n.style4 {\r\n	font-size: 24px;\r\n	font-weight: bold;\r\n	color: #0000CC;\r\n	font-family: Arial;\r\n}\r\n.style5 {\r\n	font-size: 16px;\r\n	font-family: Arial;\r\n}\r\n-->\r\n</style>\r\n<p align=\"justify\" class=\"style4\">Digital Marketing Services</p>\r\n\r\n<p align=\"justify\" class=\"style5\"><strong>One-Stop Solution for All Online Branding Needs </strong></p>\r\n\r\n<p align=\"justify\" class=\"style5\">Transform your easygoing online visitors into paying clients. Even better transform them into brand advocates. Getting a consistent stream of website traffic is an incredible beginning, but bad if they&#39;re not changing over, and afterward you&#39;re not going to see quite a bit of&nbsp;ROI. Begin getting greater commitment to digital marketing services.</p>\r\n\r\n<p align=\"justify\" class=\"style5\">SmacPage is a #1 digital marketing company that centers on developing your business effectively online. Regardless of whether you need to boost conversion, bring traffic to your website, or both, we can assist you with planning an Internet showcasing effort that can assist you with arriving at your objectives.</p>\r\n\r\n<p align=\"justify\" class=\"style5\"><strong>Leads, Conversion and Sales</strong></p>\r\n\r\n<p align=\"justify\" class=\"style5\">We center on developing your business effectively with internet branding services. Regardless of whether you need to boost conversion, bring traffic to your website, or both, we can assist you with planning an Internet advertising effort that can assist you with arriving at your objectives.</p>\r\n\r\n<p align=\"justify\" class=\"style5\">Numerous entrepreneurs treat their site as though it were an online pamphlet. This is a genuine blunder! Your website isn&#39;t a leaflet, it&#39;s a virtual salesman with an implicit deals pipe (and if it&#39;s not, it ought to be!). Regardless of how extraordinary your website is, it can&#39;t create leads and deals. Let SmacPage tell you the best way to make a web-based branding procedure that works&mdash;changing your web nearness into a lead age domain!</p>\r\n\r\n<p align=\"justify\" class=\"style5\">Transform your online visitors into paying clients. Even better transform them into brand advocates. Getting a steady stream of online traffic is an extraordinary beginning; however, if they&#39;re not changing over, at that point you&#39;re not going to see a lot of ROI. Begin getting greater commitment with your internet promotion.</p>\r\n\r\n<p align=\"justify\" class=\"style5\"><strong>Get Free Consulting</strong></p>\r\n\r\n<p align=\"justify\" class=\"style5\">Get in touch with us today for free consulting. Inform us concerning your circumstance and we&#39;ll furnish you with genuine proposals for digital marketing services. Contact us to find out our additional based advertising contextual investigations specifying real outcomes we&#39;ve delivered for business simply like yours, or get the telephone and call us today at <strong>7735013123</strong>!</p>\r\n',1,'2020-05-20 16:00:17',1,'2020-05-26 07:09:18',1);
/*!40000 ALTER TABLE `tbl_service` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-27 13:57:26
