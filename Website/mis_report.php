<?php
      include("Database.php");

	
	echo("<FORM ACTION=mis_report_university_request_handler.php method=post target=test> ");
	echo("<TR> ");
	echo("	<TD ALIGN=LEFT COLSPAN=2 bgcolor='FFFFEF'><b>University M.I.S report</b></TD> ");
	echo("</TR> ");

	echo("<TR> ");
	echo("	<TD ALIGN=RIGHT><B>Exam. Year</B></TD> ");
	echo("	<TD><select name='exam_year' class='form-cantrol'> ");
			    display_scheme_years_in_combobox();
	echo("	    </select> ");
	echo("          <INPUT TYPE=SUBMIT VALUE='View Report'>");
	echo("	 </TD> ");
	echo("</TR> ");
	echo("</FORM>");
      echo("</TABLE>");
	//echo("<img src=department_logo.gif>");

	echo("</body>");
?>









