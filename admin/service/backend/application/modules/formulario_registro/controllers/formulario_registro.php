<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class formulario_registro extends Main {

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

		$this->load->model('formulario_registro_model');


		$crud = new grocery_CRUD();

		$crud->set_theme('flexigrid');
		$crud->set_table('REG_REGISTRADO');
		$crud->set_subject('Usuarios registrados');
		//$crud->where('PAU_EVENTO',0); //$this->session->userdata('sadmin_user_id');

        $crud->display_as('REG_NOMBRE','Nombre')
        ->display_as('REG_EMAIL','Email')
        ->display_as('REG_INTERESES','Intereses');

        /*CONTROL*/
        $result = $this->formulario_registro_model->formulario_sorteo($this->session->userdata('sadmin_user_id'));
        //print_r($result);
        	if($result[0]['RESPUESTA']!=0 ){
        	          	$this->data['output'] =" <h1>No tenes permiso para acceder esta seccion</h1>" ;// $output = $crud->render();
        	            $breadcrums[]='<a class="current" href="'.site_url('main/formulario_registro').'">Usuarios registrados</a>'; 
        	          	$this->data['titulo']='Permiso denegado';
        	          	$this->data['encabezado']='Error';
        	          	$this->error('example',$this->data,$breadcrums);
        	          	die();
        	          }
        /*CONTROL*/


        $crud->unset_add();
        $crud->unset_edit();
		$crud->fields('REG_NOMBRE','REG_EMAIL','REG_INTERESES');
        //$crud->required_fields('PAU_NOMBRE','PAU_IMAGEN','VISIBILITY','PAU_FECHA','PAU_DESCRIPCION');
        $crud->columns('REG_NOMBRE','REG_EMAIL','REG_INTERESES');
		$this->data= array('autor'=>$this->session->userdata('username') . ' ('.$this->session->userdata('email').')' , 'ident'=>$this->session->userdata('sadmin_user_id') );




		$crud->set_language('spanish');
		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Usuarios registrados';
		$this->data['encabezado']='Usuarios registrados';

		$breadcrums[]='<a class="current" href="'.site_url('main/formulario_registro').'">Usuarios registrados</a>'; 
		$this->salida('example',$this->data, $breadcrums);
	}


/* ******************************************************************************************************************* */



}