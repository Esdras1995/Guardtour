-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 13, 2016 at 11:32 
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `create_time`, `name`, `lastname`) VALUES
(1, 'admin', 'esdras@mail.com', '$2y$10$gqiBOIsjgp4F4jrPjDjdjulKE', '2016-01-13 17:14:31', 'Esdras', 'SUY'),
(2, 'admin1', 'test@mail.com', '$2y$10$0GWAp5sLGuBuGdECd68sae7Av', '2016-01-13 17:20:12', 'Esdras', 'Suy'),
(3, 'testAdmin', 'esdras.test@esih.edu', '123456', '2016-01-13 17:36:11', 'Esdras', 'SUY');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `guard`
--

INSERT INTO `guard` (`id`, `nom`, `prenom`, `uid`, `photo`, `email`, `phone`, `NIF`) VALUES
(1, '111', '111', '11', NULL, 'esdras@mail.com', '1111', 'wwwww');

-- --------------------------------------------------------

--
-- Table structure for table `guardtours`
--

CREATE TABLE IF NOT EXISTS `guardtours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heure` datetime DEFAULT NULL,
  `interval` int(11) DEFAULT NULL,
  `guard_id` int(11) NOT NULL,
  `poste_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_guardtours_guard_idx` (`guard_id`),
  KEY `fk_guardtours_poste1_idx` (`poste_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `poste`
--

INSERT INTO `poste` (`id`, `nom`, `adress`, `contact`) VALUES
(1, 'Post', '69, rue laveau', '47839902'),
(2, 'fadfa', 'adfa', 'fafd');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE IF NOT EXISTS `report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mention` varchar(255) DEFAULT NULL,
  `guard_id` int(11) NOT NULL,
  `tours_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_report_guard1_idx` (`guard_id`),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  ADD CONSTRAINT `fk_report_guard1` FOREIGN KEY (`guard_id`) REFERENCES `guard` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_report_tours1` FOREIGN KEY (`tours_id`) REFERENCES `tours` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tours`
--
ALTER TABLE `tours`
  ADD CONSTRAINT `fk_tours_guard1` FOREIGN KEY (`guard_id`) REFERENCES `guard` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
