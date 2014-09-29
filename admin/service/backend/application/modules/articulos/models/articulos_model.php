<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Articulos_model extends CI_Model
{

  	public function __construct()
  	{
  		parent::__construct();
  	}
  		

  	public function update_tag_articulos($ident,$primary_key){

            $data = array(
                           'TAG_USER_CREADOR' => $ident,
                           'TAG_USER_ULTIMO' => $ident,
                           'TAG_FECHA' => date('Y-m-d'),
                           'AUTORIZADO' => 5 ,
                           'VISIBILITY' => 0
                        );

            $this->db->where('TAG_ARTICULO_ID','9'); //ID del articulo
            $this->db->update('TAG_ARTICULOS', $data); 
        	 
           // echo $primary_key; //34


    }

    public function insert_tag_articulos($ident,$primary_key){

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

    function get_tags(){

          $this->db->select( 'TAGS_ID ,TAGS_NOMBRE');
          $this->db->from('TAGS_NOMBRES');
          $results = $this->db->get();//->result();

          foreach ($results->result() as $row)
          {
              $salida[$row->TAGS_ID]=$row->TAGS_NOMBRE;
               
          }
          return  $salida;


    }

    function get_marcapais()
    {
        $this->db->select('MAP_ID, MAP_NOMBRE');
        $this->db->from('MAP_MARCA_PAIS');

        $results = $this->db->get();
        $salida='';
        foreach ($results->result() as $row)
        {
            $salida[$row->MAP_ID]=$row->MAP_NOMBRE;
           
        }
        return  $salida;
 
    }

    function get_smart_id()
    {
        $this->db->select('PAT_NOMBRE, PAT_IDENTIFICADOR');
        $this->db->from('PAT_PATROCINADORES');

        $results = $this->db->get();
        $salida= array();
        if ($results->num_rows() > 0)  {
        foreach ($results->result() as $row)
        {
            $salida[$row->PAT_IDENTIFICADOR]=$row->PAT_NOMBRE.' ( '.$row->PAT_IDENTIFICADOR.' )';
           
        }

        }else{

            $salida[""]=' ( SIN  PATROCINADORES)'; 
        }
          

         
        return  $salida;
 
    }

    function control_articulo($pUSER_ID){

        $param = array(
           $pUSER_ID  // ,pUSER_ID INT
        );

        $sql = "CALL AB_ARTICULOS_INSERT(?)";
        $query = $this->db->query($sql, $param);  
        return $query->result_array();

    }


}
