<?php
/**
 * Created by PhpStorm.
 * User: Yasir
 * Date: 17-Sep-18
 * Time: 1:27 PM
 */

require("fpdf/fpdf.php");
require("../conn_attendance.php");


class PDF extends FPDF
{

    function Header()
    {


        // Logo
        //$this->Image('logo.png',10,6,30);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 13);
        // Move to the right
        $this->Cell(55);
        // Title
        $this->Cell(100, 10, 'University of Sindh - Information Technology Services Centre (UoS - ITSC)', 0, 0, 'C');
        // Line break
        //$this->Ln(7);
        //$this->Cell(45);
        //$this->SetFont('Times','',10);
        //$this->Cell(100,10,'',0,0,'C');

        $this->Ln(7);
        $this->Cell(45);
        $this->SetFont('Times', 'B', 12);
        $this->Cell(100, 10, 'Attendance Progress Report', 0, 0, 'C');

        $this->Ln(8);


        //$this->ln(13);
if($this->PageNo() >= 2) {
    $this->SetFont('Times', 'B', 8);


    $this->Cell(10, 7, 'S.NO', 1);
    $this->Cell(27, 7, 'ROLL NO', 1, '', 'C');
    $this->Cell(45, 7, 'NAME', 1, '', 'C');
    $this->Cell(44, 7, "FATHER'S NAME", 1, '', 'C');
    $this->Cell(30, 7, 'SURNAME', 1, '', 'C');
    $this->Cell(24, 7, 'TOTAL CLASSES', 1, '', 'C');
    $this->Cell(14, 7, 'PRESENT', 1, '', 'C');
    $this->Cell(13, 7, 'PER %', 1, '', 'C');

$this->ln(7);
}
    }
// Simple table
        function BasicTable($dept_id, $program_id, $batch, $shift, $group, $attendanceMonthYear, $db)
        {

            $sql = "SELECT BATCH_ID,DEPT_NAME,PROGRAM_TITLE,b.YEAR AS YEAR,SHIFT,GROUP_DESC,MONTH,my.YEAR AS MY_YEAR,y.REMARKS AS BATCHYEAR FROM department d, program p, batch b, month_year my, year y ";
            $sql .= "WHERE d.DEPT_ID=p.DEPT_ID AND p.PROG_ID=b.PROG_ID AND b.YEAR = '" . $batch . "' AND y.YEAR= {$batch} AND b.SHIFT LIKE '" . $shift . "' AND b.GROUP_DESC LIKE '" . $group . "' AND d.DEPT_ID = '" . $dept_id . "' AND p.PROG_ID ='" . $program_id . "' AND my.MONTH_ID = '" . $attendanceMonthYear . "'";

            $result = $db->query($sql);

            if ($db->error) {

                die($db->error);
            }

            if (!$result->num_rows) {

                $db->close();
                die('Sorry Department Record Not Found...!');
            }
            $rows = $result->fetch_assoc();

            if ($rows['GROUP_DESC'] == 'GNRL') {

                $group = 'General';
            } elseif ($rows['GROUP_DESC'] == 'MEDL') {
                $group = 'Pre-Medical';
            } elseif ($rows['GROUP_DESC'] == 'ENGG') {
                $group = 'Pre-Engineering';
            } elseif ($rows['GROUP_DESC'] == 'COMM') {
                $group = 'Pre-Commerce';
            } else {
                $group = $rows['GROUP_DESC'];
            }


            if ($rows['SHIFT'] == 'M') {

                $shift = 'Morning';
            } elseif ($rows['SHIFT'] == 'E') {
                $shift = 'Evening';
            } elseif ($rows['GROUP_DESC'] == 'N') {
                $shift = 'Afternoon';
            } else {
                $shift = '';
            }


            $this->SetFont('Times', '', 9);


            $this->Ln(7);

            $this->Cell(10);

            $this->Cell(40, 10, 'Department Name: ' . ucwords(strtolower($rows['DEPT_NAME'])), 0, 'R', 'L');
            $this->Cell(65);
            $this->Cell(40, 10, 'Batch: ' . $rows['BATCHYEAR'], 0, 'L', 'L');

            $this->Ln(7);
            $this->Cell(10);
            $this->Cell(40, 10, 'Class/Program: ' . $rows['PROGRAM_TITLE'], 0, 'R', 'L');

            $this->Cell(65);
            //$this->Ln(5);
            $this->Cell(230, 10, 'Attendance Report: ' . ucwords(strtolower($rows['MONTH'])) . ' - ' . $rows['MY_YEAR'], 0, 'R', 'L');

            $this->Ln(7);

            $this->Cell(10);
            $this->Cell(40, 10, 'Shift: ' . $shift, 0, 'R', 'L');

            $this->Cell(65);
            //$this->Ln(5);
            $this->Cell(230, 10, 'Group: ' . $group, 0, 'R', 'L');

            // Header

            $this->ln(13);
            $this->SetFont('Times', 'B', 8);


            $this->Cell(10, 7, 'S.NO', 1);
            $this->Cell(27, 7, 'ROLL NO', 1, '', 'C');
            $this->Cell(45, 7, 'NAME', 1, '', 'C');
            $this->Cell(44, 7, "FATHER'S NAME", 1, '', 'C');
            $this->Cell(30, 7, 'SURNAME', 1, '', 'C');
            $this->Cell(24, 7, 'TOTAL CLASSES', 1, '', 'C');
            $this->Cell(14, 7, 'PRESENT', 1, '', 'C');
            $this->Cell(13, 7, 'PER %', 1, '', 'C');
            // $this->Cell(30,7,'RECEIVED BY',1,'','C');

            $this->Ln();

            $this->SetFont('Times', '', 10);

            $sqlAttendance = "SELECT sr.ROLL_NO as ROLL_NO,NAME,FNAME,SURNAME,TOTAL_CLASSES,PRESENT,PERCENTAGE FROM student_registration sr, month_year my, aggregate ag";
            $sqlAttendance .= " WHERE sr.ROLL_NO LIKE ag.ROLL_NO AND my.MONTH_ID=ag.MONTH_ID AND sr.BATCH_ID='" . $rows['BATCH_ID'] . "' AND my.MONTH_ID='" . $attendanceMonthYear . "' ORDER BY sr.NAME";

//echo $sqlAttendance;

            $resultAttendance = $db->query($sqlAttendance);

            if (!$resultAttendance->num_rows) {

                $db->close();
                die('Attendance Record Not Available');
            }

            $i = 1;

            while ($rowsAttendance = $resultAttendance->fetch_assoc()) {


                $this->Cell(10, 6, $i, 1);

                $this->Cell(27, 6, ($rowsAttendance['ROLL_NO']), 1);
                $this->Cell(45, 6, ucwords(strtolower($rowsAttendance['NAME'])), 1);
                $this->Cell(44, 6, ucwords(strtolower($rowsAttendance['FNAME'])), 1);
                $this->Cell(30, 6, ucwords(strtolower($rowsAttendance['SURNAME'])), 1);
                $this->Cell(24, 6, $rowsAttendance['TOTAL_CLASSES'], 1);
                $this->Cell(14, 6, $rowsAttendance['PRESENT'], 1);
                $this->Cell(13, 6, $rowsAttendance['PERCENTAGE'], 1);


                $this->Ln();
                $i++;
            }

        }


    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        //$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
        $this->Cell(0,10,'Page '.$this->PageNo().' of {nb}',0,0,'C');

    }
}


$dept_id = base64_decode($_GET['dept_id']);
$program_id = base64_decode($_GET['program_id']);
$batch = base64_decode($_GET['batch']);
$shift = base64_decode($_GET['shift']);
$group = base64_decode($_GET['group']);
$attendanceMonthYear = base64_decode($_GET['attendanceMonthYear']);

//$result = $db->query($query);
$pdf = new PDF();
$pdf->AliasNbPages();
// Column headings

//$pdf->SetFont('Times','',10);
$pdf->SetMargins('3.5','2');
$pdf->AddPage('p','letter');

$pdf->BasicTable($dept_id,$program_id,$batch,$shift,$group,$attendanceMonthYear,$db);

$first=$batch[0];
$second=$batch[1];
$third=$batch[2];
$fourth=$batch[3];

$filename = $first.'K'.''.$third.''.$fourth.'.pdf';
//$pdf->AddPage();
//$pdf->ImprovedTable($header,$data);
//$pdf->AddPage();
//$pdf->FancyTable($header,$data);
$pdf->Output('I',$filename);
?>