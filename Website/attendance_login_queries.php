<?php
/**
 * Created by PhpStorm.
 * User: Yasir
 * Date: 20-May-18
 * Time: 12:32 AM
 */
require_once ('conn_attendance.php');

function accesslogs ($user,$respone){

    $dateTime = date("d/ M/ Y - h:i:s a");
    $logFile = fopen("attendance_login_Logs.txt",'a');

    $txt="[".$dateTime."]"." [USER: ".$user.' '.$respone."]\r\n";
    fwrite($logFile,$txt);
    fclose($logFile);
}

if(isset ($_POST['flag']) && $_POST['flag'] == 'login'){

   // require_once ('activeUserStatus.php');

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $remember = trim($_POST['remember']);
    $decoded_password = trim($_POST['password']);

//echo $username.' '.$password;

    $clientIp  = @$_SERVER['REMOTE_ADDR'];
    if(empty($username) || $username == null){

            $db->close();
            exit('Please Type Username...!');
        }
    if(empty($password) || $password == null){

        $db->close();
        exit('Please Type Password...!');
    }else{

        $password = md5($password);
    }


$stmt = $db->prepare("SELECT USER_ID,NAME,USER_NAME,ACCT_STATUS,REMARKS FROM sac_login_user WHERE USER_NAME=? AND PASSWORD=?");

    $stmt->bind_param('ss',$username,$password);

$stmt->execute();

    if($stmt->num_rows === 0){

        $stmt->bind_result($USER_ID,$NAME,$USER_NAME,$ACCT_STATUS,$REMARKS);
        $stmt->fetch();

        if(empty($USER_ID) || $USER_ID == null ){

            accesslogs($username,'Sign in Failed - IP address '.$clientIp);
        //    $db->close();
            $stmt->close();
            //exit('Invalid Credentials...!');
            
            //LOGIN FOR TEACHERS
            
            $stmt = $db->prepare("SELECT MEMBER_ID,FIRST_NAME,LAST_NAME,EMAIL_ADRESS FROM faculty_members WHERE EMAIL_ADRESS=? AND PASSWORD=?");

            $stmt->bind_param('ss',$username,$password);
            $stmt->execute();
            
             $stmt->bind_result($MEMBER_ID,$FIRST_NAME,$LAST_NAME,$EMAIL);
             $stmt->fetch();
             
          if(empty($MEMBER_ID) || $MEMBER_ID == null ){

            accesslogs($username,'Sign in Failed - IP address '.$clientIp);
        //    $db->close();
            $stmt->close();
            exit('Invalid Credentials...!');
            
          }else{
              
                 accesslogs($username, 'Sign in Succeeded - IP address '.$clientIp);

                @session_start();

                $_SESSION['REMARKS'] = 'TEACHER_LOGIN';
                $_SESSION['ACCT_STATUS'] = '';
                $_SESSION['NAME'] = $FIRST_NAME.' '.$LAST_NAME;
                $_SESSION['USER_ID'] = $MEMBER_ID;
                $_SESSION['USERNAME'] = $EMAIL_ADRESS;
                $_SESSION['LOGGED'] = 1;

              
                $db->close();
                $stmt->close();
                exit('Sign in Succeeded');
          }
            
            

                
            
        }else{

            if($ACCT_STATUS == 0){

                accesslogs($username, 'Sign in Succeeded - access suspended - IP address '.$clientIp);
                $db->close();
                $stmt->close();

                exit('Access Suspended...!');

            }elseif($ACCT_STATUS == 1) {
                // making log file
                accesslogs($username, 'Sign in Succeeded - IP address '.$clientIp);

                @session_start();

                $_SESSION['REMARKS'] = $REMARKS;
                $_SESSION['ACCT_STATUS'] = $ACCT_STATUS;
                $_SESSION['NAME'] = $NAME;
                $_SESSION['USER_ID'] = $USER_ID;
                $_SESSION['USERNAME'] = $USER_NAME;
                $_SESSION['LOGGED'] = 1;

               // active(1,$USER_ID);

                if($remember == 1){

                    setcookie('username',"$username", time() + (86400 * 7), "/");
                    setcookie('password',"$decoded_password", time() + (86400 * 7), "/");
                }elseif($remember == 0){


                    unset($_COOKIE['username']);
                    unset($_COOKIE['password']);

                    setcookie("username", "", -1);
                    setcookie("password", "", -1);
                }
                //header("LOCATION:index.php");

                $db->close();
                $stmt->close();
                exit('Sign in Succeeded');

            }
        }
        
        

    } // login for different accounts
}// login isset