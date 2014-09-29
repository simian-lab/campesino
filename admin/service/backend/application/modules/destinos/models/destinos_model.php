<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Destinos_model extends CI_Model
{

  	public function __construct()
  	{
  		parent::__construct();
  	}
  		


function control_destinos($pUSER_ID){
  $param = array(
     $pUSER_ID  // ,pUSER_ID INT
  );

  $sql = "CALL AB_SUBCATEGORIA_INSERT(?)";
  $query = $this->db->query($sql, $param);  
  return $query->result_array();
}


}
