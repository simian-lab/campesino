<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth Model
*
* Author:  Ben Edmunds
*        ben.edmunds@gmail.com
*        @benedmunds
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

class Asignar_paquetes_aliados_model extends CI_Model
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
    $this->db->join('admin_users_groups', 'admin_users_groups.user_id =admin_users.id AND admin_users_groups.group_id =5'); //OR admin_users_groups.group_id =2 //AND admin_users_groups.group_id = 5

    $query = $this->db->get();
    return $query->result_array();

  }

    function get_paquetes()
    {
        $this->db->select('PAQ_ID, PAQ_NOMBRE');
        $this->db->from('PAQUETES_NOMBRES');

        $results = $this->db->get();
        $salida='';
        foreach ($results->result() as $row)
        {
            $salida[$row->PAQ_ID]=$row->PAQ_NOMBRE;
           
        }
        return  $salida;
 
    }


}
