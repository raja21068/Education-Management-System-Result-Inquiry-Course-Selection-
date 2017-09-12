<?php
    include("Database.php");

    $MessageType=	$_POST["MessageType"];
    $Subject=		$_POST["Subject"];
    $Comments=	      	$_POST["Comments"];
    $Username=		$_POST["UserName"];
    $UserEmail=		$_POST["UserEmail"];
    $UserName=		$_POST["UserName"];
    $UserTel=		$_POST["UserTel"];


    if($Comments==null|| $Comments==""){
      echo("please write some comments.....");
      return;
    } 
    echo($Username);
     if($Username==null|| $Username==""){
      echo("please write User Name.....");
      return;
    } 


echo("<body background=background.gif>");

    $to_day_date=date('Y-m-d');


    $rows=save_comments($MessageType,$Subject,$Comments,$UserName,$UserEmail,$UserTel,$to_day_date);
    if($rows){
          echo("<b><i>$Username!</i> Your comments sucessfully saved.....<br>");
    } 
echo("</body>");

?>