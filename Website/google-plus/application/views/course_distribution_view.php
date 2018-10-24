<?php
$attributes = array('target' => '_blank', 'id' => 'myform','class'=>'form-inline');

echo form_open('new_registration_fac/personal_information_save',$attributes);
?>


<div class="form-group">
	<label for="pwd">Department<font color="red">*</font></label>
	<select class="form-control" name="<?php echo Variable::getDEPTID()?>" required>

		<option value="">--Choose--</option>

		<?php
		foreach( $department as $dept )

		{
			$dept_id=$dept['DEPT_ID'];
			$dept_name=	$dept['DEPT_NAME'];

			?>
			<option value="<?php echo '' . $dept_id ?>"> <?php echo '' . $dept_name ?>  </option>

			<?php
		}
		?>
	</select>
</div>





<div class="form-group">
	<label for="pwd">First Name<font color="red">* </font></label>
	<input type="text" class="form-control" pattern="([ a-zA-Z]){3,120}" title="Only Alphabets minimum 3 characters" name="<?php echo Variable::$FIRST_NAME ?>"  required>
</div>
<div class="form-group">
	<label for="pwd">Last Name<font color="red">*</font></label>
	<input type="text" class="form-control" pattern="([ a-zA-Z]){3,120}" title="Only Alphabets minimum 3 characters" name="<?php echo Variable::$LAST_NAME ?>"  required>
</div>




<div class="form-group">
	<label for="pwd">Email Address<font color="red">*(Email address account must be Gmail / Usindh  ) <?php echo $msg ?></font></label>

	<input type="email" class="form-control" name="<?php echo Variable::$EMAIL?>" required>
</div>



<!--    <input type="submit" class="btn btn-default pull-right" value='Next &Gt;' >-->
<button type="submit" class="btn btn-info">Add
	<i class="glyphicon glyphicon-arrow-right"></i>
</button>
<?php echo form_close(); ?>
</br>
</hr>


	<?php

	echo("<center> ");
	//echo("<img src=../header_left.gif><br>");
	//echo("<font size=7 color='#006666'><b>Subject Wise Sheet</b></font><br> ");
	//echo("<font size=6><b>Semester Examinations</b></font><br>");
	echo("<font size=5><b>University of Sindh, Jamshoro</b></font><br><br>");

	/*
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
*/
	?>

	<?php

		 echo form_open('/google_plus_cantroler/lockSheet');

		echo("<div class='table-responsive'>");
					echo("<table class='table table-bordered table-striped' ");
					echo("<TR>");
					//echo("    <TH colspan='8'colspan=8  class='danger' style='text-align:center'><h2>$COURSE_TITLE</h2></TH>");
					echo("</TR>");
						
						
						$a=1;
								$SEM=0;
								$PAR=0;
					foreach( $cd as $courseDist )

                                {
									$SCHEME_ID=$courseDist['SCHEME_ID'];
									$COURSE_NO =$courseDist['COURSE_NO'];
									$COURSE_TITLE =$courseDist['COURSE_TITLE'];
									$SEMESTER =$courseDist['SEMESTER'];
									$PART =$courseDist['SCHEME_PART'];
									$MEMBER_ID_1=$courseDist['MEMBER_ID_1'];
									$PASS=$courseDist['PASS'];
									$COURSE_DISTRIBUITION_ID=$courseDist['COURSE_DISTRIBUITION_ID'];
									 $shift =$courseDist['SHIFT'];
        
                                    $group =$courseDist['GROUP_DESC'];
                                    $progId =$courseDist['PROG_ID'];
									
									if($PART!=$PAR){
										$PAR=$PART;
										echo("<TR>");
											echo("<TH colspan='5' style='text-align: center;' class='success'> PART $PART</TH>");
											echo("</TR>");
									}
									if($SEMESTER!=$SEM){
										$SEM=$SEMESTER;
											echo("<TR>");
											echo("<TH colspan='5' class='danger' style='text-align: center;'> SEMESTER $SEMESTER</TH>");
											echo("</TR>");
											echo("</TR>");
						
												echo("   <tr>");
												echo("      <th class='info' style='text-align: center;'>S.NO</th>");
												echo("      <th class='info' style='text-align: center;'>COURSE NO</th>");
												echo("      <th class='info' style='text-align: center;'>COURSE TITTLE</th>");
												echo("      <th class='info' style='text-align: center;'>NAME</th>");
												echo("      <th class='info' style='text-align: center;'>REMARKS</th>");
																	
												echo("</tr>");
															}
									
                          
									echo("<TR>");
							echo(" <TD align='center'>".($a++)."</TD>");
							echo("<TD>$COURSE_NO</TD>");
							echo("	<TD>$COURSE_TITLE</TD> ");
							
							echo("<TD><SELECT name='member_id_1' id='member_id_1'>");
								echo("<OPTION value=''>SELECT NAME</OPTION>");
								foreach( $fm as $facuilty )

                                
									{
									
									
									$MEMBER_ID=$facuilty['MEMBER_ID'];
									$FIRST_NAME =$facuilty['FIRST_NAME'];
									$LAST_NAME =$facuilty['LAST_NAME'];
									
									?>
									
									<OPTION value='<?php echo $MEMBER_ID; ?>' <?php if($MEMBER_ID_1 == $MEMBER_ID){echo "selected";}?> ><?php echo("$FIRST_NAME $LAST_NAME"); ?> </OPTION>");
									<?php
									}
								echo("</SELECT></TD>");
								echo("<TD><input type='hidden' id='REMARKS' name='REMARKS' /></TD>");	
								echo("<input type='hidden' id='COURSE_NO' name='COURSE_NO' value='$COURSE_NO' />");
								echo("<input type='hidden' id='COURSE_DISTRIBUITION_ID' name='COURSE_DISTRIBUITION_ID' value='$COURSE_DISTRIBUITION_ID' />");
								echo("<input type='hidden' id='SCHEME_ID' name='SCHEME_ID' value='$SCHEME_ID' />");
								echo("<input type='hidden' id='PASS' name='PASS' value='$PASS' />");

								
								
								
								
								
								
								
						//	echo("	<TD>$FNAME</TD>  ");
						//	echo("	<TD>$SURNAME</TD> ");
							//echo("<TD>$IS_LOCKED</TD>");
							//echo("<TD id='marks'>$MARKS_OBTAINED</TD>";

/*						
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
*/
									echo("</TR>");
						}
				
		

					
									

						echo("<tr>");	
						echo("<td colspan=3></td>");
								echo("<td><input type='button' id='save' value='Save'></td>");

					//echo("<td><input type='SUBMIT'  value='Save & Submit'></td>");


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

	echo form_open('/course_distribution_cantroler/print_form');
	
	?>
	            <input type="hidden" name="prog_id" value="<?php echo $progId ?>">
                
                
                <input type="hidden" name="group_desc" value="<?php echo $group ?>">
                
                <input type="hidden" name="shift" value="<?php echo $shift ?>">
	<?php
	echo("<td><input type='submit' class='btn btn-primary btn-lg' value='Print'> </td>");
	echo form_close();


?>
	</div>


<script>

$("#save").click(function(){
	addStudent();
		
});



			function addStudent(){
		
		var NAME1 = [];
	$('select[name=member_id_1]').each(function() {
			NAME1.push($(this).val());
//			alert(NAME1);
		});

	var COURSE_DISTRIBUITION_ID = [];
	$('input[name=COURSE_DISTRIBUITION_ID]').each(function() {
			COURSE_DISTRIBUITION_ID.push($(this).val());
//			alert(NAME1);
		});
	
		var COURSE_NO = [];
		$('input[name=COURSE_NO]').each(function() {
			COURSE_NO.push($(this).val());
	//		alert(NAME1);
		});
			var PASS = [];
		$('input[name=PASS]').each(function() {
			PASS.push($(this).val());
	//		alert(NAME1);
		});
		var REMARKS = [];
		$('input[name=REMARKS]').each(function() {
			REMARKS.push($(this).val());
	//		alert(NAME1);
		});



		var SCHEME_ID = $("#SCHEME_ID").val();
//alert(SCHEME_ID);
		$.ajax({
			type: "POST",
//		url: "http://localhost/google-plus/index.php/course_distribution_cantroler/saveCourseDistribution/",
					url: "http://104.223.95.210/google/index.php/course_distribution_cantroler/saveCourseDistribution/",

			data:{  'NAME1' : NAME1,
				'COURSE_NO' : COURSE_NO,
				'PASS' : PASS,
				'SCHEME_ID':SCHEME_ID,
					'COURSE_DISTRIBUITION_ID':COURSE_DISTRIBUITION_ID,
				'REMARKS':REMARKS
			 },
		success: function(e){
			alert(e);
	//$('#myResponse').html(data);
		}
  });
}
</script>