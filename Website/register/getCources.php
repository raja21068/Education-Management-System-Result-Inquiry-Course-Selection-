<?php
	include("../Database.php");
	$depid=mysql_real_escape_string($_GET['depId']);
	$PROG_ID=mysql_real_escape_string($_GET['progId']);
	$YEAR=mysql_real_escape_string($_GET['year']);
	$SEMESTER=$_GET['semester'];
	$SCHEME_ID=0;			
	
					
					$schemeId_query=mysql_query("SELECT SCHEME_ID FROM  scheme WHERE  PROG_ID =$PROG_ID AND  YEAR =$YEAR");
						if($row=mysql_fetch_array($schemeId_query)){
									
									$SCHEME_ID=$row['SCHEME_ID'];
					
									}
				$subject_query=mysql_query("SELECT COURSE_NO,COURSE_TITLE FROM  scheme_detail WHERE  SCHEME_ID=$SCHEME_ID AND  SEMESTER =$SEMESTER");
						while($row_subject=mysql_fetch_array($subject_query)){
						$COURSE_NO=$row_subject['COURSE_NO'];
						$COURSE_TITLE=$row_subject['COURSE_TITLE'];
						echo("<option value='$COURSE_NO'>$COURSE_TITLE</option>");
						}
						
							$subject_query1=mysql_query("SELECT COURSE_NO,COURSE_TITLE FROM  ac_scheme_detail WHERE  SCHEME_ID=$SCHEME_ID AND  SEMESTER =$SEMESTER");
						while($row_subject=mysql_fetch_array($subject_query1)){
						$COURSE_NO=$row_subject['COURSE_NO'];
						$COURSE_TITLE=$row_subject['COURSE_TITLE'];
						echo("<option value='$COURSE_NO'>$COURSE_TITLE</option>");
						}
			
						
						
						
						
						?>

                       