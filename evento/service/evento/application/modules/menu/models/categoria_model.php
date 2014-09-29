<?php

class categoria_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    function categorias() {

        $this->db->select('*');
        $this->db->from('CAT_CATEGORIA');
   
        $query = $this->db->get();

        if ($query->num_rows() > 0)                
            return $query->result_array();

        return NULL;
        
    }

    function categoriasFija() {

        $this->db->select('*');
        $this->db->from('CAT_CATEGORIA');
        $this->db->where('VISIBILITY', '0');
   
        $query = $this->db->get();

        if ($query->num_rows() > 0)                
            return $query->result_array();

        return NULL;
        
    }
    function categoriasSubMenu() {

        $this->db->select('*');
        $this->db->from('CAT_CATEGORIA');
        $this->db->where('VISIBILITY', '1');
        $this->db->order_by("CAT_NOMBRE", "asc");
   
        $query = $this->db->get();

        if ($query->num_rows() > 0)                
            return $query->result_array();

        return NULL;
        
    }

    function subCategorias() {

        $this->db->select('*');
        $this->db->from('SUB_SUBCATEGORIA');
        $this->db->order_by("SUB_NOMBRE", "asc");
          
        $query = $this->db->get();

        if ($query->num_rows() > 0)                
             return $query->result_array();

        return NULL;        
    }


  function subCategoriasLibrePromocion($catId) {

        $query =  $this->db->query('SELECT * 
                                    FROM SUB_SUBCATEGORIA SUB 
                                    WHERE SUB_ID IN (SELECT PRO.SUB_ID 
                                                        FROM  PRO_PROMOCIONES PRO 
                                                        WHERE PRO.CAT_ID='.$catId.')');    
        if ($query->num_rows() > 0)                
             return $query->result_array();

        return NULL;        
    }


    function existCategoria($slug='') {

        
        $this->db->where('CAT_SLUG', $slug);
        $this->db->from('CAT_CATEGORIA');
     
        if ($this->db->count_all_results() > 0)
        {
                return true;  
        }
        else
        {
                return false;  
        }           
        
      }
     

}