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
<title>Faculty</title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!--================================================== -->
<?php
include("bar.php");
?> 
<script>
	$(document).ready(function(){
		$('nav ul li a').each(function() {
			if($(this).text() == "Faculty"){
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
<h1>Faculty</h1>
	
		<p style='margin-bottom:10px; margin-top:10px; font-size:20px;'></p>
	</div>


	
	
            <?php
        require './Database.php';
	
	echo("<TABLE class='standard-table'> ");
	echo("<TR > ");
	echo("	<TD ALIGN=RIGHT><B>Department / Campus</B></TD> ");
	echo("	<TD COLSPAN=3> ");
   ?>
<div class='col-md-8'>
<select  name="dept_id" id="dept_id"  class='form-control'>

							<option value="">--Select Department / Campus--</option>
						<?php
						display_departments_with_insititute();
						echo("</select>");
						echo("</div>");
?>

		
	<?php  
      
	echo("	</TD> ");
	echo("</TR> ");
		echo("</Table> ");

	?>
	    
     
	<?php
	
 
echo(	"<div id='facMembersData'> </div>");

echo("</div>");


include("footer.php");
	
?>

   </div>
   
   <script>			   
			$("#dept_id").change(function(){
				var val = $(this).val();
					$.ajax(
					{ url:"getFacuiltyMembers.php?depId="+val}).done(function(data){
						
						$("#facMembersData").html(data);
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