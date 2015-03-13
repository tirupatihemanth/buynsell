-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 13, 2015 at 11:55 PM
-- Server version: 5.5.41
-- PHP Version: 5.4.36-0+deb7u3

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
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comments_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_com_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `visibility` tinyint(4) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`comments_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `ufriendly` varchar(4) NOT NULL,
  `bugs` text NOT NULL,
  `improvements` text NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`feedback_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `ufriendly`, `bugs`, `improvements`, `user_id`) VALUES
(1, 'yes', '<p>lot of bugs by blah</p>\r\n', '<p>try to improve the functionality of the site</p>\r\n', 1),
(2, 'yes', '<p>lot of bugs by blah</p>\r\n', '<p>try to improve the functionality of the site</p>\r\n', 1),
(3, 'yes', '<p>lot of bugs by blah</p>\r\n', '<p>try to improve the functionality of the site</p>\r\n', 1);

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
  `renew` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `timestamp` (`timestamp`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=90 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `price`, `description`, `reason`, `timestamp`, `renew`, `user_id`) VALUES
(89, 'Institute T Shirt', 160, 'Sizes : S, M, L, XL, XXL\r\nQuantity per person : Limited to 2\r\nCost per t-shirt : Approximately 160 Rs per t-shirt. Price might go up or down slightly depending on the size of order placed by the institute.', 'For creating oneness among the junta of IITM', '2015-03-11 22:04:59', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `item_tags`
--

CREATE TABLE IF NOT EXISTS `item_tags` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=190 ;

--
-- Dumping data for table `item_tags`
--

INSERT INTO `item_tags` (`ID`, `item_id`, `tag_id`) VALUES
(189, 89, 15);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(30) NOT NULL,
  PRIMARY KEY (`tag_id`),
  UNIQUE KEY `tag_name` (`tag_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `tag_name`) VALUES
(6, 'academics'),
(14, 'accessories'),
(16, 'books'),
(15, 'clothing'),
(11, 'cosmetics'),
(5, 'cycles'),
(8, 'eatables'),
(4, 'electronics'),
(10, 'fccoupons'),
(3, 'laptops'),
(1, 'mobiles'),
(9, 'others');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE IF NOT EXISTS `userinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(30) NOT NULL,
  `rollno` varchar(8) NOT NULL,
  `password` varchar(50) NOT NULL,
  `hostel` varchar(20) NOT NULL,
  `roomno` int(11) NOT NULL,
  `emailid` varchar(50) NOT NULL,
  `phoneno` bigint(12) NOT NULL,
  `count` int(11) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rollno` (`rollno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`id`, `fullname`, `rollno`, `password`, `hostel`, `roomno`, `emailid`, `phoneno`, `count`, `last_login`) VALUES
(1, 'TIRUPATI HEMANTH KUMAR', 'CS13B027', '5bf1fd927dfb8679496a2e6cf00cbe50c1c87145', 'SARASWATHI', 266, 'cs13b027@smail.iitm.ac.in', 9043255688, 72, '2015-03-12 18:47:15'),
(8, 'BHAVANI SHANKAR PRASAD', 'CS13B029', '', 'SARASWATHI', 267, 'cs13b029@smail.iitm.ac.in', 9912345678, 2, '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
