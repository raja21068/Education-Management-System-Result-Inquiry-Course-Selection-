<?php
      include("../Database.php");
	  require('fpdf/fpdf.php');
		class PDF extends FPDF
		{
		}
	
	$STUDENT_CODE=strtoupper($_REQUEST['STUDENT_CODE']);
	
	echo("<body background='background.gif' onload='window.print()'>");
	echo("<center> ");
	echo("<img src=header_left.gif><br>");

	//echo("<font size=7 color='#006666'><b>Subject Wise Sheet</b></font><br> ");
	echo("<font size=6><b>Semester Examinations</b></font><br>");
	echo("<font size=5><b>University of Sindh, Jamshoro</b></font><br><br>");
		
		
		
			  $query="SELECT BATCH_ID,ROLL_NO, MARKS_OBTAINED, GRADE, COURSE_NO,MIN_MARKS,REMARKS,COURSE_TITLE,REMARKS_PROGRAM_NAME FROM ledger_details_teacher WHERE STUDENT_CODE='$STUDENT_CODE'";
			$result_teacher_list=mysql_query($query);
		$rows=mysql_num_rows($result_teacher_list);
			if($rows<1){
			echo("WRONG codes");
			return;
			}
			
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
						
							
						if($a==0){
						echo("<font size=5><b></b>$REMARKS_PROGRAM_NAME</font><br><br>");
			 
						echo(" <table border=1>");
						echo("<TR style='color: white; background-color: #666666'>");
						echo("    <TH colspan=8  ALIGN=CENTER><h2>$COURSE_TITLE</h2></TH>");
						echo("</TR>");
				
						echo("</TR>");
						
						echo("<tr style='color: white; background-color: #666666'>");
						echo(" <th>S.NO</th>");
						echo("<th size='10'>ROLL NO   </th>");
						echo("<th>NAME</th>");
						echo("<th>FNAME</th>");
						echo("<th>SURNAME</th>");
						echo("<th>MARKS</th>");
						
						echo("   </tr>");
				
		
						} //end if 
						
						$query="select BATCH_ID,ROLL_NO,NAME,FNAME,SURNAME,GENDER from  student_registration where ROLL_NO='$ROLL_NO' AND BATCH_ID='$BATCH_ID'";
							$result=mysql_query($query);
							if($row=mysql_fetch_object($result)){
					
							
							echo("<TR bgcolor='FFFFEF'>");
							echo(" <TD align=center>".($a+1)."</TD>");
							echo("<TD size='20'>$ROLL_NO</TD>");
							echo("	<TD>$row->NAME</TD> ");
							echo("	<TD>$row->FNAME</TD>  ");
							echo("	<TD>$row->SURNAME</TD> ");
							echo("<TD>$MARKS_OBTAINED</TD>");
						
			

					echo("</TR>");
						} //end if student
					
				
		
                     
					}	

					}			
				
					
?>




 