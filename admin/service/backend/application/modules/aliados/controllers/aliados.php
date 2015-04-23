<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aliados extends Main {

	function __construct()
	{
		parent::__construct();

		$this->load->database();

		$this->load->library('grocery_crud');
		$this->load->helper('url');
		}

		/**
		 * [update_ally_on_user description]
		 * @param  array $post_array Data from the update.
		 * @param  int $primary_key Primary key of the ally.
		 */
		function update_ally_on_user($post_array, $primary_key) {
			$user_id = $post_array['PAT_ALIADO'];
			$ally_id = $primary_key;
			if($user_id != '') {
				$query = 'SELECT PAT_ID FROM PAT_PATROCINADORES WHERE PAT_ALIADO = ? AND PAT_ID != ?';
				$result = $this->db->query($query, array($user_id, $ally_id));
				$ids = $result->result();
				if(!empty($ids)) {
					foreach($ids as $id) {
						$pat_id = $id->PAT_ID;
						$query = 'UPDATE PAT_PATROCINADORES SET PAT_ALIADO = NULL WHERE PAT_ID = ?';
						$this->db->query($query, array($pat_id));
					}
				}

				$query = 'UPDATE admin_users SET ally_id = ? WHERE id = ?';
				$this->db->query($query, array($ally_id, $user_id));
			} else {
				$query = 'UPDATE admin_users SET ally_id = NULL WHERE ally_id = ?';
				$this->db->query($query, array($ally_id));
			}
		}

		// Metodo para carga de albunes
		function index()
		{
			$this->load->model('aliados_model');

			$crud = new grocery_CRUD();

			$state = $crud->getState();

			if($state == "edit") {
				$state_info = $crud->getStateInfo();
				$allies = $this->aliados_model->get_user_aliados($state_info->primary_key);
			} else if ($state == "add") {
				$allies = $this->aliados_model->get_user_aliados("add");
			} else {
				$allies = $this->aliados_model->get_user_aliados('list');
			}

			/*
			Aquí me aseguro que la variable $allies sea un arreglo así la base de datos esté vacía.
			Así prevengo el error que genera Grocery Crud al intentar llenar el dropdown.
			- Nicolás, 23 Apr 2015
			 */
			if(is_array($allies)) {
				asort($allies);
			} else {
				$allies = array('');
			}

			if($state == 'insert_validation' || $state == 'update_validation'){
				$url = $this->input->post('PAT_URL_EVENT');

				if($url != "") {
					if (! filter_var($url, FILTER_VALIDATE_URL)){

						echo '<textarea>'.json_encode(
														array(
																	'success'	=>	false,
																	'error_message'	=>"<p>URL inválida</p>",
																	"error_fields"	=>	array("PRO_URL"	=>	"El campo Url<br>(Debe incluir <strong>http:\/\/<\/strong> ) es requerido.")
															)
													).'</textarea>';
						die();

					}
				}
			}

			$crud->set_theme('flexigrid');
			$crud->set_table('PAT_PATROCINADORES');
			$crud->set_subject('patrocinadores');

			$crud->display_as('PAT_ID','TID')
			->display_as('PAT_NOMBRE','Nombre')
			->display_as('PAT_LOGO','Imagen <br>(204x113) max 100kb')
			->display_as('PAT_IDENTIFICADOR','Identificador Smart')
			->display_as('PAT_FECHA','Fecha')
			->display_as('PAT_URL','Url')
			->display_as('PAT_URL_EVENT','Url evento')
			->display_as('VISIBILITY','Visibilidad')
			->display_as('PAT_PAQUETE', 'Paquete')
			->display_as('PAT_ALIADO', 'Usuario');
			$crud->unset_read();
			$this->data= array('autor'=>$this->session->userdata('username') . ' ('.$this->session->userdata('email').')' , 'ident'=>$this->session->userdata('sadmin_user_id') );

			$crud->fields('PAT_ID','PAT_NOMBRE','PAT_LOGO','PAT_URL', 'PAT_URL_EVENT', 'PAT_FECHA','VISIBILITY','PAT_USER_CREADOR','PAT_USER_ULTIMO', 'PAT_PAQUETE', 'PAT_ALIADO', 'PAT_HASH_URL_EVENT');
			$crud->required_fields('PAT_NOMBRE','PAT_LOGO','PAT_FECHA','VISIBILITY');
			$crud->columns('PAT_NOMBRE','PAT_FECHA','VISIBILITY', 'PAT_PAQUETE', 'PAT_ALIADO');

			$crud->callback_before_update(array($this,'encrypt_password_callback'));

			$crud->set_field_upload('PAT_LOGO','multimedia/aliados/');
			$crud->callback_after_upload(array($this,'mover_imagen'));


			/*CONTROL*/
			$result = $this->aliados_model->control_aliado($this->session->userdata('sadmin_user_id'));
			//print_r($result);
			if($result[0]['RESPUESTA']!=0 ){
				$this->data['output'] =" <h1>No tenes permiso para acceder esta seccion</h1>" ;
				$breadcrums[]='<a class="current" href="'.site_url('main/aliados').'">Patrocinadores</a>';
				$this->data['titulo']='Permiso denegado';
				$this->data['encabezado']='Error';
				$this->error('example',$this->data,$breadcrums);
				die();
				}
				/*CONTROL*/

				$crud->field_type('PAT_ID','invisible');
				$crud->field_type('PAT_NOMBRE','String');
				$crud->field_type('PAT_IDENTIFICADOR','String');
				$crud->field_type('PAT_FECHA','datetime');
				$crud->field_type('PAT_URL','STRING');
				$crud->field_type('PAT_URL_EVENT','STRING');
				$crud->field_type('VISIBILITY','true_false');
				$crud->field_type('PAT_USER_CREADOR','invisible');
				$crud->field_type('PAT_USER_ULTIMO','invisible');
				$packages = array('Sin paquete', 'Oro Plus', 'Oro', 'Plata', 'Bronce', 'Platino', 'General');
				$crud->field_type('PAT_PAQUETE', 'dropdown', $packages);
				$crud->field_type('PAT_ALIADO', 'dropdown', $allies);
				$crud->field_type('PAT_HASH_URL_EVENT','invisible');

				$crud->callback_before_insert(array($this,'before'));
				$crud->callback_before_update(array($this,'before'));
				$crud->callback_after_insert(array($this, 'update_ally_on_user'));
				$crud->callback_after_update(array($this, 'update_ally_on_user'));

				$crud->set_language('spanish');

				$this->data['output'] = $output = $crud->render();
				$this->data['titulo']='Patrocinadores';
				$this->data['encabezado']='Patrocinadores';

				$breadcrums[]='<a class="current" href="'.site_url('main/aliados').'">Patrocinadores</a>';
				$this->salida('example',$this->data, $breadcrums);
				}


				/* ****************************************************************************************** */

				function before($post_array) {
					$this->limpiar_datos($post_array);

					if($post_array["PAT_URL_EVENT"] != "") {
						$post_array['PAT_HASH_URL_EVENT'] = $this->generar_hash($post_array["PAT_URL_EVENT"]);
					}
					return $post_array;
				}

				function generar_hash($string) {
					return sha1($string);
				}

				function mover_imagen($uploader_response,$field_info, $files_to_upload){
					$this->load->library('image_moo');
					$file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name;
					if( !$this->is_image($file_uploaded)){
						@unlink($file_uploaded);
						return 'Formato de image incorrecto.';
						}
						$ndestino =  '../static/multimedia/aliados/'.$uploader_response[0]->name;
						copy($file_uploaded, $ndestino);
						return true;
						}

						function is_image($path){

							$a = getimagesize($path);
							$image_type = $a[2];

							if (in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
							{
								return true;
								}
								return false;
								}


								function limpiar_datos($post_array){

									$post_array['PAT_USER_CREADOR'] = $this->session->userdata('sadmin_user_id');
									$post_array['PAT_USER_ULTIMO'] =$this->session->userdata('sadmin_user_id');

									return $post_array;

									}

								}
