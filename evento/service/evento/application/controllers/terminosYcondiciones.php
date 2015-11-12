<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class terminosYcondiciones extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');
        $this->load->helper('get_app_data');
        $this->load->library('CollectorPromo');
        $this->load->library('session');
        $this->load->library('memcached_library');
    }

    public function terminos()
    {
        $this->load->helper('url');
        $this->load->library('user_agent');

        $data = null;
        $data = get_url_base();

        $data['jsonParam'] = get_app_data();


        $meta_title = TITLE;
        $meta_descripcion = META_DESCRIPTION;
        $meta_keys = META_KEY;
        $meta_imagen = base_url() . "static/evento/img/logo200x200.jpg";
        $meta_url = base_url();

        $data['meta_title'] = $meta_title;
        $data['meta_descripcion'] = $meta_descripcion;
        $data['image_src'] = $meta_imagen;
        $data['meta_url'] = $meta_url;

        /* mencache menu*/
        $data['menu_html'] = modules::run('menu/menu/load', $data);
        /* mencache menu*/

        $this->load->view('template/head', $data);
        $this->load->view('template/header', $data);
        $this->load->view('template/terminos', $data);
        $this->load->view('template/footer', $data);
        $this->load->view('template/scripts', $data);

        return;
    }
}