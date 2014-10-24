<?php

class Home_model extends CI_Model {
    
    public function get_pautas(){


        $sql = "CALL AB_PAU_PAUTAS_GET_PREEVENTO()";

        $query = $this->db->query($sql); //->row_array();
        return $query->result();

    }


    public function get_count_pautas(){

        $sql = 'CALL AB_PAU_PAUTAS_CANT()';

        $query = $this->db->query($sql);
        return $query->result();

    }


    public function get_patrocinadores(){

        $sql = "CALL AB_PATROCINADORES_GET()";

        $query = $this->db->query($sql); //->row_array();
        return $query->result();

    }


    public function get_articulos($art_slug = NULL, $inicio, $fin = 6){

        $param = array(

                $art_slug,
                $inicio,
                $fin

            );

        $sql = "CALL AB_ARTICULOS_GET(?,?,?)";

        $query = $this->db->query($sql, $param); //->row_array();
        return $query->result();

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

    public function get_titulo_slug($slug){

        $this->db->select();
        $this->db->from('ART_ARTICULOS');
        $this->db->where('ART_SLUG', $slug);

        $query = $this->db->get();

        return $query->row_array();

    }



}