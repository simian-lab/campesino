<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class novedades extends Main {

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
		$crud->set_table('PRO_PROMOCIONES');
		$crud->set_subject('Novedades');
		
                    $crud->display_as('PRO_NOMBRE','Titulo')
		        ->display_as('PRO_DESCRIPCION','Descripcion');
			
		$crud->fields('PRO_NOMBRE','PRO_DESCRIPCION');
        $crud->required_fields('PRO_NOMBRE','PRO_DESCRIPCION');
                   
        $crud->columns('PRO_NOMBRE','PRO_DESCRIPCION');

//		$crud->set_field_upload('PATH','../multimedia/galeria/');
		$crud->set_field_upload('PATH_MARCA','../multimedia/marca/');
//		$crud->callback_after_upload(array($this,'cambiar_img'));

//                $crud->field_type('CATEGORIA','dropdown',array('SPLIT' => 'SPLIT', 'ENTRENAMIENTO' => 'ENTRENAMIENTO'));

		// $crud->unset_texteditor('NOV_DESCRIPCION','full_text');
		// $crud->field_type('NOV_ID','hidden');
		// $crud->field_type('VISIBILITY','true_false');
		// $crud->field_type('NOV_DESCRIPCION','text');

		// $crud->set_language('spanish');
		// $crud->add_action('Imágenes', base_url('/images/insert-image.png'), 'main/imagenes_novedades','');
		
		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Novedades';
		$this->data['encabezado']='Gestión de novedades';

		$breadcrums[]='<a class="current" href="'.site_url('main/novedades').'">Novedades</a>'; 
		$this->salida('example',$this->data, $breadcrums);
	}

	function novedades_home()
	{
	$crud = new grocery_CRUD();

		$crud->set_theme('flexigrid');
		$crud->set_table('NOV_NOVEDADES_HOME');
		$crud->set_subject('Novedades home');
		
                    $crud->display_as('NOV_NOMBRE','Nombre promocion')
		        ->display_as('NOV_IMAGEN','Imagen')
		        ->display_as('FECHA','Fecha de alta')
                            ->display_as('VISIBILITY','Visibilidad');
                    
			
		$crud->fields('NOV_NOMBRE','NOV_IMAGEN','FECHA','VISIBILITY');
                    $crud->required_fields('NOV_NOMBRE','NOV_IMAGEN','FECHA','VISIBILITY');
                   
                    $crud->columns('NOV_NOMBRE','NOV_IMAGEN','FECHA','VISIBILITY');

		$crud->set_field_upload('NOV_IMAGEN','../multimedia/novedades/');

//                $crud->field_type('CATEGORIA','dropdown',array('SPLIT' => 'SPLIT', 'ENTRENAMIENTO' => 'ENTRENAMIENTO'));

		$crud->field_type('FECHA','datetime');
		$crud->field_type('NOV_NOMBRE','String');
		$crud->field_type('VISIBILITY','true_false');
                    
		$crud->set_language('spanish');
//		$crud->add_action('Imágenes', base_url('/images/insert-image.png'), 'main/promociones','');
		$this->data['introduccion'] = 'El tamaño de las imagenes debe ser de 485px de Ancho x 150px de Alto';
		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Novedades home';
		$this->data['encabezado']='Gestión de novedades de la home';

		$breadcrums[]='<a class="current" href="'.site_url('main/novedades_home').'">Promociones home</a>'; 
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
                              $image_crud->set_table('NOVEDADES_MULTIMEDIA');
			$image_crud->set_primary_key_field('ID');
			$image_crud->set_url_field('PATH');
			//$image_crud->set_field_upload( 'jpg|jpeg|gif|png');

			
			$image_crud->set_color_bg('#fff');
//			$image_crud->set_width(700);

			$image_crud->set_image_path('../multimedia/original')
			->set_image_path_ampliada('../multimedia/ampliada')
			->set_image_path_thumbs('../multimedia/images')
//			->set_field_extra('IMG_FECHA',date('Y-m-d H:i:s'))->set_relation_field('NOV_ID'->set_relation_field('NOV_ID')
			->set_relation_field('NOV_ID');

		$this->data['output'] = $output = $image_crud->render();

		$this->data['titulo']='Imagenes novedades';
		$this->data['encabezado']='Gestión de imágenes';

		$breadcrums[]='<a class="current" href="'.site_url('main/album').'">Novedades</a>'; 
		$this->salida('example',$this->data, $breadcrums); 
		//
	}	
          
	function imagenes_VMOD($id = NULL)
	{
		
		//Busco los tamaños del banner
//		$this->load->model('banner_model');
		$this->load->library('image_CRUD');


//			$image_crud = new image_CRUD();
			$image_crud = new grocery_CRUD();

                              //relacion 
//                              $image_crud->set_table('NOVEDADES_NOVXMUL');
//                              $image_crud->set_relation_n_n('Imagenes', 'NOV_NOVEDADES', 'MUL_MULTIMEDIA', 'NOV_ID', 'MUL_ID');

                              $image_crud->set_table('NOVEDADES_MULTIMEDIA');
//                              $image_crud->set_relation_n_n('Imagenes', 'NOVEDADES_NOVXMUL', 'NOV_NOVEDADES', 'NOV_ID', 'NOV_ID');
                              $image_crud->set_relation('NOV_ID', 'NOV_NOVEDADES', 'NOV_ID');
                              $image_crud->where('NOVEDADES_MULTIMEDIA.NOV_ID',$id);
                               //Fin relacion
                              
//			$image_crud->set_primary_key_field('IMG_ID');
//			$image_crud->set_primary_key_field('NXM_ID');
//			$image_crud->set_url_field('IMG_IMAGEN');
//			$image_crud->set_field_upload( 'jpg|jpeg|gif|png');

//			$image_crud->set_table('IMG_IMAGEN');
//			$image_crud->set_table('MUL_MULTIMEDIA');
//			$image_crud->set_color_bg('#fff');
//			$image_crud->set_width(700);

//			$image_crud->set_image_path('../multimedia/galeria/originales')
//			->set_image_path_ampliada('../multimedia/galeria/ampliada')
//			->set_image_path_thumbs('../multimedia/galeria/thumbs')
//			->set_field_extra('IMG_FECHA',date('Y-m-d H:i:s'))
//			->set_relation_field('ALB_ID');

                     /* ********* */
//                    $image_crud->columns('NXM_ID','NOV_ID', 'MUL_ID');
                    $image_crud->columns('NOV_ID','PATH');
		$this->data['output'] = $output = $image_crud->render();


		$this->data['titulo']='Imágenes por álbum';
		$this->data['encabezado']='Gestión de imágenes';

		$breadcrums[]='<a class="current" href="'.site_url('main/album').'">Álbum</a>'; 
		$this->salida('example',$this->data, $breadcrums); 
		//
	}	


}