<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asignar_tiendas extends Main {

	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		
		$this->load->library('grocery_crud');	
		$this->load->helper('url');
		$this->load->helper('text');
	}

	// Metodo para carga de albunes
	function index($id=null)
	{

		$this->load->model('asignar_tiendas_model');
	    $result = $this->asignar_tiendas_model->get_grupo($this->session->userdata('sadmin_user_id'));//grupo del usuario actual
	    $usuarios= $this->asignar_tiendas_model->get_user_x_grupo('3');
	    $arrUsuarios = $this->asignar_tiendas_model->get_user_aliados();

		$this->load->library('grocery_crud');
		$crud = new grocery_CRUD();
		$crud->set_language("spanish"); //Defino el lenguaje
		$crud->set_theme('flexigrid'); // Defino el tema
		$crud->set_table('TIE_TIENDAS'); // Tabla a insertar/editar
		$crud->set_subject('Tiendas'); // Titulo

		$crud->unset_read();

		$crud->display_as('TIE_NOMBRE','Nombre tienda')
			 ->display_as('VISIBILITY','Visibilidad')
			 ->display_as('TIE_SLUG','Slug tienda')
			 ->display_as('TIE_ID_USER','Usuario')
			 ->display_as('TIE_FECHA_ALTA', 'Fecha')
			 ->display_as('TIE_LOGO_VISA', 'Logo Visa')
			 ->display_as('TIE_TEXTO_VISA', 'Texto Logo Visa');

		$crud->columns('TIE_NOMBRE','TIE_ID_USER','VISIBILITY','TIE_FECHA_ALTA');
		$crud->fields('TIE_NOMBRE','TIE_ID_USER','VISIBILITY','TIE_FECHA_ALTA','TIE_SLUG','TIE_LOGO_VISA','TIE_TEXTO_VISA');

			

		$crud->set_rules('TIE_NOMBRE','Nombre tienda','max_length[25]');
		$crud->field_type('TIE_NOMBRE', 'String');
		$crud->field_type('TIE_ID_USER', 'dropdown',$arrUsuarios);
		$crud->field_type('VISIBILITY', 'true_false');
		$crud->field_type('TIE_SLUG', 'invisible');
		$crud->field_type('TIE_LOGO_VISA', 'true_false');
		$crud->field_type('TIE_TEXTO_VISA', 'String');

		$crud->callback_before_insert(array($this,'generar_slug')); //  antes de insertar
		$crud->callback_before_update(array($this,'generar_slug'));

		$crud->set_language('spanish');
		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Asignar tienda a usuarios';
		$this->data['encabezado']='Asignar tienda a usuarios';

		$breadcrums[]='<a class="current" href="'.site_url('main/asignar_paquetes_aliados').'">Asignar paquetes a usuarios</a>'; 
		$this->salida('example',$this->data, $breadcrums);
	}


/**************** METODOS CALLBACK ****************/


	public function generar_slug($post_array){
	    $post_array['TIE_SLUG'] = url_title(convert_accented_characters($post_array['TIE_NOMBRE']), 'dash', TRUE);
	    //$post_array['TIE_LOGO_VISA'] = 1;
		return $post_array;
	}

	


}