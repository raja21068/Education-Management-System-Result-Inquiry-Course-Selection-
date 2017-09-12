SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `stbbedup_exam` DEFAULT CHARACTER SET latin1 ;
USE `stbbedup_exam` ;

-- -----------------------------------------------------
-- Table `stbbedup_exam`.`faculty`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stbbedup_exam`.`faculty` ;

CREATE  TABLE IF NOT EXISTS `stbbedup_exam`.`faculty` (
  `FAC_ID` INT(3) NOT NULL DEFAULT '0' ,
  `FAC_NAME` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NOT NULL ,
  `REMARKS` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  PRIMARY KEY (`FAC_ID`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_general_ci;


-- -----------------------------------------------------
-- Table `stbbedup_exam`.`department`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stbbedup_exam`.`department` ;

CREATE  TABLE IF NOT EXISTS `stbbedup_exam`.`department` (
  `DEPT_ID` INT(3) NOT NULL AUTO_INCREMENT ,
  `FAC_ID` INT(3) NULL DEFAULT NULL ,
  `INST_ID` INT(3) NULL DEFAULT NULL ,
  `DEPT_NAME` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `IS_INST` VARCHAR(1) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `CODE` VARCHAR(5) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `REMARKS` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  PRIMARY KEY (`DEPT_ID`) ,
  INDEX `fk_department_faculty_idx` (`FAC_ID` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_general_ci;


-- -----------------------------------------------------
-- Table `stbbedup_exam`.`program`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stbbedup_exam`.`program` ;

CREATE  TABLE IF NOT EXISTS `stbbedup_exam`.`program` (
  `PROG_ID` INT NOT NULL ,
  `DEPT_ID` INT(3) NULL DEFAULT NULL ,
  `PROGRAM_TITLE` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `SEM_DURATION` INT(3) NULL DEFAULT NULL ,
  `SEM_PER_PART` INT(1) NULL DEFAULT NULL ,
  `REMARKS` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `DEGREE_TITLE` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `SUBJECT` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `GRADUATE_POSTGRADUATE` VARCHAR(1) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `SEM_MONTH_DURATION` VARCHAR(1) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NOT NULL ,
  INDEX `fk_program_department1_idx` (`DEPT_ID` ASC) ,
  PRIMARY KEY (`PROG_ID`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_general_ci;


-- -----------------------------------------------------
-- Table `stbbedup_exam`.`scheme`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stbbedup_exam`.`scheme` ;

CREATE  TABLE IF NOT EXISTS `stbbedup_exam`.`scheme` (
  `SCHEME_ID` INT(4) NOT NULL ,
  `DEPT_ID` INT(3) NOT NULL,
  `PROG_ID` INT(3) NOT NULL,
  `YEAR` VARCHAR(10) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `REMARKS` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `MIN_MARKS` INT(3) NULL DEFAULT NULL ,
  `GROUP_DESC` VARCHAR(4) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  INDEX `fk_scheme_department1_idx` (`DEPT_ID` ASC) ,
  INDEX `fk_scheme_program1_idx` (`PROG_ID` ASC) ,
  PRIMARY KEY (`SCHEME_ID`, `PROG_ID`, `DEPT_ID`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_general_ci;


-- -----------------------------------------------------
-- Table `stbbedup_exam`.`scheme_part`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stbbedup_exam`.`scheme_part` ;

CREATE  TABLE IF NOT EXISTS `stbbedup_exam`.`scheme_part` (
  `SCHEME_ID` INT(4) NOT NULL DEFAULT NULL ,
  `SCHEME_PART` INT(1) NULL DEFAULT NULL ,
  `REMARKS` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  INDEX `fk_scheme_part_scheme1_idx` (`SCHEME_ID` ASC) ,
  PRIMARY KEY (`SCHEME_ID`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_general_ci;


-- -----------------------------------------------------
-- Table `stbbedup_exam`.`conc_area`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stbbedup_exam`.`conc_area` ;

CREATE  TABLE IF NOT EXISTS `stbbedup_exam`.`conc_area` (
  `AC_ID` INT NOT NULL ,
  `SCHEME_ID` INT(3) NOT NULL ,
  `SCHEME_PART` INT(1) NOT NULL DEFAULT NULL ,
  `TITLE` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `DESCRIPTION` VARCHAR(100) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `REMARKS` VARCHAR(100) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  INDEX `fk_conc_area_scheme_part1_idx` (`SCHEME_PART` ASC) ,
  INDEX `fk_conc_area_scheme_part2_idx` (`SCHEME_ID` ASC) ,
  PRIMARY KEY (`SCHEME_PART`, `SCHEME_ID`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_general_ci;


-- -----------------------------------------------------
-- Table `stbbedup_exam`.`ac_scheme_detail`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stbbedup_exam`.`ac_scheme_detail` ;

CREATE  TABLE IF NOT EXISTS `stbbedup_exam`.`ac_scheme_detail` (
  `SCHEME_ID` INT(3) NOT NULL DEFAULT NULL ,
  `SCHEME_PART` INT(1) NOT NULL DEFAULT NULL ,
  `AC_ID` INT(10) NOT NULL DEFAULT NULL ,
  `COURSE_NO` VARCHAR(15) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `COURSE_TITLE` VARCHAR(100) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `CR_HRS` INT(2) NULL DEFAULT NULL ,
  `MAX_MARKS` INT(3) NULL DEFAULT NULL ,
  `REMARKS` VARCHAR(2) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `SEMESTER` INT(1) NULL DEFAULT NULL ,
  `IS_CREDITABLE` VARCHAR(5) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  INDEX `fk_ac_scheme_detail_conc_area1_idx` (`AC_ID` ASC) ,
  INDEX `fk_ac_scheme_detail_conc_area2_idx` (`SCHEME_ID` ASC) ,
  INDEX `fk_ac_scheme_detail_conc_area3_idx` (`SCHEME_PART` ASC) ,
  PRIMARY KEY (`SCHEME_ID`, `AC_ID`, `SCHEME_PART`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_general_ci;


-- -----------------------------------------------------
-- Table `stbbedup_exam`.`batch`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stbbedup_exam`.`batch` ;

CREATE  TABLE IF NOT EXISTS `stbbedup_exam`.`batch` (
  `BATCH_ID` INT(3) NOT NULL DEFAULT '0' ,
  `PROG_ID` INT(3) NULL DEFAULT NULL ,
  `DEPT_ID` INT(3) NULL DEFAULT NULL ,
  `RUL_ID` INT(4) NULL DEFAULT NULL ,
  `YEAR` VARCHAR(10) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `SHIFT` VARCHAR(1) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `REMARKS` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `GROUP_DESC` VARCHAR(4) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  PRIMARY KEY (`BATCH_ID`) ,
  INDEX `fk_batch_program1_idx` (`DEPT_ID` ASC) ,
  INDEX `fk_batch_program1_idx1` (`PROG_ID` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_general_ci;


-- -----------------------------------------------------
-- Table `stbbedup_exam`.`comments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stbbedup_exam`.`comments` ;

CREATE  TABLE IF NOT EXISTS `stbbedup_exam`.`comments` (
  `MessageType` TEXT NULL DEFAULT NULL ,
  `Subject` TEXT NULL DEFAULT NULL ,
  `Comments` TEXT NULL DEFAULT NULL ,
  `Username` TEXT NULL DEFAULT NULL ,
  `UserEmail` TEXT NULL DEFAULT NULL ,
  `UserTel` TEXT NULL DEFAULT NULL ,
  `UserFAX` TEXT NULL DEFAULT NULL ,
  `to_day_date` DATE NULL DEFAULT NULL )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `stbbedup_exam`.`item_requisition`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stbbedup_exam`.`item_requisition` ;

CREATE  TABLE IF NOT EXISTS `stbbedup_exam`.`item_requisition` (
  `REQ_ID` INT(10) NOT NULL ,
  `SL_ID` INT(10) NULL DEFAULT NULL ,
  `ROLL_NO` VARCHAR(15) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `SL_TYPE` VARCHAR(1) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `CHALLAN_NO` INT(10) NULL DEFAULT NULL ,
  `CHALLAN_DATE` DATE NULL DEFAULT NULL ,
  `ITEM_ID` INT(10) NULL DEFAULT NULL ,
  `REQ_DATE` DATE NULL DEFAULT NULL ,
  `DELEIVERY_DATE` DATE NULL DEFAULT NULL ,
  `ISSUED_CERT_NO` VARCHAR(10) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `ISSUED_DATE` DATE NULL DEFAULT NULL ,
  `REQ_STATUS` CHAR(1) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `ARCHIVE` VARCHAR(1) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `REMARKS` VARCHAR(100) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  PRIMARY KEY (`REQ_ID`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_general_ci;


-- -----------------------------------------------------
-- Table `stbbedup_exam`.`part`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stbbedup_exam`.`part` ;

CREATE  TABLE IF NOT EXISTS `stbbedup_exam`.`part` (
  `PART` INT(1) NULL DEFAULT NULL ,
  `BATCH_ID` INT(3) NULL DEFAULT NULL ,
  `REMARKS` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `YEAR` DATE NULL DEFAULT NULL ,
  INDEX `fk_part_batch1_idx` (`BATCH_ID` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_general_ci;


-- -----------------------------------------------------
-- Table `stbbedup_exam`.`seat_list`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stbbedup_exam`.`seat_list` ;

CREATE  TABLE IF NOT EXISTS `stbbedup_exam`.`seat_list` (
  `SL_ID` INT(10) NOT NULL ,
  `PART` INT(2) NOT NULL DEFAULT NULL ,
  `BATCH_ID` INT(3) NOT NULL DEFAULT NULL ,
  `PREP_DATE` DATE NULL DEFAULT NULL ,
  `YEAR` VARCHAR(10) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `REMARKS` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `PART_GROUP` VARCHAR(1) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `TYPE` VARCHAR(1) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  PRIMARY KEY (`SL_ID`, `PART`, `BATCH_ID`) ,
  INDEX `fk_seat_list_part1_idx` (`PART` ASC) ,
  INDEX `fk_seat_list_part2_idx` (`BATCH_ID` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_general_ci;


-- -----------------------------------------------------
-- Table `stbbedup_exam`.`ledger`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stbbedup_exam`.`ledger` ;

CREATE  TABLE IF NOT EXISTS `stbbedup_exam`.`ledger` (
  `SL_ID` INT(10) NOT NULL ,
  `SCHEME_ID` INT(4) NOT NULL ,
  `SCHEME_PART` INT(1) NOT NULL ,
  `ANN_DATE` DATE NOT NULL ,
  `TOTAL_PASS` INT(4) NOT NULL ,
  `TOTAL_FAIL` INT(4) NOT NULL ,
  `REMARKS` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `TABULATOR_NAME` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `CHECKER_NAME` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `IS_ANNOUNCED` VARCHAR(1) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  INDEX `fk_ledger_seat_list1_idx` (`SL_ID` ASC) ,
  INDEX `fk_ledger_scheme1_idx` (`SCHEME_ID` ASC) ,
  PRIMARY KEY (`SCHEME_ID`, `SL_ID`, `SCHEME_PART`) ,
  INDEX `fk_ledger_seat_list2_idx` (`SCHEME_PART` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_general_ci;


-- -----------------------------------------------------
-- Table `stbbedup_exam`.`ledger_detail_summary`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stbbedup_exam`.`ledger_detail_summary` ;

CREATE  TABLE IF NOT EXISTS `stbbedup_exam`.`ledger_detail_summary` (
  `SL_ID` INT(10) NULL DEFAULT NULL ,
  `ROLL_NO` VARCHAR(15) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `TOTAL_MARKS` INT(6) NULL DEFAULT NULL ,
  `RESULT_REMARKS` VARCHAR(20) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `PERCENTAGE` DOUBLE(6,2) NULL DEFAULT NULL ,
  `INDV_RESULT_ANN_DATE` DATE NULL DEFAULT NULL ,
  `CGPA` DOUBLE(6,2) NULL DEFAULT NULL ,
  `OBTAIN_MARKS` INT(6) NULL DEFAULT NULL ,
  `NO_DUES_REMARKS` VARCHAR(20) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `PREV_PART` INT(1) NULL DEFAULT NULL ,
  `PREV_ROLL_NO` VARCHAR(18) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `PREV_SL_ID` INT(10) NULL DEFAULT NULL ,
  `PREV_RESULT_REMARKS` VARCHAR(10) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `AC_II_NO` VARCHAR(9) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `AC_II_NO_DATED` DATE NULL DEFAULT NULL ,
  `PREV_CGPA` DOUBLE(6,2) NULL DEFAULT NULL ,
  `PREV_OBTAIN_MARKS` INT(6) NULL DEFAULT NULL ,
  `PREV_PERCENTAGE` DOUBLE(6,2) NULL DEFAULT NULL ,
  `PREV_TOTAL_MARKS` INT(6) NULL DEFAULT NULL ,
  `PRE_YEAR` VARCHAR(10) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `PRE_TYPE` VARCHAR(1) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `PREV_BATCH_ID` INT(4) NULL DEFAULT NULL ,
  `CURRENT_RESULT_REMARKS` VARCHAR(20) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  INDEX `fk_ledger_detail_summary_seat_list1_idx` (`SL_ID` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_general_ci;


-- -----------------------------------------------------
-- Table `stbbedup_exam`.`student_registration`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stbbedup_exam`.`student_registration` ;

CREATE  TABLE IF NOT EXISTS `stbbedup_exam`.`student_registration` (
  `BATCH_ID` INT(3) NULL DEFAULT NULL ,
  `ROLL_NO` VARCHAR(15) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `TAG_NO` INT(5) NULL DEFAULT NULL ,
  `NAME` VARCHAR(70) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `FNAME` VARCHAR(70) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `SURNAME` VARCHAR(70) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `GENDER` VARCHAR(5) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `CELL` VARCHAR(15) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `PHONE` VARCHAR(200) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NOT NULL ,
  INDEX `fk_student_registration_batch1_idx` (`BATCH_ID` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_general_ci;


-- -----------------------------------------------------
-- Table `stbbedup_exam`.`student_part`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stbbedup_exam`.`student_part` ;

CREATE  TABLE IF NOT EXISTS `stbbedup_exam`.`student_part` (
  `ROLL_NO` VARCHAR(15) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NOT NULL DEFAULT NULL ,
  `BATCH_ID` INT(3) NOT NULL DEFAULT NULL ,
  `PART` INT(2) NOT NULL DEFAULT NULL ,
  `REMARKS` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  INDEX `fk_student_part_part1_idx` (`PART` ASC) ,
  INDEX `fk_student_part_student_registration1_idx` (`ROLL_NO` ASC) ,
  INDEX `fk_student_part_student_registration2_idx` (`BATCH_ID` ASC) ,
  PRIMARY KEY (`ROLL_NO`, `BATCH_ID`, `PART`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_general_ci;


-- -----------------------------------------------------
-- Table `stbbedup_exam`.`seat_list_detail`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stbbedup_exam`.`seat_list_detail` ;

CREATE  TABLE IF NOT EXISTS `stbbedup_exam`.`seat_list_detail` (
  `SL_ID` INT(10) NOT NULL DEFAULT NULL ,
  `ROLL_NO` VARCHAR(15) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NOT NULL DEFAULT NULL ,
  `BATCH_ID` INT(3) NOT NULL DEFAULT NULL ,
  `PART` INT(2) NOT NULL DEFAULT NULL ,
  `REMARKS` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `STATUS` VARCHAR(1) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  INDEX `fk_seat_list_detail_batch1_idx` (`BATCH_ID` ASC) ,
  INDEX `fk_seat_list_detail_seat_list1_idx` (`SL_ID` ASC) ,
  INDEX `fk_seat_list_detail_seat_list2_idx` (`PART` ASC) ,
  PRIMARY KEY (`BATCH_ID`, `SL_ID`, `PART`, `ROLL_NO`) ,
  INDEX `fk_seat_list_detail_student_part1_idx` (`ROLL_NO` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_general_ci;


-- -----------------------------------------------------
-- Table `stbbedup_exam`.`ledger_list_detail`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stbbedup_exam`.`ledger_list_detail` ;

CREATE  TABLE IF NOT EXISTS `stbbedup_exam`.`ledger_list_detail` (
  `SL_ID` INT(10) NOT NULL DEFAULT NULL ,
  `ROLL_NO` VARCHAR(15) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NOT NULL DEFAULT NULL ,
  `REMARKS` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  INDEX `fk_ledger_list_detail_seat_list_detail1_idx` (`SL_ID` ASC) ,
  INDEX `fk_ledger_list_detail_seat_list_detail2_idx` (`ROLL_NO` ASC) ,
  PRIMARY KEY (`SL_ID`, `ROLL_NO`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_general_ci;


-- -----------------------------------------------------
-- Table `stbbedup_exam`.`ledger_semester`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stbbedup_exam`.`ledger_semester` ;

CREATE  TABLE IF NOT EXISTS `stbbedup_exam`.`ledger_semester` (
  `SEMESTER` INT(2) NULL DEFAULT NULL ,
  `SL_ID` INT(10) NOT NULL DEFAULT NULL ,
  `ROLL_NO` VARCHAR(15) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NOT NULL DEFAULT NULL ,
  `REMARKS` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  INDEX `fk_ledger_semester_ledger_list_detail1_idx` (`SL_ID` ASC) ,
  INDEX `fk_ledger_semester_ledger_list_detail2_idx` (`ROLL_NO` ASC) ,
  PRIMARY KEY (`SL_ID`, `ROLL_NO`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_general_ci;


-- -----------------------------------------------------
-- Table `stbbedup_exam`.`scheme_semester`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stbbedup_exam`.`scheme_semester` ;

CREATE  TABLE IF NOT EXISTS `stbbedup_exam`.`scheme_semester` (
  `SCHEME_ID` INT(4) NOT NULL DEFAULT NULL ,
  `SCHEME_PART` INT(1) NOT NULL DEFAULT NULL ,
  `SEMESTER` INT(2) NULL DEFAULT NULL ,
  `REMARKS` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  INDEX `fk_scheme_semester_scheme_part1_idx` (`SCHEME_PART` ASC) ,
  INDEX `fk_scheme_semester_scheme_part2_idx` (`SCHEME_ID` ASC) ,
  PRIMARY KEY (`SCHEME_PART`, `SCHEME_ID`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_general_ci;


-- -----------------------------------------------------
-- Table `stbbedup_exam`.`scheme_detail`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stbbedup_exam`.`scheme_detail` ;

CREATE  TABLE IF NOT EXISTS `stbbedup_exam`.`scheme_detail` (
  `SCHEME_ID` INT(3) NOT NULL DEFAULT NULL ,
  `SCHEME_PART` INT(1) NOT NULL DEFAULT NULL ,
  `SEMESTER` INT(2) NOT NULL DEFAULT NULL ,
  `COURSE_NO` VARCHAR(15) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `COURSE_TITLE` VARCHAR(100) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `CR_HRS` INT(2) NULL DEFAULT NULL ,
  `MAX_MARKS` INT(3) NULL DEFAULT NULL ,
  `REMARKS` VARCHAR(2) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `SUBJ_TYPE` VARCHAR(1) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `IS_CREDITABLE` VARCHAR(5) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  INDEX `fk_scheme_detail_scheme_semester1_idx` (`SCHEME_ID` ASC) ,
  INDEX `fk_scheme_detail_scheme_semester2_idx` (`SCHEME_PART` ASC) ,
  INDEX `fk_scheme_detail_scheme_semester3_idx` (`SEMESTER` ASC) ,
  PRIMARY KEY (`SEMESTER`, `SCHEME_ID`, `SCHEME_PART`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_general_ci;


-- -----------------------------------------------------
-- Table `stbbedup_exam`.`ledger_details`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stbbedup_exam`.`ledger_details` ;

CREATE  TABLE IF NOT EXISTS `stbbedup_exam`.`ledger_details` (
  `SCHEME_ID` INT(10) NOT NULL DEFAULT NULL ,
  `SCHEME_PART` INT(1) NOT NULL DEFAULT NULL ,
  `AC_ID` INT(10) NOT NULL ,
  `SL_ID` INT(10) NOT NULL DEFAULT NULL ,
  `ROLL_NO` VARCHAR(15) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NOT NULL DEFAULT NULL ,
  `SEMESTER` INT(2) NOT NULL DEFAULT NULL ,
  `COURSE_NO` VARCHAR(15) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `MARKS_OBTAINED` INT(3) NULL DEFAULT NULL ,
  `GRADE` VARCHAR(5) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `REMARKS` VARCHAR(50) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NULL DEFAULT NULL ,
  `MIN_MARKS` INT(3) NULL DEFAULT NULL ,
  `QP` DOUBLE(5,2) NULL DEFAULT NULL ,
  `UNI_MARKS_OBTAINED` VARCHAR(100) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NOT NULL ,
  `COLLEGE_MARKS_OBTAINED` VARCHAR(100) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NOT NULL ,
  `REF_NO` VARCHAR(100) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NOT NULL ,
  `REF_DATE` VARCHAR(100) CHARACTER SET 'latin1' COLLATE 'latin1_general_ci' NOT NULL ,
  INDEX `fk_ledger_details_ledger_semester1_idx` (`SL_ID` ASC) ,
  INDEX `fk_ledger_details_ledger_semester2_idx` (`ROLL_NO` ASC) ,
  INDEX `fk_ledger_details_ledger_semester3_idx` (`SEMESTER` ASC) ,
  PRIMARY KEY (`SL_ID`, `ROLL_NO`, `SEMESTER`, `SCHEME_ID`, `SCHEME_PART`, `AC_ID`) ,
  INDEX `fk_ledger_details_ledger1_idx` (`SCHEME_ID` ASC) ,
  INDEX `fk_ledger_details_ledger2_idx` (`SCHEME_PART` ASC) ,
  INDEX `fk_ledger_details_conc_area1_idx` (`AC_ID` ASC) ,
  INDEX `fk_ledger_details_scheme_detail4_idx` (`COURSE_NO` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_general_ci;


-- -----------------------------------------------------
-- Table `stbbedup_exam`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `stbbedup_exam`.`users` ;

CREATE  TABLE IF NOT EXISTS `stbbedup_exam`.`users` (
  `DEPT_ID` INT(11) NOT NULL ,
  `USERS_NAME` VARCHAR(100) NOT NULL ,
  `PASSWORD` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`USERS_NAME`) ,
  INDEX `fk_users_department1_idx` (`DEPT_ID` ASC) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;

USE `stbbedup_exam` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
