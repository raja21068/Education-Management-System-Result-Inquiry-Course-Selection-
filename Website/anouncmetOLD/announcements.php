<!DOCTYPE html>
<html>
<head>

    <!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>UOS Examination</title>
	<meta name="description" content="Free Html5 Templates and Free Responsive Themes Designed by Kimmy | zerotheme.com">
	<meta name="author" content="www.zerotheme.com">
	
    <!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="css/zerogrid.css">
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
	<link rel="stylesheet" href="css/responsiveslides.css" />
	
	
	<link href='./images/favicon.ico' rel='icon' type='image/x-icon'/>
	
	<script src="js/jquery.min.js"></script>
	<script src="js/responsiveslides.js"></script>
	<script>
    $(function () {
      $("#slider").responsiveSlides({
        auto: true,
        pager: false,
        nav: true,
        speed: 500,
        maxwidth: 960,
        namespace: "centered-btns"
      });
    });
  </script>
    
</head>
<body>
<!--------------Header--------------->
<header> 
	<div ><a href=""><img src="./images/usindhlogo.jpg"/></a></div>
	
</header>

<!--------------Navigation--------------->
<nav style="width: auto;">
	<ul>
            <li><a href="index.html" style="border-right: 1px solid purple;">Home</a></li>
            <li><a href="announcements.php" style="border-right: 1px solid purple;">Result Announcements</a></li>
            <li><a href="transcripts.php" style="border-right: 1px solid purple;">Transcript</a></li>
		<li><a href="possitions.php" style="border-right: 1px solid purple;">Academic Postion</a></li>
		<li><a href="successful_candidates.php" style="border-right: 1px solid purple;">Successful Candidates</a></li>
		<li><a href="course_schemes.php" style="border-right: 1px solid purple;">Course Scheme</a></li>
		<li><a href="comments.html" style="border-right: 1px solid purple;">Comments</a></li>
		<li><a href="view_comments.php" style="border-right: 1px solid purple;">View Comments</a></li>
	</ul>
</nav>
<div style="margin-left: 20%; margin-right: 10%;">
   <?php
        require '../Database.php';
	//echo("<body background=background.gif>");


	echo("<p style='margin-bottom:20px; font-size:40px; color:#006666;'>Announcements</p>");
	echo("<p style='margin-bottom:10px; margin-top:10px; font-size:20px;'>Semester Examinations</p>");
	echo("<font size=5 color='#003366'><b>University of Sindh, Jamshoro</b></font><br>");

	echo("<FORM ACTION=announcements_request_handler.php method=post target=test> ");
	echo("<TABLE border=0> ");
	echo("<TR color='#003366'> ");
	echo("	<TD ><B>Department</B></TD> ");
	echo("	<TD COLSPAN=3> ");
	echo("		<select name=dept_id size=1> ");
        
      display_departments_in_combobox();

	echo("		</select> ");
	echo("	<TD> ");
	echo("</TR> ");
	echo("<TR> ");
	echo("	<TD ><B>Exam. Year</B></TD> ");
	echo("	<TD><select name=exam_year size=1> ");

      display_seat_list_years_in_combobox();

	echo("	</select> ");
	echo("	</TD> ");
	echo("<TR> ");
	echo("<TD  COLSPAN=4><INPUT style='background-color: purple; color:white; padding: 5px 5px 5px 5px; border-radius:5px;' TYPE='SUBMIT' VALUE='View Announcements'></TD> ");
	echo("</TABLE> ");
	echo("</form> ");
        echo '<br/>';
	echo("<img src=department_logo.gif>");

	

?>
    </div>
    </body>
</html>
