<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tags extends Main {

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

		$this->load->model('tag_model');

		$crud = new grocery_CRUD();

		$crud->set_theme('flexigrid');
		$crud->set_table('TAGS_NOMBRES');
		$crud->set_subject('Tags');
		

        $crud->display_as('TAGS_ID','TID')
	         ->display_as('TAGS_NOMBRE','Nombre')
	         ->display_as('TAGS_FECHA','Fecha')
	         ->display_as('VISIBILITY','Visibilidad');

		$crud->fields('TAGS_NOMBRE','TAGS_FECHA','VISIBILITY','TAGS_USER_CREADOR','TAGS_USER_ULTIMO','AUTORIZADO');
        $crud->required_fields('TAGS_NOMBRE','TAGS_FECHA','VISIBILITY');
        $crud->columns('TAGS_NOMBRE','TAGS_FECHA','VISIBILITY');
        $crud->unset_read();
        /*CONTROL*/
        $result = $this->tag_model->control_tag($this->session->userdata('sadmin_user_id'));
        // print_r($result);
    	if($result[0]['RESPUESTA']!=0 ){
          	$this->data['output'] =" <h1>No tenes permiso para acceder esta seccion</h1>" ;// $output = $crud->render();
            $breadcrums[]='<a class="current" href="'.site_url('main/tags').'">Tags</a>'; 
          	$this->data['titulo']='Permiso denegado';
          	$this->data['encabezado']='Error';
          	$this->error('example',$this->data,$breadcrums);
          	die();
        }
        /*CONTROL*/

        $crud->field_type('TAGS_NOMBRE','String');
        $crud->field_type('TAGS_ID','invisible');
        $crud->field_type('VISIBILITY','true_false');
        $crud->field_type('TAGS_USER_CREADOR','invisible');
        $crud->field_type('TAGS_USER_ULTIMO','invisible');
        $crud->field_type('AUTORIZADO','invisible');

        $crud->callback_before_insert(array($this,'limpiar_datos'));
        $crud->callback_before_update(array($this,'limpiar_datos'));

		$crud->set_language('spanish');
		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Tags';
		$this->data['encabezado']='Tags';

		$breadcrums[]='<a class="current" href="'.site_url('main/tags').'">Tags</a>'; 
		$this->salida('example',$this->data, $breadcrums);
	}



	function limpiar_datos($post_array){

	       	    $post_array['TAGS_USER_CREADOR'] = $this->session->userdata('sadmin_user_id');
	       	    $post_array['TAGS_USER_ULTIMO'] =$this->session->userdata('sadmin_user_id');
	       	    $post_array['AUTORIZADO'] =$this->session->userdata('sadmin_user_id');

	        	return $post_array;

	}


	

}