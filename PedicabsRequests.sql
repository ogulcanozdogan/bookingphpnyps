/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.6.19-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: PedicabsRequests
-- ------------------------------------------------------
-- Server version	10.6.19-MariaDB-cll-lve

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
  `down_payment` varchar(150) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scheduled_a_to_b_requests`
--

LOCK TABLES `scheduled_a_to_b_requests` WRITE;
/*!40000 ALTER TABLE `scheduled_a_to_b_requests` DISABLE KEYS */;
INSERT INTO `scheduled_a_to_b_requests` (`id`, `requestNumber`, `first_name`, `last_name`, `email`, `phone_number`, `num_passengers`, `pick_up_date`, `hours`, `minutes`, `am_pm`, `pick_up_address`, `destination_address`, `down_payment`, `payment_method`, `created_at`) VALUES (27,'2024-09-07-11-30-2024-08-30-10-46-b77c6adf1ac11c67','alyssa','golub','alyssa.golub@gmail.com','+12014524738','2 (1 Pedicab)','2024-09-07',11,'30','am','240 Central Park S, New York, NY 10019 (Marea)','West Drive near, W 81st St, New York, NY 10024 (Winterdale Arch)','','CASH','2024-08-30 17:46:48'),(29,'2024-10-04-21-00-2024-09-03-11-07-c400eb1000e06adb','Suzanne','Schwartz','suzys1148@gmail.com','+19176478044','6 (2 Pedicabs)','2024-10-04',9,'00','pm','473 West End Ave, New York, NY 10024','151 East 78th Street, 9','','CASH','2024-09-03 18:07:53'),(30,'2024-10-04-21-00-2024-09-03-15-52-8c9ee38857346028','Suzanne','Schwartz','suzys1148@gmail.com','+19176478044','6 (2 Pedicabs)','2024-10-04',9,'00','pm','473 West End Ave, New York, NY 10024','151 East 78th Street, 9','','CASH','2024-09-03 22:52:21'),(31,'2024-10-12-08-00-2024-09-11-02-15-06a0d0a1ab39a70a','Rebecca','Michaud','slomathgirl@gmail.com','+18054598626','3 (1 Pedicab)','2024-10-12',8,'00','am','60 W 37th St, New York, NY 10018','Go through Times Square Go to Rockefeller Center  Then on to Central Park.  We don&#039;t need to see everything, but we&#039;d like to see: The Cherry Hills Fountain; Belvedere Castle, and maybe the Model Boat Sailing.  Anything else we see along the way would be nice too but not required. And a drop off at Wollman Rink at the end (preferably by 10am ish if possible)','','CASH','2024-09-11 09:15:53'),(32,'2024-09-13-22-00-2024-09-12-06-16-346f1d3f8bdb64d7','Adele','Laboz','labozadele@gmail.com','+16466450261','2 (1 Pedicab)','2024-09-13',10,'00','pm','10 South St, New York, NY 10004 (Casa Cipriani New York)','310 W Broadway, New York, NY 10013 (Soho Grand Hotel)','','fullcard','2024-09-12 13:16:28'),(33,'2024-10-19-18-30-2024-09-19-20-24-f55541c0f5808096','Virginia','Cook','virginiacooknyc@gmail.com','+19178165102','2 (1 Pedicab)','2024-10-19',6,'30','pm','865 Madison Ave, New York, NY 10021 (St James&#039; Church)','564 Park Ave, New York, NY 10065 (The Colony Club)','','CASH','2024-09-20 03:24:15'),(34,'2024-09-27-10-00-2024-09-20-06-47-859b12e7b7628057','Lee','Baker','leelovesemail@gmail.com','+447860785957','1 (1 Pedicab)','2024-09-27',10,'00','am','Loch Walking Path &amp;, East Dr, New York, NY 10026 (Huddlestone Arch)','New York, NY 10024 (Bethesda Terrace)','','CASH','2024-09-20 13:47:21'),(35,'2024-11-03-17-30-2024-09-29-19-16-a5733362ce8ee724','Samantha','Devine','samdvine@gmail.com','+19178364110','2 (1 Pedicab)','2024-11-03',5,'30','pm','Columbus Circle, Columbus Circle, New York, NY, USA','50 Lexington Ave, New York, NY 10010','','card','2024-09-30 02:16:02'),(43,'2024-10-02-21-30-2024-10-01-10-03-33d066dc405e39f7','Sammy','Sabbagh','sammysabbagh@gmail.com','+19175799833','3 (1 Pedicab)','2024-10-02',9,'30','pm','2255 East 7th Street, Brooklyn, NY, USA','1511 East 2nd Street, Brooklyn, NY, USA','','fullcard','2024-10-01 17:03:13');
/*!40000 ALTER TABLE `scheduled_a_to_b_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scheduled_central_requests`
--

DROP TABLE IF EXISTS `scheduled_central_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scheduled_central_requests` (
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
  `service_duration` varchar(555) NOT NULL,
  `pick_up_address` text NOT NULL,
  `destination_address` text NOT NULL,
  `service_details` text NOT NULL,
  `down_payment` varchar(150) NOT NULL,
  `payment_method` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scheduled_central_requests`
--

LOCK TABLES `scheduled_central_requests` WRITE;
/*!40000 ALTER TABLE `scheduled_central_requests` DISABLE KEYS */;
INSERT INTO `scheduled_central_requests` (`id`, `requestNumber`, `first_name`, `last_name`, `email`, `phone_number`, `num_passengers`, `pick_up_date`, `hours`, `minutes`, `am_pm`, `service_duration`, `pick_up_address`, `destination_address`, `service_details`, `down_payment`, `payment_method`, `created_at`) VALUES (3,'2024-11-09-10-00-2024-10-01-04-06-f84914dfd49df565','mark ','schofield ','schofie83@aol.com','+4407973396062','2 (1 Pedicab)','2024-11-09',10,'00','am','1','Columbus Circle, New York, NY, USA','Columbus Circle, New York, NY, USA','Dacota building ','','card','2024-10-01 11:06:21'),(8,'2024-10-05-11-30-2024-10-03-14-58-8166ba8076844baf','Thao','Ngu ','codai2410@gmail.com','+19293955891','3 (1 Pedicab)','2024-10-05',11,'30','am','3 Hours','Central Park, New York, NY, USA','Battery Park, New York, NY, USA','9/11 Building, world trade central, trinity church, century 21, group of 4 trees','','card','2024-10-03 21:58:38'),(9,'2024-10-04-12-00-2024-10-03-19-59-29f5aff07b93b7e0','Kelsey','Kintz','kkintz34@yahoo.com','+12607605687','1 (1 Pedicab)','2024-10-04',12,'00','pm','1 Hour','Central Park, New York, NY, USA','Central Park, New York, NY, USA','N/a','','CASH','2024-10-04 02:59:50'),(13,'2024-12-28-10-15-2024-10-16-20-07-9d1b7f9451d59b49','Elizabeth','Milton','bethmilton49@gmail.com','+14843518784','9 (3 Pedicabs)','2024-12-28',10,'15','am','90 Minutes','American Museum of Natural History, Central Park West, New York, NY, USA','West 72nd Street, New York, NY, USA','  I am interested in the Middle Loop','venmo','CASH','2024-10-17 03:07:37'),(14,'2024-10-20-14-45-2024-10-20-13-36-55393bf9f860b311','Zoey','Laird','zoey.laird@gmail.com','+14709199644','2 (1 Pedicab)','2024-10-20',2,'45','pm','90 Minutes','Amsterdam Avenue &amp; West 111th Street, New York, NY, USA','Lyceum Theatre, West 45th Street, New York, NY, USA','Me and my grandma \r\nBoth about average size ','card','CASH','2024-10-20 20:36:56');
/*!40000 ALTER TABLE `scheduled_central_requests` ENABLE KEYS */;
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
  `service_duration` varchar(555) NOT NULL,
  `pick_up_address` text NOT NULL,
  `destination_address` text NOT NULL,
  `service_details` text NOT NULL,
  `down_payment` varchar(150) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scheduled_hourly_requests`
--

LOCK TABLES `scheduled_hourly_requests` WRITE;
/*!40000 ALTER TABLE `scheduled_hourly_requests` DISABLE KEYS */;
INSERT INTO `scheduled_hourly_requests` (`id`, `requestNumber`, `first_name`, `last_name`, `email`, `phone_number`, `num_passengers`, `pick_up_date`, `hours`, `minutes`, `am_pm`, `service_duration`, `pick_up_address`, `destination_address`, `service_details`, `down_payment`, `payment_method`, `created_at`) VALUES (16,'2024-10-19-13-00-2024-10-16-23-49-7e93fd2893704518','Sajid','Ahmed','dijas4611@gmail.com','+17088975550','2 (1 Pedicab)','2024-10-19',1,'00','pm','1 Hour','41-50 78th Street, Elmhurst, NY, USA','30-99 48th Ave, Long Island City, NY 11101, USA','Ride from residence in elmhurst nyc to gantry park','zelle','CASH','2024-10-17 06:49:44'),(17,'2024-11-07-12-00-2024-11-05-18-54-97736fc758aeca44','julia','koenig','juliekoenigfl@aol.com','+119545997828','1 (1 Pedicab)','2024-11-07',12,'00','pm','90 Minutes','Lotte New York Palace, Madison Avenue, New York, NY, USA','Diamond District, Manhattan, New York, NY, USA','SIGHTSEEING','zelle','CASH','2024-11-06 01:54:11');
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

-- Dump completed on 2024-11-08 11:44:12
