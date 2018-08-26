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
		
		$query="SELECT  EMAIL_ADRESS ,	DATE_OF_BIRTH, REMARKS  FROM faculty_members WHERE EMAIL_ADRESS='$user' AND DATE_OF_BIRTH='$pass'";
		//echo($query);
		$result_authantication=mysql_query($query);
			
		    	if(!($row_authantication=mysql_fetch_object($result_authantication))){
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
	
<select  name="facMember_id" id="facMember_id" size='1'  >

							<option value="">--Select Name--</option>
						<?php
						$query="SELECT 	MEMBER_ID,DEPT_ID,FIRST_NAME,LAST_NAME FROM faculty_members  order by FIRST_NAME";
						$result=mysql_query($query)or die(header("Location: error.html"));
						while($row=mysql_fetch_object($result))
						echo("<option value=$row->MEMBER_ID>".$row->FIRST_NAME." ".$row->LAST_NAME."</option> ");     

						echo("</select>");
?>

		
	<?php  
      
	echo("	</TD> ");
	echo("</TR> ");
	?>
	<tr>
	<td><B>Courses</B></td>
	<td>	
		<select id="course_distribution_id" name="course_distribution_id">
				<option value="">--Select Course--</option>
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
			
			$("#course_distribution_id").change(function(){
					//changeValue();
					//changeBatchValue();
			});
			
			
			
			$("#facMember_id").change(function(){
				
				var val = $(this).val();
				//alert(val);
					$.ajax(
					{ url:"getCourseDistribution.php?facMember_id="+val}).done(function(data){
						//alert(data);
						$("#course_distribution_id").html(data);
						//changeValue();
						//changeBatchValue();
					});
					
			});
			
			
			function changeValue(){
				var course_distribution_id= $('#course_distribution_id').val();
				
			//	alert(""+departmentId+"-"+programId+"-"+yearId+"-"+semester);
				if( departmentId!="" &&  programId!="" && semester!="" && yearId!=""){
					$.ajax(
					{ url:"getCources.php?depId="+departmentId+"&progId="+programId+"&semester="+semester+"&year="+yearId}).done(function(data){
						$("#courseNo").html(data);
				//		alert(data);
						//changeBatchValue();
					});
				}
			}
			
				function changeBatchValue(){
				var departmentId = $('#dept_id').val();
				var programId = $('#program_id').val();
				var yearId = $('#no_of_classes').val();
				var semester = $('#semesterCombo').val();
				//var courseNo = $('#courseNo').val();
				//alert(""+departmentId+"-"+programId+"-"+yearId+"-"+semester+"-"+courseNo);
				if( departmentId!="" &&  programId!="" && semester!="" && yearId!="" && courseNo!=""){
					$.ajax(
					{ url:"getBatch.php?dept_id="+departmentId+"&program_id="+programId+"&semester="+semester+"&exam_year="+yearId}).done(function(data){
						
						$("#batch").html(data);
						
					});
				}
			}
	
		</script>
		
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