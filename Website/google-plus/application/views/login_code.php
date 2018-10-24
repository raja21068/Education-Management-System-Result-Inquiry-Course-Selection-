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
  <div class="container">

	<div class="sixteen floated page-title">

	<h1>Teachers Sheet Results</h1>
	
		<p style='margin-bottom:10px; margin-top:10px; font-size:20px;'>Semester Examinations</p>
		<font size=5 color='#003366'><b>University of Sindh, Jamshoro</b></font><br>
	</div>

</div>

<div class="page-content">


<?php echo form_open('/google_plus_cantroler/accessSheet');	?>

<!--	<form name="login-form" id="teacherform"  method="post" action="marks_add.php" >-->
		<!-- Large Notice -->
		<div class="large-notice">
			<h2> Login Form</h2>
				<!-- Contact Form -->
				<section id="contact">

						<fieldset>
							<div>
								<input name="TEACHER_CODE" id="TEACHER_CODE" type="text"  placeholder="Teacher Code" />

							</div>
							
						</fieldset>

						<input type="submit" class="submit" id="login1" value="Login"/>
						<div class="err" id="add_err1" style="color:red;"></div>
	
                        <div style="float:right; padding-top:8px"><a href="student_registration.php">Register</a></div>
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

	$("#add_err1").html("");
	if(e.which == 13) {
		return false;

       }
});

$("#login1").click(function(){
//teacher();
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


</head>

</body>
</html>