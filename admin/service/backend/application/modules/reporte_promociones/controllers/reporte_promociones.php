<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reporte_promociones extends Main {

	function __construct() {
		parent::__construct();

		$this->load->database();
		$this->load->library('grocery_crud');
	}

	function index() {
		$this->load->model('reporte_promociones_model');
		$user_id = $this->session->userdata('sadmin_user_id');
		$result = $this->reporte_promociones_model->get_grupo($user_id);
		$group_id = $result['group_id'];

		$breadcrums[]='<a class="current" href="'.site_url('main/reporte_promociones').'">Reportes</a>';

		$crud = new grocery_CRUD();

		if($group_id == 4 || $group_id == 3) {
			$crud->columns('PAT_ID', 'PAT_NOMBRE', 'PAQ_NOMBRE', 'EVE_NOMBRE', 'PAQ_MONTO_PREMIUM', 'PAQ_CREADAS_PREMIUM', 'PAQ_APROBADAS_PREMIUM', 'PAQ_MONTO_PREMIUM_CATEGORIA', 'PAQ_CREADAS_PREMIUM_CATEGORIA', 'PAQ_APROBADAS_PREMIUM_CATEGORIA', 'PAQ_MONTO_GENERAL', 'PAQ_CREADAS_GENERAL', 'PAQ_APROBADAS_GENERAL', 'PAQ_MONTO_TOTAL', 'PAQ_CREADAS_TOTAL', 'PAQ_APROBADAS_TOTAL');
		}
		else {
			$crud->columns('PAQ_NOMBRE', 'EVE_NOMBRE', 'PAQ_MONTO_PREMIUM', 'PAQ_CREADAS_PREMIUM', 'PAQ_APROBADAS_PREMIUM', 'PAQ_MONTO_PREMIUM_CATEGORIA', 'PAQ_CREADAS_PREMIUM_CATEGORIA', 'PAQ_APROBADAS_PREMIUM_CATEGORIA', 'PAQ_MONTO_GENERAL', 'PAQ_CREADAS_GENERAL', 'PAQ_APROBADAS_GENERAL', 'PAQ_MONTO_TOTAL', 'PAQ_CREADAS_TOTAL', 'PAQ_APROBADAS_TOTAL');
			$crud->or_where('PAT_ID', $user_id);
		}

		$crud->display_as('PAT_ID', 'ID Aliado');
		$crud->display_as('PAT_NOMBRE', 'Aliado');
		$crud->display_as('PAQ_NOMBRE', 'Paquete');
		$crud->display_as('EVE_NOMBRE', 'Evento');
		$crud->display_as('PAQ_MONTO_PREMIUM', 'Cantidad Premium Asignadas');
		$crud->display_as('PAQ_CREADAS_PREMIUM', 'Cantidad Premium Creadas');
		$crud->display_as('PAQ_APROBADAS_PREMIUM', 'Cantidas Premium Aprobadas');
		$crud->display_as('PAQ_MONTO_PREMIUM_CATEGORIA', 'Cantidad Premium Categoría Asignadas');
		$crud->display_as('PAQ_CREADAS_PREMIUM_CATEGORIA', 'Cantidad Premium Categoría Creadas');
		$crud->display_as('PAQ_APROBADAS_PREMIUM_CATEGORIA', 'Cantidad Premium Categoría Aprobadas');
		$crud->display_as('PAQ_MONTO_GENERAL', 'Cantidad General Asignadas');
		$crud->display_as('PAQ_CREADAS_GENERAL', 'Cantidad General Creadas');
		$crud->display_as('PAQ_APROBADAS_GENERAL', 'Cantidad General Aprobadas');
		$crud->display_as('PAQ_MONTO_TOTAL', 'Total Promociones Asignadas');
		$crud->display_as('PAQ_CREADAS_TOTAL', 'Total Promociones Creadas');
		$crud->display_as('PAQ_APROBADAS_TOTAL', 'Total Promociones Aprobadas');

		$crud->set_primary_key('AXP_ID');
		$crud->set_table('V_REPORTE_PROMOCIONES_TOTAL');
		$crud->set_theme('datatables');

		$crud->unset_add();
		$crud->unset_delete();
        $crud->unset_edit();
        $crud->unset_read();

		$this->data['output'] = $output = $crud->render();
		$this->data['titulo'] = 'Reporte';
		$this->data['encabezado']='Reporte de promociones';

		$this->salida('reporte_promociones/reporte_promociones',$this->data, $breadcrums);
	}
}
?>