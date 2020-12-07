-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 05, 2020 at 05:13 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cedcab`
--

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `distance` varchar(50) NOT NULL,
  `is_available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`, `distance`, `is_available`) VALUES
(3, 'BBD', '30', 1),
(5, 'Faizabad', '100', 1),
(6, 'Basti', '150', 1),
(7, 'Gorakhpur', '210', 1),
(8, 'Firozabad', '180', 1),
(9, 'Delhi', '500', 1),
(10, 'Agra', '350', 1),
(11, 'Charbagh', '0', 1),
(13, 'Devariya', '250', 0),
(16, 'Barabanki', '60', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ride`
--

CREATE TABLE `ride` (
  `ride_id` int(11) NOT NULL,
  `ride_date` varchar(20) NOT NULL,
  `from_distance` varchar(50) NOT NULL,
  `to_distance` varchar(50) NOT NULL,
  `cab_type` varchar(20) NOT NULL,
  `total_distance` varchar(50) NOT NULL,
  `luggage` varchar(50) NOT NULL,
  `total_fare` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  `customer_user_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ride`
--

INSERT INTO `ride` (`ride_id`, `ride_date`, `from_distance`, `to_distance`, `cab_type`, `total_distance`, `luggage`, `total_fare`, `status`, `customer_user_id`) VALUES
(63, '2020-12-04 11:35', 'Gorakhpur', 'Agra', 'CedMini', '140', '141', '2041', 2, 10),
(65, '2020-12-04 01:28', 'Basti', 'Charbagh', 'CedMini', '150', '34', '2153', 1, 9),
(66, '2020-12-04 01:29', 'Gorakhpur', 'Firozabad', 'CedRoyal', '30', '5', '685', 1, 9),
(67, '2020-12-04 01:29', 'Charbagh', 'Basti', 'CedMini', '150', '56', '2153', 1, 9),
(68, '2020-12-04 01:34', 'Basti', 'Delhi', 'CedMini', '350', '34', '4070', 1, 10),
(69, '2020-12-04 01:35', 'Basti', 'Charbagh', 'CedMini', '150', '44', '2153', 0, 10),
(70, '2020-12-04 01:35', 'Agra', 'Gorakhpur', 'CedSUV', '140', '8', '2321', 1, 10),
(71, '2020-12-04 01:35', 'Barabanki', 'Agra', 'CedRoyal', '290', '7', '3690', 1, 10),
(72, '2020-12-04 01:35', 'Faizabad', 'Firozabad', 'CedMicro', '80', '0', '989', 1, 10),
(73, '2020-12-04 03:30', 'BBD', 'Faizabad', 'CedRoyal', '70', '45', '1377', 1, 10),
(74, '2020-12-04 03:51', 'Gorakhpur', 'Firozabad', 'CedSUV', '30', '44', '1115', 1, 10),
(75, '2020-12-04 03:52', 'Firozabad', 'Gorakhpur', 'CedRoyal', '30', '0', '635', 0, 10),
(76, '2020-12-04 04:17', 'Firozabad', 'Gorakhpur', 'CedSUV', '30', '99', '1115', 1, 10),
(77, '2020-12-04 04:17', 'Gorakhpur', 'Firozabad', 'CedRoyal', '30', '56', '835', 1, 10),
(78, '2020-12-04 06:41', 'BBD', 'Faizabad', 'CedMini', '70', '12', '1157', 1, 10),
(79, '2020-12-04 06:46', 'Basti', 'Faizabad', 'CedMicro', '50', '0', '665', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `dateofsignup` varchar(20) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `isblock` tinyint(1) NOT NULL,
  `password` varchar(50) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `name`, `dateofsignup`, `mobile`, `isblock`, `password`, `is_admin`) VALUES
(8, 'admin@admin.com', 'admin', '2020-11-25 03:48', '0987654321', 1, '5cbcf07e36fe37142b407ace0211cbf7', 1),
(9, 'localhost@localhost.com', 'Localhost', '2020-11-25 06:03', '1234509876', 1, '827ccb0eea8a706c4c34a16891f84e7b', 0),
(10, 'vaibhav@baba.com', 'vaibhav srivastav', '2020-11-26 11:19', '4654545444', 1, 'c20ad4d76fe97759aa27a0c99bff6710', 0),
(11, 'newuser@new.com', 'newuser', '2020-11-27 02:55', '8888888888', 1, 'e10adc3949ba59abbe56e057f20f883e', 0),
(12, 'newuser123@new.com', 'newuser123', '2020-11-27 03:17', '9999999999', 0, '81dc9bdb52d04dc20036dbd8313ed055', 0),
(13, 'pranjal@shukla.com', 'pranjal', '2020-11-30 02:39', '8936545622522', 1, '5f4dcc3b5aa765d61d8327deb882cf99', 0),
(14, 'local@user.com', 'local user', '2020-11-30 02:45', '23435565756', 1, 'e10adc3949ba59abbe56e057f20f883e', 0),
(15, 'abc@gmail.com', 'abc444', '2020-12-01 03:31', '7865434663', 0, '202cb962ac59075b964b07152d234b70', 0),
(20, 'random@random.rr', 'random', '2020-12-02 06:01', '2436464644', 0, '202cb962ac59075b964b07152d234b70', 0),
(28, 'test@user.com', 'test user', '2020-12-03 09:59', '7418529635', 0, 'e10adc3949ba59abbe56e057f20f883e', 0),
(30, 'user@is.com', 'user is', '2020-12-03 04:10', '5445546464', 0, 'e10adc3949ba59abbe56e057f20f883e', 0),
(36, 'new@new.in', 'new', '2020-12-03 06:42', '7898965654', 0, '202cb962ac59075b964b07152d234b70', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ride`
--
ALTER TABLE `ride`
  ADD PRIMARY KEY (`ride_id`),
  ADD KEY `id` (`customer_user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `ride`
--
ALTER TABLE `ride`
  MODIFY `ride_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ride`
--
ALTER TABLE `ride`
  ADD CONSTRAINT `id` FOREIGN KEY (`customer_user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
