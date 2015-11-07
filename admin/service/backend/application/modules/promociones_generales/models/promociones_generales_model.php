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

class Promociones_generales_model extends CI_Model
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

        $config['protocol'] = 'smtp';
        $config['smtp_host'] = $this->config->item('smtp');
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);

        $this->email->from($this->config->item('mail_send'), 'Promociones');
        $this->email->to($result['email']);

        $this->email->subject('Nueva promoción creada');
        $this->email->message('Su promoción ha sido creada con éxito.<br>Título: '.$datos_envio['titulo'].'<br> Autor: '.$datos_envio['autor'].'<br> Eventos: '.$datos_envio['eventos']  );

        $this->email->send();
    }

    function send_mail_aliado_edit($datos_envio){
        $this->load->library('email');

        $this->db->select('email');
        $this->db->from('admin_users');
        $this->db->where('admin_users.id', $datos_envio['aliado']);

        $query = $this->db->get();
        $result = $query->row_array();

        $config['protocol'] = 'smtp';
        $config['smtp_host'] = $this->config->item('smtp');
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);

        $this->email->from($this->config->item('mail_send'), 'Promociones');
        $this->email->to($result['email']);

        $this->email->subject('Promoción editada');
        $this->email->message('Su promoción ha sido editada con éxito.<br>Título: '.$datos_envio['titulo'].'<br> Autor: '.$datos_envio['autor'].'<br> Eventos: '.$datos_envio['eventos']  );

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


			$config['protocol'] = 'smtp';
            $config['smtp_host'] = $this->config->item('smtp');
            $config['charset'] = 'utf-8';
            $config['wordwrap'] = TRUE;

			$this->email->initialize($config);

			$this->email->from($this->config->item('mail_send'), 'Promociones');
			$this->email->to($listado_mails);
			// $this->email->to('mgranada@brandigital.com');


			$this->email->subject('Nueva promoción para aprobar');
			$this->email->message('Se ha cargado una nueva promoción para aprobar.<br>Título: '.$datos_envio['titulo'].'<br> Autor: '.$datos_envio['autor'].'<br> Eventos: '.$datos_envio['eventos'] );

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


            $config['protocol'] = 'smtp';
            $config['smtp_host'] = $this->config->item('smtp');
            $config['charset'] = 'utf-8';
            $config['wordwrap'] = TRUE;

            $this->email->initialize($config);

            $this->email->from($this->config->item('mail_send'), 'Promociones');
            $this->email->to($listado_mails);
            // $this->email->to('mgranada@brandigital.com');


            $this->email->subject('Nueva promoción para aprobar');
            $this->email->message('Se ha editado una promoción y debe ser aprobada.<br>Título: '.$datos_envio['titulo'].'<br> Autor: '.$datos_envio['autor'].'<br> Eventos: '.$datos_envio['eventos'] );

            $this->email->send();
            return true;
            // echo $this->email->print_debugger();
    }

    function send_mail_delete_aliado($datos_envio){
        $this->load->library('email');

        $this->db->select('email');
        $this->db->from('admin_users');
        $this->db->where('admin_users.id', $datos_envio['aliado']);

        $query = $this->db->get();
        $result = $query->row_array();

        $config['smtp_host'] = $this->config->item('smtp');
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);

        $this->email->from($this->config->item('mail_send'), 'Promociones');
        $this->email->to($result['email']);

        $this->email->subject('Promoción eliminada');
        $this->email->message('Su promoción ha sido eliminada.<br>Título: '.$datos_envio['titulo'].'<br> Autor: '.$datos_envio['autor'].'<br> Eventos: '.$datos_envio['eventos']  );

        $this->email->send();
    }

    function send_mail_delete_user($datos_envio){
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


            $config['protocol'] = 'smtp';
            $config['smtp_host'] = $this->config->item('smtp');
            $config['charset'] = 'utf-8';
            $config['wordwrap'] = TRUE;

            $this->email->initialize($config);

            $this->email->from($this->config->item('mail_send'), 'Promociones');
            $this->email->to($listado_mails);
            // $this->email->to('mgranada@brandigital.com');


            $this->email->subject('Promoción eliminada');
            $this->email->message('Se ha eliminado una promoción.<br>Título: '.$datos_envio['titulo'].'<br> Autor: '.$datos_envio['autor'].'<br> Eventos: '.$datos_envio['eventos'] );

            $this->email->send();
            //echo $this->email->print_debugger();die();
            return true;
            // echo $this->email->print_debugger();
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

    function validar_limite_edit($id_promo,$post_array){
            //definir tipo de promocion
            $tipo_promocion = 1;
            //definir respeusta default en caso de exito
            $respuesta = 1;
            //llama lista de eventos para obtener el nombre
            $lista_eventos = $this->promociones_generales_model->get_eventos();
            //buscar eventos a los que pertenece la promocion por ID
            $this->db->select('EVE_ID');
            $this->db->from('EXP_EVENTOXPROMOCION');
            $this->db->join('EVE_EVENTOS', 'EVE_EVENTOS.EVE_ID =EXP_EVENTOXPROMOCION.EXP_EVENTO');
            $this->db->where('EXP_PROMOCION', $id_promo);

            $query = $this->db->get();
            $resp =  $query->result_array();
             foreach($resp as $clave=>$valor){
                $arraEventos[] = $valor['EVE_ID'];
            }
            //calcula cuales eventos fueron inscritos como nuevos
            $agregados = array_diff($post_array['eventos'], $arraEventos);
            //busca id del dueño de la promocion
            $this->db->select('PRO_USER_CREADOR');
            $this->db->from('PRO_PROMOCIONES');
            $this->db->where('PRO_ID', $id_promo);
            $query = $this->db->get();
            $resp =  $query->result_array();
             foreach($resp as $clave=>$valor){
                $id_user = $valor['PRO_USER_CREADOR'];
            }
            //ciclo para contar el número de promociones inscritas para los eventos nuevos
            foreach($agregados as $evento_agregado){
              //cuenta las promociones del usuario, por evento y tipo
              $this->db->select('COUNT(*)');
              $this->db->from('EXP_EVENTOXPROMOCION');
              $this->db->join('PRO_PROMOCIONES', 'PRO_PROMOCIONES.PRO_ID =EXP_EVENTOXPROMOCION.EXP_PROMOCION');
              $this->db->where('PRO_USER_CREADOR', $id_user);
              $this->db->where('EXP_EVENTO', $evento_agregado);
              $this->db->where('PRO_SRC_ID', $tipo_promocion);

              $query = $this->db->get();
              $resp =  $query->result_array();
               foreach($resp as $clave=>$valor){
                $no_promociones = $valor['COUNT(*)'];
               }
               //busca el # de promociones del paquete
              $this->db->select('*');
              $this->db->from('PAQUETES_NOMBRES');
              $this->db->join('AXP_ADMINXPAQUETE', 'AXP_ADMINXPAQUETE.AXP_PAQUETE=PAQUETES_NOMBRES.PAQ_ID');
              $this->db->where('AXP_ADMIN', $id_user);
              $this->db->where('PAQ_EVENTO', $evento_agregado);

              $query = $this->db->get();
              $resp =  $query->result_array();
              if (!empty($resp)) {//revisa si no hay paquetes asignados para el evento
               foreach($resp as $clave=>$valor){//ciclo por cada paquete encontrado
                 switch ($tipo_promocion) {//cambia el mensaje dependiendo de la promocion
                  case '1':
                    if ($valor['PAQ_MONTO_BASICO'] <= $no_promociones ) {//compara numero de promociones
                      $respuesta = 'EL USUARIO SUPERO EL MAXIMO DE PROMOCIONES BASICAS A CARGAR PARA EL EVENTO '.$lista_eventos[$evento_agregado];
                    }
                  break;
                  case '2':
                    if ($valor['PAQ_MONTO_PREMIUN'] <= $no_promociones ) {
                      $respuesta = 'EL USUARIO SUPERO EL MAXIMO DE PROMOCIONES PREMIUN A CARGAR PARA EL EVENTO '.$lista_eventos[$evento_agregado];
                    }
                  break;
                  case '3':
                    if ($valor['PAQ_MONTO_PREMIUN_CATEGORIA'] <= $no_promociones ) {
                      $respuesta = 'EL USUARIO SUPERO EL MAXIMO DE PROMOCIONES A CARGAR POR CATEGORIA PREMIUN PARA EL EVENTO '.$lista_eventos[$evento_agregado];
                    }
                  break;
                  default:
                    $respuesta = 'ERROR: el tipo de promocion no esta bien definido';
                  break;
                }
               }
              }else{
                $respuesta = 'Esta Promocion no se puede agregar al Evento '.$lista_eventos[$evento_agregado].', favor comunicar con atencion al cliente, para validar sus paquetes asociados';
              }
            }
        return  $respuesta;
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

    function get_eventos()
    {
        $this->db->select('EVE_ID, EVE_NOMBRE');
        $this->db->from('EVE_EVENTOS');

        $results = $this->db->get();
        $salida='';
        foreach ($results->result() as $row)
        {
            $salida[$row->EVE_ID]=$row->EVE_NOMBRE;

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

    function decrementar($pUSER_ID,$pTIPO,$evento){


    	$param = array(
    	   $pUSER_ID  // ,pUSER_ID INT
         ,$pTIPO  // ,pTIPO INT
    	   ,$evento  // ,evento INT
    	);


    	$sql = "CALL AB_DESCONTAR_MAX(?,?,?)";
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

    function getPromocionById($id_promo){
        $this->db->select();
        $this->db->from('PRO_PROMOCIONES');
        $this->db->where('PRO_ID', $id_promo);

        $query = $this->db->get();

        return $query->row_array();
    }

    function verificar_visibilidad($id_promo){

        $this->db->select('VISIBILITY');
        $this->db->from('PRO_PROMOCIONES');
        $this->db->where('PRO_ID', $id_promo);
        $query = $this->db->get();

        return $query->row_array();

    }

}
