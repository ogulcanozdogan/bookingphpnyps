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
  `status` varchar(555) NOT NULL DEFAULT 'available',
  `driver` varchar(555) DEFAULT NULL,
  `sms_sent` int(11) NOT NULL DEFAULT 0,
  `totalMinutes` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `centralpark`
--

LOCK TABLES `centralpark` WRITE;
/*!40000 ALTER TABLE `centralpark` DISABLE KEYS */;
INSERT INTO `centralpark` (`id`, `bookingNumber`, `numberOfPassengers`, `date`, `hour`, `minutes`, `ampm`, `destinationAddress`, `destinationCoords`, `paymentMethod`, `firstName`, `lastName`, `emailAddress`, `phoneNumber`, `bookingFee`, `driverFee`, `totalFare`, `createdAt`, `updated_at`, `duration`, `pickupAddress`, `pickUpCoords`, `returnDuration`, `tourDuration`, `pickUpDuration`, `hub`, `hubCoords`, `baseFare`, `operationFare`, `status`, `driver`, `sms_sent`, `totalMinutes`) VALUES ('07263c1053cfa40e','2024-07-08-19-07-2024-07-08-18-47-07263c1053cfa40e',1,'07/08/2024',0,0,'','888 7th Avenue, New York, NY 10106','40.7654863,-73.9808532','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',9.36,37.45,46.81,'2024-07-08 18:47:28','2024-07-08 18:57:01','54.5','425 Park Ave, New York, NY 10022','40.7605182,-73.9712319','',40,'','','',0,46.8125,'past','ogulcan',1,74.9),('3311be27b92a5693','2024-07-09-14-16-2024-07-09-14-01-3311be27b92a5693',2,'07/09/2024',0,0,'','45 E 45th St, New York, NY 10017','40.7549394,-73.9772689','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',11.74,46.98,58.72,'2024-07-09 14:01:05','2024-07-09 14:01:21','68.125','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','',40,'','','',0,58.7188,'past','ogulcan',1,93.95),('44abd5fdabeee091','2024-07-05-17-06-2024-07-05-16-34-44abd5fdabeee091',1,'07/05/2024',0,0,'','432 Park Ave, New York, NY 10022, Amerika Birleşik Devletleri','40.7617561,-73.9719035','CASH','Yiğit','Tahir','yigittahir50@gmail.com','+12024991588',16.78,67.13,83.91,'2024-07-05 13:34:23','2024-07-08 16:12:01','77.2','222 E 41st St, New York, NY 10017, Amerika Birleşik Devletleri','40.7500825,-73.9746016','',45,'','','',0,83.9062,'failed','none',0,0),('47a12a9819a47200','2024-07-05-13-15-2024-07-05-13-00-47a12a9819a47200',3,'07/05/2024',0,0,'','45 E 45th St, New York, NY 10017, Amerika Birleşik Devletleri','40.7549394,-73.9772689','CASH','Yiğit','Tahir','yigittahir50@gmail.com','+15354618582',14.09,56.37,70.46,'2024-07-05 10:00:15','2024-07-08 16:12:01','68.125','30 Rockefeller Plaza, New York, NY 10112, Amerika Birleşik Devletleri','40.7593755,-73.9799726','',0,'','','',0,70.4625,'failed','none',1,0),('4fda28a9a9982ed4','2024-07-08-15-47-2024-07-08-15-32-4fda28a9a9982ed4',2,'07/08/2024',0,0,'','45 E 42nd St, New York, NY 10017 (SUMMIT One Vanderbilt)','40.752764,-73.9787461','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',14.76,59.04,73.8,'2024-07-08 15:32:03','2024-07-08 16:12:01','91.25','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','',60,'','','',0,73.7969,'failed','none',0,118.075),('5596c84a0635599b','2024-07-09-18-34-2024-07-09-18-15-5596c84a0635599b',1,'07/09/2024',0,0,'','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',11.8,47.2,59,'2024-07-09 18:15:24','2024-07-09 18:47:43','71.425','625 8th Ave, New York, NY 10018','40.7569282,-73.9905282','',40,'','','',0,59,'failed',NULL,0,94.4),('56673405bff57cc2','2024-07-05-13-09-2024-07-05-12-54-56673405bff57cc2',2,'07/05/2024',0,0,'','222 E 41st St, New York, NY 10017','40.7493378,-73.9740737','CASH','recep tayyip','erdogan','yigittahir50@gmail.com','+12024991588',16.71,66.83,83.53,'2024-07-05 09:54:06','2024-07-08 16:12:01','76.675','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','',0,'','','',0,83.5312,'failed','none',1,0),('5c19f83cb3f902ce','2024-07-08-18-30-2024-07-08-18-10-5c19f83cb3f902ce',1,'07/08/2024',0,0,'','888 7th Avenue, New York, NY 10106','40.7654863,-73.9808532','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',9.36,37.45,46.81,'2024-07-08 18:10:25','2024-07-08 18:20:01','54.5','425 Park Ave, New York, NY 10022','40.7605182,-73.9712319','',40,'','','',0,46.8125,'past','ogulcan',1,74.9),('5eeb971e8e6875c4','2024-07-08-13-09-2024-07-08-12-54-5eeb971e8e6875c4',2,'07/08/2024',0,0,'','45 E 45th St, New York, NY 10017','40.7549394,-73.9772689','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',11.74,46.98,58.72,'2024-07-08 09:54:34','2024-07-08 16:12:01','68.125','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','',40,'','','',0,58.7188,'failed','none',1,0),('5ef8c82896ef3ca0','2024-07-08-14-09-2024-07-08-13-54-5ef8c82896ef3ca0',2,'07/08/2024',0,0,'','45 E 45th St, New York, NY 10017','40.7549394,-73.9772689','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',11.74,46.98,58.72,'2024-07-08 13:54:11','2024-07-08 16:12:01','68.125','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','',40,'','','',0,58.7188,'failed','none',0,0),('63fddae732ae30ee','2024-07-05-13-23-2024-07-05-13-08-63fddae732ae30ee',3,'07/05/2024',0,0,'','45 E 45th St, New York, NY 10017','40.7549394,-73.9772689','CASH','Ogulcan','Ozdogan','ogulcanozdogan@gmail.com','+16562002544',14.09,56.37,70.46,'2024-07-05 10:08:05','2024-07-08 16:12:01','68.125','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','',0,'','','',0,70.4625,'failed','none',1,0),('74b005c7bedeaa51','2024-07-04-14-15-2024-07-04-13-59-74b005c7bedeaa51',3,'07/04/2024',0,0,'','45 E 45th St, New York, NY 10017, Amerika Birleşik Devletleri','40.7549394,-73.9772689','card','Yiğit','Tahir','yigittahir50@gmail.com','+15354618582',11.74,51.67,63.42,'2024-07-04 10:59:57','2024-07-08 16:12:01','68.125','30 Rockefeller Plaza, New York, NY 10112, Amerika Birleşik Devletleri','40.7593755,-73.9799726','',0,'','','',0,58.7188,'failed','none',0,0),('8dfc6ca01755b219','2024-07-09-11-59-2024-07-09-11-44-8dfc6ca01755b219',3,'07/09/2024',0,0,'','45 E 45th St, New York, NY 10017, Amerika Birleşik Devletleri','40.7549394,-73.9772689','CASH','Yiğit','Tahir','yigittahir50@gmail.com','+12024991588',11.74,46.98,58.72,'2024-07-09 11:44:04','2024-07-09 13:20:02','68.125','30 Rockefeller Plaza, New York, NY 10112, Amerika Birleşik Devletleri','40.7593755,-73.9799726','',40,'','','',0,58.7188,'past','ajdarfan1973',1,93.95),('a7cf14fb9442c887','2024-07-05-14-02-2024-07-05-13-47-a7cf14fb9442c887',1,'07/05/2024',0,0,'','45 E 45th St, New York, NY 10017, Amerika Birleşik Devletleri','40.7549394,-73.9772689','CASH','Yiğit','Tahir','yigittahir50@gmail.com','+16562002544',14.09,56.37,70.46,'2024-07-05 10:47:24','2024-07-08 16:12:01','68.125','30 Rockefeller Plaza, New York, NY 10112, Amerika Birleşik Devletleri','40.7593755,-73.9799726','',0,'','','',0,70.4625,'failed','none',1,0),('b7e3a8c027eb499a','2024-07-05-14-36-2024-07-05-14-20-b7e3a8c027eb499a',1,'07/05/2024',0,0,'','45 E 45th St, New York, NY 10017, Amerika Birleşik Devletleri','40.7549394,-73.9772689','CASH','Yiğit','Tahir','yigittahir50@gmail.com','+12024991588',14.84,59.37,74.21,'2024-07-05 11:20:51','2024-07-08 16:12:01','73.125','30 Rockefeller Plaza, New York, NY 10112, Amerika Birleşik Devletleri','40.7593755,-73.9799726','',0,'','','',0,74.2125,'failed','none',0,0),('bece8d286f113f22','2024-07-04-13-55-2024-07-04-13-39-bece8d286f113f22',2,'07/04/2024',0,0,'','545 8th Ave, New York, NY 10018','40.7544946,-73.9921654','cash','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',12.62,50.46,63.08,'2024-07-04 10:39:56','2024-07-08 16:12:01','69.925','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','',0,'','','',0,63.0781,'failed','none',0,0),('c017de54db3ae3e8','2024-07-05-16-36-2024-07-05-16-14-c017de54db3ae3e8',3,'07/05/2024',0,0,'','787 7th Ave, New York, NY 10019','40.7614408,-73.9814491','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',14.91,59.66,74.57,'2024-07-05 13:14:34','2024-07-08 16:12:01','73.75','345 Park Ave, New York, NY 10154','40.7579332,-73.9722189','',50,'','','',0,74.5687,'failed','none',0,0),('c2b03388adae915f','2024-07-08-15-43-2024-07-08-15-28-c2b03388adae915f',2,'07/08/2024',0,0,'','45 E 42nd St, New York, NY 10017 (SUMMIT One Vanderbilt)','40.752764,-73.9787461','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',14.76,59.04,73.8,'2024-07-08 15:28:23','2024-07-08 16:12:01','91.25','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','',60,'','','',0,73.7969,'failed','none',0,209.325),('c672e76648fee232','2024-07-08-17-41-2024-07-08-17-20-c672e76648fee232',1,'07/08/2024',0,0,'','888 7th Avenue, New York, NY 10106','40.7654863,-73.9808532','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',9.36,37.45,46.81,'2024-07-08 18:32:43','2024-07-08 18:39:02','54.5','425 Park Ave, New York, NY 10022','40.7605182,-73.9712319','',40,'','','',0,46.8125,'past','ogulcan',1,5),('d27e1cebc1be25e2','2024-07-04-14-14-2024-07-04-13-58-d27e1cebc1be25e2',3,'07/04/2024',0,0,'','45 E 45th St, New York, NY 10017, Amerika Birleşik Devletleri','40.7549394,-73.9772689','CASH','Yiğit','Tahir','yigittahir50@gmail.com','+15354618582',11.74,46.98,58.72,'2024-07-04 10:58:50','2024-07-08 16:12:01','68.125','30 Rockefeller Plaza, New York, NY 10112, Amerika Birleşik Devletleri','40.7593755,-73.9799726','',0,'','','',0,58.7188,'failed','none',0,0),('db43d3256a19be2a','2024-07-05-14-34-2024-07-05-14-19-db43d3256a19be2a',1,'07/05/2024',0,0,'','555 Madison Ave, New York, NY 10022','40.7612329,-73.9726722','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',13.28,53.13,66.41,'2024-07-05 11:19:03','2024-07-08 16:12:01','67.425','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','',0,'','','',0,66.4125,'failed','none',0,0),('f020ed39a4a64143','2024-07-09-14-04-2024-07-09-13-48-f020ed39a4a64143',3,'',0,0,'','1221 6th Ave, New York, NY 10020, Amerika Birleşik Devletleri (1221 Avenue of the Americas)','40.759375,-73.9821001','CASH','Yiğit','Tahir','yigittahir50@gmail.com','+12024991588',10.26,41.04,51.3,'2024-07-09 13:48:03','2024-07-09 13:48:34','60.075','432 Park Ave, New York, NY 10022, Amerika Birleşik Devletleri','40.7617561,-73.9719035','',40,'','','',0,51.2969,'past','ajdarfan1973',1,82.075);
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
  `status` varchar(555) NOT NULL DEFAULT 'available',
  `driver` varchar(555) NOT NULL,
  `sms_sent` int(11) NOT NULL DEFAULT 0,
  `serviceDetails` text NOT NULL,
  `serviceDuration` varchar(500) NOT NULL,
  `totalMinutes` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hourly`
--

LOCK TABLES `hourly` WRITE;
/*!40000 ALTER TABLE `hourly` DISABLE KEYS */;
INSERT INTO `hourly` (`id`, `bookingNumber`, `numberOfPassengers`, `date`, `hour`, `minutes`, `ampm`, `destinationAddress`, `destinationCoords`, `paymentMethod`, `firstName`, `lastName`, `emailAddress`, `phoneNumber`, `bookingFee`, `driverFee`, `totalFare`, `createdAt`, `updated_at`, `duration`, `pickupAddress`, `pickUpCoords`, `returnDuration`, `pickUpDuration`, `hub`, `hubCoords`, `baseFare`, `operationFare`, `status`, `driver`, `sms_sent`, `serviceDetails`, `serviceDuration`, `totalMinutes`) VALUES ('00f4b0459c1cc6c2','2024-07-04-14-12-2024-07-04-13-54-00f4b0459c1cc6c2',3,'07/04/2024',0,0,'','30 Rockefeller Plaza, New York, NY 10112, Amerika Birle?ik Devletleri','40.7593755,-73.9799726','CASH','fgh','fghf','yigittahir50@gmail.com','+15051483131',19.51,78.05,97.56,'2024-07-04 10:54:50','2024-07-08 16:12:01','10.60','150 E 58th St #3200, New York, NY 10155, Amerika Birle?ik Devletleri (SDNY Dental)','40.7610509,-73.968041','12.45','13.05','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,97.5625,'failed','none',0,'ddfgdf','2 Hour',0),('0f67fb40ff5f9287','2024-07-09-18-30-2024-07-09-18-14-0f67fb40ff5f9287',2,'07/09/2024',0,0,'','40a 10th Ave, New York, NY 10014','40.741486,-74.008156','CASH','allah','recep tayiip','yigittahir50@gmail.com','+12024991588',16.1,64.39,80.48,'2024-07-09 18:14:54','2024-07-09 18:47:43','15.27','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','43.25','10.25','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,80.4812,'failed','',0,'asd','1 Hour',113.5),('1ebcd26eb84d4ea3','2024-07-09-14-28-2024-07-09-14-12-1ebcd26eb84d4ea3',2,'07/09/2024',0,0,'','40a 10th Ave, New York, NY 10014','40.741486,-74.008156','CASH','allah','recep tayiip','yigittahir50@gmail.com','+12024991588',16.1,64.39,80.48,'2024-07-09 14:12:58','2024-07-09 14:19:01','15.27','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','43.25','10.25','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,80.4812,'past','ogulcan',1,'asd','1 Hour',113.5),('2dc802452d562bd2','2024-07-08-15-40-2024-07-08-15-24-2dc802452d562bd2',3,'07/08/2024',0,0,'','80 Greenwich St, New York, NY 10006 (ASDS REP THEATER)','40.7074232,-74.0140785','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',22.99,91.98,114.97,'2024-07-08 15:24:52','2024-07-08 16:12:01','30.50','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','83.2','10.25','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,114.969,'failed','none',0,'34','1 Hour',153.45),('3a4025cd950e3d4f','2024-07-04-14-13-2024-07-04-13-55-3a4025cd950e3d4f',3,'07/04/2024',0,0,'','30 Rockefeller Plaza, New York, NY 10112, Amerika Birle?ik Devletleri','40.7593755,-73.9799726','card','fgh','fghf','yigittahir50@gmail.com','+15051483131',19.51,85.86,105.37,'2024-07-04 10:55:48','2024-07-08 16:12:01','10.60','150 E 58th St #3200, New York, NY 10155, Amerika Birle?ik Devletleri (SDNY Dental)','40.7610509,-73.968041','12.45','13.05','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,97.5625,'failed','none',0,'ddfgdf','2 Hour',0),('4c51b8ced4d0ab4f','2024-07-08-12-50-2024-07-08-12-34-4c51b8ced4d0ab4f',1,'07/08/2024',0,0,'','40a 10th Ave, New York, NY 10014','40.741486,-74.008156','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@gmail.com','+12129617435',16.11,64.43,80.53,'2024-07-08 09:34:46','2024-07-08 16:12:01','15.28','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','43.325','10.25','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,80.5344,'failed','none',0,'a','1 Hour',0),('4d3c9b62744ade9c','2024-07-08-12-54-2024-07-08-12-39-4d3c9b62744ade9c',1,'07/08/2024',0,0,'','40a 10th Ave, New York, NY 10014','40.741486,-74.008156','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@gmail.com','+12129617435',16.11,64.43,80.53,'2024-07-08 09:39:35','2024-07-08 16:12:01','15.28','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','43.325','10.25','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,80.5344,'failed','none',1,'a','1 Hour',0),('a150bfb100953d68','2024-07-05-15-13-2024-07-05-14-58-a150bfb100953d68',2,'07/05/2024',0,0,'','40a 10th Ave, New York, NY 10014','40.741486,-74.008156','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',14.83,59.31,74.14,'2024-07-05 11:58:43','2024-07-08 16:12:01','15.28','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','43.325','10.25','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,74.1413,'failed','none',0,'asd','30 Minutes',0),('b061d975fded7355','2024-07-08-14-17-2024-07-08-13-53-b061d975fded7355',2,'07/08/2024',0,0,'','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',11.96,47.84,59.8,'2024-07-08 13:53:02','2024-07-08 16:12:01','4.15','45 E 45th St, New York, NY 10017','40.7549394,-73.9772689','12.45','19.075','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,59.7969,'failed','none',0,'dasd','1 Hour',0),('b571a96df34ce8ee','2024-07-08-13-00-2024-07-08-12-44-b571a96df34ce8ee',1,'07/08/2024',0,0,'','40a 10th Ave, New York, NY 10014','40.741486,-74.008156','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@gmail.com','+12129617435',16.11,64.43,80.53,'2024-07-08 09:44:52','2024-07-08 16:12:01','15.28','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','43.325','10.25','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,80.5344,'failed','none',1,'a','1 Hour',0),('b75572380596601f','2024-07-04-13-46-2024-07-04-13-28-b75572380596601f',3,'07/04/2024',0,0,'','30 Rockefeller Plaza, New York, NY 10112, Amerika Birle?ik Devletleri','40.7593755,-73.9799726','cash','fgh','fghf','yigittahir50@gmail.com','+905051483131',19.51,78.05,97.56,'2024-07-04 10:28:40','2024-07-08 16:12:01','10.60','150 E 58th St #3200, New York, NY 10155, Amerika Birle?ik Devletleri (SDNY Dental)','40.7610509,-73.968041','12.45','13.05','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,97.5625,'failed','none',0,'ddfgdf','2 Hour',0),('cafe6393ea37d66a','2024-07-09-14-37-2024-07-09-14-13-cafe6393ea37d66a',1,'07/09/2024',0,0,'','30 Rockefeller Plaza, New York, NY 10112, Amerika Birle?ik Devletleri','40.7593755,-73.9799726','CASH','Yi?it','Tahir','yigittahir50@gmail.com','+12024991588',15.71,62.84,78.55,'2024-07-09 14:13:39','0000-00-00 00:00:00','4.15','45 E 45th St, New York, NY 10017, Amerika Birle?ik Devletleri','40.7549394,-73.9772689','12.45','19.075','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,78.5469,'past','ajdarfan1973',1,'4542344','90 Minutes',121.525),('cd04a19aa43db1da','2024-07-08-13-02-2024-07-08-12-47-cd04a19aa43db1da',1,'07/08/2024',0,0,'','40a 10th Ave, New York, NY 10014','40.741486,-74.008156','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@gmail.com','+12129617435',16.11,64.43,80.53,'2024-07-08 09:47:38','2024-07-08 16:12:01','15.28','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','43.325','10.25','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,80.5344,'failed','none',1,'a','1 Hour',0);
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
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pointatob`
--

LOCK TABLES `pointatob` WRITE;
/*!40000 ALTER TABLE `pointatob` DISABLE KEYS */;
INSERT INTO `pointatob` (`id`, `bookingNumber`, `numberOfPassengers`, `date`, `hour`, `minutes`, `ampm`, `destinationAddress`, `destinationCoords`, `paymentMethod`, `firstName`, `lastName`, `emailAddress`, `phoneNumber`, `bookingFee`, `driverFee`, `totalFare`, `createdAt`, `updated_at`, `duration`, `pickupAddress`, `pickUpCoords`, `returnDuration`, `pickUpDuration`, `hub`, `hubCoords`, `baseFare`, `operationFare`, `status`, `driver`, `sms_sent`, `totalMinutes`) VALUES ('072ab8ca32f713be','2024-07-05-15-08-2024-07-05-14-53-072ab8ca32f713be',2,'07/05/2024',0,0,'','45 E 45th St, New York, NY 10017','40.7549394,-73.9772689','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',9.74,38.95,48.69,'2024-07-05 11:53:20','2024-07-08 16:12:01','8.13','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','19','10.25','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',30,18.6875,'failed','none',0,0),('0ea1131df57c3226','2024-07-08-16-18-2024-07-08-16-02-0ea1131df57c3226',2,'07/08/2024',0,0,'','40a 10th Ave, New York, NY 10014','40.741486,-74.008156','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',11.92,47.68,59.6,'2024-07-08 16:02:48','2024-07-08 16:12:01','41.79','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','43.325','10.25','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,59.6031,'failed','none',0,95.365),('273468b3ce1fde6d','2024-07-05-18-26-2024-07-05-18-11-273468b3ce1fde6d',2,'07/05/2024',0,0,'','1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)','40.7442419,-73.9886085','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',7.21,28.83,36.03,'2024-07-05 15:11:35','2024-07-08 16:12:01','17.45','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','29.95','10.25','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,36.0312,'failed','none',0,0),('2977019981141c37','2024-07-09-19-13-2024-07-09-19-05-2977019981141c37',2,'07/09/2024',0,0,'','151 W 54th St, New York, NY 10019 (Conrad New York Midtown)','40.7634658,-73.9806007','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+16562002544',3.75,15,18.75,'2024-07-09 19:05:38','2024-07-10 07:41:01','2.58','881 7th Ave, New York, NY 10019 (Carnegie Hall)','40.7651258,-73.9799236','9.675','2.5','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,9.22375,'past','ogulcan',1,14.755),('31173e1182a4a915','2024-07-08-15-58-2024-07-08-15-21-31173e1182a4a915',2,'07/08/2024',0,0,'','28 Liberty Street, New York, NY 10005','40.7077585,-74.0088503','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',20.52,82.06,102.58,'2024-07-08 15:21:20','2024-07-08 16:12:01','47.50','4 Charles St #3004, New York, NY 10014 (4 Charles Prime Rib)','40.7351675,-74.0006537','83.95','32.675','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,102.578,'failed','none',0,164.125),('466f880417f8ef9b','2024-07-05-18-00-2024-07-05-17-45-466f880417f8ef9b',3,'07/05/2024',0,0,'','45 E 45th St, New York, NY 10017, Amerika Birle?ik Devletleri','40.7549394,-73.9772689','CASH','Yi?it','Tahir','yigittahir50@gmail.com','+15354618582',5.13,20.5,25.63,'2024-07-05 14:45:07','2024-07-08 16:12:01','11.75','30 Rockefeller Plaza, New York, NY 10112, Amerika Birle?ik Devletleri','40.7593755,-73.9799726','19','10.25','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,25.625,'failed','none',0,0),('477edf5d5e8567ee','2024-07-05-18-23-2024-07-05-18-07-477edf5d5e8567ee',2,'07/05/2024',0,0,'','1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)','40.7442419,-73.9886085','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',7.21,28.83,36.03,'2024-07-05 15:07:59','2024-07-08 16:12:01','17.45','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','29.95','10.25','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,36.0312,'failed','none',0,0),('48b7084b2bddb3ce','2024-07-08-16-50-2024-07-08-16-35-48b7084b2bddb3ce',1,'07/08/2024',0,0,'','45 E 45th St, New York, NY 10017','40.7549394,-73.9772689','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',4.67,18.69,23.36,'2024-07-08 16:35:07','2024-07-08 16:41:01','8.13','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','19','10.25','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,23.3594,'past','ogulcan',1,5),('4f963a664417ad70','2024-07-05-18-22-2024-07-05-18-07-4f963a664417ad70',2,'07/05/2024',0,0,'','1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)','40.7442419,-73.9886085','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',7.21,28.83,36.03,'2024-07-05 15:07:35','2024-07-08 16:12:01','17.45','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','29.95','10.25','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,36.0312,'failed','none',0,0),('5dee17f5ea340096','2024-07-09-14-34-2024-07-09-14-18-5dee17f5ea340096',2,'07/09/2024',0,0,'','45 E 45th St, New York, NY 10017, Amerika Birle?ik Devletleri','40.7549394,-73.9772689','CARD','Yi?it','Tahir','yigittahir50@gmail.com','+12024991588',5.13,22.55,27.68,'2024-07-09 14:18:58','2024-07-09 15:01:01','11.75','30 Rockefeller Plaza, New York, NY 10112, Amerika Birle?ik Devletleri','40.7593755,-73.9799726','19','10.25','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,25.625,'past','ajdarfan1973',1,41),('6580008cebc81232','2024-07-05-18-08-2024-07-05-17-31-6580008cebc81232',2,'07/05/2024',0,0,'','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',7.78,31.11,38.89,'2024-07-05 14:31:15','2024-07-08 16:12:01','32.66','4 Charles St #3004, New York, NY 10014 (4 Charles Prime Rib)','40.7351675,-74.0006537','12.45','32.675','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,38.8925,'failed','none',0,0),('73c6cf3a34dfbbb8','2024-07-08-14-38-2024-07-08-14-00-73c6cf3a34dfbbb8',2,'07/08/2024',0,0,'','28 Liberty Street, New York, NY 10005','40.7077585,-74.0088503','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',20.52,82.06,102.58,'2024-07-08 14:00:45','2024-07-08 16:12:01','47.50','4 Charles St #3004, New York, NY 10014 (4 Charles Prime Rib)','40.7351675,-74.0006537','83.95','32.675','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,102.578,'failed','none',0,0),('7668411d1c522dc8','2024-07-09-18-22-2024-07-09-18-14-7668411d1c522dc8',2,'07/09/2024',0,0,'','151 W 54th St, New York, NY 10019 (Conrad New York Midtown)','40.7634658,-73.9806007','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+16562002544',3.75,15,18.75,'2024-07-09 18:14:39','2024-07-09 18:47:43','2.58','881 7th Ave, New York, NY 10019 (Carnegie Hall)','40.7651258,-73.9799236','9.675','2.5','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,9.22375,'failed','',0,14.755),('7b5cba08d93fe1a3','2024-07-08-12-29-2024-07-08-12-14-7b5cba08d93fe1a3',2,'07/08/2024',0,0,'','45 E 45th St, New York, NY 10017','40.7549394,-73.9772689','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',4.67,18.69,23.36,'2024-07-08 09:14:32','2024-07-08 16:12:01','8.13','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','19','10.25','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,23.3594,'failed','none',0,0),('7c67c906f90590df','2024-07-10-12-17-2024-07-10-11-46-7c67c906f90590df',2,'07/10/2024',0,0,'','432 Park Ave, New York, NY 10022, Amerika Birle?ik Devletleri','40.7617561,-73.9719035','CASH','Yi?it','Tahir','yigittahir50@gmail.com','+15354618582',8.77,35.1,43.87,'2024-07-10 11:46:31','2024-07-10 11:52:01','27.12','1150 Broadway, New York, NY 10001, Amerika Birle?ik Devletleri (230 Fifth Rooftop Bar)','40.7442419,-73.9886085','16.825','26.25','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,43.8719,'failed','',0,70.195),('80fbf7c12c5d4cf8','2024-07-08-13-45-2024-07-08-13-30-80fbf7c12c5d4cf8',3,'07/08/2024',0,0,'','432 Park Ave, New York, NY 10022','40.7617561,-73.9719035','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',3.98,15.92,19.9,'2024-07-08 13:30:32','2024-07-08 16:12:01','8.83','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','12.75','10.25','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,19.8956,'failed','none',0,0),('9722339e98211f30','2024-07-05-18-04-2024-07-05-17-49-9722339e98211f30',3,'07/05/2024',0,0,'','45 E 45th St, New York, NY 10017, Amerika Birle?ik Devletleri','40.7549394,-73.9772689','CARD','Yi?it','Tahir','yigittahir50@gmail.com','+15354618582',5.76,25.33,31.08,'2024-07-05 14:49:08','2024-07-08 16:12:01','9.13','','','19','10.25','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,28.7812,'failed','none',0,0),('b7d9bb5da174aabc','2024-07-08-14-44-2024-07-08-14-06-b7d9bb5da174aabc',2,'07/08/2024',0,0,'','28 Liberty Street, New York, NY 10005','40.7077585,-74.0088503','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',20.52,82.06,102.58,'2024-07-08 14:06:34','2024-07-08 16:12:01','47.50','4 Charles St #3004, New York, NY 10014 (4 Charles Prime Rib)','40.7351675,-74.0006537','83.95','32.675','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,102.578,'failed','none',0,0),('bff253b60b2e7bcd','2024-07-09-17-48-2024-07-09-17-43-bff253b60b2e7bcd',2,'07/09/2024',0,0,'','7th Ave & West 59th Street, Central Park S, New York, NY 10019 (NYC Horse and Carriage Ride)','40.7669119,-73.979038','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+16562002544',3.75,15,18.75,'2024-07-09 17:43:03','2024-07-09 17:44:26','0.00','7th Ave & West 59th Street, Central Park S, New York, NY 10019 (NYC Horse and Carriage Ride)','40.7669119,-73.979038','0.05','0.3','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,0.21875,'past','ogulcan',1,0.35),('ccf41c9cf215197b','2024-07-05-14-02-2024-07-05-13-47-ccf41c9cf215197b',2,'07/05/2024',0,0,'','45 E 45th St, New York, NY 10017','40.7549394,-73.9772689','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',9.74,38.95,48.69,'2024-07-05 10:47:28','2024-07-08 16:12:01','8.13','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','19','10.25','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',30,18.6875,'failed','none',0,0),('e28af3a139dfe3c0','2024-07-09-18-15-2024-07-09-18-07-e28af3a139dfe3c0',2,'07/09/2024',0,0,'','151 W 54th St, New York, NY 10019 (Conrad New York Midtown)','40.7634658,-73.9806007','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+16562002544',3.75,15,18.75,'2024-07-09 18:07:33','2024-07-09 18:09:48','2.58','881 7th Ave, New York, NY 10019 (Carnegie Hall)','40.7651258,-73.9799236','9.675','2.5','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,9.22375,'past','ogulcan',1,2),('e37fa6e51f079c1a','2024-07-08-16-23-2024-07-08-16-07-e37fa6e51f079c1a',2,'07/08/2024',0,0,'','40a 10th Ave, New York, NY 10014','40.741486,-74.008156','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+12129617435',11.92,47.68,59.6,'2024-07-08 16:07:54','2024-07-08 16:16:35','41.79','30 Rockefeller Plaza, New York, NY 10112','40.7593755,-73.9799726','43.325','10.25','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,59.6031,'past','ogulcan',1,8),('f0266d9da957227e','2024-07-09-17-45-2024-07-09-17-40-f0266d9da957227e',2,'07/09/2024',0,0,'','7th Ave & West 59th Street, Central Park S, New York, NY 10019 (NYC Horse and Carriage Ride)','40.7669119,-73.979038','CASH','IBRAHIM','DONMEZ','ibrahimdonmez1983@yahoo.com','+16562002544',3.75,15,18.75,'2024-07-09 17:40:33','2024-07-09 17:40:37','0.00','7th Ave & West 59th Street, Central Park S, New York, NY 10019 (NYC Horse and Carriage Ride)','40.7669119,-73.979038','0.05','0.3','West Drive and West 59th Street New York, NY 10019','40.7668483,-73.9790817',0,0.21875,'past','ogulcan',1,0.35);
/*!40000 ALTER TABLE `pointatob` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `user`, `pass`, `name`, `surname`, `email`, `number`, `perm`) VALUES (1,'ogulcan','$2y$10$9YVrmzOac7hHBQDdfHibB.1VvmBs0kxCpCHazkcJEPIcQZIoIhpHy','Ogulcan','Ozdogan','ogulcanozdogan@gmail.com','6562002544','admin'),(6,'ibrahim','$2y$10$WgrsLWv3tQYuEyoYbuzmW.F4sDA9V35r8fe/dUjv1AWr4ZycyV1q2','IBRAHIM','DONMEZ','ibrahimdonmez1983@gmail.com','2129617435','driver'),(14,'testing','$2y$10$9YVrmzOac7hHBQDdfHibB.1VvmBs0kxCpCHazkcJEPIcQZIoIhpHy','TestingP','TestingP','TestingP@gmail.sdasd','9734492373','driver'),(16,'ajdarfan1973','$2y$10$YuBViqX7S2KLdMchEHMJHuzfe7Q7fqzQJ3x/s2dUE4U9PeNc4R5Ae','Yigit Kemal','Tahir','yigittahir50@gmail.com','2024991588','driver');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_temporary`
--

LOCK TABLES `users_temporary` WRITE;
/*!40000 ALTER TABLE `users_temporary` DISABLE KEYS */;
INSERT INTO `users_temporary` (`id`, `user`, `pass`, `name`, `surname`, `email`, `number`, `perm`) VALUES (1,'asd','$2y$10$UPtq.aJcT4urWycuAF9ql.pw0iQUfb9omaOa16y4REqTmw8f95Tfe','asd','asdq','asd@asd.asd','1231231231','driver'),(5,'asd','$2y$10$oQrZKTSKbp1SPXCG0R10yuG4tlqBFWJVThpMOen81PJwmn.g4XrLW','asd','asd','asdad@asd.adf','1321231231','driver');
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

-- Dump completed on 2024-07-10  9:12:51
