<?php
/**
 * Created by PhpStorm.
 * User: Yasir Mehboob
 * Date: 26-Sep-18
 * Time: 11:29 PM
 */

require_once ('../conn_attendance.php')
?>
<!DOCTYPE html>
<html>
<head>
    <title> Campus Reports</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/css/font-awesome.css" rel="stylesheet">
    <link href="assets/css/css/font-awesome.min.css" rel="stylesheet">

</head>
<body>

<div class="container-fluid">
    <h1 style="font-size: 16px; font-weight: bold">Campus Report</h1>
    <div class="row">

        <div class="col-md-4">

            <label> Select Report *</label>
            <select id="reportCampus" class="form-control">
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

        <div class="col-md-3">
            <label> Select Percentage</label>
            <select id="perLevel" class="form-control">
                <option value="ALL"> ALL </option>
                <option value=">=90"> Greater Than Equal to 90%</option>
                <option value=">=80"> Greater Than Equal to 80%</option>
                <option value=">=70"> Greater Than Equal to 70%</option>
                <option value=">=60"> Greater Than Equal to 60%</option>
                <option value=">=50"> Greater Than Equal to 50%</option>
                <option value=">=40"> Greater Than Equal to 40%</option>
                <option value=">=30"> Greater Than Equal to 30%</option>
                <option value=">=20"> Greater Than Equal to 20%</option>
                <option value=">=10"> Greater Than Equal to 10%</option>
                <option value=">=5"> Greater Than Equal to 5%</option>
                <option value="<50"> Less Than 50%</option>
                <option value="<40"> Less Than 40%</option>
                <option value="<30"> Less Than 30%</option>
                <option value="<20"> Less Than 20%</option>
                <option value="<10"> Less Than 10%</option>
            </select>

        </div>
        <div class="col-md-1">

            <button id="FetchCampusReport" CLASS="btn btn-success btn" style="margin-top: 25px">SUBMIT</button>
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

</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery-1.10.2.js"></script>

</body>
<script type="text/javascript">

    $('#FetchCampusReport').on('click',function () {

        var report = $('#reportCampus').val();
        var selectedPer = $('#perLevel').val();

        if(report == "" || report == null)
        {

            $('#msg').text('Asterisk (*) fields are required...!');
            return;
        }

        if(confirm('Do you want to fetch campus report?') == false)
        {
            $('#msg').text('');
            return;
        }else
        {
            $('#msg').text('');

            $('#spinnerGif').show();

            var xhttp;

            xhttp = new XMLHttpRequest();

            xhttp.onreadystatechange = function() {

                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("Display").innerHTML = this.responseText;
                    $('#spinnerGif').hide();
                }
            };

            xhttp.open("GET", "WholeCampusReport.php?report="+report+"&selectedPer="+selectedPer, true);
            xhttp.send();

        } // else confirm dialogue box
    });

</script>
</html>
