<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Course_distribution_model extends  CI_Model
{
	public  function getCourseDistribution($progId,$groupDesc,$shift){

	$sql = "SELECT * FROM `course_distribution` AS cd WHERE cd.PROG_ID=? and group_desc=? and shift=? ORDER BY SEMESTER";

        $query = $this->db->query($sql, array($progId,$groupDesc,$shift));
        $result = $query->result_array();

        if ($result) {
            return $result;
        } else {
            return false;
        }

    }// end
	
		public  function printCourseDistribution($progId,$groupDesc,$shift){

		$sql = "SELECT cd.`COURSE_TITLE`,cd.`COURSE_NO`,cd.`SEMESTER`,cd.`SCHEME_PART`,cd.`PASS`,cd.`PROG_ID`,(SELECT CONCAT( FIRST_NAME,' ',LAST_NAME) FROM `faculty_members` AS fm WHERE fm.MEMBER_ID=cd.MEMBER_ID_1) AS NAME1  FROM `course_distribution` AS cd 

						 WHERE cd.PROG_ID=? and group_desc=? and shift=?
						  ORDER BY SEMESTER";

        $query = $this->db->query($sql, array($progId,$groupDesc,$shift));
        $result = $query->result_array();

        if ($result) {
            return $result;
        } else {
            return false;
        }

    }// end



    public  function distinictSchemeIdDepartmentWise($user,$pass){

    //     $sql = "SELECT DISTINCT(SCHEME_ID),cd.`PROG_ID`,cd.`SHIFT`,cd.`GROUP_DESC`,p.`PROGRAM_TITLE`,cd.PART_REMARKS FROM `course_distribution` AS cd
				// 	INNER JOIN `program` AS p ON p.`PROG_ID`=cd.`PROG_ID`
				// 	 WHERE cd.`USER`=?  AND cd.`PASS`=?";
				
				
$sql = "SELECT DISTINCT cd.PROG_ID,cd.`SHIFT`,cd.`GROUP_DESC`,p.PROGRAM_TITLE FROM `course_distribution` AS cd,program as p WHERE cd.`USER`=?  AND cd.`PASS`=? and p.prog_id=cd.prog_id order by shift,group_desc";

				
				

        $query = $this->db->query($sql, array($user,$pass));
        $result = $query->result_array();

        if ($result) {
            return $result;
        } else {
            return false;
        }

    }// end

    public  function getFacultyMember(){

        $sql = "SELECT * FROM `faculty_members`";

        $query = $this->db->query($sql);
        $result = $query->result_array();
        

        if ($result) {
            return $result;
        } else {
            return false;
        }

    }// end
	public  function getFacultyMemberName($id){

        $sql = "SELECT * FROM `faculty_members` WHERE MEMBER_ID=?";

        $query = $this->db->query($sql,$id);
        $result = $query->result_array();
        

        if ($result) {
            return $result;
        } else {
            return false;
        }

    }// end
		public  function getProgramName($programId){

	$sql = "SELECT DEPT_NAME AS DEPARTMENT_NAME , PROGRAM_TITLE FROM `program` AS p 
			INNER JOIN `department` AS d ON d.`DEPT_ID`=p.`DEPT_ID`
			WHERE p.`PROG_ID`=?";

        $query = $this->db->query($sql, array($programId));
        $result = $query->result_array();

        if ($result) {
            return $result;
        } else {
            return false;
        }

    }

 public  function updateCourseDistribution($COURSE_DISTRIBUITION_ID,$NAME1){

       // $sql = "UPDATE  course_distribution SET MEMBER_ID_1=? WHERE COURSE_NO=? AND PASS=?  AND SCHEME_ID=?";
	    $sql = "UPDATE  course_distribution SET MEMBER_ID_1=? WHERE COURSE_DISTRIBUITION_ID=?  ";
        //$query = $this->db->query($sql, array($NAME1,$COURSE_NO,$PASS,$SCHEME_ID));
		$query = $this->db->query($sql, array($NAME1,$COURSE_DISTRIBUITION_ID));

        $result = $query;
        //echo($sql);
        if ($result) {
            return $result;
        } else {
            return false;
        }

    }
    public  function getSingleCourse($SCHEME_ID){

        $sql = " SELECT  FROM `course_distribution` WHERE `SCHEME_ID`=? ORDER BY SEMESTER";
        $query = $this->db->query($sql, array($SCHEME_ID));
        $result = $query;
        //echo($sql);
        if ($result) {
            return $result;
        } else {
            return false;
        }

    }


}