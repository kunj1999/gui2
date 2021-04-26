-- MySQL dump 10.13  Distrib 8.0.23, for Linux (x86_64)
--
-- Host: localhost    Database: ETutor
-- ------------------------------------------------------
-- Server version	8.0.23-0ubuntu0.20.10.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `avail`
--

DROP TABLE IF EXISTS `avail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `avail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(110) DEFAULT NULL,
  `day` varchar(45) DEFAULT NULL,
  `startTime` time DEFAULT NULL,
  `endTime` time DEFAULT NULL,
  `zoomLink` varchar(110) DEFAULT NULL,
  `subjects` varchar(110) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avail`
--

LOCK TABLES `avail` WRITE;
/*!40000 ALTER TABLE `avail` DISABLE KEYS */;
INSERT INTO `avail` VALUES (35,'RonPestov2869','Monday','10:00:00','11:00:00','https://www.google.com/','Math'),(36,'EricRamos1507','Monday','14:00:00','15:00:00','https://www.google.com/','Web Development');
/*!40000 ALTER TABLE `avail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registered`
--

DROP TABLE IF EXISTS `registered`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `registered` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(110) DEFAULT NULL,
  `startTime` datetime DEFAULT NULL,
  `endTime` datetime DEFAULT NULL,
  `notes` longtext,
  `zoomLink` varchar(110) DEFAULT NULL,
  `tutorUsername` varchar(110) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registered`
--

LOCK TABLES `registered` WRITE;
/*!40000 ALTER TABLE `registered` DISABLE KEYS */;
INSERT INTO `registered` VALUES (49,'RonPestov2869','2021-04-19 10:00:00','2021-04-19 11:00:00',NULL,'https://www.google.com/','RonPestov2869'),(50,'RonPestov2869','2021-04-26 10:00:00','2021-04-26 11:00:00',NULL,'https://www.google.com/','RonPestov2869'),(51,'RonPestov2869','2021-05-03 10:00:00','2021-05-03 11:00:00',NULL,'https://www.google.com/','RonPestov2869'),(52,'RonPestov2869','2021-05-10 10:00:00','2021-05-10 11:00:00',NULL,'https://www.google.com/','RonPestov2869'),(53,'RonPestov2869','2021-05-17 10:00:00','2021-05-17 11:00:00',NULL,'https://www.google.com/','RonPestov2869'),(54,'RonPestov2869','2021-05-24 10:00:00','2021-05-24 11:00:00',NULL,'https://www.google.com/','RonPestov2869'),(55,'RonPestov2869','2021-05-31 10:00:00','2021-05-31 11:00:00',NULL,'https://www.google.com/','RonPestov2869'),(56,'RonPestov2869','2021-06-07 10:00:00','2021-06-07 11:00:00',NULL,'https://www.google.com/','RonPestov2869'),(57,'RonPestov2869','2021-06-14 10:00:00','2021-06-14 11:00:00',NULL,'https://www.google.com/','RonPestov2869'),(58,'EricRamos1507','2021-04-26 14:00:00','2021-04-26 15:00:00',NULL,'https://www.google.com/','EricRamos1507'),(59,'EricRamos1507','2021-05-03 14:00:00','2021-05-03 15:00:00',NULL,'https://www.google.com/','EricRamos1507'),(60,'EricRamos1507','2021-05-10 14:00:00','2021-05-10 15:00:00',NULL,'https://www.google.com/','EricRamos1507'),(61,'EricRamos1507','2021-05-17 14:00:00','2021-05-17 15:00:00',NULL,'https://www.google.com/','EricRamos1507'),(62,'EricRamos1507','2021-05-24 14:00:00','2021-05-24 15:00:00',NULL,'https://www.google.com/','EricRamos1507'),(63,'EricRamos1507','2021-05-31 14:00:00','2021-05-31 15:00:00',NULL,'https://www.google.com/','EricRamos1507'),(64,'EricRamos1507','2021-06-07 14:00:00','2021-06-07 15:00:00',NULL,'https://www.google.com/','EricRamos1507'),(65,'EricRamos1507','2021-06-14 14:00:00','2021-06-14 15:00:00',NULL,'https://www.google.com/','EricRamos1507'),(66,'EricRamos1507','2021-06-21 14:00:00','2021-06-21 15:00:00',NULL,'https://www.google.com/','EricRamos1507'),(73,'KunjPatel1417','2021-04-26 10:00:00','2021-04-26 11:00:00',NULL,'https://www.google.com/','RonPestov2869'),(74,'KunjPatel1417','2021-06-07 10:00:00','2021-06-07 11:00:00',NULL,'https://www.google.com/','RonPestov2869');
/*!40000 ALTER TABLE `registered` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `username` varchar(110) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `pass` varchar(45) DEFAULT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `isTutor` tinyint(1) DEFAULT NULL,
  `review` json DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('EricRamos1507','E@gmail.com','1234','Eric','Ramos',1,'[]'),('KunjPatel1417','kunj@gmail.com','1234','Kunj','Patel',0,NULL),('RonPestov2869','ron@gmail.com','1234','Ron','Pestov',1,'[{\"rating\": \"4\", \"comments\": \"AAA\"}, {\"rating\": \"3\", \"comments\": \"1234\"}, {\"rating\": \"5\", \"comments\": \"Great work!\"}, {\"rating\": \"1\", \"comments\": \"Great Help!\"}]');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-25 20:14:00
