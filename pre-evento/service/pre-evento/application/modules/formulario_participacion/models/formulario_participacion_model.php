<?php

class Formulario_participacion_model extends CI_Model {


    public function get_patrocinadores(){

        $sql = "CALL AB_PATROCINADORES_GET()";

        $query = $this->db->query($sql); //->row_array();
        return $query->result();

    }

    public function insert_participantes(){

    	$param = array(

    			$this->input->post('nombre_empresa'),
    			$this->input->post('nombre_contacto'),
    			$this->input->post('cargo'),
    			$this->input->post('email'),
    			$this->input->post('celular'),
    			$this->input->post('telefono'),
    			$this->input->post('url'),
    			$this->input->post('comentarios')

    		);

		$sql = "CALL AB_US_USUARIOS_PARTICIPACION_SET(?,?,?,?,?,?,?,?)";

		$query = $this->db->query($sql, $param); //->row_array();
        return $query->result();


    }

}