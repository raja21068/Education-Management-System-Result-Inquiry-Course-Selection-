<?php


class generate extends CI_Controller
{
    public function index(){
        $this->load->model("course_pass");
        $this->load->library("random_generator");
		$this->load->library('encrypt');
        $this->load->library("my_cryptor");

        //vikeshkumar12345
        //R@j@
       // $c_user = My_Cryptor::myEncryption("vikeshkumar12345");
       // $c_pass= My_Cryptor::myEncryption("R@j@");
        //$this->online_slip_issuer->addSlipIssuer($c_user,$c_pass);

	//	$schemeId= $this->course_pass->getDistinctSchemeId();
		$schemeId= $this->course_pass->getDistinctDeptId();
			foreach( $schemeId as $sId ) {
			$scheme_id = $sId['DEPT_ID'];
		
		$a=0;
		$this->load->library('encrypt');
        $this->load->library("my_cryptor");
        
		   $dec_password= $this->random_generator->generateRandomPassword(7);
            $dec_username = $this->random_generator->generateRandomUsername(6);
            $enc_username = My_Cryptor::myEncryption($dec_username);
            $enc_password = My_Cryptor::myEncryption($dec_password);
				echo($scheme_id."  "."USER: ".$dec_username."  PASS: ".$dec_password."</BR>"  );
		
	//		$this->course_pass->insertUserPass($dec_username,$dec_password,$enc_username,$enc_password,$scheme_id);
			

		while($a==0){
            $dec_password= $this->random_generator->generateRandomPassword(7);
            $dec_username = $this->random_generator->generateRandomUsername(6);
            $enc_username = My_Cryptor::myEncryption($dec_username);
            $enc_password = My_Cryptor::myEncryption($dec_password);
			
				
				$result= $this->course_pass->checkDublicatePass($dec_username,$dec_password);
				if( $result>0 ){
				$a=0;	
				continue;
				}
				$a=1;
		//		echo($dec_password);
			    $this->course_pass->insertUserPass($dec_username,$dec_password,$enc_username,$enc_password,$scheme_id);
				
            }

        }

    }

}