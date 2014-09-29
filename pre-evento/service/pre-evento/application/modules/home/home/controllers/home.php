<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct() {
          parent:: __construct();
       	  $this->load->model('home_model');
       	  $this->load->library("pagination");
       	  $this->load->helper('url');
       	  $this->load->helper('text');
          $this->load->library('session');
          $this->load->helper('cookie');
          $this->load->helper('fechas-articulos');
          $this->load->library('user_agent');
     }
    
    public function index($paramOrigen='') { 

       $origen=$this->session->userdata('origen');
       if($origen=='registro_success'){
                redirect('/gracias');
                exit();
       }

        $data = null;
        $data = get_url_base();
        
        $meta_title = 'Cyberlunes';
        $meta_descripcion = 'Si les gustan las ofertas como a mí no se pueden perder CyberLunes este 19 de mayo. Entérense de las tiendas que van a participar aquí: http://www.cyberlunes.com.co';
        $meta_keys = "Compare,Mejores Ofertas Turísticas,vive viajar";
        $meta_imagen = $data['base_url_static']."img/logo200x200.jpg";
        $meta_url = base_url();

        $data['meta_title'] = $meta_title;
        $data['meta_descripcion'] = $meta_descripcion;
        $data['image_src'] = $meta_imagen;
        $data['meta_url'] = $meta_url;
        $data = array_merge($data, add_meta_tags($meta_title, $meta_descripcion, $meta_imagen, $meta_keys, $meta_url));

        $data['slider_pautas'] = $this->home_model->get_pautas();
        $data['slider_patrocinadores'] = $this->home_model->get_patrocinadores();

        $this->paginacionArticulos();
        $page = ($this->uri->segment(1)) ? $this->uri->segment(1) : 0;
        $page = ($page == 0) ? 0 : ($page*6)-6;
        $data['articulos'] = $this->home_model->get_articulos(NULL,$page);
		    $data['paginador_articulos'] = $this->pagination->create_links(); 



        $data['s_pageName']='cyberlunes: pre-evento: home'; // Slider de la home de articulos
        $data['s_channel']= 'cyberlunes: pre-evento: home  ';
        $data['s_prop1']= '';
        $data['s_prop2']= '';
        $data['sitio_seccion'] = '58465/438587'; 

        if($this->agent->is_mobile()){
          $data['is_mobile'] = 1;
        }
        else{
          $data['is_mobile'] = 0;
        }

        if($this->session->userdata('formularios') == 'hidden'){
          $data['hide_form'] = 1;
        }

        $this->load->view('template/header', $data);
        $this->load->view('home', $data);

        if($paramOrigen=='gracias'){
                $this->load->view('template/gracias');
        }     

        $this->load->view('template/terminos_condiciones');
        $this->load->view('template/footer_share', $data);
        $this->load->view('template/script_form');

    }


    public function detalle($art_slug=''){
       $origen=$this->session->userdata('origen');

       if($origen=='registro_success'){
                redirect('/gracias');
                exit();
       }

       if(empty($art_slug)){
           show_404('error_404');
           return;

       }

      $data = null;
      $data = get_url_base();

      $data['title'] = 'Cyberlunes';

      $data['articulo'] = $this->home_model->get_articulos($art_slug, $page = 0);

      if(empty($data['articulo'])){
        show_404('error_404');
      }

      $data['articulos_recomendados'] = $this->home_model->get_articulos_recomendados();

      $meta_title = $data['articulo'][0]->ART_TITULO;
      $meta_descripcion = $data['articulo'][0]->ART_DESCRIPCION;
      $meta_keys = "Compare,Mejores Ofertas Turísticas,vive viajar";
      $meta_imagen = $data['base_url_img_articulos'].$data['articulo'][0]->ART_IMAGEN;
      $meta_url = current_url();

      $data['meta_title'] = $meta_title;
      $data['meta_descripcion'] = $meta_descripcion;
      $data['image_src'] = $meta_imagen;
      $data['meta_url'] = $meta_url;
      $data = array_merge($data, add_meta_tags($meta_title, $meta_descripcion, $meta_imagen, $meta_keys, $meta_url));
      
      $data['s_pageName']='cyberlunes: pre-evento: detalle: '.$art_slug; 
      $data['s_channel']= 'cyberlunes: pre-evento: detalle';
      $data['s_prop1']= 'cyberlunes: pre-evento: detalle: '.$art_slug;
      $data['s_prop2']= '';
      
      if(empty($data['articulo'])){
        show_404('error_404');
      }
      $image_size = getimagesize($data['base_url_img_articulos'].$data['articulo'][0]->ART_IMAGEN);
      if($image_size[0] > $image_size[1]){
        $data['sitio_seccion'] = '58465/438588'; 
      }
      else{
        $data['sitio_seccion'] = '58465/438589'; 
      }

      if($this->agent->is_mobile()){
        $data['is_mobile'] = 1;
      }
      else{
        $data['is_mobile'] = 0;
      }

      if($this->session->userdata('formularios') == 'hidden'){
        $data['hide_form'] = 1;
      }

      //$data['id_form_mobile'] = 'id-form-detalle-mobile';
      //$data['class_form_mobile'] = 'box-form';
      //$data['id_form_mobile'] = 'form-collapse';
      //$data['class_form_mobile'] = 'box-form mobile vistaFormulario';

      $this->load->view('template/header', $data);
      if($this->agent->is_mobile()){
        $this->load->view('template/form_mobile', $data);
      }
      $this->load->view('detalle', $data);
    

/*
      $origen=$this->session->userdata('origen');
      if($origen=='registro_success'){
              $array_items = array('origen' => '');
              $this->session->unset_userdata($array_items);
              $data['registro_success'] = TRUE;
              $this->load->view('template/gracias');
      }else{
              $data['registro_success'] = FALSE ;
      }*/

      $this->load->view('template/terminos_condiciones');
      if(!$this->agent->is_mobile() && !$this->session->userdata('formularios')){
        $this->load->view('template/form_popup');
      }
      $this->load->view('template/footer_share', $data);
      $this->load->view('template/script_form');

    }


    public function paginacionArticulos(){
      $data = null;
      $data = get_url_base();

  		$config = array();
  		$config['base_url'] = base_url();
  		$arrayCantArt = $this->home_model->get_count_articulos();
  		$config['total_rows'] = $arrayCantArt[0]->TOTAL;
  		$config['per_page'] =  6;
  		$config['num_links'] = 5;
  		$config['uri_segment'] = 1;
      $config['use_page_numbers'] = TRUE;
      $config['enable_query_strings'] = TRUE;

  		$config['next_link'] = '<img src="'.$data['base_url_static'].'img/arrow-right.png" alt="">';
  		$config['next_tag_open'] = '<div class="pag-arrow-right" style="vertical-align:middle">';
  		$config['next_tag_close'] = '</div>';
  		$config['prev_link'] = '<img src="'.$data['base_url_static'].'img/arrow-left.png" alt="">';
  		$config['prev_tag_open'] = '<div class="pag-arrow-left" style="vertical-align:middle">';
  		$config['prev_tag_close'] = '</div>';
  		$config['cur_tag_open'] = '<li><a href="#" class="activa">';
  		$config['cur_tag_close'] = '</a></li>';
  		$config['num_tag_open'] = '<li>';
  		$config['num_tag_close'] = '</li>';
  		$config['first_link'] = FALSE;
  		$config['last_link'] = FALSE;

  		$this->pagination->initialize($config); 

	}


  public function setCookie(){

    $cookie = array(
        'name'   => 'suscripcion',
        'value' => 'suscripcion',
        'expire' => '86500'
    );

    $this->input->set_cookie($cookie);
    $salida['code'] = '0'; 
    $json= json_encode($salida);


        $this->output
         ->set_content_type('application/json')
         ->set_output($json);

        return;
  }

  public function setOrigen(){

    $newdata = array(
                    'origen' => 'registro_success',
                    'formularios' => 'hidden'
                    );

    $this->session->set_userdata($newdata);

    $salida['code'] = '0'; 
    $json= json_encode($salida);


        $this->output
         ->set_content_type('application/json')
         ->set_output($json);

        return;
  }

  public function gracias(){
      $array_items = array('origen' => '');
      $this->session->unset_userdata($array_items);
      $this->index('gracias');
  }

  public function prueba(){
    $this->load->view('prueba');
  }

  public function prueba2(){
    $this->load->view('prueba2');
  }
     

  public function pruebagracias(){
       $this->load->view('pruebagracias');
  }   
}

/* End of file welcome.php */
/* Location: ./application/modules/welcome/controllers/welcome.php */