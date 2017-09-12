 <!-- Fevicon
================================================== -->
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" type="image/gif" href="images/animated_favicon1.gif">

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>View Announments</title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<?php
    
      include './Database.php';
	$dept_id=mysql_real_escape_string($_POST["dept_id"]);        
	$exam_year=mysql_real_escape_string($_POST["exam_year"]);
	if($dept_id==""){
	header("Location: error.html");
	return;
	}
	if($exam_year==""){
	header("Location: error.html");
	return;
	}
	echo("<body>");
  echo("<center>");
	//echo("<img src=header_left.gif><br>");

      $DEPT_NAME=get_department_name($dept_id);

	if($DEPT_NAME!=null)echo("<font size=6 color='#006666'><b>$DEPT_NAME</b></font><br>");
	echo("<font size=5  color='#003366'><b>RESULT ANNOUNCED EXAMINATION $exam_year</b></font><br>");

$announced_programs="";
$not_announced_programs="";
$is_ann=0;
$is_not_ann=0;
$prog="";
echo("<div class='col-md-3'></div>");

echo("<div class='col-md-6'>");
//		echo("<div class='table-responsive'>");
	
		echo("<table class='table  table-bordered   table-hover' ");
      $query="select PROG_ID, DEPT_ID, PROGRAM_TITLE, SEM_DURATION, SEM_PER_PART, REMARKS from program where dept_id=$dept_id order by PROGRAM_TITLE";
      $result_program=mysql_query($query);
 
     while($row_program=mysql_fetch_object($result_program)){
       	$prog_id=$row_program->PROG_ID;     

	      $query="select BATCH_ID,PROG_ID,DEPT_ID,YEAR, SHIFT,REMARKS,GROUP_DESC FROM batch WHERE PROG_ID=$prog_id and dept_id=$dept_id";
	      $result_batch=mysql_query($query);
	      while($row_batch=mysql_fetch_object($result_batch)){
	       	$batch_id=$row_batch->BATCH_ID;
           
		      $query="select PART, BATCH_ID,REMARKS,YEAR FROM part where batch_id=$batch_id order by PART";
		      $result_part=mysql_query($query);
		      while($row_part=mysql_fetch_object($result_part)){
		       	$part=$row_part->PART;


			      $query="select SL.SL_ID, SL.PART,SL.BATCH_ID,SL.PREP_DATE,SL.YEAR,SL.REMARKS,SL.PART_GROUP,SL.TYPE from seat_list SL, ledger L WHERE SL.BATCH_ID=$batch_id and SL.PART=$part and SL.year='$exam_year' AND SL.SL_ID=L.SL_ID AND SL.PART=L.SCHEME_PART AND L.IS_ANNOUNCED='Y'";
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
	                        $BATCH_YEAR=get_batch_year_encode($row_batch->YEAR);
	                        $SHIFT=$row_batch->SHIFT;
	                        $BATCH_ID=$row_batch->BATCH_ID;
	                        $GROUP_DESC=$row_batch->GROUP_DESC;                        
      	                  $PART_REMARKS=$row_part->REMARKS;
					
						$program_ann="BATCH ($BATCH_YEAR)";
						
								
					
					if(strstr($SHIFT,"E")=="E" &&  strstr($PART_REMARKS,"EVENING")==null)$program_ann="$program_ann ".get_shift_encode($SHIFT)."";
					if($GROUP_DESC!=null && $GROUP_DESC!="GNRL") $program_ann="$program_ann ".get_batch_group_encode($GROUP_DESC)."";
							
							if($program_ann != $prog){
					
							
									$announced_programs=$announced_programs."<TR><TH colspan='8'  class='info' style='text-align:center'><h2>$program_ann</h2></TH></TR> <TR bgcolor='FFFFEF'><TD><a href=ledger_summary.php?sl_id=$SL_ID&part=$PART&batch_id=$BATCH_ID&exam_year=$EXAM_YEAR&exam_type=$TYPE&prog_name=".urlencode("$PART_REMARKS "."$program_ann"."<FONT COLOR=red>".encode_exam_type($TYPE)) ."><b>$PART_REMARKS <FONT COLOR=red>".encode_exam_type($TYPE)."</FONT> </b></a></TD></TR>";
											
								$prog = "".$program_ann;
							
							}
							else{
							
							$announced_programs=$announced_programs."<TR><TD bgcolor='FFFFEF'><a href=ledger_summary.php?sl_id=$SL_ID&part=$PART&batch_id=$BATCH_ID&exam_year=$EXAM_YEAR&exam_type=$TYPE&prog_name=".urlencode("$PART_REMARKS "."$program_ann"."<FONT COLOR=red>".encode_exam_type($TYPE)) ." ><b>$PART_REMARKS <FONT COLOR=red>".encode_exam_type($TYPE)."</FONT></b></a></TD></TR>";
							
							}
						//
						//$PART_REMARKS <FONT COLOR=red>".encode_exam_type($TYPE)."</FONT> 
                             // $announced_programs=$announced_programs."<li><a href=ledger_summary.php?sl_id=$SL_ID&part=$PART&batch_id=$BATCH_ID&exam_year=$EXAM_YEAR&exam_type=$TYPE&prog_name=".urlencode($program_ann) ."><b>$program_ann</b></a>";
					//echo("<li><a href=ledger_summary.php?sl_id=$SL_ID&part=$PART&batch_id=$BATCH_ID&exam_year=$EXAM_YEAR&exam_type=$TYPE&prog_name=".urlencode($program_ann) ."><b>$program_ann</b></a>");
                        }//END SEAT LIST

			      $query="select SL.SL_ID, SL.PART,SL.BATCH_ID,SL.PREP_DATE,SL.YEAR,SL.REMARKS,SL.PART_GROUP,SL.TYPE from seat_list SL, ledger L WHERE SL.BATCH_ID=$batch_id and SL.PART=$part and SL.year='$exam_year' AND SL.SL_ID=L.SL_ID AND SL.PART=L.SCHEME_PART AND (L.IS_ANNOUNCED='N' OR L.IS_ANNOUNCED=NULL)";
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
							
				
					
					$program_ann="BATCH ($BATCH_YEAR)";

					if(strstr($SHIFT,"E")=="E" &&  strstr($PART_REMARKS,"EVENING")==null)$program_ann="$program_ann ".get_shift_encode($SHIFT)."";
					if($GROUP_DESC!=null && $GROUP_DESC!="GNRL") $program_ann="$program_ann ".get_batch_group_encode($GROUP_DESC)."";
							if($program_ann != $prog){
								
								$not_announced_programs=$not_announced_programs."<TR class='info' style='text-align:center'><TH  class='info' style='text-align:center'colspan=8  ><h2>$program_ann</h2></TH></TR> <TR bgcolor='FFFFEF'><TD><a href=ledger_summary.php?sl_id=$SL_ID&part=$PART&batch_id=$BATCH_ID&exam_year=$EXAM_YEAR&exam_type=$TYPE&prog_name=".urlencode("$PART_REMARKS "."$program_ann"."<FONT COLOR=red>".encode_exam_type($TYPE)) ."><b>$PART_REMARKS  <FONT COLOR=red>".encode_exam_type($TYPE)."</FONT>(N.A) </b></a></TD></TR>";
								$prog = "".$program_ann;
							}
							else{
								$not_announced_programs=$not_announced_programs."<TR bgcolor='FFFFEF'><TD class='info' style='text-align:center'><a href=ledger_summary.php?sl_id=$SL_ID&part=$PART&batch_id=$BATCH_ID&exam_year=$EXAM_YEAR&exam_type=$TYPE&prog_name=".urlencode("$PART_REMARKS "."$program_ann"."<FONT COLOR=red>".encode_exam_type($TYPE)) ." ><b>$PART_REMARKS <FONT COLOR=red>".encode_exam_type($TYPE)."</FONT>(N.A)</b></a></TD></TR>";
						
							}
				
				
					                        }//END SEAT LIST
           }//END PART
          }//END BATCH
        }//END PROG.



    if($is_ann);
        echo($announced_programs);

if($is_not_ann){
    echo("<h3>IN PROGRESS (still not announced due to guenon reasons)</h3>");
    echo($not_announced_programs);
}
echo("</table>");
echo("</div>");
echo("</div>");

  echo("</center>");
echo("</body>");

?>