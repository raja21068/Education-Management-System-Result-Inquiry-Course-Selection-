<?php
/**
 * Created by PhpStorm.
 * User: Yasir
 * Date: 14-Sep-18
 * Time: 2:40 PM
 */
 
require_once ('../conn_attendance.php');


/*if(!isset($_REQUEST['PERMISSION']) && $_REQUEST['PERMISSION']   != base64_encode('payroll') && !isset($_REQUEST['Apikey'])){


$url = base64_encode($_SERVER['PHP_SELF']);
$flag = base64_encode('payroll');

header("LOCATION:lockscreen.php?url=$url&flag=$flag");
exit();

}
else{

    $dept_id_user =  base64_decode($_REQUEST['Apikey']);

    if($dept_id_user == "" || $dept_id_user == null){

        $url = base64_encode($_SERVER['PHP_SELF']);
        $flag = base64_encode('payroll');

        header("LOCATION:lockscreen.php?url=$url&flag=$flag");

    }else{

        if($dept_id_user == 'ALL'){

            $dept_find_query=" 1 ";
            $show_month = " 1 ";
        }else{

       
            $dept_find_query = " DEPT_ID={$dept_id_user} ";
            $show_month = " SHOW_COLUMN=1";



        }
    }
}*/

//$dept_find_query=" 1 ";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Department Wise Report</title>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/css/font-awesome.min.css" rel="stylesheet">


</head>
<body>

<div class="container-fluid">

    <div class="row">
        <div class="col-md-3"></div>

        <div class="col-md-3">

            <h1 style="font-size: 16px; font-weight: bold">Department Report</h1>
            <a href="DeptReport.php">Logout</a>

        </div>
<div class="col-md-3"></div>
        <div class="col-md-3">



        </div>

    </div>

    <div class="row">


        <div class="col-md-4">
            <label> Select Department *</label>
<select id="dept" class="form-control">
    <option value=""> Choose Department</option>

    <?php
    $sql = "SELECT DEPT_ID, DEPT_NAME FROM department WHERE 1 ORDER BY DEPT_NAME ASC";

//    echo $sql;

    $result =  $db->query($sql);

    while ($rows = $result->fetch_assoc()){
        ?>

        <option value="<?php echo $rows['DEPT_ID'];?>"> <?php echo $rows['DEPT_NAME'];?> </option>
    <?php
        }

        unset($rows);
        unset($result);
        unset($sql);
    ?>
</select>
        </div>

        <div class="col-md-3">

            <label> Select Program *</label>
    <select id="program" class="form-control">

        <option value="">Choose Program</option>

    </select>
        </div>

        <div class="col-md-1">
            <label> Select Shift *</label>
    <select id="shift" class="form-control">
        <option value="">Choose</option>
    </select>
        </div>



    </div>

    <div class="row">

        <div class="col-md-2">

            <label> Select Batch *</label>
    <select id="batch" class="form-control">
        <option value="">Choose Batch</option>
    </select>
        </div>
        <div class="col-md-2">
            <label> Select Group *</label>
    <select id="group" class="form-control">
        <option value="">Choose Group</option>
    </select>
        </div>

        <div class="col-md-3">

            <label> Select Report *</label>
    <select id="report" class="form-control">
        <option value="">Choose Attendance Month & Year</option>
        <?php
    $sql = "SELECT MONTH_ID,MONTH,YEAR FROM month_year WHERE 1";
    $result = $db->query($sql);

    while($rows = $result->fetch_assoc()){

        ?>
        <option value="<?php echo $rows['MONTH_ID'];?>"> <?php echo $rows['MONTH'].' - '.$rows['YEAR'];?> </option>
     <?php
    }
        ?>

    </select>
        </div>

<div class="col-md-1">
    <button id="submit" CLASS="btn btn-primary" style="margin-top: 25px">SUBMIT</button>


</div>

    </div>

<div class="row">
<div class="col-md-6">

</div>
    <div class="col-md-6">
        <div id="msg"></div>
        <img id="spinnerGif" src="assets/lg_double_ring_spinner.gif" style="height: 100px; width: 100px; display: none;">
    </div>
</div>



    <div id="Display"></div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery-1.10.2.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->

    <script type="text/javascript">



        $('#submit').on('click',function () {

            //$('#spinnerGif').show();


            var dept_id         = $('#dept').val();
            var program_id      = $('#program').val();
            var shift           = $('#shift').val();
            var batch           = $('#batch').val();
            var group           = $('#group').val();
            var attendanceMonthYear = $('#report').val();

            if(dept_id == "" || program_id == "" || shift == "" || batch == "" || group == "" || attendanceMonthYear == "" ){

                $('#msg').text('Asterisk (*) fields are required...!');
                $('#spinnerGif').hide();
                return;
            }else{

                $('#msg').text('');
            }
                if(confirm('Do you want to processed?') == true){


                    $('#spinnerGif').show();

                    var xhttp;

                    xhttp = new XMLHttpRequest();

                    xhttp.onreadystatechange = function() {

                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("Display").innerHTML = this.responseText;
                            $('#spinnerGif').hide();
                        }
                    };

                    xhttp.open("GET", "DeptWiseReport.php?dept_id="+dept_id+"&program_id="+program_id+"&shift="+shift+"&batch="+batch+"&group="+group+"&attendanceMonthYear="+attendanceMonthYear, true);
                    xhttp.send();


            } // end else if of confirm box

        });

        $('#program').on('change',function () {

            var program_id = $('#program').val();

           if(program_id == "" || program_id == null){
               return;
           }

            var flag ='SELECT PROGRAMS COLUMN';
            $.ajax({
                method: "POST",
                url: "dropDown_function.php",
                data: {program_id: program_id, flag: flag},
                dataType: 'json',
                cache: false,
                async: false,
                success: function (data) {

                    //console.log(data);

                    // this code for shift drop down

                    var op_shift ="";
                    op_shift+="<option value=''>Choose Shift</option>";

                    for (var i=0; i<data[1].length; i++){

                        op_shift+= "<option value="+data[1][i]+">"+data[1][i]+"</option>";
                    }
                    document.getElementById('shift').innerHTML = op_shift

                    // this code for batch drop down

                    var op_batch ="";
                    op_batch+="<option value=''>Choose Batch</option>";

                    for (var j=0; j<data[0].length; j++){

                        op_batch+= "<option value="+data[0][j]+">"+data[0][j]+"</option>";
                    }
                    document.getElementById('batch').innerHTML = op_batch

                    // this code for group drop down

                    var op_group ="";
                    op_group+="<option value=''>Choose Group</option>";

                    for (var k=0; k<data[2].length; k++){

                        op_group+= "<option value="+data[2][k]+">"+data[2][k]+"</option>";
                    }
                    document.getElementById('group').innerHTML = op_group


                }
            });

        });

        $('#dept').on('change',function () {

//alert('working');
            var dept_id = $('#dept').val();

            if(dept_id == "" ||  dept_id == null){
                    return;
            }

            $('#spinnerGif').show();

            var flag ='SELECT PROGRAMS';
            $.ajax({
                method: "POST",
                url: "dropDown_function.php",
                data: {dept_id: dept_id, flag: flag},
                dataType: 'json',
                cache: false,
                async: false,
                success: function (data) {

                 //   console.log(data);
        var op ="";
                    op+="<option value=''>Choose Program</option>";

                    for (var i=0; i<data.length; i++){

                        op+= "<option value="+data[i][0]+">"+data[i][1]+"</option>";
                    }
                    document.getElementById('program').innerHTML = op;

                    //$('#program').innerHTML(op);
                    $('#spinnerGif').hide();
                }
            });
        });
    </script>

</div>

</body>
</html>
