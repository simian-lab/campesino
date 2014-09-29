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

class Pendientes_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		// $this->load->database();
		// $this->load->helper('cookie');
		// $this->load->helper('date');
		// $this->load->library('session');
	}

	public function get_user_x_promocion($id_promo){
        $this->db->select('PRO_USER_CREADOR');
        $this->db->from('PRO_PROMOCIONES');
        $this->db->where('PRO_ID', $id_promo);

        $query = $this->db->get();
        return $query->row_array();
    }

	public function get_user_aliados(){
        //$this->db->select('admin_users.id, username');
        //$this->db->from('admin_users');
        //$this->db->join('admin_users_groups', 'admin_users_groups.group_id = 5 AND admin_users_groups.user_id = admin_users.id');
        $query = $this->db->query('SELECT admin_users.id, username FROM admin_users join admin_users_groups ON admin_users_groups.group_id = 5 AND admin_users_groups.user_id = admin_users.id');
        $salida = '';
        foreach($query->result() as $row){
            $salida[$row->id] = $row->username;
        }
        return $salida;
    }



   function getPromocion($id) {
            $this->db->select('*');
            $this->db->from('PRO_PROMOCIONES');
            $this->db->join('TIE_TIENDAS', 'TIE_TIENDAS.TIE_ID_USER = PRO_PROMOCIONES.PRO_USER_CREADOR');
            $this->db->where('PRO_ID', $id);            
            $this->db->limit(1);
           
            $query = $this->db->get();

            if ($query->num_rows() > 0)                
                return $query->row_array();

            return NULL;
        
    }

	public function get_paquete($id_user){
		$this->db->select('PAQ_ID,PAQ_NOMBRE');
		$this->db->from('PAQUETES_NOMBRES');
		$this->db->join('admin_users', 'admin_users.paquete = PAQUETES_NOMBRES.PAQ_ID');
		$this->db->where('admin_users.id', $id_user);

		$query = $this->db->get();
        $salida='';
        foreach ($query->row_array() as $row)
        {
            $salida[$id_user]=$row;
           
        }
        return  $salida;
	}

	public function get_grupo($id){

		// $this->db->select('*');
		// $this->db->from('admin_users_groups');
		// // $this->db->join('comments', 'comments.id = blogs.id');

		// $query = $this->db->get();

		$query = $this->db->select('user_id, group_id')
		                  ->from('admin_users_groups')
		                  ->where('user_id', $id)
		                   ->get();
		                  // ->limit(1)

		$row = $query->row_array();
		return $row;
	}


	function get_user($id_user){
		$this->db->select('id,username');
		$this->db->from('admin_users');
		$this->db->where('admin_users.id', $id_user);

		$query = $this->db->get();

		$row = $query->row_array();
		return $row;
	}

	function get_motivo_rechazo($id_promo){
		$this->db->select('PRO_ID, CXP_DESCRIPCION,CXP_ID');
		$this->db->from('CXP_COMENTARIOSXPROMOCION');
		$this->db->where('PRO_ID', $id_promo);

		$query = $this->db->get();
		$salida = '';
		foreach($query->result() as $row){
			$salida[$row->CXP_ID] = $row->CXP_DESCRIPCION;
		}

		return $salida;
	}


	function send_mail_rechazado($titulo_promo,$usuario_creador,$asunto,$autor, $estado, $motivo_rechazo = ''){
	       $this->load->library('email');

			$this->db->select('id,email');
			$this->db->from('admin_users');
			$this->db->where('id',$usuario_creador);
			// $this->db->join('admin_users_groups', 'admin_users_groups.user_id =admin_users.id AND admin_users_groups.group_id =3'); //AND admin_users_groups.group_id = 5
			$query = $this->db->get();

			// $resp =  $query->result_array();
			$resp =  $query->row_array();

			//  foreach($resp as $clave=>$valor){
			// 	$arrMails[] = $valor['email'];
			// }
			// $listado_mails = implode(',',$arrMails);
			//die($asunto);

			$config['protocol'] = 'sendmail';
			$config['smtp_host'] = 'localhost';
			$config['charset'] = 'utf-8';
			$config['wordwrap'] = TRUE;

			$this->email->initialize($config);

			$this->email->from('no-reply@cyberlunes.com.co','Promociones');
			$this->email->to($resp['email']);
			// $this->email->to('mgranada@brandigital.com'); 
			

			$this->email->subject($asunto);
			if($estado == 2){
				$this->email->message('Se ha rechazado la promoción:<br> Promoción: '.$titulo_promo.'<br> Autor: '.$autor.'<br> Motivo: '.$motivo_rechazo);	
		    }
		    else{
		    	$this->email->message('Se ha aprobado la promoció:<br> Promoción: '.$titulo_promo.'<br> Autor: '.$autor);	
		    }
			$this->email->send();
			return true;
			// echo $this->email->print_debugger();
	}

	function getCategoriaId($id) {
            $this->db->select('*');
            $this->db->from('CAT_CATEGORIA');
            $this->db->where('CAT_ID', $id);            
            $this->db->limit(1);
           
            $query = $this->db->get();

            if ($query->num_rows() > 0)                
                return $query->row_array();

            return NULL;
        
    }

    function getSubCategoriaId($id) {
            $this->db->select('*');
            $this->db->from('SUB_SUBCATEGORIA');
            $this->db->where('SUB_ID', $id);            
            $this->db->limit(1);
           
            $query = $this->db->get();

            if ($query->num_rows() > 0)                
                return $query->row_array();

            return NULL;
        
    }

    function getTiendaId($id) {
            $this->db->select('*');
            $this->db->from('TIE_TIENDAS');
            $this->db->where('TIE_ID_USER', $id);            
            $this->db->limit(1);
           
            $query = $this->db->get();

            if ($query->num_rows() > 0)                
                return $query->row_array();

            return NULL;
        
    }

    function getMarcaId($id) {
            $this->db->select('* ');
            $this->db->from('MAR_MARCAS');
            $this->db->where('MAR_ID', $id);            
            $this->db->limit(1);
           
            $query = $this->db->get();

            if ($query->num_rows() > 0)                
                return $query->row_array();

            return NULL;
        
    }

    
   
	
}
