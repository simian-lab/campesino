<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marcas extends Main {

	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		
		$this->load->library('grocery_crud');	
		$this->load->helper('url');
		$this->load->helper('text');
	}

	// Metodo para carga de albunes
	function index()
	{

		$this->load->model('marcas_model');

		$crud = new grocery_CRUD();

		$crud->set_theme('flexigrid');
		$crud->set_table('MAR_MARCAS');
		$crud->set_subject('Marcas');
		
		// $this->data= array('autor'=>$this->session->userdata('username') . ' ('.$this->session->userdata('email').')' , 'ident'=>$this->session->userdata('sadmin_user_id') );

                $crud->display_as('MAR_ID','MID')
                ->display_as('MAR_NOMBRE','Nombre')
		        ->display_as('MAR_FECHA_ALTA','Fecha')
		        ->display_as('VISIBILITY','Visibilidad')
		        ->display_as('MAR_SLUG','slug');

					$crud->fields('MAR_NOMBRE','MAR_FECHA_ALTA','VISIBILITY','MAR_SLUG');
                    $crud->required_fields('MAR_NOMBRE','MAR_FECHA_ALTA','VISIBILITY');
                    $crud->columns('MAR_NOMBRE','MAR_FECHA_ALTA','VISIBILITY');
                    $crud->unset_read();
                    /*CONTROL*/
                    /*$result = $this->marcas_model->control_tag($this->session->userdata('sadmin_user_id'));
                    // print_r($result);
                    	if($result[0]['RESPUESTA']!=0 ){
                    	          	$this->data['output'] =" <h1>No tenes permiso para acceder esta seccion</h1>" ;// $output = $crud->render();
                    	            $breadcrums[]='<a class="current" href="'.site_url('main/promociones').'">Promociones</a>'; 
                    	          	$this->data['titulo']='Permiso denegado';
                    	          	$this->data['encabezado']='Error';
                    	          	$this->error('example',$this->data,$breadcrums);
                    	          	die();
                    	          }*/
                    /*CONTROL*/

                    $crud->field_type('MAR_NOMBRE','String');
                    $crud->field_type('MAR_ID','invisible');
                    $crud->field_type('MAR_SLUG','invisible');
                    $crud->field_type('VISIBILITY','true_false');

                    $crud->callback_before_insert(array($this,'limpiar_datos'));
                    $crud->callback_before_update(array($this,'limpiar_datos'));

		$crud->set_language('spanish');
		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Marcas';
		$this->data['encabezado']='Marcas';

		$breadcrums[]='<a class="current" href="'.site_url('main/tags').'">Tags</a>'; 
		$this->salida('example',$this->data, $breadcrums);
	}



	function limpiar_datos($post_array){

	       	    $post_array['TAGS_USER_CREADOR'] = $this->session->userdata('sadmin_user_id');
	       	    $post_array['TAGS_USER_ULTIMO'] =$this->session->userdata('sadmin_user_id');
	       	    $post_array['AUTORIZADO'] =$this->session->userdata('sadmin_user_id');

	       	    $post_array['MAR_SLUG'] = url_title(convert_accented_characters($post_array['MAR_NOMBRE']), 'dash', TRUE);

	        	return $post_array;

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