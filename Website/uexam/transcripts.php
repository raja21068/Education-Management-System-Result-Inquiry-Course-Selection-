<html>
<head>

    <!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>UOS Examination</title>
	<meta name="robots" content="index, follow" />
  	<meta name="keywords" content="usindh,usindhexam,usindh exam,usindh marksheet" />
  	<meta name="rights" content="usindh exam" />
  	<meta name="language" content="en-GB" />
  	
	<meta name="description" content="University Of Sindh Examination Results Online, Marksheets and announcements">
	<meta name="author" content="University Of Sindh Exam Results">
	
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
<nav style="width: 1200px;">
	<ul>
            <li><a href="index.html" style="border-right: 1px solid purple;text-transform:none;">Home</a></li>
            <li><a href="announcements.php" style="border-right: 1px solid purple;text-transform:none;">Result Announcements</a></li>
            <li><a href="transcripts.php" style="border-right: 1px solid purple;text-transform:none;">Marksheets</a></li>
		<li><a href="possitions.php" style="border-right: 1px solid purple;text-transform:none;">Academic Postion</a></li>
		<li><a href="successful_candidates.php" style="border-right: 1px solid purple;text-transform:none;">Successful Candidates</a></li>
		<li><a href="course_schemes.php" style="border-right: 1px solid purple;text-transform:none;">Course Scheme</a></li>
		<li><a href="comments.html" style="border-right: 1px solid purple;text-transform:none;">Comments</a></li>

	</ul>
</nav>
<div style="margin-left: 20%; margin-right: 10%;">
    <?php
      include("Database.php");

	

	echo("<p style='margin-bottom:10px; font-size:40px; color:#006666;'>Academic Transcript / Marksheet</p>");
	echo("<p style='margin-bottom:10px; margin-top:10px; font-size:20px;'>Semester Examinations</p>");
	echo("<font size=5  color='#003366'><b>University of Sindh, Jamshoro</b></font><br>");

	echo("<FORM ACTION=1.php method=post target=test> ");
	echo("<TABLE border=0> ");


	echo("<TR> ");
	echo("	<TD ALIGN=RIGHT><B>Roll No.</B></TD> ");
	echo("	<TD><input type=text name=roll_no size=10><FONT COLOR=RED SIZE=2> for example <U>2K10/CSE/60</U></TD>  ");
	echo("	<TD ALIGN=RIGHT><B>Part</B></TD> ");
	echo("	<TD> ");
	echo("		<select name=part size=1> ");
	echo("		 <option value=1>I</option> ");
	echo("		 <option value=2>II</option> ");
	echo("		 <option value=3>III</option> ");
	echo("		 <option value=4>IV</option> ");
	echo("		</select> ");
	echo("	</TD> ");
	echo("</TR> ");
	echo("<TR> ");
	echo("	<TD ALIGN=RIGHT><B>Exam. Year</B></TD> ");
	echo("	<TD><select name=exam_year size=1> ");

      display_seat_list_years_in_combobox();
	echo("	</select> ");
         echo '<br/>';
      echo("<INPUT TYPE=SUBMIT style='background-color: purple; color:white; padding: 5px 5px 5px 5px; border-radius:5px;' VALUE='View Marksheet'> ");
	echo("</TD> ");


	echo("</TR> ");
	echo("</TABLE> ");

	echo("</form> ");
        echo '<br/>';
      echo("<img src=department_logo.gif>");


?>

    </div>
    </body>
</html>





