<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class formulario_sorteo extends Main {

	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		
		$this->load->library('grocery_crud');	
		$this->load->helper('url');
		$this->load->helper('download');
	}

	// Metodo para carga de albunes
	function index()
	{

		$this->load->model('control_formulario_sorteo_model');


		$crud = new grocery_CRUD();

		$crud->set_theme('flexigrid');
		$crud->set_table('US_USUARIOS_SORTEO');
		$crud->set_subject('Participantes sorteo');


        $crud->display_as('US_NOMBRE','Nombre')
	         ->display_as('US_EMAIL','Email')
	         ->display_as('US_DIRECCION ','Dirección')
	         ->display_as('US_CELULAR','Celular')
	         ->display_as('US_TIENDA','Tienda')
	         ->display_as('US_FACTURA','Factura')
	         ->display_as('US_FECHA','Fecha');
        
        /*CONTROL*/
        $result = $this->control_formulario_sorteo_model->formulario_sorteo($this->session->userdata('sadmin_user_id'));
        
        if($result[0]['RESPUESTA']!=0 ){
	      	$this->data['output'] =" <h1>No tenes permiso para acceder esta seccion</h1>" ;// $output = $crud->render();
	        $breadcrums[]='<a class="current" href="'.site_url('main/formulario_sorteo').'">Formulario de sorteo</a>'; 
	      	$this->data['titulo']='Permiso denegado';
	      	$this->data['encabezado']='Error';
	      	$this->error('example',$this->data,$breadcrums);
	      	die();		
        }
        /*CONTROL*/

        $crud->unset_add();
        $crud->unset_edit();

        $crud->columns('US_NOMBRE','US_EMAIL','US_DIRECCION','US_CELULAR','US_TIENDA','US_FECHA', 'US_FACTURA');
		$this->data= array('autor'=>$this->session->userdata('username') . ' ('.$this->session->userdata('email').')' , 'ident'=>$this->session->userdata('sadmin_user_id') );

		$crud->callback_field('US_FACTURA',array($this,'field_callback_image'));
		$crud->callback_column('factura', array($this, 'mostrarNombreFactura'));


		$crud->set_language('spanish');
		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Pre Evento';
		$this->data['encabezado']='Pre Evento';

		$breadcrums[]='<a class="current" href="'.site_url('main/formulario_sorteo').'">Formulario de sorteo</a>'; 
		$this->salida('example',$this->data, $breadcrums);
	}


/* ******************************************************************************************************************* */


function field_callback_image($value,$primary_key){

	return '<a href="'.site_url('main/formulario_sorteo/read/'.$primary_key.'/descargarFactura/'.$value).'" id="descargaFactura" />Descargar factura</a>';


}

function descargarFactura($value){
	die();
	$path = '../../../../../multimedia/formulario-sorteo/';
	$archivo = file_get_contents($path.$value);
	force_download($value,$archivo);

}



}