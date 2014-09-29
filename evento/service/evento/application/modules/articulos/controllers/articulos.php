<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Articulos extends CI_Controller {
    
    public function __construct() {
          parent:: __construct();
       	  $this->load->model('articulos_model');
          $this->load->library("pagination");
          $this->load->helper('fechas-articulos');
     }
    
    public function index() { 
        $data = null;
        $data = get_url_base();
        
        $data['title'] = 'El Tiempo - Cybermonday';
        $data['categorias'] = $this->articulos_model->get_categorias();
        $data['tiendas'] = $this->articulos_model->get_tiendas();
        $data['marcas'] = $this->articulos_model->get_marcas();

        $this->paginacionArticulos();
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $page = ($page == 0) ? 0 : ($page*8)-8;
        $data['articulos'] = $this->articulos_model->get_articulos(NULL,$page);
        $data['paginador_articulos'] = $this->pagination->create_links(); 
        $data['marcas_participantes'] = $this->articulos_model->get_patrocinadores();
        
        /*$data['s_pageName']='cyberlunes: evento: home'; // Slider de la home de articulos
        $data['s_channel']= 'cyberlunes: evento: home  ';
        $data['s_prop1']= '';
        $data['s_prop2']= '';*/

        $this->load->view('template/header', $data);
        $this->load->view('template/nav', $data);
        $this->load->view('articulos', $data);
        $this->load->view('template/footer', $data);
        $this->load->view('template/scripts', $data);

    }

    public function paginacionArticulos(){
      $data = null;
      $data = get_url_base();

      $config = array();
      $config['base_url'] = base_url().'contenidos';
      $arrayCantArt = $this->articulos_model->get_count_articulos();
      $config['total_rows'] = $arrayCantArt[0]->TOTAL;
      $config['per_page'] =  8;
      $config['num_links'] = 5;
      $config['uri_segment'] = 2;
      $config['use_page_numbers'] = TRUE;
      $config['enable_query_strings'] = TRUE;

      $config['next_link'] = '<img src="'.$data['base_url_static'].'img/arrow-right.png" alt="">';
      $config['next_tag_open'] = '<div class="pag-arrow-right">';
      $config['next_tag_close'] = '</div>';
      $config['prev_link'] = '<img src="'.$data['base_url_static'].'img/arrow-left.png" alt="">';
      $config['prev_tag_open'] = '<div class="pag-arrow-left">';
      $config['prev_tag_close'] = '</div>';
      $config['cur_tag_open'] = '<li><a href="#" class="activa">';
      $config['cur_tag_close'] = '</a></li>';
      $config['num_tag_open'] = '<li>';
      $config['num_tag_close'] = '</li>';
      $config['first_link'] = FALSE;
      $config['last_link'] = FALSE;

      $this->pagination->initialize($config); 

    }
        
}

/* End of file welcome.php */
/* Location: ./application/modules/welcome/controllers/welcome.php */