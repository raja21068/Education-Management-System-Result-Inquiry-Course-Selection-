<?php

 if (isset($_REQUEST['batch_id'])){
     
     $batchId = $_REQUEST['batch_id'];
     require_once './DatabaseManager.php';
     $result = DatabaseManager::getStudentPhoneNumber($batchId);
     $response['student'] = $result;
     echo json_encode($response);
     if(isset($_REQUEST['message'])){
     	$total = count($result);
     	$message = $_REQUEST['message'];
     	DatabaseManager::addNotification($batchId , $message , $total);	
     }
     
 }
?>