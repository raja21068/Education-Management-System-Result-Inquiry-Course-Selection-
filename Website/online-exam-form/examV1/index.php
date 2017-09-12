<!DOCTYPE HTML>
<html lang="en-US" xmlns="http://www.w3.org/1999/html">

 <!-- Basic Page Needs
  ================================================== -->
	    <!-- Basic Page Needs
  ================================================== -->
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" type="image/gif" href="images/animated_favicon1.gif">

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>Gazette</title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!--================================================== -->
<?php
include("../bar.php");
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

	<!--	<h3>Semester Results for Ex-Students from Academic Year 2004 to 2013 only</h3>

		<p style='margin-bottom:10px; margin-top:10px; font-size:15px; color:red;'>Note: This gazette is not for currently enrolled students and it is published for record and verification purposes only</p>
		 -->
	</div>

  <!-- Begin Container -->


	
<div class='row'>
<div class='col-md-2'></div>
<div class="form-group">
<div class='col-md-2'>
    <!--<label   for="exampleInputEmail1">Enter Roll Number</label>-->
    </div>
    
    <div class='col-md-4'>
	<!--	<form action="getgazet.php">-->
		<table class='table  table-bordered table-striped' >
		<tr>
		<td>Enter Roll No</td>


<td>    <input type="text" name='rollNo' id='rollNo' class="form-control"  placeholder="i.e 2K10/CSE/60" required="required"></td>
		</tr>
	<?php
					echo("<tr>");
					echo("<td>Select Semester</td>");
					echo("	<TD><select id='semesterCombo' name=semester size=1> ");

					echo("<option value=''>Select Semester</option>");
					echo("<option value='1'>1</option>");
					echo("<option value='2'>2</option>");
					echo("<option value='3'>3</option>");
					echo("<option value='4'>4</option>");
					echo("<option value='5'>5</option>");
					//echo("<option value='6'>6</option>");
					echo("<option value='7'>7</option>");
					//echo("<option value='8'>8</option>");
					echo("<option value='9'>9</option>");
					//echo("<option value='10'>10</option>");
					echo("</select></TD></tr>");






	?>

			<tr><td colspan="2">	<input type="submit" id='gazet' class="btn btn-primary"  value='SUBMIT'> <img src='../images/busy.gif' id='ajax-ico' style='display:none;'></td></tr>
			 

			</table>
<Div><Font color='red'> Last date Of sumbission is 5-May-2016 However student will be faciliate </div></FONT>
<Div><Font color='red'>  Date Of exam start on 9-May-2016</div></FONT>
<Div><Font color='red'> Note:<a href='Online_Exam_Form_Guidleine.pdf'>Please read guideline</a></FONT></div>
<Div>black and white print is acceptable</div>

		</form>
</div>
<div class='col-md-4'>
	<iframe width="300" height="250" src="https://www.youtube.com/embed/nxkc2rMhgz8?autoplay=0&cc_load_policy=1" frameborder="0"
allowfullscreen></iframe>
<a href='Online_Exam_Form_Guidleine.pdf'>Download Guideline and Fees Stucture</a>
</div>

</div>
	</div>
</div>
	<div id='studentData'> </div>


</div>

</div>
		
	    
     
	<?php
	
 

echo("</div>");


include("../footer.php");
	
?>

   </div>



   <script>			   
			$("#gazet").click(function(){
				 $('#ajax-ico').show();
				var rollNo = $('#rollNo').val();
				var semesterCombo= $('#semesterCombo').val();

				if(rollNo==""){
				return;
				}
				$.post("getgazet.php", {
					rollNo: rollNo,
					semester: semesterCombo

				}, function(response) {
					//alert(response);
					$("#studentData").html(response);
					    $('#ajax-ico').hide();


				});
				//alert(rollNo);

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