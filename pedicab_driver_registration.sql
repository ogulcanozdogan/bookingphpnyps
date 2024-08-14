/*!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.6.18-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: pedicab_driver_registration
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
-- Current Database: `pedicab_driver_registration`
--


--
-- Table structure for table `registration`
--

DROP TABLE IF EXISTS `registration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registration` (
  `id` binary(16) NOT NULL,
  `driverLicenseFile` varchar(255) NOT NULL,
  `driverFirstName` varchar(50) NOT NULL,
  `driverLastName` varchar(50) NOT NULL,
  `driverLicenseNumber` varchar(50) NOT NULL,
  `driverLicenseExpiration` date NOT NULL,
  `driverPhone` varchar(15) NOT NULL,
  `driverEmail` varchar(100) NOT NULL,
  `driverStreetAddress` varchar(255) NOT NULL,
  `driverApartmentNumber` varchar(50) DEFAULT NULL,
  `driverCity` varchar(100) NOT NULL,
  `driverState` varchar(50) NOT NULL,
  `driverZipCode` varchar(10) NOT NULL,
  `businessName` varchar(100) DEFAULT NULL,
  `businessLicenseNumber` varchar(50) DEFAULT NULL,
  `businessRegistrationNumber` varchar(50) DEFAULT NULL,
  `businessLicenseExpiration` date DEFAULT NULL,
  `businessPhone` varchar(15) DEFAULT NULL,
  `businessEmail` varchar(100) DEFAULT NULL,
  `businessStreetAddress` varchar(255) DEFAULT NULL,
  `businessApartmentNumber` varchar(50) DEFAULT NULL,
  `businessCity` varchar(100) DEFAULT NULL,
  `businessState` varchar(50) DEFAULT NULL,
  `businessZipCode` varchar(10) DEFAULT NULL,
  `signature_svg` text NOT NULL,
  `pdf_link` varchar(400) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registration`
--

LOCK TABLES `registration` WRITE;
/*!40000 ALTER TABLE `registration` DISABLE KEYS */;
/*!40000 ALTER TABLE `registration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'pedicab_driver_registration'
--

--
-- Dumping routines for database 'pedicab_driver_registration'
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
