<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class formulario_sorteo extends CI_Controller {
    
    public function __construct() {
          parent:: __construct();
       	  $this->load->model('formulario_sorteo_model');
       	  $this->load->helper('url');
          $this->load->helper('form');
          $this->load->helper('get_app_data');
          $this->load->library('form_validation');
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

        $meta_title = 'DiadeModa';
        $meta_descripcion = 'Si les gustan las ofertas como a mí no se pueden perder CyberLunes este 19 de mayo. Entérense de las tiendas que van a participar aquí: http://www.cyberlunes.com.co';
        $meta_keys = "Compare,Mejores Ofertas Turísticas,vive viajar";
        $meta_imagen = $data['base_url_static']."img/logo200x200.jpg";
        $meta_url = base_url();

        $data['meta_title'] = $meta_title;
        $data['meta_descripcion'] = $meta_descripcion;
        $data['image_src'] = $meta_imagen;
        $data['meta_url'] = $meta_url;
        $data = array_merge($data, add_meta_tags($meta_title, $meta_descripcion, $meta_imagen, $meta_keys, $meta_url));

        if($success == 'success'){
            $data['success'] = 'Formulario enviado con éxito';
        }
        elseif($success == 'formato_de_imagen_incorrecto'){
            $data['success'] = 'Formato de imagen incorrecto';
        }
        elseif($success == 'error_upload_file'){
            $data['success'] = 'El archivo no debe superar 8 Mb';
        }
        else{

            $data['error_file'] = $success;
            
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

        $data['slider_patrocinadores'] = $this->formulario_sorteo_model->get_patrocinadores();

        $data['tiendas'] = $this->formulario_sorteo_model->get_tiendas();

        $data['s_pageName']='DíadeModa: pre-evento: formulario: sorteo'; 
        $data['s_channel']= 'DíadeModa: pre-evento: formulario ';
        $data['s_prop1']= 'DíadeModa: pre-evento: formulario: sorteo';
        $data['s_prop2']= '';

        $data['sitio_seccion'] = '58465/438587'; 

        //$data['id_form_mobile'] = 'form-collapse';
        $data['class_form_mobile'] = 'mobile';

        $this->load->view('template/header', $data);
        if($this->agent->is_mobile()){
            $this->load->view('template/form_mobile', $data);
        }
        $this->load->view('formulario_sorteo', $data);
        $this->load->view('template/footer', $data);
        

        $this->load->view('template/terminos_condiciones');
        $this->load->view('template/script_form');

    }


    public function send(){

        $data = null;
        $data = get_url_base();

        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|xss_clean');
        $this->form_validation->set_message('required', '%s requerido');
        //$this->form_validation->set_message('alpha', '%s inválido');
        $this->form_validation->set_rules('dir', 'Dirección', 'trim|required|xss_clean');
        $this->form_validation->set_message('required', '%s requerido');
        $this->form_validation->set_rules('cel', 'Celular', 'trim|required|xss_clean|numeric');
        $this->form_validation->set_message('numeric', '%s inválido');
        $this->form_validation->set_message('required', '%s requerido');
        $this->form_validation->set_rules('tiendas', 'Tienda donde lo compraste', 'trim|required|xss_clean');
        $this->form_validation->set_message('required', '%s requerido');
        //$this->form_validation->set_rules('factura', 'Factura', 'trim|required|xss_clean');
        //$this->form_validation->set_message('required', '%s requerido');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
        $this->form_validation->set_message('required', '%s requerido');
        $this->form_validation->set_message('valid_email', '%s inválido');
        $this->form_validation->set_rules('terminos', 'Términos y condiciones', 'trim|required|xss_clean');
        //$this->form_validation->set_message('required', 'Debe aceptar los %s');
        $this->form_validation->set_error_delimiters('<div class="text-error" style="font-size:0.835em;color:#FF0000">', '</div>'); 

        if ($this->form_validation->run() === FALSE){
            
            $this->index();

        }
        else{

            if (!empty($_FILES['factura']['name'])){
             // $config['upload_path'] = '../static/multimedia/formulario-sorteo/';
                $this->load->library('upload');
                $config['upload_path'] =$data['base_path_static_img_facturas'];
                $config['allowed_types'] = 'pdf|jpg|tiff|png|jpeg|tif';
                $config['max_size'] = '8192';
                $ext = end(explode(".", $_FILES['factura']['name']));
                $config['file_name'] = time().'_factura_cliente.'.$ext;
                $this->upload->initialize($config); 
                //print_r($config['upload_path']);
                if(!$this->upload->do_upload('factura')){
                    
                    $error_file = $this->upload->display_errors();
                    $this->index($error_file);

                }
                else{
                 //   $ruta_copy = '../admin/multimedia/formulario-sorteo/';
                    //die($data['base_path_admin_img_facturas'].$config['file_name']);
                    $path = $data['base_path_static_img_facturas'].$config['file_name'];
                    //die($path);
                    $tipo_pdf = mime_content_type($path);

                    if($tipo_pdf != 'application/pdf'){
                        if(!$this->is_image($path)){
                           @unlink($path);
                           $success = 'formato_de_imagen_incorrecto';
                           $this->index($success);  
                        }
                        else{
                            copy($config['upload_path'].$config['file_name'], $data['base_path_admin_img_facturas'].$config['file_name']);
                            $nombre = $this->input->post('nombre');
                            $direccion = $this->input->post('dir');
                            $email = $this->input->post('email');
                            $celular = $this->input->post('cel');
                            $tienda = $this->input->post('tiendas');
                            $archivo = $config['file_name'];
                            if(file_exists($path)){
                                $this->formulario_sorteo_model->insert_participantes($nombre, $direccion, $email, $celular, $tienda, $archivo);
                                $success = 'success';
                            }
                            else{
                                $success = 'error_upload_file';
                            }
                            redirect('formulario/sorteo/'.$success);
                        }
                    }else{
                        copy($config['upload_path'].$config['file_name'], $data['base_path_admin_img_facturas'].$config['file_name']);
                        $nombre = $this->input->post('nombre');
                        $direccion = $this->input->post('dir');
                        $email = $this->input->post('email');
                        $celular = $this->input->post('cel');
                        $tienda = $this->input->post('tiendas');
                        $archivo = $config['file_name'];
                        if(file_exists($path)){
                            $this->formulario_sorteo_model->insert_participantes($nombre, $direccion, $email, $celular, $tienda, $archivo);
                            $success = 'success';
                        }
                        else{
                            $success = 'error_upload_file';
                        }
                        redirect('formulario/sorteo/'.$success);
                    }
                
                }
                
            }
            else{
                $success = 'Debe seleccionar un archivo';
                $this->index($success);
            }  
            
        }

    }

    public function is_image($path){
        $a = getimagesize($path);
        $image_type = $a[2];

        if (in_array($image_type , array(IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP))){
            return true;
        }
        return false;
    }
        
}

/* End of file welcome.php */
/* Location: ./application/modules/welcome/controllers/welcome.php */