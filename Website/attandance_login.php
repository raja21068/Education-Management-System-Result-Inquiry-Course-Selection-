    <!-- Page Content -->
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class='col-md-10'>
                    <div class="text-center"><h3><span class="label label-default">Signup for Attandance</span></h3></div>
                    </br>
                    <div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                     
                    <div class="text-danger">
                    <FORM action='attandance.php' method='POST'>
                    </div>
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control" placeholder="Email" name="username" required>
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="date" class="form-control" placeholder="Date Of Birth" name="pass" required>
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="text-danger">
                                <p>username and password are case sensitive</p>
                            </div>
                            <?php //echo  $this->recaptcha->recaptcha_get_html(); ?>
                           </br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success" align="center">Login
                                    <i class="glyphicon glyphicon-log-in"></i>
                                </button>
                            </div>




                            </FORM>
                    </div>

                        <div class="col-md-4"></div>

                    </div>

                </div>

        </div>
            <!--IMPORTANT INSTRUCTION -->

            </div>
        </div>




