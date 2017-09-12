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
<h1>Subject Wise Result</h1>
	
		<p style='margin-bottom:10px; margin-top:10px; font-size:20px;'>Semester Examinations</p>
	</div>

	

	
            <?php
        require 'Database.php';
	//echo("<body background=background.gif>");



//	echo("<FORM ACTION='course_summary.php' method='post' target=test> ");
//	echo("<div class='table-responsive'>");

	echo("<TABLE border=0 class='standard-table'> ");
	echo("<TR color='#003366'> ");
	echo("	<TD ><B>Department</B></TD> ");
	echo("	<TD COLSPAN=3> ");
	

	?>
	
<select  name="dept_id" id="dept_id" size='1'  >

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
	<td><B>Program</B></td>
	<td>	
		<select id="program_id" name="program_id">
				<option value="">--Select Program--</option>
		</select>
	</td>	
</tr>
	<?php
	echo("<TR> ");
	echo("	<TD ><B>Exam. Year</B></TD> ");
	echo("	<TD><select name='exam_year' id='exam_year' size=1> ");
	
	?>
	<option value="">--Select Year--</option>
	<?php
      display_seat_list_years_in_combobox();

	echo("	</select> ");
	echo("	</TD> ");
	echo("</TR> ");
	
	
	echo("<TR> ");
	echo("	<TD ><B>Semeister</B></TD> ");
	echo("	<TD><select id='semesterCombo' name=semester size=1> ");

    echo("<option value=''>--Select Semester</option>");
    echo("<option value='1'>1</option>");
	echo("<option value='2'>2</option>");
	echo("<option value='3'>3</option>");
	echo("<option value='4'>4</option>");
	echo("<option value='5'>5</option>");
	echo("<option value='6'>6</option>");
	echo("<option value='7'>7</option>");
	echo("<option value='8'>8</option>");
	echo("<option value='9'>9</option>");
	echo("<option value='10'>10</option>");


	

	echo("	</select> ");
	echo("	</TD> ");
	echo("</TR>");
	
	?>
	
	<tr>
	<td><B>Batch:</B></td>
	<td>	
			<select id="batch" name="batch">
				<option value="">--Select Course--</option>
			</select>
			</td>	
</tr>
<tr>
	<td><B>Course:</B></td>
	<td>	
			<select id="courseNo" name="courseNo">
				<option value="">--Select Course--</option>
			</select>

	</td>	
</tr>

	
	<?php
	echo("<TR> ");
	echo("<TD ALIGN='CENTER' COLSPAN='2'> ");
  echo("<INPUT TYPE='SUBMIT' id='display' class='submit' VALUE='Display'> ");
   echo("<img src='images/busy.gif' id='ajax-ico' style='display:none;'> ");
		echo("</td>");	
	
	echo("</TABLE> ");
		echo("<div id='course'> </div>");
	//echo("</form> ");
//        echo '<br/>';
echo("</div>");
echo("</div>");
		
include("footer.php");

	//echo("<img src=department_logo.gif>");

	

?>
					   
		<script>			   
			$("#semesterCombo").change(function(){
					//changeValue();
					changeBatchValue();
			});
			$("#program_id").change(function(){
					//changeValue();
					changeBatchValue();
			});
			$("#exam_year").change(function(){
					//changeValue();
					changeBatchValue();
			});
				$("#batch").change(function(){
					changeValue();
					
			});
			
			$("#dept_id").change(function(){
				var val = $(this).val();
					$.ajax(
					{ url:"getProgram.php?depId="+val}).done(function(data){
						$("#program_id").html(data);
						//changeValue();
						changeBatchValue();
					});
					
			});
			
			
			function changeValue(){
				var departmentId = $('#dept_id').val();
				var programId = $('#program_id').val();
				//var yearId = $('#exam_year').val();
				var semester = $('#semesterCombo').val();
				var batch = $('#batch').val();
				 var batchStr = batch.split("~");
                  var yearId=batchStr[1];
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
				var yearId = $('#exam_year').val();
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
				var exam_year = $('#exam_year').val();
				var semester = $('#semesterCombo').val();
				var courseNo = $('#courseNo').val();
				var batch = $('#batch').val();
				 var batchStr = batch.split("~");
                   batch=batchStr[0];     
				  $.post("course_summary.php", {
										batch: batch,
										courseNo:courseNo,
										semester: semester,
                                       exam_year: exam_year					   
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