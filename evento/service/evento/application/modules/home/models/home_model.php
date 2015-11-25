<?php

class Home_model extends CI_Model {

  public function get_patrocinadores() {
    $sql = "CALL AB_PATROCINADORES_GET()";

    $query = $this->db->query($sql); //->row_array();
    return $query->result();
  }

  function getByHash($hash) {
    // We mask the PAT_URL_EVENT AS PRO_URL to make it easier to handle
    // when working with it in redireccionamiento.php
    $this->db->select('PAT_ID,PAT_NOMBRE,PAT_HASH_URL_EVENT,PAT_URL_EVENT AS PRO_URL, OMNITURE_ID');
    $this->db->from('PAT_PATROCINADORES');
    $this->db->where('PAT_HASH_URL_EVENT', $hash);
    $this->db->limit(1);

    $query = $this->db->get();

    if ($query->num_rows() > 0)
      return $query->row_array();

    return NULL;
  }
}