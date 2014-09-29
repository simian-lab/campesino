<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class subCategoria extends MX_Controller {
    
    public function __construct() {
          parent:: __construct();
      //   $this->output->enable_profiler(TRUE);
       
    }


    public function load($data,$slugCat){

      

      if($slugCat!='todos'){
          $this->load->model('promociones/promocion_model');    

          $data['subCategorias'] = $this->promocion_model->get_subcategorias($slugCat);

           if(!$data['subCategorias'])
           {
              return; 
           }else{
              return $this->load->view('containerSelectSubCategorias',$data,true);    
           }
          
      }else{
        return;
      }


	      

    }

  
    	
}

  

/* End of file welcome.php */
/* Location: ./application/modules/welcome/controllers/welcome.php */
