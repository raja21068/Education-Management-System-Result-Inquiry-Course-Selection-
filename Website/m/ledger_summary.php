 <!-- Fevicon
================================================== -->
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" type="image/gif" href="images/animated_favicon1.gif">

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>Ledger Summary</title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<?php
      include("../Database.php");

	$sl_id  =	mysql_real_escape_string($_GET["sl_id"]);    
	$part=		mysql_real_escape_string($_GET["part"]);
	$batch_id=	mysql_real_escape_string($_GET["batch_id"]);
	$exam_year=	mysql_real_escape_string($_GET["exam_year"]);
	$exam_type=	mysql_real_escape_string($_GET["exam_type"]);
	$prog_name=	mysql_real_escape_string($_GET["prog_name"]);
	if($sl_id==""){
	
	header("Location: error.html");
	return;
	}
	if($sl_id==""){
	
	header("Location: error.html");
	return;
	}
	if($part==""){
	
	header("Location: error.html");
	return;
	}
	if($batch_id==""){
	
	header("Location: error.html");
	return;
	}
	if($exam_year==""){
	
	header("Location: error.html");
	return;
	}
	if($prog_name==""){
	
	header("Location: error.html");
	return;
	}

//	echo("<body background=background.gif>");
	echo("<center> ");
	//echo("<img src=header_left.gif><br>");

	echo("<font size=7 color='#006666'><b>Result Announcement Sheet</b></font><br> ");
	echo("<font size=6><b>Semester Examinations</b></font><br>");
//	echo("<font size=5><b>University of Sindh, Jamshoro</b></font><br><br>");
	echo("<font size=5><b>$prog_name</b></font><br><br>");
      
      $scheme_id=get_scheme_id($sl_id);
      display_ledger_detail_summary($sl_id,$part,$scheme_id,$batch_id,$exam_year, $exam_type);

	echo("<br>");
	//echo("<img src=department_logo.gif>");
	echo("</center> ");

	echo("</body>");
?>