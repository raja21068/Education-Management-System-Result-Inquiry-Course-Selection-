  <?php
  
@session_start();
if(isset($_SESSION['LOGGED']) && $_SESSION['LOGGED'] == 1){
    
    //echo $_SESSION['LOGGED'];
    //header("Location: http://exam.usindh.edu.pk/attendance_home.php");
    header("Location: http://104.223.95.210/attendance_home.php");
}
?>
  
  <!DOCTYPE HTML>
<html lang="en-US" xmlns="http://www.w3.org/1999/html">

 <!-- Basic Page Needs
  ================================================== -->
	    <!-- Basic Page Needs
  ================================================== -->
<link rel="shortcut icon" href="favicon.ico">
<link rel="icon" type="image/gif" href="images/animated_favicon1.gif">

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>Attendance Login</title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!--================================================== -->
<?php
echo("<h1 align=center style='font-size:18px;'>ONLINE Attendance System</h1>");

include("bar.php");
?>
<script>
	$(document).ready(function(){
		$('nav ul li a').each(function() {
			if($(this).text() == "Results"){
				$(this).attr("id","current");
			}else {
				$(this).removeAttr("id");
			}
    	});
	});
</script>
<div class="container floated">

	<div class="sixteen floated page-title">

	<!--	<h3>Semester Results for Ex-Students from Academic Year 2004 to 2013 only</h3>

		<p style='margin-bottom:10px; margin-top:10px; font-size:15px; color:red;'>Note: This gazette is not for currently enrolled students and it is published for record and verification purposes only</p>
		 -->
	</div>
	

                    
    <!-- Page Content -->
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class='col-md-10'>
                    <div class="text-center"><h3><span class="label label-default"> Login - ITSC (Attendance Cell) </span></h3></div>
                    </br>
                    <div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                     
                    <div class="text-danger">
                    <FORM action='attandance_login.php' method='POST'>
                    </div>
                            <div class="form-group has-feedback">
                                <input type="text" class="form-control" placeholder="Username" id='username' name="username" required>
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="password" class="form-control" placeholder="Password" id='password' name="password" required>
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="text-danger">
                                <p>username and password are case sensitive</p>
                            </div>
                            <?php //echo  $this->recaptcha->recaptcha_get_html(); ?>
                           </br>
                            <div class="form-group">
                                 <label>
                            <input type="checkbox" id="remember"> Remember Me
                        </label>
                                <button type="button" id='login' class="btn btn-success" align="center" name='login'>Login
                                    <i class="glyphicon glyphicon-log-in"></i>
                                </button>
                            </div>
                                    <span id='loginMsg'></span>



                            </FORM>
                    </div>
               

                        <div class="col-md-4"></div>

                    </div>

        
                    
                </div>

        </div>
            <!--IMPORTANT INSTRUCTION -->

            </div>
        </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type='text/javascript'>

 $('#login').on('click',function () {

///alert('working');
        var username = $('#username').val();
        var password = $('#password').val();

//alert(username);
//alert(password);

        if($('#remember').prop('checked') == true){

            var remember = parseInt(1);
        }else{
            var remember = parseInt(0);
        }

        if(username == "" || username == null || password == "" || password == null ){

            $('#loginMsg').css('color','red');
            $('#loginMsg').text('Please Enter User Credentials...!');
            return;

        }else {

            flag = 'login';
            $.ajax({
                method: "POST",
                url: "attendance_login_queries.php",
                data: {username:username, password:password, remember:remember, flag:flag },
                //dataType: 'json',
                cache: false,
                async: false,
                success: function(data) {

//alert(data);
                    if(data == 'Sign in Succeeded'){
                        
                        window.location.replace('http://104.223.95.210/attendance_home.php');


                        //$('#loginMsg').html('<a href="logout.php"> Logout </a>');
                        //window.open('index.php')

                    //location.reload();
                    
                    }else{
                        $('#loginMsg').css('color','red');
                        $('#loginMsg').text(data);
                    }


                }
            });

        } // end else of user credentials empty

    });
    
</script>

	         <?php 
                    // $msg = '';
                    
                    // if(isset($_POST['login']))
                    
                    // {
                        
                    //     		$user	=trim($_POST["username"]);
	                   //     	$pass	=trim($_POST["pass"]);
	                        	
	                   //     if($user == null || $pass == ""){
	                           
	                   //       $msg ='Username and Pasword are required';  
	                   //     }else{
	                            
	                   //         $default_username ="itscattendancecell";
	                   //         $default_pass =md5('itschightech123*');
	                            
	                   //     $pass = md5($pass);
	                            
	                   //         if($user !=$default_username ||  $pass!=$default_pass){
	                                
	                   //             $msg = "you have entered invalid username or password";
	                                
	                   //         }else{
	                   //            // echo "esle working";
	                   //          //   session_start();
	                   //            // $_SESSION['LOGGED']=1;
	                                
	                   //             header('location:attendance_home.php');
	                             
	       	                          
	       	           //                 }
	       	           //             }
	                   //        }
                    
                    ?>

