<?php

class Robapagina extends CI_Controller 
{	

	function index(){
		$this->load->helper('url');
		$data = get_url_base();
		$this->load->view('template/sac');
//		$this->load->view('template/script_form', $data);
//		$this->load->view('template/terminos_condiciones', $data);
	}

}