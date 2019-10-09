-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 05, 2019 at 08:39 PM
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
  `transaction-keyword` varchar(500) NOT NULL,
  `future-transaction` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  ADD PRIMARY KEY (`transaction-id`),
  ADD KEY `category-id` (`category-id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category-master`
--
ALTER TABLE `category-master`
  MODIFY `category-id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=279;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction-id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=611;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`category-id`) REFERENCES `category-master` (`category-id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
