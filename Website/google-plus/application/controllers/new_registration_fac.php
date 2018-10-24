<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class New_Registration_Fac extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');

    }
    public function index()
                 {
                    $this->load->model("faculty");
                    $data['department'] = $this->faculty->getDepartment();
                     $data['msg'] = "";
                    $this->load->view("bar");
                    $this->load->view("new_registration_faculty", $data);

                }



    public function personal_information_save(){

        $this->load->model("faculty");

        $deptId=$this->input->post(Variable::getDEPTID());
        $firstName=$this->input->post(Variable::getFIRSTNAME());
        $firstName= strtoupper($firstName);
        $lastName=$this->input->post(Variable::getLASTNAME());
        $lastName = strtoupper($lastName);
        $email=$this->input->post(Variable::getEMAIL());
        $email = strtolower($email);
       $count= $this->faculty-> checkDublicateEmail($email);
   //     echo($count);

        if($count>0){
            $data['department'] = $this->faculty->getDepartment();
            $data['msg'] = "Duplicate Email";
            $this->load->view("bar");
            $this->load->view("new_registration_faculty", $data);
            return;

     }
       $id= $this->faculty->addFaculty($deptId,$firstName,$lastName ,$email);


        $config['upload_path'] = './uploads/idCards';
        $config['allowed_types'] = 'jpg|png';
        $config['overwrite'] = TRUE;
        $config['detect_mime'] = TRUE;
        $config['file_name'] =($id);
        $this->load->library('upload', $config);
        if ( $this->upload->do_upload(Variable::STUDENT_PICTURE()))
        {
            $gd['image_library'] = 'gd2';
            $gd['source_image']	= './uploads/idCards'.$this->upload->file_name;
            $gd['maintain_ratio'] = TRUE;
            $gd['create_thumb'] = TRUE;
            $gd['thumb_marker'] = '';
            $gd['overwrite'] = TRUE;
            $gd['width']	= 400;
            $gd['height']	= 400;
            $this->load->library('image_lib', $gd);
            $this->image_lib->resize();

        }
        // $this->tab_education($candidate_id);
        $this->load->view("bar");
        $data['msg']= "Register Sucessfully Please Wait For Conformation Email";
        $this->load->view("sucessfulMsg",$data);



    }





    public function get_image(){
        $candidateId = 19;
        $this->load->model("candidate");
        $result = $this->candidate->getImage($candidateId);
        $this->output->set_header("Content-type:".$result['content_type']);
        echo $result['pic'];
    }



}

