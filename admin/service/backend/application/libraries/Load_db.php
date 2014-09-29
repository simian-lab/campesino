<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Load_db  extends MX_Controller{

    function __construct() {

		$this->load->library('session');

		if($this->session->flashdata('pais_db'))
			$pais = $this->session->flashdata('pais_db');
		else
			$pais = 'ch';
		
        $this->load->database($pais);
    }

}

/* End of file Tank_auth.php */
/* Location: ./application/libraries/Tank_auth.php */