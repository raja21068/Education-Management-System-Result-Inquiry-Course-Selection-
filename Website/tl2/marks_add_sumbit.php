<?php
$SL_ID=$_REQUEST['SL_ID'];
$TEACHER_CODE=$_REQUEST['TEACHER_CODE'];
$ROLL_NO=$_REQUEST['ROLL_NO'];
$MARKS_OBTAINED=$_REQUEST['MARKS_OBTAINED'];
$MIN_MARKS=$_REQUEST['MIN_MARKS'];
$COURSE_NO=$_REQUEST['COURSE_NO'];
$SCHEME_ID=$_REQUEST['SCHEME_ID'];
//echo($SCHEME_ID);
$remarks="";
$grade="";
$qp="";
$CR_HRS="";
$num = sizeOf($ROLL_NO);
//echo("SLID: ".$SL_ID."</BR>");
//echo("SC: ".$STUDENT_CODE."</BR>");
//echo("tc: ".$TEACHER_CODE."</BR>");
 include("../Database.php");

 $charHoursQuery="SELECT CR_HRS FROM scheme_detail WHERE COURSE_NO='$COURSE_NO' AND SCHEME_ID=$SCHEME_ID";
 //echo($charHoursQuery);
 $charHoursResult=mysql_query($charHoursQuery);
 	if($row=mysql_fetch_object($charHoursResult)){
			$CR_HRS=$row->CR_HRS;
			}		
	
	$sno=0;	
	for($i=0;$i<$num;$i++){
		//max marks 100
		if($MIN_MARKS == 40){
			$remarks="PASS";
			$marks = $MARKS_OBTAINED[$i];
			
			if($marks >=80 && $marks<=100){
				$grade="A";
				$qp=(4.00*$CR_HRS);
			}else if($marks >=60 && $marks <=79){
				$grade="B";
				$qp=(3.00*$CR_HRS);
			}else if($marks >=50 && $marks<=59){
				$grade="C";
				$qp=(2.00*$CR_HRS);
			}
			else if($marks>=40 && $marks<=49){
				$grade="D";
				$qp=(1.00*$CR_HRS);
			}
			else{
				$grade="F";
				$remarks="FAIL";
				$qp=(0.00*$CR_HRS);
			}
				
		}
		
			//max marks 100
				if($MIN_MARKS == 60){
			$remarks="PASS";
			$marks = $MARKS_OBTAINED[$i];
			
			if($marks >=87 && $marks<=100){
				$grade="A";
				$qp=(4.00*$CR_HRS);
			}else if($marks >=76 && $marks <=86){
				$grade="B";
				$qp=(3.00*$CR_HRS);
			}else if($marks >=60 && $marks<=75){
				$grade="C";
				$qp=(2.00*$CR_HRS);
			}else{
				$grade="F";
				$remarks="FAIL";
				$qp=(0.00*$CR_HRS);
			}
				
			}
			//max marks 100
				if($MIN_MARKS == 50){
			$remarks="PASS";
			$marks = $MARKS_OBTAINED[$i];
			
			if($marks >=80 && $marks<=100){
				$grade="A";
				$qp=(4.00*$CR_HRS);
			}else if($marks >=60 && $marks <=79){
				$grade="B";
				$qp=(3.00*$CR_HRS);
			}else if($marks >=50 && $marks<=59){
				$grade="C";
				$qp=(2.00*$CR_HRS);
			}else{
				$grade="F";
				$remarks="FAIL";
				$qp=(0.00*$CR_HRS);
			}
			
				
			}
		
		
		//max marks 200
		if($MIN_MARKS == 80){
			$remarks="PASS";
			$marks = $MARKS_OBTAINED[$i];
			
			if($marks >=160 && $marks<=200){
				$grade="A";
				$qp=(4.00*$CR_HRS);
			}else if($marks >=120 && $marks <=159){
				$grade="B";
				$qp=(3.00*$CR_HRS);
			}else if($marks >=100 && $marks<=119){
				$grade="C";
				$qp=(2.00*$CR_HRS);
			}
			else if($marks>=80 && $marks<=99){
				$grade="D";
				$qp=(1.00*$CR_HRS);
			}
			else{
				$grade="F";
				$remarks="FAIL";
				$qp=(0.00*$CR_HRS);
			}
				
		}
	
	$query="UPDATE  ledger_details_teacher SET MARKS_OBTAINED=$MARKS_OBTAINED[$i],GRADE='$grade',REMARKS='$remarks',QP='$qp' WHERE ROLL_NO='$ROLL_NO[$i]' AND TEACHER_CODE='$TEACHER_CODE'  AND SL_ID=$SL_ID";
	//$query="DELETE FORM  ledger_details_teacher WHERE ROLL_NO='$ROLL_NO[$i]' AND TEACHER_CODE='$TEACHER_CODE' AND STUDENT_CODE='$STUDENT_CODE' AND SL_ID=$SL_ID";
	//echo($query);
	$result=mysql_query($query);
			$sno++;			
		//echo("</BR>");
		//echo($ROLL_NO[$i]);
		//echo("  ");
		//echo($MARKS_OBTAINED[$i]);
			}
			echo("ok");
			//header("Location: marks_add.php?TEACHER_CODE=$TEACHER_CODE");


?>