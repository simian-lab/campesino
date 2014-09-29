<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class articulos extends Main {

	function __construct()
	{
		 
		parent::__construct();
		
		$this->load->database();
		
		$this->load->library('grocery_crud');	
		$this->load->helper('url');
	//	$this->output->enable_profiler(TRUE);
	}

	// Metodo para carga de albunes
	function index()
	{

		//$this->output->enable_profiler(TRUE);
		
		$this->load->model('articulos_model');

        //$arrMarcaPais = $this->articulos_model->get_marcapais();
        //$smart_id = $this->articulos_model->get_smart_id();
		
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
		 	            $breadcrums[]='<a class="current" href="'.site_url('main/promociones').'">Promociones</a>'; 
		 	          	$this->data['titulo']='Permiso denegado';
		 	          	$this->data['encabezado']='Error';
		 	          	$this->error('example',$this->data,$breadcrums);
		 	          	die();
		 	          }
		 		}
		 }
		 /*CONTROL*/
		


                $crud->display_as('ART_TITULO','Titulo')
                // ->display_as('ART_ID','ID')
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
		        //->display_as('PAT_IDENTIFICADOR','Smart id');
		        //->display_as('MAP_ID','Marca País');
		 
		 $crud->order_by('ART_FECHA','DESC');
		$crud->unset_read();

		// CAMPOS POR DEFAULT
		$this->data= array('autor'=>$this->session->userdata('username') . ' ('.$this->session->userdata('email').')' , 'ident'=>$this->session->userdata('sadmin_user_id') );

		// $this->data= array();
		//***************************	Relacion de tablas ***************************	
		$crud->set_relation_n_n('Tags', 'TAG_ARTICULOS', 'TAGS_NOMBRES', 'TAG_ARTICULO_ID', 'TAGS_ID', 'TAGS_NOMBRE' );
		//***************************	Relacion de tablas ***************************	


        $crud->fields('ART_TITULO','ART_IMAGEN','ART_DESCRIPCION','ART_DETALLE','ART_AUTOR','Tags','VISIBILITY','ART_FECHA','ART_USER_CREADOR','ART_USER_ULTIMO','ART_USER_AUTORIZADOR','ART_SLUG');
        $crud->required_fields('ART_TITULO','ART_DESCRIPCION','ART_IMAGEN', 'ART_FECHA'); //,'AUTORIZADO'
        $crud->columns('ART_TITULO','ART_DESCRIPCION','Tags','VISIBILITY','ART_AUTOR','ART_FECHA');

		$crud->set_field_upload('ART_IMAGEN','multimedia/articulos/');
		$crud->callback_after_upload(array($this,'mover_imagen'));

		$crud->unset_texteditor('ART_DESCRIPCION','full_text');
		
		// $crud->field_type('ART_ID','hidden');
		$crud->field_type('ART_TITULO','String');
		$crud->field_type('ART_DESCRIPCION','text');
		$crud->field_type('ART_DETALLE','text');
        $crud->field_type('Tags','multiselect');    // dropdown
		$crud->field_type('ART_USER_CREADOR','invisible');  //hidden //invisible
		$crud->field_type('ART_USER_ULTIMO','invisible');  //hidden //invisible
		$crud->field_type('ART_AUTOR','invisible');
		//$crud->field_type('ART_USER_CREADOR','hidden',$this->session->userdata('sadmin_user_id'));
		$crud->field_type('ART_USER_ULTIMO','invisible');
		$crud->field_type('ART_USER_AUTORIZADOR','invisible');
		$crud->field_type('ART_SLUG', 'invisible');
       //$crud->field_type('MAP_ID', 'dropdown', $arrMarcaPais);
       //$crud->field_type('PAT_IDENTIFICADOR', 'dropdown', $smart_id);
       $crud->unique_fields('ART_TITULO'); // valida que sea unico

		
		// $crud->callback_before_insert(array($this,'setear_visibilidad'));
       $crud->callback_before_insert(array($this,'before_after_insert')); //  antes de insertar
		//$crud->callback_before_insert(array($this,'limpiar_textos_slug_insert'));
		$crud->callback_before_update(array($this,'limpiar_textos_slug'));
 		$crud->callback_field('ART_DESCRIPCION',array($this,'limit_text_area'));
		$crud->callback_field('ART_TITULO',array($this,'limit_titulo'));

		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Articulos';
		$this->data['encabezado']='Gestión de novedades';


		$breadcrums[]='<a class="current" href="'.site_url('main/articulos').'">Articulos</a>';
		$this->salida('example',$this->data, $breadcrums);
	}

/* ****************************************************** */

function limit_text_area($value, $primary_key){
	
	return '<textarea id="field-ART_DESCRIPCION" name="ART_DESCRIPCION" maxlength="90">'.$value.'</textarea>';

}

function limit_titulo($value){

	return '<input type="text" id="field-ART_TITULO" name="ART_TITULO" value="'.$value.'" maxlength="70"/>';

}


function before_after_insert($post_array){
 // $pUSER_ID= $this->session->userdata('sadmin_user_id'); // Id de usuario que esta cargando la promo
// $pTIPO = $post_array['PRO_SRC_ID'];

    $post_array['AUTORIZADO']='0';
    // $post_array['PRO_FECHA']=date('Y-m-d h:m:s');
    $post_array['ART_USER_CREADOR']=$this->session->userdata('sadmin_user_id');
    $post_array['ART_USER_ULTIMO']=$this->session->userdata('sadmin_user_id');
    $post_array['ART_USER_AUTORIZADOR']=$this->session->userdata('sadmin_user_id');
    $post_array['ART_AUTOR']=$this->session->userdata('username');

    $this->load->helper('htmlpurifier');

    $post_array['ART_DETALLE'] = $post_array['ART_DETALLE'];
    $result_data=$this->sanar_string($post_array['ART_TITULO']);
    // $post_array['ART_SLUG'] = url_title($this->input->post('ART_TITULO'), 'dash', TRUE);
    $post_array['ART_SLUG'] = url_title($result_data, 'dash', TRUE);


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


	// function field_callback_1($value = '', $primary_key = null){
	// 	    return '<input type="text" maxlength="50" value="'.$this->data['autor'].'" name="ART_AUTOR" readonly style="display:none">';
	// 	}

	function field_callback_user_creador($value = '', $primary_key = null){
		    return '<input type="text" maxlength="50" value="'.$this->data['ident'].'" name="ART_USER_CREADOR" readonly style="display:none">';
		}

	function field_callback_user_ultimo($value = '', $primary_key = null){
		    return '<input type="text" maxlength="50" value="'.$this->data['ident'].'" name="ART_USER_ULTIMO" readonly style="display:none">';
		}


		function log_user_after_update($post_array,$primary_key) {
		$this->load->model('articulos_model');
		$result = $this->articulos_model->update_tag_articulos($this->data['ident'],$primary_key);
		}

		function insert_tag_articulos($post_array,$primary_key) {
		$this->load->model('articulos_model');
		$result = $this->articulos_model->insert_tag_articulos($this->data['ident'],$primary_key);

		}

		function limpiar_textos_slug($post_array){
		   $this->load->helper('htmlpurifier');
		   // $post_array['ART_DETALLE'] = html_purify($post_array['ART_DETALLE']);
		   $post_array['ART_DETALLE'] = $post_array['ART_DETALLE'];

		   $result_data=$this->sanar_string($post_array['ART_TITULO']);
		   $post_array['ART_SLUG'] = url_title($result_data, 'dash', TRUE);
     		return $post_array;

		}
		 function limpiar_textos_slug_insert($post_array){
				   $this->load->helper('htmlpurifier');

				   $post_array['ART_DETALLE'] = $post_array['ART_DETALLE'];
				   $result_data=$this->sanar_string($post_array['ART_TITULO']);
				   // $post_array['ART_SLUG'] = url_title($this->input->post('ART_TITULO'), 'dash', TRUE);
				   $post_array['ART_SLUG'] = url_title($result_data, 'dash', TRUE);
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