-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 03, 2024 at 11:20 AM
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
  `id` int(11) NOT NULL,
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
(1, '2024-05-14-15-45-2024-05-13-13-17', 2, '05/14/2024', 3, 45, 'PM', '11 W 53rd St, New York, NY 10019, USA', '40.7613258,-73.9774014', 'CASH', 'SUSAN', 'HAVENS', 'ogulcanozdogan@gmail.com', '+16562002544', 10.3, 41.18, 51.48, '2024-05-13 10:17:27', '2024-05-15 13:25:00', '3.55', '45 Rockefeller Plaza, New York, NY 10111, USA', '40.7591523,-73.9777136', '', '', '', '', 0, 51.475, 'past', 'ogulcan', 1),
(2, '2024-05-14-14-00-2024-05-13-13-52', 2, '05/14/2024', 4, 0, 'PM', '45 Rockefeller Plaza, New York, NY 10111, USA', '40.7591523,-73.9777136', 'CASH', 'IBRAHIM', 'DONMEZ', 'ogulcanozdogan@gmail.com', '+16562002544', 10.22, 40.88, 51.11, '2024-05-13 10:52:27', '2024-05-15 13:58:00', '3.183333333333333', '11 W 53rd St, New York, NY 10019, USA', '40.7613258,-73.9774014', '', '', '', '', 0, 51.105, 'past', 'ogulcan', 1),
(3, '2024-05-14-16-00-2024-05-13-14-01', 2, '05/14/2024', 4, 0, 'PM', '45 Rockefeller Plaza, New York, NY 10111, USA', '40.7591523,-73.9777136', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 10.22, 40.88, 51.11, '2024-05-13 11:01:34', NULL, '51.105', '11 W 53rd St, New York, NY 10019, USA', '40.7613258,-73.9774014', '', '', '', '', 0, 51.105, 'available', NULL, 0),
(4, '2024-05-14-15-15-2024-05-13-14-22', 2, '05/14/2024', 3, 15, 'PM', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 11.54, 46.16, 57.7, '2024-05-13 11:22:36', NULL, '57.7', 'John Jay College of Criminal Justice, West 59th Street, New York, NY, USA', '40.7707237,-73.9892342', '', '', '', '', 0, 57.7, 'available', NULL, 0),
(5, '2024-05-14-15-15-2024-05-13-14-34', 2, '05/14/2024', 3, 15, 'PM', 'ZARA, 5th Avenue, New York, NY, USA', '40.7380972,-73.9919555', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 20.14, 80.58, 100.72, '2024-05-13 11:34:59', NULL, '100.72', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 100.72, 'available', NULL, 0),
(6, '2024-05-14-17-00-2024-05-13-15-53', 3, '05/14/2024', 5, 0, 'PM', '200 Park Avenue, New York, NY 10167, USA', '40.7543211,-73.974642', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 14.99, 59.96, 74.95, '2024-05-13 12:53:57', NULL, '74.95', '123 West 50th Street, New York, NY 10020, USA', '40.7601629,-73.9807165', '', '', '', '', 0, 74.95, 'available', NULL, 0),
(7, '2024-05-14-17-00-2024-05-13-16-30', 3, '05/14/2024', 5, 0, 'PM', '200 Park Avenue, New York, NY 10167', '40.7543211,-73.974642', 'CASH', 'SUSAN', 'HAVENS', 'shavens88@gmail.com', '+19175791603', 14.99, 59.96, 74.95, '2024-05-13 13:30:22', NULL, '5.25', '123 West 50th Street, New York, NY 10020, USA', '40.7601629,-73.9807165', '', '', '', '', 0, 74.95, 'available', NULL, 0),
(8, '2024-05-14-16-45-2024-05-13-16-58', 1, '05/14/2024', 4, 45, 'PM', '50 West 57th Street, New York, NY, USA', '40.7637279,-73.976629', 'CASH', 'za', 'dsd', 'ibrahimdonmez1983@gmail.com', '+12129617435', 5.99, 23.96, 29.95, '2024-05-13 13:58:47', NULL, '3.05', '100 Central Park South, New York, NY, USA', '40.7655919,-73.9766034', '', '', '', '', 0, 29.95, 'available', NULL, 0),
(9, '2024-05-14-15-30-2024-05-13-17-05', 2, '05/14/2024', 3, 30, 'PM', '767 Fifth Ave, New York, NY 10153, USA', '40.7638413,-73.9729706', 'CASH', 'sdkasdnbka', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 12.45, 49.78, 62.23, '2024-05-13 14:05:14', NULL, '33.425', '555 8th Ave, New York, NY 10018, USA', '40.7545931,-73.9919416', '', '', '', '', 0, 62.225, 'available', NULL, 0),
(10, '2024-05-14-15-30-2024-05-13-17-41', 2, '05/14/2024', 3, 30, 'PM', '767 Fifth Ave, New York, NY 10153, USA', '40.7638413,-73.9729706', 'CASH', 'SUSAN', 'HAVENS', 'shavens88@gmail.com', '+19175791603', 18.44, 73.74, 92.18, '2024-05-13 14:41:16', NULL, '63.375', '555 8th Ave, New York, NY 10018, USA', '40.7545931,-73.9919416', '', '', '', '', 0, 92.175, 'available', 'ogulcan', 0),
(11, '2024-05-15-16-45-2024-05-13-17-45', 2, '05/15/2024', 4, 45, 'PM', '400 West 43rd Street, New York, NY, USA', '40.7590526,-73.9925457', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 30.69, 122.74, 153.43, '2024-05-13 14:45:55', NULL, '103.625', '711 3rd Avenue, New York, NY, USA', '40.7522486,-73.9729531', '', '', '', '', 0, 153.425, 'available', NULL, 0),
(12, '2024-05-15-14-00-2024-05-13-18-53', 2, '05/15/2024', 2, 0, 'PM', 'Metropolitan Museum of Art, 5th Avenue, New York, NY, USA', '40.7794366,-73.963244', 'CASH', 'PM', 'HAVENS', 'shavens88@gmail.com', '917-579-1603', 44.75, 179, 223.75, '2024-05-13 15:53:17', NULL, '163', 'Whitney Museum of American Art, Gansevoort Street, New York, NY, USA', '40.7395877,-74.0088629', '', '', '', '', 0, 223.75, 'available', NULL, 0),
(13, '2024-05-15-15-15-2024-05-14-11-13', 2, '05/15/2024', 3, 15, 'PM', '5 Columbus Circle, New York, NY, USA', '40.766668,-73.9814608', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 29.04, 116.14, 145.18, '2024-05-14 08:13:42', NULL, '119.875', '250 Park Ave, New York, NY 10177, USA', '40.7551055,-73.9758738', '', '', '', '', 0, 145.175, 'available', 'ogulcan', 0),
(14, '2024-05-15-15-15-2024-05-14-11-15', 2, '05/15/2024', 3, 15, 'PM', '5 Columbus Circle, New York, NY, USA', '40.766668,-73.9814608', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 29.04, 116.14, 145.18, '2024-05-14 08:15:47', NULL, '119.875', '250 Park Ave, New York, NY 10177, USA', '40.7551055,-73.9758738', '', '', '', '', 0, 145.175, 'available', NULL, 0),
(15, '2024-05-15-17-00-2024-05-14-11-20', 2, '05/15/2024', 5, 0, 'PM', '125 Park Avenue, New York, NY, USA', '40.751727,-73.9774507', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 24.67, 98.66, 123.33, '2024-05-14 08:20:19', NULL, '94.75', '5 Columbus Circle, New York, NY, USA', '40.766668,-73.9814608', '', '', '', '', 0, 123.325, 'available', NULL, 0),
(16, '2024-05-15-17-00-2024-05-14-11-20', 2, '05/15/2024', 5, 0, 'PM', '125 Park Avenue, New York, NY, USA', '40.751727,-73.9774507', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 24.67, 98.66, 123.33, '2024-05-14 08:20:19', NULL, '94.75', '5 Columbus Circle, New York, NY, USA', '40.766668,-73.9814608', '', '', '', '', 0, 123.325, 'available', NULL, 0),
(17, '2024-05-15-17-00-2024-05-14-11-24', 2, '05/15/2024', 5, 0, 'PM', '125 Park Avenue, New York, NY, USA', '40.751727,-73.9774507', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 24.67, 98.66, 123.33, '2024-05-14 08:24:44', NULL, '94.75', '5 Columbus Circle, New York, NY, USA', '40.766668,-73.9814608', '', '', '', '', 0, 123.325, 'available', NULL, 0),
(18, '2024-05-15-15-00-2024-05-14-11-33', 1, '05/15/2024', 3, 0, 'PM', '150 East 58th Street, New York, NY, USA', '40.7611177,-73.9681954', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 34.03, 136.1, 170.13, '2024-05-14 08:33:29', NULL, '123.95', '125 Park Avenue, New York, NY, USA', '40.751727,-73.9774507', '', '', '', '', 0, 170.125, 'available', NULL, 0),
(19, '2024-05-15-15-00-2024-05-14-11-38', 1, '05/15/2024', 3, 0, 'PM', '150 East 58th Street, New York, NY, USA', '40.7611177,-73.9681954', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 34.03, 136.1, 170.13, '2024-05-14 08:38:28', NULL, '123.95', '125 Park Avenue, New York, NY, USA', '40.751727,-73.9774507', '', '', '', '', 0, 170.125, 'available', NULL, 0),
(20, '2024-05-15-15-00-2024-05-14-11-42', 1, '05/15/2024', 3, 0, 'PM', '150 East 58th Street, New York, NY, USA', '40.7611177,-73.9681954', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 34.03, 136.1, 170.13, '2024-05-14 08:42:44', NULL, '123.95', '125 Park Avenue, New York, NY, USA', '40.751727,-73.9774507', '', '', '', '', 0, 170.125, 'available', NULL, 0),
(21, '2024-05-15-15-00-2024-05-14-11-56', 1, '05/15/2024', 3, 0, 'PM', '150 East 58th Street, New York, NY, USA', '40.7611177,-73.9681954', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 34.03, 136.1, 170.13, '2024-05-14 08:56:42', NULL, '123.95', '125 Park Avenue, New York, NY, USA', '40.751727,-73.9774507', '', '', '', '', 0, 170.125, 'available', NULL, 0),
(22, '2024-05-15-15-00-2024-05-14-11-58', 1, '05/15/2024', 3, 0, 'PM', '150 East 58th Street, New York, NY, USA', '40.7611177,-73.9681954', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 34.03, 136.1, 170.13, '2024-05-14 08:58:53', NULL, '123.95', '125 Park Avenue, New York, NY, USA', '40.751727,-73.9774507', '', '', '', '', 0, 170.125, 'available', NULL, 0),
(23, '2024-05-15-15-00-2024-05-14-12-00', 1, '05/15/2024', 3, 0, 'PM', '150 East 58th Street, New York, NY, USA', '40.7611177,-73.9681954', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 34.03, 136.1, 170.13, '2024-05-14 09:00:51', NULL, '123.95', '125 Park Avenue, New York, NY, USA', '40.751727,-73.9774507', '', '', '', '', 0, 170.125, 'available', NULL, 0),
(24, '2024-05-15-15-00-2024-05-14-12-03', 1, '05/15/2024', 3, 0, 'PM', '150 East 58th Street, New York, NY, USA', '40.7611177,-73.9681954', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 34.03, 136.1, 170.13, '2024-05-14 09:03:56', NULL, '123.95', '125 Park Avenue, New York, NY, USA', '40.751727,-73.9774507', '', '', '', '', 0, 170.125, 'available', NULL, 0),
(25, '2024-05-15-15-00-2024-05-14-12-05', 1, '05/15/2024', 3, 0, 'PM', '150 East 58th Street, New York, NY, USA', '40.7611177,-73.9681954', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 34.03, 136.1, 170.13, '2024-05-14 09:05:42', NULL, '123.95', '125 Park Avenue, New York, NY, USA', '40.751727,-73.9774507', '', '', '', '', 0, 170.125, 'available', 'ogulcan', 0),
(26, '2024-05-15-14-15-2024-05-14-13-55', 2, '05/15/2024', 2, 15, 'PM', '200 Park Ave, New York, NY, USA', '40.7533488,-73.9766668', 'CASH', 'Oğulcan', 'Özdoğan', 'asdad@asd.adf', '+16562002544', 33.23, 132.92, 166.15, '2024-05-14 10:55:24', NULL, '133.35', '150 East 58th Street, New York, NY, USA', '40.7611177,-73.9681954', '', '', '', '', 0, 166.15, 'available', 'ogulcan', 0),
(27, '2024-05-15-16-15-2024-05-14-15-42', 2, '05/15/2024', 4, 15, 'PM', 'Museum of Modern Art, West 53rd Street, New York, NY, USA', '40.7614327,-73.9776216', 'CASH', 'PM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+16562002544', 22.25, 89, 111.25, '2024-05-14 12:42:24', NULL, '70.85', 'Metropolitan Museum of Art, 5th Avenue, New York, NY, USA', '40.7794366,-73.963244', '', '', '', '', 0, 111.25, 'available', 'ogulcan', 0),
(28, '2024-05-15-14-15-2024-05-14-16-17', 2, '05/15/2024', 2, 15, 'PM', 'Whitney Museum of American Art, Gansevoort Street, New York, NY, USA', '40.7395877,-74.0088629', 'cash', 'oguz', 'yilmaz', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 38.75, 155, 193.75, '2024-05-14 13:18:00', NULL, '120.75', 'Metropolitan Museum of Art, 5th Avenue, New York, NY, USA', '40.7794366,-73.963244', '', '', '', '', 0, 193.75, 'available', NULL, 0),
(29, '2024-05-16-16-30-2024-05-15-13-43', 2, '05/16/2024', 4, 30, 'PM', 'Metropolitan Museum of Art, 5th Avenue, New York, NY, USA', '40.7794366,-73.963244', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+16562002544', 28.25, 113, 141.25, '2024-05-15 10:43:56', NULL, '90.625', 'Metropolitan Museum of Art, 5th Avenue, New York, NY, USA', '40.7794366,-73.963244', '', '', '', '', 0, 141.25, 'available', NULL, 0),
(30, '2024-05-16-16-30-2024-05-15-13-46', 2, '05/16/2024', 4, 30, 'PM', 'Metropolitan Museum of Art, 5th Avenue, New York, NY, USA', '40.7794366,-73.963244', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+16562002544', 28.25, 113, 141.25, '2024-05-15 10:46:12', NULL, '90.625', 'Metropolitan Museum of Art, 5th Avenue, New York, NY, USA', '40.7794366,-73.963244', '', '', '', '', 0, 141.25, 'available', 'ogulcan', 0),
(31, '2024-05-17-16-00-2024-05-16-17-11-31', 2, '05/17/2024', 4, 0, 'PM', 'Radio City Music Hall, 6th Avenue, New York, NY, USA', '40.759976,-73.9799772', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+16562002544', 20.83, 83.32, 104.15, '2024-05-16 14:11:47', NULL, '82.2', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 104.15, 'available', NULL, 0),
(32, '2024-05-31-15-00-2024-05-31-11-22-32', 1, '05/31/2024', 3, 0, 'PM', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@gmail.com', '+13443123124', 21.78, 87.1, 108.88, '2024-05-31 08:22:54', NULL, '84', '45 Rockefeller Plaza, New York, NY, USA', '40.7591523,-73.9777136', '', '', '', '', 0, 108.875, 'available', NULL, 0),
(33, '2024-06-01-16-00-2024-05-31-14-30-33', 2, '06/01/2024', 4, 0, 'PM', '124 West 36th Street, New York, NY, USA', '40.7514727,-73.9881911', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@gmail.com', '+14123412341', 24.33, 97.32, 121.65, '2024-05-31 11:30:28', NULL, '88.375', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 121.65, 'available', NULL, 0),
(34, '2024-06-01-15-00-2024-05-31-17-24-34', 2, '06/01/2024', 3, 0, 'PM', '30 Rockefeller Plaza, Rockefeller Plaza, New York, NY, USA', '40.7593755,-73.9799726', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+16666666666', 27.59, 110.36, 137.95, '2024-05-31 14:24:03', NULL, '112.925', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 137.95, 'available', NULL, 0),
(35, '2024-06-01-15-00-2024-05-31-17-27-35', 2, '06/01/2024', 3, 0, 'PM', '30 Rockefeller Plaza, Rockefeller Plaza, New York, NY, USA', '40.7593755,-73.9799726', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+16666666666', 27.59, 110.36, 137.95, '2024-05-31 14:27:18', NULL, '112.925', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 137.95, 'available', NULL, 0),
(36, '2024-06-04-15-00-2024-06-03-11-48-36', 2, '06/04/2024', 3, 0, 'PM', '30 Rockefeller Plaza, Rockefeller Plaza, New York, NY, USA', '40.7593755,-73.9799726', 'cash', 'asd', 'asd', 'ibrahimdonmez1983@gmail.com', '+16562002544', 18.74, 74.94, 93.68, '2024-06-03 08:48:11', NULL, '65.35', '45 Rockefeller Plaza, New York, NY, USA', '40.7591523,-73.9777136', '', '', '', '', 0, 93.675, 'available', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `hourly`
--

CREATE TABLE `hourly` (
  `id` int(11) NOT NULL,
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
(1, '2024-05-17-15-00-2024-05-16-17-19-0', 2, '05/17/2024', 3, 0, 'PM', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'CASH', 'ogulcan', 'ozdogan', 'ibrahimdonmez1983@gmail.com', '+16562002544', 33.4, 77.94, 111.34, '2024-05-16 14:19:14', '2024-05-17 15:05:00', '22.52', '100 Centre Street, New York, NY, USA', '40.7158872,-74.0012066', '9', '61.875', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 35, 76.3438, 'past', 'ibrahim', 1, '', ''),
(2, '2024-06-01-09-00-2024-05-31-13-07-2', 2, '06/01/2024', 9, 0, 'AM', '30 Rockefeller Plaza, Rockefeller Plaza, New York, NY, USA', '40.7593755,-73.9799726', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@gmail.com', '+14121241231', 36.9, 86.11, 123.01, '2024-05-31 10:07:47', '0000-00-00 00:00:00', '10.23', 'American Museum of Natural History, Central Park West, New York, NY, USA', '40.7813241,-73.9739882', '12.45', '18.425', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 35, 88.0104, 'available', '', 0, 'a', ''),
(3, '2024-06-01-09-00-2024-05-31-13-13-3', 2, '06/01/2024', 9, 0, 'AM', '30 Rockefeller Plaza, Rockefeller Plaza, New York, NY, USA', '40.7593755,-73.9799726', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@gmail.com', '+14121241231', 36.9, 86.11, 123.01, '2024-05-31 10:13:52', '0000-00-00 00:00:00', '10.23', 'American Museum of Natural History, Central Park West, New York, NY, USA', '40.7813241,-73.9739882', '12.45', '18.425', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 35, 88.0104, 'available', '', 0, 'a', ''),
(4, '2024-05-31-19-00-2024-05-31-16-07-4', 2, '05/31/2024', 7, 0, 'PM', 'American Museum of Natural History, Central Park West, New York, NY, USA', '40.7813241,-73.9739882', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@gmail.com', '+14124124124', 46.34, 108.14, 154.48, '2024-05-31 13:07:25', '0000-00-00 00:00:00', '11.28', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '21.625', '3.2', '7th Avenue and West 48th Street New York, NY 10036', '40.7598506,-73.9842032', 35, 119.481, 'available', '', 0, 'aaaaaaaaaaaaaaaaa', ''),
(5, '2024-05-31-19-00-2024-05-31-16-10-5', 2, '05/31/2024', 7, 0, 'PM', 'American Museum of Natural History, Central Park West, New York, NY, USA', '40.7813241,-73.9739882', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@gmail.com', '+14124124124', 46.34, 108.14, 154.48, '2024-05-31 13:10:05', '0000-00-00 00:00:00', '11.28', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '21.625', '3.2', '7th Avenue and West 48th Street New York, NY 10036', '40.7598506,-73.9842032', 35, 119.481, 'available', '', 0, 'aaaaaaaaaaaaaaaaa', ''),
(6, '2024-06-05-17-00-2024-05-31-16-33-6', 1, '06/05/2024', 5, 0, 'PM', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'CARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@gmail.com', '+13333333333', 9.02, 39.67, 48.68, '2024-05-31 13:33:17', '0000-00-00 00:00:00', '0.00', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '0.075', '0.075', '6th Avenue and West 48th Street New York, NY 10020', '40.7586531,-73.9813286', 30, 15.075, 'available', '', 0, 'a', '30 mins'),
(7, '2024-06-05-17-00-2024-05-31-16-35-7', 1, '06/05/2024', 5, 0, 'PM', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'CARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@gmail.com', '+13333333333', 12.02, 52.87, 64.88, '2024-05-31 13:35:21', '0000-00-00 00:00:00', '0.00', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '0.075', '0.075', '6th Avenue and West 48th Street New York, NY 10020', '40.7586531,-73.9813286', 30, 30.075, 'available', '', 0, 'a', '1 hour'),
(8, '2024-06-05-17-00-2024-05-31-16-44-8', 1, '06/05/2024', 5, 0, 'PM', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@gmail.com', '+13333333333', 14.42, 57.67, 72.09, '2024-05-31 13:44:19', '0000-00-00 00:00:00', '0.00', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '0.075', '0.075', '6th Avenue and West 48th Street New York, NY 10020', '40.7586531,-73.9813286', 30, 30.075, 'available', '', 0, 'a', '1 hour'),
(9, '2024-06-05-17-00-2024-05-31-17-21-9', 1, '06/05/2024', 5, 0, 'PM', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@gmail.com', '+13333333333', 14.42, 57.67, 72.09, '2024-05-31 14:21:09', '0000-00-00 00:00:00', '0.00', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '0.075', '0.075', '6th Avenue and West 48th Street New York, NY 10020', '40.7586531,-73.9813286', 30, 30.075, 'available', '', 0, 'a', '1 hour'),
(10, '2024-06-05-17-00-2024-05-31-17-22-10', 1, '06/05/2024', 5, 0, 'PM', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@gmail.com', '+13333333333', 14.42, 57.67, 72.09, '2024-05-31 14:22:31', '0000-00-00 00:00:00', '0.00', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '0.075', '0.075', '6th Avenue and West 48th Street New York, NY 10020', '40.7586531,-73.9813286', 30, 30.075, 'available', '', 0, 'a', '1 hour'),
(11, '2024-06-01-14-00-2024-05-31-17-36-11', 2, '06/01/2024', 2, 0, 'PM', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'CARD', 'Abdul Rehman', 'DONMEZ', 'ibrahimdonmez1983@gmail.com', '+923468040608', 16.3, 71.7, 88, '2024-05-31 14:36:05', '2024-06-01 14:05:00', '5.52', 'RRE Ventures, East 59th Street, New York, NY, USA', '40.762313,-73.96883', '9', '10.675', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 35, 46.4771, 'past', 'ogulcan', 1, 'a', '1 hour'),
(12, '2024-06-04-14-00-2024-06-03-11-50-12', 2, '06/04/2024', 2, 0, 'PM', '30 Rockefeller Plaza, Rockefeller Plaza, New York, NY, USA', '40.7593755,-73.9799726', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@gmail.com', '+16562002544', 17.37, 69.49, 86.87, '2024-06-03 08:50:17', '0000-00-00 00:00:00', '2.02', '45 Rockefeller Plaza, New York, NY, USA', '40.7591523,-73.9777136', '12.45', '12.325', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 42.3875, 'available', '', 0, 'asd', '1 hour');

-- --------------------------------------------------------

--
-- Table structure for table `pointatob`
--

CREATE TABLE `pointatob` (
  `id` int(11) NOT NULL,
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
(7, '2024-05-23-16-30-2024-05-10-12-23', 2, '05/23/2024', 4, 30, 'PM', 'American Museum of Natural History, Central Park West, New York, NY, USA', '', 'CASH', 'asd', 'dsa', '0', '+19175791603', 28.06, 112.25, 140.31, '2024-04-01 22:08:16', '0000-00-00 00:00:00', '109.3', 'Domino Park, River Street, Brooklyn, NY, USA', '', '24.575', '86.75', '6th Avenue and West 48th Street New York, NY 10020', '', 30, 110.312, 'available', '', 0),
(8, '2024-05-23-16-30-2024-05-10-12-26', 2, '05/25/2024', 4, 30, 'PM', 'American Museum of Natural History, Central Park West, New York, NY, USA', '', 'CASH', 'asd', 'dsa', '0', '+19175791603', 28.06, 112.25, 140.31, '2024-05-10 09:26:24', '0000-00-00 00:00:00', '109.3', 'Domino Park, River Street, Brooklyn, NY, USA', '', '24.575', '86.75', '6th Avenue and West 48th Street New York, NY 10020', '', 30, 110.312, 'available', 'ibrahim', 0),
(9, '2024-05-15-16-30-2024-05-10-12-28', 2, '05/23/2024', 4, 30, 'PM', 'American Museum of Natural History, Central Park West, New York, NY, USA', '', 'CASH', 'asd', 'dsa', '0', '+19175791603', 28.06, 112.25, 140.31, '2024-05-10 09:28:05', '2024-05-15 17:05:00', '109.3', 'Domino Park, River Street, Brooklyn, NY, USA', '', '24.575', '86.75', '6th Avenue and West 48th Street New York, NY 10020', '', 30, 110.312, 'past', 'ogulcan', 0),
(10, '2024-05-23-16-30-2024-05-10-12-45', 2, '05/23/2024', 4, 30, 'PM', 'American Museum of Natural History, Central Park West, New York, NY, USA', '40.7813241,-73.9739882', 'CASH', 'asd', 'dsa', 'shavens88@gmail.com', '+19175791603', 28.06, 112.25, 140.31, '2024-05-10 09:45:55', '0000-00-00 00:00:00', '109.3', 'Domino Park, River Street, Brooklyn, NY, USA', '', '24.575', '86.75', '6th Avenue and West 48th Street New York, NY 10020', '', 30, 110.312, 'available', 'ogulcan', 0),
(11, '2024-05-11-19-30-2024-05-10-13-59', 2, '05/11/2024', 7, 30, 'PM', 'Metropolitan Museum of Art, 5th Avenue, New York, NY, USA', '', 'CARD', 'recep tayyip', 'erdogan', 'recep@gmail.com', '+112124123123', 15, 66, 81, '2024-05-10 10:59:06', '0000-00-00 00:00:00', '30.95', '6th Avenue & Central Park South, New York, NY, USA', '', '26.95', '10.675', '7th Avenue and West 48th Street New York, NY 10036', '', 35, 40.0021, 'available', '', 0),
(12, '2024-05-15-22-15-2024-05-10-15-16', 2, '05/15/2024', 10, 15, 'PM', 'Metropolitan Museum of Art, 5th Avenue, New York, NY, USA', '', 'CARD', 'asdd', 'dasd', 'shavens88@gmail.com', '+19175791603', 16.11, 70.87, 86.98, '2024-05-10 12:16:13', '0000-00-00 00:00:00', '55.79', '6th Avenue, New York, NY, USA', '', '26.95', '18.325', '7th Avenue and West 48th Street New York, NY 10036', '', 30, 50.5325, 'available', '', 0),
(13, '2024-05-14-17-30-2024-05-10-15-18', 2, '05/14/2024', 5, 30, 'PM', 'Domino Park, River Street, Brooklyn, NY, USA', '', 'CASH', 'asd', 'dsad', 'asdas@asdasd.com', '+113123123123', 27.29, 109.14, 136.43, '2024-05-10 12:18:12', '0000-00-00 00:00:00', '104.1', 'AMC Lincoln Square 13, Broadway, New York, NY, USA', '', '88.175', '20.575', '6th Avenue and West 48th Street New York, NY 10020', '', 30, 106.425, 'available', '', 0),
(14, '2024-05-15-14-30-2024-05-10-15-29', 2, '05/15/2024', 2, 30, 'PM', 'Domino Park, River Street, Brooklyn, NY, USA', 'Array', 'CASH', 'a', 'd', 'asdad@asdasd.asdas', '+135234', 29.14, 116.54, 145.68, '2024-05-10 12:29:17', '0000-00-00 00:00:00', '72.20', 'Astoria, Queens, NY, USA', 'Array', '98.825', '60.325', 'West Drive and West 59th Street New York, NY 10019', '', 30, 115.675, 'available', '', 0),
(15, '2024-05-15-14-30-2024-05-10-15-32', 2, '05/15/2024', 2, 30, 'PM', 'Domino Park, River Street, Brooklyn, NY, USA', ',', 'CASH', 'a', 'd', 'asdad@asdasd.asdas', '+135234', 29.14, 116.54, 145.68, '2024-05-10 12:32:56', '0000-00-00 00:00:00', '72.20', 'Astoria, Queens, NY, USA', ',', '98.825', '60.325', 'West Drive and West 59th Street New York, NY 10019', '', 30, 115.675, 'available', '', 0),
(16, '2024-05-15-14-30-2024-05-10-15-35', 2, '05/15/2024', 2, 30, 'PM', 'Domino Park, River Street, Brooklyn, NY, USA', '40.7148803,-73.967851', 'CASH', 'a', 'd', 'asdad@asdasd.asdas', '+135234', 29.14, 116.54, 145.68, '2024-05-10 12:35:19', '0000-00-00 00:00:00', '72.20', 'Astoria, Queens, NY, USA', '40.7643574,-73.9234619', '98.825', '60.325', 'West Drive and West 59th Street New York, NY 10019', '', 30, 115.675, 'available', '', 0),
(17, '2024-05-15-14-30-2024-05-10-15-37', 2, '05/15/2024', 2, 30, 'PM', 'Domino Park, River Street, Brooklyn, NY, USA', '40.7148803,-73.967851', 'CASH', 'a', 'd', 'asdad@asdasd.asdas', '+135234', 29.14, 116.54, 145.68, '2024-05-10 12:37:26', '0000-00-00 00:00:00', '72.20', 'Astoria, Queens, NY, USA', '40.7643574,-73.9234619', '98.825', '60.325', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 115.675, 'available', '', 0),
(18, '2024-05-13-19-15-2024-05-10-15-44', 2, '05/13/2024', 7, 15, 'PM', 'Metropolitan Museum of Art, 5th Avenue, New York, NY, USA', '40.7794366,-73.963244', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 16.11, 64.43, 80.53, '2024-05-10 12:44:06', '0000-00-00 00:00:00', '55.79', '6th Avenue, New York, NY, USA', '40.742903,-73.9927978', '26.95', '18.325', '7th Avenue and West 48th Street New York, NY 10036', '40.7598506,-73.9842032', 30, 50.5325, 'available', '', 0),
(19, '2024-05-10-20-00-2024-05-10-16-45', 2, '05/10/2024', 8, 0, 'PM', 'Metropolitan Museum of Art, 5th Avenue, New York, NY, USA', '40.7794366,-73.963244', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 15, 59.98, 74.98, '2024-05-10 13:45:48', '0000-00-00 00:00:00', '24.83', '100 Central Park South, New York, NY, USA', '40.7655919,-73.9766034', '26.95', '16.75', '7th Avenue and West 48th Street New York, NY 10036', '40.7598506,-73.9842032', 35, 39.9758, 'available', '', 0),
(20, '2024-05-15-21-15-2024-05-10-18-19', 2, '05/15/2024', 9, 15, 'PM', 'Metropolitan Museum of Art, 5th Avenue, New York, NY, USA', '40.7794366,-73.963244', 'CASH', 'asd', 'dasd', 'asdas@asdasd.com', '+1123123123131', 12.86, 51.43, 64.29, '2024-05-10 15:20:02', '2024-05-29 15:05:00', '30.95', '6th Avenue & Central Park South, New York, NY, USA', '40.7657419,-73.9762371', '26.95', '10.675', '7th Avenue and West 48th Street New York, NY 10036', '40.7598506,-73.9842032', 30, 34.2875, 'past', 'ibrahim', 1),
(21, '2024-05-15-21-15-2024-05-10-18-23', 2, '05/15/2024', 9, 15, 'PM', 'Metropolitan Museum of Art, 5th Avenue, New York, NY, USA', '40.7794366,-73.963244', 'CASH', 'asd', 'dasd', 'asdas@asdasd.com', '+1123123123131', 12.86, 51.43, 64.29, '2024-05-10 15:23:16', '0000-00-00 00:00:00', '30.95', '6th Avenue & Central Park South, New York, NY, USA', '40.7657419,-73.9762371', '26.95', '10.675', '7th Avenue and West 48th Street New York, NY 10036', '40.7598506,-73.9842032', 30, 34.2875, 'available', '', 0),
(22, '2024-05-13-16-15-2024-05-13-12-06', 1, '05/13/2024', 4, 15, 'PM', 'Metropolitan Museum of Art, 5th Avenue, New York, NY, USA', '40.7794366,-73.963244', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 12.1, 48.39, 60.48, '2024-05-13 09:06:58', '0000-00-00 00:00:00', '23.79', '6th Avenue & Central Park South, New York, NY, USA', '40.7657419,-73.9762371', '29.925', '7.25', '6th Avenue and West 48th Street New York, NY 10020', '40.7586531,-73.9813286', 30, 30.4825, 'available', '', 0),
(23, '2024-05-14-15-30-2024-05-13-12-37', 1, '05/14/2024', 3, 30, 'PM', '11 W 53rd St, New York, NY 10019, USA', '40.7613258,-73.9774014', 'CASH', 'PM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '212-961-7435', 10.3, 41.18, 51.48, '2024-05-13 09:37:40', '0000-00-00 00:00:00', '3.55', '45 Rockefeller Plaza, New York, NY 10111, USA', '40.7591523,-73.9777136', '', '', '', '', 0, 51.475, 'available', '', 0),
(24, '2024-05-15-16-30-2024-05-13-13-06', 2, '05/15/2024', 4, 30, 'PM', '11 W 53rd St, New York, NY 10019, USA', '40.7613258,-73.9774014', 'CASH', 'deneme', 'deneme', 'ibrahimdonmez1983@gmail.com', '+19175791603', 10.3, 41.18, 51.48, '2024-05-13 10:06:57', '0000-00-00 00:00:00', '3.55', '45 Rockefeller Plaza, New York, NY 10111, USA', '40.7591523,-73.9777136', '', '', '', '', 0, 51.475, 'available', '', 0),
(25, '2024-05-15-14-15-2024-05-14-11-21', 1, '05/15/2024', 2, 15, 'PM', 'Metropolitan Museum of Art, 5th Avenue, New York, NY, USA', '40.7794366,-73.963244', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 10.49, 41.96, 52.45, '2024-05-14 08:21:58', '0000-00-00 00:00:00', '23.79', '6th Avenue & Central Park South, New York, NY, USA', '40.7657419,-73.9762371', '19.675', '1.425', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 22.445, 'available', '', 0),
(26, '2024-05-15-17-15-2024-05-14-12-38', 2, '05/15/2024', 5, 15, 'PM', 'Metropolitan Museum of Art, 5th Avenue, New York, NY, USA', '40.7794366,-73.963244', 'CASH', 'Ogulcan', 'Ozdogan', 'ogulcanozdogan@gmail.com', '+16562002544', 12.1, 48.39, 60.48, '2024-05-14 09:38:05', '0000-00-00 00:00:00', '23.79', '6th Avenue & Central Park South, New York, NY, USA', '40.7657419,-73.9762371', '29.925', '7.25', '6th Avenue and West 48th Street New York, NY 10020', '40.7586531,-73.9813286', 30, 30.4825, 'available', 'ogulcan', 0),
(27, '2024-05-15-15-15-2024-05-14-12-40', 2, '05/15/2024', 3, 15, 'PM', 'Metropolitan Museum of Art, 5th Avenue, New York, NY, USA', '40.7794366,-73.963244', 'CARD', 'Suleyman', 'Demirel', 'suleymandemirel@gmail.com', '+12129617435', 10.49, 46.15, 56.64, '2024-05-14 09:40:35', '0000-00-00 00:00:00', '23.79', '6th Avenue & Central Park South, New York, NY, USA', '40.7657419,-73.9762371', '19.675', '1.425', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 22.445, 'available', 'ogulcan', 0),
(28, '2024-05-15-15-15-2024-05-14-12-40', 2, '05/15/2024', 3, 15, 'PM', 'Metropolitan Museum of Art, 5th Avenue, New York, NY, USA', '40.7794366,-73.963244', 'CARD', 'Suleyman', 'Demirel', 'suleymandemirel@gmail.com', '+12129617435', 10.49, 46.15, 56.64, '2024-05-14 09:40:37', '0000-00-00 00:00:00', '23.79', '6th Avenue & Central Park South, New York, NY, USA', '40.7657419,-73.9762371', '19.675', '1.425', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 22.445, 'available', 'ogulcan', 0),
(29, '2024-05-15-17-15-2024-05-14-16-11', 1, '05/15/2024', 5, 15, 'PM', 'Grand central station, East 42nd Street, New York, NY, USA', '40.752714,-73.9772269', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 12.56, 50.23, 62.79, '2024-05-14 13:11:44', '0000-00-00 00:00:00', '27.66', 'ZARA, Broadway, New York, NY, USA', '40.7743041,-73.9825097', '10.125', '27.8', '6th Avenue and West 48th Street New York, NY 10020', '40.7586531,-73.9813286', 30, 32.7925, 'available', 'ogulcan', 0),
(30, '2024-05-17-16-00-2024-05-15-13-38', 2, '05/17/2024', 4, 0, 'PM', '6th Avenue & Central Park South, New York, NY, USA', '40.7657419,-73.9762371', 'CASH', 'PM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+16562002544', 96.13, 144.2, 240.33, '2024-05-15 10:38:31', '0000-00-00 00:00:00', '8.88', 'Metropolitan Museum of Art, 5th Avenue, New York, NY, USA', '40.7794366,-73.963244', '12.925', '39.075', '6th Avenue and West 48th Street New York, NY 10020', '40.7586531,-73.9813286', 35, 205.333, 'available', '', 0),
(31, '2024-05-17-15-30-2024-05-16-17-07-31', 2, '05/17/2024', 3, 30, 'PM', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'CASH', 'deneme', 'deneme', 'ogulcanozdogan@gmail.com', '+16562002544', 13.03, 52.13, 65.16, '2024-05-16 14:07:26', '0000-00-00 00:00:00', '24.25', 'American Museum of Natural History, Central Park West, New York, NY, USA', '40.7813241,-73.9739882', '9', '18.45', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 35, 30.1583, 'available', '', 0),
(32, '2024-05-28-14-00-2024-05-27-14-45-32', 2, '05/28/2024', 2, 0, 'PM', '520 West 49th Street, New York, NY, USA', '40.7644176,-73.9937463', 'CASH', 'PM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.64, 54.56, 68.2, '2024-05-27 11:45:46', '0000-00-00 00:00:00', '26.58', '150 East 42nd Street, New York, NY, USA', '40.7509849,-73.9754252', '24.25', '25.575', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 38.2025, 'available', '', 0),
(33, '2024-05-28-15-00-2024-05-27-15-17-33', 1, '05/28/2024', 3, 0, 'PM', '6th Avenue & Central Park South, New York, NY, USA', '40.7657419,-73.9762371', 'CASH', 'asd', 'asd', 'ibrahimdonmez1983@gmail.com', '+16562002544', 11.8, 47.2, 59, '2024-05-27 12:17:41', '0000-00-00 00:00:00', '22.20', 'Metropolitan Museum of Art, 5th Avenue, New York, NY, USA', '40.7794366,-73.963244', '2.675', '33.125', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 29, 'available', '', 0),
(34, '2024-05-28-15-00-2024-05-27-15-18-34', 1, '05/28/2024', 3, 0, 'PM', '6th Avenue & Central Park South, New York, NY, USA', '40.7657419,-73.9762371', 'CASH', 'asd', 'asd', 'ibrahimdonmez1983@gmail.com', '+16562002544', 11.8, 47.2, 59, '2024-05-27 12:18:54', '0000-00-00 00:00:00', '22.20', 'Metropolitan Museum of Art, 5th Avenue, New York, NY, USA', '40.7794366,-73.963244', '2.675', '33.125', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 29, 'available', '', 0),
(35, '2024-05-28-15-00-2024-05-27-15-19-35', 1, '05/28/2024', 3, 0, 'PM', '6th Avenue & Central Park South, New York, NY, USA', '40.7657419,-73.9762371', 'CASH', 'asd', 'asd', 'ibrahimdonmez1983@gmail.com', '+16562002544', 11.8, 47.2, 59, '2024-05-27 12:19:34', '0000-00-00 00:00:00', '22.20', 'Metropolitan Museum of Art, 5th Avenue, New York, NY, USA', '40.7794366,-73.963244', '2.675', '33.125', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 29, 'available', '', 0),
(36, '2024-05-28-15-00-2024-05-27-15-20-36', 1, '05/28/2024', 3, 0, 'PM', '6th Avenue & Central Park South, New York, NY, USA', '40.7657419,-73.9762371', 'CASH', 'asd', 'asd', 'ibrahimdonmez1983@gmail.com', '+16562002544', 11.8, 47.2, 59, '2024-05-27 12:20:13', '0000-00-00 00:00:00', '22.20', 'Metropolitan Museum of Art, 5th Avenue, New York, NY, USA', '40.7794366,-73.963244', '2.675', '33.125', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 29, 'available', '', 0),
(37, '2024-05-29-15-15-2024-05-27-16-20-37', 2, '05/29/2024', 3, 15, 'PM', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'CASH', 'IBRAHIM', 'asd', 'ibrahimdonmez1983@yahoo.com', '+16562002544', 11.17, 44.67, 55.84, '2024-05-27 13:20:29', '0000-00-00 00:00:00', '24.25', 'American Museum of Natural History, Central Park West, New York, NY, USA', '40.7813241,-73.9739882', '9', '18.425', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 25.8375, 'available', '', 0),
(38, '2024-05-31-16-00-2024-05-29-12-43-38', 2, '05/31/2024', 4, 0, 'PM', '45 Rockefeller Plaza, New York, NY, USA', '40.7591523,-73.9777136', 'CASH', 'deneme', 'deneme', 'ibrahimdonmez1983@gmail.com', '+16562002544', 10.5, 42, 52.5, '2024-05-29 09:43:34', '0000-00-00 00:00:00', '2.125', '30 Rockefeller Plaza, Rockefeller Plaza, New York, NY, USA', '40.7593755,-73.9799726', '3', '2.05', '6th Avenue and West 48th Street New York, NY 10020', '40.7586531,-73.9813286', 35, 4.18542, 'available', '', 0),
(39, '2024-06-01-15-00-2024-05-31-14-11-39', 2, '06/01/2024', 3, 0, 'PM', 'American Museum of Natural History, Central Park West, New York, NY, USA', '40.7813241,-73.9739882', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@gmail.com', '+15555555555', 16.23, 64.9, 81.13, '2024-05-31 11:11:33', '0000-00-00 00:00:00', '29.25', '45 Rockefeller Plaza, New York, NY, USA', '40.7591523,-73.9777136', '14.325', '12.325', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 35, 32.6083, 'available', '', 0),
(40, '2024-06-01-15-00-2024-05-31-14-12-40', 2, '06/01/2024', 3, 0, 'PM', 'American Museum of Natural History, Central Park West, New York, NY, USA', '40.7813241,-73.9739882', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@gmail.com', '+15555555555', 16.23, 64.9, 81.13, '2024-05-31 11:12:36', '0000-00-00 00:00:00', '29.25', '45 Rockefeller Plaza, New York, NY, USA', '40.7591523,-73.9777136', '14.325', '12.325', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 35, 32.6083, 'available', '', 0),
(41, '2024-06-01-15-00-2024-05-31-14-17-41', 2, '06/01/2024', 3, 0, 'PM', 'American Museum of Natural History, Central Park West, New York, NY, USA', '40.7813241,-73.9739882', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@gmail.com', '+15555555555', 16.23, 64.9, 81.13, '2024-05-31 11:18:01', '0000-00-00 00:00:00', '29.25', '45 Rockefeller Plaza, New York, NY, USA', '40.7591523,-73.9777136', '14.325', '12.325', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 35, 32.6083, 'available', '', 0),
(42, '2024-06-01-15-00-2024-05-31-14-18-42', 2, '06/01/2024', 3, 0, 'PM', 'American Museum of Natural History, Central Park West, New York, NY, USA', '40.7813241,-73.9739882', 'CARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@gmail.com', '+15555555555', 13.52, 59.5, 73.02, '2024-05-31 11:18:55', '0000-00-00 00:00:00', '29.25', '45 Rockefeller Plaza, New York, NY, USA', '40.7591523,-73.9777136', '14.325', '12.325', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 35, 32.6083, 'available', '', 0),
(43, '2024-06-01-15-00-2024-05-31-14-31-43', 2, '06/01/2024', 3, 0, 'PM', 'American Museum of Natural History, Central Park West, New York, NY, USA', '40.7813241,-73.9739882', 'CARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@gmail.com', '+15555555555', 13.52, 59.5, 73.02, '2024-05-31 11:31:09', '0000-00-00 00:00:00', '29.25', '45 Rockefeller Plaza, New York, NY, USA', '40.7591523,-73.9777136', '14.325', '12.325', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 35, 32.6083, 'available', '', 0),
(44, '2024-06-01-14-00-2024-05-31-17-38-44', 2, '06/01/2024', 2, 0, 'PM', 'American Museum of Natural History, Central Park West, New York, NY, USA', '40.7813241,-73.9739882', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@gmail.com', '+14444444444', 15.22, 60.87, 76.09, '2024-05-31 14:38:41', '0000-00-00 00:00:00', '25.33', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '14.325', '9.05', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 35, 28.4112, 'available', '', 0),
(45, '2024-06-04-13-00-2024-06-03-12-03-45', 3, '06/04/2024', 1, 0, 'PM', '30 Rockefeller Plaza, Rockefeller Plaza, New York, NY, USA', '40.7593755,-73.9799726', 'FULLCARD', 'IBRAHIM', 'DONMEZ', '', '+13434343434', 12.29, 49.14, 61.43, '2024-06-03 09:03:46', '0000-00-00 00:00:00', '10.5', '45 East 45th Street, New York, NY, USA', '40.7549394,-73.9772689', '12.45', '19.425', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 21.1875, 'available', '', 0),
(46, '2024-06-04-13-00-2024-06-03-12-23-46', 3, '06/04/2024', 1, 0, 'PM', '30 Rockefeller Plaza, Rockefeller Plaza, New York, NY, USA', '40.7593755,-73.9799726', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@gmail.com', '+13434343434', 12.29, 49.14, 61.43, '2024-06-03 09:23:19', '0000-00-00 00:00:00', '10.5', '45 East 45th Street, New York, NY, USA', '40.7549394,-73.9772689', '12.45', '19.425', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 21.1875, 'available', '', 0),
(47, '2024-06-04-13-00-2024-06-03-12-38-47', 3, '06/04/2024', 1, 0, 'PM', '30 Rockefeller Plaza, Rockefeller Plaza, New York, NY, USA', '40.7593755,-73.9799726', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@gmail.com', '+13434343434', 12.29, 49.14, 61.43, '2024-06-03 09:38:16', '0000-00-00 00:00:00', '10.5', '45 East 45th Street, New York, NY, USA', '40.7549394,-73.9772689', '12.45', '19.425', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 21.1875, 'available', '', 0),
(48, '2024-06-04-13-00-2024-06-03-12-54-48', 3, '06/04/2024', 1, 0, 'PM', '30 Rockefeller Plaza, Rockefeller Plaza, New York, NY, USA', '40.7593755,-73.9799726', 'FULLCARD', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@gmail.com', '+13434343434', 12.29, 49.14, 61.43, '2024-06-03 09:54:29', '0000-00-00 00:00:00', '10.5', '45 East 45th Street, New York, NY, USA', '40.7549394,-73.9772689', '12.45', '19.425', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 21.1875, 'available', '', 0);

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
(1, 'ogulcan', '$2y$10$4Q/Qs9Mpao0TNgD2TzsnneK.oWMTCvNAmkltywXAaueoAA.kQ68bO', 'Ogulcan', 'ÖZDOĞAN', '', '6562002544', 'driver'),
(6, 'ibrahim', '$2y$10$RKNDubIvjGQ2dDqOsSY7KepJgW.ZNtRCtfbamGLvKcHTgLfFdxKfG', 'Ibrahim', 'Donmez', '', '2129617435', 'admin'),
(11, 'deneme', '$2y$10$11bs21YMNrCuzQlkpDjq3O22JsTrxo4X7mXMWRrzb2.401Kw6W01a', 'deneme', 'deneme', 'deneme1@deneme1.cs', '1231231231', 'driver');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ayarlar`
--
ALTER TABLE `ayarlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `centralpark`
--
ALTER TABLE `centralpark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `hourly`
--
ALTER TABLE `hourly`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pointatob`
--
ALTER TABLE `pointatob`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
