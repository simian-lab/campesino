<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class formulario_participacion extends CI_Controller {

    public function __construct() {
          parent:: __construct();
       	  $this->load->model('formulario_participacion_model');
       	  $this->load->helper('url');
          $this->load->helper('form');
          $this->load->helper('get_app_data');
          $this->load->library('form_validation');
          $this->load->library('email');
          $this->load->library('user_agent');
     }

    public function index($success = '') {



       if(isset($_COOKIE['origen']) && $_COOKIE['origen']=='registro_success'){
                redirect('/gracias');
                exit();
       }


        $data = null;
        $data = get_url_base();

        $data['jsonParam']=get_app_data();

        $meta_title = 'Cyberlunes';
        $meta_descripcion = 'Ahorré en mis compras y ahora voy a disfrutarlas. Pronto www.cyberlunes.com de nuevo.';
        $meta_keys = "Compare,Mejores Ofertas Turísticas";
        $meta_imagen = $data['base_url_static']."img/logo200x200.jpg";
        $meta_url = base_url();

        $data['meta_title'] = $meta_title;
        $data['meta_descripcion'] = $meta_descripcion;
        $data['image_src'] = $meta_imagen;
        $data['meta_url'] = $meta_url;
        $data = array_merge($data, add_meta_tags($meta_title, $meta_descripcion, $meta_imagen, $meta_keys, $meta_url));

        if($success != ''){
            $data['success'] = 'Formulario enviado con éxito';
        }

        if($this->agent->is_mobile()){
            $data['is_mobile'] = 1;
          }
          else{
            $data['is_mobile'] = 0;
          }

        if(isset($_COOKIE['formularios']) && $_COOKIE['formularios'] == 'hidden'){
          $data['hide_form'] = 1;
        }

        $data['title'] = 'El Tiempo - Cybermonday';

        $data['slider_patrocinadores'] = $this->formulario_participacion_model->get_patrocinadores();

        $data['s_pageName']='cyberlunes: pre-evento: formulario participacion';
        $data['s_channel']= 'cyberlunes: pre-evento';
        $data['s_prop1']= 'Cyberlunes: pre-evento: formulario: participacion';
        $data['s_prop2']= '';

        $data['siteId'] = 58465;
        $data['pageId'] = 438590;

        //$data['id_form_mobile'] = 'form-collapse';
        $data['class_form_mobile'] = 'mobile';

        $this->load->view('template/header', $data);
        if($this->agent->is_mobile()){
            $this->load->view('template/form_mobile', $data);
        }
        $this->load->view('formulario_participacion', $data);
        $this->load->view('template/footer', $data);


        $this->load->view('template/terminos_condiciones');
        $this->load->view('template/script_form');

    }

    public function setCookie(){

        $cookie = array(
            'name'   => 'suscripcion',
            'value' => 'suscripcion',
            'expire' => '86500'
        );

        $this->input->set_cookie($cookie);

      }


    public function send(){

        $this->form_validation->set_rules('nombre_empresa', 'Nombre de la empresa', 'trim|required|xss_clean');
        $this->form_validation->set_message('required', '%s requerido');
        $this->form_validation->set_rules('nombre_contacto', 'Nombre de contacto', 'trim|required|xss_clean');
        $this->form_validation->set_message('required', '%s requerido');
        $this->form_validation->set_rules('cargo', 'Cargo', 'trim|required|xss_clean');
        $this->form_validation->set_message('required', '%s requerido');
        $this->form_validation->set_rules('ciudad', 'Ciudad', 'trim|required|xss_clean');
        $this->form_validation->set_message('required', '%s requerido');
        $this->form_validation->set_rules('celular', 'Teléfono móvil', 'trim|numeric|required|xss_clean');
        $this->form_validation->set_message('required', '%s requerido');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
        $this->form_validation->set_message('required', '%s requerido');
        $this->form_validation->set_message('valid_email', '%s inválido');
        $this->form_validation->set_rules('terminos', 'Términos y condiciones', 'trim|required|xss_clean');
        $this->form_validation->set_message('required', '%s requerido');
        $this->form_validation->set_rules('telefono', 'Teléfono oficina', 'trim|numeric|xss_clean');
        $this->form_validation->set_message('numeric', '%s inválido');
        $this->form_validation->set_message('alpha', '%s inválido');
        $this->form_validation->set_rules('url');
        $this->form_validation->set_rules('comentarios');
        $this->form_validation->set_error_delimiters('<div class="text-error" style="font-size:0.835em;color:#FF0000">', '</div>');


        if ($this->form_validation->run() === FALSE)
        {
            $this->index();
        }
        else
        {
            $this->config->load('email');
            $config['protocol'] = 'smtp';
            $config['smtp_host'] = $this->config->item('smtp_host');


            $this->email->initialize($config);

            $mensaje = 'Nombre de la empresa: '.$this->input->post('nombre_empresa').'
                        Nombre de contacto: '.$this->input->post('nombre_contacto').'
                        Cargo: '.$this->input->post('cargo').'
                        Ciudad: '.$this->input->post('ciudad').'
                        Correo electrónico: '.$this->input->post('email').'
                        Teléfono móvil: '.$this->input->post('celular').'
                        Teléfono oficina: '.$this->input->post('telefono').'
                        URL de la tienda: '.$this->input->post('url').'
                        Comentarios: '.$this->input->post('comentarios');

            $this->email->from($this->config->item('website_sender'));
            $this->email->to($this->config->item('email_to'));
            $this->email->subject('Formulario de particiación de Cyberlunes');
            $this->email->message($mensaje);
            $this->email->send();

            $this->formulario_participacion_model->insert_participantes();
            $success = 'success';

            redirect('formulario/participacion/'.$success);
        }

    }

}

/* End of file welcome.php */
/* Location: ./application/modules/welcome/controllers/welcome.php */