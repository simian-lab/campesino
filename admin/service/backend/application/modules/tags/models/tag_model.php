<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tag_model extends CI_Model
{

  	public function __construct()
  	{
  		parent::__construct();
  	}
  		


    public function insert_tag($ident,$primary_key){

           $data = array(
                       'TAG_ARTICULO_ID' => $primary_key,
                       'TAG_USER_CREADOR' => $ident,
                        'TAG_USER_ULTIMO' => $ident,
                        'TAG_FECHA' => date('y-m-d'),
                        'AUTORIZADO' => 0 ,
                        'TAGS_ID' => 6 ,
                        'VISIBILITY' => 0
                );

           $results = $this->db->insert('TAG_ARTICULOS', $data); 

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
