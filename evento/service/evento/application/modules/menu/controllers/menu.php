<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu extends MX_Controller {
    
    public function __construct() {

        parent::__construct();

    }        
    public function load($data='') {
      $this->load->helper('string');
       //$data  = get_url_base();
       $this->load->database();

       $this->load->model('menu/categoria_model');    

       $data['resultCategoriasFija'] = $this->categoria_model->categoriasFija(); 


       $data['resultCategoriasSubMenu'] = $this->categoria_model->categoriasSubMenu(); 

       
       $this->load->view('menu',$data);     
       return;
    } 


}

