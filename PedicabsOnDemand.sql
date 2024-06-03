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
(31, '2024-05-14-19-2024-05-14-19', 1, '', 0, 0, '', 'Metropolitan Museum of Art, 5th Avenue, New York, NY, USA', '40.7794366,-73.963244', 'cash', 'a', 'd', 'shavens88@gmail.com', '+1 6841231231231', 23.44, 93.76, 117.2, '2024-05-16 11:19:16', NULL, '84.95', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 117.2, 'available', NULL, 0),
(32, '2024-05-14-59-2024-05-14-44-32', 1, '05/16/2024', 0, 0, '', 'Metropolitan Museum of Art, 5th Avenue, New York, NY, USA', '40.7794366,-73.963244', 'cash', 'a', 'd', 'ogulcanozdogan@gmail.com', '+16562002544', 23.44, 93.76, 117.2, '2024-05-16 18:26:48', '2024-05-16 21:05:01', '84.95', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 117.2, 'past', 'ibrahim', 1),
(33, '2024-05-15-08-2024-05-14-51-33', 1, '05/16/2024', 0, 0, '', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'cash', 'ogulcan', 'ogulcan', 'ibrahimdonmez1983@gmail.com', '+16562002544', 17.63, 70.52, 88.15, '2024-05-16 11:51:41', NULL, '66.575', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 88.15, 'available', NULL, 0),
(34, '2024-05-16-15-13-2024-05-16-14-56-34', 1, '05/16/2024', 0, 0, '', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'cash', 'ogulcan', 'ogulcan', 'ibrahimdonmez1983@gmail.com', '+16562002544', 17.63, 70.52, 88.15, '2024-05-16 11:56:56', NULL, '66.575', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 88.15, 'available', NULL, 0),
(35, '2024-05-16-15-16-2024-05-16-14-59-35', 1, '05/16/2024', 0, 0, '', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'cash', 'ogulcan', 'ogulcan', 'ibrahimdonmez1983@gmail.com', '+16562002544', 17.63, 70.52, 88.15, '2024-05-16 11:59:56', NULL, '66.575', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 88.15, 'available', NULL, 0),
(36, '2024-05-16-15-19-2024-05-16-15-02-36', 1, '05/16/2024', 0, 0, '', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'cash', 'ogulcan', 'ogulcan', 'ibrahimdonmez1983@gmail.com', '+16562002544', 17.63, 70.52, 88.15, '2024-05-16 12:02:12', NULL, '66.575', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 88.15, 'available', NULL, 0),
(37, '2024-05-16-16-49-2024-05-16-16-32-37', 1, '05/16/2024', 0, 0, '', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'cash', 'ogulcan', 'ogulcan', 'ibrahimdonmez1983@gmail.com', '+16562002544', 17.63, 70.52, 88.15, '2024-05-16 13:32:50', NULL, '66.575', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 88.15, 'available', NULL, 0),
(38, '2024-05-16-16-47-2024-05-16-16-34-38', 1, '05/16/2024', 0, 0, '', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'cash', 'ogulcan', 'ogulcan', 'ibrahimdonmez1983@gmail.com', '+16562002544', 17.63, 70.52, 88.15, '2024-05-16 13:34:37', NULL, '66.575', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 88.15, 'available', NULL, 0),
(39, '2024-05-16-16-56-2024-05-16-16-41-39', 1, '05/16/2024', 0, 0, '', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'cash', 'ogulcan', 'ogulcan', 'ibrahimdonmez1983@gmail.com', '+16562002544', 17.63, 70.52, 88.15, '2024-05-16 13:41:34', NULL, '66.575', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 88.15, 'available', NULL, 0),
(40, '2024-05-16-16-52-2024-05-16-16-42-40', 1, '05/16/2024', 0, 0, '', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'cash', 'ogulcan', 'ogulcan', 'ibrahimdonmez1983@gmail.com', '+16562002544', 17.63, 70.52, 88.15, '2024-05-16 13:42:20', NULL, '66.575', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 88.15, 'available', NULL, 0),
(41, '2024-05-16-17-03-2024-05-16-16-46-41', 1, '05/16/2024', 0, 0, '', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'cash', 'ogulcan', 'ogulcan', 'ibrahimdonmez1983@gmail.com', '+16562002544', 17.63, 70.52, 88.15, '2024-05-16 13:46:28', NULL, '66.575', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 88.15, 'available', NULL, 0),
(42, '2024-05-16-17-04-2024-05-16-16-47-42', 1, '05/16/2024', 0, 0, '', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'cash', 'ogulcan', 'ogulcan', 'ibrahimdonmez1983@gmail.com', '+16562002544', 17.63, 70.52, 88.15, '2024-05-16 13:47:30', NULL, '66.575', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 88.15, 'available', NULL, 0),
(43, '2024-05-16-17-10-2024-05-16-16-53-43', 1, '05/16/2024', 0, 0, '', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'cash', 'ogulcan', 'ogulcan', 'ibrahimdonmez1983@gmail.com', '+16562002544', 17.63, 70.52, 88.15, '2024-05-16 13:53:19', NULL, '66.575', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 88.15, 'available', NULL, 0),
(44, '2024-05-16-17-11-2024-05-16-16-54-44', 1, '05/16/2024', 0, 0, '', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'cash', 'ogulcan', 'ogulcan', 'ibrahimdonmez1983@gmail.com', '+16562002544', 17.63, 70.52, 88.15, '2024-05-16 13:54:30', NULL, '66.575', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 88.15, 'available', NULL, 0),
(45, '2024-05-16-17-12-2024-05-16-16-55-45', 1, '05/16/2024', 0, 0, '', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'cash', 'ogulcan', 'ogulcan', 'ibrahimdonmez1983@gmail.com', '+16562002544', 17.63, 70.52, 88.15, '2024-05-16 13:55:02', NULL, '66.575', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 88.15, 'available', NULL, 0),
(46, '2024-05-16-17-13-2024-05-16-16-56-46', 1, '05/16/2024', 0, 0, '', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'cash', 'ogulcan', 'ogulcan', 'ibrahimdonmez1983@gmail.com', '+16562002544', 17.63, 70.52, 88.15, '2024-05-16 13:56:31', NULL, '66.575', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 88.15, 'available', NULL, 0),
(47, '2024-05-16-17-14-2024-05-16-16-57-47', 1, '05/16/2024', 0, 0, '', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'cash', 'ogulcan', 'ogulcan', 'ibrahimdonmez1983@gmail.com', '+16562002544', 17.63, 70.52, 88.15, '2024-05-16 13:58:00', NULL, '66.575', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 88.15, 'available', NULL, 0),
(48, '2024-05-16-17-15-2024-05-16-16-58-48', 1, '05/16/2024', 0, 0, '', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'cash', 'ogulcan', 'ogulcan', 'ibrahimdonmez1983@gmail.com', '+16562002544', 17.63, 70.52, 88.15, '2024-05-16 13:58:34', NULL, '66.575', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 88.15, 'available', NULL, 0),
(49, '2024-05-16-17-16-2024-05-16-16-59-49', 1, '05/16/2024', 0, 0, '', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'cash', 'ogulcan', 'ogulcan', 'ibrahimdonmez1983@gmail.com', '+16562002544', 17.63, 70.52, 88.15, '2024-05-16 13:59:44', NULL, '66.575', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 88.15, 'available', NULL, 0),
(50, '2024-05-16-17-17-2024-05-16-17-00-50', 1, '05/16/2024', 0, 0, '', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', 'cash', 'ogulcan', 'ogulcan', 'ibrahimdonmez1983@gmail.com', '+16562002544', 17.63, 70.52, 88.15, '2024-05-16 14:00:06', '2024-05-16 18:35:22', '66.575', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 88.15, 'past', 'ibrahim', 1),
(51, '2024-05-31-12-34-2024-05-31-12-16-51', 1, '05/31/2024', 0, 0, '', '45 Rockefeller Plaza, New York, NY, USA', '40.7591523,-73.9777136', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+11231231231', 18.74, 74.94, 93.68, '2024-05-31 09:16:10', NULL, '68.325', '30 Rockefeller Plaza, Rockefeller Plaza, New York, NY, USA', '40.7593755,-73.9799726', '', '', '', '', 0, 93.675, 'available', NULL, 0),
(52, '2024-05-31-12-35-2024-05-31-12-17-52', 1, '05/31/2024', 0, 0, '', '45 Rockefeller Plaza, New York, NY, USA', '40.7591523,-73.9777136', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+11231231231', 18.74, 74.94, 93.68, '2024-05-31 09:17:46', NULL, '68.325', '30 Rockefeller Plaza, Rockefeller Plaza, New York, NY, USA', '40.7593755,-73.9799726', '', '', '', '', 0, 93.675, 'available', NULL, 0),
(53, '2024-05-31-17-48-2024-05-31-17-31-53', 1, '05/31/2024', 0, 0, '', '30 Rockefeller Plaza, Rockefeller Plaza, New York, NY, USA', '40.7593755,-73.9799726', 'card', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+13434343434', 19.59, 86.2, 105.79, '2024-05-31 14:31:21', NULL, '72.925', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 97.95, 'available', NULL, 0),
(54, '2024-05-31-17-50-2024-05-31-17-33-54', 1, '05/31/2024', 0, 0, '', '30 Rockefeller Plaza, Rockefeller Plaza, New York, NY, USA', '40.7593755,-73.9799726', 'card', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+13434343434', 19.59, 86.2, 105.79, '2024-05-31 14:33:39', NULL, '72.925', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 97.95, 'available', NULL, 0),
(55, '2024-05-31-17-51-2024-05-31-17-34-55', 1, '05/31/2024', 0, 0, '', '30 Rockefeller Plaza, Rockefeller Plaza, New York, NY, USA', '40.7593755,-73.9799726', 'card', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+13434343434', 19.59, 86.2, 105.79, '2024-05-31 14:34:22', NULL, '72.925', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 97.95, 'available', NULL, 0),
(56, '2024-05-31-17-51-2024-05-31-17-34-56', 1, '05/31/2024', 0, 0, '', '30 Rockefeller Plaza, Rockefeller Plaza, New York, NY, USA', '40.7593755,-73.9799726', 'card', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@yahoo.com', '+16562002544', 19.59, 86.2, 105.79, '2024-05-31 14:34:52', '2024-05-31 18:05:01', '72.925', 'Rockefeller Center, Rockefeller Plaza, New York, NY, USA', '40.7587402,-73.9786736', '', '', '', '', 0, 97.95, 'past', 'ogulcan', 1),
(57, '2024-06-03-12-09-2024-06-03-11-49-57', 1, '06/03/2024', 0, 0, '', '30 Rockefeller Plaza, Rockefeller Plaza, New York, NY, USA', '40.7593755,-73.9799726', 'cash', 'IBRAHIM', 'DONMEZ', 'ibrahimdonmez1983@gmail.com', '+16562002544', 18.74, 74.94, 93.68, '2024-06-03 08:49:08', NULL, '65.35', '45 Rockefeller Plaza, New York, NY, USA', '40.7591523,-73.9777136', '', '', '', '', 0, 93.675, 'available', NULL, 0);

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
  `sms_sent` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
(1, 'ogulcan', '$2y$10$9YVrmzOac7hHBQDdfHibB.1VvmBs0kxCpCHazkcJEPIcQZIoIhpHy', 'Ogulcan', 'ÖZDOĞAN', '', '6562002544', 'driver'),
(6, 'ibrahim', '$2y$10$WgrsLWv3tQYuEyoYbuzmW.F4sDA9V35r8fe/dUjv1AWr4ZycyV1q2', 'Ibrahim', 'Donmez', '', '2129617435', 'admin'),
(11, 'deneme', '$2y$10$p5B0Fr8rKLjrB4U3lJWdx.P9C5l4wDr4r4TvAJeq.zHCnaD9oVv4a', 'deneme', 'deneme', 'deneme1@deneme1.com', '3123134123', 'driver');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `hourly`
--
ALTER TABLE `hourly`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pointatob`
--
ALTER TABLE `pointatob`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
