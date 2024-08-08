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
INSERT INTO `registration` (`id`, `driverLicenseFile`, `driverFirstName`, `driverLastName`, `driverLicenseNumber`, `driverLicenseExpiration`, `driverPhone`, `driverEmail`, `driverStreetAddress`, `driverApartmentNumber`, `driverCity`, `driverState`, `driverZipCode`, `businessName`, `businessLicenseNumber`, `businessRegistrationNumber`, `businessLicenseExpiration`, `businessPhone`, `businessEmail`, `businessStreetAddress`, `businessApartmentNumber`, `businessCity`, `businessState`, `businessZipCode`, `signature_svg`, `pdf_link`) VALUES ('007d7ce2bf8f9fc6','license_66a2935444efa5.38467228.jpeg','IBRAHIM','DONMEZ','asd','2024-07-27','2129617435','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','a','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-07-27','asd','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_66a2935429f151.92366499.svg','output_66a293546403c4.13056193.pdf'),('0821f73479d3d1e2','license_66a3e0f695a386.09565055.png','IBRAHIM','DONMEZ','asd','2024-07-27','2129617435','ogulcanozdogan@gmail.com','6936 Greenhill Place','asd','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-07-31','2129617435','ibrahimdonmasdasdadasdsez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_66a3e0f67ea984.11677584.svg','output_66a3e0f6aef468.55099357.pdf'),('17ca6ebcbfa99028','license_66917b83399377.36073685.jpg','Faruk','Kurt','123123','2024-07-19','124123','asdasd@asdasd.asdadsd','asdasd','asdada','asda','sd53453','345345','345345','345345','345345','2024-07-26','asdasda','sdasd@asdasd.asdas','ewrwer','dadasd','etert','dsfs','df354w','signature_66917b8323dfb4.29256885.svg','output_66917b83554956.77871880.pdf'),('219fbb85a3c9fc43','license_66a295a5356265.39584636.jpeg','IBRAHIM','DONMEZ','asd','2024-07-27','2129617435','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','a','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-07-27','asd','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_66a295a520a025.52775100.svg','output_66a295a54b7dc5.73176594.pdf'),('358ee517123255f1','license_6697fa4486aa37.29397445.jpg','Faruk4','Kurt4','penlwın322l3nk23','2024-07-04','+12029824915','ffarukkurt3@gmail.com','weqweqwee','eqwe','Egekentqweqwe','İezmqweqwir','3561340','qweqwe','qweqwe','qweqw','2024-07-03','qweqweq','eqweq@gmail.com','qwewq','eqweq','weqwe','qweqwe','q','signature_6697fa4470e309.77560663.svg','output_6697fa449b7f12.54884263.pdf'),('36fab237d420f251','license_66a3e084027977.55166386.png','IBRAHIM','DONMEZ','asd','2024-07-27','2129617435','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','asd','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-07-31','2129617435','ibrahimdonmasdasdadasdsez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_66a3e083e125e6.41003424.svg','output_66a3e08419f352.63544817.pdf'),('3718f285e5a051e6','license_6674a9fd7b49b1.46925119.jpg','IBRAHIM','DONMEZ','123123','2024-06-22','2129617435','ibrahimdonmez1983@gmail.com','6936 Greenhill Place','4','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-06-22','3478279308','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_6674a9fd66c281.56243325.svg','output_6674a9fd9090b4.88956412.pdf'),('3c2232a41dee2bee','license_669560302bad30.11166225.jpg','Omer Faruk','kurt','65165156561561651561561516','2024-07-03','45245245','dasdasdas@dfsdfsdf.com','Egekent','4656464654','Egekent','İzmir','35610','fefefef','23434324234234','324234234234','2023-08-23','34234324234','rwefwefq@info.gov','qweqwe','qweqwe','wqeqwe','qweqwe','qwe','signature_66956030157d65.95827413.svg','output_6695603044bee4.06573314.pdf'),('3fefd107164c4740','license_66749b49858511.75099925.jpeg','IBRAHIM','DONMEZ','asd','2024-06-22','2129617435','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','4','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-06-22','3478279308','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_66749b4971a2d5.22771922.svg','output_66749b499acc29.35094790.pdf'),('4bfde27c8f6b67b4','license_66956fdf954780.35283963.jpg','sosis','salam','7678678678678678','2024-07-19','84515181','sosisvesalam@gmail.com','daslşmdlşamsd','23','alşsmd','aslşdm','32232','laşsmdaslşm','23709327097','32902323','2024-07-06','4325235','dsadasd@gmail.com','sadasdasd','32','assdasd','asdasd','212','signature_66956fdf7f0be8.37527350.svg','output_66956fdfab8f76.13501670.pdf'),('62db1cd97b138cb8','license_6697f0da740793.52419701.jpg','faruk3','kurt3','apodpondpqow33434o23p4','2024-07-04','+12029824915','ffarukkurt3@gmail.com','dasdasd','asdasd','Egadasdekent','İzmasdasdair','35adsqw326','assdasd','asdasd','asdasd','2024-07-04','sadasd','asdasd@gmail.com','asdasd','asdasd','asdasd','asdasd','asdasd','signature_6697f0da5fe751.42920843.svg','output_6697f0da8a9037.05722535.pdf'),('686f077988d3f94d','license_667ca2f4f40cb9.98566191.jpeg','IBRAHIM','DONMEZ','1235412431','2024-06-28','2129617435','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','asd','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-06-28','2129617435','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_667ca2f4de5072.68188007.svg','output_667ca2f5169e90.37482195.pdf'),('690be9d1e311c094','license_668dba49aa2fd9.20745282.jpeg','IBRAHIM','DONMEZ','1235412431','2024-07-11','2129617435','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','asd','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-07-19','2129617435','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_668dba499100a4.55718394.svg','output_668dba49c1c839.94277756.pdf'),('80bbec5ea6a56c42','license_6675ad05c120a2.78565480.jpeg','IBRAHIM','DONMEZ','1235412431','2024-06-04','2129617435','ibrahimdonmez1983@gmail.com','6936 Greenhill Place','asd','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-06-02','3478279308','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_6675ad05aa2318.99236059.svg','output_6675ad05d723e7.66236660.pdf'),('868a901cba47b7a9','license_667d8760cbe8a7.30194097.jpeg','IBRAHIM','DONMEZ','asd','2024-06-28','2129617435','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','asd','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-06-29','2129617435','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_667d8760b52f17.33228604.svg','output_667d8760e21372.70702370.pdf'),('941a0d2cab4bc7a2','license_6674a8d02888f8.75985853.jpg','IBRAHIM','DONMEZ','123123','2024-06-22','2129617435','ibrahimdonmez1983@gmail.com','6936 Greenhill Place','4','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-06-22','3478279308','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_6674a8d01319b2.39958521.svg','output_6674a8d03e4662.11190374.pdf'),('9d90752a12eb1268','license_66968ca5d36bc5.20047418.jpg','kangal','sucuk','122112211221','2024-07-11','213123123','kangalsucuk@gmail.com','asdomadom','aosdmaosdm','nw','adsn','323','sucuuuk','234324234','34234234234','2024-07-01','32323232323','kangalsucuk@gmail.com','dmaklm','2323','fnj','jdn','223','signature_66968ca5c10c49.46380250.svg','output_66968ca5ebaa26.74091424.pdf'),('a889f23c69ea9fe3','license_66a68c4a6b07d0.50025495.png','deneme','sakd','samd324234234','2024-08-04','213123','ffarukkurt3@gmail.com','dasd34324','efklw324','lkmlkm','lkmlkml','2323lkmlm','lkmlkm2323','lkmlkm23323','lkmlkm23232323','2024-08-09','23123123123213','ffarukkurt3@gmail.com','asdmasldmasld','lsakclkasmd','aslkalkm','lkslkssm','lskdlkd','signature_66a68c4a53cc28.06408200.svg','output_66a68c4b3dfa88.69074745.pdf'),('ac6779e90f058410','license_66a3def025a1e7.25299063.png','IBRAHIM','DONMEZ','asd','2024-07-27','2129617435','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','asd','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-07-31','2129617435','ibrahimdonmasdasdadasdsez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_66a3def00d0859.40914736.svg','output_66a3def03d9ab3.81393227.pdf'),('ac86bf949b98057b','license_66a3e14a9fe235.15226620.png','IBRAHIM','DONMEZ','asd','2024-07-27','2129617435','ogulcanozdogan@gmail.com','6936 Greenhill Place','asd','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-07-31','2129617435','ibrahimdonmasdasdadasdsez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_66a3e14a8b33f5.12336981.svg','output_66a3e14ab72571.38720821.pdf'),('af95c99f8874b7dd','license_66a3e0ce01b772.94193100.png','IBRAHIM','DONMEZ','asd','2024-07-27','2129617435','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','asd','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-07-31','2129617435','ibrahimdonmasdasdadasdsez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_66a3e0cde0c9f4.61389329.svg','output_66a3e0ce189a26.67998236.pdf'),('b1ff06dd832c304f','license_667aeb48835317.59189288.jpeg','Enes','DONMEZ','asd','2024-06-27','2129617435','ibrahimdonmez1983@gmail.com','6936 Greenhill Place','asd','Tampa','Florida','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-06-22','9175791603','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_667aeb486e07e8.90801476.svg','output_667aeb489c66b1.27859995.pdf'),('b27348cb931792ad','license_6697e2179862d0.41595018.jpg','faruk2','kurt2','132458529929299292929292','2024-07-02','+12029824915','ffarukkurt3@gmail.com','asdasd','asdasd','Egekentadasd','İzmirasdasd','35610asdas','faruk2','23823828328892389','9302930930','2024-07-03','+12029824915','ffarukkurt3@gmail.com','asdasdas','asdasd','Egekeasdnt','asd','35610asdas','signature_6697e21784e2c5.59228544.svg','output_6697e217af84c0.20123337.pdf'),('b363f5ff237265bd','license_66a3e5b964d0c4.35935967.png','IBRAHIM','DONMEZ','asd1234','2024-07-30','2129617435','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','412','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-07-30','2129617435','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_66a3e5b94f0470.33792424.svg','output_66a3e5b97bd538.45038782.pdf'),('c8aa41ee4140d073','license_66749d7f369717.64847423.jpeg','IBRAHIM','DONMEZ','asd','2024-06-22','2129617435','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','4','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-06-22','3478279308','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_66749d7f21f427.10626856.svg','output_66749d7f4c0ed4.44769705.pdf'),('c92ea37b34472efa','license_66a3e1879507c4.18470612.png','IBRAHIM','DONMEZ','asd','2024-07-27','2129617435','ogulcan66142@gmail.com','6936 Greenhill Place','asd','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-07-31','2129617435','ibrahimdonmasdasdadasdsez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_66a3e1877de038.35200455.svg','output_66a3e187ab0ed9.63923445.pdf'),('d36d061b13a5ea48','license_66a11b565f52d3.61415629.jpg','faruk5','kurt5','29389u430948238\"','2024-07-03','+12029824915','ffarukkurt3@gmail.com','qweqweqwe','ıh','ın','ln','lkn','lk','nlk','nlk','2024-07-04','kj','k@gmail.com','jk','j','kj','k','jk','signature_66a11b56497932.13555643.svg','output_66a11b56796c61.02523826.pdf'),('d46bf7fe0214f7f8','license_66a292bb11e419.92816741.jpeg','IBRAHIM','DONMEZ','asd','2024-07-27','2129617435','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','asdasd','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-07-27','2129617435','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_66a292baede604.80519137.svg','output_66a292bb282441.66194323.pdf'),('df50aa9e3f853d0d','license_6674a84e56c446.10140660.jpg','IBRAHIM','DONMEZ','123123','2024-06-22','2129617435','ibrahimdonmez1983@gmail.com','6936 Greenhill Place','4','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-06-22','3478279308','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_6674a84e41d6d7.04667287.svg','output_6674a84e6c39d8.98873068.pdf'),('e2cb0f57bf63f9df','license_66a26e60e0c970.83287911.jpeg','IBRAHIM','DONMEZ','asd','2024-07-27','2129617435','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','a','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-07-27','asd','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_66a26e60ca1628.41467094.svg','output_66a26e6107f209.27572583.pdf'),('eb298f70a26ee468','license_66905f4adbae05.16891578.jpeg','IBRAHIM','DONMEZ','1235412431','2024-07-24','2129617435','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','asd','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-07-20','2129617435','ibrahimdonmez1983@yahoo.com','5 Columbus Circle','IBRAHIM DONMEZ','New York','NY','10019','signature_66905f4ac36eb4.69448544.svg','output_66905f4b00af54.57421993.pdf'),('edbb726872f810a2','license_66a3e0afd53e76.24889125.png','IBRAHIM','DONMEZ','asd','2024-07-27','2129617435','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','asd','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-07-31','2129617435','ibrahimdonmasdasdadasdsez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_66a3e0afc0ad56.55268528.svg','output_66a3e0afec79d1.14462820.pdf'),('f8b8c8fb1a1eebb3','license_66759d4d6cd1f7.16757633.jpg','DENEME','DENEME','123124234234123','2024-06-30','42342341231','SDFWERW@gmail.com','SDFWERW@gmail.com','SDFWERW@gmail.com','SDFWERW@gmail.com','SDFWERW@gmail.com','SDFWERW@gm','SDFWERW@gmail.com','SDFWERW@gmail.com','SDFWERW@gmail.com','2024-06-30','SDFWERW@gmail.c','SDFWERW@gmail.com','SDFWERW@gmail.com','SDFWERW@gmail.com','SDFWERW@gmail.com','SDFWERW@gmail.com','SDFWERW@gm','signature_66759d4d557660.48798724.svg','output_66759d4d83ea88.09196195.pdf'),('fc469c75e346a39a','license_6674a90fe45800.46567064.jpg','IBRAHIM','DONMEZ','123123','2024-06-22','2129617435','ibrahimdonmez1983@gmail.com','6936 Greenhill Place','4','Tampa','FL','33617','IBRAHIM DONMEZ','IBRAHIM DONMEZ','IBRAHIM DONMEZ','2024-06-22','3478279308','ibrahimdonmez1983@yahoo.com','6936 Greenhill Place','IBRAHIM DONMEZ','Tampa','FL','33617','signature_6674a90fcfac41.48747872.svg','output_6674a91006dab5.31107581.pdf');
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

-- Dump completed on 2024-08-08 10:17:46
