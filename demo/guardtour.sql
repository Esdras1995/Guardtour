-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 18, 2016 at 11:17 
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `guardtour`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(32) NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(45) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `create_time`, `name`, `lastname`) VALUES
(1, 'testAdmin', 'esdras.test@esih.edu', '123456', '2016-01-13 17:36:11', 'Esdras', 'SUY'),
(4, 'admin', 'david.jean@mail.com', 'administrateur', '2016-01-18 18:48:14', 'David', 'Jean');

-- --------------------------------------------------------

--
-- Table structure for table `guard`
--

CREATE TABLE IF NOT EXISTS `guard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `uid` varchar(45) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `NIF` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `guard`
--

INSERT INTO `guard` (`id`, `nom`, `prenom`, `uid`, `photo`, `email`, `phone`, `NIF`) VALUES
(3, 'Alessandro', 'Osias', 'e0504fd1d65f789b', NULL, 'alhdo@mail.com', '3456-7899', '112-999-543-0');

-- --------------------------------------------------------

--
-- Table structure for table `guardtours`
--

CREATE TABLE IF NOT EXISTS `guardtours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heure` datetime DEFAULT NULL,
  `intervale` time DEFAULT NULL,
  `openAt` time DEFAULT NULL,
  `closeAt` time DEFAULT NULL,
  `guard_id` int(11) NOT NULL,
  `poste_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_guardtours_guard_idx` (`guard_id`),
  KEY `fk_guardtours_poste1_idx` (`poste_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `poste`
--

CREATE TABLE IF NOT EXISTS `poste` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `adress` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `poste`
--

INSERT INTO `poste` (`id`, `nom`, `adress`, `contact`) VALUES
(3, 'Post503', '69, rue nogues bourdon', '3778-9905');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE IF NOT EXISTS `report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mention` varchar(255) DEFAULT NULL,
  `tours_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_report_tours1_idx` (`tours_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tours`
--

CREATE TABLE IF NOT EXISTS `tours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_tour` datetime DEFAULT NULL,
  `qrcode` varchar(255) DEFAULT NULL,
  `description` text,
  `guard_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tours_guard1_idx` (`guard_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guardtours`
--
ALTER TABLE `guardtours`
  ADD CONSTRAINT `fk_guardtours_guard` FOREIGN KEY (`guard_id`) REFERENCES `guard` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_guardtours_poste1` FOREIGN KEY (`poste_id`) REFERENCES `poste` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `fk_report_tours1` FOREIGN KEY (`tours_id`) REFERENCES `tours` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tours`
--
ALTER TABLE `tours`
  ADD CONSTRAINT `fk_tours_guard1` FOREIGN KEY (`guard_id`) REFERENCES `guard` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
