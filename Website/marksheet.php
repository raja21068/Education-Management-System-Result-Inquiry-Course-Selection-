<!DOCTYPE HTML>
<html lang="en-US">
<head>
<meta charset="UTF-8">
    <!-- Basic Page Needs
  ================================================== -->
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" type="image/gif" href="http://104.223.95.210/images/animated_favicon1.gif">

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>Trancript</title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
 <!-- ================================================== -->
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

	<h1>Academic Transcript</h1>
	
		<p style='margin-bottom:10px; margin-top:10px; font-size:20px;'>Semester Examinations</p>

	</div>



  <!-- Begin Container -->    
            <?php
      require_once("Database.php");

	

	
	echo("<FORM ACTION=printMarksheet.php  method=post> ");
	?>
	
	<?php
	echo("<TABLE class='standard-table'> ");


	echo("<TR> ");
	echo("	<TD ALIGN=RIGHT><B>Roll No.</B></TD> ");
	echo("	<TD ><input type='text' name='roll_no' id='roll_no' size='10'><FONT COLOR=RED SIZE=2> for example <U>2K10/CSE/60</U></TD>  ");
	echo("</TR>");
		echo(" <TR>");
		echo("	<TD ALIGN=RIGHT><B>Part</B></TD> ");
	
		echo(" <TD >");
	echo("		<select name='part' id='part' size='1'> ");
	echo("		 <option value=1>I</option> ");
	echo("		 <option value=2>II</option> ");
	echo("		 <option value=3>III</option> ");
	echo("		 <option value=4>IV</option> ");
	echo("		 <option value=5>V</option> ");
	echo("		</select>     ");
	
	echo("	</TD> ");
	echo("</TR> ");
		echo("<TR> ");
	echo("<TD ALIGN='CENTER' COLSPAN='2' > ");

     echo("<INPUT TYPE='BUTTON' id='display' class='submit' VALUE='View Marksheet'>     ");

	  echo("<img src='images/busy.gif' id='ajax-ico' style='display:none;'> </TD>");
	  
	echo("<TD ALIGN='CENTER'> <INPUT TYPE='SUBMIT' id='print' class='submit' VALUE='Print Marksheet'> </td>");



	echo("</TR> ");



	
	echo("</TABLE> ");

	echo("</form> ");
			echo("<div id='Transcript'> </div>");

        echo '<br/>';
      //echo("<img src=department_logo.gif>");


?>

  </div>
  </div>
  <div>
  <?php
 // include("facebook.php");
  include("footer.php");
  ?>
</div>
<!-- End Wrapper --> 



<script type="text/javascript" src="http://104.223.95.210/style/js/scripts.js"></script>

</body>

<script>
$("#display").click(function(){
				
				// alert("dd");
				 $('#ajax-ico').show();
				 var roll_no = $("#roll_no").val();
				 var part = $("#part").val();
                  //alert (roll_no);                
				  				$.post("marksheet_handler.php", {
										roll_no: roll_no,
										part: part		
		                                }, function(response) {
										//	alert(response);
                                            $("#Transcript").html(response);
                                            $('#ajax-ico').hide();
                                        });	
										
										
						
										
				
				});
				
			
			$("#print").click(function(){
				
				// alert("dd");
				 $('#ajax-ico').show();
				 var roll_no = $("#roll_no").val();
				 var part = $("#part").val();
                  //alert (roll_no);                
				  				$.post("printMarksheet.php", {
										roll_no: roll_no,
										part: part		
		                                }, function(response) {
										//	alert(response);
                                            //$("#Transcript").html(response);
                                            $('#ajax-ico').hide();
                                        });	
										
										
						
										
				
				});

</script>
</html>