-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 26, 2024 at 04:13 PM
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
-- Database: `PedicabsOnDemand`
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
(0x30393132633263326163353762343939, '2024-06-20-19-14-2024-06-20-18-58-0912c2c2ac57b499', 2, '06/20/2024', 0, 0, '', '1 E 58th St, New York, NY 10022', '40.7636298,-73.9734288', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 10.23, 40.91, 51.14, '2024-06-20 15:58:22', NULL, '57.45', '310 W 53rd St, New York, NY 10019 (Turkuaz Halal Turkish Mediterranean)', '40.7643246,-73.9854905', '', '', '', '', 0, 51.1406, 'available', NULL, 0),
(0x31366531386136663361613931306132, '2024-06-18-15-12-2024-06-18-14-46-16e18a6f3aa910a2', 3, '06/18/2024', 0, 0, '', '1325 6th Ave, New York, NY 10019', '40.7627644,-73.9808403', 'card', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 12.77, 56.17, 68.93, '2024-06-18 11:46:03', NULL, '68.25', '300 W 42nd St, New York, NY 10017', '40.7573192,-73.9903724', '', '', '', '', 0, 63.8281, 'available', NULL, 0),
(0x31393563666436346630626339313566, '2024-06-25-12-20-2024-06-25-11-52-195cfd64f0bc915f', 1, '06/25/2024', 0, 0, '', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+562129617435', 13.51, 54.04, 67.55, '2024-06-25 08:52:55', NULL, '72.875', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '', '', '', '', 0, 67.5469, 'available', NULL, 0),
(0x31646533373261313038643030386232, '2024-06-18-21-25-2024-06-18-21-03-1de372a108d008b2', 2, '06/18/2024', 0, 0, '', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.92, 55.68, 69.59, '2024-06-18 18:03:13', '2024-06-19 13:05:01', '75.675', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', '', '', '', '', 0, 69.5938, 'past', 'ogulcan', 1),
(0x31663561663438623564363465616266, '2024-06-26-17-05-2024-06-26-16-37-1f5af48b5d64eabf', 2, '06/26/2024', 0, 0, '', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.51, 54.04, 67.55, '2024-06-26 13:37:42', NULL, '72.875', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '', '', '', '', 0, 67.5469, 'available', NULL, 0),
(0x32303735623735363966393764613361, '2024-06-18-18-51-2024-06-18-14-24-2075b7569f97da3a', 2, '06/18/2024', 0, 0, '', '1325 6th Ave, New York, NY 10019', '40.7627644,-73.9808403', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 12.77, 51.06, 63.83, '2024-06-18 11:24:45', NULL, '68.5', '300 W 42nd St, New York, NY 10036', '40.7574615,-73.9907055', '', '', '', '', 0, 63.8281, 'available', NULL, 0),
(0x32316464313066313562613736623631, '2024-06-18-15-00-2024-06-18-14-34-21dd10f15ba76b61', 2, '06/18/2024', 0, 0, '', '1325 6th Ave, New York, NY 10019', '40.7627644,-73.9808403', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 12.77, 51.06, 63.83, '2024-06-18 11:34:08', NULL, '68.5', '300 W 42nd St, New York, NY 10036', '40.7574615,-73.9907055', '', '', '', '', 0, 63.8281, 'available', NULL, 0),
(0x32363866386161306132383539616231, '2024-06-10-15-02-2024-06-10-14-44-268f8aa0a2859ab1', 2, '06/10/2024', 0, 0, '', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 25.58, 102.3, 127.88, '2024-06-10 11:44:59', NULL, '95', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 127.875, 'available', NULL, 0),
(0x32653534656263623661626462373066, '2024-06-07-16-29-2024-06-07-15-56', 1, '06/07/2024', 0, 0, '', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 36.41, 145.62, 182.03, '2024-06-07 12:56:12', NULL, '110.2', '451 10th Ave, New York, NY 10018', '40.7557505,-73.9986545', '', '', '', '', 0, 182.025, 'available', NULL, 0),
(0x33313138363864663062663337663936, '2024-06-20-19-01-2024-06-20-18-42-311868df0bf37f96', 3, '06/20/2024', 0, 0, '', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 12.74, 50.96, 63.7, '2024-06-20 15:42:19', NULL, '69.925', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 63.7031, 'available', NULL, 0),
(0x33373731356562616231313030316663, '2024-06-18-15-03-2024-06-18-14-36-37715ebab11001fc', 2, '06/18/2024', 0, 0, '', '1325 6th Ave, New York, NY 10019', '40.7627644,-73.9808403', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 12.77, 51.06, 63.83, '2024-06-18 11:36:47', NULL, '68.5', '300 W 42nd St, New York, NY 10036', '40.7574615,-73.9907055', '', '', '', '', 0, 63.8281, 'available', NULL, 0),
(0x33393561363537366137653065666634, '2024-06-10-16-14-2024-06-10-15-45-395a6576a7e0eff4', 2, '06/10/2024', 0, 0, '', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 22.4, 89.6, 112, '2024-06-10 12:45:23', NULL, '74.75', '338 W 36th St., New York, NY 10018', '40.7539456,-73.9941606', '', '', '', '', 0, 112, 'available', NULL, 0),
(0x33616535306537323730333362626539, '2024-06-12-14-22-2024-06-12-13-49-3ae50e727033bbe9', 1, '06/12/2024', 0, 0, '', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 25.76, 103.04, 128.8, '2024-06-12 10:49:38', NULL, '82.175', '451 10th Ave, New York, NY 10018', '40.7557505,-73.9986545', '', '', '', '', 0, 128.8, 'available', NULL, 0),
(0x34356433356466306661393138636566, '2024-06-19-17-39-2024-06-19-17-21-45d35df0fa918cef', 1, '06/19/2024', 0, 0, '', '222 W 51st St, New York, NY 10019', '40.7623891,-73.9853968', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 10.54, 42.18, 52.72, '2024-06-19 14:21:06', NULL, '62.175', '222 W 51st St, New York, NY 10019', '40.7623891,-73.9853968', '', '', '', '', 0, 52.7188, 'available', NULL, 0),
(0x34653932633061373266663661393361, '2024-06-07-16-28-2024-06-07-15-55', 1, '06/07/2024', 0, 0, '', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 36.41, 145.62, 182.03, '2024-06-07 12:55:25', NULL, '110.2', '451 10th Ave, New York, NY 10018', '40.7557505,-73.9986545', '', '', '', '', 0, 182.025, 'available', NULL, 0),
(0x34663532346266353163306530383665, '2024-06-14-13-35-2024-06-14-13-18-4f524bf51c0e086e', 1, '06/14/2024', 0, 0, '', '237 W 54th St, New York, NY 10019 (Hilton Garden Inn New York/Central Park South-Midtown West)', '40.7644997,-73.9831151', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 20.65, 82.6, 103.25, '2024-06-14 10:18:53', NULL, '80.875', '150 E 58th St, New York, NY 10155', '40.7611177,-73.9681954', '', '', '', '', 0, 103.25, 'available', NULL, 0),
(0x35306435393966303234353462353861, '2024-06-25-12-26-2024-06-25-11-58-50d599f02454b58a', 1, '06/25/2024', 0, 0, '', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+562129617435', 13.51, 54.04, 67.55, '2024-06-25 08:58:21', NULL, '72.875', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '', '', '', '', 0, 67.5469, 'available', NULL, 0),
(0x35363230323839363735373032353735, '2024-06-18-19-32-2024-06-18-19-09-5620289675702575', 2, '06/18/2024', 0, 0, '', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.92, 55.68, 69.59, '2024-06-18 16:09:53', NULL, '75.675', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', '', '', '', '', 0, 69.5938, 'available', NULL, 0),
(0x35363536623163346638663363373262, '2024-06-25-12-27-2024-06-25-11-59-5656b1c4f8f3c72b', 1, '06/25/2024', 0, 0, '', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+562129617435', 13.51, 54.04, 67.55, '2024-06-25 08:59:23', NULL, '72.875', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '', '', '', '', 0, 67.5469, 'available', NULL, 0),
(0x35623834366265316133626532643833, '2024-06-11-11-47-2024-06-11-11-25-5b846be1a3be2d83', 1, '06/11/2024', 0, 0, '', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 23.27, 93.08, 116.35, '2024-06-11 08:25:17', NULL, '80.675', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', '', '', '', '', 0, 116.35, 'available', NULL, 0),
(0x36383661323864643937373061653739, '2024-06-07-15-31-2024-06-07-14-46-0', 1, '06/07/2024', 0, 0, '', '40a 10th Ave, New York, NY 10014 (40a 10th Ave)', '40.741486,-74.008156', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 41.6, 166.4, 208, '2024-06-07 11:46:37', NULL, '124', '40a 10th Ave, New York, NY 10014 (40a 10th Ave)', '40.741486,-74.008156', '', '', '', '', 0, 208, 'available', NULL, 0),
(0x36386639633231616164393230383237, '2024-06-18-14-31-2024-06-18-14-05-68f9c21aad920827', 2, '06/18/2024', 0, 0, '', '1325 6th Ave, New York, NY 10019', '40.7627644,-73.9808403', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 12.77, 51.06, 63.83, '2024-06-18 11:05:46', NULL, '68.5', '300 W 42nd St, New York, NY 10036', '40.7574615,-73.9907055', '', '', '', '', 0, 63.8281, 'available', NULL, 0),
(0x36396631343931636633333135383933, '2024-06-26-16-55-2024-06-26-16-27-69f1491cf3315893', 2, '06/26/2024', 0, 0, '', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.51, 54.04, 67.55, '2024-06-26 13:27:16', NULL, '72.875', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '', '', '', '', 0, 67.5469, 'available', NULL, 0),
(0x36653064356334313766396538623963, '2024-06-18-15-05-2024-06-18-14-38-6e0d5c417f9e8b9c', 2, '06/18/2024', 0, 0, '', '1325 6th Ave, New York, NY 10019', '40.7627644,-73.9808403', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 12.77, 51.06, 63.83, '2024-06-18 11:38:24', NULL, '68.5', '300 W 42nd St, New York, NY 10036', '40.7574615,-73.9907055', '', '', '', '', 0, 63.8281, 'available', NULL, 0),
(0x37303461326533323430663764323236, '2024-06-10-15-02-2024-06-10-14-44-704a2e3240f7d226', 2, '06/10/2024', 0, 0, '', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 25.58, 102.3, 127.88, '2024-06-10 11:44:57', NULL, '95', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 127.875, 'available', NULL, 0),
(0x37646466656635383930396230616537, '2024-06-20-19-02-2024-06-20-18-43-7ddfef58909b0ae7', 3, '06/20/2024', 0, 0, '', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 12.74, 50.96, 63.7, '2024-06-20 15:43:32', NULL, '69.925', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 63.7031, 'available', NULL, 0),
(0x37656638376237313263313865303638, '2024-06-10-16-07-2024-06-10-15-38-7ef87b712c18e068', 2, '06/10/2024', 0, 0, '', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 22.4, 89.6, 112, '2024-06-10 12:38:01', NULL, '74.75', '338 W 36th St., New York, NY 10018', '40.7539456,-73.9941606', '', '', '', '', 0, 112, 'available', NULL, 0),
(0x38306364333332653261383735333465, '2024-06-18-14-57-2024-06-18-14-30-80cd332e2a87534e', 2, '06/18/2024', 0, 0, '', '1325 6th Ave, New York, NY 10019', '40.7627644,-73.9808403', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 12.77, 51.06, 63.83, '2024-06-18 11:30:27', NULL, '68.5', '300 W 42nd St, New York, NY 10036', '40.7574615,-73.9907055', '', '', '', '', 0, 63.8281, 'available', NULL, 0),
(0x38393463353732396436666138343962, '2024-06-07-16-02-2024-06-07-15-32', 1, '06/07/2024', 0, 0, '', '451 10th Ave, New York, NY 10018', '40.7557505,-73.9986545', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 27.63, 110.52, 138.15, '2024-06-07 12:32:23', NULL, '88.075', '33 W 37th St, New York, NY 10018 (Marriott Vacation Club, New York City)', '40.7512956,-73.9848187', '', '', '', '', 0, 138.15, 'available', NULL, 0),
(0x38616462653933313061316266343734, '2024-06-10-15-02-2024-06-10-14-44-8adbe9310a1bf474', 2, '06/10/2024', 0, 0, '', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 25.58, 102.3, 127.88, '2024-06-10 11:44:58', NULL, '95', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 127.875, 'available', NULL, 0),
(0x38666134363138626561316535613265, '2024-06-26-17-06-2024-06-26-16-38-8fa4618bea1e5a2e', 2, '06/26/2024', 0, 0, '', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.51, 54.04, 67.55, '2024-06-26 13:38:54', NULL, '72.875', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '', '', '', '', 0, 67.5469, 'available', NULL, 0),
(0x39333264396365643633353961643231, '2024-06-26-18-07-2024-06-26-17-48-932d9ced6359ad21', 2, '06/26/2024', 0, 0, '', '222 E 41st St, New York, NY 10017', '40.7493378,-73.9740737', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 16.18, 64.73, 80.91, '2024-06-26 14:48:34', '2024-06-26 18:05:02', '87.65', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 80.9062, 'past', 'ogulcan', 1),
(0x39643762313131313163393131313864, '2024-06-20-18-59-2024-06-20-18-40-9d7b11111c91118d', 3, '06/20/2024', 0, 0, '', '625 8th Ave, New York, NY 10018', '40.7569282,-73.9905282', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 12.74, 50.96, 63.7, '2024-06-20 15:40:52', NULL, '69.925', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 63.7031, 'available', NULL, 0),
(0x61343164663366313364393965336366, '2024-06-10-16-40-2024-06-10-15-55-a41df3f13d99e3cf', 1, '06/10/2024', 0, 0, '', '440 W 57th St, New York, NY 10019', '40.7684256,-73.9874565', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 29.02, 116.08, 145.1, '2024-06-10 12:55:48', NULL, '95.175', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', '', '', '', '', 0, 145.1, 'available', NULL, 0),
(0x61353165303436646637383635643637, '2024-06-11-16-56-2024-06-11-16-39-a51e046df7865d67', 1, '06/11/2024', 0, 0, '', '888 8th Ave, New York, NY 10019', '40.7637113,-73.9848426', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 15.97, 63.88, 79.85, '2024-06-11 13:39:45', NULL, '59.925', '888 8th Ave, New York, NY 10019', '40.7637113,-73.9848426', '', '', '', '', 0, 79.85, 'available', NULL, 0),
(0x61353334326435363031393539396265, '2024-06-26-17-03-2024-06-26-16-35-a5342d56019599be', 2, '06/26/2024', 0, 0, '', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.51, 54.04, 67.55, '2024-06-26 13:36:00', NULL, '72.875', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '', '', '', '', 0, 67.5469, 'available', NULL, 0),
(0x61656463663761363831656562303436, '2024-06-10-16-39-2024-06-10-15-54-aedcf7a681eeb046', 1, '06/10/2024', 0, 0, '', '440 W 57th St, New York, NY 10019', '40.7684256,-73.9874565', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 29.02, 116.08, 145.1, '2024-06-10 12:54:25', NULL, '95.175', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', '', '', '', '', 0, 145.1, 'available', NULL, 0),
(0x62366631356162323933303665626562, '2024-06-18-18-54-2024-06-18-14-27-b6f15ab29306ebeb', 2, '06/18/2024', 0, 0, '', '1325 6th Ave, New York, NY 10019', '40.7627644,-73.9808403', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 12.77, 51.06, 63.83, '2024-06-18 11:27:27', NULL, '68.5', '300 W 42nd St, New York, NY 10036', '40.7574615,-73.9907055', '', '', '', '', 0, 63.8281, 'available', NULL, 0),
(0x62393730633231383837663065303632, '2024-06-26-18-02-2024-06-26-17-43-b970c21887f0e062', 2, '06/26/2024', 0, 0, '', '222 E 41st St, New York, NY 10017', '40.7493378,-73.9740737', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 16.18, 64.73, 80.91, '2024-06-26 14:43:45', NULL, '87.65', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 80.9062, 'available', NULL, 0),
(0x62633936376161323235383263383363, '2024-06-26-14-26-2024-06-26-14-07-bc967aa22582c83c', 2, '06/26/2024', 0, 0, '', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.51, 54.04, 67.55, '2024-06-26 11:07:53', NULL, '75.2', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 67.5469, 'available', NULL, 0),
(0x63626130613262346337363232656336, '2024-06-18-15-04-2024-06-18-14-37-cba0a2b4c7622ec6', 2, '06/18/2024', 0, 0, '', '1325 6th Ave, New York, NY 10019', '40.7627644,-73.9808403', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 12.77, 51.06, 63.83, '2024-06-18 11:37:23', NULL, '68.5', '300 W 42nd St, New York, NY 10036', '40.7574615,-73.9907055', '', '', '', '', 0, 63.8281, 'available', NULL, 0),
(0x64303663656665333566343033646432, '2024-06-21-12-40-2024-06-21-12-21-d06cefe35f403dd2', 2, '06/21/2024', 0, 0, '', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 16.94, 67.76, 84.69, '2024-06-21 09:21:16', NULL, '80.1', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 84.6937, 'available', NULL, 0),
(0x64306261643139616637666432316165, '2024-06-26-18-05-2024-06-26-17-47-d0bad19af7fd21ae', 2, '06/26/2024', 0, 0, '', '222 E 41st St, New York, NY 10017', '40.7493378,-73.9740737', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 16.18, 64.73, 80.91, '2024-06-26 14:47:01', NULL, '87.65', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 80.9062, 'available', NULL, 0),
(0x64366631393039303466306461613535, '2024-06-07-18-57-2024-06-07-18-12-0', 1, '06/07/2024', 0, 0, '', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 41.6, 166.4, 208, '2024-06-07 15:12:31', NULL, '124', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', '', '', '', '', 0, 208, 'available', NULL, 0),
(0x64613963313636663339363439666165, '2024-06-18-16-52-2024-06-18-16-19-da9c166f39649fae', 1, '06/18/2024', 0, 0, '', '1325 6th Ave, New York, NY 10019', '40.7627644,-73.9808403', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+6822129617435', 14.69, 58.78, 73.47, '2024-06-18 13:19:10', NULL, '77.3', '451 10th Ave, New York, NY 10018', '40.7557505,-73.9986545', '', '', '', '', 0, 73.4688, 'available', NULL, 0),
(0x64646132616233666330653831643434, '2024-06-11-16-59-2024-06-11-16-35-dda2ab3fc0e81d44', 1, '06/11/2024', 0, 0, '', '4 Charles St #3004, New York, NY 10014 (4 Charles Prime Rib)', '40.7351675,-74.0006537', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 31.1, 124.38, 155.48, '2024-06-11 13:35:13', NULL, '93.325', '575 8th Ave, New York, NY 10018', '40.7550226,-73.9916868', '', '', '', '', 0, 155.475, 'available', NULL, 0),
(0x64663430343130363434303035366238, '2024-06-07-18-57-2024-06-07-18-12-0', 1, '06/07/2024', 0, 0, '', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 36.41, 145.62, 182.03, '2024-06-07 12:54:23', NULL, '110.2', '451 10th Ave, New York, NY 10018', '40.7557505,-73.9986545', '', '', '', '', 0, 182.025, 'available', NULL, 0),
(0x65353037613134636166623766386466, '2024-06-10-15-02-2024-06-10-14-44-e507a14cafb7f8df', 2, '06/10/2024', 0, 0, '', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 25.58, 102.3, 127.88, '2024-06-10 11:44:16', NULL, '95', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 127.875, 'available', NULL, 0),
(0x65353566323835663766613466333062, '2024-06-10-14-55-2024-06-10-14-37-e55f285f7fa4f30b', 2, '06/10/2024', 0, 0, '', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 25.58, 102.3, 127.88, '2024-06-10 11:37:27', NULL, '95', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '', '', '', '', 0, 127.875, 'available', NULL, 0),
(0x66326165303164376433326562373336, '2024-06-26-17-04-2024-06-26-16-36-f2ae01d7d32eb736', 2, '06/26/2024', 0, 0, '', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.51, 54.04, 67.55, '2024-06-26 13:36:57', NULL, '72.875', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '', '', '', '', 0, 67.5469, 'available', NULL, 0),
(0x66373134393963326532656530663232, '2024-06-07-18-57-2024-06-07-18-12-0', 1, '06/07/2024', 0, 0, '', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 36.41, 145.62, 182.03, '2024-06-07 12:51:37', NULL, '110.2', '451 10th Ave, New York, NY 10018', '40.7557505,-73.9986545', '', '', '', '', 0, 182.025, 'available', NULL, 0),
(0x66396163333436613763363132366239, '2024-06-18-14-41-2024-06-18-14-08-f9ac346a7c6126b9', 1, '06/18/2024', 0, 0, '', '1325 6th Ave, New York, NY 10019', '40.7627644,-73.9808403', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+6822129617435', 14.69, 58.78, 73.47, '2024-06-18 11:08:47', NULL, '77.3', '451 10th Ave, New York, NY 10018', '40.7557505,-73.9986545', '', '', '', '', 0, 73.4688, 'available', NULL, 0),
(0x66653034386364346464316164356530, '2024-06-18-13-13-2024-06-18-12-54-fe048cd4dd1ad5e0', 0, '06/18/2024', 0, 0, '', '666 10th Ave, New York, NY 10036', '40.7625222,-73.9929956', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.51, 54.05, 67.56, '2024-06-18 09:54:17', NULL, '75.925', '555 W 57th St, New York, NY 10019', '40.7704561,-73.9903111', '', '', '', '', 0, 67.5625, 'available', NULL, 0);

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
(0x30353938616230396630323266323531, '2024-06-21-19-36-2024-06-21-19-20-0598ab09f022f251', 2, '06/21/2024', 0, 0, '', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 23.83, 95.34, 119.17, '2024-06-21 16:20:53', '0000-00-00 00:00:00', '15.27', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '43.325', '10.3', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 0, 119.171, 'available', '', 0, 's', '90 Minutes'),
(0x30386465303636303139316265313833, '2024-06-26-13-54-2024-06-26-13-39-08de0660191be183', 2, '06/26/2024', 0, 0, '', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.38, 53.51, 66.89, '2024-06-26 10:39:34', '0000-00-00 00:00:00', '6.70', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '30', '10.325', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 0, 66.8906, 'available', '', 0, 'f', '1 Hour'),
(0x37366336353235616435343065626663, '2024-06-26-16-54-2024-06-26-16-39-76c6525ad540ebfc', 2, '06/26/2024', 0, 0, '', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 16.12, 64.49, 80.61, '2024-06-26 13:39:27', '0000-00-00 00:00:00', '15.28', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '43.375', '10.325', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 0, 80.6125, 'available', '', 0, '2', '1 Hour'),
(0x37623831313032336237623738356666, '2024-06-26-13-52-2024-06-26-13-36-7b811023b7b785ff', 2, '06/26/2024', 0, 0, '', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.38, 53.51, 66.89, '2024-06-26 10:36:49', '0000-00-00 00:00:00', '6.70', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '30', '10.325', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 0, 66.8906, 'available', '', 0, 'f', '1 Hour'),
(0x38653162353030666430336263656133, '2024-06-26-13-46-2024-06-26-13-31-8e1b500fd03bcea3', 2, '06/26/2024', 0, 0, '', '1150 Broadway, New York, NY 10001 (230 Fifth Rooftop Bar)', '40.7442419,-73.9886085', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.38, 53.51, 66.89, '2024-06-26 10:31:22', '0000-00-00 00:00:00', '6.70', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '30', '10.325', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 0, 66.8906, 'available', '', 0, 'f', '1 Hour'),
(0x38666431303237353337653538313833, '2024-06-24-12-59-2024-06-24-12-17-8fd1027537e58183', 2, '06/24/2024', 0, 0, '', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 12.01, 48.03, 60.03, '2024-06-24 09:17:46', '0000-00-00 00:00:00', '16.45', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', '12.425', '37.175', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 0, 60.0312, 'available', '', 0, 'ad', '30 Minutes'),
(0x39613438343038336134303139633362, '2024-06-26-18-02-2024-06-26-17-38-9a484083a4019c3b', 2, '06/26/2024', 0, 0, '', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 11.98, 47.9, 59.88, '2024-06-26 14:38:45', '0000-00-00 00:00:00', '4.15', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '12.45', '19.2', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 0, 59.875, 'available', '', 0, 'as', '1 Hour'),
(0x63313838373338636661643266643037, '2024-06-24-11-31-2024-06-24-11-16-c188738cfad2fd07', 1, '06/24/2024', 0, 0, '', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 23.65, 94.6, 118.25, '2024-06-24 08:16:10', '0000-00-00 00:00:00', '15.57', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '43.325', '10.3', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 0, 118.247, 'available', '', 0, '52', '2 Hour'),
(0x63396435303538303334383634313737, '2024-06-26-17-58-2024-06-26-17-34-c9d5058034864177', 2, '06/26/2024', 0, 0, '', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 11.98, 47.9, 59.88, '2024-06-26 14:34:08', '0000-00-00 00:00:00', '4.15', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '12.45', '19.2', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 0, 59.875, 'available', '', 0, 'as', '1 Hour'),
(0x65386233666337343430626432353463, '2024-06-26-18-01-2024-06-26-17-36-e8b3fc7440bd254c', 2, '06/26/2024', 0, 0, '', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 11.98, 47.9, 59.88, '2024-06-26 14:36:51', '0000-00-00 00:00:00', '4.15', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', '12.45', '19.2', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 0, 59.875, 'available', '', 0, 'as', '1 Hour');

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
(0x30353665623065386461376331303333, '2024-06-26-12-50-2024-06-26-12-34-056eb0e8da7c1033', 2, '06/26/2024', 0, 0, '', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 16.2, 64.8, 81, '2024-06-26 09:34:44', '0000-00-00 00:00:00', '48.29', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '43.375', '10.325', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 50.995, 'available', '', 0),
(0x33616532653032636431643334633839, '2024-06-26-17-45-2024-06-26-17-30-3ae2e02cd1d34c89', 2, '06/26/2024', 0, 0, '', '45 E 45th St, New York, NY 10017', '40.7549394,-73.9772689', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 9.85, 39.4, 49.25, '2024-06-26 14:30:17', '0000-00-00 00:00:00', '9.17', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '19', '10.325', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 19.2455, 'available', '', 0),
(0x35653331383835633639353864353436, '2024-06-26-12-22-2024-06-26-12-06-5e31885c6958d546', 2, '06/26/2024', 0, 0, '', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 16.2, 64.8, 81, '2024-06-26 09:06:55', '0000-00-00 00:00:00', '48.29', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '43.375', '10.325', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 50.995, 'available', '', 0),
(0x36373033363832656136646161343536, '2024-06-24-12-54-2024-06-24-12-39-6703682ea6daa456', 2, '06/24/2024', 0, 0, '', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 16.2, 64.78, 80.98, '2024-06-24 09:39:20', '0000-00-00 00:00:00', '48.33', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '43.325', '10.3', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 50.9775, 'available', '', 0),
(0x36633037343837323636356634323934, '2024-06-24-12-37-2024-06-24-12-22-6c074872665f4294', 2, '06/24/2024', 0, 0, '', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 16.2, 64.78, 80.98, '2024-06-24 09:22:20', '0000-00-00 00:00:00', '48.33', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '43.325', '10.3', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 50.9775, 'available', '', 0),
(0x38333063323166303532313763363461, '2024-06-25-12-02-2024-06-25-11-24-830c21f05217c64a', 1, '06/25/2024', 0, 0, '', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 13.82, 55.29, 69.12, '2024-06-25 08:24:40', '0000-00-00 00:00:00', '33.08', '4 Charles St #3004, New York, NY 10014 (4 Charles Prime Rib)', '40.7351675,-74.0006537', '12.45', '32.7', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 39.115, 'available', '', 0),
(0x39363463306130626565346362663132, '2024-06-24-12-46-2024-06-24-12-30-964c0a0bee4cbf12', 2, '06/24/2024', 0, 0, '', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 16.2, 64.78, 80.98, '2024-06-24 09:30:59', '0000-00-00 00:00:00', '48.33', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '43.325', '10.3', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 50.9775, 'available', '', 0),
(0x39643565386136663964356361323430, '2024-06-26-12-19-2024-06-26-12-04-9d5e8a6f9d5ca240', 2, '06/26/2024', 0, 0, '', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 16.2, 64.8, 81, '2024-06-26 09:04:27', '0000-00-00 00:00:00', '48.29', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '43.375', '10.325', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 50.995, 'available', '', 0),
(0x62356534363665653866636334613135, '2024-06-25-12-20-2024-06-25-12-05-b5e466ee8fcc4a15', 2, '06/25/2024', 0, 0, '', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+342129617435', 15.19, 60.76, 75.95, '2024-06-25 09:05:36', '0000-00-00 00:00:00', '38.20', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '43.375', '10.325', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 45.95, 'available', '', 0),
(0x62373665303134306337386430653565, '2024-06-25-11-33-2024-06-25-11-17-b76e0140c78d0e5e', 2, '06/25/2024', 0, 0, '', '4 Charles St #3004, New York, NY 10014 (4 Charles Prime Rib)', '40.7351675,-74.0006537', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 14.7, 58.79, 73.49, '2024-06-25 08:17:42', '0000-00-00 00:00:00', '34.45', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '42.2', '10.325', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 43.4875, 'available', '', 0),
(0x63656461613532356438363565623136, '2024-06-25-19-09-2024-06-25-18-28-cedaa525d865eb16', 2, '06/25/2024', 0, 0, '', '35 Wall St, New York, NY 10038', '40.706577,-74.010141', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+412129617435', 21.67, 86.66, 108.33, '2024-06-25 15:28:17', '0000-00-00 00:00:00', '43.33', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', '76.875', '36.45', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 78.3275, 'available', '', 0),
(0x64613535386331383632626434376165, '2024-06-24-13-25-2024-06-24-12-43-da558c1862bd47ae', 2, '06/24/2024', 0, 0, '', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 15.07, 60.29, 75.36, '2024-06-24 09:43:06', '0000-00-00 00:00:00', '41.12', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', '12.425', '37.175', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 45.36, 'available', '', 0),
(0x65366662343336393838666366663935, '2024-06-25-12-19-2024-06-25-12-04-e6fb436988fcff95', 3, '06/25/2024', 0, 0, '', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+332129617435', 15.19, 60.76, 75.95, '2024-06-25 09:04:12', '0000-00-00 00:00:00', '38.20', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '43.375', '10.325', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 45.95, 'available', '', 0),
(0x65626264316564333463336237663462, '2024-06-24-12-52-2024-06-24-12-36-ebbd1ed34c3b7f4b', 2, '06/24/2024', 0, 0, '', '40a 10th Ave, New York, NY 10014', '40.741486,-74.008156', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 16.2, 64.78, 80.98, '2024-06-24 09:36:59', '0000-00-00 00:00:00', '48.33', '30 Rockefeller Plaza, New York, NY 10112', '40.7593755,-73.9799726', '43.325', '10.3', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 50.9775, 'available', '', 0),
(0x66646132313432373536623835616534, '2024-06-26-17-01-2024-06-26-16-41-fda2142756b85ae4', 2, '06/26/2024', 0, 0, '', '26 Federal Plaza, New York, NY 10278', '40.7153928,-74.0042441', 'CASH', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+12129617435', 21.25, 84.98, 106.23, '2024-06-26 13:41:09', '0000-00-00 00:00:00', '67.70', '425 Park Ave, New York, NY 10022', '40.7605182,-73.9712319', '69.2', '15.55', 'West Drive and West 59th Street New York, NY 10019', '40.7668483,-73.9790817', 30, 76.225, 'available', '', 0);

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
(1, 'ogulcan', '$2y$10$9YVrmzOac7hHBQDdfHibB.1VvmBs0kxCpCHazkcJEPIcQZIoIhpHy', 'Ogulcan', 'ÖZDOĞAN', 'ogulcanozdogan@gmail.com', '6562002544', 'driver'),
(6, 'ibrahima', '$2y$10$WgrsLWv3tQYuEyoYbuzmW.F4sDA9V35r8fe/dUjv1AWr4ZycyV1q2', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@gmail.com', '2129617435', 'admin');

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
-- Dumping data for table `users_temporary`
--

INSERT INTO `users_temporary` (`id`, `user`, `pass`, `name`, `surname`, `email`, `number`, `perm`) VALUES
(1, 'asd', '$2y$10$UPtq.aJcT4urWycuAF9ql.pw0iQUfb9omaOa16y4REqTmw8f95Tfe', 'asd', 'asdq', 'asd@asd.asd', '1231231231', 'driver'),
(5, 'asd', '$2y$10$oQrZKTSKbp1SPXCG0R10yuG4tlqBFWJVThpMOen81PJwmn.g4XrLW', 'asd', 'asd', 'asdad@asd.adf', '1321231231', 'driver');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users_temporary`
--
ALTER TABLE `users_temporary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
