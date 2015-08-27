-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: sql307.byethost13.com
-- Generation Time: Aug 15, 2015 at 06:53 AM
-- Server version: 5.6.22-71.0
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `b13_16528839_tdo`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesslevels`
--

CREATE TABLE IF NOT EXISTS `accesslevels` (
  `accessLevelID` int(11) NOT NULL AUTO_INCREMENT,
  `userGroupID` int(11) DEFAULT NULL,
  `formID` int(11) DEFAULT NULL,
  `canAdd` bit(1) DEFAULT NULL,
  `canView` bit(1) DEFAULT NULL,
  `canEdit` bit(1) DEFAULT NULL,
  `canDelete` bit(1) DEFAULT NULL,
  `canApprove` bit(1) DEFAULT NULL,
  `createdByID` int(11) DEFAULT NULL,
  `dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedByID` int(11) DEFAULT NULL,
  `dateModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`accessLevelID`),
  KEY `userGroupID` (`userGroupID`),
  KEY `formID` (`formID`),
  KEY `createdByID` (`createdByID`),
  KEY `modifiedByID` (`modifiedByID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `accesslevels`
--

INSERT INTO `accesslevels` (`accessLevelID`, `userGroupID`, `formID`, `canAdd`, `canView`, `canEdit`, `canDelete`, `canApprove`, `createdByID`, `dateCreated`, `modifiedByID`, `dateModified`) VALUES
(1, 1, 1, b'1', b'1', b'1', b'1', b'1', 1, '2015-06-12 11:10:05', 1, '2015-06-12 11:10:05');

-- --------------------------------------------------------

--
-- Table structure for table `cargotype`
--

CREATE TABLE IF NOT EXISTS `cargotype` (
  `cargoTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `cargoTypeName` varchar(50) NOT NULL,
  `dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `createdByID` int(11) DEFAULT NULL,
  `dateModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`cargoTypeID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `cargotype`
--

INSERT INTO `cargotype` (`cargoTypeID`, `cargoTypeName`, `dateCreated`, `createdByID`, `dateModified`, `modifiedBy`) VALUES
(37, 'Pallet', '2015-08-14 13:26:52', 3, '2015-08-14 13:26:52', 3),
(36, '45 FT', '2015-08-14 13:26:22', 3, '2015-08-14 13:26:22', 3),
(35, '40 FT', '2015-08-14 13:26:16', 3, '2015-08-14 13:26:16', 3),
(34, '20 FT', '2015-08-14 13:26:06', 3, '2015-08-14 13:26:06', 3);

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `cityID` int(11) NOT NULL AUTO_INCREMENT,
  `cityName` varchar(50) NOT NULL,
  `cityCode` varchar(10) DEFAULT NULL,
  `stateID` int(11) NOT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `createdByID` int(11) DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`cityID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`cityID`, `cityName`, `cityCode`, `stateID`, `dateCreated`, `createdByID`, `dateModified`, `modifiedBy`) VALUES
(2, 'Ikeja', 'IKJ', 9, NULL, 3, NULL, 3),
(3, 'Oregun', 'OR', 9, NULL, 3, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `despatchregister`
--

CREATE TABLE IF NOT EXISTS `despatchregister` (
  `despatchRegisterID` int(11) NOT NULL AUTO_INCREMENT,
  `tdoRegisterID` int(11) NOT NULL,
  `containerConfirmed` bit(1) DEFAULT NULL,
  `returnTerminalConfirmed` bit(1) DEFAULT NULL,
  `truckConfirmed` bit(1) DEFAULT NULL,
  `waybillNumber` varchar(20) DEFAULT NULL,
  `billOfLadingNumber` varchar(20) DEFAULT NULL,
  `loadingDate` datetime DEFAULT NULL,
  `clientArrival` datetime DEFAULT NULL,
  `startClientDelay` datetime DEFAULT NULL,
  `startDemurrage` datetime DEFAULT NULL,
  `offloadingTime` datetime DEFAULT NULL,
  `dropEmptyTime` datetime DEFAULT NULL,
  `waybillReceivedTime` datetime DEFAULT NULL,
  `CCReceivedTime` datetime DEFAULT NULL,
  `fashola` bit(1) DEFAULT NULL,
  `bonusPayable` decimal(18,2) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `createdByID` int(11) DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`despatchRegisterID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE IF NOT EXISTS `driver` (
  `driverID` int(11) NOT NULL AUTO_INCREMENT,
  `driverCode` varchar(10) DEFAULT NULL,
  `firstName` varchar(50) NOT NULL,
  `middleName` varchar(50) DEFAULT NULL,
  `lastName` varchar(50) NOT NULL,
  `dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `createdByID` int(11) DEFAULT NULL,
  `dateModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`driverID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driverID`, `driverCode`, `firstName`, `middleName`, `lastName`, `dateCreated`, `createdByID`, `dateModified`, `modifiedBy`) VALUES
(7, 'TEST001', 'Ola', 'Badru', 'Akeem', '2015-08-14 13:30:59', 3, '2015-08-14 13:31:26', 3),
(6, 'TEST002', 'Kazeem', 'Wale', 'Ade', '2015-08-14 13:30:37', 3, '2015-08-14 13:34:35', 3);

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE IF NOT EXISTS `forms` (
  `formID` int(11) NOT NULL AUTO_INCREMENT,
  `menuItemID` int(11) DEFAULT NULL,
  `formName` varchar(255) DEFAULT NULL,
  `formDescription` varchar(255) DEFAULT NULL,
  `formCode` varchar(255) DEFAULT NULL,
  `createdByID` int(11) DEFAULT NULL,
  `dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedByID` int(11) DEFAULT NULL,
  `dateModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`formID`),
  KEY `menuItemID` (`menuItemID`),
  KEY `createdByID` (`createdByID`),
  KEY `modifiedByID` (`modifiedByID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`formID`, `menuItemID`, `formName`, `formDescription`, `formCode`, `createdByID`, `dateCreated`, `modifiedByID`, `dateModified`) VALUES
(1, 3, 'Forms', 'Forms', 'form.phpa', 1, '2015-06-12 11:09:07', 3, '2015-08-09 20:11:32'),
(4, 1, 'asds', 'asd', 'asdasd bbbbb', 3, '2015-08-09 21:05:59', 3, '2015-08-09 21:06:08');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `locationID` int(11) NOT NULL AUTO_INCREMENT,
  `locationName` varchar(50) NOT NULL,
  `regionID` int(11) NOT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `createdByID` int(11) DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`locationID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`locationID`, `locationName`, `regionID`, `dateCreated`, `createdByID`, `dateModified`, `modifiedBy`) VALUES
(5, 'Ijebu Ode', 3, NULL, 3, NULL, 3),
(4, 'Ibadan', 3, NULL, 3, NULL, 3),
(6, 'Ilesha', 3, NULL, 3, NULL, 3),
(7, 'Sagamu', 3, NULL, 3, NULL, 3),
(8, 'Sango Otta', 3, NULL, 3, NULL, 3),
(9, 'Onitsha', 4, NULL, 3, NULL, 3),
(10, 'Benin', 4, NULL, 3, NULL, 3),
(11, 'Ilorin', 4, NULL, 3, NULL, 3),
(12, 'Warri', 4, NULL, 3, NULL, 3),
(13, 'Aba', 5, NULL, 3, NULL, 3),
(14, 'Abuja', 5, NULL, 3, NULL, 3),
(15, 'Enugu', 5, NULL, 3, NULL, 3),
(16, 'Ishanti', 5, NULL, 3, NULL, 3),
(17, 'Makurdi', 5, NULL, 3, NULL, 3),
(18, 'Minna', 5, NULL, 3, NULL, 3),
(19, 'Owerri', 5, NULL, 3, NULL, 3),
(20, 'Port Harcourt', 5, NULL, 3, NULL, 3),
(21, 'Uyo', 5, NULL, 3, NULL, 3),
(22, 'Gombe', 6, NULL, 3, NULL, 3),
(23, 'Kaduna', 6, NULL, 3, NULL, 3),
(24, 'Kano', 6, NULL, 3, NULL, 3),
(25, 'Skokoto', 6, NULL, 3, NULL, 3),
(26, 'Yola', 6, NULL, 3, NULL, 3),
(27, 'Agbara', 7, NULL, 3, NULL, 3),
(28, 'Ajao Shuttle', 7, NULL, 3, NULL, 3),
(29, 'Alraine', 7, NULL, 3, NULL, 3),
(30, 'Amuwo Odofin', 7, NULL, 3, NULL, 3),
(31, 'Apapa', 7, NULL, 3, NULL, 3),
(32, 'Gbagada', 7, NULL, 3, NULL, 3),
(33, 'Iganmu', 7, NULL, 3, NULL, 3),
(34, 'Ikeja', 7, NULL, 3, NULL, 3),
(35, 'Isolo', 7, NULL, 3, NULL, 3),
(36, 'Matori', 7, NULL, 3, NULL, 3),
(37, 'Mushin', 7, NULL, 3, NULL, 3),
(38, 'Ogba', 7, NULL, 3, NULL, 3),
(39, 'Oregun', 7, NULL, 3, NULL, 3),
(40, 'PZ Ilupeju', 7, NULL, 3, NULL, 3),
(41, 'Shuttle', 7, NULL, 3, NULL, 3),
(42, 'Shuttle GMT', 7, NULL, 3, NULL, 3),
(43, 'Surulere', 7, NULL, 3, NULL, 3),
(44, 'Total Kirikiri', 7, NULL, 3, NULL, 3),
(45, 'Victoria Island', 7, NULL, 3, NULL, 3),
(46, 'Wamco', 7, NULL, 3, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`user_id`, `time`) VALUES
(2, '1434035017'),
(1, '1434107036'),
(1, '1436778131'),
(1, '1438113690'),
(1, '1438113716'),
(2, '1438113744'),
(1, '1438160628'),
(3, '1439382253'),
(3, '1439253817');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `username`, `email`, `password`, `salt`) VALUES
(1, 'test_user', 'test@example.com', '00807432eae173f652f2064bdca1b61b290b52d40e429a7d295d76a71084aa96c0233b82f1feac45529e0726559645acaed6f3ae58a286b9f075916ebf66cacc', 'f9aab579fc1b41ed0c44fe4ecdbfcdb4cb99b9023abb241a6db833288f4eea3c02f76e0d35204a8695077dcf81932aa59006423976224be0390395bae152d4ef'),
(2, 'Admin', 'hefhem.ng@gmail.com', '41ae85f3a8f80c7313601a8054222514fa282ffd53c142eebb3d5e437a2170f79b4e509ccdb627838377801d823e99978d0834c39727ab4e9ac4e0216e7e964a', '9c1a24dc7da6c71b24f51d81be010031b4ad2a3d0f47f756f01da4efdd1f287e00d2bce1653a0e6750c0ebcbfe11deba290050f27ac2a3c81b4c424210a7a96b');

-- --------------------------------------------------------

--
-- Table structure for table `menuitems`
--

CREATE TABLE IF NOT EXISTS `menuitems` (
  `menuItemID` int(11) NOT NULL AUTO_INCREMENT,
  `menuID` int(11) DEFAULT NULL,
  `menuItemName` varchar(255) DEFAULT NULL,
  `menuItemDescription` varchar(255) DEFAULT NULL,
  `menuItemCode` varchar(255) DEFAULT NULL,
  `menuItemRanking` int(11) DEFAULT NULL,
  `createdByID` int(11) DEFAULT NULL,
  `dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedByID` int(11) DEFAULT NULL,
  `dateModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`menuItemID`),
  KEY `menuID` (`menuID`),
  KEY `createdByID` (`createdByID`),
  KEY `modifiedByID` (`modifiedByID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `menuitems`
--

INSERT INTO `menuitems` (`menuItemID`, `menuID`, `menuItemName`, `menuItemDescription`, `menuItemCode`, `menuItemRanking`, `createdByID`, `dateCreated`, `modifiedByID`, `dateModified`) VALUES
(1, 1, 'Form', 'Form', 'form.php', 1, 1, '2015-06-12 11:07:29', 1, '2015-06-12 11:07:29'),
(3, 2, 'Dash', 'Dash Desc', 'DSC', 1, 3, '2015-08-09 19:41:58', 3, '2015-08-09 19:41:58'),
(4, 1, 'asas', 'AS', 'ASA', 2, 3, '2015-08-10 01:46:32', 3, '2015-08-10 01:46:32'),
(5, 3, 'ssd name', 'dsfdf desc', 'sdfdsf code', 4, 3, '2015-08-10 02:40:50', 3, '2015-08-14 07:35:55'),
(6, 1, 'sdfsdf', 'sdfsdf', 'sdfsdf', 2, 3, '2015-08-10 02:41:03', 3, '2015-08-10 02:41:03'),
(7, 1, 'fdf', 'df', 'fdf', 2, 3, '2015-08-13 16:15:28', 3, '2015-08-13 16:15:28'),
(8, 3, 'cvxc', 'xcv', 'xvcx', 1, 3, '2015-08-13 16:19:50', 3, '2015-08-13 16:19:50'),
(9, 3, 'd', 'D', 'G', 7, 3, '2015-08-13 18:57:19', 3, '2015-08-13 18:57:19');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
  `menuID` int(11) NOT NULL AUTO_INCREMENT,
  `menuName` varchar(255) DEFAULT NULL,
  `menuDesc` varchar(255) DEFAULT NULL,
  `menuCode` varchar(50) DEFAULT NULL,
  `menuRanking` int(11) DEFAULT NULL,
  `createdByID` int(11) DEFAULT NULL,
  `dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedByID` int(11) DEFAULT NULL,
  `dateModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`menuID`),
  KEY `createdByID` (`createdByID`),
  KEY `modifiedByID` (`modifiedByID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menuID`, `menuName`, `menuDesc`, `menuCode`, `menuRanking`, `createdByID`, `dateCreated`, `modifiedByID`, `dateModified`) VALUES
(1, 'Administration', 'Administration', 'Administration', 2, 1, '2015-06-12 11:04:50', 1, '2015-06-12 11:04:50'),
(2, 'Dashboardz', 'Dashboardz', 'dashboard.php', 1, 1, '2015-06-12 11:06:32', 3, '2015-06-12 11:06:32'),
(3, 'a', 's', 'd', 1, 3, '2015-08-13 16:14:40', 3, '2015-08-13 16:14:40');

-- --------------------------------------------------------

--
-- Table structure for table `port`
--

CREATE TABLE IF NOT EXISTS `port` (
  `portID` int(11) NOT NULL AUTO_INCREMENT,
  `portName` varchar(50) NOT NULL,
  `locationID` int(11) NOT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `createdByID` int(11) DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`portID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `port`
--

INSERT INTO `port` (`portID`, `portName`, `locationID`, `dateCreated`, `createdByID`, `dateModified`, `modifiedBy`) VALUES
(2, 'Apapa', 31, NULL, 3, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `regionID` int(11) NOT NULL AUTO_INCREMENT,
  `regionName` varchar(50) NOT NULL,
  `dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `createdByID` int(11) DEFAULT NULL,
  `dateModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`regionID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`regionID`, `regionName`, `dateCreated`, `createdByID`, `dateModified`, `modifiedBy`) VALUES
(3, 'Region 1', '2015-08-14 13:36:06', 3, '2015-08-14 13:40:08', 3),
(4, 'Region 2', '2015-08-14 13:36:19', 3, '2015-08-14 13:40:18', 3),
(5, 'Region 3', '2015-08-14 13:36:26', 3, '2015-08-14 13:40:27', 3),
(6, 'Region 4', '2015-08-14 13:36:32', 3, '2015-08-14 13:40:51', 3),
(7, 'Local', '2015-08-14 13:37:14', 3, '2015-08-14 13:41:11', 3);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `stateID` int(11) NOT NULL AUTO_INCREMENT,
  `stateName` varchar(50) NOT NULL,
  `stateCode` varchar(10) NOT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `createdByID` int(11) DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`stateID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`stateID`, `stateName`, `stateCode`, `dateCreated`, `createdByID`, `dateModified`, `modifiedBy`) VALUES
(6, 'Adamawa', 'AD', NULL, 3, NULL, 3),
(5, 'Abia', 'AB', NULL, 3, NULL, 3),
(7, 'Akwa-Ibom', 'AK', NULL, 3, NULL, 3),
(8, 'Anambra', 'AN', NULL, 3, NULL, 3),
(9, 'Lagos', 'LA', NULL, 3, NULL, 3),
(10, 'Bauchi', 'BA', NULL, 3, NULL, 3),
(11, 'Bayelsa', 'BY', NULL, 3, NULL, 3),
(12, 'Benue', 'BE', NULL, 3, NULL, 3),
(13, 'Borno', 'BO', NULL, 3, NULL, 3),
(14, 'Cross River', 'CR', NULL, 3, NULL, 3),
(15, 'Delta', 'DE', NULL, 3, NULL, 3),
(16, 'Ebonyi', 'EB', NULL, 3, NULL, 3),
(17, 'Edo', 'ED', NULL, 3, NULL, 3),
(18, 'Ekiti', 'EK', NULL, 3, NULL, 3),
(19, 'Enugu', 'EN', NULL, 3, NULL, 3),
(20, 'FCT', 'FC', NULL, 3, NULL, 3),
(21, 'Gombe', 'GB', NULL, 3, NULL, 3),
(22, 'Imo', 'IM', NULL, 3, NULL, 3),
(23, 'Jigawa', 'JG', NULL, 3, NULL, 3),
(24, 'Kaduna', 'KD', NULL, 3, NULL, 3),
(25, 'Kano', 'KN', NULL, 3, NULL, 3),
(26, 'Katsina', 'KT', NULL, 3, NULL, 3),
(27, 'Kebbi', 'KB', NULL, 3, NULL, 3),
(28, 'Kogi', 'KG', NULL, 3, NULL, 3),
(29, 'Kwara', 'KW', NULL, 3, NULL, 3),
(30, 'Nassarawa', 'NS', NULL, 3, NULL, 3),
(31, 'Niger', 'NG', NULL, 3, NULL, 3),
(32, 'Ogun', 'OG', NULL, 3, NULL, 3),
(33, 'Ondo', 'ON', NULL, 3, NULL, 3),
(34, 'Osun', 'OS', NULL, 3, NULL, 3),
(35, 'Oyo', 'OY', NULL, 3, NULL, 3),
(36, 'Plateau', 'PL', NULL, 3, NULL, 3),
(37, 'Rivers', 'RV', NULL, 3, NULL, 3),
(38, 'Sokoto', 'SO', NULL, 3, NULL, 3),
(39, 'Taraba', 'TA', NULL, 3, NULL, 3),
(40, 'Yobe', 'YO', NULL, 3, NULL, 3),
(41, 'Zamfara', 'ZF', NULL, 3, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tdoregister`
--

CREATE TABLE IF NOT EXISTS `tdoregister` (
  `tdoRegisterID` int(11) NOT NULL AUTO_INCREMENT,
  `jobNumber` varchar(30) NOT NULL,
  `dateReceived` date NOT NULL,
  `expiryDate` date NOT NULL,
  `status` varchar(15) NOT NULL,
  `cargoTypeID` int(11) NOT NULL,
  `fileRef` varchar(50) DEFAULT NULL,
  `terminalID` int(11) DEFAULT NULL,
  `destinationID` int(11) DEFAULT NULL,
  `containerNo` varchar(15) DEFAULT NULL,
  `returnTerminal` int(11) DEFAULT NULL,
  `truckID` int(11) DEFAULT NULL,
  `tdoReceiptDate` datetime DEFAULT NULL,
  `schDelDate` datetime DEFAULT NULL,
  `loadingTime` datetime DEFAULT NULL,
  `dispatchTime` datetime DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `createdByID` int(11) DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`tdoRegisterID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `terminal`
--

CREATE TABLE IF NOT EXISTS `terminal` (
  `terminalID` int(11) NOT NULL AUTO_INCREMENT,
  `terminalName` varchar(50) NOT NULL,
  `portID` int(11) NOT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `createdByID` int(11) DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`terminalID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `terminal`
--

INSERT INTO `terminal` (`terminalID`, `terminalName`, `portID`, `dateCreated`, `createdByID`, `dateModified`, `modifiedBy`) VALUES
(2, 'APMT Apapa', 2, NULL, 3, NULL, 3),
(3, 'Bizlink Bounded Terminal', 2, NULL, 3, NULL, 3),
(4, 'CMS Bounded Terminal', 2, NULL, 3, NULL, 3),
(5, 'Grimaldi PTML', 2, NULL, 3, NULL, 3),
(6, 'Isolo', 2, NULL, 3, NULL, 3),
(7, 'Owner''s Container', 2, NULL, 3, NULL, 3),
(8, 'SCOA (F1) Kirikiri LT', 2, NULL, 3, NULL, 3),
(9, 'Service General', 2, NULL, 3, NULL, 3),
(10, 'Sifax', 2, NULL, 3, NULL, 3),
(11, 'TICT', 2, NULL, 3, NULL, 3),
(12, 'TIN CAN Port and Cargo', 2, NULL, 3, NULL, 3),
(13, 'Wamco 3', 2, NULL, 3, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `truck`
--

CREATE TABLE IF NOT EXISTS `truck` (
  `truckID` int(11) NOT NULL AUTO_INCREMENT,
  `truckName` varchar(50) NOT NULL,
  `regNumb` varchar(20) NOT NULL,
  `truckTypeID` int(11) DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `createdByID` int(11) DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`truckID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `truck`
--

INSERT INTO `truck` (`truckID`, `truckName`, `regNumb`, `truckTypeID`, `dateCreated`, `createdByID`, `dateModified`, `modifiedBy`) VALUES
(5, 'Truck 1', 'LND 89 XD', 60, NULL, 3, NULL, 3),
(6, 'Truck 2', 'FKJ 213 XB', 61, NULL, 3, NULL, 3),
(7, 'Truck 3', 'MUS 34 XN', 61, NULL, 3, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `trucktype`
--

CREATE TABLE IF NOT EXISTS `trucktype` (
  `truckTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `truckTypeName` varchar(50) NOT NULL,
  `dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `createdByID` int(11) DEFAULT NULL,
  `dateModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`truckTypeID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `trucktype`
--

INSERT INTO `trucktype` (`truckTypeID`, `truckTypeName`, `dateCreated`, `createdByID`, `dateModified`, `modifiedBy`) VALUES
(61, 'Empty', '2015-08-14 13:28:33', 3, '2015-08-14 13:28:33', 3),
(60, 'Flat', '2015-08-14 13:28:18', 3, '2015-08-14 13:28:18', 3);

-- --------------------------------------------------------

--
-- Table structure for table `usergroups`
--

CREATE TABLE IF NOT EXISTS `usergroups` (
  `userGroupID` int(11) NOT NULL AUTO_INCREMENT,
  `userGroupName` varchar(50) DEFAULT NULL,
  `userGroupDescription` varchar(255) DEFAULT NULL,
  `userGroupCode` varchar(50) DEFAULT NULL,
  `createdByID` int(11) DEFAULT NULL,
  `dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedByID` int(11) DEFAULT NULL,
  `dateModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`userGroupID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `usergroups`
--

INSERT INTO `usergroups` (`userGroupID`, `userGroupName`, `userGroupDescription`, `userGroupCode`, `createdByID`, `dateCreated`, `modifiedByID`, `dateModified`) VALUES
(1, 'Admin', 'Admin', 'Admin', 1, '2015-06-12 11:09:38', 1, '2015-06-12 11:09:38'),
(5, 'Test', 'Form', 'TFM...', 3, '2015-08-12 14:45:23', 3, '2015-08-12 14:45:23'),
(3, 'Hef', 'Hem', 'Lala', 3, '2015-08-11 10:42:39', 3, '2015-08-11 10:42:39'),
(4, 'Adfhh', 'ffghh', 'Hhfgh gggg bbb', 3, '2015-08-11 10:52:59', 3, '2015-08-11 10:52:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(50) DEFAULT NULL,
  `userPassword` char(128) DEFAULT NULL,
  `salt` char(128) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `userGroupID` int(11) DEFAULT NULL,
  `pwdCanExpire` bit(1) DEFAULT NULL,
  `pwdExpiryDate` datetime DEFAULT NULL,
  `isLocked` bit(1) DEFAULT NULL,
  `lastLoginDate` datetime DEFAULT NULL,
  `resetPassword` bit(1) DEFAULT NULL,
  `isDeleted` bit(1) DEFAULT NULL,
  `createdByID` int(11) DEFAULT NULL,
  `dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedByID` int(11) DEFAULT NULL,
  `dateModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`userID`),
  KEY `userGroupID` (`userGroupID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userName`, `userPassword`, `salt`, `email`, `userGroupID`, `pwdCanExpire`, `pwdExpiryDate`, `isLocked`, `lastLoginDate`, `resetPassword`, `isDeleted`, `createdByID`, `dateCreated`, `modifiedByID`, `dateModified`) VALUES
(1, 'Admin', '41ae85f3a8f80c7313601a8054222514fa282ffd53c142eebb3d5e437a2170f79b4e509ccdb627838377801d823e99978d0834c39727ab4e9ac4e0216e7e964a', '9c1a24dc7da6c71b24f51d81be010031b4ad2a3d0f47f756f01da4efdd1f287e00d2bce1653a0e6750c0ebcbfe11deba290050f27ac2a3c81b4c424210a7a96b', 'hefhem.ng@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-06-12 11:01:59', NULL, '2015-06-12 11:01:59'),
(2, 'hefhem', '2aaba45d254bccc7a1c9cb0bb4893c80e07cb428a76937ff5d639a790357185e62a59bca0f4c518cfc977a6f8aa1e27b0ea53945fe962a0f98f02f67843e47f8', '575c7667fef2d6ff7fff9ed95b5cd3f66a863597835d121bac584587b59b472daf9fc1cedaadcbd98e8051331ec3968c7f5ab7d54c086328f51883f06086246d', 'adekunleoa@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-06-19 02:32:18', NULL, '2015-06-19 02:32:18'),
(3, 'asdf', 'fcf081a78b4c61244b76e8fb8b83e055e84a61a5c5f9d62ab88a3dd38861d5514f34920da169c1a7392cc6f2feb6b344ee53983db8bbe45841f26a788fe85ba0', '642dbf238fec77d7f29267800c642febf60bec48e9dad948fdf42ed6aaa846ae89ad25e3a68e189a8e31811c7b003a1817a4679b482fa9ddc69ea8e1b7145699', 'asdf@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-07-29 01:30:30', NULL, '2015-07-29 01:30:30');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
