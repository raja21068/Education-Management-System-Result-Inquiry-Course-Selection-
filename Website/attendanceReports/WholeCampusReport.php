<?php
/**
 * Created by PhpStorm.
 * User: Yasir Mehboob
 * Date: 25-Sep-18
 * Time: 12:09 AM
 */
require_once ('../conn_attendance.php');
?>

<link href="assets/css/bootstrap.css" rel="stylesheet">
<link href="assets/css/css/font-awesome.css" rel="stylesheet">
<link href="assets/css/css/font-awesome.min.css" rel="stylesheet">

<div class="container-fluid">
<div class="row">

    <div class="col-md-12">


<?php

$report = $_GET['report'];
$selectedPer = $_GET['selectedPer'];

if(empty($report) || empty($selectedPer)){

    $db->close();
    die('Asterisk (*) fields are required...!');
}

if($selectedPer == 'ALL'){

    $perModify = '';
}else{

    //$selectedPer = (int)$selectedPer;

    $perModify = 'AND ag.PERCENTAGE '.$selectedPer;
}

//echo $report.'<br>'.$selectedPer;


//die();

$sql = "SELECT ROLL_NO FROM aggregate WHERE MONTH_ID={$report}";

$result = $db->query($sql);

if($db->error){

    die('<p style="color: red"> Error: '.$db->error.'</p>');
}

if(!$result->num_rows){

    $db->close();
    die('<p style="color: red"> Message: Attendance Record Not Available...!</p>');
}

        unset($sql);
        unset($result);

        $sql = "SELECT DEPT_ID,DEPT_NAME FROM department ORDER BY DEPT_NAME";
        $result = $db->query($sql);

    if($db->error){

            die('<p style="color: red"> Error: '.$db->error.'</p>');
        }

    if(!$result->num_rows){

            $db->close();
            die('<p style="color: red"> Message: Department List Not Available...!</p>');
        }

$ignoredDeptListRec = array(

    95,
    96,
    102,
    122,
    105,
    108,
    103,
    110,
    112,
    114,
    107,
    113,
    104,
    109,
    111,
    106,
    99,
    98,
    97,
    100,
    101,
    90,
    82,
    75,
    92,
    116,
    93,
    91,
    94,
    83
);

     while ($rows = $result->fetch_assoc()){

        if(in_array($rows['DEPT_ID'],$ignoredDeptListRec)){
            continue;
        }
        ?>
     <table CLASS="table table-bordered">
         <tr>
             <th class="bg-primary" colspan="8" style="font-size: 14px; text-align: center; text-decoration: solid; font-family: 'Open Sans', sans-serif"> <?php echo $rows['DEPT_NAME']?></th>
         </tr>
<?php

$sqlProgram = "SELECT BATCH_ID,PROGRAM_TITLE,b.YEAR AS YEAR,SHIFT,GROUP_DESC FROM program p, batch b ";
$sqlProgram.= "WHERE p.PROG_ID=b.PROG_ID AND p.DEPT_ID ={$rows["DEPT_ID"]} AND b.YEAR >= '2014'";

$resultProgram = $db->query($sqlProgram);

        if($db->error){

                die('<tr> <th> <p style="color: red"> Error: '.$db->error.'</p> </th> </tr>');
        }

        if(!$resultProgram->num_rows){

                //$db->close();
                 echo('<tr> <th> <p style="color: red"> Message: Degree Programs Are Not Available...!</p> </th></tr>');
        }
        while ($rowsProgram= $resultProgram->fetch_assoc()){


        ?>
            <tr style="font-size: 14px; text-align: center; text-decoration: solid; font-family: 'Open Sans', sans-serif">
                <th class="bg-info"> Program </th>
                <td> <?php echo $rowsProgram['PROGRAM_TITLE']?> </td>
                <th class="bg-info"> Batch </th>
                <td>  <?php echo $rowsProgram['YEAR']?> </td>
                <th class="bg-info"> Shift </th>
                <td> <?php echo $rowsProgram['SHIFT']?> </td>
                <th class="bg-info"> Group </th>
                <td> <?php echo $rowsProgram['GROUP_DESC']?> </td>

            </tr>

            <tr class="bg-danger" style="font-size: 13px; text-align: center; text-decoration: solid; font-family: 'Open Sans', sans-serif">

                <th> S.NO </th>
                <th> ROLL NO </th>
                <th> STUDENT NAME </th>
                <th> FATHER'S NAME </th>
                <th> SURNAME </th>
                <th> TOTAL CLASSES </th>
                <th> PRESENT CLASSES </th>
                <th> PERCENTAGE % </th>
            </tr>

<?php


$sqlAttendance = "SELECT sr.ROLL_NO as ROLL_NO,NAME,FNAME,SURNAME,TOTAL_CLASSES,PRESENT,PERCENTAGE FROM student_registration sr, month_year my, aggregate ag";
$sqlAttendance.= " WHERE sr.ROLL_NO LIKE ag.ROLL_NO AND my.MONTH_ID=ag.MONTH_ID AND sr.BATCH_ID='".$rowsProgram['BATCH_ID']."' AND my.MONTH_ID={$report} {$perModify} ORDER BY sr.NAME";

//echo $sqlAttendance;

$resultAttendance = $db->query($sqlAttendance);

if($db->error){

    die('<p style="color: red"> Error: '.$db->error.'</p>');
}

//if(!$resultAttendance->num_rows){
?>





    <?php
//}

$i =1;

while ($rowsAttendance = $resultAttendance->fetch_assoc()){
    ?>

    <tr style="font-size: 12px; font-family: 'Open Sans', sans-serif; text-align: left"> <td> <?php echo $i ?> </td> <td> <?php echo $rowsAttendance['ROLL_NO']?> </td> <td> <?php echo $rowsAttendance['NAME']?> </td> <td> <?php echo $rowsAttendance['FNAME']?> </td> <td> <?php echo $rowsAttendance['SURNAME']?> </td> <td style="text-align: center"> <?php echo $rowsAttendance['TOTAL_CLASSES']?> </td> <td style="text-align: center"> <?php echo $rowsAttendance['PRESENT']?> </td> <td style="text-align: center"> <?php echo $rowsAttendance['PERCENTAGE'].'%'?> </td> </tr>


    <?php
    $i++;
            } // end of student aggregate fetch while loop

        } // end of program while loop

echo '</table>';
     }  // end of department while loop
?>



    </div>
</div>

</div>