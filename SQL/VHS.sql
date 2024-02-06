-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 01 fév. 2024 à 15:13
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `VHS`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `FullName` varchar(100) DEFAULT NULL,
  `AdminEmail` varchar(120) DEFAULT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `UpdationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `FullName`, `AdminEmail`, `UserName`, `Password`, `UpdationDate`) VALUES
(1, 'Florent', 'FlorentExemple@gmail.com', 'admin1', 'e5a807f413f8a0aba804193148dfcbae', '2024-02-01 13:19:16');

-- --------------------------------------------------------

--
-- Structure de la table `tbldiffusers`
--

DROP TABLE IF EXISTS `tbldiffusers`;
CREATE TABLE IF NOT EXISTS `tbldiffusers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `DiffuserName` varchar(159) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tbldiffusers`
--

INSERT INTO `tbldiffusers` (`id`, `DiffuserName`, `CreationDate`, `UpdationDate`) VALUES
(1, 'Paramount Pictures', '2017-07-08 12:49:09', '2024-02-01 13:26:39'),
(2, 'DreamWorks Animation', '2017-07-08 14:30:23', '2024-02-01 13:26:52'),
(3, 'Gaumont', '2017-07-08 14:35:08', '2024-02-01 13:27:00'),
(4, 'Tartan Asia Extreme', '2017-07-08 14:35:21', NULL),
(5, 'Walt Disney Pictures', '2017-07-08 14:35:36', NULL),
(6, 'Touchstone Pictures', '2017-07-08 15:22:03', NULL),
(7, '20th Century Fox', '2017-07-08 15:22:03', NULL),
(8, 'American Broadcasting Company', '2017-07-08 15:22:03', NULL),
(9, 'Salvation', '2017-07-08 15:22:03', NULL),
(10, 'Metro-Goldwyn-Mayer', '2017-07-08 15:22:03', NULL),
(11, 'Studio Canal', '2017-07-08 15:22:03', NULL),
(12, 'British Broadcasting Corporation', '2017-07-08 15:22:03', NULL),
(13, 'Samuel Goldwyn Productions', '2017-07-08 15:22:03', NULL),
(14, 'A&E Networks', '2017-07-08 15:22:03', NULL),
(15, 'Universal Pictures', '2017-07-08 15:22:03', NULL),
(16, 'Trimark Pictures', '2017-07-08 15:22:03', NULL),
(17, 'Numero Uno International', '2017-07-08 15:22:03', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tblvhs`
--

DROP TABLE IF EXISTS `tblvhs`;
CREATE TABLE IF NOT EXISTS `tblvhs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `VHSName` varchar(255) DEFAULT NULL,
  `CatId` int DEFAULT NULL,
  `DiffuserId` int DEFAULT NULL,
  `EAN` int DEFAULT NULL,
  `VHSPrice` int DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tblvhs`
--

INSERT INTO `tblvhs` (`id`, `VHSName`, `CatId`, `DiffuserId`, `EAN`, `VHSPrice`, `RegDate`, `UpdationDate`) VALUES
(1, 'Shrek', 1, 1, 2147483647, 5, '2024-02-01 13:36:38', NULL),
(2, 'Shaft', 2, 1, 2147483647, 5, '2024-02-01 13:39:37', NULL),
(3, 'Atlantis', 3, 3, 2147483647, 5, '2024-02-01 13:41:10', NULL),
(4, 'Bad guys', 3, 4, 2147483647, 5, '2024-02-01 13:42:12', NULL),
(5, 'Bambi', 1, 5, 2147483647, 5, '2024-02-01 13:42:32', NULL),
(6, 'Blaze', 2, 6, 2147483647, 5, '2024-02-01 13:42:52', NULL),
(7, 'Carousel', 2, 7, 2147483647, 5, '2024-02-01 13:43:13', NULL),
(8, 'Dinotopia', 1, 8, 2147483647, 5, '2024-02-01 13:43:37', NULL),
(9, 'Fascination', 3, 9, 2147483647, 5, '2024-02-01 13:43:58', NULL),
(10, 'Independance Day', 2, 7, 2147483647, 5, '2024-02-01 13:44:20', NULL),
(11, 'Joey', 1, 10, 2147483647, 5, '2024-02-01 13:44:48', NULL),
(12, 'Le professionnel', 2, 11, 2147483647, 5, '2024-02-01 13:45:22', NULL),
(13, 'Les visiteurs', 2, 3, 2147483647, 5, '2024-02-01 13:45:39', NULL),
(14, 'Motivation Power', 2, 12, 2147483647, 5, '2024-02-01 13:46:03', NULL),
(15, 'Rafles', 2, 13, 2147483647, 5, '2024-02-01 13:46:20', NULL),
(16, 'Samurai', 2, 14, 2147483647, 5, '2024-02-01 13:46:46', NULL),
(17, 'Scarface', 3, 15, 2147483647, 5, '2024-02-01 13:47:08', NULL),
(18, 'Sprung', 2, 16, 2147483647, 5, '2024-02-01 13:47:29', NULL),
(19, 'The Eyes', 3, 4, 2147483647, 5, '2024-02-01 13:47:44', NULL),
(20, 'Ultrà', 3, 17, 2147483647, 5, '2024-02-01 13:48:00', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tblcategory`
--

DROP TABLE IF EXISTS `tblcategory`;
CREATE TABLE IF NOT EXISTS `tblcategory` (
  `id` int NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(150) DEFAULT NULL,
  `Status` int DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Status`, `CreationDate`, `UpdationDate`) VALUES
(1, 'Enfants', 1, '2024-02-01 13:34:20', NULL),
(2, 'Tout Public', 1, '2024-02-01 13:34:28', NULL),
(3, 'Adultes', 1, '2024-02-01 13:34:34', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tblissuedvhsdetails`
--

DROP TABLE IF EXISTS `tblissuedvhsdetails`;
CREATE TABLE IF NOT EXISTS `tblissuedvhsdetails` (
  `id` int NOT NULL AUTO_INCREMENT,
  `VHSId` int DEFAULT NULL,
  `RenterID` varchar(150) DEFAULT NULL,
  `IssuesDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ReturnDate` timestamp NULL DEFAULT NULL,
  `ReturnStatus` int DEFAULT '1',
  `fine` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tblissuedvhsdetails`
--

INSERT INTO `tblissuedvhsdetails` (`id`, `VHSId`, `RenterID`, `IssuesDate`, `ReturnDate`, `ReturnStatus`, `fine`) VALUES
(1, 1, 'RID1', '2024-02-01 14:19:07', '2024-02-01 14:21:11', 1, 2),
(2, 1, 'RID1', '2024-02-01 14:23:15', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tblrenters`
--

DROP TABLE IF EXISTS `tblrenters`;
CREATE TABLE IF NOT EXISTS `tblrenters` (
  `id` int NOT NULL AUTO_INCREMENT,
  `RenterId` varchar(100) DEFAULT NULL,
  `FullName` varchar(120) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `MobileNumber` char(11) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `Status` int DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `RenterId` (`RenterId`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tblrenters`
--

INSERT INTO `tblrenters` (`id`, `RenterId`, `FullName`, `EmailId`, `MobileNumber`, `Password`, `Status`, `RegDate`, `UpdationDate`) VALUES
(1, 'RID1', 'test', 'test@gmail.com', '0123456789', 'f925916e2754e5e03f75dd58a5733251', 1, '2024-02-01 07:58:28', '2024-02-01 14:17:35'),
(2, 'RID2', 'Louise', 'Louise@gmail.com', '0621546352', 'f6f1520f05d4b5a3b5e2ec3e2fb05d42', 1, '2024-02-01 13:53:31', NULL),
(3, 'RID3', 'Jack', 'jack@gmail.com', '0621423398', '12ef7c5f50528bb5a002033ffa5551ee', 1, '2024-02-01 14:10:00', NULL),
(4, 'RID4', 'Bouder', 'bouder@gmail.com', '0723458596', '57565a5b3ac53e0cc647cdc0059757a8', 1, '2024-02-01 14:14:10', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
