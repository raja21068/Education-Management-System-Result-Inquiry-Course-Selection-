<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//set_include_path(APPPATH . 'third_party/' . PATH_SEPARATOR . get_include_path());
//require_once ('libraries/Google/autoload.php');

class Google_plus_cantroler extends CI_Controller
{


    private $_gp_client;
    private $_gp_plus;
    private $_gp_moment;
    private $_gp_plusItemScope;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->library('googleplus');
        $this->_gp_client = $this->googleplus->client;
        $this->_gp_plus = $this->googleplus->plus;
        $this->_gp_moment = $this->googleplus->moment;
        $this->_gp_plusItemScope = $this->googleplus->plusItemScope;
    }

    public function index()
    {
        if ($this->input->get_post('code')) {
            try {


                $this->_gp_client->authenticate($this->input->get_post('code'));
                $service = new Google_Service_Oauth2($this->_gp_client);
                $user = $service->userinfo->get(); //get user info


           //     echo 'Hi '.$user->id,  $user->name, $user->email.'';
                $this->load->model("anouncement_sheet_model");
                $teacherIdResult = $this->anouncement_sheet_model->getTeacherId($user->email);
                if ($teacherIdResult!= null) {
                    $teacherId = $teacherIdResult[0]['MEMBER_ID'];
                    $registerCourse = $this->anouncement_sheet_model->getDistinictTeacherCode($teacherId);
                    $data['course'] = $registerCourse;
                    $this->load->view("bar");
                    $this->load->view("login_sumbit", $data);
                }else{
                    $this->load->view("bar");
                    $data['authUrl'] = $this->_gp_client->createAuthUrl();
                    $this->load->view("login", $data);

                }





                //$access_token = $this->_gp_client->getAccessToken();

            //  $user = $service->userinfo->get(); //get user info

                //$this->session->set_userdata('access_token', $access_token);
                //$access_token->userinfo->get(); //get user info

                // $this->_gp_client->setAccessToken($this->session->userdata('access_token'));
                // $response = $this->_gp_plus->people->get('me');
                 //$this->_gp_plusItemScope->setId($response->id);

                // echo($user);
               //redirect('/google_plus_cantroler/me');

            } catch (Google_Auth_Exception $e) {
                print_r($e);
            }
        } else {

            try {
                $this->load->view("bar");
                $data['authUrl'] = $this->_gp_client->createAuthUrl();
                $this->load->view("login", $data);
           //      echo anchor($this->_gp_client->createAuthUrl(), 'Login With Google Plus');
                #$this->load->view("footerbar");
            } catch (Google_Auth_Exception $e) {
                _print($e);
            }
        }


        #$this->load->view('welcome_message');
    }
    public function loginTeacherCode(){
        $this->load->view("bar");
        $this->load->view("login_code");

    }

    public function me()
    {
        try {
            $this->_gp_client->setAccessToken($this->session->userdata('access_token'));
            $response = $this->_gp_plus->people->get('me');
            //$me = $plus->people->get('me');
       //   print $response->id;
            //print "Display Name: {$response['displayName']}\n";
          //  print "Image Url: {$response['image']['url']}\n";
           // print "Url: {$response['url']}\n";
          // print_r($response);

           // $this->_gp_plusItemScope->setId($response->id);
           // $this->_gp_plusItemScope->setType("http://schema.org/AddAction");
           // $this->_gp_plusItemScope->setName("The Google+ Platform");
           // $this->_gp_plusItemScope->setDescription("A page that describes just how awesome Google+ is!");
            //$this->_gp_plusItemScope->setImage("https://developers.google.com/+/plugins/snippet/examples/thing.png");

            #$this->_gp_plusItemScope->setImage($post_data['post_attachment']);
            //$this->_gp_moment->setTarget($this->_gp_plusItemScope);
            //$this->_gp_moment->setType("http://schemas.google.com/AddActivity");

            //$momentResult = $this->_gp_plus->moments->insert('me', 'vault', $this->_gp_moment);
            //print_R($momentResult);
//            echo anchor('https://plus.google.com/apps/activities', 'Check Posted Activity', array('target' => '_blank'));

        } catch (Google_Auth_Exception $e) {
            print_r($e);
        }
    }

    public function accessSheet($TEACHER_CODE = '')
    {

        if($TEACHER_CODE==""){
            $TEACHER_CODE= $this->input->get_post('TEACHER_CODE');
            //return;
        }

      //  $email = '1234';
        $this->load->model("anouncement_sheet_model");
        if($TEACHER_CODE=="") {
        return;
        }
            $ledgerDetailSumary = $this->anouncement_sheet_model->getAnnouncementSheet($TEACHER_CODE);
        $data['lds'] = $ledgerDetailSumary;
        $SCHEME_ID =$ledgerDetailSumary[0]['SCHEME_ID'];
        if($SCHEME_ID==null){
            $this->load->view("bar");
            $this->load->view("login_code");
            echo("INVALID USER NAME");
            return;
        }
        $COURSE_NO=$ledgerDetailSumary[0]['COURSE_NO'];
        $SEMESTER =$ledgerDetailSumary[0]['SEMESTER'];

        $deptNameRs = $this->anouncement_sheet_model->getDepartmentName($SCHEME_ID);

        $deptName =$deptNameRs[0]['DEPT_NAME'];
        $data['dept_name']=$deptName;
        $scheme_detail_rs = $this->anouncement_sheet_model->getSecheme($SCHEME_ID,$SEMESTER,$COURSE_NO);
        $CR_HRS=$scheme_detail_rs[0]['CR_HRS'];
        $MAX_MARKS=$scheme_detail_rs[0]['MAX_MARKS'];

        $data['dept_name']=$deptName;
        $data['cr_hrs']=$CR_HRS;
        $data['max_marks']=$MAX_MARKS;


        $this->load->view("bar");
        $this->load->view("marks_add", $data);

    }
    public function print_form(){
        $TEACHER_CODE = $this->input->post('TEACHER_CODE');
        if($TEACHER_CODE==""){
         return;
        }
       //   $TEACHER_CODE='RAJA';
        $this->load->model("anouncement_sheet_model");
        $ledgerDetailSumary = $this->anouncement_sheet_model->getAnnouncementSheet($TEACHER_CODE);
        $data['lds'] = $ledgerDetailSumary;
        $SCHEME_ID =$ledgerDetailSumary[0]['SCHEME_ID'];
        $COURSE_NO=$ledgerDetailSumary[0]['COURSE_NO'];
        $SEMESTER =$ledgerDetailSumary[0]['SEMESTER'];
        $IS_LOCKED =$ledgerDetailSumary[0]['IS_LOCKED'];
        if($IS_LOCKED == 0){
            echo("SHEET IS NOT SUMBITED");
          return;
        }
        $deptNameRs = $this->anouncement_sheet_model->getDepartmentName($SCHEME_ID);

        $deptName =$deptNameRs[0]['DEPT_NAME'];
        $data['dept_name']=$deptName;
        $scheme_detail_rs = $this->anouncement_sheet_model->getSecheme($SCHEME_ID,$SEMESTER,$COURSE_NO);
        $CR_HRS=$scheme_detail_rs[0]['CR_HRS'];
        $MAX_MARKS=$scheme_detail_rs[0]['MAX_MARKS'];

        $data['dept_name']=$deptName;
        $data['cr_hrs']=$CR_HRS;
        $data['max_marks']=$MAX_MARKS;

        $this->load->library("fpdf/cellpdf");
            $this->load->view("app_form_report");
        
          $this->load->view("print_form",$data);

    }


    public function lockSheet(){
        $IS_LOCKED = $this->input->post('IS_LOCKED');
        $TEACHER_CODE = $this->input->post('TEACHER_CODE');

        if($IS_LOCKED==1){




            echo("sheet is locked..");
            $this->accessSheet($TEACHER_CODE);

            return;
        }

        $SL_ID = $this->input->post('SL_ID');
        $TEACHER_CODE = $this->input->post('TEACHER_CODE');
        $ROLL_NO = $this->input->post('ROLL_NO');
        $MARKS_OBTAINED = $this->input->post('MARKS_OBTAINED');
        $MIN_MARKS = $this->input->post('MIN_MARKS');
        $COURSE_NO = $this->input->post('COURSE_NO');
        $SCHEME_ID = $this->input->post('SCHEME_ID');
        $this->load->model("anouncement_sheet_model");
        $this->anouncement_sheet_model->lockLedgerDetailTeacher($TEACHER_CODE,$SL_ID);

        $this->UpdateLedgerDetailTeacher($SL_ID,$TEACHER_CODE,$ROLL_NO,$MARKS_OBTAINED,$MIN_MARKS,$COURSE_NO,$SCHEME_ID);
           $this->load->view("phpqrcode/qrlib");
            QRcode::png("$TEACHER_CODE-$SL_ID-$SCHEME_ID", "picQr/".$TEACHER_CODE.".png", 'QR_ECLEVEL_L', 3, 2);


        $this->accessSheet($TEACHER_CODE);

    }
    public function UpdateLedgerDetailTeacher($SL_ID,$TEACHER_CODE,$ROLL_NO,$MARKS_OBTAINED,$MIN_MARKS,$COURSE_NO,$SCHEME_ID){
        $remarks = "";
        $grade = "";
        $qp = "";
        $CR_HRS = "";
        $num = sizeOf($ROLL_NO);
        $this->load->model("anouncement_sheet_model");
        //echo($ROLL_NO);
        $charHoursResult = $this->anouncement_sheet_model->getCourseScheme($COURSE_NO, $SCHEME_ID);
        foreach($charHoursResult as $CR) {
            $CR_HRS = $CR['CR_HRS'];
        }
        //  echo("VR".$CR_HRS."</BR>");
        // echo("MIN".$MIN_MARKS."</BR>");
        // $CR_HRS = $charHoursResult->$CR_HRS;


        $sno = 0;
        for ($i = 0; $i < $num; $i++) {
            //max marks 100
            if ($MIN_MARKS == 40) {
                $remarks = "PASS";
                $marks = $MARKS_OBTAINED[$i];

                if ($marks >= 80 && $marks <= 100) {
                    $grade = "A";
                    $qp = (4.00 * $CR_HRS);
                } else if ($marks >= 60 && $marks <= 79) {
                    $grade = "B";
                    $qp = (3.00 * $CR_HRS);
                } else if ($marks >= 50 && $marks <= 59) {
                    $grade = "C";
                    $qp = (2.00 * $CR_HRS);
                } else if ($marks >= 40 && $marks <= 49) {
                    $grade = "D";
                    $qp = (1.00 * $CR_HRS);
                } else {
                    $grade = "F";
                    $remarks = "FAIL";
                    $qp = (0.00 * $CR_HRS);
                }

            }
			
			
            //max marks 200
            if ($MIN_MARKS == 80) {
                $remarks = "PASS";
                $marks = $MARKS_OBTAINED[$i];

                if ($marks >= 160 && $marks <= 200) {
                    $grade = "A";
                    $qp = (4.00 * $CR_HRS);
                } else if ($marks >= 120 && $marks <= 159) {
                    $grade = "B";
                    $qp = (3.00 * $CR_HRS);
                } else if ($marks >= 100 && $marks <= 119) {
                    $grade = "C";
                    $qp = (2.00 * $CR_HRS);
                } else if ($marks >= 80 && $marks <= 99) {
                    $grade = "D";
                    $qp = (1.00 * $CR_HRS);
                } else {
                    $grade = "F";
                    $remarks = "FAIL";
                    $qp = (0.00 * $CR_HRS);
                }

            }
			
			
			

            //max marks 100
            if ($MIN_MARKS == 60) {
                $remarks = "PASS";
                $marks = $MARKS_OBTAINED[$i];

                if ($marks >= 87 && $marks <= 100) {
                    $grade = "A";
                    $qp = (4.00 * $CR_HRS);
                } else if ($marks >= 76 && $marks <= 86) {
                    $grade = "B";
                    $qp = (3.00 * $CR_HRS);
                } else if ($marks >= 60 && $marks <= 75) {
                    $grade = "C";
                    $qp = (2.00 * $CR_HRS);
                } else {
                    $grade = "F";
                    $remarks = "FAIL";
                    $qp = (0.00 * $CR_HRS);
                }

            }
            //max marks 100
            if ($MIN_MARKS == 50) {
                $remarks = "PASS";
                $marks = $MARKS_OBTAINED[$i];

                if ($marks >= 80 && $marks <= 100) {
                    $grade = "A";
                    $qp = (4.00 * $CR_HRS);
                } else if ($marks >= 60 && $marks <= 79) {
                    $grade = "B";
                    $qp = (3.00 * $CR_HRS);
                } else if ($marks >= 50 && $marks <= 59) {
                    $grade = "C";
                    $qp = (2.00 * $CR_HRS);
                } else {
                    $grade = "F";
                    $remarks = "FAIL";
                    $qp = (0.00 * $CR_HRS);
                }


            }

			

            // echo("Marks Obtain: ".$MARKS_OBTAINED."<br>");
            // echo("grade: ".$grade."<br>");
            // echo("remarks: ".$remarks."<br>");
            // echo("qp: ".$qp."<br>");
            // echo("slid: ".$SL_ID."<br>");
            // echo("roll: ".$ROLL_NO."<br>");
            // echo("code: ".$TEACHER_CODE."<br>");



            $this->anouncement_sheet_model->updateLedgerDetailTeacher($MARKS_OBTAINED[$i],$grade,$remarks,$qp,$ROLL_NO[$i],$TEACHER_CODE,$SL_ID);
        }
    }
    public function saveSheet()
    {
        $SL_ID = $this->input->post('SL_ID');
        $TEACHER_CODE = $this->input->post('TEACHER_CODE');
        $ROLL_NO = $this->input->post('ROLL_NO');
        $MARKS_OBTAINED = $this->input->post('MARKS_OBTAINED');
        $MIN_MARKS = $this->input->post('MIN_MARKS');
        $COURSE_NO = $this->input->post('COURSE_NO');
        $SCHEME_ID = $this->input->post('SCHEME_ID');

        $this->UpdateLedgerDetailTeacher($SL_ID,$TEACHER_CODE,$ROLL_NO,$MARKS_OBTAINED,$MIN_MARKS,$COURSE_NO,$SCHEME_ID);

        //$this->accessSheet($TEACHER_CODE);
        }

    }
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */