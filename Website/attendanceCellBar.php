<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Fevicon
    ================================================== -->
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="icon" type="image/gif" href="images/animated_favicon1.gif">

	<!-- Basic Page Needs
    ================================================== -->
	<meta charset="utf-8">
	<title>ATTENDANCE CELL</title>

	<!-- Mobile Specific Metas
    ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
    ================================================== -->
	<link rel="stylesheet" href="http://104.223.95.210/css/style.css">
	<link rel="stylesheet" href="http://104.223.95.210/css/colors/blue.css" id="colors">

	<link rel="stylesheet" href="http://104.223.95.210/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="http://104.223.95.210/bootstrap/css/bootstrap.min.css">

	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Java Script
    ================================================== -->
	<script src="http://104.223.95.210/scripts/jquery.min.js"></script>
	<script src="http://104.223.95.210/scripts/jquery-ui.min.js"></script>
	<script src="http://104.223.95.210/scripts/jquery.selectnav.js"></script>
	<script src="http://104.223.95.210/scripts/custom.js"></script>

	


<body>

<!-- Wrapper / Start -->
<div id="wrapper">

	<!-- Header
    ================================================== -->

	<!-- 960 Container -->
	<div class="container">

		<!-- Header -->
		<header id="header">

			<!-- Logo -->
			<div class="ten columns">
				<div id="logo">
					<h1><a href="index.php"><img src="images/logo.png" alt="Exma- University of Sindh" />
							<div id="tagline">University of Sindh </br><p style='font-size:20px;'> Directorate of IT Services Center (Attendance Cell)</p></div>

				</div>
			</div>

			<!-- Social / Contact -->
			<div class="six columns">
			<!-- Social / Contact -->
			<div class="six columns">

				<!-- Social Icons -->
				<ul class="social-icons">
					<li class="twitte"><a href="https://twitter.com/usindh" target="_blank"></a></li>
					
				</ul>

		
		<div class="clearfix"></div>

				

				<!-- Contact Details -->

				<div class="clearfix">  </div>


			</div>
			
		</header>
		<div class='row'> <div class='col-sm-6'> </div>  <div class='col-sm-6'> Welcome, <?php echo $_SESSION['NAME']; ?> &nbsp;&nbsp;&nbsp; <a href='attendance_logout.php'> Logout </a> </div> </div>
	
		<!-- Header / End -->

		<div class="clearfix"></div>

	</div>
	<!-- 960 Container / End -->

	<?php
	//			if (!isset($_SESSION)) include('admin/session.php');//session_start();
	?>
	<!-- Navigation
    ================================================== -->
	<nav id="navigation" class="style-1">

		<div class="left-corner"></div>
		
		<div class="right-corner"></div>

		<ul class="menu" id="responsive">

			<li><a href="attendance_home.php" id="current"><i class="halflings white home"></i> Home</a></li>
			<li> <a href="http://104.223.95.210/attandance.php">Upload Attendance</a>  </li>
			<!--<li> <a href="http://104.223.95.210/index_attendance.php">Student Attendance</a>  </li>-->
		
			<li><a href="#" target="new">Reports</a>
				<ul>
					<li><a href="http://104.223.95.210/attandance_display_summary_course_wise.php">Student Summary Course Wise </a></li>

     <!--               <li><a href="http://104.223.95.210/marksheet.php">Marksheet</a></li>-->
					<!--<li><a href="http://104.223.95.210/trancript.php">Marksheet (Year) </a></li>-->
					
					<!--<li><a href="http://104.223.95.210/course.php">Subject Wise Result</a></li>-->
					<!--<li><a href="http://104.223.95.210/announcements.php">Result Announcements</a></li>-->

					<!--<li><a href="http://104.223.95.210/possitions.php">Academic Position</a></li>-->
					<!--<li><a href="http://104.223.95.210/successful_candidates.php">Successful Candidates</a></li>-->
					<!--<li><a href="http://104.223.95.210/unsuccessful_candidates.php">Unsuccessful Candidates</a></li>-->
					<!--<li><a href="http://104.223.95.210/unsuccessful_successful_candidates.php">Successful & Unsucessful Candidates</a></li>-->



				</ul>
			<li><a href="http://104.223.95.210/google/index.php/course_distribution_cantroler/login" target='new'>Course Distribution</a>

			
		<!--<li><a href="http://104.223.95.210/facultyMembers.php">Faculty</a>-->
		<!--    <ul style="visibility: visible; display: none;">-->
		<!--        <li><a href="http://104.223.95.210/facultyMembers.php">Faculty</a></li>-->
		<!--        <li><a href="http://104.223.95.210/googlefacultyform/index.php/app_form/">Edit / Update Personal Information on Faculty</a></li>-->
		<!--        <li><a href="http://104.223.95.210/googlefacultyform/index.php/new_registration_fac/">Add Personal Information on Faculty</a></li>-->
		<!--        <li><a href="http://104.223.95.210/googlefacultyform/How%20to%20Edit%20Personal%20Information%20on%20Faculty.pdf">Download Guideline</a></li>-->
  <!--          </ul>-->
  <!--      </li>-->

			</li>
<!--<li><a href="http://104.223.95.210/form/">Online Exam Form</a></li>-->

<!--<li><a href="http://104.223.95.210/index_attendance.php">Student Attendance</a></li>-->


		 <!--
                          <li><a href="http://104.223.95.210/google/index.php/google_plus_cantroler/">Teachers Result </a>
                                 <ul>
                                  
                        <li><a href=" http://104.223.95.210/google/index.php/google_plus_cantroler/">Login Google Plus</a></li>
                        <li><a href="http://104.223.95.210/google/index.php/course_distribution_cantroler/login">Course Distribution</a></li>

                        <li><a href="http://104.223.95.210/tl2/index.php/">Login</a></li>
                        <li><a href="http://104.223.95.210/tl2/student_registration.php">Register</a></li>
                        </ul>
			</li>
			-->
			
			<!--
		<li><a href="">Attandance System</a>
		    <ul style="visibility: visible; display: none;">
		        <li><a href="http://104.223.95.210/attandance_login.php">Admin login</a></li>
		        <li><a href="http://104.223.95.210/attandance_login_teacher.php">Teacher login</a></li>
		        <li><a href="http://104.223.95.210/attandance_display_summary_course_wise.php">Check Course Wise</a></li>
		        <li><a href="http://104.223.95.210/attandance_display_roll_number_wise.php">Check Attandance Roll Number Wise</a></li>
		        <li><a href="http://104.223.95.210/attandance_display_date_wise.php">Check Attandance Date Wise</a></li>
		         
            </ul>
        </li>
        -->
			</li>
			<!--<li><a href="http://104.223.95.210/fees.php">Fees Structure</a></li>-->

			<!--<li><a href="http://104.223.95.210/comments.php">Comments</a></li>-->
			
		</ul>


		</ul>
	</nav>
	<div class="clearfix"></div>