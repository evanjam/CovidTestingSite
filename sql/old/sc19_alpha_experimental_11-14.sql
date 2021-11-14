-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2021 at 06:35 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sc19_alpha`
--
CREATE DATABASE IF NOT EXISTS `sc19_alpha` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sc19_alpha`;

-- --------------------------------------------------------

--
-- Table structure for table `login_log`
--

CREATE TABLE `login_log` (
  `LLID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `login_date` date NOT NULL,
  `is_successful` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login_log`
--

INSERT INTO `login_log` (`LLID`, `UID`, `login_date`, `is_successful`) VALUES
(15, 1, '2021-11-14', 1),
(16, 2, '2021-11-14', 0),
(17, 2, '2021-11-14', 1),
(18, 3, '2021-11-14', 1),
(19, 4, '2021-11-14', 1),
(20, 4, '2021-11-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `test_sample`
--

CREATE TABLE `test_sample` (
  `TID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `serial_number` int(20) NOT NULL,
  `test_date` date NOT NULL,
  `result` int(1) NOT NULL,
  `is_signed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `UIID` int(11) NOT NULL,
  `UID` int(11) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `phoneNum` varchar(11) NOT NULL,
  `address` varchar(45) NOT NULL,
  `insuranceC` varchar(25) NOT NULL,
  `insuranceNum` varchar(25) NOT NULL,
  `ssn` varchar(9) NOT NULL,
  `email` varchar(35) NOT NULL,
  `dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `UID` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(64) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `dob` date NOT NULL,
  `ssn` int(9) NOT NULL,
  `permission` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`UID`, `username`, `password`, `fname`, `lname`, `dob`, `ssn`, `permission`) VALUES
(1, 'a', '$2y$10$kzhwCTKalXGfti0XYx5VkuWeZj2QDkLC4JV1Tm0fI72EckLFou94e', 'a', 'a', '2021-10-01', 111111111, 4),
(2, 'd', '$2y$10$XUlmaC.rb3LIrMCEXe1a5.SdF.O3JQM.YLka4NgJV5krUypVdrV66', 'd', 'd', '2021-10-01', 222222222, 3),
(3, 'l', '$2y$10$Iex7HvEUoylESDSzXfJXNupakumMUGFz8xQcGNsPtVoATLK3Uy382', 'l', 'l', '2021-10-01', 333333333, 2),
(4, 'e', '$2y$10$r8dD1nNNeNhGmDcJZkIrMumzeLfCIjN/FHF5QOGFWRpUgFOUwMBIS', 'e', 'e', '2021-10-01', 444444444, 1),
(5, 'p', '$2y$10$G31XsG/5TeqZBHNW/9DCL.I.wr8eWr2IHH4nYFDyemHcTSz0HKVMq', 'p', 'p', '2021-10-01', 555555555, 0),
(7, 'theo', '$2y$10$qcu6gbVZKI.3KFq6PsHkKeJVBPmR1Yngp.ZP7sKii6UR0M0hfYTna', 'Thatcher', 'Deyoe', '2021-11-09', 11010101, 0),
(8, 'theo2', '$2y$10$ICM7X3xotLVgI0h0ffW/VujeV/DU.hgIB73L0uOlx2yq834PXv6yW', 'Thatcher', 'Deyoe', '2021-11-09', 929929292, 2),
(9, 'allie', '$2y$10$90fgDRncgzMeanmz6doHFu4ypjlTZs/597A2jxUw/fUl4ybBe62F.', 'Thatcher', 'Deyoe', '2021-11-09', 656657482, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_log`
--
ALTER TABLE `login_log`
  ADD PRIMARY KEY (`LLID`),
  ADD KEY `UID` (`UID`);

--
-- Indexes for table `test_sample`
--
ALTER TABLE `test_sample`
  ADD PRIMARY KEY (`TID`),
  ADD KEY `UID` (`UID`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`UIID`),
  ADD KEY `info_index` (`UID`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`UID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login_log`
--
ALTER TABLE `login_log`
  MODIFY `LLID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `test_sample`
--
ALTER TABLE `test_sample`
  MODIFY `TID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `UIID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_log`
--
ALTER TABLE `login_log`
  ADD CONSTRAINT `login_log_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `user_profile` (`UID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `test_sample`
--
ALTER TABLE `test_sample`
  ADD CONSTRAINT `test_sample_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `user_profile` (`UID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `user_profile` (`UID`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
