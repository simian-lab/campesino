<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MX_Controller {
  function __construct() {
    parent::__construct();
    $this->load->model('home_model');

    $this->load->library('user_agent');
  }

  public function index() {
    $data = null;
    $data = get_url_base();

    $data['tiendas'] = modules::run('promociones/tienda/load',$data);
    $data['marcas'] = modules::run('promociones/marca/load',$data);

    $patrocinadores = $this->home_model->get_patrocinadores();
    $oro_plus = array();
    $oro = array();
    $plata = array();
    $bronce = array();
    $platino = array();
    $general = array();

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
      }
    }

    $data['patrocinadores_oro_plus'] = $oro_plus;
    $data['patrocinadores_oro'] = $oro;
    $data['patrocinadores_plata'] = $plata;
    $data['patrocinadores_bronce'] = $bronce;
    $data['patrocinadores_platino'] = $platino;
    $data['patrocinadores_general'] = $general;


    $meta_title = 'Cyberlunes';
    $meta_descripcion = 'Encuentre y compare diferentes ofertas en planes y paquetes turísticos a cualquier destino nacional e internacional en viveviajar.com';
    $meta_keys = "Compare,Mejores Ofertas Turísticas,vive viajar";
    $meta_imagen = base_url() . "static/evento/img/logo200x200.jpg";
    $meta_url = base_url();

    $data['meta_title'] = $meta_title;
    $data['meta_descripcion'] = $meta_descripcion;
    $data['image_src'] = $meta_imagen;
    $data['meta_url'] = $meta_url;
    $data = array_merge($data, add_meta_tags($meta_title, $meta_descripcion, $meta_imagen, $meta_keys));

    $data['menu_html'] =modules::run('menu/menu/load',$data);

    $this->load->view('template/head',$data);
    $this->load->view('piwik',$data);
    $this->load->view('template/header',$data);
    $this->load->view('home',$data);
    $this->load->view('template/footer',$data);
    $this->load->view('template/scripts',$data);
  }
}