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
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `campusID` varchar(10) DEFAULT NULL,
  `itemID` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) DEFAULT NULL,
  `good` varchar(100) DEFAULT NULL,
  `price` varchar(10) DEFAULT '0',
  `meta` text,
  `unique` varchar(20) DEFAULT NULL,
  `desc` longtext,
  PRIMARY KEY (`itemID`),
  UNIQUE KEY `unique` (`unique`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`campusID`, `itemID`, `type`, `good`, `price`, `meta`, `unique`, `desc`) VALUES
('EY64938', 52, 'books', 'Game of Thrones', '40', 'Game of thrones george RR martin', 'EY64938_52', 'Great condition, pls buy it'),
('EY64938', 53, 'books', 'Brief History of Time', '25', 'stephen hawking books', 'EY64938_53', 'Brand new, I don''t know how to read so I shouldn''t have bought a book.'),
('EY649382', 57, 'computers', 'Laptop', '500', 'lenovo, HP, computers', 'EY649382_56', 'very good condition'),
('EY64938', 59, 'electronics', 'Gears of war 4 xbox', '400', 'game gears of war 4', 'EY64938_58', 'Never used'),
('EY64938', 60, 'events', 'Gordon Ramsay For Dinner', '5.63', 'gordon ramsay meal eat cooks', 'EY64938_60', 'He''s okay, not the best chef in the world but he''ll make a mean grilled cheese.'),
('EY64938', 62, 'food', 'Half Drank Starbucks', '5.50', 'starbucks, frappe, used', 'EY64938_62', 'Found in commons trashcan.  Still warm'),
('EY64938', 63, 'computers', 'Laptop', '300', 'lenovo, laptop', 'EY64938_63', 'Great condition pls buy');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
