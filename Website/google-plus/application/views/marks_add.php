
	<?php
	
	echo("<center> ");
	//echo("<img src=../header_left.gif><br>");
	//echo("<font size=7 color='#006666'><b>Subject Wise Sheet</b></font><br> ");
	//echo("<font size=6><b>Semester Examinations</b></font><br>");
	echo("<font size=5><b>University of Sindh, Jamshoro</b></font><br><br>");
	echo("<font size=5><b>$dept_name</b></font><br><br>");

	$REMARKS_PROGRAM_NAME=$lds[0]['REMARKS_PROGRAM_NAME'];
	$COURSE_TITLE=$lds[0]['COURSE_TITLE'];
	$COURSE_NO=$lds[0]['COURSE_NO'];
	$STUDENT_CODE=$lds[0]['TEACHER_ID'];
	$TEACHER_CODE=$lds[0]['TEACHER_CODE'];
	$MIN_MARKS =$lds[0]['MIN_MARKS'];
	$SEMESTER =$lds[0]['SEMESTER'];

	echo("<h4><b>$REMARKS_PROGRAM_NAME $SEMESTER SEMESTER</b></h4><br>");
	echo("<h4><b>$COURSE_TITLE ($COURSE_NO)</b></h4><br>");
	echo("<div class='row'> <div class='col-md-4'>MIN MARKS: <b>$MIN_MARKS</b></div> <div class='col-md-4'>     MAX MARKS: <b>$max_marks</b></div> <div class='col-md-4'>CREDIT HOURS: <b>$cr_hrs </b></div></div><br>");

		 echo form_open('/google_plus_cantroler/lockSheet');

		echo("<div class='table-responsive'>");
					echo("<table class='table table-bordered table-striped' ");
					echo("<TR>");
					//echo("    <TH colspan='8'colspan=8  class='danger' style='text-align:center'><h2>$COURSE_TITLE</h2></TH>");
					echo("</TR>");
						
						echo("   <tr>");
						echo("      <th class='info'>S.NO</th>");
						echo("      <th class='info'>ROLL NO</th>");
						echo("      <th class='info'>NAME</th>");
						echo("      <th class='info'>FNAME</th>");
						echo("      <th class='info'>SURNAME</th>");
				//		echo("      <th class='info'>MIN MARKS</th>");
						echo("      <th class='info'>OBTAIN MARKS</th>");
						
						echo("</tr>");
						$a=1;

					foreach( $lds as $ledgerDetail )

                                {
                                    $MARKS_OBTAINED =$ledgerDetail['MARKS_OBTAINED'];
									$GRADE =$ledgerDetail['GRADE'];
									$REMARKS =$ledgerDetail['REMARKS'];
									$SL_ID =$ledgerDetail['SL_ID'];
									$BATCH_ID =$ledgerDetail['BATCH_ID'];
									$ROLL_NO =$ledgerDetail['ROLL_NO'];
									$COURSE_NO =$ledgerDetail['COURSE_NO'];
									$SCHEME_ID=$ledgerDetail['SCHEME_ID'];
									$NAME=$ledgerDetail['NAME'];
									$FNAME=$ledgerDetail['FNAME'];
									$SURNAME=$ledgerDetail['SURNAME'];
									$IS_LOCKED=$ledgerDetail['IS_LOCKED'];





									echo("<TR>");
							echo(" <TD align=center>".($a++)."</TD>");
							echo("<TD>$ROLL_NO</TD>");
							echo("	<TD>$NAME</TD> ");
							echo("	<TD>$FNAME</TD>  ");
							echo("	<TD>$SURNAME</TD> ");
							//echo("<TD>$IS_LOCKED</TD>");
							//echo("<TD id='marks'>$MARKS_OBTAINED</TD>";

									if($IS_LOCKED == 0){
										echo("<TD><input type='number' id='MARKS_OBTAINED' name='MARKS_OBTAINED' min='0' max='$max_marks' maxlength='3' value='$MARKS_OBTAINED' onKeyPress='return keyTrapping(this.event);'></TD>");

									}else{
										echo("<TD>$MARKS_OBTAINED</TD>");

									}
						//	echo("<TD><input type='number' id='MARKS_OBTAINED' name='MARKS_OBTAINED' min='0' max='100' maxlength='3' value='$MARKS_OBTAINED' onKeyPress='return keyTrapping(this.event);'></TD>");
							echo("<input type='hidden' id='MIN_MARKS' name='MIN_MARKS' value='$MIN_MARKS'/>");
							echo("<input type='hidden' id='COURSE_NO' name='COURSE_NO' value='$COURSE_NO' />");
							echo("<input type='hidden' id='SCHEME_ID' name='SCHEME_ID' value='$SCHEME_ID' />");

							echo("<input type='hidden' name='ROLL_NO' value='$ROLL_NO'/>");
				
							//echo("<input type='hidden'  value='$MARKS_OBTAINED' />");
							echo("<input type='hidden'  id='SL_ID' name='SL_ID' value='$SL_ID'/>");

							echo("<input type='hidden' name='TEACHER_CODE' id='TEACHER_CODE' value='$TEACHER_CODE'/>");
									echo("<input type='hidden' name='IS_LOCKED' id='ISLOCKED' value='$IS_LOCKED'/>");

									echo("</TR>");
						}
				
		

					
									

						echo("<tr>");	
						echo("<td colspan=3></td>");
								echo("<td><input type='button' id='save' value='Save'></td>");

					echo("<td><input type='SUBMIT'  value='Save & Submit'></td>");


					echo form_close();


								
						//		echo("<TR bgcolor='FFFFEF'>");
						//		echo("");
						//echo form_close();
//	echo ("</form>");



	echo("</TR>");
							
						
						
	echo("</TABLE>");
	  				
			
					
?>
<div id='myResponse'>
</div>
	<div class='row'>

		<div class="col-md-4"></div>


<?php

echo form_open('/google_plus_cantroler/print_form');
	echo("<input type='hidden' name='TEACHER_CODE' value='$TEACHER_CODE'/> <td><input type='submit' class='btn btn-primary btn-lg' value='Print'> </td>");
	echo form_close();


?>
	</div>
<script>

$("#save").click(function(){
	var IS_LOCKED = $("#ISLOCKED").val();
	alert(IS_LOCKED);
	if(IS_LOCKED == 0){
		addStudent();
		alert("save sucessfully..");

	}else{
		alert("sheet is already sumbited..");
	}

});



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


		var MARKS_OBTAINED = [];

		$('input[name=MARKS_OBTAINED]').each(function() {
			MARKS_OBTAINED.push($(this).val());

		});
		$.ajax({
			type: "POST",
		url: "http://localhost/google-plus/index.php/google_plus_cantroler/saveSheet",
		data:{  'TEACHER_CODE' : TEACHER_CODE,
				'ROLL_NO[]' : ROLL_NO,
				'SL_ID' : SL_ID,
				'MARKS_OBTAINED':MARKS_OBTAINED,
				'MIN_MARKS':MIN_MARKS,
				'COURSE_NO':COURSE_NO,
				'SCHEME_ID':SCHEME_ID
				
			 },
		success: function(html){
	$('#myResponse').html(data);
		}
  });
}
</script>