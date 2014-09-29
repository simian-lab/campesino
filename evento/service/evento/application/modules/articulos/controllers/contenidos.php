<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class contenidosArticulos extends MX_Controller {
    
    public function __construct() {

        parent::__construct();

    }          

    public function load($data='',$page=1){

         if(!is_numeric($page)) {
  //             show_404();
               return;
         } 
  
         $this->load->database();

         $cant=6;

         $offset= ($page - 1)  * $cant;

         $nextpage = $page + 1;
         $data['nextpage']=$nextpage;

        
         $this->load->model('articulos/articulos_model');
         $data['articulos'] = $this->articulos_model->get_articulos(null,$cant, $offset);

         if(!$data['articulos'])
        {
           
            return $this->load->view('articulosEmpty',$data,true); 
        }

       
                
        $data['pagination'] = site_url('contenidos/page/'.$nextpage);

       return $this->load->view('articulos',$data,true);    
    }

}