
<?php

	$seatno = "";
        $cellno="";
	if(isset($_REQUEST['seatno'])){ $seatno = $_REQUEST['seatno']; }
	if(isset($_REQUEST['cellno'])){ $cellno = $_REQUEST['cellno']; }			
	$response = array();
			//$response["seatno"] =$seatno;
                        //$response["part"] =""+$part;
                //        $response["cellno"] =""+$cellno;
                  //      $response["status"] = "error";
                    //    $response["message"] ="";
                        
	//			echo json_encode($response);
            
           

            require_once ('dbcon.php');
	
		$query="SELECT * FROM `admmision` WHERE seatno=$seatno";
        $result=mysql_query($query);
       	$num=mysql_num_rows($result);
			//echo($query);
	        if($num>0){
                      for($a=0; $a<$num; $a++){
                        $NAME =mysql_result($result,$a,"NAME");
                        $NET_PER =mysql_result($result,$a,"NET_PER");
                        $MERIT =mysql_result($result,$a,"MERIT");	
                        $FEMALE = mysql_result($result,$a,"FEMALE");
                        $COL_TEACH = mysql_result($result,$a,"COL_TEACH");
                        $DISABLE = mysql_result($result,$a,"DISABLE");
                        $SELF_FIN_M = mysql_result($result,$a,"SELF_FIN_M");
						$SELF_FIN_M = mysql_result($result,$a,"SELF_FIN_M");


                        $response["status"] = "OK";
                        $response["message"] ="";
                        $response["NAME"] =$NAME;
                        $response["NET_PER"] =$NET_PER;
                        $response["MERIT"] =$MERIT;
                        $response["FEMALE"] =$FEMALE;
						$response["DISABLE"] =$DISABLE;
                        $response["SELF_FIN_M"] =$SELF_FIN_M;
						$response["EVENING"] =$EVENING;
						$response["cellno"] =$cellno;

						
                        echo json_encode($response);
						}
  
                 }else {
             
            $response["status"] = "ERROR";
            $response["message"] = "Invalid  Seat  No";	
            //$response["query"] = $query;
            echo json_encode($response);
            }      	 	
	
	?>