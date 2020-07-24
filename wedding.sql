-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2020 at 04:26 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wedding`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookId` int(128) NOT NULL,
  `bookDate` datetime NOT NULL,
  `proId` int(128) NOT NULL,
  `payId` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bookId`, `bookDate`, `proId`, `payId`) VALUES
(2, '2020-12-01 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cusId` int(128) NOT NULL,
  `cusName` varchar(128) NOT NULL,
  `cusPhone` int(12) NOT NULL,
  `cusAdd` varchar(200) NOT NULL,
  `bookId` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cusId`, `cusName`, `cusPhone`, `cusAdd`, `bookId`) VALUES
(2, 'zayn malik', 133743333, 'selangor', 1),
(3, 'khai bahara', 133749000, 'selangor', 2);

-- --------------------------------------------------------

--
-- Table structure for table `cus_staff`
--

CREATE TABLE `cus_staff` (
  `cus_staffId` int(128) NOT NULL,
  `staffId` int(128) NOT NULL,
  `cusId` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `designer`
--

CREATE TABLE `designer` (
  `desId` int(128) NOT NULL,
  `desName` varchar(200) NOT NULL,
  `desPhone` int(12) NOT NULL,
  `desAdd` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `designer`
--

INSERT INTO `designer` (`desId`, `desName`, `desPhone`, `desAdd`) VALUES
(1, 'taylor lartner', 123456782, 'johor'),
(2, 'rizalman', 156788888, 'johor'),
(3, 'taylor swiftt', 156322222, 'selangor');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payId` int(128) NOT NULL,
  `payStatus` varchar(200) NOT NULL,
  `payDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payId`, `payStatus`, `payDate`) VALUES
(1, 'done', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `proId` int(128) NOT NULL,
  `proName` varchar(200) NOT NULL,
  `proPrice` int(11) NOT NULL,
  `desId` int(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`proId`, `proName`, `proPrice`, `desId`) VALUES
(1, 'Mendung Selalu', 500, 1),
(3, 'Awan', 700, 1),
(4, 'Morining glory', 900, 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffId` int(128) NOT NULL,
  `staffPass` varchar(256) NOT NULL,
  `staffName` varchar(200) NOT NULL,
  `staffAdd` varchar(200) NOT NULL,
  `staffPhone` int(12) NOT NULL,
  `isActive` int(1) DEFAULT NULL,
  `roleId` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffId`, `staffPass`, `staffName`, `staffAdd`, `staffPhone`, `isActive`, `roleId`) VALUES
(1000, '$2y$10$59QW7XrkEBYLyvY3jdZMX.e5N2kYGim4FDhFgA8LKzU91kNxHkXW.', 'bossku', 'bossanda', 177777070, 1, 2),
(1001, '$2y$10$Y8GJj2y4pNXFYBf2fJXRC.oLq3RyNnEColo1N9CC6opzXEmHJBueu', 'nurin aina', 'no 8 jalan kalabakan 24000 kuala lumpur', 135676545, 1, 1),
(1002, '$2y$10$VvLqq/fWyusVg.lr5HM6G.8SonUR.p/VWT347rSCC6fN8.PVJQsH6', 'nur izzati', 'no 10 jalan kilau 23900 cyberjaya', 189887862, 1, 1),
(1003, '$2y$10$r9ylwznYWBIq57GBkp9ig.b9CX73HpIA07h.2hc7c3HRAlM0/fsxu', 'dia', 'tepi kamu', 199782633, 1, 1),
(1004, '$2y$10$9hNQX673uz7JnadzTHq2W.nfiLw0PXu7pM9W8PgLZgZYzu3njobTa', 'awak', 'dalam hati', 125567655, 1, 1),
(1010, '$2y$10$fCruijv3PdotpXNJCR/RAuD91diPwtCOmuXm54.i9XZR3PF.lD/P6', 'dahdah', 'heh', 1234556789, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `staffrole`
--

CREATE TABLE `staffrole` (
  `id` int(1) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staffrole`
--

INSERT INTO `staffrole` (`id`, `role`) VALUES
(1, 'staff'),
(2, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookId`),
  ADD UNIQUE KEY `proId` (`proId`,`payId`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cusId`),
  ADD UNIQUE KEY `bookingId` (`bookId`);

--
-- Indexes for table `cus_staff`
--
ALTER TABLE `cus_staff`
  ADD PRIMARY KEY (`cus_staffId`),
  ADD UNIQUE KEY `staffId` (`staffId`,`cusId`);

--
-- Indexes for table `designer`
--
ALTER TABLE `designer`
  ADD PRIMARY KEY (`desId`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`proId`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffId`);

--
-- Indexes for table `staffrole`
--
ALTER TABLE `staffrole`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bookId` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cusId` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `designer`
--
ALTER TABLE `designer`
  MODIFY `desId` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payId` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `proId` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffId` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1011;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
