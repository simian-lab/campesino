<?php
class promocion_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }


   function get($idtipo='2',$seed=1,$cant='0',$offset='0') {
           $this->db->select('*');
           $this->db->from('PRO_PROMOCIONES');
           $this->db->where('PRO_PROMOCIONES.VISIBILITY', '1');
           $this->db->where('PRO_PROMOCIONES.AUTORIZADO', '1');
           $this->db->where('PRO_SRC_ID', $idtipo);

           $this->db->order_by("PRO_SRC_ID DESC ,RAND(".$seed.")",'',FALSE);
           $this->db->limit($cant,$offset);
           
           $query = $this->db->get();

           if ($query->num_rows() > 0)                
                return $query->result_array();

            return NULL;
        
    }

    function getcategoria($idtipo='2',$valor,$seed=1,$cant='0',$offset='0') {
           $this->db->select('*');
           $this->db->from('PRO_PROMOCIONES');
           $this->db->join('CAT_CATEGORIA', 'PRO_PROMOCIONES.CAT_ID = CAT_CATEGORIA.CAT_ID');
           $this->db->where('PRO_PROMOCIONES.VISIBILITY', '1');
           $this->db->where('PRO_PROMOCIONES.AUTORIZADO', '1');
           $this->db->where('PRO_SRC_ID', $idtipo);
           $this->db->where('CAT_CATEGORIA.CAT_SLUG', $valor);
           $this->db->order_by("PRO_SRC_ID DESC ,RAND(".$seed.")",'',FALSE);
           $this->db->limit($cant,$offset);
           
           $query = $this->db->get();

           if ($query->num_rows() > 0)                
                return $query->result_array();

            return NULL;
        
    }

    function getpormarcas($idtipo='2',$valor,$seed=1,$cant='0',$offset='0'){
           $this->db->select('*');
           $this->db->from('PRO_PROMOCIONES');
           $this->db->join('MAR_MARCAS', 'PRO_PROMOCIONES.MAR_ID = MAR_MARCAS.MAR_ID');
           $this->db->where('PRO_PROMOCIONES.VISIBILITY', '1');
           $this->db->where('PRO_PROMOCIONES.AUTORIZADO', '1');
           $this->db->where('PRO_SRC_ID', $idtipo);
           $this->db->where('MAR_MARCAS.MAR_NOMBRE', $valor);
           $this->db->order_by("PRO_SRC_ID DESC ,RAND(".$seed.")",'',FALSE);
           $this->db->limit($cant,$offset);
           
           $query = $this->db->get();

           if ($query->num_rows() > 0)                
                return $query->result_array();

            return NULL;
    }

    function getcategoriaSubcategoria($idtipo='2',$valor,$subcategoria,$seed=1,$cant='0',$offset='0') {
           $this->db->select('*');
           $this->db->from('PRO_PROMOCIONES');
           $this->db->join('SUB_SUBCATEGORIA', 'PRO_PROMOCIONES.SUB_ID = SUB_SUBCATEGORIA.SUB_ID');
           $this->db->join('CAT_CATEGORIA', 'PRO_PROMOCIONES.CAT_ID = CAT_CATEGORIA.CAT_ID');
           $this->db->where('PRO_PROMOCIONES.VISIBILITY', '1');
           $this->db->where('PRO_PROMOCIONES.AUTORIZADO', '1');
           $this->db->where('PRO_SRC_ID', $idtipo);
           $this->db->where('CAT_CATEGORIA.CAT_SLUG', $valor);
           $this->db->where('SUB_SUBCATEGORIA.SUB_SLUG', $subcategoria);
           $this->db->order_by("PRO_SRC_ID DESC ,RAND(".$seed.")",'',FALSE);
           $this->db->limit($cant,$offset);
           
           $query = $this->db->get();

           if ($query->num_rows() > 0)                
                return $query->result_array();

            return NULL;
        
    }


    public function get_tiendas(){

           $this->db->select('*');
           $this->db->from('TIE_TIENDAS');
//           $this->db->where('VISIBILITY', '1');

           $query = $this->db->get();

           if ($query->num_rows() > 0)                
                return $query->result_array();

            return NULL;

    }


    public function get_marcas(){

        $this->db->select('*');
           $this->db->from('MAR_MARCAS');
//           $this->db->where('VISIBILITY', '1');

           $query = $this->db->get();

           if ($query->num_rows() > 0)                
                return $query->result_array();

            return NULL;

    }

}
