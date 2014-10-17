<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tags_categorias extends Main {

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
		$crud->set_table('CAT_CATEGORIA');
		$crud->set_subject('Categoría');
		
		$this->data= array('autor'=>$this->session->userdata('username') . ' ('.$this->session->userdata('email').')' , 'ident'=>$this->session->userdata('sadmin_user_id') );

        $crud->display_as('CAT_ID','TID')
             ->display_as('CAT_NOMBRE','Nombre')
	         ->display_as('CAT_DESC','Descripcion')
	         ->display_as('VISIBILITY','Visibilidad')
	         ->display_as('Subcategorias', 'Subcategorías');

	    

	    $crud->unset_read();

	    //***************************	Relacion de tablas ***************************	
	     $crud->set_relation_n_n('Subcategorias', 'SXC_SUBCATEGORIAXCATEGORIA', 'SUB_SUBCATEGORIA', 'CAT_ID', 'SUB_ID', 'SUB_NOMBRE', 'VISIBILITY');
		//***************************	Relacion de tablas ***************************	

		$crud->fields('CAT_NOMBRE','CAT_DESC','VISIBILITY','CAT_SLUG', 'Subcategorias');
        $crud->required_fields('CAT_NOMBRE','CAT_DESC','VISIBILITY');
        $crud->columns('CAT_NOMBRE','CAT_DESC','VISIBILITY');

        $crud->field_type('CAT_NOMBRE','String');
        $crud->field_type('CAT_DESC','string');
        $crud->field_type('VISIBILITY','true_false');
        $crud->field_type('CAT_SLUG', 'hidden');

        $crud->unique_fields('CAT_NOMBRE');

              
        $crud->callback_before_insert(array($this,'limpiar_textos_slug'));
		$crud->callback_before_update(array($this,'limpiar_textos_slug'));

		$crud->set_language('spanish');
		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Categoria';
		$this->data['encabezado']='Categoria';

		$breadcrums[]='<a class="current" href="'.site_url('main/tags').'">Tags categoria</a>'; 
		$this->salida('example',$this->data, $breadcrums);
	}




	function limpiar_textos_slug($post_array){
  	    $post_array['CAT_SLUG'] = url_title(convert_accented_characters($this->input->post('CAT_NOMBRE')), 'dash', TRUE);
  	    //print_r($post_array['CAT_SLUG']);die();
   		return $post_array;
    }
    


}