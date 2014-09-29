<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Marcas_model extends CI_Model
{

  	public function __construct()
  	{
  		parent::__construct();
  	}
  		

  function control_tag($pUSER_ID){
    $param = array(
       $pUSER_ID  // ,pUSER_ID INT
    );

    $sql = "CALL AB_TAGS_NOMBRES_INSERT(?)";
    $query = $this->db->query($sql, $param);  
    return $query->result_array();
}


}
