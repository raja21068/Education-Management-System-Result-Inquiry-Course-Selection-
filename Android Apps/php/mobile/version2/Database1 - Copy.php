<?php 
    $ret =  mysql_select_db('stbbedup_exam1',mysql_connect('localhost','root',''));
	 $data="";
    	$response = array();
    	


//*****************************************************************
//*****************************************************************
function get_scheme_id($sl_id){
   if($sl_id==null){
   return;
   }
   $query="select scheme_id from ledger where sl_id=$sl_id";
   $result=mysql_query($query);
   $num=mysql_num_rows($result);
    $scheme_id=null;
   if($row=mysql_fetch_object($result))$scheme_id=$row->scheme_id;

   return $scheme_id;
}//end method 
//*****************************************************************


//*****************************************************************
//*****************************************************************
function display_name_fname_surname_rollno($batch_id,$roll_no,$cellNo){

      $query="select BATCH_ID,ROLL_NO,NAME,FNAME,SURNAME,GENDER from  student_registration where BATCH_ID=$batch_id and ROLL_NO='$roll_no'";
	$result=mysql_query($query);
      if($row=mysql_fetch_object($result)){
						/*
						$response["status"] = "OK";
                        $response["NAME"] =$row->NAME;
                        $response["FNAME"] =$row->FNAME;
                        $response["SURNAME"] =$row->SURNAME;
                        $response["ROLL_NO"] =$row->ROLL_NO;
                        $response["CELL_NO"] =$cellNo;
                        $response["MESSAGE"] ="";
						*/
                        $response.=($row->NAME)."\n".($row->ROLL_NO)."\n";
						//echo json_encode($response);
						return $response;
	  }//end if         
}//END METHOD
//*****************************************************************

//*****************************************************************
//*****************************************************************


//*****************************************************************
//*****************************************************************

//*****************************************************************


//*****************************************************************
//*****************************************************************
function display_marks($sl_id,$roll_no,$part,$batch_id,$scheme_id){
	//$is_record_available=get_display_ledger_detail($sl_id,$roll_no,$scheme_id,$part);
               //  if($is_record_available){
				$record = get_display_ledger_detail_summary($sl_id,$roll_no,$part,$batch_id);      
	                $msg="";
					if($record == -1){
                        $response["MSG1"] ="Result still not announced......";
						$response=get_display_ledger_detail($sl_id,$roll_no,$scheme_id,$part);
//                        echo json_encode($response);
						//$record_array['ledger'] = $response;
						$msg=$response;
					}
					else{
					//$record_array['ledger_summary'] = $record;
					$msg=$record;
					}
		         return $msg;	
	  //}else{	
		//echo("<h2>Result is in progress.......</h2>");
		//echo("<h3>Please wait some days...</h3>");
	//}
}//end function

//*****************************************************************


//*****************************************************************
//*****************************************************************
function get_display_ledger_detail($sl_id,$roll_no,$scheme_id,$part){
	
	$query="select semester from scheme_semester where scheme_id=$scheme_id and scheme_part=$part";
	$result_sem=mysql_query($query);

                                                   
	 while($row=mysql_fetch_object($result_sem)){

	 	$sem_no=$row->semester;
		$semester_no=get_semester_decode($sem_no);
     
	      $query=get_ledger_detail_query($sl_id,$roll_no,$sem_no);
			//echo($query);
	      $result=mysql_query($query);

		$is_record_available=false;
                $index=0;
				$ledger="";
	      while($row=mysql_fetch_object($result)){
                  if(!$is_record_available){

				$is_record_available=true;
			}//end if

                        $courseNo = $row->COURSE_NO ;
                            $que = "SELECT DISTINCT(COURSE_TITLE) FROM scheme_detail WHERE COURSE_NO LIKE '%$courseNo%' AND SCHEME_ID=".$row->SCHEME_ID;
                            $resultSet = mysql_query($que);
                            if($data=  mysql_fetch_object($resultSet)){
                                $courseNo =  $data->COURSE_TITLE;
                                
                                //CREATING SHORTCUT OF SUBJECT 
                               $arr = split(" ",$courseNo);
                                $size = count($arr);
                                
                                if($size>1){
                                	$str = "";
                                	for($i=0;$i<$size;$i++){
                                		$sub = substr ($arr[$i],0,1);
                                		if($sub != "(") $str .= ($sub.".");
                                		else $str .= ($arr[$i].".");
                                	}
                                	$courseNo = $str;
                                }
            		    }
								if($row->MARKS_OBTAINED!=0){
								$ledger.="".($courseNo).": ".$row->MARKS_OBTAINED."\n";
								}
						  /*
						  $response["a".$index]["COURSE"] =$courseNo;
						 $response["a".$index]["MIN_MARKS"] =$row->MIN_MARKS;
						 $response["a".$index]["MARKS_OBTAINED"] =$row->MARKS_OBTAINED;
						 $response["a".$index]["GRADE"] =$row->GRADE;
						 $response["a".$index]["QP"] =$row->QP;
						 */
						 $index++;
                       
	      }//end while
			return $ledger;

	
  }//end outer while loop   
 return $is_record_available;
}//end function
//*****************************************************************


//*****************************************************************
//*****************************************************************

function get_ledger_detail_query($sl_id,$roll_no,$sem_no){ 
	$query=" select ".
	" ledger_details.COURSE_NO,ledger_details.SCHEME_ID, ".
	" ledger_details.MIN_MARKS, ".
	" ledger_details.MARKS_OBTAINED, ".
	" ledger_details.GRADE, ".
	" ledger_details.QP, ".
	" ledger_details.SEMESTER ".
	" from ledger_details ".
	" where ".
	" ledger_details.ROLL_NO='$roll_no' AND ".
	" ledger_details.SL_ID=$sl_id".
	" ORDER BY ledger_details.SEMESTER ";
   return $query;
 }//end function

//*****************************************************************



//*****************************************************************
//*****************************************************************
function get_ledger_detail_ac_scheme_detail_query($sl_id,$roll_no,$sem_no){ 

	$query=" select ".
	" ledger_details.COURSE_NO, ".
	" AC_SCHEME_DETAIL.COURSE_TITLE, ".
	" AC_SCHEME_DETAIL.MAX_MARKS, ".
	" ledger_details.MIN_MARKS, ".
	" ledger_details.MARKS_OBTAINED, ".
	" AC_SCHEME_DETAIL.CR_HRS, ".
	" ledger_details.GRADE, ".
	" ledger_details.QP, ".
	" ledger_details.SEMESTER, ".
	" AC_SCHEME_DETAIL.IS_CREDITABLE ".
	" from ledger_details,ac_scheme_detail".
	" where ".
	" ledger_details.ROLL_NO='$roll_no' AND ".
	" ledger_details.SL_ID=$sl_id AND ".
	" ledger_details.COURSE_NO=AC_SCHEME_DETAIL.COURSE_NO AND ".
	" ledger_details.SCHEME_ID=AC_SCHEME_DETAIL.SCHEME_ID AND ".
	" ledger_details.SCHEME_PART=AC_SCHEME_DETAIL.SCHEME_PART AND ".
	" ledger_details.SEMESTER=AC_SCHEME_DETAIL.SEMESTER AND ".
	" ledger_details.SEMESTER=$sem_no ".

	" ORDER BY ledger_details.SEMESTER ";

   return $query;
 }//end function
//*****************************************************************



//*****************************************************************
//*****************************************************************
function get_display_ledger_detail_summary($sl_id,$roll_no,$part,$batch_id){
$query=" select SL_ID, ".                  
" ROLL_NO, ".                
" TOTAL_MARKS, ".            
" RESULT_REMARKS, ".         
" FORMAT(PERCENTAGE,2) AS PERCENTAGE, ".             
" date_format(INDV_RESULT_ANN_DATE,'%d %M %Y') as INDV_RESULT_ANN_DATE, ".
" FORMAT(CGPA,2) AS CGPA, ".                   
" OBTAIN_MARKS, ".           
" NO_DUES_REMARKS, ".        
" PREV_PART, ".              
" PREV_ROLL_NO, ".           
" PREV_SL_ID, ".             
" PREV_RESULT_REMARKS from ledger_detail_summary where sl_id=$sl_id and roll_no='$roll_no'";

$sep="/ ";         

      $is_record_available=false;

      $result=mysql_query($query);
      if($row=mysql_fetch_object($result)){
		$TOTAL_MARKS=$row->TOTAL_MARKS;
		$RESULT_REMARKS=$row->RESULT_REMARKS;
		$PERCENTAGE=$row->PERCENTAGE;
		$INDV_RESULT_ANN_DATE=$row->INDV_RESULT_ANN_DATE;
		$CGPA=$row->CGPA;
		$OBTAIN_MARKS=$row->OBTAIN_MARKS;
		$NO_DUES_REMARKS=$row->NO_DUES_REMARKS;
		$PREV_PART=$row->PREV_PART;
		$PREV_ROLL_NO=$row->PREV_ROLL_NO;
		$PREV_SL_ID=$row->PREV_SL_ID;
		$PREV_RESULT_REMARKS=$row->PREV_RESULT_REMARKS;
		//echo("$INDV_RESULT_ANN_DATE");
             	
      	$CGPA=get_decimal_format($CGPA);
      	$PERCENTAGE=get_decimal_format($PERCENTAGE);
		
	      if($INDV_RESULT_ANN_DATE==null)$INDV_RESULT_ANN_DATE=get_date_of_ann($sl_id);
		if($PREV_PART==0);else{
			$TOTAL_MARKS="---";
			$RESULT_REMARKS="RW P-$PREV_PART";
			$PERCENTAGE="---";
			$CGPA="---";
			$OBTAIN_MARKS="---";
		}

		$result=get_last_result($batch_id,$part,$roll_no);
		if($result!=null)
                if($result!="PASS"){
			$TOTAL_MARKS="---";
			$RESULT_REMARKS=$result;
			$PERCENTAGE="---";
			$CGPA="---";
			$OBTAIN_MARKS="---";
		}       
						$message="\nTOTAL_MARKS: ".$TOTAL_MARKS."\nOBTAIN MARKS: ".$OBTAIN_MARKS."\nPERCENTAGE: ".$PERCENTAGE."\nCGPA: ".$CGPA."\nRESULT DECLARED: ".$INDV_RESULT_ANN_DATE."\nRESULT:".$RESULT_REMARKS."\n";
						//echo($message);
						$response["RESULT_ANNOUNCED"] ="RESULT_ANNOUNCED";   
                         $response["OBTAIN_MARKS"] ="$OBTAIN_MARKS";
                         $response["TOTAL_MARKS"]="$TOTAL_MARKS";
                         $response["CGPA"] ="$CGPA";
                         $response["PERCENTAGE"] ="$PERCENTAGE";
                         $response["INDV_RESULT_ANN_DATE"] ="$INDV_RESULT_ANN_DATE";
                         $response["RESULT_REMARKS"] ="$RESULT_REMARKS";
						 
						return $message;
      }//end if
	return -1;
}//end method
//*****************************************************************


//*****************************************************************
//*****************************************************************
function display_part_remarks($batch_id,$part,$exam_year, $exam_type){
	$query=" select REMARKS from part where BATCH_ID=$batch_id and PART=$part";
	$result=mysql_query($query);
      
      $remarks="";
	if($row=mysql_fetch_object($result))$remarks=$row->REMARKS;
	
	$exam_type=encode_exam_type($exam_type);
	
}//end method 
//*****************************************************************




//*****************************************************************
//*****************************************************************
//*****************************************************************
function  get_last_result($batch_id,$part,$roll_no){
  if($part==1)return null;

  $part--;

  $last_sl_id=get_last_SL_ID($batch_id,$part,$roll_no);
  if($last_sl_id==null)return "RW P-$part";

  $query="SELECT RESULT_REMARKS FROM ledger_detail_summary WHERE SL_ID=$last_sl_id AND ROLL_NO='$roll_no'";
  $result=mysql_query($query);    

  $result_REMARKS="PASS";
  if($row=mysql_fetch_object($result))$result_REMARKS=$row->RESULT_REMARKS;

  if($result_REMARKS=="FAIL")$result_REMARKS="RW P-$part";
  return $result_REMARKS;        
}//end methd
//*****************************************************************


//*****************************************************************
//*****************************************************************




/*
function display_ledger_detail_summary($sl_id,$part,$scheme_id,$batch_id,$exam_year, $exam_type){

//,TO_NUMBER(SUBSTRING(ROLL_NO,INSTR(ROLL_NO,'/',-1)+1),9999) as S_NO
      $query="select SL_ID,ROLL_NO,TOTAL_MARKS,RESULT_REMARKS,FORMAT(PERCENTAGE,2) AS PERCENTAGE,INDV_RESULT_ANN_DATE,FORMAT(CGPA,2) AS CGPA,OBTAIN_MARKS,NO_DUES_REMARKS,PREV_PART,PREV_ROLL_NO,PREV_SL_ID,PREV_RESULT_REMARKS from ledger_detail_summary where sl_id=$sl_id ";
      $result=mysql_query($query);

	$sno=0;
      while($row=mysql_fetch_object($result)){

	if($sno==0){

	 }



        $ROLL_NO=$row->ROLL_NO;
	  $sno=$sno+1;
	  	$response["SNO"] =$sno;
		$response["CGPA"] =$row->CGPA;
		$response["PERCENTAGE"] =$row->PERCENTAGE;
		$response["MARKS"] ="$row->OBTAIN_MARKS"."/ ". "$row->TOTAL_MARKS";
		$response["RESULT_REMARKS"] =$row->RESULT_REMARKS;
		$response["scheme_id"] =$scheme_id;
		$response["batch_id"] =$batch_id;
		$response["exam_year"] =$exam_year;
		$response["exam_type"] =$exam_type;
		$response["roll_no"] =$ROLL_NO;
		echo json_encode($response);

	//  echo("      <tD><a href=marks_certificate.php?sl_id=$sl_id&part=$part&scheme_id=$scheme_id&batch_id=$batch_id&exam_year=$exam_year&exam_type=$exam_type&roll_no=$ROLL_NO ALT='Click to view Marks'><b>$ROLL_NO</b></a></tD>");
	  
  }//end while

  
}//end methd
//*****************************************************************

*/

//*****************************************************************
//*****************************************************************
function display_marks_certificate($sl_id,$roll_no,$part,$scheme_id,$batch_id,$exam_year, $exam_type,$cell_no){    
      $display_part_remarks($batch_id,$part,$exam_year, $exam_type);
      $display_name_fname_surname_rollno = display_name_fname_surname_rollno($batch_id,$roll_no,$cell_no);
	 // echo($display_name_fname_surname_rollno);
      $display_marks = display_marks($sl_id,$roll_no,$part,$batch_id,$scheme_id); 
		//echo($display_marks);
			$msg="";
		  $msg.=$display_name_fname_surname_rollno;
		  $msg.=$display_marks;
		//echo($msg);
	  $response_array['studentname'] = $display_name_fname_surname_rollno;
	  $response_array['studentmarks'] = $display_marks;
	  
	  return $msg;
}//end method

 function  get_decimal_format($num){
//  $tokens=&new StringTokenizer("$num",".");
//  $dec_num="";
//  $dec_point="";
//  if($tokens->hasMoreTokens()) $dec_num=$tokens->nextToken();
//  if($tokens->hasMoreTokens()) $dec_point=$tokens->nextToken();
//  if(strlen($dec_point)==0)$num=$dec_num.".00";
//  if(strlen($dec_point)==2)$num=$dec_num."0";

return $num;  
}//end method



function get_semester_decode($sem_no){
	$semester_no=$sem_no;

	if($sem_no==1)$semester_no="FIRST";
	if($sem_no==2)$semester_no="SECOND";
	if($sem_no==3)$semester_no="THIRD";
	if($sem_no==4)$semester_no="FOURTH";
	if($sem_no==5)$semester_no="FIFTH";
	if($sem_no==6)$semester_no="SIXTH";
	if($sem_no==7)$semester_no="SEVENTH";
	if($sem_no==8)$semester_no="EIGHTH";

	return $semester_no;
}//end method
?>