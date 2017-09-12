<?php
$SL_ID=$_REQUEST['SL_ID'];
$TEACHER_CODE=$_REQUEST['TEACHER_CODE'];
$ROLL_NO=$_REQUEST['ROLL_NO1'];
$num = sizeOf($ROLL_NO);


//echo("RollNo: ".$ROLL_NO."</BR>");
//echo("SC: ".$num."</BR>");
//echo("tc: ".$TEACHER_CODE."</BR>");
require_once("../Database.php");
 for($i=0;$i<$num;$i++){

	$query="DELETE FROM ledger_details_teacher WHERE ROLL_NO='$ROLL_NO[$i]' AND TEACHER_CODE='$TEACHER_CODE'  AND SL_ID=$SL_ID ";
	echo($query);
	$result=mysql_query($query);
			//$sno++;			
	}
	
//		header("Location: marks_add.php?TEACHER_CODE=$TEACHER_CODE");
			

?>