<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Faculty extends  CI_Model
{

    private $memberId;
    private $departmentId = "";
	private $prefixId = "";
    private $fistName = "";
    private $lastName = "";
	private $cnic = "";
    private $dateOfBirth;
    private $mobile;
    private $email;
    private $permenentAddr;
    private $postalAddr;
    private $hblAccountNo;
    private $profileUrl;



  

    public function addNewFacultyMember($departmentId,$prefixId, $fistName, $lastName,$cnic,$dateOfBirth,$mobile,$email, $permenentAddr,$postalAddr){
       // $dat = substr($dateOfBirth,0,2);
      //  $month = substr($dateOfBirth,3,2);
      //  $year = substr($dateOfBirth,6);
      //  $dateOfBirth = "$year-$month-$dat";

     

        $data = array('PREFIX_ID'=>$prefixId,'DEPT_ID'=>$departmentId
        ,'cnic_no'=>$cnic,'FIRST_NAME'=>$fistName,'LAST_NAME'=>$lastName,'DATE_OF_BIRTH'=>$dateOfBirth
        ,'PERMENT_ADDRESS'=>$permenentAddr,'POSTEL_ADDRESS'=>$postalAddr,'MOBILE'=>$mobile,'EMAIL_ADRESS'=>$email,'CNIC'=>$cnic);
        $query=$this->db->insert('faculty_members', $data);
        return $this->db->insert_id();
    }//end addNewCandidate()

    public function addFaculty($departmentId ,$fistName, $lastName,$email){



        $data = array('DEPT_ID'=>$departmentId,'FIRST_NAME'=>$fistName,'LAST_NAME'=>$lastName,'EMAIL_ADRESS'=>$email);
        $query=$this->db->insert('faculty_members', $data);
        return $this->db->insert_id();
    }//end addNewCandidate()




    public function checkDublicateEmail($email)
    {
        $sql = " SELECT fc.`MEMBER_ID` FROM `faculty_members` AS fc
		WHERE fc.`EMAIL_ADRESS`=?";
        $query = $this->db->query($sql, array($email));
        $result = $query->num_rows();

        return $result;
    }


    public function getFacuiltyInfo($email) {
        $sql = " SELECT fc.`MEMBER_ID`,fc.PREFIX_ID, fc.`DEPT_ID`, fc.`CNIC`,fc.`FIRST_NAME`,fc.`LAST_NAME`,fc.`EMAIL_ADRESS`,fc.`PREFIX_ID`,fc.`MOBILE`,fc.`POSTEL_ADDRESS`,fc.`PERMENT_ADDRESS`,fc.`DATE_OF_BIRTH`,fc.`CNIC`,fc.HBL_ACCOUNT_NO,fc.PROFILE_URL FROM `faculty_members` AS fc
		WHERE fc.`EMAIL_ADRESS`=?";
        $query = $this->db->query($sql,array($email));
        $result = $query->result_array();

        if( $result ){
            //return $result[0];
            $bean = new Faculty();
            $bean->setPrefixId($result[0]['PREFIX_ID']);

            $bean->setMemberId($result[0]['MEMBER_ID']);
            $bean->setDepartmentId($result[0]['DEPT_ID']);
            $bean->setFirstName($result[0]['FIRST_NAME']);
            $bean->setLastName($result[0]['LAST_NAME']);
            $bean->setEmail($result[0]['EMAIL_ADRESS']);
            $bean->setMobile($result[0]['MOBILE']);
            $bean->setPostalAddr($result[0]['POSTEL_ADDRESS']);
            $bean->setPermenentAddr($result[0]['PERMENT_ADDRESS']);
            $bean->setDateOfBirth($result[0]['DATE_OF_BIRTH']);
            $bean->setHblAccountNo($result[0]['HBL_ACCOUNT_NO']);
            $bean->setCnic($result[0]['CNIC']);
            $bean->setProfileUrl($result[0]['PROFILE_URL']);



            return $bean;
        }else{
            //show_404();
           return false;
        }
    }//end getCandidateInfo()


   
 

   
    public function updateFaculty($departmentId,$prefixId ,$fistName,$lastName ,$cnic,$dateOfBirth,$mobile,$email,$permenentAddr,$postalAddr,$hblAccountNo,$URL){
        $dat = substr($dateOfBirth,0,2);
        $month = substr($dateOfBirth,3,2);
        $year = substr($dateOfBirth,6);
        $dateOfBirth = "$year-$month-$dat";



        $sql = "UPDATE faculty_members
                        SET  PREFIX_ID = ?, DEPT_ID = ?, FIRST_NAME = ?, LAST_NAME = ?,
                        EMAIL_ADRESS = ?, MOBILE = ?, POSTEL_ADDRESS = ? , PERMENT_ADDRESS = ?,
                        DATE_OF_BIRTH = ?, HBL_ACCOUNT_NO = ?, CNIC = ?,PROFILE_URL=?
                        WHERE EMAIL_ADRESS = ? ";

        $query = $this->db->query($sql,array($prefixId,$departmentId,$fistName,$lastName
        ,$email ,$mobile,$postalAddr,$permenentAddr,$dateOfBirth,$hblAccountNo,$cnic,$URL,$email));

        return $query;

    }//end addNewCandidate()



    public function getDepartment() {

        $sql = "SELECT DEPT_ID,DEPT_NAME FROM department order by DEPT_NAME";

        $query=$this->db->query( $sql );
        $result = $query->result_array();

        if( $result )
        {
            return $result;
        }
        else
        {
            return false;
            //show_404();
        }

    }
    public function getPrefix() {

        $sql = "SELECT * FROM prefix_type order by ORDERBY ";

        $query=$this->db->query( $sql );
        $result = $query->result_array();

        if( $result )
        {
            return $result;
        }
        else
        {
            return false;
            //show_404();
        }

    }

    /**
     * @return mixed
     */
    public function getProfileUrl()
    {
        return $this->profileUrl;
    }

    /**
     * @param mixed $profileUrl
     */
    public function setProfileUrl($profileUrl)
    {
        $this->profileUrl = $profileUrl;
    }
    

    /**
     * @return mixed
     */

    /**
     * @return mixed
     */
    public function getHblAccountNo()
    {
        return $this->hblAccountNo;
    }

    /**
     * @param mixed $hblAccountNo
     */
    public function setHblAccountNo($hblAccountNo)
    {
        $this->hblAccountNo = $hblAccountNo;
    }

    /**
     * @param mixed $candidateId
     */

    public function setMemberId($memberId)
    {
        $this->memberId = $memberId;
    }



    public function getMemberId() {
        return $this->memberId;
    }

	
    public function setDepartmentId($departmentId) {
        $this->departmentId = $departmentId;
    }

    public function getDepartmentId() {
        return $this->departmentId;
    }

	
    public function setPrefixId($prefixId) {
        $this->prefixId = $prefixId;
    }
	public function getPrefixId() {
        return $this->prefixId;
    }
	
	
 

    public function getFirstName() {
        return $this->fistName;
    }

    public function setFirstName($fistName) {
        $this->fistName = $fistName;
    }
	 

    public function getLastname() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

 

    public function getCnic() {
        return $this->cnic;
    }

    public function setCnic($cnic) {
        $this->cnic = $cnic;
    }



    public function getDateOfBirth() {
        if($this->dateOfBirth){
            $dob = $this->dateOfBirth;
            $year = substr($dob,0,4);
            $month = substr($dob,5,2);
            $dat = substr($dob,8);
            return "$dat-$month-$year";
        }else{
            return $this->dateOfBirth;
        }
    }

    public function setDateOfBirth($dateOfBirth) {
        $this->dateOfBirth = $dateOfBirth;
    }

    public function getMobile() {
        return $this->mobile;
    }

    public function setMobile($mobile) {
        $this->mobile = $mobile;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPermenentAddr() {
        return $this->permenentAddr;
    }

    public function setPermenentAddr($permenentAddr) {
        $this->permenentAddr = $permenentAddr;
    }

    public function getPostalAddr() {
        return $this->postalAddr;
    }

    public function setPostalAddr($postalAddr) {
        $this->postalAddr = $postalAddr;
    }





}