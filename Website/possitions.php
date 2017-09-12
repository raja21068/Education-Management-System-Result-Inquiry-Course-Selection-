<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <!-- Basic Page Needs
  ================================================== -->
    <!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>Position Holders</title>
	<meta name="description" content="Academic Possitions of all our university">
	<meta name="keywords" content="usindh,usindhexam,usindh exam holders,usindh positions,exam positions,usindh exam,usindh results,usindh result" />
	<meta name="author" content="usindhexam.stbb.edu.pk">
	
    <!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta charset="UTF-8">

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

	<h1>Positions</h1>
	
		<p style='margin-bottom:10px; margin-top:10px; font-size:20px;'>Semester Examinations</p>

	</div>


	
  
            <?php
  include("Database.php");


	//echo("<FORM ACTION='possitions_request_handler.php' method='post' target='test'> ");
//	echo("<div class='table-responsive'>");
	echo("<TABLE class='table table-bordered'> ");
	echo("<TR> ");
	echo("	<TD ALIGN=RIGHT><B>Department</B></TD> ");
	echo("	<TD> ");
	echo("		<select class='form-control' name='dept_id' id='dept_id' size=1> ");
        
      display_departments_in_combobox();

	echo("		</select> ");
	echo("	</TD> ");
	echo("</TR> ");
	
	echo("<TR> ");
	echo("	<TD ALIGN=RIGHT><B>Exam. Year</B></TD> ");
	echo("	<TD><select class='form-control' name='exam_year' id='exam_year' size='1'> ");
    display_seat_list_years_in_combobox();
	echo("	</select> ");
	echo("	</TD> ");
	echo("<TR> ");
	echo("<TD ALIGN='CENTER' COLSPAN='2'> ");
  echo("<INPUT TYPE='SUBMIT'  id='display' class='submit' VALUE='Display'> ");
  echo("<img src='images/busy.gif' id='ajax-ico' style='display:none;'> ");
		echo("</td>");

	echo("</TABLE> ");
	echo("<div id='position'> </div>");
	//echo("</form> ");
         echo '</div>';
		 
		 

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
                                  
				  $.post("possitions_request_handler.php", {
								dept_id: dept_id,
                                       exam_year: exam_year					   
                                        }, function(response) {
											//alert(response);
                                            $("#position").html(response);
                                            $('#ajax-ico').hide();
                                        });	
				
				});
				
			

</script>