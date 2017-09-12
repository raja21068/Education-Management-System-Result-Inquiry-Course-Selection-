	<!-- Java Script
    ================================================== -->
	<script src="http://exam.usindh.edu.pk/scripts/jquery.min.js"></script>
	<script src="http://exam.usindh.edu.pk/scripts/jquery-ui.min.js"></script>
	<script src="http://exam.usindh.edu.pk/scripts/jquery.layerslider.min.js"></script>
	<script src="http://exam.usindh.edu.pk/scripts/custom.js"></script>

<?php
		require_once('../DataBaseManagerForm.php');
		require_once('DisplayData.php');
		
		$link=DatabaseManager1::connect();
			//session_start();
			$rollNo=mysqli_real_escape_string($link,$_REQUEST['rollNo']);
			//$rollNo = str_replace('-', '/', $rollNo);

			$semester=mysqli_real_escape_string($link,$_REQUEST['semester']);
			$current_year=2016;
			$decodeRollNo=DataBaseManager1::getRollNoDecode($rollNo);
			$batchYear=DataBaseManager1::get_batch_year_decode($decodeRollNo);

			//echo("Raja".$batchYear);
			$examType=DataBaseManager1::getExamType($semester,$current_year,$batchYear);
		
				



					   ?>

					<?php

						$count=0;
					$result_student=DatabaseManager1::getStudentInformation($rollNo);
					//echo($result_student);
					$count=mysqli_num_rows($result_student);
					
					
					
					// ---------------------------for two records-----------------------------//
					if($count>1){
				echo("<input type='hidden' name='examType' id='examType' value=$examType>");		
						echo("<select name='std_combo' id='std_combo'>");
						echo("<option value=''>select name</option>");
					while($row_student=mysqli_fetch_array($result_student)){
						$name=$row_student['NAME'];
						$fname=$row_student['FNAME'];
						$roll_no=$row_student['ROLL_NO'];
						$batch_id=$row_student['BATCH_ID'];
					//	$str=$name."". $fname ;
					echo("<option value='$roll_no~$batch_id'>$name</option>");
					}
						echo("</select>");

					}
					
					// ---------------------------end-----------------------------//



//					echo(" ");

					$tempBatch_id=0;
				//	$tempRollNo="";

					while($row_student=mysqli_fetch_array($result_student)){
						?>
				<?php
							$name=$row_student['NAME'];
							$fname=$row_student['FNAME'];
							$surname=$row_student['SURNAME'];
							$roll_no=$row_student['ROLL_NO'];
							$batch_id=$row_student['BATCH_ID'];
							$group_desc=$row_student['GROUP_DESC'];
							if($group_desc=='COMM'){
								$group_desc='MEDL';
							}


				$result_scheme_id=DataBaseManager1::getSchemeId($batch_id,$group_desc);
				if($row=mysqli_fetch_array($result_scheme_id)){
							$exam_year=$row['YEAR'];
							$shift=$row['SHIFT'];
							$scheme_id=$row['SCHEME_ID'];
							$dept_name=$row['DEPT_NAME'];
							
							
				}

						//$part=DataBaseManager1::getpart($semester);
						//$sl_id=get_last_SL_ID($batch_id,$part,$rollNo);

						?>


	<?php
							/*

						if($batch_id==$tempBatch_id){
							continue;
								}
							$tempBatch_id=$batch_id;
							*/
						DisplayData::showData($roll_no,$name,$fname,$surname,$semester,$shift,$dept_name,$batch_id,$scheme_id,$examType);


					}

					?>
<?php
				echo("</DIV>");
				echo("</DIV>");



						?>
<script type="text/javascript" src="jquery.min.js"></script>
<script>


	$("#std_combo").change(function(){
		var rollNo = $("#std_combo").val();
		var name = $("#std_combo option:selected").text();
		var semester = <?php echo $semester; ?>;
		var batch_id = <?php echo $batch_id; ?>;
		var examType = $("#examType").val();
	
		$.post("test.php", {
			rollNo: rollNo,
			name:name,
			semester: semester,
			examType:examType
			}, function(response) {
			//	alert(response);
			$("#studentData").html(response);

		});



	});

	$("#add-cources").click(function(){
				
		var id = $("#courceDetail").val();
		if(id==null){
			return;
		}
		//alert(id);
		var txt = $("#courceDetail option:selected").text();
		addDataInTable(id,txt);
	});

	function addDataInTable(id,txt){
		var len = ($("#table-body-courceDetail tr").length)+1;
		$("#table-body-courceDetail").append("<tr id='"+id+"'><td>"+len+"</td><input type='hidden' name='courceArray[]' value='"+id+"'><td>"+txt+"</td><td><input type='button' onclick=\"deleteDataInTable('"+id+"','"+txt+"');\" value='X' ></td></tr>");
		$("#courceDetail option[value='"+id+"']").remove();
		  $("#courceDetail").siblings("[value='"+id+"']").remove();
		//$("#my-div").append("");
		// for fix students
		/*
		 var choiceLen = $("#student_id option").length;
		 if(len >= 3 || choiceLen == 0){
		 $("#add-student").attr('disabled','disabled');
		 $("#add-student").removeClass('btn-default');
		 }
		 */

	}

	function deleteDataInTable(elementNo,txt){
		//alert("aaa");
		//$(elementNo).parent().parent().remove();

		$("#table-body-courceDetail tr[id='"+elementNo+"']").remove();
		$("#courceDetail").prepend("<option value=\""+elementNo+"\" >"+txt+"</option>");
		$("#table-body-courceDetail tr").each(function(index,elem){
			var no = (index +1);
			var d = $(elem).children().get(0);
			$(d).html(no);

		});

	}

</script>
