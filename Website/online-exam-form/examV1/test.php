<?php
//require_once('gazet.php');
require_once('../DataBaseManagerForm.php');
require_once('DisplayData.php');
$link=DataBaseManager1::connect();
$rollNo=mysqli_real_escape_string($link,$_REQUEST['rollNo']);

$std_name=mysqli_real_escape_string($link,$_REQUEST['name']);
$semester=mysqli_real_escape_string($link,$_REQUEST['semester']);
$examType=mysqli_real_escape_string($link,$_REQUEST['examType']);
		$pieces = explode("~",$rollNo);
		$rollNo=$pieces[0]; // piece1
		$batch_id=$pieces[1]; // piece2
		
	//	echo($batch_id);
//$batch_id=mysqli_real_escape_string($link,$_REQUEST['batch_id']);
//echo($batch_id);
//$roll_no="2K8/CSE/6";
//$std_name="ASHRAF ALI";
//$semester="1";
$result= DataBaseManager1::getStudentInfo($rollNo,$std_name,$batch_id);
if($row_student=mysqli_fetch_array($result)){

    $name=$row_student['NAME'];
    $fname=$row_student['FNAME'];
    $surname=$row_student['SURNAME'];
    $roll_no=$row_student['ROLL_NO'];
    $batch_id=$row_student['BATCH_ID'];
	$group_desc=$row_student['GROUP_DESC'];
	
		if($group_desc=='COMM'){ $group_desc='MEDL'; }




    $result_scheme_id=DataBaseManager1::getSchemeId($batch_id,$group_desc);
    if($row=mysqli_fetch_array($result_scheme_id)){
        $exam_year=$row['YEAR'];
        $shift=$row['SHIFT'];
        $scheme_id=$row['SCHEME_ID'];
        $dept_name=$row['DEPT_NAME'];
       DisplayData::showData($roll_no,$name,$fname,$surname,$semester,$shift,$dept_name,$batch_id,$scheme_id,$examType);

    }

}
?>

<script type="text/javascript" src="jquery.min.js"></script>
<script>


    $("#add-cources").click(function(){
		var id = $("#courceDetail").val();
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
