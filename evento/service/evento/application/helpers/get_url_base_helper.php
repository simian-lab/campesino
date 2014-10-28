<?php

if ( ! function_exists('get_url_base'))
{
  function get_url_base()
  {

          
           $CI = & get_instance();
           $url      = base_url();
           $base_path=str_replace('evento/', '', FCPATH);
             

           $url_static=$CI->config->item('base_site_eltiempo_static');
           $url_root=$CI->config->item('base_site_eltiempo_root');
//base_site_eltiempo_static
           $data['base_url']         = $url;
           $data['base_url_service'] = $url .'service/';
           $data['url_static'] = $url_static;
         //  $data['base_url_static']  = $url .'static/pre-evento/';
         // $data['base_url_img_articulos']  = $url .'multimedia/articulos';

           $data['base_url_static']          = $url .'static/evento/';
           $data['base_url_img_articulos']   = $url_static .'multimedia/articulos/';
           $data['base_url_img_aliados']     = $url_static .'multimedia/aliados/'; // son los patrocinadores
           $data['base_url_img_pautas']      = $url_static .'multimedia/pautas/';
           //$data['base_url_img_promociones'] = $url_static .'multimedia/promociones/';
           $data['base_url_img_promociones'] = $url_static .'multimedia/promociones/';
 


           $data['base_url_tod']  = $url .'tod/thumb/';
           return $data;
        
  }

}
?>