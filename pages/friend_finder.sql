-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2019 at 10:59 PM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `friend_finder`
--

-- --------------------------------------------------------

--
-- Table structure for table `addfriend_list`
--

DROP TABLE IF EXISTS `addfriend_list`;
CREATE TABLE IF NOT EXISTS `addfriend_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_user` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `date_request` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `addfriend_list`
--

INSERT INTO `addfriend_list` (`id`, `request_user`, `friend_id`, `date_request`) VALUES
(22, 5, 4, '2019-02-21 16:35:49'),
(21, 5, 1, '2019-02-21 16:35:48');

-- --------------------------------------------------------

--
-- Table structure for table `friend_list`
--

DROP TABLE IF EXISTS `friend_list`;
CREATE TABLE IF NOT EXISTS `friend_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `date_added` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `profilePic` text NOT NULL,
  `work` text NOT NULL,
  `date_registered` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `profilePic`, `work`, `date_registered`) VALUES
(1, 'Joshua', 'Moshood', 'joshua.moshood@gmail.com', 'josh', ' ', 'Boss', '2019-02-21 11:24:48'),
(4, 'Julian', 'ayobami', 'alisataylorm.m@gmail.com', 'alisa', ' ', 'Programmer', '2019-02-21 12:26:17'),
(5, 'Tester', 'Boss', '130404002', 'OLAJIDE', ' ', 'Programmer', '2019-02-21 15:21:02');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
