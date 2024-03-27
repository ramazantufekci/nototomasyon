-- MySQL dump 10.13  Distrib 5.5.30, for Win64 (x86)
--
-- Host: localhost    Database: nototomasyon
-- ------------------------------------------------------
-- Server version	5.5.30

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
-- Table structure for table `ogrenci_notlari`
--

DROP TABLE IF EXISTS `ogrenci_notlari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ogrenci_notlari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ogrenci_no` varchar(20) NOT NULL,
  `ders_adi` varchar(100) NOT NULL,
  `donem` varchar(50) NOT NULL,
  `ders_notu` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ogrenci_notlari`
--

LOCK TABLES `ogrenci_notlari` WRITE;
/*!40000 ALTER TABLE `ogrenci_notlari` DISABLE KEYS */;
INSERT INTO `ogrenci_notlari` VALUES (2,'123','MAtematik','2',32),(3,'123','Türkçe','1',70);
/*!40000 ALTER TABLE `ogrenci_notlari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ogrenciler`
--

DROP TABLE IF EXISTS `ogrenciler`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ogrenciler` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(50) NOT NULL,
  `soyad` varchar(50) NOT NULL,
  `ogrenci_no` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ogrenciler`
--

LOCK TABLES `ogrenciler` WRITE;
/*!40000 ALTER TABLE `ogrenciler` DISABLE KEYS */;
INSERT INTO `ogrenciler` VALUES (3,'Ramazan','TUFEKCI','571');
/*!40000 ALTER TABLE `ogrenciler` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad` varchar(90) DEFAULT NULL,
  `soyad` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(156) DEFAULT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Ramazan','TUFEKCI','ramazan@radyobilge.com','$2y$10$.T.d8HVP4hPpbh5lkfKsCutrPMKmNqqtTOOQqts/gxLzwqaA4OPY2','0'),(2,'Ramazan','TUFEKCI','ramazan@radyobilge.com','$2y$10$6ooFFb.D9tpcjXEJBfX2vOLoMoUJ5sVZlHYmPQOOXHK/L3un9ZBxW','0'),(3,'Ramazan','TUFEKCI','ramazan@radyobilge.com','$2y$10$3fR.ZIOH.7bOxeVS/0fjneKT.o91HKw96Gg.KT2fxhtCluZDMbwKy','0'),(4,'Ramazan','TUFEKCI','ramazan@radyobilge.com','$2y$10$uL0rny1yBLJ7FXgcMMlaSeHcH7VqppNAEuYbt4t30k7PNYSv2Wihu','0'),(5,'Ramazan','TUFEKCI','ramazan@df.com','c20ad4d76fe97759aa27a0c99bff6710','user'),(6,'Ramazan','TUFEKCI','ramazan@dg.com','$2y$10$2XGvEn./m7NO//bGWTKGK.7gRtrXM1SxGl.mKv9GCOSIVWQmRUWei','user'),(7,'Ramazan','TUFEKCI','ramazan@a.com','$2y$10$wVZO5e50emNKTfh2vxNoruUbEAZrMnXUZ67IRRuVvik7JjN/4MA/O','user'),(8,'Ramazan','TUFEKCI','ramazan@b.com','$2y$10$znCLN2NgG0cYn71SwRsgiuXeMMZExfcgKbQTJJ8dU.HogPAVJ5kje','user');
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

-- Dump completed on 2024-03-27 17:08:17
