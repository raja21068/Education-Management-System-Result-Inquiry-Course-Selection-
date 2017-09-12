
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
  
QRcode::png("$lastid", "qr/$lastid.png", 'QR_ECLEVEL_L', 3, 2);    
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
if($exam_type=='R'){
    $exam_type="REGULAR";
}elseif ($exam_type=="F"){
    $exam_type="FAILURE/IMPROVER";

    $pdf->text(30,37,"Challan No: $challan_no");
    $pdf->text(80,37,"Challan Date: $challan_date");
    $pdf->text(160,37,"Challan Rs: $challan_rs");

}elseif ($exam_type=="I"){
    $exam_type="IMPROVER";
}elseif($exam_type=='S'){
    $exam_type='SPEACIAL';
}


                    $pdf->text(20,30,"$exam_type");
                    //$pdf->text(100,6,"$qrText");
					
					

                    $pdf->Line(20,40,200,40);


                       $pdf->SetFont('Times','',10);


                $pdf->Ln();
                $w = array(90, 60, 120, 50,40,20);
                $h=5;

                $pdf->Cell($w[1],$h,"Department/Center/Institute/Campus",1,0);
                $pdf->Cell($w[1],$h,"$dept_name",1,0);
                $pdf->Ln();
                $pdf->Cell($w[1],$h,"Roll No",1,0);
                $pdf->Cell($w[1],$h,"$roll_no",1,0);
                $pdf->Ln();
                $pdf->Cell($w[1],$h,"Name",1,0);
                $pdf->Cell($w[1],$h,"$name",1,0);
                $pdf->Ln();
                $pdf->Cell($w[1],$h,"Father's Name",1,0);
                $pdf->Cell($w[1],$h,"$fname",1,0);
                $pdf->Ln();
                $pdf->Cell($w[1],$h,"Surame",1,0);
                $pdf->Cell($w[1],$h,"$surname",1,0);
                $pdf->Ln();
                $pdf->Cell($w[1],$h,"Semester",1,0);
                $sem= get_semester_decode($semester);
				$pdf->Cell($w[1],$h,"$sem",1,0);
                $pdf->Ln();
                $pdf->Cell($w[1],$h,"Examination Year",1,0);
                $pdf->Cell($w[1],$h,"$year",1,0);
                $pdf->Ln(12);
                $pdf->Image($uploadfile,142,42,40,40);


$length = count($courseArray);
$count=0;
$pdf->ln();
$pdf->Cell(190,$h,"Subjects/Papers",1,0,'C');
$pdf->ln();
for ($i = 0; $i < $length; $i++) {
    $count++;
    $pdf->SetFont('Times','',10);
	$pieces = explode("~",$courseArray[$i]);
	$courceNo=$pieces[0]; // piece1
	$ac_id=$pieces[1]; // piece2
	$courseTittle=$pieces[2]; // piece3
    $pdf->Cell(5,$h,"".$count,1,0,'C');
    $pdf->Cell(90,$h,"".$courseTittle,1,0,'L');
    if($count%2==0){
        $pdf->Ln();
    }


}

		$pdf->SetXY(110, 115);
        $pdf->Ln(9);
        $pdf->SetFont("Times",'',10);
        $pdf->Cell(0,$h,"Library Stamp 1.______________ Library Stamp 2______________ Seminar Stamp______________  " ,0,0);
		$pdf->Ln(17);
		$pdf->Cell(0,$h,"Attandance:_______Signature: ______________ Chairman/Director: ______________  " ,0,0);
		$pdf->Ln(8);
        
        $pdf->SetFont("Times",'B',10);
      
		$pdf->SetXY(120, 160);


         $pdf->Image('images/logo.png',20,155,20);
              $pdf->SetFont('Times','',20);

		//$pdf->SetFont('Times','',12);
                
                $pdf->text(60,160,"University of Sindh, Jamshoro");
                $pdf->Ln();
                $pdf->text(70,170,"      Admit Card  ");
                $pdf->Ln();
                $pdf->Image($path,170,155,18);
                    $pdf->SetFont('Times','',12);
if($exam_type=='R'){
    $exam_type="REGULAR";
}elseif ($exam_type=="F"){
    $exam_type="FAILURE/IMPORVER";
}elseif ($exam_type=="I"){
    $exam_type="IMPROVER";
}elseif($exam_type=='S'){
    $exam_type='SPEACIAL';
}
$pdf->Line(20,180,200,180);

                 $pdf->text(20,179,"$exam_type");
               $pdf->text(172,176,"$lastid");
if($exam_type=="F"){
                $pdf->text(30,37,"Challan No: $challan_no");
                $pdf->text(80,37,"Challan Date: $challan_date");
                $pdf->text(160,37,"Challan Rs: $challan_rs");
}
                    $pdf->Line(20,40,200,40);


                       $pdf->SetFont('Times','',10);


			$pdf->SetY(180);

                $pdf->Ln();
                $w = array(90, 60, 120, 50,40,20);
                $h=5;

                $pdf->Cell($w[1],$h,"Department/Center/Institute/Campus",1,0);
                $pdf->Cell($w[1],$h,"$dept_name",1,0);
                $pdf->Ln();
                $pdf->Cell($w[1],$h,"Roll No",1,0);
                $pdf->Cell($w[1],$h,"$roll_no",1,0);
                $pdf->Ln();
                $pdf->Cell($w[1],$h,"Name",1,0);
                $pdf->Cell($w[1],$h,"$name",1,0);
                $pdf->Ln();
                $pdf->Cell($w[1],$h,"Father's Name",1,0);
                $pdf->Cell($w[1],$h,"$fname",1,0);
                $pdf->Ln();
                $pdf->Cell($w[1],$h,"Surame",1,0);
                $pdf->Cell($w[1],$h,"$surname",1,0);
                $pdf->Ln();
                $pdf->Cell($w[1],$h,"Semester",1,0);
                $pdf->Cell($w[1],$h,"$sem",1,0);
                $pdf->Ln();
                $pdf->Cell($w[1],$h,"Examination Year",1,0);
                $pdf->Cell($w[1],$h,"$year",1,0);
				$pdf->Ln(12);
                $pdf->Image($uploadfile,142,185,40,40);
			
                //$pdf->Ln(12);
             //   $pdf->Image('images/Blank-person-photo.png',150,42,55);


$length = count($courseArray);
$count=0;
//$pdf->ln();
$pdf->Cell(190,$h,"Subjects/Papers",1,0,'C');
$pdf->ln();
for ($i = 0; $i < $length; $i++) {
    $count++;
    $pdf->SetFont('Times','',10);
    $pdf->Cell(5,$h,"".$count,1,0,'C');
	$pieces = explode("~",$courseArray[$i]);
	$courceNo=$pieces[0]; // piece1
	$ac_id=$pieces[1]; // piece2
	$courseTittle=$pieces[2]; // piece3
    
    $pdf->Cell(90,$h,"".$courseTittle,1,0,'L');
    if($count%2==0){
        $pdf->Ln();
    }

}
$pdf->Ln(6);	
$pdf->Cell(0,$h,"Chairman/Director: ______________Signature Of Candidate: ______________ Controller Of Examination ______________  " ,0,0);
		

  //              $pdf->Ln();
		//	$pdf->Output();
                $pdf->Output("$lastid pdf",'I');
//$pdf->Output($lastid.".pdf",'I');


?>