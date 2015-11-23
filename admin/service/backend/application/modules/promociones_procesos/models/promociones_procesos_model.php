<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth Model
*
* Author:  Ben Edmunds
* 		   ben.edmunds@gmail.com
*	  	   @benedmunds
*
* Added Awesomeness: Phil Sturgeon
*
* Location: http://github.com/benedmunds/CodeIgniter-Ion-Auth
*
* Created:  10.01.2009
*
* Description:  Modified auth system based on redux_auth with extensive customization.  This is basically what Redux Auth 2 should be.
* Original Author name has been kept but that does not mean that the method has not been modified.
*
* Requirements: PHP5 or above
*
*/

class Promociones_procesos_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		// $this->load->database();
		// $this->load->helper('cookie');
		// $this->load->helper('date');
		// $this->load->library('session');
	}



    public function aceptar_promocion($id_promo, $user_autorizador){

    	$data = array(
                'AUTORIZADO' => 1,
                'PRO_USER_AUTORIZADOR' => $user_autorizador
            );

	    $this->db->where('PRO_ID', $id_promo);
	    $this->db->update('PRO_PROMOCIONES', $data);

    }

    public function rechazar_promocion($id_promocion, $motivo, $user_autorizador){

    	$data = array(
                'AUTORIZADO' => 2,
                'PRO_USER_AUTORIZADOR' => $user_autorizador
            );

	    $this->db->where('PRO_ID', $id_promocion);
	    $this->db->update('PRO_PROMOCIONES', $data);

    }

    public function get_promocion($id_promocion){

    	$this->db->select();
	    $this->db->from('PRO_PROMOCIONES');
	    $this->db->where('PRO_ID', $id_promocion);
	    $query = $this->db->get();

	    return $query->result();

    }

    public function get_user($pro_user_creador){

    	$this->db->select('id, email');
	    $this->db->from('admin_users');
	    $this->db->where('id', $pro_user_creador);
	    $query = $this->db->get();

	    return $query->result();

    }

    public function get_motivo_rechazo($id_pro){

    	$this->db->select('CXP_DESCRIPCION, PRO_ID, CXP_FECHA');
	    $this->db->from('CXP_COMENTARIOSXPROMOCION');
	    $this->db->where('PRO_ID', $id_pro);
	    $this->db->order_by("CXP_FECHA", "desc");

	    $query = $this->db->get();
	    $result = '';
	    foreach ($query->result() as $row) {
	      $result .= '- '.$row->CXP_DESCRIPCION.' <br /> ';
	    }

	    return $result;

    }


    function get_eventos_promocion($id_promo){
            $this->db->select('EVE_NOMBRE');
            $this->db->from('EXP_EVENTOXPROMOCION');
            $this->db->join('EVE_EVENTOS', 'EVE_EVENTOS.EVE_ID =EXP_EVENTOXPROMOCION.EXP_EVENTO');
            $this->db->where('EXP_PROMOCION', $id_promo);

            $query = $this->db->get();
            $resp =  $query->result_array();
             foreach($resp as $clave=>$valor){
                $arraEventos[] = $valor['EVE_NOMBRE'];
            }
            $listado_eventos = implode(',',$arraEventos);
            return $listado_eventos;
    }


}
