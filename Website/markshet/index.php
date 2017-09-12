<?php
      include("../Database.php");


	echo("<body background=../background.gif>");


      echo("<center>");

	echo("<img src=../header_left.gif><br>");


	if($DEPT_NAME!=null)echo("<font size=6 color='#006666'><b>$DEPT_NAME</b></font><br>");
	echo("<font size=6  color='#003366'><b>Marksheets Announcement </b></font><br>");
	
      echo("<table border=1 BORDERCOLOR=BLACK>");
	  echo("<TR style='color: white; background-color: #666666'>");
									echo("    <TH colspan=8  ALIGN=CENTER><h2>Please collect your Marksheet from your department</h2></TH>");
									echo("</TR>");
	                                                echo("<TR>");
									echo("  	<TH>DEPARTMENT NAME</TH>");
									echo("  	<TH>DATE</TH>");
								                	echo("</TR>");
				                         

      $query="select DEPT_NAME, DATE_OF_ANNOUNCE FROM marksheet_announcement WHERE IS_ANNOUNCE=1 order by DEPT_NAME asc ";
      $result_marksheet=mysql_query($query);
      while($row_marksheet=mysql_fetch_object($result_marksheet)){
       	$dept_name=$row_marksheet->DEPT_NAME;
		$date_of_announce=$row_marksheet->DATE_OF_ANNOUNCE;     


           
		      
									

				                      
                                                echo("  <TR bgcolor='FFFFEF'>");
								echo("  	<TD>$dept_name</TD>");
								echo("<TD>".date('d F, Y ', strtotime($date_of_announce))."</TD)");
							
								echo("");
								//echo("  	<TD>".date((d ([ .\t-])* m),strtotime($date_of_announce)."</TD>");
                                              
                                                echo("  </TR>");
			
					 			 
	  							 

                  }//END SEAT LIST
	echo("</TABLE> ");
    echo("</center>");

	echo("</body>");

?>