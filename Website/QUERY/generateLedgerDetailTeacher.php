<?php
      include("../Database.php");

	$query="select SCHEME_ID,COURSE_NO,COURSE_TITLE,SEMESTER,SCHEME_PART,CR_HRS,DEPT_ID,PROG_ID,cd.YEAR,cd.GROUP,cd.SHIFT,MEMBER_ID_1 FROM  course_distribution AS cd";
			    	echo($query."</br>");		    
				$result_seat_list=mysql_query($query);
			     while($row_seat_list=mysql_fetch_object($result_seat_list)){
				
						    $COURSE_NO=$row_seat_list->COURSE_NO;
							$COURSE_TITLE=$row_seat_list->COURSE_TITLE;
							$SEMESTER=$row_seat_list->SEMESTER;
	                        $COURSE_DISTRIBUTION_ID=$row_seat_list->SCHEME_ID;
							$SCHEME_PART=$row_seat_list->SCHEME_PART;
	                       //	$SL_ID=$row_seat_list->SL_ID;
							$DEPT_ID=$row_seat_list->DEPT_ID;
							$PROG_ID=$row_seat_list->PROG_ID;
							$GROUP_DESC=$row_seat_list->GROUP; 
							$SHIFT=$row_seat_list->SHIFT;
							$exam_year=$row_seat_list->YEAR;
							$TEACHER_ID=$row_seat_list->MEMBER_ID_1;
						$querybatch="SELECT b.`BATCH_ID`,p.`PROGRAM_TITLE`,b.`GROUP_DESC`,b.`SHIFT`,b.`YEAR` FROM batch AS b
									INNER JOIN program AS p ON p.`PROG_ID`=b.`PROG_ID`
									WHERE b.`PROG_ID`=$PROG_ID";
								
							echo($querybatch."</br>");			
						$result_batch=mysql_query($querybatch);
								$count_batch=mysql_num_rows($result_batch);
						if($count_batch<0){
						return;
						}
							
						
							while($row_batch=mysql_fetch_object($result_batch)){
							$BATCH_ID=$row_batch->BATCH_ID;
							$PROGRAM_TITLE=$row_batch->PROGRAM_TITLE;
							$GROUP_DESC=$row_batch->GROUP_DESC;
							$SHIFT=$row_batch->SHIFT;
							$BATCH_YEAR=$row_batch->YEAR;
							
							
							$querySeatList="SELECT `SL_ID`,SL.TYPE FROM seat_list SL
							WHERE SL.`YEAR`=$exam_year AND sl.`BATCH_ID`=$BATCH_ID";
							$result_seat_list=mysql_query($querySeatList);
							$count_seat_list=mysql_num_rows($result_seat_list);
							echo($querySeatList."</br>");
							echo("abc: ".$count_seat_list."</br>");
							
								if ($count_seat_list==0){
								echo("raja</br>");
									continue;
									}
							//echo($querySeatList."</br>");		    
				
							while($row_seat_listt=mysql_fetch_object($result_seat_list)){
							$SL_ID=$row_seat_listt->SL_ID;
							$TYPE=$row_seat_listt->TYPE;
						//	$PART_REMARKS=$row_seat_listt->REMARKS;
							
						/*--------------PROGRAM NAME-----------------*/
						//$program_ann=("$PART_REMARKS ".encode_exam_type($TYPE)." BATCH ($BATCH_YEAR)");
					//	if(strstr($SHIFT,"E")=="E" &&  strstr($PART_REMARKS,"EVENING")==null)$program_ann="$program_ann ".get_shift_encode($SHIFT)."";
						//if($GROUP_DESC!=null && $GROUP_DESC!="GNRL") $program_ann="$program_ann ".get_batch_group_encode($GROUP_DESC)."";
					//	$prog_name=$program_ann;
						$prog_name="";
						/*--------------END PROGRAM NAME-----------------*/
								
								$query_ledger_details="SELECT * FROM ledger_details AS ld WHERE ld.SEMESTER = $SEMESTER  AND ld.`SL_ID`=$SL_ID AND ld.`COURSE_NO`='$COURSE_NO'";
								$result_ledger_details=mysql_query($querySeatList);
								$count_ledger_detailss=mysql_num_rows($result_seat_list);
						
								echo($query_ledger_details."</br>");
								if($count_ledger_detailss<0){
								return;
								}
								while($row_ledger_details=mysql_fetch_object($result_ledger_details)){
								//echo("Count :".$count_ledger_detailss);
					
									$SCHEME_ID=$row_ledger_details->SCHEME_ID;
									$SCHEME_PART=$row_ledger_details->SCHEME_PART;
									$AC_ID=$row_ledger_details->AC_ID;
									$SL_ID=$row_ledger_details->SL_ID;
									$ROLL_NO=$row_ledger_details->ROLL_NO;
									$SEMESTER=$row_ledger_details->SEMESTER;
									//$COURSE_NO_=$row_ledger_details->COURSE_NO;
									$MARKS_OBTAINED=$row_ledger_details->MARKS_OBTAINED;
									$GRADE=$row_ledger_details->GRADE;
									$REMARKS=$row_ledger_details->REMARKS;
									$MIN_MARKS=$row_ledger_details->MIN_MARKS;
									$QP=$row_ledger_details->QP;
									$UNI_MARKS_OBTAINED=$row_ledger_details->UNI_MARKS_OBTAINED;
									$COLLEGE_MARKS_OBTAINED=$row_ledger_details->COLLEGE_MARKS_OBTAINED;
									$REF_NO=$row_ledger_details->REF_NO;
									$REF_DATE=$row_ledger_details->REF_DATE;
									$TEACHER_CODE="".$BATCH_ID."".$TYPE."".$COURSE_NO;
									
									$queryInsert="INSERT INTO ledger_details_teacher (SCHEME_ID,SCHEME_PART,AC_ID,SL_ID,ROLL_NO,SEMESTER,COURSE_NO,MARKS_OBTAINED,GRADE,REMARKS,MIN_MARKS,QP,UNI_MARKS_OBTAINED,COLLEGE_MARKS_OBTAINED,REF_NO,REF_DATE,TEACHER_CODE,TEACHER_ID,REMARKS_PROGRAM_NAME,COURSE_TITLE,BATCH_ID) VALUES($SCHEME_ID,$SCHEME_PART,$AC_ID,$SL_ID,'$ROLL_NO',$SEMESTER,'$COURSE_NO',$MARKS_OBTAINED,'$GRADE','$REMARKS','$MIN_MARKS','$QP','$UNI_MARKS_OBTAINED', '$COLLEGE_MARKS_OBTAINED','$REF_NO','$REF_DATE','$TEACHER_CODE','$TEACHER_ID','$prog_name','$COURSE_TITLE',$BATCH_ID)";
							echo("$queryInsert</br>");
								

							
								}//row_ledger_details
							
							
							}//row_seat_listt
						}//row_batch
					}//row_seat_list
						
						
	                        	
				
	
?>

 