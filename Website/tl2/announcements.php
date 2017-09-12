<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>UOS Examination</title>
	<meta name="description" content="University Of Sindh annoucements of results">
	<meta name="author" content="usindhexam.stbb.edu.pk">
	
    <!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta charset="UTF-8">
<?php
include("bar.php");
?> 
  <!-- Begin Container -->
  <div id="container" class="opacity">
    <h1><p style='font-size:40px;'>Announcements</p></h1>
	
            <?php
        require '../Database.php';
	//echo("<body background=background.gif>");


	echo("<p style='margin-bottom:10px; margin-top:10px; font-size:20px;'>Semester Examinations</p>");
	echo("<font size=5 color='#003366'><b>University of Sindh, Jamshoro</b></font><br>");
?>
	<table>
	<tr>
	<td>
	<form name="login-form"  id="myform"   action="student_check_result.php"  method="post">
		<h1>For Students</h1>
		<span>Enter Code.</span>
		<input name="STUDENT_CODE"  id="STUDENT_CODE" type="text"  placeholder="Teacher Code" />
	<input type="button" id="login" value="Login" class="button" />	
	<div class="err" id="add_err" style="color:red;"></div>
		
		<B>.</B>
	</form>
	
</td>
	<td>
	<form name="login-form" id="teacherform"  method="post" action="marks_add.php" >
		<h1>For Teachers</h1>
		<span>Enter Code.</span>
	
		<input name="TEACHER_CODE" id="TEACHER_CODE" type="text"  placeholder="Teacher Code" />
	<input type="button" id="login1" value="Login" class="button" />	
	<div class="err" id="add_err1" style="color:red;"></div>
	
	<a href='student_registration.php' ><FONT style="font-family: 'Bree Serif', serif; font-weight: 200;font-size: 20px;">REGISTER</font></a>
	
	</form>
	</td>
	</tr>
	</table>  

<?php
//include("header.php");
?>
  
</div>
<!-- End Wrapper --> 



<script type="text/javascript" src="style/js/scripts.js"></script>
<script>

$("#STUDENT_CODE").keypress(function(e){
	$("#add_err").html("");
	if(e.which == 13) {
		return false;
	 
       }
});

$("#login").click(function(){
	student();
});


function student(){

var STUDENT_CODE = $("#STUDENT_CODE").val();
	    $.ajax({
		type: "POST",
		url: "student_check_result.php",
		data: "STUDENT_CODE="+STUDENT_CODE,
		
		success: function(html){
			if(html=='false')
			{
				$("#add_err").html("Wrong username or password");
			}else{
				$("#myform").submit();
			}    
		}
  });
}

</script>
<script>
$("#TEACHER_CODE").keypress(function(e){
	
	$("#add_err1").html("");
	if(e.which == 13) {
		return false;
	 
       }
});

$("#login1").click(function(){
teacher();
});


function teacher(){

	var TEACHER_CODE = $("#TEACHER_CODE").val();
	
    $.ajax({
		type: "POST",
		url: "marks_add.php",
		data: "TEACHER_CODE="+TEACHER_CODE,
		success: function(html){
		
			if(html==("false"))
			{
				$("#add_err1").html("Wrong username or password");
			}else{
				$("#teacherform").submit();
			}    
		}
  });

}
</script>



</body>
</html>