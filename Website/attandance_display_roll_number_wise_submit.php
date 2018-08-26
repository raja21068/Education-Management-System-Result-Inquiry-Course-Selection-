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



	$course_distribution_id	=mysql_real_escape_string($_REQUEST["course_distribution_id"]);
	
	
		$query="SELECT  SUM(`NO_OF_CLASSES`) as TOTAL_NO_OF_CLASSES  FROM `attandance` WHERE `COURSE_DISTRIBUTION_ID`=$course_distribution_id  GROUP BY ROLL_NO";
		$result_course_distribution=mysql_query($query);
		    	if($row_course_distribution=mysql_fetch_object($result_course_distribution)){
				
					$TOTAL_NO_OF_CLASSES=$row_course_distribution->TOTAL_NO_OF_CLASSES;
					$query1="SELECT ROLL_NO, SUM(  `ISPRESENT` )  as TOTAL_ATTANDANCE  FROM `attandance` WHERE `COURSE_DISTRIBUTION_ID`=$course_distribution_id GROUP BY ROLL_NO ";
					$result_summary_course_distribution=mysql_query($query1);
					//echo($query1);
					
						echo("<div class='col-md-12'>");
						//		echo("<div class='table-responsive'>");
								
						echo("<table class='table  table-bordered  table-striped'  ");
						
							echo("   </tr>");
							echo("      <td>S.NO</td>");
							echo("      <td>ROLL NO</td>");
							echo("      <td>Number Of Classes</td>");
							echo("      <td>Total Attand Classes</td>");
							echo("      <td>Percentage</td>");
							echo("   </tr>");
							$sno=0;
					while($row_summary=mysql_fetch_object($result_summary_course_distribution)){
							$sno=$sno+1;
							$ROLL_NO=$row_summary->ROLL_NO;
							$TOTAL_ATTANDANCE=$row_summary->TOTAL_ATTANDANCE;
							$percentage=($TOTAL_ATTANDANCE/$TOTAL_NO_OF_CLASSES)*100;
							echo("<TR>");
							echo(" <TH>$sno</TH>");
							echo("<TH>$ROLL_NO</TH>");
							echo("<TH>$TOTAL_NO_OF_CLASSES</TH>");
							echo("<TH>$TOTAL_ATTANDANCE</TH>");
							echo("<TH>$percentage</TH>");
							echo("</TR>");
						
					}
						echo("</table");
				
				}
				//echo($query);		    
							
	  		
	echo("<br>");
	
	echo("</center> ");

	echo("</body>");
?>
