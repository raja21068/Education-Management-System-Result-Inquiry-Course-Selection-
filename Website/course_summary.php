<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" type="image/gif" href="images/animated_favicon1.gif">

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>Subject Wise Result</title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<?php
     require_once("Database.php");


	$sl_id  		=mysql_real_escape_string($_REQUEST["batch"]);    
	$exam_year	=mysql_real_escape_string($_REQUEST["exam_year"]);
	$semester=mysql_real_escape_string($_REQUEST['semester']);
	$course_no =mysql_real_escape_string($_REQUEST['courseNo']);
    
	//$part=		$_REQUEST["part"];
	//$batch_id=	$_REQUEST["batch_id"];
	//$prog_name=	$_REQUEST["prog_name"];

	
		$query="select SL.TYPE,B.YEAR,B.SHIFT,B.BATCH_ID,B.GROUP_DESC,P.REMARKS from seat_list SL,part P, batch B WHERE SL_ID=$sl_id AND P.PART=SL.PART AND B.BATCH_ID=SL.BATCH_ID AND P.BATCH_ID=B.BATCH_ID";
		//	    	echo($query);		    
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
	                        $batch_id=$row_seat_list->BATCH_ID;
	                        $GROUP_DESC=$row_seat_list->GROUP_DESC;                        
      	                  $PART_REMARKS=$row_seat_list->REMARKS;
							
	                        	//	echo("$TYPE </br>");
									
					//$program_ann=("$PART_REMARKS ".encode_exam_type($TYPE)." BATCH ($BATCH_YEAR)");
					$program_ann=$PART_REMARKS."<FONT COLOR=red>".encode_exam_type($TYPE)."</FONT> <FONT COLOR=black> BATCH ($BATCH_YEAR)</FONT>";


				if(strstr($SHIFT,"E")=="E" &&  strstr($PART_REMARKS,"EVENING")==null)$program_ann="$program_ann <FONT COLOR=brown>".get_shift_encode($SHIFT)."</FONT>";
					if($GROUP_DESC!=null && $GROUP_DESC!="GNRL") $program_ann="$program_ann <FONT COLOR=GREEN>".get_batch_group_encode($GROUP_DESC)."</FONT>";

					$prog_name=""."$program_ann";
	//				echo("</br>".$announced_programs);
					}

	
	
//	echo("<body background=background.gif>");
	echo("<center> ");
	//echo("<img src=header_left.gif><br>");

//	echo("<font size=7 color='#006666'><b>Subject Wise Sheet</b></font><br> ");
//	echo("<font size=6><b>Semester Examinations</b></font><br>");
//	echo("<font size=5><b>University of Sindh, Jamshoro</b></font><br><br>");
	echo("<font size=5><b>$prog_name</b></font><br><br>");
		$course_query="SELECT COURSE_TITLE FROM  scheme_detail where COURSE_NO='$course_no'";
		$result_course_name=mysql_query($course_query);
	    $COURSE_TITLE="";
		if($row_course_name=mysql_fetch_object($result_course_name)){
			           $COURSE_TITLE=$row_course_name->COURSE_TITLE;
					 
		}
	
      $scheme_id=get_scheme_id($sl_id);
	  $query="SELECT ROLL_NO, MARKS_OBTAINED, GRADE, COURSE_NO,MIN_MARKS,REMARKS FROM ledger_details WHERE SCHEME_ID =$scheme_id AND ledger_details.SEMESTER = $semester AND ledger_details.COURSE_NO = '$course_no'  AND SL_ID=$sl_id";
	$result_teacher_list=mysql_query($query);
				// echo($query);
				 if($result_teacher_list==null){
				 return;
				 }
//echo("<div class='col-md-1'></div>");

echo("<div class='col-md-12'>");
//		echo("<div class='table-responsive'>");
	
		echo("<table class='table  table-bordered  table-striped' ");
				echo("<TR style='text-align:center' class='success'>");
				echo("    <th colspan='8'  style='text-align:center' class='success'><h2>$COURSE_TITLE</h2></TH>");
				echo("</TR>");
				
				echo("   <tr class='info'>");
				echo("      <td>S.NO</td>");
				echo("      <td>ROLL NO</td>");
				echo("      <td>NAME</td>");
				echo("      <td>FNAME</td>");
				echo("      <td>SURNAME</td>");
				echo("      <td>MARKS</td>");
				echo("      <td>GRADE</td>");
				echo("      <td>PASS/ FAIL</td>");
				echo("   </tr>");
					$sno=0;
			      while($row_teacher_list=mysql_fetch_object($result_teacher_list)){

					
	                        $ROLL_NO=$row_teacher_list->ROLL_NO;
	                        $MARKS_OBTAINED=$row_teacher_list->MARKS_OBTAINED;
	                        $GRADE=$row_teacher_list->GRADE;
							$MIN_MARKS=$row_teacher_list->MIN_MARKS;
							$REMARKS=$row_teacher_list->REMARKS;
							
							
							
							
							$query="select BATCH_ID,ROLL_NO,NAME,FNAME,SURNAME,GENDER from  student_registration where BATCH_ID=$batch_id and ROLL_NO='$ROLL_NO'";
							$result=mysql_query($query);
							if($row=mysql_fetch_object($result)){
							if($MARKS_OBTAINED!=0){
							$sno=$sno+1;
							echo("<TR>");
							echo(" <TH>$sno</TH>");
							echo("<TH>$ROLL_NO</TH>");
							echo("	<TH>$row->NAME</TH> ");
							echo("	<TH>$row->FNAME</TH>  ");
							echo("	<TH>$row->SURNAME</TH> ");
							echo("<TH>$MARKS_OBTAINED</TH>");
							echo("<TH>$GRADE</TH>");
							echo("<TH>$REMARKS</TH>");
			
							echo("</TR>");
							}
						}
		}
			echo("</TABLE>");
			echo("</div>");
	  		echo("</div>");
	//  		echo("</div>");
	  		
	  		
	echo("<br>");
	echo("</center> ");

	echo("</body>");
?>




 