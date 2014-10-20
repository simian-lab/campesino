<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class lista_blanca_dominios extends Main {

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
		$crud = new grocery_CRUD();

		$crud->set_theme('flexigrid');
		$crud->set_table('LBD_LISTA_BLANCA_DOMINIOS');
		$crud->set_subject('dominios válidos');

	    $crud->display_as('LBD_DOMINIO','Dominio');


		$crud->fields('LBD_DOMINIO');
        $crud->required_fields('LBD_DOMINIO');
        $crud->columns('LBD_DOMINIO');
        $crud->unset_read();


	    $crud->callback_before_insert(array($this,'vaciar_lista_blanca')); 
		$crud->callback_before_update(array($this,'vaciar_lista_blanca'));



        $crud->field_type('LBD_DOMINIO','String');
    
        

		$crud->set_language('spanish');
		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Lista de dominios válidos';
		$this->data['encabezado']='Lista de dominios válidos';

		$breadcrums[]='<a class="current" href="'.site_url('main/categorias').'">Lista de dominios válidos</a>'; 
		$this->salida('example',$this->data, $breadcrums);
	}

	function vaciar_lista_blanca($post_array){
	      $this->load->library('memcached_library');
	      $key_memcached='lista_blanca_dominio';
	      $this->memcached_library->delete($key_memcached);


		return true;
	}


   /* --------------------------------------------------------------------------------- */

}