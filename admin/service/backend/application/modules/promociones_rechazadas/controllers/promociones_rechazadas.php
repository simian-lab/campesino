<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promociones_rechazadas extends Main {

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
		$this->load->model('promociones_rechazadas_model');



        $arrCategorias = $this->promociones_rechazadas_model->get_categorias();
        $arrSubCategorias = $this->promociones_rechazadas_model->get_subcategorias();
        $arrMarcas = $this->promociones_rechazadas_model->get_marcas();
        $arrTipoPromocion=array('1'=>'General','2'=>'Premium Home','3'=>'Premium Categorías');
        $arrUsersAliados = $this->promociones_rechazadas_model->get_user_aliados();
       
		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');
		$crud->set_table('PRO_PROMOCIONES');
		$crud->where('AUTORIZADO',2);
        $state = $crud->getState();

		/*CONTROL*/
		if( $state!='upload_file'){
		$segmento=$this->uri->segment(4);
		if( isset($segmento) && !empty($segmento) ){
				$result = $this->promociones_rechazadas_model->control_promocion($segmento,$this->session->userdata('sadmin_user_id'));
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


  		$result = $this->promociones_rechazadas_model->get_grupo($this->session->userdata('sadmin_user_id'));
        if( $result['group_id']==5  ){
		   $crud->where('PRO_USER_CREADOR',$this->session->userdata('sadmin_user_id'));
		   $crud->field_type('VISIBILITY','hidden');

	   }
         		 

		$crud->set_subject('Promociones');


        $crud->display_as('PRO_NOMBRE','Nombre promoción')
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
             ->display_as('MAR_ID','Marca')
             ->display_as('Paquete')
             ->display_as('PRO_TIPO_MONEDA', 'Moneda')
             ->display_as('PRO_USER_CREADOR', 'Usuario')
             ->display_as('VISTA_PREVIA', 'Vista previa')
             ->display_as('MOTIVO', 'Motivo de rechazo')
             ->display_as('ID_USER_CREADOR', 'ID Usuario');


	     $crud->unset_edit();
	     $crud->unset_delete();
	     $crud->unset_add();
		 
       //***************************	Relacion de tablas ***************************	

       $crud->set_relation_n_n('Tags', 'TAG_PROMOCIONES', 'TAGS_NOMBRES', 'PRO_ID', 'TAGS_ID', 'TAGS_NOMBRE' );
       
       $crud->order_by('PRO_FECHA','DESC');


		$crud->fields('PRO_NOMBRE','PRO_SRC_ID','PRO_LOGO_PREMIUM', 'PRO_LOGO_GENERAL','PRO_DESCRIPCION','MAR_ID','CAT_ID','SUB_ID','PRO_PRECIO_INICIAL','PRO_PRECIO_FINAL','PRO_TIPO_MONEDA','PRO_DESCUENTO','VISIBILITY','PRO_USER_CREADOR','ID_USER_CREADOR','PRO_URL','MOTIVO','VISTA_PREVIA');
        $crud->required_fields('PRO_NOMBRE','PRO_SRC_ID','PRO_DESCRIPCION','PRO_URL', 'CAT_ID','PRO_USER_CREADOR');
        $crud->columns('PRO_NOMBRE','PRO_LOGO_PREMIUM', 'PRO_LOGO_GENERAL','PRO_AUTOR','CAT_ID','SUB_ID','AUTORIZADO', 'Paquete','PRO_SRC_ID','VISIBILITY');


		$crud->set_field_upload('PRO_LOGO_PREMIUM','multimedia/promociones/');
		$crud->set_field_upload('PRO_LOGO_GENERAL','multimedia/promociones/');
		$crud->callback_after_upload(array($this,'check_imagen'));
		$crud->callback_column('Paquete', array($this, 'columna_paquete'));
	
		$crud->callback_after_insert(array($this,'fnc_after_insert')); // despues de insertar
		$crud->callback_before_update(array($this,'before_update')); // anets de insertar
		$crud->callback_before_insert(array($this,'before_insert')); //  antes de insertar
		
		$crud->callback_field('PRO_TIPO_MONEDA',array($this,'tipo_moneda'));
		$crud->callback_field('PRO_SRC_ID',array($this,'tipo_promocion'));
		$crud->callback_field('MAR_ID',array($this,'get_marca'));
		$crud->callback_field('CAT_ID',array($this,'get_cat'));
		$crud->callback_field('SUB_ID',array($this,'get_subcat'));
		$crud->callback_field('PRO_USER_CREADOR',array($this,'get_user_creador'));
		$crud->callback_field('VISTA_PREVIA',array($this,'link_vista_previa'));
		$crud->callback_field('MOTIVO',array($this,'motivo_rechazo_promocion'));
		$crud->callback_field('ID_USER_CREADOR',array($this,'get_id_user_creador'));

		$crud->set_rules('PRO_PRECIO_INICIAL','Precio inicial','numeric');
		$crud->set_rules('PRO_PRECIO_FINAL','Precio final','numeric');
		$crud->set_rules('PRO_DESCUENTO','Descuento','integer|max_length[3]|less_than[101]');

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

		$crud->field_type('PRO_DESCRIPCION','text');
		$crud->field_type('PRO_URL','String');
        $crud->field_type('Tags','multiselect');  
        $crud->field_type('PRO_FECHA','invisible');
		$crud->field_type('PRO_SRC_ID','dropdown', $arrTipoPromocion);
		$crud->field_type('CAT_ID','dropdown', $arrCategorias);
		$crud->field_type('SUB_ID','dropdown', $arrSubCategorias);
		$crud->field_type('MAR_ID','dropdown', $arrMarcas);
		$crud->field_type('PRO_TIPO_MONEDA', 'true_false');

		if($state == 'read'){
			$crud->callback_field('PRO_LOGO_PREMIUM',array($this,'show_imagen_premium'));
			$crud->callback_field('PRO_LOGO_GENERAL',array($this,'show_imagen_genereal'));
		}

		 // echo $state;
		if( $state=='edit'){

			$crud->field_type('AUTORIZADO','hidden',0);
		}else if( $state=='add'){
			$crud->field_type('AUTORIZADO','invisible');
		}else if($state=='list' || $state=='ajax_list'){
			$crud->field_type('AUTORIZADO','dropdown',array('null'=>'Pendiente de aprobacion','0'=>'Pendiente de aprobacion','1'=>'Aprobado','2'=>'Rechazado') );
		}

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
		$this->salida('promociones_rechazadas/promociones_rechazadas',$this->data, $breadcrums);
	}

/********************************************************************/
function show_imagen_premium($value){
	if($value != '')
		return '<img src="../../../../multimedia/promociones/'.$value.'" width="60" id="field-PRO_LOGO_PREMIUM"/>';
}

function show_imagen_genereal($value){
	if($value != '')
		return '<img src="../../../../multimedia/promociones/'.$value.'" width="60" id="field-PRO_LOGO_GENERAL"/>';
}

function motivo_rechazo_promocion($value, $id_promo){
	$result = $this->promociones_rechazadas_model->get_motivo_rechazo($id_promo);
	return $result;
}

function link_vista_previa(){
	return '<a onClick="vista_previa()">Vista previa</a>';
}

function get_id_user_creador($value, $id_promo){
	$result = $this->promociones_rechazadas_model->get_user_x_promocion($id_promo);
	return $result['PRO_USER_CREADOR'];
}

function get_user_creador($value){
	$result = $this->promociones_rechazadas_model->get_user($value);
	return $result['username'];
}
function get_marca($value){
	$result = $this->promociones_rechazadas_model->get_marca($value);
	return $result['MAR_NOMBRE'];
}

function get_cat($value){
	$result = $this->promociones_rechazadas_model->getCategoriaId($value);
	return $result['CAT_NOMBRE'];
}

function get_subcat($value){
	$result = $this->promociones_rechazadas_model->getSubCategoriaId($value);
	return $result['SUB_NOMBRE'];
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
  $paquete = $this->promociones_rechazadas_model->get_paquete($row->PRO_USER_CREADOR);
  //print_R($paquete);
  return $paquete[$row->PRO_USER_CREADOR];
}

function tipo_promocion($post_array){
  if($post_array == 1){
    return 'General';
  }
  elseif($post_array == 3){
    return 'Premium Categoría';
  }
  else{
  	return 'Premium Home';
  }
}

function limit_titulo($value){

	return '<input type="text" id="field-PRO_NOMBRE" name="PRO_NOMBRE" value="'.$value.'" maxlength="35"/>';

}

function before_insert($post_array){
$this->load->model('promociones_rechazadas_model');

//$pUSER_ID= $this->session->userdata('sadmin_user_id'); // Id de usuario que esta cargando la promo
$pUSER_ID=$post_array['PRO_USER_CREADOR'];
$pTIPO = $post_array['PRO_SRC_ID'];

$datos= $this->promociones_rechazadas_model->decrementar($pUSER_ID,$pTIPO);
$msg_error=$datos[0]["RESPUESTA"];
//print_R($this->session->userdata('sadmin_user_id'));die();
	if($msg_error!='0'){
		echo '<script> alert("Superó la cantidad màxima de promociones que puede cargar en esta categoria." ) </script>';
		exit();
	}

    $post_array['AUTORIZADO']='0';
    $post_array['PRO_FECHA']=date('Y-m-d h:m:s');
    $post_array['PRO_USER_CREADOR']=$this->session->userdata('sadmin_user_id');
    $post_array['PRO_USER_ULTIMO']=$this->session->userdata('sadmin_user_id');
    $post_array['PRO_USER_AUTORIZADOR']=$this->session->userdata('sadmin_user_id');
    $post_array['PRO_AUTOR']=$this->session->userdata('username');

	return $post_array;

}

function before_update($post_array, $primary_key){
	$this->load->helper('url');

	$post_array['PRO_URL']=prep_url($post_array['PRO_URL']);
	$post_array['AUTORIZADO']='0';

	return $post_array;
}

function fnc_after_insert($post_array){
    $this->load->helper('url');
	$this->load->model('promociones_rechazadas_model');

	$post_array['PRO_URL']=prep_url($post_array['PRO_URL']);


      $datos_envio['titulo'] = $this->limpiar_cadena_titulo($post_array['PRO_NOMBRE']);
      $datos_envio['autor'] = $post_array['PRO_AUTOR'];
      $datos= $this->promociones_rechazadas_model->send_mail_user($datos_envio);
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


public function check_imagen($uploader_response,$field_info, $files_to_upload){

		$file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name; 
		  
		 if( !$this->is_image($file_uploaded)){

		 	@unlink($file_uploaded);
	 		return 'Formato de image incorrecto.';
	 	}
	 	$ndestino =  '../static/multimedia/promociones/'.$uploader_response[0]->name;
		copy($file_uploaded, $ndestino);

	 	return true;
}

 


          

}