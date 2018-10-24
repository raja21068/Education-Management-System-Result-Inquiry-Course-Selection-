<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//set_include_path(APPPATH . 'third_party/' . PATH_SEPARATOR . get_include_path());
//require_once ('libraries/Google/autoload.php');

class Course_distribution_cantroler extends CI_Controller
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


            } catch (Google_Auth_Exception $e) {
                print_r($e);
            }
        } else {

            try {
                $this->load->view("bar");
                $data['authUrl'] = $this->_gp_client->createAuthUrl();
                $this->load->view("login", $data);
         
            } catch (Google_Auth_Exception $e) {
                _print($e);
            }
        }


        #$this->load->view('welcome_message');
    }
    public function login(){
        $this->load->view("bar");
        $this->load->view("course_distribution");

    }

    public function me()
    {
        try {
            $this->_gp_client->setAccessToken($this->session->userdata('access_token'));
            $response = $this->_gp_plus->people->get('me');
         
        } catch (Google_Auth_Exception $e) {
            print_r($e);
        }
    }

    public function loginSumbit()
    {
		$user= $this->input->get_post('USER');
        $pass= $this->input->get_post('PASS');
        
		if($user=="" || $pass==""){
				   $data['msg']='Invalid user or pass';
				  $this->load->view("bar");
				  $this->load->view("course_distribution",$data);
		
			return;
		}
				//$c_username = My_Cryptor::myEncryption($user);
                //$c_password = My_Cryptor::myEncryption($pass);
				$c_username = ($user);
                $c_password = ($pass);

		        
		$this->load->model("course_distribution_model");
        $courseDistribution = $this->course_distribution_model->distinictSchemeIdDepartmentWise($c_username,$c_password);
        //    $courseDistribution = $this->course_distribution_model->getCourseDistribution($c_username,$c_password);
			//unset($user);
			if($courseDistribution==false){
				$data['msg']='Invalid user or pass';
				  $this->load->view("bar");
				  $this->load->view("course_distribution",$data);
				
				return;
			}
			//$PROG_ID =$courseDistribution[0]['PROG_ID'];
			$data['cd'] = $courseDistribution;
            $this->load->view("bar");
			$this->load->view("course_distribution_sheet", $data);

    }
    public function departmentWiseScheme()

    {
        $progId= $this->input->get_post('prog_id');
        $groupDesc= $this->input->get_post('group_desc');
        $shift= $this->input->get_post('shift');
      //  $schemeId='1364';
        $this->load->model("course_distribution_model");

        $courseDistribution = $this->course_distribution_model->getCourseDistribution($progId,$groupDesc,$shift);
       //print_r($courseDistribution);
        //unset($user);
        if($courseDistribution==false){
            $data['msg']='Invalid user or pass';
            $this->load->view("bar");
            $this->load->view("course_distribution",$data);

            return;
        }
       // $PROG_ID =$courseDistribution[0]['PROG_ID'];
        $facultyMember = $this->course_distribution_model->getFacultyMember();


        $data['cd'] = $courseDistribution;
        $data['fm'] = $facultyMember;

//-------------------add teacher Data--------------------------------------
        $this->load->model("faculty");
        $data['department'] = $this->faculty->getDepartment();
        $data['msg'] = "";
//-------------------end  teacher Data--------------------------------------
        $this->load->view("bar");
        $this->load->view("course_distribution_view", $data);

    }
	
	 public function print_form(){
        $progId= $this->input->get_post('prog_id');
        $groupDesc= $this->input->get_post('group_desc');
        $shift= $this->input->get_post('shift');
        
        
			$this->load->model("course_distribution_model");
			$courseDistribution = $this->course_distribution_model->printCourseDistribution($progId,$groupDesc,$shift);
			
			$PROG_ID =$courseDistribution[0]['PROG_ID'];
			$PASS =$courseDistribution[0]['PASS'];
			$program_name = $this->course_distribution_model->getProgramName($PROG_ID);
			$dept_name =$program_name[0]['DEPARTMENT_NAME'];
			$program_name =$program_name[0]['PROGRAM_TITLE'];
		
			//$dept_name =$program_name[0]['DEPT_NAME'];
			//echo($program_name);
			
			$data['cd']=$courseDistribution;
			$data['dept_name']=$dept_name;
			$data['program_name']=$program_name;
			$this->load->view("phpqrcode/qrlib");
            QRcode::png("$PASS", "picQr/".$PASS.".png", 'QR_ECLEVEL_L', 3, 2);

			$this->load->library("fpdf/cellpdf");
            $this->load->view("course_distribution_report");
			$this->load->view("print_course_distribution",$data);

    }
	public function saveCourseDistribution()
    {
       //echo("raja");
	
        $NAME1 = $this->input->post('NAME1');
		$COURSE_NO = $this->input->post('COURSE_NO');
        $SCHEME_ID = $this->input->post('SCHEME_ID');
    $COURSE_DISTRIBUITION_ID = $this->input->post('COURSE_DISTRIBUITION_ID');
		$PASS = $this->input->post('PASS');
		$REMARKS= $this->input->post('REMARKS');
		$this->load->model("course_distribution_model");
		 $num = sizeOf($COURSE_NO);
		
			
        
			for ($i = 0; $i < $num; $i++) {
            $this->course_distribution_model->updateCourseDistribution($COURSE_DISTRIBUITION_ID[$i],$NAME1[$i]);
		
		}
		echo("Save Sucessfully..");
		
        	
        }
  
    }
  
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */