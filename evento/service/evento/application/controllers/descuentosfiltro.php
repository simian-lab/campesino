<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Descuentosfiltro extends MX_Controller 
{
   function __construct()
   {
       parent::__construct();
       $this->load->library('user_agent');
       //$this->load->library('memcached_library');
       //$this->output->enable_profiler(TRUE);
   }

   public function todos() {
      
            $filtro='todos';
            $this->get_promociones('home',$filtro); 
            return;     
   } 
   public function categoria($categoria='todos',$tienda='tiendas',$marca='marcas',$subcategoria='todos') {
                  
          /*if($categoria!='todos'){
                 $this->load->database();
                 $this->load->model('menu/categoria_model');    
                 if(!$this->categoria_model->existCategoria($categoria)){
                          echo show_404();
                          return;
                }

          }*/


          $this->get_promociones('categoria',$categoria,$tienda,$marca,$subcategoria); 
          return;     
   } 

  
   private function get_promociones($filtro='home',$categoria='todos',$tienda='tiendas',$marca='marcas',$subcategoria='todos') { 
        $this->load->helper('url');
        $this->load->library('user_agent');

        $dataFiltrado= array('categoria' =>$categoria 
                            ,'tienda' =>$tienda 
                            ,'marca' =>$marca 
                            ,'subcategoria' =>$subcategoria  );



        $data = null;
        $data = get_url_base();

        $data['descuentosfiltro']=json_encode($dataFiltrado);

        $meta_title = 'Cyberlunes';
        $meta_descripcion = 'Si les gustan las ofertas como a mí, entren ya a www.cyberlunes.com.co. Estas ofertas solo duran hasta media noche.';
        $meta_keys = "Compare,Mejores Ofertas Turísticas,viveviajar";
        $meta_imagen = base_url() . "static/evento/img/logo200x200.jpg";
        $meta_url = base_url();

        $data['meta_title'] = $meta_title;
        $data['meta_descripcion'] = $meta_descripcion;
        $data['image_src'] = $meta_imagen;
        $data['meta_url'] = $meta_url;
        $data = array_merge($data, add_meta_tags($meta_title, $meta_descripcion, $meta_imagen, $meta_keys, $meta_url));
      
/* mencache menu*/
		    $data['menu_html'] =modules::run('menu/menu/load',$data);
/* mencache menu*/       


 /*if($this->agent->is_mobile() ){
               $data['ads_movil'] ='movil'; 
  }*/
/* mencache promociones*/	
        $seed= rand(1, 5);
        $page=1;



        $data['smart_id'] ='todaslascategorias';


   
        $data['tiendas'] = modules::run('promociones/tienda/load',$data);
        $data['marcas'] = modules::run('promociones/marca/load',$data);
        $data['subCategorias'] = modules::run('promociones/subcategoria/load',$data,$categoria);

        /*print_R($filtro);
        print_r($categoria);
        print_r($tienda);
        print_r($marca);
        print_r($subcategoria);*/
        if($tienda != 'tiendas' || $marca != 'marcas'){
          $data['publicidad_home'] = 0;
        }
        if($filtro=='home'){
            $data['promocionespremium_html'] =modules::run('promociones/promocion/get/load','premiumhome',$data,$page,$seed,$filtro,$categoria,$tienda,$marca,$subcategoria);
            $data['promocionesgenerales_html'] =modules::run('promociones/promocion/get/load','premiumgenerales',$data,$page,$seed,$filtro,$categoria,$tienda,$marca,$subcategoria);
        }else{
            $data['promocionespremium_html'] =modules::run('promociones/promocion/get/load','premiumhomepremium',$data,$page,$seed,$filtro,$categoria,$tienda,$marca,$subcategoria);
            $data['promocionesgenerales_html'] =modules::run('promociones/promocion/get/load','generales',$data,$page,$seed,$filtro,$categoria,$tienda,$marca,$subcategoria);
            $data['publicidad_categoria'] = 1;
        }
        
        $data['breadcrumb'] = modules::run('breadcrumb/breadcrumb/index');
        
        //$data['promocionesgenerales_html'] =modules::run('promociones/promocion/get/load','generales',$data,$page,$seed,$filtro,$categoria,$tienda,$marca,$subcategoria);
        $templateContainer='template/containerPromocion';
        
        if($filtro == 'home'){
          $data['s_pageName']="evento: home"; // Slider de la home de articulos
          $data['s_channel']="evento: home";
          $data['s_prop1']= '';
        }

        if($filtro == 'categoria' && $tienda != 'tiendas'){
          $data['s_pageName']="evento: home: ".$tienda;
          $data['s_channel']="evento: home";
          $data['s_prop1']="evento: home: ".$tienda;
        }

        if($filtro == 'categoria' && $marca != 'marcas'){
          $data['s_pageName']="evento: home: ".$marca;
          $data['s_channel']="evento: home";
          $data['s_prop1']="evento: home: ".$marca;
        }

        if($filtro == 'categoria' && $categoria != 'todos'){
          $data['s_pageName']="evento: ".$categoria;
          $data['s_channel']="evento: ".$categoria;
          $data['s_prop1']="";
        }

        if($filtro == 'categoria' && $categoria != 'todos' && $tienda != 'tiendas'){
          $data['s_pageName']="evento: ".$categoria.": ".$tienda;
          $data['s_channel']="evento: ".$categoria;
          $data['s_prop1']="evento: ".$categoria.": ".$tienda;
        }

        if($filtro == 'categoria' && $categoria != 'todos' && $marca != 'marcas'){
          $data['s_pageName']="evento: ".$categoria.": ".$marca;
          $data['s_channel']="evento: ".$categoria;
          $data['s_prop1']="evento: ".$categoria.": ".$marca;
        }

        if($filtro == 'categoria' && $categoria != 'todos' && $subcategoria != 'todos'){
          $data['s_pageName']="evento: ".$categoria.": ".$subcategoria;
          $data['s_channel']="evento: ".$categoria;
          $data['s_prop1']="evento: ".$categoria.": ".$subcategoria;
        }

        if($categoria == 'viajes-y-turismo'){
          $data['sas_taget_lan'] = 'seccion=lan';
        }
        elseif($categoria == 'moviles'){
          $data['sas_taget_lan'] = 'seccion=tigo';
        }
        else{
          $data['sas_taget_lan'] = '';
        }
        
        $data['s_prop2']= '';

        $this->load->view('template/head',$data);
        $this->load->view('template/header',$data);
        $this->load->view($templateContainer,$data);
        $this->load->view('template/footer',$data);
        $this->load->view('template/scripts',$data);

        return;
      
    }

       public function page($tipo='premium',$filtro='home',$categoria='todos',$tienda='tiendas',$marca='marcas',$subcategoria='todos',$seed='',$page='') {
          
           $data = null;
           $data = get_url_base();

        
    

          $dataPromociones=modules::run('promociones/promocion/get/load',$tipo,$data,$page,$seed,$filtro,$categoria,$tienda,$marca,$subcategoria);
          switch ($tipo) {       
               case 'premiumhome':              
                    $data['promocionespremium_html'] = $dataPromociones;
                    echo $data['promocionespremium_html'];

               break;
               case 'premiumgenerales':
                    $data['promocionesgenerales_html'] = $dataPromociones;
                    echo $data['promocionesgenerales_html'];
               break;
               case 'premiumhomepremium':
                    $data['promocionespremium_html'] = $dataPromociones;
                    echo $data['promocionespremium_html'];
                break;
               default:
                   $data['promocionesgenerales_html'] = $dataPromociones;
                   echo $data['promocionesgenerales_html'];
               break;
       
          }
          
        return;
    }
  
    	
}