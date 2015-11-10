<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promociones_procesos extends MX_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->database();

		$this->load->library('grocery_crud');
		$this->load->helper('url');
    $this->load->library('email');
    $this->load->model('promociones_procesos_model');
	}

	function aceptar_promocion(){
      $id_promocion = $this->input->post('id_promocion');
      $user_autorizador = $this->input->post('user_autorizador');

      $this->promociones_procesos_model->aceptar_promocion($id_promocion, $user_autorizador);

      $this->send_mail($id_promocion);
    }

    function rechazar_promocion(){
      $id_promocion = $this->input->post('id_promocion');
      $motivo = $this->input->post('motivo');
      $user_autorizador = $this->input->post('user_autorizador');

      $this->promociones_procesos_model->rechazar_promocion($id_promocion, $motivo, $user_autorizador);

      $this->send_mail($id_promocion, $motivo);
    }

    function send_mail($id_promocion, $motivo = ''){

      $promocion = $this->promociones_procesos_model->get_promocion($id_promocion);
      $eventos_promo = $this->promociones_procesos_model->get_eventos_promocion($id_promocion);

      $user = $this->promociones_procesos_model->get_user($promocion[0]->PRO_USER_CREADOR);


      $this->config->load('email');
      $config['protocol'] = 'smtp';
      $config['smtp_host'] = $this->config->item('smtp');
      $config['charset'] = 'utf-8';
      $config['wordwrap'] = TRUE;

      $this->email->initialize($config);

      $this->email->from($this->config->item('mail_send'), 'Promociones');
      $this->email->to($user[0]->email);

      if($promocion[0]->AUTORIZADO == 1){

        if((int)$promocion[0]->PRO_ACTIVA === (int)1){
            $asunto='Su promoción ha sido ACTIVADA';
            $this->email->subject($asunto);
            $this->email->message('Se ha activado la promoción:
             Promoción: '.$promocion[0]->PRO_NOMBRE.'
             Eventos: '.$eventos_promo.'
             Autor: '.$promocion[0]->PRO_AUTOR);
        }
        elseif((int)$promocion[0]->PRO_ACTIVA === (int)2){
            $asunto='Su promoción ha sido INACTIVADA';
            $this->email->subject($asunto);
            $this->email->message('Se ha inactivado la promoción:
             Promoción: '.$promocion[0]->PRO_NOMBRE.'
             Eventos: '.$eventos_promo.'
             Autor: '.$promocion[0]->PRO_AUTOR);
        }
        else{
            $asunto='Su promoción ha sido APROBADA';
            $this->email->subject($asunto);
            $this->email->message('Se ha aprobado la promoción:
             Promoción: '.$promocion[0]->PRO_NOMBRE.'
             Eventos: '.$eventos_promo.'
             Autor: '.$promocion[0]->PRO_AUTOR);
        }
        $asunto='Su promoción ha sido APROBADA';
        $this->email->subject($asunto);
        $this->email->message('Se ha aprobado la promoción:
         Promoción: '.$promocion[0]->PRO_NOMBRE.'
         Eventos: '.$eventos_promo.'
         Autor: '.$promocion[0]->PRO_AUTOR);

      }

      if($promocion[0]->AUTORIZADO == 2){
        $this->db->insert('CXP_COMENTARIOSXPROMOCION', array('PRO_ID' => $id_promocion, 'CXP_DESCRIPCION' => $motivo, 'CXP_USER_ID' => $promocion[0]->PRO_USER_AUTORIZADOR));
        $asunto='Su promoción ha sido RECHAZADA';
        $this->email->subject($asunto);
        $this->email->message('Se ha rechazado la promoción:
                               Promoción: '.$promocion[0]->PRO_NOMBRE.'
                               Eventos: '.$eventos_promo.'
                               Autor: '.$promocion[0]->PRO_AUTOR.'
                               Motivo: '.$motivo);
      }

      $this->email->send();

    }

    function get_motivo_rechazo(){
        $id_pro = $this->input->post('id_promo');

        $result = $this->promociones_procesos_model->get_motivo_rechazo($id_pro);

        echo $result;
      }

}

