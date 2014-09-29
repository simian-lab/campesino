<?php

class Articulos_model extends CI_Model {
    
    
    public function get_categorias($cat_id = NULL){

        $param = array(

                $cat_id

            );

        $sql = "CALL AB_CAT_CATEGORIA_GET(?)";

        $query = $this->db->query($sql, $param); //->row_array();
        return $query->result();

    }


    public function get_patrocinadores(){

        $sql = "CALL AB_PATROCINADORES_GET()";

        $query = $this->db->query($sql); //->row_array();
        return $query->result();

    }


    public function get_articulos($art_slug = NULL,  $fin = 8,$inicio){

        $param = array(

                $art_slug,
                $inicio,
                $fin

            );

        $sql = "CALL AB_ARTICULOS_GET(?,?,?)";

        $query = $this->db->query($sql, $param); //->row_array();
        

        if ($query->num_rows() > 0)                
           return $query->result_array();
    }

    public function get_articulos_recomendados(){

        $sql = "CALL AB_ARTICULOS_ULTIMOS_X3()";

        $query = $this->db->query($sql); //->row_array();
        return $query->result();

    }

    public function get_count_articulos(){

        $sql = 'CALL AB_ART_ARTICULOS_CANT()';

        $query = $this->db->query($sql);
        return $query->result();

    }


    public function get_tiendas(){

        $sql = "CALL AB_COMBO_TIENDAS_GET()";

        $query = $this->db->query($sql); //->row_array();
        return $query->result();

    }


    public function get_marcas(){

        $sql = "CALL AB_COMBO_MARCAS_GET()";

        $query = $this->db->query($sql); //->row_array();
        return $query->result();

    }


}