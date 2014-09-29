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

class Promociones_premium_home_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		// $this->load->database();
		// $this->load->helper('cookie');
		// $this->load->helper('date');
		// $this->load->library('session');
	}

    public function delete_motivo_rechazo($id_promo){
        $query = $this->db->delete('CXP_COMENTARIOSXPROMOCION', array('PRO_ID' => $id_promo)); 
        return $query;
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

    function send_mail_aliado($datos_envio){
        $this->load->library('email');

        $this->db->select('email');
        $this->db->from('admin_users');
        $this->db->where('admin_users.id', $datos_envio['aliado']);

        $query = $this->db->get();
        $result = $query->row_array();

        $config['smtp_host'] = 'localhost';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);

        $this->email->from('no-reply@cyberlunes.com.co', 'Promociones');
        $this->email->to($result['email']); 

        $this->email->subject('Nueva promoción creada');
        $this->email->message('Su promoción ha sido creada con éxito.<br>Título: '.$datos_envio['titulo'].'<br> Autor: '.$datos_envio['autor'] );  

        $this->email->send();
    }

    function send_mail_aliado_edit($datos_envio){
        $this->load->library('email');

        $this->db->select('email');
        $this->db->from('admin_users');
        $this->db->where('admin_users.id', $datos_envio['aliado']);

        $query = $this->db->get();
        $result = $query->row_array();

        $config['smtp_host'] = 'localhost';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);

        $this->email->from('no-reply@cyberlunes.com.co', 'Promociones');
        $this->email->to($result['email']); 

        $this->email->subject('Promoción editada');
        $this->email->message('Su promoción ha sido editada con éxito.<br>Título: '.$datos_envio['titulo'].'<br> Autor: '.$datos_envio['autor'] );  

        $this->email->send();
    }

	function send_mail_user($datos_envio){
	       $this->load->library('email');

			$this->db->select('email');
			$this->db->from('admin_users');
			$this->db->join('admin_users_groups', 'admin_users_groups.user_id =admin_users.id AND admin_users_groups.group_id =3'); //AND admin_users_groups.group_id = 5

			$query = $this->db->get();
			$resp =  $query->result_array();
			 foreach($resp as $clave=>$valor){
				$arrMails[] = $valor['email'];
			}
			$listado_mails = implode(',',$arrMails);
			

			$config['protocol'] = 'sendmail';
			$config['smtp_host'] = 'localhost';
			$config['charset'] = 'utf-8';
			$config['wordwrap'] = TRUE;

			$this->email->initialize($config);

			$this->email->from('no-reply@cyberlunes.com.co', 'Promociones');
			$this->email->to($listado_mails); 
			// $this->email->to('mgranada@brandigital.com'); 
			

			$this->email->subject('Nueva promoción para aprobar');
			$this->email->message('Se ha cargado una nueva promoción para aprobar.<br>Título: '.$datos_envio['titulo'].'<br> Autor: '.$datos_envio['autor'] );	

			$this->email->send();
			return true;
			// echo $this->email->print_debugger();
	}

    function send_mail_user_edit($datos_envio){
           $this->load->library('email');

            $this->db->select('email');
            $this->db->from('admin_users');
            $this->db->join('admin_users_groups', 'admin_users_groups.user_id =admin_users.id AND admin_users_groups.group_id =3'); //AND admin_users_groups.group_id = 5

            $query = $this->db->get();
            $resp =  $query->result_array();
             foreach($resp as $clave=>$valor){
                $arrMails[] = $valor['email'];
            }
            $listado_mails = implode(',',$arrMails);
            

            //$config['protocol'] = 'sendmail';
            $config['smtp_host'] = 'localhost';
            $config['charset'] = 'utf-8';
            $config['wordwrap'] = TRUE;

            $this->email->initialize($config);

            $this->email->from('no-reply@cyberlunes.com.co', 'Promociones');
            $this->email->to($listado_mails); 
            // $this->email->to('mgranada@brandigital.com'); 
            

            $this->email->subject('Nueva promoción para aprobar');
            $this->email->message('Se ha editado una promoción y debe ser aprobada.<br>Título: '.$datos_envio['titulo'].'<br> Autor: '.$datos_envio['autor'] );  

            $this->email->send();
            return true;
            // echo $this->email->print_debugger();
    }

    
	function get_marcas()
    {
        $this->db->select('MAR_ID, MAR_NOMBRE');
        $this->db->from('MAR_MARCAS');

        $results = $this->db->get();
        $salida='';
        foreach ($results->result() as $row)
        {
            $salida[$row->MAR_ID]=$row->MAR_NOMBRE;
           
        }
        return  $salida;
 
    }
    function get_categorias()
    {
        $this->db->select('CAT_ID, CAT_NOMBRE');
        $this->db->from('CAT_CATEGORIA');

        $results = $this->db->get();
        $salida='';
        foreach ($results->result() as $row)
        {
            $salida[$row->CAT_ID]=$row->CAT_NOMBRE;
           
        }
        return  $salida;
 
    }
       function get_subcategorias()
    {
        $this->db->select('SUB_ID, SUB_NOMBRE');
        $this->db->from('SUB_SUBCATEGORIA');

        $results = $this->db->get();
        $salida='';
        foreach ($results->result() as $row)
        {
            $salida[$row->SUB_ID]=$row->SUB_NOMBRE;
           
        }
        return  $salida;
 
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

    function decrementar($pUSER_ID,$pTIPO){
        

    	$param = array(
    	   $pUSER_ID  // ,pUSER_ID INT
    	   ,$pTIPO  // ,pTIPO INT
    	);
    	

    	$sql = "CALL AB_DESCONTAR_MAX(?,?)";
    	$query = $this->db->query($sql, $param);  
    	
        // $query->next_result(); // Dump the extra resultset.
        // $query->free_result(); // Does what it says.

    	return $query->result_array();
    }


    function control_promocion($pID,$pUSER_ID){

        $param = array(
           $pUSER_ID  // ,pUSER_ID INT
           ,$pID  // ,pTIPO INT
        );

        $sql = "CALL AB_CONTROL_PROMOCIONES_BEFORE_UPDATE(?,?)";
        $query = $this->db->query($sql, $param);  
        return $query->result_array();

    }



}
