<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marcas extends Main {

	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		
		$this->load->library('grocery_crud');	
		$this->load->helper('url');
		$this->load->helper('text');
	}

	// Metodo para carga de albunes
	function index()
	{

		$this->load->model('marcas_model');

		$crud = new grocery_CRUD();

		$crud->set_theme('flexigrid');
		$crud->set_table('MAR_MARCAS');
		$crud->set_subject('Marcas');

        $crud->display_as('MAR_ID','MID')
	         ->display_as('MAR_NOMBRE','Nombre')
	         ->display_as('MAR_FECHA_ALTA','Fecha')
	         ->display_as('VISIBILITY','Visibilidad')
	         ->display_as('MAR_SLUG','slug');

		$crud->fields('MAR_NOMBRE','MAR_FECHA_ALTA','VISIBILITY','MAR_SLUG');
        $crud->required_fields('MAR_NOMBRE','MAR_FECHA_ALTA','VISIBILITY');
        $crud->columns('MAR_NOMBRE','MAR_FECHA_ALTA','VISIBILITY');
        $crud->unset_read();
                    

        $crud->field_type('MAR_NOMBRE','String');
        $crud->field_type('MAR_ID','invisible');
        $crud->field_type('MAR_SLUG','invisible');
        $crud->field_type('VISIBILITY','true_false');

        $crud->callback_before_insert(array($this,'limpiar_datos'));
        $crud->callback_before_update(array($this,'limpiar_datos'));

		$crud->set_language('spanish');
		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Marcas';
		$this->data['encabezado']='Marcas';

		$breadcrums[]='<a class="current" href="'.site_url('main/tags').'">Tags</a>'; 
		$this->salida('example',$this->data, $breadcrums);
	}



	function limpiar_datos($post_array){

   	    $post_array['TAGS_USER_CREADOR'] = $this->session->userdata('sadmin_user_id');
   	    $post_array['TAGS_USER_ULTIMO'] =$this->session->userdata('sadmin_user_id');
   	    $post_array['AUTORIZADO'] =$this->session->userdata('sadmin_user_id');

   	    $post_array['MAR_SLUG'] = url_title(convert_accented_characters($post_array['MAR_NOMBRE']), 'dash', TRUE);

    	return $post_array;

	}


	


}