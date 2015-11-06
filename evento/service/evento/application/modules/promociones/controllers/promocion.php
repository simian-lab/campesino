<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Promocion extends MX_Controller {

  public function __construct() {
    parent:: __construct();
    $this->load->library('memcached_library');
    $this->load->library('CollectorPromo');
    //$this->output->enable_profiler(TRUE);
  }

  public function load($tipo='premium', $data='', $page=1, $seed=1, $filtro='home', $categoria='todos', $tienda='tiendas', $marca='marcas', $subcategoria='todos', $idEvento=0, $session) {
    if(!is_numeric($page)) {
      //show_404();
      return;
    }
    if(!is_numeric($seed)) {
      //show_404();
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
      $idtipo = 2;
      $cant = NUMERO_PROMOCIONES_PREMIUM;
      $templateContainer='containerPromocionesPremium';
      break;

      case 'premiumhome':
      $idtipo = 2;
      $cant = NUMERO_PROMOCIONES_PREMIUM;
      $templateContainer='containerPromocionesPremium';
      break;

      case 'premiumgenerales':
      $idtipo = array(3,1);
      $cant = NUMERO_PROMOCIONES_GENERALES;
      $templateContainer = 'containerPromocionesGenerales';
      break;

      case 'premiumhomepremium':
      $idtipo = array(3,2);
      $cant = NUMERO_PROMOCIONES_PREMIUM;
      $templateContainer = 'containerPromocionesPremium';
      break;

      default:
      $idtipo = 1;
      $cant = NUMERO_PROMOCIONES_GENERALES;
      $templateContainer='containerPromocionesGenerales';
      break;
    }

    $offset= ($page - 1)  * $cant;
    $nextpage = $page + 1;
    $data['nextpage']=$nextpage;
    $data['offset'] = $offset;

    $idPromosRepetido=$this->collectorpromo->get($session);

    switch ($filtro) {
      case 'home':

      $data['promociones'] = $this->promocion_model->get($idtipo,$seed,$cant,$offset,$idPromosRepetido, $idEvento);
      $this->collectorpromo->set($data['promociones'],$session);

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

      $data['promociones'] = $this->promocion_model->getFiltro($idtipo,$idCategoria,$idTienda,$idMarca,$idSubcategoria,$seed,$cant,$offset,$idPromosRepetido, $idEvento);
      $this->collectorpromo->set($data['promociones'],$session);

      break;
    }

    if(!$data['promociones']) {
      return $this->load->view('containerEmpty',$data,true);
    }

    //$data['promociones'] = array_chunk($data['promociones'],$cant);

    $data['pagination'] = site_url('descuentosfiltro/page/'.$tipo.'/'.$filtro.'/'.$categoria.'/'.$tienda.'/'.$marca.'/'.$subcategoria.'/'.$seed.'/'.$nextpage);


    if($filtro == 'categoria' && $categoria != 'todos'){
      $data['categoria_promocion'] = modules::run('breadcrumb/breadcrumb/get_categoria_name');
    }

    return $this->load->view($templateContainer,$data,true);
  }
}

/* End of file welcome.php */
/* Location: ./application/modules/welcome/controllers/welcome.php */
