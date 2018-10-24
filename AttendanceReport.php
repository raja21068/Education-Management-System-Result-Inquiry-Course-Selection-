<?php
/**
 * Created by PhpStorm.
 * User: Yasir
 * Date: 31-Aug-18
 * Time: 6:46 PM
 */


require_once ("conn_attendance.php");
?>


   <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->
   <head> 
	<link rel="stylesheet" href="http://104.223.95.210/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="http://104.223.95.210/bootstrap/css/bootstrap.min.css">

</head>
<?php
$rollNo = trim($_GET['roll']);

if(empty($rollNo)){

    $db->close();
    die("<p class='text-danger'> Please Type Roll No <p>");
    
    }

$sql = "SELECT ROLL_NO,NAME,FNAME,SURNAME FROM student_registration WHERE ROLL_NO LIKE '".$rollNo."'";

$result = $db->query($sql);

if($result->num_rows){

    $row = $result->fetch_assoc();
    ?>

    <div class="row">
        
        <div class="col-md-8">

            
            <table class="table table-bordered">
                <tr style="font-size: 15px"> <th style="width: 30%;" class="bg-info"> Roll No </th> <td style="font-weight: bold; text-align: center"> <?php echo $row['ROLL_NO']?> </td> </tr>
                <tr style="font-size: 15px"> <th class="bg-info"> Student Name </th> <td style="font-weight: bold; text-align: center"> <?php echo ucwords(strtolower($row['NAME']));?> </td> </tr>
                <tr style="font-size: 15px"> <th class="bg-info"> Father's Name </th> <td style="font-weight: bold; text-align: center"> <?php echo ucwords(strtolower($row['FNAME']));?> </td> </tr>
                <tr style="font-size: 15px"> <th class="bg-info"> Surname </th> <td style="font-weight: bold; text-align: center"> <?php echo ucwords(strtolower($row['SURNAME']));?> </td> </tr>
            </table>

        <!/div>

    <?php

    $sqlAggregate = "SELECT MONTH,YEAR,TOTAL_CLASSES,PRESENT,PERCENTAGE FROM month_year M INNER JOIN aggregate A ON M.MONTH_ID = A.MONTH_ID AND A.ROLL_NO LIKE '".$row['ROLL_NO']."' AND M.SHOW_COLUMN=1 ORDER BY ORDER_KEY DESC LIMIT 1";

    $resultAggregate = $db->query($sqlAggregate);

    if(!$resultAggregate->num_rows){

        $db->close();

        die("&nbsp;&nbsp;&nbsp;<p class='text-danger'> Attendance Not Available...! <p>");

    }
    ?>









    <!div class="col-md-5">

    <table class="table table-bordered">

        <caption> University of Sindh - IT Services Center (Attendance Cell)</caption>
        <caption style="text-size:13px; font-weight:bold"> Attendance record of all <span style="color: red"> MAJOR </span> subjects only </caption>

<?php
$total =0;
$pre =0;
            while ($recordRows = $resultAggregate->fetch_assoc()){

                $total +=$recordRows['TOTAL_CLASSES'];
                $pre +=$recordRows['PRESENT'];
                ?>
             <tr class="bg-warning" style="font-size: 13px; text-align: center; font-weight:bold"> <th colspan="3" class='text-center'> <?php echo $recordRows['MONTH'].' '.$recordRows['YEAR'] ?> </th> </tr>

                <tr style="font-size: 14px; text-align: center">   <th class='text-center'> Total Classes </th> <th class='text-center'> Present </th> <th class='text-center'> Percentage % </th> </tr>
                <tr style="font-size: 13px; text-align: center"> <td> <?php echo $recordRows['TOTAL_CLASSES']; ?> </td> <td> <?php echo $recordRows['PRESENT']; ?> </td> <td> <?php echo $recordRows['PERCENTAGE'].'%'; ?> </td></tr>

        <?php

            }
            ?>
    <!--    <tr class="bg-warning" style="font-size: 13px; text-align: center"> <th colspan="3" class='text-center'> Complete Aggregate </th> </tr>
        <tr style="font-size: 13px; text-align: center"> <th class='text-center'> Total Classes </th> <th class='text-center'> Present </th> <th class='text-center'> Percentage % </th> </tr>
        <tr style="font-size: small; text-align: center"> <td> <?php echo $total; ?> </td> <td> <?php echo $pre; ?> </td> <td> <?php echo round($pre/$total*100).'%'; ?> </td></tr>-->

        <?php

}else
{
    $db->close();
    die("&nbsp;&nbsp;&nbsp;<p class='text-danger'> Student Not Registered, Contact Director Admissions...! <p>");
}

?>

    </table>
            <ol style="list-style-type: decimal; font-weight:bold; font-size:14px; padding: 10px;"> <p style='color:red'> Notes:</p>

            <!--<li style="font-weight:bold; font-size:14px;"> This attendance record is for the month of August 2018 </li>-->
            
                <li style="font-weight:bold; font-size:14px; color:black">

                 Errors / Ommission (if found any) will be corrected according to the original attendance record
            </li>
            
            <li style="font-size:14px;"> If you have any query <b class='text-danger'> regarding the attendance</b>, <br/> email to: <b class='text-info'> sac @ usindh.edu.pk </b> </li>

            </ol>


    </div>
    </div>
