<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <!-- Basic Page Needs
  ================================================== -->
    <!-- Basic Page Needs
  ================================================== -->
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" type="image/gif" href="images/animated_favicon1.gif">

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>Sucessful Candidates</title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <?php
include("bar.php");
?> 
<script>
	$(document).ready(function(){
		$('nav ul li a').each(function() {
			if($(this).text() == "Results"){
				$(this).attr("id","current");
			}else {
				$(this).removeAttr("id");
			}
    	});
	});
</script>
  <!-- Begin Container -->
  <div class="container floated">

	<div class="sixteen floated page-title">
<h1>List of Successful and Unsucessful Candidates</h1>
	
		<p style='margin-bottom:10px; margin-top:10px; font-size:20px;'>Semester Examinations</p>

	</div>

  
            <?php
        require './Database.php';

//	echo("<FORM ACTION='successful_candidates_request_handler.php' method='post' target=test> ");
	//echo("<div class='table-responsive'>");
	echo("<TABLE class='standard-table'> ");
	echo("<TR> ");
	echo("	<TD ALIGN=RIGHT><B>Department</B></TD> ");
	echo("	<TD> ");
	echo("		<select  class='form-control' name='dept_id' id='dept_id' > ");
        
      display_departments_in_combobox();

	echo("		</select> ");
	echo("	</TD> ");
	echo("</TR> ");
	echo("<TR> ");
	echo("	<TD ALIGN=RIGHT><B>Exam. Year</B></TD> ");
	echo("	<TD><select class='form-control' name='exam_year' id='exam_year' size=1> ");
      $last_ann_year=2013;
      display_last_seat_list_years_in_combobox($last_ann_year);

	echo("	</select> ");
	echo("	</TD> ");
	echo("<TR> ");
	echo("<TD ALIGN='CENTER' COLSPAN='2'> ");
  echo("<INPUT TYPE='SUBMIT'  id='display' class='submit' VALUE='Display'> ");
   echo("<img src='images/busy.gif' id='ajax-ico' style='display:none;'> ");
		echo("</td>");	
	
	echo("</TABLE> ");
	//echo("</div> ");
	
	echo("<div id='sucessfulCandidates'> </div>");
		
	
		
		echo("</div>");
	//echo("</form> ");


?>
</div>

<?php

include("footer.php");

//include("header.php");
?>
</div>  

<!-- End Wrapper --> 



<script type="text/javascript" src="style/js/scripts.js"></script>

</body>
</html>

<script>
$("#display").click(function(){
				
				//  alert("dd");
				 $('#ajax-ico').show();
				 var dept_id = $("#dept_id").val();
				 var exam_year = $("#exam_year").val();
                                  
				  $.post("unsuccessful_successful_candidates_request_handler.php", {
								dept_id: dept_id,
                                       exam_year: exam_year					   
                                        }, function(response) {
											//alert(response);
                                            $("#sucessfulCandidates").html(response);
                                            $('#ajax-ico').hide();
                                        });	
				
				});
				
			

</script>