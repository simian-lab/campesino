<?php

class pautas_model extends CI_Model {
    var $categoria_novedades;
    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();

        $this->categoria_novedades= $this->config->item('categoria_novedades');
    }

    function get_articulos_home($ART_ID=null){
        $param = array(
            $ART_ID
        );

        $sql = "CALL AB_ARTICULOS_GET(?)";

        $query = $this->db->query($sql, $param); //->row_array();
        return $query->result_array();
        
    }

/*
 function get_patrocinadores(){

    $sql = "CALL AB_PATROCINADORES_GET()";

    $query = $this->db->query($sql); //->row_array();
    return $query->result_array();
   
 }
*/
 function get_pauta($PAU_ID){

        $this->db->select('*');
        $this->db->from('PAU_PAUTAS');
        $this->db->where('PAU_ID', $PAU_ID);


        $query = $this->db->get();

        if ($query->num_rows() > 0)                
            return $query->result_array();

        return NULL;
 }
 
 function get_tagsxpautas($PAU_ID){

        $param = array(
            $PAU_ID
        );

        $sql = "CALL AB_TAGSXPAUTAS(?)";

        $query = $this->db->query($sql, $param); //->row_array();
        return $query->result_array();
 }
 
 function get_pautasxslug($PAU_SLUG){

        $param = array(
            $PAU_SLUG
        );

        $sql = "CALL AB_TAG_SLUG_GET(?)";

        $query = $this->db->query($sql, $param); //->row_array();
        return $query->result_array();
 }
 function get_pautaxslug($PAU_SLUG){

        $this->db->select('*');
        $this->db->from('PAU_PAUTAS');
        $this->db->where('PAU_SLUG', $PAU_SLUG);


        $query = $this->db->get();

        if ($query->num_rows() > 0)                
            return $query->row_array();

        return NULL;
 }

    function get_pautas_destacados() {
           $this->db->select('*');
           $this->db->from('PAU_PAUTAS');
           $this->db->where('VISIBILITY', '1');
           $this->db->where('PAU_EVENTO', '1');
           $this->db->where('PAU_DESTACADO', '1');

           
           $query = $this->db->get();

           if ($query->num_rows() > 0)                
                return $query->result_array();

           return NULL;
        
    }    

    function get_pautas_all($cant=0,$offset=0) {
           $this->db->select('*');
           $this->db->from('PAU_PAUTAS');
           $this->db->where('VISIBILITY', '1');
           $this->db->where('PAU_EVENTO', '1');
           $this->db->limit($cant,$offset);
           
           $query = $this->db->get();

           if ($query->num_rows() > 0)                
                return $query->result_array();

           return NULL;
        
    }

    function get_pautas_carousel($PAU_ID){
        $param = array(
            $PAU_ID
        );


        $sql = "CALL AB_PAUTAS_CARUSEL_GET(?)";

        $query = $this->db->query($sql, $param); //->row_array();
        return $query->result_array();        

    }

    function get_articulos_x_marca_pais($ART_ID){
        $param = array(
            $ART_ID
        );


        $sql = "CALL AB_ARTICULOS_GET_MARCA_SLUG(?)";

        $query = $this->db->query($sql, $param); //->row_array();
        return $query->result_array();        

     }

     function get_nota($ART_SLUG){
            $param = array(
                $ART_SLUG
            );

            $sql = "CALL AB_ARTICULOS_GET_SLUG(?)";

            $query = $this->db->query($sql, $param); //->row_array();
            return $query->row_array();

     }



      function get_recomendados($ART_ID){
             $param = array(
                 $ART_ID
             );

             $sql = "CALL AB_CARGAR_ARTICULOS3_ULTIMATED(?)";

             $query = $this->db->query($sql, $param); //->row_array();
             return $query->result_array();

      }

    function get_patrocinadores($id){

        $this->db->select('*');
        $this->db->from('PAT_PATROCINADORES');
        $this->db->join('PXP_PAUTAXPATROCINADOR', 'PAT_PATROCINADORES.PAT_ID = PXP_PAUTAXPATROCINADOR.PAT_ID');
        $this->db->where('PXP_PAUTAXPATROCINADOR.PAU_ID', $id);
        $this->db->order_by("PXP_PAUTAXPATROCINADOR.PXP_ID");
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() > 0)                
            return $query->row_array();

        return NULL;
    }

}