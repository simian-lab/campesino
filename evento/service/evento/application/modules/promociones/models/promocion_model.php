<?php
class promocion_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }


   function get($idtipo='2',$seed=1,$cant='0',$offset='0',$idPromosRepetido='') {
           $this->db->select('*');
           $this->db->from('PRO_PROMOCIONES');
           $this->db->where('PRO_PROMOCIONES.VISIBILITY', '1');
           $this->db->where('PRO_PROMOCIONES.AUTORIZADO', '1');
           //$this->db->where('PRO_SRC_ID', $idtipo);
           $this->db->where_in('PRO_SRC_ID', $idtipo);
           if(!empty($idPromosRepetido))
                $this->db->where_not_in('PRO_ID', $idPromosRepetido);
           $this->db->join('TIE_TIENDAS', 'TIE_TIENDAS.TIE_ID_USER = PRO_PROMOCIONES.PRO_USER_CREADOR');

           $this->db->order_by("PRO_SRC_ID DESC ,RAND(".$seed.")",'',FALSE);
           //$this->db->order_by("PRO_FECHA",'desc', FALSE);
           $this->db->limit($cant,$offset);
           
           $query = $this->db->get();
           //print_r($this->db->last_query());die();
           if ($query->num_rows() > 0)                
                return $query->result_array();

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
           $this->db->select('*');
           $this->db->from('PRO_PROMOCIONES');
           $this->db->where('PRO_PROMOCIONES.VISIBILITY', '1');
           $this->db->where('PRO_PROMOCIONES.AUTORIZADO', '1');
           $this->db->where_in('PRO_SRC_ID', $idtipo);
           $this->db->join('TIE_TIENDAS', 'TIE_TIENDAS.TIE_ID_USER = PRO_PROMOCIONES.PRO_USER_CREADOR');
           
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

           if ($query->num_rows() > 0)                
                return $query->result_array();

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
            $this->db->select('MAR_ID ');
            $this->db->from('MAR_MARCAS');
            $this->db->where('MAR_SLUG', $slug);            
            $this->db->limit(1);
           
            $query = $this->db->get();

            if ($query->num_rows() > 0)                
                return $query->row_array();

            return NULL;
        
    }
   


    public function get_tiendas(){

           $this->db->select('*');
           $this->db->from('TIE_TIENDAS');
           $this->db->where('VISIBILITY', '1');
           $this->db->order_by("TIE_NOMBRE", "asc");

           $query = $this->db->get();

           if ($query->num_rows() > 0)                
                return $query->result_array();

            return NULL;

    }


    public function get_marcas(){

        $this->db->select('*');
        $this->db->from('MAR_MARCAS');
        $this->db->where('VISIBILITY', '1');
        $this->db->order_by("MAR_NOMBRE", "asc"); 

           $query = $this->db->get();

           if ($query->num_rows() > 0)                
                return $query->result_array();

            return NULL;

    }

    public function get_subcategorias($slug){

        $this->db->select('*');
        $this->db->from('SUB_SUBCATEGORIA');
        $this->db->join('SXC_SUBCATEGORIAXCATEGORIA', 'SXC_SUBCATEGORIAXCATEGORIA.SUB_ID = SUB_SUBCATEGORIA.SUB_ID');
        $this->db->join('CAT_CATEGORIA', 'CAT_CATEGORIA.CAT_ID = SXC_SUBCATEGORIAXCATEGORIA.CAT_ID');
        $this->db->where('CAT_CATEGORIA.CAT_SLUG = "'.$slug.'" AND SUB_SUBCATEGORIA.VISIBILITY = 1'); 
        $this->db->order_by("SUB_SUBCATEGORIA.SUB_NOMBRE", "asc"); 

           $query = $this->db->get();

           if ($query->num_rows() > 0)                
                return $query->result_array();

            return NULL;

    }

    function getByHash($hash) {
        $this->db->select('PRO_ID,PRO_NOMBRE,PRO_HASH,PRO_URL');
        $this->db->from('PRO_PROMOCIONES');
        $this->db->where('PRO_HASH', $hash);            
        $this->db->limit(1);
       
        $query = $this->db->get();

        if ($query->num_rows() > 0)                
            return $query->row_array();

        return NULL;
        
    }



}
