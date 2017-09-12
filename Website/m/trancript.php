<!DOCTYPE HTML>
<html lang="en-US">
<head>
<meta charset="UTF-8">
    <!-- Basic Page Needs
  ================================================== -->
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" type="image/gif" href="images/animated_favicon1.gif">

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>Trancript</title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
 <!-- ================================================== -->
<?php
include("bar.php");
?> 

<div class="container floated">

	<div class="sixteen floated page-title">

	<h1>Academic Transcript / Marksheet</h1>
	
		<p style='margin-bottom:10px; margin-top:10px; font-size:20px;'>Semester Examinations</p>

	</div>

</div>

  <!-- Begin Container -->
  <div id="container" class="opacity">
    
            <?php
      require_once("../Database.php");

	

	
	echo("<FORM ACTION=../transcript_handler.php method=post target=test> ");
	?>
	
	<?php
	echo("<TABLE class='standard-table'> ");


	echo("<TR> ");
	echo("	<TD ALIGN=RIGHT><B>Roll No.</B></TD> ");
	echo("	<TD><input type=text name=roll_no  class='form-control' size=10><FONT COLOR=RED SIZE=2> for example <U>2K10/CSE/60</U></TD>  ");
	echo("</TR>");
		echo(" <TR>");
		echo("	<TD ALIGN=RIGHT><B>Part</B></TD> ");
	
		echo(" <TD>");
	echo("		<select  class='form-control' name=part size=1> ");
	echo("		 <option value=1>I</option> ");
	echo("		 <option value=2>II</option> ");
	echo("		 <option value=3>III</option> ");
	echo("		 <option value=4>IV</option> ");
	echo("		</select> ");
	echo("	</TD> ");
	echo("</TR> ");
	echo("<TR> ");
	echo("	<TD ALIGN=RIGHT><B>Exam. Year</B></TD> ");
	echo("	<TD><select name=exam_year size=1> ");
	display_seat_list_years_in_combobox();

  	echo("	</select> ");
		echo("</TD> ");

		echo("</TR> ");
		echo("<TR> ");
	echo("<TD ALIGN='CENTER' COLSPAN='2'> ");

      echo("<INPUT TYPE='SUBMIT' class='submit' VALUE='View Marksheet'> ");
     	echo("</TD> ");

	echo("</TR> ");



	
	echo("</TABLE> ");

	echo("</form> ");
        echo '<br/>';
      //echo("<img src=department_logo.gif>");


?>

  
  <?php
 // include("facebook.php");
  include("footer.php");
  ?>
</div>
<!-- End Wrapper --> 



<script type="text/javascript" src="style/js/scripts.js"></script>

</body>
</html>