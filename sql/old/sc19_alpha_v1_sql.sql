-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2021 at 02:47 AM
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
-- Creation: Sep 17, 2021 at 12:43 AM
--

CREATE TABLE `login_log` (
  `LLID` int(11) NOT NULL,
  `ULID` int(11) NOT NULL,
  `login_date` varchar(25) NOT NULL,
  `is_successful` int(1) NOT NULL,
  `error_message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `login_log`:
--   `ULID`
--       `user_login` -> `ULID`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--
-- Creation: Sep 17, 2021 at 12:41 AM
--

CREATE TABLE `user_login` (
  `ULID` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `user_login`:
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_log`
--
ALTER TABLE `login_log`
  ADD PRIMARY KEY (`LLID`),
  ADD KEY `ULID` (`ULID`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`ULID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login_log`
--
ALTER TABLE `login_log`
  MODIFY `LLID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `ULID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_log`
--
ALTER TABLE `login_log`
  ADD CONSTRAINT `login_log_ibfk_1` FOREIGN KEY (`ULID`) REFERENCES `user_login` (`ULID`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
