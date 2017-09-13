<?php


class DatabaseManager {
    
    public static function connect(){
        return mysqli_connect('localhost', 'stbbedup_exam','S#Zmca1s,^uu@', 'stbbedup_exam');
 }
    public static function verifyUser($username , $password){
        $db = DatabaseManager::connect();
        $query = "SELECT DEPT_ID FROM users WHERE USERS_NAME='$username' AND PASSWORD='$password'";
       	$result = mysqli_query($db, $query);
        if($row = mysqli_fetch_array($result)){
            $deptId =  $row['DEPT_ID'];
            
            return DatabaseManager::getPrograms($db, $deptId);
            
        }else{
            return 0;
        }
    }
    
    public static function getPrograms($db , $deptId){
       $query2 = "SELECT PROG_ID,PROGRAM_TITLE FROM program WHERE DEPT_ID='$deptId'";
            $result2 = mysqli_query($db, $query2);
            $programs = array();
            $count = 0;
            while ($row2 = mysqli_fetch_array($result2)) {
                $programs[$count] = array();
                $programs[$count][0] = $row2['PROG_ID'];
                $programs[$count][1] = $row2['PROGRAM_TITLE'];
                $count++;
            }
            return $programs;
    }

    public static function getDistinctYears($db , $programId){
        $query = "SELECT DISTINCT(YEAR) FROM batch WHERE PROG_ID='$programId' ORDER BY YEAR DESC LIMIT 0,5";
        $result = mysqli_query($db, $query);
        $year = '';
        $index = 0;
        
        while ($row = mysqli_fetch_array($result)) {
            if($index == 0)$year .= (''.$row['YEAR']);
            else $year .= (','.$row['YEAR']);
            $index++;
        }
        return $year;
    }


    
    public static function getBatch($programId){
        $db = DatabaseManager::connect();
        $years =  DatabaseManager::getDistinctYears($db, $programId);
        $query = "SELECT BATCH_ID,YEAR,SHIFT,GROUP_DESC FROM batch WHERE PROG_ID='$programId' AND YEAR IN ($years) ORDER  BY YEAR";
        $result = mysqli_query($db, $query);
        $count = 0;
        $batch = array();
        while ($row = mysqli_fetch_array($result)) {
            $batch[$count]=array();
            $batch[$count][0]= $row['BATCH_ID'];
            $batch[$count][1]= $row['YEAR'].' - '.$row['GROUP_DESC'].' - '.$row['SHIFT'];
            $count++;
        }
        return $batch;
    }

    public static function getStudentPhoneNumber($batchId){
        $db = DatabaseManager::connect();
        $query = "SELECT NAME,CELL FROM student_registration WHERE BATCH_ID='$batchId' AND CELL<>''";
        $result = mysqli_query($db, $query);
        $students = array();
        $index = 0;
        while ($row = mysqli_fetch_array($result)) {
            $students[$index] = array();
            $students[$index][0] = $row['NAME'];
            $students[$index][1] = str_replace("-","", $row['CELL']);
            $index++;
        }
        return $students;
    }

    public static function addNotification($batchId , $message , $total_sent){
    	$db = DatabaseManager::connect();
        $query = "INSERT INTO notification (noti_date , batch_id, message , total_sent_msg ) VALUES ('".date("Y-m-d")."' , '$batchId' , '$message', '$total_sent') ";
        $result = mysqli_query($db, $query);
    }
	

    //$db = connect();
    //$query = "";
    //$result = mysqli_query($db, $query);
}

?>