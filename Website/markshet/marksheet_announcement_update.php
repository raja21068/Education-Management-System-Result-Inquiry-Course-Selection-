<?php
     
 $ret =  mysql_select_db('stbbedup_exam1',mysql_connect('localhost','stbbedup_exam1db','exam1db'));
$date_of_announce=$_REQUEST['date'];
$is_announce=$_REQUEST['announce'];
$deptID=$_REQUEST['deptId'];
	$query="update marksheet_announcement SET DATE_OF_ANNOUNCE='$date_of_announce', IS_ANNOUNCE=$is_announce WHERE DEPT_ID=$deptID";
	//echo($query);
      $result_marksheet=mysql_query($query);
     header("location:markshetAnnouncemnet_form.php");

?>