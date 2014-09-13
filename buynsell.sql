-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 13, 2014 at 12:52 PM
-- Server version: 5.5.38
-- PHP Version: 5.4.4-14+deb7u14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `buynsell`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(25) NOT NULL,
  `price` float NOT NULL,
  `description` text NOT NULL,
  `reason` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `timestamp` (`timestamp`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `price`, `description`, `reason`, `timestamp`, `user_id`) VALUES
(16, 'blah', 50, 'blah user chose mobiles laptops and others', 'blah is here', '2014-09-12 20:46:12', 1),
(17, 'blah1', 52, 'blah1 chose tablets electronic devices and cycles', 'blah1 is here', '2014-09-12 20:48:00', 2),
(19, 'blah2', 53, 'blah2 chose laptops electronic devices and academics related', 'blah', '2014-09-12 20:57:58', 3),
(20, 'blah4', 58, 'blah4 chose Tablets eatables and others', 'blah4 is here', '2014-09-12 21:01:07', 5),
(21, 'blah', 100, 'blah chose Tablets Laptops Cycles', 'blah is here', '2014-09-12 22:18:21', 1),
(22, 'blah1', 58, 'blah1 second post', 'blah1 is back again', '2014-09-12 23:14:19', 2);

-- --------------------------------------------------------

--
-- Table structure for table `item_tags`
--

CREATE TABLE IF NOT EXISTS `item_tags` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `item_tags`
--

INSERT INTO `item_tags` (`ID`, `item_id`, `tag_id`) VALUES
(25, 16, 1),
(26, 16, 3),
(27, 16, 9),
(28, 17, 2),
(29, 17, 4),
(30, 17, 5),
(32, 19, 3),
(33, 19, 4),
(34, 19, 6),
(35, 20, 2),
(36, 20, 8),
(37, 20, 9),
(38, 21, 2),
(39, 21, 3),
(40, 21, 5),
(41, 22, 2),
(42, 22, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(30) NOT NULL,
  PRIMARY KEY (`tag_id`),
  UNIQUE KEY `tag_name` (`tag_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `tag_name`) VALUES
(6, 'academics'),
(5, 'cycles'),
(8, 'eatables'),
(4, 'electronic devices'),
(3, 'laptops'),
(1, 'mobiles'),
(9, 'others'),
(2, 'tablets');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE IF NOT EXISTS `userinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(30) NOT NULL,
  `rollno` varchar(8) NOT NULL,
  `password` varchar(50) NOT NULL,
  `hostel` varchar(15) NOT NULL,
  `roomno` int(11) NOT NULL,
  `emailid` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rollno` (`rollno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`id`, `fullname`, `rollno`, `password`, `hostel`, `roomno`, `emailid`) VALUES
(1, 'BLAH', 'blah', '5bf1fd927dfb8679496a2e6cf00cbe50c1c87145', '', 0, ''),
(2, 'BLAH1', 'blah1', '0c9cfeb528bf68cd6ead0868f0d45495438e7186', '', 0, ''),
(3, 'BLAH2', 'blah2', '7ec1f0eb9119d48eb6a3176ca47380c6496304c8', '', 0, ''),
(4, 'BLAH3', 'blah3', 'bb74179db036d06aaf96e34da2b9a32bf15418b0', '', 0, ''),
(5, 'BLAH4', 'blah4', '77caa7fa09e8278b9fde8d0e0dfcc64c1ea6511d', '', 0, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
