/*!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.6.18-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: PedicabsScheduled
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
-- Current Database: `PedicabsScheduled`
--


--
-- Table structure for table `ayarlar`
--

DROP TABLE IF EXISTS `ayarlar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ayarlar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sitebasligi` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `siteaciklamasi` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `siteurl` varchar(55) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `dil` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ayarlar`
--

LOCK TABLES `ayarlar` WRITE;
/*!40000 ALTER TABLE `ayarlar` DISABLE KEYS */;
INSERT INTO `ayarlar` (`id`, `sitebasligi`, `siteaciklamasi`, `siteurl`, `dil`) VALUES (1,'New York Pedicab Services','New York Pedicab Services provides Central Park Pedicab Tours, Point A to Point B Pedicab Rides, Hourly Pedicab Services, Pedicab Rentals and Pedicab Advertising. New York Pedicab Services offers a professional, reliable, friendly and fun pedicab experience.','https://newyorkpedicabservices.com/dashboard-scheduled/',0);
/*!40000 ALTER TABLE `ayarlar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `centralpark`
--

DROP TABLE IF EXISTS `centralpark`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `centralpark` (
  `id` binary(16) NOT NULL,
  `bookingNumber` varchar(555) NOT NULL,
  `numberOfPassengers` int(11) NOT NULL,
  `date` varchar(555) NOT NULL,
  `hour` int(11) NOT NULL,
  `minutes` int(11) NOT NULL,
  `ampm` varchar(555) NOT NULL,
  `destinationAddress` text NOT NULL,
  `destinationCoords` text NOT NULL,
  `paymentMethod` varchar(555) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(555) NOT NULL,
  `emailAddress` text NOT NULL,
  `phoneNumber` varchar(555) NOT NULL,
  `bookingFee` float NOT NULL,
  `driverFee` float NOT NULL,
  `totalFare` float NOT NULL,
  `createdAt` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `duration` varchar(555) NOT NULL,
  `pickupAddress` text NOT NULL,
  `pickUpCoords` text NOT NULL,
  `returnDuration` text NOT NULL,
  `pickUpDuration` text NOT NULL,
  `hub` text NOT NULL,
  `hubCoords` text NOT NULL,
  `baseFare` float NOT NULL,
  `operationFare` float NOT NULL,
  `status` varchar(555) NOT NULL DEFAULT 'available',
  `driver` varchar(555) DEFAULT NULL,
  `sms_sent` int(11) NOT NULL DEFAULT 0,
  `totalMinutes` float NOT NULL,
  `unique_id` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `centralpark`
--

LOCK TABLES `centralpark` WRITE;
/*!40000 ALTER TABLE `centralpark` DISABLE KEYS */;
INSERT INTO `centralpark` (`id`, `bookingNumber`, `numberOfPassengers`, `date`, `hour`, `minutes`, `ampm`, `destinationAddress`, `destinationCoords`, `paymentMethod`, `firstName`, `lastName`, `emailAddress`, `phoneNumber`, `bookingFee`, `driverFee`, `totalFare`, `createdAt`, `updated_at`, `duration`, `pickupAddress`, `pickUpCoords`, `returnDuration`, `pickUpDuration`, `hub`, `hubCoords`, `baseFare`, `operationFare`, `status`, `driver`, `sms_sent`, `totalMinutes`, `unique_id`) VALUES ('3b3e7f9cc42399df','2024-08-08-11-45-2024-08-08-11-33-3b3e7f9cc42399df',1,'08/08/2024',11,45,'AM','153 W 57th St, New York, NY 10019, Amerika Birle?ik Devletleri','40.7655285,-73.9790084','CASH','central','ldm','ffarukkurt3@gmail.com','+12029824915',6.19,24.75,60.94,'2024-08-08 11:33:32','2024-08-08 12:35:00','50.375','308 W 58th St, New York, NY 10019, Amerika Birle?ik Devletleri','40.7675589,-73.9831177','','','','',0,30.94,'past','farukkurt2',1,61.875,'4b85bdabdd983bffdb908de84c757a08'),('5e59c682a798973d','2024-08-15-15-15-2024-08-09-11-10-5e59c682a798973d',1,'08/15/2024',3,15,'PM','30 Rockefeller Plaza, New York, NY 10112, USA','40.7593755,-73.9799726','CASH','IBRAHIM','Radovanovic','ibrahimdonmez1983@yahoo.com','+12129617435',9.61,38.42,78.03,'2024-08-09 11:10:34',NULL,'66.875','45 E 45th St, New York, NY 10017, USA','40.7549394,-73.9772689','','','','',0,48.03,'available',NULL,0,96.05,'3ce10be074d18e6a399f5b71a862972b'),('9699509a83b672d7','2024-08-18-13-00-2024-08-08-12-01-9699509a83b672d7',2,'08/18/2024',1,0,'PM','308 W 58th St, New York, NY 10019, Amerika Birle?ik Devletleri','40.7675589,-73.9831177','CASH','asdasd','asdasd','ffarukkurt3@gmail.com','+12029824915',7.22,28.88,71.09,'2024-08-08 12:01:34',NULL,'51.5','153 W 57th St, New York, NY 10019, Amerika Birle?ik Devletleri','40.7655285,-73.9790084','','','','',0,36.09,'available',NULL,0,61.875,'fdf063073ac78373e8c2af54276ddf70');
/*!40000 ALTER TABLE `centralpark` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hourly`
--

DROP TABLE IF EXISTS `hourly`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hourly` (
  `id` binary(16) NOT NULL,
  `bookingNumber` varchar(555) NOT NULL,
  `numberOfPassengers` int(11) NOT NULL,
  `date` varchar(555) NOT NULL,
  `hour` int(11) NOT NULL,
  `minutes` int(11) NOT NULL,
  `ampm` varchar(555) NOT NULL,
  `destinationAddress` text NOT NULL,
  `destinationCoords` text NOT NULL,
  `paymentMethod` varchar(555) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(555) NOT NULL,
  `emailAddress` text NOT NULL,
  `phoneNumber` varchar(555) NOT NULL,
  `bookingFee` float NOT NULL,
  `driverFee` float NOT NULL,
  `totalFare` float NOT NULL,
  `createdAt` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `duration` varchar(555) NOT NULL,
  `pickupAddress` text NOT NULL,
  `pickUpCoords` text NOT NULL,
  `returnDuration` text NOT NULL,
  `pickUpDuration` text NOT NULL,
  `hub` text NOT NULL,
  `hubCoords` text NOT NULL,
  `baseFare` float NOT NULL,
  `operationFare` float NOT NULL,
  `status` varchar(555) NOT NULL DEFAULT 'available',
  `driver` varchar(555) NOT NULL,
  `sms_sent` int(11) NOT NULL DEFAULT 0,
  `serviceDetails` text NOT NULL,
  `serviceDuration` varchar(500) NOT NULL,
  `totalMinutes` float NOT NULL,
  `unique_id` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hourly`
--

LOCK TABLES `hourly` WRITE;
/*!40000 ALTER TABLE `hourly` DISABLE KEYS */;
INSERT INTO `hourly` (`id`, `bookingNumber`, `numberOfPassengers`, `date`, `hour`, `minutes`, `ampm`, `destinationAddress`, `destinationCoords`, `paymentMethod`, `firstName`, `lastName`, `emailAddress`, `phoneNumber`, `bookingFee`, `driverFee`, `totalFare`, `createdAt`, `updated_at`, `duration`, `pickupAddress`, `pickUpCoords`, `returnDuration`, `pickUpDuration`, `hub`, `hubCoords`, `baseFare`, `operationFare`, `status`, `driver`, `sms_sent`, `serviceDetails`, `serviceDuration`, `totalMinutes`, `unique_id`) VALUES ('b4bbeb2796038b3e','2024-08-08-11-45-2024-08-08-11-33-b4bbeb2796038b3e',1,'08/08/2024',11,45,'AM','153 W 57th St, New York, NY 10019, Amerika Birle?ik Devletleri','40.7655285,-73.9790084','CASH','hourly','sad','ffarukkurt3@gmail.com','+12029824915',10.56,42.23,52.79,'2024-08-08 11:33:28','2024-08-08 12:19:00','1.98','308 W 58th St, New York, NY 10019, Amerika Birle?ik Devletleri','40.7675589,-73.9831177','7.075','8.5','','',30,0,'past','farukkurt2',1,'as','30 Minutes',45.575,'053d14c514ec391f801f6d82baf75819'),('e414941c13aed2c8','2024-08-14-15-00-2024-08-09-11-12-e414941c13aed2c8',3,'08/14/2024',3,0,'PM','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',15.25,61,76.25,'2024-08-09 11:12:06','0000-00-00 00:00:00','4.17','45 E 45th St, New York, NY 10017','40.7549394,-73.9772689','12.375','20.125','','',30,0,'available','',0,'sd','1 Hour',92.5,'43854496c889eb42cd4129bab87d8c23');
/*!40000 ALTER TABLE `hourly` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pointatob`
--

DROP TABLE IF EXISTS `pointatob`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pointatob` (
  `id` binary(16) NOT NULL,
  `bookingNumber` varchar(555) NOT NULL,
  `numberOfPassengers` int(11) NOT NULL,
  `date` varchar(555) NOT NULL,
  `hour` int(11) NOT NULL,
  `minutes` int(11) NOT NULL,
  `ampm` varchar(555) NOT NULL,
  `destinationAddress` text NOT NULL,
  `destinationCoords` text NOT NULL,
  `paymentMethod` varchar(555) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(555) NOT NULL,
  `emailAddress` text NOT NULL,
  `phoneNumber` varchar(555) NOT NULL,
  `bookingFee` float NOT NULL,
  `driverFee` float NOT NULL,
  `totalFare` float NOT NULL,
  `createdAt` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `duration` varchar(555) NOT NULL,
  `pickupAddress` text NOT NULL,
  `pickUpCoords` text NOT NULL,
  `returnDuration` text NOT NULL,
  `pickUpDuration` text NOT NULL,
  `hub` text NOT NULL,
  `hubCoords` text NOT NULL,
  `baseFare` float NOT NULL,
  `operationFare` float NOT NULL,
  `status` varchar(555) NOT NULL DEFAULT 'available',
  `driver` varchar(555) NOT NULL,
  `sms_sent` int(11) NOT NULL DEFAULT 0,
  `totalMinutes` float NOT NULL,
  `unique_id` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pointatob`
--

LOCK TABLES `pointatob` WRITE;
/*!40000 ALTER TABLE `pointatob` DISABLE KEYS */;
INSERT INTO `pointatob` (`id`, `bookingNumber`, `numberOfPassengers`, `date`, `hour`, `minutes`, `ampm`, `destinationAddress`, `destinationCoords`, `paymentMethod`, `firstName`, `lastName`, `emailAddress`, `phoneNumber`, `bookingFee`, `driverFee`, `totalFare`, `createdAt`, `updated_at`, `duration`, `pickupAddress`, `pickUpCoords`, `returnDuration`, `pickUpDuration`, `hub`, `hubCoords`, `baseFare`, `operationFare`, `status`, `driver`, `sms_sent`, `totalMinutes`, `unique_id`) VALUES ('7923742a1622cfec','2024-08-08-11-45-2024-08-08-11-33-7923742a1622cfec',1,'08/08/2024',11,45,'AM','153 W 57th St, New York, NY 10019, Amerika Birle?ik Devletleri','40.7655285,-73.9790084','CASH','pointatob','ad','ffarukkurt3@gmail.com','+12029824915',9,36,45,'2024-08-08 11:33:36','2024-08-08 11:53:00','4.95','308 W 58th St, New York, NY 10019, Amerika Birle?ik Devletleri','40.7675589,-73.9831177','6.325','8.5','West Drive and West 59th Street New York, NY 10019','40.766941088678855, -73.97899952992152',30,9.89,'past','farukkurt2',1,19.775,'8991d99063ce510b0207a83fcd738b5d'),('94c83f57cba977ee','2024-08-08-14-00-2024-08-08-11-13-94c83f57cba977ee',1,'08/08/2024',2,0,'PM','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',10.29,41.17,51.46,'2024-08-08 08:13:44','2024-08-08 11:57:00','10.42','45 E 45th St, New York, NY 10017','40.7549394,-73.9772689','12.375','20.125','West Drive and West 59th Street New York, NY 10019','40.766941088678855, -73.97899952992152',30,21.46,'past','ogulcan',1,42.92,'4f84788acc7121f1fef423700e9645e3');
/*!40000 ALTER TABLE `pointatob` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temporaryBookings`
--

DROP TABLE IF EXISTS `temporaryBookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temporaryBookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unique_id` varchar(150) NOT NULL,
  `num_passengers` int(11) NOT NULL,
  `pick_up_address` varchar(255) NOT NULL,
  `destination_address` varchar(255) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `booking_fee` decimal(10,2) NOT NULL,
  `driver_fare` decimal(10,2) NOT NULL,
  `total_fare` decimal(10,2) NOT NULL,
  `ride_duration` varchar(50) DEFAULT NULL,
  `return_duration` varchar(50) DEFAULT NULL,
  `operation_fare` decimal(10,2) DEFAULT NULL,
  `pickup1` varchar(255) DEFAULT NULL,
  `pickup2` varchar(255) DEFAULT NULL,
  `return1` varchar(255) DEFAULT NULL,
  `return2` varchar(255) DEFAULT NULL,
  `toursuresi` varchar(50) DEFAULT NULL,
  `hourly_operation_fare` decimal(10,2) DEFAULT NULL,
  `tour_duration` varchar(50) DEFAULT NULL,
  `country_code` varchar(10) DEFAULT NULL,
  `country_name` varchar(100) DEFAULT NULL,
  `service_details` text DEFAULT NULL,
  `hub` varchar(255) DEFAULT NULL,
  `pick_up_duration` varchar(50) DEFAULT NULL,
  `service_duration` varchar(50) DEFAULT NULL,
  `base_fare` varchar(55) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `pick_up_date` varchar(255) DEFAULT NULL,
  `hours` varchar(255) DEFAULT NULL,
  `minutes` varchar(255) DEFAULT NULL,
  `ampm` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temporaryBookings`
--

LOCK TABLES `temporaryBookings` WRITE;
/*!40000 ALTER TABLE `temporaryBookings` DISABLE KEYS */;
INSERT INTO `temporaryBookings` (`id`, `unique_id`, `num_passengers`, `pick_up_address`, `destination_address`, `payment_method`, `first_name`, `last_name`, `email`, `phone_number`, `booking_fee`, `driver_fare`, `total_fare`, `ride_duration`, `return_duration`, `operation_fare`, `pickup1`, `pickup2`, `return1`, `return2`, `toursuresi`, `hourly_operation_fare`, `tour_duration`, `country_code`, `country_name`, `service_details`, `hub`, `pick_up_duration`, `service_duration`, `base_fare`, `created_at`, `pick_up_date`, `hours`, `minutes`, `ampm`) VALUES (20,'03152a9d1ae39e80c101e59c3b0cc452',2,'45 E 45th St, New York, NY 10017, USA','30 Rockefeller Plaza, New York, NY 10112, USA','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',9.60,38.38,77.98,'66.875','',47.98,'20.075','15.625','11.25','9','4.18',NULL,'40','376',NULL,NULL,NULL,NULL,NULL,'30','2024-08-05 16:31:05','08/15/2024','3','00','PM'),(21,'c8001294b626e07fd3d77045f519fb65',2,'45 E 45th St, New York, NY 10017','30 Rockefeller Plaza, New York, NY 10112','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',40.87,95.36,136.23,'4.18','12.375',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,'asd',NULL,'20.075','3','30','2024-08-05 17:21:20','08/22/2024','1','15','PM'),(22,'1970aa5e25a40c4bec9b55b994b9a145',3,'45 E 45th St, New York, NY 10017','30 Rockefeller Plaza, New York, NY 10112','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',9.00,36.00,45.00,'10.45','2.825',11.05,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'376',NULL,NULL,NULL,NULL,NULL,'30','2024-08-05 17:53:13','08/29/2024','4','15','PM'),(23,'b2e99d0be30ca58b3af886dc47a099c7',1,'45 E 45th St, New York, NY 10017','30 Rockefeller Plaza, New York, NY 10112','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',10.29,41.16,51.45,'10.45','12.375',21.45,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'44',NULL,NULL,NULL,NULL,NULL,'30','2024-08-05 17:56:43','08/15/2024','3','30','PM'),(24,'8e42bf4169cf8f12a314548380dec3f7',2,'45 E 45th St, New York, NY 10017','30 Rockefeller Plaza, New York, NY 10112','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',10.29,41.16,51.45,'10.45','12.375',21.45,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'44',NULL,NULL,NULL,NULL,NULL,'30','2024-08-05 18:00:33','08/15/2024','2','00','PM'),(25,'10f6717cf797f67d4cd817b3d7c2d012',2,'45 E 45th St, New York, NY 10017','30 Rockefeller Plaza, New York, NY 10112','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',10.29,41.16,51.45,'10.45','12.375',21.45,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'44',NULL,NULL,NULL,NULL,NULL,'30','2024-08-05 18:06:11','08/13/2024','2','00','PM'),(26,'c5bcc0c89f25dd75fea3f253167b781e',2,'45 E 45th St, New York, NY 10017','30 Rockefeller Plaza, New York, NY 10112','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',10.29,41.16,51.45,'10.45','12.375',21.45,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'44',NULL,NULL,NULL,NULL,NULL,'30','2024-08-05 18:25:46','08/28/2024','3','00','PM'),(27,'a53fec0115efdedd982070f1b11e0460',2,'45 E 45th St, New York, NY 10017','30 Rockefeller Plaza, New York, NY 10112','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',10.29,41.16,51.45,'10.45','12.375',21.45,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'44',NULL,NULL,NULL,NULL,NULL,'30','2024-08-05 18:25:54','08/28/2024','3','00','PM'),(28,'d9d4c9fc62a522a9481d51d5c2ea2026',2,'45 E 45th St, New York, NY 10017','30 Rockefeller Plaza, New York, NY 10112','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',10.29,41.16,51.45,'10.45','12.375',21.45,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'44',NULL,NULL,NULL,NULL,NULL,'30','2024-08-05 18:26:05','08/28/2024','3','00','PM'),(29,'7f99da36ff6e5e08ac296b049ceea0cc',3,'45 E 45th St, New York, NY 10017','30 Rockefeller Plaza, New York, NY 10112','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',10.29,41.16,51.45,'10.45','12.375',21.45,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,'30','2024-08-05 18:27:35','08/22/2024','2','00','PM'),(30,'d4e8be58380357907512483bd87b4583',3,'45 E 45th St, New York, NY 10017','30 Rockefeller Plaza, New York, NY 10112','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',10.29,41.16,51.45,'10.45','12.375',21.45,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019',NULL,NULL,'30','2024-08-05 18:31:06','08/22/2024','2','00','PM'),(31,'47b9c973b7f76cf9bc3a54c9cac1a8e2',3,'4 Charles St #3004, New York, NY 10014 (4 Charles Prime Rib)','35 Wall St, New York, NY 10038','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',21.30,85.20,106.50,'41.37','77.875',76.50,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'44',NULL,NULL,'West Drive and West 59th Street New York, NY 10019',NULL,NULL,'30','2024-08-05 18:31:47','08/13/2024','3','15','PM'),(32,'ca1248c5e48718b69a68876831c5b34d',3,'4 Charles St #3004, New York, NY 10014 (4 Charles Prime Rib)','35 Wall St, New York, NY 10038','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',21.30,85.20,106.50,'41.37','77.875',76.50,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'44',NULL,NULL,'West Drive and West 59th Street New York, NY 10019',NULL,NULL,'30','2024-08-05 18:32:44','08/13/2024','3','15','PM'),(33,'c49f0ea5ee6702da72201baa7566eb35',3,'4 Charles St #3004, New York, NY 10014 (4 Charles Prime Rib)','35 Wall St, New York, NY 10038','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',21.30,85.20,106.50,'41.37','77.875',76.50,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'44',NULL,NULL,'West Drive and West 59th Street New York, NY 10019',NULL,NULL,'30','2024-08-05 18:32:56','08/13/2024','3','15','PM'),(34,'ef98f46aec903c1aa22b316ec4b5d56d',2,'4 Charles St #3004, New York, NY 10014 (4 Charles Prime Rib)','30 Rockefeller Plaza, New York, NY 10112','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',13.92,55.68,69.60,'33.07','12.375',39.60,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','33.75',NULL,'30','2024-08-05 18:34:16','08/15/2024','3','00','PM'),(35,'cf7b9c8763eebc6a410d9b599112c633',2,'725 10th Ave, New York, NY 10019, Amerika Birle?ik Devletleri','455 Madison Ave, New York, NY 10022, Amerika Birle?ik Devletleri (Lotte New York Palace Hotel)','CASH','centralpark','scheduled','ffarukkurt3@gmail.com','2029824915',10.35,41.40,81.75,'75.775','',51.75,'15.55','19.575','16.2','12.175','7.63',NULL,'40','1',NULL,NULL,NULL,NULL,NULL,'30','2024-08-05 18:40:27','08/06/2024','1','00','PM'),(36,'3f609dc3cb6da1c99d853e589dc97eb5',2,'725 10th Ave, New York, NY 10019, Amerika Birle?ik Devletleri','455 Madison Ave, New York, NY 10022, Amerika Birle?ik Devletleri (Lotte New York Palace Hotel)','CASH','centralpark','scheduled','ffarukkurt3@gmail.com','2029824915',10.35,41.40,81.75,'75.775','',51.75,'15.55','19.575','16.2','12.175','7.63',NULL,'40','1',NULL,NULL,NULL,NULL,NULL,'30','2024-08-05 18:40:28','08/06/2024','1','00','PM'),(37,'bc61e12736c11ff9145c077b5d9570b0',1,'41 E 42nd St, New York, NY 10017, Amerika Birle?ik Devletleri','725 10th Ave, New York, NY 10019, Amerika Birle?ik Devletleri','CASH','denemeqwqw','adasdasd','ffarukkurt3@gmail.com','2029824915',13.43,53.72,97.15,'91.85','',67.15,'22.95','16.3','15.55','19.5','8.72',NULL,'60','1',NULL,NULL,NULL,NULL,NULL,'30','2024-08-06 17:51:22','08/07/2024','1','00','PM'),(38,'3807f45c32c6e110e8a2877b3bbc809f',1,'725 10th Ave, New York, NY 10019, Amerika Birle?ik Devletleri','455 Madison Ave, New York, NY 10022, Amerika Birle?ik Devletleri (Lotte New York Palace Hotel)','CASH','sdasdasdasdasdsadsadas','dasdsadasdasdsadad','ffarukkurt3@gmail.com','2029824915',11.02,44.06,55.08,'19.05','15.55',25.08,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','15.55',NULL,'30','2024-08-06 17:51:35','08/07/2024','1','00','PM'),(39,'dce34b0d4d9ed10fb4604c5f58c3e6c1',1,'455 Madison Ave, New York, NY 10022, Amerika Birle?ik Devletleri (Lotte New York Palace Hotel)','725 10th Ave, New York, NY 10019, Amerika Birle?ik Devletleri','CASH','asdasda','dsasdasd','ffarukkurt3@gmail.com','2029824915',12.39,49.55,61.94,'7.80','17.675',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,'asd',NULL,'16.2','30','30','2024-08-06 17:51:52','08/07/2024','1','00','PM'),(40,'e4c5b715da1e3b08ce26d636490df0e9',1,'217 E 51st St, New York, NY 10022, Amerika Birle?ik Devletleri','525 W 50th St, New York, NY 10019, Amerika Birle?ik Devletleri','CASH','centralpark','scheduled','ffarukkurt3@gmail.com','2029824915',16.93,67.70,119.63,'99.45','',84.63,'24.25','19.875','19.575','21.375','12.38',NULL,'60','1',NULL,NULL,NULL,NULL,NULL,'35','2024-08-06 19:16:27','08/09/2024','2','00','PM'),(41,'fca82c7f67bbce818b57078211601fa2',1,'525 W 50th St, New York, NY 10019, Amerika Birle?ik Devletleri','217 E 51st St, New York, NY 10022, Amerika Birle?ik Devletleri','CASH','pointatob','scheduled','ffarukkurt3@gmail.com','2029824915',15.68,62.72,78.40,'31.57','23.25',43.40,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','19.575',NULL,'35','2024-08-06 19:16:49','08/09/2024','2','15','PM'),(42,'e3158b5a7d00d3f595244cf3e851a471',1,'217 E 51st St, New York, NY 10022, Amerika Birle?ik Devletleri','525 W 50th St, New York, NY 10019, Amerika Birle?ik Devletleri','CASH','hourly','scheduled','ffarukkurt3@gmail.com','2029824915',33.89,79.08,112.98,'12.38','19.425',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,'asdad',NULL,'24.25','90','35','2024-08-06 19:17:06','08/09/2024','2','30','PM'),(43,'cf4cab75ec81b924ce551d0b0da0c9de',1,'725 10th Ave, New York, NY 10019, Amerika Birle?ik Devletleri','455 Madison Ave, New York, NY 10022, Amerika Birle?ik Devletleri (Lotte New York Palace Hotel)','CASH','scheduled ','centralpark','ffarukkurt3@gmail.com','2029824915',14.42,57.67,107.09,'95.825','',72.09,'15.55','19.625','16.2','12.2','7.62',NULL,'60','1',NULL,NULL,NULL,NULL,NULL,'35','2024-08-07 15:48:14','08/10/2024','1','00','PM'),(44,'e932655877a1f6216d774a957cda5515',1,'455 Madison Ave, New York, NY 10022, Amerika Birle?ik Devletleri (Lotte New York Palace Hotel)','725 10th Ave, New York, NY 10019, Amerika Birle?ik Devletleri','CASH','scheduledatob','pointaob','ffarukkurt3@gmail.com','2029824915',13.20,52.79,65.99,'19.3','17.625',30.99,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','16.2',NULL,'35','2024-08-07 15:48:33','08/10/2024','2','00','PM'),(45,'14607fd6ac04839c31495f55a4f1bb54',1,'725 10th Ave, New York, NY 10019, Amerika Birle?ik Devletleri','455 Madison Ave, New York, NY 10022, Amerika Birle?ik Devletleri (Lotte New York Palace Hotel)','CASH','scheduledhourly','hourly','ffarukkurt3@gmail.com','2029824915',17.63,70.53,88.16,'7.62','15.575',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,'asasas',NULL,'15.55','1','35','2024-08-07 15:48:56','08/10/2024','3','00','PM'),(46,'6beb9261a0cf3667b8ef35c9ccb653cd',2,'725 10th Ave, New York, NY 10019, Amerika Birle?ik Devletleri','455 Madison Ave, New York, NY 10022, Amerika Birle?ik Devletleri (Lotte New York Palace Hotel)','CASH','hourly','scheduled','ffarukkurt3@gmail.com','2029824915',17.63,70.53,88.16,'7.62','15.575',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,'saaaaaaaaaaaaaaaaaaa',NULL,'15.55','1','35','2024-08-07 16:15:24','08/10/2024','1','30','PM'),(47,'b7441e6320d958c1a905a45b592a9d56',1,'455 Madison Ave, New York, NY 10022, Amerika Birle?ik Devletleri (Lotte New York Palace Hotel)','725 10th Ave, New York, NY 10019, Amerika Birle?ik Devletleri','CASH','pointatob','scheduled','ffarukkurt3@gmail.com','2029824915',13.19,52.76,65.95,'19.3','17.55',30.95,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','16.2',NULL,'35','2024-08-07 16:15:26','08/10/2024','1','15','PM'),(48,'7cf5dd30a461dcf9b8b833d5befa0c4e',1,'725 10th Ave, New York, NY 10019, Amerika Birle?ik Devletleri','455 Madison Ave, New York, NY 10022, Amerika Birle?ik Devletleri (Lotte New York Palace Hotel)','CASH','central park','scheduled','ffarukkurt3@gmail.com','2029824915',14.42,57.67,107.09,'95.825','',72.09,'15.55','19.625','16.2','12.2','7.62',NULL,'60','1',NULL,NULL,NULL,NULL,NULL,'35','2024-08-07 16:15:28','08/10/2024','1','00','PM'),(49,'737555acadae2f235a4de45710060e76',1,'30 Rockefeller Plaza, New York, NY 10112, USA','45 E 45th St, New York, NY 10017, USA','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',11.61,46.42,88.03,'89.175','',58.03,'11.25','9.05','20.125','15.625','3.67',NULL,'60','1',NULL,NULL,NULL,NULL,NULL,'30','2024-08-07 16:33:11','08/15/2024','2','00','PM'),(50,'8c210e1a1aa937e6bce6ec91126feedf',2,'45 E 45th St, New York, NY 10017, USA','30 Rockefeller Plaza, New York, NY 10112, USA','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',11.61,46.42,88.03,'86.875','',58.03,'20.125','15.625','11.25','9.05','4.17',NULL,'60','1',NULL,NULL,NULL,NULL,NULL,'30','2024-08-07 16:36:12','08/21/2024','3','15','PM'),(51,'b958ed40cf8aa3e676fa2f9f86fdc163',2,'45 E 45th St, New York, NY 10017, USA','30 Rockefeller Plaza, New York, NY 10112, USA','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',14.61,58.42,103.03,'116.875','',73.03,'20.125','15.625','11.25','9.05','4.17',NULL,'90','1',NULL,NULL,NULL,NULL,NULL,'30','2024-08-07 16:37:53','08/19/2024','4','00','PM'),(52,'ed85137f1717b8539031337f95a90f7b',2,'45 E 45th St, New York, NY 10017','30 Rockefeller Plaza, New York, NY 10112','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',40.88,95.39,136.28,'4.17','12.425',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,'asd',NULL,'20.125','3','30','2024-08-07 16:49:50','08/12/2024','1','00','PM'),(53,'4a849400831596f3bf02a37116c473d7',2,'45 E 45th St, New York, NY 10017','30 Rockefeller Plaza, New York, NY 10112','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',10.30,41.19,51.49,'10.42','12.425',21.49,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','20.125',NULL,'30','2024-08-07 16:53:00','08/22/2024','2','00','PM'),(54,'1501183e19d71a9557d6c91939d37cf6',1,'928 8th Ave, New York, NY 10019, Amerika Birle?ik Devletleri','18 W 56th St, New York, NY 10019, Amerika Birle?ik Devletleri','CASH','seseeees','drdrdrd','ffarukkurt3@gmail.com','2029824915',11.36,45.45,91.82,'79.425','',56.82,'8.925','8.75','10.675','9.05','3.08',NULL,'60','1',NULL,NULL,NULL,NULL,NULL,'35','2024-08-07 18:16:01','08/11/2024','1','15','PM'),(55,'09d74a28cdbd4fb0cb1257aa7326a1fc',1,'928 8th Ave, New York, NY 10019, Amerika Birle?ik Devletleri','18 W 56th St, New York, NY 10019, Amerika Birle?ik Devletleri','CASH','seseeees','drdrdrd','ffarukkurt3@gmail.com','2029824915',11.36,45.45,91.82,'79.425','',56.82,'8.925','8.75','10.675','9.05','3.08',NULL,'60','1',NULL,NULL,NULL,NULL,NULL,'35','2024-08-07 18:16:02','08/11/2024','1','15','PM'),(56,'032078d0f8f76dced0ff0548aa258029',3,'18 W 56th St, New York, NY 10019, Amerika Birle?ik Devletleri','308 W 58th St, New York, NY 10019, Amerika Birle?ik Devletleri','CASH','uhuhuhuhuhuh','uhuh','ffarukkurt3@gmail.com','2029824915',11.13,44.53,55.66,'18.62','6.125',20.66,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','10.675',NULL,'35','2024-08-07 18:18:42','08/11/2024','2','00','PM'),(57,'e8b195aea567c17debaccf604712854e',2,'45 E 45th St, New York, NY 10017','30 Rockefeller Plaza, New York, NY 10112','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',10.29,41.17,51.46,'10.42','12.375',21.46,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','20.125',NULL,'30','2024-08-08 14:34:04','08/08/2024','10','45','AM'),(58,'daac3968fd1c0bb0dc9ff7927ab46d17',1,'34 St - Herald Sq, New York, NY 10001','26 Federal Plaza, New York, NY 10278','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',28.57,66.66,95.23,'17.87','60.625',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,'ad',NULL,'9.825','1','30','2024-08-08 14:38:02','08/08/2024','10','45','PM'),(59,'33a6061da1d409d50fe8d8fbf235db7c',1,'455 Madison Ave, New York, NY 10022 (Lotte New York Palace)','725 10th Ave, New York, NY 10019','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',15.38,61.53,76.91,'7.82','17.625',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,'asd',NULL,'16.2','1','30','2024-08-08 14:41:46','08/08/2024','10','45','AM'),(60,'881c0a47cc4036c8f17d50d989356d32',1,'928 8th Ave, New York, NY 10019, Amerika Birle?ik Devletleri','18 W 56th St, New York, NY 10019, Amerika Birle?ik Devletleri','CASH','asdsdasd','asdasd','ffarukkurt3@gmail.com','2029824915',10.50,42.00,52.50,'7.7','12.375',16.92,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','8.925',NULL,'35','2024-08-08 14:45:36','08/10/2024','1','00','PM'),(61,'8dce8bb85724b3cb74d9b51a60481f82',1,'18 W 56th St, New York, NY 10019, Amerika Birle?ik Devletleri','928 8th Ave, New York, NY 10019, Amerika Birle?ik Devletleri','CASH','qwdqwdwd','qwdqwdqwd','ffarukkurt3@gmail.com','2029824915',13.81,55.22,69.03,'5.72','7.375',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,'adsdasda',NULL,'10.675','1','30','2024-08-08 14:50:09','08/08/2024','11','00','AM'),(62,'b3227b0863e0d4f6b6f0656062bbbe90',1,'928 8th Ave, New York, NY 10019, Amerika Birle?ik Devletleri','18 W 56th St, New York, NY 10019, Amerika Birle?ik Devletleri','CASH','asdasd','asdasdasd','ffarukkurt3@gmail.com','2029824915',10.50,42.00,52.50,'7.7','12.375',16.92,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','8.925',NULL,'35','2024-08-08 14:53:55','08/10/2024','1','00','PM'),(63,'25fcdf0d7751b4a8bb805d2341d3e5ce',1,'18 W 56th St, New York, NY 10019, Amerika Birle?ik Devletleri','928 8th Ave, New York, NY 10019, Amerika Birle?ik Devletleri','CASH','central','asdasda','ffarukkurt3@gmail.com','2029824915',9.74,38.96,78.70,'77.975','',48.70,'10.675','9.05','8.925','8.75','5.60',NULL,'60','1',NULL,NULL,NULL,NULL,NULL,'30','2024-08-08 14:57:36','08/08/2024','11','00','AM'),(64,'20ce4d80e5c466664b294c242b5b5ccc',1,'308 W 58th St, New York, NY 10019, Amerika Birle?ik Devletleri','153 W 57th St, New York, NY 10019, Amerika Birle?ik Devletleri','CASH','central','asd','ffarukkurt3@gmail.com','2029824915',6.19,24.75,60.94,'50.375','',30.94,'8.5','7.5','2.875','3','1.98',NULL,'40','1',NULL,NULL,NULL,NULL,NULL,'30','2024-08-08 15:04:12','08/08/2024','11','15','AM'),(65,'af1f2ccde4ddebef8f72a512f5ae3b4c',1,'308 W 58th St, New York, NY 10019, Amerika Birle?ik Devletleri','153 W 57th St, New York, NY 10019, Amerika Birle?ik Devletleri','CASH','pointatob','asdas','ffarukkurt3@gmail.com','2029824915',9.00,36.00,45.00,'4.95','6.325',9.89,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','8.5',NULL,'30','2024-08-08 15:05:56','08/08/2024','11','15','AM'),(66,'59eec27d341504c5473c44262a3140e6',1,'308 W 58th St, New York, NY 10019, Amerika Birle?ik Devletleri','153 W 57th St, New York, NY 10019, Amerika Birle?ik Devletleri','CASH','hourly','asdad','ffarukkurt3@gmail.com','2029824915',10.56,42.23,52.79,'1.98','7.075',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,'asdasdad',NULL,'8.5','30','30','2024-08-08 15:07:46','08/08/2024','11','15','AM'),(67,'4f84788acc7121f1fef423700e9645e3',1,'45 E 45th St, New York, NY 10017','30 Rockefeller Plaza, New York, NY 10112','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',10.29,41.17,51.46,'10.42','12.375',21.46,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','20.125',NULL,'30','2024-08-08 15:13:42','08/08/2024','2','00','PM'),(68,'e115f4ecb285874dab5d5a57abb6d290',1,'308 W 58th St, New York, NY 10019, Amerika Birle?ik Devletleri','153 W 57th St, New York, NY 10019, Amerika Birle?ik Devletleri','CASH','houtly','asd','ffarukkurt3@gmail.com','2029824915',10.56,42.23,52.79,'1.98','7.075',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,'as',NULL,'8.5','30','30','2024-08-08 15:23:18','08/08/2024','11','30','AM'),(69,'0a7340aee995730d1cdf2d18cd7f628f',1,'308 W 58th St, New York, NY 10019, Amerika Birle?ik Devletleri','153 W 57th St, New York, NY 10019, Amerika Birle?ik Devletleri','CASH','houtly','asd','ffarukkurt3@gmail.com','2029824915',10.56,42.23,52.79,'1.98','7.075',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,'as',NULL,'8.5','30','30','2024-08-08 15:23:18','08/08/2024','11','30','AM'),(70,'5a5ae9102c471df25982a475bf2e56dd',1,'308 W 58th St, New York, NY 10019, Amerika Birle?ik Devletleri','153 W 57th St, New York, NY 10019, Amerika Birle?ik Devletleri','CASH','pointatob','sasd','ffarukkurt3@gmail.com','2029824915',9.00,36.00,45.00,'4.95','6.325',9.89,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','8.5',NULL,'30','2024-08-08 15:23:20','08/08/2024','11','30','AM'),(71,'8872f9cb2fc6dccdaba95beb4a7a92eb',1,'308 W 58th St, New York, NY 10019, Amerika Birle?ik Devletleri','153 W 57th St, New York, NY 10019, Amerika Birle?ik Devletleri','CASH','central','adasd','ffarukkurt3@gmail.com','2029824915',6.19,24.75,60.94,'50.375','',30.94,'8.5','7.5','2.875','3','1.98',NULL,'40','1',NULL,NULL,NULL,NULL,NULL,'30','2024-08-08 15:23:22','08/08/2024','11','30','AM'),(72,'544b5b8645f9deac906a46861c45b8c1',1,'308 W 58th St, New York, NY 10019, Amerika Birle?ik Devletleri','153 W 57th St, New York, NY 10019, Amerika Birle?ik Devletleri','CASH','central','adasd','ffarukkurt3@gmail.com','2029824915',6.19,24.75,60.94,'50.375','',30.94,'8.5','7.5','2.875','3','1.98',NULL,'40','1',NULL,NULL,NULL,NULL,NULL,'30','2024-08-08 15:26:02','08/08/2024','11','30','AM'),(73,'0fc29413d7e13c263ea93bed92143859',1,'308 W 58th St, New York, NY 10019, Amerika Birle?ik Devletleri','153 W 57th St, New York, NY 10019, Amerika Birle?ik Devletleri','CASH','houtly','asd','ffarukkurt3@gmail.com','2029824915',10.56,42.23,52.79,'1.98','7.075',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,'as',NULL,'8.5','30','30','2024-08-08 15:27:10','08/08/2024','11','30','AM'),(74,'053d14c514ec391f801f6d82baf75819',1,'308 W 58th St, New York, NY 10019, Amerika Birle?ik Devletleri','153 W 57th St, New York, NY 10019, Amerika Birle?ik Devletleri','CASH','hourly','sad','ffarukkurt3@gmail.com','2029824915',10.56,42.23,52.79,'1.98','7.075',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,'as',NULL,'8.5','30','30','2024-08-08 15:33:26','08/08/2024','11','45','AM'),(75,'8991d99063ce510b0207a83fcd738b5d',1,'308 W 58th St, New York, NY 10019, Amerika Birle?ik Devletleri','153 W 57th St, New York, NY 10019, Amerika Birle?ik Devletleri','CASH','pointatob','ad','ffarukkurt3@gmail.com','2029824915',9.00,36.00,45.00,'4.95','6.325',9.89,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','8.5',NULL,'30','2024-08-08 15:33:27','08/08/2024','11','45','AM'),(76,'4b85bdabdd983bffdb908de84c757a08',1,'308 W 58th St, New York, NY 10019, Amerika Birle?ik Devletleri','153 W 57th St, New York, NY 10019, Amerika Birle?ik Devletleri','CASH','central','ldm','ffarukkurt3@gmail.com','2029824915',6.19,24.75,60.94,'50.375','',30.94,'8.5','7.5','2.875','3','1.98',NULL,'40','1',NULL,NULL,NULL,NULL,NULL,'30','2024-08-08 15:33:29','08/08/2024','11','45','AM'),(77,'fdf063073ac78373e8c2af54276ddf70',2,'153 W 57th St, New York, NY 10019, Amerika Birle?ik Devletleri','308 W 58th St, New York, NY 10019, Amerika Birle?ik Devletleri','CASH','asdasd','asdasd','ffarukkurt3@gmail.com','2029824915',7.22,28.88,71.09,'51.5','',36.09,'2.875','3','8.5','7.5','3.32',NULL,'40','1',NULL,NULL,NULL,NULL,NULL,'35','2024-08-08 16:01:32','08/18/2024','1','00','PM'),(78,'3ce10be074d18e6a399f5b71a862972b',1,'45 E 45th St, New York, NY 10017, USA','30 Rockefeller Plaza, New York, NY 10112, USA','CASH','IBRAHIM','Radovanovic','ibrahimdonmez1983@yahoo.com','2129617435',9.61,38.42,78.03,'66.875','',48.03,'20.125','15.625','11.25','9.05','4.17',NULL,'40','1',NULL,NULL,NULL,NULL,NULL,'30','2024-08-09 15:10:32','08/15/2024','3','15','PM'),(79,'43854496c889eb42cd4129bab87d8c23',3,'45 E 45th St, New York, NY 10017','30 Rockefeller Plaza, New York, NY 10112','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',15.25,61.00,76.25,'4.17','12.375',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,'sd',NULL,'20.125','1','30','2024-08-09 15:12:05','08/14/2024','3','00','PM');
/*!40000 ALTER TABLE `temporaryBookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) DEFAULT NULL,
  `pass` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `surname` text DEFAULT NULL,
  `email` text NOT NULL,
  `number` varchar(555) NOT NULL,
  `perm` varchar(555) NOT NULL DEFAULT 'driver',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `user`, `pass`, `name`, `surname`, `email`, `number`, `perm`) VALUES (1,'ogulcan','$2y$10$4Q/Qs9Mpao0TNgD2TzsnneK.oWMTCvNAmkltywXAaueoAA.kQ68bO','Ogulcan','Ozdogan','ogulcanozdogan@gmail.com','6562002544','admin'),(6,'ibrahim','$2y$10$cHdoJpNSnUety4PikWtFd.ZhcBNMk5EUTmy5hhBcarMjKuOdWIBcu','Ibrahim','Donmez','ibrahimdonmez1983@gmail.com','2129617435','driver'),(20,'testing','$2y$10$4Q/Qs9Mpao0TNgD2TzsnneK.oWMTCvNAmkltywXAaueoAA.kQ68bO','Testing','Testing','testttttt@gmail.com','9734492373','driver'),(21,'farukkurt2','$2y$10$TQXmJJ5Jtb3R7C8mjJOsi.15s5jU41xayUE.vZ.cVVihL528jA0Xm','faruk2','kurt2','ffarukkurt3@gmail.com','2029824915','driver'),(22,'ffarukkurt3','$2y$10$JIde2ppSY5q2UVcHCw7GJujBDtb7wXb4FunHIpG8.BJw07IHn6jV2','faruk3','kurt3','ffarukkurt3@gmail.com','2029824915','driver'),(23,'farukkurt4','$2y$10$JSF0fcWKlf3bkhihfz3vSONh7/df1GBrgM1uSA0rk1Ctbk.MM7J3.','faruk4','kurt4','ffarukkurt3@gmail.com','2029824915','driver');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_temporary`
--

DROP TABLE IF EXISTS `users_temporary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_temporary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) DEFAULT NULL,
  `pass` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `surname` text DEFAULT NULL,
  `email` text NOT NULL,
  `number` varchar(555) NOT NULL,
  `perm` varchar(555) NOT NULL DEFAULT 'driver',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_temporary`
--

LOCK TABLES `users_temporary` WRITE;
/*!40000 ALTER TABLE `users_temporary` DISABLE KEYS */;
INSERT INTO `users_temporary` (`id`, `user`, `pass`, `name`, `surname`, `email`, `number`, `perm`) VALUES (15,'1','$2y$10$caCcVToKuL7lUzfWJNpUjuNW6V4VIOYxkCYlLs4K2Nqy83Wembwzm','deneme','a','31@asd.asd','4123123','driver');
/*!40000 ALTER TABLE `users_temporary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'PedicabsScheduled'
--

--
-- Dumping routines for database 'PedicabsScheduled'
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
