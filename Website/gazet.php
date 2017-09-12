<!DOCTYPE HTML>
<html lang="en-US">

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

		<h3>Semester Results for Ex-Students only</h3>

		<p style='margin-bottom:10px; margin-top:10px; font-size:15px; color:red;'>Note: This gazette is not for currently enrolled students and it is published for record and verification purposes only</p>
	</div>

  <!-- Begin Container -->


	
<div class='row'>
<div class='col-md-2'></div>
<div class="form-group">
<div class='col-md-2'>
    <!--<label   for="exampleInputEmail1">Enter Roll Number</label>-->
    </div>
    <div class='col-md-4'>		
Enter Roll Number
    <input type="text" name='rollNo' id='rollNo' class="form-control"  placeholder="i.e 2K10/CSE/60" required="required">
 <input type="submit" id='gazet' class="btn btn-primary"  value='Search'>

  </div>
</div>
</div>
		
	    
     
	<?php
	
 
echo(	"<div id='facMembersData'> </div>");

echo("</div>");


include("../footer.php");
	
?>

   </div>
   
   <script>			   
			$("#gazet").click(function(){
				//alert("sds");
				var rollNo = $('#rollNo').val();
				if(rollNo==""){
				return;
				}
				//alert(rollNo);
					$.ajax(
					{ url:"getgazet.php?rollNo="+rollNo}).done(function(data){
						
						$("#facMembersData").html(data);
								});
					
			});
			
		</script>

<script>		
	   
			$("#rollNo").keypress(function(e){
               if (e.which == 13) {  // the enter key code

				//alert("sds");
				var rollNo = $('#rollNo').val();
				if(rollNo==""){
				return;
				}

				//alert(rollNo);
					$.ajax(
					{ url:"getgazet.php?rollNo="+rollNo}).done(function(data){
						
						$("#facMembersData").html(data);
								});
}
					
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