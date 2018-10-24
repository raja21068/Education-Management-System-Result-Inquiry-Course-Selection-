<div class="page-content">

    <div class="container">
        <div class="row">
            <div class='col-md-2'></div>
            <div class='col-md-9'>

                <div class="continer">
                    <p><em>  <strong>It is mandatory to provide all required information which is highlighted by <font color="red">*</font> </strong></em> </p>
                </div>
            </div>


        </div>
        <div class="row">
            <div class='col-md-10'>
                <?php echo form_open_multipart('app_form/personal_information_save');?>


                <!-- Left Side -->
                <div class="col-md-3"></div>
                <div class="col-md-6 ">
                    <div class="form-group">

                        <div class="form-group">
                            <label for="pwd">Department<font color="red">*</font></label>
                            <select class="form-control" name="<?php echo Variable::getDEPTID()?>" required>

                                <option value="">--Choose--</option>

                                <?php
                                foreach( $department as $dept )

                                {
                                    $dept_id=$dept['DEPT_ID'];
                                    $dept_name=	$dept['DEPT_NAME'];

                                    ?>
                                    <option value="<?php echo '' . $dept_id ?>"
                                        <?php if($faculty_bean->getDepartmentId() == $dept_id){echo "selected";}?>
                                    > <?php echo '' . $dept_name ?>  </option>

                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Designation<font color="red">*</font></label>
                            <select class="form-control" name="<?php echo Variable::getPREFIXID()?>" required>

                                <option value="">--Choose--</option>

                                <?php
                                foreach( $prefix as $designation )

                                {
                                    $prefix_id=$designation['PREFIX_ID'];
                                    $prefix_name=	$designation['PREFIX_NAME'];

                                    ?>
                                    <option value="<?php echo '' . $prefix_id ?>"
                                        <?php if($faculty_bean->getPrefixId() == $prefix_id){echo "selected";}?>
                                    > <?php echo '' . $prefix_name ?>  </option>

                                    <?php
                                }
                                ?>
                            </select>
                        </div>



                        <input type="hidden"  name="<?php echo Variable::$MEMBER_ID ?>" value="<?php echo $faculty_bean->getMemberId();?>" >

                        <div class="panel-heading" style="background-color:#555;margin: 0 -1px 10px -1px;padding: 0 15px;font-family: 'Trebuchet MS',Arial,Helvetica,sans-serif;font-size: 14px;line-height: 26px;text-shadow: 1px 1px 1px #000;border-radius: 7px 7px 0 0;color: white;"> Personal Details</div>
                        <div class="form-group">
                            <label for="pwd">First Name<font color="red">* </font></label>
                            <input type="text"   class="form-control" pattern="([ a-zA-Z]){3,120}" title="Only Alphabets minimum 3 characters" name="<?php echo Variable::$FIRST_NAME ?>" value="<?php echo $faculty_bean->getFirstName();?>" required>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Last Name<font color="red">*</font></label>
                            <input type="text"  class="form-control" pattern="([ a-zA-Z]){3,120}" title="Only Alphabets minimum 3 characters" name="<?php echo Variable::$LAST_NAME ?>" value="<?php echo $faculty_bean->getLastName(); ?>" required>
                        </div>


                        <div class="form-group">
                            <label for="pwd">CNIC No <font color="red">*</font></label>

                            <input type="text" name="<?php echo Variable::$CNIC ;?>" class="form-control" id="idcard" maxlength="15" pattern="[0-9]{5}-[0-9]{7}-[0-9]{1}" title="i.e. 00000-0000000-0" placeholder="i.e. 00000-0000000-0" value="<?php echo $faculty_bean->getCnic(); ?>" required>


                        </div>

                      <!--  <div class="form-group">
                            <label for="pwd">Date of Birth<font color="red">* </font></label>
                            <input type="text"  class="form-control" id="birth-date"  name="<?php echo Variable::getDATEOFBIRTH()?>" value="<?php echo $faculty_bean->getDateOfBirth(); ?>" placeholder="i.e.YYYY-MM-DD" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" >
                        </div>
-->
                        <input type="hidden" name="<?php echo Variable::getDATEOFBIRTH()?>" value="">
                        <div class="form-group">
                            <label for="pwd">Profile Url</label>
                            <input type="text" name="<?php echo Variable::$PROFILE_URL ;?>" class="form-control" id="profileUrl"  value="<?php echo $faculty_bean->getProfileUrl(); ?>" >

                        </div>




                        <div class="panel-heading" style="background-color:#555;margin: 0 -1px 10px -1px;padding: 0 15px;font-family: 'Trebuchet MS',Arial,Helvetica,sans-serif;font-size: 14px;line-height: 26px;text-shadow: 1px 1px 1px #000;border-radius: 7px 7px 0 0;color: white;"> Contact Information</div>


                        <div class="form-group">
                            <label for="pwd">Mobile Number<font color="red">*</font></label>
                            <input type="text" maxlength="11" class="form-control"  name="<?php echo Variable::$MOBILE?>" value="<?php echo $faculty_bean->getMobile(); ?>" pattern="[0-9]{11}" title="i.e. 03330000000" placeholder="i.e. 0333000000" required>
                        </div>

                        <div class="form-group">
                            <label for="pwd">Email Address<font color="red">*</font></label>
                            <input type="email" class="form-control" name="<?php echo Variable::$EMAIL?>" value="<?php echo $faculty_bean->getEmail(); ?>" required>
                        </div>



                        <div class="form-group">
                            <label for="pwd">Postal Address<font color="red">*</font></label>
                            <textarea  id="permanent" class="form-control" name="<?php echo Variable::$POSTAL_ADDRESS ?>" required><?php echo $faculty_bean->getPostalAddr(); ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="pwd">Permanent Address<font color="red">*</font></label>
                            <textarea  id="permanent" class="form-control" name="<?php echo Variable::$PERMENENT_ADDRESS?>" required><?php echo $faculty_bean->getPermenentAddr(); ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="pwd">HBL Account No<font color="red">*</font></label>
                            <input type="number" id="hbl" class="form-control" name="<?php echo Variable::$HBL_ACCOUNT_NO?>" required value="<?php echo $faculty_bean->getHblAccountNo(); ?>">
                        </div>






                        <div class="form-group">
                            <label for="pwd">Picture</label>
                            <input type="file" class="form-control" name="<?php echo Variable::$STUDENT_PICTURE;?>"  accept="image/jpeg" id="input-pic" <?php echo $img_input;?>>
                            <label for="pwd">Only JPG File is allowed</label>
                            <div style="border:1px solid black; width: 25%;" id="div-pic">
                                <img <?php echo $img_src;?>>
                            </div>
                        </div>


                        <!--    <input type="submit" class="btn btn-default pull-right" value='Next &Gt;' >-->
                        <button type="submit" class="btn btn-info">Save
                            <i class="glyphicon glyphicon-arrow-right"></i>
                        </button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>







  <script>

        //---------------id card  setting ------------------------------------------------
        jQuery(function($){
            $("#idcard").mask("99999-9999999-9");
        });


        jQuery(function($){
            $("birth-date").mask("1991-02-10");
        });

        //-----------------------------picture setting -----------------------------------

        function putPicture(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#div-pic').html("<img src='' id='img-pic' >");
                    $('#img-pic').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#input-pic").change(function(){
            putPicture(this);
        });

    </script>

