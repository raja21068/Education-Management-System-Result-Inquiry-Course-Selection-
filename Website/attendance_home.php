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
</head>
<body> 
<?php 
include('attendanceCellBar.php');
?>
</body>
</html>