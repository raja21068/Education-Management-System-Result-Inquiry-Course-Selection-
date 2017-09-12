<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" type="image/gif" href="images/animated_favicon1.gif">

<!-- Basic Page Needs
================================================== -->
    <!-- Basic Page Needs
  ================================================== -->
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" type="image/gif" href="images/animated_favicon1.gif">

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>Sucessful Candidates</title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<?php
      include("Database.php");

	$dept_id		=mysql_real_escape_string($_POST["dept_id"]);        
	$exam_year	=mysql_real_escape_string($_POST["exam_year"]);
	
	if($dept_id==""){
	
	header("Location: error.html");
	return;
	}
	if($exam_year==""){
	
	header("Location: error.html");
	return;
	}
	
	echo("<body>");


      echo("<center>");

	//echo("<img src=header_left.gif><br>");

      $DEPT_NAME=get_department_name($dept_id);

	//if($DEPT_NAME!=null)echo("<font size=6 color='#006666'><b>$DEPT_NAME</b></font><br>");
//	echo("<font size=6  color='#003366'><b>List of  Unsuccessful Candidates</b></font><br>");
//	echo("<font size=4><b>EXAMINATIONS $exam_year</b></font><br><br>");
 
$sno=0;
//echo("<div class='col-md-1'></div>");

echo("<div class='col-md-12'>");
	
		echo("<table class='table  table-bordered  table-striped' ");

      $query="select PROG_ID, DEPT_ID, PROGRAM_TITLE, SEM_DURATION, SEM_PER_PART, REMARKS from program where dept_id=$dept_id order by PROGRAM_TITLE";
      $result_program=mysql_query($query);
      while($row_program=mysql_fetch_object($result_program)){
       	$prog_id=$row_program->PROG_ID;     

//	      $query="select BATCH_ID,PROG_ID,DEPT_ID,YEAR, SHIFT,REMARKS,GROUP_DESC FROM batch WHERE PROG_ID=$prog_id and dept_id=$dept_id and IS_POSSITION_ANN LIKE 'Y' AND YEAR>=2004";
	      $query="select BATCH_ID,PROG_ID,DEPT_ID,YEAR, SHIFT,REMARKS,GROUP_DESC FROM batch WHERE PROG_ID=$prog_id and dept_id=$dept_id AND YEAR>=2004";
	      $result_batch=mysql_query($query);
	      while($row_batch=mysql_fetch_object($result_batch)){
	       	$batch_id=$row_batch->BATCH_ID;

	            $PROGRAM_TITLE=$row_program->PROGRAM_TITLE;
	            $BATCH_YEAR=get_batch_year_encode($row_batch->YEAR);
	            $SHIFT=$row_batch->SHIFT;
	            $GROUP_DESC=$row_batch->GROUP_DESC;                        

           
		      $query="select PART, BATCH_ID,REMARKS,YEAR FROM part where batch_id=$batch_id order by PART DESC";
		      $result_part=mysql_query($query);
		      if($row_part=mysql_fetch_object($result_part)){
		       	$part=$row_part->PART;
                        $PART_REMARKS=$row_part->REMARKS;


	                  $query="SELECT SL_ID,TYPE,YEAR FROM seat_list WHERE BATCH_ID=$batch_id AND PART=$part AND YEAR='$exam_year'"; 
			      $result_seat_list=mysql_query($query);
			      if($row_seat_list=mysql_fetch_object($result_seat_list)){
			       	$sl_id=$row_seat_list->SL_ID;
	                        $TYPE=$row_seat_list->TYPE;
	                        $EXAM_YEAR=$row_seat_list->YEAR;


		                  $query="SELECT SL_ID FROM ledger WHERE SL_ID=$sl_id and IS_ANNOUNCED LIKE 'Y'"; 
				      $result_ledger=mysql_query($query);
				      if($row_ledger=mysql_fetch_object($result_ledger)){
				       	$sl_id=$row_ledger->SL_ID;


				                  $sno=0;
				                  $query="SELECT FORMAT(CGPA,2) AS CGPA,OBTAIN_MARKS,FORMAT(PERCENTAGE,2) AS PERCENTAGE,ROLL_NO,TOTAL_MARKS FROM ledger_detail_summary WHERE SL_ID=$sl_id AND RESULT_REMARKS='FAIL' ORDER BY CGPA DESC,PERCENTAGE DESC"; 
						      $result_ledger_detail_summary=mysql_query($query);
						      while($row_ledger_detail_summary=mysql_fetch_object($result_ledger_detail_summary)){

								if($sno==0){	
									$program_ann="$PART_REMARKS <FONT COLOR='FFFFEF'>".encode_exam_type($TYPE)."</FONT> <FONT COLOR='#999966'> BATCH ($BATCH_YEAR)</FONT>";
									if($GROUP_DESC!=null && $GROUP_DESC!="GNRL") $program_ann="$program_ann <FONT COLOR='#AFAF61'>".get_batch_group_encode($GROUP_DESC)."</FONT>";
									if(strstr($SHIFT,"E")=="E")$program_ann="$program_ann <FONT COLOR='999999'>".get_shift_encode($SHIFT)."</FONT>";

									echo("<TR>");
									echo("    <TH colspan='9'  style='text-align:center' class='success'><h3>$program_ann</h3></TH>");
									echo("</TR>");
	                                                echo("<TR class='info'>");
									echo("  	<TH>S.NO.</TH>");
									echo("  	<TH>ROLL NO.</TH>");
									echo("  	<TH>NAME</TH>");
									echo("  	<TH>FATHER'S NAME</TH>");
									echo("  	<TH>SURNAME</TH>");
									echo("  	<TH>C.G.P.A</TH>");
									echo("  	<TH>PERCENTAGE</TH>");
									echo("  	<TH>OBTAIN MARKS</TH>");
									echo("  	<TH>TOTAL MARKS</TH>");
                                                	echo("</TR>");
				                         }

				                        $sno=$sno+1;
								$CGPA=$row_ledger_detail_summary->CGPA;
								$ROLL_NO=$row_ledger_detail_summary->ROLL_NO;
								$OBTAIN_MARKS=$row_ledger_detail_summary->OBTAIN_MARKS;
								$TOTAL_MARKS=$row_ledger_detail_summary->TOTAL_MARKS;
								$PERCENTAGE=$row_ledger_detail_summary->PERCENTAGE;


                                                echo("  <TR>");
								echo("  	<TD>$sno</TD>");
								echo("  	<TD>$ROLL_NO</TD>");
                                              
                                                display_student_reg_successful($batch_id,$ROLL_NO);

								echo("  	<TD>$CGPA</TD>");
								echo("  	<TD>$PERCENTAGE</TD>");
								echo("      <TD><B>$OBTAIN_MARKS</B></TD>");
								echo("      <TD><B>$TOTAL_MARKS</B></TD>");
                               
                                                echo("  </TR>");
			
					 			 
	  							 

                  }//END SEAT LIST
                }//END LEDGER
              }//END LEDGER_DETAIL_SUMMARY
            }//END PART 
          }//END BATCH
        }//END PROG.

     if($sno>0){
	echo("</TABLE> ");
		echo("</div> ");
			echo("</div> ");
			
     }else{
	echo("<b>No any student take degree in $exam_year Examinations in $DEPT_NAME</b>");
}

        echo("<br>");
  //  echo("<img src=department_logo.gif>");
    echo("</center>");

echo("</body>");

?>