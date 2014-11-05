<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Breadcrumb extends MX_Controller {
    
    public function __construct() {

        parent::__construct();
        $this->load->model('breadcrumb_model');

    }        
    
    public function index(){

      $breadcrumb = array();

      if($this->uri->segment(2) != ''){

        $breadcrumb[0] = $this->breadcrumb_model->get_categoria($this->uri->segment(2));
        //print_R($breadcrumb[0]);die();

      }
 
      if($this->uri->segment(3) != ''){

        $breadcrumb[1] =  $this->breadcrumb_model->get_tienda($this->uri->segment(3));

      }

      if($this->uri->segment(4) != ''){

        $breadcrumb[2] =  $this->breadcrumb_model->get_marca($this->uri->segment(4));

      }

      if($this->uri->segment(5) != ''){

        $breadcrumb[3] =  $this->breadcrumb_model->get_subcategoria($this->uri->segment(5));

      }

      return $breadcrumb;

    }

    public function get_categoria_name(){
      return $this->breadcrumb_model->get_categoria($this->uri->segment(2));
    }

}

