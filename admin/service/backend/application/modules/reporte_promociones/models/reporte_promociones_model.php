<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reporte_promociones_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	/**
	 * Get the user group from the id.
	 * @param  $id The user id
	 */
	public function get_grupo($id) {
		$this->db->select('user_id, group_id');
		$this->db->from('admin_users_groups');
		$this->db->where('user_id', $id);
		$query = $this->db->get();

		$row = $query->row_array();
		return $row;
	}
}
?>