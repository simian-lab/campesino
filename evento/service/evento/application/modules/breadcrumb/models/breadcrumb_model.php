<?php

class breadcrumb_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    
     public function get_categoria($slug){
        $this->db->select('*');
        $this->db->from('CAT_CATEGORIA');
        $this->db->where('CAT_SLUG', $slug);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            $row = $query->row(); 
            return $row->CAT_NOMBRE;
        }

        return NULL;
     }

     public function get_tienda($slug){
        $this->db->select('*');
        $this->db->from('TIE_TIENDAS');
        $this->db->where('TIE_SLUG', $slug);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            $row = $query->row(); 
            return $row->TIE_NOMBRE;
        }

        return NULL;
     }

     public function get_marca($slug){
        $this->db->select('*');
        $this->db->from('MAR_MARCAS');
        $this->db->where('MAR_SLUG', $slug);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            $row = $query->row(); 
            return $row->MAR_NOMBRE;
        }

        return NULL;
     }

     public function get_subcategoria($slug){
        $this->db->select('*');
        $this->db->from('SUB_SUBCATEGORIA');
        $this->db->where('SUB_SLUG', $slug);
        $query = $this->db->get();

        if($query->num_rows() > 0){
            $row = $query->row(); 
            return $row->SUB_NOMBRE;
        }

        return NULL;
     }

}