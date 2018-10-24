<?php
/**
 * Created by PhpStorm.
 * User: Yasir
 * Date: 25-Sep-18
 * Time: 1:15 AM
 */

require_once ('../conn_attendance.php');


echo md5('eco_director123');
echo '<br>';

echo 'Encode '.base64_encode(2).'<br>';
echo 'Decode '.base64_decode('MQ==').'<br>';
$arr = array(

    "GOVERNMENT BOYS COLLEGE KALI MORI HYDERABAD",
    "GOVERNMENT BOYS COLLEGE QASIMABAD HYDERABAD",
    "GOVERNMENT BOYS COLLEGE TANDO JAN MUHAMMAD",
    "GOVERNMENT COLLEGES",
    "GOVERNMENT ELEMENTARY COLLEGE OF EDUCATION (MEN)",
    "GOVERNMENT ELEMENTARY COLLEGE OF EDUCATION (MEN)",
    "GOVERNMENT ELEMENTARY COLLEGE OF EDUCATION (MEN)",
    "GOVERNMENT ELEMENTARY COLLEGE OF EDUCATION (MEN)",
    "GOVERNMENT ELEMENTARY COLLEGE OF EDUCATION (MEN)",
    "GOVERNMENT ELEMENTARY COLLEGE OF EDUCATION (MEN)",
    "GOVERNMENT ELEMENTARY COLLEGE OF EDUCATION (MEN)",
    "GOVERNMENT BOYS COLLEGE QASIMABAD HYDERABAD"
);

$ignoredDeptListRec = array(

    95,
    96,
    102,
    122,
    105,
    108,
    103,
    110,
    112,
    114,
    107,
    113,
    104,
    109,
    111,
    106,
    99,
    98,
    97,
    100,
    101,
    90,
    82,
    75,
    92,
    116,
    93,
    91,
    94,
    83
);

//echo $joined;

$sql = "SELECT DEPT_ID,DEPT_NAME FROM department ORDER BY DEPT_NAME ASC";
$result = $db->query($sql);

//echo $sql;

if($db->error){

    die('<p style="color: red"> Error: '.$db->error.'</p>');
}

if(!$result->num_rows){

    $db->close();
    die('<p style="color: red"> Message: Department List Not Available...!</p>');
}

while ($rows = $result->fetch_assoc()) {


    if(in_array($rows['DEPT_ID'],$ignoredDeptListRec)){
        continue;
    }


    echo $rows['DEPT_NAME'] . '<br>'. $rows['DEPT_ID'].'<br>.';
}

    ?>