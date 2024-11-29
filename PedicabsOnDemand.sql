/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.6.19-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: PedicabsOnDemand
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
  `bookingFee` decimal(10,2) NOT NULL,
  `driverFee` decimal(10,2) NOT NULL,
  `totalFare` decimal(10,2) NOT NULL,
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
  `baseFare` decimal(10,2) NOT NULL,
  `operationFare` decimal(10,2) NOT NULL,
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
INSERT INTO `centralpark` (`id`, `bookingNumber`, `numberOfPassengers`, `date`, `hour`, `minutes`, `ampm`, `destinationAddress`, `destinationCoords`, `paymentMethod`, `firstName`, `lastName`, `emailAddress`, `phoneNumber`, `bookingFee`, `driverFee`, `totalFare`, `createdAt`, `updated_at`, `duration`, `pickupAddress`, `pickUpCoords`, `returnDuration`, `tourDuration`, `pickUpDuration`, `hub`, `hubCoords`, `baseFare`, `operationFare`, `pickUpTime`, `status`, `driver`, `sms_sent`, `totalMinutes`, `unique_id`) VALUES ('d3b51a56d8f79d69','2024-09-09-17-13-2024-09-09-16-38-d3b51a56d8f79d69',2,'09/09/2024',0,0,'','1000 5th Ave, New York, NY 10028 (The Metropolitan Museum of Art)','40.7794366,-73.963244','CARD','Alison','Lay Cranston','alsamae@gmail.com','+15757799585',16.97,74.66,91.63,'2024-09-09 16:38:47','2024-09-09 18:56:01','87.88','1000 5th Ave, New York, NY 10028 (The Metropolitan Museum of Art)','40.7794366,-73.963244','',40,'','','',0.00,84.84,'05:13 PM','past','John86',1,135.75,'56a4231342b610b78a9e10f1cddea3fd'),('e95b127385202911','2024-10-21-14-54-2024-10-21-14-32-e95b127385202911',2,'10/21/2024',0,0,'','EAST 72ND ST +, Center Drive, New York, NY 10021 (Central Park Boathouse)','40.769257,-73.9594274','CASH','Elaine','Fisher','elaineyfish@live.co.uk','+447748648951',10.07,40.26,50.33,'2024-10-21 14:32:55','2024-10-21 16:29:28','39.80','109 W 38th St, New York, NY 10018','40.7527077,-73.9863856','',1,'','','',0.00,50.33,'02:54 PM','past','AlexRad',1,80.53,'06fdffe45b02f84407e32295cceecab0');
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
  `bookingFee` decimal(10,2) NOT NULL,
  `driverFee` decimal(10,2) NOT NULL,
  `totalFare` decimal(10,2) NOT NULL,
  `createdAt` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `duration` varchar(555) NOT NULL,
  `pickupAddress` text NOT NULL,
  `pickUpCoords` text NOT NULL,
  `returnDuration` text NOT NULL,
  `pickUpDuration` text NOT NULL,
  `hub` text NOT NULL,
  `hubCoords` text NOT NULL,
  `baseFare` decimal(10,2) NOT NULL,
  `operationFare` decimal(10,2) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` (`id`, `bookingNumber`, `driverUsername`, `driverName`, `driverLastName`, `action`, `perm`, `timestamp`) VALUES (54,'2024-09-09-17-13-2024-09-09-16-38-d3b51a56d8f79d69','John86','Murodjon','Mirboboev','Central Accepted!','driver','2024-09-09 23:40:03'),(56,'2024-10-21-14-54-2024-10-21-14-32-e95b127385202911','AlexRad','Aleksandar','Radovanovic','Central Accepted!','driver','2024-10-21 21:33:45');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone_number` varchar(444) NOT NULL,
  `name` varchar(555) NOT NULL,
  `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sent_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` (`id`, `phone_number`, `name`, `body`, `sent_at`) VALUES (69,'+12095951174','Lenora Gerber','Okay 👍','2024-09-24 12:41:46'),(95,'whatsapp:+16197079268','Nadim Ghafari','Hello. Yeah, i Am new to new york and having issues with public transport. I am trying yo get on time for the appointment but i might be late around 30 minutes','2024-09-27 10:39:09'),(96,'whatsapp:+16197079268','Nadim Ghafari','is that okay ?','2024-09-27 10:39:11'),(97,'whatsapp:+447557400775','Maxine Hill','Hi we are here is there any possibility that we could leave earlier?','2024-09-28 11:00:09'),(98,'whatsapp:+18483504003','Dr Anuja Gaurinandan','Hello yes','2024-09-30 11:00:16'),(99,'whatsapp:+18483504003','Dr Anuja Gaurinandan','See you','2024-09-30 11:00:19'),(100,'whatsapp:+447979385865','Joanne Burton','Hello, we need to cancel this. I have cancelled the payment so please cancel. Thank you','2024-10-02 01:48:06'),(101,'+18587898672','Jycel Garcia','here at starbucks located at W 57th and 6th ave','2024-10-02 09:51:52'),(102,'+12508695011','Myrna MacKenzie','Where do I meet you?','2024-10-02 09:58:53'),(103,'+16198844577','Allison Balaguer','looking forward to it, thanks!','2024-10-03 09:30:27'),(104,'whatsapp:+19177537017','Patricia Springer','I\'m  here at Duane Reade','2024-10-03 09:55:40'),(105,'+18082270192','Julia Salvido','10am with Billy, right?','2024-10-04 09:48:12'),(106,'+17188019199',' Kathryn Rando','Thank you! ','2024-10-06 14:04:18'),(107,'whatsapp:+13462219940','Qingfang Zhao','Tks for the reminder. See u later','2024-10-07 14:16:36'),(108,'+13473628633','Unknown','Hi , This is Felícita , Nico’s wife . Here is my number . ','2024-10-08 19:01:59'),(109,'+17705954150','Amber Wickham','Hello - We made a mistake and meant to book our pedicab for tomorrow, 10/12. Can we reschedule? ','2024-10-11 08:38:13'),(110,'whatsapp:+34647334789','Carlos Martinez','Hi there do you have blankets for passengers ?','2024-10-11 08:54:56'),(111,'+15707023715',' Rohan Dhekane','See you\nThanks ','2024-10-13 09:49:10'),(112,'whatsapp:+17874321248','Jomary Rodriguez Negron','Gracias por comunicarte con Jomary’s Custom Designs. Por favor, haznos saber cómo podemos ayudarte.','2024-10-14 08:00:05'),(113,'+17874321248','Jomary Rodriguez Negron','Yes ','2024-10-14 08:37:39'),(114,'whatsapp:+447725529495','Jessica Reynolds','Standing outside the Duane pharmacy now 🙂','2024-10-14 11:19:08'),(115,'+447590046615','Sara Mcquitty','Hello we are waiting at the meeting point nobody here','2024-10-15 09:58:27'),(116,'whatsapp:+447972870466','Gillian Quigley','Hi, I’m at the corner of 6th & w 57th. Am I at the correct place','2024-10-17 11:14:35'),(117,'whatsapp:+447972870466','Gillian Quigley','Phone number is not working','2024-10-17 11:15:57'),(119,'whatsapp:+447774316086','Karen Roberts','Hi. Where do we meet you?','2024-10-19 09:49:25'),(120,'whatsapp:+19092864914','Joseph Muto','Can you tell me again where we meet you','2024-10-19 10:30:29'),(121,'whatsapp:+33673822779','Sylvie Guilbaud','Yes, Thank you, see u then','2024-10-19 12:33:30'),(122,'whatsapp:+393382515884','Annamaria Barrile','See you in a few minutes','2024-10-19 12:48:34'),(123,'whatsapp:+16474045233','Jade Desouza','Hello, we are here at the meeting point, do you know when the pedicab will be here?','2024-10-21 15:54:01'),(124,'whatsapp:+447900923845',' Jenny Fillingham','Hi we are waiting here is this the correct address?','2024-10-22 10:04:30'),(125,'+12075709739','Nichole Jipson Soucy','this is the wrong number','2024-10-25 11:17:21'),(126,'+13614296773','Christine Ramos','Where r u at','2024-10-25 12:44:30'),(127,'+19176602574','eric adjmi','See you in 10 minutes ','2024-10-25 20:35:10'),(128,'whatsapp:+31637327559','Annemarie de Gama','It was a very great tour. Thank you very much.Greatings Annemarie.','2024-10-26 19:11:28'),(129,'+15592856533','Victoria Jackson','We are here','2024-10-28 11:24:21'),(130,'whatsapp:+33698912745','Lina Taha','Hi so it’s at 10:45 as you said ? (Other number )','2024-10-30 10:09:39'),(131,'whatsapp:+33782522053','BERENICE DEVRESSE','Hello, we will be there in 20 minutes.','2024-10-31 14:12:22'),(132,'+14087037324','Unknown','Hi there','2024-11-02 15:47:54'),(133,'whatsapp:+353851233440','Donna Buckley','Great see you soon thanks','2024-11-05 09:40:38'),(134,'+16107629490','Vivek Singh','I\'m here','2024-11-05 12:39:43'),(135,'whatsapp:+48512615969','Ewa Nordgard','Hello, thank you','2024-11-06 11:21:53'),(136,'whatsapp:+48512615969','Ewa Nordgard','We are at the park now so if possible to go faster please let us know','2024-11-06 11:22:13'),(137,'whatsapp:+41765670211','Nadia Sciullo Le Donne','hello were is the meeting ppintu?','2024-11-06 12:38:19'),(138,'whatsapp:+41765670211','Nadia Sciullo Le Donne','point','2024-11-06 12:38:24'),(139,'whatsapp:+41765670211','Nadia Sciullo Le Donne','is this the correct place?','2024-11-06 12:53:00'),(140,'whatsapp:+13235940134','Kazariann Guzman','Hello good morning, I was wondering where we meet for pick up of our tour? Thank you.','2024-11-08 07:22:17'),(141,'+13059684622','Luis Lopez','Hi thanks see you soon! We want to go to the Oak Bridge in Central Park, will the pedicab be able to make it there on the paths?','2024-11-08 09:25:06');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
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
  `bookingFee` decimal(10,2) NOT NULL,
  `driverFee` decimal(10,2) NOT NULL,
  `totalFare` decimal(10,2) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `duration` varchar(555) NOT NULL,
  `pickupAddress` text NOT NULL,
  `pickUpCoords` text NOT NULL,
  `returnDuration` text NOT NULL,
  `pickUpDuration` text NOT NULL,
  `hub` text NOT NULL,
  `hubCoords` text NOT NULL,
  `baseFare` decimal(10,2) NOT NULL,
  `operationFare` decimal(10,2) NOT NULL,
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
INSERT INTO `pointatob` (`id`, `bookingNumber`, `numberOfPassengers`, `date`, `hour`, `minutes`, `ampm`, `destinationAddress`, `destinationCoords`, `paymentMethod`, `firstName`, `lastName`, `emailAddress`, `phoneNumber`, `bookingFee`, `driverFee`, `totalFare`, `createdAt`, `updated_at`, `duration`, `pickupAddress`, `pickUpCoords`, `returnDuration`, `pickUpDuration`, `hub`, `hubCoords`, `baseFare`, `operationFare`, `pickUpTime`, `status`, `driver`, `sms_sent`, `totalMinutes`, `unique_id`) VALUES ('6febb732932eab21','2024-09-19-13-21-2024-09-19-13-11-6febb732932eab21',2,'09/19/2024',0,0,'','45 E 42nd St, New York, NY 10017','40.7527746,-73.9787253','CASH','Nicholas','Norris','nicknorris12@gmail.com','+12054467783',5.38,21.54,26.92,'2024-09-19 13:11:06','2024-09-20 10:35:30','18.42','1725 Broadway, New York, NY 10019','40.7646672,-73.9824954','19.7','4.95','West Drive and West 59th Street New York, NY 10019','40.766941088678855, -73.97899952992152',0.00,26.92,'01:21 PM','failed','',0,43.07,'58848beaeeeb9690774dae984458ba77');
/*!40000 ALTER TABLE `pointatob` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rates`
--

DROP TABLE IF EXISTS `rates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ratename` varchar(255) NOT NULL,
  `hourlyOperationFare` decimal(10,2) DEFAULT NULL,
  `hourlyOperationFareWeekends` decimal(10,2) DEFAULT NULL,
  `hourlyOperationFareDecember` decimal(10,2) DEFAULT NULL,
  `hourlyOperationFareWeekendsDecember` decimal(10,2) DEFAULT NULL,
  `minFareCashWeek` decimal(10,2) DEFAULT NULL,
  `minFareCashWeekend` decimal(10,2) DEFAULT NULL,
  `minFareCashWeekDecember` decimal(10,2) DEFAULT NULL,
  `minFareCashWeekendDecember` decimal(10,2) DEFAULT NULL,
  `minFareCardWeek` decimal(10,2) DEFAULT NULL,
  `minFareCardWeekend` decimal(10,2) DEFAULT NULL,
  `minFareCardWeekDecember` decimal(10,2) DEFAULT NULL,
  `minFareCardWeekendDecember` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rates`
--

LOCK TABLES `rates` WRITE;
/*!40000 ALTER TABLE `rates` DISABLE KEYS */;
INSERT INTO `rates` (`id`, `ratename`, `hourlyOperationFare`, `hourlyOperationFareWeekends`, `hourlyOperationFareDecember`, `hourlyOperationFareWeekendsDecember`, `minFareCashWeek`, `minFareCashWeekend`, `minFareCashWeekDecember`, `minFareCashWeekendDecember`, `minFareCardWeek`, `minFareCardWeekend`, `minFareCardWeekDecember`, `minFareCardWeekendDecember`) VALUES (1,'Central Park',37.50,45.00,52.50,60.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,'Hourly',37.50,45.00,52.50,60.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'Point A to B',37.50,45.00,52.50,60.00,18.75,22.50,25.00,30.00,20.25,24.30,27.00,32.40);
/*!40000 ALTER TABLE `rates` ENABLE KEYS */;
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
  `tour_duration` varchar(555) DEFAULT NULL,
  `country_code` varchar(10) DEFAULT NULL,
  `country_name` varchar(100) DEFAULT NULL,
  `service_details` text DEFAULT NULL,
  `hub` varchar(255) DEFAULT NULL,
  `pick_up_duration` varchar(50) DEFAULT NULL,
  `service_duration` varchar(50) DEFAULT NULL,
  `base_fare` varchar(55) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temporaryBookings`
--

LOCK TABLES `temporaryBookings` WRITE;
/*!40000 ALTER TABLE `temporaryBookings` DISABLE KEYS */;
INSERT INTO `temporaryBookings` (`id`, `unique_id`, `num_passengers`, `pick_up_address`, `destination_address`, `payment_method`, `first_name`, `last_name`, `email`, `phone_number`, `booking_fee`, `driver_fare`, `total_fare`, `ride_duration`, `return_duration`, `operation_fare`, `pickup1`, `pickup2`, `return1`, `return2`, `toursuresi`, `hourly_operation_fare`, `tour_duration`, `country_code`, `country_name`, `service_details`, `hub`, `pick_up_duration`, `service_duration`, `base_fare`, `created_at`) VALUES (88,'56a4231342b610b78a9e10f1cddea3fd',2,'1000 5th Ave, New York, NY 10028 (The Metropolitan Museum of Art)','1000 5th Ave, New York, NY 10028 (The Metropolitan Museum of Art)','card','Alison','Lay Cranston','alsamae@gmail.com','5757799585',16.97,74.66,91.63,'87.875','',84.84,'30','17.875','30','17.875','0.00',37.50,'40','1',NULL,NULL,NULL,NULL,NULL,NULL,'2024-09-09 20:38:44'),(94,'58848beaeeeb9690774dae984458ba77',2,'1725 Broadway, New York, NY 10019','45 E 42nd St, New York, NY 10017','CASH','Nicholas','Norris','nicknorris12@gmail.com','2054467783',5.38,21.54,26.92,'18.42','19.7',26.92,NULL,NULL,NULL,NULL,NULL,37.50,NULL,'1',NULL,NULL,'West Drive and West 59th Street New York, NY 10019','4.95',NULL,NULL,'2024-09-19 17:11:03'),(95,'06fdffe45b02f84407e32295cceecab0',2,'109 W 38th St, New York, NY 10018','EAST 72ND ST +, Center Drive, New York, NY 10021 (Central Park Boathouse)','CASH','Elaine','Fisher','elaineyfish@live.co.uk','7748648951',10.07,40.26,50.33,'39.8','',50.33,'16.425','15.55','23.25','24.3','14.45',37.50,'1 Hour (Stop at Cherry Hill + Strawberry Fields + Bethesda Fountain)','44',NULL,NULL,NULL,NULL,NULL,NULL,'2024-10-21 18:32:39');
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
  `verify` int(11) DEFAULT 0,
  `pdf_id` varchar(555) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `user`, `pass`, `name`, `surname`, `email`, `number`, `perm`, `verify`, `pdf_id`) VALUES (1,'ogulcan','$2y$10$Q9x2658Co2nLU3iY1OUYyuPjmQ2QrcvlmT6VO0WfQdHOAhb9WiPXy','Ogulcan','Ozdogan','ogulcanozdogan@gmail.com','6562002544','admin',1,''),(6,'ibrahim','$2y$10$NnkYTqizdA1bkxQvQK/zYuNifLLQ5pGd9ss5p9FOOas9NvFxpNd4q','IBRAHIM','DONMEZ','ibrahimdonmez1983@gmail.com','2129617435','admin',1,''),(39,'bill2@inbox.ru','$2y$10$XJ/fjwUX3NwVycGRKQObOOsfgdfbmMW73ediYY8mVY2141CvEsTGu','Abul','Kkhan','bill2@inbox.ru','3475361773','driver',1,'c51afc9c3ab4f522'),(40,'renzofine0812','$2y$10$6kNK6PS3WnOnXkxPNL/CCO3EfEb6PXuiMIGVGM38A4bcSrcnrLNxu','Moussa','Fall','strongmind79@yahoo.com','6463186953','driver',1,'0ac53881abbc735e'),(41,'Benjamin','$2y$10$SEjhhggFbrLVNh70GPTR..ndoeRyJwjJF5GfJYcZcdpNHnniuqPXi','Bunyani','Durak','bunyamindurakusa@gmail.com','3473922263','driver',1,'e25c8360b4e4a184'),(42,'Devilman','$2y$10$bjTRTRE4qz49Hrc7PKCdMe3GxmN50ppRE5fK.kg2WU8kXD55iKgLW','Kenneth','Winter','cityparktours@gmail.com','9179810917','driver',1,'1f71bd2960bb435b'),(45,'ceka1983','$2y$10$DsrSEsR/eePItZDbdIRE8uprg0d5RRaewkg0u0i/iH9SQWJf/6kl2','Jeyhun','Hasanov','jeyhun_hasanov@yahoo.com','6466730954','driver',1,'be3d71830026bae4'),(46,'Fenerbahce1907','$2y$10$P79glPCVNL4Lg/K0lUPq8uGWTt8Qw5/6GK8tgbET2SJT9SEkYR6ra','Levent','Gulkok','info@rideincentralpark.com','2014920681','driver',1,'447a080db9bd8569'),(48,'Maruf','$2y$10$DI/uUQuxgyJtDJPhjUb0t.PUJyJmlOn7xmq0eca2A3GUWb.coJ57m','Marufjon','Hafizov','mkh29908@gmail.com','9296647280','driver',1,'7c5fb655c8e3f4f9'),(49,'Benjaminh','$2y$10$8zt12OQoX5m0dY/2F/27QuZ9LAiPLIIQ73V4Ncuwy09xiUb/BRgPe','Benjamin','Harris','benjaminharris174@gmail.com','3473373174','driver',1,'9c849a93aa079ade'),(50,'John86','$2y$10$aSKZOI8o0cYzqQ65qMfFquWFK2wh82TqFYvgIIT7uxvuVs5okizwe','Murodjon','Mirboboev','dbr.mika@gmail.com','9294445445','driver',1,'a6b91db43b710983'),(54,'AlexRad','$2y$10$ER37Z2ocHKQGxqkEBC07q.Y.iQzI6gJ62xp2GUzK.jduCcm97aoD6','Aleksandar','Radovanovic','sasaradovanovic82@yahoo.com','3478279308','driver',1,'ace27c852114629f'),(55,'Achilov89','$2y$10$QnJ8c76Jjra9F5AwwxVIMuJUjr.hfdTrmkEJh0nAWv.uAj4p8mWH6','Dilmurod','Achilov','achilov89@yahoo.com','2063991625','driver',1,'dce61338302041b0');
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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_temporary`
--

LOCK TABLES `users_temporary` WRITE;
/*!40000 ALTER TABLE `users_temporary` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_temporary` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zip_codes`
--

DROP TABLE IF EXISTS `zip_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zip_codes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zip_code` varchar(10) NOT NULL,
  `app_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zip_codes`
--

LOCK TABLES `zip_codes` WRITE;
/*!40000 ALTER TABLE `zip_codes` DISABLE KEYS */;
INSERT INTO `zip_codes` (`id`, `zip_code`, `app_id`) VALUES (1,'10017',1),(2,'10018',1),(3,'10019',1),(4,'10020',1),(5,'10022',1),(6,'10036',1),(7,'10055',1),(8,'10101',1),(9,'10102',1),(10,'10103',1),(11,'10104',1),(12,'10105',1),(13,'10106',1),(14,'10107',1),(15,'10108',1),(16,'10109',1),(17,'10110',1),(18,'10111',1),(19,'10112',1),(20,'10124',1),(21,'10126',1),(22,'10129',1),(23,'10151',1),(24,'10152',1),(25,'10153',1),(26,'10154',1),(27,'10155',1),(28,'10163',1),(29,'10164',1),(30,'10166',1),(31,'10167',1),(32,'10169',1),(33,'10170',1),(34,'10171',1),(35,'10172',1),(36,'10173',1),(37,'10174',1),(38,'10175',1),(39,'10176',1),(40,'10177',1),(41,'10179',1),(42,'10185',1),(43,'10000',1),(44,'10001',1),(45,'10016',1),(46,'10021',1),(47,'10023',1),(48,'10024',1),(49,'10028',1),(50,'10065',1),(51,'10075',1),(52,'10017',2),(53,'10018',2),(54,'10019',2),(55,'10020',2),(56,'10022',2),(57,'10036',2),(58,'10055',2),(59,'10101',2),(60,'10102',2),(61,'10103',2),(62,'10104',2),(63,'10105',2),(64,'10106',2),(65,'10107',2),(66,'10108',2),(67,'10109',2),(68,'10110',2),(69,'10111',2),(70,'10112',2),(71,'10124',2),(72,'10126',2),(73,'10129',2),(74,'10151',2),(75,'10152',2),(76,'10153',2),(77,'10154',2),(78,'10155',2),(79,'10163',2),(80,'10164',2),(81,'10166',2),(82,'10167',2),(83,'10169',2),(84,'10170',2),(85,'10171',2),(86,'10172',2),(87,'10173',2),(88,'10174',2),(89,'10175',2),(90,'10176',2),(91,'10177',2),(92,'10179',2),(93,'10185',2),(94,'10000',2),(95,'10001',2),(96,'10016',2),(97,'10021',2),(98,'10023',2),(99,'10024',2),(100,'10028',2),(101,'10065',2),(102,'10075',2),(105,'10019',3),(106,'10020',3),(107,'10022',3),(108,'10036',3),(109,'10055',3),(110,'10101',3),(111,'10102',3),(112,'10103',3),(113,'10104',3),(114,'10105',3),(115,'10106',3),(116,'10107',3),(117,'10108',3),(118,'10109',3),(119,'10110',3),(120,'10111',3),(121,'10112',3),(122,'10124',3),(123,'10126',3),(124,'10129',3),(125,'10151',3),(126,'10152',3),(127,'10153',3),(128,'10154',3),(129,'10155',3),(130,'10163',3),(131,'10164',3),(132,'10166',3),(133,'10167',3),(134,'10169',3),(135,'10170',3),(136,'10171',3),(137,'10172',3),(138,'10173',3),(139,'10174',3),(140,'10175',3),(141,'10176',3),(142,'10177',3),(143,'10179',3),(144,'10185',3),(145,'10000',3),(146,'10001',3),(147,'10016',3),(148,'10021',3),(149,'10023',3),(150,'10024',3),(151,'10028',3),(152,'10065',3),(153,'10075',3),(155,'10018',3),(158,'10017',3);
/*!40000 ALTER TABLE `zip_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'PedicabsOnDemand'
--

--
-- Dumping routines for database 'PedicabsOnDemand'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-08 11:44:11
