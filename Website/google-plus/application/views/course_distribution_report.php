<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CellPDF {
    var $columnWidth = 60;
    var $columnHeight = 5;
var $cd,$dept_name,$program_name;

    function  setDeptName($dept_name,$program_name,$cd){

        $this->cd = $cd;
        $this->dept_name = $dept_name;
        $this->program_name = $program_name;
        }

    function Header()
    {
        $this->SetFont("Arial",'B',20);
        //$this->Image(ASSET_PATH.'images/logo.png',20,5,25,25);
        //$this->Image('logo.png',20,5,25,25);
        
		
        $this->Image("picQr/".$this->cd[0]['PASS'].".png",170,5,30);
      //
        $this->Cell(0,20,"The University of Sindh",0,1,'C',false);
        $this->Ln(1);

        $this->SetFont("Times",'',11);
        $this->Cell(0,$this->columnHeight,$this->dept_name,0,1,'C',false);
        $this->Ln(1);
        $this->Cell(0,$this->columnHeight, $this->program_name,0,1,'C',false);
        $this->Ln(1);
        // $this->abc();
        $this->SetFont("Times",'',11);
        $w = array(12, 20, 80, 50,40,20);
       // $this->Cell($w[0],$this->columnHeight,"S.NO",1,0,'C');
        $this->Cell($w[1],$this->columnHeight,"COURSE NO",1,0,'C');
        $this->Cell($w[2],$this->columnHeight,"COURSE TITTLE",1,0,'C');
        $this->Cell($w[3],$this->columnHeight,"NAME",1,0,'C');
       // $this->Cell($w[5],$this->columnHeight,"MARKS",1,0,'C');
        $this->Ln();


        //	$this->SetFont( 'Arial', 'B', 18 ); //set font to Arial, Bold, and 16 Size

        //  $this->Cell($w,9,$REMARKS_PROGRAM_NAME,1,1,'C',false);
//	$this->Ln(10);

    }
    //Page footer
    function Footer()
    {
		$this->Ln();
			$this->Cell(0,5,"Signature: ______________                                                                          Chairman/Director: ______________  " ,0,0);
        //Position at 1.5 cm from bottom

        $this->SetY(-15);

        //Arial italic 8
        $this->SetFont('Arial','I',8);

        //Page number
    
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	
    }
}

class CourseDistributionReport {

var $cd,$dept_name,$program_name;
    var $columnWidth = 60;
    var $columnHeight = 5;
	
    public function __construct($cd,$dept_name,$program_name)
    {
        $this->cd = $cd;
        $this->dept_name = $dept_name;
        $this->program_name = $program_name;
      
       $this->printReport();
    }





    public function printReport(){

        $pd = new Test();
        $pd->AliasNbPages();
        $pd->setDeptName($this->dept_name,$this->program_name,$this->cd);
		$pd->SetFont('Times','',10);
//		$pdf->AddPage();

        $pd->AddPage();


/*
        $pd->Ln(1);
        $pd->SetFont("Times",'',11);
        $pd->Cell(0,$this->columnHeight,$this->dept_name,0,1,'C',false);
        $pd->Ln(1);
        $pd->Cell(0,$this->columnHeight, $this->lds[0]['REMARKS_PROGRAM_NAME'] ." ".$this->lds[0]['SEMESTER']." SEMESTER",0,1,'C',false);
        $pd->Cell(0,$this->columnHeight,$this->lds[0]['COURSE_TITLE']." (".$this->lds[0]['COURSE_NO'].")",0,1,'C',false);
        $pd->Ln(1);
        $pd->Cell(0,$this->columnHeight,"Credit Hours:".$this->cr_hrs."       Max Marks: ".$this->max_marks."         Min Marks: ".$this->lds[0]['MIN_MARKS'],0,1,'C');
        $pd->Ln(1);
*/
        $w = array(12, 20, 80, 50,40,20);

        $a=0;
		$sem=0;
        foreach( $this->cd as $courseDist ) {
			$a=$a+1;
            $COURSE_NO = $courseDist['COURSE_NO'];
            $COURSE_TITTLE = $courseDist['COURSE_TITLE'];
			$SEMESTER = $courseDist['SEMESTER'];
            //$TEACHER_NAME_1 = $courseDist['MEMBER_ID_1'];
			$NAME1 = $courseDist['NAME1'];
			//$LAST_NAME = $courseDist['LAST_NAME'];
			if($sem!=$SEMESTER){
				$sem=$SEMESTER;
				     $pd->Cell(150,$this->columnHeight,"SEMESTER $SEMESTER",1,0,'C');
					 $pd->Ln();
		//			 $pd->Cell($w[1],$this->columnHeight,"COURSE NO",1,0,'C');
        //$pd->Cell($w[2],$this->columnHeight,"COURSE TITTLE",1,0,'C');
       // $pd->Cell($w[3],$this->columnHeight,"NAME",1,0,'C');
       // $this->Cell($w[5],$this->columnHeight,"MARKS",1,0,'C');
       // $pd->Ln();
			}
				if($a%2==0){
						$pd->SetFillColor(230,230,230);
										}else{
						$pd->SetFillColor(255,255,255);
						}
											//$pd->SetTextColor(230,230,230);
					
             //$pd->Cell($w[0],$this->columnHeight,($a),1,0,'L');
            $pd->Cell($w[1],$this->columnHeight,$COURSE_NO,1,0,'L',1);
            $pd->Cell($w[2],$this->columnHeight,"$COURSE_TITTLE",1,0,'L',1);
            $pd->Cell($w[3],$this->columnHeight,$NAME1,1,0,'L',1);

            //SSS$pdf->$row($row);

            //$pdf->Cell($w[3],$h,"$row->FNAME",1,0,'L');
           // $pd->Cell($w[5],$this->columnHeight,"$MARKS_OBTAINED",1,0,'L');
            $pd->Ln();


        }




        $pd->Output($this->dept_name.".pdf",'I');
        //$pd->Output();
    }
}

?>
