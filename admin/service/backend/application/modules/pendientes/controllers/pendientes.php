<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pendientes extends Main {

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


    $this->load->model('promociones/promociones_model');

    $arrCategorias = $this->promociones_model->get_categorias();
    $arrSubCategorias = $this->promociones_model->get_subcategorias();
    $arrUsersAliados = $this->promociones_model->get_user_aliados();
  	$crud = new grocery_CRUD();
  	$crud->set_theme('flexigrid');



  	$crud->set_table('PRO_PROMOCIONES');
  	$crud->where('AUTORIZADO',0);
    $crud->or_where('AUTORIZADO',null);
  	//$crud->or_where('AUTORIZADO',2);
  	$crud->set_subject('Promocines pendientes');

    $crud->display_as('PRO_NOMBRE','Titulo promoción')
         ->display_as('PRO_DESCRIPCION','Descripción')
         ->display_as('PRO_ETIQUETA','Etiqueta')
         ->display_as('PRO_LOGO_PREMIUM','Imagen premium')
         ->display_as('PRO_LOGO_GENERAL','Imagen general')
         ->display_as('PRO_PRECIO_INICIAL','Precio inicial')
         ->display_as('PRO_PRECIO_FINAL','Precio final')
         ->display_as('PRO_DESCUENTO','Descuento')
         ->display_as('PRO_SRC_ID','Tipo de promoción')
         ->display_as('VISIBILITY','Visibilidad')
         ->display_as('PRO_URL','url')
         ->display_as('CAT_ID','Categoría')
         ->display_as('SUB_ID','Subcategoría')
         ->display_as('AUTORIZADO','Estado')
         ->display_as('eventos','Eventos')
         ->display_as('PRO_MOTIVO_RECHAZO','Motivo rechazo')
         ->display_as('PRO_TIPO_MONEDA', 'Moneda')
         ->display_as('PRO_FECHA', 'Fecha')
         ->display_as('PRO_AUTOR', 'Autor')
         ->display_as('PRO_USER_AUTORIZADOR', 'Aprobador')
         ->display_as('PRO_USER_CREADOR', 'Usuario')
         ->display_as('VISTA_PREVIA', 'Vista previa')
         ->display_as('ID_USER_CREADOR', 'ID Usuario');

    $state = $crud->getState();

    $crud->unset_delete();
    $crud->unset_add(); //Elimina el boton agregar
    $crud->unset_edit(); //Elimina el boton agregar

    $this->load->model('pendientes_model');
    $result = $this->pendientes_model->get_grupo($this->session->userdata('sadmin_user_id'));

    $crud->callback_field('PRO_LOGO_PREMIUM',array($this,'show_imagen_premium'));
    $crud->callback_field('PRO_LOGO_GENERAL',array($this,'show_imagen_genereal'));

    	//***************************	Relacion de tablas ***************************

    $crud->set_relation_n_n('eventos', 'EXP_EVENTOXPROMOCION', 'EVE_EVENTOS', 'EXP_PROMOCION', 'EXP_EVENTO', 'EVE_NOMBRE');


    $crud->fields('PRO_NOMBRE','PRO_LOGO_PREMIUM','PRO_LOGO_GENERAL','PRO_DESCRIPCION','CAT_ID','SUB_ID','PRO_PRECIO_INICIAL','PRO_PRECIO_FINAL','PRO_TIPO_MONEDA','PRO_DESCUENTO','VISIBILITY','PRO_AUTOR','AUTORIZADO','eventos','PRO_USER_CREADOR','ID_USER_CREADOR','PRO_URL', 'VISTA_PREVIA');

    $crud->columns('PRO_LOGO_PREMIUM', 'PRO_LOGO_GENERAL','PRO_NOMBRE','PRO_AUTOR','VISIBILITY','AUTORIZADO','eventos','PRO_SRC_ID');


    $crud->set_field_upload('PRO_LOGO_PREMIUM','multimedia/promociones/');
    $crud->set_field_upload('PRO_LOGO_GENERAL','multimedia/promociones/');
    $crud->callback_column('PRO_SRC_ID',array($this, 'tipo_promocion'));
    $crud->callback_field('PRO_TIPO_MONEDA',array($this,'tipo_moneda'));
    $crud->callback_column('AUTORIZADO',array($this,'estado_promocion'));
    $crud->add_action('Aceptar','../../images/aprobar.png','','aceptar-promocion',array($this,'aceptar_promociones'));
    $crud->add_action('Rechazar','../../images/rechazar.png','','rechazar-promocion',array($this,'rechazar_promociones'));
    $crud->callback_field('CAT_ID',array($this,'get_categoria'));
    $crud->callback_field('SUB_ID',array($this,'get_subcategoria'));
    $crud->callback_field('AUTORIZADO',array($this,'estado_promocion_field'));
    $crud->callback_field('PRO_USER_CREADOR',array($this,'get_usuarios_aliados'));
    $crud->callback_field('ID_USER_CREADOR',array($this,'get_id_user_creador'));
    $crud->callback_field('eventos',array($this,'get_eventos'));
    $crud->callback_field('VISTA_PREVIA',array($this,'link_vista_previa'));


    $crud->field_type('PRO_USER_ULTIMO','hidden',$this->session->userdata('sadmin_user_id'));
    $crud->field_type('PRO_USER_AUTORIZADOR','hidden',$this->session->userdata('sadmin_user_id'));

    $crud->order_by('PRO_FECHA','DESC');


    $this->data['output'] = $output = $crud->render();
    $this->data['titulo']='Promociones pendientes';
    $this->data['encabezado']='Gestión de novedades';

    $breadcrums[]='<a class="current" href="'.site_url('main/pendientes').'">Promocines pendientes</a>';
    $this->salida('pendientes/pendientes',$this->data, $breadcrums);
  }


/******************************************************************************/

function show_imagen_premium($value){
  if($value != '')
    return '<img src="../../../../multimedia/promociones/'.$value.'" width="60" id="field-PRO_LOGO_PREMIUM"/>';
}

function show_imagen_genereal($value){
  if($value != '')
    return '<img src="../../../../multimedia/promociones/'.$value.'" width="60" id="field-PRO_LOGO_GENERAL"/>';
}

function get_id_user_creador($value, $id_promo){
  $result = $this->pendientes_model->get_user_x_promocion($id_promo);
  return $result['PRO_USER_CREADOR'];
}

function get_eventos($value, $id_promo){
  $result = $this->pendientes_model->get_eventos_promocion($id_promo);
  return $result;
}

function link_vista_previa(){
  return '<a onClick="vista_previa()">Vista previa</a>';
}

function get_usuarios_aliados($value){
  $this->load->model('pendientes_model');
  $result = $this->pendientes_model->get_user($value);
  return $result['username'];
}

function get_subcategoria($value){
  $this->load->model('pendientes_model');
  $result = $this->pendientes_model->getSubCategoriaId($value);
  return $result['SUB_NOMBRE'];
}
function get_categoria($value){
  $this->load->model('pendientes_model');
  $result = $this->pendientes_model->getCategoriaId($value);
  return $result['CAT_NOMBRE'];
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
    default:
      return 'Pendiente de aprobación';
      break;
  }

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

function aceptar_promociones($primary_key, $row){
  //return base_url().'index.php/main/aceptar_promocion/'.$row->PRO_ID;
  return 'javascript: aceptarPromocion('. $row->PRO_ID .')';
}

function rechazar_promociones($primary_key, $row){
  //return base_url().'index.php/main/rechazar_promocion/'.$row->PRO_ID;
  return 'javascript: rechazarPromocion('. $row->PRO_ID .')';
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
  $this->load->model('pendientes_model');
  //print_R($row);
  $paquete = $this->pendientes_model->get_paquete($row->PRO_USER_CREADOR);


  if(empty($paquete)){
    return 'sin paquete';
  }
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

  function send_rechazado($post_array,$primary_key){
      $this->load->model('pendientes_model');

        $titulo_promo =$post_array['PRO_NOMBRE'];
        $usuario_creador =$post_array['PRO_USER_CREADOR'];
        $autor=$post_array['PRO_AUTOR'];
        $motivo_rechazo = $post_array['PRO_MOTIVO_RECHAZO'];
        $eventos_promo = $this->pendientes_model->get_eventos_promocion($primary_key);

      if($post_array['AUTORIZADO']==2 ){
        $asunto='Su promocion ha sido RECHAZADA';
        $datos= $this->pendientes_model->send_mail_rechazado($titulo_promo,$usuario_creador,$asunto,$autor, $post_array['AUTORIZADO'],$eventos_promo,$motivo_rechazo);
      }

       if($post_array['AUTORIZADO']==1 ){
        // $titulo_promo =$post_array['PRO_NOMBRE'];
        // $usuario_creador =$post_array['PRO_USER_CREADOR'];
        $asunto='Su promocion ha sido APROBADA';
        $datos= $this->pendientes_model->send_mail_rechazado($titulo_promo,$usuario_creador,$asunto,$autor,$post_array['AUTORIZADO'],$eventos_promo);
      }

      // return true;
  }




}

