<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Prueba_smart extends Default_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('template/prueba_smart');
    }


}