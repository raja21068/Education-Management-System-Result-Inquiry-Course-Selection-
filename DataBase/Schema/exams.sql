-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2018 at 10:24 AM
-- Server version: 5.6.11
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `exams`
--
CREATE DATABASE IF NOT EXISTS `exams` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `exams`;

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
-- Table structure for table `attandance`
--

CREATE TABLE IF NOT EXISTS `attandance` (
  `COURSE_DISTRIBUTION_ID` int(11) NOT NULL,
  `ROLL_NO` varchar(50) NOT NULL,
  `COURSE_NO` varchar(50) NOT NULL,
  `DATE_OF_ATTANDANCE` date NOT NULL,
  `NO_OF_CLASSES` int(11) NOT NULL,
  `REMARKS` varchar(100) NOT NULL,
  `ISPRESENT` int(1) NOT NULL,
  `SCHEME_ID` int(11) NOT NULL,
  `SEMESTER` int(11) NOT NULL,
  `DEPT_ID` int(11) NOT NULL,
  `PROG_ID` int(11) NOT NULL,
  `SHIFT` varchar(2) NOT NULL,
  `GROUP_DESC` varchar(10) NOT NULL,
  `YEAR` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `to_day_date` date DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1148 ;

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
-- Table structure for table `course_distribution`
--

CREATE TABLE IF NOT EXISTS `course_distribution` (
  `SCHEME_ID` int(11) DEFAULT NULL,
  `COURSE_NO` varchar(100) DEFAULT NULL,
  `COURSE_TITLE` varchar(300) DEFAULT NULL,
  `SEMESTER` varchar(1) DEFAULT NULL,
  `SCHEME_PART` varchar(1) DEFAULT NULL,
  `CR_HRS` varchar(1) DEFAULT NULL,
  `DEPT_ID` int(11) DEFAULT NULL,
  `PROG_ID` int(11) DEFAULT NULL,
  `YEAR` varchar(4) DEFAULT NULL,
  `USER` varchar(200) DEFAULT NULL,
  `PASS` varchar(200) DEFAULT NULL,
  `MEMBER_ID_1` int(11) DEFAULT '0',
  `GROUP_DESC` varchar(10) DEFAULT NULL,
  `SHIFT` varchar(1) DEFAULT NULL,
  `COURSE_DISTRIBUITION_ID` int(11) NOT NULL AUTO_INCREMENT,
  `REMARKS` varchar(100) NOT NULL,
  PRIMARY KEY (`COURSE_DISTRIBUITION_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2614 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=118 ;

-- --------------------------------------------------------

--
-- Table structure for table `exam_form_paper`
--

CREATE TABLE IF NOT EXISTS `exam_form_paper` (
  `idexam_form_paper` int(11) NOT NULL AUTO_INCREMENT,
  `scheme_detail_SEMESTER` int(2) NOT NULL,
  `scheme_detail_SCHEME_ID` int(3) NOT NULL,
  `scheme_detail_COURSE_NO` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `exam_form_student_enlorment_ID` int(11) NOT NULL,
  `scheme_detail_PART` int(11) DEFAULT NULL,
  `AC_ID` int(11) DEFAULT NULL,
  `scheme_detail_CR_HRS` int(2) DEFAULT NULL,
  `scheme_detail_COURSE_TITTLE` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idexam_form_paper`),
  KEY `fk_exam_form_paper_scheme_detail1_idx` (`scheme_detail_SEMESTER`,`scheme_detail_SCHEME_ID`,`scheme_detail_COURSE_NO`),
  KEY `fk_exam_form_paper_exam_form_student_enlorment1_idx` (`exam_form_student_enlorment_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=324137 ;

-- --------------------------------------------------------

--
-- Table structure for table `exam_form_student_enlorment`
--

CREATE TABLE IF NOT EXISTS `exam_form_student_enlorment` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EXAM_TYPE` varchar(45) NOT NULL,
  `DATE_OF_SUMBIT_FORM` date NOT NULL,
  `REMARKS` varchar(45) DEFAULT NULL,
  `student_registration_BATCH_ID` int(3) NOT NULL,
  `student_registration_ROLL_NO` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `CHALLAN_NO` int(11) DEFAULT NULL,
  `CHALLAN_DATE` date DEFAULT NULL,
  `CHALLAN_RS` int(11) DEFAULT NULL,
  `SEMESTER` int(11) DEFAULT NULL,
  `STATUS` varchar(1) DEFAULT 'T',
  `EXAM_YEAR` int(11) DEFAULT NULL,
  `SCHEME_ID` int(11) DEFAULT NULL,
  `NAME` varchar(60) DEFAULT NULL,
  `FNAME` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`ID`,`student_registration_BATCH_ID`,`student_registration_ROLL_NO`),
  KEY `fk_exam_form_student_enlorment_student_registration1_idx` (`student_registration_BATCH_ID`,`student_registration_ROLL_NO`),
  KEY `student_registration_BATCH_ID` (`student_registration_BATCH_ID`,`student_registration_ROLL_NO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60643 ;

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
-- Table structure for table `faculty_members`
--

CREATE TABLE IF NOT EXISTS `faculty_members` (
  `MEMBER_ID` int(11) NOT NULL AUTO_INCREMENT,
  `DEPT_ID` varchar(255) NOT NULL,
  `FIRST_NAME` varchar(255) NOT NULL,
  `LAST_NAME` varchar(255) NOT NULL,
  `EMAIL_ADRESS` varchar(255) NOT NULL,
  `DEPARTMENT_NAME` varchar(255) NOT NULL,
  `PREFIX_ID` int(11) NOT NULL,
  `MOBILE` varchar(13) DEFAULT NULL,
  `POSTEL_ADDRESS` varchar(100) DEFAULT NULL,
  `PERMENT_ADDRESS` varchar(100) DEFAULT NULL,
  `DATE_OF_BIRTH` date DEFAULT NULL,
  `CNIC` varchar(13) DEFAULT NULL,
  `HBL_ACCOUNT_NO` varchar(25) DEFAULT NULL,
  `PROFILE_URL` varchar(75) DEFAULT NULL,
  `ACTIVATE` tinyint(1) DEFAULT '0',
  `EDUCATION` varchar(100) DEFAULT NULL,
  `REMARKS` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`MEMBER_ID`),
  UNIQUE KEY `MEMBER_ID` (`MEMBER_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=813 ;

-- --------------------------------------------------------

--
-- Table structure for table `google_users`
--

CREATE TABLE IF NOT EXISTS `google_users` (
  `google_id` decimal(21,0) NOT NULL,
  `google_name` varchar(60) NOT NULL,
  `google_email` varchar(60) NOT NULL,
  `google_link` varchar(60) NOT NULL,
  `google_picture_link` varchar(60) NOT NULL,
  PRIMARY KEY (`google_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hec_pass_fail_gazet`
--

CREATE TABLE IF NOT EXISTS `hec_pass_fail_gazet` (
  `id` int(11) NOT NULL,
  `roll_no` varchar(110) NOT NULL,
  `name` varchar(100) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `program_part` varchar(100) NOT NULL,
  `exam_year` varchar(100) NOT NULL,
  `cgpa` float NOT NULL,
  `percentage` float NOT NULL,
  `announcement_date` varchar(100) NOT NULL,
  `total_semesters` int(11) NOT NULL,
  `semester_per_part` int(11) NOT NULL,
  `year_of_education` int(11) NOT NULL,
  `semester-month` int(11) NOT NULL,
  `result` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`SL_ID`),
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
  `MARKS_OBTAINED` varchar(3) COLLATE latin1_general_ci DEFAULT NULL,
  `GRADE` varchar(5) COLLATE latin1_general_ci DEFAULT NULL,
  `REMARKS` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `MIN_MARKS` int(3) DEFAULT NULL,
  `QP` double(5,2) DEFAULT NULL,
  `UNI_MARKS_OBTAINED` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `COLLEGE_MARKS_OBTAINED` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `REF_NO` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `REF_DATE` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`SL_ID`,`ROLL_NO`,`SEMESTER`,`COURSE_NO`),
  KEY `fk_ledger_details_ledger_semester1_idx` (`SL_ID`),
  KEY `fk_ledger_details_ledger_semester2_idx` (`ROLL_NO`),
  KEY `fk_ledger_details_ledger_semester3_idx` (`SEMESTER`),
  KEY `fk_ledger_details_ledger1_idx` (`SCHEME_ID`),
  KEY `fk_ledger_details_ledger2_idx` (`SCHEME_PART`),
  KEY `fk_ledger_details_conc_area1_idx` (`AC_ID`),
  KEY `fk_ledger_details_scheme_detail4_idx` (`COURSE_NO`),
  KEY `ROLL_NO` (`ROLL_NO`),
  KEY `ROLL_NO_2` (`ROLL_NO`),
  KEY `SL_ID` (`SL_ID`),
  KEY `SCHEME_ID` (`SCHEME_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

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
  `MARKS_OBTAINED` int(3) DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `ledger_detail_summary`
--

CREATE TABLE IF NOT EXISTS `ledger_detail_summary` (
  `SL_ID` int(10) NOT NULL,
  `ROLL_NO` varchar(15) COLLATE latin1_general_ci NOT NULL,
  `TOTAL_MARKS` int(6) DEFAULT NULL,
  `RESULT_REMARKS` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `PERCENTAGE` decimal(6,2) DEFAULT NULL,
  `INDV_RESULT_ANN_DATE` date DEFAULT NULL,
  `CGPA` decimal(6,2) DEFAULT NULL,
  `OBTAIN_MARKS` int(6) DEFAULT NULL,
  `NO_DUES_REMARKS` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `PREV_PART` int(1) DEFAULT NULL,
  `PREV_ROLL_NO` varchar(18) COLLATE latin1_general_ci DEFAULT NULL,
  `PREV_SL_ID` int(10) DEFAULT NULL,
  `PREV_RESULT_REMARKS` varchar(10) COLLATE latin1_general_ci DEFAULT NULL,
  `AC_II_NO` varchar(9) COLLATE latin1_general_ci DEFAULT NULL,
  `AC_II_NO_DATED` date DEFAULT NULL,
  `PREV_CGPA` decimal(6,2) DEFAULT NULL,
  `PREV_OBTAIN_MARKS` int(6) DEFAULT NULL,
  `PREV_PERCENTAGE` decimal(6,2) DEFAULT NULL,
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21424 ;

-- --------------------------------------------------------

--
-- Table structure for table `marksheet_announcement`
--

CREATE TABLE IF NOT EXISTS `marksheet_announcement` (
  `DEPT_ID` int(3) NOT NULL AUTO_INCREMENT,
  `DEPT_NAME` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `DATE_OF_ANNOUNCE` date NOT NULL,
  `IS_ANNOUNCE` int(1) NOT NULL,
  PRIMARY KEY (`DEPT_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=88 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=264 ;

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

CREATE TABLE IF NOT EXISTS `part` (
  `PART` int(1) NOT NULL,
  `BATCH_ID` int(3) NOT NULL,
  `REMARKS` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `YEAR` date DEFAULT NULL,
  PRIMARY KEY (`PART`,`BATCH_ID`),
  KEY `fk_part_batch1_idx` (`BATCH_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prefix_type`
--

CREATE TABLE IF NOT EXISTS `prefix_type` (
  `PREFIX_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PREFIX_NAME` varchar(255) NOT NULL,
  `REMARKS` varchar(255) NOT NULL,
  `ORDERBY` int(11) NOT NULL,
  PRIMARY KEY (`PREFIX_ID`),
  KEY `PREFIX_ID` (`PREFIX_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE IF NOT EXISTS `program` (
  `PROG_ID` int(6) NOT NULL,
  `DEPT_ID` int(3) NOT NULL,
  `PROGRAM_TITLE` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `SEM_DURATION` int(3) DEFAULT NULL,
  `SEM_PER_PART` int(1) DEFAULT NULL,
  `REMARKS` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `DEGREE_TITLE` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `SUBJECT` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `GRADUATE_POSTGRADUATE` varchar(1) COLLATE latin1_general_ci DEFAULT NULL,
  `SEM_MONTH_DURATION` varchar(1) COLLATE latin1_general_ci DEFAULT NULL,
  `PRE-REQUEST` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`PROG_ID`,`DEPT_ID`),
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
  `COURSE_TITLE` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `CR_HRS` int(2) DEFAULT NULL,
  `MAX_MARKS` int(3) DEFAULT NULL,
  `REMARKS` varchar(2) COLLATE latin1_general_ci DEFAULT NULL,
  `SUBJ_TYPE` varchar(1) COLLATE latin1_general_ci DEFAULT NULL,
  `IS_CREDITABLE` varchar(5) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`SCHEME_ID`,`SCHEME_PART`,`SEMESTER`,`COURSE_NO`,`COURSE_TITLE`),
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
  PRIMARY KEY (`SL_ID`),
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
  PRIMARY KEY (`SL_ID`,`ROLL_NO`),
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
  `HOME_ADDRESS` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `PERMANENT_ADDRESS` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `REMARKS` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `REF_NO` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `REF_DATE` datetime NOT NULL,
  `NIC` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `DISTRICT` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `U_R` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `CANDIDATE_ID` int(10) DEFAULT NULL,
  `NATIONALITY` varchar(15) COLLATE latin1_general_ci DEFAULT NULL,
  `EMAIL` varbinary(40) DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE IF NOT EXISTS `year` (
  `YEAR_ID` int(11) NOT NULL AUTO_INCREMENT,
  `YEAR` int(11) NOT NULL,
  `REMARKS` varchar(100) NOT NULL,
  PRIMARY KEY (`YEAR_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- Table structure for table `zemail_students`
--

CREATE TABLE IF NOT EXISTS `zemail_students` (
  `ROLL_NO` varchar(100) NOT NULL,
  `R1` varchar(100) NOT NULL,
  `R2` varchar(100) NOT NULL,
  `R3` varchar(100) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `FNAME` varchar(100) NOT NULL,
  `SURNAME` varchar(100) NOT NULL,
  `GENDER` varchar(100) NOT NULL,
  `CELL` varchar(100) NOT NULL,
  `PHONE` varchar(100) NOT NULL,
  `DEPARTMENT` varchar(100) NOT NULL,
  `YEAR` varchar(100) NOT NULL,
  `PROGRAM` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
