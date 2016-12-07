-- phpMyAdmin SQL Dump
-- version 4.0.10.17
-- https://www.phpmyadmin.net
--
-- Host: studentdb-maria.gl.umbc.edu
-- Generation Time: Dec 07, 2016 at 12:36 AM
-- Server version: 10.1.18-MariaDB
-- PHP Version: 5.4.44

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jstand1`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE IF NOT EXISTS `user_accounts` (
  `campusID` varchar(10) NOT NULL,
  `fName` varchar(25) DEFAULT NULL,
  `lName` varchar(40) DEFAULT NULL,
  `karma` int(11) DEFAULT '0',
  `password` varchar(128) DEFAULT 'pass',
  `favorites` text,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(36) DEFAULT NULL,
  `messageNO` int(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`campusID`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`campusID`, `fName`, `lName`, `karma`, `password`, `favorites`, `email`, `username`, `messageNO`) VALUES
('AB12345', 'abc', 'def', 0, '$2a$10$lCFAo.Ef/l0QYoeD.fmm7.XLDYgITwOR44/6bv67eRKUYRxFou9SO', NULL, 'guest@umbc.edu', 'guest', 0),
('AB34567', 'Joshua', 'Standiford', 0, '$2a$10$bGRtjlNO/k9DHZl5jOIzD.VDAin1dlBqPxVB7WNObPflnrf5t0oDm', NULL, 'jstand3@umbc.edu', 'dank_meme', 0),
('EY64938', 'Joshua', 'Standiford', 0, '$2a$10$6bjLZP97hwO5whbJxaG7mOVQ8xrMMeyLeCBFnOzyA2CJJEjZODwwW', NULL, 'jstand1@umbc.edu', 'jstand1', 0),
('EY649382', 'Joshua', 'Standiford', 0, '$2a$10$vKM/WRUXyuQCXmLylW5w7uqRWVWGc9SsY50PmHaOalaX7L08AD0LG', NULL, 'jstand2@umbc.edu', 'jstand2', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
