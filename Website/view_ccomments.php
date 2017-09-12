<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<?php
    include("Database.php");
  echo("<center>");

    echo("<font size=6 color='#006666'><b>View Your Comments</b></font><br> ");
    echo("<font size=6><b>Semester Examinations,</b></font><br>");
    echo("<font size=5 color='#003366'><b>University of Sindh, Jamshoro</b></font><br>");


    $query="SELECT * FROM comments order by id desc";
    //echo($query);
    
    $result=mysql_query($query);
//echo($query);


    echo("<body background=background.gif>");
    echo("<TABLE border=1 bordercolor=black>");
    echo("<TR bgcolor='#CCCCCC'>");

    echo("	<TH>Date</TH>");
    echo("	<TH>Message Type</TH>");
    echo("	<TH>Subject</TH>");
    echo("	<TH>Comments</TH>");
    echo("	<TH>User Name</TH>");
    echo("	<TH>User E-Mail</TH>");
    echo("	<TH>User Tel.</TH>");
    echo("</TR>");

    while($row=mysql_fetch_object($result)){

	    echo("<TR>");
          
	    echo("	<TD>$row->to_day_date</TD>");
	    echo("	<TD>$row->MessageType</TD>");
	    echo("	<TD>$row->Subject</TD>");
	    echo("	<TD>$row->Comments</TD>");
	    echo("	<TD>$row->Username</TD>");
	    echo("	<TD>$row->UserEmail</TD>");
	    echo("	<TD>$row->UserTel</TD>");
	    echo("</TR>");
	}//END WHILE

    echo("</TABLE><br>");
   // echo("<img src=department_logo.gif>");
    echo("<hr>");
    echo("<b>Computer Cell, Examinations Wing, University of Sindh, Jamshoro.<br>");
    echo("Copyright © 2014 [University of Sindh, Jamshoro]. All rights reserved.<br>");
    echo("</center>");

    echo("</body>");

?>
