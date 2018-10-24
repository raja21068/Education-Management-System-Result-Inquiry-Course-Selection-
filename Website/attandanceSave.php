<?php

 include("Database.php");
 require_once("conn_attendance.php");
							
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
	
	if($no_of_classes == "" || $no_of_classes == null){
	    
	    die('Please type number of classes (if 0 complete attendance record will be erased of your selected course and date )');
	}

        $queryChecktotalClasses = "SELECT TOTAL_CLASS FROM attandance WHERE COURSE_DISTRIBUTION_ID=$course_distribution_id AND DATE_OF_ATTANDANCE = '".$date_of_attandance."' LIMIT 1 ";
	
	//echo $queryChecktotalClasses;
	
	    $resultCheckTotalClasses = $db->query($queryChecktotalClasses);
	    
	
	   if($resultCheckTotalClasses->num_rows){
	        
	
	 $rowsCheckTotalClasses = $resultCheckTotalClasses->fetch_assoc();
	    
	    
	    //echo $rowsCheckTotalClasses['TOTAL_CLASS'];        	    
	    
	    
	    if($no_of_classes < $rowsCheckTotalClasses['TOTAL_CLASS']){
	    
	    $total_class = $rowsCheckTotalClasses['TOTAL_CLASS'];
	    
	    if($no_of_classes == 0){
	    
	    $deleteQuery = "DELETE FROM attandance WHERE COURSE_DISTRIBUTION_ID =$course_distribution_id AND DATE_OF_ATTANDANCE='$date_of_attandance'";
	    
	    $resultDelete = $db->query($deleteQuery);
	        
	        if($resultDelete){
	            
	            die('Attendance record of this Course NO: '.$COURSE_NO.' and  Date: '.$date_of_attandance.' successfully deleted.');
	        }
	        
	    }else{
	        
	        $remainingClass = $total_class-$no_of_classes;
	             
	             //print_r($ROLL_NO);
	             
	            $num = sizeOf($ROLL_NO);
	            
	            for ($i = 0; $i < $num; $i++) {
	                
	                //echo $ROLL_NO[$i];
	                
	            $queryAttendanceDelete = "DELETE FROM `attandance` WHERE `ROLL_NO`='$ROLL_NO[$i]' AND `COURSE_DISTRIBUTION_ID` =$course_distribution_id AND `DATE_OF_ATTANDANCE` = '".$date_of_attandance."' LIMIT $remainingClass";
	            
	           // echo $queryAttendanceDelete;
	            
	                $resultAttendanceDelete = $db->query($queryAttendanceDelete);
	            }
	            
	            if($resultAttendanceDelete){
	                
	                $queryUpdateNumClass = "UPDATE attandance SET TOTAL_CLASS =$no_of_classes WHERE `COURSE_DISTRIBUTION_ID` =$course_distribution_id AND `DATE_OF_ATTANDANCE` = '".$date_of_attandance."'";
	            
	               $resultUpdateNumClass = $db->query($queryUpdateNumClass);
	               
	               if($resultUpdateNumClass){
	                   
	                   die("Total Class: ".$remainingClass." of this Course No: ".$COURSE_NO." DATED: ".$date_of_attandance." successfully updated.");
	               }
	                
	            }
	        
	    
	        
	    }
	    //die('Sorry you can not decrease no of classes as of previously entered..!');
	    
	    
	        }
	        else
	        {
	            
	    $total_class = $no_of_classes;         
	       
	        }
	    
	    	$num = sizeOf($ROLL_NO);
	for ($j = 0; $j <$total_class; $j++) {
		
		for ($i = 0; $i < $num; $i++) {
		    
		    if($j>=$rowsCheckTotalClasses['TOTAL_CLASS'])
		    {
		        
		 $queryInsert="INSERT INTO attandance (TOTAL_CLASS,COURSE_DISTRIBUTION_ID,ROLL_NO,COURSE_NO,DATE_OF_ATTANDANCE,NO_OF_CLASSES,ISPRESENT,SCHEME_ID,SEMESTER,DEPT_ID,PROG_ID,SHIFT,GROUP_DESC,YEAR) VALUES($total_class,$course_distribution_id,'$ROLL_NO[$i]','$COURSE_NO','$date_of_attandance',1,$present[$i],$SCHEME_ID,$SEMESTER,$DEPT_ID,$PROG_ID,'$SHIFT','$GROUP_DESC',$YEAR)";
		  //echo($queryInsert);
		  $result=mysql_query($queryInsert);
		        
		    }else{
		     
		  $queryUpdate="UPDATE attandance SET TOTAL_CLASS=$total_class,NO_OF_CLASSES=1,ISPRESENT=$present[$i] WHERE COURSE_DISTRIBUTION_ID =$course_distribution_id AND ROLL_NO ='$ROLL_NO[$i]' AND DATE_OF_ATTANDANCE='$date_of_attandance'";
	//	  echo($queryUpdate);
		  $result=mysql_query($queryUpdate);
		  //$this->course_distribution_model->updateCourseDistribution($COURSE_NO[$i],$NAME1[$i],$SCHEME_ID,$PASS[$i],$REMARKS[$i]);
		    }
		}
	}	
		echo("Successfully Updated...");
		
	    
	    }
	    else
	    {
	        
	    
	    

	//echo($present[1]);
	$num = sizeOf($ROLL_NO);
	for ($j = 0; $j <$no_of_classes; $j++) {
		
		for ($i = 0; $i < $num; $i++) {
		    
		    
		    
			
		  
		  $queryInsert="INSERT INTO attandance (TOTAL_CLASS,COURSE_DISTRIBUTION_ID,ROLL_NO,COURSE_NO,DATE_OF_ATTANDANCE,NO_OF_CLASSES,ISPRESENT,SCHEME_ID,SEMESTER,DEPT_ID,PROG_ID,SHIFT,GROUP_DESC,YEAR) VALUES($no_of_classes,$course_distribution_id,'$ROLL_NO[$i]','$COURSE_NO','$date_of_attandance',1,$present[$i],$SCHEME_ID,$SEMESTER,$DEPT_ID,$PROG_ID,'$SHIFT','$GROUP_DESC',$YEAR)";
		  //echo($queryInsert);
		  $result=mysql_query($queryInsert);
		  //$this->course_distribution_model->updateCourseDistribution($COURSE_NO[$i],$NAME1[$i],$SCHEME_ID,$PASS[$i],$REMARKS[$i]);
		
		}
	}	
		echo("Successfully Saved...");
		
	    }
		
		
		
?>