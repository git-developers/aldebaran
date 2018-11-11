-- MySQL dump 10.13  Distrib 5.7.9, for linux-glibc2.5 (x86_64)
--
-- Host: localhost    Database: aldebaran_db
-- ------------------------------------------------------
-- Server version	5.5.48-MariaDB-1~trusty

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
-- Table structure for table `about`
--

DROP TABLE IF EXISTS `about`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `about` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `body` text,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_increment`,`user_id`),
  KEY `fk_about_user1_idx` (`user_id`),
  CONSTRAINT `fk_about_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `about`
--

LOCK TABLES `about` WRITE;
/*!40000 ALTER TABLE `about` DISABLE KEYS */;
/*!40000 ALTER TABLE `about` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuration_email`
--

DROP TABLE IF EXISTS `configuration_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuration_email` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `from_email` varchar(45) DEFAULT 'test@test.com',
  `from_name` varchar(45) DEFAULT 'Admiro tu belleza',
  `username` text,
  `password` varchar(100) DEFAULT NULL,
  `host` varchar(100) DEFAULT NULL,
  `port` int(5) DEFAULT NULL,
  `encryption` varchar(5) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_increment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuration_email`
--

LOCK TABLES `configuration_email` WRITE;
/*!40000 ALTER TABLE `configuration_email` DISABLE KEYS */;
/*!40000 ALTER TABLE `configuration_email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `element`
--

DROP TABLE IF EXISTS `element`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `element` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `element_type_id` int(11) NOT NULL,
  `unique_id` varchar(45) NOT NULL,
  `stack_order` int(11) NOT NULL DEFAULT '9999',
  `position_x` decimal(18,12) DEFAULT NULL,
  `position_y` decimal(18,12) DEFAULT NULL,
  `tag_id` varchar(45) DEFAULT NULL,
  `tag_name` varchar(100) DEFAULT NULL,
  `tag_value` varchar(100) DEFAULT NULL,
  `tag_title` varchar(100) DEFAULT NULL,
  `tag_size` int(11) DEFAULT NULL,
  `tag_readonly` tinyint(1) DEFAULT NULL,
  `tag_disabled` tinyint(1) DEFAULT NULL,
  `tag_required` tinyint(1) DEFAULT NULL,
  `tag_max` int(11) DEFAULT NULL,
  `tag_min` int(11) DEFAULT NULL,
  `tag_maxlength` int(11) DEFAULT NULL,
  `tag_pattern` varchar(45) DEFAULT NULL,
  `tag_step` varchar(45) DEFAULT NULL,
  `tag_onclick` varchar(100) DEFAULT NULL,
  `tag_placeholder` varchar(45) DEFAULT NULL,
  `tag_rows` int(11) DEFAULT NULL,
  `tag_cols` int(11) DEFAULT NULL,
  `tag_autofocus` varchar(45) DEFAULT NULL,
  `tag_multiple` tinyint(1) DEFAULT NULL,
  `label_name` varchar(100) DEFAULT NULL,
  `label_for` varchar(45) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_increment`,`element_type_id`),
  UNIQUE KEY `element_unique_id_UNIQUE` (`unique_id`),
  KEY `fk_element_element_type1_idx` (`element_type_id`),
  CONSTRAINT `fk_element_element_type1` FOREIGN KEY (`element_type_id`) REFERENCES `element_type` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `element`
--

LOCK TABLES `element` WRITE;
/*!40000 ALTER TABLE `element` DISABLE KEYS */;
INSERT INTO `element` VALUES (1,5,'579d8d2f095be',1,NULL,NULL,'579d8d2f095be','text',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese un texto',NULL,NULL,NULL,NULL,'Etiqueta texto',NULL,'2016-07-31 00:31:27','2016-07-31 00:38:58',1),(2,8,'579d8d332d15b',2,NULL,NULL,'579d8d332d15b','time',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,'Etiqueta hora',NULL,'2016-07-31 00:31:31','2016-07-31 00:38:58',1),(3,5,'579d8d343d1f6',3,NULL,NULL,'579d8d343d1f6','text',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese un texto',NULL,NULL,NULL,NULL,'Etiqueta texto',NULL,'2016-07-31 00:31:32','2016-07-31 00:38:58',1),(4,11,'579d8d3533cf7',0,NULL,NULL,'579d8d3533cf7','url',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://',NULL,NULL,NULL,NULL,'Etiqueta url',NULL,'2016-07-31 00:31:33','2016-07-31 00:38:58',1),(5,20,'579e31f703b5b',9999,NULL,NULL,'579e31f703b5b','map',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,'Etiqueta mapa',NULL,'2016-07-31 12:14:31',NULL,1),(6,5,'579e31fdaf558',9999,NULL,NULL,'579e31fdaf558','text',NULL,NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese un texto',NULL,NULL,NULL,NULL,'Direccion',NULL,'2016-07-31 12:14:37','2016-07-31 12:14:48',1),(7,5,'579e31ff191d2',9999,NULL,NULL,'579e31ff191d2','text',NULL,NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese un texto',NULL,NULL,NULL,NULL,'Urb',NULL,'2016-07-31 12:14:39','2016-07-31 12:15:00',1),(8,5,'579e339d90b2e',9999,NULL,NULL,'579e339d90b2e','text',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese un texto',NULL,NULL,NULL,NULL,'Etiqueta texto',NULL,'2016-07-31 12:21:33',NULL,1),(9,5,'579e339f3ff3f',9999,NULL,NULL,'579e339f3ff3f','text',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese un texto',NULL,NULL,NULL,NULL,'Etiqueta texto',NULL,'2016-07-31 12:21:35',NULL,1),(10,5,'579e72ad701b5',9999,NULL,NULL,'579e72ad701b5','text',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese un texto',NULL,NULL,NULL,NULL,'Etiqueta texto',NULL,'2016-07-31 16:50:37',NULL,1),(11,24,'579eb76975416',9999,NULL,NULL,'579eb76975416','bed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-31 21:43:53',NULL,1),(12,24,'579eb83abb7cb',9999,NULL,NULL,'579eb83abb7cb','bed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-31 21:47:22',NULL,1),(13,5,'579ec096cd0e8',9999,NULL,NULL,'579ec096cd0e8','text',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese un texto',NULL,NULL,NULL,NULL,'Etiqueta texto',NULL,'2016-07-31 22:23:02',NULL,1),(14,5,'579ec09b4c874',9999,NULL,NULL,'579ec09b4c874','text',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese un texto',NULL,NULL,NULL,NULL,'Etiqueta texto',NULL,'2016-07-31 22:23:07',NULL,1),(15,24,'579ec27b06bce',9999,487.000000000000,421.000000000000,'579ec27b06bce','bed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-31 22:31:07','2016-08-01 00:20:12',1),(16,24,'579ec27ea3846',9999,679.000000000000,312.000000000000,'579ec27ea3846','bed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-31 22:31:10','2016-08-01 01:14:09',1),(17,24,'579eccc3a5d36',9999,470.000000000000,414.000000000000,'579eccc3a5d36','bed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-31 23:14:59','2016-08-01 01:14:08',1),(18,24,'579eccc5634b0',9999,491.000000000000,321.000000000000,'579eccc5634b0','bed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-31 23:15:01','2016-08-01 01:14:05',1),(19,24,'579eccc9e640b',9999,268.000000000000,257.000000000000,'579eccc9e640b','bed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-31 23:15:05','2016-08-01 01:14:03',1),(20,24,'579ecdd766561',9999,507.000000000000,285.000000000000,'579ecdd766561','bed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-07-31 23:19:35','2016-08-01 00:14:21',1),(22,24,'579eefab31dee',9999,407.000000000000,251.000000000000,'579eefab31dee','bed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-01 01:43:55','2016-08-01 01:44:56',1),(23,24,'579eefe2cc7b4',9999,245.000000000000,433.000000000000,'579eefe2cc7b4','bed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-01 01:44:50','2016-08-01 01:44:55',1),(24,24,'579eefe8e27d8',9999,457.000000000000,508.000000000000,'579eefe8e27d8','bed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-01 01:44:56','2016-08-01 01:45:02',1),(25,24,'579eefee3d467',9999,494.000000000000,242.000000000000,'579eefee3d467','bed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-01 01:45:02','2016-08-01 01:45:06',1),(26,24,'579eeff2acd55',9999,320.000000000000,365.000000000000,'579eeff2acd55','bed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-01 01:45:06','2016-08-01 01:45:09',1),(27,24,'579eeff574121',9999,822.000000000000,212.000000000000,'579eeff574121','bed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-01 01:45:09','2016-08-01 01:45:12',1),(28,24,'579eeff85e4fd',9999,282.000000000000,270.000000000000,'579eeff85e4fd','bed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-01 01:45:12','2016-08-01 01:45:28',1),(29,24,'579ef008d6c78',9999,395.000000000000,405.000000000000,'579ef008d6c78','bed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-01 01:45:28','2016-08-01 01:45:50',1),(30,24,'579ef010edb30',9999,279.000000000000,245.000000000000,'579ef010edb30','bed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-01 01:45:36','2016-08-01 01:45:50',1),(31,24,'579ef0206bcf9',9999,750.000000000000,299.000000000000,'579ef0206bcf9','bed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-01 01:45:52','2016-08-01 01:47:39',1),(32,24,'579ef031ee0aa',9999,274.000000000000,320.000000000000,'579ef031ee0aa','bed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-01 01:46:09','2016-08-01 01:46:14',1),(33,34,'579ef07e76143',9999,485.000000000000,243.000000000000,'579ef07e76143','martiniglass',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-01 01:47:26','2016-08-01 01:47:34',1),(34,34,'579ef1a9b354b',9999,912.000000000000,302.000000000000,'579ef1a9b354b','martiniglass',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-01 01:52:25','2016-08-01 01:54:54',1),(35,24,'579ef1b239426',9999,303.000000000000,255.000000000000,'579ef1b239426','bed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-01 01:52:34','2016-08-01 01:54:51',1),(36,24,'579f96320e4cb',9999,NULL,NULL,'579f96320e4cb','bed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-01 13:34:26',NULL,1),(37,24,'579f9635e2753',9999,NULL,NULL,'579f9635e2753','bed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-01 13:34:29',NULL,1),(38,34,'579f963e6272f',9999,NULL,NULL,'579f963e6272f','martiniglass',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-01 13:34:38',NULL,1),(39,1,'57a17a2b537d6',1,NULL,NULL,'57a17a2b537d6','date',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,'Etiqueta fecha',NULL,'2016-08-02 23:59:23','2016-08-03 00:00:44',1),(40,5,'57a17a7246c8c',0,NULL,NULL,'57a17a7246c8c','text',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese un texto',NULL,NULL,NULL,NULL,'Etiqueta texto',NULL,'2016-08-03 00:00:34','2016-08-03 00:00:44',1),(41,5,'57a17b1ae0304',2,NULL,NULL,'57a17b1ae0304','text',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese un texto',NULL,NULL,NULL,NULL,'Etiqueta texto',NULL,'2016-08-03 00:03:22','2016-08-03 00:03:35',1),(42,5,'57a17b1bec48c',1,NULL,NULL,'57a17b1bec48c','text',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese un texto',NULL,NULL,NULL,NULL,'Etiqueta texto',NULL,'2016-08-03 00:03:23','2016-08-03 00:03:35',1),(43,10,'57a17b1e32930',3,NULL,NULL,'57a17b1e32930','email',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'test@aldebaran.com',NULL,NULL,NULL,NULL,'Etiqueta email',NULL,'2016-08-03 00:03:26','2016-08-03 00:03:35',1),(44,6,'57a17b1fce43f',0,NULL,NULL,'57a17b1fce43f','color',NULL,NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'color',NULL,'2016-08-03 00:03:27','2016-08-03 00:03:44',1),(45,21,'57a17b444741c',9999,NULL,NULL,'57a17b444741c','pagebreak',NULL,NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese default',NULL,NULL,NULL,NULL,'Programa 01',NULL,'2016-08-03 00:04:04','2016-08-03 00:04:37',1),(46,5,'57a17b50c04cb',9999,NULL,NULL,'57a17b50c04cb','text',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese un texto',NULL,NULL,NULL,NULL,'Etiqueta texto',NULL,'2016-08-03 00:04:16',NULL,1),(47,5,'57a17b51d17e8',9999,NULL,NULL,'57a17b51d17e8','text',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese un texto',NULL,NULL,NULL,NULL,'Etiqueta texto',NULL,'2016-08-03 00:04:17',NULL,1),(48,8,'57a17b52e80f2',9999,NULL,NULL,'57a17b52e80f2','time',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,'Etiqueta hora',NULL,'2016-08-03 00:04:18',NULL,1),(49,21,'57a17b577f898',9999,NULL,NULL,'57a17b577f898','pagebreak',NULL,NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese default',NULL,NULL,NULL,NULL,'Programa 02',NULL,'2016-08-03 00:04:23','2016-08-03 00:04:44',1),(50,8,'57a17b5a4021c',9999,NULL,NULL,'57a17b5a4021c','time',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,'Etiqueta hora',NULL,'2016-08-03 00:04:26',NULL,1),(51,20,'57a17b7db4dec',9999,NULL,NULL,'57a17b7db4dec','map',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,'Etiqueta mapa',NULL,'2016-08-03 00:05:01',NULL,1),(52,5,'57a17b982a52e',9999,NULL,NULL,'57a17b982a52e','text',NULL,NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese un texto',NULL,NULL,NULL,NULL,'direccion',NULL,'2016-08-03 00:05:28','2016-08-03 00:05:40',1),(53,5,'57a17b9a20c67',9999,NULL,NULL,'57a17b9a20c67','text',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese un texto',NULL,NULL,NULL,NULL,'Etiqueta texto',NULL,'2016-08-03 00:05:30',NULL,1),(54,5,'57a17b9cd057d',9999,NULL,NULL,'57a17b9cd057d','text',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese un texto',NULL,NULL,NULL,NULL,'Etiqueta texto',NULL,'2016-08-03 00:05:32',NULL,1),(56,34,'57a184cb4aa7d',9999,NULL,NULL,'57a184cb4aa7d','martiniglass',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-03 00:44:43',NULL,1),(57,5,'57a29841b46a7',0,NULL,NULL,'57a29841b46a7','text',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese un texto',NULL,NULL,NULL,NULL,'Etiqueta texto',NULL,'2016-08-03 20:20:01','2016-08-03 20:20:11',1),(58,20,'57a298433b754',2,NULL,NULL,'57a298433b754','map',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,'Etiqueta mapa',NULL,'2016-08-03 20:20:03','2016-08-03 20:20:11',1),(59,11,'57a29848f253e',1,NULL,NULL,'57a29848f253e','url',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://',NULL,NULL,NULL,NULL,'Etiqueta url',NULL,'2016-08-03 20:20:09','2016-08-03 20:20:11',1),(60,8,'57a39c0fed06c',1,NULL,NULL,'57a39c0fed06c','time',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,'Etiqueta hora',NULL,'2016-08-04 14:48:31','2016-08-04 14:49:46',1),(61,5,'57a39c10edeb8',2,NULL,NULL,'57a39c10edeb8','text',NULL,NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese un texto',NULL,NULL,NULL,NULL,'Precio',NULL,'2016-08-04 14:48:32','2016-08-04 14:49:46',1),(64,11,'57a39c2c940e8',3,NULL,NULL,'57a39c2c940e8','url',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://',NULL,NULL,NULL,NULL,'Etiqueta url',NULL,'2016-08-04 14:49:00','2016-08-04 14:49:46',1),(65,4,'57a39c454496f',0,NULL,NULL,'57a39c454496f','number',NULL,NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese un numero',NULL,NULL,NULL,NULL,'cantidad',NULL,'2016-08-04 14:49:25','2016-08-04 14:49:46',1),(66,21,'57a7693820b14',9999,NULL,NULL,'57a7693820b14','pagebreak',NULL,NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese default',NULL,NULL,NULL,NULL,'Brief',NULL,'2016-08-07 12:00:40','2016-08-07 12:01:22',1),(69,5,'57a7698480289',9999,NULL,NULL,'57a7698480289','text',NULL,NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese un texto',NULL,NULL,NULL,NULL,'Descripcion',NULL,'2016-08-07 12:01:56','2016-08-07 12:03:38',1),(70,5,'57a769877260d',9999,NULL,NULL,'57a769877260d','text',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese un texto',NULL,NULL,NULL,NULL,'Etiqueta texto',NULL,'2016-08-07 12:01:59',NULL,1),(71,8,'57a76a6211641',9999,NULL,NULL,'57a76a6211641','time',NULL,NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Cronograma',NULL,'2016-08-07 12:05:38','2016-08-07 12:06:06',1),(72,1,'57a76b0f0d2ae',1,NULL,NULL,'57a76b0f0d2ae','date',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,'Etiqueta fecha',NULL,'2016-08-07 12:08:31','2016-08-07 12:13:11',1),(73,8,'57a76b14f1af8',2,NULL,NULL,'57a76b14f1af8','time',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,'Etiqueta hora',NULL,'2016-08-07 12:08:37','2016-08-07 12:13:11',1),(74,20,'57a76b1b3c931',0,NULL,NULL,'57a76b1b3c931','map',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,'Etiqueta mapa',NULL,'2016-08-07 12:08:43','2016-08-07 12:13:11',1),(75,5,'57a76b25b592b',3,NULL,NULL,'57a76b25b592b','text',NULL,NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese un texto',NULL,NULL,NULL,NULL,'Contactos',NULL,'2016-08-07 12:08:53','2016-08-07 12:13:11',1),(76,5,'57a76b3996214',4,NULL,NULL,'57a76b3996214','text',NULL,NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese un texto',NULL,NULL,NULL,NULL,'Direcion',NULL,'2016-08-07 12:09:13','2016-08-07 12:13:11',1),(77,4,'57a76b4abf617',5,NULL,NULL,'57a76b4abf617','number',NULL,NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese un numero',NULL,NULL,NULL,NULL,'Area a Toldar',NULL,'2016-08-07 12:09:30','2016-08-07 12:13:11',1),(78,5,'57a7c2ad1856a',9999,NULL,NULL,'57a7c2ad1856a','text',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese un texto',NULL,NULL,NULL,NULL,'Etiqueta texto',NULL,'2016-08-07 18:22:21',NULL,1),(79,29,'57a7c4895adc4',9999,NULL,NULL,'57a7c4895adc4','reedchair',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-07 18:30:17',NULL,1),(80,29,'57a7c48b3a7a4',9999,NULL,NULL,'57a7c48b3a7a4','reedchair',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-07 18:30:19',NULL,1),(81,27,'57a7c48c6c0ee',9999,NULL,NULL,'57a7c48c6c0ee','bookshelf',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-07 18:30:20',NULL,1),(82,34,'57a7c48e943b4',9999,NULL,NULL,'57a7c48e943b4','martiniglass',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-07 18:30:22',NULL,1),(83,24,'57a7c4a002c61',9999,NULL,NULL,'57a7c4a002c61','bed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-07 18:30:40',NULL,1),(84,26,'57a7c4abc097e',9999,NULL,NULL,'57a7c4abc097e','bookcase',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-07 18:30:51',NULL,1),(85,24,'57a7c4adb444c',9999,NULL,NULL,'57a7c4adb444c','bed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-07 18:30:53',NULL,1),(86,34,'57a7c4bf817c6',9999,NULL,NULL,'57a7c4bf817c6','martiniglass',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-07 18:31:11',NULL,1),(87,5,'57b93850a1d5e',9999,NULL,NULL,'57b93850a1d5e','text',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ingrese un texto',NULL,NULL,NULL,NULL,'Etiqueta texto',NULL,'2016-08-21 00:12:48',NULL,1),(88,11,'57b9385322f1d',9999,NULL,NULL,'57b9385322f1d','url',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://',NULL,NULL,NULL,NULL,'Etiqueta url',NULL,'2016-08-21 00:12:51',NULL,1),(89,10,'57b9385420aed',9999,NULL,NULL,'57b9385420aed','email',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'test@aldebaran.com',NULL,NULL,NULL,NULL,'Etiqueta email',NULL,'2016-08-21 00:12:52',NULL,1),(90,1,'57b93855455d0',9999,NULL,NULL,'57b93855455d0','date',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,'Etiqueta fecha',NULL,'2016-08-21 00:12:53',NULL,1);
/*!40000 ALTER TABLE `element` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `element_group`
--

DROP TABLE IF EXISTS `element_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `element_group` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `name_es` varchar(120) DEFAULT NULL,
  `name_en` varchar(120) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_increment`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `element_group`
--

LOCK TABLES `element_group` WRITE;
/*!40000 ALTER TABLE `element_group` DISABLE KEYS */;
INSERT INTO `element_group` VALUES (1,'Formulario','Form',NULL,NULL,NULL),(2,'Cocina comercial','Commercial Kitchen',NULL,NULL,NULL),(3,'Sillas y taburetes','Chairs & Stools',NULL,NULL,NULL),(4,'Catering','Catering',NULL,NULL,NULL),(5,'Vasos y botellas','Glases and bottles',NULL,NULL,NULL);
/*!40000 ALTER TABLE `element_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `element_type`
--

DROP TABLE IF EXISTS `element_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `element_type` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `name_es` varchar(120) DEFAULT NULL,
  `name_en` varchar(120) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_increment`,`group_id`),
  KEY `fk_element_group1_idx` (`group_id`),
  CONSTRAINT `fk_element_group1` FOREIGN KEY (`group_id`) REFERENCES `element_group` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `element_type`
--

LOCK TABLES `element_type` WRITE;
/*!40000 ALTER TABLE `element_type` DISABLE KEYS */;
INSERT INTO `element_type` VALUES (1,1,'DateElement','fecha','','<i class=\'fa fa-fw fa-calendar\'></i>','0000-00-00 00:00:00',NULL,1),(4,1,'NumberElement','numero','number','<i class=\"fa fa-fw fa-sort-numeric-asc\"></i>','0000-00-00 00:00:00',NULL,1),(5,1,'TextElement','texto','text','<i class=\"fa fa-fw fa-align-left\"></i>','0000-00-00 00:00:00',NULL,1),(6,1,'ColorElement','color','color','<i class=\"fa fa-fw fa-paint-brush\"></i>','0000-00-00 00:00:00',NULL,1),(8,1,'TimeElement','hora','time','<i class=\"fa fa-fw fa-clock-o\"></i>','0000-00-00 00:00:00',NULL,1),(10,1,'EmailElement','email','email','<i class=\"fa fa-fw fa-envelope-o\"></i>','0000-00-00 00:00:00',NULL,1),(11,1,'UrlElement','web site','web site','<i class=\"fa fa-fw fa-link\"></i>','0000-00-00 00:00:00',NULL,1),(12,1,'TextareaElement','parrafo','textarea','<i class=\"fa fa-fw fa-align-justify\"></i>','0000-00-00 00:00:00',NULL,1),(14,1,'RangeElement','rango','range','<i class=\"fa fa-fw fa-sliders\"></i>','0000-00-00 00:00:00',NULL,1),(16,1,'RadioElement','una elección','','<i class=\"fa fa-fw fa-dot-circle-o\"></i>','0000-00-00 00:00:00',NULL,1),(18,1,'CheckboxElement','multiple elección','','<i class=\"fa fa-fw fa-check-square-o\"></i>','0000-00-00 00:00:00',NULL,1),(20,1,'MapElement','mapa','map','<i class=\"fa fa-fw fa-map-marker\"></i>','0000-00-00 00:00:00',NULL,1),(21,1,'PagebreakElement','page break','page break','<i class=\"fa fa-fw fa-ellipsis-h\"></i>','0000-00-00 00:00:00',NULL,1),(24,2,'BedElement','cama','bed','furniture-and-household-set/bed.svg','0000-00-00 00:00:00',NULL,1),(26,2,'BookcaseElement','bookcase','bookcase','bookcase.svg','0000-00-00 00:00:00',NULL,1),(27,3,'BookshelfElement','bookshelf','bookshelf','bookshelf.svg','0000-00-00 00:00:00',NULL,1),(29,3,'ReedChairElement','Silla de caña','Reed Chair','reed-chair.png','0000-00-00 00:00:00',NULL,1),(30,4,'ChairElement','chair','chair','chair.svg','0000-00-00 00:00:00',NULL,1),(31,4,'ChestDrawersElement','chest of drawers','chest of drawers','chest-of-drawers.svg','0000-00-00 00:00:00',NULL,1),(32,4,'ClosetElement','closet','closet','closet.svg','0000-00-00 00:00:00',NULL,1),(34,5,'MartiniGlassElement','martini glass','martini glass','bar-glases-and-bottles/martini-glass.svg','0000-00-00 00:00:00',NULL,1);
/*!40000 ALTER TABLE `element_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `unique_id` varchar(45) NOT NULL,
  `code` varchar(45) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_increment`),
  UNIQUE KEY `unique_id_UNIQUE` (`unique_id`),
  UNIQUE KEY `code_UNIQUE` (`code`),
  KEY `fk_event_user1_idx` (`user_id`),
  CONSTRAINT `fk_event_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES (24,1,'5799591aeb6ce','4444','',NULL,'2016-07-27 20:01:27','2016-07-30 00:19:24',0),(25,1,'57996f67f1a01','wwwww','',NULL,'2016-07-27 21:36:37','2016-07-30 00:19:27',0),(26,1,'5799759700c1d','55555555555555555','',NULL,'2016-07-27 22:01:55','2016-07-30 00:19:29',0),(27,1,'5799a5fa88aec','9','',NULL,'2016-07-28 01:28:44','2016-07-30 00:19:31',0),(28,1,'579a6f660369f','2222222','',NULL,'2016-07-28 16:03:57','2016-07-30 00:19:34',0),(29,1,'579aef91f3aeb','test 5555','',NULL,'2016-07-29 00:54:43','2016-07-30 00:19:36',0),(30,1,'579afabe3032b','4','',NULL,'2016-07-29 01:42:25','2016-07-30 00:19:38',0),(31,1,'579c3840bb191','999999999999','6666',NULL,'2016-07-30 00:17:13','2016-07-31 12:13:51',0),(32,1,'579d5dc4305d6','222222222222','33333333',NULL,'2016-07-30 21:09:26','2016-07-31 12:13:53',0),(33,1,'579e321e79925','2222222222','33333333333333',NULL,'2016-07-31 12:15:29',NULL,1),(34,1,'579ef0a3afa4b','22222222222222','333333333333',NULL,'2016-08-01 01:52:13',NULL,1),(35,1,'57a17bc49c1b9','el comercio','el comercio',NULL,'2016-08-03 00:07:29',NULL,1),(36,1,'57a7672b70378','EL COMERCIO BUFFET 150 PAX 15-08-2016','BUFFET COCKTAIL PARA 150 PAX',NULL,'2016-08-07 11:58:42',NULL,1),(37,1,'57a7b5500e022','EL COMERCIO BUFFET','fiesta de aniversario','buffet para 1000','2016-08-07 17:28:13',NULL,1);
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_has_form`
--

DROP TABLE IF EXISTS `event_has_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_has_form` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `position` int(11) NOT NULL DEFAULT '9999',
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_increment`,`event_id`,`form_id`),
  KEY `fk_event_has_form5_event1_idx` (`event_id`),
  KEY `fk_event_has_form_form1_idx` (`form_id`),
  CONSTRAINT `fk_event_has_form5_event1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_event_has_form_form1` FOREIGN KEY (`form_id`) REFERENCES `form` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_has_form`
--

LOCK TABLES `event_has_form` WRITE;
/*!40000 ALTER TABLE `event_has_form` DISABLE KEYS */;
INSERT INTO `event_has_form` VALUES (65,24,14,9999,'2016-07-27 20:02:42',NULL),(69,25,14,9999,'2016-07-27 21:39:57',NULL),(91,27,14,9999,'2016-07-28 01:35:31',NULL),(153,28,25,9999,'2016-07-28 18:09:45',NULL),(169,26,14,9999,'2016-07-28 18:25:43',NULL),(170,26,15,9999,'2016-07-28 18:25:43',NULL),(171,26,16,9999,'2016-07-28 18:25:43',NULL),(172,29,45,9999,'2016-07-29 00:54:43',NULL),(176,30,56,9999,'2016-07-29 01:44:07',NULL),(179,32,15,9999,'2016-07-30 21:09:26',NULL),(184,31,13,9999,'2016-07-31 12:13:42',NULL),(185,33,71,9999,'2016-07-31 12:15:29',NULL),(186,34,71,9999,'2016-08-01 01:52:13',NULL),(187,35,71,9999,'2016-08-03 00:07:29',NULL),(188,35,76,9999,'2016-08-03 00:07:29',NULL),(189,35,73,9999,'2016-08-03 00:07:29',NULL),(190,36,73,9999,'2016-08-07 11:58:42',NULL),(191,37,75,9999,'2016-08-07 17:28:13',NULL),(192,37,83,9999,'2016-08-07 17:28:13',NULL),(193,37,82,9999,'2016-08-07 17:28:13',NULL);
/*!40000 ALTER TABLE `event_has_form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `files_mime_type_id` int(11) NOT NULL,
  `name` text,
  `original_name` text,
  `path` text,
  `size` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id_increment`,`user_id`,`files_mime_type_id`),
  KEY `fk_document_user1_idx` (`user_id`),
  KEY `fk_files_files_mime_type1_idx` (`files_mime_type_id`),
  CONSTRAINT `fk_document_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_files_files_mime_type1` FOREIGN KEY (`files_mime_type_id`) REFERENCES `files_mime_type` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (2,1,5,'2016_07_21_57911ed54b8ba.gif','tumblr_kvf6q6OXOj1qa0wtvo1_400.gif','2016_07_21_57911ed54b8ba.gif',264010,1,'2016-07-21 14:13:25',NULL);
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `files_mime_type`
--

DROP TABLE IF EXISTS `files_mime_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files_mime_type` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('jpg','png','gif','pdf','word','ppt','mp3','excel') DEFAULT 'jpg',
  `mime_type` text,
  `viewer` enum('img','google_viewer','audio') DEFAULT 'google_viewer',
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_increment`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files_mime_type`
--

LOCK TABLES `files_mime_type` WRITE;
/*!40000 ALTER TABLE `files_mime_type` DISABLE KEYS */;
INSERT INTO `files_mime_type` VALUES (1,'png','image/png','img','2016-06-13 13:45:44',NULL,1),(2,'pdf','application/pdf','google_viewer','2016-06-13 13:45:59',NULL,1),(3,'jpg','image/jpeg','img','2016-06-13 14:52:36',NULL,1),(4,'ppt','application/vnd.openxmlformats-officedocument.presentationml.presentation','google_viewer','2016-06-13 14:57:06',NULL,1),(5,'gif','image/gif','img','2016-06-13 15:00:17',NULL,1),(6,'ppt','application/vnd.ms-powerpoint','google_viewer','2016-06-26 19:21:00',NULL,1),(7,'jpg','','google_viewer','2016-06-26 22:16:32',NULL,1),(8,'word','application/msword','google_viewer','2016-06-27 12:22:07',NULL,1);
/*!40000 ALTER TABLE `files_mime_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `floor_plan`
--

DROP TABLE IF EXISTS `floor_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `floor_plan` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_increment`,`event_id`),
  KEY `fk_floor_plan_event1_idx` (`event_id`),
  CONSTRAINT `fk_floor_plan_event1` FOREIGN KEY (`event_id`) REFERENCES `event` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `floor_plan`
--

LOCK TABLES `floor_plan` WRITE;
/*!40000 ALTER TABLE `floor_plan` DISABLE KEYS */;
INSERT INTO `floor_plan` VALUES (2,33,NULL,'2016-07-31 22:15:49','2016-08-01 01:47:26',1),(3,34,NULL,'2016-08-01 01:52:22','2016-08-01 13:34:38',1),(4,35,NULL,'2016-08-03 00:44:17','2016-08-03 00:44:43',1),(5,37,NULL,'2016-08-07 18:30:07','2016-08-07 18:31:11',1);
/*!40000 ALTER TABLE `floor_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `floor_plan_has_element`
--

DROP TABLE IF EXISTS `floor_plan_has_element`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `floor_plan_has_element` (
  `floor_plan` int(11) NOT NULL,
  `element` int(11) NOT NULL,
  PRIMARY KEY (`floor_plan`,`element`),
  KEY `fk_floor_plan_has_element_element1_idx` (`element`),
  KEY `fk_floor_plan_has_element_floor_plan1_idx` (`floor_plan`),
  CONSTRAINT `fk_floor_plan_has_element_element1` FOREIGN KEY (`element`) REFERENCES `element` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_floor_plan_has_element_floor_plan1` FOREIGN KEY (`floor_plan`) REFERENCES `floor_plan` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `floor_plan_has_element`
--

LOCK TABLES `floor_plan_has_element` WRITE;
/*!40000 ALTER TABLE `floor_plan_has_element` DISABLE KEYS */;
INSERT INTO `floor_plan_has_element` VALUES (2,15),(2,16),(2,17),(2,18),(2,19),(2,20),(2,22),(2,23),(2,24),(2,25),(2,26),(2,27),(2,28),(2,29),(2,30),(2,31),(2,32),(2,33),(3,34),(3,35),(3,36),(3,37),(3,38),(4,56),(5,79),(5,80),(5,81),(5,82),(5,83),(5,84),(5,85),(5,86);
/*!40000 ALTER TABLE `floor_plan_has_element` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form`
--

DROP TABLE IF EXISTS `form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `unique_id` varchar(45) NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `description` text,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_increment`),
  UNIQUE KEY `form_unique_id_UNIQUE` (`unique_id`),
  KEY `fk_form_user1_idx` (`user_id`),
  CONSTRAINT `fk_form_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form`
--

LOCK TABLES `form` WRITE;
/*!40000 ALTER TABLE `form` DISABLE KEYS */;
INSERT INTO `form` VALUES (8,1,'5799347d85009',NULL,NULL,'2016-07-27 17:24:33','2016-07-27 21:38:58',0),(9,1,'57993a2892b36',NULL,NULL,'2016-07-27 17:48:19','2016-07-27 21:39:00',0),(10,1,'57993a6490bd8',NULL,NULL,'2016-07-27 17:49:15','2016-07-27 21:39:03',0),(11,1,'57993a7cd9839',NULL,NULL,'2016-07-27 17:49:56','2016-07-27 21:39:09',0),(12,1,'57993abe30c9d',NULL,NULL,'2016-07-27 17:50:50','2016-07-27 21:39:06',0),(13,1,'57993fa7ca877','Concepto creativ o diseno','Concepto creativ\r\no diseno','2016-07-27 18:11:43','2016-07-31 12:14:17',0),(14,1,'579942a2a2c73','cliente','cliente','2016-07-27 18:24:33','2016-07-31 12:14:15',0),(15,1,'57994ebc92e6f','FECHA Y UBICACIÓN DEL EVENTO','FECHA Y UBICACIÓN DEL EVENTO','2016-07-27 19:16:18','2016-07-31 12:14:13',0),(16,1,'57997bea17ece',NULL,NULL,'2016-07-27 22:28:50','2016-07-29 23:01:21',0),(17,1,'57998bbf84c6c',NULL,NULL,'2016-07-27 23:36:21','2016-07-29 01:41:59',0),(18,1,'57999495bac49',NULL,NULL,'2016-07-28 00:14:04','2016-07-29 01:41:56',0),(19,1,'5799a9ca479d0',NULL,NULL,'2016-07-28 01:47:01','2016-07-29 01:42:01',0),(20,1,'5799b98dce2b9',NULL,NULL,'2016-07-28 02:51:47','2016-07-29 01:41:47',0),(21,1,'579a2942c1575',NULL,NULL,'2016-07-28 10:51:34','2016-07-29 01:41:49',0),(22,1,'579a39c8b40f4',NULL,NULL,'2016-07-28 11:58:56','2016-07-29 01:41:52',0),(23,1,'579a3e74f38fc',NULL,NULL,'2016-07-28 12:18:52','2016-07-29 01:41:45',0),(24,1,'579a3ed98d369',NULL,NULL,'2016-07-28 12:20:30','2016-07-29 01:41:54',0),(25,1,'579a404c53380',NULL,NULL,'2016-07-28 12:26:40','2016-07-29 01:41:50',0),(26,1,'579a435888559',NULL,NULL,'2016-07-28 12:39:40','2016-07-29 01:41:57',0),(27,1,'579a439e04a7a',NULL,NULL,'2016-07-28 12:41:52','2016-07-29 01:41:30',0),(28,1,'579a462b8ae17',NULL,NULL,'2016-07-28 12:51:44','2016-07-29 01:41:32',0),(29,1,'579a468f15d08',NULL,NULL,'2016-07-28 12:53:23','2016-07-29 01:41:41',0),(30,1,'579a46e3aa681',NULL,NULL,'2016-07-28 12:54:50','2016-07-29 01:41:38',0),(31,1,'579a47099cb3c',NULL,NULL,'2016-07-28 12:55:25','2016-07-29 01:41:34',0),(32,1,'579a484fc8026',NULL,NULL,'2016-07-28 13:00:52','2016-07-29 01:41:28',0),(33,1,'579a4ad67a877',NULL,NULL,'2016-07-28 13:11:42','2016-07-29 01:41:36',0),(34,1,'579a516d27261',NULL,NULL,'2016-07-28 13:39:46','2016-07-29 01:41:43',0),(35,1,'579a5245146c0',NULL,NULL,'2016-07-28 13:43:22','2016-07-29 01:41:25',0),(36,1,'579a54dacec06',NULL,NULL,'2016-07-28 13:54:23','2016-07-29 01:41:21',0),(37,1,'579a6d7f2efc9',NULL,NULL,'2016-07-28 15:39:33','2016-07-29 01:41:18',0),(38,1,'579a6ddb3ff3b',NULL,NULL,'2016-07-28 15:41:03','2016-07-29 01:41:27',0),(39,1,'579a77cce0e39',NULL,NULL,'2016-07-28 16:23:29','2016-07-29 01:41:14',0),(40,1,'579adf7dc245d',NULL,NULL,'2016-07-28 23:45:57','2016-07-29 01:41:16',0),(41,1,'579ae3353040d',NULL,NULL,'2016-07-29 00:01:51','2016-07-29 01:41:20',0),(42,1,'579aecfc8ec15',NULL,NULL,'2016-07-29 00:43:32','2016-07-29 01:41:23',0),(43,1,'579aed81a3406',NULL,NULL,'2016-07-29 00:45:44','2016-07-29 01:41:08',0),(44,1,'579aedb397311',NULL,NULL,'2016-07-29 00:46:33','2016-07-29 01:41:01',0),(45,1,'579aee980985d',NULL,NULL,'2016-07-29 00:50:45','2016-07-29 01:41:10',0),(46,1,'579af23c962c3',NULL,NULL,'2016-07-29 01:05:54','2016-07-29 01:41:05',0),(47,1,'579af291c80d7',NULL,NULL,'2016-07-29 01:07:19','2016-07-29 01:40:55',0),(48,1,'579af2d66a713',NULL,NULL,'2016-07-29 01:08:28','2016-07-29 01:41:12',0),(49,1,'579af30f4ff96',NULL,NULL,'2016-07-29 01:09:24','2016-07-29 01:40:57',0),(50,1,'579af3a33fa13',NULL,NULL,'2016-07-29 01:11:51','2016-07-29 01:41:00',0),(51,1,'579af3b4d4fcd',NULL,NULL,'2016-07-29 01:12:09','2016-07-29 01:40:47',0),(52,1,'579af41743760',NULL,NULL,'2016-07-29 01:13:48','2016-07-29 01:40:50',0),(53,1,'579af52b6fe82',NULL,NULL,'2016-07-29 01:18:27','2016-07-29 01:40:45',0),(54,1,'579af67c75e7e',NULL,NULL,'2016-07-29 01:24:02','2016-07-29 01:40:52',0),(55,1,'579af6af6fe16',NULL,NULL,'2016-07-29 01:24:52','2016-07-29 01:40:43',0),(56,1,'579af7ded7934',NULL,NULL,'2016-07-29 01:30:00','2016-07-29 23:01:19',0),(57,1,'579c254c0e7ec',NULL,NULL,'2016-07-29 23:00:15','2016-07-30 00:08:13',0),(58,1,'579c2831002ac','66666',NULL,'2016-07-29 23:08:28','2016-07-30 21:07:46',0),(59,1,'579c2ae05c47e',NULL,NULL,'2016-07-29 23:19:49','2016-07-29 23:59:42',0),(60,1,'579c2b02600ce',NULL,NULL,'2016-07-29 23:20:25','2016-07-29 23:59:39',0),(61,1,'579c2b340a8fa',NULL,NULL,'2016-07-29 23:21:16','2016-07-29 23:59:36',0),(62,1,'579c2b51482b6',NULL,NULL,'2016-07-29 23:21:42','2016-07-29 23:59:34',0),(63,1,'579c2b9255ccb',NULL,NULL,'2016-07-29 23:22:58','2016-07-29 23:59:31',0),(64,1,'579c2bbc47c45',NULL,NULL,'2016-07-29 23:23:34','2016-07-29 23:59:29',0),(65,1,'579c2cca4d6dc',NULL,NULL,'2016-07-29 23:28:15','2016-07-29 23:59:26',0),(66,1,'579c2d0d23f08',NULL,NULL,'2016-07-29 23:29:17','2016-07-29 23:59:23',0),(67,1,'579ce834e5975','555555555',NULL,'2016-07-30 12:47:46','2016-07-30 21:07:43',0),(68,1,'579d5d0884881','2222',NULL,'2016-07-30 21:06:16','2016-07-30 21:07:41',0),(69,1,'579d5da840af3','111111111',NULL,'2016-07-30 21:08:51','2016-07-30 21:08:59',0),(70,1,'579d8ce89c1c9','qqqqqqqqqqqqqqq',NULL,'2016-07-31 00:31:24','2016-07-31 12:14:11',0),(71,1,'579e31eb222ee','clientes',NULL,'2016-07-31 12:14:29','2016-07-31 12:14:39',1),(72,1,'579e3385d5dcc','33',NULL,'2016-07-31 12:21:32','2016-07-31 12:21:35',1),(73,1,'579e72988acf0','wwww',NULL,'2016-07-31 16:50:36','2016-07-31 16:50:37',1),(74,1,'579ec08ce6528','8888',NULL,'2016-07-31 22:23:01','2016-07-31 22:23:07',1),(75,1,'57a179a21828d','Fecha y Ubicacion del Evento',NULL,'2016-08-02 23:59:04','2016-08-03 00:00:34',1),(76,1,'57a17abbb3d20','form 01',NULL,'2016-08-03 00:03:20','2016-08-03 00:04:26',1),(77,1,'57a17b714c6b5','Ubicacion evento',NULL,'2016-08-03 00:04:57','2016-08-03 00:05:33',1),(78,1,'57a18152007b3','32323',NULL,'2016-08-03 00:29:59','2016-08-03 00:30:11',1),(79,1,'57a18ae107e27','44444',NULL,'2016-08-03 01:10:59',NULL,1),(80,1,'57a2983817475','sss',NULL,'2016-08-03 20:19:59','2016-08-03 20:20:09',1),(81,1,'57a39c0700879','55555555',NULL,'2016-08-04 14:48:29','2016-08-04 14:49:25',1),(82,1,'57a768fb40d0b','Pre-Produccion',NULL,'2016-08-07 12:00:26','2016-08-07 12:01:59',1),(83,1,'57a76a16ece07','Programa , Guion y pautas generales',NULL,'2016-08-07 12:05:18','2016-08-07 12:05:38',1),(84,1,'57a76ad7a0c1b','Fecha y Ubicacion del Evento',NULL,'2016-08-07 12:08:24','2016-08-07 12:09:31',1),(85,1,'57a7ac8195d26','estruccturas',NULL,'2016-08-07 16:48:23',NULL,1),(86,1,'57a7c2448b106','Catering','Alimentos y Bebidas','2016-08-07 18:22:04','2016-08-21 00:12:53',1);
/*!40000 ALTER TABLE `form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_579d5d0884881`
--

DROP TABLE IF EXISTS `form_579d5d0884881`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_579d5d0884881` (
  `id_increment` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_id` int(11) DEFAULT NULL,
  `text_579d5d198a993` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_increment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_579d5d0884881`
--

LOCK TABLES `form_579d5d0884881` WRITE;
/*!40000 ALTER TABLE `form_579d5d0884881` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_579d5d0884881` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_579d5da840af3`
--

DROP TABLE IF EXISTS `form_579d5da840af3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_579d5da840af3` (
  `id_increment` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_id` int(11) DEFAULT NULL,
  `date_579d5db416ec3` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_increment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_579d5da840af3`
--

LOCK TABLES `form_579d5da840af3` WRITE;
/*!40000 ALTER TABLE `form_579d5da840af3` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_579d5da840af3` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_579d8ce89c1c9`
--

DROP TABLE IF EXISTS `form_579d8ce89c1c9`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_579d8ce89c1c9` (
  `id_increment` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_id` int(11) DEFAULT NULL,
  `text_579d8d2f095be` varchar(150) DEFAULT NULL,
  `time_579d8d332d15b` varchar(150) DEFAULT NULL,
  `text_579d8d343d1f6` varchar(150) DEFAULT NULL,
  `url_579d8d3533cf7` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_increment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_579d8ce89c1c9`
--

LOCK TABLES `form_579d8ce89c1c9` WRITE;
/*!40000 ALTER TABLE `form_579d8ce89c1c9` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_579d8ce89c1c9` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_579e31eb222ee`
--

DROP TABLE IF EXISTS `form_579e31eb222ee`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_579e31eb222ee` (
  `id_increment` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_id` int(11) DEFAULT NULL,
  `map_579e31f703b5b` varchar(150) DEFAULT NULL,
  `text_579e31fdaf558` varchar(150) DEFAULT NULL,
  `text_579e31ff191d2` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_increment`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_579e31eb222ee`
--

LOCK TABLES `form_579e31eb222ee` WRITE;
/*!40000 ALTER TABLE `form_579e31eb222ee` DISABLE KEYS */;
INSERT INTO `form_579e31eb222ee` VALUES (1,'2016-07-31 17:15:29',33,'-12.040495754387724##-77.09209442138672','pollazo','eeeeeeeeeeee'),(2,'2016-08-01 06:52:13',34,'','',''),(3,'2016-08-03 05:07:30',35,'-12.097738394619991##-76.99424743652344','lima','');
/*!40000 ALTER TABLE `form_579e31eb222ee` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_579e3385d5dcc`
--

DROP TABLE IF EXISTS `form_579e3385d5dcc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_579e3385d5dcc` (
  `id_increment` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_id` int(11) DEFAULT NULL,
  `text_579e339d90b2e` varchar(150) DEFAULT NULL,
  `text_579e339f3ff3f` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_increment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_579e3385d5dcc`
--

LOCK TABLES `form_579e3385d5dcc` WRITE;
/*!40000 ALTER TABLE `form_579e3385d5dcc` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_579e3385d5dcc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_579e72988acf0`
--

DROP TABLE IF EXISTS `form_579e72988acf0`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_579e72988acf0` (
  `id_increment` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_id` int(11) DEFAULT NULL,
  `text_579e72ad701b5` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_increment`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_579e72988acf0`
--

LOCK TABLES `form_579e72988acf0` WRITE;
/*!40000 ALTER TABLE `form_579e72988acf0` DISABLE KEYS */;
INSERT INTO `form_579e72988acf0` VALUES (1,'2016-08-03 05:07:30',35,''),(2,'2016-08-07 16:58:42',36,'');
/*!40000 ALTER TABLE `form_579e72988acf0` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_579ec08ce6528`
--

DROP TABLE IF EXISTS `form_579ec08ce6528`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_579ec08ce6528` (
  `id_increment` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_id` int(11) DEFAULT NULL,
  `text_579ec096cd0e8` varchar(150) DEFAULT NULL,
  `text_579ec09b4c874` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_increment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_579ec08ce6528`
--

LOCK TABLES `form_579ec08ce6528` WRITE;
/*!40000 ALTER TABLE `form_579ec08ce6528` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_579ec08ce6528` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_57a179a21828d`
--

DROP TABLE IF EXISTS `form_57a179a21828d`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_57a179a21828d` (
  `id_increment` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_id` int(11) DEFAULT NULL,
  `date_57a17a2b537d6` varchar(150) DEFAULT NULL,
  `text_57a17a7246c8c` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_increment`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_57a179a21828d`
--

LOCK TABLES `form_57a179a21828d` WRITE;
/*!40000 ALTER TABLE `form_57a179a21828d` DISABLE KEYS */;
INSERT INTO `form_57a179a21828d` VALUES (1,'2016-08-07 22:28:13',37,'','');
/*!40000 ALTER TABLE `form_57a179a21828d` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_57a17abbb3d20`
--

DROP TABLE IF EXISTS `form_57a17abbb3d20`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_57a17abbb3d20` (
  `id_increment` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_id` int(11) DEFAULT NULL,
  `text_57a17b1ae0304` varchar(150) DEFAULT NULL,
  `text_57a17b1bec48c` varchar(150) DEFAULT NULL,
  `email_57a17b1e32930` varchar(150) DEFAULT NULL,
  `color_57a17b1fce43f` varchar(150) DEFAULT NULL,
  `pagebreak_57a17b444741c` varchar(150) DEFAULT NULL,
  `text_57a17b50c04cb` varchar(150) DEFAULT NULL,
  `text_57a17b51d17e8` varchar(150) DEFAULT NULL,
  `time_57a17b52e80f2` varchar(150) DEFAULT NULL,
  `pagebreak_57a17b577f898` varchar(150) DEFAULT NULL,
  `time_57a17b5a4021c` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_increment`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_57a17abbb3d20`
--

LOCK TABLES `form_57a17abbb3d20` WRITE;
/*!40000 ALTER TABLE `form_57a17abbb3d20` DISABLE KEYS */;
INSERT INTO `form_57a17abbb3d20` VALUES (1,'2016-08-03 05:07:30',35,'','','','#000000',NULL,'','','',NULL,'');
/*!40000 ALTER TABLE `form_57a17abbb3d20` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_57a17b714c6b5`
--

DROP TABLE IF EXISTS `form_57a17b714c6b5`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_57a17b714c6b5` (
  `id_increment` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_id` int(11) DEFAULT NULL,
  `map_57a17b7db4dec` varchar(150) DEFAULT NULL,
  `text_57a17b982a52e` varchar(150) DEFAULT NULL,
  `text_57a17b9a20c67` varchar(150) DEFAULT NULL,
  `text_57a17b9cd057d` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_increment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_57a17b714c6b5`
--

LOCK TABLES `form_57a17b714c6b5` WRITE;
/*!40000 ALTER TABLE `form_57a17b714c6b5` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_57a17b714c6b5` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_57a18152007b3`
--

DROP TABLE IF EXISTS `form_57a18152007b3`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_57a18152007b3` (
  `id_increment` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_increment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_57a18152007b3`
--

LOCK TABLES `form_57a18152007b3` WRITE;
/*!40000 ALTER TABLE `form_57a18152007b3` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_57a18152007b3` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_57a18ae107e27`
--

DROP TABLE IF EXISTS `form_57a18ae107e27`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_57a18ae107e27` (
  `id_increment` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_increment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_57a18ae107e27`
--

LOCK TABLES `form_57a18ae107e27` WRITE;
/*!40000 ALTER TABLE `form_57a18ae107e27` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_57a18ae107e27` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_57a2983817475`
--

DROP TABLE IF EXISTS `form_57a2983817475`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_57a2983817475` (
  `id_increment` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_id` int(11) DEFAULT NULL,
  `text_57a29841b46a7` varchar(150) DEFAULT NULL,
  `map_57a298433b754` varchar(150) DEFAULT NULL,
  `url_57a29848f253e` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_increment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_57a2983817475`
--

LOCK TABLES `form_57a2983817475` WRITE;
/*!40000 ALTER TABLE `form_57a2983817475` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_57a2983817475` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_57a39c0700879`
--

DROP TABLE IF EXISTS `form_57a39c0700879`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_57a39c0700879` (
  `id_increment` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_id` int(11) DEFAULT NULL,
  `time_57a39c0fed06c` varchar(150) DEFAULT NULL,
  `text_57a39c10edeb8` varchar(150) DEFAULT NULL,
  `url_57a39c2c940e8` varchar(150) DEFAULT NULL,
  `number_57a39c454496f` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_increment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_57a39c0700879`
--

LOCK TABLES `form_57a39c0700879` WRITE;
/*!40000 ALTER TABLE `form_57a39c0700879` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_57a39c0700879` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_57a768fb40d0b`
--

DROP TABLE IF EXISTS `form_57a768fb40d0b`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_57a768fb40d0b` (
  `id_increment` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_id` int(11) DEFAULT NULL,
  `pagebreak_57a7693820b14` varchar(150) DEFAULT NULL,
  `text_57a7698480289` varchar(150) DEFAULT NULL,
  `text_57a769877260d` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_increment`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_57a768fb40d0b`
--

LOCK TABLES `form_57a768fb40d0b` WRITE;
/*!40000 ALTER TABLE `form_57a768fb40d0b` DISABLE KEYS */;
INSERT INTO `form_57a768fb40d0b` VALUES (1,'2016-08-07 22:28:13',37,NULL,'','');
/*!40000 ALTER TABLE `form_57a768fb40d0b` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_57a76a16ece07`
--

DROP TABLE IF EXISTS `form_57a76a16ece07`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_57a76a16ece07` (
  `id_increment` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_id` int(11) DEFAULT NULL,
  `time_57a76a6211641` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_increment`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_57a76a16ece07`
--

LOCK TABLES `form_57a76a16ece07` WRITE;
/*!40000 ALTER TABLE `form_57a76a16ece07` DISABLE KEYS */;
INSERT INTO `form_57a76a16ece07` VALUES (1,'2016-08-07 22:28:13',37,'');
/*!40000 ALTER TABLE `form_57a76a16ece07` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_57a76ad7a0c1b`
--

DROP TABLE IF EXISTS `form_57a76ad7a0c1b`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_57a76ad7a0c1b` (
  `id_increment` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_id` int(11) DEFAULT NULL,
  `date_57a76b0f0d2ae` varchar(150) DEFAULT NULL,
  `time_57a76b14f1af8` varchar(150) DEFAULT NULL,
  `map_57a76b1b3c931` varchar(150) DEFAULT NULL,
  `text_57a76b25b592b` varchar(150) DEFAULT NULL,
  `text_57a76b3996214` varchar(150) DEFAULT NULL,
  `number_57a76b4abf617` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_increment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_57a76ad7a0c1b`
--

LOCK TABLES `form_57a76ad7a0c1b` WRITE;
/*!40000 ALTER TABLE `form_57a76ad7a0c1b` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_57a76ad7a0c1b` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_57a7ac8195d26`
--

DROP TABLE IF EXISTS `form_57a7ac8195d26`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_57a7ac8195d26` (
  `id_increment` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_increment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_57a7ac8195d26`
--

LOCK TABLES `form_57a7ac8195d26` WRITE;
/*!40000 ALTER TABLE `form_57a7ac8195d26` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_57a7ac8195d26` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_57a7c2448b106`
--

DROP TABLE IF EXISTS `form_57a7c2448b106`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_57a7c2448b106` (
  `id_increment` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_id` int(11) DEFAULT NULL,
  `text_57a7c2ad1856a` varchar(150) DEFAULT NULL,
  `text_57b93850a1d5e` varchar(150) DEFAULT NULL,
  `url_57b9385322f1d` varchar(150) DEFAULT NULL,
  `email_57b9385420aed` varchar(150) DEFAULT NULL,
  `date_57b93855455d0` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_increment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_57a7c2448b106`
--

LOCK TABLES `form_57a7c2448b106` WRITE;
/*!40000 ALTER TABLE `form_57a7c2448b106` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_57a7c2448b106` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_has_element`
--

DROP TABLE IF EXISTS `form_has_element`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_has_element` (
  `form_id` int(11) NOT NULL,
  `element_id` int(11) NOT NULL,
  PRIMARY KEY (`form_id`,`element_id`),
  KEY `fk_form_has_element_element1_idx` (`element_id`),
  KEY `fk_form_has_element_form1_idx` (`form_id`),
  CONSTRAINT `fk_form_has_element_element1` FOREIGN KEY (`element_id`) REFERENCES `element` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_form_has_element_form1` FOREIGN KEY (`form_id`) REFERENCES `form` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_has_element`
--

LOCK TABLES `form_has_element` WRITE;
/*!40000 ALTER TABLE `form_has_element` DISABLE KEYS */;
INSERT INTO `form_has_element` VALUES (13,39),(14,42),(14,43),(14,179),(14,181),(14,182),(15,50),(15,58),(15,59),(16,60),(17,61),(17,64),(17,65),(18,66),(19,69),(20,70),(20,71),(20,75),(20,76),(20,77),(20,78),(21,79),(21,80),(21,81),(22,82),(22,83),(22,84),(24,87),(25,88),(26,89),(26,90),(26,91),(27,92),(28,93),(29,94),(29,95),(29,96),(29,97),(29,98),(30,99),(31,100),(31,101),(32,102),(32,103),(33,134),(33,135),(33,136),(33,137),(34,141),(34,142),(34,143),(35,153),(35,154),(35,155),(35,156),(35,157),(35,164),(36,159),(36,160),(36,161),(36,162),(36,163),(38,165),(38,166),(38,167),(38,168),(38,169),(38,170),(38,171),(38,172),(38,173),(40,193),(41,195),(42,196),(43,197),(44,199),(45,202),(46,204),(47,206),(48,207),(49,208),(50,209),(51,210),(52,211),(53,212),(54,213),(55,216),(56,217),(56,224),(56,225),(57,228),(57,230),(57,231),(58,232),(58,234),(58,235),(60,237),(61,238),(62,239),(63,240),(64,241),(65,242),(66,243),(67,246),(67,248),(68,249),(69,250),(70,1),(70,2),(70,3),(70,4),(71,5),(71,6),(71,7),(72,8),(72,9),(73,10),(74,13),(74,14),(75,39),(75,40),(76,41),(76,42),(76,43),(76,44),(76,45),(76,46),(76,47),(76,48),(76,49),(76,50),(77,51),(77,52),(77,53),(77,54),(80,57),(80,58),(80,59),(81,60),(81,61),(81,64),(81,65),(82,66),(82,69),(82,70),(83,71),(84,72),(84,73),(84,74),(84,75),(84,76),(84,77),(86,78),(86,87),(86,88),(86,89),(86,90);
/*!40000 ALTER TABLE `form_has_element` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gcm`
--

DROP TABLE IF EXISTS `gcm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gcm` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `click_action` varchar(45) DEFAULT NULL,
  `icon` varchar(45) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `sound` varchar(45) DEFAULT NULL,
  `badge` varchar(45) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  `body` text,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_increment`,`user_id`),
  KEY `fk_gcm_user2_idx` (`user_id`),
  CONSTRAINT `fk_gcm_user2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gcm`
--

LOCK TABLES `gcm` WRITE;
/*!40000 ALTER TABLE `gcm` DISABLE KEYS */;
/*!40000 ALTER TABLE `gcm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `files_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `body` text NOT NULL,
  `news_date` datetime DEFAULT NULL,
  `news_status` enum('published','unpublished') DEFAULT 'unpublished',
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_increment`,`user_id`),
  KEY `fk_section_user1_idx` (`user_id`),
  KEY `fk_news_files1_idx` (`files_id`),
  CONSTRAINT `fk_news_files1` FOREIGN KEY (`files_id`) REFERENCES `files` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_section_user11` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission`
--

DROP TABLE IF EXISTS `permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `group_permission` varchar(45) DEFAULT NULL,
  `group_permission_tag` varchar(45) DEFAULT NULL,
  `alias` varchar(45) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_increment`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission`
--

LOCK TABLES `permission` WRITE;
/*!40000 ALTER TABLE `permission` DISABLE KEYS */;
INSERT INTO `permission` VALUES (1,'Crear usuario','CREATE_USER','Usuario','','0000-00-00 00:00:00',NULL,1),(2,'Editar usuario','EDIT_USER','Usuario','','0000-00-00 00:00:00',NULL,1),(5,'Acceso al backend','BACKEND_ACCESS','Backend','','0000-00-00 00:00:00',NULL,1),(6,'Eliminar usuario','DELETE_USER','Usuario','','0000-00-00 00:00:00',NULL,1),(14,'Listar usuario','LIST_USER','Usuario','','2016-06-10 08:47:11',NULL,1),(15,'Listar usuario session','LIST_USER_SESSION','Usuario','','2016-06-10 10:18:42',NULL,1),(16,'Delete usuario session','DELETE_USER_SESSION','Sesion','','2016-06-10 10:21:57',NULL,1),(17,'Crear perfil','CREATE_PROFILE','Perfil','','2016-06-10 10:26:34',NULL,1),(18,'Eliminar perfil','DELETE_PROFILE','Perfil','','2016-06-10 10:26:34',NULL,1),(19,'Listar perfil','LIST_PROFILE','Perfil','','2016-06-10 10:27:45',NULL,1),(20,'Editar perfil','EDIT_PROFILE','Perfil','','2016-06-10 10:29:50',NULL,1),(21,'Listar gcm','LIST_GCM','Gcm','','2016-06-10 10:49:28',NULL,1),(22,'Eliminar gcm','DELETE_GCM','Gcm','','0000-00-00 00:00:00',NULL,1),(23,'Crear gcm','CREATE_GCM','Gcm','','2016-06-10 10:51:38',NULL,1),(24,'Crear qr','CREATE_QR','Qr','','2016-06-10 10:59:52',NULL,1),(25,'Listar qr','LIST_QR','Qr','','2016-06-10 10:59:52',NULL,1),(26,'Eliminar qr','DELETE_QR','Qr','','2016-06-10 10:59:52',NULL,1),(27,'Editar qr','EDIT_QR','Qr','','2016-06-10 11:01:21',NULL,1),(46,'Crear video','CREATE_VIDEO','Video',NULL,'2016-06-30 05:11:47',NULL,1),(47,'Editar video','EDIT_VIDEO','Video',NULL,'2016-06-30 05:11:47',NULL,1),(48,'Eliminar video','DELETE_VIDEO','Video',NULL,'2016-06-30 05:11:47',NULL,1),(49,'Listar video','LIST_VIDEO','Video',NULL,'2016-06-30 05:11:47',NULL,1),(50,'Crear config email','CREATE_CONFIGURATION_EMAIL','Email',NULL,'2016-06-30 12:44:04',NULL,1),(51,'Editar config email','EDIT_CONFIGURATION_EMAIL','Email',NULL,'2016-06-30 12:44:04',NULL,1),(52,'Eliminar config email','DELETE_CONFIGURATION_EMAIL','Email',NULL,'2016-06-30 12:44:04',NULL,1),(53,'Listar config email','LIST_CONFIGURATION_EMAIL','Email',NULL,'2016-06-30 12:44:04',NULL,1),(54,'recibir notificaciones por email','RECEIVE_NOTIFICATIONS_BY_EMAIL','Email','','2016-07-03 05:03:57',NULL,1),(55,'Crear archivos','CREATE_FILES','Archivos',NULL,'0000-00-00 00:00:00',NULL,1),(56,'Eliminar archivos','DELETE_FILES','Archivos',NULL,'0000-00-00 00:00:00',NULL,1),(57,'Listar archivos','LIST_FILES','Archivos',NULL,'0000-00-00 00:00:00',NULL,1),(58,'Editar archivos','EDIT_FILES','Archivos',NULL,'0000-00-00 00:00:00',NULL,1),(59,'Crear formulario','CREATE_FORM','Formulario',NULL,'0000-00-00 00:00:00',NULL,1),(60,'Eliminar formulario','DELETE_FORM','Formulario',NULL,'0000-00-00 00:00:00',NULL,1),(61,'Listar formulario','LIST_FORM','Formulario',NULL,'0000-00-00 00:00:00',NULL,1),(62,'Editar formulario','EDIT_FORM','Formulario',NULL,'0000-00-00 00:00:00',NULL,1),(63,'Crear evento','CREATE_EVENT','Evento',NULL,'0000-00-00 00:00:00',NULL,1),(64,'Eliminar evento','DELETE_EVENT','Evento',NULL,'0000-00-00 00:00:00',NULL,1),(65,'Listar evento','LIST_EVENT','Evento',NULL,'0000-00-00 00:00:00',NULL,1),(66,'Editar evento','EDIT_EVENT','Evento',NULL,'0000-00-00 00:00:00',NULL,1),(67,'Crear floorplan','CREATE_FLOORPLAN','Floor planning',NULL,'0000-00-00 00:00:00',NULL,1),(68,'Eliminar floorplan','DELETE_FLOORPLAN','Floor planning',NULL,'0000-00-00 00:00:00',NULL,1),(69,'Listar floorplan','LIST_FLOORPLAN','Floor planning',NULL,'0000-00-00 00:00:00',NULL,1),(70,'Editar floorplan','EDIT_FLOORPLAN','Floor planning',NULL,'0000-00-00 00:00:00',NULL,1);
/*!40000 ALTER TABLE `permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_increment`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (1,'administrador','0000-00-00 00:00:00','2016-07-30 18:53:06',1),(2,'Gerente','2016-08-02 23:49:03',NULL,1),(3,'Asistente de Gerencia','2016-08-02 23:50:26',NULL,1),(4,'Mozo','2016-08-02 23:55:58',NULL,1);
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile_has_permission`
--

DROP TABLE IF EXISTS `profile_has_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile_has_permission` (
  `profile_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`profile_id`,`permission_id`),
  KEY `fk_profile_has_permission_permission1_idx` (`permission_id`),
  KEY `fk_profile_has_permission_profile1_idx` (`profile_id`),
  CONSTRAINT `fk_profile_has_permission_permission1` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_profile_has_permission_profile1` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile_has_permission`
--

LOCK TABLES `profile_has_permission` WRITE;
/*!40000 ALTER TABLE `profile_has_permission` DISABLE KEYS */;
INSERT INTO `profile_has_permission` VALUES (1,1,NULL,NULL),(1,2,NULL,NULL),(1,5,NULL,NULL),(1,6,NULL,NULL),(1,14,NULL,NULL),(1,15,NULL,NULL),(1,16,NULL,NULL),(1,17,NULL,NULL),(1,18,NULL,NULL),(1,19,NULL,NULL),(1,20,NULL,NULL),(1,21,NULL,NULL),(1,22,NULL,NULL),(1,23,NULL,NULL),(1,24,NULL,NULL),(1,25,NULL,NULL),(1,26,NULL,NULL),(1,27,NULL,NULL),(1,46,NULL,NULL),(1,47,NULL,NULL),(1,48,NULL,NULL),(1,49,NULL,NULL),(1,50,NULL,NULL),(1,51,NULL,NULL),(1,52,NULL,NULL),(1,53,NULL,NULL),(1,54,NULL,NULL),(1,55,NULL,NULL),(1,56,NULL,NULL),(1,57,NULL,NULL),(1,58,NULL,NULL),(1,59,NULL,NULL),(1,60,NULL,NULL),(1,61,NULL,NULL),(1,62,NULL,NULL),(1,63,NULL,NULL),(1,64,NULL,NULL),(1,65,NULL,NULL),(1,66,NULL,NULL),(1,67,NULL,NULL),(1,68,NULL,NULL),(1,69,NULL,NULL),(1,70,NULL,NULL),(2,1,NULL,NULL),(2,2,NULL,NULL),(2,5,NULL,NULL),(2,6,NULL,NULL),(2,14,NULL,NULL),(2,15,NULL,NULL),(2,16,NULL,NULL),(2,17,NULL,NULL),(2,18,NULL,NULL),(2,19,NULL,NULL),(2,20,NULL,NULL),(2,21,NULL,NULL),(2,22,NULL,NULL),(2,23,NULL,NULL),(2,24,NULL,NULL),(2,25,NULL,NULL),(2,26,NULL,NULL),(2,27,NULL,NULL),(2,46,NULL,NULL),(2,47,NULL,NULL),(2,48,NULL,NULL),(2,49,NULL,NULL),(2,50,NULL,NULL),(2,51,NULL,NULL),(2,52,NULL,NULL),(2,53,NULL,NULL),(2,54,NULL,NULL),(2,55,NULL,NULL),(2,56,NULL,NULL),(2,57,NULL,NULL),(2,58,NULL,NULL),(2,59,NULL,NULL),(2,60,NULL,NULL),(2,61,NULL,NULL),(2,62,NULL,NULL),(2,63,NULL,NULL),(2,64,NULL,NULL),(2,65,NULL,NULL),(2,66,NULL,NULL),(2,67,NULL,NULL),(2,68,NULL,NULL),(2,69,NULL,NULL),(2,70,NULL,NULL),(3,1,NULL,NULL),(3,2,NULL,NULL),(3,6,NULL,NULL),(3,14,NULL,NULL),(3,15,NULL,NULL),(3,16,NULL,NULL),(3,17,NULL,NULL),(3,18,NULL,NULL),(3,19,NULL,NULL),(3,20,NULL,NULL),(3,21,NULL,NULL),(3,22,NULL,NULL),(3,23,NULL,NULL),(3,24,NULL,NULL),(3,25,NULL,NULL),(3,26,NULL,NULL),(3,27,NULL,NULL),(3,46,NULL,NULL),(3,47,NULL,NULL),(3,48,NULL,NULL),(3,49,NULL,NULL),(3,50,NULL,NULL),(3,51,NULL,NULL),(3,52,NULL,NULL),(3,53,NULL,NULL),(3,54,NULL,NULL),(3,55,NULL,NULL),(3,56,NULL,NULL),(3,57,NULL,NULL),(3,58,NULL,NULL),(3,59,NULL,NULL),(3,60,NULL,NULL),(3,61,NULL,NULL),(3,62,NULL,NULL),(3,63,NULL,NULL),(3,64,NULL,NULL),(3,65,NULL,NULL),(3,66,NULL,NULL),(3,67,NULL,NULL),(3,68,NULL,NULL),(3,69,NULL,NULL),(3,70,NULL,NULL);
/*!40000 ALTER TABLE `profile_has_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `qr`
--

DROP TABLE IF EXISTS `qr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `qr` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `cht` varchar(45) NOT NULL DEFAULT 'qr',
  `chl` text NOT NULL,
  `chs` varchar(45) NOT NULL,
  `choe` varchar(45) DEFAULT NULL,
  `chld` varchar(45) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_increment`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `qr`
--

LOCK TABLES `qr` WRITE;
/*!40000 ALTER TABLE `qr` DISABLE KEYS */;
INSERT INTO `qr` VALUES (1,'qr','343434','500x500','UTF-8','L','2016-07-23 23:01:36',NULL,1),(2,'qr','eeeee','500x500','UTF-8','L','2016-08-02 23:54:24',NULL,1);
/*!40000 ALTER TABLE `qr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `session` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(45) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_increment`,`user_id`),
  KEY `fk_session_user1_idx` (`user_id`),
  CONSTRAINT `fk_session_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session`
--

LOCK TABLES `session` WRITE;
/*!40000 ALTER TABLE `session` DISABLE KEYS */;
/*!40000 ALTER TABLE `session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `terms_conditions`
--

DROP TABLE IF EXISTS `terms_conditions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `terms_conditions` (
  `id_increment` int(11) NOT NULL,
  `title` varchar(500) DEFAULT NULL,
  `body` text NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_increment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `terms_conditions`
--

LOCK TABLES `terms_conditions` WRITE;
/*!40000 ALTER TABLE `terms_conditions` DISABLE KEYS */;
/*!40000 ALTER TABLE `terms_conditions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `device_code` varchar(100) DEFAULT NULL,
  `device_os` enum('ANDROID','IOS') DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `salt` varchar(45) DEFAULT NULL,
  `dni` varchar(8) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `image` varchar(45) DEFAULT NULL,
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_increment`,`profile_id`),
  UNIQUE KEY `dni_UNIQUE` (`dni`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `fk_user_profile1_idx` (`profile_id`),
  CONSTRAINT `fk_user_profile1` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,1,'admin',NULL,'ANDROID','Z8ltFA6Wnd6nIYRNKNouRsCdBKHn4zTK5N3tDCJGro5j78Lj3QazJGgL/HSOMLQEqwOTlauMqEJvU7Nbppt8wg==','ifvkpiz1mn4ksgc80wk0koo4wswsg4o','88865786','alan','garcia',NULL,NULL,NULL,NULL,NULL,'0000-00-00 00:00:00','2016-07-21 00:43:03',1);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video`
--

DROP TABLE IF EXISTS `video`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video` (
  `id_increment` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `body` text,
  `youtube_url` text NOT NULL,
  `youtube_id` varchar(45) DEFAULT NULL,
  `youtube_thumbnail` varchar(100) DEFAULT NULL,
  `youtube_duration` varchar(45) DEFAULT NULL,
  `youtube_title` text,
  `youtube_description` text,
  `youtube_viewCount` varchar(45) DEFAULT NULL,
  `access` enum('private','public') NOT NULL DEFAULT 'private',
  `created` datetime NOT NULL,
  `updated` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_increment`,`user_id`),
  KEY `fk_video_user1_idx` (`user_id`),
  CONSTRAINT `fk_video_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_increment`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video`
--

LOCK TABLES `video` WRITE;
/*!40000 ALTER TABLE `video` DISABLE KEYS */;
/*!40000 ALTER TABLE `video` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-25 10:27:47
