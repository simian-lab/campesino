<style>
/* Sorry for this. But grocerycrud doesn't have a function for only showing the image. */
.delete-anchor, .fileinput-button {
	display: none !important;
}
</style>

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aliado extends Main {

	function __construct() {
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_crud');
	}

	/**
	 * [send_notification_email description]
	 * @param  [type] $post_array [description]
	 * @return [type]             [description]
	 */
	function send_notification_email($post_array) {
		$this->load->library('email');

		$this->db->select('email');
		$this->db->from('admin_users');
		$this->db->join('admin_users_groups', 'admin_users_groups.user_id =admin_users.id AND admin_users_groups.group_id =3'); //AND admin_users_groups.group_id = 5

		$query = $this->db->get();
		$resp =  $query->result_array();
		foreach($resp as $clave=>$valor){
			$arrMails[] = $valor['email'];
		}
		$mails_list = implode(',',$arrMails);

		$email_config['protocol'] = 'sendmail';
		$email_config['smtp_host'] = 'localhost';
		$email_config['charset'] = 'iso-8859-1';
		$email_config['wordwrap'] = TRUE;

		$this->email->initialize($email_config);
		$this->email->from('no-reply@cyberlunes.com.co', 'Patrocinadores');
		//$this->email->to($mails_list);
		$this->email->to('nicolas@simian.co'); // This email is for testing.
		$this->email->subject('Se modifico una URL de evento');
		$this->email->message('El aliado '.$post_array['PAT_NOMBRE'].' agregó la siguiente URL de evento:<br>URL evento: '.$post_array['PAT_URL_EVENT']);
		$this->email->send();

		return true;
	}

	/**
	 * [index description]
	 * @return [type] [description]
	 */
	function index() {
		$breadcrums[]='<a class="current" href="'.site_url('main/aliado').'">Patrocinador</a>';

		$this->data = array('autor'=>$this->session->userdata('username') . ' ('.$this->session->userdata('email').')' , 'ident'=>$this->session->userdata('sadmin_user_id'));
		$this->data['titulo']='Patrocinadores';
		$this->data['encabezado']='Patrocinadores';
		$this->load->model('aliado_model');

		$crud = new grocery_CRUD();

		$crud->callback_after_update(array($this,'send_notification_email'));
		$crud->columns('PAT_NOMBRE','PAT_URL_EVENT');
		$crud->display_as('PAT_NOMBRE', 'Nombre');
		$crud->display_as('PAT_LOGO','Imagen <br>(100x73) - png');
		$crud->display_as('PAT_URL_EVENT','Url evento');
		$crud->field_type('PAT_URL_EVENT','STRING');
		$crud->field_type('PAT_NOMBRE','hidden');
		$crud->fields('PAT_NOMBRE', 'PAT_LOGO', 'PAT_URL_EVENT');
		$crud->set_field_upload('PAT_LOGO','multimedia/aliados/');
		$crud->set_language('spanish');
		$crud->set_theme('flexigrid');
		$crud->set_table('PAT_PATROCINADORES');
		$crud->unset_add();
		$crud->unset_delete();
		$crud->unset_read();
		echo 'User id: '.$this->session->userdata('sadmin_user_id');
		$crud->where('PAT_ID',56);

		$state = $crud->getState();
		if($state == 'edit') {
			$state_info = $crud->getStateInfo();
			$primary_key = $state_info->primary_key;
			echo '<br>Patrocinador id: '.$primary_key;
		}

		/*CONTROL*/
		/*$result = $this->aliado_model->control_aliado($this->session->userdata('sadmin_user_id'));
		if($result[0]['RESPUESTA']!=0 ){
			$this->data['output'] =" <h1>No tenes permiso para acceder esta seccion</h1>" ;
			$breadcrums[]='<a class="current" href="'.site_url('main/aliado').'">Patrocinadores</a>';
			$this->data['titulo']='Permiso denegado';
			$this->data['encabezado']='Error';
			$this->error('example',$this->data,$breadcrums);
			die();
		}
		/*CONTROL*/

		$this->data['output'] = $output = $crud->render();

		$this->salida('example',$this->data, $breadcrums);
	}
}
