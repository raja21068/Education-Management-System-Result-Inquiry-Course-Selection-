<?php
session_start();

if(isset($_SESSION['LOGGED']) && $_SESSION['LOGGED'] == 1) {

    require_once("conn_attendance.php");
    //require_once ('activeUserStatus.php');

    $dateTime = date("d/ M/ Y - h:i:s a");
    $logFile = fopen("attendance_login_logs.txt", 'a');

    $txt = "[" . $dateTime . "]" . " [USER: " . (trim($_SESSION['USERNAME'])) . " Logout Succeeded]\r\n";
    fwrite($logFile, $txt);
    fclose($logFile);

   // active(0,$_SESSION['USER_ID']);

    if(session_destroy()) {


        $db->close();

        header("Location:attandance_login.php");
    }
}else{


    if(session_destroy()) {

        header("Location:attandance_login.php");
    }
}


?>