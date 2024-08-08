/*!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.6.18-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: PedicabsOnDemand
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
-- Current Database: `PedicabsOnDemand`
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
  `createdAt` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `duration` varchar(555) NOT NULL,
  `pickupAddress` text NOT NULL,
  `pickUpCoords` text NOT NULL,
  `returnDuration` text NOT NULL,
  `tourDuration` int(11) NOT NULL,
  `pickUpDuration` text NOT NULL,
  `hub` text NOT NULL,
  `hubCoords` text NOT NULL,
  `baseFare` float NOT NULL,
  `operationFare` float NOT NULL,
  `pickUpTime` varchar(555) NOT NULL,
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
INSERT INTO `centralpark` (`id`, `bookingNumber`, `numberOfPassengers`, `date`, `hour`, `minutes`, `ampm`, `destinationAddress`, `destinationCoords`, `paymentMethod`, `firstName`, `lastName`, `emailAddress`, `phoneNumber`, `bookingFee`, `driverFee`, `totalFare`, `createdAt`, `updated_at`, `duration`, `pickupAddress`, `pickUpCoords`, `returnDuration`, `tourDuration`, `pickUpDuration`, `hub`, `hubCoords`, `baseFare`, `operationFare`, `pickUpTime`, `status`, `driver`, `sms_sent`, `totalMinutes`, `unique_id`) VALUES ('192d832234db4f73','2024-08-07-12-19-2024-08-07-11-54-192d832234db4f73',2,'08/07/2024',0,0,'','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',12.63,50.53,63.16,'2024-08-07 11:54:34','2024-08-07 12:00:02','71.88','45 E 45th St, New York, NY 10017','40.7549394,-73.9772689','',45,'','','',0,63.16,'12:19 PM','failed',NULL,0,101.05,'32fa6e408fc9823ed4c3b5a098c9ea3b');
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
  `createdAt` datetime DEFAULT NULL,
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
  `pickUpTime` varchar(555) NOT NULL,
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
INSERT INTO `hourly` (`id`, `bookingNumber`, `numberOfPassengers`, `date`, `hour`, `minutes`, `ampm`, `destinationAddress`, `destinationCoords`, `paymentMethod`, `firstName`, `lastName`, `emailAddress`, `phoneNumber`, `bookingFee`, `driverFee`, `totalFare`, `createdAt`, `updated_at`, `duration`, `pickupAddress`, `pickUpCoords`, `returnDuration`, `pickUpDuration`, `hub`, `hubCoords`, `baseFare`, `operationFare`, `pickUpTime`, `status`, `driver`, `sms_sent`, `serviceDetails`, `serviceDuration`, `totalMinutes`, `unique_id`) VALUES ('03528498a273cf52','2024-08-07-15-34-2024-08-07-15-13-03528498a273cf52',2,'08/07/2024',0,0,'','234 E 85th St, New York, NY 10028','40.7772538,-73.9529275','','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',17.55,70.2,87.75,'2024-08-07 15:13:02','2024-08-07 15:18:02','14.32','425 Park Ave, New York, NY 10022','40.7605182,-73.9712319','33.7','16.7','West Drive and West 59th Street New York, NY 10019','40.766941088678855, -73.97899952992152',0,87.75,'03:34 PM','failed','',0,'','90',140.4,'21af0a19a8252aff87d029ce8d5355cd'),('5cc8ffbe71184b8b','2024-08-07-15-52-2024-08-07-15-13-5cc8ffbe71184b8b',2,'08/07/2024',0,0,'','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',13.27,53.06,66.33,'2024-08-07 15:13:38','2024-08-07 15:19:01','13.22','4 Charles St #3004, New York, NY 10014 (4 Charles Prime Rib)','40.7351675,-74.0006537','12.425','33.7','West Drive and West 59th Street New York, NY 10019','40.766941088678855, -73.97899952992152',0,66.33,'03:52 PM','failed','',0,'','1',106.13,'6ebda18ce79e3c9b198a827d76572359'),('965b6634fb95f082','2024-08-07-15-20-2024-08-07-15-04-965b6634fb95f082',2,'08/07/2024',0,0,'','45 E 45th St, New York, NY 10017','40.7549394,-73.9772689','','asd','dsa','asd@asd.wdf','+13424324324',18.78,75.13,93.91,'2024-08-07 15:04:16','2024-08-07 15:10:02','3.67','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','19','11.25','West Drive and West 59th Street New York, NY 10019','40.766941088678855, -73.97899952992152',0,93.91,'03:20 PM','failed','',0,'',' Hour',30.25,'f5d5eea2cd6bfad6eba605a4b961fe8b'),('96d5caff530e57ce','2024-08-07-15-32-2024-08-07-15-07-96d5caff530e57ce',2,'08/07/2024',0,0,'','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',11.57,46.28,57.84,'2024-08-07 15:07:53','2024-08-07 15:13:01','4.17','45 E 45th St, New York, NY 10017','40.7549394,-73.9772689','12.425','20.125','West Drive and West 59th Street New York, NY 10019','40.766941088678855, -73.97899952992152',0,57.84,'03:32 PM','failed','',0,'','',32.55,'27f49746808a6bb262e38a45429620de'),('fa57f5090bc56476','2024-08-07-15-37-2024-08-07-15-11-fa57f5090bc56476',3,'08/07/2024',0,0,'','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',11.57,46.28,57.84,'2024-08-07 15:11:54','2024-08-07 15:17:01','4.17','45 E 45th St, New York, NY 10017','40.7549394,-73.9772689','12.425','20.125','West Drive and West 59th Street New York, NY 10019','40.766941088678855, -73.97899952992152',0,57.84,'03:37 PM','failed','',0,'','1',92.55,'aa0ed122bdddb37b9ab083fbe63410d6');
/*!40000 ALTER TABLE `hourly` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bookingNumber` varchar(555) NOT NULL,
  `driverUsername` varchar(255) NOT NULL,
  `driverName` varchar(255) NOT NULL,
  `driverLastName` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `perm` varchar(55) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` (`id`, `bookingNumber`, `driverUsername`, `driverName`, `driverLastName`, `action`, `perm`, `timestamp`) VALUES (1,'','ogulcan','Ogulcan','Ozdogan','Point A to B Accepted!','','2024-08-08 19:42:10'),(2,'','farukkurt4','faruk4','kurt4','Point A to B Accepted!','','2024-08-08 19:42:29'),(3,'2024-08-08-13-12-2024-08-08-12-47-2f1448615032bab5','ogulcan','Ogulcan','Ozdogan','Point A to B Accepted!','admin','2024-08-08 19:47:47'),(4,'2024-08-08-13-15-2024-08-08-12-49-3b298a4146ef74a2','ffarukkurt3','faruk3','kurt3','Point A to B Accepted!','driver','2024-08-08 19:51:10');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
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
  `pickUpTime` varchar(555) NOT NULL,
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
INSERT INTO `pointatob` (`id`, `bookingNumber`, `numberOfPassengers`, `date`, `hour`, `minutes`, `ampm`, `destinationAddress`, `destinationCoords`, `paymentMethod`, `firstName`, `lastName`, `emailAddress`, `phoneNumber`, `bookingFee`, `driverFee`, `totalFare`, `createdAt`, `updated_at`, `duration`, `pickupAddress`, `pickUpCoords`, `returnDuration`, `pickUpDuration`, `hub`, `hubCoords`, `baseFare`, `operationFare`, `pickUpTime`, `status`, `driver`, `sms_sent`, `totalMinutes`, `unique_id`) VALUES ('1eff637f5bb1c62e','2024-08-07-17-01-2024-08-07-16-36-1eff637f5bb1c62e',2,'08/07/2024',0,0,'','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','CASH','asd','asd','asd@asd.asd','+11231231231',5.37,21.49,26.86,'2024-08-07 16:36:04','2024-08-07 16:42:01','10.42','45 E 45th St, New York, NY 10017','40.7549394,-73.9772689','12.425','20.125','West Drive and West 59th Street New York, NY 10019','40.766941088678855, -73.97899952992152',0,26.86,'05:01 PM','failed','',0,42.97,'54919fd932ceccaf05c6b8cb9027983c'),('23141555e46575cb','2024-08-07-17-33-2024-08-07-17-11-23141555e46575cb',2,'08/07/2024',0,0,'','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','CARD','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',5.43,23.88,29.31,'2024-08-07 17:11:51','2024-08-07 17:17:01','14.30','425 Park Ave, New York, NY 10022','40.7605182,-73.9712319','12.425','16.7','West Drive and West 59th Street New York, NY 10019','40.766941088678855, -73.97899952992152',0,27.14,'05:33 PM','failed','',0,43.43,'775a960d4cf2f9c51e06e3fb451557a9'),('2f1448615032bab5','2024-08-08-13-12-2024-08-08-12-47-2f1448615032bab5',3,'08/08/2024',0,0,'','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','CARD','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',5.37,23.61,28.97,'2024-08-08 12:47:11','2024-08-08 12:47:47','10.42','45 E 45th St, New York, NY 10017','40.7549394,-73.9772689','12.375','20.125','West Drive and West 59th Street New York, NY 10019','40.766941088678855, -73.97899952992152',0,26.83,'01:12 PM','pending','ogulcan',0,42.92,'90bf3d864a71ce8bf1fa0a3ab8568677'),('3b298a4146ef74a2','2024-08-08-13-15-2024-08-08-12-49-3b298a4146ef74a2',1,'08/08/2024',0,0,'','315 W 44th St #5402, New York, NY 10036, Amerika Birle?ik Devletleri','40.7590167,-73.9896861','CASH','sadasd','dasda','ffarukkurt3@gmail.com','+12029824915',6.78,27.11,33.89,'2024-08-08 12:49:58','2024-08-08 12:51:10','17.92','45 E 45th St, New York, NY 10017, Amerika Birle?ik Devletleri','40.7549394,-73.9772689','16.175','20.125','West Drive and West 59th Street New York, NY 10019','40.766941088678855, -73.97899952992152',0,33.89,'01:15 PM','pending','ffarukkurt3',0,54.22,'2293b4f0d2942339ebb4d5a3f7f7cfc3'),('6fa3147fd1a49f65','2024-08-08-12-52-2024-08-08-12-27-6fa3147fd1a49f65',1,'08/08/2024',0,0,'','315 W 44th St #5402, New York, NY 10036, Amerika Birle?ik Devletleri','40.7590167,-73.9896861','CASH','point a to b','asdad','ffarukkurt3@gmail.com','+12029824915',6.78,27.11,33.89,'2024-08-08 12:27:38','2024-08-08 12:27:58','17.92','45 E 45th St, New York, NY 10017, Amerika Birle?ik Devletleri','40.7549394,-73.9772689','16.175','20.125','West Drive and West 59th Street New York, NY 10019','40.766941088678855, -73.97899952992152',0,33.89,'12:52 PM','past','farukkurt2',1,54.22,'4c01104471e5dae844169678f290a0fa'),('744139c23b623324','2024-08-08-13-07-2024-08-08-12-41-744139c23b623324',1,'08/08/2024',0,0,'','30 Rockefeller Plaza, Rockefeller Plaza, New York, NY, USA','40.7593755,-73.9799726','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',5.37,21.46,26.83,'2024-08-08 12:41:58','2024-08-08 12:42:10','10.42','45 E 45th St, New York, NY 10017','40.7549394,-73.9772689','12.375','20.125','West Drive and West 59th Street New York, NY 10019','40.766941088678855, -73.97899952992152',0,26.83,'01:07 PM','past','ogulcan',1,42.92,'348fef5d1476d781f90a410c13654828'),('776efbd578df620e','2024-08-07-16-50-2024-08-07-16-25-776efbd578df620e',2,'08/07/2024',0,0,'','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',5.37,21.49,26.86,'2024-08-07 16:25:06','2024-08-07 16:31:02','10.42','45 E 45th St, New York, NY 10017','40.7549394,-73.9772689','12.425','20.125','West Drive and West 59th Street New York, NY 10019','40.766941088678855, -73.97899952992152',0,26.86,'04:50 PM','failed','',0,42.97,'f9945929a1ed90aa79e8820dbb98b40d'),('7b73ea4a5b2fe4fc','2024-08-08-13-04-2024-08-08-12-41-7b73ea4a5b2fe4fc',1,'08/08/2024',0,0,'','45 E 45th St, New York, NY 10017, Amerika Birle?ik Devletleri','40.7549394,-73.9772689','CASH','asdasd','asdasd','ffarukkurt3@gmail.com','+12029824915',6.47,25.88,32.34,'2024-08-08 12:41:53','2024-08-08 12:42:29','15.25','315 W 44th St #5402, New York, NY 10036, Amerika Birle?ik Devletleri','40.7590167,-73.9896861','18.95','17.55','West Drive and West 59th Street New York, NY 10019','40.766941088678855, -73.97899952992152',0,32.34,'01:04 PM','pending','farukkurt4',0,51.75,'7dbadcef4291e06fe5e5f2fe86a3fb8a'),('b35bd07fc6617202','2024-08-07-17-36-2024-08-07-17-11-b35bd07fc6617202',2,'08/07/2024',0,0,'','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',5.37,21.49,26.86,'2024-08-07 17:11:21','2024-08-07 17:17:01','10.42','45 E 45th St, New York, NY 10017','40.7549394,-73.9772689','12.425','20.125','West Drive and West 59th Street New York, NY 10019','40.766941088678855, -73.97899952992152',0,26.86,'05:36 PM','failed','',0,42.97,'d12e3a75ad72630d4badaf7e658f324c');
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temporaryBookings`
--

LOCK TABLES `temporaryBookings` WRITE;
/*!40000 ALTER TABLE `temporaryBookings` DISABLE KEYS */;
INSERT INTO `temporaryBookings` (`id`, `unique_id`, `num_passengers`, `pick_up_address`, `destination_address`, `payment_method`, `first_name`, `last_name`, `email`, `phone_number`, `booking_fee`, `driver_fare`, `total_fare`, `ride_duration`, `return_duration`, `operation_fare`, `pickup1`, `pickup2`, `return1`, `return2`, `toursuresi`, `hourly_operation_fare`, `tour_duration`, `country_code`, `country_name`, `service_details`, `hub`, `pick_up_duration`, `service_duration`, `base_fare`, `created_at`) VALUES (37,'32fa6e408fc9823ed4c3b5a098c9ea3b',2,'45 E 45th St, New York, NY 10017','30 Rockefeller Plaza, New York, NY 10112','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',12.63,50.53,63.16,'71.875','',63.16,'20.125','15.625','11.25','9.05','4.17',37.50,'45','1',NULL,NULL,NULL,NULL,NULL,NULL,'2024-08-07 15:54:32'),(38,'f5d5eea2cd6bfad6eba605a4b961fe8b',2,'30 Rockefeller Plaza, New York, NY 10112','45 E 45th St, New York, NY 10017','CASH','asd','dsa','asd@asd.wdf','3424324324',18.78,75.13,93.91,'3.67','19',93.91,NULL,NULL,NULL,NULL,NULL,37.50,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','11.25',NULL,NULL,'2024-08-07 19:04:14'),(39,'27f49746808a6bb262e38a45429620de',2,'45 E 45th St, New York, NY 10017','30 Rockefeller Plaza, New York, NY 10112','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',11.57,46.28,57.84,'4.17','12.425',57.84,NULL,NULL,NULL,NULL,NULL,37.50,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','20.125',NULL,NULL,'2024-08-07 19:07:51'),(40,'aa0ed122bdddb37b9ab083fbe63410d6',3,'45 E 45th St, New York, NY 10017','30 Rockefeller Plaza, New York, NY 10112','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',11.57,46.28,57.84,'4.17','12.425',57.84,NULL,NULL,NULL,NULL,NULL,37.50,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','20.125','1',NULL,'2024-08-07 19:11:52'),(41,'21af0a19a8252aff87d029ce8d5355cd',2,'425 Park Ave, New York, NY 10022','234 E 85th St, New York, NY 10028','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',17.55,70.20,87.75,'14.32','33.7',87.75,NULL,NULL,NULL,NULL,NULL,37.50,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','16.7','90',NULL,'2024-08-07 19:13:00'),(42,'6ebda18ce79e3c9b198a827d76572359',2,'4 Charles St #3004, New York, NY 10014 (4 Charles Prime Rib)','30 Rockefeller Plaza, New York, NY 10112','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',13.27,53.06,66.33,'13.22','12.425',66.33,NULL,NULL,NULL,NULL,NULL,37.50,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','33.7','1',NULL,'2024-08-07 19:13:36'),(43,'f9945929a1ed90aa79e8820dbb98b40d',2,'45 E 45th St, New York, NY 10017','30 Rockefeller Plaza, New York, NY 10112','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',5.37,21.49,26.86,'10.42','12.425',26.86,NULL,NULL,NULL,NULL,NULL,37.50,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','20.125',NULL,NULL,'2024-08-07 20:25:03'),(44,'54919fd932ceccaf05c6b8cb9027983c',2,'45 E 45th St, New York, NY 10017','30 Rockefeller Plaza, New York, NY 10112','CASH','asd','asd','asd@asd.asd','1231231231',5.37,21.49,26.86,'10.42','12.425',26.86,NULL,NULL,NULL,NULL,NULL,37.50,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','20.125',NULL,NULL,'2024-08-07 20:36:02'),(45,'d12e3a75ad72630d4badaf7e658f324c',2,'45 E 45th St, New York, NY 10017','30 Rockefeller Plaza, New York, NY 10112','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',5.37,21.49,26.86,'10.42','12.425',26.86,NULL,NULL,NULL,NULL,NULL,37.50,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','20.125',NULL,NULL,'2024-08-07 21:11:19'),(46,'775a960d4cf2f9c51e06e3fb451557a9',2,'425 Park Ave, New York, NY 10022','30 Rockefeller Plaza, New York, NY 10112','CARD','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',5.43,23.88,29.31,'14.30','12.425',27.14,NULL,NULL,NULL,NULL,NULL,37.50,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','16.7',NULL,NULL,'2024-08-07 21:11:49'),(47,'4c01104471e5dae844169678f290a0fa',1,'45 E 45th St, New York, NY 10017, Amerika Birle?ik Devletleri','315 W 44th St #5402, New York, NY 10036, Amerika Birle?ik Devletleri','CASH','point a to b','asdad','ffarukkurt3@gmail.com','2029824915',6.78,27.11,33.89,'17.92','16.175',33.89,NULL,NULL,NULL,NULL,NULL,37.50,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','20.125',NULL,NULL,'2024-08-08 16:27:35'),(48,'7dbadcef4291e06fe5e5f2fe86a3fb8a',1,'315 W 44th St #5402, New York, NY 10036, Amerika Birle?ik Devletleri','45 E 45th St, New York, NY 10017, Amerika Birle?ik Devletleri','CASH','asdasd','asdasd','ffarukkurt3@gmail.com','2029824915',6.47,25.88,32.34,'15.25','18.95',32.34,NULL,NULL,NULL,NULL,NULL,37.50,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','17.55',NULL,NULL,'2024-08-08 16:41:51'),(49,'348fef5d1476d781f90a410c13654828',1,'45 E 45th St, New York, NY 10017','30 Rockefeller Plaza, Rockefeller Plaza, New York, NY, USA','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',5.37,21.46,26.83,'10.42','12.375',26.83,NULL,NULL,NULL,NULL,NULL,37.50,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','20.125',NULL,NULL,'2024-08-08 16:41:56'),(50,'90bf3d864a71ce8bf1fa0a3ab8568677',3,'45 E 45th St, New York, NY 10017','30 Rockefeller Plaza, New York, NY 10112','CARD','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','2129617435',5.37,23.61,28.97,'10.42','12.375',26.83,NULL,NULL,NULL,NULL,NULL,37.50,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','20.125',NULL,NULL,'2024-08-08 16:47:09'),(51,'2293b4f0d2942339ebb4d5a3f7f7cfc3',1,'45 E 45th St, New York, NY 10017, Amerika Birle?ik Devletleri','315 W 44th St #5402, New York, NY 10036, Amerika Birle?ik Devletleri','CASH','sadasd','dasda','ffarukkurt3@gmail.com','2029824915',6.78,27.11,33.89,'17.92','16.175',33.89,NULL,NULL,NULL,NULL,NULL,37.50,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','20.125',NULL,NULL,'2024-08-08 16:49:55');
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
  `verify` int(11) NOT NULL DEFAULT 0,
  `pdf_id` varchar(555) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `user`, `pass`, `name`, `surname`, `email`, `number`, `perm`, `verify`, `pdf_id`) VALUES (1,'ogulcan','$2y$10$9YVrmzOac7hHBQDdfHibB.1VvmBs0kxCpCHazkcJEPIcQZIoIhpHy','Ogulcan','Ozdogan','ogulcanozdogan@gmail.com','6562002544','admin',1,''),(6,'ibrahim','$2y$10$WgrsLWv3tQYuEyoYbuzmW.F4sDA9V35r8fe/dUjv1AWr4ZycyV1q2','IBRAHIM','DONMEZ','ibrahimdonmez1983@gmail.com','2129617435','driver',1,''),(14,'testing','$2y$10$9YVrmzOac7hHBQDdfHibB.1VvmBs0kxCpCHazkcJEPIcQZIoIhpHy','TestingP','TestingP','TestingP@gmail.sdasd','9734492373','driver',1,''),(20,'ffarukkurtt','$2y$10$WXrj2F.3YwbD9SyTJTrQoObS8XGwUgZkQErgENofMPB.3XJPhvrqG','FARUKK','KURTT','ffarukkurt3@gmail.com','2029824915','driver',1,'3c2232a41dee2bee'),(22,'farukkurt2','$2y$10$doDb1tNas1CFyEOmh5jUjuscWKRqKSg.zHye1v3erjK5FyBS4OY3S','faruk2','kurt2','ffarukkurt3@gmail.com','2029824915','driver',1,'b27348cb931792ad'),(23,'ffarukkurt3','$2y$10$It0nnTgjfnPHH3JMahl2A.HL.Yo5BMJtY9CUO0NmBhMuFJfrzqKt.','faruk3','kurt3','ffarukkurt3@gmail.com','2029824915','driver',1,'62db1cd97b138cb8'),(24,'farukkurt4','$2y$10$X0D1YQPIjxEn/WRZJyhyPObwwENgmlLKb.8sMgHAZMLgQeuFkz7Ii','faruk4','kurt4','ffarukkurt3@gmail.com','2029824915','driver',1,'358ee517123255f1'),(30,'farukkurt5','$2y$10$mLcVQGswcvsLYKugX5gkNOS2CApToRMLaD7ygvUV2vMPyx/HM.lTm','faruk5','kurt5','ffarukkurt3@gmail.com','2029824915','driver',0,'d36d061b13a5ea48'),(31,'farukkurt','$2y$10$pv7AFf4pszl01A9gThsKxOVVgCJ3xHILP2x6ViCeL7bCQ.RWVvRCW','faruk11','kurt11','ffarukkurt3@gmail.com','2029824915','driver',0,'b27348cb931792ad');
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
  `pdf_id` varchar(555) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_temporary`
--

LOCK TABLES `users_temporary` WRITE;
/*!40000 ALTER TABLE `users_temporary` DISABLE KEYS */;
INSERT INTO `users_temporary` (`id`, `user`, `pass`, `name`, `surname`, `email`, `number`, `perm`, `pdf_id`) VALUES (35,'a','$2y$10$MIiaXXJwlqFTdpgqt1wDs.XjokR0H3mxgTX2Ue1UbPeQ7T/m5nhOG','ogulcan','sdqw','ibrahimdonmez1983@yahoo.com','1231231231','driver','e2cb0f57bf63f9df'),(36,'asdadas','$2y$10$gFdv5ekNqGn8IytXFkyYR.96K/sgQuNvUjRgHfbXIXxBZg8RAddVu','ogulcan','asdasd','ibrahimdonmez1983@yahoo.com','1231231231','driver','e2cb0f57bf63f9df'),(37,'asda143','$2y$10$EtrFpnvUZ95Pb.zbKgGe5u9HCUEuECMIIc6EXYX68W6htCButHH.S','ogulcan','asdasd','asdad@asd.adf','1231231231','driver','e2cb0f57bf63f9df'),(38,'ogulcan2','$2y$10$O/sjWgphQ0bO9spX7dffMOHZHN2wleWJHZJkNCTrJ7yln29vrPhIi','ogulcan','asdasd','ibrahimdonmez1983@yahoo.com','1241241231','driver','e2cb0f57bf63f9df');
/*!40000 ALTER TABLE `users_temporary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'PedicabsOnDemand'
--

--
-- Dumping routines for database 'PedicabsOnDemand'
--
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
/*!50003 DROP FUNCTION IF EXISTS `ConvertToNYTime` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `ConvertToNYTime`(input_time TIMESTAMP) RETURNS timestamp
BEGIN
    RETURN CONVERT_TZ(input_time, @@session.time_zone, 'America/New_York');
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-08 10:17:46
