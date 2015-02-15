-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.16


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema recruitment
--

CREATE DATABASE IF NOT EXISTS recruitment;
USE recruitment;

--
-- Definition of table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `UserName` varchar(50) NOT NULL,
  `StoredPassword` varchar(100) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `LockField` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`Id`,`UserName`,`StoredPassword`,`IsActive`,`LockField`) VALUES 
 (3,'user','caf1a3dfb505ffed0d024130f58c5cfa',1,3);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;


--
-- Definition of table `applicant`
--

DROP TABLE IF EXISTS `applicant`;
CREATE TABLE `applicant` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(80) NOT NULL,
  `DateOfBirth` datetime NOT NULL,
  `PlaceOfBirth` varchar(80) NOT NULL,
  `Address` varchar(150) NOT NULL,
  `PhoneNumber` varchar(25) NOT NULL,
  `LockField` int(10) unsigned DEFAULT NULL,
  `UserName` varchar(50) NOT NULL,
  `StoredPassword` varchar(100) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applicant`
--

/*!40000 ALTER TABLE `applicant` DISABLE KEYS */;
INSERT INTO `applicant` (`Id`,`Name`,`DateOfBirth`,`PlaceOfBirth`,`Address`,`PhoneNumber`,`LockField`,`UserName`,`StoredPassword`,`IsActive`) VALUES 
 (1,'Andi','1993-07-14 00:00:00','Selatpanjang','Villa Marina Blok F No 18','0852 2594 6727',0,'andis','202cb962ac59075b964b07152d234b70',1),
 (2,'andi','1993-07-14 00:00:00','Slp','Batam','0852 2594 6777',0,'andi','caf1a3dfb505ffed0d024130f58c5cfa',1),
 (4,'Merry Susanti','1991-10-23 00:00:00','Selatpanjang','Villa Marina Blok F No 18','0852 0852 0852',0,'merry','202cb962ac59075b964b07152d234b70',1);
/*!40000 ALTER TABLE `applicant` ENABLE KEYS */;


--
-- Definition of table `applicantrecruitment`
--

DROP TABLE IF EXISTS `applicantrecruitment`;
CREATE TABLE `applicantrecruitment` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Applicant` int(10) unsigned NOT NULL,
  `Recruitment` int(10) unsigned NOT NULL,
  `LockField` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_applicantrecruitment_applicant` (`Applicant`),
  KEY `FK_applicantrecruitment_recruitment` (`Recruitment`),
  CONSTRAINT `FK_applicantrecruitment_applicant` FOREIGN KEY (`Applicant`) REFERENCES `applicant` (`Id`),
  CONSTRAINT `FK_applicantrecruitment_recruitment` FOREIGN KEY (`Recruitment`) REFERENCES `recruitment` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applicantrecruitment`
--

/*!40000 ALTER TABLE `applicantrecruitment` DISABLE KEYS */;
INSERT INTO `applicantrecruitment` (`Id`,`Applicant`,`Recruitment`,`LockField`) VALUES 
 (1,2,3,0),
 (2,2,2,0),
 (3,1,2,0),
 (4,4,2,0);
/*!40000 ALTER TABLE `applicantrecruitment` ENABLE KEYS */;


--
-- Definition of table `applicantrecruitmentcriteria`
--

DROP TABLE IF EXISTS `applicantrecruitmentcriteria`;
CREATE TABLE `applicantrecruitmentcriteria` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ApplicantRecruitment` int(10) unsigned NOT NULL,
  `RecruitmentCriteria` int(10) unsigned NOT NULL,
  `RecruitmentSubcriteria` int(10) unsigned DEFAULT NULL,
  `LockField` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_applicantrecruitmentcriteria_recruitmentcriteria` (`RecruitmentCriteria`),
  KEY `FK_applicantrecruitmentcriteria_applicantrecruitment` (`ApplicantRecruitment`),
  KEY `FK_applicantrecruitmentcriteria_recruitmentsubcriteria` (`RecruitmentSubcriteria`) USING BTREE,
  CONSTRAINT `FK_applicantrecruitmentcriteria_applicantrecruitment` FOREIGN KEY (`ApplicantRecruitment`) REFERENCES `applicantrecruitment` (`Id`),
  CONSTRAINT `FK_applicantrecruitmentcriteria_recruitmentcriteria` FOREIGN KEY (`RecruitmentCriteria`) REFERENCES `recruitmentcriteria` (`Id`),
  CONSTRAINT `FK_applicantrecruitmentcriteria_recruitmentsubcriteria` FOREIGN KEY (`RecruitmentSubCriteria`) REFERENCES `recruitmentsubcriteria` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applicantrecruitmentcriteria`
--

/*!40000 ALTER TABLE `applicantrecruitmentcriteria` DISABLE KEYS */;
INSERT INTO `applicantrecruitmentcriteria` (`Id`,`ApplicantRecruitment`,`RecruitmentCriteria`,`RecruitmentSubcriteria`,`LockField`) VALUES 
 (1,1,8,17,2),
 (2,1,7,14,2),
 (3,2,6,8,4),
 (4,2,5,5,4),
 (5,2,4,2,4),
 (6,3,6,7,0),
 (7,3,5,6,0),
 (8,3,4,3,0),
 (9,4,6,9,0),
 (10,4,5,6,0),
 (11,4,4,23,0);
/*!40000 ALTER TABLE `applicantrecruitmentcriteria` ENABLE KEYS */;


--
-- Definition of table `recruitment`
--

DROP TABLE IF EXISTS `recruitment`;
CREATE TABLE `recruitment` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Description` varchar(500) NOT NULL,
  `TransDate` datetime NOT NULL,
  `Status` tinyint(3) unsigned NOT NULL,
  `LockField` int(10) unsigned DEFAULT NULL,
  `Name` varchar(80) NOT NULL,
  `EstimationCloseDate` datetime NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recruitment`
--

/*!40000 ALTER TABLE `recruitment` DISABLE KEYS */;
INSERT INTO `recruitment` (`Id`,`Description`,`TransDate`,`Status`,`LockField`,`Name`,`EstimationCloseDate`) VALUES 
 (2,'Buka Invoice, cek payment, cari supplier','2015-01-01 00:00:00',1,10,'Manager Accounting','2015-03-15 00:00:00'),
 (3,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eros nulla, sodales quis aliquet vel, fermentum vitae risus. Vestibulum non urna nisi. Integer fermentum erat hendrerit diam viverra, in consequat urna luctus. Proin eu condimentum magna, vitae mollis turpis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc turpis dui, luctus sed congue eu, vestibulum in nibh. Maecenas placerat neque vel vestibulum pharetra. Mauris lacinia metus nec sem pulvi','2015-01-01 00:00:00',1,6,'Accounting Manager','2015-03-01 00:00:00');
/*!40000 ALTER TABLE `recruitment` ENABLE KEYS */;


--
-- Definition of table `recruitmentcriteria`
--

DROP TABLE IF EXISTS `recruitmentcriteria`;
CREATE TABLE `recruitmentcriteria` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Recruitment` int(10) unsigned NOT NULL,
  `Name` varchar(45) NOT NULL,
  `Weight` decimal(10,2) NOT NULL,
  `IndifferenceThreshold` int(10) unsigned NOT NULL,
  `PreferenceThreshold` int(10) unsigned NOT NULL,
  `LockField` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_recruitmentcriteria_recruitment` (`Recruitment`),
  CONSTRAINT `FK_recruitmentcriteria_recruitment` FOREIGN KEY (`Recruitment`) REFERENCES `recruitment` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recruitmentcriteria`
--

/*!40000 ALTER TABLE `recruitmentcriteria` DISABLE KEYS */;
INSERT INTO `recruitmentcriteria` (`Id`,`Recruitment`,`Name`,`Weight`,`IndifferenceThreshold`,`PreferenceThreshold`,`LockField`) VALUES 
 (4,2,'Age','2.00',0,4,8),
 (5,2,'Highest Education','5.00',0,1,4),
 (6,2,'English','3.00',0,1,3),
 (7,3,'Age','1.00',2,8,0),
 (8,3,'Highest Education Level','0.20',0,10,0);
/*!40000 ALTER TABLE `recruitmentcriteria` ENABLE KEYS */;


--
-- Definition of table `recruitmentsubcriteria`
--

DROP TABLE IF EXISTS `recruitmentsubcriteria`;
CREATE TABLE `recruitmentsubcriteria` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `RecruitmentCriteria` int(10) unsigned NOT NULL,
  `Description` varchar(80) NOT NULL,
  `Value` int(10) unsigned NOT NULL,
  `LockField` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_recruitmentsubcriteria_recruitmentcriteria` (`RecruitmentCriteria`),
  CONSTRAINT `FK_recruitmentsubcriteria_recruitmentcriteria` FOREIGN KEY (`RecruitmentCriteria`) REFERENCES `recruitmentcriteria` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recruitmentsubcriteria`
--

/*!40000 ALTER TABLE `recruitmentsubcriteria` DISABLE KEYS */;
INSERT INTO `recruitmentsubcriteria` (`Id`,`RecruitmentCriteria`,`Description`,`Value`,`LockField`) VALUES 
 (1,4,'19',19,0),
 (2,4,'20',20,0),
 (3,4,'21',21,0),
 (4,5,'Senior High School',1,0),
 (5,5,'Bachelor',2,0),
 (6,5,'Master',3,0),
 (7,6,'Beginner',1,0),
 (8,6,'Inter-Mediate',2,0),
 (9,6,'Advanced',3,0),
 (10,7,'19',19,0),
 (11,7,'20',20,0),
 (12,7,'21',21,0),
 (13,7,'22',22,0),
 (14,7,'23',23,0),
 (15,7,'24',24,0),
 (16,8,'SMA',1,0),
 (17,8,'S1',2,0),
 (18,8,'S2',3,0),
 (19,8,'S3',5,0),
 (20,4,'22',22,0),
 (21,4,'23',23,0),
 (22,4,'24',24,0),
 (23,4,'25',25,0),
 (24,4,'26',26,0);
/*!40000 ALTER TABLE `recruitmentsubcriteria` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
