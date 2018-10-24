<div class="page-content">
<div class="container floated">

	<div class="sixteen floated page-title">

	<h1>Add Personal Information on Faculty</h1>
	
		<p style='margin-bottom:10px; margin-top:10px; font-size:20px;'>This performa only for faculty members</p>

	</div>

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
                <?php echo form_open_multipart('new_registration_fac/personal_information_save');?>


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
                                    <option value="<?php echo '' . $dept_id ?>"> <?php echo '' . $dept_name ?>  </option>

                                    <?php
                                }
                                ?>
                            </select>
                        </div>





                        <div class="form-group">
                            <label for="pwd">First Name<font color="red">* </font></label>
                            <input type="text" class="form-control" pattern="([ a-zA-Z]){3,120}" title="Only Alphabets minimum 3 characters" name="<?php echo Variable::$FIRST_NAME ?>"  required>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Last Name<font color="red">*</font></label>
                            <input type="text" class="form-control" pattern="([ a-zA-Z]){3,120}" title="Only Alphabets minimum 3 characters" name="<?php echo Variable::$LAST_NAME ?>"  required>
                        </div>




                        <div class="form-group">
                            <label for="pwd">Email Address<font color="red">*(Email address account must be Gmail / Usindh  ) <?php echo $msg ?></font></label>

                            <input type="email" class="form-control" name="<?php echo Variable::$EMAIL?>" required>
                        </div>









                        <div class="form-group">
                            <label for="pwd">Employee Card (Please scan and upload your employee card)</label>
                            <input type="file" class="form-control" name="<?php echo Variable::$STUDENT_PICTURE;?>"  accept="image/jpeg" id="input-pic" >
                            <label for="pwd">Only JPG File is allowed</label>
                            <div style="border:1px solid black; width: 20%;" id="div-pic">

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

