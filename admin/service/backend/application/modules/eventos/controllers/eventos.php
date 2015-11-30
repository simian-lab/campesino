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
		$crud->display_as('EVE_PREFIJO', 'Prefijo');
		$crud->display_as('EVE_TAG_LINE', 'SEO H1: Taga Line ');
		$crud->display_as('EVE_TITLE', 'SEO: Title');
		$crud->display_as('EVE_META_DESCRIPTION', 'SEO: Meta Descriptio');
		$crud->display_as('EVE_FACEBOOK', 'Tag Line de Facebook');
		$crud->display_as('EVE_TWITTER', 'Tag Line de Twitter');
		$crud->display_as('EVE_LEGAL', 'Texto Legal');


		$crud->required_fields('EVE_NOMBRE', 'EVE_DESCRIPCION', 'EVE_PREFIJO');

		$crud->set_subject('evento');

		$crud->set_table('EVE_EVENTOS');

		$this->data['output'] = $output = $crud->render();

		$this->salida('reporte_promociones/reporte_promociones',$this->data, $breadcrums);
	}
}
?>