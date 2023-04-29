-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2023 at 06:00 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookingsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `reservationid` int(11) NOT NULL,
  `datestart` date NOT NULL,
  `dateend` date NOT NULL,
  `roomid` int(11) DEFAULT NULL,
  `customers_id` int(11) DEFAULT NULL,
  `noofnights` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`reservationid`, `datestart`, `dateend`, `roomid`, `customers_id`, `noofnights`) VALUES
(251, '2023-04-27', '2023-04-28', 102, NULL, 1),
(252, '2023-04-20', '2023-04-22', 101, NULL, 2),
(253, '2023-05-10', '2023-05-25', 201, NULL, 15),
(254, '2023-06-13', '2023-06-16', 202, NULL, 3),
(255, '2023-06-01', '2023-06-06', 103, NULL, 5),
(256, '2023-06-11', '2023-06-14', 301, NULL, 3),
(257, '2023-05-22', '2023-05-30', 303, NULL, 8),
(258, '2023-06-19', '2023-06-21', 203, NULL, 3),
(259, '2023-04-22', '2023-04-30', 401, NULL, 8),
(260, '2023-07-03', '2023-07-11', 102, NULL, 8),
(261, '2023-07-07', '2023-04-09', 202, NULL, 2),
(262, '2023-07-28', '2023-07-29', 103, NULL, 1),
(263, '2023-08-14', '2023-08-18', 302, NULL, 4),
(264, '2023-06-27', '2023-06-29', 301, NULL, 2),
(265, '2023-06-19', '2023-06-24', 402, NULL, 5),
(266, '2023-09-04', '2023-09-07', 401, NULL, 3),
(267, '2023-07-15', '2023-07-19', 101, NULL, 4),
(268, '2023-07-24', '2023-07-27', 403, NULL, 3),
(269, '2023-05-13', '2023-05-21', 303, NULL, 8),
(270, '2023-04-23', '2023-04-25', 203, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `sname` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `fname`, `sname`, `email`, `address`, `phone`, `created_at`) VALUES
(1, 'Alice', 'Johnson', 'alice.johnson@example.com', '123 Main St, Anytown, USA', '(555) 555-4671', '2023-04-24 17:37:36'),
(2, 'Bob', 'Smith', 'bob.smith@example.com', '456 Elm St, Anycity, USA', '(555) 555-5678', '2023-04-24 17:37:36'),
(3, 'Claire', 'Taylor', 'claire.taylor@example.com', '789 Oak St, Anyvillage, USA', '(555) 555-9012', '2023-04-24 17:37:36'),
(4, 'David', 'Lee', 'david.lee@example.com', '321 Maple St, Anytown, USA', '(555) 555-3456', '2023-04-24 17:37:36'),
(5, 'Emma', 'Brown', 'emma.brown@example.com', '654 Pine St, Anycity, USA', '(555) 555-7890', '2023-04-24 17:37:36'),
(6, 'Frank', 'Baker', 'frank.baker@example.com', '987 Cedar St, Anyvillage, USA', '(555) 555-2345', '2023-04-24 17:37:36'),
(7, 'Grace', 'Garcia', 'grace.garcia@example.com', '438 Main St, Anytown, USA', '(555) 555-6789', '2023-04-24 17:37:36'),
(8, 'Henry', 'Davis', 'henry.davis@example.com', '782 Elm St, Anycity, USA', '(555) 555-0123', '2023-04-24 17:37:36'),
(9, 'Isabel', 'Hernandez', 'isabel.hernandez@example.com', '486 Oak St, Anyvillage, USA', '(555) 555-4567', '2023-04-24 17:37:36'),
(10, 'Jack', 'Martinez', 'jack.martinez@example.com', '182 Maple St, Anytown, USA', '(555) 555-8901', '2023-04-24 17:37:36'),
(11, 'Kelly', 'Rodriguez', 'helly.rodriguez@example.com', '186 Pine St, Anycity, USA', '(555) 555-6487', '2023-04-24 17:37:36'),
(12, 'Liam', 'Wilson', 'liam.wilson@example.com', '978 Cedar St, Anyvillage, USA', '(555) 555-9725', '2023-04-24 17:37:36'),
(13, 'Mia', 'Anderson', 'mia.anderson@example.com', '345 Main St, Anytown, USA', '(555) 555-4971', '2023-04-24 17:37:36'),
(14, 'Noah', 'Thomas', 'noah.thomas@example.com', '898 Elm St, Anycity, USA', '(555) 555-8731', '2023-04-24 17:37:36'),
(15, 'Olivia', 'Jackson', 'olivia.jackson@example.com', '119 Oak St, Anyvillage, USA', '(555) 555-3246', '2023-04-24 17:37:36'),
(16, 'Peter', 'White', 'peter.white@example.com', '422 Maple St, Anytown, USA', '(555) 555-4476', '2023-04-24 17:37:36'),
(17, 'Quinn', 'Harris', 'quinn.harris@example.com', '388 Pine St, Anycity, USA', '(555) 555-1124', '2023-04-24 17:37:36'),
(18, 'Rachel', 'Martin', 'rachel.martin@example.com', '779 Cedar St, Anyvillage, USA', '(555) 555-7997', '2023-04-24 17:37:36'),
(19, 'Sarah', 'Thompson', 'sarah.thompson@example.com', '166 Main St, Anytown, USA', '(555) 555-2997', '2023-04-24 17:37:36'),
(20, 'Tyler', 'Scott', 'tyler.scott@example.com', '499 Elm St, Anycity, USA', '(555) 555-1999', '2023-04-24 17:37:36'),
(28, 'aggelos', 'gaylord', 'yiannisgoku@hotmail.com', 'Glamorgan Court P33', '344562', '2023-04-28 00:06:53');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `hotelid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `fax` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`hotelid`, `name`, `address`, `telephone`, `email`, `fax`) VALUES
(1, 'Aurora Sands Resort & Spa California', '2385 Pepperwood Drive, Riverside, CA 92506', '(818) 555-0176', 'AuroraSandsCali@gmail.com', 7193),
(2, 'Aurora Sands Resort & Spa Cardiff', '17 Windsor Road, Penarth, Cardiff, CF64 1JD, UK', '029 2019 5432', 'AuroraSandCard@gmail.com', 8462),
(3, 'Aurora Sands Resort & Spa Nicosia', '13 Mnasiadou, Ayios Andreas, 1105 Nicosia, Cyprus', '+357 22 345678', 'AuroraSandNic@gmail.com', 2468);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `roomid` int(11) NOT NULL,
  `roomnumber` varchar(100) NOT NULL,
  `roomtype` varchar(200) NOT NULL,
  `roomprice` decimal(5,2) NOT NULL,
  `roomstatus` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`roomid`, `roomnumber`, `roomtype`, `roomprice`, `roomstatus`) VALUES
(101, 'G101', 'Single Room', 50.00, 'Available'),
(102, 'G102', 'Twin Room', 75.00, 'Unavailable'),
(103, 'G103', 'Deluxe Room', 100.00, 'Maintanance'),
(201, 'A201', 'Single Room', 150.00, 'Unavailable'),
(202, 'A202', 'Twin Room', 175.00, 'Available'),
(203, 'A203', 'Deluxe Room', 200.00, 'Unavailable'),
(301, 'B301', 'Single Room', 250.00, 'Maintanance'),
(302, 'B302', 'Twin Room', 275.00, 'Available'),
(303, 'B303', 'Deluxe Room', 300.00, 'Unavailable'),
(401, 'C401', 'Single Room', 350.00, 'Unavailable'),
(402, 'C402', 'Twin Room', 375.00, 'Maintanance'),
(403, 'C403', 'Deluxe Room', 400.00, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `roomprice`
--

CREATE TABLE `roomprice` (
  `roompriceid` int(12) NOT NULL,
  `roomid` int(11) NOT NULL,
  `roomprice` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roomprice`
--

INSERT INTO `roomprice` (`roompriceid`, `roomid`, `roomprice`) VALUES
(1, 101, 50.00),
(2, 102, 75.00),
(3, 103, 100.00),
(4, 201, 150.00),
(5, 202, 175.00),
(6, 203, 200.00),
(7, 301, 250.00),
(8, 302, 275.00),
(9, 303, 300.00),
(10, 401, 350.00),
(11, 402, 375.00),
(12, 403, 400.00);

-- --------------------------------------------------------

--
-- Table structure for table `roomstatus`
--

CREATE TABLE `roomstatus` (
  `roomstatusid` int(11) NOT NULL,
  `roomnumber` varchar(100) NOT NULL,
  `roomid` int(11) NOT NULL,
  `roomstatus` varchar(200) NOT NULL,
  `notes` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roomstatus`
--

INSERT INTO `roomstatus` (`roomstatusid`, `roomnumber`, `roomid`, `roomstatus`, `notes`) VALUES
(1, 'G101', 101, 'Available', ''),
(2, 'G102', 102, 'Unavailable', ''),
(3, 'G103', 103, 'Maintanance', 'Cleaning'),
(4, 'A201', 201, 'Unavailable', ''),
(5, 'A202', 202, 'Available', ''),
(6, 'A203', 203, 'Unavailable', ''),
(7, 'B301', 301, 'Maintanance', 'Cleaning'),
(8, 'B302', 302, 'Available', ''),
(9, 'B303', 303, 'Unavailable', ''),
(10, 'C401', 401, 'Unavailable', ''),
(11, 'C402', 402, 'Maintanance', 'Cleaning'),
(12, 'C403', 403, 'Available', '');

-- --------------------------------------------------------

--
-- Table structure for table `roomtype`
--

CREATE TABLE `roomtype` (
  `roomtypeid` int(11) NOT NULL,
  `roomtype` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roomtype`
--

INSERT INTO `roomtype` (`roomtypeid`, `roomtype`) VALUES
(1, 'Single Room'),
(2, 'Twin Room'),
(3, 'Deluxe Room');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`reservationid`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`hotelid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`roomid`);

--
-- Indexes for table `roomprice`
--
ALTER TABLE `roomprice`
  ADD PRIMARY KEY (`roompriceid`);

--
-- Indexes for table `roomstatus`
--
ALTER TABLE `roomstatus`
  ADD PRIMARY KEY (`roomstatusid`);

--
-- Indexes for table `roomtype`
--
ALTER TABLE `roomtype`
  ADD PRIMARY KEY (`roomtypeid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `reservationid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=274;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `hotelid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roomprice`
--
ALTER TABLE `roomprice`
  MODIFY `roompriceid` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `roomstatus`
--
ALTER TABLE `roomstatus`
  MODIFY `roomstatusid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `roomtype`
--
ALTER TABLE `roomtype`
  MODIFY `roomtypeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
