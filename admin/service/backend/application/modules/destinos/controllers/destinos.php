<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Destinos extends Main {

	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		
		$this->load->library('grocery_crud');	
		$this->load->helper('url');
	}

	// Metodo para carga de albunes
	function index()
	{

		$this->load->model('destinos_model');

		$crud = new grocery_CRUD();

		$crud->set_theme('flexigrid');
		$crud->set_table('SUB_SUBCATEGORIA');
		$crud->set_subject('Destinos');
		
		$this->data= array('autor'=>$this->session->userdata('username') . ' ('.$this->session->userdata('email').')' , 'ident'=>$this->session->userdata('sadmin_user_id') );

        $crud->display_as('SUB_NOMBRE','Nombre')
             ->display_as('VISIBILITY','Visibilidad');

		$crud->fields('SUB_NOMBRE','VISIBILITY','SUB_SLUG');
        $crud->required_fields('SUB_NOMBRE','VISIBILITY');
        $crud->columns('SUB_NOMBRE','VISIBILITY');

		$crud->unset_read();

        $crud->field_type('SUB_NOMBRE','String');
        $crud->field_type('VISIBILITY','true_false');

        $crud->field_type('SUB_SLUG', 'invisible');
        $crud->unique_fields('SUB_NOMBRE');
                 
 
 /*CONTROL*/
 $result = $this->destinos_model->control_destinos($this->session->userdata('sadmin_user_id'));
 // print_r($result);
 	if($result[0]['RESPUESTA']!=0 ){
 	          	$this->data['output'] =" <h1>No tenes permiso para acceder esta seccion</h1>" ;// $output = $crud->render();
 	            $breadcrums[]='<a class="current" href="'.site_url('main/promociones').'">Promociones</a>'; 
 	          	$this->data['titulo']='Permiso denegado';
 	          	$this->data['encabezado']='Error';
 	          	$this->error('example',$this->data,$breadcrums);
 	          	die();
 	          }
 /*CONTROL*/

  	$crud->callback_before_insert(array($this,'limpiar_datos'));
  	$crud->callback_before_update(array($this,'limpiar_datos'));

		$crud->set_language('spanish');
		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Destinos';
		$this->data['encabezado']='Destinos';

		$breadcrums[]='<a class="current" href="'.site_url('main/destinos').'">Destinos</a>'; 
		$this->salida('example',$this->data, $breadcrums);
	}

	// function limpiar_textos_slug($post_array){
 //  	    $post_array['SUB_SLUG'] = url_title($this->input->post('SUB_NOMBRE'), 'dash', TRUE);
 //   		return $post_array;
 //    }

   function limpiar_datos($post_array){

          	    $post_array['SUB_SLUG'] = url_title($this->input->post('SUB_NOMBRE'), 'dash', TRUE);
           		return $post_array;
   } 


}