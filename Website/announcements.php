<!DOCTYPE HTML>
<html lang="en-US">

<head>
 <!-- Fevicon
================================================== -->
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" type="image/gif" href="images/animated_favicon1.gif">

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>Announmcents</title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
 
<?php
include("bar.php");
include("pagination.php");
/*
$menu_heading = "An";

$page="announcements.php";
$current_url=$_SERVER['PHP_SELF'];
//echo("$current_url");
$loc1=strrpos($current_url,"/")+1;
$loc2=strrpos($current_url,".")-1;
echo($loc1);
for ($a=$loc1;$a<=$loc2;$a++) {
    $page.=$current_url[$a];
}
//echo($page);
// Pagination class //
    $PaginateIt = new pagination();
    //$PaginateIt->SetItemsPerPage($limit);
    $PaginateIt->SetQueryString('');
    $PaginateIt->SetLinksToDisplay(5);
    
   
    
    $PageLinks = $PaginateIt->GetPageLinks();
	$PageLinks = $PaginateIt->SetLinksHref($current_url);
	   $PaginateIt->SetQueryStringVar($page); 
	$PaginateIt->SetCurrentPage("234"); 
	//echo($PageLinks);
	
// Pagination class //

//echo($loc1);
//echo($loc2);

//    echo $paginate->SetLinksHref('{p:&lt; Prev} {links:7: } {n:Next &gt;}');
*/
 
 

$uri         = $_SERVER['REQUEST_URI'];
$page        = strstr($uri, '=');
$page        = substr($page, 1);
$uri = rtrim( dirname($_SERVER["SCRIPT_NAME"]), '/' );
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

		<h1>Announcements</h1>

		<p style='margin-bottom:10px; margin-top:10px; font-size:20px;'>Semester Examinations</p>
	</div>

</div>
  <!-- Begin Container -->
  <div id="container" >
   
            <?php
        require './Database.php';
	//echo("<body background=background.gif>");



	echo("<FORM ACTION=announcements_request_handler.php method=post target=test> ");
	echo("<div class='table-responsive'>");
	echo("<TABLE border=0 class='standard-table'> ");
	echo("<TR> ");
	echo("	<TD><B>Department</B></TD> ");
	echo("	<TD> ");
	echo("		<select name=dept_id size=1> ");
        
      display_departments_in_combobox();

	echo("		</select> ");
	echo("	</TD> ");
	echo("</TR> ");
	echo("<TR> ");
	echo("	<TD ><B>Exam. Year</B></TD> ");
	echo("	<TD><select name=exam_year size=1> ");

      display_seat_list_years_in_combobox();

	echo("	</select> ");
	echo("	</TD> ");
	echo("<TR> ");
	echo("<TD ALIGN='CENTER' COLSPAN='2'> ");
  echo("<INPUT TYPE='SUBMIT' class='submit' VALUE='View Announcements'> ");
		echo("</td>");
		echo("</TABLE> ");
		echo("</div> ");
	echo("</form> ");
        echo '<br/>';
      //echo("<img src=department_logo.gif>");


include("footer.php");
?>
<?php
//include("header.php");
?>
  
</div>
<!-- End Wrapper --> 



<script type="text/javascript" src="style/js/scripts.js"></script>

</body>
</html>