<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
//set_include_path(APPPATH . 'third_party/' . PATH_SEPARATOR . get_include_path());
//require_once ('libraries/Google/autoload.php');

class Register_cantroler extends CI_Controller
{


   
    public function index()
    {
                    $this->load->view("bar");
					$this->load->view("login");

                    
                }
    
    }
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */