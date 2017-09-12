<?php
      include 'Database.php';
	$dept_id		=mysql_real_escape_string($_REQUEST["dept_id"]);        
	$exam_year	=mysql_real_escape_string($_REQUEST["exam_year"]);
	$semester=mysql_real_escape_string($_REQUEST['semester']);
	//$course_no = mysql_real_escape_string($_REQUEST['courseNo']);
	$program_id=mysql_real_escape_string($_REQUEST['program_id']);
	//echo($program_id);
	//echo($dept_id);
	$part1=0;
	
	if($semester==1||$semester==2){
	$part1=1;
	}elseif($semester==3 || $semester==4){
	$part1=2;
	}elseif($semester==5 || $semester==6){
	$part1=3;
	}elseif($semester==7 || $semester==8){
	$part1=4;}
	
	
	
      
$announced_programs="";
$not_announced_programs="";
$is_ann=0;
$is_not_ann=0;

		
	      $query="select BATCH_ID,PROG_ID,DEPT_ID,YEAR, SHIFT,REMARKS,GROUP_DESC FROM batch WHERE PROG_ID=$program_id and dept_id=$dept_id";
		//  echo($query);
			echo("<option value=''>select batch</option>");
				
	      $result_batch=mysql_query($query);
	      while($row_batch=mysql_fetch_object($result_batch)){
	       	$batch_id=$row_batch->BATCH_ID;
           
		      $query="select PART, BATCH_ID,REMARKS,YEAR FROM part where batch_id=$batch_id and PART=$part1 order by PART";
		      $result_part=mysql_query($query);
			  		
		      while($row_part=mysql_fetch_object($result_part)){
		       	$part=$row_part->PART;

			      $query="select SL.SL_ID, SL.PART,SL.BATCH_ID,SL.PREP_DATE,SL.YEAR,SL.REMARKS,SL.PART_GROUP,SL.TYPE from seat_list SL, ledger L WHERE SL.BATCH_ID=$batch_id and SL.PART=$part and SL.year='$exam_year' AND SL.SL_ID=L.SL_ID AND SL.PART=L.SCHEME_PART";
			      $result_seat_list=mysql_query($query);
				  //echo($query);
			      while($row_seat_list=mysql_fetch_object($result_seat_list)){

					$is_ann=1;
	                        $PROGRAM_TITLE=$row_program->PROGRAM_TITLE;
	                        $PROG_ID=$row_program->PROG_ID;
	                        $PART=$row_part->PART;
	                        $TYPE=$row_seat_list->TYPE;
	                        $EXAM_YEAR=$row_seat_list->YEAR;
	                        $SL_ID=$row_seat_list->SL_ID;
	                      //  $BATCH_YEAR=get_batch_year_encode($row_batch->YEAR);
							  $BATCH_YEAR=$row_batch->YEAR;
							
	                        $SHIFT=$row_batch->SHIFT;
	                        $BATCH_ID=$row_batch->BATCH_ID;
	                        $GROUP_DESC=$row_batch->GROUP_DESC;                        
							$PART_REMARKS=$row_part->REMARKS;
							$program_ann="BATCH ($BATCH_YEAR)";
					//$program_ann="<FONT COLOR=red>".encode_exam_type($TYPE)."</FONT> <FONT COLOR=black> BATCH ($BATCH_YEAR)</FONT>";

					
					if(strstr($SHIFT,"E")=="E" &&  strstr($PART_REMARKS,"EVENING")==null)$program_ann="$program_ann ".get_shift_encode($SHIFT)."";
					if($GROUP_DESC!=null && $GROUP_DESC!="GNRL") $program_ann="$program_ann ".get_batch_group_encode($GROUP_DESC)."";
							echo("<option value='$SL_ID~$BATCH_YEAR'>$program_ann".encode_exam_type($TYPE)." </option>");
					
				
                        }//END SEAT LIST

			   
           }//END PART
          }//END BATCH
       // }//END PROG.



    
?>