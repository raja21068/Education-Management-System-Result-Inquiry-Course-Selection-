<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Fevicon
    ================================================== -->
	<link rel="shortcut icon" href="<?Php echo ASSET_PATH ?>favicon.ico">
	<link rel="icon" type="image/gif" href="<?Php echo ASSET_PATH ?>images/animated_favicon1.gif">

	<!-- Basic Page Needs
    ================================================== -->
	<meta charset="utf-8">
	<title>Exams</title>

	<!-- Mobile Specific Metas
    ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
    ================================================== -->
	<!-- CSS
    ================================================== -->
	<link rel="stylesheet" href="<?Php echo ASSET_PATH ?>css/style.css">
	<!--<link rel="stylesheet" href="--><?Php //echo ASSET_PATH ?><!--css/colors/blue.css" id="colors">-->
	<!--<link rel="stylesheet" href="--><?Php //echo ASSET_PATH ?><!--css/bootstrap.min.css">-->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<link rel="stylesheet" href="http://exam.usindh.edu.pk/css/colors/blue.css" id="colors">

	<link rel="stylesheet" href="http://exam.usindh.edu.pk/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="http://exam.usindh.edu.pk/bootstrap/css/bootstrap.min.css">

	<!--[if lt IE 9]>
	<script src="<?Php echo ASSET_PATH; ?>/js/html5.js"></script>
	<![endif]-->

	<!-- Java Script
    ================================================== -->
	<script src="<?Php echo ASSET_PATH; ?>/js/jquery-1.11.2.min.js"></script>
	<script src="http://exam.usindh.edu.pk/scripts/jquery-ui.min.js"></script>
	<script src="http://exam.usindh.edu.pk/scripts/jquery.selectnav.js"></script>
	<script src="<?Php echo ASSET_PATH; ?>/js/bootstrap.min.js"></script>
		<script src="<?Php echo ASSET_PATH; ?>/scripts/chosen.jquery.js"></script>


	<script src="http://exam.usindh.edu.pk/scripts/custom.js"></script>



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
					<h1><a href="index.php"><img src="<?Php echo ASSET_PATH ?>images/logo.png" alt="Exma- University of Sindh" />
							<div id="tagline">University of Sindh </br><p style='font-size:23px;'>Semester Examination </p></div>

				</div>
			</div>

			<!-- Social / Contact -->
			<div class="six columns">

				<!-- Social Icons -->
				<ul class="social-icons">
					<li class="twitter"><a href="https://twitter.com/usindh" target="_blank">Twitter</a></li>
					<li class="facebook"><a href="https://www.facebook.com/usindh" target="_blank">Facebook</a></li>

					<li class="linkedin"><a href="https://www.linkedin.com/edu/school?id=15897&trk=edu-cp-title" target="_blank">LinkedIn</a></li>
					<li class="rss"><a href="http://usindh.edu.pk/blogs/" target="_blank">RSS</a></li>
				</ul>

				<div class="clearfix"></div>

				<!-- Contact Details -->

				<div class="clearfix"></div>


			</div>
		</header>
		<!-- Header / End -->

		<div class="clearfix"></div>

	</div>
	<!-- 960 Container / End -->

	<?php
	//			if (!isset($_SESSION)) include('admin/session.php');//session_start();
	?>
	<!-- Navigation ================================================== -->
	<nav id="navigation" class="style-1">

		<div class="left-corner"></div>
		<div class="right-corner"></div>

		<ul class="menu" id="responsive">

<!--			<li><a href="http://admission.usindh.edu.pk/"><i class="halflings white home"></i> Home</a></li>-->
			<li><a href="<?php echo base_url("index.php/google_plus_cantroler");?>"><i class="halflings white list-alt"></i> Login With Google Plus</a></li>
			<li><a href="<?php echo base_url("index.php/google_plus_cantroler/loginTeacherCode");?>"><i class="halflings white list-alt"></i>Login With Code </a></li>
			</nav>
	<div class="clearfix"></div>