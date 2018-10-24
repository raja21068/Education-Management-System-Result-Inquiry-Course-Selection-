<?php 
@session_start();
if(!isset($_SESSION['LOGGED'])){
    
	exit("Can not communicate with Database Please Login");
	
	//die;
	}
?>