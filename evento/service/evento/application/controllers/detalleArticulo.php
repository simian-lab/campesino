<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class detalleArticulo extends MX_Controller
{
   function __construct()
   {
       parent::__construct();
       //$this->output->enable_profiler(TRUE);
   }


  public function todos($id_art = '') {
        $data = null;
        $data = get_url_base();


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

      /* mencache menu*/
      //  $key['menu']='menu_html';
        $data['menu_html'] =modules::run('menu/menu/load',$data);

/* mencache menu*/
/* mencache articulos*/
        //$page=1;
        $data['articulo_html'] = modules::run('articulos/contenidosArticulos/loadArticulo',$data,$id_art);
        $data['articulos_recomendados_html'] = modules::run('articulos/contenidosArticulos/loadArticulosRecomendados',$data,$id_art);
//print_R($data);
        $templateContainer='template/containerDetalleArticulo';
        $this->load->view('template/head',$data);
        $this->load->view('template/header',$data);
        $this->load->view($templateContainer,$data);
        $this->load->view('template/footer',$data);
        $this->load->view('template/scripts',$data);

       return;

  }

}