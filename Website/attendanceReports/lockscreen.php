<?php
/**
 * Created by PhpStorm.
 * User: Yasir Mehboob
 * Date: 31-May-18
 * Time: 2:57 AM
 */

require_once ('../conn_attendance.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lock Screen</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>-->
    <script src="assets/lib/html5shiv.min.js"></script>
    <!-- <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->
    <script src="assets/lib/respond.min.js"></script>
    <!-- <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>-->
    <!-- <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->

    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">-->

    <style>
        [data-letters]:before {
            content:attr(data-letters);
            display:inline-block;
            font-size:1.5em;
            width:2.5em;
            height:2.5em;
            line-height:2.5em;
            text-align:center;
            border-radius:50%;
            background:cornflowerblue;
            vertical-align:middle;
            margin-right:1em;
            color:white;
        }
    </style>

</head>
<body class="hold-transition lockscreen">

<?php

if(isset($_POST['PinCodeActivity'])){

    $sendTo  = ($_POST['sendTo']);
    $username = trim($_POST['username']);
    $pass = trim($_POST['pass']);
    $flag    = ($_POST['flag']);
    $ok ="";

echo base64_decode($sendTo);

  if(!isset($_POST['sendTo']) || !isset($_POST['flag'])){

        $msg = base64_encode(" Sorry. Your request is not from proper Channel");

        header("location:lockscreen.php?MSG=$msg");
        //$ok = 0;
    }
    else{
        $ok=1;

     //   header("LOCATION:lockscreen.php?url=$sendTo&flag=$flag");
    }


    if($ok == 1){

        if(empty($username) || empty($pass)){

            $msg = base64_encode("Please Enter User Credentials.");
            $ok = 0;
            header("LOCATION:lockscreen.php?url=$sendTo&flag=$flag&MSG=$msg");
        }else
            {

                // for itsc personal account

                $adminUsername= md5('itsc');
                $adminPass=md5('itsc@123');

             if (md5($username) == $adminUsername && md5($pass) == $adminPass)
             {
                 $ok = 1;
                 $permission = base64_encode('payroll');
                 $apiKey = base64_encode('ALL');
                 $path = base64_decode($sendTo);
                 header("LOCATION:$path?PERMISSION=$permission&Apikey=$apiKey");
             }
             else
             {
                 $pass = md5($pass);
                 
                 $stmt = $db->prepare("SELECT DEPT_ID FROM department WHERE DEPT_USERNAME=? AND DEPT_PASS=?");

                 

                 $stmt->bind_param('ss',$username,$pass);

                 $stmt->execute();

                 if($stmt->num_rows === 0) {

                     $stmt->bind_result($DEPT_ID);
                     $stmt->fetch();

                     if (empty($DEPT_ID) || $DEPT_ID == null) {

                         //  accesslogs($username,'Sign in Failed - IP address '.$clientIp);
                         $db->close();
                         $stmt->close();

                         $msg = base64_encode(' Invalid User Credentials');
                         $ok = 0;
                         header("LOCATION:lockscreen.php?url=$sendTo&flag=$flag&MSG=$msg");

                     } else {

                         //die($DEPT_ID);

                         $ok = 1;
                         $permission = base64_encode('payroll');
                         $apiKey = base64_encode($DEPT_ID);
                         $path = base64_decode($sendTo);
                         header("LOCATION:$path?PERMISSION=$permission&Apikey=$apiKey");
                     }


                 }
             }

        }

     /*   if($ok == 1){

            if($flag ==  base64_encode('payroll')){

                if(file_exists('txt files/payRollPinCodeFile.txt')) {

                    $data = file_get_contents('txt files/payRollPinCodeFile.txt');
                    $data = json_decode($data);

                    if(isset($data)) {

                        if($pincode != "$data[0]"){
                            $msg = base64_encode('invalid Pin code entered');
                            header("LOCATION:lockscreen.php?url=$sendTo&flag=$flag&MSG=$msg");
                        }else{

                            $permission = base64_encode('payroll');
                            $path = base64_decode($sendTo);
                            header("LOCATION:$path?PERMISSION=$permission");
                        }

                    }else{

                        $msg = base64_encode('Pin code not set or maybe expired');
                        //$msg = base64_encode($data[0]);
                        header("LOCATION:lockscreen.php?url=$sendTo&flag=$flag&MSG=$msg");

                    }
                }else{

                    $msg = base64_encode('Pin code not set or maybe expired');
                    header("LOCATION:lockscreen.php?url=$sendTo&flag=$flag&MSG=$msg");
                }


            }

                } // end ok 1*/


        //}
    }

    //$msg = base64_decode($sendTo);


}
?>
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
        <a href="#"><b><?php echo 'IT SERVICES CENTRE ' ?></b> Web Portal</a>
    </div>
    <!-- User name -->
    <div class="lockscreen-name"><?php// echo  $_SESSION['NAME']; ?></div>

    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">
        <!-- lockscreen image -->
       <!-- <div class="lockscreen-image">
            <!img src="gallary/picavatar.jpg" alt="User Image">
            <!--<p data-letters="<?php //echo $_SESSION['NAME'][0] ?>"> </p>-->
       <?php 
    /*   $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
       
       echo $actual_link*/
       
       echo base64_decode($_REQUEST['url']).'<br>';
       
       echo $_SERVER['PHP_SELF'];
       ?>
       
        <!/div>
        <!-- /.lockscreen-image -->

        <!-- lockscreen credentials (contains the form) -->
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="lockscreen-credentials">
        <input type="hidden" name="sendTo" value="<?php if(isset($_REQUEST['url'])){ echo ($_REQUEST['url']); }?>">
        <input type="hidden" name="flag" value="<?php if(isset($_REQUEST['flag'])){ echo ($_REQUEST['flag']); }?>">
            <div class="input-group">
                <input type="text" id="username" name="username" class="form-control"  placeholder="USERNAME">
            </div>

            <div class="input-group">
                <input type="password" id="pass" name="pass" class="form-control"  placeholder="PASSWORD">

                <div class="input-group-btn">
                    <button type="submit" name="PinCodeActivity" id="PinCodeActivity"  class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
                </div>
            </div>
        </form>
        <!-- /.lockscreen credentials -->

    </div>
    <!-- /.lockscreen-item -->
    <div class="help-block text-center" style="color: red; font-size: 15px">
        <?php if(isset($_REQUEST['MSG'])){ echo base64_decode($_REQUEST['MSG']);} ?>
    </div>

    <div class="help-block text-center">
        Enter username & password to retrieve your session <br/>

    </div>
    <!--<div class="text-center">
        <a href="login.html">Or sign in as a different user</a>
    </div>
    <div class="lockscreen-footer text-center">
        Copyright &copy; 2014-2016 <b><a href="https://adminlte.io" class="text-black">Almsaeed Studio</a></b><br>
        All rights reserved
    </div>-->
</div>
<!-- /.center -->

<!-- jQuery 3 -->
<script src="assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/lib/js/jquery.js"> </script>
<script>

$('#PinCodeActivity').on('click',function (e) {

    if(confirm('Do you want to start this session?') == false){

        e.preventDefault();
    }else{


    }
});

</script>

</body>
</html>

