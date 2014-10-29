<?php

class lista_blanca_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }
    function get() {

        $this->db->select('LBD_DOMINIO');
        $this->db->from('LBD_LISTA_BLANCA_DOMINIOS');
   
        $query = $this->db->get();

        if ($query->num_rows() > 0)                
            return $query->result_array();

        return NULL;
   }

    
  

}