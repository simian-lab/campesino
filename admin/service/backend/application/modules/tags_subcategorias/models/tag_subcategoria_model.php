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

    function get_subcategorias_promociones($cat_id){
      $this->db->select('SUB_SUBCATEGORIA.SUB_ID, SUB_NOMBRE');
      $this->db->from('SUB_SUBCATEGORIA');
      $this->db->join('SXC_SUBCATEGORIAXCATEGORIA', 'SXC_SUBCATEGORIAXCATEGORIA.SUB_ID = SUB_SUBCATEGORIA.SUB_ID');
      $this->db->where('SXC_SUBCATEGORIAXCATEGORIA.CAT_ID',$cat_id);

      $query = $this->db->get();
      if ($query->num_rows() > 0)  {
        foreach ($query->result() as $row){
          $salida[$row->SUB_ID]=$row->SUB_NOMBRE;
        }
      }
      else{
        $salida = ' ';
      }
      echo json_encode($salida);
    }


}
