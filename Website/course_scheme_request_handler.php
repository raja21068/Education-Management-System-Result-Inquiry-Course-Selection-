 <!-- Basic Page Needs
  ================================================== -->
	    <!-- Basic Page Needs
  ================================================== -->
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" type="image/gif" href="images/animated_favicon1.gif">

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>Course Scheme</title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!--================================================== -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<?php
      include("Database.php");

	$prog_id	  =mysql_real_escape_string($_POST["program_id"]);        
	$scheme_year  =mysql_real_escape_string($_POST["scheme_year"]);
	
	if($prog_id==""){
	
	header("Location: error.html");
	return;
	}
	if($scheme_year==""){
	
	header("Location: error.html");
	return;
	}
	echo("<body>");

      $PROGRAM_TITLE=get_program_name($prog_id);
	echo("<CENTER>");
	//echo("<img src=header_left.gif><br>");
//	echo("<font size=5><b>COURSE SCHEME $scheme_year</b></font><br>");
	//if($PROGRAM_TITLE!=null)echo("<font size=5><b>$PROGRAM_TITLE</b></font><br>");
//	echo("<font size=4><b>UNIVERSITY OF SINDH, JAMSHORO, PAKISTAN</b></font><br>");
	echo("<BR>");
       
echo("<div class='row'>");
echo("");

$query="SELECT SCHEME_ID,DEPT_ID,PROG_ID,YEAR,REMARKS,MIN_MARKS,GROUP_DESC FROM scheme WHERE PROG_ID=$prog_id AND YEAR='$scheme_year'";
//echo($query);
$result_scheme=mysql_query($query);



while($row_scheme=mysql_fetch_object($result_scheme)){       
//echo("<div class='col-md-1'></div>");

echo("<div class='col-md-12'>");
//		echo("<div class='table-responsive'>");
	
		echo("<table class='table  table-bordered table-striped' ");

	$query="SELECT SCHEME_ID,SCHEME_PART,REMARKS FROM scheme_part WHERE SCHEME_ID=$row_scheme->SCHEME_ID";
	$result_scheme_part=mysql_query($query);
	while($row_scheme_part=mysql_fetch_object($result_scheme_part)){

		echo("<tr class='success'>");
		echo("<th colspan='6' style='text-align: center;' class='success' >$row_scheme_part->REMARKS</th>");
		echo("</tr>");

		$query="SELECT SCHEME_ID,SCHEME_PART,SEMESTER,REMARKS FROM scheme_semester WHERE SCHEME_ID=$row_scheme_part->SCHEME_ID AND SCHEME_PART=$row_scheme_part->SCHEME_PART";
		$result_scheme_semester=mysql_query($query);
		while($row_scheme_semester=mysql_fetch_object($result_scheme_semester)){


			echo("<tr class='warning'>");
			echo("<th colspan=6 class='active' style='text-align: center;' class='warning'>".get_semester_decode($row_scheme_semester->SEMESTER)." SEMESTER</th>");
			echo("</tr>");

			echo(" <tr class='info'> ");
			echo("	<th style='text-align:center' >S.NO.</th> ");
			echo("	<th style='text-align:center'>CRS No.</th> ");
			echo("	<th style='text-align:center'>SUBJECTS</th> ");
			echo("	<th style='text-align:center'>C.HR.</th> ");
			echo("	<th style='text-align:center'>MN.MRK</th> ");
			echo("	<th style='text-align:center'>MX.MRK</th> ");
			echo(" </tr> ");

 	            $sno=0;
 			$query="SELECT SCHEME_ID,SCHEME_PART,SEMESTER,COURSE_NO,COURSE_TITLE,CR_HRS,MAX_MARKS,REMARKS,SUBJ_TYPE,IS_CREDITABLE FROM scheme_detail WHERE SCHEME_ID=$row_scheme_semester->SCHEME_ID AND SCHEME_PART=$row_scheme_semester->SCHEME_PART AND SEMESTER=$row_scheme_semester->SEMESTER AND SUBJ_TYPE='G'";          
			//echo($query);
			$result_scheme_detail=mysql_query($query);
			while($row_scheme_detail=mysql_fetch_object($result_scheme_detail)){

                        $CR_HRS=$row_scheme_detail->CR_HRS;
                        if($row_scheme_detail->CR_HRS==0)$CR_HRS="NC";


	                 $sno=$sno+1;
				echo("<tr> ");
				echo("	<tD align=center>$sno</td>");
				echo("	<tD>$row_scheme_detail->COURSE_NO</tD>");
				echo("	<tD>$row_scheme_detail->COURSE_TITLE</tD>");
				echo("	<tD align=right>$CR_HRS</tD>");
				echo("	<tD align=right>$row_scheme->MIN_MARKS</tD>");
				echo("	<tD align=right>$row_scheme_detail->MAX_MARKS</tD>");
				echo("</tr> ");

                  }//end scheme_detail
				  
				  $query="SELECT SCHEME_ID,SCHEME_PART,SEMESTER,COURSE_NO,COURSE_TITLE,CR_HRS,MAX_MARKS FROM ac_scheme_detail WHERE SCHEME_ID=$row_scheme_semester->SCHEME_ID AND SCHEME_PART=$row_scheme_semester->SCHEME_PART AND SEMESTER=$row_scheme_semester->SEMESTER";          
			//echo($query);
			$result_scheme_detail=mysql_query($query);
			$count=mysql_num_rows($result_scheme_detail);
			if($count>0){
					echo("<tr class='warning'>");
			echo("<th colspan=6  style='text-align: center;' class='danger'>ELECTIVE /SPECIALIZATION/ OPTIONAL SUBJECTS</th>");
			echo("</tr>");
			while($row_scheme_detail=mysql_fetch_object($result_scheme_detail)){

                        $CR_HRS=$row_scheme_detail->CR_HRS;
                        if($row_scheme_detail->CR_HRS==0)$CR_HRS="NC";


	                 //$sno=$sno+1;
				echo("<tr> ");
				echo("	<tD align=center></td>");
				echo("	<tD>$row_scheme_detail->COURSE_NO</tD>");
				echo("	<tD>$row_scheme_detail->COURSE_TITLE</tD>");
				echo("	<tD align=right>$CR_HRS</tD>");
				echo("	<tD align=right>$row_scheme->MIN_MARKS</tD>");
				echo("	<tD align=right>$row_scheme_detail->MAX_MARKS</tD>");
				echo("</tr> ");

			}}//end scheme_detail
            }//end scheme_semester
       }//end scheme_part
 
}//end scheme
   echo("</table>");
	echo("</div>");
	
	echo("</div>");
	echo("</div>");
	
echo("<br>");
//echo("<img src=department_logo.gif>");
echo("</CENTER>");
	echo("</body>");
?>