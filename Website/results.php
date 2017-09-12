<?php
    //if(isset($_REQUEST['rollNo']) && isset($_REQUEST['part'])){
        
        //$rollNo = $_REQUEST['rollNo'];
        //$part = $_REQUEST['part'];
        echo 'Hello<br/>';
    
         mysql_select_db('stbbedup_exam',mysql_connect('localhost','stbbedup_examdb','examdb'));
    
        $rollNo = '2K11/CSM/25';
        $part = '1';
        
        $query = "SELECT * FROM student_registration WHERE ROLL_NO = '$rollNo'";
        $result = mysql_query($query);
        while($row = mysql_fetch_object($result)){
            $batchId = $row->BATCH_ID;
            $name = $row->NAME;
            $fName= $row->FNAME;
            $query2 = "SELECT MAX(SL_ID) AS SL_ID FROM seat_list_detail WHERE BATCH_ID='$batchId' AND PART='$part' AND ROLL_NO='$rollNo'";
            echo "$query2<br/>";
            $resultSet = mysql_query($query2);
            while($row1 = mysql_fetch_array($resultSet)) {
                $maxSlId = $row1['SL_ID'];
                $query3 = "SELECT * FROM ledger_detail_summary WHERE ROLL_NO='$rollNo' AND SL_ID='$maxSlId'";
                $resultSet2 = mysql_query($query3);
                $rowsCount = mysql_num_rows($resultSet2);
                echo "Rows: $rowsCount<br/>";
                if($rowsCount == 0){
                   $query4 = "SELECT * FROM ledger_details WHERE ROLL_NO='$rollNo' AND SL_ID='$maxSlId'";
                   $resultSet3 = mysql_query($query4);
                   echo ''.$query4."<br/>";
                   while ($row3 = mysql_fetch_object(mysql_query($query4))) {
                       echo ''.$row3->COURSE_NO;
                       echo ' ->'.$row3->MARKS_OBTAINED."<br/>";
                   }
                }
                while ($row2 = mysql_fetch_array($resultSet2)) {
                    $percentage = $row2['PERCENTAGE'];
                    echo "$name: $percentage<br/>";
                }
            }
        }
    //}
    
?>