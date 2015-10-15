<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paquetes extends Main {

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
      $this->load->model('paquetes_model');

        $arrEventos = $this->paquetes_model->get_eventos();

		$crud = new grocery_CRUD();

		$crud->set_theme('flexigrid');
		$crud->set_table('PAQUETES_NOMBRES');
		$crud->set_subject('Paquetes');


        $crud->display_as('PAQ_NOMBRE','Nombre paquete')
	         ->display_as('PAQ_MONTO_PREMIUN','Monto Premium Home')
	         ->display_as('PAQ_MONTO_PREMIUN_CATEGORIA', 'Monto Premium Categorías')
           ->display_as('PAQ_MONTO_BASICO','Monto Básico')
	         ->display_as('PAQ_EVENTO','Evento')
	         ->display_as('PAQ_FECHA','Fecha');

		$crud->fields('PAQ_NOMBRE','PAQ_MONTO_PREMIUN','PAQ_MONTO_PREMIUN_CATEGORIA','PAQ_MONTO_BASICO','PAQ_EVENTO','PAQ_FECHA','PAQ_USER_CREADOR');
        $crud->required_fields('PAQ_NOMBRE','PAQ_MONTO_PREMIUN','PAQ_MONTO_PREMIUN_CATEGORIA','PAQ_MONTO_BASICO','PAQ_EVENTO');
        $crud->columns('PAQ_NOMBRE','PAQ_MONTO_PREMIUN','PAQ_MONTO_PREMIUN_CATEGORIA','PAQ_MONTO_BASICO','PAQ_EVENTO','PAQ_FECHA');
        $crud->unset_read();
        $crud->field_type('PAQ_NOMBRE','String');
        $crud->field_type('PAQ_MONTO_PREMIUN','integer');
        $crud->field_type('PAQ_MONTO_PREMIUN_CATEGORIA','integer');
        $crud->field_type('PAQ_MONTO_BASICO','integer');
        $crud->field_type('PAQ_EVENTO','dropdown', $arrEventos);
        $crud->field_type('PAQ_USER_CREADOR','invisible' );
        $crud->field_type('PAQ_FECHA','datetime');


        $crud->callback_before_insert(array($this,'limpiar_datos'));
        $crud->callback_before_update(array($this,'limpiar_datos'));

		$crud->set_language('spanish');
		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Paquetes';
		$this->data['encabezado']='Paquetes';

		$breadcrums[]='<a class="current" href="'.site_url('main/Paquetes').'">Paquetes</a>';
		$this->salida('example',$this->data, $breadcrums);
	}



/**************** METODOS CALLBACK ****************/

function limpiar_cadena_titulo($texto){
	$texto=strip_tags($texto);
	return $texto;
}

function limpiar_datos($post_array){

    $post_array['PAQ_USER_CREADOR'] = $this->session->userdata('sadmin_user_id');
    // $post_array['TAGS_USER_ULTIMO'] =$this->session->userdata('sadmin_user_id');
    $post_array['PAQ_NOMBRE'] =$this->limpiar_cadena_titulo($post_array['PAQ_NOMBRE']);
    // $post_array['AUTORIZADO'] =$this->session->userdata('sadmin_user_id');

	return $post_array;

}


}