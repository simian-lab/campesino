<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pautas extends MX_Controller {
    
    public function __construct() {

        parent::__construct();

    }        
    public function loadSlice($data='') {
		//$data  = get_url_base();
    	$this->load->model('pautas_model');

    	$data['pautas'] = $this->pautas_model->get_pautas_destacados();
    	if(!$data['pautas'])
        {
             return $this->load->view('pautas/sliceEmpty',$data,true);
        }   

		
		return $this->load->view('sliceHome',$data,true);     
    } 


    public function loadSliceSubPautas($pau_id) {
  		$data  = get_url_base();
      $this->load->model('pautas_model');

      $pau = $this->pautas_model->get_pautaxslug($this->uri->segment(2));

      if(!$pau)
      {
            
         return  $this->load->view('pautas/sliceEmpty',$data,true);  
 
      }   

      $data['pautas'] = $this->pautas_model->get_pautas_carousel($pau['PAU_ID']);

      if($data['pautas']['0']['RESPUESTA'] == 101) // si no hay subpauta cargada
      {
      
        return  $this->load->view('pautas/sliceEmpty',$data,true);  
      }
      return $this->load->view('sliceSubPauta',$data,true);
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

        
         $this->load->model('pautas/pautas_model');
         $data['pautas'] = $this->pautas_model->get_pautas_all($cant, $offset);

         if(!$data['pautas'])
        {
           
            return $this->load->view('containerPautaEmpty',$data,true); 
        }

        $data['pautas'] = array_chunk($data['pautas'], 3);
                
        $data['pagination'] = site_url('pauta/page/'.$nextpage);

       return $this->load->view('containerPautaPag',$data,true);    
    }

}
