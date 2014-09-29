<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class contenidosArticulos extends MX_Controller {
    
    public function __construct() {

        parent::__construct();
        $this->load->database();
        $this->load->model('articulos/articulos_model');
        $this->load->library("pagination");
        $this->load->helper('fechas-articulos');

    }          

    public function load($data='',$page=1,$seed=1){

         if(!is_numeric($page)) {
  //             show_404();
               return;
         } 
  
         

         $cant=8;

         $offset= ($page - 1)  * $cant;

         /*$nextpage = $page + 1;
         $data['nextpage']=$nextpage;*/

        
         
         $data['articulos'] = $this->articulos_model->get_articulos(null,$cant, $offset);

         if(!$data['articulos'])
        {
           
            return $this->load->view('articulosEmpty',$data,true); 
        }

       $this->paginacionArticulos();
                
        //$data['pagination'] = site_url('contenidos/page/'.$nextpage);
       $data['pagination'] =  $this->pagination->create_links();
       return $this->load->view('articulos',$data,true);    
    }

    public function loadArticulo($data='', $id_art = ''){
        
        $data['articulo'] = $this->articulos_model->get_articulos($id_art,1, 0);

        return $this->load->view('detalleArticulo',$data,true);    

    }

    public function loadArticulosRecomendados($data='', $id_art = ''){
        
        $data['articulosRecomendados'] = $this->articulos_model->get_articulos_recomendados();

        return $this->load->view('articulosRecomendados',$data,true);    

    }

    public function paginacionArticulos(){
      $data = null;
      $data = get_url_base();

        $config = array();
        $config['base_url'] = base_url().'contenidos/';
        $arrayCantArt = $this->articulos_model->get_count_articulos();
        $config['total_rows'] = $arrayCantArt[0]->TOTAL;
        $config['per_page'] =  8;
        $config['num_links'] = 5;
        $config['uri_segment'] = 2;
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

}