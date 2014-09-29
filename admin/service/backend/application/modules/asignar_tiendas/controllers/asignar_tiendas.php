<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Asignar_tiendas extends Main {

	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		
		$this->load->library('grocery_crud');	
		$this->load->helper('url');
		$this->load->helper('text');
	}

	// Metodo para carga de albunes
	function index($id=null)
	{

			$this->load->model('asignar_tiendas_model');
		    $result = $this->asignar_tiendas_model->get_grupo($this->session->userdata('sadmin_user_id'));//grupo del usuario actual
		    // print_r($result);
		    $usuarios= $this->asignar_tiendas_model->get_user_x_grupo('3');
		    $arrUsuarios = $this->asignar_tiendas_model->get_user_aliados();

		    // print_r( $arrpaquetes);

			$breadcrums[]='<a class="current" href="'.site_url('main/list_user').'">Usuarios</a>'; 

			$this->load->library('grocery_crud');
			$crud = new grocery_CRUD();
			$crud->set_language("spanish"); //Defino el lenguaje
			$crud->set_theme('flexigrid'); // Defino el tema
			$crud->set_table('TIE_TIENDAS'); // Tabla a insertar/editar
			$crud->set_subject('Tiendas'); // Titulo

			$crud->unset_read();

			 //Elimina el boton agregar
	
			 
			 /*$q ='';
		 if($result['group_id']==3 or $result['group_id']==1 or $result['group_id']==4  ){ //Habilitar para filtrar solo para siertos grupos de usuario

		 	$i=1;
		 	$total_user=count($usuarios);
		 	foreach($usuarios as $key=>$valor){
		 		if($i<$total_user){
	 
		 			 $crud->or_where('id',$valor['user_id']);
		 		}else{
		 			$crud->where('id',$valor['user_id']);
		 		}
		 	 	$i++;
		 	}

			   }*/
		 

			// Defino titulos de los campos 
				$crud->display_as('TIE_NOMBRE','Nombre tienda')
				->display_as('VISIBILITY','Visibilidad')
				->display_as('TIE_SLUG','Slug tienda')
				->display_as('TIE_ID_USER','Usuario')
				->display_as('TIE_FECHA_ALTA', 'Fecha')
				->display_as('TIE_LOGO_VISA', 'Logo Visa')
				->display_as('TIE_TEXTO_VISA', 'Texto Logo Visa');

		//$crud->order_by('TIE_FECHA_ALTA','DESC');

			// Columnas que muestra la tabla
				// $crud->columns('username','email','first_name','last_name','Paquete');
				$crud->columns('TIE_NOMBRE','TIE_ID_USER','VISIBILITY','TIE_FECHA_ALTA');
				 $crud->fields('TIE_NOMBRE','TIE_ID_USER','VISIBILITY','TIE_FECHA_ALTA','TIE_SLUG','TIE_LOGO_VISA','TIE_TEXTO_VISA');
				// $crud->fields('username','email','first_name','last_name');

			
			// Defino el tipo de campo 
		$crud->set_rules('TIE_NOMBRE','Nombre tienda','max_length[25]');
		$crud->field_type('TIE_NOMBRE', 'String');
		$crud->field_type('TIE_ID_USER', 'dropdown',$arrUsuarios);
		$crud->field_type('VISIBILITY', 'true_false');
		$crud->field_type('TIE_SLUG', 'invisible');
		$crud->field_type('TIE_LOGO_VISA', 'true_false');
		$crud->field_type('TIE_TEXTO_VISA', 'String','max_length[20]');

		$crud->callback_before_insert(array($this,'generar_slug')); //  antes de insertar
		$crud->callback_before_update(array($this,'generar_slug'));
		//$crud->field_type('TIE_ID_USER', 'invisible');
		// $crud->field_type('paquete', 'multiselect',$arrpaquetes);

		$crud->set_language('spanish');
		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Asignar tienda a usuarios';
		$this->data['encabezado']='Asignar tienda a usuarios';

		$breadcrums[]='<a class="current" href="'.site_url('main/asignar_paquetes_aliados').'">Asignar paquetes a usuarios</a>'; 
		$this->salida('example',$this->data, $breadcrums);
	}


/**************** METODOS CALLBACK ****************/

// function _add_field_callback($parameter){
// 	$this->load->helper('form');
// 	$this->load->model('asignar_tiendas_model');

// 	 $arrpaquetes= $this->asignar_tiendas_model->get_paquetes();
//    //load db model
//    //call the result and return as dropdown input field with selected selection when value = $parameter 

//    // $value = !empty($this->my_test_parameter) ? $this->my_test_parameter : '';

//     $value = '0';
//     return form_dropdown('Paquetes', $arrpaquetes, 'large');

//    //here you can also use the form_dropdown of codeigniter (http://ellislab.com/codeigniter/user-guide/helpers/form_helper.html)
// } 


// function insert_data_user_tags($post_array){
// 	// $post_array
// 		$this->load->model('tag_model');
// 		$result = $this->tag_model->insert_tag($this->data['ident'],$primary_key);
// }

	public function generar_slug($post_array){
	    $post_array['TIE_SLUG'] = url_title(convert_accented_characters($post_array['TIE_NOMBRE']), 'dash', TRUE);
	    //$post_array['TIE_LOGO_VISA'] = 1;
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