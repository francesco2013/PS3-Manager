-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 02, 2016 at 12:40 AM
-- Server version: 5.5.49
-- PHP Version: 5.6.23-1~dotdeb+7.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ps3-games`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE IF NOT EXISTS `games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastplayed` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `time_played` int(11) NOT NULL,
  `dateadded` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `name` text NOT NULL,
  `isoname` text NOT NULL,
  `covername` text NOT NULL,
  `numplayed` int(11) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=669 ;

-- --------------------------------------------------------

--
-- Table structure for table `game_details`
--

CREATE TABLE IF NOT EXISTS `game_details` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `category` text NOT NULL,
  `developer` text NOT NULL,
  `publisher` text NOT NULL,
  `score` int(11) NOT NULL,
  `rlsdate` text NOT NULL,
  `rel_date` datetime NOT NULL,
  `description` text NOT NULL,
  `tags` text NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
