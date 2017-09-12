<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Variable {


    //handling files
    public static $CONFIRM_FORM = "confirm.php";




    // Personal Information Tab
    public static $FIRST_NAME = "first_name";
    public static $LAST_NAME = "last_name";
    public static $DEPT_ID = "surname";
    public static $MEMBER_ID = "member_id";
    public static $CNIC = "cnic";
    public static $DATE_OF_BIRTH = "birth_date";
    public static $MOBILE = "mobile";
    public static $EMAIL = "email";
    public static $PERMENENT_ADDRESS = "permanent_address";
    public static $HBL_ACCOUNT_NO = "account_no";
    public static $PROFILE_URL = "url";
    public static $PREFIX_ID = "prefix_id";
    public static $POSTAL_ADDRESS = "postal_address";
    public static $STUDENT_PICTURE = "std_pic";

    /**
     * @return string
     */
    public static function STUDENT_PICTURE()
    {
        return self::$STUDENT_PICTURE;
    }

    /**
     * @return string
     */
    public static function getCNIC()
    {
        return self::$CNIC;
    }

    /**
     * @return string
     */
    public static function getCONFIRMFORM()
    {
        return self::$CONFIRM_FORM;
    }

    /**
     * @return string
     */
    public static function getDATEOFBIRTH()
    {
        return self::$DATE_OF_BIRTH;
    }

    /**
     * @return string
     */
    public static function getDEPTID()
    {
        return self::$DEPT_ID;
    }

    /**
     * @return string
     */
    public static function getEMAIL()
    {
        return self::$EMAIL;
    }

    /**
     * @return string
     */
    public static function getFIRSTNAME()
    {
        return self::$FIRST_NAME;
    }

    /**
     * @return string
     */
    public static function getHBLACCOUNTNO()
    {
        return self::$HBL_ACCOUNT_NO;
    }

    /**
     * @return string
     */
    public static function getLASTNAME()
    {
        return self::$LAST_NAME;
    }

    /**
     * @return string
     */
    public static function getMEMBERID()
    {
        return self::$MEMBER_ID;
    }

    /**
     * @return string
     */
    public static function getMOBILE()
    {
        return self::$MOBILE;
    }

    /**
     * @return string
     */
    public static function getPERMENENTADDRESS()
    {
        return self::$PERMENENT_ADDRESS;
    }

    /**
     * @return string
     */
    public static function getPOSTALADDRESS()
    {
        return self::$POSTAL_ADDRESS;
    }

    /**
     * @return string
     */
    public static function getPREFIXID()
    {
        return self::$PREFIX_ID;
    }

    /**
     * @return string
     */
    public static function getPROFILEURL()
    {
        return self::$PROFILE_URL;
    }










    public static function yearOptions($yearSelected = 0){
        for($i = 2015;$i>1950;$i--){
            echo "<option value='$i' ";
            if($i == $yearSelected){
                echo " selected='true' ";
            }
            echo ">$i</option>";
        }
    }
}
?>