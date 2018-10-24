<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" type="image/gif" href="images/animated_favicon1.gif">

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>ATTENDANCE CELL</title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<style>
/* The container */
.containerCheckBox {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 18px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default checkbox */
.containerCheckBox input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #bfbfbf;
}

/* On mouse-over, add a grey background color */
.containerCheckBox:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.containerCheckBox input:checked ~ .checkmark {
    background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.containerCheckBox input:checked ~ .checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.containerCheckBox .checkmark:after {
    left: 9px;
    top: 5px;
    width: 7px;
    height: 12px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
.rollNumDisplay{
    display:block;
    height:350px;
    overflow-y: scroll;
   
}
.showRollNum {
    
    float:left;
    font-weight:bold;
    font-size:13px;
    width:20%;
    overflow:hidden;
 }
 
 @media screen and (max-width: 600px) {
    .showRollNum {
        width: 100%;
    }
}
</style>

<style>
            button {
                background-color: blue;
                height: 100px;
                width: 150px;
            }

.ButtonClicked {
    background-color:Red;
}
</style>
<?php
     require_once("Database.php");
     require_once("conn_attendance.php");


	
	$no_of_classes  		=mysql_real_escape_string($_REQUEST["no_of_classes"]);    
	$course_distribution_id	=mysql_real_escape_string($_REQUEST["course_distribution_id"]);
	$date_of_attandance=mysql_real_escape_string($_REQUEST['date_of_attandance']);
	
	
	
		$query="SELECT * FROM `course_distribution` WHERE `COURSE_DISTRIBUITION_ID`=$course_distribution_id";
		//	    	echo($query);		    
				$result_course_distribution=mysql_query($query);
			     if($row_course_distribution=mysql_fetch_object($result_course_distribution)){
				
							$SCHEME_ID=$row_course_distribution->SCHEME_ID;
							$COURSE_NO=$row_course_distribution->COURSE_NO;
							$COURSE_TITLE=$row_course_distribution->COURSE_TITLE;
							$SEMESTER=$row_course_distribution->SEMESTER;
							$SCHEME_PART=$row_course_distribution->SCHEME_PART;
							$CR_HRS=$row_course_distribution->CR_HRS;
							$DEPT_ID=$row_course_distribution->DEPT_ID;
							$PROG_ID=$row_course_distribution->PROG_ID;
							$YEAR=$row_course_distribution->YEAR;
							$MEMBER_ID_1=$row_course_distribution->MEMBER_ID_1;
							$SHIFT=$row_course_distribution->SHIFT;
							$GROUP_DESC=$row_course_distribution->GROUP_DESC;
							$REMARKS=$row_course_distribution->REMARKS;
							$COURSE_DISTRI_ID = $row_course_distribution->COURSE_DISTRIBUITION_ID;
							
							$batchYear=$YEAR-($SCHEME_PART-1);
						$querybatch="SELECT b.`BATCH_ID`,p.`PROGRAM_TITLE`,b.`GROUP_DESC`,b.`SHIFT`,b.`YEAR` FROM batch AS b
									INNER JOIN program AS p ON p.`PROG_ID`=b.`PROG_ID`
									WHERE b.`PROG_ID`='$PROG_ID'
									AND b.`YEAR`='$batchYear'
									AND b.`SHIFT`='$SHIFT'
									AND b.`GROUP_DESC`='$GROUP_DESC'";
								//echo($querybatch."</br>");		
								$result_batch=mysql_query($querybatch);
								$row_batch=mysql_fetch_object($result_batch);
								
								$BATCH_ID=$row_batch->BATCH_ID;	
								$queryStudentRegistration="SELECT BATCH_ID,ROLL_NO,NAME,FNAME,SURNAME,GENDER FROM  student_registration WHERE BATCH_ID=$BATCH_ID ORDER BY NAME ASC";
								//echo($queryStudentRegistration);
															//	echo("<body background=background.gif>");
															
															$queryDeptName="SELECT DEPT_NAME FROM department WHERE DEPT_ID=$DEPT_ID";
								//echo($querybatch."</br>");		
								$result_DeptName=mysql_query($queryDeptName);
								$row_DeptName=mysql_fetch_object($result_DeptName);
								
								
								
								        $queryChecktotalClasses = "SELECT TOTAL_CLASS,DATE_FORMAT(DATE_OF_ATTANDANCE,'%d/%M/%y') AS DATE_OF_ATTANDANCE  FROM attandance WHERE COURSE_DISTRIBUTION_ID=$COURSE_DISTRI_ID AND DATE_OF_ATTANDANCE = '".$date_of_attandance."' LIMIT 1 ";
	
	//echo $queryChecktotalClasses;
	
	    $resultCheckTotalClasses = $db->query($queryChecktotalClasses);
	    
	
	  // if($resultCheckTotalClasses->num_rows){
	        
	
	 $rowsCheckTotalClasses = $resultCheckTotalClasses->fetch_object();
	 
	 
	 //echo $rowsCheckTotalClasses['DATE_OF_ATTANDANCE'];
	   //}
								echo("<center> ");
								//echo("<img src=header_left.gif><br>");


							echo("<div class='col-md-12'>");
							//		echo("<div class='table-responsive'>");
								
									echo("<table class='table  table-bordered table-hover  id='att' ");
											echo("<tr class='info'>");
											echo ("<th>DEPARTMENT NAME: <label style='font-size:14px; font-weight:bold; text-style:justify;'> $row_DeptName->DEPT_NAME </label> </th> 
											<th>PROGRAM TITLE: <label style='font-size:14px; font-weight:bold; text-style:justify;'> $row_batch->PROGRAM_TITLE </label> </th>
											<th>BATCH: <label style='font-size:14px; font-weight:bold; text-style:justify;'> $row_batch->YEAR </label> </th> </tr> ");
											
											echo("<tr class='info'>");
											echo("<th>GROUP: <label style='font-size:14px; font-weight:bold; text-style:justify;'>$row_batch->GROUP_DESC </label> </th>");
											echo("<th>SHIFT: <label style='font-size:14px; font-weight:bold; text-style:justify;'>$row_batch->SHIFT </label> </th>");
								 	echo ("<th>DATE: <label style='font-size:14px; font-weight:bold; text-style:justify;'>$rowsCheckTotalClasses->DATE_OF_ATTANDANCE </label> </th>");
											
											echo("</TR>");
											
											echo("<tr class='info'><th>COURSE NO: <label style='font-size:14px; font-weight:bold; text-style:justify;'>$COURSE_NO </label> </th>");
											echo(" <th>COURSE TITLE: <label style='font-size:14px; font-weight:bold; text-style:justify;'> $COURSE_TITLE </label> </th>");
											echo ("<th colspan='2'>NO. OF CLASS: <label style='font-size:14px; font-weight:bold; text-style:justify;'> $rowsCheckTotalClasses->TOTAL_CLASS </label> </th> ");
											
											echo("</TR>");
											
										echo("   <tr>");
								// 			echo("      <th>S.NO</th>");
								// 			echo("      <th>ROLL NO</th>");
								// 		//	echo("      <td>NAME</td>");
								// 		//	echo("      <td>FATHER'S NAME</td>");
								 			echo("    <td> </td>  <td> </td> <td>  <label class='containerCheckBox' style='font-size:13px'> Check All <Input Type='checkbox' name='checkAll' id='checkAll'> <span class='checkmark'></span></label></td>");
									//	echo("      <td><Input Type='radio' name='checkAll' id='checkAll' value='P'  >P <Input Type='radio' name='checkAll' id='checkAll' value='A' >A</td>");
				
							 			echo("</tr>");
								
												$sno=0;

								$result_studentRegistration=mysql_query($queryStudentRegistration);
								
								echo("<tr>  <td colspan='3'>");
								// echo ("<div class=''>");
								
								while($row_studentRegistration=mysql_fetch_object($result_studentRegistration)){
										
										  $ROLL_NO=$row_studentRegistration->ROLL_NO;
										  
										  							$sno=$sno+1;
										
									//	echo("<tr>  <td>$sno</td>");
									//	echo("<td>$ROLL_NO</td>");
									//	echo ("<th> $row_studentRegistration->NAME</TH>");
									//	echo ("<th> $row_studentRegistration->FNAME </th>");
										
										
										
							$queryIspresent = "SELECT ISPRESENT FROM attandance WHERE COURSE_DISTRIBUTION_ID = '$COURSE_DISTRI_ID' AND ROLL_NO LIKE '$ROLL_NO' AND DATE_OF_ATTANDANCE = '$date_of_attandance'";
							
							//echo $queryIspresent;
							$resultIspresent = $db->query($queryIspresent);
							
							if($resultIspresent->num_rows)
							{
							    $rowIspresent = $resultIspresent->fetch_assoc();
							    
							    if($rowIspresent['ISPRESENT'] == 1)
							    {
							        
//   <input type="checkbox" checked="checked">
  


							        
							        echo("<label class='containerCheckBox showRollNum'> <Input type='checkbox' name='present' checked> <span class='checkmark'></span>[$ROLL_NO]</label> ");
							        
							    }
							    else
							    {
							        echo(" <label class='containerCheckBox showRollNum'> <Input type='checkbox' name='present' > <span class='checkmark'></span>[$ROLL_NO]</label> ");
							        
							    }
							    
							}
							else
							{
							    echo(" <label class='containerCheckBox showRollNum'>  <Input type='checkbox' name='present' > <span class='checkmark'></span> [$ROLL_NO]</label>");
							    
							}
							
			
										
										
										
										//echo("</tr>");
									
										echo("<input type='hidden' id='COURSE_NO' name='COURSE_NO' value='$COURSE_NO' />");
										echo("<input type='hidden' id='ROLL_NO' name='ROLL_NO' value='$ROLL_NO' />");
										echo("<input type='hidden' id='course_distribution_id' name='course_distribution_id' value='$course_distribution_id' />");
										echo("<input type='hidden' id='no_of_classes' name='no_of_classes' value='$no_of_classes' />");
										echo("<input type='hidden' id='date_of_attandance' name='date_of_attandance' value='$date_of_attandance' />");
										echo("<input type='hidden' id='SCHEME_ID' name='SCHEME_ID' value='".$SCHEME_ID."' />");
										echo("<input type='hidden' id='SEMESTER' name='SEMESTER' value='".$SEMESTER."' />");
										echo("<input type='hidden' id='DEPT_ID' name='DEPT_ID' value='".$DEPT_ID."' />");
										echo("<input type='hidden' id='PROG_ID' name='PROG_ID' value='".$PROG_ID."' />");
										echo("<input type='hidden' id='SHIFT' name='SHIFT' value='".$SHIFT."' />");
										echo("<input type='hidden' id='GROUP_DESC' name='GROUP_DESC' value='".$GROUP_DESC."' />");
										echo("<input type='hidden' id='YEAR' name='YEAR' value='".$YEAR."' />");
										
										
								}
								echo (" <!/div> </td> </tr>");
									echo("<TR>");	
										echo("<td colspan='1'></td>");
										//echo ("<td> </td>");
										echo("<td><input type='button' id='save' value='Submit'> </td> <td> <input type='button' id='cancel' value='Cancel' class='btn-danger'></td>");
										echo("</TR>");
									echo ("<tr> <td colspan='3'> <img src='attendanceReports/assets/lg_double_ring_spinner.gif' id='progress' style='height:60px; width:60px; display:none'> </td> </tr>");
				}
								
							
				   
				   
			echo("</table>");
			echo("</div>");
	  		echo("</div>");
	//  		echo("</div>");
	  		
	  		
	echo("<br>");
	
	echo("</center> ");

	echo("</body>");
?>
<!--<button id="ButtonId">Hello</button>-->
<script>
$("#checkAll").change(function(){

  if (! $('input:checkbox').is('checked')) {
      $('input:checkbox').prop('checked',true);
  } else {
      $('input:checkbox').prop('checked', false);
  }       
});
</script>


<script>

$("#cancel").click(function(){
	
	location.reload();
		
});

$("#save").click(function(){
	
	addStudent();
		
});



			function addStudent(){
			    
			    
		var course_distribution_id = $("#course_distribution_id").val();

		var COURSE_NO = $("#COURSE_NO").val();
	
		
			var ROLL_NO = [];
		$('input[name=ROLL_NO]').each(function() {
			ROLL_NO.push($(this).val());
			//alert(ROLL_NO);
		});
		var present = [];
		$('input[name=present]').each(function() {
			//-------Code For Button Push
			//var x= $(this).toggleClass('ButtonClicked');
	        //var color= getBackgroundColor(x);
            //alert(color);
            //if (color=='rgb(0, 0, 255)') {
            
            
			if ($(this).prop('checked')==true) {
			    
			
			present.push(1);
			
			}else{
				
			//present.push($(this).val());
			present.push(0);
			}
			//alert(ROLL_NO);
		});
		
		
		var date_of_attandance = $("#date_of_attandance").val();
		var no_of_classes = $("#no_of_classes").val();
		var SEMESTER = $("#SEMESTER").val();
		
		var SCHEME_ID = $("#SCHEME_ID").val();
		var DEPT_ID = $("#DEPT_ID").val();
		var PROG_ID = $("#PROG_ID").val();
		var SHIFT= $("#SHIFT").val();
		
		var GROUP_DESC= $("#GROUP_DESC").val();
		var YEAR= $("#YEAR").val();
		
		//console.log(present);
		
		var countPresent = 0;
		var countAbsent = 0;
        for(var j= 0; j < present.length; j++){
        
        if(present[j] == 1){
        
        countPresent++;
        }else if (present[j] == 0){
            countAbsent++;
        }
			}
			
			if(no_of_classes == "" || no_of_classes == null){
			    
			    alert('Please type number of classes');
			    
			    return;
			}else if( no_of_classes ==0){
			    
			    if(confirm('Are you sure want to delete attendance record?') == false){
			        
			        return;
			    }
			}
        
        if(confirm("Total Class: "+no_of_classes+"          Date: "+date_of_attandance+"\n"+"Present: "+countPresent+"         Absent: "+countAbsent+"\n"+"Do you want to process further?")== false ){
            
            return;
        }
        
         $("#save").attr("disabled", true);
	 $("#save").hide();
	  $("#cancel").hide();
	 
	 $("#progress").show();
	 
	 
        //alert("Present"+countPresent+" Absent"+countAbsent);

		
		//alert(no_of_classes);
		$.ajax({
			type: "POST",
//		url: "http://localhost/google-plus/index.php/course_distribution_cantroler/saveCourseDistribution/",
					url: "attandanceSave.php",

			data:{  'course_distribution_id' : course_distribution_id,
				'COURSE_NO' : COURSE_NO,
				'ROLL_NO' : ROLL_NO,
				'date_of_attandance':date_of_attandance,
				'no_of_classes':no_of_classes,
				'SCHEME_ID':SCHEME_ID,
				'SEMESTER':SEMESTER,
				'DEPT_ID':DEPT_ID,
				'PROG_ID':PROG_ID,
				'SHIFT':SHIFT,
				'GROUP_DESC':GROUP_DESC,
				'YEAR':YEAR,
				'present':present
			 },
		success: function(e){
		    
		    $('#progress').hide();
			alert(e);
			$("#att").hide();
	//('#myResponse').html(e);
		}
  });
}
</script>

<script>
var color = '';
$('#ButtonId').on('click',function(){
    var x= $(this).toggleClass('ButtonClicked');
	var color= getBackgroundColor(x);
    alert(color);
});





function getBackgroundColor($dom) {
    var bgColor = "";
    while ($dom[0].tagName.toLowerCase() != "html") {
      bgColor = $dom.css("background-color");
      if (bgColor != "rgba(0, 0, 0, 0)" && bgColor != "transparent") {
        break;
      }
      $dom = $dom.parent();
    }
    return bgColor;
  }
</script>
    
 