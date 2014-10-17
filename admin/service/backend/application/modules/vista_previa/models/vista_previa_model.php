<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class vista_previa_model extends CI_Model
{

  	public function __construct()
  	{
  		parent::__construct();
  	}
  		

  	function get_tienda($username){

        $query = $this->db->query("SELECT *
                                    FROM TIE_TIENDAS
                                    JOIN admin_users ON TIE_TIENDAS.TIE_ID_USER = admin_users.id
                                    WHERE admin_users.username = '$username'");
        
        $result = $query->row_array();

        return $result;

    }

    function get_tienda_by_id($id){

        $query = $this->db->query("SELECT *
                                    FROM TIE_TIENDAS
                                    WHERE TIE_TIENDAS.TIE_ID_USER = '$id'");
        
        $result = $query->row_array();

        return $result;

    }

    function get_categoria($id){

        $this->db->select();
        $this->db->from('CAT_CATEGORIA');
        $this->db->where('CAT_ID', $id);

        $query = $this->db->get();

        return $query->row_array();

    }

    function get_destino($id){

        $this->db->select();
        $this->db->from('DES_DESTINO');
        $this->db->where('DES_ID', $id);

        $query = $this->db->get();

        return $query->row_array();

    }

    function get_tipo_viaje($id){

        $this->db->select();
        $this->db->from('TIP_TIPO_DE_VIAJE');
        $this->db->where('TIP_ID', $id);

        $query = $this->db->get();

        return $query->row_array();

    }


}
