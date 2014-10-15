<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class get_subcategorias_promociones extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		
		$this->load->library('grocery_crud');	
		$this->load->helper('url');
		$this->load->helper('text');
	}

	
    function index($cat_id){
		$this->load->model('tag_subcategoria_model');
		$result = $this->tag_subcategoria_model->get_subcategorias_promociones($cat_id);
		return $result;
	}
    


}