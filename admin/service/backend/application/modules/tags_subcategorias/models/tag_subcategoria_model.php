<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tag_subcategoria_model extends CI_Model
{

  	public function __construct()
  	{
  		parent::__construct();
  	}
  		


    public function get_categorias(){

      $this->db->select('CAT_NOMBRE, CAT_ID');
      $this->db->from('CAT_CATEGORIA');

      $results = $this->db->get();
      $salida= array();
      if ($results->num_rows() > 0)  {
      foreach ($results->result() as $row)
      {
          $salida[$row->CAT_NOMBRE]=$row->CAT_NOMBRE.' ( '.$row->CAT_ID.' )';
         
      }

      }else{

          $salida[""]=' ( SIN  CATEGORIAS)'; 
      }
        

       
      return  $salida;

    }


}
