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


	
	$no_of_classes  		=mysql_real_escape_string($_REQUEST["no_of_classes"]);    
	$course_distribution_id	=mysql_real_escape_string($_REQUEST["course_distribution_id"]);
	$date_of_attandance=mysql_real_escape_string($_REQUEST['date_of_attandance']);
	
	
	
		$query="SELECT * FROM `course_distribution` WHERE `COURSE_DISTRIBUITION_ID`=$course_distribution_id";
		//	    	echo($query);		    
				$result_course_distribution=mysql_query($query);
			     if($row_course_distribution=mysql_fetch_object($result_course_distribution)){
				
							$SCHEME_ID=$row_course_distribution->SCHEME_ID;
							$COURSE_NO=$row_course_distribution->COURSE_NO;
							$COURSE_TITLE=$row_course_distribution->COURSE_TITLE;
							$SEMESTER=$row_course_distribution->SEMESTER;
							$SCHEME_PART=$row_course_distribution->SCHEME_PART;
							$CR_HRS=$row_course_distribution->CR_HRS;
							$DEPT_ID=$row_course_distribution->DEPT_ID;
							$PROG_ID=$row_course_distribution->PROG_ID;
							$YEAR=$row_course_distribution->YEAR;
							$MEMBER_ID_1=$row_course_distribution->MEMBER_ID_1;
							$SHIFT=$row_course_distribution->SHIFT;
							$GROUP_DESC=$row_course_distribution->GROUP_DESC;
							$REMARKS=$row_course_distribution->REMARKS;
							
							$batchYear=$YEAR-($SCHEME_PART-1);
						$querybatch="SELECT b.`BATCH_ID`,p.`PROGRAM_TITLE`,b.`GROUP_DESC`,b.`SHIFT`,b.`YEAR` FROM batch AS b
									INNER JOIN program AS p ON p.`PROG_ID`=b.`PROG_ID`
									WHERE b.`PROG_ID`='$PROG_ID'
									AND b.`YEAR`='$batchYear'
									
									AND b.`SHIFT`='$SHIFT'";
								//AND b.`GROUP_DESC`='$GROUP_DESC'
								echo($querybatch."</br>");		
								$result_batch=mysql_query($querybatch);
								$row_batch=mysql_fetch_object($result_batch);
								
								$BATCH_ID=$row_batch->BATCH_ID;	
								$queryStudentRegistration="select BATCH_ID,ROLL_NO,NAME,FNAME,SURNAME,GENDER from  student_registration where BATCH_ID=$BATCH_ID ";
								echo($queryStudentRegistration);
															//	echo("<body background=background.gif>");
								echo("<center> ");
								//echo("<img src=header_left.gif><br>");


							echo("<div class='col-md-12'>");
							//		echo("<div class='table-responsive'>");
								
									echo("<table class='table  table-bordered  table-striped' ");
											echo("<TR style='text-align:center' class='success'>");
											echo("    <th colspan='8'  style='text-align:center' class='success'><h2>$COURSE_TITLE</h2></TH>");
											echo("</TR>");
											
											echo("   <tr class='info'>");
											echo("      <td>S.NO</td>");
											echo("      <td>ROLL NO</td>");
											echo("      <td><Input Type='checkbox' name='present' ></td>");
			
											echo("   </tr>");
												$sno=0;

								$result_studentRegistration=mysql_query($queryStudentRegistration);
								while($row_studentRegistration=mysql_fetch_object($result_studentRegistration)){
										
										  $ROLL_NO=$row_studentRegistration->ROLL_NO;
										  
							
							
							
							
										$sno=$sno+1;
										echo("<TR>");
										echo(" <TH>$sno</TH>");
										echo("<TH>$ROLL_NO</TH>");
										echo("      <td><Input Type='checkbox' name='present' ></td>");
										
										echo("</TR>");
										
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




 