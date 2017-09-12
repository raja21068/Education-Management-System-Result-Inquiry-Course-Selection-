<?php
      include("../Database.php");

	$sl_id  =		mysql_escape_string($_REQUEST["batch"]);    
	$exam_year	=mysql_escape_string($_REQUEST["exam_year"]);
	$semester=mysql_escape_string($_REQUEST['semester']);
	$course_no = mysql_escape_string($_REQUEST['courseNo']);
	$BATCH_ID="";
	$TEACHER_CODE=mysql_escape_string(strtoupper($_REQUEST['TEACHER_CODE']));
	$TEACHER_ID=mysql_escape_string($_REQUEST['STUDENT_CODE']);
	
	$dept_id		=mysql_escape_string($_REQUEST["dept_id"]);
	$program_id=mysql_escape_string($_REQUEST['program_id']);
	//$email=$_REQUEST['email'];
	$prog_name="";
	
	$query="select SL.TYPE,B.YEAR,B.SHIFT,B.BATCH_ID,B.GROUP_DESC,P.REMARKS from seat_list SL,part P, batch B WHERE SL_ID=$sl_id AND P.PART=SL.PART AND B.BATCH_ID=SL.BATCH_ID AND P.BATCH_ID=B.BATCH_ID";
			    	echo($query);		    
				$result_seat_list=mysql_query($query);
			     if($row_seat_list=mysql_fetch_object($result_seat_list)){
				
							
							//$PROGRAM_TITLE=$row_program->PROGRAM_TITLE;
	                       // $PROG_ID=$row_program->PROG_ID;
	                        //$PART=$row_part->PART;
	                        $TYPE=$row_seat_list->TYPE;
	                        //$EXAM_YEAR=$row_seat_list->YEAR;
	                        //$SL_ID=$row_seat_list->SL_ID;
	                        $BATCH_YEAR=get_batch_year_encode($row_seat_list->YEAR);
	                        $SHIFT=$row_seat_list->SHIFT;
	                        $BATCH_ID=$row_seat_list->BATCH_ID;
	                        $GROUP_DESC=$row_seat_list->GROUP_DESC;                        
      	                  $PART_REMARKS=$row_seat_list->REMARKS;
							
	                        	//	echo("$TYPE </br>");
									
					$program_ann=("$PART_REMARKS ".encode_exam_type($TYPE)." BATCH ($BATCH_YEAR)");

					if(strstr($SHIFT,"E")=="E" &&  strstr($PART_REMARKS,"EVENING")==null)$program_ann="$program_ann ".get_shift_encode($SHIFT)."";
					if($GROUP_DESC!=null && $GROUP_DESC!="GNRL") $program_ann="$program_ann ".get_batch_group_encode($GROUP_DESC)."";
					$prog_name=$program_ann;
	//				echo("</br>".$announced_programs);
					}
	
	
	//echo("sl_id: $sl_id</BR>");
//	echo("exam_year: $exam_year</BR>");
	//echo("prog_name: $prog_name</BR>");
	//echo("batch_id: $BATCH_ID</BR>");
	//echo("TEACHER_CODE: $TEACHER_CODE</BR>");
//	echo("STUDENT_CODE: $STUDENT_CODE</BR>");
	
		if($TEACHER_CODE==""){
			echo("teachercode");
			return;
		}
	//	if($STUDENT_CODE==""){
		//		echo("studentcode");
			//	return;
	//	}
	  $teacher_code_query="SELECT TEACHER_CODE FROM ledger_details_teacher WHERE TEACHER_CODE ='".$TEACHER_CODE."'";
	  $result_teacher_code=mysql_query($teacher_code_query);
	  $row_teacher_code=mysql_num_rows($result_teacher_code);
		if($row_teacher_code>0){
				echo("teachercode");
				return;
		}
		/*		
		$student_code_query="SELECT STUDENT_CODE FROM ledger_details_teacher WHERE STUDENT_CODE ='".$STUDENT_CODE."'";
		//echo($student_code_query);
		$result_student_code=mysql_query($student_code_query);
		$row_student_code=mysql_num_rows($result_student_code);
		//echo("Rows: ".$row_student_code."</br>");
		
		if($row_student_code>0){
				echo("studentcode");
				return;
		}
		*/

		$course_query="SELECT COURSE_TITLE FROM  scheme_detail where COURSE_NO='$course_no'";
		$result_course_name=mysql_query($course_query);
	    $COURSE_TITLE="";
		if($row_course_name=mysql_fetch_object($result_course_name)){
			           $COURSE_TITLE=$row_course_name->COURSE_TITLE;
					 
		}
	
      $scheme_id=get_scheme_id($sl_id);
	  $query="SELECT * FROM ledger_details WHERE SCHEME_ID =$scheme_id AND ledger_details.SEMESTER = $semester AND ledger_details.COURSE_NO = '$course_no'  AND SL_ID=$sl_id";
	$result_teacher_list=mysql_query($query);
				// echo($query);
				 $sno=0;
			      while($row_teacher_list=mysql_fetch_object($result_teacher_list)){

							
							$SCHEME_ID=$row_teacher_list->SCHEME_ID;
							$SCHEME_PART=$row_teacher_list->SCHEME_PART;
							$AC_ID=$row_teacher_list->AC_ID;
							$SL_ID=$row_teacher_list->SL_ID;
							$ROLL_NO=$row_teacher_list->ROLL_NO;
	                        $SEMESTER=$row_teacher_list->SEMESTER;
							$COURSE_NO=$row_teacher_list->COURSE_NO;
							$MARKS_OBTAINED=$row_teacher_list->MARKS_OBTAINED;
	                        $GRADE=$row_teacher_list->GRADE;
							$REMARKS=$row_teacher_list->REMARKS;
							$MIN_MARKS=$row_teacher_list->MIN_MARKS;
						    $QP=$row_teacher_list->QP;
	                    	$UNI_MARKS_OBTAINED=$row_teacher_list->UNI_MARKS_OBTAINED;
	                        $COLLEGE_MARKS_OBTAINED=$row_teacher_list->COLLEGE_MARKS_OBTAINED;
	                        $REF_NO=$row_teacher_list->REF_NO;
	                        $REF_DATE=$row_teacher_list->REF_DATE;
	                    
	                        $sno=$sno+1;
						//	echo($ROLL_NO);
							$queryInsert="INSERT INTO ledger_details_teacher (SCHEME_ID,SCHEME_PART,AC_ID,SL_ID,ROLL_NO,SEMESTER,COURSE_NO,MARKS_OBTAINED,GRADE,REMARKS,MIN_MARKS,QP,UNI_MARKS_OBTAINED,COLLEGE_MARKS_OBTAINED,REF_NO,REF_DATE,TEACHER_CODE,TEACHER_ID,REMARKS_PROGRAM_NAME,COURSE_TITLE,BATCH_ID) VALUES($SCHEME_ID,$SCHEME_PART,$AC_ID,$SL_ID,'$ROLL_NO',$SEMESTER,'$COURSE_NO',$MARKS_OBTAINED,'$GRADE','$REMARKS','$MIN_MARKS','$QP','$UNI_MARKS_OBTAINED', '$COLLEGE_MARKS_OBTAINED','$REF_NO','$REF_DATE','$TEACHER_CODE','$TEACHER_ID','$prog_name','$COURSE_TITLE',$BATCH_ID)";
							//echo("$queryInsert</br>");
				
							$result=mysql_query($queryInsert);
							
							}
							
		//					mail($email,"Examination Sheet $prog_name " ,"</br> TeacherCode:  $TEACHER_CODE </br> Student: $STUDENT_CODE  From: Semester Examination Wing ");
							
	// mail($email, "Examination Sheet","$prog_name </br> TeacherCode:  $TEACHER_CODE </br> Student: $STUDENT_CODE ", "From: Semester Examination Wing " );
 
								echo("<font color='red'>$sno students register  Sucessfully..</br> TeacherCode:  $TEACHER_CODE </br> <a href='index.php'>please login </a></font> ");
				
			
	
?>

 