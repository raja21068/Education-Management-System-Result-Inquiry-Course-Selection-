<?php

/**
 * Created by PhpStorm.
 * User: RAJA DELL LAPTOP
 * Date: 2/4/2016
 * Time: 1:47 AM
 */
class PDF extends CellPDF {
    function Header()
    {
        $this->Image('sindh-university.png',50,50,100);

        //	$this->SetFont( 'Arial', 'B', 18 ); //set font to Arial, Bold, and 16 Size

        $this->SetFont('Arial','B',15);
        //  $this->Cell($w,9,$REMARKS_PROGRAM_NAME,1,1,'C',false);
//	$this->Ln(10);

    }
}