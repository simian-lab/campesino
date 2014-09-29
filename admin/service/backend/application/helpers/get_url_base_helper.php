<?php

if ( ! function_exists('get_url_base'))
{
  function get_url_base()
  {

          
           $CI = & get_instance();
           $url      = base_url();
           $base_path=str_replace('evento/', '', FCPATH);
             

           $url_static=$CI->config->item('base_site_eltiempo_static');
           $url_pre_evento=$CI->config->item('base_site_eltiempo_pre-evento');
           $url_evento=$CI->config->item('base_site_eltiempo_evento');
           

//base_site_eltiempo_static
           $data['base_url']         = $url;
           $data['base_url_service'] = $url .'service/';
         //  $data['base_url_static']  = $url .'static/pre-evento/';
         // $data['base_url_img_articulos']  = $url .'multimedia/articulos';



           
           $data['base_url_img_articulos']   = $url_static .'multimedia/articulos/';
           $data['base_url_img_aliados']     = $url_static .'multimedia/aliados/'; // son los patrocinadores
           $data['base_url_img_pautas']      = $url_static .'multimedia/pautas/';
           $data['base_url_img_promociones'] = $url_static .'multimedia/promociones/';
           $data['base_url_img_facturas']    = $url_static .'multimedia/formulario-sorteo/';

           $data['base_path_static_img_facturas']    =  $base_path .'static/multimedia/formulario-sorteo/';
           $data['base_path_admin_img_facturas']    =  $base_path.'admin/multimedia/formulario-sorteo/';
           $data['base_path_admin_img_promociones']    =  $base_path.'multimedia/promociones/';

           $data['base_url_evento_tod']  = $url_evento .'tod/thumb/';
           $data['base_url_pre_evento_tod']  = $url_pre_evento .'tod/thumb/';

           $data['base_url_evento']  = $url_evento;
           $data['base_url_pre_evento']  = $url_pre_evento;

           $data['base_url_static_evento']          = $url_evento .'static/evento/';
           $data['base_url_static_pre_evento']          = $url_pre_evento .'static/evento/';

           return $data;
        
  }

}
?>