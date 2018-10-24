<?php
/**
 * Created by PhpStorm.
 * User: Yasir
 * Date: 14-Sep-18
 * Time: 9:35 PM
 */

require_once ('../conn_attendance.php');

$dept_id = trim($_GET['dept_id']);
$program_id = trim($_GET['program_id']);
$shift = trim($_GET['shift']);
$batch = trim($_GET['batch']);
$group = trim($_GET['group']);
$attendanceMonthYear = trim($_GET['attendanceMonthYear']);


if (empty($dept_id) || empty($program_id) || empty($shift) || empty($batch) || empty($group) || empty($attendanceMonthYear)){

    $db->close();

   die('Asterisk (*) fields are required...!');
}

$sql = "SELECT BATCH_ID,DEPT_NAME,PROGRAM_TITLE,b.YEAR AS YEAR,SHIFT,GROUP_DESC,MONTH,my.YEAR AS MY_YEAR FROM department d, program p, batch b, month_year my ";
$sql.= "WHERE d.DEPT_ID=p.DEPT_ID AND p.PROG_ID=b.PROG_ID AND b.YEAR = '".$batch."' AND b.SHIFT LIKE '".$shift."' AND b.GROUP_DESC LIKE '".$group."' AND d.DEPT_ID = '".$dept_id."' AND p.PROG_ID ='".$program_id."' AND my.MONTH_ID = '".$attendanceMonthYear."'";

$result = $db->query($sql);

if(!$result->num_rows){

    $db->close();
    die('Sorry Department Record Not Found...!');
}
    $rows = $result->fetch_assoc();
?>

<!-- Bootstrap -->
<link href="assets/css/bootstrap.css" rel="stylesheet">
<link href="assets/css/css/font-awesome.css" rel="stylesheet">
<link href="assets/css/css/font-awesome.min.css" rel="stylesheet">
<br>
<div class="row">

    <div class="col-md-2"></div>
    <div class="col-md-8">
    <table CLASS="table">


    <tr> <th class="bg-info ">Department Name</th> <td> <?php echo $rows['DEPT_NAME']; ?> </td> <th class="bg-info"> Batch </th> <td> <?php echo $rows['YEAR']; ?> </td> </tr>
    <tr> <th class="bg-info"> Class/Program </th> <td> <?php echo $rows['PROGRAM_TITLE']; ?> </td> <th class="bg-info"> Attendance </th> <td> <?php echo $rows['MONTH'].' - '.$rows['MY_YEAR']   ?> </td> </tr>
    <tr> <th class="bg-info"> Shift </th> <td> <?php echo $rows['SHIFT']; ?> </td> <th class="bg-info"> Group </th> <td> <?php echo $rows['GROUP_DESC']; ?> </td> </tr>
    <tr> <th class="bg-info"> Action </th> <td> <a href="pdfDeptReport.php?dept_id=<?php echo base64_encode($dept_id)?>&program_id=<?php echo base64_encode($program_id)?>&batch=<?php echo base64_encode($batch)?>&shift=<?php echo base64_encode($shift)?>&group=<?php echo base64_encode($group)?>&attendanceMonthYear=<?php echo base64_encode($attendanceMonthYear)?>" target="_blank"> Print/Download</a>  </td>  </tr>

</table>
    </div>
    <div class="col-md-2"></div>

</div>

<div class="row">

<div class="col-md-2"> </div>
    <div class="col-md-8">
        <div class="table-responsive">
<table class="table table-bordered">
    <tr class="bg-danger" style="font-size: 13px;"> <th> S.NO </th> <th> ROLL NO </th> <th> STUDENT NAME </th> <th> FATHER'S NAME  </th> <th> TOTAL CLASSES  </th> <th> PRESENT  </th> <th> PERCENTAGE %  </th>   </tr>
<?php

$sqlAttendance = "SELECT sr.ROLL_NO as ROLL_NO,NAME,FNAME,SURNAME,TOTAL_CLASSES,PRESENT,PERCENTAGE FROM student_registration sr, month_year my, aggregate ag";
$sqlAttendance.= " WHERE sr.ROLL_NO LIKE ag.ROLL_NO AND my.MONTH_ID=ag.MONTH_ID AND sr.BATCH_ID='".$rows['BATCH_ID']."' AND my.MONTH_ID='".$attendanceMonthYear."' ORDER BY sr.NAME";

//echo $sqlAttendance;

$resultAttendance = $db->query($sqlAttendance);

if($db->error){

    die('<p style="color: red"> Error: '.$db->error.'</p>');
}

if(!$resultAttendance->num_rows){

    $db->close();
    die('Attendance Record Not Available');
}

$i =1;
while ($rowsAttendance = $resultAttendance->fetch_assoc()){
    ?>

    <tr style="font-size: 12px; font-family: 'Open Sans', sans-serif; text-align: left"> <td> <?php echo $i ?> </td> <td> <?php echo $rowsAttendance['ROLL_NO']?> </td> <td> <?php echo $rowsAttendance['NAME']?> </td> <td> <?php echo $rowsAttendance['FNAME']?> </td> <td style="text-align: center"> <?php echo $rowsAttendance['TOTAL_CLASSES']?> </td> <td style="text-align: center"> <?php echo $rowsAttendance['PRESENT']?> </td> <td style="text-align: center"> <?php echo $rowsAttendance['PERCENTAGE'].'%'?> </td> </tr>


<?php
$i++;
}

?>


</table>
        </div>

    </div>
</div>