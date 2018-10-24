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



  <!-- Begin Container -->
  <div class="container">

	<div class="sixteen floated page-title">

	<h1>Course Distribution</h1>
	
		<p style='margin-bottom:10px; margin-top:10px; font-size:20px;'>Semester Examinations</p>
		<font size=5 color='#003366'><b>University of Sindh, Jamshoro</b></font><br>
	</div>

</div>

<div class="page-content">


<?php echo form_open('/course_distribution_cantroler/loginSumbit');	?>

<!--	<form name="login-form" id="teacherform"  method="post" action="marks_add.php" >-->
		<!-- Large Notice -->
		<div class="large-notice">
			<h2> Login Form</h2>
				<!-- Contact Form -->
				<section id="contact">

						<fieldset>
							<div>
								<!-- <input name="TEACHER_CODE" id="TEACHER_CODE" type="text"  placeholder="Teacher Code" /> -->
								<input name="USER" id="USER" type="text"  placeholder="USER" /> 
								<input name="PASS" id="PASS" type="text"  placeholder="PASSWORD" /> 

							</div>
							
						</fieldset>

						<input type="submit" class="submit" id="login1" value="Login"/>
						<div class="err" id="add_err1" style="color:red;"></div>
	
                		<div class="clearfix"></div>
					</form>

				</section>
				<!-- Contact Form / End -->
	</div>

</div>


  
</div>
<!-- End Wrapper --> 



<script type="text/javascript" src="style/js/scripts.js"></script>
<script>
$("#TEACHER_CODE").keypress(function(e){
	var USER = $("#USER").val();
	var PASS = $("#PASS").val();


	$("#add_err1").html("");
	if(e.which == 13) {
		
		return false;

       }
});

$("#login1").click(function(){
		var USER = $("#USER").val();
		var PASS = $("#PASS").val();
if(USER==""){
	alert("empty user name");
	return;
}
if(PASS==""){
	alert("empty pass");
	return;
}

//teacher();
});

</script>


</head>

</body>
</html>