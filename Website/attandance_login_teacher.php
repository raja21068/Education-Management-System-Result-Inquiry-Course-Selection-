    <!DOCTYPE HTML>
<html lang="en-US" xmlns="http://www.w3.org/1999/html">

 <!-- Basic Page Needs
  ================================================== -->
	    <!-- Basic Page Needs
  ================================================== -->
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" type="image/gif" href="images/animated_favicon1.gif">

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>Attandance Login</title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!--================================================== -->
<?php
echo("<h1 align=center>ONLINE Attandance Submission System</h1>");

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

	<!--	<h3>Semester Results for Ex-Students from Academic Year 2004 to 2013 only</h3>

		<p style='margin-bottom:10px; margin-top:10px; font-size:15px; color:red;'>Note: This gazette is not for currently enrolled students and it is published for record and verification purposes only</p>
		 -->
	</div>

  <!-- Begin Container -->

    <!-- Page Content -->
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class='col-md-10'>
                    <div class="text-center"><h3><span class="label label-default">Teacher Login Attandance</span></h3></div>
                    </br>
                    <div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                     
                    <div class="text-danger">
                    <FORM action='attandance_login_teacher_submit.php' method='POST'>
                    </div>
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control" placeholder="Email" name="username" required>
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="date" class="form-control" placeholder="Date Of Birth" name="pass" required>
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="text-danger">
                                <p>username and password are case sensitive</p>
                            </div>
                            <?php //echo  $this->recaptcha->recaptcha_get_html(); ?>
                           </br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success" align="center">Login
                                    <i class="glyphicon glyphicon-log-in"></i>
                                </button>
                            </div>

                             <div class="col-md-4"></div>
                        <div class="col-md-4">
                        

                    <div class="text-danger">
                      <a href="<?php echo $authUrl; ?>">  <img src="google/assets/images/google-sign-in.png"> </a>
                    </div>





                        
                    </div>

                        <div class="col-md-4"></div>



                            </FORM>
                    </div>

                        <div class="col-md-4"></div>

                    </div>

                </div>

        </div>
            <!--IMPORTANT INSTRUCTION -->

            </div>
        </div>




