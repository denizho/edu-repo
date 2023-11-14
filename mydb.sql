-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: localhost    Database: mydb
-- ------------------------------------------------------
-- Server version	8.0.26

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categ`
--

DROP TABLE IF EXISTS `categ`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categ` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kat` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categ`
--

LOCK TABLES `categ` WRITE;
/*!40000 ALTER TABLE `categ` DISABLE KEYS */;
INSERT INTO `categ` VALUES (1,'Nike'),(2,'Jordan'),(3,'adidas');
/*!40000 ALTER TABLE `categ` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `predp_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_orders_predp_idx` (`predp_id`),
  CONSTRAINT `fk_orders_predp` FOREIGN KEY (`predp_id`) REFERENCES `predp` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,'Заказ1',1),(2,'Заказ2',2),(3,'Заказ3',3);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `predp`
--

DROP TABLE IF EXISTS `predp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `predp` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `imgpred` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `predp`
--

LOCK TABLES `predp` WRITE;
/*!40000 ALTER TABLE `predp` DISABLE KEYS */;
INSERT INTO `predp` VALUES (1,'StreetBeat','Москва, Щелковской шоссе, Дом 23',NULL),(2,'SuperStep','Москва, ул. Парковая 4-я, дом 10',NULL),(3,'SportMaster','Москва, Сиреневый бульвар, дом 3',NULL);
/*!40000 ALTER TABLE `predp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prod`
--

DROP TABLE IF EXISTS `prod`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prod` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `categ_id` int DEFAULT NULL,
  `price` int DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_prod_categ1_idx` (`categ_id`),
  CONSTRAINT `fk_prod_categ1` FOREIGN KEY (`categ_id`) REFERENCES `categ` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prod`
--

LOCK TABLES `prod` WRITE;
/*!40000 ALTER TABLE `prod` DISABLE KEYS */;
INSERT INTO `prod` VALUES (1,'Air Max Plus',1,45000,'http://localhost/my-repo-main/images/1.png'),(2,'1 Retro High OG SP',2,30002,'http://localhost/my-repo-main/images/2.png'),(3,'Campus 00s',3,70000,'http://localhost/my-repo-main/images/3.png');
/*!40000 ALTER TABLE `prod` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sklad`
--

DROP TABLE IF EXISTS `sklad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sklad` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kol` int DEFAULT NULL,
  `date_in` date DEFAULT NULL,
  `prod_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sklad_prod1_idx` (`prod_id`),
  CONSTRAINT `fk_sklad_prod1` FOREIGN KEY (`prod_id`) REFERENCES `prod` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sklad`
--

LOCK TABLES `sklad` WRITE;
/*!40000 ALTER TABLE `sklad` DISABLE KEYS */;
INSERT INTO `sklad` VALUES (1,51,'2023-05-03',1),(2,12,'2023-05-04',2),(3,1002,'2023-05-07',3);
/*!40000 ALTER TABLE `sklad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specif`
--

DROP TABLE IF EXISTS `specif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `specif` (
  `id` int NOT NULL AUTO_INCREMENT,
  `orders_id` int NOT NULL,
  `prod_id` int NOT NULL,
  `kolord` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_specif_orders1_idx` (`orders_id`),
  KEY `fk_specif_prod_idx` (`prod_id`),
  CONSTRAINT `fk_specif_orders1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `fk_specif_prod` FOREIGN KEY (`prod_id`) REFERENCES `prod` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specif`
--

LOCK TABLES `specif` WRITE;
/*!40000 ALTER TABLE `specif` DISABLE KEYS */;
INSERT INTO `specif` VALUES (1,1,1,2),(2,2,2,3),(3,3,3,1);
/*!40000 ALTER TABLE `specif` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-14 14:25:17
