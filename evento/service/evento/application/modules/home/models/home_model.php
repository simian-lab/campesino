<?php

class Home_model extends CI_Model {

  public function get_patrocinadores() {
    $sql = "CALL AB_PATROCINADORES_GET()";

    $query = $this->db->query($sql); //->row_array();
    return $query->result();
  }
}