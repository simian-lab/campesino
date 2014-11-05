<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pautas_pre_evento extends Main {

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

$this->load->model('control_pauta_pre_evento_model');


		$crud = new grocery_CRUD();

		$crud->set_theme('flexigrid');
		$crud->set_table('PAU_PAUTAS');
		$crud->set_subject('Pautas');
		$crud->where('PAU_EVENTO',0); 

        $crud->display_as('PAU_NOMBRE','Nombre')
	         ->display_as('PAU_IMAGEN','Imagen destacada')
	         ->display_as('PAU_MOVIL_IMAGEN','Imagen Móvil')
	         ->display_as('VISIBILITY','Visibilidad')
	         ->display_as('PAU_FECHA','Fecha')
	         ->display_as('PAU_USER_CREADOR','Creador')
	         ->display_as('PAU_DESTACADO','Destacado')
	         ->display_as('PAU_DESCRIPCION','Descripcion')
	         ->display_as('PAU_USER_ULTIMO','Utimo')
	         ->display_as('PAU_URL','URL <br />(Debe incluir <strong>http://</strong> )')
	         ->display_as('PAU_TARGET', 'Direccionamiento de URL');
        
        /*CONTROL*/
        $result = $this->control_pauta_pre_evento_model->pauta_pre_evento($this->session->userdata('sadmin_user_id'));
        // print_r($result);
    	if($result[0]['RESPUESTA']!=0 ){
          	$this->data['output'] =" <h1>No tenes permiso para acceder esta seccion</h1>" ;// $output = $crud->render();
            $breadcrums[]='<a class="current" href="'.site_url('main/pautas_pre_evento').'">Pautas</a>'; 
          	$this->data['titulo']='Permiso denegado';
          	$this->data['encabezado']='Error';
          	$this->error('example',$this->data,$breadcrums);
          	die();
        }
        /*CONTROL*/

        //***************************	Relacion de tablas ***********************************************************	
        $crud->set_relation_n_n('Tags', 'TAG_PAUTAS', 'TAGS_NOMBRES', 'TAG_PAUTAS_ID', 'TAGS_ID', 'TAGS_NOMBRE');
        //***************************	Relacion de tablas ***********************************************************

		$crud->fields('PAU_EVENTO','PAU_ID','PAU_NOMBRE','PAU_IMAGEN','PAU_MOVIL_IMAGEN','PAU_DESCRIPCION','VISIBILITY','Tags','PAU_FECHA','PAU_USER_CREADOR','PAU_USER_ULTIMO','PAU_URL','PAU_TARGET');
        $crud->required_fields('PAU_NOMBRE','PAU_IMAGEN','VISIBILITY','PAU_FECHA','PAU_DESCRIPCION','PAU_MOVIL_IMAGEN');
        $crud->columns('PAU_NOMBRE','VISIBILITY','PAU_FECHA');
		$this->data= array('autor'=>$this->session->userdata('username') . ' ('.$this->session->userdata('email').')' , 'ident'=>$this->session->userdata('sadmin_user_id') );

		$crud->unset_read();
		$crud->callback_before_insert(array($this,'esconder_campos'));

		$crud->set_field_upload('PAU_IMAGEN','multimedia/pautas/');
		$crud->callback_after_upload(array($this,'mover_imagen'));
		$crud->set_field_upload('PAU_MOVIL_IMAGEN','multimedia/pautas/');
		$crud->callback_after_upload(array($this,'mover_imagen_mobil'));
		$crud->unset_texteditor('PAU_DESCRIPCION','full_text');

		$crud->field_type('PAU_NOMBRE','String');
		$crud->field_type('PAU_URL','String');
		$crud->field_type('VISIBILITY','true_false');
		$crud->field_type('PAU_TARGET','true_false');
		$crud->field_type('Tags','multiselect');    
		$crud->field_type('PAU_ID','invisible');    
		$crud->field_type('PAU_EVENTO','invisible');    
		$crud->field_type('PAU_DESCRIPCION','text');    

		$crud->field_type('PAU_USER_CREADOR','invisible');
		$crud->field_type('PAU_USER_ULTIMO','invisible');
	 
	 	$crud->callback_add_field('PAU_TARGET',array($this,'add_field_callback_target'));
	 	$crud->callback_edit_field('PAU_TARGET',array($this,'add_field_callback_target'));

		$crud->set_language('spanish');
		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Pre Evento';
		$this->data['encabezado']='Pre Evento';

		$breadcrums[]='<a class="current" href="'.site_url('main/pautas_pre_evento').'">Pre Evento</a>'; 
		$this->salida('example',$this->data, $breadcrums);
	}


/* ******************************************************************************************************************* */
function add_field_callback_target($value){
	if($value == 1){
		$checkedNuevaVentana = 'checked="checked"';
		$checkedMismaVentana = '';
	}
	else{
		$checkedMismaVentana = 'checked="checked"';
		$checkedNuevaVentana = '';
	}
	return ' <input type="radio" class="radio-uniform" id="field-PAU_TARGET-true" '.$checkedNuevaVentana.' name="PAU_TARGET" value="1" /> Nueva ventana <input type="radio" id="field-PAU_TARGET-false" class="radio-uniform" value="0" name="PAU_TARGET" '.$checkedMismaVentana.' /> Misma ventana';
}

function esconder_campos($post_array){

	$post_array['PAU_EVENTO']=0;
	$post_array['PAU_USER_CREADOR']=$this->session->userdata('sadmin_user_id') ;
	$post_array['PAU_USER_ULTIMO']=$this->session->userdata('sadmin_user_id') ;
	return $post_array;
}

function mover_imagen($uploader_response,$field_info, $files_to_upload){
	$this->load->library('image_moo');
	$file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name; 
	if( !$this->is_image($file_uploaded)){
	 	@unlink($file_uploaded);
	 	return 'Formato de image incorrecto.';
	} 
 	$ndestino =  '../static/multimedia/pautas/'.$uploader_response[0]->name; 
	copy($file_uploaded, $ndestino);
	return true;
} 

function mover_imagen_mobil($uploader_response,$field_info, $files_to_upload){
	$this->load->library('image_moo');
	//print_r($field_info->upload_path.'/'.$uploader_response[0]->name);die();
	$file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name; 
	if( !$this->is_image($file_uploaded)){
	 	@unlink($file_uploaded);
	 	return 'Formato de image incorrecto.';
	} 	
 	$ndestino =  '../static/multimedia/pautas/'.$uploader_response[0]->name; 
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

}