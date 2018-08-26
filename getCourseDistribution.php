
<?php
include("Database.php");
$facMember_id=mysql_real_escape_string($_GET['facMember_id']);
				$emp_query=mysql_query("SELECT `COURSE_TITLE`,`COURSE_NO`,COURSE_DISTRIBUITION_ID FROM `course_distribution` WHERE `MEMBER_ID_1`=$facMember_id");										
                        ?> 						<option value="">--Select Course--</option>
						
					<?php
												
						while($row=mysql_fetch_array($emp_query)){
						
						$COURSE_DISTRIBUITION_ID=$row['COURSE_DISTRIBUITION_ID'];
						$COURSE_TITLE=$row['COURSE_TITLE'];						$COURSE_NO=$row['COURSE_NO'];						
						echo("<option value=$COURSE_DISTRIBUITION_ID>$COURSE_TITLE $COURSE_NO </option>");
						}
						

						
						
						?>

                       