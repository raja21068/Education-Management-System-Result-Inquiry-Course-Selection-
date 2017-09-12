<?php
      include("../Database.php");
	$count=10000;
	$group="";
	$shiftt="";
	$sc_id=0;
							
	$exam_year	=mysql_escape_string($_REQUEST["exam_year"]);	
	$query="SELECT DISTINCT (ld.`COURSE_NO`) ,ld.`SEMESTER`,ld.`SCHEME_ID`,ld.`SCHEME_PART`,ld.`SL_ID`,p.`DEPT_ID`,p.`PROG_ID`,b.`GROUP_DESC`,b.`SHIFT` ,ld.AC_ID FROM ledger_details AS ld
					 INNER JOIN `seat_list` AS sl  ON sl.`SL_ID`=ld.`SL_ID` AND sl.`YEAR`=$exam_year
					 INNER JOIN `batch` AS b ON b.`BATCH_ID`=sl.`BATCH_ID`
					 INNER JOIN `program` AS p ON p.`PROG_ID`=b.`PROG_ID`";
			    //	echo($query);		    
				$result_seat_list=mysql_query($query);
				
			     while($row_seat_list=mysql_fetch_object($result_seat_list)){
							
							
							
	                        $COURSE_NO=$row_seat_list->COURSE_NO;
	                        $SEMESTER=$row_seat_list->SEMESTER;
	                        $SCHEME_ID=$row_seat_list->SCHEME_ID;
							$SCHEME_PART=$row_seat_list->SCHEME_PART;
	                       	$SL_ID=$row_seat_list->SL_ID;
							$DEPT_ID=$row_seat_list->DEPT_ID;
							$PROG_ID=$row_seat_list->PROG_ID;
							$GROUP_DESC=$row_seat_list->GROUP_DESC; 
							$SHIFT=$row_seat_list->SHIFT;
							$AC_ID=$row_seat_list->AC_ID;
							
							if($group!=$GROUP_DESC || $shiftt!= $SHIFT || $sc_id != $SCHEME_ID){
								$count++;
								$group=$GROUP_DESC;
								$shiftt=$SHIFT;
								$sc_id=$SCHEME_ID;
								
							}
							
							if($AC_ID==0){
									$query=" SELECT * FROM `scheme_detail` AS sd WHERE sd.`COURSE_NO`='$COURSE_NO' AND sd.`SCHEME_ID`=$SCHEME_ID";
					
							}else{
								$query=" SELECT * FROM `ac_scheme_detail` AS sd WHERE sd.`COURSE_NO`='$COURSE_NO' AND sd.`SCHEME_ID`=$SCHEME_ID";
					
							}
							$result_scheme=mysql_query($query);
							if($row_scheme=mysql_fetch_object($result_scheme)){
								$COURSE_TITLE=$row_seat_list->COURSE_TITLE;
								$CR_HRS=$row_seat_list->CR_HRS;
								
							$queryInsert="INSERT INTO course_distribution (SCHEME_ID,COURSE_NO,COURSE_TITLE,SEMESTER,SCHEME_PART,CR_HRS,DEPT_ID,PROG_ID,YEAR,GROUP,SHIFT) VALUES($count,$COURSE_NO,$COURSE_TITLE,$SEMESTER,$SCHEME_PART,$CR_HRS,$DEPT_ID,$PROG_ID,$YEAR,$GROUP,$SHIFT)";
							//echo("$queryInsert</br>");
				
							$result=mysql_query($queryInsert);
							}
				 
					}
	
	
	
?>

 