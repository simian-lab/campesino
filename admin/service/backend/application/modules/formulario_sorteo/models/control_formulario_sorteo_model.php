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

class control_formulario_sorteo_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}




    function formulario_sorteo($pUSER_ID){

        $param = array(
           $pUSER_ID  // ,pUSER_ID INT
        );

        $sql = "CALL AB_USUARIOS_INSERT(?)";
        $query = $this->db->query($sql, $param);  
        return $query->result_array();

    }



}
