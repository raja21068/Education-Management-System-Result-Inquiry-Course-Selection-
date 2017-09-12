
<?php
require_once('../DataBaseManagerForm.php');
require_once('../Database.php');
$link=DataBaseManager1::connect();
//session_start();
if ((isset($_POST['challanNo']))) {
	$challan_no=mysqli_real_escape_string($link,$_POST['challanNo']);
}else{
	
	$challan_no=0;
    
}

if ((isset($_POST['challanRS']))) {
$challan_rs=mysqli_real_escape_string($link,$_POST['challanRS']);
}else{
	$challan_rs=0;
}


if ((isset($_POST['challanDate']))) {
$challan_date=mysqli_real_escape_string($link,$_POST['challanDate']);
}else{
	$challan_date='0000-00-00';
   
}
if(!isset($_POST['roll_number'])) {
header('Location: error.html');
   die();	
}
if(!isset($_POST['courceArray'])) {
header('Location: course.html');
   die();	
}

$roll_no=mysqli_real_escape_string($link,$_POST['roll_number']);
$name=mysqli_real_escape_string($link,$_POST['name']);
$fname=mysqli_real_escape_string($link,$_POST['fname']);
$surname=mysqli_real_escape_string($link,$_POST['surname']);
$semester=mysqli_real_escape_string($link,$_POST['semester']);
$shift=mysqli_real_escape_string($link,$_POST['shift']);
$dept_name=mysqli_real_escape_string($link,$_POST['dept_name']);
$exam_type=mysqli_real_escape_string($link,$_POST['exam_type']);
$batch_id=mysqli_real_escape_string($link,$_POST['batch_id']);
$scheme_id=mysqli_real_escape_string($link,$_POST['scheme_id']);
$courseArray=$_POST['courceArray'];


$form_sumbit_date=date("Y-m-d");
$year=date("Y");
//echo($challan_no."</BR>".$challan_date."</BR>".$challan_rs);

$lastid=DataBaseManager1::addExamFormData($exam_type,$form_sumbit_date,$batch_id,$roll_no,$challan_no,$challan_date,$challan_rs,$semester,$scheme_id,$name,$fname);
  include("imageUpload.php");
  $uploadfile = $uploaddir . $lastid.$file_ext;
	if (move_uploaded_file($_FILES['my_files']['tmp_name'], $uploadfile)) {
  } else {
  echo "error";
  }
 
  include "phpqrcode/qrlib.php";    
  $result=str_pad($lastid, 10, "0", STR_PAD_LEFT);
QRcode::png("$result", "qr/$lastid.png", 'QR_ECLEVEL_L', 3, 2);    
//$qrText= QRcode::text("$lastid", "qr/$lastid.png", 'QR_ECLEVEL_L', 3, 2);    

  
$length = count($courseArray);
for ($i = 0; $i < $length; $i++) {
	$pieces = explode("~",$courseArray[$i]);
	$courceNo=$pieces[0]; // piece1
		$ac_id=$pieces[1]; // piece2
		$courseTittle=$pieces[2]; // piece3
		$CR_HRS=$pieces[3]; // piece3
    DataBaseManager1::addExamPapers($lastid,$semester,$scheme_id,$courceNo,$ac_id,$courseTittle,$CR_HRS);
}


require('fpdf/cellpdf.php');
class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial','B',15);

    }
    function Footer()
    {
        //Position at 1.5 cm from bottom
        $this->SetY(-15);
        //Arial italic 8
        $this->SetFont('Arial','I',8);
        //Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

}
                $pdf=new CellPDF();
                $pdf->SetFont('Times','',12);
                $pdf->AddPage();


                //	$pdf->AddPage();
                $pdf->Image('images/logo.png',20,5,20);
                $pdf->SetFont('Times','',20);


                $pdf->Cell(0,8,"University of Sindh, Jamshoro",0,1,'C',false);
                $pdf->Ln();
                $pdf->text(80,22,"Examination Form");
                $pdf->Ln();
				$path="qr/".$lastid.".png";
                $pdf->Image($path,170,5,18);
                    $pdf->SetFont('Times','',10);
			
			$pdf->text(172,26,"$lastid");
                
                    $pdf->SetFont('Times','',12);

 		

  //              $pdf->Ln();
		//	$pdf->Output();
                $pdf->Output("11.pdf",'I');
//$pdf->Output($lastid.".pdf",'I');


?>