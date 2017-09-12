 <!-- Fevicon================================================== --><link rel="shortcut icon" href="favicon.ico"><link rel="icon" type="image/gif" href="images/animated_favicon1.gif"><!-- Basic Page Needs================================================== --><meta charset="utf-8"><title>Mis Report</title><!-- Mobile Specific Metas================================================== --><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"><link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"><?php
       include("Database.php");
	 $EXAM_YEAR=mysql_real_escape_string($_POST["exam_year"]);

	echo("<body background=background.gif>");
	 echo("<img src=header_left.gif><br>");

 	 echo("<font size=6><b>EXAMINATIONS $EXAM_YEAR</b></font><br><br>");
 	 echo("<font size=5 color='#003366'><b>Progress Report of Examinations $EXAM_YEAR</b></font><br>");
		echo("<div class='table-responsive'>");			echo("<table class='table  table-bordered   table-hover' ");

	       $TOTAL_NUMBER_OF_EXAMS=0;
       	       $TOTAL_NUMBER_OF_MALE_STUDENTS=0;
	       $TOTAL_NUMBER_OF_FEMALE_STUDENTS=0;
	       $GRANT_TOTAL_STUDENTS=0;
	       $TOTAL_NUMBER_OF_PASS_STUDENTS=0;
	       $TOTAL_NUMBER_OF_FAIL_STUDENTS=0;

	       $sno=0;

	       $query="SELECT DISTINCT TYPE as TYPE FROM seat_list WHERE  YEAR='$EXAM_YEAR'"; 			echo($query."</br>");
 

      echo("</TABLE>");
  echo("</div>");
 
      echo("</body>");
?>