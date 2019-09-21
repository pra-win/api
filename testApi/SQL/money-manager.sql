-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 21, 2019 at 04:37 PM
-- Server version: 5.7.27-0ubuntu0.16.04.1
-- PHP Version: 7.0.33-0ubuntu0.16.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `money-manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `category-master`
--

CREATE TABLE `category-master` (
  `category-id` int(255) NOT NULL,
  `category-name` varchar(500) NOT NULL,
  `category-type` varchar(1) NOT NULL,
  `category-added-date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category-master`
--

INSERT INTO `category-master` (`category-id`, `category-name`, `category-type`, `category-added-date`) VALUES
(13, 'dsd', 'i', '2019-09-21 03:01:09'),
(14, 'dsd-2', 'e', '2019-09-21 03:01:48'),
(15, 'dsd-3', 'i', '2019-09-21 03:02:11'),
(16, 'dsd-4', 'e', '2019-09-21 03:02:11'),
(20, 'dsd-11', 'e', '2019-09-21 03:12:01'),
(21, 'dsd-7895', 'i', '2019-09-21 03:30:00'),
(22, 'tedt', 'e', '2019-09-21 03:30:00'),
(23, 'test-3', 'i', '2019-09-21 04:06:04'),
(24, 'test-4', 'e', '2019-09-21 04:06:15');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction-id` int(255) NOT NULL,
  `transaction-amt` int(255) NOT NULL,
  `category-id` int(255) NOT NULL,
  `transaction-date` datetime NOT NULL,
  `transaction-desc` varchar(1000) NOT NULL,
  `transaction-keyword` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction-id`, `transaction-amt`, `category-id`, `transaction-date`, `transaction-desc`, `transaction-keyword`) VALUES
(1, 999999, 1, '2019-09-21 00:00:00', 'test t', 'test t k');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category-master`
--
ALTER TABLE `category-master`
  ADD PRIMARY KEY (`category-id`),
  ADD UNIQUE KEY `category-name` (`category-name`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction-id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category-master`
--
ALTER TABLE `category-master`
  MODIFY `category-id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction-id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
