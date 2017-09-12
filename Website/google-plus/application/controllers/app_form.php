<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class App_Form extends CI_Controller
{
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

                $this->load->model("faculty");
                $facultyBean = new Faculty;
                $facultyInfo = $this->faculty->getFacuiltyInfo($user->email);
                $facultyBean=$facultyInfo;

                if ($facultyInfo) {
                    if($facultyInfo->getMemberId() == null){
                        $data['img_src'] = '';
                        $data['img_input'] = 'required';
                    }else{
                        $data['img_input'] = '';
                        $data['img_src'] = "src='".base_url("uploads/".($facultyInfo->getMemberId())).".jpg?" . time() ."'";
                    }
                    $data['faculty_bean'] = $facultyBean;
                    $data['prefix'] = $this->faculty->getPrefix();
                    $data['department'] = $this->faculty->getDepartment();
                    $this->load->view("bar");
                    $this->load->view("facultyForm", $data);
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
                //      echo anchor($this->_gp_client->createAuthUrl(), 'Login With Google Plus');
                #$this->load->view("footerbar");
            } catch (Google_Auth_Exception $e) {
                _print($e);
            }
        }


        #$this->load->view('welcome_message');
    }








    public function personal_information_save(){

            $this->load->model("faculty");

            $deptId=$this->input->post(Variable::getDEPTID());
            $prefixId=$this->input->post(Variable::getPREFIXID());
            $firstName=$this->input->post(Variable::getFIRSTNAME());
            $firstName= strtoupper($firstName);
            $lastName=$this->input->post(Variable::getLASTNAME());
            $lastName = strtoupper($lastName);
            $cnic=$this->input->post(Variable::$CNIC);
            $dateOfBirth=$this->input->post("birth-date");
            $mobile=$this->input->post(Variable::getMOBILE());
            $email=$this->input->post(Variable::getEMAIL());
            $email = strtolower($email);
            $permenentAddr=$this->input->post(Variable::getPERMENENTADDRESS());
            $permenentAddr=strtoupper($permenentAddr);
            $postalAddr=$this->input->post(Variable::getPOSTALADDRESS());
            $postalAddr=strtoupper($postalAddr);
            $hblAccountNo=$this->input->post(Variable::getHBLACCOUNTNO());
            $profileUrl=$this->input->post(Variable::getPROFILEURL());
            $fac_member_id = $this->input->post(Variable::getMEMBERID());
            $this->faculty->updateFaculty($deptId,$prefixId ,$firstName,$lastName ,$cnic,$dateOfBirth,$mobile,$email,$permenentAddr,$postalAddr,$hblAccountNo,$profileUrl);



            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|png';
            $config['overwrite'] = TRUE;
            $config['detect_mime'] = TRUE;
            $config['file_name'] =($fac_member_id);
            $this->load->library('upload', $config);
            if ( $this->upload->do_upload(Variable::STUDENT_PICTURE()))
            {
                $gd['image_library'] = 'gd2';
                $gd['source_image']	= './uploads/'.$this->upload->file_name;
                $gd['maintain_ratio'] = TRUE;
                $gd['create_thumb'] = TRUE;
                $gd['thumb_marker'] = '';
                $gd['overwrite'] = TRUE;
                $gd['width']	= 400;
                $gd['height']	= 400;
                $this->load->library('image_lib', $gd);
                $this->image_lib->resize();

            }
        $this->load->view("bar");
        $data['msg']= "Data Updated Sucessfully..";
        $this->load->view("sucessfulMsg",$data);

    }



    public function sendMail($from,$senderName,$to,$cc,$subject,$message="",$filePath)
    {
        $this->load->library('email'); // load email library
        $this->email->from($from, $senderName);
        $this->email->to($to);
        $this->email->cc($cc);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->attach($filePath); // attach file
       // $this->email->attach('/path/to/file2.pdf');
        if ($this->email->send())
            echo "Mail Sent!";
        else
            echo "There is error in sending mail!";
    }

function testmail()
{
    $this->load->library('email'); // load email library
    $this->email->from('rajakumarlohano@gmail.com', 'Admission University of Sindh');
    $this->email->to('rajakumarlohano@gmail.com');
    //$this->email->cc('test2@gmail.com');
    $this->email->subject('Admission Form');
    $this->email->message('Your Message');
    //$this->email->attach('/path/to/file1.png'); // attach file
    //$this->email->attach('/path/to/file2.pdf');

    if ($this->email->send())

        echo "Mail Sent!";
    else
        echo "There is error in sending mail!";
}


    public function get_image(){
        $candidateId = 19;
        $this->load->model("candidate");
        $result = $this->candidate->getImage($candidateId);
        $this->output->set_header("Content-type:".$result['content_type']);
        echo $result['pic'];
    }



}

