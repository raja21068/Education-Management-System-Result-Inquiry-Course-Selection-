<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>UOS Examination</title>
	<meta name="description" content="University Of Sindh annoucements of results">

    <!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta charset="UTF-8">

<script>
	$(document).ready(function(){
		$('nav ul li a').each(function() {
			if($(this).text() == "Teachers Result "){
				$(this).attr("id","current");
			}else {
				$(this).removeAttr("id");
			}
    	});
	});
</script> 
  <!-- Begin Container -->
 	
	  <!-- Begin Container -->
  <div class="container floated">

	<div class="sixteen floated page-title">

	<h1>Student Sheet Registration</h1>
	
		<p style='margin-bottom:10px; margin-top:10px; font-size:20px;'>Semester Examinations</p>
		<font size=5 color='#003366'><b>University of Sindh, Jamshoro</b></font><br>
	</div>

</div>

            <?php


	echo("<FORM ACTION='student_registration_add.php' method='post' id='registrationForm'> ");
		echo("<div class='table-responsive'>");

	echo("<TABLE border=0 class='standard-table'> ");

?>

	<tr>
	<td>Department</td>
<td>	<select  name="dept_id" id="dept_id" size='1'  >

							<option value="">--Select Department--</option>
						<?php
											foreach( $department as $dept )

                                {
									 $dept_id =$dept['DEPT_ID'];
									$dept_name =$dept['DEPT_NAME'];
									//$REMARKS =$dept['REMARKS'];
									echo("<option VALUE='$dept_id'>$dept_name</option>");
								}
								

						echo("</select>");
?>
</td>
</tr>

<tr>
	<td><B>Program</B></td>
	<td>	
		<select id="program_id" name="program_id" >
				<option value="">--Select Program--</option>
		</select>
	</td>	
</tr>
	<?php
	echo("<TR> ");
	echo("	<TD ><B>Exam. Year</B></TD> ");
	echo("	<TD><select name='exam_year' id='exam_year' size=1> ");
	
	?>
	
	<option value="2013">2013</option>
		<option value="2014">2014</option>
	<option value="2015">2015</option>


	<?php
    
	echo("	</select> ");
	echo("	</TD> ");
	echo("</TR> ");
	
	
	echo("<TR> ");
	echo("	<TD ><B>Semeister</B></TD> ");
	echo("	<TD><select id='semesterCombo' name=semester size=1> ");

    echo("<option value=''>--Select Semester</<option>");
    echo("<option value='1'>1</<option>");
	echo("<option value='2'>2</<option>");
	echo("<option value='3'>3</<option>");
	echo("<option value='4'>4</<option>");
	echo("<option value='5'>5</<option>");
	echo("<option value='6'>6</<option>");
	echo("<option value='7'>7</<option>");
	echo("<option value='8'>8</<option>");
	echo("<option value='9'>9</<option>");
	echo("<option value='10'>10</<option>");


	

	echo("	</select> ");
	echo("	</TD> ");
	echo("</TR>");
	
	?>
	<tr>
	<td><B>Course:</B></td>
	<td>	
			<select id="courseNo" name="courseNo">
				<option value="">--Select Course--</option>
			</select>
		
	</td>	
</tr>

<tr>
	<td><B>Batch</B></td>
	<td>	
		
		<select id="batch" name="batch">
				<option value="">--Select Batch--</option>
		</select>
		
	</td>	
</tr>

<tr>
	<td><B>Teacher Code</B></td>
	<td>
		<input type='text' name='TEACHER_CODE' id='TEACHER_CODE' placeholder="Enter Teacher Code" required />
	</td>	
	
</tr>
<tr>
	<td><B>Student Code</B></td>
	<td>
		<input type='text' name='STUDENT_CODE' id='STUDENT_CODE' placeholder="Enter student Code" required />
	</td>	
	
</tr>
<!--
<tr>
	<td><B>Email </B></td>
	<td>
		<input type='email' name='email' id='email' placeholder="email"/>
	</td>	
	
</tr>
-->
<tr>
<?php
echo("<TD ALIGN='CENTER' COLSPAN='2'> ");
  echo("<INPUT  id='register' TYPE='button' class='submit' VALUE='Register'> ");
		echo("</td>");

		?>
			<div id="add_err"></div>

</tr>	
	</table>  
	
			   
</div>
<!-- End Wrapper --> 



<script type="text/javascript" src="style/js/scripts.js"></script>
		<script>			   
			$("#semesterCombo").change(function(){
					changeValue();
					changeBatchValue();
			});
			$("#program_id").change(function(){
					changeValue();
					changeBatchValue();
			});
			$("#exam_year").change(function(){
					changeValue();
					changeBatchValue();
			});
			
			
			$("#dept_id").change(function(){
				
				var val = $(this).val();
					$.ajax(
					{ url:"http://localhost/google-plus/index.php/student_register_cantroler/getProgramAjax?depId="+val}).done(function(data){
						$("#program_id").html(data);
						changeValue();
						changeBatchValue();
					});
					
			});
			
			function changeValue(){
				var departmentId = $('#dept_id').val();
				var programId = $('#program_id').val();
				var yearId = $('#exam_year').val();
				var semester = $('#semesterCombo').val();
				var courseNo = $('#courseNo').val();
				//alert(""+departmentId+"-"+programId+"-"+yearId+"-"+semester);
				if( departmentId!="" &&  programId!="" && semester!="" && yearId!=""){
					$.ajax(
					{ url:"http://localhost/google-plus/index.php/student_register_cantroler/getCourseAjax?depId="+departmentId+"&progId="+programId+"&semester="+semester+"&year="+yearId}).done(function(data){
						$("#courseNo").html(data);
								changeBatchValue();

					});
				}
			}
			
			function changeBatchValue(){
				var departmentId = $('#dept_id').val();
				var programId = $('#program_id').val();
				var yearId = $('#exam_year').val();
				var semester = $('#semesterCombo').val();
				var courseNo = $('#courseNo').val();
				//alert(""+departmentId+"-"+programId+"-"+yearId+"-"+semester+"-"+courseNo);
				if( departmentId!="" &&  programId!="" && semester!="" && yearId!="" && courseNo!=""){
					$.ajax(
					
					{ url:"http://localhost/google-plus/index.php/student_register_cantroler/getBatchAjax?depId="+departmentId+"&program_id="+programId+"&semester="+semester+"&exam_year="+yearId+"&courseNo"+courseNo}).done(function(data){
						alert(data);
						$("#batch").html(data);
					});
				}
			}
			
		$("#register").click(function(){
		
			student_teacher_code();
		});	
			function student_teacher_code(){

				var STUDENT_CODE = $("#STUDENT_CODE").val();
				var TEACHER_CODE=$("#TEACHER_CODE").val();
				var departmentId = $('#dept_id').val();
				var programId = $('#program_id').val();
				var yearId = $('#exam_year').val();
				var semester = $('#semesterCombo').val();
				var courseNo = $('#courseNo').val();
				var slid=$('#batch').val();
				var email=$('#email').val();
				//alert(slid);
				if( STUDENT_CODE!="" && TEACHER_CODE!="" && departmentId!="" &&  programId!="" && semester!="" && yearId!="" && courseNo!="" && slid!=""){
				
				
				$.ajax(
					{ url:"student_registration_add.php?STUDENT_CODE="+STUDENT_CODE+"&TEACHER_CODE="+TEACHER_CODE+"&batch="+slid+"&exam_year="+yearId+"&semester="+semester+"&courseNo="+courseNo+"&dept_id="+departmentId+"&program_id="+programId+"email="+email}).done(function(data){
						//alert(data);
						if(data=='teachercode')
						{
					//	alert("Duplicate Teacher Code..");
					$("#add_err").html("<font colour='red'>Duplicate Teacher Code..</font>");
					}else if(data=='studentcode'){
					//alert("Duplicate std Code..");
				
					$("#add_err").html("font colour='red'> Duplicate Student Code....</font>");
						}
						else{
						//$("#registrationForm").submit();
						$("#add_err").html(data);
						}
						//	$("#").html(data);
					});
				
  }//end if
} //end function

	
		</script>



</body>
</html>