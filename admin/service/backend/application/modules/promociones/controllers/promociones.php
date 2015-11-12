<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promociones extends Main {

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
		$this->load->model('promociones_model');


        $arrCategorias = $this->promociones_model->get_categorias();
        $arrSubCategorias = $this->promociones_model->get_subcategorias();
        $arrMarcas = $this->promociones_model->get_marcas();
        $arrTipoPromocion=array('1'=>'Básica','2'=>'Premium Home','3'=>'Premium Categorías');
        $arrUsersAliados = $this->promociones_model->get_user_aliados();

		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('PRO_PROMOCIONES');
        $state = $crud->getState();

		/*CONTROL*/
		if( $state!='upload_file'){
		$segmento=$this->uri->segment(4);
		if( isset($segmento) && !empty($segmento) ){
				$result = $this->promociones_model->control_promocion($segmento,$this->session->userdata('sadmin_user_id'));
			          if($result[0]['REPUESTA']!=0 ){

			          	// $breadcrums[]='<a class="current" href="'.site_url('main/promociones').'">Promociones</a>';
			          	$this->data['output'] =" <h1>No tenes permiso para acceder esta seccion</h1>" ;// $output = $crud->render();
			            // $this->data['output'] = $output = $crud->render(); ;// $output = $crud->render();
			            $breadcrums[]='<a class="current" href="'.site_url('main/promociones').'">Promociones</a>';
			          	$this->data['titulo']='Permiso denegado';
			          	$this->data['encabezado']='Error';
			          	$this->error('promociones',$this->data,$breadcrums);
			          	die();
			          }
				}
		}

		/*CONTROL*/


  		$result = $this->promociones_model->get_grupo($this->session->userdata('sadmin_user_id'));
        if( $result['group_id']==5  ){
		   $crud->where('PRO_USER_CREADOR',$this->session->userdata('sadmin_user_id'));
		   $crud->field_type('VISIBILITY','hidden');

	   }


		$crud->set_subject('Promociones');

		if($result['group_id']==3){
			$crud->unset_delete();
			$crud->unset_edit();
			$crud->unset_add();
		}
		else{
			$crud->unset_read();
		}


        $crud->display_as('PRO_NOMBRE','Nombre promoción')
        	 ->display_as('PRO_ID','ID')
	         ->display_as('PRO_DESCRIPCION','Descripción')
             ->display_as('PRO_ETIQUETA','Etiqueta')
             ->display_as('PRO_LOGO_PREMIUM','Imagen Premium<br>Tamaño recomendado:<br>458x347px')
             ->display_as('PRO_LOGO_GENERAL','Imagen General<br>Tamaño recomendado:<br>298x298px')
             ->display_as('PRO_PRECIO_INICIAL','Precio inicial')
             ->display_as('PRO_PRECIO_FINAL','Precio final')
             ->display_as('PRO_DESCUENTO','Descuento')
             ->display_as('PRO_SRC_ID','Tipo de promoción')
             ->display_as('VISIBILITY','Visibilidad')
             ->display_as('PRO_URL','Url<br>(Debe incluir <strong>http://</strong> )')
             ->display_as('PRO_AUTOR','Autor')
             ->display_as('CAT_ID','Categoría')
             ->display_as('SUB_ID','Subcategoría')
             ->display_as('AUTORIZADO','Estado')
             ->display_as('eventos','Eventos')
             ->display_as('MAR_ID','Marca')
             ->display_as('Paquete')
             ->display_as('PRO_TIPO_MONEDA', 'Moneda')
             ->display_as('PRO_USER_CREADOR', 'Usuario')
             ->display_as('VISTA_PREVIA', 'Vista previa')
             ->display_as('PRO_FECHA', 'Fecha')
             ->display_as('ID_USER_CREADOR', 'ID Usuario')
             ->display_as('PRO_HASH', 'Hash')
             ->display_as('PRO_ACTIVA', 'Hash');




       //***************************	Relacion de tablas ***************************
       $crud->set_relation_n_n('Tags', 'TAG_PROMOCIONES', 'TAGS_NOMBRES', 'PRO_ID', 'TAGS_ID', 'TAGS_NOMBRE' );


       $crud->set_relation_n_n('eventos', 'EXP_EVENTOXPROMOCION', 'EVE_EVENTOS', 'EXP_PROMOCION', 'EXP_EVENTO', 'EVE_NOMBRE');

       $crud->order_by('PRO_FECHA','DESC');


        if($result['group_id']==3){
        	$crud->fields('PRO_SRC_ID','PRO_NOMBRE','PRO_LOGO_PREMIUM', 'PRO_LOGO_GENERAL','PRO_DESCRIPCION','MAR_ID','CAT_ID','SUB_ID','PRO_PRECIO_INICIAL','PRO_PRECIO_FINAL','PRO_TIPO_MONEDA','PRO_DESCUENTO','VISIBILITY','PRO_USER_CREADOR','PRO_URL','PRO_AUTOR','ID_USER_CREADOR','PRO_FECHA','AUTORIZADO','eventos', 'VISTA_PREVIA','PRO_HASH','PRO_ACTIVA');
        }
        else{
        	$crud->fields('PRO_SRC_ID','PRO_NOMBRE','PRO_LOGO_PREMIUM', 'PRO_LOGO_GENERAL','PRO_DESCRIPCION','MAR_ID','CAT_ID','SUB_ID','PRO_PRECIO_INICIAL','PRO_PRECIO_FINAL','PRO_TIPO_MONEDA','PRO_DESCUENTO','VISIBILITY','PRO_USER_CREADOR','PRO_USER_ULTIMO','PRO_URL','PRO_AUTOR','PRO_FECHA','AUTORIZADO','eventos', 'VISTA_PREVIA','PRO_HASH','PRO_ACTIVA');
        }
        $crud->required_fields('PRO_NOMBRE','PRO_DESCRIPCION','PRO_URL', 'CAT_ID', 'PRO_SRC_ID','PRO_USER_CREADOR','MAR_ID','eventos');
        $crud->columns('PRO_ID', 'PRO_NOMBRE','PRO_LOGO_PREMIUM', 'PRO_LOGO_GENERAL','PRO_AUTOR','eventos','CAT_ID','SUB_ID','AUTORIZADO','VISIBILITY', 'PRO_SRC_ID');


		$crud->set_field_upload('PRO_LOGO_PREMIUM','multimedia/promociones/');
		$crud->set_field_upload('PRO_LOGO_GENERAL','multimedia/promociones/');

		$crud->callback_after_insert(array($this,'fnc_after_insert'));
		$crud->callback_after_update(array($this,'fnc_after_update'));
		$crud->callback_after_upload(array($this,'check_imagen'));
		$crud->callback_before_insert(array($this,'before_insert'));
		$crud->callback_before_delete(array($this,'delete_motivo_rechazo'));
		$crud->callback_before_update(array($this,'before_update'));
		$crud->callback_before_upload(array($this,'change_name_image'));
		$crud->callback_column('Paquete', array($this, 'columna_paquete'));
		$crud->callback_field('PRO_TIPO_MONEDA',array($this,'tipo_moneda'));
		$crud->callback_field('VISTA_PREVIA',array($this,'link_vista_previa'));

		if($result['group_id']==3){
			$crud->callback_field('PRO_SRC_ID',array($this,'tipo_promocion'));
			$crud->callback_field('MAR_ID',array($this,'get_marca'));
			$crud->callback_field('CAT_ID',array($this,'get_categoria'));
			$crud->callback_field('SUB_ID',array($this,'get_subcategoria'));
			$crud->callback_field('PRO_USER_CREADOR',array($this,'get_usuarios_aliados'));
			$crud->callback_field('AUTORIZADO',array($this,'estado_promocion_field'));
			$crud->callback_field('PRO_LOGO_PREMIUM',array($this,'show_imagen_premium'));
			$crud->callback_field('PRO_LOGO_GENERAL',array($this,'show_imagen_genereal'));
			$crud->callback_field('ID_USER_CREADOR',array($this,'get_id_user_creador'));
		}

		$crud->set_rules('PRO_PRECIO_INICIAL','Precio inicial','integer|less_than[100000000]');
		$crud->set_rules('PRO_PRECIO_FINAL','Precio final','integer|less_than[100000000]');
		$crud->set_rules('PRO_DESCUENTO','Descuento','is_natural|max_length[3]|less_than[101]');

		if($state == 'insert_validation' || $state == 'update_validation'){
			$url = $this->input->post('PRO_URL');

			if (! filter_var($url, FILTER_VALIDATE_URL)){

				echo '<textarea>'.json_encode(
												array(
															'success'	=>	false,
															'error_message'	=>"<p>URL inválida</p>",
															"error_fields"	=>	array("PRO_URL"	=>	"El campo Url<br>(Debe incluir <strong>http:\/\/<\/strong> ) es requerido.")
													)
											).'</textarea>';
				die();

			}
		}

		$crud->unique_fields('PRO_NOMBRE');

		$crud->callback_column('PRO_SRC_ID',array($this,'tipo_promocion'));


        $crud->unset_texteditor('PRO_DESCRIPCION','full_text');
		$crud->field_type('PRO_ID','hidden');
		$crud->field_type('PRO_NOMBRE','String');
		$crud->field_type('PRO_SRC_ID','dropdown', array(1 => 'General', 2 => 'Premium Home', 3 => 'Premium Categoría'));
		$crud->field_type('PRO_PRECIO_INICIAL','String');
		$crud->field_type('PRO_PRECIO_FINAL','String');
		$crud->field_type('PRO_DESCUENTO','string');
        if( $result['group_id']==5  ){
			$crud->field_type('VISIBILITY','invisible');
	    }else{
			$crud->field_type('VISIBILITY','true_false');
	    }

	    // Here I want to be sure that these variables are arrays.
	    if(is_array($arrCategorias)) {
	    	asort($arrCategorias);
	    } else {
	    	$arrCategorias = array('' => 'No hay categorias');
	    }

	    if(is_array($arrMarcas)) {
	    	asort($arrMarcas);
	    } else {
	    	$arrMarcas = array('' => 'No hay marcas');
	    }

	    if(is_array($arrSubCategorias)) {
	    	asort($arrSubCategorias);
	    } else {
	    	$arrSubCategorias = array('' => 'No hay subcategorias');
	    }

		$crud->field_type('PRO_DESCRIPCION','text');
		$crud->field_type('PRO_URL','String');
        $crud->field_type('Tags','multiselect');
        $crud->field_type('PRO_FECHA','invisible');
		$crud->field_type('CAT_ID','dropdown', $arrCategorias);
		$crud->field_type('SUB_ID','dropdown', $arrSubCategorias);
		$crud->field_type('MAR_ID','dropdown', $arrMarcas);
		$crud->field_type('PRO_TIPO_MONEDA', 'true_false');
		$crud->field_type('VISTA_PREVIA','String');
		$crud->field_type('PRO_HASH','invisible');
		$crud->field_type('PRO_ACTIVA','invisible');


		if( $state=='edit'){

			$crud->field_type('AUTORIZADO','hidden',0);
		}else if( $state=='add'){
			$crud->field_type('AUTORIZADO','invisible');
		}else if($state=='list' || $state=='ajax_list'){
		 	//$crud->field_type('AUTORIZADO','dropdown',array('null'=>'Pendiente de aprobacion','0'=>'Pendiente de aprobacion','1'=>'Aprobado','2'=>'Rechazado') );
		}
		$crud->callback_column('AUTORIZADO',array($this,'tipo_autorizado'));
		/*invisibles*/
		$crud->field_type('PRO_USER_CREADOR','dropdown', $arrUsersAliados);
		$crud->field_type('PRO_USER_ULTIMO','invisible');
		$crud->field_type('PRO_USER_AUTORIZADOR','invisible');
		$crud->field_type('PRO_AUTOR','invisible');

		$crud->set_language('spanish');

		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Promociones';
		$this->data['encabezado']='Gestión de promociones';

		$breadcrums[]='<a class="current" href="'.site_url('main/promociones').'">Promociones</a>';
		if($result['group_id']==3){
			$this->salida('promociones/promociones',$this->data, $breadcrums);
		}
		else{
			$this->salida('promociones_view',$this->data, $breadcrums);
		}

	}

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

function generar_hash(){
	$uniqid = 'p' .rand(1,10000 ) . uniqid('',true);
    $hash = sha1($uniqid);
    return $hash;
}

function change_name_image($files_to_upload,$field_info){
	if($files_to_upload[$field_info->encrypted_field_name]['name'] != filter_var($files_to_upload[$field_info->encrypted_field_name]['name'], FILTER_SANITIZE_SPECIAL_CHARS)){
		return 'Nombre de imagen incorrecto';
	}
	$ext = pathinfo($files_to_upload[$field_info->encrypted_field_name]['name'], PATHINFO_EXTENSION);
	$_FILES[$field_info->encrypted_field_name]['name'] = mktime().'_imagen.'.$ext;
	return true;
}

function delete_motivo_rechazo($id_promo){
	$this->load->model('promociones_model');
	$this->promociones_model->delete_motivo_rechazo($id_promo);
	$this->load->helper('url');

	$result = $this->promociones_model->getPromocionById($id_promo);
	$datos_envio['titulo'] = $result['PRO_NOMBRE'];
	$datos_envio['autor'] = $result['PRO_AUTOR'];
	$datos_envio['aliado'] = $result['PRO_USER_CREADOR'];
	$datos= $this->promociones_model->send_mail_delete_user($datos_envio);
	$this->promociones_model->send_mail_delete_aliado($datos_envio);
}

function get_id_user_creador($value, $id_promo){
	$result = $this->promociones_model->get_user_x_promocion($id_promo);
	return $result['PRO_USER_CREADOR'];
}

function show_imagen_premium($value){
	if($value != '')
		return '<img src="../../../../multimedia/promociones/'.$value.'" width="60" id="field-PRO_LOGO_PREMIUM"/>';
}

function show_imagen_genereal($value){
	if($value != '')
		return '<img src="../../../../multimedia/promociones/'.$value.'" width="60" id="field-PRO_LOGO_GENERAL"/>';
}

function estado_promocion_field($value, $post_array){

  switch ($value) {
    case '1':
      return 'Aprobado';
      break;
    case '2':
      return 'Rechazado';
      break;
    default:
      return 'Pendiente de aprobación';
      break;
  }

}

function get_usuarios_aliados($value){
  $this->load->model('promociones_model');
  $result = $this->promociones_model->get_user($value);
  return $result['username'];
}

function get_subcategoria($value){
  $this->load->model('promociones_model');
  $result = $this->promociones_model->getSubCategoriaId($value);
  return $result['SUB_NOMBRE'];
}

function get_categoria($value){
  $this->load->model('promociones_model');
  $result = $this->promociones_model->getCategoriaId($value);
  return $result['CAT_NOMBRE'];
}

function get_marca($value){

	$this->load->model('promociones_model');
	$marca = $this->promociones_model->get_marca_id($value);
	return $marca['MAR_NOMBRE'];
}
function tipo_autorizado($value, $row){

	switch ($row->AUTORIZADO) {
		case '0':
			return 'Pendiente de aprobación';
			break;
		case '1':
			return 'Aprobado';
			break;
		case '2':
			return 'Rechazado';
			break;
	}

}
function link_vista_previa(){
	return '<a onClick="vista_previa()">Vista previa</a>';
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

function columna_paquete($value, $row){
  //print_R($row);
  $paquete = $this->promociones_model->get_paquete($row->PRO_USER_CREADOR);
  //print_R($paquete);
  return $paquete[$row->PRO_USER_CREADOR];
}

function tipo_promocion($post_array){
    switch ($post_array) {
      case '1':
            return 'General';
        break;
      case '2':
        return 'Premium Home';
        break;
      case '3':
         return 'Premium';
        break;
      default:
         return 'Sin Ubicación';
        break;
    }

}

function limit_titulo($value){

	return '<input type="text" id="field-PRO_NOMBRE" name="PRO_NOMBRE" value="'.$value.'" maxlength="35"/>';

}

function before_insert($post_array){

$file_name = $post_array['PRO_LOGO_PREMIUM'];
$file_name = preg_replace("/([^a-zA-Z0-9\.\-\_]+?){1}/i", '', $file_name);
$file_name = str_replace(" ", "", $file_name);
$post_array['PRO_LOGO_PREMIUM'] = $file_name;

if(!$this->image_is_valid($file_name)) {
	$post_array['PRO_LOGO_PREMIUM'] = '';
}

$file_name = $post_array['PRO_LOGO_GENERAL'];
$file_name = preg_replace("/([^a-zA-Z0-9\.\-\_]+?){1}/i", '', $file_name);
$file_name = str_replace(" ", "", $file_name);
$post_array['PRO_LOGO_GENERAL'] = $file_name;

if(!$this->image_is_valid($file_name)) {
	$post_array['PRO_LOGO_GENERAL'] = '';
}

$this->load->model('promociones_model');
$pUSER_ID=$post_array['PRO_USER_CREADOR'];
$pTIPO = $post_array['PRO_SRC_ID'];


foreach ($post_array['eventos'] as $evento){

  $datos= $this->promociones_model->decrementar($pUSER_ID,$pTIPO,$evento);
  $msg_error=$datos[0]["RESPUESTA"];
  $msg_msg=$datos[0]["COMENTARIO"];
  //print_R($this->session->userdata('sadmin_user_id'));die();
    if($msg_error!='0'){
      echo '<script> alert("'.$msg_msg.'" ) </script>';
      exit();
    }

}

    $post_array['AUTORIZADO']='0';
    $post_array['PRO_FECHA']=date('Y-m-d h:m:s');
    $post_array['PRO_USER_CREADOR']=$post_array['PRO_USER_CREADOR'];
    $post_array['PRO_USER_ULTIMO']=$this->session->userdata('sadmin_user_id');
    $post_array['PRO_USER_AUTORIZADOR']=$this->session->userdata('sadmin_user_id');
    $post_array['PRO_AUTOR']=$this->session->userdata('username');
    $post_array['PRO_HASH'] = $this->generar_hash();

	return $post_array;

}

function before_update($post_array, $primary_key){

	$file_name = $post_array['PRO_LOGO_PREMIUM'];
	$file_name = preg_replace("/([^a-zA-Z0-9\.\-\_]+?){1}/i", '', $file_name);
	$file_name = str_replace(" ", "", $file_name);
	$post_array['PRO_LOGO_PREMIUM'] = $file_name;

	if(!$this->image_is_valid($file_name)) {
		$post_array['PRO_LOGO_PREMIUM'] = '';
	}

	$file_name = $post_array['PRO_LOGO_GENERAL'];
	$file_name = preg_replace("/([^a-zA-Z0-9\.\-\_]+?){1}/i", '', $file_name);
	$file_name = str_replace(" ", "", $file_name);
	$post_array['PRO_LOGO_GENERAL'] = $file_name;

	if(!$this->image_is_valid($file_name)) {
		$post_array['PRO_LOGO_GENERAL'] = '';
	}

	$this->load->helper('url');

	//print_R($post_array);die();
	$post_array['PRO_URL']=prep_url($post_array['PRO_URL']);
	$post_array['AUTORIZADO']='0';

	$datos_envio['titulo'] = $this->limpiar_cadena_titulo($post_array['PRO_NOMBRE']);
    $datos_envio['autor'] = $this->session->userdata('username');
    $datos_envio['aliado'] = $this->session->userdata('sadmin_user_id');
    $datos_envio['eventos'] = $this->promociones_model->get_eventos_promocion($primary_key);


  //validar limite paquete
  $comprobacion = $this->promociones_model->validar_limite_edit($primary_key,$post_array);
  if($comprobacion!=1){
    echo '<script>alert("'.$comprobacion.'")</script>';
    exit();
  }
  //fin validacion

	$visibilidad = $this->promociones_model->verificar_visibilidad($primary_key);

    if($post_array['VISIBILITY'] == 0 && $visibilidad['VISIBILITY'] == 1){
    	$post_array['PRO_ACTIVA'] = 2;
      $datos_envio['PRO_ACTIVA'] = 2;
      $this->promociones_model->send_mail_aliado_edit($datos_envio);
    }
    elseif($post_array['VISIBILITY'] == 1 && $visibilidad['VISIBILITY'] == 0){
    	$post_array['PRO_ACTIVA'] = 1;
      $datos_envio['PRO_ACTIVA'] = 1;
      $this->promociones_model->send_mail_aliado_edit($datos_envio);
    }
    else{
    	$post_array['PRO_ACTIVA'] = '';
      $datos_envio['PRO_ACTIVA'] = '';
    	$this->promociones_model->send_mail_aliado_edit($datos_envio);
    }

	return $post_array;
}

function fnc_after_update($post_array){ //print_r($post_array);die();
	$this->load->model('promociones_model');

	$datos_envio['titulo'] = $this->limpiar_cadena_titulo($post_array['PRO_NOMBRE']);
    $datos_envio['autor'] = $this->session->userdata('username');
    $datos_envio['aliado'] = $post_array['PRO_USER_CREADOR'];
    $datos_envio['PRO_ACTIVA'] = $post_array['PRO_ACTIVA'];
    $this->promociones_model->send_mail_user_edit($datos_envio);


}

function fnc_after_insert($post_array){
    $this->load->helper('url');
	$this->load->model('promociones_model');

	$post_array['PRO_URL']=prep_url($post_array['PRO_URL']);


      $datos_envio['titulo'] = $this->limpiar_cadena_titulo($post_array['PRO_NOMBRE']);
      $datos_envio['autor'] = $post_array['PRO_AUTOR'];
      $datos_envio['aliado'] = $post_array['PRO_USER_CREADOR'];
      $datos= $this->promociones_model->send_mail_user($datos_envio);
      $this->promociones_model->send_mail_aliado($datos_envio);
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

	if(strlen($name[0]) > 31){ // Cuenta 25 caracteres.
		return false;
	}

	return true;
}


public function check_imagen($uploader_response,$field_info, $files_to_upload){

		$file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name;

	//print_r($files_to_upload);die();
		 if( !$this->is_image($file_uploaded)){
		 	@unlink($file_uploaded);
	 		return 'Formato de imagen incorrecto.';
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