<?php 


$con=mysql_connect('localhost','usindhex_rajakumar','@2k10/cse/60');
$ret =  mysql_select_db('usindhex_exams',$con);
//$con=mysql_connect('localhost','root','');
//$ret =  mysql_select_db('exam',$con);

$w = array(90, 60, 120, 50,40,20);
$h=5;


//*****************************************************************
//*****************************************************************
function get_scheme_id($sl_id){
   $query="select scheme_id from ledger where sl_id=$sl_id";
   $result=mysql_query($query);

   $scheme_id=null;
   if($row=mysql_fetch_object($result))$scheme_id=$row->scheme_id;

   return $scheme_id;
}//end method 
//*****************************************************************
//*****************************************************************
//*****************************************************************
function display_name_fname_surname_rollno($batch_id,$roll_no,$pdf){

      $query="select BATCH_ID,ROLL_NO,NAME,FNAME,SURNAME,GENDER from  student_registration where BATCH_ID=$batch_id and ROLL_NO='$roll_no'";
	$result=mysql_query($query);
      if($row=mysql_fetch_object($result)){
		       $pdf->SetFont('Times','B',10);
				$pdf->Ln();	
				 $pdf->SetFont('Times','B',10);
                $pdf->Cell(30,5,"NAME:",0,0);
                 $pdf->SetFont('Times','',10);
                
                $pdf->Cell(40,5,"$row->NAME",0,0);
                $pdf->Ln();
                   $pdf->SetFont('Times','B',10);
                $pdf->Cell(30,5,"FATHER'S NAME:",0,0);
                $pdf->SetFont('Times','',10);
                
                $pdf->Cell(40,5,"$row->FNAME",0,0);
                $pdf->Ln();
                   $pdf->SetFont('Times','B',10);
                $pdf->Cell(30,5,"SURNAME:",0,0);
                $pdf->SetFont('Times','',10);
                
                $pdf->Cell(30,5,"$row->SURNAME",0,0);
                $pdf->Ln();
                   $pdf->SetFont('Times','B',10);
                $pdf->Cell(30,5,"ROLL NO:",0,0);
                $pdf->SetFont('Times','',10);
                $pdf->Cell(30,5,"$row->ROLL_NO",0,0);
                $pdf->Ln();


   
      }//end if         
}//END METHOD
//*****************************************************************

//*****************************************************************
//*****************************************************************
function get_batch_ID($roll_no,$prog_id){

	$query=" SELECT BATCH.BATCH_ID FROM batch,student_registration ".
	" WHERE ".
	" BATCH.PROG_ID=$prog_id AND ".
	" STUDENT_REGISTRATION.BATCH_ID=BATCH.BATCH_ID AND ".
	" STUDENT_REGISTRATION.ROLL_NO='$roll_no' ";

	$result=mysql_query($query);

      $batch_id=0;
      if($row=mysql_fetch_object($result))  $batch_id=$row->BATCH_ID;  

	return $batch_id;
}//end function
//*****************************************************************


//*****************************************************************
//*****************************************************************
function get_SL_ID($batch_id,$part,$exam_year,$exam_type,$roll_no){
	 $query=" SELECT SEAT_LIST.SL_ID FROM seat_list,seat_list_detail ".
		 " where ".
		 " SEAT_LIST.part=$part AND ".
		 " SEAT_LIST.batch_id=$batch_id AND ".
		 " SEAT_LIST.year=$exam_year AND ".
//		 " SEAT_LIST.type='$exam_type' AND ".
		 " SEAT_LIST_DETAIL.ROLL_NO='$roll_no' AND ".
		 " SEAT_LIST.SL_ID=SEAT_LIST_DETAIL.SL_ID AND ".
		 " SEAT_LIST.PART=SEAT_LIST_DETAIL.PART AND ".
		 " SEAT_LIST.PART=SEAT_LIST_DETAIL.PART AND ".
		 " SEAT_LIST.BATCH_ID=SEAT_LIST_DETAIL.BATCH_ID ";
	$result=mysql_query($query);

      $sl_id=0;
      if($row=mysql_fetch_object($result))  $sl_id=$row->SL_ID;  

	return $sl_id;
}//end function
//*****************************************************************


//*****************************************************************
//*****************************************************************
function display_marks($sl_id,$roll_no,$part,$batch_id,$scheme_id,$pdf){
	$is_record_available=get_display_ledger_detail($sl_id,$roll_no,$scheme_id,$part,$pdf);
                 if($is_record_available){
		$is_record_available=get_display_ledger_detail_summary($sl_id,$roll_no,$part,$batch_id,$pdf);      
	                if(!$is_record_available){
	                    
                                            $pdf->Cell($w[1],$h,"Result still not announced...",1,0);
                                            $pdf->Ln();

		         return;	
		}
	  }else{	
	    $pdf->Cell($w[1],$h,">Result is in progress.......",1,0);
         $pdf->Ln();
											  $pdf->Cell($w[1],$h,"Please wait some days..",1,0);
                                            $pdf->Ln();

		
	}
}//end function

function getCourceDetail($SCHEME_ID,$COURSE_NO,$SEMESTER)
    {
       // $link= DataBaseManager1::connect();
		$query1="SELECT * FROM  ac_scheme_detail WHERE  SCHEME_ID=$SCHEME_ID AND  SEMESTER =$SEMESTER AND COURSE_NO='$COURSE_NO' ";
		//echo($query1);
		$subject_query1=mysql_query($query1);
		//$subject_query1=mysqli_query($link,$query1);
		$count= mysql_num_rows($subject_query1);
		if($count>0){
			return $subject_query1;
			
		}else{
			
			$query="SELECT SCHEME_ID,SCHEME_PART,SEMESTER,COURSE_NO,COURSE_TITLE,CR_HRS,MAX_MARKS,REMARKS,SUBJ_TYPE,IS_CREDITABLE,CONCAT('0') AS AC_ID FROM  scheme_detail WHERE  SCHEME_ID=$SCHEME_ID AND  SEMESTER =$SEMESTER AND  COURSE_NO='$COURSE_NO'";
			//echo($query);
			$subject_query=mysql_query($query);
			return $subject_query;

		}
	}

//*****************************************************************


//*****************************************************************
//*****************************************************************
function get_display_ledger_detail($sl_id,$roll_no,$scheme_id,$part,$pdf){
	
	$query="select semester from scheme_semester where scheme_id=$scheme_id and scheme_part=$part";
//	echo($query);
	$result_sem=mysql_query($query);

	 while($row=mysql_fetch_object($result_sem)){

	 	$sem_no=$row->semester;
		$semester_no=get_semester_decode($sem_no);
     
	      $query=get_ledger_detail_query($sl_id,$roll_no,$sem_no); 
	      
	      $result=mysql_query($query);
		  
		$is_record_available=false;
		$lastrow=0;
		$qp=0;
		$crtHRS=0;
		$sum=0;	
	      while($row=mysql_fetch_object($result)){
			  $lastrow=$lastrow+1;
			$totalRows= mysql_num_rows ($result);
			

			if(!$is_record_available){
			    $pdf->Ln();
					$pdf->SetFont("Times",'B',12);
			        $pdf->Cell(180,5,"$semester_no SEMESTER ",0,0,'C');
					$pdf->SetFont("Times",'B',10);
                    $pdf->Ln(6);
					$pdf->Cell(20,5,"C.NO","TBL",0); 
			        $pdf->Cell(80,5,"SUBJECTS","TB",0);
			        $pdf->Cell(15,5,"MAX.MRKS.","TB",0);
			        $pdf->Cell(15,5,"MIN.MRKS","TB",0);
			        $pdf->Cell(15,5,"OBT.MRKS","TB",0);
			        $pdf->Cell(15,5,"CRT.HRS","TB",0);
			        $pdf->Cell(15,5,"GRADE","TB",0);
			        $pdf->Cell(15,5,"Q.P","TRB",0);
					
                    $pdf->Ln(5);


				$is_record_available=true;
			}//end if
			
                           if($row->MARKS_OBTAINED!=""){
							   $resultschemeDetail=getCourceDetail($row->SCHEME_ID,$row->COURSE_NO,$sem_no);
							//   echo("r ".$resultschemeDetail);
							    if($rowschemeDetail=mysql_fetch_array($resultschemeDetail)){
										$courseTitle=$rowschemeDetail['COURSE_TITLE'];
										$maxMarks=$rowschemeDetail['MAX_MARKS'];
										$cr_hrs=$rowschemeDetail['CR_HRS'];
								}
		// $pdf->Cell(180,5,"$row->COURSE_NO     $courseTitle                                                         $maxMarks   $row->MIN_MARKS    $row->MARKS_OBTAINED   $row->GRADE   $row->QP" ,1,1);
		
					$border='L';
					  $sum+= ($row->MARKS_OBTAINED);
					  $qp+=($row->QP);
	                  $crtHRS+=$cr_hrs;
	                  
	                $pdf->SetFont("Times",'',10);
			
					if($lastrow==$totalRows){
					$pdf->Cell(20,5,"$row->COURSE_NO",'LB',0);
			        $pdf->Cell(80,5,"$courseTitle",'B',0);
			        $pdf->Cell(15,5,"$maxMarks",'B',0);
			        $pdf->Cell(15,5,"$row->MIN_MARKS",'B',0);
			        $pdf->Cell(15,5,"$row->MARKS_OBTAINED",'B',0);
			        $pdf->Cell(15,5,"$cr_hrs",'B',0);
			        $pdf->Cell(15,5,"$row->GRADE",'B',0);
			        $pdf->Cell(15,5,"$row->QP",'RB',0);
                    $pdf->Ln();
                     $pdf->SetFont("Times",'B',12);
                    $cgpa=round(($qp/$crtHRS), 2); 
                    $pdf->Cell(90,5,"MARKS OBTAINED: $sum",'LBU',0);
					$pdf->Cell(100,5,"G.P.A: $cgpa",'BUR',0);
					$pdf->Ln();
					}else{
				
			        $pdf->Cell(20,5,"$row->COURSE_NO",'L',0);
			        $pdf->Cell(80,5,"$courseTitle",0,0);
			        $pdf->Cell(15,5,"$maxMarks",0,0);
			        $pdf->Cell(15,5,"$row->MIN_MARKS",0,0);
			        $pdf->Cell(15,5,"$row->MARKS_OBTAINED",0,0);
			        $pdf->Cell(15,5,"$cr_hrs",'0',0);
			       
			        $pdf->Cell(15,5,"$row->GRADE",0,0);
			        $pdf->Cell(15,5,"$row->QP",'R',0);
                    $pdf->Ln();
					}
				}
			
	      }//end while


	    
  }//end outer while loop   

 return $is_record_available;
}//end function
//*****************************************************************


//*****************************************************************
//*****************************************************************

function get_ledger_detail_query($sl_id,$roll_no,$sem_no){ 
	$query="  SELECT 
	 ledger_details.COURSE_NO, 
	 ledger_details.MIN_MARKS, 
	 ledger_details.MARKS_OBTAINED, 
	 ledger_details.GRADE, 
	 ledger_details.QP, 
	 ledger_details.SEMESTER,
	 ledger_details.SCHEME_ID
	 
	 FROM ledger_details AS ledger_details
	 WHERE 
	 ledger_details.ROLL_NO='$roll_no' AND 
	 ledger_details.SL_ID=$sl_id AND 
	   
	 ledger_details.SEMESTER=$sem_no
	ORDER BY ledger_details.SEMESTER ;";

   return $query;
   
 }//end function

/*
function get_ledger_detail_query($sl_id,$roll_no,$sem_no){ 
	$query=" select ".
	" ledger_details.COURSE_NO, ledger_details.SCHEME_ID, ".
	" ledger_details.MIN_MARKS, ".
	" ledger_details.MARKS_OBTAINED, ".
	" ledger_details.GRADE, ".
	" ledger_details.QP, ".
	" ledger_details.SEMESTER ".
	" from ledger_details ".
	" where ".
	" ledger_details.ROLL_NO='$roll_no' AND ".
	" ledger_details.SL_ID=$sl_id AND ".
	" ledger_details.SEMESTER=$sem_no ".

	" ORDER BY ledger_details.SEMESTER ";
   return $query;
 }//end function
*/
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
//*****************************************************************


//*****************************************************************
//*****************************************************************
function get_display_ledger_detail_summary($sl_id,$roll_no,$part,$batch_id,$pdf){
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

	      if(!$is_record_available){
                
	       
 		 $is_record_available=true;	 
	      }


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
		
			$pdf->Ln(5);
	        $pdf->Cell(40,5,"MARKS OBTAINED:",0,0);
	        $pdf->Cell(30,5,"$OBTAIN_MARKS$sep$TOTAL_MARKS",0,0);
            $pdf->Ln();
            
            $pdf->Cell(40,5,"CGPA:",0,0);
	        $pdf->Cell(30,5,"$CGPA",0,0);
            $pdf->Ln();
            
             $pdf->Cell(40,5,"RESULT:",0,0);
	        $pdf->Cell(30,5,"$RESULT_REMARKS",0,0);
            $pdf->Ln();
            
            $pdf->Cell(40,5,"PERCENTAGE:",0,0);
	        $pdf->Cell(30,5,"$PERCENTAGE",0,0);
            $pdf->Ln();
                
            $pdf->Cell(40,5,"RESULT DECLARED:",0,0);
	        $pdf->Cell(30,5,"$INDV_RESULT_ANN_DATE",0,0);
            $pdf->Ln();

	
	
	
		
     }//end if

	if($is_record_available)   
	
	return $is_record_available;
}//end method
//*****************************************************************


//*****************************************************************
//*****************************************************************
function display_part_remarks($batch_id,$part,$exam_year, $exam_type,$pdf){
	$query=" select remarks from part where batch_id=$batch_id and part=$part";
	$result=mysql_query($query);
      
      $remarks="";
	if($row=mysql_fetch_object($result))$remarks=$row->remarks;
	
	$exam_type=encode_exam_type($exam_type);
    
    //$pdf->Cell(0,5,"$remarks $exam_type YEAR $exam_year",0,0,'C');
    $pdf->Cell(0,5,"$remarks   $exam_year",0,0,'C');
    $pdf->Ln();
    
    //$pdf->Cell(0,5,"Academic Transcript",1,0);
    //$pdf->Ln();
	
}//end method 
//*****************************************************************


//*****************************************************************
//*****************************************************************
 function encode_exam_type($exam_type){

	if($exam_type=="I")$exam_type=" IMP/FAIL ";
	if($exam_type=="R")$exam_type=" REGULAR ";
	if($exam_type=="S")$exam_type=" SPECIAL ";
	
	return $exam_type;
 }//END METHOD
//*****************************************************************


//*****************************************************************
//*****************************************************************
function get_date_of_ann($sl_id){
	$query="select SL_ID, ".         
	" SCHEME_ID, ".     
	" SCHEME_PART, ".    
	" date_format(ANN_DATE,'%d %M %Y') as ANN_DATE, ".       
	" TOTAL_PASS, ".     
	" TOTAL_FAIL, ".     
	" REMARKS, ".        
	" TABULATOR_NAME, ".
	" CHECKER_NAME FROM ledger WHERE SL_ID=$sl_id";

	$result=mysql_query($query);
	$ANN_DATE=null;
	if($row=mysql_fetch_object($result))$ANN_DATE=$row->ANN_DATE;
	return $ANN_DATE;
}//end methd
//*****************************************************************
   

//*****************************************************************
//*****************************************************************
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
function  get_last_SL_ID($batch_id,$part,$roll_no){
	$query=" SELECT ".
	" SL.PART, ".
	" SL.BATCH_ID, ".
	" SL.PREP_DATE, ".
	" SL.YEAR, ".
	" SL.REMARKS, ".
	" SL.PART_GROUP, ".
	" SL.TYPE, ".
	" ANN_DATE, ".
	" ROLL_NO, ".
	" SLD.SL_ID ".
	" FROM ".
	" seat_list SL, ".
	" seat_list_detail SLD, ".
	" ledger L ".
	" WHERE ".
	" SLD.BATCH_ID=$batch_id AND ".
	" SL.year<=2017 AND ".
	" SLD.PART=$part AND ".
	" SLD.ROLL_NO='$roll_no' AND ".
	" SLD.SL_ID=L.SL_ID AND ".
	" SL.SL_ID=SLD.SL_ID ".
	" ORDER BY ANN_DATE DESC";

	$result=mysql_query($query);    
	$last_sl_id=null;
	if($row=mysql_fetch_object($result))$last_sl_id=$row->SL_ID;

	return $last_sl_id;
}//end methd
//*****************************************************************



function get_batch_year_encode($YEAR){

	if($YEAR==2004)return "2K4";
	if($YEAR==2005)return "2K5";
	if($YEAR==2006)return "2K6";
	if($YEAR==2007)return "2K7";
	if($YEAR==2008)return "2K8";
	if($YEAR==2009)return "2K9";
	if($YEAR==2010)return "2K10";
	if($YEAR==2011)return "2K11";
	if($YEAR==2012)return "2K12";
	if($YEAR==2013)return "2K13";
	if($YEAR==2014)return "2K14";
	if($YEAR==2015)return "2K15";
	if($YEAR==2016)return "2K16";
	if($YEAR==2017)return "2K17";
	if($YEAR==2018)return "2K18";
	if($YEAR==2019)return "2K19";
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
//*****************************************************************
//*****************************************************************


function get_shift_encode($SHIFT){

	if($SHIFT=="M")return "MORNING";
	if($SHIFT=="E")return "EVENING";
	if($SHIFT=="N")return "NOON";

	return $SHIFT;
}//end method
//*****************************************************************
//*****************************************************************

function get_batch_group_encode($GROUP_DESC){
	if($GROUP_DESC=="COMM")return "COMMERCE";
	if($GROUP_DESC=="ENGG")return "ENGINEERING";
	if($GROUP_DESC=="GNRL")return "GENERAL";
	if($GROUP_DESC=="MEDL")return "MEDICAL";

	return $GROUP_DESC;
}//END METHOD
//*****************************************************************
//*****************************************************************

function get_department_name($dept_id,$pdf){

      $query="SELECT DEPT_ID,FAC_ID,INST_ID,DEPT_NAME,IS_INST,CODE,REMARKS FROM department WHERE DEPT_ID=$dept_id";
      
      $result=mysql_query($query);

      $DEPT_NAME=null;
     
      if($row=mysql_fetch_object($result)){
      $DEPT_NAME=$row->DEPT_NAME;
      $INST_ID=$row->INST_ID;
        if($INST_ID == 0){
            $pdf->Ln(4);
            $pdf->Cell(0,5,"$DEPT_NAME",0,0,'C');
            $pdf->Ln();
        }else{
        $query="SELECT DEPT_ID,FAC_ID,INST_ID,DEPT_NAME,IS_INST,CODE,REMARKS FROM department WHERE DEPT_ID=$INST_ID";
        $result=mysql_query($query);
        $row=mysql_fetch_object($result);
        $INSTITUTE_NAME=$row->DEPT_NAME;
     
            $pdf->Ln(4);
            $pdf->Cell(0,5,"$INSTITUTE_NAME",0,0,'C');
            $pdf->Ln();
        }
            
    }
      
                           
      

	//return $DEPT_NAME;
}//end method

//*****************************************************************
//*****************************************************************


function display_marks_certificate($sl_id,$roll_no,$part,$scheme_id,$batch_id,$exam_year, $exam_type,$pdf,$dept_id){
      get_department_name($dept_id,$pdf);
      display_part_remarks($batch_id,$part,$exam_year, $exam_type,$pdf);
      display_name_fname_surname_rollno($batch_id,$roll_no,$pdf);
      display_marks($sl_id,$roll_no,$part,$batch_id,$scheme_id,$pdf);    
}//end method
//*****************************************************************
//*****************************************************************
//*****************************************************************




?>