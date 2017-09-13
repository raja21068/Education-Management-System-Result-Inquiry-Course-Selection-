<?php
 if (isset($_REQUEST['prog_id'])){
     $programId = $_REQUEST['prog_id'];
     require_once './DatabaseManager.php';
     
     $result = DatabaseManager::getBatch($programId);
     $response['status'] = "OK";
     $response['batch'] = $result;
      
     echo json_encode($response);
 }
?>
