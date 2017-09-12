<?php
    $ret =  mysql_select_db('stbbedup_exam1',mysql_connect('localhost','stbbedup_exam1db','exam1db'));

	echo("<body background=background.gif>");


      echo("<center>");

	echo("<img src=header_left.gif><br>");


	echo("<font size=6  color='#003366'><b> Marksheet of Candidates sent Various Departments</b></font><br>");
	
      echo("<table border=1 BORDERCOLOR=BLACK>");
	  echo("<TR style='color: white; background-color: #666666'>");
									echo("    <TH colspan=8  ALIGN=CENTER><h2></h2></TH>");
									echo("</TR>");
	                                                echo("<TR>");
									echo("  	<TH>DEPARTMENT NAME</TH>");
									echo("  	<TH>OLD DATE</TH>");
									echo("  	<TH>NEW DATE</TH>");
									echo("  	<TH>IS Activated</TH>");
								                	echo("</TR>");
				                         

      $query="select DEPT_ID,DEPT_NAME, DATE_OF_ANNOUNCE,DATE_OF_ANNOUNCE,IS_ANNOUNCE FROM marksheet_announcement order by DEPT_NAME asc";
      $result_marksheet=mysql_query($query);
      while($row_marksheet=mysql_fetch_object($result_marksheet)){
       	$dept_name=$row_marksheet->DEPT_NAME;
		$date_of_announce=$row_marksheet->DATE_OF_ANNOUNCE;
				$announce=$row_marksheet->IS_ANNOUNCE;
				$deptId=$row_marksheet->DEPT_ID	;


           
		      
									

				                      
                                                echo("  <TR bgcolor='FFFFEF'>");
												echo("  <FORM ACTION='marksheet_announcement_update.php'>");
												echo("  	<TD>$dept_name</TD>");
												echo("  <input type='hidden' name='deptId' value='$deptId'></TD>");
											
												echo("  	<TD>$date_of_announce</TD>");
												echo("  	<TD><input type='date' name='date' value='$date_of_announce'></TD>");
												echo("  	<TD><input type='text' name='announce' value='$announce'></TD>");
												echo("  	<TD><input type='submit'></TD>");
	
												echo("  	<TD></FORM></TD>");
												
                                                echo("  </TR>");
			
					 			 
	  							 

                  }//END SEAT LIST
	echo("</TABLE> ");
    echo("</center>");

	echo("</body>");

?>