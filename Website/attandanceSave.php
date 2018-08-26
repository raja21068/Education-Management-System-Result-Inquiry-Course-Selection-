<?php

 include("Database.php");
							
	$course_distribution_id	=($_REQUEST["course_distribution_id"]);
	$COURSE_NO	=($_REQUEST["COURSE_NO"]);
	$ROLL_NO	=($_REQUEST["ROLL_NO"]);
	$date_of_attandance	=($_REQUEST["date_of_attandance"]);
	$no_of_classes	=($_REQUEST["no_of_classes"]);
	$SCHEME_ID=($_REQUEST["SCHEME_ID"]);
	$SEMESTER=($_REQUEST["SEMESTER"]);
	$DEPT_ID=($_REQUEST["DEPT_ID"]);
	$PROG_ID=($_REQUEST["PROG_ID"]);
	$SHIFT=($_REQUEST["SHIFT"]);
	$GROUP_DESC=($_REQUEST["GROUP_DESC"]);
	$YEAR=($_REQUEST["YEAR"]);
	$present=($_REQUEST["present"]);
	

	
	echo($present[1]);
	$num = sizeOf($ROLL_NO);
	for ($j = 0; $j <$no_of_classes; $j++) {
		
		for ($i = 0; $i < $num; $i++) {
			
		  
		  $queryInsert="INSERT INTO attandance (COURSE_DISTRIBUTION_ID,ROLL_NO,COURSE_NO,DATE_OF_ATTANDANCE,NO_OF_CLASSES,ISPRESENT,SCHEME_ID,SEMESTER,DEPT_ID,PROG_ID,SHIFT,GROUP_DESC,YEAR) VALUES($course_distribution_id,'$ROLL_NO[$i]','$COURSE_NO','$date_of_attandance',1,$present[$i],$SCHEME_ID,$SEMESTER,$DEPT_ID,$PROG_ID,'$SHIFT','$GROUP_DESC',$YEAR)";
		  //echo($queryInsert);
		  $result=mysql_query($queryInsert);
		  //$this->course_distribution_model->updateCourseDistribution($COURSE_NO[$i],$NAME1[$i],$SCHEME_ID,$PASS[$i],$REMARKS[$i]);
		
		}
	}	
		echo("Save Sucessfully..");
		
		
		
?>