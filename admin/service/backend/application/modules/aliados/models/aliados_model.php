<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Aliados_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

  function control_aliado($pUSER_ID){
    $param = array(
       $pUSER_ID  // ,pUSER_ID INT
    );

    $sql = "CALL AB_PATROCINADORES_INSERT(?)";
    $query = $this->db->query($sql, $param);
    return $query->result_array();
  }

  /**
   * Get the ID and username of all the allies.
   * @return array All the allies.
   */
  public function get_user_aliados($ally_id){
    $this->db->select('admin_users.id, username');
    $this->db->from('admin_users');
    $this->db->join('admin_users_groups', 'admin_users_groups.user_id = admin_users.id AND admin_users_groups.group_id = 5'); //OR admin_users_groups.group_id =2 //AND admin_users_groups.group_id = 5
		if($ally_id != 'list' and $ally_id != 'add') {
			$where = 'ally_id IS NULL OR ally_id = '. $ally_id . ' AND active = 1';
			$this->db->where($where);
		} else if ($ally_id == 'add') {
			$where = 'ally_id IS NULL AND active = 1';
			$this->db->where($where);
		}

    $results = $this->db->get();
    $salida='';
    foreach ($results->result() as $row)
    {
        $salida[$row->id]=$row->username;

    }

    return  $salida;
  }
}
