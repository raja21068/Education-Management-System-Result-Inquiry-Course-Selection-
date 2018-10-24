<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Anouncement_sheet_model extends  CI_Model
{
	public  function getAnnouncementSheet($email){

	$sql = "SELECT sr.`NAME`,sr.`FNAME`, sr.`SURNAME`, TEACHER_ID,TEACHER_CODE,SCHEME_ID,ldt.BATCH_ID,SL_ID,sr.ROLL_NO, MARKS_OBTAINED, GRADE, COURSE_NO,MIN_MARKS,ldt.REMARKS,COURSE_TITLE,REMARKS_PROGRAM_NAME,IS_LOCKED,SEMESTER FROM ledger_details_teacher AS ldt
			INNER JOIN `student_registration` AS sr ON sr.`BATCH_ID`=ldt.`BATCH_ID` AND ldt.`ROLL_NO`=sr.`ROLL_NO`
			WHERE TEACHER_CODE=?";

        $query = $this->db->query($sql, array($email));
        $result = $query->result_array();

        if ($result) {
            return $result;
        } else {
            return false;
        }

    }// end

    public  function getDepartmentName($scheme_id){

        $sql = "SELECT `INST_ID`,d.DEPT_ID,d.`DEPT_NAME`,d.`IS_INST` FROM `scheme` AS s
        INNER JOIN `department` AS d ON d.`DEPT_ID`=s.`DEPT_ID`
        WHERE s.`SCHEME_ID`=?";

        $query = $this->db->query($sql, array($scheme_id));
        $result = $query->result_array();

        $inst_id=$result[0]['INST_ID'];
        if($inst_id <> 0){
            $sql = "SELECT `INST_ID`,d.DEPT_ID,d.`DEPT_NAME`,d.`IS_INST` FROM `department` AS d
              WHERE d.DEPT_ID=$inst_id";
            $query = $this->db->query($sql, array($scheme_id));
            $result = $query->result_array();


        }

        if ($result) {
            return $result;
        } else {
            return false;
        }

    }// end


    public  function getSecheme($scheme_id,$semester,$courseNo){

        $sql = "SELECT * FROM `scheme_detail` AS sd WHERE `SCHEME_ID`=?  AND `SEMESTER`=? AND `COURSE_NO`=?";

        $query = $this->db->query($sql, array($scheme_id,$semester,$courseNo));
        $result = $query->result_array();


        if ($result) {
            return $result;
        } else {
            return false;
        }

    }



	public  function getStudent($batch_id,$roll_no){

        $sql = "select BATCH_ID,ROLL_NO,NAME,FNAME,SURNAME,GENDER from  student_registration where ROLL_NO='?' AND BATCH_ID='?'";
        $query = $this->db->query($sql, array($batch_id,$roll_no));
        $result = $query->result_array();

        if ($result) {
            return $result;
        } else {
            return false;
        }

    }// end


    public  function getCourseScheme($COURSE_NO,$SCHEME_ID){

        $sql = "SELECT CR_HRS FROM scheme_detail WHERE COURSE_NO=? AND SCHEME_ID=?";
        $query = $this->db->query($sql, array($COURSE_NO,$SCHEME_ID));
        $result = $query->result_array();

        if ($result) {
            return $result;
        } else {
            return false;
        }

    }// end
    public  function updateLedgerDetailTeacher($MARKS_OBTAINED,$grade,$remarks,$qp,$ROLL_NO,$TEACHER_CODE,$SL_ID){

        $sql = "UPDATE  ledger_details_teacher SET MARKS_OBTAINED=?,GRADE=?,REMARKS=?,QP=? WHERE ROLL_NO=? AND TEACHER_CODE=?  AND SL_ID=?";
        $query = $this->db->query($sql, array($MARKS_OBTAINED,$grade,$remarks,$qp,$ROLL_NO,$TEACHER_CODE,$SL_ID));

        $result = $query;
        //echo($sql);
        if ($result) {
            return $result;
        } else {
            return false;
        }

    }
    public  function lockLedgerDetailTeacher($TEACHER_CODE,$SL_ID){

        $sql = "UPDATE  ledger_details_teacher SET IS_LOCKED=1  WHERE TEACHER_CODE=?  AND SL_ID=?";
        $query = $this->db->query($sql, array($TEACHER_CODE,$SL_ID));

        $result = $query;
        //echo($sql);
        if ($result) {
            return $result;
        } else {
            return false;
        }

    }

	public function searchAnnouncementSheet($email){

        $sql = "SELECT TEACHER_ID,SCHEME_ID,BATCH_ID,SL_ID,ROLL_NO, MARKS_OBTAINED, GRADE, COURSE_NO,MIN_MARKS,REMARKS,COURSE_TITLE,REMARKS_PROGRAM_NAME FROM ledger_details_teacher WHERE TEACHER_CODE='?'";
        $query = $this->db->query($sql, array($email));
        $result = $query->result_array();

        if ($result) {
            return $result;
        } else {
            return false;
        }

    }// end

    public  function getDistinictTeacherCode($teacherId){

        $sql = "SELECT DISTINCT(`TEACHER_CODE`),`COURSE_TITLE`,`REMARKS_PROGRAM_NAME` FROM `ledger_details_teacher` AS ldt WHERE `TEACHER_ID`=?";

        $query = $this->db->query($sql, array($teacherId));
        $result = $query->result_array();


        if ($result) {
            return $result;
        } else {
            return false;
        }

    }
    public  function getTeacherId($email){

        $sql = "SELECT * FROM `faculty_members`  WHERE `EMAIL_ADRESS`=?";

        $query = $this->db->query($sql, array($email));
        $result = $query->result_array();


        if ($result) {
            return $result;
        } else {
            return false;
        }

    }


}