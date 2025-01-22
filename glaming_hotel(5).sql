-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2025 at 01:07 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `glaming_hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `booking_number` text NOT NULL,
  `booking_checkin_date` date NOT NULL,
  `booking_checkout_date` date NOT NULL,
  `booking_amt` decimal(10,0) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `booking_number`, `booking_checkin_date`, `booking_checkout_date`, `booking_amt`, `client_id`) VALUES
(1, 'CSC264', '2024-06-20', '2024-06-23', 35, 1),
(5, 'MRE112', '2024-06-20', '2024-06-21', 0, 1),
(7, 'UED102', '2024-06-12', '2024-06-14', 300, 19),
(8, 'LSC100', '2024-06-22', '2024-06-23', 720, 21),
(14, 'KXA432', '2024-06-14', '2024-06-15', 220, 21),
(17, 'OLK874', '2024-06-25', '2024-06-28', 96, 26),
(18, 'OJH740', '2024-07-06', '2024-07-07', 240, 27),
(19, 'DXV828', '2024-06-24', '2024-06-25', 240, 21),
(24, 'CZW610', '2024-07-03', '2024-07-06', 720, 28),
(32, 'QYW739', '2024-06-14', '2024-06-15', 220, 25),
(33, 'JNO295', '2024-06-21', '2024-06-27', 1056, 1),
(34, 'NVA507', '2024-06-14', '2024-06-15', 220, 28),
(35, 'DXP568', '2024-06-14', '2024-06-15', 220, 30),
(36, 'DOZ158', '2024-06-14', '2024-06-15', 190, 1),
(39, 'OYG450', '2024-06-14', '2024-06-17', 720, 1),
(40, 'BRF902', '2024-06-20', '2024-06-23', 720, 1),
(41, 'XRO601', '0000-00-00', '0000-00-00', 176, 1),
(42, 'QIX384', '2024-06-21', '2024-06-25', 608, 1),
(43, 'NSB566', '2024-06-14', '2024-06-17', 120, 1),
(44, 'HKW796', '2024-06-14', '2024-06-15', 300, 1),
(45, 'FZD794', '2024-06-14', '2024-06-15', 220, 1),
(46, 'ELW842', '2024-06-27', '2024-06-29', 308, 21),
(47, 'FRO120', '2025-01-09', '2025-01-11', 64, 31);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `client_username` text NOT NULL,
  `client_password` text NOT NULL,
  `client_name` text NOT NULL,
  `client_phone` text NOT NULL,
  `membership_tier` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `client_username`, `client_password`, `client_name`, `client_phone`, `membership_tier`) VALUES
(1, 'hazrel', '123', 'hazrel idlan', '1234567890', 'platinum'),
(19, 'googlymoogly21', 'p@ssw0rd', 'Google bin', '123456789', NULL),
(21, 'cikongsejuk', 'cikongpanas', 'cik kong', '0246810', 'silver'),
(25, 'test', 'test', 'test', '1234', NULL),
(26, 'maklimah', 'rotijala', 'makcik limah', '01444444444', NULL),
(27, 'encem', 'comel', 'aizad', '123456778', NULL),
(28, 'johan', 'joh@n', 'johan raja lawak', '13575', NULL),
(29, 'KERANG', '1234', 'Muhd Aizad', '01170201191', NULL),
(30, 'diniha', 'Diha', 'diniha', '0197352693', NULL),
(31, 'tester', '123', 'tester', '01test', 'platinum');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `hotel_id` int(11) NOT NULL,
  `hotel_name` text NOT NULL,
  `hotel_location` text NOT NULL,
  `hotel_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`hotel_id`, `hotel_name`, `hotel_location`, `hotel_desc`) VALUES
(1, 'Glaming Selangor', 'Selangor', 'First branch that completed in 2018 and start the operation in the same years. This was the smallest branch. This branch used theme of glamping on campsite. this branch have its own outdoor firepit place and restaurant. and its offer outdoor activities like zipline, paintball, wall climbing and obstacle course.\r\n'),
(2, 'Glaming Pahang', 'Pahang', 'Second branch that completed in 2022 and start the operation in the same years. This branch used theme of glamping on mountain due to the location of this hotel was built which is on the hill side. this branch famous with the glamping tent that have a clear roof for star gazing and sunset, sunrise. Its also offer hiking activities and paragliding.\r\n\r\n'),
(3, 'Grand Glaming', 'Johor', 'Third branch that completed in 2023 and start the operation in the same years. This branch used theme of glamping on forest due to the location inside the jungle and beside the flowing river. this branch was surrounded by very beautiful flora and fauna. its offer outdoor activities such as jungle trekking, fishing, and atv or buggy riding through the path inside the jungle.\r\n'),
(4, 'Penang Glaming Resort', 'Pulau Pinang', 'Fourth branch that completed in 2024 and start the operation in the same years. This was the biggest branch. This branch used theme of glamping on beach due to the location of this hotel was built which is on beach with white sand. this branch have its own outdoor firepit place, restaurant, and gym. this branch famous with the its own sunrise and sunset activities and its offer outdoor activities such as water confident, scuba diving, jet ski, banana boat, water rafting and parasailing.');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_room`
--

CREATE TABLE `hotel_room` (
  `hotelroom_id` int(11) NOT NULL,
  `hotelroom_number` text NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel_room`
--

INSERT INTO `hotel_room` (`hotelroom_id`, `hotelroom_number`, `hotel_id`, `room_id`, `booking_id`) VALUES
(1, 'PH101', 2, 3, NULL),
(2, 'PH102', 2, 3, 47),
(3, 'PP201', 4, 2, NULL),
(4, 'JH302', 3, 1, 45),
(5, 'JH102', 3, 4, 44),
(6, 'PP212', 4, 1, NULL),
(7, 'SG011', 1, 3, NULL),
(8, 'SG012', 1, 3, 43),
(9, 'PP108', 4, 4, NULL),
(10, 'PH215', 2, 4, NULL),
(18, 'JH301', 3, 1, 46),
(19, 'SG316', 1, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `room_type` varchar(50) NOT NULL,
  `room_desc` text NOT NULL,
  `room_pax` int(11) NOT NULL,
  `room_price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_type`, `room_desc`, `room_pax`, `room_price`) VALUES
(1, 'King Suite', 'This room have 1 king bed with built in toilet. this room equipped with air conditioned, kettle, small stove, small fridge and a TV with gaming console. This room can fit 1-4 pax in one time. This room also have their own outdoor dining table and chair.', 4, 220),
(2, 'Queen Suite', 'This room have 1 queen bed with built in toilet. This room equipped with air conditioned, kettle, small stove, small fridge and a TV with gaming console. This room can fit 1-3 pax in one time.\r\n', 3, 190),
(3, 'Single', 'This room have 4 single bed. This room equipped with air conditioned. This room can fit 1-4 pax in one time. Shared bathroom. Shared outdoor kitchen.', 1, 40),
(4, 'Family Room', 'This room have 2 queen bed with toilet beside the tent. This room equipped with air conditioned, kettle, small stove, small fridge, family couch and TV with gaming console. This room can fit 1-6 pax in one time. This type of room is also have their own outdoor dining table and chair. This room is surrounded by wood gate for more privacy.', 6, 300);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `fk_client` (`client_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`),
  ADD UNIQUE KEY `client_username` (`client_username`) USING HASH;

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`hotel_id`);

--
-- Indexes for table `hotel_room`
--
ALTER TABLE `hotel_room`
  ADD PRIMARY KEY (`hotelroom_id`),
  ADD KEY `fk_hotel` (`hotel_id`),
  ADD KEY `fk_room` (`room_id`),
  ADD KEY `fk_booking` (`booking_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `hotel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `hotel_room`
--
ALTER TABLE `hotel_room`
  MODIFY `hotelroom_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`);

--
-- Constraints for table `hotel_room`
--
ALTER TABLE `hotel_room`
  ADD CONSTRAINT `fk_booking` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`booking_id`),
  ADD CONSTRAINT `fk_hotel` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`hotel_id`),
  ADD CONSTRAINT `fk_room` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
