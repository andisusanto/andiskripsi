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
 (3,'user','caf1a3dfb505ffed0d024130f58c5cfa',1,0);
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applicant`
--

/*!40000 ALTER TABLE `applicant` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applicantrecruitment`
--

/*!40000 ALTER TABLE `applicantrecruitment` DISABLE KEYS */;
/*!40000 ALTER TABLE `applicantrecruitment` ENABLE KEYS */;


--
-- Definition of table `applicantrecruitmentcriteria`
--

DROP TABLE IF EXISTS `applicantrecruitmentcriteria`;
CREATE TABLE `applicantrecruitmentcriteria` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ApplicantRecruitment` int(10) unsigned NOT NULL,
  `RecruitmentCriteria` int(10) unsigned NOT NULL,
  `RecruitmentSubCriteria` int(10) unsigned NOT NULL,
  `LockField` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_applicantrecruitmentcriteria_recruitmentcriteria` (`RecruitmentCriteria`),
  KEY `FK_applicantrecruitmentcriteria_recruitmentsubcriteria` (`RecruitmentSubCriteria`),
  KEY `FK_applicantrecruitmentcriteria_applicantrecruitment` (`ApplicantRecruitment`),
  CONSTRAINT `FK_applicantrecruitmentcriteria_applicantrecruitment` FOREIGN KEY (`ApplicantRecruitment`) REFERENCES `applicantrecruitment` (`Id`),
  CONSTRAINT `FK_applicantrecruitmentcriteria_recruitmentcriteria` FOREIGN KEY (`RecruitmentCriteria`) REFERENCES `recruitmentcriteria` (`Id`),
  CONSTRAINT `FK_applicantrecruitmentcriteria_recruitmentsubcriteria` FOREIGN KEY (`RecruitmentSubCriteria`) REFERENCES `recruitmentsubcriteria` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applicantrecruitmentcriteria`
--

/*!40000 ALTER TABLE `applicantrecruitmentcriteria` DISABLE KEYS */;
/*!40000 ALTER TABLE `applicantrecruitmentcriteria` ENABLE KEYS */;


--
-- Definition of table `recruitment`
--

DROP TABLE IF EXISTS `recruitment`;
CREATE TABLE `recruitment` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Description` varchar(150) NOT NULL,
  `TransDate` datetime NOT NULL,
  `Status` tinyint(3) unsigned NOT NULL,
  `LockField` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recruitment`
--

/*!40000 ALTER TABLE `recruitment` DISABLE KEYS */;
INSERT INTO `recruitment` (`Id`,`Description`,`TransDate`,`Status`,`LockField`) VALUES 
 (2,'Manager Accounting','2015-01-01 00:00:00',0,6);
/*!40000 ALTER TABLE `recruitment` ENABLE KEYS */;


--
-- Definition of table `recruitmentcriteria`
--

DROP TABLE IF EXISTS `recruitmentcriteria`;
CREATE TABLE `recruitmentcriteria` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Recruitment` int(10) unsigned NOT NULL,
  `Name` varchar(45) NOT NULL,
  `Weight` decimal(10,0) NOT NULL,
  `IndifferenceTreshold` int(10) unsigned NOT NULL,
  `PreferenceTreshold` int(10) unsigned NOT NULL,
  `LockField` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_recruitmentcriteria_indifferencetreshold` (`IndifferenceTreshold`),
  KEY `FK_recruitmentcriteria_preferencetreshold` (`PreferenceTreshold`),
  KEY `FK_recruitmentcriteria_recruitment` (`Recruitment`),
  CONSTRAINT `FK_recruitmentcriteria_indifferencetreshold` FOREIGN KEY (`IndifferenceTreshold`) REFERENCES `recruitmentsubcriteria` (`Id`),
  CONSTRAINT `FK_recruitmentcriteria_preferencetreshold` FOREIGN KEY (`PreferenceTreshold`) REFERENCES `recruitmentsubcriteria` (`Id`),
  CONSTRAINT `FK_recruitmentcriteria_recruitment` FOREIGN KEY (`Recruitment`) REFERENCES `recruitment` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recruitmentcriteria`
--

/*!40000 ALTER TABLE `recruitmentcriteria` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recruitmentsubcriteria`
--

/*!40000 ALTER TABLE `recruitmentsubcriteria` DISABLE KEYS */;
/*!40000 ALTER TABLE `recruitmentsubcriteria` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
