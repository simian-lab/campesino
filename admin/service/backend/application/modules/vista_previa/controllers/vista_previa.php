<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vista_previa extends MX_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->database();

		$this->load->library('grocery_crud');
		$this->load->helper('url');
		$this->load->helper('text');
		$this->load->helper('get_url_base');
		$this->load->model('vista_previa_model');
	}

	function vista_previa_promociones(){

		$data['id_user'] = filter_var($this->input->post('id'),FILTER_VALIDATE_INT);
		$data['nombre_promocion'] = filter_var($this->input->post('nombre'),FILTER_SANITIZE_SPECIAL_CHARS);
		$data['descripcion_promocion'] = filter_var($this->input->post('descripcion'),FILTER_SANITIZE_SPECIAL_CHARS);
		$data['precio_inicial_promocion'] = filter_var($this->input->post('precio_inicial'),FILTER_SANITIZE_SPECIAL_CHARS);
		$data['precio_final_promocion'] = filter_var($this->input->post('precio_final'),FILTER_SANITIZE_SPECIAL_CHARS);
		$data['descuento_promocion'] = filter_var($this->input->post('descuento'),FILTER_SANITIZE_SPECIAL_CHARS);
		$data['url_promocion'] = filter_var($this->input->post('url'),FILTER_VALIDATE_URL);
		//var_dump();die();
		$data['imagen_premium_promocion'] = filter_var($this->input->post('imagen_premium'),FILTER_SANITIZE_SPECIAL_CHARS);
		$data['imagen_general_promocion'] = filter_var($this->input->post('imagen_general'),FILTER_SANITIZE_SPECIAL_CHARS);
		$data['seccion'] = $this->input->post('seccion');
		$data['tipo_moneda_promocion'] = filter_var($this->input->post('tipo_moneda'),FILTER_SANITIZE_SPECIAL_CHARS);
    $data['eventos'] = $this->input->post('eventos');
//print_r($this->input->post('url',true));die();

		$result = $this->vista_previa_model->get_tienda_by_id($data['id_user']);

		$data['logo_visa'] = $result['TIE_LOGO_VISA'];
		$data['nombre_tienda'] = $result['TIE_NOMBRE'];
		$data['texto_visa'] = $result['TIE_TEXTO_VISA'];
		//print_r($data);die();

		$url = get_url_base();
		$data['url_static'] = $url['base_url_static_evento'];
		$this->load->view('vista_previa_promociones',$data);

	}

}