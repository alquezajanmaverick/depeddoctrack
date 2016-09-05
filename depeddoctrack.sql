-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.11 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for depeddoctracking
DROP DATABASE IF EXISTS `depeddoctracking`;
CREATE DATABASE IF NOT EXISTS `depeddoctracking` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `depeddoctracking`;


-- Dumping structure for procedure depeddoctracking.addappointee
DROP PROCEDURE IF EXISTS `addappointee`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `addappointee`(IN `itemno` VARCHAR(50), IN `name` VARCHAR(50), IN `position` VARCHAR(50), IN `dateinformed` DATE, IN `reply` VARCHAR(50))
BEGIN
INSERT INTO `tblappointee`(`itemno`, `name`, `position`, `dateinformed`, `reply`) VALUES (itemno,name,position,dateinformed,reply);
INSERT INTO `tblcongratulatory`(`itemno`)VALUES(itemno);
INSERT INTO `tblprocess`(`itemno`)VALUES(itemno);
INSERT INTO `tblremarks`(`itemno`)VALUES(itemno);
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.deleteappointee
DROP PROCEDURE IF EXISTS `deleteappointee`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteappointee`(IN `mykey` VARCHAR(50))
BEGIN
	DELETE FROM `tblappointee` WHERE `itemno` = mykey limit 1;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.editappointee
DROP PROCEDURE IF EXISTS `editappointee`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `editappointee`(IN `itemkey` VARCHAR(50), IN `olditemkey` VARCHAR(50), IN `namekey` VARCHAR(50), IN `positionkey` VARCHAR(50), IN `datekey` VARCHAR(50), IN `replykey` VARCHAR(50))
BEGIN
	UPDATE `tblappointee` SET `itemno`=itemkey,`name`=namekey,`position`=positionkey,`dateinformed`=datekey,`reply`=replykey WHERE `itemno` = olditemkey ;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.fetchappointee
DROP PROCEDURE IF EXISTS `fetchappointee`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchappointee`()
    COMMENT 'fetch all tblappointee data'
BEGIN
	SELECT * from tblappointee;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.fetchpositions
DROP PROCEDURE IF EXISTS `fetchpositions`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchpositions`()
    COMMENT 'fetch all tblposition data'
BEGIN
	SELECT * from tblpositions;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.fetchsingleappointee
DROP PROCEDURE IF EXISTS `fetchsingleappointee`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchsingleappointee`(IN `myKey` VARCHAR(50))
BEGIN
	SELECT * from tblappointee where `itemno` = mykey limit 1;
END//
DELIMITER ;


-- Dumping structure for table depeddoctracking.tblappointee
DROP TABLE IF EXISTS `tblappointee`;
CREATE TABLE IF NOT EXISTS `tblappointee` (
  `itemno` varchar(50) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `dateinformed` date DEFAULT NULL,
  `reply` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`itemno`),
  KEY `position` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table depeddoctracking.tblappointee: ~1 rows (approximately)
/*!40000 ALTER TABLE `tblappointee` DISABLE KEYS */;
INSERT IGNORE INTO `tblappointee` (`itemno`, `name`, `position`, `dateinformed`, `reply`) VALUES
	('123', 'asd', 'asd', '2016-09-05', 'asdasd');
/*!40000 ALTER TABLE `tblappointee` ENABLE KEYS */;


-- Dumping structure for table depeddoctracking.tblcongratulatory
DROP TABLE IF EXISTS `tblcongratulatory`;
CREATE TABLE IF NOT EXISTS `tblcongratulatory` (
  `itemno` varchar(50) NOT NULL,
  `isHRMO` varchar(5) NOT NULL DEFAULT 'NO',
  `hrmodate` date DEFAULT NULL,
  `isSDS` varchar(5) NOT NULL DEFAULT 'NO',
  `SDSdate` date DEFAULT NULL,
  `duedate` date DEFAULT NULL,
  KEY `itemno` (`itemno`),
  CONSTRAINT `itemno` FOREIGN KEY (`itemno`) REFERENCES `tblappointee` (`itemno`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table depeddoctracking.tblcongratulatory: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblcongratulatory` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblcongratulatory` ENABLE KEYS */;


-- Dumping structure for table depeddoctracking.tblpositions
DROP TABLE IF EXISTS `tblpositions`;
CREATE TABLE IF NOT EXISTS `tblpositions` (
  `itemno` varchar(150) NOT NULL,
  `position` varchar(50) NOT NULL,
  `positioncategory` varchar(50) NOT NULL,
  `schoollevel` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `schoolid` varchar(150) NOT NULL,
  `schoolname` varchar(150) NOT NULL,
  PRIMARY KEY (`itemno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table depeddoctracking.tblpositions: 0 rows
/*!40000 ALTER TABLE `tblpositions` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblpositions` ENABLE KEYS */;


-- Dumping structure for table depeddoctracking.tblprocess
DROP TABLE IF EXISTS `tblprocess`;
CREATE TABLE IF NOT EXISTS `tblprocess` (
  `itemno` varchar(50) DEFAULT NULL,
  `isHRMO` varchar(5) DEFAULT 'NO',
  `hrmodate` date DEFAULT NULL,
  `isBO` varchar(5) NOT NULL DEFAULT 'NO',
  `bodatereceived` date DEFAULT NULL,
  `bodatereleased` date DEFAULT NULL,
  `isSGOD` varchar(5) NOT NULL DEFAULT 'NO',
  `sgoddatereceived` date DEFAULT NULL,
  `sgoddatereleased` date DEFAULT NULL,
  `isASDS` varchar(5) NOT NULL DEFAULT 'NO',
  `asdsdatereceived` date DEFAULT NULL,
  `asdsdatereleased` date DEFAULT NULL,
  `isSDS` varchar(5) NOT NULL DEFAULT 'NO',
  `sdsdatereceived` date DEFAULT NULL,
  `sdsdatereleased` date DEFAULT NULL,
  KEY `itemno1` (`itemno`),
  CONSTRAINT `itemno1` FOREIGN KEY (`itemno`) REFERENCES `tblappointee` (`itemno`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table depeddoctracking.tblprocess: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblprocess` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblprocess` ENABLE KEYS */;


-- Dumping structure for table depeddoctracking.tblremarks
DROP TABLE IF EXISTS `tblremarks`;
CREATE TABLE IF NOT EXISTS `tblremarks` (
  `itemno` varchar(50) NOT NULL,
  `effectivity` varchar(50) DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL,
  KEY `itemno2` (`itemno`),
  CONSTRAINT `itemno2` FOREIGN KEY (`itemno`) REFERENCES `tblappointee` (`itemno`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table depeddoctracking.tblremarks: ~0 rows (approximately)
/*!40000 ALTER TABLE `tblremarks` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblremarks` ENABLE KEYS */;


-- Dumping structure for table depeddoctracking.tblusers
DROP TABLE IF EXISTS `tblusers`;
CREATE TABLE IF NOT EXISTS `tblusers` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(150) NOT NULL,
  `Password` varchar(150) NOT NULL,
  `Privilege` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table depeddoctracking.tblusers: ~2 rows (approximately)
/*!40000 ALTER TABLE `tblusers` DISABLE KEYS */;
INSERT IGNORE INTO `tblusers` (`userID`, `UserName`, `Password`, `Privilege`) VALUES
	(1, 'HRMO', 'hrmo', 'HRMO'),
	(2, 'SGOD', 'sgod', 'SGOD');
/*!40000 ALTER TABLE `tblusers` ENABLE KEYS */;


-- Dumping structure for trigger depeddoctracking.fillposition
DROP TRIGGER IF EXISTS `fillposition`;
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER';
DELIMITER //
CREATE TRIGGER `fillposition` AFTER INSERT ON `tblappointee` FOR EACH ROW BEGIN
	DELETE from tblpositions WHERE position = new.position limit 1;
	INSERT into tblcongratulatory(`itemno`)VALUES(NEW.itemno);
	INSERT into tblprocess(`itemno`)VALUES(NEW.itemno);
	INSERT into tblremarks(`itemno`)VALUES(NEW.itemno);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
