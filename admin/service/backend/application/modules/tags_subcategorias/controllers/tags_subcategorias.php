<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tags_subcategorias extends Main {

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

		$this->load->model('tag_subcategoria_model');

        $categorias = $this->tag_subcategoria_model->get_categorias();

		$crud = new grocery_CRUD();

		$crud->set_theme('flexigrid');
		$crud->set_table('SUB_SUBCATEGORIA');
		$crud->set_subject('Subcategoría');
		
		$this->data= array('autor'=>$this->session->userdata('username') . ' ('.$this->session->userdata('email').')' , 'ident'=>$this->session->userdata('sadmin_user_id') );

        $crud->display_as('SUB_ID','SID')
             ->display_as('SUB_NOMBRE','Nombre')
	         ->display_as('VISIBILITY','Visibilidad');

	    $crud->unset_read();

	    //***************************	Relacion de tablas ***************************	
	     $crud->set_relation_n_n('Categorias', 'SXC_SUBCATEGORIAXCATEGORIA', 'CAT_CATEGORIA', 'SUB_ID', 'CAT_ID', 'CAT_NOMBRE','VISIBILITY' );
		//***************************	Relacion de tablas ***************************	

		$crud->fields('SUB_NOMBRE','VISIBILITY','SUB_SLUG', 'Categorias');
        $crud->required_fields('SUB_NOMBRE','VISIBILITY');
        $crud->columns('SUB_NOMBRE','SUB_SLUG','VISIBILITY');

        $crud->field_type('SUB_NOMBRE','String');
        $crud->field_type('VISIBILITY','true_false');
        $crud->field_type('SUB_SLUG', 'hidden');
   

        $crud->unique_fields('SUB_NOMBRE');

              
        $crud->callback_before_insert(array($this,'limpiar_textos_slug'));
		$crud->callback_before_update(array($this,'limpiar_textos_slug'));

		$crud->set_language('spanish');
		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Subcategoria';
		$this->data['encabezado']='Subcategoria';

		$breadcrums[]='<a class="current" href="'.site_url('main/tags').'">Tags categoria</a>'; 
		$this->salida('example',$this->data, $breadcrums);
	}




	function limpiar_textos_slug($post_array){
  	    $post_array['SUB_SLUG'] = url_title(convert_accented_characters($this->input->post('SUB_NOMBRE')), 'dash', TRUE);
   		return $post_array;
    }

    function get_subcategorias_promociones($cat_id){
		$this->load->model('tag_subcategoria_model');
		$result = $this->tag_subcategoria_model->get_subcategorias_promociones($cat_id);
		return $result;
	}
    


}