-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 26, 2024 at 04:12 PM
-- Server version: 10.6.17-MariaDB-cll-lve
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `PedicabsScheduled`
--

-- --------------------------------------------------------

--
-- Table structure for table `ayarlar`
--

CREATE TABLE `ayarlar` (
  `id` int(11) NOT NULL,
  `sitebasligi` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `siteaciklamasi` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `siteurl` varchar(55) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `dil` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ayarlar`
--

INSERT INTO `ayarlar` (`id`, `sitebasligi`, `siteaciklamasi`, `siteurl`, `dil`) VALUES
(1, 'New York Pedicab Services', 'New York Pedicab Services provides Central Park Pedicab Tours, Point A to Point B Pedicab Rides, Hourly Pedicab Services, Pedicab Rentals and Pedicab Advertising. New York Pedicab Services offers a professional, reliable, friendly and fun pedicab experience.', 'https://newyorkpedicabservices.com/dashboard-scheduled/', 0);

-- --------------------------------------------------------

--
-- Table structure for table `centralpark`
--

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
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
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
  `sms_sent` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `centralpark`
--

INSERT INTO `centralpark` (`id`, `bookingNumber`, `numberOfPassengers`, `date`, `hour`, `minutes`, `ampm`, `destinationAddress`, `destinationCoords`, `paymentMethod`, `firstName`, `lastName`, `emailAddress`, `phoneNumber`, `bookingFee`, `driverFee`, `totalFare`, `createdAt`, `updated_at`, `duration`, `pickupAddress`, `pickUpCoords`, `returnDuration`, `pickUpDuration`, `hub`, `hubCoords`, `baseFare`, `operationFare`, `status`, `driver`, `sms_sent`) VALUES
(0x30306464613965636539616665396235, '2024-06-20--2024-06-18-20-20-00dda9ece9afe9b5', 2, '06/20/2024', 14, 0, 'PM', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '2129617435', 13.19, 52.76, 95.95, '2024-06-18 17:20:09', NULL, '87.675', '666 5th Ave, New York, NY 10019', '40.7605248,-73.9769049', '', '', '', '', 0, 32.975, 'available', NULL, 0),
(0x30326237656464366139383262303439, '2024-06-20--2024-06-18-19-58-02b7edd6a982b049', 2, '06/20/2024', 16, 15, 'PM', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.64, 54.56, 98.21, '2024-06-18 16:58:38', NULL, '69.925', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 34.1025, 'available', NULL, 0),
(0x30336565303732313434653566363731, '2024-06-27-15-00-2024-06-19-14-20-03ee072144e5f671', 2, '06/27/2024', 3, 0, 'PM', '222 E 41st St, New York, NY 10017', '40.7493378,-73.9740737', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 23.2, 92.8, 146, '2024-06-19 11:20:37', NULL, '98', '222 E 41st St, New York, NY 10017', '40.7493378,-73.9740737', '', '', '', '', 0, 58, 'available', NULL, 0),
(0x31376262633131353966623239613336, '2024-06-28-16-15-2024-06-20-18-52-17bbc1159fb29a36', 2, '06/28/2024', 4, 15, 'PM', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 10.5, 42, 87.5, '2024-06-20 15:52:17', NULL, '86.25', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 30.625, 'available', NULL, 0),
(0x31613632356365373232633462316439, '2024-06-19-03:15 PM-2024-06-18-20-55-1a625ce722c4b1d9', 2, '06/19/2024', 3, 15, 'PM', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.64, 54.56, 98.21, '2024-06-18 17:55:07', NULL, '69.925', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 34.1025, 'available', NULL, 0),
(0x32373735326162303238616534656134, '2024-06-27-16-30-2024-06-25-18-03-27752ab028ae4ea4', 2, '06/27/2024', 4, 30, 'PM', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 11.56, 46.26, 57.82, '2024-06-25 15:03:03', NULL, '31.92', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 57.82, 'available', NULL, 0),
(0x32633932333130663632376630306166, '2024-06-13-16-15-2024-06-12-13-47-2c92310f627f00af', 1, '06/13/2024', 4, 15, 'PM', '45 Rockefeller Plaza, New York, NY 10111', '40.7591523,-73.9777136', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 22.68, 90.7, 113.38, '2024-06-12 10:47:48', NULL, '88.175', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 113.375, 'available', NULL, 0),
(0x33366134363231323930623537313831, '2024-06-19-14-00-2024-06-12-12-31-36a4621290b57181', 2, '06/19/2024', 2, 0, 'PM', '45 Rockefeller Plaza, New York, NY 10111 (Rockefeller Center)', '40.7587402,-73.9786736', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 17.54, 70.14, 87.68, '2024-06-12 09:31:15', NULL, '64.85', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 87.675, 'available', NULL, 0),
(0x35623764333230666663396132346639, '2024-06-19--2024-06-18-21-01-5b7d320ffc9a24f9', 2, '06/19/2024', 3, 15, 'PM', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.64, 54.56, 98.21, '2024-06-18 18:01:40', NULL, '69.925', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 34.1025, 'available', NULL, 0),
(0x36613336333035633338333065613462, '2024-06-20--2024-06-18-20-16-6a36305c3830ea4b', 3, '06/20/2024', 14, 15, 'PM', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '2129617435', 13.64, 54.56, 98.21, '2024-06-18 17:16:27', NULL, '69.925', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 34.1025, 'available', NULL, 0),
(0x38376238663733616363643337323538, '2024-06-13-16-15-2024-06-12-13-45-87b8f73accd37258', 1, '06/13/2024', 4, 15, 'PM', '45 Rockefeller Plaza, New York, NY 10111', '40.7591523,-73.9777136', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 22.68, 90.7, 113.38, '2024-06-12 10:45:04', NULL, '88.175', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 113.375, 'available', NULL, 0),
(0x38386335313334303137346437333632, '2024-06-20--2024-06-18-20-09-88c51340174d7362', 2, '06/20/2024', 16, 15, 'PM', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '2129617435', 13.64, 54.56, 98.21, '2024-06-18 17:09:38', NULL, '119.925', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 34.1025, 'available', NULL, 0),
(0x38633739623761333636353066303461, '2024-06-28-14-00-2024-06-26-17-27-8c79b7a36650f04a', 2, '06/28/2024', 2, 0, 'PM', '432 Park Ave, New York, NY 10022', '40.7617561,-73.9719035', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 10.81, 43.24, 54.05, '2024-06-26 14:27:08', NULL, '25.95', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 54.0458, 'available', NULL, 0),
(0x39633563393832623530383939323631, '2024-06-19-03:15 PM-2024-06-18-20-53-9c5c982b50899261', 2, '06/19/2024', 3, 15, 'PM', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.64, 54.56, 98.21, '2024-06-18 17:53:05', NULL, '69.925', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 34.1025, 'available', NULL, 0),
(0x39643337623337353161663730613938, '2024-06-19-03:15 PM-2024-06-18-20-58-9d37b3751af70a98', 2, '06/19/2024', 3, 15, 'PM', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.64, 54.56, 98.21, '2024-06-18 17:58:09', NULL, '69.925', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 34.1025, 'available', NULL, 0),
(0x61323435343466643261613338303731, '2024-06-20--2024-06-18-19-56-a24544fd2aa38071', 2, '06/20/2024', 16, 15, 'PM', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.64, 54.56, 98.21, '2024-06-18 16:56:40', NULL, '69.925', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 34.1025, 'available', NULL, 0),
(0x61376135343963666135396131313731, '2024-06-13-17-00-2024-06-13-15-36-a7a549cfa59a1171', 2, '06/13/2024', 5, 0, 'PM', '89 E 42nd St, New York, NY 10017 (Grand Central Terminal)', '40.7533582,-73.9768041', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 22.52, 90.08, 112.6, '2024-06-13 12:36:52', NULL, '88.7', '768 5th Ave, New York, NY 10019 (The Plaza)', '40.7646318,-73.9743251', '', '', '', '', 0, 112.6, 'available', NULL, 0),
(0x62323236633366653161363030653665, '2024-06-12-14-15-2024-06-11-16-40-b226c3fe1a600e6e', 2, '06/12/2024', 2, 15, 'PM', '45 Rockefeller Plaza, New York, NY 10111', '40.7591523,-73.9777136', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 18.68, 74.7, 93.38, '2024-06-11 13:40:48', NULL, '68.175', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 93.375, 'available', NULL, 0),
(0x62326333376532383262313037366237, '2024-06-19--2024-06-18-21-01-b2c37e282b1076b7', 2, '06/19/2024', 3, 15, 'PM', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.64, 54.56, 98.21, '2024-06-18 18:01:02', NULL, '69.925', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 34.1025, 'available', NULL, 0),
(0x62383064656466346634393839323735, '2024-06-20-04:15-2024-06-18-19-51-b80dedf4f4989275', 2, '06/20/2024', 16, 15, 'PM', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.64, 54.56, 98.21, '2024-06-18 16:51:56', NULL, '69.925', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 34.1025, 'available', NULL, 0),
(0x63303664613862393731356134626465, '2024-06-12-15-15-2024-06-10-15-49-c06da8b9715a4bde', 2, '06/12/2024', 3, 15, 'PM', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 22.4, 89.6, 112, '2024-06-10 12:49:31', NULL, '74.75', '338 W 36th St., New York, NY 10018', '40.7539456,-73.9941606', '', '', '', '', 0, 112, 'available', NULL, 0),
(0x63306662386531326334393238363732, '2024-06-12-15-15-2024-06-10-15-52-c0fb8e12c4928672', 2, '06/12/2024', 3, 15, 'PM', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'card', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 22.4, 98.56, 120.96, '2024-06-10 12:52:47', NULL, '74.75', '338 W 36th St., New York, NY 10018', '40.7539456,-73.9941606', '', '', '', '', 0, 112, 'available', NULL, 0),
(0x63333733363564353266303463333766, '2024-06-27-15-00-2024-06-19-12-16-c37365d52f04c37f', 2, '06/27/2024', 3, 0, 'PM', '222 E 41st St, New York, NY 10017', '40.7493378,-73.9740737', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 23.2, 92.8, 146, '2024-06-19 09:16:31', NULL, '98', '222 E 41st St, New York, NY 10017', '40.7493378,-73.9740737', '', '', '', '', 0, 58, 'available', NULL, 0),
(0x63636236656636366566613866386261, '2024-06-18-15-15-2024-06-11-11-23-ccb6ef66efa8f8ba', 2, '06/18/2024', 3, 15, 'PM', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 27.21, 108.84, 136.05, '2024-06-11 08:23:42', NULL, '91', 'New York, NY 10017', '40.7519846,-73.9697795', '', '', '', '', 0, 136.05, 'available', NULL, 0),
(0x63653062313934636363363835653539, '2024-06-14-15-30-2024-06-13-17-58-ce0b194ccc685e59', 2, '06/14/2024', 3, 30, 'PM', '1 E 58th St, New York, NY 10022', '40.7636298,-73.9734288', 'cash', 'Susan', 'Havens', 'ibrahimdonmez1983@yahoo.com', '+1', 20.79, 83.14, 103.93, '2024-06-13 14:58:27', NULL, '79.425', '150 W 48th St, New York, NY 10036', '40.7595001,-73.9837008', '', '', '', '', 0, 103.925, 'available', NULL, 0),
(0x64333830343939613639353364306639, '2024-06-26-14-15-2024-06-21-13-10-d380499a6953d0f9', 2, '06/26/2024', 2, 15, 'PM', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 7.72, 30.88, 38.6, '2024-06-21 10:10:42', NULL, '19.3', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 38.6, 'available', NULL, 0),
(0x64346565386239356166663563326233, '2024-06-13-16-15-2024-06-12-13-45-d4ee8b95aff5c2b3', 1, '06/13/2024', 4, 15, 'PM', '45 Rockefeller Plaza, New York, NY 10111', '40.7591523,-73.9777136', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 22.68, 90.7, 113.38, '2024-06-12 10:45:38', NULL, '88.175', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 113.375, 'available', NULL, 0),
(0x65306463393730363339616238333662, '2024-06-19-03:15 PM-2024-06-18-20-53-e0dc970639ab836b', 2, '06/19/2024', 3, 15, 'PM', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.64, 54.56, 98.21, '2024-06-18 17:53:28', NULL, '69.925', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 34.1025, 'available', NULL, 0),
(0x65343463303138623161363566333433, '2024-06-20-04:15 AM-2024-06-18-19-54-e44c018b1a65f343', 2, '06/20/2024', 16, 15, 'PM', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.64, 54.56, 98.21, '2024-06-18 16:54:55', NULL, '69.925', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 34.1025, 'available', NULL, 0),
(0x65383230666262616165336361666562, '2024-06-27-15-00-2024-06-19-12-17-e820fbbaae3cafeb', 2, '06/27/2024', 3, 0, 'PM', '222 E 41st St, New York, NY 10017', '40.7493378,-73.9740737', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 23.2, 92.8, 146, '2024-06-19 09:17:00', NULL, '98', '222 E 41st St, New York, NY 10017', '40.7493378,-73.9740737', '', '', '', '', 0, 58, 'available', NULL, 0),
(0x65633633313563393833373634396565, '2024-06-14-15-30-2024-06-13-17-59-ec6315c9837649ee', 2, '06/14/2024', 3, 30, 'PM', '1 E 58th St, New York, NY 10022', '40.7636298,-73.9734288', 'cash', 'Susan', 'Havens', 'ibrahimdonmez1983@yahoo.com', '+1', 20.79, 83.14, 103.93, '2024-06-13 14:59:30', NULL, '79.425', '150 W 48th St, New York, NY 10036', '40.7595001,-73.9837008', '', '', '', '', 0, 103.925, 'available', NULL, 0),
(0x66303338633031363639363861616234, '2024-06-14-14-00-2024-06-13-17-23-f038c0166968aab4', 2, '06/14/2024', 2, 0, 'PM', '234 W 42nd St, New York, NY 10036 (Hilton New York Times Square)', '40.756649,-73.9888153', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 19.88, 79.5, 99.38, '2024-06-13 14:23:38', NULL, '70.125', '1535 Broadway, New York, NY 10036 (New York Marriott Marquis)', '40.7585862,-73.9858202', '', '', '', '', 0, 99.375, 'available', NULL, 0),
(0x66343035313636396365346232623730, '2024-06-20-04:15-2024-06-18-19-53-f4051669ce4b2b70', 2, '06/20/2024', 16, 15, 'PM', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.64, 54.56, 98.21, '2024-06-18 16:53:42', NULL, '69.925', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 34.1025, 'available', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hourly`
--

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
  `serviceDetails` text NOT NULL,
  `serviceDuration` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hourly`
--

INSERT INTO `hourly` (`id`, `bookingNumber`, `numberOfPassengers`, `date`, `hour`, `minutes`, `ampm`, `destinationAddress`, `destinationCoords`, `paymentMethod`, `firstName`, `lastName`, `emailAddress`, `phoneNumber`, `bookingFee`, `driverFee`, `totalFare`, `createdAt`, `updated_at`, `duration`, `pickupAddress`, `pickUpCoords`, `returnDuration`, `pickUpDuration`, `hub`, `hubCoords`, `baseFare`, `operationFare`, `status`, `driver`, `sms_sent`, `serviceDetails`, `serviceDuration`) VALUES
(0x30336536383161356262333064643536, '2024-06-19-15-15-2024-06-18-13-15-03e681a5bb30dd56', 2, '06/19/2024', 3, 15, 'PM', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 39.08, 91.19, 130.28, '2024-06-18 10:15:22', '0000-00-00 00:00:00', '11.87', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', '30.05', '37.075', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 78.5625, 'available', '', 0, '5', '90 mins'),
(0x31346636343862383837636235653033, '2024-06-19-15-15-2024-06-18-13-17-14f648b887cb5e03', 2, '06/19/2024', 3, 15, 'PM', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 39.08, 91.19, 130.28, '2024-06-18 10:17:51', '0000-00-00 00:00:00', '11.87', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', '30.05', '37.075', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 78.5625, 'available', '', 0, '5', '90 mins'),
(0x32326232626632383133623539313234, '2024-06-19-15-15-2024-06-18-13-17-22b2bf2813b59124', 2, '06/19/2024', 3, 15, 'PM', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 39.08, 91.19, 130.28, '2024-06-18 10:17:53', '0000-00-00 00:00:00', '11.87', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', '30.05', '37.075', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 78.5625, 'available', '', 0, '5', '90 mins'),
(0x32626532643334363738386235346166, '2024-06-29-14-00-2024-06-26-17-25-2be2d346788b54af', 2, '06/29/2024', 2, 0, 'PM', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 40.9, 95.43, 136.33, '2024-06-26 14:25:14', '0000-00-00 00:00:00', '15.28', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '43.375', '10.325', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 35, 101.325, 'available', '', 0, '2', '2 Hour'),
(0x33316662613239313335356461373264, '2024-06-27-15-00-2024-06-25-14-23-31fba291355da72d', 2, '06/27/2024', 3, 0, 'PM', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 29.96, 69.9, 99.85, '2024-06-25 11:23:34', '0000-00-00 00:00:00', '24.95', '56 Leonard St, New York, NY 10013', '40.7176987,-74.0062231', '19', '60.7', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 69.85, 'available', '', 0, 'asd', '1 hour'),
(0x33343532303333643239386632626539, '2024-06-29-14-00-2024-06-26-17-15-3452033d298f2be9', 2, '06/29/2024', 2, 0, 'PM', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 40.9, 95.43, 136.33, '2024-06-26 14:15:58', '0000-00-00 00:00:00', '15.28', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '43.375', '10.325', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 35, 101.325, 'available', '', 0, '2', '2 Hour'),
(0x33376136623266376361313535623531, '2024-06-27-16-00-2024-06-25-17-41-37a6b2f7ca155b51', 2, '06/27/2024', 4, 0, 'PM', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 34.48, 80.45, 114.93, '2024-06-25 14:41:22', '0000-00-00 00:00:00', '18.10', '345 Park Ave, New York, NY 10154', '40.7579332,-73.9722189', '37.925', '11.925', '6th Avenue and West 48th Street New York, NY 10020', '40.7586531,-73.9813286', 30, 84.925, 'available', '', 0, 'a', '2 Hour'),
(0x34643033633531383261363835373333, '2024-06-19-15-15-2024-06-18-13-17-4d03c5182a685733', 2, '06/19/2024', 3, 15, 'PM', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 39.08, 91.19, 130.28, '2024-06-18 10:17:34', '0000-00-00 00:00:00', '11.87', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', '30.05', '37.075', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 78.5625, 'available', '', 0, '5', '90 mins'),
(0x34653839613566303236633237646531, '2024-06-21-19-30-2024-06-21-19-15-4e89a5f026c27de1', 2, '', 0, 0, '', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 23.83, 95.34, 119.17, '2024-06-21 16:15:36', '0000-00-00 00:00:00', '15.27', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '43.325', '10.3', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 0, 119.171, 'available', '', 0, 's', '90 Minutes'),
(0x35323564346338336335313834633434, '2024-06-19-16-15-2024-06-10-12-38-525d4c83c5184c44', 2, '06/19/2024', 4, 15, 'PM', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 27.62, 64.44, 92.06, '2024-06-10 09:38:05', '0000-00-00 00:00:00', '0.28', '1260 6th Ave, New York, NY 10020 (Radio City Music Hall)', '40.759976,-73.9799772', '2.825', '1.3', '6th Avenue and West 48th Street New York, NY 10020', '40.7586531,-73.9813286', 30, 62.0625, 'available', '', 0, 'r', '2 hour'),
(0x35636563623561623233356136653634, '2024-06-26-14-00-2024-06-21-12-06-5cecb5ab235a6e64', 2, '06/26/2024', 2, 0, 'PM', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 27.39, 63.92, 91.31, '2024-06-21 09:06:10', '0000-00-00 00:00:00', '8.62', '4 Charles St #3004, New York, NY 10014 (4 Charles Prime Rib)', '40.7351675,-74.0006537', '29.95', '32.675', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 61.3125, 'available', '', 0, 's', '1 hour'),
(0x35653138333066626438666361356532, '2024-06-19-15-15-2024-06-18-13-14-5e1830fbd8fca5e2', 2, '06/19/2024', 3, 15, 'PM', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 39.08, 91.19, 130.28, '2024-06-18 10:14:36', '0000-00-00 00:00:00', '11.87', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', '30.05', '37.075', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 78.5625, 'available', '', 0, '5', '90 mins'),
(0x36326430343464616261306433626439, '2024-06-21-19-05-2024-06-21-18-50-62d044daba0d3bd9', 2, '', 0, 0, '', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 23.83, 95.34, 119.17, '2024-06-21 15:50:28', '0000-00-00 00:00:00', '15.27', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '43.325', '10.3', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 0, 119.171, 'available', '', 0, '3', '90 Minutes'),
(0x36336539393761393931313635313330, '2024-06-29-14-00-2024-06-26-17-24-63e997a991165130', 2, '06/29/2024', 2, 0, 'PM', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 40.9, 95.43, 136.33, '2024-06-26 14:24:03', '0000-00-00 00:00:00', '15.28', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '43.375', '10.325', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 35, 101.325, 'available', '', 0, '2', '120 Hour'),
(0x36383333333236316232363962636163, '2024-06-29-14-00-2024-06-26-17-21-68333261b269bcac', 2, '06/29/2024', 2, 0, 'PM', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 40.9, 95.43, 136.33, '2024-06-26 14:21:13', '0000-00-00 00:00:00', '15.28', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '43.375', '10.325', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 35, 101.325, 'available', '', 0, '2', '2 Hour'),
(0x36393364633762396161366565376336, '2024-06-21-19-30-2024-06-21-19-14-693dc7b9aa6ee7c6', 2, '', 0, 0, '', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 23.83, 95.34, 119.17, '2024-06-21 16:14:43', '0000-00-00 00:00:00', '15.27', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '43.325', '10.3', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 0, 119.171, 'available', '', 0, 's', '90 Minutes'),
(0x37396132666433353130633165626236, '2024-06-19-15-15-2024-06-18-13-20-79a2fd3510c1ebb6', 2, '06/19/2024', 3, 15, 'PM', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 39.08, 91.19, 130.28, '2024-06-18 10:20:07', '0000-00-00 00:00:00', '11.87', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', '30.05', '37.075', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 78.5625, 'available', '', 0, '5', '90 mins'),
(0x37636332333766363061653832343033, '2024-06-27-15-00-2024-06-25-14-24-7cc237f60ae82403', 2, '06/27/2024', 3, 0, 'PM', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 29.96, 69.9, 99.85, '2024-06-25 11:24:37', '0000-00-00 00:00:00', '24.95', '56 Leonard St, New York, NY 10013', '40.7176987,-74.0062231', '19', '60.7', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 69.85, 'available', '', 0, 'asd', '1 hour'),
(0x38643137303638616163633130333832, '2024-06-19-14-00-2024-06-18-15-14-8d17068aacc10382', 2, '06/19/2024', 2, 0, 'PM', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'FULLCARD', 'Enes', 'Kahraman', 'eneskhrmn4321@gmail.com', '+13473885990', 16.74, 66.96, 83.7, '2024-06-18 12:14:48', '2024-06-19 14:05:00', '16.48', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', '12.425', '37.075', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 39.75, 'past', 'ogulcan', 1, 'r', '30 mins'),
(0x39613735636635386336613461346466, '2024-06-19-15-15-2024-06-18-14-58-9a75cf58c6a4a4df', 2, '06/19/2024', 3, 15, 'PM', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 33.68, 78.59, 112.28, '2024-06-18 11:58:15', '0000-00-00 00:00:00', '11.87', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', '30.05', '37.075', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 63.5625, 'available', '', 0, '4', '1 hour'),
(0x61306532316335383935663866623235, '2024-06-21-19-33-2024-06-21-19-17-a0e21c5895f8fb25', 2, '', 0, 0, '', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 23.83, 95.34, 119.17, '2024-06-21 16:17:57', '0000-00-00 00:00:00', '15.27', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '43.325', '10.3', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 0, 119.171, 'available', '', 0, 's', '90 Minutes'),
(0x61363133663362343238333565643862, '2024-06-26-14-00-2024-06-21-12-05-a613f3b42835ed8b', 2, '06/26/2024', 2, 0, 'PM', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 32.87, 76.7, 109.58, '2024-06-21 09:05:15', '0000-00-00 00:00:00', '8.62', '4 Charles St #3004, New York, NY 10014 (4 Charles Prime Rib)', '40.7351675,-74.0006537', '29.95', '32.675', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 61.3125, 'available', '', 0, 's', '1 hour'),
(0x61366362633031363237396636396237, '2024-06-19-15-15-2024-06-18-13-18-a6cbc016279f69b7', 2, '06/19/2024', 3, 15, 'PM', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 39.08, 91.19, 130.28, '2024-06-18 10:18:30', '0000-00-00 00:00:00', '11.87', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', '30.05', '37.075', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 78.5625, 'available', '', 0, '5', '90 mins'),
(0x62363530363730393832343165663833, '2024-06-12-14-15-2024-06-11-11-24-b65067098241ef83', 2, '06/12/2024', 2, 15, 'PM', '383 Madison Ave, New York, NY 10017', '40.7557605,-73.9769036', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 16.38, 65.52, 81.9, '2024-06-11 08:24:30', '0000-00-00 00:00:00', '9.78', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', '17.5', '26.3', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 51.9, 'available', '', 0, '5', '1 hour'),
(0x63393331356533346234363865336534, '2024-06-29-14-00-2024-06-26-17-22-c9315e34b468e3e4', 2, '06/29/2024', 2, 0, 'PM', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 40.9, 95.43, 136.33, '2024-06-26 14:22:30', '0000-00-00 00:00:00', '15.28', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '43.375', '10.325', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 35, 101.325, 'available', '', 0, '2', '2 Hour'),
(0x64656661383633623834303439326339, '2024-06-20-14-15-2024-06-18-15-11-defa863b840492c9', 3, '06/20/2024', 2, 15, 'PM', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+562129617435', 37.14, 86.67, 123.81, '2024-06-18 12:11:53', '2024-06-20 14:05:00', '0.00', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', '30.05', '26.3', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 73.175, 'past', 'ogulcan', 1, '555', '90 mins'),
(0x65326539316232636139366532343065, '2024-06-29-14-00-2024-06-26-17-19-e2e91b2ca96e240e', 2, '06/29/2024', 2, 0, 'PM', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 40.9, 95.43, 136.33, '2024-06-26 14:19:43', '0000-00-00 00:00:00', '15.28', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '43.375', '10.325', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 35, 101.325, 'available', '', 0, '2', '2 Hour'),
(0x65376664373966666261306163646631, '2024-06-19-15-15-2024-06-18-13-17-e7fd79ffba0acdf1', 2, '06/19/2024', 3, 15, 'PM', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 39.08, 91.19, 130.28, '2024-06-18 10:17:14', '0000-00-00 00:00:00', '11.87', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', '30.05', '37.075', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 78.5625, 'available', '', 0, '5', '90 mins'),
(0x65643736336539303763356637666536, '2024-06-21-19-32-2024-06-21-19-17-ed763e907c5f7fe6', 2, '', 0, 0, '', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 23.83, 95.34, 119.17, '2024-06-21 16:17:10', '0000-00-00 00:00:00', '15.27', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '43.325', '10.3', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 0, 119.171, 'available', '', 0, 's', '90 Minutes'),
(0x65646432376333633231636365313336, '2024-06-19-15-00-2024-06-12-13-06-edd27c3c21cce136', 3, '06/19/2024', 3, 0, 'PM', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 17.37, 69.49, 86.86, '2024-06-12 10:06:38', '0000-00-00 00:00:00', '15.53', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '43.425', '10.3', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 56.8625, 'available', '', 0, 'g', '1 hour'),
(0x66326635353730646538653435383436, '2024-06-21-18-53-2024-06-21-18-48-f2f5570de8e45846', 2, '', 0, 0, '', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 23.83, 95.34, 119.17, '2024-06-21 15:48:01', '0000-00-00 00:00:00', '15.27', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '43.325', '10.3', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 0, 119.171, 'available', '', 0, '3', '90 Minutes'),
(0x66653536326538343239306539623735, '2024-06-21-19-07-2024-06-21-18-51-fe562e84290e9b75', 2, '', 0, 0, '', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 23.83, 95.34, 119.17, '2024-06-21 15:51:58', '0000-00-00 00:00:00', '15.27', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '43.325', '10.3', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 0, 119.171, 'available', '', 0, '3', '90 Minutes');

-- --------------------------------------------------------

--
-- Table structure for table `pointatob`
--

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
  `sms_sent` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pointatob`
--

INSERT INTO `pointatob` (`id`, `bookingNumber`, `numberOfPassengers`, `date`, `hour`, `minutes`, `ampm`, `destinationAddress`, `destinationCoords`, `paymentMethod`, `firstName`, `lastName`, `emailAddress`, `phoneNumber`, `bookingFee`, `driverFee`, `totalFare`, `createdAt`, `updated_at`, `duration`, `pickupAddress`, `pickUpCoords`, `returnDuration`, `pickUpDuration`, `hub`, `hubCoords`, `baseFare`, `operationFare`, `status`, `driver`, `sms_sent`) VALUES
(0x30653334333363623832363462613964, '2024-06-22-16-15-2024-06-18-12-53-0e3433cb8264ba9d', 2, '06/22/2024', 4, 15, 'PM', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 10.5, 46.2, 103.83, '2024-06-18 09:53:26', '0000-00-00 00:00:00', '48.33', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '37.925', '2.075', '6th Avenue and West 48th Street New York, NY 10020', '40.7586531,-73.9813286', 35, 51.5258, 'available', '', 0),
(0x31613835616439663761303565623462, '2024-06-12-16-00-2024-06-10-16-52-1a85ad9f7a05eb4b', 2, '06/12/2024', 4, 0, 'PM', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 9.73, 38.92, 48.65, '2024-06-10 13:52:05', '0000-00-00 00:00:00', '15.79', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '12.7', '8.8', '6th Avenue and West 48th Street New York, NY 10020', '40.7586531,-73.9813286', 30, 18.645, 'available', '', 0),
(0x32323763646361303131323637396334, '2024-06-18-15-15-2024-06-12-11-28-227cdca0112679c4', 2, '06/18/2024', 3, 15, 'PM', '45 Rockefeller Plaza, New York, NY 10111 (Rockefeller Center)', '40.7587402,-73.9786736', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 9.46, 37.83, 47.29, '2024-06-12 08:28:35', '2024-06-18 15:05:00', '7.75', '345 Park Ave, New York, NY 10154', '40.7579332,-73.9722189', '9', '17.825', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 17.2875, 'past', 'ogulcan', 1),
(0x32353565363262326433373235353236, '2024-06-27-13-00-2024-06-25-13-01-255e62b2d3725526', 2, '06/27/2024', 1, 0, 'PM', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 10.2, 40.81, 51.01, '2024-06-25 10:01:53', '0000-00-00 00:00:00', '10.37', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '12.45', '19.2', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 21.01, 'available', '', 0),
(0x32623063383438336630613431303838, '2024-06-27-13-00-2024-06-25-12-31-2b0c8483f0a41088', 2, '06/27/2024', 1, 0, 'PM', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 10.2, 40.81, 51.01, '2024-06-25 09:31:33', '0000-00-00 00:00:00', '10.37', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '12.45', '19.2', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 21.01, 'available', '', 0),
(0x32653734393565623932396235306262, '2024-06-12-16-00-2024-06-10-17-15-2e7495eb929b50bb', 2, '06/12/2024', 4, 0, 'PM', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 9.73, 38.92, 48.65, '2024-06-10 14:16:00', '0000-00-00 00:00:00', '15.79', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '12.7', '8.8', '6th Avenue and West 48th Street New York, NY 10020', '40.7586531,-73.9813286', 30, 18.645, 'available', '', 0),
(0x32666235616633633238323366623765, '2024-06-12-16-00-2024-06-07-18-55-deme', 2, '06/12/2024', 4, 0, 'PM', '250 W 50th St, New York, NY 10019', '40.7619828,-73.9856872', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.05, 52.18, 65.23, '2024-06-07 15:55:15', '0000-00-00 00:00:00', '27.04', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', '5.175', '16.5', '6th Avenue and West 48th Street New York, NY 10020', '40.7586531,-73.9813286', 30, 24.3575, 'available', '', 0),
(0x33313130343532366133643364633438, '2024-06-19-15-30-2024-06-10-18-29-31104526a3d3dc48', 3, '06/19/2024', 3, 30, 'PM', '432 Park Ave, New York, NY 10022', '40.7617561,-73.9719035', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 12.09, 48.36, 60.45, '2024-06-10 15:29:28', '0000-00-00 00:00:00', '8.875', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '12.8', '19.075', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 20.375, 'available', '', 0),
(0x34333534613439363830653465306533, '2024-06-12-16-00-2024-06-10-16-54-4354a49680e4e0e3', 2, '06/12/2024', 4, 0, 'PM', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 9.73, 38.92, 48.65, '2024-06-10 13:54:34', '0000-00-00 00:00:00', '15.79', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '12.7', '8.8', '6th Avenue and West 48th Street New York, NY 10020', '40.7586531,-73.9813286', 30, 18.645, 'available', '', 0),
(0x34343761343361303037626634636231, '2024-06-21-17-15-2024-06-10-16-15-447a43a007bf4cb1', 2, '06/21/2024', 5, 15, 'PM', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 10.04, 40.15, 50.19, '2024-06-10 13:15:19', '0000-00-00 00:00:00', '5', '45 Rockefeller Plaza, New York, NY 10111', '40.7591523,-73.9777136', '2.825', '3.875', '6th Avenue and West 48th Street New York, NY 10020', '40.7586531,-73.9813286', 35, 6.825, 'available', '', 0),
(0x34396561323935666430353035363336, '2024-06-27-13-00-2024-06-25-12-59-49ea295fd0505636', 2, '06/27/2024', 1, 0, 'PM', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 10.2, 40.81, 51.01, '2024-06-25 09:59:50', '0000-00-00 00:00:00', '10.37', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '12.45', '19.2', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 21.01, 'available', '', 0),
(0x34613537376634383937643132356366, '2024-06-19-15-30-2024-06-10-18-28-4a577f4897d125cf', 3, '06/19/2024', 3, 30, 'PM', '432 Park Ave, New York, NY 10022', '40.7617561,-73.9719035', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 10.08, 40.3, 50.38, '2024-06-10 15:28:08', '0000-00-00 00:00:00', '8.875', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '12.8', '19.075', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 20.375, 'available', '', 0),
(0x34623530313362333134643265343938, '2024-06-20-14-15-2024-06-18-18-59-4b5013b314d2e498', 2, '06/20/2024', 2, 15, 'PM', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 9, 39.6, 70.23, '2024-06-18 15:59:32', '0000-00-00 00:00:00', '16.75', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '30', '10.3', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 28.525, 'available', '', 0),
(0x34653535353033303963613032646265, '2024-06-11-14-00-2024-06-10-17-59-4e5550309ca02dbe', 2, '06/11/2024', 2, 0, 'PM', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 19.58, 78.3, 97.88, '2024-06-10 14:59:27', '0000-00-00 00:00:00', '31.75', '56 Leonard St, New York, NY 10013', '40.7176987,-74.0062231', '43.425', '60.575', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 67.875, 'available', '', 0),
(0x34656464613938366635643538633565, '2024-06-19-15-00-2024-06-18-13-37-4edda986f5d58c5e', 2, '06/19/2024', 3, 0, 'PM', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 17.66, 70.63, 88.29, '2024-06-18 10:37:43', '0000-00-00 00:00:00', '55.33', '345 Park Ave, New York, NY 10154', '40.7579332,-73.9722189', '43.425', '17.825', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 58.29, 'available', '', 0),
(0x34666664313331336437386631303535, '2024-06-27-13-00-2024-06-25-12-54-4ffd1313d78f1055', 2, '06/27/2024', 1, 0, 'PM', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 10.2, 40.81, 51.01, '2024-06-25 09:54:44', '0000-00-00 00:00:00', '10.37', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '12.45', '19.2', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 21.01, 'available', '', 0),
(0x35326364336461633839333839346433, '2024-06-27-14-15-2024-06-18-14-55-52cd3dac893894d3', 3, '06/27/2024', 2, 15, 'PM', '4 Charles St #3004, New York, NY 10014 (4 Charles Prime Rib)', '40.7351675,-74.0006537', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 14.64, 58.56, 73.21, '2024-06-18 11:55:02', '0000-00-00 00:00:00', '17.91', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', '42.2', '26.3', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 43.205, 'available', '', 0),
(0x36303435663035356565306566666530, '2024-06-12-15-00-2024-06-11-11-20-6045f055ee0effe0', 2, '06/12/2024', 3, 0, 'PM', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 12.24, 48.97, 61.21, '2024-06-11 08:20:46', '0000-00-00 00:00:00', '22.79', 'New York, NY 10017', '40.7519846,-73.9697795', '12.425', '27.2', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 31.2075, 'available', '', 0),
(0x36383636343932313236613766376336, '2024-06-27-15-15-2024-06-26-17-15-6866492126a7f7c6', 1, '06/27/2024', 3, 15, 'PM', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 15.3, 61.21, 76.52, '2024-06-26 14:15:02', '0000-00-00 00:00:00', '23.41', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', '43.375', '26.25', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 46.5175, 'available', '', 0),
(0x36616637323832643337366265653661, '2024-06-19-14-00-2024-06-18-18-37-6af7282d376bee6a', 2, '06/19/2024', 2, 0, 'PM', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 9, 39.6, 85.97, '2024-06-18 15:37:30', '0000-00-00 00:00:00', '28.79', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', '18.175', '36.325', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 41.645, 'available', '', 0),
(0x36656163323339636561356637353933, '2024-06-19-15-00-2024-06-18-13-29-6eac239cea5f7593', 2, '06/19/2024', 3, 0, 'PM', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 9, 39.6, 105.95, '2024-06-18 10:29:58', '0000-00-00 00:00:00', '55.33', '345 Park Ave, New York, NY 10154', '40.7579332,-73.9722189', '43.425', '17.825', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 58.29, 'available', '', 0),
(0x37616238376363323330353532363435, '2024-06-12-16-00-2024-06-10-16-46-7ab87cc230552645', 2, '06/12/2024', 4, 0, 'PM', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 9.73, 38.92, 48.65, '2024-06-10 13:46:44', '0000-00-00 00:00:00', '15.79', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '12.7', '8.8', '6th Avenue and West 48th Street New York, NY 10020', '40.7586531,-73.9813286', 30, 18.645, 'available', '', 0),
(0x37623933306138383666616335653766, '2024-06-19-15-00-2024-06-18-20-34-7b930a886fac5e7f', 2, '06/19/2024', 3, 0, 'PM', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 22.36, 89.44, 111.8, '2024-06-18 17:34:11', '0000-00-00 00:00:00', '40.04', '35 Wall St, New York, NY 10038', '40.706577,-74.010141', '43.425', '80.125', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 81.795, 'available', '', 0),
(0x37656232323835396331346639636538, '2024-06-19-15-15-2024-06-18-12-55-7eb22859c14f9ce8', 2, '06/19/2024', 3, 15, 'PM', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 11.3, 45.22, 56.52, '2024-06-18 09:55:07', '0000-00-00 00:00:00', '15.79', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '18.175', '19.075', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 26.52, 'available', '', 0),
(0x37666436363134343032336635323530, '2024-06-12-16-00-2024-06-07-18-58-7fd66144023f5250', 2, '06/12/2024', 4, 0, 'PM', '250 W 50th St, New York, NY 10019', '40.7619828,-73.9856872', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.05, 52.18, 65.23, '2024-06-07 15:58:23', '0000-00-00 00:00:00', '27.04', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', '5.175', '16.5', '6th Avenue and West 48th Street New York, NY 10020', '40.7586531,-73.9813286', 30, 24.3575, 'available', '', 0),
(0x38316336343266613738373161656362, '2024-06-19-14-00-2024-06-18-18-18-81c642fa7871aecb', 2, '06/19/2024', 2, 0, 'PM', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 9, 39.6, 85.97, '2024-06-18 15:18:42', '0000-00-00 00:00:00', '28.79', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', '18.175', '36.325', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 41.645, 'available', '', 0),
(0x38663165363137353462643530383934, '2024-06-19-15-00-2024-06-18-13-13-8f1e61754bd50894', 2, '06/19/2024', 3, 0, 'PM', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 9, 39.6, 61.17, '2024-06-18 10:13:04', '0000-00-00 00:00:00', '10.45', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '12.425', '19.075', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 20.975, 'available', '', 0),
(0x39303131306537333963353138313133, '2024-06-12-16-00-2024-06-07-18-49', 2, '06/12/2024', 4, 0, 'PM', '250 W 50th St, New York, NY 10019', '40.7619828,-73.9856872', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.05, 52.18, 65.23, '2024-06-07 15:49:48', '0000-00-00 00:00:00', '27.04', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', '5.175', '16.5', '6th Avenue and West 48th Street New York, NY 10020', '40.7586531,-73.9813286', 30, 24.3575, 'available', '', 0),
(0x39306163306335396239386261636265, '2024-06-13-15-15-2024-06-12-16-44-90ac0c59b98bacbe', 2, '06/13/2024', 3, 15, 'PM', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 18.09, 72.38, 90.47, '2024-06-12 13:44:53', '0000-00-00 00:00:00', '41.29', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', '12.425', '37.075', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 45.395, 'available', '', 0),
(0x39323031386533666565376439303162, '2024-06-27-13-00-2024-06-25-12-57-92018e3fee7d901b', 2, '06/27/2024', 1, 0, 'PM', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 10.2, 40.81, 51.01, '2024-06-25 09:57:46', '0000-00-00 00:00:00', '10.37', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '12.45', '19.2', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 21.01, 'available', '', 0),
(0x39626433323735353164363064633436, '2024-06-11-14-00-2024-06-10-18-00-9bd327551d60dc46', 2, '06/11/2024', 2, 0, 'PM', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 19.58, 78.3, 97.88, '2024-06-10 15:00:27', '0000-00-00 00:00:00', '31.75', '56 Leonard St, New York, NY 10013', '40.7176987,-74.0062231', '43.425', '60.575', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 67.875, 'available', '', 0),
(0x39643133346165383033356433363039, '2024-06-27-13-00-2024-06-25-12-36-9d134ae8035d3609', 2, '06/27/2024', 1, 0, 'PM', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 10.2, 40.81, 51.01, '2024-06-25 09:36:47', '0000-00-00 00:00:00', '10.37', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '12.45', '19.2', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 21.01, 'available', '', 0),
(0x61313961663963363534336563303232, '2024-06-20-13-15-2024-06-18-18-45-a19af9c6543ec022', 3, '06/20/2024', 1, 15, 'PM', '254 Elizabeth St, New York, NY 10012', '40.7237145,-73.9934938', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 17.76, 71.03, 88.79, '2024-06-18 15:45:50', '0000-00-00 00:00:00', '51.66', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '55.625', '10.3', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 58.7925, 'available', '', 0),
(0x61326332636236373730353866393530, '2024-06-13-15-15-2024-06-12-16-18-a2c2cb677058f950', 2, '06/13/2024', 3, 15, 'PM', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 18.09, 72.38, 90.47, '2024-06-12 13:18:36', '0000-00-00 00:00:00', '41.29', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', '12.425', '37.075', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 45.395, 'available', '', 0),
(0x61373034376636643166623031373132, '2024-06-12-16-00-2024-06-10-16-51-a7047f6d1fb01712', 2, '06/12/2024', 4, 0, 'PM', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 9.73, 38.92, 48.65, '2024-06-10 13:51:00', '0000-00-00 00:00:00', '15.79', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '12.7', '8.8', '6th Avenue and West 48th Street New York, NY 10020', '40.7586531,-73.9813286', 30, 18.645, 'available', '', 0),
(0x61373338653538356236346563646266, '2024-06-12-16-00-2024-06-07-19-00-a738e585b64ecdbf', 2, '06/12/2024', 4, 0, 'PM', '250 W 50th St, New York, NY 10019', '40.7619828,-73.9856872', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.05, 52.18, 65.23, '2024-06-07 16:00:15', '0000-00-00 00:00:00', '27.04', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', '5.175', '16.5', '6th Avenue and West 48th Street New York, NY 10020', '40.7586531,-73.9813286', 30, 24.3575, 'available', '', 0),
(0x61376636303432313632343835323231, '2024-06-19-15-00-2024-06-18-14-07-a7f6042162485221', 2, '06/19/2024', 3, 0, 'PM', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 17.66, 70.63, 88.29, '2024-06-18 11:07:43', '0000-00-00 00:00:00', '55.33', '345 Park Ave, New York, NY 10154', '40.7579332,-73.9722189', '43.425', '17.825', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 58.29, 'available', '', 0),
(0x61663535303333656665383339626137, '2024-06-27-13-00-2024-06-25-13-11-af55033efe839ba7', 2, '06/27/2024', 1, 0, 'PM', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 10.2, 40.81, 51.01, '2024-06-25 10:12:00', '0000-00-00 00:00:00', '10.37', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '12.45', '19.2', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 21.01, 'available', '', 0),
(0x61666434336630386162656334366463, '2024-06-12-16-00-2024-06-07-18-56-afd43f08abec46dc-0', 2, '06/12/2024', 4, 0, 'PM', '250 W 50th St, New York, NY 10019', '40.7619828,-73.9856872', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.05, 52.18, 65.23, '2024-06-07 15:56:58', '0000-00-00 00:00:00', '27.04', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', '5.175', '16.5', '6th Avenue and West 48th Street New York, NY 10020', '40.7586531,-73.9813286', 30, 24.3575, 'available', '', 0),
(0x62346138303530323135326236616361, '2024-06-12-16-00-2024-06-10-17-38-b4a80502152b6aca', 2, '06/12/2024', 4, 0, 'PM', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 9.73, 38.92, 48.65, '2024-06-10 14:38:59', '0000-00-00 00:00:00', '15.79', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '12.7', '8.8', '6th Avenue and West 48th Street New York, NY 10020', '40.7586531,-73.9813286', 30, 18.645, 'available', '', 0),
(0x62613531376138633930613138303131, '2024-06-27-13-00-2024-06-25-12-43-ba517a8c90a18011', 2, '06/27/2024', 1, 0, 'PM', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 10.2, 40.81, 51.01, '2024-06-25 09:43:31', '0000-00-00 00:00:00', '10.37', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '12.45', '19.2', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 21.01, 'available', '', 0),
(0x62643061396636356236326261316431, '2024-06-27-15-15-2024-06-26-17-12-bd0a9f65b62ba1d1', 1, '06/27/2024', 3, 15, 'PM', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 15.3, 61.21, 76.52, '2024-06-26 14:12:11', '0000-00-00 00:00:00', '23.41', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', '43.375', '26.25', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 46.5175, 'available', '', 0),
(0x63363566303666636232393630363766, '2024-06-12-16-00-2024-06-07-18-56-afd43f08abec46dc-0', 2, '06/12/2024', 4, 0, 'PM', '250 W 50th St, New York, NY 10019', '40.7619828,-73.9856872', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.05, 52.18, 65.23, '2024-06-07 15:53:25', '0000-00-00 00:00:00', '27.04', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', '5.175', '16.5', '6th Avenue and West 48th Street New York, NY 10020', '40.7586531,-73.9813286', 30, 24.3575, 'available', '', 0),
(0x63643830366139386265373733306437, '2024-06-19-14-00-2024-06-18-14-52-cd806a98be7730d7', 2, '06/19/2024', 2, 0, 'PM', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 9, 39.6, 77.15, '2024-06-18 11:52:20', '0000-00-00 00:00:00', '20.70', '345 Park Ave, New York, NY 10154', '40.7579332,-73.9722189', '30.05', '17.825', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 34.2875, 'available', '', 0),
(0x64313063383034336262306564303266, '2024-06-19-15-30-2024-06-10-18-27-d10c8043bb0ed02f', 3, '06/19/2024', 3, 30, 'PM', '432 Park Ave, New York, NY 10022', '40.7617561,-73.9719035', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 10.08, 40.3, 50.38, '2024-06-10 15:27:33', '0000-00-00 00:00:00', '8.875', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '12.8', '19.075', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 20.375, 'available', '', 0),
(0x64343935643762363763363938666434, '2024-06-27-13-00-2024-06-25-12-27-d495d7b67c698fd4', 2, '06/27/2024', 1, 0, 'PM', '548 W 22nd St, New York, NY 10011', '40.747812,-74.007014', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 15.48, 61.93, 77.41, '2024-06-25 09:27:34', '0000-00-00 00:00:00', '35.75', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '39.875', '19.2', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 47.4125, 'available', '', 0),
(0x64643864343065616263396139343166, '2024-06-12-16-00-2024-06-07-18-56-afd43f08abec46dc-0', 2, '06/12/2024', 4, 0, 'PM', '250 W 50th St, New York, NY 10019', '40.7619828,-73.9856872', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.05, 52.18, 65.23, '2024-06-07 15:48:25', '0000-00-00 00:00:00', '27.04', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', '5.175', '16.5', '6th Avenue and West 48th Street New York, NY 10020', '40.7586531,-73.9813286', 30, 24.3575, 'available', '', 0),
(0x65623762366339636162343762346335, '2024-06-27-13-00-2024-06-25-12-33-eb7b6c9cab47b4c5', 2, '06/27/2024', 1, 0, 'PM', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 10.2, 40.81, 51.01, '2024-06-25 09:33:26', '0000-00-00 00:00:00', '10.37', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '12.45', '19.2', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 21.01, 'available', '', 0),
(0x65626561316338653238303338313564, '2024-06-12-14-15-2024-06-11-16-41-ebea1c8e2803815d', 2, '06/12/2024', 2, 15, 'PM', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 14.43, 57.71, 72.14, '2024-06-11 13:41:13', '0000-00-00 00:00:00', '21.58', '4 Charles St #3004, New York, NY 10014 (4 Charles Prime Rib)', '40.7351675,-74.0006537', '30.125', '32.575', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 42.14, 'available', '', 0),
(0x66343563663439656337313731323233, '2024-06-25-15-00-2024-06-19-11-15-f45cf49ec7171223', 3, '06/25/2024', 3, 0, 'PM', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 17.5, 69.98, 87.48, '2024-06-19 08:15:07', '0000-00-00 00:00:00', '44', '222 E 41st St, New York, NY 10017', '40.7493378,-73.9740737', '43.325', '27.625', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 57.475, 'available', '', 0),
(0x66363064353162366130366265613139, '2024-06-12-10-00-2024-06-11-17-42-f60d51b6a06bea19', 2, '06/12/2024', 10, 0, 'AM', '100 W 48th St, New York, NY 10020', '40.7586531,-73.9813286', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 12.04, 48.16, 60.2, '2024-06-11 14:42:35', '0000-00-00 00:00:00', '9.208', '200 Park Ave, New York, NY 10017', '40.7533488,-73.9766668', '10.675', '20.45', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 20.1665, 'available', '', 0),
(0x66366466383565326330303361366463, '2024-06-19-15-00-2024-06-18-12-51-f6df85e2c003a6dc', 2, '06/19/2024', 3, 0, 'PM', '545 8th Ave, New York, NY 10018', '40.7544946,-73.9921654', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 12.02, 48.08, 60.1, '2024-06-18 09:51:51', '0000-00-00 00:00:00', '24.62', '345 Park Ave, New York, NY 10154', '40.7579332,-73.9722189', '17.75', '17.825', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 30.0975, 'available', '', 0),
(0x66373530386634373239623761633031, '2024-06-27-15-00-2024-06-26-12-06-f7508f4729b7ac01', 2, '06/27/2024', 3, 0, 'PM', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 10.2, 40.81, 51.01, '2024-06-26 09:06:06', '0000-00-00 00:00:00', '10.37', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '12.45', '19.2', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 21.01, 'available', '', 0),
(0x66663366396438306462656634646538, '2024-06-18-14-00-2024-06-11-15-48-ff3f9d80dbef4de8', 2, '06/18/2024', 2, 0, 'PM', '45 Rockefeller Plaza, New York, NY 10111 (Rockefeller Center)', '40.7587402,-73.9786736', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 10.68, 42.72, 53.4, '2024-06-11 12:48:26', '0000-00-00 00:00:00', '14.37', '20 W 34th St., New York, NY 10001 (Empire State Building)', '40.7484405,-73.9856644', '9', '23.425', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 23.3975, 'available', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(50) DEFAULT NULL,
  `pass` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `surname` text DEFAULT NULL,
  `email` text NOT NULL,
  `number` varchar(555) NOT NULL,
  `perm` varchar(555) NOT NULL DEFAULT 'driver'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user`, `pass`, `name`, `surname`, `email`, `number`, `perm`) VALUES
(1, 'ogulcan', '$2y$10$4Q/Qs9Mpao0TNgD2TzsnneK.oWMTCvNAmkltywXAaueoAA.kQ68bO', 'Ogulcan', 'Ozdogan', 'ogulcanozdogan@gmail.com', '6562002544', 'admin'),
(6, 'ibrahim', '$2y$10$cHdoJpNSnUety4PikWtFd.ZhcBNMk5EUTmy5hhBcarMjKuOdWIBcu', 'Ibrahim', 'Donmez', 'ibrahimdonmez1983@gmail.com', '2129617435', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users_temporary`
--

CREATE TABLE `users_temporary` (
  `id` int(11) NOT NULL,
  `user` varchar(50) DEFAULT NULL,
  `pass` text DEFAULT NULL,
  `name` text DEFAULT NULL,
  `surname` text DEFAULT NULL,
  `email` text NOT NULL,
  `number` varchar(555) NOT NULL,
  `perm` varchar(555) NOT NULL DEFAULT 'driver'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ayarlar`
--
ALTER TABLE `ayarlar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `centralpark`
--
ALTER TABLE `centralpark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hourly`
--
ALTER TABLE `hourly`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pointatob`
--
ALTER TABLE `pointatob`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_temporary`
--
ALTER TABLE `users_temporary`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ayarlar`
--
ALTER TABLE `ayarlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users_temporary`
--
ALTER TABLE `users_temporary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
