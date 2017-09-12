 <!-- Fevicon
================================================== -->
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" type="image/gif" href="images/animated_favicon1.gif">

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>Marksheet</title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<?php
      include("Database.php");

	$roll_no		=mysql_real_escape_string($_POST["roll_no"]);        
	$part		=mysql_real_escape_string($_POST["part"]);        
//	$roll_no = str_replace('-', '/', $roll_no);
	if($roll_no==""){
	
	header("Location: error.html");
	return;
	}
	if($part==""){
	
	header("Location: error.html");
	return;
	}
	?>
          <?php       $sl_id=null;

	$query=" SELECT batch.BATCH_ID FROM batch,student_registration ".
	" WHERE ".
	" student_registration.BATCH_ID=batch.BATCH_ID AND ".
	" student_registration.ROLL_NO='$roll_no' ";
	
	
	$result_BATCH=mysql_query($query);

                 $batch_id=null;
	while($row_BATCH=mysql_fetch_object($result_BATCH))  {
	        $batch_id=$row_BATCH->BATCH_ID;  

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

	       	                 echo("<HR>");

 			$scheme_id=get_scheme_id($sl_id); 
			if($scheme_id==null){
         				echo("<h2>Result is in progress.....</h2>");
         				echo("<h3>Please wiat some days.....</h3>");
         				return;
			}
      display_marks_certificate($sl_id,$roll_no,$part,$scheme_id,$batch_id,$exam_year, $exam_type);    
      echo("<HR>");
  }//end while
  
}//end batch

  if($sl_id==null){
         echo("<h2>[$roll_no] does not appeared Examination $exam_year.</h2>");
         echo("<h3>Wrong Exam.Year $exam_year selected......</h3>");
         return;
   }

	if($batch_id==null){
         echo("<h2>Wrong Roll No. entered [$roll_no]......</h2>");
         echo("<h3>Please verify program......</h3>");
         return;
	}


	echo("</body>");

?>