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
          $this->load->library('memcached_library');
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

            //$result = $this->formulario_lyris_model->verifiy_insert($nombre, $email, $intereses);
            $lista_users = $this->_getListaUsers();
            if(in_array($email, $lista_users)){
                $this->formulario_lyris_model->update($nombre, $email, $intereses);
            }
            else{
                $this->formulario_lyris_model->insert($nombre, $email, $intereses);
            }

        }
        else{
            echo (validation_errors());
        }
        
    }

    function setUserOnlyEmail(){

        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|trim|xss_clean');

        $this->form_validation->set_message('required', '%s obligatorio'); 
        $this->form_validation->set_message('valid_email', 'E-mail inválido'); 
        $this->form_validation->set_error_delimiters('', ''); 

        if($this->form_validation->run() == TRUE){
            $nombre = null;
            $email = $this->input->post('email');
            $intereses = null;

            //$result = $this->formulario_lyris_model->verifiy_insert($nombre, $email, $intereses);
            $lista_users = $this->_getListaUsers();
            if(in_array($email, $lista_users)){
                $this->formulario_lyris_model->update($nombre, $email, $intereses);
            }
            else{
                $this->formulario_lyris_model->insert($nombre, $email, $intereses);
            }

        }
        else{
            echo (validation_errors());
        }
        
    }

    function checkEmailExist(){

        $email = $this->input->post('email');
    	//$this->form_validation->set_rules('email', 'E-mail', 'is_unique[REG_REGISTRADO.REG_EMAIL]');
        $lista_users = $this->_getListaUsers();
        if(in_array($email, $lista_users)){
            $check = FALSE;
        }
        else{
            $check = TRUE;
        }
        
    	if($check == TRUE){
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

    private function _getListaUsers(){
        $key_memcached = 'lista_users';
        $result_memcached = $this->memcached_library->get($key_memcached);
        
        if(!$result_memcached) 
        {       
          $result = $this->formulario_lyris_model->get();
          $emails=array();
          foreach ($result as $value) {
            $emails[]=$value->REG_EMAIL;
          }
          $this->memcached_library->add($key_memcached, $emails,300);
          return $emails;   
        }
        else
        {
            return $result_memcached;  
        }
   


   }
        
}

/* End of file welcome.php */
/* Location: ./application/modules/welcome/controllers/welcome.php */