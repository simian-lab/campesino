<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promociones_generales extends Main {

	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		
		$this->load->library('grocery_crud');	
		$this->load->helper('url');
	}

	// Metodo para carga de promociones
	function index()
	{
		$this->load->model('promociones_generales_model');


        $arrCategorias = $this->promociones_generales_model->get_categorias();
        $arrSubCategorias = $this->promociones_generales_model->get_subcategorias();
        $arrMarcas = $this->promociones_generales_model->get_marcas();
        $arrTipoPromocion=array('1'=>'Básica');
       
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->where('PRO_SRC_ID','1');
		$crud->set_table('PRO_PROMOCIONES');
        $state = $crud->getState();

		/*CONTROL*/
		if( $state!='upload_file'){
		$segmento=$this->uri->segment(4);
		if( isset($segmento) && !empty($segmento) ){
				$result = $this->promociones_generales_model->control_promocion($segmento,$this->session->userdata('sadmin_user_id'));
			          if($result[0]['REPUESTA']!=0 ){

			          	// $breadcrums[]='<a class="current" href="'.site_url('main/promociones').'">Promociones</a>';
			          	$this->data['output'] =" <h1>No tenes permiso para acceder esta seccion</h1>" ;// $output = $crud->render();
			            // $this->data['output'] = $output = $crud->render(); ;// $output = $crud->render();
			            $breadcrums[]='<a class="current" href="'.site_url('main/promociones').'">Promociones</a>'; 
			          	$this->data['titulo']='Permiso denegado';
			          	$this->data['encabezado']='Error';
			          	$this->error('example',$this->data,$breadcrums);
			          	die();
			          }
				}
		}

		/*CONTROL*/

  		$result = $this->promociones_generales_model->get_grupo($this->session->userdata('sadmin_user_id'));
        if( $result['group_id']==5  ){
		   $crud->where('PRO_USER_CREADOR',$this->session->userdata('sadmin_user_id'));
		   $crud->field_type('VISIBILITY','hidden');

	   }
         		 

		$crud->set_subject('Promociones Generales');
		$crud->unset_read();

        $crud->display_as('PRO_NOMBRE','Nombre promoción')
	         ->display_as('PRO_DESCRIPCION','Descripción')
	         ->display_as('PRO_ETIQUETA','Etiqueta')
	         ->display_as('PRO_LOGO_GENERAL','Imagen General<br>Tamaño recomendado:<br>298x298px')
	         ->display_as('PRO_PRECIO_INICIAL','Precio inicial')
	         ->display_as('PRO_PRECIO_FINAL','Precio final')
	         ->display_as('PRO_DESCUENTO','Descuento')
	         ->display_as('PRO_SRC_ID','Tipo de promoción')
	         ->display_as('VISIBILITY','Visibilidad')
	         ->display_as('PRO_URL','Url<br>(Ejemplo: <strong>http://www.tupagina.com</strong> )')
	         ->display_as('PRO_AUTOR','Autor')
	         ->display_as('CAT_ID','Categoría')
	         ->display_as('SUB_ID','Subcategoría')
	         ->display_as('AUTORIZADO','Estado')
	         ->display_as('MAR_ID','Marca')
	         ->display_as('PRO_LOGO_VISA', 'Visa')
	         ->display_as('PRO_TIPO_MONEDA', 'Moneda')
	         ->display_as('VISTA_PREVIA', 'Vista previa')
	         ->display_as('PRO_HASH', 'Hash');



 		 
       //***************************	Relacion de tablas ***************************	

       $crud->set_relation_n_n('Tags', 'TAG_PROMOCIONES', 'TAGS_NOMBRES', 'PRO_ID', 'TAGS_ID', 'TAGS_NOMBRE' );
       
       $crud->order_by('PRO_FECHA','DESC');

		$crud->fields('PRO_NOMBRE','PRO_LOGO_GENERAL','PRO_DESCRIPCION','MAR_ID','PRO_SRC_ID','CAT_ID','SUB_ID','PRO_PRECIO_INICIAL','PRO_PRECIO_FINAL','PRO_TIPO_MONEDA','PRO_DESCUENTO','VISIBILITY','PRO_USER_CREADOR','PRO_USER_ULTIMO','PRO_URL','PRO_AUTOR','PRO_FECHA','AUTORIZADO','PRO_LOGO_VISA', 'VISTA_PREVIA','PRO_HASH');
        $crud->required_fields('PRO_NOMBRE','PRO_LOGO_GENERAL','PRO_DESCRIPCION','PRO_URL','CAT_ID','MAR_ID');
        $crud->columns('PRO_NOMBRE','PRO_LOGO_GENERAL','PRO_AUTOR','CAT_ID','SUB_ID','AUTORIZADO');

		$crud->set_field_upload('PRO_LOGO_GENERAL','multimedia/promociones/');
		$crud->callback_before_upload(array($this,'change_name_image'));
		$crud->callback_after_upload(array($this,'check_imagen'));


		$crud->callback_after_insert(array($this,'fnc_after_insert')); // despues de insertar
		$crud->callback_after_update(array($this,'fnc_after_update'));
		$crud->callback_before_update(array($this,'before_update')); // anets de insertar
		$crud->callback_before_insert(array($this,'before_insert')); //  antes de insertar
		
		
	
		$crud->callback_field('PRO_TIPO_MONEDA',array($this,'tipo_moneda'));
		$crud->callback_field('VISTA_PREVIA',array($this,'link_vista_previa'));
		$crud->callback_before_delete(array($this,'delete_motivo_rechazo'));

		$crud->set_rules('PRO_PRECIO_INICIAL','Precio inicial','integer|less_than[100000000]');
		$crud->set_rules('PRO_PRECIO_FINAL','Precio final','integer|less_than[100000000]');
		$crud->set_rules('PRO_DESCUENTO','Descuento','integer|max_length[3]|less_than[101]');

		$crud->unique_fields('PRO_NOMBRE');
		$crud->set_rules('PRO_NOMBRE','Nombre promoción','max_length[22]|required');

		$crud->set_rules('PRO_DESCRIPCION','Descripción','max_length[23]|required');

        $crud->unset_texteditor('PRO_DESCRIPCION','full_text');
		$crud->field_type('PRO_ID','hidden');
		$crud->field_type('PRO_NOMBRE','String');
		$crud->field_type('PRO_PRECIO_INICIAL','String');
		$crud->field_type('PRO_PRECIO_FINAL','String');
		$crud->field_type('PRO_DESCUENTO','string');
        if( $result['group_id']==5  ){
			$crud->field_type('VISIBILITY','invisible');
	    }else{
			$crud->field_type('VISIBILITY','true_false');
		}

	    $crud->field_type('PRO_LOGO_PREMIUM','hidden',NULL);
		$crud->field_type('PRO_DESCRIPCION','text');
		$crud->field_type('PRO_URL','String');
        $crud->field_type('Tags','multiselect');  
        $crud->field_type('PRO_FECHA','invisible');
		$crud->field_type('PRO_SRC_ID','invisible');
		$crud->field_type('CAT_ID','dropdown', $arrCategorias);
		$crud->field_type('SUB_ID','dropdown', $arrSubCategorias);
		$crud->field_type('MAR_ID','dropdown', $arrMarcas);
		$crud->field_type('PRO_LOGO_VISA', 'invisible');
		$crud->field_type('PRO_TIPO_MONEDA', 'true_false');

		 // echo $state;
		if( $state=='edit'){

			$crud->field_type('AUTORIZADO','hidden',0);
		}else if( $state=='add'){
			$crud->field_type('AUTORIZADO','invisible');
		}else if($state=='list' || $state=='ajax_list'){
			 //$crud->field_type('AUTORIZADO','dropdown',array('null'=>'Pendiente de aprobacion','0'=>'Pendiente de aprobacion','1'=>'Aprobado','2'=>'Rechazado') );
		 	
		}
		$crud->callback_column('AUTORIZADO',array($this,'estado_promocion'));
		/*invisibles*/
		$crud->field_type('PRO_USER_CREADOR','invisible');
		$crud->field_type('PRO_USER_ULTIMO','invisible');
		$crud->field_type('PRO_USER_AUTORIZADOR','invisible');
		$crud->field_type('PRO_AUTOR','invisible');
		$crud->field_type('PRO_HASH','invisible');

		$crud->set_language('spanish');
		
		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Promociones Generales';
		$this->data['encabezado']='Gestión de promociones generales';

		$breadcrums[]='<a class="current" href="'.site_url('main/promociones').'">Promociones</a>'; 
		$this->salida('promociones_generales/promociones_generales',$this->data, $breadcrums);
	}

/********************************************************************/
function generar_hash(){
	$uniqid = 'p' .rand(1,10000 ) . uniqid('',true);
    $hash = sha1($uniqid);
    return $hash;
}

function change_name_image($files_to_upload,$field_info){
	if($files_to_upload[$field_info->encrypted_field_name]['name'] != filter_var($files_to_upload[$field_info->encrypted_field_name]['name'], FILTER_SANITIZE_SPECIAL_CHARS)){
		return 'Nombre de imagen incorrecto';
	}
	return true;
}

function delete_motivo_rechazo($id_promo){
	return $this->promociones_generales_model->delete_motivo_rechazo($id_promo);
}

function link_vista_previa(){
	return '<a onClick="vista_previa()">Vista previa</a>';
}

function estado_promocion($value, $row){

  switch ($value) {
    case '1':
      return 'Aprobado';
      break;
    case '2':
      $resultado = 'Rechazado <br />';
      //$motivo_rechazo = $this->pendientes_model->get_motivo_rechazo();
      $resultado .= '<a href="#" onClick="showMotivoRechazo('.$row->PRO_ID.')">Motivo de rechazo</a>';
      return $resultado;
      break;
    case '0':
      return 'Pendiente de aprobación';
      break;
  }

}

function tipo_moneda($value){
  if($value == 'US$'){
    $selectedDolar = 'checked="checked"';
    $selectedPeso = '';
  }else{
    $selectedDolar = '';
    $selectedPeso = 'checked="checked"';
  }
  return '<input type="radio" id="field-PRO_TIPO_MONEDA-true" class="radio-uniform" '.$selectedPeso.' name="PRO_TIPO_MONEDA" value="$" /> $ <input type="radio" id="field-PRO_TIPO_MONEDA-false" class="radio-uniform" name="PRO_TIPO_MONEDA" value="US$" '.$selectedDolar.' /> US$ ';
}

function limit_titulo($value){

	return '<input type="text" id="field-PRO_NOMBRE" name="PRO_NOMBRE" value="'.$value.'" maxlength="22"/>';

}

function limit_descripcion($value){
	//return '<textarea id="field-PRO_DESCRIPCION" name="PRO_DESCRIPCION" maxlength="23">'.$value.'</textarea>';
	return '<input type="text" id="field-PRO_DESCRIPCION" name="PRO_DESCRIPCION" value="'.$value.'" maxlength="23"/>';
}

function before_insert($post_array){
if($post_array['PRO_LOGO_PREMIUM'] != filter_var($post_array['PRO_LOGO_PREMIUM'], FILTER_SANITIZE_SPECIAL_CHARS)){
	echo '<script>alert("Nombre de imagen incorrecto")</script>';
	exit();
}
	
$this->load->model('promociones_generales_model');

$pUSER_ID= $this->session->userdata('sadmin_user_id'); // Id de usuario que esta cargando la promo
$pTIPO = 1;

$datos= $this->promociones_generales_model->decrementar($pUSER_ID,$pTIPO);
$msg_error=$datos[0]["RESPUESTA"];
//print_R($this->session->userdata('sadmin_user_id'));die();
	if($msg_error!='0'){
		echo '<script> alert("Ha superado el límite de promociones para este paquete." ) </script>';
		exit();
	}


    $post_array['AUTORIZADO']='0';
    $post_array['PRO_FECHA']=date('Y-m-d h:m:s');
    $post_array['PRO_USER_CREADOR']=$this->session->userdata('sadmin_user_id');
    $post_array['PRO_USER_ULTIMO']=$this->session->userdata('sadmin_user_id');
    $post_array['PRO_USER_AUTORIZADOR']=$this->session->userdata('sadmin_user_id');
    $post_array['PRO_AUTOR']=$this->session->userdata('username');
    $post_array['PRO_SRC_ID']=1;
    $post_array['PRO_LOGO_VISA']=1;
    $post_array['PRO_HASH'] = $this->generar_hash();

	return $post_array;

}

function before_update($post_array, $primary_key){
	if($post_array['PRO_LOGO_PREMIUM'] != filter_var($post_array['PRO_LOGO_PREMIUM'], FILTER_SANITIZE_SPECIAL_CHARS)){
		echo '<script>alert("Nombre de imagen incorrecto")</script>';
		exit();
	}

	$this->load->helper('url');

	$post_array['PRO_URL']=prep_url($post_array['PRO_URL']);
	$post_array['AUTORIZADO']='0';
	$post_array['PRO_SRC_ID']=1;
	$post_array['PRO_LOGO_VISA']=1;

	return $post_array;
}

function fnc_after_update($post_array){ //print_r($post_array);die();
	$this->load->model('promociones_generales_model');

	$datos_envio['titulo'] = $this->limpiar_cadena_titulo($post_array['PRO_NOMBRE']);
    $datos_envio['autor'] = $this->session->userdata('username');
    $datos_envio['aliado'] = $this->session->userdata('sadmin_user_id');
    $datos= $this->promociones_generales_model->send_mail_user_edit($datos_envio);
    $this->promociones_generales_model->send_mail_aliado_edit($datos_envio);
}

function fnc_after_insert($post_array){
    $this->load->helper('url');
	$this->load->model('promociones_generales_model');

	$post_array['PRO_URL']=prep_url($post_array['PRO_URL']);


	  $datos_envio['titulo'] = $this->limpiar_cadena_titulo($post_array['PRO_NOMBRE']);
	  $datos_envio['autor'] = $post_array['PRO_AUTOR'];
	  $datos_envio['aliado'] = $post_array['PRO_USER_CREADOR'];
	  $datos= $this->promociones_generales_model->send_mail_user($datos_envio);
	  $this->promociones_generales_model->send_mail_aliado($datos_envio);
       // return true;
	return $post_array;

}

	function limpiar_cadena_titulo($texto){
		return strip_tags($texto);
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

function control_size($path){
	if(filesize($path) >= 2097152){
		return false;
	}

	return true;
}

function control_size_name($name){
	$name = explode('.',$name);

	if(strlen($name[0]) > 31){// Cuenta 25 caracteres. 
		return false;
	}

	return true;
}

public function check_imagen($uploader_response,$field_info, $files_to_upload){

		$file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name; 
		  
		 if( !$this->is_image($file_uploaded)){

		 	@unlink($file_uploaded);
	 		return 'Formato de image incorrecto.';
	 	}

	 	if(!$this->control_size($file_uploaded)){
	 		@unlink($file_uploaded);
	 		return 'El archivo excede el tamaño 2MB que fue especificado.';
	 	}

	 	if($field_info->field_name == 'PRO_LOGO_PREMIUM'){
			$width = 458;
			$height = 347;
		}
		else{
			$width = 298;
			$height = 298;
		}

	 	/*if(!$this->control_size($file_uploaded, $width, $height)){
	 		@unlink($file_uploaded);
	 		return 'Tamaño de imagen incorrecto.';
	 	}*/

	 	if(!$this->control_size_name($uploader_response[0]->name)){
	 		@unlink($file_uploaded);
	 		return 'El nombre de la imagen debe tener máximo 25 caracteres.';
	 	}

	 	$this->load->library('image_moo');
	 	$this->image_moo->set_jpeg_quality(100);
		$this->image_moo->load($file_uploaded)->resize_crop($width,$height)->save($file_uploaded,true);
	 	
	 	$ndestino =  '../static/multimedia/promociones/'.$uploader_response[0]->name;
		copy($file_uploaded, $ndestino);

	 	return true;
}

 


}