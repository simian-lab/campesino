<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eventos extends Main {

	function __construct() {
		parent::__construct();

		$this->load->database();

		$this->load->library('grocery_crud');
		$this->load->helper('url');
	}

	function index() {
		$breadcrums[]='<a class="current" href="'.site_url('main/eventos').'">Eventos</a>';

		$crud = new grocery_CRUD();

		$crud->display_as('EVE_NOMBRE', 'Nombre');
		$crud->display_as('EVE_DESCRIPCION', 'Descripción');

		$crud->required_fields('EVE_NOMBRE', 'EVE_DESCRIPCION');

		$crud->set_subject('evento');

		$crud->set_table('EVE_EVENTOS');

		$this->data['output'] = $output = $crud->render();

		$this->salida('reporte_promociones/reporte_promociones',$this->data, $breadcrums);
	}
}
?>