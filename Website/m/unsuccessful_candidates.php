<!DOCTYPE HTML>
<html lang="en-US">
<head>
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
  <?php
include("bar.php");
?> 
  <!-- Begin Container -->
  <div class="container floated">

	<div class="sixteen floated page-title">
<h1>List of Unsccessful Candidates</h1>
	
		<p style='margin-bottom:10px; margin-top:10px; font-size:20px;'>Semester Examinations</p>

	</div>

</div>
  
            <?php
        require '../Database.php';

	echo("<FORM ACTION=../unsuccessful_candidates_request_handler.php method=post target=test> ");
	echo("<div class='table-responsive'>");
	echo("<TABLE class='standard-table'> ");
	echo("<TR> ");
	echo("	<TD ALIGN=RIGHT><B>Department</B></TD> ");
	echo("	<TD> ");
	echo("		<select name=dept_id size=1> ");
        
      display_departments_in_combobox();

	echo("		</select> ");
	echo("	</TD> ");
	echo("</TR> ");
	echo("<TR> ");
	echo("	<TD ALIGN=RIGHT><B>Exam. Year</B></TD> ");
	echo("	<TD><select  name=exam_year size=1> ");
		display_seat_list_years_in_combobox();
	echo("	</select> ");
	echo("	</TD> ");
	echo("<TR> ");
	echo("<TD ALIGN='CENTER' COLSPAN='2'> ");
  echo("<INPUT TYPE='SUBMIT' class='submit' VALUE='Successful Candidates'> ");
		echo("</td>");	
	
	echo("</TABLE> ");
		echo("</div>");

	echo("</form> ");


?>
<?php

include("footer.php");

//include("header.php");
?>
  
</div>
<!-- End Wrapper --> 



<script type="text/javascript" src="style/js/scripts.js"></script>

</body>
</html>