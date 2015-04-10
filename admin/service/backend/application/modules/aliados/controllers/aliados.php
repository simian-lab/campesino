<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aliados extends Main {

	function __construct()
	{
		parent::__construct();

		$this->load->database();

		$this->load->library('grocery_crud');
		$this->load->helper('url');
		}

		// Metodo para carga de albunes
		function index()
		{
			$this->load->model('aliados_model');

			$allies = $this->aliados_model->get_user_aliados();

			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			$crud->set_table('PAT_PATROCINADORES');
			$crud->set_subject('patrocinadores');

			$crud->display_as('PAT_ID','TID')
			->display_as('PAT_NOMBRE','Nombre')
			->display_as('PAT_LOGO','Imagen <br>(100x73) - png')
			->display_as('PAT_IDENTIFICADOR','Identificador Smart')
			->display_as('PAT_FECHA','Fecha')
			->display_as('PAT_URL','Url')
			->display_as('PAT_URL_EVENT','Url evento')
			->display_as('VISIBILITY','Visibilidad')
			->display_as('PAT_PAQUETE', 'Paquete')
			->display_as('PAT_ALIADO', 'Aliado');
			$crud->unset_read();
			$this->data= array('autor'=>$this->session->userdata('username') . ' ('.$this->session->userdata('email').')' , 'ident'=>$this->session->userdata('sadmin_user_id') );

			$crud->fields('PAT_ID','PAT_NOMBRE','PAT_LOGO','PAT_URL', 'PAT_URL_EVENT', 'PAT_FECHA','VISIBILITY','PAT_USER_CREADOR','PAT_USER_ULTIMO', 'PAT_PAQUETE', 'PAT_ALIADO');
			$crud->required_fields('PAT_NOMBRE','PAT_LOGO','PAT_FECHA','VISIBILITY');
			$crud->columns('PAT_NOMBRE','PAT_FECHA','VISIBILITY', 'PAT_PAQUETE');

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

				$crud->callback_before_insert(array($this,'limpiar_datos'));
				$crud->callback_before_update(array($this,'limpiar_datos'));

				$crud->set_language('spanish');

				$this->data['output'] = $output = $crud->render();
				$this->data['titulo']='Patrocinadores';
				$this->data['encabezado']='Patrocinadores';

				$breadcrums[]='<a class="current" href="'.site_url('main/aliados').'">Patrocinadores</a>';
				$this->salida('example',$this->data, $breadcrums);
				}


				/* ****************************************************************************************** */

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
