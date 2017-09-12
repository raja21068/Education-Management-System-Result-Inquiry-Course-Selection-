 <!-- Fevicon
================================================== -->
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" type="image/gif" href="images/animated_favicon1.gif">

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>Markshet</title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<?php
      include("../Database.php");

	$sl_id 		=mysql_real_escape_string($_GET["sl_id"]);    
	$part		=mysql_real_escape_string($_GET["part"]);
	$scheme_id	=mysql_real_escape_string($_GET["scheme_id"]);
	$batch_id		=mysql_real_escape_string($_GET["batch_id"]);
	$exam_year	=mysql_real_escape_string($_GET["exam_year"]);
	$exam_type	=mysql_real_escape_string($_GET["exam_type"]);
	$roll_no		=mysql_real_escape_string($_GET["roll_no"]);
	
	if($sl_id==""){
	
	header("Location: error.html");
	return;
	}
	if($part==""){
	
	header("Location: error.html");
	return;
	}
	if($scheme_id==""){
	
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
	if($roll_no==""){
	
	header("Location: error.html");
	return;
	}

	echo("<body background=background.gif>");

	echo("<img src=header_left.gif><br>");
                 display_marks_certificate($sl_id,$roll_no,$part,$scheme_id,$batch_id,$exam_year, $exam_type);    

    
	echo("</body>");
?>