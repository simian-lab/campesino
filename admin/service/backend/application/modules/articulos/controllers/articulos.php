<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class articulos extends Main {

	function __construct()
	{
		 
		parent::__construct();
		
		$this->load->database();
		
		$this->load->library('grocery_crud');	
		$this->load->helper('url');
	
	}

	
	function index()
	{
		
		$this->load->model('articulos_model');

		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->where('AUTORIZADO','1');
		$crud->or_where('AUTORIZADO',null);
		$crud->set_table('ART_ARTICULOS');
		$crud->set_subject('Articulos');
		 $state = $crud->getState();

		 /*CONTROL*/
		 if( $state!='upload_file'){
			 $segmento=$this->uri->segment(4);
			 if( isset($segmento) && !empty($segmento) ){
		 		$result = $this->articulos_model->control_articulo($this->session->userdata('sadmin_user_id'));
		 	// print_r($result);

    	          if($result[0]['RESPUESTA']!=0 ){
	 	          	$this->data['output'] =" <h1>No tenes permiso para acceder esta seccion</h1>" ;// $output = $crud->render();
	 	            $breadcrums[]='<a class="current" href="'.site_url('main/articulos').'">Articulos</a>'; 
	 	          	$this->data['titulo']='Permiso denegado';
	 	          	$this->data['encabezado']='Error';
	 	          	$this->error('example',$this->data,$breadcrums);
	 	          	die();
	 	          }
		 	}
		 }
		 /*CONTROL*/
		


        $crud->display_as('ART_TITULO','Titulo')
	         ->display_as('ART_DESCRIPCION','Descripcion')
	         ->display_as('ART_IMAGEN','Imagen (608x182) o (607x686)')
	         ->display_as('ART_AUTOR','Autor')
	         ->display_as('ART_DETALLE','Detalle')
	         ->display_as('ART_ETIQUETAS','Etiqueta')
	         ->display_as('ART_EVENTO','Evento')
	         ->display_as('VISIBILITY','Visibilidad')
	         ->display_as('ART_FECHA','Fecha')
	         ->display_as('ART_URL','Url')
	         ->display_as('TAGS_ID','tag id')
	         ->display_as('TAGS_NOMBRE','Tag nombre');
		 
		$crud->order_by('ART_FECHA','DESC');
		$crud->unset_read();

		// CAMPOS POR DEFAULT
		$this->data= array('autor'=>$this->session->userdata('username') . ' ('.$this->session->userdata('email').')' , 'ident'=>$this->session->userdata('sadmin_user_id') );

		//***************************	Relacion de tablas ***************************	
		$crud->set_relation_n_n('Tags', 'TAG_ARTICULOS', 'TAGS_NOMBRES', 'TAG_ARTICULO_ID', 'TAGS_ID', 'TAGS_NOMBRE' );
		//***************************	Relacion de tablas ***************************	


        $crud->fields('ART_TITULO','ART_IMAGEN','ART_DESCRIPCION','ART_DETALLE','ART_AUTOR','Tags','VISIBILITY','ART_FECHA','ART_USER_CREADOR','ART_USER_ULTIMO','ART_USER_AUTORIZADOR','ART_SLUG');
        $crud->required_fields('ART_TITULO','ART_DESCRIPCION','ART_IMAGEN', 'ART_FECHA'); 
        $crud->columns('ART_TITULO','ART_DESCRIPCION','Tags','VISIBILITY','ART_AUTOR','ART_FECHA');

		$crud->set_field_upload('ART_IMAGEN','multimedia/articulos/');

		$crud->unset_texteditor('ART_DESCRIPCION','full_text');
		
		$crud->field_type('ART_TITULO','String');
		$crud->field_type('ART_DESCRIPCION','text');
		$crud->field_type('ART_DETALLE','text');
        $crud->field_type('Tags','multiselect');    // dropdown
		$crud->field_type('ART_USER_CREADOR','invisible');  //hidden //invisible
		$crud->field_type('ART_USER_ULTIMO','invisible');  //hidden //invisible
		$crud->field_type('ART_AUTOR','invisible');
		$crud->field_type('ART_USER_ULTIMO','invisible');
		$crud->field_type('ART_USER_AUTORIZADOR','invisible');
		$crud->field_type('ART_SLUG', 'invisible');
        $crud->unique_fields('ART_TITULO'); // valida que sea unico

		$crud->set_rules('ART_TITULO','Título','required|max_length[70]');
		$crud->set_rules('ART_DESCRIPCION','Descripción','required|max_length[90]');
		
		$crud->callback_after_upload(array($this,'mover_imagen'));
        $crud->callback_before_insert(array($this,'before_after_insert')); //  antes de insertar
		$crud->callback_before_update(array($this,'limpiar_textos_slug'));
		$crud->callback_before_upload(array($this,'before_image_upload'));

		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Articulos';
		$this->data['encabezado']='Gestión de articulos';


		$breadcrums[]='<a class="current" href="'.site_url('main/articulos').'">Articulos</a>';
		$this->salida('example',$this->data, $breadcrums);
	}

/* ****************************************************** */

/**
 * Verifies if the file has a valid image format.
 * @param  String $file_name The image file name
 * @return boolean           True if it's valid. False otherwise.
 */
function image_is_valid($file_name) {
	$file_format = explode('.', $file_name)[1];
	$accepted_image_formats = array('jpg', 'png', 'jpeg');
	$is_valid = in_array($file_format, $accepted_image_formats);
	return $is_valid;
}

/**
 * [example_callback_before_upload description]
 * @param  [type] $files_to_upload [description]
 * @param  [type] $field_info      [description]
 * @return [type]                  [description]
 */
function before_image_upload($files_to_upload, $field_info) {
	$keys = array_keys($files_to_upload);
	$file_name = $files_to_upload[$keys[0]]['name'];
	$file_size = $files_to_upload[$keys[0]]['size'];

	if($this->image_is_valid($file_name)) {
		if($file_size < 1000000) {
			return true;
		} else {
			return 'El archivo de la imagen es muy grande';
		}
	} else {
		return 'El formato de imagen no es válido';
	}
}

function before_after_insert($post_array){
	$this->load->helper('htmlpurifier');

    $post_array['AUTORIZADO']='0';
    $post_array['ART_USER_CREADOR']=$this->session->userdata('sadmin_user_id');
    $post_array['ART_USER_ULTIMO']=$this->session->userdata('sadmin_user_id');
    $post_array['ART_USER_AUTORIZADOR']=$this->session->userdata('sadmin_user_id');
    $post_array['ART_AUTOR']=$this->session->userdata('username');
    $result_data=$this->sanar_string($post_array['ART_TITULO']);
    $post_array['ART_SLUG'] = url_title($result_data, 'dash', TRUE);

    $file_name = $post_array['ART_IMAGEN'];
	$file_name = preg_replace("/([^a-zA-Z0-9\.\-\_]+?){1}/i", '', $file_name);
	$file_name = str_replace(" ", "", $file_name);
	$post_array['ART_IMAGEN'] = $file_name;

	if(!$this->image_is_valid($file_name)) {
		$post_array['ART_IMAGEN'] = '';
	}

	return $post_array;
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

 //Mover imagenes a la caepeta que se comparte
function mover_imagen($uploader_response,$field_info, $files_to_upload){

	$this->load->library('image_moo');
	$file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name; 
		 if( !$this->is_image($file_uploaded)){

		 	@unlink($file_uploaded);
	 		return 'Formato de image incorrecto.';
	 	}
	 	
 	$ndestino =  '../static/multimedia/articulos/'.$uploader_response[0]->name; 
	copy($file_uploaded, $ndestino);
	return true;
}

/**
 * [limpiar_textos_slug description]
 * @param  [type] $post_array [description]
 * @return [type]             [description]
 */
function limpiar_textos_slug($post_array){
	$this->load->helper('htmlpurifier');
	$post_array['ART_DETALLE'] = $post_array['ART_DETALLE'];
	$result_data=$this->sanar_string($post_array['ART_TITULO']);
	$post_array['ART_SLUG'] = url_title($result_data, 'dash', TRUE);
	$file_name = $post_array['ART_IMAGEN'];
	$file_name = preg_replace("/([^a-zA-Z0-9\.\-\_]+?){1}/i", '', $file_name);
	$file_name = str_replace(" ", "", $file_name);
	$post_array['ART_IMAGEN'] = $file_name;

	if(!$this->image_is_valid($file_name)) {
		$post_array['ART_IMAGEN'] = '';
	}

	return $post_array;
}

function sanar_string($cadena=''){
	$cadena = strtolower($cadena);
	$no_permitidos=array('á','é','í','ó','ú','ñ');
	$reemplaza_por=array('a','e','i','o','u','n');
	$result_array=str_replace($no_permitidos,$reemplaza_por,$cadena);
	return $result_array;
}

//****************************************************************************************











}