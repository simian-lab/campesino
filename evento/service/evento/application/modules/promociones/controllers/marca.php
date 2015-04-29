<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class marca extends MX_Controller {

    public function __construct() {
          parent:: __construct();
      //   $this->output->enable_profiler(TRUE);

    }


    public function load($data){

	      $this->load->model('promociones/promocion_model');

        if(!isset($data['tienda'])) {
          $data['tienda'] = 'tiendas';
        }
        
	      $data['marcas'] = $this->promocion_model->get_marcas_by_tienda($data['tienda']);

	      return $this->load->view('containerSelectMarcas',$data,true);

    }

    public function marcasOptions($data){

      $this->load->model('promociones/promocion_model');

      $data['marcas'] = $this->promocion_model->get_marcas_by_tienda($data['tienda']);

      return $this->load->view('containerSelectMarcasDeTienda',$data,true);

    }



}



/* End of file welcome.php */
/* Location: ./application/modules/welcome/controllers/welcome.php */
