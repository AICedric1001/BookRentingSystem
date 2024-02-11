-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2024 at 06:44 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentabook`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `BookID` int(11) NOT NULL,
  `BookName` varchar(255) DEFAULT NULL,
  `Genre` varchar(255) DEFAULT NULL,
  `Chronology` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`BookID`, `BookName`, `Genre`, `Chronology`) VALUES
(1, 'Percy Jackson', 'Fantasy', 1),
(2, 'Harry Potter: The Sorcerer\'s Stone', 'Fantasy', 1);

-- --------------------------------------------------------

--
-- Table structure for table `checkinout`
--

CREATE TABLE `checkinout` (
  `PersonID` int(11) DEFAULT NULL,
  `TimeIn` date DEFAULT NULL,
  `TimeOut` date DEFAULT NULL,
  `BookId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkinout`
--

INSERT INTO `checkinout` (`PersonID`, `TimeIn`, `TimeOut`, `BookId`) VALUES
(1, '2024-02-07', NULL, 1),
(2, '2024-02-07', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `renteraccount`
--

CREATE TABLE `renteraccount` (
  `PersonID` bigint(20) UNSIGNED NOT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `renteraccount`
--

INSERT INTO `renteraccount` (`PersonID`, `LastName`, `FirstName`, `Address`) VALUES
(1, 'Labayen', 'Larry James', 'Bacolod City'),
(2, 'Abarientos', 'Al Cedric', 'Bacolod City');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`BookID`);

--
-- Indexes for table `checkinout`
--
ALTER TABLE `checkinout`
  ADD KEY `PersonID` (`PersonID`),
  ADD KEY `BookId` (`BookId`);

--
-- Indexes for table `renteraccount`
--
ALTER TABLE `renteraccount`
  ADD PRIMARY KEY (`PersonID`),
  ADD UNIQUE KEY `unique_person_id` (`PersonID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `renteraccount`
--
ALTER TABLE `renteraccount`
  MODIFY `PersonID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkinout`
--
ALTER TABLE `checkinout`
  ADD CONSTRAINT `checkinout_ibfk_2` FOREIGN KEY (`BookId`) REFERENCES `books` (`BookID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
