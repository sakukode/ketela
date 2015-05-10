-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2015 at 07:52 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `simple-trello`
--

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE IF NOT EXISTS `card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `listId` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  `duedate` datetime DEFAULT NULL,
  `status` enum('pending','progress','done') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `listId` (`listId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`id`, `listId`, `title`, `description`, `date`, `duedate`, `status`) VALUES
(1, 3, 'card one', 'this is card one', '2015-05-03', '2015-05-03 17:00:00', 'pending'),
(2, 3, 'card two', '', '0000-00-00', NULL, 'pending'),
(3, 3, 'card tri', '', '2015-05-03', NULL, 'pending'),
(4, 4, 'hello world', '', '2015-05-03', NULL, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `commentcard`
--

CREATE TABLE IF NOT EXISTS `commentcard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cardId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `date` date NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cardId` (`cardId`,`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `filecard`
--

CREATE TABLE IF NOT EXISTS `filecard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cardId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `date` date NOT NULL,
  `filename` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cardId` (`cardId`,`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `filecard`
--

INSERT INTO `filecard` (`id`, `cardId`, `userId`, `date`, `filename`) VALUES
(4, 4, 1, '2015-05-09', 'simple-trello2.txt'),
(5, 4, 1, '2015-05-09', 'pinjaman.txt'),
(6, 2, 1, '2015-05-09', 'bolt.txt'),
(7, 2, 1, '2015-05-09', 'pajak.xlsx');

-- --------------------------------------------------------

--
-- Table structure for table `list`
--

CREATE TABLE IF NOT EXISTS `list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `list`
--

INSERT INTO `list` (`id`, `title`) VALUES
(3, 'new list'),
(4, 'another list'),
(5, 'beatiful list'),
(6, 'wonderful list'),
(7, 'crazy list');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `password`, `name`) VALUES
(1, 'demo@simpletrello.com', 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', 'demo user'),
(2, 'admin@simpletrello.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin user'),
(3, 'utari@gmail.com', 'utari', '62a6cfff6b0ba700dfb0e93b1c2560bf', 'tutik utari'),
(4, 'adam@gmail.com', 'adam', '1d7c2923c1684726dc23d2901c4d8157', 'adam levigne');

-- --------------------------------------------------------

--
-- Table structure for table `usercard`
--

CREATE TABLE IF NOT EXISTS `usercard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cardId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cardId` (`cardId`,`userId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `usercard`
--

INSERT INTO `usercard` (`id`, `cardId`, `userId`) VALUES
(2, 1, 1),
(3, 1, 3),
(4, 1, 4),
(1, 4, 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
