-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2024 at 01:36 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carwash`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `role` varchar(250) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `fullname`, `role`, `image`) VALUES
(1, 'admin@gmail.com', 'admin', 'Admin Admin', 'Admin', 'adminprofile.png');

-- --------------------------------------------------------

--
-- Table structure for table `announce`
--

CREATE TABLE `announce` (
  `id` int(11) NOT NULL,
  `datetimes` varchar(250) NOT NULL,
  `details` text NOT NULL,
  `subject` varchar(250) NOT NULL,
  `untilwhen` varchar(250) NOT NULL,
  `carwash` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announce`
--

INSERT INTO `announce` (`id`, `datetimes`, `details`, `subject`, `untilwhen`, `carwash`) VALUES
(1, '2024-10-17', 'sample lang ito', 'News', '2024-10-17', '1');

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

CREATE TABLE `block` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `block` varchar(250) NOT NULL,
  `car` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `block`
--

INSERT INTO `block` (`id`, `name`, `block`, `car`) VALUES
(2, '1', 'y', '2');

-- --------------------------------------------------------

--
-- Table structure for table `carrate`
--

CREATE TABLE `carrate` (
  `id` int(11) NOT NULL,
  `car` varchar(250) NOT NULL,
  `rate` varchar(250) NOT NULL,
  `datee` varchar(250) NOT NULL,
  `customer` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carrate`
--

INSERT INTO `carrate` (`id`, `car`, `rate`, `datee`, `customer`) VALUES
(1, '1', '5', '2024-10-17', '1'),
(2, '1', '5', '2024-10-17', '1');

-- --------------------------------------------------------

--
-- Table structure for table `carwash`
--

CREATE TABLE `carwash` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `wash_name` varchar(250) NOT NULL,
  `role` varchar(250) NOT NULL,
  `owner` varchar(250) NOT NULL,
  `location` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `image` text NOT NULL,
  `suspended` varchar(250) NOT NULL,
  `created` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carwash`
--

INSERT INTO `carwash` (`id`, `username`, `password`, `fullname`, `wash_name`, `role`, `owner`, `location`, `status`, `image`, `suspended`, `created`) VALUES
(1, 'carwash1@gmail.com', 'carwash1', 'carwash1', 'Lian Car Wash', 'Car', 'Lourent', '14.037032475548889, 120.65267277654472', 'Accepted', 'IMG-6713ce79212bf3.77760334.png', '', ''),
(2, 'carwash2@gmail.com', 'carwash2', 'carwash2', 'Nasugbu Car Wash', 'Car', 'Sourent', '14.072585268549238, 120.63206538116192', 'Accepted', 'adminprofile.png', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `carwashnotif`
--

CREATE TABLE `carwashnotif` (
  `id` int(11) NOT NULL,
  `details` text NOT NULL,
  `date` varchar(250) NOT NULL,
  `carwash` varchar(250) NOT NULL,
  `readd` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carwash_notif`
--

CREATE TABLE `carwash_notif` (
  `id` int(11) NOT NULL,
  `car` varchar(250) NOT NULL,
  `date` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `readd` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carwash_notif`
--

INSERT INTO `carwash_notif` (`id`, `car`, `date`, `message`, `readd`) VALUES
(3, '1', '2024-08-22 21:58:30', 'Your carwash is now suspended Please contact the admin to fix the Problem. Thankyou!', 'y'),
(4, '1', '2024-09-22 22:16:02', 'You may now resume your carwash services. Thank you!', 'y'),
(5, '1', '2024-09-22 22:16:09', 'Your carwash is now suspended Please contact the admin to fix the Problem. Thankyou!', 'y'),
(6, '1', '2024-09-22 22:16:12', 'You may now resume your carwash services. Thank you!', 'y'),
(7, '1', '2024-09-22 22:36:01', 'Your carwash is now suspended Please contact the admin to fix the Problem. Thankyou!', 'y'),
(8, '2', '2024-09-22 23:21:31', 'You may now serve services to your future customer. Welcome to CleanConnect!', ''),
(9, '2', '2024-09-22 23:22:09', 'You may now serve services to your future customer. Welcome to CleanConnect!', ''),
(10, '2', '2024-09-22 23:22:29', 'You may now serve services to your future customer. Welcome to CleanConnect!', ''),
(11, '1', '2024-09-22 23:28:08', 'You may now resume your carwash services. Thank you!', 'y'),
(14, '1', '2024-10-17 21:52:19', 'Customer Cancel their request', 'y'),
(15, '1', '2024-10-17 21:54:45', 'Customer Cancel their request', 'y'),
(16, '1', '2024-10-17 22:18:03', 'Customer Cancel their request', 'y'),
(17, '1', '2024-10-17 22:23:39', 'Customer Cancel their request', 'y'),
(18, '1', '2024-10-17 22:24:24', 'Customer Cancel their request', 'y'),
(19, '1', '2024-10-17 22:57:58', 'Customer Cancel their request', 'y'),
(20, '1', '2024-10-18 13:49:49', 'Customer Cancel their request', 'y'),
(21, '1', '2024-10-18 13:53:03', 'Customer Cancel their request', 'y'),
(22, '1', '2024-10-18 13:55:45', 'Customer Cancel their request', 'y'),
(23, '1', '2024-10-18 14:27:45', 'Customer Cancel their request', 'y'),
(24, '1', '2024-10-18 14:27:58', 'Customer Cancel their request', 'y');

-- --------------------------------------------------------

--
-- Table structure for table `car_reports`
--

CREATE TABLE `car_reports` (
  `id` int(11) NOT NULL,
  `service` varchar(250) NOT NULL,
  `startdate` varchar(250) NOT NULL,
  `enddate` varchar(250) NOT NULL,
  `car` varchar(250) NOT NULL,
  `createdate` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_reports`
--

INSERT INTO `car_reports` (`id`, `service`, `startdate`, `enddate`, `car`, `createdate`) VALUES
(11, '6,7,4', '2024-10-17', '2024-10-27', '1', '2024-10-27'),
(12, '6', '2024-10-17', '2024-10-27', '1', '2024-10-27'),
(13, '7', '2024-10-17', '2024-10-27', '1', '2024-10-27');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `fullname` varchar(250) NOT NULL,
  `role` varchar(250) NOT NULL,
  `contact` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `username`, `password`, `fullname`, `role`, `contact`, `gender`, `status`, `image`) VALUES
(1, 'custo1@gmail.com', 'custo1', 'custo1', 'Customer', '09123456789', 'M', 'Accepted', 'adminprofile.png'),
(3, 'custo2@gmail.com', 'custo2', 'custo2', 'Customer', '09123456789', 'M', 'Accepted', 'adminprofile.png');

-- --------------------------------------------------------

--
-- Table structure for table `custonotif`
--

CREATE TABLE `custonotif` (
  `id` int(11) NOT NULL,
  `date` varchar(250) NOT NULL,
  `details` varchar(250) NOT NULL,
  `custo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `custonotif`
--

INSERT INTO `custonotif` (`id`, `date`, `details`, `custo`) VALUES
(3, '2024-10-19 15:34:45', 'Carwash confirm your cancelation.', '1'),
(4, '2024-10-19 15:36:13', 'Carwash confirm your cancelation.', '1'),
(5, '2024-10-19 15:47:37', 'Carwash rejected your request please try again another time. Thank you!', ''),
(6, '2024-10-19 23:27:38', 'Congrats carwash Accepted your request', ''),
(7, '2024-10-23 23:21:51', 'Your request are now completed', '');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `customer` varchar(250) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `details` text NOT NULL,
  `car` varchar(250) NOT NULL,
  `datetimes` varchar(250) NOT NULL,
  `canceltime` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `service` varchar(250) NOT NULL,
  `total` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `customer` varchar(250) NOT NULL,
  `sent_request` varchar(250) NOT NULL,
  `target_date` date NOT NULL,
  `target_time` varchar(200) NOT NULL,
  `carwash` varchar(250) NOT NULL,
  `cancelationtime` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `service`, `total`, `status`, `customer`, `sent_request`, `target_date`, `target_time`, `carwash`, `cancelationtime`) VALUES
(6, '4', '2345.00', 'completed', '1', '2024-10-17 22:17:23', '2024-10-17', '09:00', '1', ''),
(7, '6,7,4', '2445.00', 'completed', '1', '2024-10-17 22:58:48', '2024-10-17', '09:00', '1', ''),
(8, '6,7,4', '2445.00', 'Rejected', '1', '2024-10-17 22:58:48', '2024-10-17', '09:00', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `carwash` varchar(250) NOT NULL,
  `services` varchar(250) NOT NULL,
  `price` varchar(250) NOT NULL,
  `for_vehicle` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `carwash`, `services`, `price`, `for_vehicle`) VALUES
(4, '1', 'Linis', '2345', 'Motor'),
(6, '1', 'Change Oil', '2345', 'Car'),
(7, '1', 'Palit gulong', '100', 'Car');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announce`
--
ALTER TABLE `announce`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carrate`
--
ALTER TABLE `carrate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carwash`
--
ALTER TABLE `carwash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carwashnotif`
--
ALTER TABLE `carwashnotif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carwash_notif`
--
ALTER TABLE `carwash_notif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_reports`
--
ALTER TABLE `car_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custonotif`
--
ALTER TABLE `custonotif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `announce`
--
ALTER TABLE `announce`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `block`
--
ALTER TABLE `block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `carrate`
--
ALTER TABLE `carrate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `carwash`
--
ALTER TABLE `carwash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `carwashnotif`
--
ALTER TABLE `carwashnotif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carwash_notif`
--
ALTER TABLE `carwash_notif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `car_reports`
--
ALTER TABLE `car_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `custonotif`
--
ALTER TABLE `custonotif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
