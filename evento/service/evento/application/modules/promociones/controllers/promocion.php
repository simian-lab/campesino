<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Promocion extends MX_Controller {
    
    public function __construct() {
          parent:: __construct();
          $this->load->library('memcached_library');
      //   $this->output->enable_profiler(TRUE);
       
    }

   

  

  public function load($tipo='premium',$data='',$page=1,$seed=1,$filtro='home',$categoria='todos',$tienda='tiendas',$marca='marcas',$subcategoria='todos'){



       if(!is_numeric($page)) {
//             show_404();
             return;
       } 
       if(!is_numeric($seed)) {
  //           show_404();
             return;
       } 
       $this->load->database();

       $this->load->model('promociones/promocion_model');    
/*
       if($tipo=='premium'){
            $idtipo=2;
            $cant=4;
            $templateContainer='containerPromocionesPremium';
         }else{
            $idtipo=1;
            $cant=6;
            $templateContainer='containerPromocionesGenerales';
        }*/
        switch ($tipo) {
           case 'premium':
                 $idtipo=2;
                $cant=4;
                $templateContainer='containerPromocionesPremium';
           break;
           case 'premiumhome':
                $idtipo=2;
                $cant=4;
                $templateContainer='containerPromocionesPremium';
           break;
           case 'premiumgenerales':
                $idtipo = array(3,1);
                $cant = 6;
                $templateContainer = 'containerPromocionesGenerales';
           break;
           case 'premiumhomepremium':
                $idtipo = array(3,2);
                $cant = 4;
                $templateContainer = 'containerPromocionesPremium';
            break;
           default:
              $idtipo=1;
              $cant=6;
              $templateContainer='containerPromocionesGenerales';
           break;
   
        }

      

       $offset= ($page - 1)  * $cant;
       $nextpage = $page + 1;
       $data['nextpage']=$nextpage;
       $data['offset'] = $offset;

        switch ($filtro) {
           case 'home':
                   
                    $data['promociones'] = $this->promocion_model->get($idtipo,$seed,$cant,$offset);
                    for($i=0; $i < count($data['promociones']); $i++){
                      $key_memcached = 'promo_id_'.$data['promociones'][$i]['PRO_ID'];
                      $results = $this->memcached_library->get($key_memcached);
                      if(!$results){
                        $this->memcached_library->add($key_memcached, $data['promociones'][$i]['PRO_ID']);
                      }
                      else{
                        unset($data['promociones'][$i]);
                      }
                    }
           break;  
           case 'categoria':                   
                    
                    $idCategoria = 'todos';
                    if($categoria!='todos'){
                          $result = $this->promocion_model->getCategoriaSlug($categoria); 
                          if(!$result)
                          {
                             show_404();
                             return;                               
                          }
                          $idCategoria=$result['CAT_ID'];
                    }
                      

                    $idTienda = 'tiendas';
                    if($tienda!='tiendas'){
                          $result = $this->promocion_model->getTiendaSlug($tienda);
                          if(!$result)
                          {
                             show_404();
                             return;                               
                          } 
                          $idTienda=$result['TIE_ID_USER'];
                    }
                      

                    $idMarca = 'marcas';
                    if($marca!='marcas'){
                          $result = $this->promocion_model->getMarcaSlug($marca);
                          if(!$result)
                          {
                             show_404();
                             return;                               
                          } 
                          $idMarca=$result['MAR_ID'];
                    }
                      

                    $idSubcategoria = 'todos';
                    if($subcategoria!='todos'){
                          $result =  $this->promocion_model->getSubCategoriaSlug($subcategoria); 
                          if(!$result)
                          {
                             show_404();
                             return;                               
                          }
                          $idSubcategoria=$result['SUB_ID'];
                    }
                      


                  $data['promociones'] = $this->promocion_model->getFiltro($idtipo,$idCategoria,$idTienda,$idMarca,$idSubcategoria,$seed,$cant,$offset);                    
                  
           break;   
                  
        }     

       if(!$data['promociones'])
       {

                return $this->load->view('containerEmpty',$data,true); 
       }

//       $data['promociones'] = array_chunk($data['promociones'],$cant);
  
       $data['pagination'] = site_url('descuentosfiltro/page/'.$tipo.'/'.$filtro.'/'.$categoria.'/'.$tienda.'/'.$marca.'/'.$subcategoria.'/'.$seed.'/'.$nextpage);


      if($filtro == 'categoria' && $categoria != 'todos'){
        $data['categoria_promocion'] = modules::run('breadcrumb/breadcrumb/get_categoria_name');
      }
      //print_r($this->memcached_library->getAllKeys());die;
       return  $this->load->view($templateContainer,$data,true);    

    }

   
  
    	
}

  

/* End of file welcome.php */
/* Location: ./application/modules/welcome/controllers/welcome.php */
