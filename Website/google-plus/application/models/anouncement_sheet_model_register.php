<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Anouncement_sheet_model_register extends  CI_Model
{
	
    public  function getDepartment(){

        $sql = "SELECT DEPT_ID,FAC_ID,INST_ID,DEPT_NAME,IS_INST,CODE,REMARKS FROM department WHERE IS_INST='N' order by DEPT_NAME";

        $query = $this->db->query($sql);
        $result = $query->result_array();

        

        if ($result) {
            return $result;
        } else {
            return false;
        }

    }// end


    public  function getProgram($DEPT_ID){

        $sql = "SELECT PROG_ID,PROGRAM_TITLE FROM program WHERE DEPT_ID=?";

        $query = $this->db->query($sql, array($DEPT_ID));
        $result = $query->result_array();


        if ($result) {
            return $result;
        } else {
            return false;
        }

    }
    public  function getSchemeDetail($PROG_ID,$YEAR,$SEMESTER){

        $sql = "SELECT SCHEME_ID FROM  scheme WHERE  PROG_ID =? AND  YEAR =?";

        $query = $this->db->query($sql, array($PROG_ID,$YEAR));
        $result = $query->result_array();

        $scheme_id=$result[0]['SCHEME_ID'];
        if($scheme_id <> 0){
            $sql = "SELECT COURSE_NO,COURSE_TITLE FROM  scheme_detail WHERE  SCHEME_ID=$scheme_id AND  SEMESTER =$SEMESTER";
            $query = $this->db->query($sql, array($scheme_id));
            $result = $query->result_array();


        }

        if ($result) {
            return $result;
        } else {
            return false;
        }

    }// end




	public  function getBatch($program_id,$dept_id){

        $sql = "select BATCH_ID,PROG_ID,DEPT_ID,YEAR, SHIFT,REMARKS,GROUP_DESC FROM batch WHERE PROG_ID=? and dept_id=?";
        $query = $this->db->query($sql, array($program_id,$dept_id));
        $result = $query->result_array();

        if ($result) {
            return $result;
        } else {
            return false;
        }

    }// end

	
	public  function getPart($batch_id,$part){

        $sql = "select PART, BATCH_ID,REMARKS,YEAR FROM part where batch_id=? and PART=? order by PART";
        $query = $this->db->query($sql, array($batch_id,$part));
        $result = $query->result_array();

        if ($result) {
            return $result;
        } else {
            return false;
        }

    }// end
		
		 public function encode_exam_type($exam_type){

	if($exam_type=="I")$exam_type=" IMP/FAIL ";
	if($exam_type=="R")$exam_type=" REGULAR ";
	if($exam_type=="S")$exam_type=" SPECIAL ";
	
	return $exam_type;
 }//END METHOD
 
public function get_shift_encode($SHIFT){

	if($SHIFT=="M")return "MORNING";
	if($SHIFT=="E")return "EVENING";
	if($SHIFT=="N")return "NOON";

	return $SHIFT;
}//end method

public function get_batch_group_encode($GROUP_DESC){
	if($GROUP_DESC=="COMM")return "COMMERCE";
	if($GROUP_DESC=="ENGG")return "ENGINEERING";
	if($GROUP_DESC=="GNRL")return "GENERAL";
	if($GROUP_DESC=="MEDL")return "MEDICAL";

	return $GROUP_DESC;
}//END METHOD
public function get_batch_year_encode($YEAR){

	if($YEAR==2004)return "2K4";
	if($YEAR==2005)return "2K5";
	if($YEAR==2006)return "2K6";
	if($YEAR==2007)return "2K7";
	if($YEAR==2008)return "2K8";
	if($YEAR==2009)return "2K9";
	if($YEAR==20010)return "2K10";
	if($YEAR==20011)return "2K11";
	if($YEAR==20012)return "2K12";
	if($YEAR==20013)return "2K13";
	if($YEAR==20014)return "2K14";
	if($YEAR==20015)return "2K15";
	if($YEAR==20016)return "2K16";
	if($YEAR==20017)return "2K17";
	if($YEAR==20018)return "2K18";
	if($YEAR==20019)return "2K19";
	if($YEAR==2020)return "2K20";
	if($YEAR==2021)return "2K21";
	if($YEAR==2022)return "2K22";
	if($YEAR==2023)return "2K23";
	if($YEAR==2024)return "2K24";
	if($YEAR==2025)return "2K25";
	if($YEAR==2026)return "2K26";
	if($YEAR==2027)return "2K27";
	if($YEAR==2028)return "2K28";
	if($YEAR==2029)return "2K29";
	if($YEAR==2030)return "2K30";

	return $YEAR;
}//end method

	public  function getSeatlistLedger($batch_id,$part,$exam_year,$COURSE_NO){

        $sql = "SELECT SL.SL_ID, SL.PART,SL.BATCH_ID,SL.PREP_DATE,SL.YEAR,SL.REMARKS,SL.PART_GROUP,SL.TYPE ,P.`REMARKS`
FROM seat_list SL, ledger L , part P
 WHERE SL.BATCH_ID=? 
 AND SL.PART=?
 AND SL.year=? 
 AND P.`BATCH_ID`=SL.`BATCH_ID`
 AND L.`SL_ID`=LD.`SL_ID`
 AND L.`SCHEME_ID`=LD.`SCHEME_ID`
 AND SL.SL_ID=L.SL_ID AND SL.PART=L.SCHEME_PART";
		//AND (L.IS_ANNOUNCED='N' OR L.IS_ANNOUNCED=NULL)";
        $query = $this->db->query($sql, array($batch_id,$part,$exam_year,$COURSE_NO));
        $result = $query->result_array();
		//echo($sql);
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