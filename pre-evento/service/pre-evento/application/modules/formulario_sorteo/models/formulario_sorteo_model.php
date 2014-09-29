<?php

class Formulario_sorteo_model extends CI_Model {


    public function get_patrocinadores(){

        $sql = "CALL AB_PATROCINADORES_GET()";

        $query = $this->db->query($sql); //->row_array();
        return $query->result();

    }

    public function insert_participantes($nombre, $direccion, $email, $cel, $tiendas, $factura){

    	$param = array(

    			$nombre,
                $direccion,
                $email,
                $cel,
                $tiendas,
                $factura

    		);

		$sql = "CALL AB_US_USUARIOS_SORTEO_SET(?,?,?,?,?,?)";

		$query = $this->db->query($sql, $param); //->row_array();
        return $query->result();


    }


    public function get_tiendas(){

        $sql = "CALL AB_TIENDAS_GET()";
        
        $query = $this->db->query($sql); //->row_array();
        return $query->result();
    }

}