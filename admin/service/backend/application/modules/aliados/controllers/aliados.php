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
		        ->display_as('VISIBILITY','Visibilidad');
		        $crud->unset_read();
			$this->data= array('autor'=>$this->session->userdata('username') . ' ('.$this->session->userdata('email').')' , 'ident'=>$this->session->userdata('sadmin_user_id') );

					// $crud->fields('PAT_ID','PAT_NOMBRE','PAT_LOGO','PAT_IDENTIFICADOR','PAT_URL','PAT_FECHA','VISIBILITY','PAT_USER_CREADOR','PAT_USER_ULTIMO','Paquete');
					$crud->fields('PAT_ID','PAT_NOMBRE','PAT_LOGO','PAT_URL','PAT_FECHA','VISIBILITY','PAT_USER_CREADOR','PAT_USER_ULTIMO');
                    $crud->required_fields('PAT_NOMBRE','PAT_LOGO','PAT_FECHA','VISIBILITY');
                    $crud->columns('PAT_NOMBRE','PAT_FECHA','VISIBILITY');

					$crud->set_field_upload('PAT_LOGO','multimedia/aliados/');
                    $crud->callback_after_upload(array($this,'mover_imagen'));

					
					/*CONTROL*/
					$result = $this->aliados_model->control_aliado($this->session->userdata('sadmin_user_id'));
					// print_r($result);
						if($result[0]['RESPUESTA']!=0 ){
						          	$this->data['output'] =" <h1>No tenes permiso para acceder esta seccion</h1>" ;// $output = $crud->render();
						            $breadcrums[]='<a class="current" href="'.site_url('main/promociones').'">Promociones</a>'; 
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
                    $crud->field_type('VISIBILITY','true_false');
                    $crud->field_type('PAT_USER_CREADOR','invisible');
                    $crud->field_type('PAT_USER_ULTIMO','invisible');
                    $crud->field_type('Paquete','dropdown');


                    $crud->callback_before_insert(array($this,'limpiar_datos'));
                    $crud->callback_before_update(array($this,'limpiar_datos'));

		$crud->set_language('spanish');
//		$crud->add_action('Imágenes', base_url('/images/insert-image.png'), 'main/imagenes_locales','');
		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Patrocinadores';
		$this->data['encabezado']='Patrocinadores';

		$breadcrums[]='<a class="current" href="'.site_url('main/aliados').'">Patrocinadores</a>'; 
		$this->salida('example',$this->data, $breadcrums);
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

/* ****************************************************************************************** */
 

function limpiar_datos($post_array){

       	    $post_array['PAT_USER_CREADOR'] = $this->session->userdata('sadmin_user_id');
       	    $post_array['PAT_USER_ULTIMO'] =$this->session->userdata('sadmin_user_id');

        	return $post_array;

}
/**/

	function insertar_aliado_id($post_array,$primary_key){
	 echo "<script>alert('mensaje')</script>";
		   // return true;
	}



	function update_aliado_id($post_array,$primary_key)
	{
	    $user_logs_update = array(
	        "PAT_ID" => $primary_key
	    );
	 
	    $this->db->update('PXP_PATROCINADORXPAQUETE',$user_logs_update,array('PAT_ID' => $primary_key));
	   // return true;
	}

	function field_callback_user_creador($value = '', $primary_key = null){
		    return '<input type="text" maxlength="50" value="'.$this->data['ident'].'" name="PAT_USER_CREADOR" readonly style="display:none">';
		}


	function field_callback_user_ultimo($value = '', $primary_key = null){
		    return '<input type="text" maxlength="50" value="'.$this->data['ident'].'" name="PAT_USER_ULTIMO" readonly style="display:none">';
		}


	function cambiar_img($uploader_response,$field_info, $files_to_upload)
	{
		$this->load->library('image_moo');
	 
		//Is only one file uploaded so it ok to use it with $uploader_response[0].
		$file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name; 
	 
		$this->image_moo->load($file_uploaded)->set_background_colour("#FFF")->resize(236,200,TRUE)->save($file_uploaded,true);
	//	$this->image_moo->load('DSC01707.JPG')->set_background_colour("#49F")->resize(216,231,TRUE)->save($file_uploaded,true);
		return true;
	} 


          function imagenes($upload = NULL,$id = NULL)
	{
		
		//Busco los tamaños del banner
		$this->load->model('banner_model');
		$this->load->library('image_CRUD');

			$image_crud = new image_CRUD();
                              $image_crud->set_table('LOCALES_MULTIMEDIA');
			$image_crud->set_primary_key_field('ID');
			$image_crud->set_url_field('PATH');
			//$image_crud->set_field_upload( 'jpg|jpeg|gif|png');

			$image_crud->set_color_bg('#fff');
//			$image_crud->set_width(700);

			$image_crud->set_image_path('../multimedia/original')
			->set_image_path_ampliada('../multimedia/ampliada')
			->set_image_path_thumbs('../multimedia/images')
//			->set_field_extra('IMG_FECHA',date('Y-m-d H:i:s'))->set_relation_field('NOV_ID'->set_relation_field('NOV_ID')
			->set_relation_field('LOC_ID');

		$this->data['output'] = $output = $image_crud->render();

		$this->data['titulo']='Imagenes novedades';
		$this->data['encabezado']='Gestión de imágenes';

		$breadcrums[]='<a class="current" href="'.site_url('main/locales').'">Locales</a>'; 
		$this->salida('example',$this->data, $breadcrums); 
	}	
          


}