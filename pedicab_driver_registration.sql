/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.6.19-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: pedicab_driver_registration
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
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registration`
--

LOCK TABLES `registration` WRITE;
/*!40000 ALTER TABLE `registration` DISABLE KEYS */;
INSERT INTO `registration` (`id`, `driverLicenseFile`, `driverFirstName`, `driverLastName`, `driverLicenseNumber`, `driverLicenseExpiration`, `driverPhone`, `driverEmail`, `driverStreetAddress`, `driverApartmentNumber`, `driverCity`, `driverState`, `driverZipCode`, `businessName`, `businessLicenseNumber`, `businessRegistrationNumber`, `businessLicenseExpiration`, `businessPhone`, `businessEmail`, `businessStreetAddress`, `businessApartmentNumber`, `businessCity`, `businessState`, `businessZipCode`, `signature_svg`, `pdf_link`, `timestamp`) VALUES ('0ac53881abbc735e','license_66c7631edacb11.86162463.jpg','Moussa','Fall','1336733','2025-04-30','6463186953','strongmind79@yahoo.com','203 west 111th street ','3B','New York','New York','10026','FALL MOUSSA','2080643','2054','2024-11-01','6463186953','strongmind79@yahoo.com','203 west 111th street','3B','New York','New York','10026','signature_66c7631ecdfae4.70807612.svg','output_66c7631eeba6b4.33599928.pdf','0000-00-00 00:00:00'),('1f71bd2960bb435b','license_66c7925e7de590.40702699.jpeg','Kenneth','Aguirre','2108665','2025-04-30','8885993959','cityparktours@gmail.com','1750 Grand Concourse','5D','Bronx','NY','10457','Kenneth Aguirre','1339195','2328','2024-11-01','8885993959','cityparktours@gmail.com','1750 Grand Concourse','5D','Bronx','NY','10457','signature_66c7925e67a581.25182383.svg','output_66c7925e97ac96.28148484.pdf','0000-00-00 00:00:00'),('447a080db9bd8569','license_66c75cffdcdf05.15743966.jpg','Levent','Gulkok','2108174','2025-04-30','2014920681','leventgulkok@yahoo.com','7430 Boulevard East','2B','North Bergen','NJ','07047','LAVO TRAVEL LLC','2114139','1766','2024-11-01','2014920681','leventgulkok@yahoo.com','2813 Astoria Boulevard','3R','Astoria','NY','11102','signature_66c75cffd09e42.35321956.svg','output_66c75cffece888.23783956.pdf','0000-00-00 00:00:00'),('7c5fb655c8e3f4f9','license_66cce57fb49974.16027095.jpeg','Marufjon','Hafizov','0000000','2025-04-30','9296647280','mkh29908@gmail.com','Null','Null','Null','Null','Null','Bashirkhon Azizboev','2113791','1869','2024-11-01','7409800000','mkh29908@gmail.com','1658 74th Street','2R','Brooklyn','NY','11204','signature_66cce57f9dee31.41309098.svg','output_66cce57fccbed9.07231078.pdf','0000-00-00 00:00:00'),('8910775085c42e59','license_66ccd6eee7d939.31572835.jpg','Dmitry ','Kuprin ','1340205','2025-04-30','9178622897','dkuprin87@gmail.com','137 88th Street ','Apt 4J ','Brooklyn ','Ny','11209 ','Dmitry Kuprin ','2018228','2175','2024-10-31','9178622897','dkuprin87@gmail.com','137 88th Street','Apt 4J ','Brooklyn ','Ny ','11209','signature_66ccd6eedbfb08.78238345.svg','output_66ccd6ef03e515.72491164.pdf','0000-00-00 00:00:00'),('9c849a93aa079ade','license_66c7682a7daeb8.12738467.jpeg','Benjamin','Harris','0000000','2025-04-30','3473373174','Null@Null.Com','Null','Null','Null','Null','Null','Null','Null','Null','2024-11-01','3473373174','Null@Null.Com','Null','Null','Null','Null','Null','signature_66c7682a685929.05323188.svg','output_66c7682a953394.92468925.pdf','0000-00-00 00:00:00'),('a6b91db43b710983','license_66ce5cd96588e6.93048866.jpeg','Murodjon','Mirboboev','2108231','2025-04-30','9294445445','Dbr.mika@gmail.com','2334 82nd Street','6','Brooklyn','NY','11214','Murodjon Mirboboev','2097655','1705','2024-11-01','9294445445','Dbr.mika@gmail.com','2334 82nd Street','6','Brooklyn','NY','11214','signature_66ce5cd94edb76.06331057.svg','output_66ce5cd97cf491.20173067.pdf','0000-00-00 00:00:00'),('ace27c852114629f','license_66df68536d06b4.55246664.jpg','Aleksandar','Radovanovic','1339746','2025-05-01','3478279308','sasaradovanovic82@yahoo.com','3448 33rd St','3','Astoria','NY','11106','Aleksandar Radovanov','1338856','1807','2024-11-01','3478279308','sasaradovanovic82@yahoo.com','3448 33rd St','3','Astoria','Ney York','11106','signature_66df68535fa028.09795556.svg','output_66df68537efc12.62341935.pdf','2024-09-09 17:27:47'),('be3d71830026bae4','license_66c92df517e500.74491717.jpeg','Jeyhun','Hasanov','1351461','2025-04-30','6466730954','jeyhun_hasanov@yahoo.com','6803 Kennedy Blvd','92','West New York','NJ','07093','Sarper Kadioglu','2092061','1983','2024-11-01','6462437136','jeyhun_hasanov@yahoo.com','350 East 54th Street','6B','Manhattan','NY','10022','signature_66c92df501d664.63709540.svg','output_66c92df52efee7.68229885.pdf','0000-00-00 00:00:00'),('c51afc9c3ab4f522','license_66bf9c31745f03.72109253.jpeg','Abul','Kkhan','2101762','2025-04-30','3475361773','bill2@inbox.ru','7412 35TH AVE','305E','Jackson Heights','New York ','11372','Abul Kalam Kkhan ','2091717','1969','2024-11-01','3475361773','bill2@inbox.ru','7412 35TH AVE','305E','Jackson Heights','New York ','11372','signature_66bf9c31683063.26658400.svg','output_66bf9c3184dac9.80519639.pdf','0000-00-00 00:00:00'),('dce61338302041b0','license_66d11061d9bf44.30680741.jpeg','Dilmurod','Achilov','2046924','2025-04-30','2063991625','Achilov89@yahoo.com','1611 Quentin Rd','2F','Brooklyn','NY','11229','Dilmurod Achilov','2113901','1845','2024-11-01','2063991625','Achilov89@yahoo.com','1611 Quentin Rd','2F','Brooklyn','NY','11229','signature_66d11061c3a191.54250218.svg','output_66d11061efc9e6.55828213.pdf','0000-00-00 00:00:00'),('e25c8360b4e4a184','license_66c775ba54dd53.77195395.jpeg','Bunyani','Durak','0000000','2025-04-30','3473922263','bunyamindurakusa@gmail.com','3044 35th Street','2R','Astoria','NY','11103','Garth Burton','2097192','1588','2024-11-01','6467616549','bunyamindurakusa@gmail.com','120 West 91st Street','16G','Manhattan','NY','10024','signature_66c775ba3d11a2.23360537.svg','output_66c775ba6cf3a0.99806005.pdf','0000-00-00 00:00:00');
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

-- Dump completed on 2024-11-08 11:44:13
