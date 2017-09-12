<?php
      include '../Database.php';
	$dept_id		=$_POST["dept_id"];        
	$exam_year	=$_POST["exam_year"];

	echo("<body background=background.gif>");

	echo("<img src=header_left.gif><br>");

      $DEPT_NAME=get_department_name($dept_id);

	if($DEPT_NAME!=null)echo("<font size=6 color='#006666'><b>$DEPT_NAME</b></font><br>");
	echo("<font size=5  color='#003366'><b>RESULT ANNOUNCED EXAMINATION $exam_year</b></font><br>");

$announced_programs="<ol>";
$not_announced_programs="<ol>";
$is_ann=0;
$is_not_ann=0;

      $query="select PROG_ID, DEPT_ID, PROGRAM_TITLE, SEM_DURATION, SEM_PER_PART, REMARKS from PROGRAM where dept_id=$dept_id order by PROGRAM_TITLE";
      $result_program=mysql_query($query);
 
     while($row_program=mysql_fetch_object($result_program)){
       	$prog_id=$row_program->PROG_ID;     

	      $query="select BATCH_ID,PROG_ID,DEPT_ID,YEAR, SHIFT,REMARKS,GROUP_DESC FROM BATCH WHERE PROG_ID=$prog_id and dept_id=$dept_id";
	      $result_batch=mysql_query($query);
	      while($row_batch=mysql_fetch_object($result_batch)){
	       	$batch_id=$row_batch->BATCH_ID;
           
		      $query="select PART, BATCH_ID,REMARKS,YEAR FROM PART where batch_id=$batch_id order by PART";
		      $result_part=mysql_query($query);
		      while($row_part=mysql_fetch_object($result_part)){
		       	$part=$row_part->PART;


			      $query="select SL.SL_ID, SL.PART,SL.BATCH_ID,SL.PREP_DATE,SL.YEAR,SL.REMARKS,SL.PART_GROUP,SL.TYPE from SEAT_LIST SL, LEDGER L WHERE SL.BATCH_ID=$batch_id and SL.PART=$part and SL.year='$exam_year' AND SL.SL_ID=L.SL_ID AND SL.PART=L.SCHEME_PART AND L.IS_ANNOUNCED='Y'";
			      $result_seat_list=mysql_query($query);
			      while($row_seat_list=mysql_fetch_object($result_seat_list)){

					$is_ann=1;
	                        $PROGRAM_TITLE=$row_program->PROGRAM_TITLE;
	                        $PROG_ID=$row_program->PROG_ID;
	                        $PART=$row_part->PART;
	                        $TYPE=$row_seat_list->TYPE;
	                        $EXAM_YEAR=$row_seat_list->YEAR;
	                        $SL_ID=$row_seat_list->SL_ID;
	                        $BATCH_YEAR=get_batch_year_encode($row_batch->YEAR);
	                        $SHIFT=$row_batch->SHIFT;
	                        $BATCH_ID=$row_batch->BATCH_ID;
	                        $GROUP_DESC=$row_batch->GROUP_DESC;                        
      	                  $PART_REMARKS=$row_part->REMARKS;

					$program_ann="$PART_REMARKS <FONT COLOR=red>".encode_exam_type($TYPE)."</FONT> <FONT COLOR=black> BATCH ($BATCH_YEAR)</FONT>";

					if(strstr($SHIFT,"E")=="E" &&  strstr($PART_REMARKS,"EVENING")==null)$program_ann="$program_ann <FONT COLOR=brown>".get_shift_encode($SHIFT)."</FONT>";
					if($GROUP_DESC!=null && $GROUP_DESC!="GNRL") $program_ann="$program_ann <FONT COLOR=GREEN>".get_batch_group_encode($GROUP_DESC)."</FONT>";

                              $announced_programs=$announced_programs."<li><a href=ledger_summary.php?sl_id=$SL_ID&part=$PART&batch_id=$BATCH_ID&exam_year=$EXAM_YEAR&exam_type=$TYPE&prog_name=".urlencode($program_ann) ."><b>$program_ann</b></a>";
					//echo("<li><a href=ledger_summary.php?sl_id=$SL_ID&part=$PART&batch_id=$BATCH_ID&exam_year=$EXAM_YEAR&exam_type=$TYPE&prog_name=".urlencode($program_ann) ."><b>$program_ann</b></a>");
                        }//END SEAT LIST

			      $query="select SL.SL_ID, SL.PART,SL.BATCH_ID,SL.PREP_DATE,SL.YEAR,SL.REMARKS,SL.PART_GROUP,SL.TYPE from SEAT_LIST SL, LEDGER L WHERE SL.BATCH_ID=$batch_id and SL.PART=$part and SL.year='$exam_year' AND SL.SL_ID=L.SL_ID AND SL.PART=L.SCHEME_PART AND (L.IS_ANNOUNCED='N' OR L.IS_ANNOUNCED=NULL)";
			      $result_seat_list=mysql_query($query);
			      while($row_seat_list=mysql_fetch_object($result_seat_list)){

					$is_not_ann=1;
	                        $PROGRAM_TITLE=$row_program->PROGRAM_TITLE;
	                        $PROG_ID=$row_program->PROG_ID;
	                        $PART=$row_part->PART;
	                        $TYPE=$row_seat_list->TYPE;
	                        $EXAM_YEAR=$row_seat_list->YEAR;
	                        $SL_ID=$row_seat_list->SL_ID;
	                        $BATCH_YEAR=get_batch_year_encode($row_batch->YEAR);
	                        $SHIFT=$row_batch->SHIFT;
	                        $BATCH_ID=$row_batch->BATCH_ID;
	                        $GROUP_DESC=$row_batch->GROUP_DESC;                        
      	                  $PART_REMARKS=$row_part->REMARKS;

					$program_ann="$PART_REMARKS <FONT COLOR=red>".encode_exam_type($TYPE)."</FONT> <FONT COLOR=black> BATCH ($BATCH_YEAR)</FONT>";

					if(strstr($SHIFT,"E")=="E" &&  strstr($PART_REMARKS,"EVENING")==null)$program_ann="$program_ann <FONT COLOR=brown>".get_shift_encode($SHIFT)."</FONT>";
					if($GROUP_DESC!=null && $GROUP_DESC!="GNRL") $program_ann="$program_ann <FONT COLOR=GREEN>".get_batch_group_encode($GROUP_DESC)."</FONT>";

                              $not_announced_programs=$not_announced_programs."<li><a href=ledger_summary.php?sl_id=$SL_ID&part=$PART&batch_id=$BATCH_ID&exam_year=$EXAM_YEAR&exam_type=$TYPE&prog_name=".urlencode($program_ann) ."><b>$program_ann</b></a>";
                        }//END SEAT LIST
           }//END PART
          }//END BATCH
        }//END PROG.


    $announced_programs=$announced_programs."</ol>";
    $not_announced_programs=$not_announced_programs."</ol>";

    if($is_ann);
        echo($announced_programs);

if($is_not_ann){
    echo("<h3>IN PROGRESS (still not announced due to guenon reasons)</h3>");
    echo($not_announced_programs);
}
echo("<br>");
echo("<img src=department_logo.gif>");

echo("</body>");

?>