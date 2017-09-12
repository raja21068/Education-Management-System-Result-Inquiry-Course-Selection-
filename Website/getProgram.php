
<?php
include("Database.php");
$DEPT_ID=mysql_real_escape_string($_GET['depId']);
				$emp_query=mysql_query("SELECT PROG_ID,PROGRAM_TITLE FROM program WHERE DEPT_ID=$DEPT_ID");
                        ?> 
						
					<?php
						
						while($row=mysql_fetch_array($emp_query)){
						
						$PROG_ID=$row['PROG_ID'];
						$PROGRAM_TITLE=$row['PROGRAM_TITLE'];
						echo("<option value=$PROG_ID>$PROGRAM_TITLE</option>");
						}
						

						
						
						?>

                       