

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
<title>Course Scheme</title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!--================================================== -->
<?php
include("bar.php");
?> 
  <!-- Begin Container -->

	  <div class="container floated">

	<div class="sixteen floated page-title">
<h1>Course Scheme</h1>
	
		<p style='margin-bottom:10px; margin-top:10px; font-size:20px;'>Semester Examinations</p>

	</div>

</div>

	
	
            <?php
        require '../Database.php';
	

	echo("<FORM ACTION=../course_scheme_request_handler.php method=post target=test> ");
	echo("<div class='table-responsive'>");
	echo("<TABLE class='standard-table'> ");
	echo("<TR > ");
	echo("	<TD ALIGN=RIGHT><B>Department</B></TD> ");
	echo("	<TD COLSPAN=3> ");
   ?>

<select  name="dept_id" id="dept_id" size='1' class='form-control ' >

							<option value="">--Select Department--</option>
						<?php
						display_departments_in_combobox();
						echo("</select>");
?>

		
	<?php  
      
	echo("	</TD> ");
	echo("</TR> ");
	?>
	<tr>
	<td ALIGN=RIGHT><B>Program</B></td>
	<td>	
		<select id="program_id" name="program_id" class='form-control' >
				<option value="">--Select Program--</option>
		</select>
	</td>	
</tr>    
     
	<?php
	echo("<TR> ");
	echo("	<TD ALIGN=RIGHT><B>Scheme Year</B></TD> ");
	
	echo("	<TD><select name=scheme_year size='1' class='form-control'> ");
display_seat_list_years_in_combobox();

	echo("	</select> ");
	echo("	</TD> ");
	echo("<TR> ");
	echo("<TD ALIGN='CENTER' COLSPAN='2'> ");
  echo("<INPUT TYPE='SUBMIT' class='submit' VALUE='View Course Scheme'> ");
		echo("</td>");
	echo("</TABLE> ");
echo("</div>");
	echo("</form> ");

include("footer.php");
	
?>

   </div>
   
   <script>			   
			$("#dept_id").change(function(){
				var val = $(this).val();
					$.ajax(
					{ url:"../getProgram.php?depId="+val}).done(function(data){
						$("#program_id").html(data);
								});
					
			});
			
		</script>
 

<?php
//include("header.php");
?>
  
</div>
<!-- End Wrapper --> 



<script type="text/javascript" src="style/js/scripts.js"></script>

</body>
</html>