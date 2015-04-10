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

class Ion_users_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		// $this->load->database();
		// $this->load->helper('cookie');
		// $this->load->helper('date');
		// $this->load->library('session');
	}


	public function get_grupo($id){

			$query = $this->db->select('user_id, group_id')
		                  ->from('admin_users_groups')
		                  ->where('user_id', $id)
		                   ->get();
		                  // ->limit(1)

		$row = $query->row_array();
		return $row;
	}

	public function  get_user_x_grupo($id_grupo){


		$this->db->select('*');
		$this->db->from('admin_users');
		if($id_grupo==3){
		$this->db->join('admin_users_groups', 'admin_users_groups.user_id =admin_users.id AND admin_users_groups.group_id =5 OR admin_users_groups.group_id =2'); //AND admin_users_groups.group_id = 5
		}elseif($id_grupo==4){
		$this->db->join('admin_users_groups', 'admin_users_groups.user_id =admin_users.id AND admin_users_groups.group_id !=1');
		}

		$query = $this->db->get();
		return $query->result_array();

	}

	function send_mail_user_change_passwprd($datos_envio){
	       $this->load->library('email');

			$this->db->select('email');
			$this->db->from('admin_users');
			// $this->db->join('admin_users_groups', 'admin_users_groups.user_id =admin_users.id AND admin_users_groups.group_id =3'); //AND admin_users_groups.group_id = 5
			$this->db->where('id',$datos_envio['ident']); //AND admin_users_groups.group_id = 5

			$query = $this->db->get();
			$resp =  $query->row_array();
			//  foreach($resp as $clave=>$valor){
			// 	$arrMails[] = $valor['email'];
			// }
			// $listado_mails = implode(',',$arrMails);


			$config['protocol'] = 'sendmail';
			$config['smtp_host'] = 'localhost';
			$config['charset'] = 'iso-8859-1';
			$config['wordwrap'] = TRUE;

			$this->email->initialize($config);

			$this->email->from('no-reply@cyberlunes.com.co', 'Cambio de clave');
			$this->email->to($resp['email']);
			// $this->email->to('mgranada@brandigital.com');

			$this->email->subject('Cambio de Clave');
			$this->email->message('La Clave de su cuenta fue modificada. <br>Su nueva clave es: '. $datos_envio['clave']);

			$this->email->send();
			return true;
			// echo $this->email->print_debugger();
	}

	/**
	 * @return array Get an array of allies with its ids and names.
	 */
	function get_allies() {
		$this->db->select('PAT_ID, PAT_NOMBRE');
    $this->db->from('PAT_PATROCINADORES');

    $results = $this->db->get();
    $allies='';
    foreach ($results->result() as $row) {
			$allies[$row->PAT_ID] = $row->PAT_NOMBRE;
			}
    return $allies;
	}

	function insert_tienda($username, $visibility){

		$this->db->select('id');
		$this->db->from('admin_users');
		$this->db->where('username',$username);

		$query = $this->db->get();
		$resp =  $query->row_array();
		$slug = url_title($username, '-', TRUE);
		$data = array(

				'TIE_NOMBRE' => $username,
				'TIE_FECHA_ALTA' => date("Y-m-d H:i:s"),
				'VISIBILITY' => $visibility,
				'TIE_SLUG' => $slug,
				'TIE_ID_USER' => $resp['id']

			);
		$this->db->insert('TIE_TIENDAS', $data);

	}

	function update_tienda($username, $visibility){

		$this->db->select('id');
		$this->db->from('admin_users');
		$this->db->where('username',$username);

		$queryUser = $this->db->get();
		$respUser =  $queryUser->row_array();
		$slug = url_title($username, '-', TRUE);
		$data = array(

				'TIE_NOMBRE' => $username,
				'TIE_FECHA_ALTA' => date("Y-m-d H:i:s"),
				'VISIBILITY' => $visibility,
				'TIE_SLUG' => $slug,
				'TIE_ID_USER' => $respUser['id']

			);
		$this->db->where('TIE_ID_USER', $respUser['id']);
		$this->db->update('TIE_TIENDAS', $data);

	}

	function delete_tienda($id_user){

		$this->db->where('TIE_ID_USER',$id_user);
		$this->db->delete('TIE_TIENDAS');

	}

}
