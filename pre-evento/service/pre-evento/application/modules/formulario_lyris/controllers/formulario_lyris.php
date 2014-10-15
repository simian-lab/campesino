<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class formulario_lyris extends CI_Controller {
    
    public function __construct() {
          parent:: __construct();
       	  $this->load->model('formulario_lyris_model');
       	  $this->load->helper('url');
          $this->load->helper('form');
          $this->load->library('form_validation');
     }
    
    function setUser(){

        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|trim|xss_clean');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|trim|xss_clean');
        $this->form_validation->set_rules('intereses', 'Intereses', 'required|trim|xss_clean');

        $this->form_validation->set_message('required', '%s obligatorio'); 
        $this->form_validation->set_message('valid_email', 'E-mail inválido'); 
        $this->form_validation->set_error_delimiters('', ''); 

        if($this->form_validation->run() == TRUE){
            $nombre = $this->input->post('nombre');
            $email = $this->input->post('email');
            $intereses = $this->input->post('intereses');

            $result = $this->formulario_lyris_model->verifiy_insert($nombre, $email, $intereses);

        }
        else{
            echo (validation_errors());
        }
        
    }

    function checkEmailExist(){

    	$this->form_validation->set_rules('email', 'E-mail', 'is_unique[REG_REGISTRADO.REG_EMAIL]');

    	if($this->form_validation->run() == TRUE){
            $response = array(
			        		'success'	=>	true,
			        		'status'	=>	array(
			        							'code'	=>	'100',
			        							'description'	=>	'OK'
			        						)
			        	);

        }
        else{
        	$response = array(
			        		'success'	=>	true,
			        		'status'	=>	array(
			        							'code'	=>	'101',
			        							'description'	=>	'Usuario ya registrado'
			        						)
			        	);
        }

        echo json_encode($response);

    }
        
}

/* End of file welcome.php */
/* Location: ./application/modules/welcome/controllers/welcome.php */