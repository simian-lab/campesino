<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asignar_paquetes_aliados extends Main {

	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		
		$this->load->library('grocery_crud');	
		$this->load->helper('url');
	}

	// Metodo para carga de albunes
	function index($id=null)
	{

		$this->load->model('Asignar_paquetes_aliados_model');
	    $result = $this->Asignar_paquetes_aliados_model->get_grupo($this->session->userdata('sadmin_user_id'));//grupo del usuario actual
	    $usuarios= $this->Asignar_paquetes_aliados_model->get_user_x_grupo('3');
	    $arrpaquetes= $this->Asignar_paquetes_aliados_model->get_paquetes();

		$this->load->library('grocery_crud');
		$crud = new grocery_CRUD();
		$crud->set_language("spanish"); //Defino el lenguaje
		$crud->set_theme('flexigrid'); // Defino el tema
		$crud->set_table('admin_users'); // Tabla a insertar/editar
		$crud->set_subject('Usuarios'); // Titulo

		$crud->unset_read();
		$crud->unset_add(); 

		 
		 $q ='';
	 	if($result['group_id']==3 or $result['group_id']==1 or $result['group_id']==4  ){ //Habilitar para filtrar solo para siertos grupos de usuario

		 	$i=1;
		 	$total_user=count($usuarios);
		 	foreach($usuarios as $key=>$valor){
		 		if($i<$total_user){
		 			$crud->or_where('id',$valor['user_id']);
		 		}else{
		 			$crud->where('id',$valor['user_id']);
		 		}
		 	 	$i++;
		 	}

		}
	 

		// Defino titulos de los campos 
		$crud->display_as('active','Usuario Activo')
		->display_as('username','Nombre Usuario')
		->display_as('first_name','Nombres')
		->display_as('last_name','Apellido')
		->display_as('email2','Email corporativo')
		->display_as('Paquete','Tipo de paquete')
		->display_as('phone','Teléfono');

		$crud->columns('username','email','first_name','last_name','paquete');
		$crud->fields('username','email','first_name','last_name','paquete');

		$crud->field_type('username', 'readonly');
		$crud->field_type('first_name', 'readonly');
		$crud->field_type('last_name', 'readonly');
		$crud->field_type('email', 'readonly');
		$crud->field_type('paquete', 'dropdown',$arrpaquetes);

		$crud->set_language('spanish');
		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Asignar paquetes a usuario';
		$this->data['encabezado']='Asignar paquetes a usuarios';

		$breadcrums[]='<a class="current" href="'.site_url('main/asignar_paquetes_aliados').'">Asignar paquetes a usuarios</a>'; 
		$this->salida('example',$this->data, $breadcrums);
	}


/**************** METODOS CALLBACK ****************/

}