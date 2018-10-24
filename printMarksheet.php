<?php
      include("DataBaseManagerPrintMarksheet.php");

	$roll_no		=mysql_real_escape_string($_POST["roll_no"]);        
	$part		=mysql_real_escape_string($_POST["part"]);        
//	$roll_no = str_replace('-', '/', $roll_no);
	if($roll_no==""){
	
	header("Location: error.html");
	return;
	}
	if($part==""){
	
	header("Location: error.html");
	return;
	}
          $sl_id=null;

	$query=" SELECT batch.BATCH_ID,batch.DEPT_ID FROM batch,student_registration ".
	" WHERE ".
	" student_registration.BATCH_ID=batch.BATCH_ID AND ".
	" student_registration.ROLL_NO='$roll_no' ";
	
	
	$result_BATCH=mysql_query($query);

                 $batch_id=null;
	while($row_BATCH=mysql_fetch_object($result_BATCH))  {
	        $batch_id=$row_BATCH->BATCH_ID;  

 $dept_id=$row_BATCH->DEPT_ID;
	        $query=" SELECT seat_list.SL_ID,seat_list.TYPE,seat_list.YEAR  FROM seat_list,seat_list_detail ".
		 " where ".
		 " seat_list.part=$part AND ".
		 " seat_list.batch_id=$batch_id AND ".
		 " seat_list_detail.ROLL_NO='$roll_no' AND ".
		 " seat_list.SL_ID=seat_list_detail.SL_ID AND ".
		 " seat_list.PART=seat_list_detail.PART AND ".
		 " seat_list.PART=seat_list_detail.PART AND ".
		 " seat_list.BATCH_ID=seat_list_detail.BATCH_ID ORDER BY seat_list.YEAR DESC";
		$result=mysql_query($query);

		 if($row=mysql_fetch_object($result)){
			$sl_id=$row->SL_ID;  
			$exam_type=$row->TYPE;
			$exam_year=$row->YEAR;			

	       	 require('form/fpdf/cellpdf.php');
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
                $pdf->Image('form/images/logo.png',53,5,20);
                //$pdf->SetFont('Times','',20);

		$pdf->SetFont("Arial",'B',20);
        $pdf->Cell(0,5,"University of Sindh ",0,1,'C',false);
        $pdf->Ln(2);
               
                $pdf->SetFont("Times",'BU',12);
				$pdf->Cell(0,5,"Marks Certificate",0,1,'C',false);
				$pdf->Ln(1);

        
				$pdf->SetFont("Times",'B',10);
      

 


			

  //              $pdf->Ln();
		//	$pdf->Output();
                
//$pdf->Output($lastid.".pdf",'I');


	       	 
	       	      

 			$scheme_id=get_scheme_id($sl_id); 
			if($scheme_id==null){
			     $pdf->Cell(0,5,"Result is in progress.....",0,1,'C',false);
			     $pdf->Cell(0,5,"Please wiat some days.....",0,1,'C',false);
			     
         				return;
			}
			
      display_marks_certificate($sl_id,$roll_no,$part,$scheme_id,$batch_id,$exam_year, $exam_type,$pdf,$dept_id);  
      $pdf->Output("$roll_no.pdf",'I');
     // echo("<HR>");
  }//end while
  
}//end batch

  if($sl_id==null){
                $pdf->Cell(0,5,"[$roll_no] does not appeared Examination $exam_year.",0,1,'C',false);
			     $pdf->Cell(0,5,"Wrong Exam.Year $exam_year selected......",0,1,'C',false);
       
         return;
   }

	if($batch_id==null){
	       $pdf->Cell(0,5,"[Wrong Roll No. entered [$roll_no]......",0,1,'C',false);
			     $pdf->Cell(0,5,"Please verify program.......",0,1,'C',false);
         
         return;
	}



?>




