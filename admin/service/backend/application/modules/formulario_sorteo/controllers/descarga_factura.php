<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class descarga_factura extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		
		$this->load->library('grocery_crud');	
		$this->load->helper('url');
		$this->load->helper('download');
		$this->load->helper('get_url_base');
	}

	
	function descargarFactura($value){
		$url = get_url_base();

		$path = $url['base_url_img_facturas'].'multimedia/formulario-sorteo/';
		$archivo = file_get_contents($path.$value);
		force_download($value,$archivo);

	}

		
}