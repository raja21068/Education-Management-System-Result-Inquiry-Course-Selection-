<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<?php
include("Database.php");
$DEPT_ID=mysql_real_escape_string($_GET['depId']);
				$emp_query=mysql_query("SELECT * FROM faculty_members as fm,prefix_type as p 
										WHERE fm.PREFIX_ID =p.PREFIX_ID 
										AND DEPT_ID=$DEPT_ID
										AND fm.`ACTIVATE`=1 
										order by p.ORDERBY ");
						$countrows=mysql_num_rows($emp_query);
						if($countrows<0){
						return;
						}
					   ?> 
						
					<?php
						echo("<div class='col-md-2'></div>");

						echo("<div class='col-md-8'>");
					
						echo("<table class='table  table-bordered table-striped' ");
						echo("<TR>");
						echo("<TH class='info' style='text-align: center;'>SNO</TH>");				
						echo("<TH class='info' style='text-align: center;'>NAME</TH>");
						echo("<TH class='info' style='text-align: center;'>DISIGNATION</TH>");
						echo("<TH class='info' style='text-align: center;'>EMAIL</TH>");
						echo("<TH class='info' style='text-align: center;'>IMAGE</TH>");
				//		echo("<TH></TH>");
						echo("</TR>");
						$count=0;
						while($row=mysql_fetch_array($emp_query)){
						$count++;
						$id=$row['MEMBER_ID'];
						$first_name=$row['FIRST_NAME'];
						$last_name=$row['LAST_NAME'];
						$email=$row['EMAIL_ADRESS'];
						$prefix_id=$row['PREFIX_ID'];
						$prefix_name=$row['PREFIX_NAME'];
						$profile_url=$row['PROFILE_URL'];
				
						
						
						echo("<TR>");
						echo("<TH>$count </TH>");
						echo("<TH><a href='$profile_url' target='new'>$first_name $last_name</a></TH>");
						echo("<TH>$prefix_name</TH>");
						echo("<TH>$email</TH>");
						?>
						
						<TH><img src='http://exam.usindh.edu.pk/googlefacultyform/uploads/<?php echo $id; ?>.jpg' style='width:410x; height:124px;' onerror="this.src='empty.png'" ></TH>
						<?php
					//	echo("<TH></TH>");
						echo("</TR>");
					
						
						}
						

		
				echo("</TABLE>");
				echo("</DIV>");
				echo("</DIV>");
				
						
						?>

                       