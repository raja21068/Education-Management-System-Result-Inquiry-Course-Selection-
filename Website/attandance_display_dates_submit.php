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
	

	
		$query="SELECT  distinct (`DATE_OF_ATTANDANCE`) FROM `attandance` WHERE `COURSE_DISTRIBUTION_ID`=$course_distribution_id ";
		    	//echo($query);		    
				$result_course_distribution=mysql_query($query);
				
					echo("<div class='col-md-12'>");
							//		echo("<div class='table-responsive'>");
								
										echo("<table class='table  table-bordered  table-striped'  ");
										
											echo("   </tr>");
											echo("      <td>S.NO</td>");
											echo("      <td>ROLL NO</td>");

											echo("   </tr>");
												$sno=0;
												
												
			     while($row_course_distribution=mysql_fetch_object($result_course_distribution)){
				
							$DATE_OF_ATTANDANCE=$row_course_distribution->DATE_OF_ATTANDANCE;
							
	
					$sno=$sno+1;
										echo("<TR>");
										echo(" <TH>$sno</TH>");
										echo("<TH><a href=attandance_display_date_wise_submit.php?date_of_attandance=$DATE_OF_ATTANDANCE&course_distribution_id=$course_distribution_id  target='new'>$DATE_OF_ATTANDANCE</TH>");
										//echo(" <td>$ISPRESENT</td>");
										
										echo("</TR>");
				 }						
							
	  		
	echo("<br>");
	
	echo("</center> ");

	echo("</body>");
?>
