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
CREATE DATABASE IF NOT EXISTS `depeddoctracking` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `depeddoctracking`;


-- Dumping structure for procedure depeddoctracking.addappointee
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `addappointee`(IN `itemno` VARCHAR(50), IN `name` VARCHAR(50), IN `pos` VARCHAR(50), IN `cat` VARCHAR(50), IN `dateinformed` DATE, IN `reply` VARCHAR(50), IN `si` VARCHAR(50), IN `sn` VARCHAR(50), IN `effect` DATE, IN `remark` VARCHAR(50))
BEGIN
INSERT INTO `tblappointee`(`itemno`, `name`, `position`,`category`, `dateinformed`, `reply`,`schoolID`,`schoolName`) VALUES (itemno,name,pos,cat,dateinformed,reply,si,sn);
UPDATE `tblremarks` set `effectivity`=effect,`remarks`=remark WHERE `itemno` = itemno;
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `editappointee`(IN `itemkey` VARCHAR(50), IN `namekey` VARCHAR(50), IN `datekey` VARCHAR(50), IN `replykey` VARCHAR(50), IN `effectivitykey` DATE, IN `remarkskey` TEXT)
BEGIN
	UPDATE `tblappointee` SET `name`=namekey,`dateinformed`=datekey,`reply`=replykey WHERE `itemno` = itemkey limit 1;
	UPDATE `tblremarks` SET `effectivity`=effectivitykey,`remarks`=remarkskey WHERE `itemno` = itemkey limit 1;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.fetch-attest
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetch-attest`()
BEGIN
	select a.itemno,a.position,a.schoolID,a.schoolName,a.name,t.datereceivedSDS,t.dateAwarded,t.releasedToRecords from tblappointee as a
	left join tbltransmission as t
	on a.itemno = t.itemno;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.fetchappointee
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchappointee`()
    COMMENT 'fetch all tblappointee data'
BEGIN
	SELECT * from tblappointee as t
	left join tblremarks as r
	on
	t.itemno = r.itemno;
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


-- Dumping structure for procedure depeddoctracking.fetchCongSDS
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchCongSDS`()
BEGIN
	SELECT a.itemno,a.position,a.schoolID,a.schoolName,a.name,c.hrmodate,c.SDSreleaseddate from tblappointee as a
	left join tblcongratulatory as c
	on a.itemno = c.itemno;
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `fetchsingleappointee`(IN `keyitem` VARCHAR(50))
BEGIN
	SELECT * from tblappointee as t
	left join tblremarks as r
	on
	t.itemno = r.itemno
	where t.itemno = keyitem;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.forcongratulatory
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `forcongratulatory`()
BEGIN
	SELECT a.itemno,a.name,a.position,a.schoolName,a.dateinformed,c.duedate,c.hrmodate,c.isSDS,c.ok,r.effectivity,r.remarks from tblappointee as a
	left join tblcongratulatory as c on a.itemno = c.itemno
	left join tblremarks as r on a.itemno = r.itemno;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.get-asds-process
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `get-asds-process`()
BEGIN
	/** ASDS **/
	SELECT a.itemno,a.position,a.schoolID,a.schoolName,a.name,p.isASDS,p.asdsdatereceived,p.asdsdatereleased,c.ok from tblappointee as a
	LEFT JOIN tblprocess as p
	on a.itemno = p.itemno
	LEFT JOIN tblcongratulatory as c
	on p.itemno = c.itemno
	where c.ok = 'YES' AND p.asdsdatereceived is not null;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.get-bo-process
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `get-bo-process`()
BEGIN
	/** BO **/
	SELECT a.itemno,a.position,a.schoolID,a.schoolName,a.name,p.isBO,p.bodatereceived,p.bodatereleased,c.ok from tblappointee as a
	LEFT JOIN tblprocess as p
	on a.itemno = p.itemno
	LEFT JOIN tblcongratulatory as c
	on p.itemno = c.itemno
	where c.ok = 'YES' AND p.bodatereceived is not null;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.get-hrmo-process
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `get-hrmo-process`()
BEGIN
	/** HRMO **/
	SELECT a.itemno,a.position,a.schoolID,a.schoolName,a.name,p.isHRMO,p.hrmodatereceived,p.hrmodatereleased,c.ok from tblappointee as a
	LEFT JOIN tblprocess as p
	on a.itemno = p.itemno
	LEFT JOIN tblcongratulatory as c
	on p.itemno = c.itemno
	where c.ok = 'YES' AND p.hrmodatereceived is not null;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.get-progress
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `get-progress`(IN `xitem` VARCHAR(50))
BEGIN
	SELECT * from tblitemTracker WHERE itemno = xitem limit 1;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.get-records
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `get-records`()
BEGIN
	SELECT a.itemno,a.name,a.position,a.schoolID,a.schoolName,t.dateAwarded,t.releasedToRecords,t.recordsreceived,t.releasedAttested from tblappointee as a
	LEFT JOIN tbltransmission as t
	ON a.itemno = t.itemno
	WHERE t.releasedToRecords is not null
	AND t.dateAwarded is null;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.get-sds-process
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `get-sds-process`()
BEGIN
	/** SDS **/
	SELECT a.itemno,a.position,a.schoolID,a.schoolName,a.name,p.isSDS,p.sdsdatereceived,p.sdsdatereleased,c.ok from tblappointee as a
	LEFT JOIN tblprocess as p
	on a.itemno = p.itemno
	LEFT JOIN tblcongratulatory as c
	on p.itemno = c.itemno
	where c.ok = 'YES' AND p.sgoddatereceived is not null;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.get-sgod-process
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `get-sgod-process`()
BEGIN
	/** SGOD **/
	SELECT a.itemno,a.position,a.schoolID,a.schoolName,a.name,p.isSGOD,p.sgoddatereceived,p.sgoddatereleased,c.ok from tblappointee as a
	LEFT JOIN tblprocess as p
	on a.itemno = p.itemno
	LEFT JOIN tblcongratulatory as c
	on p.itemno = c.itemno
	where c.ok = 'YES' AND p.sgoddatereceived is not null;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.get-single-user
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `get-single-user`(IN `uid` VARCHAR(50))
BEGIN
 SELECT * from tblusers WHERE userID = uid limit 1;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.get-transmission
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `get-transmission`()
BEGIN
	select a.itemno,a.position,a.schoolID,a.schoolName,a.name,t.hrmoreceived,t.transmittedCSC,t.receivedCSC,t.releasedToSDS from tblappointee as a
	left join tbltransmission as t
	on a.itemno = t.itemno
	WHERE t.ready=1;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.get-users
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `get-users`()
BEGIN
	SELECT * from tblusers;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.getsingleposition
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `getsingleposition`(IN `item` VARCHAR(50))
BEGIN
	SELECT * from tblpositions WHERE itemno = item;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.markcomplete
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `markcomplete`(IN `itm` VARCHAR(50))
BEGIN
	UPDATE tblcongratulatory set `ok` = 'YES' WHERE itemno = itm limit 1;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.marksds
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `marksds`(IN `ddate` DATE, IN `item` VARCHAR(50))
BEGIN
	UPDATE `tblcongratulatory` SET `SDSreleaseddate`=ddate,`isSDS`='YES' WHERE `itemno` = item limit 1;
	UPDATE `tblprocess` SET `hrmodatereceived` = ddate WHERE `itemno` = item limit 1;
	UPDATE tblitemTracker set progress = 40,curLocation = 'HRMO',datereceived = ddate WHERE itemno = item limit 1;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.post-receivedCSC
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `post-receivedCSC`(IN `xdate` DATE, IN `xitem` VARCHAR(50))
BEGIN
		UPDATE tbltransmission SET receivedCSC = xdate WHERE itemno = xitem limit 1;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.post-receivedSDS
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `post-receivedSDS`(IN `xdate` DATE, IN `xitem` VARCHAR(50))
BEGIN
	UPDATE tbltransmission SET hrmoreceived = xdate WHERE itemno = xitem limit 1;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.post-releasedSDS
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `post-releasedSDS`(IN `xdate` DATE, IN `xitem` VARCHAR(50))
BEGIN
		UPDATE tbltransmission SET releasedToSDS = xdate WHERE itemno = xitem limit 1;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.post-sds-awarded
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `post-sds-awarded`(IN `xdate` DATE, IN `xitem` VARCHAR(50))
BEGIN
	UPDATE tbltransmission set dateAwarded = xdate WHERE itemno = xitem limit 1;
	UPDATE tblitemTracker set progress = 100,curLocation = 'BUDGET',datereceived = xdate WHERE itemno = xitem limit 1;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.post-sds-received
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `post-sds-received`(IN `xdate` DATE, IN `xitem` VARCHAR(50))
BEGIN
	UPDATE tbltransmission set datereceivedSDS = xdate WHERE itemno = xitem limit 1;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.post-sds-records
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `post-sds-records`(IN `xdate` DATE, IN `xitem` VARCHAR(50))
BEGIN
	UPDATE tbltransmission SET releasedToRecords = xdate WHERE itemno = xitem limit 1;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.post-transmit
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `post-transmit`(IN `xdate` DATE, IN `xitem` VARCHAR(50))
BEGIN
		UPDATE tbltransmission SET transmittedCSC = xdate WHERE itemno = xitem limit 1;
		UPDATE tblitemTracker set progress = 95,curLocation = 'CSC',datereceived = xdate WHERE itemno = xitem limit 1;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.set-asds-process
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `set-asds-process`(IN `xdate` DATE, IN `xitem` VARCHAR(50))
BEGIN
	UPDATE tblprocess set asdsdatereleased = xdate,isSDS = 'YES' WHERE itemno = xitem limit 1;
	UPDATE tblprocess set sdsdatereceived = xdate WHERE itemno = xitem limit 1;
	UPDATE tblitemTracker set progress = 80,curLocation = 'SDS',datereceived = xdate WHERE itemno = xitem limit 1;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.set-bo-process
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `set-bo-process`(IN `xdate` DATE, IN `xitem` VARCHAR(50))
BEGIN
	UPDATE tblprocess set bodatereleased = xdate,isBO = 'YES' WHERE itemno = xitem limit 1;
	UPDATE tblprocess set sgoddatereceived = xdate WHERE itemno = xitem limit 1;
	UPDATE tblitemTracker set progress = 60,curLocation = 'SGOD',datereceived = xdate WHERE itemno = xitem limit 1;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.set-hrmo-process
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `set-hrmo-process`(IN `xdate` DATE, IN `xitem` VARCHAR(50))
BEGIN
	UPDATE tblprocess set hrmodatereleased = xdate,isHRMO = 'YES' WHERE itemno = xitem limit 1;
	UPDATE tblprocess set bodatereceived = xdate WHERE itemno = xitem limit 1;
	UPDATE tblitemTracker set progress = 50,curLocation = 'BUDGET',datereceived = xdate WHERE itemno = xitem limit 1;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.set-sds-process
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `set-sds-process`(IN `xdate` DATE, IN `xitem` VARCHAR(50))
BEGIN
	UPDATE tblprocess set sdsdatereleased = xdate,isSDS = 'YES' WHERE itemno = xitem limit 1;
	UPDATE tbltransmission set ready = 1 WHERE itemno = xitem limit 1;
	UPDATE tblitemTracker set progress = 90,curLocation = 'HRMO',datereceived = xdate WHERE itemno = xitem limit 1;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.set-sgod-process
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `set-sgod-process`(IN `xdate` DATE, IN `xitem` VARCHAR(50))
BEGIN
	UPDATE tblprocess set sgoddatereleased = xdate,isSGOD = 'YES' WHERE itemno = xitem limit 1;
	UPDATE tblprocess set asdsdatereceived = xdate WHERE itemno = xitem limit 1;
	UPDATE tblitemTracker set progress = 70,curLocation = 'ASDS',datereceived = xdate WHERE itemno = xitem limit 1;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.set-user
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `set-user`(IN `uname` VARCHAR(50), IN `pword` VARCHAR(50), IN `uid` INT)
BEGIN
UPDATE tblusers set UserName = uname, Password = pword WHERE userID = uid limit 1;
END//
DELIMITER ;


-- Dumping structure for table depeddoctracking.tblappointee
CREATE TABLE IF NOT EXISTS `tblappointee` (
  `itemno` varchar(150) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `dateinformed` date DEFAULT NULL,
  `reply` varchar(50) DEFAULT NULL,
  `schoolID` varchar(50) DEFAULT NULL,
  `schoolName` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`itemno`),
  KEY `position` (`position`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table depeddoctracking.tblappointee: ~1 rows (approximately)
DELETE FROM `tblappointee`;
/*!40000 ALTER TABLE `tblappointee` DISABLE KEYS */;
INSERT INTO `tblappointee` (`itemno`, `name`, `position`, `category`, `dateinformed`, `reply`, `schoolID`, `schoolName`) VALUES
	('DepEd-001', 'Juan Dela Cruz', 'Teacher 3', 'Promotion', '2016-09-19', 'TEST', '307133', 'San Agustin IS');
/*!40000 ALTER TABLE `tblappointee` ENABLE KEYS */;


-- Dumping structure for table depeddoctracking.tblappointeeprogress
CREATE TABLE IF NOT EXISTS `tblappointeeprogress` (
  `itemno` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT '0',
  `progress` tinyint(4) DEFAULT '0',
  UNIQUE KEY `itemno` (`itemno`),
  CONSTRAINT `itemprogress` FOREIGN KEY (`itemno`) REFERENCES `tblappointee` (`itemno`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='progressbar on front end';

-- Dumping data for table depeddoctracking.tblappointeeprogress: ~1 rows (approximately)
DELETE FROM `tblappointeeprogress`;
/*!40000 ALTER TABLE `tblappointeeprogress` DISABLE KEYS */;
INSERT INTO `tblappointeeprogress` (`itemno`, `name`, `progress`) VALUES
	('DepEd-001', 'Juan Dela Cruz', 0);
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

-- Dumping data for table depeddoctracking.tblcongratulatory: ~1 rows (approximately)
DELETE FROM `tblcongratulatory`;
/*!40000 ALTER TABLE `tblcongratulatory` DISABLE KEYS */;
INSERT INTO `tblcongratulatory` (`itemno`, `hrmodate`, `isSDS`, `duedate`, `SDSreleaseddate`, `ok`) VALUES
	('DepEd-001', NULL, 'NO', NULL, NULL, 'NO');
/*!40000 ALTER TABLE `tblcongratulatory` ENABLE KEYS */;


-- Dumping structure for table depeddoctracking.tblitemtracker
CREATE TABLE IF NOT EXISTS `tblitemtracker` (
  `itemno` varchar(50) DEFAULT NULL,
  `progress` smallint(6) DEFAULT NULL,
  `curLocation` varchar(50) DEFAULT NULL,
  `datereceived` date DEFAULT NULL,
  UNIQUE KEY `itemno` (`itemno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table depeddoctracking.tblitemtracker: 2 rows
DELETE FROM `tblitemtracker`;
/*!40000 ALTER TABLE `tblitemtracker` DISABLE KEYS */;
INSERT INTO `tblitemtracker` (`itemno`, `progress`, `curLocation`, `datereceived`) VALUES
	('Deped-002', 80, 'SDS', '2016-09-17'),
	('asdasd', 50, 'BUDGET', '2016-09-18'),
	('DepEd-001', 20, 'HRMO', '2016-09-19');
/*!40000 ALTER TABLE `tblitemtracker` ENABLE KEYS */;


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
  `hrmodatereceived` date DEFAULT NULL,
  `hrmodatereleased` date DEFAULT NULL,
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
  UNIQUE KEY `itemno` (`itemno`),
  CONSTRAINT `itemno1` FOREIGN KEY (`itemno`) REFERENCES `tblappointee` (`itemno`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table depeddoctracking.tblprocess: ~1 rows (approximately)
DELETE FROM `tblprocess`;
/*!40000 ALTER TABLE `tblprocess` DISABLE KEYS */;
INSERT INTO `tblprocess` (`itemno`, `isHRMO`, `hrmodatereceived`, `hrmodatereleased`, `isBO`, `bodatereceived`, `bodatereleased`, `isSGOD`, `sgoddatereceived`, `sgoddatereleased`, `isASDS`, `asdsdatereceived`, `asdsdatereleased`, `isSDS`, `sdsdatereceived`, `sdsdatereleased`) VALUES
	('DepEd-001', 'NO', NULL, NULL, 'NO', NULL, NULL, 'NO', NULL, NULL, 'NO', NULL, NULL, 'NO', NULL, NULL);
/*!40000 ALTER TABLE `tblprocess` ENABLE KEYS */;


-- Dumping structure for table depeddoctracking.tblremarks
CREATE TABLE IF NOT EXISTS `tblremarks` (
  `itemno` varchar(50) NOT NULL,
  `effectivity` date DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL,
  UNIQUE KEY `itemno` (`itemno`),
  CONSTRAINT `itemno2` FOREIGN KEY (`itemno`) REFERENCES `tblappointee` (`itemno`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table depeddoctracking.tblremarks: ~1 rows (approximately)
DELETE FROM `tblremarks`;
/*!40000 ALTER TABLE `tblremarks` DISABLE KEYS */;
INSERT INTO `tblremarks` (`itemno`, `effectivity`, `remarks`) VALUES
	('DepEd-001', '2016-09-19', 'NOT SUBMITTED');
/*!40000 ALTER TABLE `tblremarks` ENABLE KEYS */;


-- Dumping structure for table depeddoctracking.tbltransmission
CREATE TABLE IF NOT EXISTS `tbltransmission` (
  `itemno` varchar(50) NOT NULL,
  `hrmoreceived` date DEFAULT NULL,
  `transmittedCSC` date DEFAULT NULL,
  `receivedCSC` date DEFAULT NULL,
  `releasedToSDS` date DEFAULT NULL,
  `datereceivedSDS` date DEFAULT NULL,
  `dateAwarded` date DEFAULT NULL,
  `releasedToRecords` date DEFAULT NULL,
  `recordsreceived` date DEFAULT NULL,
  `releasedAttested` date DEFAULT NULL,
  `ready` tinyint(4) DEFAULT '0',
  UNIQUE KEY `itemno` (`itemno`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table depeddoctracking.tbltransmission: 3 rows
DELETE FROM `tbltransmission`;
/*!40000 ALTER TABLE `tbltransmission` DISABLE KEYS */;
INSERT INTO `tbltransmission` (`itemno`, `hrmoreceived`, `transmittedCSC`, `receivedCSC`, `releasedToSDS`, `datereceivedSDS`, `dateAwarded`, `releasedToRecords`, `recordsreceived`, `releasedAttested`, `ready`) VALUES
	('DepEd-001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);
/*!40000 ALTER TABLE `tbltransmission` ENABLE KEYS */;


-- Dumping structure for table depeddoctracking.tblusers
CREATE TABLE IF NOT EXISTS `tblusers` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(150) NOT NULL,
  `Password` varchar(150) NOT NULL,
  `Privilege` varchar(50) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table depeddoctracking.tblusers: ~7 rows (approximately)
DELETE FROM `tblusers`;
/*!40000 ALTER TABLE `tblusers` DISABLE KEYS */;
INSERT INTO `tblusers` (`userID`, `UserName`, `Password`, `Privilege`) VALUES
	(1, 'HRMO', 'hrmo', 'HRMO'),
	(2, 'SGOD', 'sgod', 'SGOD'),
	(3, 'SDS', 'sds', 'SDS'),
	(4, 'BUDGET', 'budget', 'BUDGET'),
	(5, 'ASDS', 'asds', 'ASDS'),
	(6, 'RECORDS', 'records', 'RECORDS'),
	(7, 'ADMIN', 'admin', 'ADMINISTRATOR');
/*!40000 ALTER TABLE `tblusers` ENABLE KEYS */;


-- Dumping structure for procedure depeddoctracking.track-warning
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `track-warning`()
BEGIN
	SELECT a.itemno,a.name,a.schoolID,a.schoolName,a.position,DATEDIFF(NOW(),c.duedate),c.duedate from tblappointee as a
	LEFT JOIN tblcongratulatory as c
	on a.itemno = c.itemno
	WHERE DATEDIFF(NOW(),c.duedate) = 1;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.update-recordawards
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `update-recordawards`(IN `xdate` DATE, IN `xitem` VARCHAR(50))
BEGIN
	UPDATE tbltransmission set releasedAttested = xdate WHERE itemno = xitem limit 1;
	UPDATE tblitemTracker set progress = 100,curLocation = 'BUDGET',datereceived = xdate WHERE itemno = xitem limit 1;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.update-recordsreceived
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `update-recordsreceived`(IN `xdate` DATE, IN `xitem` VARCHAR(50))
BEGIN
	UPDATE tbltransmission set recordsreceived = xdate WHERE itemno = xitem limit 1;
END//
DELIMITER ;


-- Dumping structure for procedure depeddoctracking.updateCongratulatory
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateCongratulatory`(IN `datereleased` DATE, IN `releasedtoSDS` CHAR(50), IN `xduedate` DATE, IN `xitem` VARCHAR(50), IN `effectivity` DATE, IN `remarks` CHAR(50))
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
	INSERT into tbltransmission(`itemno`)VALUES(NEW.itemno);
	INSERT into tblitemTracker(`itemno`)VALUES(NEW.itemno);
	UPDATE tblitemTracker SET progress = 20,curLocation = 'HRMO',datereceived = NOW() WHERE itemno = new.itemno limit 1;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
