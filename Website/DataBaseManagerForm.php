<?php

/**
 * Created by PhpStorm.
 * User: RAJA DELL LAPTOP
 * Date: 9/5/2015
 * Time: 9:53 AM
 */
class DataBaseManager1
{
    public static  function connect(){
        $mysql_hostname = "localhost";


 $mysql_user = "root";
      $mysql_password = "";
  $mysql_database = "exams";
        $link = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database) or die("<h2>Error connecting with database...!</h2>");
        return $link;

    }
        public static function getStudentInformation($rollNo){
                $link= DataBaseManager1::connect();
//               $query=" SELECT sr.`NAME`,sr.`FNAME`,sr.`SURNAME`,sr.`ROLL_NO`,sr.`BATCH_ID`
  //                      FROM `student_registration` AS sr
    //                     WHERE sr.ROLL_NO='$rollNo'";
				$query=" SELECT sr.`NAME`,sr.`FNAME`,sr.`SURNAME`,sr.`ROLL_NO`,sr.`BATCH_ID`,b.`GROUP_DESC`,b.`YEAR`,b.`PROG_ID`
						 FROM `student_registration` AS sr
						 INNER JOIN `batch` AS b ON b.`BATCH_ID`=sr.`BATCH_ID`
                         WHERE sr.ROLL_NO='$rollNo'";
		 
                $result=mysqli_query($link,$query);
                return $result;

    }
	 public static function getProgramId($ROLL_NO){
       $link= DataBaseManager1::connect();

        $query="SELECT B.`PROG_ID` FROM `student_registration`  AS SR
				INNER JOIN `batch` AS B ON B.`BATCH_ID`=SR.`BATCH_ID` 
				WHERE `roll_no`='$ROLL_NO'";
				
				$result=mysqli_query($link,$query);
				//$row=mysqli_fetch_array($result);
				 if($row=mysqli_fetch_array($result)){
                       // $courseNo=$row['COURSE_NO'];
						
					$prog_id=$row['PROG_ID'];
				 }
                return $prog_id;

	//	$row=mysqli_fetch_array($result)
		//$prog_id=0;
		//$prog_id=result[0]['PROG_ID'];
//      return $result;

    }
	

    public static function getStudentInfo($rollNo,$name,$batch_id){
        $link= DataBaseManager1::connect();
        $query=" SELECT sr.`NAME`,sr.`FNAME`,sr.`SURNAME`,sr.`ROLL_NO`,sr.`BATCH_ID`,b.`GROUP_DESC`,b.PROG_ID
                        FROM `student_registration` AS sr
						INNER JOIN `batch` AS b ON b.`BATCH_ID`=sr.`BATCH_ID`
                         WHERE sr.ROLL_NO='$rollNo' AND sr.NAME='$name' AND  sr.BATCH_ID=$batch_id";
        $result=mysqli_query($link,$query);
        return $result;

    }

    public static function getSchemeId($batch_id,$group_desc){
        $link= DataBaseManager1::connect();
        $query_student="SELECT prog.`PROGRAM_TITLE`,
							`scheme`.`YEAR`,MAX(`scheme`.`SCHEME_ID`) AS SCHEME_ID,
							batch.BATCH_ID,batch.SHIFT,
							dept.`DEPT_NAME`
							FROM `batch`
							INNER JOIN `program` AS prog ON `batch`.`PROG_ID`=prog.`PROG_ID`
							INNER JOIN `department` AS dept ON prog.`DEPT_ID`=dept.`DEPT_ID`
							INNER JOIN `scheme`  ON prog.`PROG_ID`=`scheme`.`PROG_ID` AND prog.`DEPT_ID`=scheme.`DEPT_ID` AND `batch`.`YEAR`=`scheme`.`YEAR`
							WHERE `batch`.`BATCH_ID`=$batch_id
							AND `scheme`.`GROUP_DESC`='$group_desc'"
							;

         //                   echo($query_student."<br>");

        $result_student=mysqli_query($link,$query_student);
        return $result_student;

    }

  public static  function getCourceDetail($SCHEME_ID,$SEMESTER)
    {
        $link= DataBaseManager1::connect();
		$query1="SELECT * FROM  ac_scheme_detail WHERE  SCHEME_ID=$SCHEME_ID AND  SEMESTER =$SEMESTER";
		//echo($query1);
		$subject_query1=mysqli_query($link,$query1);
		$count= mysqli_num_rows($subject_query1);
	
					$AC_ID=0;
					while($row_subject=mysqli_fetch_array($subject_query1)){
                        $COURSE_NO=$row_subject['COURSE_NO'];
                        $COURSE_TITLE=$row_subject['COURSE_TITLE'];
						$AC_ID=$row_subject['AC_ID'];
						
						$SCHEME_PART=$row_subject['SCHEME_PART'];
						$SEMESTER=$row_subject['SEMESTER'];
						$CR_HRS=$row_subject['CR_HRS'];
					
						
						 echo("<option value='$COURSE_NO~$AC_ID~$COURSE_TITLE~$CR_HRS'> $COURSE_TITLE</option>");
						 //$concat="";
					}

	//echo($count);
		
			
			$query="SELECT SCHEME_ID,SCHEME_PART,SEMESTER,COURSE_NO,COURSE_TITLE,CR_HRS,MAX_MARKS,REMARKS,SUBJ_TYPE,IS_CREDITABLE,CONCAT('0') AS AC_ID FROM  scheme_detail WHERE  SCHEME_ID=$SCHEME_ID AND  SEMESTER =$SEMESTER";
			$subject_query=mysqli_query($link,$query);
				while($row_subject=mysqli_fetch_array($subject_query)){
                        $COURSE_NO=$row_subject['COURSE_NO'];
                        $COURSE_TITLE=$row_subject['COURSE_TITLE'];
						$AC_ID=$row_subject['AC_ID'];
						
						$SCHEME_PART=$row_subject['SCHEME_PART'];
						$SEMESTER=$row_subject['SEMESTER'];
						$CR_HRS=$row_subject['CR_HRS'];
						$speclization=DataBaseManager1::startsWith($COURSE_TITLE,"SPECIALIZATION");
						$optional=DataBaseManager1::startsWith($COURSE_TITLE,"OPTIONAL");
						$elective=DataBaseManager1::startsWith($COURSE_TITLE,"ELECTIVE");
						$minor=DataBaseManager1::startsWith($COURSE_TITLE,"MINOR");
					if($speclization==true || $optional==true || $elective==true || $minor==true){
					continue;
					}
						 echo("<option value='$COURSE_NO~$AC_ID~$COURSE_TITLE~$CR_HRS'> $COURSE_TITLE</option>");
						// $concat="";
					}
		
        
        return $subject_query;

    }


    public static  function addExamFormData($exam_type,$date_of_sumbit,$batch_id,$roll_no,$challan_no=0,$challan_date='NULL',$challan_rs=0,$semester,$scheme_id,$name,$fname){
        $link= DataBaseManager1::connect();
		if($challan_no==0){
			$query="INSERT INTO exam_form_student_enlorment (`EXAM_TYPE`, `DATE_OF_SUMBIT_FORM`, `student_registration_BATCH_ID`, `student_registration_ROLL_NO`, `SEMESTER`, `SCHEME_ID`, `NAME`, `FNAME`) VALUES ('$exam_type','$date_of_sumbit', $batch_id, '$roll_no',$semester,$scheme_id,'$name','$fname')";
			
		}else{
        $query="INSERT INTO exam_form_student_enlorment (`EXAM_TYPE`, `DATE_OF_SUMBIT_FORM`, `student_registration_BATCH_ID`, `student_registration_ROLL_NO`, `CHALLAN_NO`, `CHALLAN_DATE`, `CHALLAN_RS`, `SEMESTER`, `SCHEME_ID`, `NAME`, `FNAME`) VALUES ('$exam_type','$date_of_sumbit', $batch_id, '$roll_no',$challan_no, '$challan_date', $challan_rs,$semester,$scheme_id,'$name','$fname')";
		}
		//echo($query);
        mysqli_query($link, $query);

        $last_id = mysqli_insert_id($link);
        return $last_id;


    }
    public static function addExamPapers($exam_form_id,$semester,$scheme_id,$course_no,$ac_id,$COURSE_TITTLE,$CR_HRS){
		$part=floor($semester/2);
        $link= DataBaseManager1::connect();
        $query="INSERT INTO exam_form_paper (scheme_detail_SEMESTER,scheme_detail_SCHEME_ID,scheme_detail_COURSE_NO,exam_form_student_enlorment_ID,AC_ID,scheme_detail_PART,scheme_detail_COURSE_TITTLE,scheme_detail_CR_HRS) VALUES ($semester,$scheme_id, '$course_no',$exam_form_id,$ac_id,$part,'$COURSE_TITTLE',$CR_HRS)";
    //     echo($query."</br>");

        mysqli_query($link, $query);




    }
	
	
	public static function getpart($semester){
	switch($semester){
		case 1: case 2: return 1;
		case 3: case 4: return 2;
		case 5: case 6: return 3;
		case 7: case 8: return 4;
		case 9: case 10: return 5;
		
	}
	return -1;
		
	}
	public static function get_batch_year_decode($YEAR){

	if($YEAR=="2K4")return 2004 ;
	if($YEAR=="2K5")return 2005;
	if($YEAR=="2K6")return 2006;
	if($YEAR=="2K7")return 2007;
	if($YEAR=="2K8")return 2008;
	if($YEAR=="2K9")return 2009;
	if($YEAR=="2K10")return 2010;
	if($YEAR=="2K11")return 2011;
	if($YEAR=="2K12")return 2012;
	if($YEAR=="2K13")return 2013;
	if($YEAR=="2K14")return 2014;
	if($YEAR=="2K15")return 2015;
	if($YEAR=="2K16")return 2016;
	if($YEAR=="2K17")return 2017;
	if($YEAR=="2K18")return 2018;
	if($YEAR=="2K19")return 2019;
	if($YEAR=="2K20")return 2020;

	return $YEAR;
}//end method



    public static function getRollNoDecode($rollNo){

    $firstIndex=stripos($rollNo,"/");
    $rollNo=strtoupper($rollNo);
    $batchYearStr=substr($rollNo,0,$firstIndex);
    return $batchYearStr;

    }
    public static function getImpFalCources($SEMESTER,$ROLL_NO,$SL_ID,$filter=""){
       $link= DataBaseManager1::connect();

        $query="SELECT DISTINCT(`COURSE_NO`),ld.`AC_ID`,ld.`SCHEME_ID`,ld.`MIN_MARKS` FROM `ledger_details` AS ld
              WHERE `ROLL_NO`='$ROLL_NO'
              AND ld.`SEMESTER`=$SEMESTER
              $filter
              AND ld.`SL_ID`=$SL_ID";

        $result=mysqli_query($link,$query);
		
        return $result;

    }

	
	public static function startsWith($haystack, $needle) {
		// search backwards starting from haystack length characters from the end
		return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
		}
		
	public static	function endsWith($haystack, $needle) {
		// search forward starting from end minus needle length characters
		return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
		}
		
		
    public static function getSchemeDetail($schemeId,$courseNo,$ac_id,$semester){
       $link= DataBaseManager1::connect();
       if($ac_id!=0){
        $query="SELECT * FROM `ac_scheme_detail` AS SD WHERE SD.`COURSE_NO`='$courseNo' AND SD.`SCHEME_ID`=$schemeId";

       }else{
        $query="SELECT * FROM `scheme_detail` AS SD WHERE SD.`COURSE_NO`='$courseNo' AND SD.`SCHEME_ID`=$schemeId";

       }
      // echo($query);

                        $result=mysqli_query($link,$query);
                      // $count= mysqli_num_rows($result);
                      // echo($count);
                      // if($count==0){
                      // return;
                       //}
                        if($row_subject=mysqli_fetch_array($result)){
                        $COURSE_NO=$row_subject['COURSE_NO'];
                        $COURSE_TITLE=$row_subject['COURSE_TITLE'];
						$AC_ID=0;
						if($ac_id!=0){
						$AC_ID=$row_subject['AC_ID'];
                        }
						
						//$SCHEME_PART=$row_subject['SCHEME_PART'];
					    //$SEMESTER=$row_subject['SEMESTER'];
						$CR_HRS=$row_subject['CR_HRS'];
						
						$speclization=DataBaseManager1::startsWith($COURSE_TITLE,"SPECIALIZATION");
						$optional=DataBaseManager1::startsWith($COURSE_TITLE,"OPTIONAL");
						$elective=DataBaseManager1::startsWith($COURSE_TITLE,"ELECTIVE");
						$minor=DataBaseManager1::startsWith($COURSE_TITLE,"MINOR");
						
						if($speclization==true || $optional==true || $elective==true || $minor==true){
						$query="SELECT * FROM `ac_scheme_detail` AS SD WHERE SD.`SEMESTER`='$semester' AND SD.`SCHEME_ID`=$schemeId";
                        $result=mysqli_query($link,$query);
						$rows=mysqli_num_rows($result);
						//echo($rows);
						if($rows==0){
						$query="SELECT * FROM `scheme_detail` AS SD WHERE SD.`SEMESTER`='$semester' AND SD.`SCHEME_ID`=$schemeId AND SUBJ_TYPE='E'";
                        $result=mysqli_query($link,$query);
		
							while($row_subject1=mysqli_fetch_array($result)){
							$COURSE_NO=$row_subject1['COURSE_NO'];
							$COURSE_TITLE=$row_subject1['COURSE_TITLE'];
							$AC_ID=$row_subject1['AC_ID'];
							$CR_HRS=$row_subject1['CR_HRS'];
							echo("<option value='$COURSE_NO~$AC_ID~$COURSE_TITLE~$CR_HRS'>$COURSE_TITLE</option>");						 //$concat="";
							}	
						}
                        while($row_subject1=mysqli_fetch_array($result)){
						$COURSE_NO=$row_subject1['COURSE_NO'];
                        $COURSE_TITLE=$row_subject1['COURSE_TITLE'];
						$AC_ID=$row_subject1['AC_ID'];
						$CR_HRS=$row_subject1['CR_HRS'];
						 echo("<option value='$COURSE_NO~$AC_ID~$COURSE_TITLE~$CR_HRS'>$COURSE_TITLE</option>");						 //$concat="";
					}	
						
						}else{
						echo("<option value='$COURSE_NO~$AC_ID~$COURSE_TITLE~$CR_HRS'>$COURSE_TITLE</option>");						 //$concat="";
						
						}
						 
						
						 
					
					}


    }
    public static function getExamType($semester,$examYear,$batchYear){

    $part=self::getpart($semester);
    $partYear=$part+($batchYear-1);
    if($partYear==$examYear) return "R";
    elseif($partYear>$examYear) return "NO";
    else return "F";
    }
	

   

}


	