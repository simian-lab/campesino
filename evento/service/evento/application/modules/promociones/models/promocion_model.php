<?php
class promocion_model extends CI_Model {

  function __construct() {
    // Call the Model constructor
    parent::__construct();

    $this->load->library('memcached_library');
  }

  function get($idtipo='2', $seed=1, $cant='0', $offset='0', $idPromosRepetido='') {

    $key_memcached_funcion_get = 'funcion_get_'.ID_EVENTO.'_'.$idPromosRepetido.'_'.$idtipo;
    $result_memcached_funcion_get = $this->memcached_library->get($key_memcached_funcion_get);

  if(!$result_memcached_funcion_get) {
      $this->db->select('*');
      $this->db->from('PRO_PROMOCIONES');
      $this->db->where('PRO_PROMOCIONES.VISIBILITY', '1');
      $this->db->where('PRO_PROMOCIONES.AUTORIZADO', '1');
      //$this->db->where('PRO_SRC_ID', $idtipo);
      $this->db->where_in('PRO_SRC_ID', $idtipo);
      if(!empty($idPromosRepetido))
        $this->db->where_not_in('PRO_ID', $idPromosRepetido);
      $this->db->join('TIE_TIENDAS', 'TIE_TIENDAS.TIE_ID_USER = PRO_PROMOCIONES.PRO_USER_CREADOR');
  	$this->db->join('PAT_PATROCINADORES', 'PAT_PATROCINADORES.PAT_ALIADO = PRO_PROMOCIONES.PRO_USER_CREADOR');
      $this->db->join('EXP_EVENTOXPROMOCION', 'EXP_EVENTOXPROMOCION.EXP_PROMOCION = PRO_PROMOCIONES.PRO_ID');
      $this->db->where('EXP_EVENTOXPROMOCION.EXP_EVENTO', ID_EVENTO);

      $this->db->order_by("PRO_SRC_ID DESC ,RAND(".$seed.")",'',FALSE);
      //$this->db->order_by("PRO_FECHA",'desc', FALSE);
      $this->db->limit($cant,$offset);

      $query = $this->db->get();
      //print_r($this->db->last_query());die();
      if ($query->num_rows() > 0){
        $this->memcached_library->add($key_memcached_funcion_get, $query->result_array(), MEMCACHED_LIVE_TIME);
        return $query->result_array();
      }

    }

    return $result_memcached_funcion_get;

    return NULL;
  }

  /*function get_tienda_id($id_user){
    $this->db->select('*');
    $this->db->from('TIE_TIENDAS');
    $this->db->where('TIE_ID_USER', $id_user);
    $query = $this->db->get();
    if ($query->num_rows() > 0)
    return $query->result_array();

    return NULL;

  }*/

  function getFiltro($idtipo='2',$categoria='todos',$tienda='tiendas',$marca='marcas',$subcategoria='todos',$seed=1,$cant='0',$offset='0',$idPromosRepetido='') {

    $key_memcached_getFiltro = 'funcion_getFiltro_'.ID_EVENTO.'_'.$idPromosRepetido.'_'.$idtipo.'_'.$categoria.'_'.$tienda.'_'.$marca.'_'.$subcategoria;
    $result_memcached_getFiltro = $this->memcached_library->get($key_memcached_getFiltro);
    if(!$result_memcached_getFiltro) {
    $this->db->select('*');
    $this->db->from('PRO_PROMOCIONES');
    $this->db->where('PRO_PROMOCIONES.VISIBILITY', '1');
    $this->db->where('PRO_PROMOCIONES.AUTORIZADO', '1');
    $this->db->where_in('PRO_SRC_ID', $idtipo);
    $this->db->join('TIE_TIENDAS', 'TIE_TIENDAS.TIE_ID_USER = PRO_PROMOCIONES.PRO_USER_CREADOR');
	$this->db->join('PAT_PATROCINADORES', 'PAT_PATROCINADORES.PAT_ALIADO = PRO_PROMOCIONES.PRO_USER_CREADOR');
    $this->db->join('EXP_EVENTOXPROMOCION', 'EXP_EVENTOXPROMOCION.EXP_PROMOCION = PRO_PROMOCIONES.PRO_ID');
    $this->db->where('EXP_EVENTOXPROMOCION.EXP_EVENTO', ID_EVENTO);

    if($categoria!='todos')
      $this->db->where('CAT_ID', $categoria);

    if($tienda!='tiendas')
      $this->db->where('PRO_USER_CREADOR', $tienda);

    if($marca!='marcas')
      $this->db->where('MAR_ID', $marca);

    if($subcategoria!='todos')
      $this->db->where('SUB_ID', $subcategoria);

    if(!empty($idPromosRepetido))
      $this->db->where_not_in('PRO_ID', $idPromosRepetido);

    $this->db->order_by("PRO_SRC_ID DESC ,RAND(".$seed.")",'',FALSE);
    //$this->db->order_by("PRO_FECHA",'desc', FALSE);
    $this->db->limit($cant,$offset);

    $query = $this->db->get();

    if ($query->num_rows() > 0){
      $this->memcached_library->add($key_memcached_getFiltro, $query->result_array(), MEMCACHED_LIVE_TIME);
      return $query->result_array();
    }

   }

    return $result_memcached_getFiltro;

    return NULL;
  }


  //$tienda='todos',$marca='todos',$subcategoria='todos'

  function getCategoriaSlug($slug) {
    $this->db->select('CAT_ID');
    $this->db->from('CAT_CATEGORIA');
    $this->db->where('CAT_SLUG', $slug);
    $this->db->limit(1);

    $query = $this->db->get();

    if ($query->num_rows() > 0)
      return $query->row_array();

    return NULL;
  }

  function getSubCategoriaSlug($slug) {
    $this->db->select('SUB_ID');
    $this->db->from('SUB_SUBCATEGORIA');
    $this->db->where('SUB_SLUG', $slug);
    $this->db->limit(1);

    $query = $this->db->get();

    if ($query->num_rows() > 0)
      return $query->row_array();

    return NULL;
  }

  function getTiendaSlug($slug) {
    $this->db->select('TIE_ID_USER');
    $this->db->from('TIE_TIENDAS');
    $this->db->where('TIE_SLUG', $slug);
    $this->db->limit(1);

    $query = $this->db->get();

    if ($query->num_rows() > 0)
      return $query->row_array();

    return NULL;
  }

  function getMarcaSlug($slug) {
    $key_memcached_getMarcaSlug = 'funcion_getMarcaSlug_'.ID_EVENTO.'_'.$slug;
    $result_memcached_getMarcaSlug = $this->memcached_library->get($key_memcached_getMarcaSlug);

    if(!$result_memcached_getMarcaSlug) {
      $this->db->select('MAR_ID ');
      $this->db->from('MAR_MARCAS');
      $this->db->where('MAR_SLUG', $slug);
      $this->db->limit(1);

      $query = $this->db->get();

      if ($query->num_rows() > 0){
       $this->memcached_library->add($key_memcached_getMarcaSlug, $query->row_array(), MEMCACHED_LIVE_TIME);
       return $query->row_array();
      }
    }

    return $result_memcached_getMarcaSlug;

    return NULL;
  }

  public function get_tiendas() {
    $key_memcached_get_tiendas = 'funcion_get_tiendas_'.ID_EVENTO;
    $result_memcached_get_tiendas = $this->memcached_library->get($key_memcached_get_tiendas);

    if(!$result_memcached_get_tiendas) {
      $this->db->select('*');
      $this->db->from('TIE_TIENDAS');
      $this->db->where('VISIBILITY', '1');
      $this->db->order_by("TIE_NOMBRE", "asc");

      $query = $this->db->get();


      if ($query->num_rows() > 0){
       $this->memcached_library->add($key_memcached_get_tiendas, $query->result_array(), MEMCACHED_LIVE_TIME);
       return $query->result_array();
      }
    }

    return $result_memcached_get_tiendas;

    return NULL;
  }


  public function get_marcas() {
    $key_memcached_get_marcas = 'funcion_get_marcas_'.ID_EVENTO;
    $result_memcached_get_marcas = $this->memcached_library->get($key_memcached_get_marcas);

    if(!$result_memcached_get_marcas) {
      $this->db->select('*');
      $this->db->from('MAR_MARCAS');
      $this->db->where('VISIBILITY', '1');
      $this->db->order_by("MAR_NOMBRE", "asc");

      $query = $this->db->get();

      if ($query->num_rows() > 0){
       $this->memcached_library->add($key_memcached_get_marcas, $query->result_array(), MEMCACHED_LIVE_TIME);
       return $query->result_array();
      }
    }

    return $result_memcached_get_marcas;

    return NULL;
  }

  public function get_subcategorias($slug) {

    $key_memcached_get_subcategorias = 'funcion_get_subcategorias_'.ID_EVENTO.'_'.$slug;
    $result_memcached_get_subcategorias = $this->memcached_library->get($key_memcached_get_subcategorias);

    if(!$result_memcached_get_subcategorias) {
      $this->db->select('*');
      $this->db->from('SUB_SUBCATEGORIA');
      $this->db->join('SXC_SUBCATEGORIAXCATEGORIA', 'SXC_SUBCATEGORIAXCATEGORIA.SUB_ID = SUB_SUBCATEGORIA.SUB_ID');
      $this->db->join('CAT_CATEGORIA', 'CAT_CATEGORIA.CAT_ID = SXC_SUBCATEGORIAXCATEGORIA.CAT_ID');
      $this->db->where('CAT_CATEGORIA.CAT_SLUG = "'.$slug.'" AND SUB_SUBCATEGORIA.VISIBILITY = 1');
      $this->db->order_by("SUB_SUBCATEGORIA.SUB_NOMBRE", "asc");

      $query = $this->db->get();

      if ($query->num_rows() > 0){
       $this->memcached_library->add($key_memcached_get_subcategorias, $query->result_array(), MEMCACHED_LIVE_TIME);
       return $query->result_array();
      }
    }

    return $result_memcached_get_subcategorias;

    return NULL;
  }

  function get_marcas_by_tienda($tienda='tiendas',$idPromosRepetido='') {

    $key_memcached_marcas_hfx = $tienda.'_'.$idPromosRepetido;
    $result_memcached_marcas_hfx = $this->memcached_library->get($key_memcached_marcas_hfx);

    if(!$result_memcached_marcas_hfx) {
      $this->db->select('MAR_NOMBRE,MAR_SLUG');
      $this->db->distinct();
      $this->db->from('PRO_PROMOCIONES');
      $this->db->where('PRO_PROMOCIONES.VISIBILITY', '1');
      $this->db->where('PRO_PROMOCIONES.AUTORIZADO', '1');
      $this->db->join('MAR_MARCAS', 'MAR_MARCAS.MAR_ID = PRO_PROMOCIONES.MAR_ID');
      $this->db->join('TIE_TIENDAS', 'TIE_TIENDAS.TIE_ID_USER = PRO_PROMOCIONES.PRO_USER_CREADOR');

      if($tienda!='tiendas')
        $this->db->where('PRO_USER_CREADOR', $tienda);

      $this->db->where('MAR_SLUG !=', 'no-aplica');
      if(!empty($idPromosRepetido))
        $this->db->where_not_in('PRO_ID', $idPromosRepetido);

      $this->db->order_by("MAR_NOMBRE", "asc");
      $query = $this->db->get();

      $result = $query->result_array();

      $this->memcached_library->add($key_memcached_marcas_hfx, $result, MEMCACHED_LIVE_TIME);
      return $result;
    }

    return $result_memcached_marcas_hfx;

    return NULL;
  }

  function getByHash($hash) {
    $key_memcached_getByHash = 'funcion_getByHash_'.ID_EVENTO.'_'.$hash;
    $result_memcached_getByHash = $this->memcached_library->get($key_memcached_getByHash);

    if(!$result_memcached_getByHash) {
      $this->db->select('PRO_ID,PRO_NOMBRE,PRO_HASH,PRO_URL');
      $this->db->from('PRO_PROMOCIONES');
      $this->db->where('PRO_HASH', $hash);
      $this->db->limit(1);

      $query = $this->db->get();

      if ($query->num_rows() > 0){
       $this->memcached_library->add($key_memcached_getByHash, $query->row_array(), MEMCACHED_LIVE_TIME);
       return $query->row_array();
      }
    }

    return $result_memcached_getByHash;

    return NULL;

  }
}
