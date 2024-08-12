/*!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.6.18-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: PedicabsRequests
-- ------------------------------------------------------
-- Server version	10.6.18-MariaDB-cll-lve

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `PedicabsRequests`
--


--
-- Table structure for table `scheduled_a_to_b_requests`
--

DROP TABLE IF EXISTS `scheduled_a_to_b_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scheduled_a_to_b_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `requestNumber` varchar(555) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `num_passengers` varchar(250) NOT NULL,
  `pick_up_date` varchar(555) NOT NULL,
  `hours` int(11) NOT NULL,
  `minutes` varchar(2) NOT NULL,
  `am_pm` varchar(2) NOT NULL,
  `pick_up_address` text NOT NULL,
  `destination_address` text NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scheduled_a_to_b_requests`
--

LOCK TABLES `scheduled_a_to_b_requests` WRITE;
/*!40000 ALTER TABLE `scheduled_a_to_b_requests` DISABLE KEYS */;
INSERT INTO `scheduled_a_to_b_requests` (`id`, `requestNumber`, `first_name`, `last_name`, `email`, `phone_number`, `num_passengers`, `pick_up_date`, `hours`, `minutes`, `am_pm`, `pick_up_address`, `destination_address`, `payment_method`, `created_at`) VALUES (3,'2024-08-29-19-00-2024-08-10-16-12-9a084a7a750f98ec','ibooo','ibram','ibrahimdonmez1983@gmail.com','+11231231231','3','2024-08-29',7,'00','pm','2807 E Busch Blvd, Tampa, FL 33612','4407 Perch St, Tampa, FL 33617','card','2024-08-10 23:12:11'),(4,'2024-08-22-19-00-2024-08-10-16-12-6f256954d68c68b1','ibooo','ibram','ibrahimdonmez1983@gmail.com','+11231231231','3','2024-08-22',7,'00','pm','Tampa, FL 33613','7801 N 22nd St, Tampa, FL 33610 (22nd Street Park Disc Golf Course)','card','2024-08-10 23:12:52'),(5,'2024-08-12-13-00-2024-08-12-11-57-bd175f74b5e2950c','deneme1 ','soyad1','ffarukkurt3@gmail.com','+12029824915','1','2024-08-12',1,'00','pm','45 E 45th St, New York, NY 10017, Amerika Birle?ik Devletleri','315 W 44th St #5402, New York, NY 10036, Amerika Birle?ik Devletleri','CASH','2024-08-12 18:57:25'),(6,'2024-08-21-16-00-2024-08-12-12-06-db5a5c961f747b2a','deneme','deneme','ogulcanozdogan@gmail.com','+16562002544','2','2024-08-21',4,'00','pm','Anna Maria Island, Florida','Gainesville, FL','CASH','2024-08-12 19:06:47'),(7,'2024-08-18-13-15-2024-08-12-12-10-73f93c4e2b21f2b7','deneme2','kurt','ffarukkurt3@gmail.com','+12029824915','1','2024-08-18',1,'15','pm','45 E 45th St, New York, NY 10017, Amerika Birle?ik Devletleri','315 W 44th St #5402, New York, NY 10036, Amerika Birle?ik Devletleri','CASH','2024-08-12 19:10:44'),(8,'2024-08-12-13-30-2024-08-12-12-19-5a15fd378d4f60d1','denme333','kurt','ffarukkurt3@gmail.com','+12029824915','1','2024-08-12',1,'30','pm','45 E 45th St, New York, NY 10017, Amerika Birle?ik Devletleri','315 W 44th St #5402, New York, NY 10036, Amerika Birle?ik Devletleri','CASH','2024-08-12 19:19:16'),(9,'2024-08-21-19-30-2024-08-12-13-42-b681da5e418f2f0e','asdasd','asdasd','ogulcanozdogan@gmail.com','+11231231231','10','2024-08-21',7,'30','pm','7801 N 22nd St, Tampa, FL 33610 (22nd Street Park Disc Golf Course)','4014 W South Ave, Tampa, FL 33614 (DAS Autowerks)','fullcard','2024-08-12 20:42:22'),(10,'2024-08-22-14-15-2024-08-12-13-45-eaab83d7c41be1eb','asd','asd','ogulcanozdogan@gmail.com','+16562002544','10 (4 Pedicabs)','2024-08-22',2,'15','pm','3500 E Fletcher Ave, Tampa, FL 33613','10001 McKinley Dr, Tampa, FL 33612 (Adventure Island)','fullcard','2024-08-12 20:45:04');
/*!40000 ALTER TABLE `scheduled_a_to_b_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'PedicabsRequests'
--

--
-- Dumping routines for database 'PedicabsRequests'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-12 10:50:14
