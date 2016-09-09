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

-- Dumping structure for procedure depeddoctracking.addappointee
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `addappointee`(IN `itemno` VARCHAR(50), IN `name` VARCHAR(50), IN `position` VARCHAR(50), IN `dateinformed` DATE, IN `reply` VARCHAR(50))
BEGIN
INSERT INTO `tblappointee`(`itemno`, `name`, `position`, `dateinformed`, `reply`) VALUES (itemno,name,position,dateinformed,reply);
INSERT INTO `tblcongratulatory`(`itemno`)VALUES(itemno);
INSERT INTO `tblprocess`(`itemno`)VALUES(itemno);
INSERT INTO `tblremarks`(`itemno`)VALUES(itemno);
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.AppointeeProgress
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `AppointeeProgress`()
BEGIN
	SELECT *
	FROM tblappointee as tbl1
	LEFT JOIN tblcongratulatory as tbl2
	ON tbl1.itemno=tbl2.itemno
	LEFT JOIN tblprocess as tbl3
	ON tbl1.itemno=tbl3.itemno
	LEFT JOIN tblremarks as tbl4
	ON tbl1.itemno=tbl4.itemno;
	/** WHERE tbl1.itemno = 222;
	**/
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.deleteappointee
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteappointee`(IN `mykey` VARCHAR(50))
BEGIN
	DELETE FROM `tblappointee` WHERE `itemno` = mykey limit 1;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.editappointee
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `editappointee`(IN `itemkey` VARCHAR(50), IN `olditemkey` VARCHAR(50), IN `namekey` VARCHAR(50), IN `positionkey` VARCHAR(50), IN `datekey` VARCHAR(50), IN `replykey` VARCHAR(50))
BEGIN
	UPDATE `tblappointee` SET `itemno`=itemkey,`name`=namekey,`position`=positionkey,`dateinformed`=datekey,`reply`=replykey WHERE `itemno` = olditemkey ;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.fetchappointee
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchappointee`()
    COMMENT 'fetch all tblappointee data'
BEGIN
	SELECT * from tblappointee;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.fetchcongratulatory
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchcongratulatory`(IN `xitem` VARCHAR(50))
BEGIN
	SELECT * from tblcongratulatory as c
	LEFT JOIN tblremarks as r
	on
	c.itemno = r.itemno
	WHERE c.itemno = xitem;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.fetchforSDS
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchforSDS`()
BEGIN
	SELECT * from tblcongratulatory as c
	LEFT JOIN tblappointee as a
	on c.itemno = a.itemno
	where c.isSDS LIKE 'YES' AND c.ok like 'NO';
	
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.fetchpositions
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchpositions`()
    COMMENT 'fetch all tblposition data'
BEGIN
	SELECT * from tblpositions;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.fetchsingleappointee
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchsingleappointee`(IN `myKey` VARCHAR(50))
BEGIN
	SELECT * from tblappointee where `itemno` = mykey limit 1;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.marksds
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `marksds`(IN `ddate` DATE, IN `item` VARCHAR(50))
BEGIN
	UPDATE `tblcongratulatory` SET `SDSreleaseddate`=ddate,`ok`='YES' WHERE `itemno` = item limit 1;
END//
DELIMITER ;


-- Dumping structure for table depeddoctracking.tblappointee
CREATE TABLE IF NOT EXISTS `tblappointee` (
  `itemno` varchar(50) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `dateinformed` date DEFAULT NULL,
  `reply` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`itemno`),
  KEY `position` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table depeddoctracking.tblappointee: ~4 rows (approximately)
DELETE FROM `tblappointee`;
/*!40000 ALTER TABLE `tblappointee` DISABLE KEYS */;
INSERT INTO `tblappointee` (`itemno`, `name`, `position`, `dateinformed`, `reply`) VALUES
	('111', 'Jose', 'asd', '2016-09-28', 'CONFIRMED'),
	('112', 'asd', 'asds', '2016-09-30', 'CONFIRMED'),
	('1123', 'TEST', 'Principal 1', '2016-09-30', 'CONFIRMED'),
	('222', 'asd', 'asd', '2016-09-23', 'WAIVED');
/*!40000 ALTER TABLE `tblappointee` ENABLE KEYS */;


-- Dumping structure for table depeddoctracking.tblappointeeprogress
CREATE TABLE IF NOT EXISTS `tblappointeeprogress` (
  `itemno` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT '0',
  `progress` tinyint(4) DEFAULT '0',
  KEY `itemno` (`itemno`),
  CONSTRAINT `itemprogress` FOREIGN KEY (`itemno`) REFERENCES `tblappointee` (`itemno`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='progressbar on front end';

-- Dumping data for table depeddoctracking.tblappointeeprogress: ~4 rows (approximately)
DELETE FROM `tblappointeeprogress`;
/*!40000 ALTER TABLE `tblappointeeprogress` DISABLE KEYS */;
INSERT INTO `tblappointeeprogress` (`itemno`, `name`, `progress`) VALUES
	('222', 'asd', 0),
	('111', 'Jose', 0),
	('112', 'asd', 0),
	('1123', 'TEST', 0);
/*!40000 ALTER TABLE `tblappointeeprogress` ENABLE KEYS */;


-- Dumping structure for table depeddoctracking.tblcongratulatory
CREATE TABLE IF NOT EXISTS `tblcongratulatory` (
  `itemno` varchar(50) NOT NULL,
  `hrmodate` date DEFAULT NULL,
  `isSDS` varchar(5) NOT NULL DEFAULT 'NO',
  `duedate` date DEFAULT NULL,
  `SDSreleaseddate` date DEFAULT NULL,
  `ok` char(50) DEFAULT 'NO',
  UNIQUE KEY `itemno` (`itemno`),
  CONSTRAINT `itemno` FOREIGN KEY (`itemno`) REFERENCES `tblappointee` (`itemno`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table depeddoctracking.tblcongratulatory: ~4 rows (approximately)
DELETE FROM `tblcongratulatory`;
/*!40000 ALTER TABLE `tblcongratulatory` DISABLE KEYS */;
INSERT INTO `tblcongratulatory` (`itemno`, `hrmodate`, `isSDS`, `duedate`, `SDSreleaseddate`, `ok`) VALUES
	('111', '2016-09-12', 'YES', '2016-09-20', '2016-09-28', 'YES'),
	('112', NULL, 'NO', NULL, NULL, 'NO'),
	('1123', '2016-09-21', 'YES', '2016-09-13', '2016-09-09', 'YES'),
	('222', '2016-09-23', 'YES', '2016-09-20', '2016-09-24', 'YES');
/*!40000 ALTER TABLE `tblcongratulatory` ENABLE KEYS */;


-- Dumping structure for table depeddoctracking.tblpositions
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
DELETE FROM `tblpositions`;
/*!40000 ALTER TABLE `tblpositions` DISABLE KEYS */;
/*!40000 ALTER TABLE `tblpositions` ENABLE KEYS */;


-- Dumping structure for table depeddoctracking.tblprocess
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

-- Dumping data for table depeddoctracking.tblprocess: ~7 rows (approximately)
DELETE FROM `tblprocess`;
/*!40000 ALTER TABLE `tblprocess` DISABLE KEYS */;
INSERT INTO `tblprocess` (`itemno`, `isHRMO`, `hrmodate`, `isBO`, `bodatereceived`, `bodatereleased`, `isSGOD`, `sgoddatereceived`, `sgoddatereleased`, `isASDS`, `asdsdatereceived`, `asdsdatereleased`, `isSDS`, `sdsdatereceived`, `sdsdatereleased`) VALUES
	('222', 'NO', NULL, 'NO', NULL, NULL, 'NO', NULL, NULL, 'NO', NULL, NULL, 'NO', NULL, NULL),
	('222', 'NO', NULL, 'NO', NULL, NULL, 'NO', NULL, NULL, 'NO', NULL, NULL, 'NO', NULL, NULL),
	('111', 'NO', NULL, 'NO', NULL, NULL, 'NO', NULL, NULL, 'NO', NULL, NULL, 'NO', NULL, NULL),
	('111', 'NO', NULL, 'NO', NULL, NULL, 'NO', NULL, NULL, 'NO', NULL, NULL, 'NO', NULL, NULL),
	('112', 'NO', NULL, 'NO', NULL, NULL, 'NO', NULL, NULL, 'NO', NULL, NULL, 'NO', NULL, NULL),
	('112', 'NO', NULL, 'NO', NULL, NULL, 'NO', NULL, NULL, 'NO', NULL, NULL, 'NO', NULL, NULL),
	('1123', 'NO', NULL, 'NO', NULL, NULL, 'NO', NULL, NULL, 'NO', NULL, NULL, 'NO', NULL, NULL);
/*!40000 ALTER TABLE `tblprocess` ENABLE KEYS */;


-- Dumping structure for table depeddoctracking.tblremarks
CREATE TABLE IF NOT EXISTS `tblremarks` (
  `itemno` varchar(50) NOT NULL,
  `effectivity` text,
  `remarks` varchar(50) DEFAULT NULL,
  KEY `itemno2` (`itemno`),
  CONSTRAINT `itemno2` FOREIGN KEY (`itemno`) REFERENCES `tblappointee` (`itemno`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table depeddoctracking.tblremarks: ~7 rows (approximately)
DELETE FROM `tblremarks`;
/*!40000 ALTER TABLE `tblremarks` DISABLE KEYS */;
INSERT INTO `tblremarks` (`itemno`, `effectivity`, `remarks`) VALUES
	('222', 'asdasd111', 'Complete and Received'),
	('222', NULL, NULL),
	('111', 'asd', 'Returned for Compliance'),
	('111', NULL, NULL),
	('112', NULL, NULL),
	('112', NULL, NULL),
	('1123', 'asd', 'Returned for Compliance');
/*!40000 ALTER TABLE `tblremarks` ENABLE KEYS */;


-- Dumping structure for table depeddoctracking.tblusers
CREATE TABLE IF NOT EXISTS `tblusers` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(150) NOT NULL,
  `Password` varchar(150) NOT NULL,
  `Privilege` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table depeddoctracking.tblusers: ~2 rows (approximately)
DELETE FROM `tblusers`;
/*!40000 ALTER TABLE `tblusers` DISABLE KEYS */;
INSERT INTO `tblusers` (`userID`, `UserName`, `Password`, `Privilege`) VALUES
	(1, 'HRMO', 'hrmo', 'HRMO'),
	(2, 'SGOD', 'sgod', 'SGOD'),
	(3, 'SDS', 'sds', 'SDS');
/*!40000 ALTER TABLE `tblusers` ENABLE KEYS */;


-- Dumping structure for procedure depeddoctracking.updateCongratulatory
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateCongratulatory`(IN `datereleased` DATE, IN `releasedtoSDS` CHAR(50), IN `xduedate` DATE, IN `xitem` VARCHAR(50), IN `effectivity` TEXT, IN `remarks` CHAR(50))
BEGIN
	UPDATE `tblcongratulatory` SET `hrmodate`=datereleased,`isSDS`=releasedtoSDS,`duedate`=xduedate WHERE `itemno`=xitem limit 1;
	UPDATE `tblremarks` SET `effectivity`=effectivity,`remarks`= remarks WHERE `itemno`=xitem limit 1;
END//
DELIMITER ;


-- Dumping structure for trigger depeddoctracking.fillposition
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER';
DELIMITER //
CREATE TRIGGER `fillposition` AFTER INSERT ON `tblappointee` FOR EACH ROW BEGIN
	DELETE from tblpositions WHERE position = new.position limit 1;
	INSERT into tblcongratulatory(`itemno`)VALUES(NEW.itemno);
	INSERT into tblprocess(`itemno`)VALUES(NEW.itemno);
	INSERT into tblremarks(`itemno`)VALUES(NEW.itemno);
	INSERT into tblappointeeprogress(`itemno`,`name`)VALUES(NEW.itemno,NEW.name);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
