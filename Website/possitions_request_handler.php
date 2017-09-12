 <!-- Fevicon
================================================== -->
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" type="image/gif" href="images/animated_favicon1.gif">

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>Position</title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<?php
      include("Database.php");

	$dept_id	   =mysql_real_escape_string($_POST["dept_id"]);        
	$exam_year     =mysql_real_escape_string($_POST["exam_year"]);

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
//	echo("<font size=5  color='#003366'b>POSSITION ANNOUNCEMENT PROGRAMS</b></font><br>");
	//echo("<font size=4><b>EXAMINATIONS $exam_year</b></font><br><br>");
 
 $stood=0;
echo("<div class='col-md-1'></div>");

echo("<div class='col-md-10'>");
//		echo("<div class='table-responsive'>");
	
		echo("<table class='table  table-bordered table-striped' ");
				
      $query="select PROG_ID, DEPT_ID, PROGRAM_TITLE, SEM_DURATION, SEM_PER_PART, REMARKS from program where dept_id=$dept_id order by PROGRAM_TITLE";
      $result_program=mysql_query($query);
      while($row_program=mysql_fetch_object($result_program)){
       	$prog_id=$row_program->PROG_ID;     

	      $query="select BATCH_ID,PROG_ID,DEPT_ID,YEAR, SHIFT,REMARKS,GROUP_DESC FROM batch WHERE PROG_ID=$prog_id and dept_id=$dept_id AND YEAR>=2004";
	      $result_batch=mysql_query($query);
	      while($row_batch=mysql_fetch_object($result_batch)){
	       	$batch_id=$row_batch->BATCH_ID;

	            $PROGRAM_TITLE=$row_program->PROGRAM_TITLE;
	            $BATCH_YEAR=get_batch_year_encode($row_batch->YEAR);
	            $SHIFT=$row_batch->SHIFT;
	            $GROUP_DESC=$row_batch->GROUP_DESC;                        

			$program_ann="$PROGRAM_TITLE <FONT COLOR=black> BATCH ($BATCH_YEAR)</FONT>";
			if($GROUP_DESC!=null && $GROUP_DESC!="GNRL") $program_ann="$program_ann <FONT COLOR=GREEN>".get_batch_group_encode($GROUP_DESC)."</FONT>";
			if(strstr($SHIFT,"E")=="E")$program_ann="$program_ann <FONT COLOR=brown>".get_shift_encode($SHIFT)."</FONT>";

           
		      $query="select PART, BATCH_ID,REMARKS,YEAR FROM part where batch_id=$batch_id order by PART DESC";
		      $result_part=mysql_query($query);
		      if($row_part=mysql_fetch_object($result_part)){
		       	$part=$row_part->PART;


	                  $query="SELECT SL_ID FROM seat_list WHERE BATCH_ID=$batch_id AND PART=$part AND TYPE='R' AND YEAR='$exam_year'"; 
			      $result_seat_list=mysql_query($query);
			      if($row_seat_list=mysql_fetch_object($result_seat_list)){
			       	$sl_id=$row_seat_list->SL_ID;

		                  $query="SELECT SL_ID FROM ledger WHERE SL_ID=$sl_id and IS_ANNOUNCED LIKE 'Y'"; 
				      $result_ledger=mysql_query($query);
				      if($row_ledger=mysql_fetch_object($result_ledger)){
				       	$sl_id=$row_ledger->SL_ID;


				                  $stood=0;
							$num_of_pass_std=getNumOfPassStd($sl_id);
				                  $query="SELECT FORMAT(CGPA,2) AS CGPA,OBTAIN_MARKS,FORMAT(PERCENTAGE,2) AS PERCENTAGE,ROLL_NO,TOTAL_MARKS FROM ledger_detail_summary WHERE SL_ID=$sl_id AND RESULT_REMARKS='PASS' ORDER BY CGPA DESC,PERCENTAGE DESC"; 
						      $result_ledger_detail_summary=mysql_query($query);
						      while($row_ledger_detail_summary=mysql_fetch_object($result_ledger_detail_summary)){

								if($stood==0){	
										echo("<TR style='text-align:center' class='success'>");
									echo("    <th colspan=6  style='text-align:center' class='success'><h3>$program_ann</h3></th>");
									echo("</TR>");
				                         }
					 			 if($num_of_pass_std<=1){
									echo("   <tr  class='info'>");
									echo("    <th colspan='6' style='text-align:center' class='info'  >Only $num_of_pass_std Students are passed, so there will be no possition.<h2></h2></th>");
									echo("</TR>");
 								      break;
	  							 }


				                        $stood=$stood+1;
								$CGPA=$row_ledger_detail_summary->CGPA;
								$OBTAIN_MARKS=$row_ledger_detail_summary->OBTAIN_MARKS;
								$TOTAL_MARKS=$row_ledger_detail_summary->TOTAL_MARKS;
								$PERCENTAGE=$row_ledger_detail_summary->PERCENTAGE;
								$ROLL_NO=$row_ledger_detail_summary->ROLL_NO;

								$stood_str=get_stood_decode($stood);

                              
								echo("    <TR  class='info'>");
								echo("      <th colspan=6 style='text-align:center' class='success'><FONT SIZE=4><u><B>$stood_str</B></u></FONT></th>");
								echo("    </TR>");

			                              display_student_reg($batch_id,$ROLL_NO); 
			
								echo("    <TR>");
								echo("      <TD >OBTAIN MARKS: </TD>");
								echo("      <TD><B>$OBTAIN_MARKS"."/ "."$TOTAL_MARKS</B></TD>");
								echo("      <TD >C.G.P.A: </TD>");
								echo("      <TD ><B>$CGPA</B></TD>");
								echo("      <TD >PERCENTAGE: </TD>");
								echo("      <TD ><B>$PERCENTAGE%</B></TD>");
								echo("    </TR>");
					
					 			 if($num_of_pass_std==$stood+1 || $stood==3)
 								      break;
					 			 
	  							 

                  }//END SEAT LIST
                }//END LEDGER
              }//END LEDGER_DETAIL_SUMMARY
            }//END PART 
          }//END BATCH
        }//END PROG.

     if($stood>0)
	echo("</TABLE> ");


    echo("<br>");
   // echo("<img src=department_logo.gif>");
    echo("<br>Note:- The University reserves the right of issuing any correction in the result if any mistake is detected later.");
    echo("</center>");
    echo("</body>");
?>