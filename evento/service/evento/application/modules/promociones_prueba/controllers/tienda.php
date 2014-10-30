<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class tienda extends MX_Controller {
    
    public function __construct() {
          parent:: __construct();
      //   $this->output->enable_profiler(TRUE);
       
    }

   

    public function load($data){

        $this->load->model('promociones/promocion_model');    

        $data['tiendas'] = $this->promocion_model->get_tiendas();

        return $this->load->view('containerSelectTiendas',$data,true);  

    }

    

  
    	
}

  

/* End of file welcome.php */
/* Location: ./application/modules/welcome/controllers/welcome.php */
