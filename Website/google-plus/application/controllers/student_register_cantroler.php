<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//set_include_path(APPPATH . 'third_party/' . PATH_SEPARATOR . get_include_path());
//require_once ('libraries/Google/autoload.php');

class student_register_cantroler extends CI_Controller
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

    public function registerForm()
    {
		$this->load->model("anouncement_sheet_model_register");
		$department = $this->anouncement_sheet_model_register->getDepartment();
		$data['department']=$department;
        $this->load->view("bar");
        $this->load->view("student_registration", $data);

    }
	public function getProgramAjax(){
			$deptID= $this->input->get('depId');
            
			$this->load->model("anouncement_sheet_model_register");
			$program = $this->anouncement_sheet_model_register->getProgram($deptID);
						foreach( $program as $pro )

                                {
									 $prog_id =$pro['PROG_ID'];
									$program_tittle =$pro['PROGRAM_TITLE'];	
									echo("<option VALUE='$prog_id'>$program_tittle</option>");
								}
	
		
	}
	
	public function getCourseAjax(){
			$progId= $this->input->get('progId');
			$year= $this->input->get('year');
			$semester= $this->input->get('semester');
			
            
			$this->load->model("anouncement_sheet_model_register");
			$scheneDetail = $this->anouncement_sheet_model_register->getSchemeDetail($progId,$year,$semester);
						foreach( $scheneDetail as $sd )

                                {
									 $COURSE_NO =$sd['COURSE_NO'];
									$COURSE_TITLE =$sd['COURSE_TITLE'];	
									echo("<option VALUE='$COURSE_NO'>$COURSE_TITLE</option>");
								}
	
		
	}
	
	public function getBatchAjax(){
			$progId= $this->input->get('program_id');
			$semester= $this->input->get('semester');
			$year= $this->input->get('exam_year');
			$depId= $this->input->get('depId');
	
			
		$part=0;
	
					if($semester==1||$semester==2){
					$part=1;
				}elseif($semester==3 || $semester==4){
				$part=2;
				}elseif($semester==5 || $semester==6){
				$part=3;
				}elseif($semester==7 || $semester==8){
				$part=4;}	
	
	
			$announced_programs="";
		$not_announced_programs="";
		$is_ann=0;
		$is_not_ann=0;
		$prog="";        
		
		
			$this->load->model("anouncement_sheet_model_register");
			
	//		echo("program $progId <br> Semester $semester </br> year $year </br> $depId ");
			
			
			$batch = $this->anouncement_sheet_model_register->getBatch($progId,$depId);
							foreach( $batch as $b )

                                {
									 $batch_id =$b['BATCH_ID'];
									 
									$seatList = $this->anouncement_sheet_model_register->getSeatlistLedger($batch_id,$part,$year);
									
			
									foreach($seatList as $sl)

									{
									$is_not_ann=1;
							
									
								$b_YEAR=$b["YEAR"];
								$TYPE=$sl["TYPE"];
								$EXAM_YEAR=$sl["YEAR"];
								$SL_ID=$sl["SL_ID"];
								$BATCH_YEAR=$this->anouncement_sheet_model_register->get_batch_year_encode($b_YEAR);
								$SHIFT=$b["SHIFT"];
								$BATCH_ID=$b["BATCH_ID"];
								$GROUP_DESC=$b["GROUP_DESC"];                        
								$PART_REMARKS=$sl["PART_REMARKS"];
							
					$program_ann=("".$this->anouncement_sheet_model_register->encode_exam_type($TYPE)." BATCH ($BATCH_YEAR)");
					

					if(strstr($SHIFT,"E")=="E" &&  strstr($PART_REMARKS,"EVENING")==null)
						$program_ann="$program_ann ".$this->anouncement_sheet_model_register->get_shift_encode($SHIFT)."";
					if($GROUP_DESC!=null && $GROUP_DESC!="GNRL")
						$program_ann="$program_ann ".$this->anouncement_sheet_model_register->get_batch_group_encode($GROUP_DESC)."";

					$announced_programs=$announced_programs."$program_ann";
					
					echo("<option value='$SL_ID'> $PART_REMARKS $program_ann</option>");
						
									
									} // end seatlist
						
															
								
								} // end batch
				
						
	
	
		
	} // end function
    

    
    }
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */