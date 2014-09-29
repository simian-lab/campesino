<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class asignar_pautas extends Main {

	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		
		$this->load->library('grocery_crud');	
		$this->load->helper('url');
	}

	// Metodo para carga de albunes
	function index($id=null)
	{

		// echo $id;

		$crud = new grocery_CRUD();

		$crud->set_theme('flexigrid');
		$crud->set_table('CAR_CARUSEL_IMAGENES');
		$crud->set_subject('Imagenes pautas');
		$crud->where('PAU_ID',$id);

		// $this->data= array('autor'=>$this->session->userdata('username') . ' ('.$this->session->userdata('email').')' , 'ident'=>$this->session->userdata('sadmin_user_id') );

                $crud->display_as('CAR_TITULO','Titulo')
                ->display_as('CAR_DESCRIPCION','Descripcion')
		        ->display_as('CAR_LINK','Link')
		        ->display_as('VISIBILITY','Visibilidad')
		        ->display_as('PAU_ID','Id pauta')
		        ->display_as('CAR_IMAGEN_SLIDER','Imagen')
		        ->display_as('CAR_FECHA','Fecha');

					$crud->fields('CAR_TITULO','CAR_IMAGEN_SLIDER','CAR_DESCRIPCION','CAR_LINK','VISIBILITY','PAU_ID','CAR_FECHA');
                    $crud->required_fields('CAR_TITULO','CAR_IMAGEN_SLIDER');
                    $crud->columns('CAR_TITULO','VISIBILITY','CAR_FECHA');
                    $crud->unset_read();
                    $crud->field_type('PAQ_NOMBRE','String');
                    $crud->field_type('PAQ_MONTO_PREMIUN','integer');
                    $crud->field_type('PAQ_MONTO_BASICO','integer');
                    $crud->field_type('VISIBILITY','true_false');
                    $crud->field_type('PAQ_FECHA','date');
                    $crud->field_type('PAU_ID','invisible',$id);

                    $crud->set_field_upload('CAR_IMAGEN_SLIDER','../multimedia/pautas/slider/');
                    $crud->callback_after_upload(array($this,'mover_imagen'));


		$crud->set_language('spanish');
		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Asignar pautas';
		$this->data['encabezado']='Asignar pautas';

		$breadcrums[]='<a class="breadcrumbs" href="'.site_url('main/pautas').'">Pautas</a> <a href="">/</a> <a class="current" href="'.site_url('main/asignar_pautas/'.$id).'">Asignar pautas</a>'; 
		$this->salida('example',$this->data, $breadcrums);
	}


/**************** METODOS CALLBACK ****************/
function is_image($path){
     $a = getimagesize($path);
     $image_type = $a[2];

     if (in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
     {
         return true;
     }
     return false;
 }


function mover_imagen($uploader_response,$field_info, $files_to_upload){
		// $this->load->library('image_moo');
		$file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name; 

	 	 if( !$this->is_image($file_uploaded)){

		 	@unlink($file_uploaded);
	 		return 'Formato de image incorrecto.';
	 	}
	 	
	 	$ndestino =  '../static/multimedia/pautas/slider/'.$uploader_response[0]->name; 
		copy($file_uploaded, $ndestino);
		return true;
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