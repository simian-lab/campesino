<?php

class Main extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('tank_auth');        
    }
    
    public function index(){
              
        //Modelo
        $this->load->model('beneficios_model');        
        
        //Lista Socios
        $data['socios'] = $this->beneficios_model->get_socios();        
        
        //Lista Categorias
        $data['categorias'] = $this->beneficios_model->get_categorias();
        
        //Lista Beneficios
        if($this->input->post('search_op'))
            $search_op=$this->input->post('search_op');
        else
            $search_op=$this->input->get('search_op');

        if($this->input->post('search_key'))
                $search_key=$this->input->post('search_key');
        if($this->input->get('search_key'))
            $search_key=$this->input->get('search_key');
		

        if(empty($search_key)&&empty($search_op)){ 
            $searchOp = '';
            $searchCampo  = '';
            $searchString = '';
        }else{
            if(!empty($search_key)){
                $searchOp     = 'cn';
                $searchCampo  = 'SOC_NOMBRE';                
                $searchString = $search_key;
                $data['searchOp'] = '';
            }else{
                $searchOp     = 'eq';
                $searchCampo  = 'ID';                
                $searchString = $search_op;
                $data['searchOp'] = $search_op;
            }
        }                
        
        $categoria=$this->input->get('categoria'); 
        $data['cat_id']=$categoria;
        
        $data['beneficios'] = $this->_get_list($categoria, $searchOp, $searchCampo, $searchString);        

        //VIEWS
        $this->load->view('template/header');        
        if($this->tank_auth->is_logged_in()){
            $data['user'] = $this->tank_auth->get_user_data();
            $this->load->view('template/nav_user',$data);
            $this->load->view('template/nav_left_user',$data); 
        }else{
            $this->load->view('template/nav_guest');
            $this->load->view('template/nav_left_guest',$data);            
        }        
        
        $this->load->view('beneficios',$data);          
        $this->load->view('template/footer');
    }
    
    private function _get_list($categoria,$searchOp, $searchCampo, $searchString){
        $this->load->library('pagination');
        
        $config['base_url'] = site_url('beneficios/main/index/');
	          
        $rows = $this->beneficios_model->getnumRows($categoria,$searchOp, $searchCampo, $searchString);

        $config['total_rows'] = $rows['CANT'];
        $config['per_page'] = 9;
        $config['num_links'] = 6;
                   
        $offset = $this->uri->segment(5);
        $uri_segment = 5;
            
        $config['uri_segment'] = $uri_segment;    
        
        $config['full_tag_open'] = '<ul>';
        $config['full_tag_close'] = '</ul>';

        $config['first_link'] = false;
        $config['last_link'] = false; 
		

        $config['cur_tag_open'] = '<li><a href="#">';
        $config['cur_tag_close'] = '</a></li>';                   

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';

        $config['next_link'] = '>';
        $config['prev_link'] = '<';

        $config['use_page_numbers'] = TRUE;
        $config['enable_query_strings']=TRUE;
        $config['first_url'] = '1?'.http_build_query($_GET, '', "&").'&search_op='.$searchOp.'&search_key='.$searchString;
        $config['suffix'] = '?'.http_build_query($_GET, '', "&").'&search_op='.$searchOp.'&search_key='.$searchString;
        
        $this->pagination->initialize($config);
        
        $per_page   = $config['per_page'];
 
        $result = $this->beneficios_model->get_beneficios($per_page,$offset,$categoria,$searchOp, $searchCampo, $searchString);

        return $result;        
    }
    
    public function get_detalle($beneficio=''){
                
        //Modelo
        $this->load->model('beneficios_model');        
        
        //Lista Socios
        $data['socios'] = $this->beneficios_model->get_socios();        
        
        //Lista Categorias
        $data['categorias'] = $this->beneficios_model->get_categorias();
        
        //Detalle Beneficio
        $data['beneficio'] = $this->beneficios_model->get_beneficio($beneficio);

        //Imagenes Beneficio
        $data['slide'] = $this->beneficios_model->get_beneficio_imagenes($beneficio);
        
        //VIEWS
        $this->load->view('template/header');        
        if($this->tank_auth->is_logged_in()){
            $data['user'] = $this->tank_auth->get_user_data();        
            $this->load->view('template/nav_user',$data);
            $this->load->view('template/nav_left_user',$data);          
        }else{
            $this->load->view('template/nav_guest');
            $this->load->view('template/nav_left_guest',$data);            
         
        }
        $this->load->view('beneficio_detalle',$data);           
        $this->load->view('template/footer');
    }
}

