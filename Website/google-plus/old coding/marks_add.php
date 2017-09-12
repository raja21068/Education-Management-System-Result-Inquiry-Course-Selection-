<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<?php
	$TEACHER_CODE=mysql_escape_string(strtoupper($_REQUEST['TEACHER_CODE']));
		require_once("../Database.php");
 
	  	  $query="SELECT STUDENT_CODE,SCHEME_ID,BATCH_ID,SL_ID,ROLL_NO, MARKS_OBTAINED, GRADE, COURSE_NO,MIN_MARKS,REMARKS,COURSE_TITLE,REMARKS_PROGRAM_NAME FROM ledger_details_teacher WHERE TEACHER_CODE='$TEACHER_CODE'";
			$result_teacher_list=mysql_query($query);
			$rows=mysql_num_rows($result_teacher_list);
			if($rows<1){
			print("false");
			return;
			}
	?>		

		<script src="../js/responsiveslides.js"></script>
		<script src="js/ValidationTextField.js"></script>
		<script src="../js/jquery.min.js"></script>	
	<?php
	//echo("<body background=../background.gif>");
	?>

		
	 	
	<?php
	
	echo("<center> ");
	echo("<img src=../header_left.gif><br>");
	echo("<font size=7 color='#006666'><b>Subject Wise Sheet</b></font><br> ");
	echo("<font size=6><b>Semester Examinations</b></font><br>");
//	echo("<font size=5><b>University of Sindh, Jamshoro</b></font><br><br>");
		
					echo("<form action='marks_add_sumbit.php' method='post'>");

			 if($rows>0){
                      for($a=0; $a<$rows; $a++){
                        $COURSE_TITLE =mysql_result($result_teacher_list,$a,"COURSE_TITLE");
						$REMARKS_PROGRAM_NAME =mysql_result($result_teacher_list,$a,"REMARKS_PROGRAM_NAME");
						$MARKS_OBTAINED =mysql_result($result_teacher_list,$a,"MARKS_OBTAINED");
						$GRADE =mysql_result($result_teacher_list,$a,"GRADE");
						$MIN_MARKS =mysql_result($result_teacher_list,$a,"MIN_MARKS");
						$REMARKS =mysql_result($result_teacher_list,$a,"REMARKS");
						$SL_ID =mysql_result($result_teacher_list,$a,"SL_ID");
						$BATCH_ID =mysql_result($result_teacher_list,$a,"BATCH_ID");
						$ROLL_NO =mysql_result($result_teacher_list,$a,"ROLL_NO");
						$COURSE_NO =mysql_result($result_teacher_list,$a,"COURSE_NO");
						$SCHEME_ID=mysql_result($result_teacher_list,$a,"SCHEME_ID");
						$STUDENT_CODE=mysql_result($result_teacher_list,$a,"STUDENT_CODE");
						
						if($a==0){
						echo("<font size=5><b></b>$REMARKS_PROGRAM_NAME</font><br><br>");
	echo("<div class='col-md-1'></div>");

echo("<div class='col-md-10'>");
					echo("<div class='table-responsive'>");
	
						echo("<table class='table  table-bordered' table-striped ");
						echo("<TR>");
						echo("    <TH colspan='8'colspan=8  class='danger' style='text-align:center'><h2>$COURSE_TITLE</h2></TH>");
						echo("</TR>");
				
						echo("   <tr>");
						echo("      <th class='info' style='text-align:center'>S.NO</th>");
						echo("      <th class='info' style='text-align:center'>ROLL NO</th>");
						echo("      <th class='info' style='text-align:center'>NAME</th>");
						echo("      <th class='info' style='text-align:center'>FNAME</th>");
						echo("      <th class='info' style='text-align:center'>SURNAME</th>");
						echo("      <th class='info' style='text-align:center'>MIN MARKS</th>");
						echo("      <th class='info' style='text-align:center'>OBTAIN MARKS</th>");
						//echo("      <th>ADD</th>");
						echo("      <th class='info' style='text-align:center'>DELETE</th>");
						echo("   </tr>");
		
						}
						
						$query="select BATCH_ID,ROLL_NO,NAME,FNAME,SURNAME,GENDER from  student_registration where ROLL_NO='$ROLL_NO' AND BATCH_ID='$BATCH_ID'";
							$result=mysql_query($query);
							if($row=mysql_fetch_object($result)){
					
							
							echo("<TR bgcolor='FFFFEF' id='$ROLL_NO'>");
							echo(" <TD align=center>".($a+1)."</TD>");
							echo("<TD>$ROLL_NO</TD>");
							echo("	<TD>$row->NAME</TD> ");
							echo("	<TD>$row->FNAME</TD>  ");
							echo("	<TD>$row->SURNAME</TD> ");
							echo("<TD>$MIN_MARKS</TD>");
							//echo("<TD id='marks'>$MARKS_OBTAINED</TD>");
							echo("<TD><input type='number' id='MARKS_OBTAINED' name='MARKS_OBTAINED' min='0' max='100' maxlength='3' value='$MARKS_OBTAINED' onKeyPress='return keyTrapping(this.event);'></TD>");
							echo("<input type='hidden' id='MIN_MARKS' name='MIN_MARKS' value='$MIN_MARKS'/>");
							echo("<input type='hidden' id='COURSE_NO' name='COURSE_NO' value='$COURSE_NO' />");
							echo("<input type='hidden' id='SCHEME_ID' name='SCHEME_ID' value='$SCHEME_ID' />");
							
							echo("<input type='hidden' name='ROLL_NO' value='$ROLL_NO'/>");
				
							//echo("<input type='hidden'  value='$MARKS_OBTAINED' />");
							echo("<input type='hidden'  id='SL_ID' name='SL_ID' value='$SL_ID'/>");

							echo("<input type='hidden' name='TEACHER_CODE' id='TEACHER_CODE' value='$TEACHER_CODE'/>");
							echo("<td><input type='checkbox'  name='ROLL_NO1' value='$ROLL_NO'/></td>");
							//echo("<td><a href=marks_delete.php?ROLL_NO1=".$ROLL_NO."&TEACHER_CODE=".$TEACHER_CODE."&SL_ID=".$SL_ID.">delete</a></td>");
	
							
			
							echo("</TR>");
						}
				
		
                     
					}
									

						echo("<tr>");	
						echo("<td colspan=6></td>");
						echo("<td><input type='button' id='save' value='SAVE'></td>");
						echo("<TH><input type='button' id='delete' value='delete'></TH>");
							
						echo("</tr>");
					
							echo("</form>");
												
							//echo("<TH></TH>");
						
										}
					
								
								
								echo("<TR bgcolor='FFFFEF'>");
						
								echo("<form action='print_sheet1.php' method='post'>");
								echo("<TH COLSPAN='6'>PRINT SHEET  </TH>");
								echo("<TH><input type='submit' value='print'></TH>");
								echo("<input type='hidden' id='STUDENT_CODE' name='STUDENT_CODE' value='$STUDENT_CODE'/>");
								echo("<input type='hidden' name='REMARKS_PROGRAM_NAME' value='$REMARKS_PROGRAM_NAME'/>");
								echo("<input type='hidden' name='COURSE_TITLE' value='$COURSE_TITLE'/>");
								echo("</form>");

								
								
								echo("<form action='print_sheet.php' method='post'>");
								echo("<TH><input type='submit' value='print1'></TH>");
								echo("<input type='hidden' name='STUDENT_CODE' value='$STUDENT_CODE'/>");
								echo("<input type='hidden' name='REMARKS_PROGRAM_NAME' value='$REMARKS_PROGRAM_NAME'/>");
								echo("<input type='hidden' name='COURSE_TITLE' value='$COURSE_TITLE'/>");
								echo("</form>");
								echo("</TR>");
							
						
						
	echo("</TABLE>");
	  				
			
			
//				$query="select BATCH_ID,ROLL_NO,NAME,FNAME,SURNAME,GENDER from  student_registration where ROLL_NO='$ROLL_NO' AND BATCH_ID=''";
	//						$result=mysql_query($query);
		//					if($row=mysql_fetch_object($result)){
					
//}
					
?>
<div id='myResponse'>
</div>

	


<script>
$("#delete").click(function(){
	alert("delete");
	deleteStudent();
	
});
$("#save").click(function(){
	alert("save");
	addStudent();
	
});

function deleteStudent(){

var TEACHER_CODE = $("#TEACHER_CODE").val();
var SL_ID = $("#SL_ID").val();

//var ROLL_NO =$("#ROLL_NO").attr('checked');
  var ROLL_NO = [];
  
  $('input:checkbox[name=ROLL_NO1]:checked').each(function() {		
	ROLL_NO.push($(this).val());
	 
	        $(this).parents('tr').first().remove();
     });
  
 	//alert(ROLL_NO);
	
//alert(STUDENT_CODE);
//alert(ROLL_NO);
//alert(SL_ID);

	    $.ajax({
		type: "POST",
		url: "marks_delete.php",
		data:{  'TEACHER_CODE' : TEACHER_CODE,
				'ROLL_NO1[]' : ROLL_NO,
				'SL_ID' : SL_ID
			 },
		success: function(html){
		alert(html);
	$('#myResponse').html(data);
		}
  });
}

function addStudent(){

var TEACHER_CODE = $("#TEACHER_CODE").val();
var SL_ID = $("#SL_ID").val();
var MIN_MARKS = $("#MIN_MARKS").val();
var COURSE_NO = $("#COURSE_NO").val();
var SCHEME_ID = $("#SCHEME_ID").val();

//var ROLL_NO =$("#ROLL_NO").attr('checked');
  var ROLL_NO = [];
  $('input[name=ROLL_NO]').each(function() {		
	ROLL_NO.push($(this).val());
  });
  
	//alert(ROLL_NO);
 
 var MARKS_OBTAINED = [];
  
  $('input[name=MARKS_OBTAINED]').each(function() {		
	MARKS_OBTAINED.push($(this).val());

  });
  //alert(MARKS_OBTAINED);
 
 
//alert(STUDENT_CODE);
//alert(ROLL_NO);
//alert(SL_ID);

	    $.ajax({
		type: "POST",
		url: "marks_add_sumbit.php",
		data:{  'TEACHER_CODE' : TEACHER_CODE,
				'ROLL_NO[]' : ROLL_NO,
				'SL_ID' : SL_ID,
				'MARKS_OBTAINED':MARKS_OBTAINED,
				'MIN_MARKS':MIN_MARKS,
				'COURSE_NO':COURSE_NO,
				'SCHEME_ID':SCHEME_ID
				
			 },
		success: function(html){
		alert(html);
	$('#myResponse').html(data);
		}
  });
}
</script>