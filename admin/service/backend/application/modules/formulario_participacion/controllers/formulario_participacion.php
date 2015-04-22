<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class formulario_participacion extends Main {

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

		$this->load->model('control_formulario_participacion_model');


		$crud = new grocery_CRUD();

		$crud->set_theme('flexigrid');
		$crud->set_table('US_USUARIOS_PARTICIPACION');
		$crud->set_subject('Participantes evento');
		

        $crud->display_as('US_EMPRESA','Empresa')
	         ->display_as('US_NOMBRE','Nombre Contacto')
	         ->display_as('US_CARGO','Cargo')
	         ->display_as('US_CIUDAD','Ciudad')
	         ->display_as('US_EMAIL','Email')
	         ->display_as('US_TELEFONO_MOVIL','Celular')
	         ->display_as('US_URL_TIENDA','Tienda')
	         ->display_as('US_TELEFONO_OFICINA','Teléfono oficina')
	         ->display_as('US_COMENTARIOS','Comentarios');

        /*CONTROL*/
        $result = $this->control_formulario_participacion_model->formulario_sorteo($this->session->userdata('sadmin_user_id'));
        //print_r($result);
    	if($result[0]['RESPUESTA']!=0 ){
          	$this->data['output'] =" <h1>No tenes permiso para acceder esta seccion</h1>" ;// $output = $crud->render();
            $breadcrums[]='<a class="current" href="'.site_url('main/formulario_participacion').'">Formulario de participación</a>'; 
          	$this->data['titulo']='Permiso denegado';
          	$this->data['encabezado']='Error';
          	$this->error('example',$this->data,$breadcrums);
          	die();
    	}
        /*CONTROL*/

        $crud->unset_add();
        $crud->unset_edit();
		$crud->fields('US_EMPRESA','US_NOMBRE','US_CARGO','US_EMAIL','US_TELEFONO_MOVIL','US_URL_TIENDA','US_TELEFONO_OFICINA','US_COMENTARIOS');
        $crud->columns('US_EMPRESA', 'US_CIUDAD', 'US_NOMBRE','US_CARGO', 'US_EMAIL','US_TELEFONO_MOVIL','US_URL_TIENDA','US_TELEFONO_OFICINA','US_COMENTARIOS');
		$this->data= array('autor'=>$this->session->userdata('username') . ' ('.$this->session->userdata('email').')' , 'ident'=>$this->session->userdata('sadmin_user_id') );

	 


		$crud->set_language('spanish');
		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Pre Evento';
		$this->data['encabezado']='Pre Evento';

		$breadcrums[]='<a class="current" href="'.site_url('main/formulario_participacion').'">Formulario de participación</a>'; 
		$this->salida('example',$this->data, $breadcrums);
	}


/* ******************************************************************************************************************* */


}