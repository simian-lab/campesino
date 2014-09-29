<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vista_previa extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		
		$this->load->helper('url');
	}

	// Metodo para carga de albunes
	function index($id='')
	{

    if(!is_numeric($id)){
        die('promocion no existente');
    }

      $this->load->helper('get_url_base');
      $this->load->helper('text');
      $this->load->helper('html');
      $this->load->helper('get_url_promocion');
      $this->load->helper('get_url_encode_tod');

      
       
      $data = null;
      $data = get_url_base();

      $this->load->model('pendientes_model');
    
      $data['promocion'] = $this->pendientes_model->getPromocion($id);


    


/*
      echo('<pre>');
      print_r($data['promociones']);
      echo('<pre>');

*/
      if(!$data['promocion'])
      {
         die('promocion no existente');
      }

      $idCategoria= $data['promocion']['CAT_ID'];
      $idSubCategoria= $data['promocion']['SUB_ID'];
      $idTienda= $data['promocion']['PRO_USER_CREADOR'];
      $idMarca= $data['promocion']['MAR_ID'];

      $data['categoria'] = $this->pendientes_model->getCategoriaId($idCategoria);
      $data['subcategoria'] = $this->pendientes_model->getSubCategoriaId($idSubCategoria);      
      $data['tienda'] = $this->pendientes_model->getTiendaId($idTienda);      
      $data['marca'] = $this->pendientes_model->getMarcaId($idMarca);      
/*
getCategoriaId
getSubCategoriaId
getTiendaId
getMarcaId

      */
      //  $data['promocion'] = $this->pendientes_model->getPromocion($id);

      $this->load->view('vista_previa_promociones_base',$data);
      return;

  }




}

