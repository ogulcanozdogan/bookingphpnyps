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
INSERT INTO `registration` (`id`, `driverLicenseFile`, `driverFirstName`, `driverLastName`, `driverLicenseNumber`, `driverLicenseExpiration`, `driverPhone`, `driverEmail`, `driverStreetAddress`, `driverApartmentNumber`, `driverCity`, `driverState`, `driverZipCode`, `businessName`, `businessLicenseNumber`, `businessRegistrationNumber`, `businessLicenseExpiration`, `businessPhone`, `businessEmail`, `businessStreetAddress`, `businessApartmentNumber`, `businessCity`, `businessState`, `businessZipCode`, `signature_svg`, `pdf_link`) VALUES ('3718f285e5a051e6','license_6674a9fd7b49b1.46925119.jpg','IBRAHIM','DONMEZ','123123','2024-06-22','2129617435','ibrahimdonmez1983@gmail.com','6936 Greenhill Place','4','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-06-22','3478279308','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_6674a9fd66c281.56243325.svg','output_6674a9fd9090b4.88956412.pdf'),('3fefd107164c4740','license_66749b49858511.75099925.jpeg','IBRAHIM','DONMEZ','asd','2024-06-22','2129617435','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','4','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-06-22','3478279308','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_66749b4971a2d5.22771922.svg','output_66749b499acc29.35094790.pdf'),('686f077988d3f94d','license_667ca2f4f40cb9.98566191.jpeg','IBRAHIM','DONMEZ','1235412431','2024-06-28','2129617435','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','asd','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-06-28','2129617435','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_667ca2f4de5072.68188007.svg','output_667ca2f5169e90.37482195.pdf'),('690be9d1e311c094','license_668dba49aa2fd9.20745282.jpeg','IBRAHIM','DONMEZ','1235412431','2024-07-11','2129617435','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','asd','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-07-19','2129617435','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_668dba499100a4.55718394.svg','output_668dba49c1c839.94277756.pdf'),('80bbec5ea6a56c42','license_6675ad05c120a2.78565480.jpeg','IBRAHIM','DONMEZ','1235412431','2024-06-04','2129617435','ibrahimdonmez1983@gmail.com','6936 Greenhill Place','asd','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-06-02','3478279308','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_6675ad05aa2318.99236059.svg','output_6675ad05d723e7.66236660.pdf'),('868a901cba47b7a9','license_667d8760cbe8a7.30194097.jpeg','IBRAHIM','DONMEZ','asd','2024-06-28','2129617435','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','asd','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-06-29','2129617435','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_667d8760b52f17.33228604.svg','output_667d8760e21372.70702370.pdf'),('941a0d2cab4bc7a2','license_6674a8d02888f8.75985853.jpg','IBRAHIM','DONMEZ','123123','2024-06-22','2129617435','ibrahimdonmez1983@gmail.com','6936 Greenhill Place','4','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-06-22','3478279308','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_6674a8d01319b2.39958521.svg','output_6674a8d03e4662.11190374.pdf'),('b1ff06dd832c304f','license_667aeb48835317.59189288.jpeg','Enes','DONMEZ','asd','2024-06-27','2129617435','ibrahimdonmez1983@gmail.com','6936 Greenhill Place','asd','Tampa','Florida','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-06-22','9175791603','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_667aeb486e07e8.90801476.svg','output_667aeb489c66b1.27859995.pdf'),('c8aa41ee4140d073','license_66749d7f369717.64847423.jpeg','IBRAHIM','DONMEZ','asd','2024-06-22','2129617435','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','4','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-06-22','3478279308','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_66749d7f21f427.10626856.svg','output_66749d7f4c0ed4.44769705.pdf'),('df50aa9e3f853d0d','license_6674a84e56c446.10140660.jpg','IBRAHIM','DONMEZ','123123','2024-06-22','2129617435','ibrahimdonmez1983@gmail.com','6936 Greenhill Place','4','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-06-22','3478279308','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_6674a84e41d6d7.04667287.svg','output_6674a84e6c39d8.98873068.pdf'),('f8b8c8fb1a1eebb3','license_66759d4d6cd1f7.16757633.jpg','DENEME','DENEME','123124234234123','2024-06-30','42342341231','SDFWERW@gmail.com','SDFWERW@gmail.com','SDFWERW@gmail.com','SDFWERW@gmail.com','SDFWERW@gmail.com','SDFWERW@gm','SDFWERW@gmail.com','SDFWERW@gmail.com','SDFWERW@gmail.com','2024-06-30','SDFWERW@gmail.c','SDFWERW@gmail.com','SDFWERW@gmail.com','SDFWERW@gmail.com','SDFWERW@gmail.com','SDFWERW@gmail.com','SDFWERW@gm','signature_66759d4d557660.48798724.svg','output_66759d4d83ea88.09196195.pdf'),('fc469c75e346a39a','license_6674a90fe45800.46567064.jpg','IBRAHIM','DONMEZ','123123','2024-06-22','2129617435','ibrahimdonmez1983@gmail.com','6936 Greenhill Place','4','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-06-22','3478279308','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_6674a90fcfac41.48747872.svg','output_6674a91006dab5.31107581.pdf');
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

-- Dump completed on 2024-07-10 14:22:34
