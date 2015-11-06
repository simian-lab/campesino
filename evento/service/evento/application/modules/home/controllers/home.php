<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MX_Controller {
  function __construct() {
    parent::__construct();
    $this->load->library('user_agent');
    $this->load->helper('get_app_data');
    $this->load->library('CollectorPromo');
    $this->load->model('home_model');
    $this->load->library('session');
    $this->load->library('memcached_library');
  }

  public function index($filtro='home',$categoria='todos',$tienda='tiendas',$marca='marcas',$subcategoria='todos') {
    $data = null;
    $data = get_url_base();

    $this->load->helper('url');
    $this->load->library('user_agent');

    $dataFiltrado = array( 'categoria' => $categoria ,'tienda' => $tienda ,'marca' => $marca, 'subcategoria' => $subcategoria );

    $session_id = $this->session->userdata('session_id');
    $session_id = sha1('lista_promos'.$session_id);

    $this->collectorpromo->int($session_id);

    $data['jsonParam']=get_app_data();
    $data['descuentosfiltro']=json_encode($dataFiltrado);

    $meta_title = 'Cyberlunes';
    $meta_descripcion = 'Ya estoy disfrutando 24 horas de las mejores ofertas en CyberLunes. Ingresa tu también a http://www.cyberlunes.com.co  y aprovecha descuentos increíbles';
    $meta_keys = "Compare,Mejores Ofertas Turísticas";
    $meta_imagen = base_url() . "static/evento/img/logo200x200.jpg";
    $meta_url = base_url();

    $data['meta_title'] = $meta_title;
    $data['meta_descripcion'] = $meta_descripcion;
    $data['image_src'] = $meta_imagen;
    $data['meta_url'] = $meta_url;
    $data = array_merge($data, add_meta_tags($meta_title, $meta_descripcion, $meta_imagen, $meta_keys));

    $data['menu_html'] =modules::run('menu/menu/load',$data);

    $dataFiltrado = array('categoria' => 'todos'
                            ,'tienda' => 'tiendas'
                            ,'marca' => 'marcas'
                            ,'subcategoria' => 'todos' );
    $data['descuentosfiltro']=json_encode($dataFiltrado);
    $data['jsonParam']=get_app_data();

    $data['s_pageName'] = "cyberlunes: evento: home";
    $data['s_channel'] = "cyberlunes: evento";
    $data['s_prop1']= '';

    $data['tiendas'] = modules::run('promociones/tienda/load',$data);
    $data['marcas'] = modules::run('promociones/marca/load',$data);

    $patrocinadores = $this->home_model->get_patrocinadores();
    $oro_plus = array();
    $oro = array();
    $plata = array();
    $bronce = array();
    $platino = array();
    $general = array();
    $otros = array();

    foreach($patrocinadores as $patrocinador) {
      switch($patrocinador->PAT_PAQUETE){
        case "1":
          array_push($oro_plus, $patrocinador);
          break;

        case "2":
          array_push($oro, $patrocinador);
          break;

        case "3":
          array_push($plata, $patrocinador);
          break;

        case "4":
          array_push($bronce, $patrocinador);
          break;

        case "5":
          array_push($platino, $patrocinador);
          break;

        case "6":
          array_push($general, $patrocinador);
          break;

        case "7":
          array_push($otros, $patrocinador);
          break;
      }
    }

    shuffle($oro_plus);
    shuffle($oro);
    shuffle($plata);
    shuffle($bronce);
    shuffle($platino);
    shuffle($general);
    shuffle($otros);

    $data['patrocinadores_oro_plus'] = $oro_plus;
    $data['patrocinadores_oro'] = $oro;
    $data['patrocinadores_plata'] = $plata;
    $data['patrocinadores_bronce'] = $bronce;
    $data['patrocinadores_platino'] = $platino;
    $data['patrocinadores_general'] = $general;
    $data['patrocinadores_otros'] = $otros;

    $session_id = $this->session->userdata('session_id');
    $session_id = sha1('lista_promos'.$session_id);

    $seed = rand(1, 5);
    $page = 1;

    $data['promocionespremium_html'] = modules::run('promociones/promocion/get/load','premiumhome',$data,$page,$seed,$filtro,$categoria,$tienda,$marca,$subcategoria,$session_id);

    $this->load->view('template/head',$data);
    $this->load->view('template/header',$data);
    $this->load->view('home',$data);
    $this->load->view('template/footer',$data);
    $this->load->view('template/scripts',$data);
  }
}
