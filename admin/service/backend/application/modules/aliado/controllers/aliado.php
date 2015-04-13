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
	 * @param  array $post_array
	 * @return boolean returns TRUE when the email has been sended.
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
		$this->email->to($mails_list);
		//$this->email->to('nicolas@simian.co'); // This email is for testing.
		$this->email->subject('Se modifico una URL de evento');
		$this->email->message('El aliado '.$post_array['PAT_NOMBRE'].' agregó la siguiente URL de evento:<br>URL evento: '.$post_array['PAT_URL_EVENT']);
		$this->email->send();

		return true;
	}

	/**
	 * Main function.
	 */
	function index() {
		$breadcrums[]='<a class="current" href="'.site_url('main/aliado').'">Patrocinador</a>';

		$this->data = array('autor'=>$this->session->userdata('username') . ' ('.$this->session->userdata('email').')' , 'ident'=>$this->session->userdata('sadmin_user_id'));
		$this->data['titulo']='Patrocinadores';
		$this->data['encabezado']='Patrocinadores';
		$this->load->model('aliado_model');

		$user_id = $this->session->userdata('sadmin_user_id');

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
		$crud->where('PAT_ALIADO', $user_id);

		$state = $crud->getState();

		// If i'm on an edit screen...
		if($state == 'edit') {
			$state_info = $crud->getStateInfo();
			$ally_id = $state_info->primary_key;
			$query = 'SELECT PAT_ALIADO FROM PAT_PATROCINADORES WHERE PAT_ID = ?';
			$result = $this->db->query($query, array($ally_id));
			$user_id_from_ally = $result->result()[0]->PAT_ALIADO;

			if($user_id != $user_id_from_ally) {
				$this->data['output'] =" <h1>No tienes permiso para acceder esta secci&oacute;n.</h1>" ;
				$breadcrums[]='<a class="current" href="'.site_url('main/aliado').'">Patrocinadores</a>';
				$this->data['titulo']='Permiso denegado';
				$this->data['encabezado']='Error';
				$this->error('example', $this->data, $breadcrums);
				die();
			}
		}

		$this->data['output'] = $output = $crud->render();

		$this->salida('example',$this->data, $breadcrums);
	}
}
