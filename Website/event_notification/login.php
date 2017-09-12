<?php
    if(isset($_REQUEST['user_name']) && isset($_REQUEST['password'])){
        $username = $_REQUEST['user_name'];
        $password = $_REQUEST['password'];
        
        require_once './DatabaseManager.php';
        
        $deptId = DatabaseManager::verifyUser($username, $password);
        $response = array();
        if($deptId == 0){
            $response['status'] = "ERROR";
            $response['message'] = "INVALID USERNAME OR PASSWORD..";
        }else{
            $response['status'] = "OK";
            $response['programs'] = $deptId;

        }//end else
        
        echo json_encode($response);
    }// end if
?>
