<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aliado_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

  function control_aliado($pUSER_ID){
    $param = array(
       $pUSER_ID  // ,pUSER_ID INT
    );

    $sql = "CALL AB_PATROCINADORES_INSERT(?)";
    $query = $this->db->query($sql, $param);
    return $query->result_array();
  }

  function get_store_id($user_id) {
    $param = array($user_id);
    $sql = "CALL GET_USER_STORE_ID(?)";
    $query = $this->db->query($sql, $param);
    return $query->result_array();
  }
}
