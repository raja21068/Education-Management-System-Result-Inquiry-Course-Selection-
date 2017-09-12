-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 27, 2014 at 11:02 AM
-- Server version: 5.5.34-MariaDB-cll-lve
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stbbedup_exam1`
--

-- --------------------------------------------------------

--
-- Table structure for table `ac_scheme_detail`
--

CREATE TABLE IF NOT EXISTS `ac_scheme_detail` (
  `SCHEME_ID` int(3) NOT NULL,
  `SCHEME_PART` int(1) NOT NULL,
  `AC_ID` int(10) NOT NULL,
  `COURSE_NO` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `COURSE_TITLE` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `CR_HRS` int(2) DEFAULT NULL,
  `MAX_MARKS` int(3) DEFAULT NULL,
  `REMARKS` varchar(2) COLLATE latin1_general_ci DEFAULT NULL,
  `SEMESTER` int(1) DEFAULT NULL,
  `IS_CREDITABLE` varchar(5) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`SCHEME_ID`,`AC_ID`,`SCHEME_PART`,`COURSE_NO`),
  KEY `fk_ac_scheme_detail_conc_area1_idx` (`AC_ID`),
  KEY `fk_ac_scheme_detail_conc_area2_idx` (`SCHEME_ID`),
  KEY `fk_ac_scheme_detail_conc_area3_idx` (`SCHEME_PART`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE IF NOT EXISTS `batch` (
  `BATCH_ID` int(3) NOT NULL DEFAULT '0',
  `PROG_ID` int(3) DEFAULT NULL,
  `DEPT_ID` int(3) DEFAULT NULL,
  `RUL_ID` int(4) DEFAULT NULL,
  `YEAR` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `SHIFT` varchar(1) COLLATE latin1_general_ci DEFAULT NULL,
  `REMARKS` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `GROUP_DESC` varchar(4) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`BATCH_ID`),
  KEY `fk_batch_program1_idx` (`DEPT_ID`),
  KEY `fk_batch_program1_idx1` (`PROG_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `MessageType` text,
  `Subject` text,
  `Comments` text,
  `Username` text,
  `UserEmail` text,
  `UserTel` text,
  `UserFAX` text,
  `to_day_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `conc_area`
--

CREATE TABLE IF NOT EXISTS `conc_area` (
  `AC_ID` int(11) NOT NULL,
  `SCHEME_ID` int(3) NOT NULL,
  `SCHEME_PART` int(1) NOT NULL,
  `TITLE` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `DESCRIPTION` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `REMARKS` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`SCHEME_PART`,`SCHEME_ID`,`AC_ID`),
  KEY `fk_conc_area_scheme_part1_idx` (`SCHEME_PART`),
  KEY `fk_conc_area_scheme_part2_idx` (`SCHEME_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `DEPT_ID` int(3) NOT NULL AUTO_INCREMENT,
  `FAC_ID` int(3) DEFAULT NULL,
  `INST_ID` int(3) DEFAULT NULL,
  `DEPT_NAME` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `IS_INST` varchar(1) COLLATE latin1_general_ci DEFAULT NULL,
  `CODE` varchar(5) COLLATE latin1_general_ci DEFAULT NULL,
  `REMARKS` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`DEPT_ID`),
  KEY `fk_department_faculty_idx` (`FAC_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=87 ;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `FAC_ID` int(3) NOT NULL DEFAULT '0',
  `FAC_NAME` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `REMARKS` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`FAC_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_requisition`
--

CREATE TABLE IF NOT EXISTS `item_requisition` (
  `REQ_ID` int(10) NOT NULL,
  `SL_ID` int(10) DEFAULT NULL,
  `ROLL_NO` varchar(15) COLLATE latin1_general_ci DEFAULT NULL,
  `SL_TYPE` varchar(1) COLLATE latin1_general_ci DEFAULT NULL,
  `CHALLAN_NO` int(10) DEFAULT NULL,
  `CHALLAN_DATE` date DEFAULT NULL,
  `ITEM_ID` int(10) DEFAULT NULL,
  `REQ_DATE` date DEFAULT NULL,
  `DELEIVERY_DATE` date DEFAULT NULL,
  `ISSUED_CERT_NO` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `ISSUED_DATE` date DEFAULT NULL,
  `REQ_STATUS` char(1) COLLATE latin1_general_ci DEFAULT NULL,
  `ARCHIVE` varchar(1) COLLATE latin1_general_ci DEFAULT NULL,
  `REMARKS` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`REQ_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ledger`
--

CREATE TABLE IF NOT EXISTS `ledger` (
  `SL_ID` int(10) NOT NULL,
  `SCHEME_ID` int(4) NOT NULL,
  `SCHEME_PART` int(1) NOT NULL,
  `ANN_DATE` date NOT NULL,
  `TOTAL_PASS` int(4) NOT NULL,
  `TOTAL_FAIL` int(4) NOT NULL,
  `REMARKS` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `TABULATOR_NAME` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `CHECKER_NAME` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `IS_ANNOUNCED` varchar(1) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`SCHEME_ID`,`SL_ID`,`SCHEME_PART`),
  KEY `fk_ledger_seat_list1_idx` (`SL_ID`),
  KEY `fk_ledger_scheme1_idx` (`SCHEME_ID`),
  KEY `fk_ledger_seat_list2_idx` (`SCHEME_PART`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ledger_details`
--

CREATE TABLE IF NOT EXISTS `ledger_details` (
  `SCHEME_ID` int(10) NOT NULL,
  `SCHEME_PART` int(1) NOT NULL,
  `AC_ID` int(10) NOT NULL,
  `SL_ID` int(10) NOT NULL,
  `ROLL_NO` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `SEMESTER` int(2) NOT NULL,
  `COURSE_NO` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `MARKS_OBTAINED` int(3) DEFAULT NULL,
  `GRADE` varchar(5) COLLATE latin1_general_ci DEFAULT NULL,
  `REMARKS` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `MIN_MARKS` int(3) DEFAULT NULL,
  `QP` double(5,2) DEFAULT NULL,
  `UNI_MARKS_OBTAINED` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `COLLEGE_MARKS_OBTAINED` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `REF_NO` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `REF_DATE` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`SL_ID`,`ROLL_NO`,`SEMESTER`,`SCHEME_ID`,`SCHEME_PART`,`AC_ID`,`COURSE_NO`),
  KEY `fk_ledger_details_ledger_semester1_idx` (`SL_ID`),
  KEY `fk_ledger_details_ledger_semester2_idx` (`ROLL_NO`),
  KEY `fk_ledger_details_ledger_semester3_idx` (`SEMESTER`),
  KEY `fk_ledger_details_ledger1_idx` (`SCHEME_ID`),
  KEY `fk_ledger_details_ledger2_idx` (`SCHEME_PART`),
  KEY `fk_ledger_details_conc_area1_idx` (`AC_ID`),
  KEY `fk_ledger_details_scheme_detail4_idx` (`COURSE_NO`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ledger_detail_summary`
--

CREATE TABLE IF NOT EXISTS `ledger_detail_summary` (
  `SL_ID` int(10) NOT NULL,
  `ROLL_NO` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `TOTAL_MARKS` int(6) DEFAULT NULL,
  `RESULT_REMARKS` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `PERCENTAGE` double(6,2) DEFAULT NULL,
  `INDV_RESULT_ANN_DATE` date DEFAULT NULL,
  `CGPA` double(6,2) DEFAULT NULL,
  `OBTAIN_MARKS` int(6) DEFAULT NULL,
  `NO_DUES_REMARKS` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `PREV_PART` int(1) DEFAULT NULL,
  `PREV_ROLL_NO` varchar(18) COLLATE latin1_general_ci DEFAULT NULL,
  `PREV_SL_ID` int(10) DEFAULT NULL,
  `PREV_RESULT_REMARKS` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `AC_II_NO` varchar(9) COLLATE latin1_general_ci DEFAULT NULL,
  `AC_II_NO_DATED` date DEFAULT NULL,
  `PREV_CGPA` double(6,2) DEFAULT NULL,
  `PREV_OBTAIN_MARKS` int(6) DEFAULT NULL,
  `PREV_PERCENTAGE` double(6,2) DEFAULT NULL,
  `PREV_TOTAL_MARKS` int(6) DEFAULT NULL,
  `PRE_YEAR` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `PRE_TYPE` varchar(1) COLLATE latin1_general_ci DEFAULT NULL,
  `PREV_BATCH_ID` int(4) DEFAULT NULL,
  `CURRENT_RESULT_REMARKS` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`SL_ID`,`ROLL_NO`),
  KEY `fk_ledger_detail_summary_ledger_details1_idx` (`SL_ID`),
  KEY `fk_ledger_detail_summary_ledger_details2_idx` (`ROLL_NO`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ledger_list_detail`
--

CREATE TABLE IF NOT EXISTS `ledger_list_detail` (
  `SL_ID` int(10) NOT NULL,
  `ROLL_NO` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `REMARKS` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`SL_ID`,`ROLL_NO`),
  KEY `fk_ledger_list_detail_seat_list_detail1_idx` (`SL_ID`),
  KEY `fk_ledger_list_detail_seat_list_detail2_idx` (`ROLL_NO`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ledger_semester`
--

CREATE TABLE IF NOT EXISTS `ledger_semester` (
  `SEMESTER` int(2) NOT NULL,
  `SL_ID` int(10) NOT NULL,
  `ROLL_NO` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `REMARKS` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`SL_ID`,`ROLL_NO`,`SEMESTER`),
  KEY `fk_ledger_semester_ledger_list_detail1_idx` (`SL_ID`),
  KEY `fk_ledger_semester_ledger_list_detail2_idx` (`ROLL_NO`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `log_numbers`
--

CREATE TABLE IF NOT EXISTS `log_numbers` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `mobile_number` varchar(20) NOT NULL,
  `roll_no` varchar(20) NOT NULL,
  `rec_date` date NOT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5801 ;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `noti_date` date NOT NULL,
  `batch_id` int(11) NOT NULL,
  `message` varchar(400) NOT NULL,
  `total_sent_msg` int(11) NOT NULL,
  PRIMARY KEY (`notification_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=165 ;

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

CREATE TABLE IF NOT EXISTS `part` (
  `PART` int(1) DEFAULT NULL,
  `BATCH_ID` int(3) DEFAULT NULL,
  `REMARKS` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `YEAR` date DEFAULT NULL,
  KEY `fk_part_batch1_idx` (`BATCH_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE IF NOT EXISTS `program` (
  `PROG_ID` int(11) NOT NULL,
  `DEPT_ID` int(3) DEFAULT NULL,
  `PROGRAM_TITLE` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `SEM_DURATION` int(3) DEFAULT NULL,
  `SEM_PER_PART` int(1) DEFAULT NULL,
  `REMARKS` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `DEGREE_TITLE` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `SUBJECT` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `GRADUATE_POSTGRADUATE` varchar(1) COLLATE latin1_general_ci DEFAULT NULL,
  `SEM_MONTH_DURATION` varchar(1) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`PROG_ID`),
  KEY `fk_program_department1_idx` (`DEPT_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scheme`
--

CREATE TABLE IF NOT EXISTS `scheme` (
  `SCHEME_ID` int(4) NOT NULL,
  `DEPT_ID` int(3) NOT NULL,
  `PROG_ID` int(3) NOT NULL,
  `YEAR` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `REMARKS` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `MIN_MARKS` int(3) DEFAULT NULL,
  `GROUP_DESC` varchar(4) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`SCHEME_ID`,`PROG_ID`,`DEPT_ID`),
  KEY `fk_scheme_department1_idx` (`DEPT_ID`),
  KEY `fk_scheme_program1_idx` (`PROG_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scheme_detail`
--

CREATE TABLE IF NOT EXISTS `scheme_detail` (
  `SCHEME_ID` int(3) NOT NULL,
  `SCHEME_PART` int(1) NOT NULL,
  `SEMESTER` int(2) NOT NULL,
  `COURSE_NO` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `COURSE_TITLE` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `CR_HRS` int(2) DEFAULT NULL,
  `MAX_MARKS` int(3) DEFAULT NULL,
  `REMARKS` varchar(2) COLLATE latin1_general_ci DEFAULT NULL,
  `SUBJ_TYPE` varchar(1) COLLATE latin1_general_ci DEFAULT NULL,
  `IS_CREDITABLE` varchar(5) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`SEMESTER`,`SCHEME_ID`,`SCHEME_PART`,`COURSE_NO`),
  KEY `fk_scheme_detail_scheme_semester1_idx` (`SCHEME_ID`),
  KEY `fk_scheme_detail_scheme_semester2_idx` (`SCHEME_PART`),
  KEY `fk_scheme_detail_scheme_semester3_idx` (`SEMESTER`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scheme_part`
--

CREATE TABLE IF NOT EXISTS `scheme_part` (
  `SCHEME_ID` int(4) NOT NULL,
  `SCHEME_PART` int(1) NOT NULL,
  `REMARKS` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`SCHEME_ID`,`SCHEME_PART`),
  KEY `fk_scheme_part_scheme1_idx` (`SCHEME_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scheme_semester`
--

CREATE TABLE IF NOT EXISTS `scheme_semester` (
  `SCHEME_ID` int(4) NOT NULL,
  `SCHEME_PART` int(1) NOT NULL,
  `SEMESTER` int(2) NOT NULL,
  `REMARKS` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`SCHEME_PART`,`SCHEME_ID`,`SEMESTER`),
  KEY `fk_scheme_semester_scheme_part1_idx` (`SCHEME_PART`),
  KEY `fk_scheme_semester_scheme_part2_idx` (`SCHEME_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seat_list`
--

CREATE TABLE IF NOT EXISTS `seat_list` (
  `SL_ID` int(10) NOT NULL,
  `PART` int(2) NOT NULL,
  `BATCH_ID` int(3) NOT NULL,
  `PREP_DATE` date DEFAULT NULL,
  `YEAR` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `REMARKS` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `PART_GROUP` varchar(1) COLLATE latin1_general_ci DEFAULT NULL,
  `TYPE` varchar(1) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`SL_ID`,`PART`,`BATCH_ID`),
  KEY `fk_seat_list_part1_idx` (`PART`),
  KEY `fk_seat_list_part2_idx` (`BATCH_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seat_list_detail`
--

CREATE TABLE IF NOT EXISTS `seat_list_detail` (
  `SL_ID` int(10) NOT NULL,
  `ROLL_NO` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `BATCH_ID` int(3) NOT NULL,
  `PART` int(2) NOT NULL,
  `REMARKS` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `STATUS` varchar(1) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`BATCH_ID`,`SL_ID`,`PART`,`ROLL_NO`),
  KEY `fk_seat_list_detail_batch1_idx` (`BATCH_ID`),
  KEY `fk_seat_list_detail_seat_list1_idx` (`SL_ID`),
  KEY `fk_seat_list_detail_seat_list2_idx` (`PART`),
  KEY `fk_seat_list_detail_student_part1_idx` (`ROLL_NO`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_part`
--

CREATE TABLE IF NOT EXISTS `student_part` (
  `ROLL_NO` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `BATCH_ID` int(3) NOT NULL,
  `PART` int(2) NOT NULL,
  `REMARKS` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`ROLL_NO`,`BATCH_ID`,`PART`),
  KEY `fk_student_part_part1_idx` (`PART`),
  KEY `fk_student_part_student_registration1_idx` (`ROLL_NO`),
  KEY `fk_student_part_student_registration2_idx` (`BATCH_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_registration`
--

CREATE TABLE IF NOT EXISTS `student_registration` (
  `BATCH_ID` int(3) NOT NULL,
  `ROLL_NO` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `TAG_NO` int(5) DEFAULT NULL,
  `NAME` varchar(70) COLLATE latin1_general_ci DEFAULT NULL,
  `FNAME` varchar(70) COLLATE latin1_general_ci DEFAULT NULL,
  `SURNAME` varchar(70) COLLATE latin1_general_ci DEFAULT NULL,
  `GENDER` varchar(5) COLLATE latin1_general_ci DEFAULT NULL,
  `CELL` varchar(15) COLLATE latin1_general_ci DEFAULT NULL,
  `PHONE` varchar(200) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`BATCH_ID`,`ROLL_NO`),
  KEY `fk_student_registration_batch1_idx` (`BATCH_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `DEPT_ID` int(11) NOT NULL,
  `USERS_NAME` varchar(100) NOT NULL,
  `PASSWORD` varchar(100) NOT NULL,
  PRIMARY KEY (`USERS_NAME`),
  KEY `fk_users_department1_idx` (`DEPT_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
