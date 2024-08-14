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
  `phone_number` varchar(20) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scheduled_a_to_b_requests`
--

LOCK TABLES `scheduled_a_to_b_requests` WRITE;
/*!40000 ALTER TABLE `scheduled_a_to_b_requests` DISABLE KEYS */;
INSERT INTO `scheduled_a_to_b_requests` (`id`, `requestNumber`, `first_name`, `last_name`, `email`, `phone_number`, `num_passengers`, `pick_up_date`, `hours`, `minutes`, `am_pm`, `pick_up_address`, `destination_address`, `payment_method`, `created_at`) VALUES (3,'2024-08-29-19-00-2024-08-10-16-12-9a084a7a750f98ec','ibooo','ibram','ibrahimdonmez1983@gmail.com','+11231231231','3','2024-08-29',7,'00','pm','2807 E Busch Blvd, Tampa, FL 33612','4407 Perch St, Tampa, FL 33617','card','2024-08-10 23:12:11'),(4,'2024-08-22-19-00-2024-08-10-16-12-6f256954d68c68b1','ibooo','ibram','ibrahimdonmez1983@gmail.com','+11231231231','3','2024-08-22',7,'00','pm','Tampa, FL 33613','7801 N 22nd St, Tampa, FL 33610 (22nd Street Park Disc Golf Course)','card','2024-08-10 23:12:52'),(5,'2024-08-12-13-00-2024-08-12-11-57-bd175f74b5e2950c','deneme1 ','soyad1','ffarukkurt3@gmail.com','+12029824915','1','2024-08-12',1,'00','pm','45 E 45th St, New York, NY 10017, Amerika Birle?ik Devletleri','315 W 44th St #5402, New York, NY 10036, Amerika Birle?ik Devletleri','CASH','2024-08-12 18:57:25'),(6,'2024-08-21-16-00-2024-08-12-12-06-db5a5c961f747b2a','deneme','deneme','ogulcanozdogan@gmail.com','+16562002544','2','2024-08-21',4,'00','pm','Anna Maria Island, Florida','Gainesville, FL','CASH','2024-08-12 19:06:47'),(7,'2024-08-18-13-15-2024-08-12-12-10-73f93c4e2b21f2b7','deneme2','kurt','ffarukkurt3@gmail.com','+12029824915','1','2024-08-18',1,'15','pm','45 E 45th St, New York, NY 10017, Amerika Birle?ik Devletleri','315 W 44th St #5402, New York, NY 10036, Amerika Birle?ik Devletleri','CASH','2024-08-12 19:10:44'),(8,'2024-08-12-13-30-2024-08-12-12-19-5a15fd378d4f60d1','denme333','kurt','ffarukkurt3@gmail.com','+12029824915','1','2024-08-12',1,'30','pm','45 E 45th St, New York, NY 10017, Amerika Birle?ik Devletleri','315 W 44th St #5402, New York, NY 10036, Amerika Birle?ik Devletleri','CASH','2024-08-12 19:19:16'),(9,'2024-08-21-19-30-2024-08-12-13-42-b681da5e418f2f0e','asdasd','asdasd','ogulcanozdogan@gmail.com','+11231231231','10','2024-08-21',7,'30','pm','7801 N 22nd St, Tampa, FL 33610 (22nd Street Park Disc Golf Course)','4014 W South Ave, Tampa, FL 33614 (DAS Autowerks)','fullcard','2024-08-12 20:42:22'),(10,'2024-08-22-14-15-2024-08-12-13-45-eaab83d7c41be1eb','asd','asd','ogulcanozdogan@gmail.com','+16562002544','10 (4 Pedicabs)','2024-08-22',2,'15','pm','3500 E Fletcher Ave, Tampa, FL 33613','10001 McKinley Dr, Tampa, FL 33612 (Adventure Island)','fullcard','2024-08-12 20:45:04'),(11,'2024-08-12-15-15-2024-08-12-13-57-98138b6dd8698883','denemeeeeee','faafaf','ffarukkurt3@gmail.com','+12029824915','12 (4 Pedicabs)','2024-08-12',3,'15','pm','45 E 45th St, New York, NY 10017, Amerika Birle?ik Devletleri','153 W 57th St, New York, NY 10019, Amerika Birle?ik Devletleri','CASH','2024-08-12 20:57:29'),(12,'2024-08-21-16-30-2024-08-12-18-13-e7f3dda3cfccc296','asd','das','asd@asd.asd','+11231231231','2 (1 Pedicab)','2024-08-21',4,'30','pm','4500 E Fletcher Ave, Tampa, FL 33613','Tampa, FL 33612','CASH','2024-08-13 01:13:56'),(13,'2024-08-22-16-15-2024-08-13-11-10-38a35a1f04c8e986','asd','das','ogulcanozdogan@gmail.com','+11231321231','3 (1 Pedicab)','2024-08-22',4,'15','pm','4500 E Fletcher Ave, Tampa, FL 33613','3011 University Center Dr, Tampa, FL 33612','CASH','2024-08-13 18:10:12'),(14,'1970-01-01-00-minutes-2024-08-13-11-15-9feafb9552840533','1d3d2d231d2dd4','1d3d2d231d2dd4','example_email@example.com','+1tel','Secure123456$','1970-01-01',0,'mi','am','1d3d2d231d2dd4','1d3d2d231d2dd4','CASH','2024-08-13 18:15:26'),(15,'2024-08-20-15-30-2024-08-13-11-46-de7461e1fe783396','asd','das','asd@asd.asd','+16562002544','2 (1 Pedicab)','2024-08-20',3,'30','pm','5450 E Busch Blvd, Temple Terrace, FL 33617','3011 University Center Dr, Tampa, FL 33612','card','2024-08-13 18:46:27'),(16,'2024-08-13-14-00-2024-08-13-12-00-f8a2b5c99c02029e','hbhbhbhbhbhbhbhbhbhbhbhbhbhbhbhbhbhbhbhbhbhbhbhbhbhbhbhbhbhbhhbhbhb','bhbhbhbhbhhbhbhbhbhbhbhbhbhbhbhbhbhbhbhbhbhhbhbhbhbhbhb','ffarukkurt3@gmail.com','+12029824915','3 (1 Pedicab)','2024-08-13',2,'00','pm','45 E 45th St, New York, NY 10017, Amerika Birle?ik Devletleri','325 W 15th St, New York, NY 10011, Amerika Birle?ik Devletleri','CASH','2024-08-13 19:00:21'),(17,'2024-08-15-17-30-2024-08-13-12-05-92aecc9231013eb6','asd','dsa','asd@asd.asd','+11231231231','3 (1 Pedicab)','2024-08-15',5,'30','pm','4500 E Fletcher Ave, Tampa, FL 33613','3011 University Center Dr, Tampa, FL 33612','CASH','2024-08-13 19:05:03'),(18,'2024-08-22-17-00-2024-08-13-12-23-aaff3b0eb14f5c88','sdasdasdasdsdasdasdasdsdasdasdasdsdasdasdasdsdasda','sdasdasdasdsdasdasdasdsdasdasdasdsdasdasdasdsdasda','asd@asd.asd','+16562002544','3 (1 Pedicab)','2024-08-22',5,'00','pm','4241 E Busch Blvd, Tampa, FL 33617','5802 N 30th St, Tampa, FL 33610','CASH','2024-08-13 19:23:31'),(19,'2024-08-21-15-00-2024-08-13-12-50-5b8f182eec1d505d','asd','da','asd@asd.asd','+112312312312','3 (1 Pedicab)','2024-08-21',3,'00','pm','4500 E Fletcher Ave, Tampa, FL 33613','3011 University Center Dr, Tampa, FL 33612','CASH','2024-08-13 19:50:37'),(20,'2024-08-14-13-00-2024-08-13-15-03-27cc8f35817ea26b','nsnsns','hNNnN','ffarukkurt3@gmail.com','+12029824915','1 (1 Pedicab)','2024-08-14',1,'00','pm','45 E 45th St. New York. NY 10017','125 Worth St. New York. NY 10013','CASH','2024-08-13 22:03:17'),(21,'2024-08-30-13-00-2024-08-13-15-57-58cfd0ac3895c817','asd','das','asd@asd.asd','+1235235235','3 (1 Pedicab)','2024-08-30',1,'00','pm','45 E 45th St, New York, NY 10017','260 Meserole St, Brooklyn, NY 11206 (3 Dollar Bill)','CASH','2024-08-13 22:57:27'),(22,'2024-08-14-13-00-2024-08-13-15-58-8bb8d8bf054df187','adasdasdadasdasdadasdasdadasdasdadasdasdadasdasdad','adasdasdadasdasdadasdasdadasdasdadasdasdadasdasdad','ffarukkurt3@gmail.com','+12029824915','1 (1 Pedicab)','2024-08-14',1,'00','pm','45 E 45th St, New York, NY 10017, Amerika Birle?ik Devletleri','315 W 44th St #5402, New York, NY 10036, Amerika Birle?ik Devletleri','CASH','2024-08-13 22:58:32'),(23,'2024-08-23-15-00-2024-08-13-16-15-3b151fefc8d3239e','asd','das','asd@asd.asd','+1123124124','2 (1 Pedicab)','2024-08-23',3,'00','pm','4510 Oak Fair Blvd, Tampa, FL 33610','3500 E Fletcher Ave, Tampa, FL 33613','CASH','2024-08-13 23:15:30'),(24,'2024-08-14-15-00-2024-08-13-16-17-0b735e7c38840338','asdasdasdasdasdasdadasdasdasdasdasdasdasdasdasdasd','asdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdas','ffarukkurt3@gmail.com','+12029824915','2 (1 Pedicab)','2024-08-14',3,'00','pm','45 E 45th St, New York, NY 10017, Amerika Birle?ik Devletleri','315 W 44th St #5402, New York, NY 10036, Amerika Birle?ik Devletleri','CASH','2024-08-13 23:17:59'),(25,'2024-08-21-16-15-2024-08-13-16-34-8a4c29c2ea7c4a32','asdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdas','asdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdas','asdasdasdasdasdasdasdasdasdasasdasdas@gasdf.asdasd','+1562342342343523456','5 (2 Pedicabs)','2024-08-21',4,'15','pm','4241 E Busch Blvd, Tampa, FL 33617','3000 Medical Park Dr, Tampa, FL 33613','CASH','2024-08-13 23:34:56'),(26,'2024-08-14-14-00-2024-08-14-10-58-2d1ef3b94ea03175','amememeememme me eme memmemmememmeme ememmemememem','memememememe emememememem emememmemem emememmememe','ffaadksmdkalsdlasmdamdamdalkdalkdmalksdm@gmail.com','+12029824915','1 (1 Pedicab)','2024-08-14',2,'00','pm','45 E 45th St, New York, NY 10017, Amerika Birle?ik Devletleri','315 W 44th St #5402, New York, NY 10036, Amerika Birle?ik Devletleri','CASH','2024-08-14 17:58:27');
/*!40000 ALTER TABLE `scheduled_a_to_b_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scheduled_hourly_requests`
--

DROP TABLE IF EXISTS `scheduled_hourly_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scheduled_hourly_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `requestNumber` varchar(555) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `num_passengers` varchar(250) NOT NULL,
  `pick_up_date` varchar(555) NOT NULL,
  `hours` int(11) NOT NULL,
  `minutes` varchar(2) NOT NULL,
  `am_pm` varchar(2) NOT NULL,
  `service_duration` int(11) NOT NULL,
  `pick_up_address` text NOT NULL,
  `destination_address` text NOT NULL,
  `service_details` text NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scheduled_hourly_requests`
--

LOCK TABLES `scheduled_hourly_requests` WRITE;
/*!40000 ALTER TABLE `scheduled_hourly_requests` DISABLE KEYS */;
INSERT INTO `scheduled_hourly_requests` (`id`, `requestNumber`, `first_name`, `last_name`, `email`, `phone_number`, `num_passengers`, `pick_up_date`, `hours`, `minutes`, `am_pm`, `service_duration`, `pick_up_address`, `destination_address`, `service_details`, `payment_method`, `created_at`) VALUES (1,'1970-01-01-00-minutes-2024-08-13-11-16-93d484b76906975f','1d3d2d231d2dd4','1d3d2d231d2dd4','example_email@example.com','+1tel','Secure123456$','1970-01-01',0,'mi','am',0,'1d3d2d231d2dd4','1d3d2d231d2dd4','serviceDetails','CASH','2024-08-13 18:16:43'),(2,'2024-08-22-17-00-2024-08-13-11-44-760063f45d17a419','asd','das','asd@asd.asd','+16562002544','4 (2 Pedicabs)','2024-08-22',5,'00','pm',90,'4500 E Fletcher Ave, Tampa, FL 33613','3011 University Center Dr, Tampa, FL 33612','asd','CASH','2024-08-13 18:44:20'),(3,'2024-08-13-15-00-2024-08-13-12-20-a56c508af39aa187','nanananananananananananananananananananananananananananananananananannanananananana','nanananananananananananananananananananananananananananananananananannanananananana','ffarukkurt3@gmail.com','+12029824915','2 (1 Pedicab)','2024-08-13',3,'00','pm',2,'45 E 45th St, New York, NY 10017, Amerika Birle?ik Devletleri','325W W 42nd St, New York, NY 10036, Amerika Birle?ik Devletleri','aa','CASH','2024-08-13 19:20:51'),(4,'2024-08-22-17-15-2024-08-13-16-27-54943a2fb1001573','asdasd','asdasd','asdasd@asdasd.asdasd','+1123123123123','5 (2 Pedicabs)','2024-08-22',5,'15','pm',2,'5802 N 30th St, Tampa, FL 33610','2701 E Fletcher Ave, Tampa, FL 33612','asdsad','CASH','2024-08-13 23:27:53'),(5,'2024-08-14-15-00-2024-08-13-16-31-981bfcd1c53d2a54','asdadas','asdads','asdasdasdasdasdasdaasdasdsdasd@gmail.com','+1512512512512512512','5 (2 Pedicabs)','2024-08-14',3,'00','pm',90,'3000 Medical Park Dr, Tampa, FL 33613','4241 E Busch Blvd, Tampa, FL 33617','asdasd','CASH','2024-08-13 23:31:09'),(6,'2024-08-16-15-00-2024-08-13-16-31-dcbb9da5a46e8f90','asdadas','asdads','asdasdasdasdasdasdaasdasdsdasd@gmail.com','+1512512512512512512','5 (2 Pedicabs)','2024-08-16',3,'00','pm',90,'3000 Medical Park Dr, Tampa, FL 33613','4241 E Busch Blvd, Tampa, FL 33617','asdasd','CASH','2024-08-13 23:31:24'),(7,'2024-08-15-13-15-2024-08-13-16-33-a8e40cafaa305619','asdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdsa','dasdasdasdasdasdasdasdasdasdasdsadasdasdasdasdasda','ffarukkurt3sadasdasdasdasdasdasdasdasdas@gmail.com','+12029824915','2 (1 Pedicab)','2024-08-15',1,'15','pm',2,'45 E 45th St, New York, NY 10017, Amerika Birle?ik Devletleri','315 W 44th St #5402, New York, NY 10036, Amerika Birle?ik Devletleri','adsd','CASH','2024-08-13 23:33:05'),(8,'2024-08-22-14-00-2024-08-13-16-52-f39e094cb148e444','asd','das','asd@asd.as','+1523423523523234','6 (2 Pedicabs)','2024-08-22',2,'00','pm',90,'4500 E Fletcher Ave, Tampa, FL 33613','3000 Medical Park Dr, Tampa, FL 33613','asd','CASH','2024-08-13 23:52:13'),(9,'2024-08-23-17-45-2024-08-13-16-54-6295f2048bc5d160','asd','das','asd@asd.asd','+1423423442342344234','3 (1 Pedicab)','2024-08-23',5,'45','pm',2,'4500 E Fletcher Ave, Tampa, FL 33613','3000 Medical Park Dr, Tampa, FL 33613','asdasd','CASH','2024-08-13 23:54:45'),(10,'2024-08-14-14-00-2024-08-14-10-40-8fcad9c8c1291384','dedededededededededededededededeededededededededed','deedededededededededededededededededededededededed','ffarukkur333333333333333333333333t333333@gmail.com','+12029824915','1 (1 Pedicab)','2024-08-14',2,'00','pm',1,'45 E 45th St, New York, NY 10017, Amerika Birle?ik Devletleri','315 W 44th St #5402, New York, NY 10036, Amerika Birle?ik Devletleri','wqw','CASH','2024-08-14 17:40:49');
/*!40000 ALTER TABLE `scheduled_hourly_requests` ENABLE KEYS */;
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

-- Dump completed on 2024-08-14  8:06:26
