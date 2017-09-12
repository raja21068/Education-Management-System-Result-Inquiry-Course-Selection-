<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<?php
      include("../Database.php");
	$STUDENT_CODE=strtoupper($_REQUEST['STUDENT_CODE']);
	
	$query="SELECT BATCH_ID,ROLL_NO, MARKS_OBTAINED, GRADE, COURSE_NO,MIN_MARKS,REMARKS,COURSE_TITLE,REMARKS_PROGRAM_NAME FROM ledger_details_teacher WHERE STUDENT_CODE='$STUDENT_CODE'";
			$result_teacher_list=mysql_query($query);
		$rows=mysql_num_rows($result_teacher_list);
			if($rows<1){
			echo("false");
			return;
			}
	echo("<body background=../background.gif>");
	echo("<center> ");
	echo("<img src=../header_left.gif><br>");

	echo("<font size=7 color='#006666'><b>Subject Wise Sheet</b></font><br> ");
	echo("<font size=6><b>Semester Examinations</b></font><br>");
//	echo("<font size=5><b>University of Sindh, Jamshoro</b></font><br><br>");
		
		  
			
			 if($rows>0){
                      for($a=0; $a<$rows; $a++){
                        $COURSE_TITLE =mysql_result($result_teacher_list,$a,"COURSE_TITLE");
						$REMARKS_PROGRAM_NAME =mysql_result($result_teacher_list,$a,"REMARKS_PROGRAM_NAME");
						$MARKS_OBTAINED =mysql_result($result_teacher_list,$a,"MARKS_OBTAINED");
						$GRADE =mysql_result($result_teacher_list,$a,"GRADE");
						$MIN_MARKS =mysql_result($result_teacher_list,$a,"MIN_MARKS");
						$REMARKS =mysql_result($result_teacher_list,$a,"REMARKS");
						//$SL_ID =mysql_result($result_teacher_list,$a,"SL_ID");
						$BATCH_ID =mysql_result($result_teacher_list,$a,"BATCH_ID");
						$ROLL_NO =mysql_result($result_teacher_list,$a,"ROLL_NO");
					
						if($MIN_MARKS==0){
								return;
						}
						if($a==0){
						echo("<font size=5><b></b>$REMARKS_PROGRAM_NAME</font><br><br>");
				echo("<div class='col-md-1'></div>");

echo("<div class='col-md-10'>");
		echo("<div class='table-responsive'>");
	
		echo("<table class='table  table-bordered' ");
					//echo(" <table border=1 bordercolor=black>");
						echo("<TR>");
						echo("    <TH colspan=8  class='danger' style='text-align:center'><h2>$COURSE_TITLE</h2></TH>");
						echo("</TR>");
				
						echo("</TR>");
						
						echo("<tr class='info' style='text-align:center'>");
						echo(" <th class='info' style='text-align:center'>S.NO</th>");
						echo("<th class='info' style='text-align:center'>ROLL NO</th>");
						echo("<th class='info' style='text-align:center'>NAME</th>");
						echo("<th class='info' style='text-align:center'>FNAME</th>");
						echo("<th class='info' style='text-align:center'>SURNAME</th>");
						echo("<th class='info' style='text-align:center'>MARKS</th>");
						echo("<th class='info' style='text-align:center'>GRADE</th>");
						echo("<th class='info' style='text-align:center'>PASS/ FAIL</th>");
						echo("   </tr>");
				
		
						}
						
						$query="select BATCH_ID,ROLL_NO,NAME,FNAME,SURNAME,GENDER from  student_registration where ROLL_NO='$ROLL_NO' AND BATCH_ID='$BATCH_ID'";
							$result=mysql_query($query);
							if($row=mysql_fetch_object($result)){
					
							
							echo("<TR bgcolor='FFFFEF'>");
							echo(" <TD align=center>".($a+1)."</TD>");
							echo("<TD>$ROLL_NO</TD>");
							echo("	<TD>$row->NAME</TD> ");
							echo("	<TD>$row->FNAME</TD>  ");
							echo("	<TD>$row->SURNAME</TD> ");
							echo("<TD>$MARKS_OBTAINED</TD>");
							echo("<TD>$GRADE</TD>");
							echo("<td>$REMARKS</td>");
						
			
							echo("</TR>");
						}
						
		
                     
					}	

					
					}			
					

?>




 </table>
 </div>
 </div>