<?php

class formulario_lyris_model extends CI_Model {

	function verifiy_insert($nombre, $email, $intereses){

		$this->db->select();
		$this->db->from('REG_REGISTRADO');
		$this->db->where('REG_EMAIL', $email);
		$query = $this->db->get();

		$result = $query->row_array();

		if(!empty($result)){
			$this->update($nombre, $email, $intereses);
		}
		else{
			$this->insert($nombre, $email, $intereses);	
		}

	}

	function insert($nombre, $email, $intereses){
		$data = array(
				'REG_NOMBRE'	=>	$nombre, 
				'REG_EMAIL'	    =>	$email, 
				'REG_INTERESES'	=>	$intereses
			);

		$this->db->insert('REG_REGISTRADO', $data);

		if($this->db->affected_rows() > 0){
		  	return 0;
		}
	}

	function update($nombre, $email, $intereses){
		$data = array(
				'REG_NOMBRE'	=>	$nombre, 
				'REG_EMAIL'	    =>	$email, 
				'REG_INTERESES'	=>	$intereses
			);

		$this->db->where('REG_EMAIL', $email);
		$this->db->update('REG_REGISTRADO', $data);

		if($this->db->affected_rows() > 0){
		  	return 0;
		}
	}

}