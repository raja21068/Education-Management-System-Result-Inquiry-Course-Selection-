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
	$date_of_attandance=mysql_real_escape_string($_REQUEST['date_of_attandance']);
	

	
		$query="SELECT * FROM `attandance` WHERE `COURSE_DISTRIBUTION_ID`=$course_distribution_id AND DATE_OF_ATTANDANCE= '$date_of_attandance' AND ISPRESENT=1 ";
		    	//echo($query);		    
				$result_course_distribution=mysql_query($query);
				
					echo("<div class='col-md-12'>");
							//		echo("<div class='table-responsive'>");
								
										echo("<table class='table  table-bordered  table-striped'  ");
										
											echo("   </tr>");
											echo("      <td>S.NO</td>");
											echo("      <td>ROLL NO</td>");
											//echo("      <td>ISPRESENT</td>");
											//echo("      <td><Input Type='radio' name='checkAll' id='checkAll' value='P'  >P <Input Type='radio' name='checkAll' id='checkAll' value='A' >A</td>");
				
											echo("   </tr>");
												$sno=0;
												
												
			     while($row_course_distribution=mysql_fetch_object($result_course_distribution)){
				
							$ROLL_NO=$row_course_distribution->ROLL_NO;
							$ISPRESENT=$row_course_distribution->ISPRESENT;
							$NO_OF_CLASSES=$row_course_distribution->NO_OF_CLASSES;
	
					$sno=$sno+1;
										echo("<TR>");
										echo(" <TH>$sno</TH>");
										echo("<TH>$ROLL_NO</TH>");
										//echo(" <td>$ISPRESENT</td>");
										
										echo("</TR>");
				 }						
							
	  		
	echo("<br>");
	
	echo("</center> ");

	echo("</body>");
?>
