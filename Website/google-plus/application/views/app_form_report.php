<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CellPDF {
    var $columnWidth = 60;
    var $columnHeight = 5;
var $deptName,$cr_hrs,$max_marks,$lds;

    function  setDeptName($deptname,$cr_hrs,$max_marks,$lds){

        $this->deptName=$deptname;
        $this->cr_hrs=$cr_hrs;
        $this->max_marks=$max_marks;
        $this->lds=$lds;

        }

    function Header()
    {
        $this->SetFont("Arial",'B',20);
        //$this->Image('http://104.223.95.210/google/assets/images/logo.png',20,5,25,25);
        //$this->Image(ASSET_PATH.'images/logo.png',20,5,25,25);
        $this->Image("picQr/".$this->lds[0]['TEACHER_CODE'].".png",170,5,30);
      //
        $this->Cell(0,20,"The University of Sindh",0,1,'C',false);
        $this->Ln(1);

        $this->SetFont("Times",'',11);
        $this->Cell(0,$this->columnHeight,$this->deptName,0,1,'C',false);
        $this->Ln(1);
        $this->Cell(0,$this->columnHeight, $this->lds[0]['REMARKS_PROGRAM_NAME'] ." ".$this->lds[0]['SEMESTER']." SEMESTER",0,1,'C',false);
        $this->Cell(0,$this->columnHeight,$this->lds[0]['COURSE_TITLE']." (".$this->lds[0]['COURSE_NO'].")",0,1,'C',false);
        $this->Ln(1);
        $this->Cell(0,$this->columnHeight,"Credit Hours:".$this->cr_hrs."       Max Marks: ".$this->max_marks."         Min Marks: ".$this->lds[0]['MIN_MARKS'],0,1,'C');
        $this->Ln(1);
        // $this->abc();
        $this->SetFont("Times",'',11);
        $w = array(12, 30, 70, 50,40,20);
        $this->Cell($w[0],$this->columnHeight,"S.NO",1,0,'C');
        $this->Cell($w[1],$this->columnHeight,"ROLL NO",1,0,'C');
        $this->Cell($w[2],$this->columnHeight,"NAME",1,0,'C');
        $this->Cell($w[3],$this->columnHeight,"FNAME",1,0,'C');
        $this->Cell($w[5],$this->columnHeight,"MARKS",1,0,'C');
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

class AppFormReport {

var $lds,$dept_name,$cr_hrs,$max_marks ,$pd;
    var $columnWidth = 60;
    var $columnHeight = 5;
    public function __construct($lds,$dept_name,$cr_hrs,$max_marks)
    {
        $this->lds = $lds;
        $this->dept_name = $dept_name;
        $this->cr_hrs = $cr_hrs;
        $this->max_marks = $max_marks;
       $this->printReport();
    }





    public function printReport(){

        $pd = new Test();
        $pd->AliasNbPages();
        $pd->setDeptName($this->dept_name,$this->cr_hrs,$this->max_marks,$this->lds);

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
        $w = array(12, 30, 70, 50,40,20);

        $pd->SetFont("Times",'',11);

        $a=1;
        foreach( $this->lds as $ledgerDetail ) {
            $MARKS_OBTAINED = $ledgerDetail['MARKS_OBTAINED'];
            $GRADE = $ledgerDetail['GRADE'];
            $REMARKS = $ledgerDetail['REMARKS'];
            $SL_ID = $ledgerDetail['SL_ID'];
            $BATCH_ID = $ledgerDetail['BATCH_ID'];
            $ROLL_NO = $ledgerDetail['ROLL_NO'];
            $COURSE_NO = $ledgerDetail['COURSE_NO'];
            $SCHEME_ID = $ledgerDetail['SCHEME_ID'];
            $NAME = $ledgerDetail['NAME'];
            $FNAME = $ledgerDetail['FNAME'];
            $SURNAME = $ledgerDetail['SURNAME'];
            $IS_LOCKED = $ledgerDetail['IS_LOCKED'];
            $pd->Cell($w[0],$this->columnHeight,($a++),1,0,'L');
            $pd->Cell($w[1],$this->columnHeight,$ROLL_NO,1,0,'L');
            $pd->Cell($w[2],$this->columnHeight,"$NAME",1,0,'L');
            $pd->Cell($w[3],$this->columnHeight,$FNAME,1,0,'L');

            //SSS$pdf->$row($row);

            //$pdf->Cell($w[3],$h,"$row->FNAME",1,0,'L');
            $pd->Cell($w[5],$this->columnHeight,"$MARKS_OBTAINED",1,0,'L');
            $pd->Ln();


        }




        $pd->Output($this->dept_name.".pdf",'I');
        //$pd->Output();
    }
}

?>
