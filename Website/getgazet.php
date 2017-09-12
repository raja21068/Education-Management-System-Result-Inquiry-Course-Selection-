<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<?php
  $mysql_hostname = "localhost";
 
	$mysql_user = "root";
  	$mysql_password = "";
    	$mysql_database = "exam";

  $link = mysqli_connect($mysql_hostname, $mysql_user, $mysql_password, $mysql_database) or die("<h2>Error connecting with database...!</h2>");

			$rollNo=$_REQUEST['rollNo'];
					   ?> 
						
					<?php
						echo("<div class='col-md-4'></div>");

						echo("<div class='col-md-6'>");
					
						echo("<table class='table  table-bordered table-striped' ");
						
						$count=0;
			$query_student="SELECT srn.NAME FROM `student_registration` AS srn WHERE srn.`ROLL_NO` = '$rollNo'";
                      echo($query_student);
	   $result_student=mysqli_query($link,$query_student);
					
      while($row_student=mysqli_fetch_array($result_student)){
       	$name=$row_student['NAME'];
	 	getGazet($rollNo,$name, $link);
	  }
	  
	function getGazet($rollNo,$name, $link){
		  echo("<table class='table  table-bordered table-striped' ");
		 $query=" SELECT sl.`BATCH_ID`, sl.`PART`, CONCAT (sl.`YEAR`,' ',sl.`REMARKS`) AS YEAR,
				leg.`ANN_DATE`,
				sr.NAME,
				sr.FNAME,
				sr.SURNAME ,
				FORMAT(lds.CGPA,2) AS CGPA,
				lds.OBTAIN_MARKS,
				FORMAT(lds.PERCENTAGE,2) AS PERCENTAGE,
				lds.ROLL_NO,
				lds.TOTAL_MARKS ,
				lds.`RESULT_REMARKS`,
				(SELECT pr.remarks FROM part AS pr WHERE pr.`batch_id` = sl.`BATCH_ID` ORDER BY pr.part DESC LIMIT 0,1)  AS DEGREE_PROGRAM
				FROM ledger_detail_summary AS lds
				INNER JOIN `ledger` AS leg ON leg.`SL_ID`= lds.`SL_ID` AND IS_ANNOUNCED = 'Y'
				INNER JOIN `seat_list` AS sl ON leg.`SL_ID`= sl.`SL_ID` AND sl.`PART` = leg.`SCHEME_PART` 
				INNER JOIN `student_registration` AS sr ON  sr.`BATCH_ID` = sl.`BATCH_ID` 
				WHERE lds.`ROLL_NO`='$rollNo' AND sr.`NAME` = '$name'  ORDER BY sl.`PART` DESC
				LIMIT 0,1";
				
		       $result=mysqli_query($link,$query);
      
						
						
						$count=0;
						
						while($row = mysqli_fetch_array($result)){
						$count++;
						$name=$row['NAME'];
						$fname=$row['FNAME'];
						$surname=$row['SURNAME'];
						$program_part=$row['DEGREE_PROGRAM'];
						$exam_year=$row['YEAR'];
						$cgpa=$row['CGPA'];
						$percentage=$row['PERCENTAGE'];
						$announcement_date=$row['ANN_DATE'];
						//$total_semesters=$row['total_semesters'];
						//$semester_per_part=$row['semester_per_part'];
						//$year_of_education=$row['year_of_education'];
						//$semester_month=$row['semester-month'];
						$result_remarks=$row['RESULT_REMARKS'];
						
					
							echo("<TR>");
						echo("<Td>ROLL NO:</Td>");
						echo("<Td>$rollNo</Td>");
						echo("</TR>");
						echo("<TR>");
						echo("<Td>Name</Td>");
						echo("<Td>$name</Td>");
						echo("</TR>");
						
						echo("<TR>");
						echo("<Td>Father<span>'<span>s Name</Td>");
						echo("<Td>$fname</Td>");
						echo("</TR>");
						
						echo("<TR>");
						echo("<Td>Surname</Td>");
						echo("<Td>$surname</Td>");
						echo("</TR>");
						
						echo("<TR>");
						echo("<Td>Degree Program</Td>");
						echo("<Td>$program_part</Td>");
						echo("</TR>");
						
						echo("<TR>");
						echo("<Td>Exam Year</Td>");
						echo("<Td>$exam_year</Td>");
						echo("</TR>");
						
						echo("<TR>");
						echo("<Td>CGPA</Td>");
						echo("<Td>$cgpa</Td>");
						echo("</TR>");
						
						echo("<TR>");
						echo("<Td>Percentage</Td>");
						echo("<Td>$percentage</Td>");
					
						echo("</TR>");
						
						echo("<TR>");
						echo("<Td>Announcement Date</Td>");
						echo("<Td>$announcement_date</Td>");
						echo("</TR>");
						
					//	echo("<TR>");
						//echo("<Td>Total Semesters</Td>");
					//	echo("<Td>$total_semesters</Td>");
					
						//echo("</TR>");
						
						
						//echo("<TR>");
						//echo("<Td>Semester per Year</Td>");
						//echo("<Td>$semester_per_part</Td>");
				
						//echo("</TR>");
						
						echo("<TR>");
						echo("<Td>Result</Td>");
						echo("<Td>$result_remarks</Td>");
			
						echo("</TR>");
						echo("</TABLE>");
					
	  } // end while
	 }//end function
				echo("</TABLE>");
				echo("</DIV>");
				echo("</DIV>");
				
						
						?>

                       