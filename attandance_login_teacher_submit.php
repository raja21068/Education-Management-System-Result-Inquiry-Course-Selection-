<!DOCTYPE HTML>
<html lang="en-US">
<head>
  <link rel="shortcut icon" href="favicon.ico">
<link rel="icon" type="image/gif" href="images/animated_favicon1.gif">

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>Subject Wise Result</title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<?php
include("bar.php");
?> 
<script>
	$(document).ready(function(){
		$('nav ul li a').each(function() {
			if($(this).text() == "Results"){
				$(this).attr("id","current");
			}else {
				$(this).removeAttr("id");
			}
    	});
	});
</script>
  <div class="container floated">

	<div class="sixteen floated page-title">
<h1>Add Attandance</h1>
	
		<p style='margin-bottom:10px; margin-top:10px; font-size:20px;'>Semester Examinations</p>
	</div>

	

	
            <?php
        require 'Database.php';
		
		$user	=mysql_real_escape_string($_POST["username"]);
		$pass	=mysql_real_escape_string($_POST["pass"]);
		
		$query="SELECT  MEMBER_ID, EMAIL_ADRESS ,	DATE_OF_BIRTH, REMARKS  FROM faculty_members WHERE EMAIL_ADRESS='$user'";
		//echo($query);
		$result_authantication=mysql_query($query);
		$row=mysql_fetch_object($result_authantication);
		$facMember_id=$row->MEMBER_ID;
		//echo($facMember_id);
			
		    	if(!($result_authantication=$row)){
					return;
					//echo("raja");
				}
	//echo("<body background=background.gif>");



//	echo("<FORM ACTION='course_summary.php' method='post' target=test> ");
//	echo("<div class='table-responsive'>");

	echo("<TABLE border=0 class='standard-table'> ");
	echo("<TR color='#003366'> ");
	echo("	<TD ><B>Name</B></TD> ");
	echo("	<TD COLSPAN=3> ");
	

	?>
	


		
	<?php  
      
	echo("	</TD> ");
	echo("</TR> ");
	?>
	<tr>
	<td><B>Courses</B></td>
	<td>	
		<select id="course_distribution_id" name="course_distribution_id">
		<?php		
		$emp_query=mysql_query("SELECT `COURSE_TITLE`,`COURSE_NO`,COURSE_DISTRIBUITION_ID FROM `course_distribution` WHERE `MEMBER_ID_1`=$facMember_id");
					
					
                        ?> 
						<option value="">--Select Course--</option>
						

					<?php

						
						
						while($row=mysql_fetch_array($emp_query)){

						

						$COURSE_DISTRIBUITION_ID=$row['COURSE_DISTRIBUITION_ID'];

						$COURSE_TITLE=$row['COURSE_TITLE'];
						$COURSE_NO=$row['COURSE_NO'];
						

						echo("<option value=$COURSE_DISTRIBUITION_ID>$COURSE_TITLE $COURSE_NO </option>");

						}
						?>
		</select>
	</td>	
</tr>
	<?php
	echo("<TR> ");
	echo("	<TD ><B>No Of Classes</B></TD> ");
	echo("	<TD><input type='number' name='no_of_classes' id='no_of_classes' > ");
	
	?>

	<?php

	echo("	</TD> ");
	echo("</TR> ");
	
	
	echo("<TR> ");
	echo("	<TD ><B>Date</B></TD> ");
	echo("	<TD><input type='DATE' id='date_of_attandance' name='date_of_attandance'> ");

    echo("	</TD> ");
	echo("</TR>");
	
	?>
	
	
	<?php
	echo("<TR> ");
	echo("<TD ALIGN='CENTER' COLSPAN='2'> ");
  echo("<INPUT TYPE='SUBMIT' id='display' class='submit' VALUE='Display'> ");
   echo("<img src='images/busy.gif' id='ajax-ico' style='display:none;'> ");
		echo("</td>");	
	
	echo("</TABLE> ");
		echo("<div id='course'> </div>");
		//echo("<div id='myResponse'>");
		//	echo("</div>");
									
	//echo("</form> ");
//        echo '<br/>';
echo("</div>");
echo("</div>");
		
include("footer.php");

	//echo("<img src=department_logo.gif>");

	

?>
			
		
		<script>
$("#display").click(function(){
				
				//  alert("dd");
				 $('#ajax-ico').show();
				var no_of_classes = $('#no_of_classes').val();
				var course_distribution_id = $('#course_distribution_id').val();
				var date_of_attandance = $('#date_of_attandance').val();
				//var batch = $('#batch').val();
				 //var batchStr = batch.split("~");
                  // batch=batchStr[0];     
				  //alert(date_of_attandance);
				  $.post("attandance_display_sheet.php", {
										no_of_classes: no_of_classes,
										course_distribution_id:course_distribution_id,
										date_of_attandance: date_of_attandance
                                     					   
                                        }, function(response) {
											//alert(response);
                                            $("#course").html(response);
                                            $('#ajax-ico').hide();
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