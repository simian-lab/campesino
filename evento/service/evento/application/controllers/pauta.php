<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pauta extends MX_Controller
{
   function __construct()
   {
       parent::__construct();
   }


  public function mejor_2013() {
        $data = null;
        $data = get_url_base();


        $meta_title = 'Cyberlunes';
        $meta_descripcion = 'Ya estoy disfrutando 24 horas de las mejores ofertas en CyberLunes. Ingresa tu también a http://www.cyberlunes.com.co  y aprovecha descuentos increíbles';
        $meta_keys = "Compare,Mejores Ofertas Turísticas,vive viajar";
        $meta_imagen = base_url() . "static/evento/img/logo200x200.jpg";

        $data['meta_title'] = $meta_title;
        $data['meta_descripcion'] = $meta_descripcion;
        $data['image_src'] = $meta_imagen;
        $data = array_merge($data, add_meta_tags($meta_title, $meta_descripcion, $meta_imagen, $meta_keys));

        $data['bodyClass']= ''; // Slider de la home de articulos
        $data['s_pageName']='vivaviajar evento'; // Slider de la home de articulos
        $data['s_channel']= 'vivaviajar evento: lo mejor del 2013  ';
        $data['s_prop1']= '';
        $data['s_prop2']= '';

        $data['breadcrumb_categoria']='';
        $data['breadcrumb_destino']='Lo mejor del 2013';


/* mencache slice pautas*/
    //    $key['pautas_slice']='pautas_slice_html';
        $data['pautas_slice_html'] =modules::run('pautas/pautas/loadSlice',$data);
/* mencache slice pautas*/

/* mencache menu*/
      //  $key['menu']='menu_html';
        $data['menu_html'] =modules::run('menu/menu/load',$data);
/* mencache menu*/
/* mencache PAUTAS*/
        $page=1;
        $data['pautas_html'] =modules::run('pautas/pautas/load',$data,$page);


        $this->load->view('template/head',$data);
        $this->load->view('template/header',$data);
        $this->load->view('template/containerPautaHome',$data);
        $this->load->view('template/footer',$data);
       return;

  }



  public function page($page='') {
           $data = null;
           $data = get_url_base();

          $data['pautas_html'] =modules::run('pautas/pautas/load',$data,$page);
          echo $data['pautas_html'];
        return;
  }



}