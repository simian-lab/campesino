<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clasificacion extends Main {

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

		$crud = new grocery_CRUD();

		$crud->set_theme('flexigrid');
		$crud->set_table('CLA_CLASIFICACION');
		$crud->set_subject('Clasificacion');
		
                    $crud->display_as('CLA_NOMBRE','Clasificacion')
                            ->display_as('VISIBILITY','Visible');


		$crud->fields('CLA_NOMBRE','VISIBILITY');
                    $crud->required_fields('CLA_NOMBRE','VISIBILITY');

                    $crud->columns('CLA_NOMBRE','VISIBILITY');

                    $crud->field_type('VISIBILITY','true_false');
                    $crud->field_type('CLA_NOMBRE','String');

		$crud->set_language('spanish');
//		$crud->add_action('Imágenes', base_url('/images/insert-image.png'), 'main/imagenes_locales','');

		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Clasificacion';
		$this->data['encabezado']='Gestión de clasificacion';

		$breadcrums[]='<a class="current" href="'.site_url('main/pelicula_clasificacion').'">Clasificacion</a>'; 
		$this->salida('example',$this->data, $breadcrums);
	
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