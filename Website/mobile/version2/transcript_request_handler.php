<?php
      include("Database1.php");
      

	$roll_no 	=$_REQUEST["roll_no"];        
	$part		=$_REQUEST["part"];        
	$cell_no	=$_REQUEST["cellno"];

		//$roll_no = '2K11/CSM/25';
      		//$part = '1';
		//$cell_no="03332836705";
                 $sl_id=null;
                 
		
		
		$query="SELECT COUNT(log_id) AS log FROM log_numbers WHERE  rec_date=  '".date("Y-m-d")."'  AND  mobile_number ='$cell_no'";
		//echo($query); 
		$result_COUNT=mysql_query($query);
		$check=mysql_fetch_object($result_COUNT);
		$logcount=$check->log;
		if($logcount>4){
			
			return;
		}
		if($logcount==4){
		$response["MSG"] ="SMS limit to 3 per day per SIM";
		$response["CELL_NO"] =$cell_no;
		echo json_encode($response);
		mysql_query("INSERT INTO log_numbers (mobile_number, roll_no, rec_date) VALUES ('$cell_no', '$roll_no','".date("Y-m-d")."') ");

		return;
		}

		
	$query=" SELECT batch.BATCH_ID FROM batch,student_registration ".
	" WHERE ".
	" student_registration.BATCH_ID=batch.BATCH_ID AND ".
	" student_registration.ROLL_NO='$roll_no' ";
	
	$result_BATCH=mysql_query($query);

                 $batch_id=null;
		
				$index=0;
				$msg="";
	while($row_BATCH=mysql_fetch_object($result_BATCH))  {
	        $batch_id=$row_BATCH->BATCH_ID;
	        $query=" SELECT seat_list.SL_ID,seat_list.TYPE,seat_list.YEAR  FROM seat_list,seat_list_detail ".
		 " where ".
		 " seat_list.part=$part AND ".
		 " seat_list.batch_id=$batch_id AND ".
		 " seat_list_detail.ROLL_NO='$roll_no' AND ".
		 " seat_list.SL_ID=seat_list_detail.SL_ID AND ".
		 " seat_list.PART=seat_list_detail.PART AND ".
		 " seat_list.PART=seat_list_detail.PART AND ".
		 " seat_list.BATCH_ID=seat_list_detail.BATCH_ID ORDER BY seat_list.YEAR DESC";

		$result=mysql_query($query);

		 if($row=mysql_fetch_object($result)){
			$sl_id=$row->SL_ID;  
			$exam_type=$row->TYPE;
			$exam_year=$row->YEAR;			
			//echo($sl_id);
	       	                
 			$scheme_id=get_scheme_id($sl_id); 
			if($scheme_id==null){
			    		  //$response["CELL_NO"] =$cell_no;
                       //   $response["MESSAGE"] ="[$roll_no] does not appeared Examination $exam_year";
                        //  $response["status"]="ERROR";
                         // $response["MESSAGE1"] ="Wrong Exam.Year $exam_year selected.....";
                          // echo json_encode($response);
						  return;
			}
      $display_marks_certificate=display_marks_certificate($sl_id,$roll_no,$part,$scheme_id,$batch_id,$exam_year, $exam_type,$cell_no);    
		$msg.=$display_marks_certificate;
			//$response[$index]["display_marks_certificate"] =$display_marks_certificate;
		//$response["display_marks_certificate"] =$display_marks_certificate;
		//$response["display_marks_certificate"] =$display_marks_certificate;
		$index++;
  }//end while
}//end batch
					//$response["display_marks_certificate"] =$display_marks_certificate;
					$response["MSG"] =$msg;
			       		$response["CELL_NO"] =$cell_no;
					echo json_encode($response);
			mysql_query("INSERT INTO log_numbers (mobile_number, roll_no, rec_date) VALUES ('$cell_no', '$roll_no','".date("Y-m-d")."') ");

           
  if($sl_id==null){
 //        echo("<h2>[$roll_no] does not appeared Examination $exam_year.</h2>");
   //      echo("<h3>Wrong Exam.Year $exam_year selected......</h3>");
         return;
   }

	if($batch_id==null){
                    $response["CELL_NO"] =$cell_no;
                   $response["MESSAGE"] ="Wrong Roll No. entered [$roll_no]......";
                   $response["status"]="ERROR";       
                    //$response["MESSAGE1"] ="Please verify program......";
                    echo json_encode($response);
           
         return;
	}

      
	
?>