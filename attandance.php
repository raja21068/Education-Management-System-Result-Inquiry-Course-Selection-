<?php 
@session_start();

require_once('attendance_check_login.php');
//echo $_SESSION['USER_ID'];
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
  <link rel="shortcut icon" href="favicon.ico">
<link rel="icon" type="image/gif" href="images/animated_favicon1.gif">

<!--<link rel="stylesheet" type="text/css" href="http://exam.usindh.edu.pk/attendanceReports/date/bootstrap-iso.css" />-->
<!--<link rel="stylesheet" href="http://exam.usindh.edu.pk/attendanceReports/assets/date/bootstrap-datepicker3.css"/>-->


<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://code.jquery.com/resources/demos/style.css">
  
<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title> ATTENDANCE CELL </title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<?php
include("attendanceCellBar.php");
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
<h1>Add Attendance</h1>
	
		<p style='margin-bottom:10px; margin-top:10px; font-size:20px;'>IT Services Center (Attendance Cell)</p>
	</div>

	

	
            <?php
        require 'Database.php';
		
	//	$user	=mysql_real_escape_string($_POST["username"]);
	//	$pass	=mysql_real_escape_string($_POST["pass"]);
		
	//	$query="SELECT  EMAIL_ADRESS ,	DATE_OF_BIRTH, REMARKS  FROM faculty_members WHERE EMAIL_ADRESS='$user' AND DATE_OF_BIRTH='$pass'";
	//	echo($query);
		$result_authantication=mysql_query($query);
			
		    //	if(!($row_authantication=mysql_fetch_object($result_authantication))){
				//	return;
					//echo("raja");
			//	}
	//echo("<body background=background.gif>");



//	echo("<FORM ACTION='course_summary.php' method='post' target=test> ");
//	echo("<div class='table-responsive'>");

// 	echo("<TABLE border=0 class='standard-table'> ");
// 	echo("<TR color='#003366'> ");
// 	echo("	<TD ><B>Name</B></TD> ");
// 	echo("	<TD COLSPAN=3> ");
	

	?>
<?php 
if($_SESSION['REMARKS'] == 'TEACHER_LOGIN')
{
    
    $queryJunction = 'AND MEMBER_ID='.$_SESSION['USER_ID'];
}else
{
    $queryJunction = '';
}
?>	
<div class='row'> 
<div class='col-md-6'>
    <label> Instructor Name</label>
    <div class='form-group'>
        
        
    
<select  name="facMember_id" id="facMember_id" size='1' class='form-control'>

							<option value="">--Select Name--</option>
						<?php
						$query="SELECT d.CODE AS CODE,DEPT_NAME,MEMBER_ID,fm.DEPT_ID AS DEPT_ID,FIRST_NAME,LAST_NAME FROM faculty_members fm, department d WHERE d.DEPT_ID=fm.DEPT_ID $queryJunction  order by FIRST_NAME";
						$result=mysql_query($query)or die(header("Location: error.html"));
						while($row=mysql_fetch_object($result))
						echo("<option value=$row->MEMBER_ID>".$row->FIRST_NAME." ".$row->LAST_NAME." (".$row->CODE.")</option> ");     

						echo("</select>");
?>

	</div>
    
</div>

	<?php  
      
	//echo("	</TD> ");
	//echo("</TR> ");
	?>
	<!--<tr>-->
	<!--<td><B>Courses</B></td>-->
	<!--<td>	-->
<div class='col-md-6'> 

<label> Courses </label>

		<select id="course_distribution_id" name="course_distribution_id" class='form-control'>
				<option value="">--Select Course--</option>
		</select>
		
		</div>
</div>

        <div class='row'> 
        <div class='col-md-4'>
          <label> No: of Classes </label>
            <div class='form-group'> 
            
	<!--</td>	-->
<!--</tr>-->
	<?php
// 	echo("<TR> ");
// 	echo("<label> No: of Classes </label> ");
	echo("<input type='number' name='no_of_classes' id='no_of_classes' min='0' max='10' value='1' class='form-control'> ");
	
	?>
	
	</div>

</div>

        <div class='col-md-4'> 
        <label> Date </label>
        <div class='form-group'>
        
	<?php

// 	echo("	</TD> ");
// 	echo("</TR> ");
	
	
// 	echo("<TR> ");
// 	echo("<label> Date </label>");
	echo("<input type='text' id='date_of_attandance' name='date_of_attandance' value='".date('Y-m-d')."' class='form-control' readonly> ");

    // echo("	</TD> ");
// 	echo("</TR>");
	
	?>
            
            </div>
        </div>
        	</div>
        	
        	<div class='row'>
	<div class='col-md-12'>
	    
	    <div class='btn-group'>
	        
	   
	<?php
// 	echo("<TR> ");
// 	echo("<TD ALIGN='CENTER' COLSPAN='2'> ");
  echo("<INPUT TYPE='SUBMIT' id='display' class='submit' VALUE='Upload Attendance' class='col-md-3'>");
   echo("<img src='images/busy.gif' id='ajax-ico' style='display:none;'> ");
	//	echo("</td>");	
	
	//echo("</TABLE> ");
	?>
	
	</div>
	    </div>
	</div>
	<?php
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




<!--			<script type="text/javascript" src="http://exam.usindh.edu.pk/attendanceReports/assets/date/jquery-1.11.3.min.js"></script>-->

 <!--Include Date Range Picker -->
<!--<script type="text/javascript" src="http://exam.usindh.edu.pk/attendanceReports/assets/date/bootstrap-datepicker.min.js"></script>-->

 <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

		<script>			   
			
			$(function() {
  var currentYear = (new Date).getFullYear();
  var currentMonth = (new Date).getMonth();
  var currentDay = (new Date).getDate();

//   $("#fromdate").datepicker({
//     minDate: new Date((currentYear - 1), 12, 1),
//     dateFormat: 'dd/mm/yy',
//     maxDate: new Date(currentYear, currentMonth, currentDay)
//   });
  
  $("#date_of_attandance").datepicker({
    minDate: new Date((currentYear - 1), 12, 1),
    dateFormat: 'yy-mm-dd',
    maxDate: new Date(currentYear, currentMonth, currentDay),
    beforeShowDay: $.datepicker.noWeekends
  });
});

//   $(document).ready(function(){
       
//         var currentYear = (new Date).getFullYear();
//         var currentMonth = (new Date).getMonth();
//         var currentDay = (new Date).getDate();

//         var date_input=$('input[id="date_of_attandance"]'); //our date input has the name "date"
//         var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
//         date_input.datepicker({
//             format: 'yyyy-mm-dd',
//             container: container,
//             todayHighlight: true,
//             autoclose: true,
            
//         })
//     });
    

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