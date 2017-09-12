<?php 

$ret =  mysql_select_db('exam',mysql_connect('localhost','root',''));


//*****************************************************************
//*****************************************************************
function display_programs_in_combobox(){
      $query="select PROG_ID, DEPT_ID, PROGRAM_TITLE, SEM_DURATION, SEM_PER_PART, REMARKS from program order by PROGRAM_TITLE";
      $result=mysql_query($query)or die(header("Location: error.html"));
      while($row=mysql_fetch_object($result))
		echo("<option value=". $row->PROG_ID .">". $row->PROGRAM_TITLE ."</option> ");     
}
//*****************************************************************

     
//*****************************************************************
//*****************************************************************
function display_scheme_years_in_combobox(){    
      $result=mysql_query("SELECT YEAR FROM year ORDER BY YEAR");
      while($row=mysql_fetch_object($result))
		echo("<option value=$row->YEAR>$row->YEAR</option> ");     
}//end method
//*****************************************************************

//*****************************************************************
//*****************************************************************
function get_scheme_id($sl_id){
   $query="select scheme_id from ledger where sl_id=$sl_id";
   $result=mysql_query($query)or die(header("Location: error.html"));

   $scheme_id=null;
   if($row=mysql_fetch_object($result))$scheme_id=$row->scheme_id;

   return $scheme_id;
}//end method 
//*****************************************************************


//*****************************************************************
//*****************************************************************
function display_name_fname_surname_rollno($batch_id,$roll_no){

      $query="select BATCH_ID,ROLL_NO,NAME,FNAME,SURNAME,GENDER from  student_registration where BATCH_ID=$batch_id and ROLL_NO='$roll_no'";
	$result=mysql_query($query)or die(header("Location: error.html"));
      if($row=mysql_fetch_object($result)){

	 // echo("<div class='col-md-2'></div>");

echo("<div class='col-md-6'>");
		//echo("<div class='table-responsive'>");
	
		echo("<table class='table table-hover' ");

	
		echo("<TR class='active'> ");
		echo("	<TD class='active'>NAME:</TD> ");
		echo("	<TD class='active'><b>$row->NAME</b></TD> ");
		echo("</TR> ");
		echo("<TR class='active' > ");
		echo("	<TD >FATHER'S NAME:</TD> ");
		echo("	<TD><b>$row->FNAME</b></TD>  ");
		echo("</TR> ");
		echo("<TR class='active' > ");
		echo("	<TD>SURNAME:</TD> ");
		echo("	<TD><b>$row->SURNAME</b></TD> ");
		echo("</TR> ");
		echo("<TR class='active'> ");
		echo("	<TD>ROLL NO:</TD> ");
		echo("	<TD><b>$row->ROLL_NO</b></TD> ");
		echo("</TR> "); 
		echo("</TABLE>");
			echo("</div>");
  // 	echo("</div>");
   	
   
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

	$result=mysql_query($query)or die(header("Location: error.html"));

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
	$result=mysql_query($query)or die(header("Location: error.html"));

      $sl_id=0;
      if($row=mysql_fetch_object($result))  $sl_id=$row->SL_ID;  

	return $sl_id;
}//end function
//*****************************************************************


//*****************************************************************
//*****************************************************************
function display_marks($sl_id,$roll_no,$part,$batch_id,$scheme_id){
	$is_record_available=get_display_ledger_detail($sl_id,$roll_no,$scheme_id,$part);
                 if($is_record_available){
		$is_record_available=get_display_ledger_detail_summary($sl_id,$roll_no,$part,$batch_id);      
	                if(!$is_record_available){
                                           echo("<h2>Result still not announced......</h2>");
		         return;	
		}
	  }else{	
		echo("<h2>Result is in progress.......</h2>");
		echo("<h3>Please wait some days...</h3>");
	}
}//end function
//*****************************************************************


//*****************************************************************
//*****************************************************************
function get_display_ledger_detail($sl_id,$roll_no,$scheme_id,$part){
	
	$query="select semester from scheme_semester where scheme_id=$scheme_id and scheme_part=$part";
//	echo($query);
	$result_sem=mysql_query($query)or die(header("Location: error.html"));
echo("<div class='col-md-2'></div>");

echo("<div class='col-md-8'>");
	//	echo("<div class='table-responsive'>");
	
		echo("<table class='table  table-bordered' ");

	 while($row=mysql_fetch_object($result_sem)){

	 	$sem_no=$row->semester;
		$semester_no=get_semester_decode($sem_no);
     
	      $query=get_ledger_detail_query($sl_id,$roll_no,$sem_no); 
	      
	      $result=mysql_query($query)or die(header("Location: error.html"))or die(header("Location: error.html"));
		  
		$is_record_available=false;
	      while($row=mysql_fetch_object($result)){

			if(!$is_record_available){
				echo("<TR> ");
				echo("	<TH colspan=7 bgcolor='#CCCCCC' style='text-align: center;'>$semester_no SEMESTER</TH> ");
				echo("</TR> ");

				echo("<TR  class='info'> ");
				echo("	<TH style='text-align: center;'>COURSE.NO</TH> ");
				echo("	<TH style='text-align: center;'>SUBJECTS</TH> ");
				echo("	<TH style='text-align: center;'>MAX.MK.</TH> ");
				echo("	<TH style='text-align: center;'>MIN.MK.</TH> ");
				echo("	<TH style='text-align: center;'>OBT.MK.</TH> ");
				echo("	<TH style='text-align: center;'>GRADE</TH> ");
				echo("	<TH style='text-align: center;'>Q.P</TH> ");
				echo("</TR> ");

				$is_record_available=true;
			}//end if
			/*
			$courseNo = $row->COURSE_NO ;
			
                   $que = "SELECT DISTINCT(`COURSE_TITLE`) FROM `scheme_detail` WHERE `COURSE_NO` LIKE '%$courseNo%' AND SCHEME_ID=".$row->SCHEME_ID;
                            
                            $resultSet = mysql_query($que);
                            if($data=  mysql_fetch_object($resultSet)){
                                $courseNo = $data->COURSE_TITLE;
                           }
						   */
                           if($row->MARKS_OBTAINED!=0){
			echo("<TR bgcolor='FFFFEF'> ");
			echo("	<TD>$row->COURSE_NO </TD> ");
			echo("	<TD>$row->COURSE_TITLE</TD> ");
			echo("	<TD ALIGN=CENTER>$row->MAX_MARKS </TD> ");
			echo("	<TD ALIGN=CENTER>$row->MIN_MARKS </TD> ");
			echo("	<TD ALIGN=CENTER>$row->MARKS_OBTAINED </TD> ");
			echo("	<TD ALIGN=CENTER>$row->GRADE </TD> ");
			echo("	<TD ALIGN=CENTER>$row->QP</TD> ");
			echo("</TR> ");}
			
	      }//end while


	      
	echo("<TR> ");
	echo("<COLSPAN=5> ");
	echo("</TR> ");

  }//end outer while loop   
 echo("</TABLE>");
 echo("</div>");
// echo("</div>");
 echo("<div class='col-md-2'></div>");

 return $is_record_available;
}//end function
//*****************************************************************


//*****************************************************************
//*****************************************************************

function get_ledger_detail_query($sl_id,$roll_no,$sem_no){ 
	$query=" select ".
	" ledger_details.COURSE_NO, ".
	" scheme_detail.COURSE_TITLE, ".
	" scheme_detail.MAX_MARKS, ".
	" ledger_details.MIN_MARKS, ".
	" ledger_details.MARKS_OBTAINED, ".
	" scheme_detail.CR_HRS, ".
	" ledger_details.GRADE, ".
	" ledger_details.QP, ".
	" ledger_details.SEMESTER, ".
	" scheme_detail.IS_CREDITABLE ".
	" from ledger_details as ledger_details ,scheme_detail as scheme_detail ".
	" where ".
	" ledger_details.ROLL_NO='$roll_no' AND ".
	" ledger_details.SL_ID=$sl_id AND ".
	" ledger_details.COURSE_NO=scheme_detail.COURSE_NO AND ".
	" ledger_details.SCHEME_ID=scheme_detail.SCHEME_ID AND ".
	" ledger_details.SCHEME_PART=scheme_detail.SCHEME_PART AND ".
	" ledger_details.SEMESTER=scheme_detail.SEMESTER AND ".
	" ledger_details.SEMESTER=$sem_no ".

	" ORDER BY ledger_details.SEMESTER ";

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

      $result=mysql_query($query)or die(header("Location: error.html"));
      if($row=mysql_fetch_object($result)){

	      if(!$is_record_available){
echo("<div class='col-md-2'></div>");

echo("<div class='col-md-6'>");
		//echo("<div class='table-responsive'>");
	
		echo("<table class='table  table-bordered' ");

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
		

		echo("<TR class='success'> ");
		echo("	<TD class='success'>MARKS OBTAINED: </TD> ");
		echo("	<TD class='success'><b>$OBTAIN_MARKS$sep$TOTAL_MARKS </b></TD> ");
		echo("</TR> ");
		echo("<TR class='success'> ");
		echo("	<TD>CGPA:</TD> ");
		echo("	<TD><b>$CGPA</b></TD> ");
		echo("</TR> ");
		echo("<TR class='success'> ");
		echo("	<TD>RESULT:</TD> ");
	        echo("	<TD><b>$RESULT_REMARKS</b></TD> ");
		echo("</TR> ");
		echo("<TR class='success'> ");
		echo("	<TD>PERCENTAGE:</TD> ");
		echo("	<TD><b>$PERCENTAGE</b> </TD> ");
		echo("</TR> ");           
	      	echo("<TR class='success'> ");
		echo("	<TD>RESULT DECLARED:</TD> ");
		echo("	<TD><b>$INDV_RESULT_ANN_DATE</b></TD> ");
		echo("</TR> ");
     }//end if

	if($is_record_available)   echo("</TABLE>");
	
	return $is_record_available;
}//end method
//*****************************************************************


//*****************************************************************
//*****************************************************************
function display_part_remarks($batch_id,$part,$exam_year, $exam_type){
	$query=" select remarks from part where batch_id=$batch_id and part=$part";
	$result=mysql_query($query)or die(header("Location: error.html"));
      
      $remarks="";
	if($row=mysql_fetch_object($result))$remarks=$row->remarks;
	
	$exam_type=encode_exam_type($exam_type);


	echo("<div class='col-md-8'>");
	echo("<FONT SIZE=5 color='#006666'><B>$remarks $exam_type $exam_year </B></FONT><BR>");
	echo("<FONT SIZE='5'  ><B>Academic Transcript</B></FONT><BR><BR>");
	echo("</div>");
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

	$result=mysql_query($query)or die(header("Location: error.html"));
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
  $result=mysql_query($query)or die(header("Location: error.html"));    

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
	" SLD.PART=$part AND ".
	" SLD.ROLL_NO='$roll_no' AND ".
	" SLD.SL_ID=L.SL_ID AND ".
	" SL.SL_ID=SLD.SL_ID ".
	" ORDER BY ANN_DATE DESC";

	$result=mysql_query($query)or die(header("Location: error.html"));    
	$last_sl_id=null;
	if($row=mysql_fetch_object($result))$last_sl_id=$row->SL_ID;

	return $last_sl_id;
}//end methd
//*****************************************************************


//*****************************************************************
//*****************************************************************
function display_seat_list_years_in_combobox(){

      $result=mysql_query("SELECT DISTINCT YEAR FROM year ORDER BY YEAR");
	  
      while($row=mysql_fetch_object($result))
	 
	  echo("<option value=$row->YEAR>$row->YEAR</option> ");     
}//end method
//*****************************************************************

//*****************************************************************
//*****************************************************************
function display_last_seat_list_years_in_combobox($last_ann_year){

      $result=mysql_query("SELECT DISTINCT YEAR FROM seat_list WHERE YEAR>=2004 and YEAR<=$last_ann_year ORDER BY YEAR");
      while($row=mysql_fetch_object($result))
		echo("<option value=$row->YEAR>$row->YEAR</option> ");     
}//end method
//*****************************************************************


function display_departments_in_combobox(){
      $query="SELECT DEPT_ID,FAC_ID,INST_ID,DEPT_NAME,IS_INST,CODE,REMARKS FROM department WHERE IS_INST='N' order by DEPT_NAME";
      $result=mysql_query($query)or die(header("Location: error.html"));
      while($row=mysql_fetch_object($result))
		echo("<option value=$row->DEPT_ID>$row->DEPT_NAME</option> ");     
}//end method


function display_departments_with_insititute(){
      $query="SELECT DEPT_ID,FAC_ID,INST_ID,DEPT_NAME,IS_INST,CODE,REMARKS FROM department WHERE DEPT_NAME <> 'COMPUTER SCIENCE' AND DEPT_NAME <> 'MATHEMATICS' AND DEPT_NAME <> 'PHYSICS' AND DEPT_NAME <> 'PHARMACY'  AND DEPT_NAME <> 'POLITICAL SCIENCE' AND DEPT_NAME <> 'WOMEN DEVLOPMENT STUDIES' AND DEPT_NAME <> 'BIOTECHNOLOGY' AND DEPT_NAME <> 'CHEMISTRY' AND  DEPT_NAME <> 'BIOCHEMISTRY' AND DEPT_NAME <> 'COMMERCE' AND DEPT_NAME <> 'ELECTRONICS' AND DEPT_NAME <> 'GENETIC ENGINEERING'  AND DEPT_NAME <> 'INFORMATION TECHNOLOGY' AND DEPT_NAME <> 'SOFTWARE ENGINEERING' AND DEPT_NAME <> 'ART & DESIGN' AND DEPT_NAME <> 'ENGLISH' AND DEPT_NAME <> 'BUSINESS ADMINSTRATION' AND  DEPT_NAME <> 'ARABIC' AND DEPT_NAME <> 'PERSIAN' AND DEPT_NAME <> 'CENTRE FOR MUSIC EDUCATION  INSTITUTE OF ART & DES'  AND DEPT_NAME <> 'LAW' AND DEPT_NAME <> 'TELECOMMUNICATION' order by DEPT_NAME  ";
      $result=mysql_query($query)or die(header("Location: error.html"));
      while($row=mysql_fetch_object($result))
		echo("<option value=$row->DEPT_ID>$row->DEPT_NAME</option> ");     
}//end method

function get_batch_year_encode($YEAR){

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


function get_shift_encode($SHIFT){

	if($SHIFT=="M")return "MORNING";
	if($SHIFT=="E")return "EVENING";
	if($SHIFT=="N")return "NOON";

	return $SHIFT;
}//end method

function get_batch_group_encode($GROUP_DESC){
	if($GROUP_DESC=="COMM")return "COMMERCE";
	if($GROUP_DESC=="ENGG")return "ENGINEERING";
	if($GROUP_DESC=="GNRL")return "GENERAL";
	if($GROUP_DESC=="MEDL")return "MEDICAL";

	return $GROUP_DESC;
}//END METHOD

function get_department_name($dept_id){

      $query="SELECT DEPT_ID,FAC_ID,INST_ID,DEPT_NAME,IS_INST,CODE,REMARKS FROM department WHERE DEPT_ID=$dept_id";
      
      $result=mysql_query($query)or die(header("Location: error.html"));

      $DEPT_NAME=null;
      if($row=mysql_fetch_object($result))
                             $DEPT_NAME=$row->DEPT_NAME;

	return $DEPT_NAME;
}//end method


        
function get_program_name($prog_id){
      $query="SELECT PROG_ID,DEPT_ID,PROGRAM_TITLE,SEM_DURATION,SEM_PER_PART,REMARKS FROM program WHERE PROG_ID=$prog_id";
      $result=mysql_query($query)or die(header("Location: error.html"));

	$PROGRAM_TITLE=null;
      if($row=mysql_fetch_object($result))$PROGRAM_TITLE=$row->PROGRAM_TITLE;

	return $PROGRAM_TITLE;
}//end method


function display_ledger_detail_summary($sl_id,$part,$scheme_id,$batch_id,$exam_year, $exam_type){

//,TO_NUMBER(SUBSTRING(ROLL_NO,INSTR(ROLL_NO,'/',-1)+1),9999) as S_NO
      $query="select SL_ID,ROLL_NO,TOTAL_MARKS,RESULT_REMARKS,FORMAT(PERCENTAGE,2) AS PERCENTAGE,INDV_RESULT_ANN_DATE,FORMAT(CGPA,2) AS CGPA,OBTAIN_MARKS,NO_DUES_REMARKS,PREV_PART,PREV_ROLL_NO,PREV_SL_ID,PREV_RESULT_REMARKS from ledger_detail_summary where sl_id=$sl_id ";
      $result=mysql_query($query)or die(header("Location: error.html"));

	$sno=0;
      while($row=mysql_fetch_object($result)){

	if($sno==0){
	 echo("<div class='col-md-2'></div>");

echo("<div class='col-md-8'>");
//		echo("<div class='table-responsive'>");
	
		echo("<table class='table  table-bordered' ");
			echo("   <tr >");
	  echo("      <th class='info' style='text-align:center'>S.NO</th>");
	  echo("      <th class='info' style='text-align:center'>ROLL NO.</th>");
	  echo("      <th class='info' style='text-align:center'>C.G.P.A</th>");
	  echo("      <th class='info' style='text-align:center'>PER.</th>");
	  echo("      <th class='info' style='text-align:center'>OBT/ TOTAL</th>");
	  echo("      <th class='info' style='text-align:center'>PASS/ FAIL</th>");
	  echo("   </tr>");
	}



        $ROLL_NO=$row->ROLL_NO;
	  $sno=$sno+1;
	  echo("   <tr bgcolor='FFFFEF'>");
	  echo("      <tD align=center>$sno</tD>");
	  echo("      <tD><a href=marks_certificate.php?sl_id=$sl_id&part=$part&scheme_id=$scheme_id&batch_id=$batch_id&exam_year=$exam_year&exam_type=$exam_type&roll_no=$ROLL_NO ALT='Click to view Marks'><b>$ROLL_NO</b></a></tD>");
	  echo("      <tD>$row->CGPA</tD>");
	  echo("      <tD>$row->PERCENTAGE</tD>");
	  echo("      <tD>$row->OBTAIN_MARKS"."/ ". "$row->TOTAL_MARKS</tD>");
	  echo("      <tD>$row->RESULT_REMARKS</tD>");
	  echo("   </tr>");

  }//end while

  echo(" </table>");
echo("<div class='col-md-2'></div>");

}//end methd
//*****************************************************************

//*****************************************************************
//*****************************************************************
function display_marks_certificate($sl_id,$roll_no,$part,$scheme_id,$batch_id,$exam_year, $exam_type){    
      display_part_remarks($batch_id,$part,$exam_year, $exam_type);
      display_name_fname_surname_rollno($batch_id,$roll_no);
      display_marks($sl_id,$roll_no,$part,$batch_id,$scheme_id);    
}//end method
//*****************************************************************

					

//*****************************************************************
//*****************************************************************
function get_stood_decode($stood){
	$stood_str=$stood;

	if($stood==1)$stood_str="STOOD FIRST";
	if($stood==2)$stood_str="STOOD SECOND";
	if($stood==3)$stood_str="STOOD THIRD";

	return $stood_str;
}//end method

//*****************************************************************

//*****************************************************************
//*****************************************************************
function display_student_reg($batch_id,$ROLL_NO){ 
  $query="SELECT NAME,FNAME,SURNAME FROM student_registration WHERE BATCH_ID=$batch_id and ROLL_NO='$ROLL_NO'";
  $result=mysql_query($query)or die(header("Location: error.html"));
  if($row=mysql_fetch_object($result)){
	$NAME=$row->NAME;
	$FNAME=$row->FNAME;
	$SURNAME=$row->SURNAME;

	echo("    <TR bgcolor='FFFFEF'>");
	echo("      <TD >NAME: </TD>");
	echo("      <TD COLSPAN=5><B>$NAME</B></TD>");
	echo("    </TR>");
	echo("    <TR bgcolor='FFFFEF'>");
	echo("      <TD >FATHER'S NAME: </TD>");
	echo("      <TD COLSPAN=5><B>$FNAME</B></TD>");
	echo("    </TR>");
	echo("    <TR bgcolor='FFFFEF'>");
	echo("      <TD >SURNAME: </TD>");
	echo("      <TD COLSPAN=5><B>$SURNAME</B></TD>");
	echo("    </TR>");
   }
}//end function



//*****************************************************************
//*****************************************************************
function display_student_reg_successful($batch_id,$ROLL_NO){ 
  $query="SELECT NAME,FNAME,SURNAME FROM student_registration WHERE BATCH_ID=$batch_id and ROLL_NO='$ROLL_NO'";
  $result=mysql_query($query)or die(header("Location: error.html"));
  if($row=mysql_fetch_object($result)){
	$NAME=$row->NAME;
	$FNAME=$row->FNAME;
	$SURNAME=$row->SURNAME;	
      echo("  	<TD>$NAME</TD>");
      echo("  	<TD>$FNAME</TD>");
	echo("  	<TD>$SURNAME</TD>");

   }
}//end function



function getNumOfPassStd($sl_id){
	
  $query="SELECT COUNT(RESULT_REMARKS) AS RESULT_REMARKS FROM ledger_detail_summary WHERE RESULT_REMARKS LIKE 'PASS' AND SL_ID=$sl_id";
  $result=mysql_query($query)or die(header("Location: error.html"));
  $num_of_pass_std=0;
  if($row=mysql_fetch_object($result))
	$num_of_pass_std=$row->RESULT_REMARKS;

  return $num_of_pass_std;
}//end method



function get_number_of_exams($EXAM_YEAR,$EXAM_TYPE){
   $query ="SELECT COUNT(SL_ID) AS NUMBER_OF_EXAMS FROM seat_list WHERE TYPE='$EXAM_TYPE' AND YEAR='$EXAM_YEAR'";
   $result=mysql_query($query)or die(header("Location: error.html"));
   $NUMBER_OF_EXAMS=0;
   if($row=mysql_fetch_object($result))
	$NUMBER_OF_EXAMS=$row->NUMBER_OF_EXAMS;

   return $NUMBER_OF_EXAMS; 			
}//end 
/*
function get_number_of_gender_students($EXAM_YEAR,$EXAM_TYPE,$GENDER){	     	
   $query="SELECT SL_ID from seat_list where year='$EXAM_YEAR' and type='$EXAM_TYPE'";
    $NUMBER_OF_GENDER_STUDENTS=0;

    $result=mysql_query($query)or die(header("Location: error.html"));
    while($row=mysql_fetch_object($result)){
	$SL_ID=$row->SL_ID;
   
	 $query ="SELECT COUNT(STUDENT_REGISTRATION.ROLL_NO) AS NUMBER_OF_GENDER_STUDENTS FROM ".
         " STUDENT_REGISTRATION, ".
         " SEAT_LIST_DETAIL  ".
         " WHERE ".
         " STUDENT_REGISTRATION.GENDER='$GENDER' AND ".
         " STUDENT_REGISTRATION.BATCH_ID=SEAT_LIST_DETAIL.BATCH_ID AND ".
         " STUDENT_REGISTRATION.ROLL_NO=SEAT_LIST_DETAIL.ROLL_NO ";
         " SEAT_LIST_DETAIL.SL_ID=$SL_ID AND ".
 //   echo($query);

      $result_summary=mysql_query($query)or die(header("Location: error.html"));
      if($row_summary=mysql_fetch_object($result_summary)){
   	    $NUM=$row_summary->NUMBER_OF_GENDER_STUDENTS;
   	    $NUMBER_OF_GENDER_STUDENTS=$NUMBER_OF_GENDER_STUDENTS+$NUM;
      }

    }//END WHILE

   return $NUMBER_OF_GENDER_STUDENTS;
}//end method

*/



function get_number_of_gender_students($EXAM_YEAR,$EXAM_TYPE,$GENDER){	     	
  
         $query ="SELECT COUNT(STUDENT_REGISTRATION.ROLL_NO) AS NUMBER_OF_GENDER_STUDENTS FROM ".
         " student_registration,".
         " seat_list,".
         " seat_list_detail".
         " WHERE ".
         " STUDENT_REGISTRATION.BATCH_ID=SEAT_LIST.BATCH_ID AND ".
         " SEAT_LIST.SL_ID=SEAT_LIST_DETAIL.SL_ID AND ".
         " SEAT_LIST.BATCH_ID=SEAT_LIST_DETAIL.BATCH_ID AND ".
         " SEAT_LIST.YEAR='$EXAM_YEAR' AND ".
         " SEAT_LIST.TYPE='$EXAM_TYPE' AND ".
         " STUDENT_REGISTRATION.GENDER='$GENDER' AND ".
         " STUDENT_REGISTRATION.BATCH_ID=SEAT_LIST_DETAIL.BATCH_ID AND ".
         " STUDENT_REGISTRATION.ROLL_NO=SEAT_LIST_DETAIL.ROLL_NO ";

          $NUMBER_OF_GENDER_STUDENTS=0;

      $result_summary=mysql_query($query)or die(header("Location: error.html"));
      if($row_summary=mysql_fetch_object($result_summary))
   	    $NUMBER_OF_GENDER_STUDENTS=$row_summary->NUMBER_OF_GENDER_STUDENTS;

   return $NUMBER_OF_GENDER_STUDENTS;
}//end method











function get_number_of_pass_fail_students($EXAM_YEAR,$EXAM_TYPE,$RESULT_REMARKS){
$query="SELECT COUNT(LEDGER_DETAIL_SUMMARY.ROLL_NO) ". 
" AS NUMBER_OF_PASS_FAIL_STUDENTS FROM  ".
" seat_list, ".
" seat_list_detail, ".
" ledger_detail_summary  ".
" WHERE ".
" SEAT_LIST.SL_ID=SEAT_LIST_DETAIL.SL_ID AND ".
" SEAT_LIST.BATCH_ID=SEAT_LIST_DETAIL.BATCH_ID AND ".
" SEAT_LIST_DETAIL.SL_ID=LEDGER_DETAIL_SUMMARY.SL_ID AND ".
" SEAT_LIST_DETAIL.ROLL_NO=LEDGER_DETAIL_SUMMARY.ROLL_NO AND ".
" SEAT_LIST.year='$EXAM_YEAR' AND ".
" SEAT_LIST.type='$EXAM_TYPE' AND ".
" RESULT_REMARKS='$RESULT_REMARKS'";

      $NUMBER_OF_PASS_FAIL_STUDENTS=0;
      $result_summary=mysql_query($query)or die(header("Location: error.html"));
      if($row_summary=mysql_fetch_object($result_summary))
           $NUMBER_OF_PASS_FAIL_STUDENTS=$row_summary->NUMBER_OF_PASS_FAIL_STUDENTS;

   return $NUMBER_OF_PASS_FAIL_STUDENTS;
}//end method


function save_comments($MessageType,$Subject,$Comments,$Username,$UserEmail,$UserTel,$to_day_date){

    $query="insert into comments (MessageType,Subject,Comments,Username,UserEmail,UserTel,to_day_date) values ('$MessageType','$Subject','$Comments','$Username','$UserEmail','$UserTel','$to_day_date')";
    $row=mysql_query($query)or die(header("Location: error.html"));

    return $row;

}//end method

?>