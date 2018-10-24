<?php
/**
 * Created by PhpStorm.
 * User: Yasir
 * Date: 14-Sep-18
 * Time: 3:45 PM
 */


// selecting programs
require_once ("../conn_attendance.php");

if(isset($_POST['flag']) && $_POST['flag'] == 'SELECT PROGRAMS' ){

    $dept_id = trim($_POST['dept_id']);
    if(empty($dept_id)){

        die();
    }

    $sql = "SELECT PROG_ID,PROGRAM_TITLE FROM program WHERE  DEPT_ID ='".$dept_id."' ";

    $result = $db->query($sql);
    if(!$result->num_rows){
        die();
    }else{

        $i =0;
        while ($rows = $result->fetch_assoc()){

            $arr[$i] = array(

                        $rows['PROG_ID'],
                        $rows['PROGRAM_TITLE']
                    );

        $i++;
        }

        echo(json_encode($arr));

        $db->close();
        unset($sql);
        unset($result);
        unset($rows);
        unset($arr);

    } // else num rows

} // end selecting programs

// select program related columns

if(isset($_POST['flag']) && $_POST['flag'] == 'SELECT PROGRAMS COLUMN'){

    $program_id = trim($_POST['program_id']);

    if(empty($program_id)){
        die();
    }

    $sqlYear = "SELECT DISTINCT YEAR FROM batch WHERE PROG_ID = '".$program_id."' AND YEAR >=2014 ORDER BY YEAR ASC";
    $resultYear = $db->query($sqlYear);

    $arrYear = array();
    while($rowsYear=$resultYear->fetch_assoc()){

        $arrYear[] = $rowsYear['YEAR'];
    }

    $sqlShift = "SELECT DISTINCT SHIFT FROM batch WHERE PROG_ID = '".$program_id."'";
    $resultShift = $db->query($sqlShift);

    $arrShift = array();
    while($rowsShift=$resultShift->fetch_assoc()){

        $arrShift[] = $rowsShift['SHIFT'];
    }

    $sqlGroup = "SELECT DISTINCT GROUP_DESC FROM batch WHERE PROG_ID = '".$program_id."'";
    $resultGroup = $db->query($sqlGroup);

    $arrGroup = array();
    while($rowsGroup=$resultGroup->fetch_assoc()){

        $arrGroup[] = $rowsGroup['GROUP_DESC'];
    }

    $arrList = array(

        $arrYear,
        $arrShift,
        $arrGroup
    );

    echo json_encode($arrList);

    $db->close();

} // end selecting program columns

?>