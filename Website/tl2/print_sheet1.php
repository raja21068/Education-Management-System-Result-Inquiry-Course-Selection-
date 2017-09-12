<?php
      include("../Database.php");
	  	$STUDENT_CODE=strtoupper($_REQUEST['STUDENT_CODE']);
	$REMARKS_PROGRAM_NAME=$_REQUEST['REMARKS_PROGRAM_NAME'];
	$COURSE_TITLE=$_REQUEST['COURSE_TITLE'];
//echo($COURSE_TITLE);
	  require('fpdf/cellpdf.php');
		class PDF extends FPDF
		{
		function Header()
			{
    	$this->Image('sindh-university.png',50,50,100);
		   
		//	$this->SetFont( 'Arial', 'B', 18 ); //set font to Arial, Bold, and 16 Size 
			 
 $this->SetFont('Arial','B',15);
 //  $this->Cell($w,9,$REMARKS_PROGRAM_NAME,1,1,'C',false);
//	$this->Ln(10);
  		
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
		$pdf->Cell(0,8,$REMARKS_PROGRAM_NAME,0,1,'C',false);
		$pdf->Ln();
		$pdf->Cell(0,9,"$COURSE_TITLE",0,1,'C',false);
		$pdf->Ln();
  	
	
	//echo("<body background='background.gif' onload='window.print()'>");
	//echo("<center> ");
//	echo("<img src=header_left.gif><br>");

	//echo("<font size=7 color='#006666'><b>Subject Wise Sheet</b></font><br> ");
//	echo("<font size=6><b>Semester Examinations</b></font><br>");
	//echo("<font size=5><b>University of Sindh, Jamshoro</b></font><br><br>");
		
		
		
			  $query="SELECT BATCH_ID,ROLL_NO, MARKS_OBTAINED, GRADE, COURSE_NO,MIN_MARKS,REMARKS,COURSE_TITLE,REMARKS_PROGRAM_NAME FROM ledger_details_teacher WHERE STUDENT_CODE='$STUDENT_CODE'";
			$result_teacher_list=mysql_query($query);
		$rows=mysql_num_rows($result_teacher_list);
			if($rows<1){
			echo("WRONG codes");
			return;
			}
			$w = array(12, 45, 120, 50,40,20);
			$h=10;
					
			 if($rows>0){
                      for($a=0; $a<$rows; $a++){
                        $COURSE_TITLE =mysql_result($result_teacher_list,$a,"COURSE_TITLE");
						$REMARKS_PROGRAM_NAME =mysql_result($result_teacher_list,$a,"REMARKS_PROGRAM_NAME");
						$MARKS_OBTAINED =mysql_result($result_teacher_list,$a,"MARKS_OBTAINED");
						$GRADE =mysql_result($result_teacher_list,$a,"GRADE");
						$MIN_MARKS =mysql_result($result_teacher_list,$a,"MIN_MARKS");
						$REMARKS =mysql_result($result_teacher_list,$a,"REMARKS");
						//$SL_ID =mysql_result($result_teacher_list,$a,"SL_ID");
						$BATCH_ID =mysql_result($result_teacher_list,$a,"BATCH_ID");
						$ROLL_NO =mysql_result($result_teacher_list,$a,"ROLL_NO");
						
							
						if($a==0){
		//				echo("<font size=5><b></b>$REMARKS_PROGRAM_NAME</font><br><br>");
			 
		//				echo(" <table border=1>");
		//				echo("<TR style='color: white; background-color: #666666'>");
		//				echo("    <TH colspan=8  ALIGN=CENTER><h2>$COURSE_TITLE</h2></TH>");
		//				echo("</TR>");
				
	//					echo("</TR>");
						
		//				echo("<tr style='color: white; background-color: #666666'>");
							// Column widths
							// Header
						$pdf->Cell($w[0],$h,"S.NO",1,0,'C');
						$pdf->Cell($w[1],$h,"ROLL NO",1,0,'C');
						$pdf->Cell($w[2],$h,"NAME",1,0,'C');
						//$pdf->Cell($w[2],$h,"FNAME",1,0,'C');
						$pdf->Cell($w[5],$h,"MARKS",1,0,'C');
						$pdf->Ln();
						
					
		
						} //end if 
												
						$query="select BATCH_ID,ROLL_NO,NAME,FNAME,SURNAME,GENDER from  student_registration where ROLL_NO='$ROLL_NO' AND BATCH_ID='$BATCH_ID'";
							$result=mysql_query($query);
							if($row=mysql_fetch_object($result)){
					
							
						$pdf->Cell($w[0],$h,($a+1),1,0,'L');
						$pdf->Cell($w[1],$h,$ROLL_NO,1,0,'L');
						//word_wrap($pdf,"$row->FNAME");
						$pdf->Cell($w[2],$h,"$row->NAME",1,0,'L');
							//SSS$pdf->$row($row);
					
						//$pdf->Cell($w[3],$h,"$row->FNAME",1,0,'L');
						$pdf->Cell($w[5],$h,"$MARKS_OBTAINED",1,0,'L');
						$pdf->Ln();
												
							
					
						} //end if student
					
				
		
                     
					}	
	$pdf->Output();
				
					}			
				


				
?>




 