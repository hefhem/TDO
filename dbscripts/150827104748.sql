/*
MySQL Backup
Source Server Version: 5.6.17
Source Database: tdo
Date: 27/08/2015 10:47:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
--  Table structure for `accesslevels`
-- ----------------------------
DROP TABLE IF EXISTS `accesslevels`;
CREATE TABLE `accesslevels` (
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
  KEY `modifiedByID` (`modifiedByID`),
  CONSTRAINT `accesslevels_ibfk_1` FOREIGN KEY (`userGroupID`) REFERENCES `usergroups` (`userGroupID`),
  CONSTRAINT `accesslevels_ibfk_2` FOREIGN KEY (`formID`) REFERENCES `forms` (`FormID`),
  CONSTRAINT `accesslevels_ibfk_3` FOREIGN KEY (`createdByID`) REFERENCES `users` (`userID`),
  CONSTRAINT `accesslevels_ibfk_4` FOREIGN KEY (`modifiedByID`) REFERENCES `users` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `cargotype`
-- ----------------------------
DROP TABLE IF EXISTS `cargotype`;
CREATE TABLE `cargotype` (
  `cargoTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `cargoTypeName` varchar(50) NOT NULL,
  `dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `createdByID` int(11) DEFAULT NULL,
  `dateModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`cargoTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `city`
-- ----------------------------
DROP TABLE IF EXISTS `city`;
CREATE TABLE `city` (
  `cityID` int(11) NOT NULL AUTO_INCREMENT,
  `cityName` varchar(50) NOT NULL,
  `cityCode` varchar(10) DEFAULT NULL,
  `stateID` int(11) NOT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `createdByID` int(11) DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`cityID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `despatchregister`
-- ----------------------------
DROP TABLE IF EXISTS `despatchregister`;
CREATE TABLE `despatchregister` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `driver`
-- ----------------------------
DROP TABLE IF EXISTS `driver`;
CREATE TABLE `driver` (
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `forms`
-- ----------------------------
DROP TABLE IF EXISTS `forms`;
CREATE TABLE `forms` (
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
  KEY `modifiedByID` (`modifiedByID`),
  CONSTRAINT `forms_ibfk_1` FOREIGN KEY (`menuItemID`) REFERENCES `menuitems` (`menuItemID`),
  CONSTRAINT `forms_ibfk_2` FOREIGN KEY (`createdByID`) REFERENCES `users` (`userID`),
  CONSTRAINT `forms_ibfk_3` FOREIGN KEY (`modifiedByID`) REFERENCES `users` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `location`
-- ----------------------------
DROP TABLE IF EXISTS `location`;
CREATE TABLE `location` (
  `locationID` int(11) NOT NULL AUTO_INCREMENT,
  `locationName` varchar(50) NOT NULL,
  `regionID` int(11) NOT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `createdByID` int(11) DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`locationID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `login_attempts`
-- ----------------------------
DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE `login_attempts` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `members`
-- ----------------------------
DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `menuitems`
-- ----------------------------
DROP TABLE IF EXISTS `menuitems`;
CREATE TABLE `menuitems` (
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
  KEY `modifiedByID` (`modifiedByID`),
  CONSTRAINT `menuitems_ibfk_1` FOREIGN KEY (`menuID`) REFERENCES `menus` (`menuID`),
  CONSTRAINT `menuitems_ibfk_2` FOREIGN KEY (`createdByID`) REFERENCES `users` (`userID`),
  CONSTRAINT `menuitems_ibfk_3` FOREIGN KEY (`modifiedByID`) REFERENCES `users` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `menus`
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
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
  KEY `modifiedByID` (`modifiedByID`),
  CONSTRAINT `menus_ibfk_1` FOREIGN KEY (`createdByID`) REFERENCES `users` (`userID`),
  CONSTRAINT `menus_ibfk_2` FOREIGN KEY (`modifiedByID`) REFERENCES `users` (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `port`
-- ----------------------------
DROP TABLE IF EXISTS `port`;
CREATE TABLE `port` (
  `portID` int(11) NOT NULL AUTO_INCREMENT,
  `portName` varchar(50) NOT NULL,
  `locationID` int(11) NOT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `createdByID` int(11) DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`portID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `region`
-- ----------------------------
DROP TABLE IF EXISTS `region`;
CREATE TABLE `region` (
  `regionID` int(11) NOT NULL AUTO_INCREMENT,
  `regionName` varchar(50) NOT NULL,
  `dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `createdByID` int(11) DEFAULT NULL,
  `dateModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`regionID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `state`
-- ----------------------------
DROP TABLE IF EXISTS `state`;
CREATE TABLE `state` (
  `stateID` int(11) NOT NULL AUTO_INCREMENT,
  `stateName` varchar(50) NOT NULL,
  `stateCode` varchar(10) NOT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `createdByID` int(11) DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`stateID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `tdoregister`
-- ----------------------------
DROP TABLE IF EXISTS `tdoregister`;
CREATE TABLE `tdoregister` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `terminal`
-- ----------------------------
DROP TABLE IF EXISTS `terminal`;
CREATE TABLE `terminal` (
  `terminalID` int(11) NOT NULL AUTO_INCREMENT,
  `terminalName` varchar(50) NOT NULL,
  `portID` int(11) NOT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `createdByID` int(11) DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`terminalID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `truck`
-- ----------------------------
DROP TABLE IF EXISTS `truck`;
CREATE TABLE `truck` (
  `truckID` int(11) NOT NULL AUTO_INCREMENT,
  `truckName` varchar(50) NOT NULL,
  `regNumb` varchar(20) NOT NULL,
  `truckTypeID` int(11) DEFAULT NULL,
  `dateCreated` datetime DEFAULT NULL,
  `createdByID` int(11) DEFAULT NULL,
  `dateModified` datetime DEFAULT NULL,
  `modifiedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`truckID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `trucktype`
-- ----------------------------
DROP TABLE IF EXISTS `trucktype`;
CREATE TABLE `trucktype` (
  `truckTypeID` int(11) NOT NULL AUTO_INCREMENT,
  `truckTypeName` varchar(50) NOT NULL,
  `dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `createdByID` int(11) DEFAULT NULL,
  `dateModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`truckTypeID`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `usergroups`
-- ----------------------------
DROP TABLE IF EXISTS `usergroups`;
CREATE TABLE `usergroups` (
  `userGroupID` int(11) NOT NULL AUTO_INCREMENT,
  `userGroupName` varchar(50) DEFAULT NULL,
  `userGroupDescription` varchar(255) DEFAULT NULL,
  `userGroupCode` varchar(50) DEFAULT NULL,
  `createdByID` int(11) DEFAULT NULL,
  `dateCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedByID` int(11) DEFAULT NULL,
  `dateModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`userGroupID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
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
  KEY `userGroupID` (`userGroupID`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`userGroupID`) REFERENCES `usergroups` (`userGroupID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
--  Procedure definition for `getCargoType`
-- ----------------------------
DROP PROCEDURE IF EXISTS `getCargoType`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getCargoType`()
BEGIN
	#Routine body goes here...
		
	SELECT cargoTypeID, cargoTypeName, dateCreated, createdByID, dateModified, modifiedBy FROM cargotype;

END;;
DELIMITER ;

-- ----------------------------
--  Procedure definition for `getDriver000`
-- ----------------------------
DROP PROCEDURE IF EXISTS `getDriver000`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getDriver000`()
BEGIN
	#Routine body goes here...
		
	SELECT driverID, driverCode, firstName, middleName, lastName, dateCreated, createdByID, dateModified, modifiedBy FROM driver;

END;;
DELIMITER ;

-- ----------------------------
--  Procedure definition for `getRegion`
-- ----------------------------
DROP PROCEDURE IF EXISTS `getRegion`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getRegion`()
BEGIN
	#Routine body goes here...
		
	SELECT regionID, regionName, dateCreated, createdByID, dateModified, modifiedBy FROM region;

END;;
DELIMITER ;

-- ----------------------------
--  Procedure definition for `getTruckType000`
-- ----------------------------
DROP PROCEDURE IF EXISTS `getTruckType000`;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `getTruckType000`()
BEGIN
	#Routine body goes here...
		
	SELECT truckTypeID, truckTypeName, dateCreated, createdByID, dateModified, modifiedBy FROM trucktype;

END;;
DELIMITER ;

-- ----------------------------
--  Records 
-- ----------------------------
INSERT INTO `accesslevels` VALUES ('1','1','1','','','','','','1','2015-06-12 07:10:05','1','2015-06-12 07:10:05');
INSERT INTO `cargotype` VALUES ('20','40 by 100 ft 22d','2015-07-29 20:25:17','1','2015-08-02 03:09:30','3'), ('23','70 by 20 ft','2015-07-29 21:16:49','1','2015-08-02 01:38:50','3'), ('24','A','2015-08-06 22:35:47','3','2015-08-06 22:35:47','3'), ('25','B','2015-08-06 22:36:10','3','2015-08-06 22:36:10','3'), ('26','c','2015-08-08 11:58:52','3','2015-08-08 11:58:52','3');
INSERT INTO `city` VALUES ('1','A','S','1',NULL,'3',NULL,'3');
INSERT INTO `driver` VALUES ('1','ccccccc','aaaaa','ssss','ddddd',NULL,NULL,NULL,NULL), ('3','HFGH','FGHH','HFGH','GH','2015-08-08 20:49:10','3','2015-08-08 20:49:10','3');
INSERT INTO `forms` VALUES ('1','3','Forms','Forms','form.phpa','1','2015-06-12 07:09:07','3','2015-08-09 16:11:32'), ('4','1','asds','asd','asdasd bbbbb','3','2015-08-09 17:05:59','3','2015-08-09 17:06:08');
INSERT INTO `location` VALUES ('1','dsads','1',NULL,'3',NULL,'3'), ('2','dfgdg','1',NULL,'3',NULL,'3');
INSERT INTO `login_attempts` VALUES ('2','1434035017'), ('1','1434107036'), ('1','1436778131'), ('1','1438113690'), ('1','1438113716'), ('2','1438113744'), ('1','1438160628'), ('3','1438471337'), ('3','1438675924'), ('3','1438784974'), ('3','1438784974'), ('3','1438784984'), ('3','1438784984');
INSERT INTO `members` VALUES ('1','test_user','test@example.com','00807432eae173f652f2064bdca1b61b290b52d40e429a7d295d76a71084aa96c0233b82f1feac45529e0726559645acaed6f3ae58a286b9f075916ebf66cacc','f9aab579fc1b41ed0c44fe4ecdbfcdb4cb99b9023abb241a6db833288f4eea3c02f76e0d35204a8695077dcf81932aa59006423976224be0390395bae152d4ef'), ('2','Admin','hefhem.ng@gmail.com','41ae85f3a8f80c7313601a8054222514fa282ffd53c142eebb3d5e437a2170f79b4e509ccdb627838377801d823e99978d0834c39727ab4e9ac4e0216e7e964a','9c1a24dc7da6c71b24f51d81be010031b4ad2a3d0f47f756f01da4efdd1f287e00d2bce1653a0e6750c0ebcbfe11deba290050f27ac2a3c81b4c424210a7a96b');
INSERT INTO `menuitems` VALUES ('1','1','Form','Form','form.php','1','1','2015-06-12 07:07:29','1','2015-06-12 07:07:29'), ('3','2','Dash','Dash Desc','DSC','1','3','2015-08-09 15:41:58','3','2015-08-09 15:41:58'), ('4','1','asas','AS','ASA','2','3','2015-08-09 21:46:32','3','2015-08-09 21:46:32'), ('5','2','ssd','dsfdf','sdfdsf','3','3','2015-08-09 22:40:50','3','2015-08-10 22:01:19'), ('6','1','sdfsdf','sdfsdf','sdfsdf','2','3','2015-08-09 22:41:03','3','2015-08-09 22:41:03');
INSERT INTO `menus` VALUES ('1','Administration','Administration','Administration','2','1','2015-06-12 07:04:50','1','2015-06-12 07:04:50'), ('2','Dashboardz','Dashboardz','dashboard.php','1','1','2015-06-12 07:06:32','3','2015-06-12 07:06:32');
INSERT INTO `region` VALUES ('1','A','2015-08-08 11:59:15','3','2015-08-08 16:18:15','3');
INSERT INTO `state` VALUES ('1','A','S',NULL,'3',NULL,'3'), ('2','a','a',NULL,'3',NULL,'3');
INSERT INTO `truck` VALUES ('1','sdsd','sdasd','47',NULL,'3',NULL,'3');
INSERT INTO `trucktype` VALUES ('47','Type 1','2015-08-02 12:43:23','3','2015-08-03 08:00:22','3'), ('48','Type 2','2015-08-02 12:43:31','3','2015-08-02 12:43:31','3'), ('49','Type 3s','2015-08-02 12:43:38','3','2015-08-08 20:08:45','3'), ('57','gjh','2015-08-08 20:55:41','3','2015-08-08 20:55:41','3'), ('58','ssadsd','2015-08-08 21:39:13','3','2015-08-08 21:39:13','3');
INSERT INTO `usergroups` VALUES ('1','Admin','Admin','Admin','1','2015-06-12 07:09:38','1','2015-06-12 07:09:38'), ('2','a','s','asdf','3','2015-08-08 23:02:59','3','2015-08-08 23:02:59');
INSERT INTO `users` VALUES ('1','Admin','41ae85f3a8f80c7313601a8054222514fa282ffd53c142eebb3d5e437a2170f79b4e509ccdb627838377801d823e99978d0834c39727ab4e9ac4e0216e7e964a','9c1a24dc7da6c71b24f51d81be010031b4ad2a3d0f47f756f01da4efdd1f287e00d2bce1653a0e6750c0ebcbfe11deba290050f27ac2a3c81b4c424210a7a96b','hefhem.ng@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-06-12 07:01:59',NULL,'2015-06-12 07:01:59'), ('2','hefhem','2aaba45d254bccc7a1c9cb0bb4893c80e07cb428a76937ff5d639a790357185e62a59bca0f4c518cfc977a6f8aa1e27b0ea53945fe962a0f98f02f67843e47f8','575c7667fef2d6ff7fff9ed95b5cd3f66a863597835d121bac584587b59b472daf9fc1cedaadcbd98e8051331ec3968c7f5ab7d54c086328f51883f06086246d','adekunleoa@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-06-18 22:32:18',NULL,'2015-06-18 22:32:18'), ('3','asdf','fcf081a78b4c61244b76e8fb8b83e055e84a61a5c5f9d62ab88a3dd38861d5514f34920da169c1a7392cc6f2feb6b344ee53983db8bbe45841f26a788fe85ba0','642dbf238fec77d7f29267800c642febf60bec48e9dad948fdf42ed6aaa846ae89ad25e3a68e189a8e31811c7b003a1817a4679b482fa9ddc69ea8e1b7145699','asdf@yahoo.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2015-07-28 21:30:30',NULL,'2015-07-28 21:30:30');
