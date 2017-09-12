<?php
      include '../Database.php';
	$dept_id		=$_REQUEST["depId"];        
	$exam_year	=$_REQUEST["exam_year"];
	$semester=$_REQUEST['semester'];
	$course_no = $_REQUEST['courseNo'];
	$program_id=$_REQUEST['program_id'];
	$part1=0;
	
	if($semester==1||$semester==2){
	$part1=1;
	}elseif($semester==3 || $semester==4){
	$part1=2;
	}elseif($semester==5 || $semester==6){
	$part1=3;
	}elseif($semester==7 || $semester==8){
	$part1=4;}
	
	

    //  $DEPT_NAME=get_department_name($dept_id);

	//if($DEPT_NAME!=null)echo("<font size=6 color='#006666'><b>$DEPT_NAME</b></font><br>");
	//echo("<font size=5  color='#003366'><b>RESULT ANNOUNCED EXAMINATION $exam_year</b></font><br>");

$announced_programs="";
$not_announced_programs="";
$is_ann=0;
$is_not_ann=0;
$prog="";


	      $query="select BATCH_ID,PROG_ID,DEPT_ID,YEAR, SHIFT,REMARKS,GROUP_DESC FROM batch WHERE PROG_ID=$program_id and dept_id=$dept_id";
		 // echo($query);
	      $result_batch=mysql_query($query);
	      while($row_batch=mysql_fetch_object($result_batch)){
	       	$batch_id=$row_batch->BATCH_ID;
           
		      //$query="select PART, BATCH_ID,REMARKS,YEAR FROM part where batch_id=$batch_id and PART=$part1 order by PART";
		      //$result_part=mysql_query($query);
		     // while($row_part=mysql_fetch_object($result_part)){
		       //	$part=$row_part->PART;
			//	$PART_REMARKS1=$row_part->REMARKS;
				  //select SL.SL_ID, SL.PART,SL.BATCH_ID,SL.PREP_DATE,SL.YEAR,SL.REMARKS,SL.PART_GROUP,SL.TYPE from seat_list SL, ledger L WHERE SL.BATCH_ID=$batch_id and SL.PART=$part and SL.year='$exam_year' AND SL.SL_ID=L.SL_ID AND SL.PART=L.SCHEME_PART"
				  $query="SELECT SL.SL_ID, SL.PART,SL.BATCH_ID,SL.PREP_DATE,SL.YEAR AS SEAT_LIST_YEAR,SL.REMARKS AS SEAT_LIST_REMARKS,SL.PART_GROUP,SL.TYPE,P.`REMARKS` AS PART_REMARKS
FROM seat_list SL, ledger L , `part` P ,`ledger_details` LD
WHERE SL.BATCH_ID=$batch_id 
AND SL.PART=$part1 
AND SL.year=$exam_year
AND SL.SL_ID=L.SL_ID 
AND P.`BATCH_ID`=SL.BATCH_ID
 AND LD.`COURSE_NO`='$course_no'
  AND LD.`SL_ID`=L.`SL_ID`
  AND L.`SCHEME_ID`=LD.`SCHEME_ID`"
;

			      
				$result_seat_list=mysql_query($query);
			     if($row_seat_list=mysql_fetch_object($result_seat_list)){
				
					$is_not_ann=1;
	                       // $PROGRAM_TITLE=$row_program->PROGRAM_TITLE;
	                       // $PROG_ID=$row_program->PROG_ID;
	                        $PART=$row_seat_list->PART;
	                        $TYPE=$row_seat_list->TYPE;
	                        $EXAM_YEAR=$row_seat_list->SEAT_LIST_YEAR;
	                        $SL_ID=$row_seat_list->SL_ID;
	                        $BATCH_YEAR=get_batch_year_encode($row_batch->YEAR);
	                        $SHIFT=$row_batch->SHIFT;
	                        $BATCH_ID=$row_batch->BATCH_ID;
	                        $GROUP_DESC=$row_batch->GROUP_DESC;                        
							$PART_REMARKS=$row_seat_list->PART_REMARKS;
							
					
					$program_ann=("".encode_exam_type($TYPE)." BATCH ($BATCH_YEAR)");

					if(strstr($SHIFT,"E")=="E" &&  strstr($PART_REMARKS,"EVENING")==null)$program_ann="$program_ann ".get_shift_encode($SHIFT)."";
					if($GROUP_DESC!=null && $GROUP_DESC!="GNRL") $program_ann="$program_ann ".get_batch_group_encode($GROUP_DESC)."";

					$announced_programs=$announced_programs."$program_ann";
					
				echo("<option value='$SL_ID'>$PART_REMARKS $program_ann</option>");
//				echo("<option value='$SL_ID'>$query</option>");
					// <a href=code.php?sl_id=$SL_ID&course_no=$course_no&semester=$semester&part=$PART&batch_id=$BATCH_ID&exam_year=$EXAM_YEAR&exam_type=$TYPE&prog_name=".urlencode("$PART_REMARKS "."$program_ann"."<FONT COLOR=red>".encode_exam_type($TYPE)) .">
					

					
				
					                        }//END SEAT LIST
          // }//END PART
          }//END BATCH
	
			
		
						
							
          //echo($announced_programs);
 
?>