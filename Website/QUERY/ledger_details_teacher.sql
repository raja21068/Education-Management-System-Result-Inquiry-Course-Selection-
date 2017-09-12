-- phpMyAdmin SQL Dump
-- version 3.5.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 19, 2016 at 07:46 AM
-- Server version: 5.5.43-cll-lve
-- PHP Version: 5.6.19

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `usindh_exam_raja`
--

-- --------------------------------------------------------

--
-- Table structure for table `ledger_details_teacher`
--

CREATE TABLE IF NOT EXISTS `ledger_details_teacher` (
  `SCHEME_ID` int(10) NOT NULL,
  `SCHEME_PART` int(1) NOT NULL,
  `AC_ID` int(10) NOT NULL,
  `SL_ID` int(10) NOT NULL,
  `ROLL_NO` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `SEMESTER` int(2) NOT NULL,
  `COURSE_NO` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `MARKS_OBTAINED` varchar(3) DEFAULT NULL,
  `GRADE` varchar(5) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `REMARKS` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `MIN_MARKS` int(3) DEFAULT NULL,
  `QP` double(5,2) DEFAULT NULL,
  `UNI_MARKS_OBTAINED` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `COLLEGE_MARKS_OBTAINED` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `REF_NO` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `REF_DATE` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `TEACHER_CODE` varchar(15) NOT NULL,
  `TEACHER_ID` int(5) DEFAULT NULL,
  `REMARKS_PROGRAM_NAME` varchar(200) NOT NULL,
  `COURSE_TITLE` varchar(100) NOT NULL,
  `BATCH_ID` int(11) NOT NULL,
  `IS_LOCKED` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`SL_ID`,`ROLL_NO`,`SEMESTER`,`COURSE_NO`,`TEACHER_CODE`),
  KEY `fk_ledger_details_ledger_semester1_idx` (`SL_ID`),
  KEY `fk_ledger_details_ledger_semester2_idx` (`ROLL_NO`),
  KEY `fk_ledger_details_ledger_semester3_idx` (`SEMESTER`),
  KEY `fk_ledger_details_ledger1_idx` (`SCHEME_ID`),
  KEY `fk_ledger_details_ledger2_idx` (`SCHEME_PART`),
  KEY `fk_ledger_details_conc_area1_idx` (`AC_ID`),
  KEY `fk_ledger_details_scheme_detail4_idx` (`COURSE_NO`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
