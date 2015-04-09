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

			// Metodo para carga de albunes
			function index()
			{
				$breadcrums[]='<a class="current" href="'.site_url('main/aliado').'">Patrocinador</a>';

				$this->data = array('autor'=>$this->session->userdata('username') . ' ('.$this->session->userdata('email').')' , 'ident'=>$this->session->userdata('sadmin_user_id') );
				$this->data['titulo']='Patrocinadores';
				$this->data['encabezado']='Patrocinadores';
				$this->load->model('aliado_model');

				$crud = new grocery_CRUD();

				$crud->callback_before_update(array($this,'encrypt_password_callback'));
				$crud->columns('PAT_NOMBRE','PAT_URL_EVENT');
				$crud->display_as('PAT_NOMBRE', 'Nombre');
				$crud->display_as('PAT_LOGO','Imagen <br>(100x73) - png');
				$crud->display_as('PAT_URL_EVENT','Url evento');
				$crud->field_type('PAT_URL_EVENT','STRING');
				$crud->fields('PAT_LOGO', 'PAT_URL_EVENT');
				$crud->set_field_upload('PAT_LOGO','multimedia/aliados/');
				$crud->set_language('spanish');
				$crud->set_theme('flexigrid');
				$crud->set_table('PAT_PATROCINADORES');
				$crud->unset_add();
				$crud->unset_read();
				$crud->unset_delete();
				$crud->where('PAT_ID',56);

				/*CONTROL*/
				/*$result = $this->aliados_model->control_aliado($this->session->userdata('sadmin_user_id'));
				var_dump($result);
				if($result[0]['RESPUESTA']!=0 ){
				$this->data['output'] = $crud->render();
				$breadcrums[]='<a class="current" href="'.site_url('main/aliados').'">Patrocinadores</a>';
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
