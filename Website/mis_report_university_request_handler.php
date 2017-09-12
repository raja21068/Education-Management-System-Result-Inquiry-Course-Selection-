 <!-- Fevicon================================================== --><link rel="shortcut icon" href="favicon.ico"><link rel="icon" type="image/gif" href="images/animated_favicon1.gif"><!-- Basic Page Needs================================================== --><meta charset="utf-8"><title>Mis Report</title><!-- Mobile Specific Metas================================================== --><meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"><link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"><?php
       include("Database.php");
	 $EXAM_YEAR=$_POST["exam_year"];	 

	echo("<body background=background.gif>");
	 echo("<img src=header_left.gif><br>");

 	 echo("<font size=6><b>EXAMINATIONS $EXAM_YEAR</b></font><br><br>");
 	 echo("<font size=5 color='#003366'><b>Progress Report of Examinations $EXAM_YEAR</b></font><br>");
		echo("<div class='table-responsive'>");			echo("<table class='table  table-bordered   table-hover' ");

	       $TOTAL_NUMBER_OF_EXAMS=0;
       	       $TOTAL_NUMBER_OF_MALE_STUDENTS=0;
	       $TOTAL_NUMBER_OF_FEMALE_STUDENTS=0;
	       $GRANT_TOTAL_STUDENTS=0;
	       $TOTAL_NUMBER_OF_PASS_STUDENTS=0;
	       $TOTAL_NUMBER_OF_FAIL_STUDENTS=0;

	       $sno=0;

	       $query="SELECT DISTINCT TYPE FROM seat_list WHERE  YEAR='$EXAM_YEAR'"; 
       	       $result_seat_list=mysql_query($query);
	       
	        while($row_seat_list=mysql_fetch_object($result_seat_list)){

	           $EXAM_TYPE=$row_seat_list->TYPE;

	           $NUMBER_OF_EXAMS=get_number_of_exams($EXAM_YEAR,$EXAM_TYPE);

	           $NUMBER_OF_MALE_STUDENTS=	     get_number_of_gender_students($EXAM_YEAR,$EXAM_TYPE,"M");
	           $NUMBER_OF_FEMALE_STUDENTS=	     get_number_of_gender_students($EXAM_YEAR,$EXAM_TYPE,"F");
	           $TOTAL_STUDENTS=			     $NUMBER_OF_MALE_STUDENTS + $NUMBER_OF_FEMALE_STUDENTS;
	           $NUMBER_OF_PASS_STUDENTS=	     get_number_of_pass_fail_students($EXAM_YEAR,$EXAM_TYPE,"PASS");
	           $NUMBER_OF_FAIL_STUDENTS=	     $TOTAL_STUDENTS - $NUMBER_OF_PASS_STUDENTS;

	           $TOTAL_NUMBER_OF_EXAMS=		     $TOTAL_NUMBER_OF_EXAMS+		$NUMBER_OF_EXAMS;
	           $TOTAL_NUMBER_OF_MALE_STUDENTS=     $TOTAL_NUMBER_OF_MALE_STUDENTS+	$NUMBER_OF_MALE_STUDENTS;
	           $TOTAL_NUMBER_OF_FEMALE_STUDENTS=$TOTAL_NUMBER_OF_FEMALE_STUDENTS+	$NUMBER_OF_FEMALE_STUDENTS;
	           $GRANT_TOTAL_STUDENTS=		     $GRANT_TOTAL_STUDENTS+		$TOTAL_STUDENTS;
	           $TOTAL_NUMBER_OF_PASS_STUDENTS=     $TOTAL_NUMBER_OF_PASS_STUDENTS+	$NUMBER_OF_PASS_STUDENTS;
	           $TOTAL_NUMBER_OF_FAIL_STUDENTS=       $TOTAL_NUMBER_OF_FAIL_STUDENTS+	$NUMBER_OF_FAIL_STUDENTS;

	     if($sno==0){
		           echo("<TR >");
		           echo("		<TH class='info' style='text-align:center'>S.NO</TH>");
		           echo("		<TH class='info' style='text-align:center'>EXAM. TYPES</TH>");
		           echo("		<TH class='info' style='text-align:center'>NUM. OF EXAMS</TH>");
		           echo("		<TH class='info' style='text-align:center'>NUM. OF STD.</TH>");
		           echo("		<TH class='info' style='text-align:center'>MALE STD.</TH>");
		           echo("		<TH class='info' style='text-align:center'>FEMALE STD.</TH>");
		           echo("		<TH class='info' style='text-align:center'>PASS STD.</TH>");
		           echo("		<TH class='info' style='text-align:center'>FAIL STD.</TH>");
		           echo("</TR>");
                         }//end if

 	     $sno=$sno+1; 

           echo("<TR bgcolor='FFFFEF'>");
           echo("	<TD>$sno</TD>");
           echo("	<TD>".encode_exam_type($EXAM_TYPE)."</TD>");
           echo("	<TD>$NUMBER_OF_EXAMS</TD>");
           echo("	<TD>$TOTAL_STUDENTS</TD>");
           echo("	<TD>$NUMBER_OF_MALE_STUDENTS</TD>");                      
           echo("	<TD>$NUMBER_OF_FEMALE_STUDENTS</TD>");
           echo("	<TD>$NUMBER_OF_PASS_STUDENTS</TD>");
           echo("	<TD>$NUMBER_OF_FAIL_STUDENTS</TD>");
           echo("</TR>");
}//END WHILE


      echo("<TR class='success'>");
      echo("	<TD><B>SUM OF </B></TD>");
      echo("	<TD><B>$sno</B></TD>");
      echo("	<TD><B>$TOTAL_NUMBER_OF_EXAMS</B></TD>");
      echo("	<TD><B>$GRANT_TOTAL_STUDENTS</B></TD>");
      echo("	<TD><B>$TOTAL_NUMBER_OF_MALE_STUDENTS</B></TD>");                          
      echo("	<TD><B>$TOTAL_NUMBER_OF_FEMALE_STUDENTS</B></TD>");
      echo("	<TD><B>$TOTAL_NUMBER_OF_PASS_STUDENTS</B></TD>");
      echo("	<TD><B>$TOTAL_NUMBER_OF_FAIL_STUDENTS</B></TD>");
      echo("</TR>");


      $MALE_STD_PER=	"00%";
      $FEMALE_STD_PER=	"00%";
      $PASS_STD_PER=	"00%";
      $FAIL_STD_PER=	"00%";


      if($TOTAL_NUMBER_OF_MALE_STUDENTS>0)  $MALE_STD_PER=  ($TOTAL_NUMBER_OF_MALE_STUDENTS*100.0/$GRANT_TOTAL_STUDENTS)."%";
      if($TOTAL_NUMBER_OF_FEMALE_STUDENTS>0)$FEMALE_STD_PER=($TOTAL_NUMBER_OF_FEMALE_STUDENTS*100.0/$GRANT_TOTAL_STUDENTS)."%";
      if($TOTAL_NUMBER_OF_PASS_STUDENTS>0)  $PASS_STD_PER=	($TOTAL_NUMBER_OF_PASS_STUDENTS*100.0/$GRANT_TOTAL_STUDENTS)."%";
      if($TOTAL_NUMBER_OF_FAIL_STUDENTS>0)  $FAIL_STD_PER=	($TOTAL_NUMBER_OF_FAIL_STUDENTS*100.0/$GRANT_TOTAL_STUDENTS)."%";

      echo("<TR class='danger'>");
      echo("	<TD COLSPAN=4><B>PERCENTAGE%</B></TD>");
      echo("	<TD><B>$MALE_STD_PER</B></TD>");
      echo("	<TD><B>$FEMALE_STD_PER</B></TD>");
      echo("	<TD><B>$PASS_STD_PER</B></TD>");
      echo("	<TD><B>$FAIL_STD_PER</B></TD>");
      echo("</TR>");

      echo("</TABLE>");
  echo("</div>");
 
      echo("</body>");
?>