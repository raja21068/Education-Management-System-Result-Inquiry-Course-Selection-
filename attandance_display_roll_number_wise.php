<!DOCTYPE HTML>
<html lang="en-US">
<head>
  <link rel="shortcut icon" href="favicon.ico">
<link rel="icon" type="image/gif" href="images/animated_favicon1.gif">

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>Dispaly Present Students</title>

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
  <div class="container floated">

	<div class="sixteen floated page-title">
<h1>Dispaly Over All Summary </h1>
	
		<p style='margin-bottom:10px; margin-top:10px; font-size:20px;'>Semester Examinations</p>
	</div>

	

	
            <?php
        require 'Database.php';
	//echo("<body background=background.gif>");



//	echo("<FORM ACTION='course_summary.php' method='post' target=test> ");
//	echo("<div class='table-responsive'>");

	echo("<TABLE border=0 class='standard-table'> ");
	echo("<TR color='#003366'> ");
	echo("	<TD ><B>Name</B></TD> ");
	echo("	<TD COLSPAN=3> ");
	

	?>
	<td>    <input type="text" name='rollNo' id='rollNo' class="form-control"  placeholder="i.e 2K10/CSE/60" required="required">



		
	<?php  
      
	echo("	</TD> ");
	echo("</TR> ");
	?>
	
	

	
	
	<?php
	echo("<TR> ");
	echo("<TD ALIGN='CENTER' COLSPAN='2'> ");
  echo("<INPUT TYPE='SUBMIT' id='display' class='submit' VALUE='Display Present Students'> ");
   echo("<img src='images/busy.gif' id='ajax-ico' style='display:none;'> ");
		echo("</td>");	
	
	echo("</TABLE> ");
		echo("<div id='course'> </div>");
		//echo("<div id='myResponse'>");
		//	echo("</div>");
									
	//echo("</form> ");
//        echo '<br/>';
echo("</div>");
echo("</div>");
		
include("footer.php");

	//echo("<img src=department_logo.gif>");

	

?>
					   
		<script>			   
			
			$("#course_distribution_id").change(function(){
					//changeValue();
					//changeBatchValue();
			});
			
			
			
			$("#facMember_id").change(function(){
				
				var val = $(this).val();
				//alert(val);
					$.ajax(
					{ url:"getCourseDistribution.php?facMember_id="+val}).done(function(data){
						//alert(data);
						$("#course_distribution_id").html(data);
						//changeValue();
						//changeBatchValue();
					});
					
			});
			
			
		
			
			
		</script>
		
		<script>
$("#display").click(function(){
				
				//  alert("dd");
				 $('#ajax-ico').show();
				
				var course_distribution_id = $('#course_distribution_id').val();
				
				  $.post("attandance_display_summary_course_wise_submit.php", {
										
										course_distribution_id:course_distribution_id
										
                                     					   
                                        }, function(response) {
											//alert(response);
                                            $("#course").html(response);
                                            $('#ajax-ico').hide();
                                        });	
				
				});
				
			

</script>
<?php
//include("header.php");
?>
  
</div>
<!-- End Wrapper --> 



<script type="text/javascript" src="style/js/scripts.js"></script>

</body>
</html>