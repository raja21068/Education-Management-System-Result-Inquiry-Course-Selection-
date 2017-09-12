<?php
require_once('../DataBaseManagerForm.php');

class DisplayData{
 public static function showData($roll_no,$name,$fname,$surname,$semester,$shift,$dept_name,$batch_id,$scheme_id,$examType,$progId){

                        echo('<form action="print.php" method="post" target="blank" enctype="multipart/form-data" class="form-horizontal">' );
                        echo('<table class="table  table-bordered table-striped">');
                        echo("<input type='hidden' name='roll_number' value= '".$roll_no."'>");
                        echo("<input type='hidden' name='name' value='".$name."'>");
                        echo("<input type='hidden' name='fname'  value='".$fname."'>");
                        echo("<input type='hidden' name='surname'  value='".$surname."'>");
                        echo("<input type='hidden' name='semester'  value='".$semester."'>");
                        echo("<input type='hidden' name='shift'  value='". $shift."'>");
                        echo("<input type='hidden' name='dept_name'  value='".$dept_name."'>");
                        echo("<input type='hidden' name='batch_id'  value='".$batch_id."'>");
                        echo("<input type='hidden' name='scheme_id'  value='".$scheme_id."'>");
						echo("<input type='hidden' name='prog_id'  value='".$progId."'>");
               /*
                    session_start();

                    $_SESSION["roll_number"] = $roll_no;
                    $_SESSION["name"] = $name;
                    $_SESSION["fname"]=$fname;
                    $_SESSION["surname"]=$surname;
                    $_SESSION["semester"]=$semester;
                    $_SESSION["shift"]= $shift;
                    $_SESSION["dept_name"]=$dept_name;
                    $_SESSION["batch_id"]=$batch_id;
                    $_SESSION["scheme_id"]=$scheme_id;

                */
               // echo("<TABLE table-bordered table-striped'>");
               ?>
               <div class="row">

                        <div class="panel-heading" style="background-color:#555;margin: 0 352px 10px 252px;padding: 0 15px;font-family: 'Trebuchet MS',Arial,Helvetica,sans-serif;font-size: 20px;line-height: 32px;text-shadow: 1px 1px 1px #000;border-radius: 7px 7px 0 0;color: white;"> Personal Details</div>


                  <div class="col-md-2"></div>

                       <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Roll No</label>
                       <div class="col-sm-10 col-md-3">
                        <input type="text" class="form-control" value="<?php echo $roll_no;?>" disabled="disabled">
                        </div>
                           </div>
                                 <div class="col-md-2"></div>

                           <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                       <div class="col-sm-10 col-md-3">
                        <input type="text" class="form-control" value="<?php echo $name;?>" disabled="disabled">
                        </div>
                           </div>
                                                            <div class="col-md-2"></div>

                           <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Father Name</label>
                       <div class="col-sm-10 col-md-3">
                        <input type="text" class="form-control" value="<?php echo $fname;?>" disabled="disabled">
                        </div>
                           </div>
						   
                                                            <div class="col-md-2"></div>

                           <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Surname</label>
                       <div class="col-sm-10 col-md-3">
                        <input type="text" class="form-control" value="<?php echo $surname;?>" disabled="disabled">
                        </div>
                           </div>
                           <?php
        if($examType=="F"){
                    echo("<input type='hidden' name='exam_type'  value='F'>");
                    }elseif($examType=="R"){
                    echo("<input type='hidden' name='exam_type'  value='R'>");
                    }else{
                    echo("<font color='red'>Wrong Input Try Again...</font>");
                    return;
                    }

?>
                       <div class="col-md-2"></div>

                      <!--  <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Cell No</label>
                       <div class="col-sm-10 col-md-3">
                        <input input type='text' name='cellNo' required class="form-control" >
                        </div>
                           </div>
						  
                                       <div class="col-md-2"></div>
								-->
                            <div class="form-group">
<div class=" col-md-2">		</div>
<div class=" col-md-4">				
                      <label for="inputEmail3" class="control-label">Please upload your  recent passport size photograph with white background 
					  </label>
					  </div>
<div class=" col-md-4"></div>					  
                       <div class="col-sm-10 col-md-3">
                        <input <input type='file' name='my_files' accept='image/* required' id='i_submit'required class="form-control" >
						<font color="red">Maximum image size 2mb</font>
						<font color="red">(Your photograph will appear on your Mraksheet/ Transript/ Degree)</font>
                        </div>
                           </div>
						   <?php                 if($examType=="F"){
 ?>
           
                             <div class="panel-heading" style="background-color:#555;margin: 0 352px 10px 252px;padding: 0 15px;font-family: 'Trebuchet MS',Arial,Helvetica,sans-serif;font-size: 20px;line-height: 32px;text-shadow: 1px 1px 1px #000;border-radius: 7px 7px 0 0;color: white;"> Bank Details</div>

                                 <div class="col-md-2"></div>

                            <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Challan No</label>
                       <div class="col-sm-10 col-md-3">
                        <input input type='number' name='challanNo' id='challanNo' value='0' required class="form-control" >
                        </div>
                           </div>
                                 <div class="col-md-2"></div>

 <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Challan Date(MM/DD/YYYY)</label>
                       <div class="col-sm-10 col-md-3">
                        <input type='date' name='challanDate'  required class="form-control"  >
                        </div>
                           </div>
                                 <div class="col-md-2"></div>

 <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Challan Rs</label>
                       <div class="col-sm-10 col-md-3">
                        <input type='number' name='challanRS' id='challanRs' value='0' required class="form-control" >
                        </div>

                           </div>

            <?php }?>


                                                        <div class="panel-heading" style="background-color:#555;margin: 0 352px 10px 252px;padding: 0 15px;font-family: 'Trebuchet MS',Arial,Helvetica,sans-serif;font-size: 20px;line-height: 32px;text-shadow: 1px 1px 1px #000;border-radius: 7px 7px 0 0;color: white;"> Subject Details</div>
                                                            <div class="col-md-4"></div>

                             <div class="form-group">
							
                             <select name='courceDetail' id='courceDetail' class="col-sm-10 col-md-3" >
                             <?php


                            require_once('../Database.php');
		                    if($examType=="F"){
								
							$part=DataBaseManager1::getpart($semester);
							$sl_id=get_last_SL_ID($batch_id,$part,$roll_no);
							$progId=DataBaseManager1::getProgramId($roll_no);
							//echo("raja ".$progId);
		//					$filter="AND ld.`GRADE`  IN ('D','F')";
						
							if($progId==4 || $progId==159 || $progId==175 || $progId==188 || $progId==193 || $progId==195 || $progId==199 || $progId==208 || $progId==218 || $progId==6 || $progId==109 || $progId==187 || $progId==117 || $progId==166 ){
							//echo("ss");							
							$filter="AND ld.`GRADE`  IN ('F')";
								
							}else{
								$filter="AND ld.`GRADE`  IN ('C','D','F')";
							}
							//$filter="AND ld.`GRADE`  IN ('C','D','F')";
								
						  $result= DataBaseManager1::getImpFalCources($semester,$roll_no,$sl_id,$filter);

						 while($row_ImpFalCources=mysqli_fetch_array($result)){
                        $courseNo=$row_ImpFalCources['COURSE_NO'];
                        $schemeId=$row_ImpFalCources['SCHEME_ID'];
						$ac_id=$row_ImpFalCources['AC_ID'];
                         $minMarks=$row_ImpFalCources['MIN_MARKS'];

							DataBaseManager1::getSchemeDetail($schemeId,$courseNo,$ac_id,$semester);


					} // END WHILE
                        } // END IF
			            else{

                    DataBaseManager1::getCourceDetail($scheme_id,$semester);
}



 ?>
                             </select>
                       <div class="col-sm-10 col-md-3">
                        <button  type='button' id='add-cources' class="form-control btn btn-primary" > ADD SUBJECTS </button>
                        </div>
                           </div>
 <?php
							 if($examType=="F"){
							 ?>
							  <div class="col-sm-10 col-md-3"></DIV>
							   <div class="col-sm-10 col-md-6">.
							<!-- <font color="red">Note: You have to reappear in cources in which failled or got 'D' grade</font>-->
							 </DIV>
							 <?php } ?>


                        </div>
               <?php

               /*
                    echo("<TR>");
                    echo("<Td>ROLL NO:</Td>");
                    echo("<Td>$roll_no</Td>");
                    echo("</TR>");
                    echo("<TR>");
                    echo("<Td>Name</Td>");
                    echo("<Td>$name</Td>");
                    echo("</TR>");

                    echo("<TR>");
                    echo("<Td>Father<span>'<span>s Name</Td>");
                    echo("<Td>$fname</Td>");
                    echo("</TR>");

                    echo("<TR>");
                    echo("<Td>Surname</Td>");
                    echo("<Td>$surname</Td>");
                    echo("</TR>");
					echo("<TR>");




                    echo("<Td>Mobile Number</Td>");
                    echo("<Td><input type='text' name='cellNo' required></Td>");
                    echo("</TR>");

                  //  echo("<TR>");
                   // echo("<Td COLSPAN='2'><input type='radio' name='exam_type' id='faliure' value='F'>FAILURE / IMPROVER   <input type='radio' name='exam_type' id='regular' value='R' checked='checked'>REGULAR </Td>");
                    //echo("</TR>");
                if($examType=="F"){
                    echo("<TR>");
                    echo("<Td>Challan No</Td>");
                    echo("<Td><input type='number' name='challanNo' id='challanNo' value='0'></Td>");
                    echo("</TR>");

                    echo("<TR>");
                    echo("<Td>Challan Date</Td>");
                    echo("<Td><input type='date' name='challanDate' id='challanDate'></Td>");
                    echo("</TR>");

                    echo("<TR>");
                    echo("<Td>Challan Rs</Td>");
                    echo("<Td><input type='number' name='challanRS' id='challanRs' value='0'></Td>");
                    echo("</TR>");
            }

				echo("<TR>");
                    echo("<Td>Upload Picture</Td>");
                    echo("<Td><input type='file' name='my_files' accept='image/* required' id='i_submit'></Td>");
                    echo("</TR>");
                    //echo("</TABLE>");

// echo('<table class="table  table-bordered table-striped">');



                    echo("<TR>");
                    echo("<td><select name='courceDetail' id='courceDetail' >");


                        /*
                            require_once('../Database.php');
		                    if($examType=="F"){
                        $part=DataBaseManager1::getpart($semester);
							$sl_id=get_last_SL_ID($batch_id,$part,$rollNo);
						  $result= getImpFalCources($MARKS_OBTAINED,$semester,$rollNo,$sl_id);

						 while($row_ImpFalCources=mysqli_fetch_array($result)){
                        $courseNo=$row_ImpFalCources['COURSE_NO'];
                        $schemeId=$row_ImpFalCources['SCHEME_id'];
						$ac_id=$row_ImpFalCources['AC_ID'];
                         $minMarks=$row_ImpFalCources['MIN_MARKS'];

						//	getSchemeDetail($schemeId,$courseNo,$ac_id);


					} // END WHILE
                        } // END IF


                    DataBaseManager1::getCourceDetail($scheme_id,$semester);
                    
							 
                                         

                    echo("</select> </td>");
                    echo("<Td><button type='button' id='add-cources' >ADD SUBJECTS</input></Td>");

                    echo("</TR>");
// 	getGazet($rollNo,$name, $link);


*/
              
                echo("<div id='display'></div>");

//                echo("</TABLE>");
                ?>
<div class="row">
<div class="col-lg-4 col-md-4"></div>
    <div class="col-lg-4 col-md-4">
<table class='table  table-bordered table-striped''>

<tbody id="table-body-courceDetail" >
</tbody>
    </div>
<tr><td colspan="3"><input type="submit" value="save and print"></td></tr>

</table>
    </div>

</form>
<?php
}
}
?>

