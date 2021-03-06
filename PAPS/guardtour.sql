-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 13, 2016 at 08:37 
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `guardtour`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `prenom` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `date_created` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nom`, `prenom`, `username`, `email`, `password`, `date_created`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@mail.com', '8624bbecd3642f743faef5f0926e8dc9', '2016-02-17 14:27:57');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `adress` varchar(150) DEFAULT NULL,
  `contact` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `nom`, `adress`, `contact`, `email`) VALUES
(1, 'Pap securite', '65, delmas port-au-prince, haiti', '3499-0077', 'paps@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `guard`
--

CREATE TABLE `guard` (
  `id` int(11) NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `prenom` varchar(45) DEFAULT NULL,
  `uid` varchar(45) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `nif` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `guard`
--

INSERT INTO `guard` (`id`, `nom`, `prenom`, `uid`, `photo`, `email`, `phone`, `nif`) VALUES
(1, 'SUY', 'Esdras', '123457575675', NULL, 'esdras@mail.com', '30390939093', '111-111-111-1'),
(2, 'klamklma', 'lkmlkm', 'mlkmlmlml', 'klmlkmlkm', 'mklmlml', 'mklmlml', 'lmklmklml'),
(3, 'tetet', 'ti tet', '123457575675', NULL, 'tet@mail.com', '3456-0099', '123-000-888-7'),
(4, 'Osias', 'Alhdo', '466d3f09217cdbf1', NULL, 'alhdo@mail.com', '3456-0097', '111-111-111-8'),
(5, 'today123', 'Esdras today', '1234567890', NULL, 'suyeasdras@yahoo.fr', '3790-9122', '123-444-111-6'),
(6, 'Derisse', 'Hollyn', 'eb414cd27279ee13', NULL, 'suyeasdras@mail.fr', '3790-9128', '300-000-000-9');

-- --------------------------------------------------------

--
-- Table structure for table `guardtours`
--

CREATE TABLE `guardtours` (
  `id` int(11) NOT NULL,
  `intervale` time DEFAULT NULL,
  `intervale_limit` time DEFAULT NULL,
  `commence_a` time DEFAULT NULL,
  `termine_a` time DEFAULT NULL,
  `poste_id` int(11) NOT NULL,
  `guard_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `guardtours`
--

INSERT INTO `guardtours` (`id`, `intervale`, `intervale_limit`, `commence_a`, `termine_a`, `poste_id`, `guard_id`) VALUES
(4, '01:00:00', '00:15:00', '07:00:00', '15:00:00', 3, 4),
(5, '01:00:00', '00:15:00', '15:00:00', '07:00:00', 3, 1),
(12, '01:00:00', '00:09:00', '01:00:00', '02:00:00', 4, 5),
(13, '15:00:00', '00:12:00', '12:00:00', '13:00:00', 4, 2),
(14, '08:13:18', '07:19:19', '13:14:14', '12:17:08', 6, 3),
(15, '01:00:00', '00:12:00', '08:00:00', '16:00:00', 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `poste`
--

CREATE TABLE `poste` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `adress` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `poste`
--

INSERT INTO `poste` (`id`, `nom`, `adress`, `contact`) VALUES
(1, 'poste', 'kmmk', 'mklmkll'),
(3, 'jesais pas', 'knknkn', 'knklnklnkl\r\n'),
(4, 'Poste test1', '19 rue testard, christ-roi', '3444-9901'),
(5, '&amp;amp;quot;', 'kkbbkbj', 'bjkbjkbjk'),
(6, 'kjbkbj''nnn', 'bjkbbkb', 'bjkbjkbjk'),
(7, '\\''', 'nkn', 'klnlnkl');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `numdossier` varchar(45) DEFAULT NULL,
  `liste_reporte` varchar(500) DEFAULT NULL,
  `date` varchar(45) DEFAULT NULL,
  `client` varchar(45) DEFAULT NULL,
  `signature_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `signature`
--

CREATE TABLE `signature` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `role` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `signature`
--

INSERT INTO `signature` (`id`, `nom`, `signature`, `role`) VALUES
(1, 'Esdras Suy', '20160304053737pmsignature.jpeg', 'Developpeur'),
(2, 'Pap securite', '20160304060452pm', '');

-- --------------------------------------------------------

--
-- Table structure for table `tours`
--

CREATE TABLE `tours` (
  `id` int(11) NOT NULL,
  `guardtours_id` int(11) NOT NULL,
  `date_tour` date DEFAULT NULL,
  `heure` time DEFAULT NULL,
  `qrcode` varchar(45) DEFAULT NULL,
  `matricule` int(11) DEFAULT NULL,
  `description` text,
  `mention` varchar(45) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tours`
--

INSERT INTO `tours` (`id`, `guardtours_id`, `date_tour`, `heure`, `qrcode`, `matricule`, `description`, `mention`, `photo`) VALUES
(11, 4, '2016-03-02', '08:15:00', '5364564538837830', 1234, 'je sais pas', '#dd5826', 'uploads/1234_20160302081500.jpeg'),
(12, 4, '2016-03-02', '08:10:00', 'post1', 1243, 'test', '#dd5826', 'uploads/1243_20160302081000.jpeg'),
(13, 4, '2016-03-02', '08:09:01', '5364564538837830', 1234, 'je sais pas', '#f0b518', 'uploads/1234_20160302080901.jpeg'),
(14, 13, '2016-03-02', '08:09:01', '5364564538837830', 1234, 'je sais pas', '#dd5826', 'uploads/1234_20160302080901.jpeg'),
(15, 13, '2025-03-02', '08:09:01', '5364564538837830', 1234, 'je sais pas', '#dd5826', 'uploads/1234_20250302080901.jpeg'),
(16, 13, '2025-03-02', '08:09:01', '5364564538837830', 1234, 'je sais pas', '#dd5826', 'uploads/1234_20250302080901.jpeg'),
(17, 15, '2016-05-13', '11:28:08', 'PAPSECURITY35', 0, 'Consierge present, Lumieres defectueuses, ', '#dd5826', ''),
(18, 15, '2016-05-13', '11:30:11', 'PAPSECURITY35', 0, 'Lumieres defectueuses, ', '#dd5826', ''),
(19, 15, '2016-05-13', '11:32:18', 'PAPSECURITY35', -1, '', '#dd5826', ''),
(20, 15, '2016-05-13', '11:37:17', 'PAPSECURITY35', -1, 'Generatrice ne marche pas, Employe present, ', '#dd5826', ''),
(21, 15, '2016-05-13', '11:41:30', 'PAPSECURITY35', -1, 'Pas d\\''electricite, Consierge present, Employe present, ', '#dd5826', ''),
(22, 15, '2016-05-13', '11:54:55', 'PAPSECURITY35', -1, 'Generatrice ne marche pas, Consierge present, ', '#dd5826', ''),
(23, 15, '2016-05-13', '12:01:23', 'PAPSECURITY35', 6866, 'Generatrice ne marche pas, ', '#555', 'uploads/6866_20160513120123.jpeg'),
(24, 15, '2016-05-13', '12:03:48', 'PAPSECURITY35', 6431, 'Generatrice ne marche pas, ', '#555', 'uploads/6431_20160513120348.jpeg'),
(25, 15, '2016-05-13', '12:06:26', 'PAPSECURITY35', 6482, '', '#f0b518', 'uploads/6482_20160513120626.jpeg'),
(26, 15, '2016-05-13', '12:09:09', 'PAPSECURITY35', 6321, 'Vitre casse, Fenetre Brisee, Pas d\\''electricite, Generatrice ne marche pas, Consierge present, Employe present, Lumieres defectueuses, ', '#dd5826', 'uploads/6321_20160513120909.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guard`
--
ALTER TABLE `guard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guardtours`
--
ALTER TABLE `guardtours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_poste_guard_poste` (`poste_id`),
  ADD KEY `fk_poste_guard_guard1` (`guard_id`);

--
-- Indexes for table `poste`
--
ALTER TABLE `poste`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_report_signature1_idx` (`signature_id`);

--
-- Indexes for table `signature`
--
ALTER TABLE `signature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tours_guardtours1` (`guardtours_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `guard`
--
ALTER TABLE `guard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `guardtours`
--
ALTER TABLE `guardtours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `poste`
--
ALTER TABLE `poste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `signature`
--
ALTER TABLE `signature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tours`
--
ALTER TABLE `tours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `guardtours`
--
ALTER TABLE `guardtours`
  ADD CONSTRAINT `fk_poste_guard_guard1` FOREIGN KEY (`guard_id`) REFERENCES `guard` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_poste_guard_poste` FOREIGN KEY (`poste_id`) REFERENCES `poste` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `fk_report_signature1` FOREIGN KEY (`signature_id`) REFERENCES `signature` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tours`
--
ALTER TABLE `tours`
  ADD CONSTRAINT `fk_tours_guardtours1` FOREIGN KEY (`guardtours_id`) REFERENCES `guardtours` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
