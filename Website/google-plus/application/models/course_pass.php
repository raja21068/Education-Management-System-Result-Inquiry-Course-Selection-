<?php
/**
 * Created by PhpStorm.
 * User: Jay
 * Date: 9/2/2015
 * Time: 1:44 PM
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Course_Pass extends CI_Model
{

    public function insertUserPass($dec_username,$dec_password,$username,$password,$scheme_id){
        $sql = "UPDATE `course_distribution`   SET `USER_TEMP`='$dec_username' ,`PASS_TEMP`='$dec_password'  WHERE DEPT_ID =$scheme_id";
        $query = $this->db->query($sql);
	//		echo("query".$sql);
        if($query){
            $sql_two = "UPDATE `course_distribution`  SET
                  `USER`= ? ,
                  `PASS`= ? WHERE DEPT_ID=?";
            $query_two = $this->db->query($sql_two,array($username,$password,$scheme_id) );
            return $query_two;
        }else{
            return $query;
		
        }
    }
/*
    public function insertUserPass($dec_username,$dec_password,$username,$password,$scheme_id){
            $sql_two = "UPDATE `course_distribution`  SET
                  `USER`= '$dec_username' AND
                  `PASS`= '$dec_password' WHERE SCHEME_ID=$scheme_id";
            $query_two = $this->db->query($sql_two);
            
    	echo("query: ".$sql_two."</br>");
          return $query_two;
    }	*/
	    public function checkDublicatePass($user,$pass)
    {
        $sql = "SELECT * FROM `course_distribution` AS cd WHERE cd.`USER`=? AND CD.`PASS`=?";
        $query = $this->db->query($sql, array($user,$pass));
		$result = $query->num_rows();
	
        return $result;
    }

	   public function getDistinctSchemeId()
    {
        $sql = "SELECT DISTINCT(`SCHEME_ID`) FROM `course_distribution`";
        $query = $this->db->query($sql);
    	$result = $query->result_array();
    
        return $result;
    }
    public function getDistinctDeptId()
    {
        $sql = "SELECT DISTINCT(`DEPT_ID`) FROM `course_distribution`";
        $query = $this->db->query($sql);
        $result = $query->result_array();

        return $result;
    }

}