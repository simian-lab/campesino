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

  //$arrMarcaPais = $this->promociones_model->get_marcapais();
  $arrCategorias = $this->promociones_model->get_categorias();
  $arrSubCategorias = $this->promociones_model->get_subcategorias();

  // $arrTipoPromocion=array('0'=>'Premium','1'=>'General');
   // $arrTipoPromocion= $this->promociones_model->get_paquetes();

		$crud = new grocery_CRUD();
		$crud->set_theme('flexigrid');



		$crud->set_table('PRO_PROMOCIONES');
		$crud->where('AUTORIZADO',0);
    $crud->or_where('AUTORIZADO',null);
		$crud->or_where('AUTORIZADO',2);
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
                            ->display_as('PRO_MOTIVO_RECHAZO','Motivo rechazo')
                            ->display_as('PRO_LOGO_VISA', 'Logo Visa')
                            ->display_as('Paquete')
                            ->display_as('PRO_TIPO_MONEDA', 'Moneda');

   $state = $crud->getState();

   $crud->unset_delete();
	 $crud->unset_add(); //Elimina el boton agregar

  // $state_info = $crud->getStateInfo();
// CONTROL PARA HABILITAR EL BOTON DE AGREAR PROMOCIONES SI NO ES EL ADMINISTRADOR
 if( $state=='list' ){
   $this->load->model('pendientes_model');
   $result = $this->pendientes_model->get_grupo($this->session->userdata('sadmin_user_id'));
}

		 //***************************	Relacion de tablas ***************************	
           //Tags (Tags de la tabla de promociones)
           $crud->set_relation_n_n('Tags', 'TAG_PROMOCIONES', 'TAGS_NOMBRES', 'PRO_ID', 'TAGS_ID', 'TAGS_NOMBRE' );
           //subcategoria

          // $crud->fields('PRO_NOMBRE','PRO_LOGO','PRO_DESCRIPCION','PRO_SRC_ID','Tags','CAT_ID','SUB_ID','MAP_ID','PRO_PRECIO_INICIAL','PRO_PRECIO_FINAL','PRO_DESCUENTO','VISIBILITY','PRO_USER_CREADOR','PRO_USER_AUTORIZADOR','PRO_USER_ULTIMO','AUTORIZADO','PRO_URL','PRO_FECHA');
          $crud->fields('PRO_NOMBRE','PRO_LOGO_PREMIUM','PRO_LOGO_GENERAL','PRO_DESCRIPCION','CAT_ID','SUB_ID','PRO_PRECIO_INICIAL','PRO_PRECIO_FINAL','PRO_TIPO_MONEDA','PRO_DESCUENTO','VISIBILITY','PRO_USER_CREADOR','PRO_AUTOR','PRO_USER_AUTORIZADOR','PRO_USER_ULTIMO','AUTORIZADO','PRO_MOTIVO_RECHAZO','PRO_LOGO_VISA','PRO_URL');
          $crud->required_fields('PRO_NOMBRE','PRO_DESTINO','PRO_LOGO_GENERAL','PRO_DESCRIPCION', 'VISIBILITY','PRO_URL');
          
          // $crud->columns('PRO_NOMBRE','PRO_LOGO','VISIBILITY','CAT_ID','SUB_ID','MAP_ID');
          $crud->columns('PRO_LOGO_PREMIUM','PRO_LOGO_GENERAL','PRO_NOMBRE','VISIBILITY','AUTORIZADO','PRO_SRC_ID', 'Paquete');
      		$crud->set_field_upload('PRO_LOGO_PREMIUM','multimedia/promociones/');//ESTA SECCION NO TIENE ESTA OPCION - CHEQUEAR
          $crud->set_field_upload('PRO_LOGO_GENERAL','multimedia/promociones/');
          $crud->set_rules('PRO_PRECIO_INICIAL','Precio inicial','numeric');
          $crud->set_rules('PRO_PRECIO_FINAL','Precio final','numeric');
          $crud->set_rules('PRO_DESCUENTO','Descuento','integer|max_length[3]|less_than[101]');
          // $crud->callback_before_insert(array($this, 'corrobora_estado'));
          // $crud->callback_after_update(array($this, 'corrobora_estado'));
          $crud->callback_after_update(array($this, 'send_rechazado'));
          $crud->callback_column('PRO_SRC_ID',array($this, 'tipo_promocion'));
          $crud->callback_column('Paquete', array($this, 'columna_paquete'));
          $crud->callback_field('PRO_TIPO_MONEDA',array($this,'tipo_moneda'));

          // $crud->callback_update(array($this,'corrobora_estado'));
          $crud->unset_texteditor('PRO_DESCRIPCION','full_text');
          $crud->unset_texteditor('PRO_MOTIVO_RECHAZO','full_text');
          $crud->field_type('PRO_NOMBRE','string');
          $crud->field_type('PRO_PRECIO_INICIAL','string');
          $crud->field_type('PRO_PRECIO_FINAL','string');
          $crud->field_type('PRO_DESCUENTO','string');
          $crud->field_type('VISIBILITY','true_false');
          $crud->field_type('PRO_DESCRIPCION','text');
          $crud->field_type('PRO_URL','string');
          $crud->field_type('Tags','multiselect'); 
          $crud->field_type('PRO_FECHA','date');
          $crud->field_type('PRO_AUTOR','hidden');
          $crud->field_type('PRO_SRC_ID','hidden');
          $crud->field_type('PRO_MOTIVO_RECHAZO', 'text');
          $crud->field_type('PRO_LOGO_VISA', 'true_false');
          $crud->field_type('PRO_TIPO_MONEDA', 'true_false');


          //$crud->field_type('MAP_ID', 'dropdown', $arrMarcaPais);
          $crud->field_type('SUB_ID', 'dropdown', $arrSubCategorias);
          $crud->field_type('CAT_ID', 'dropdown', $arrCategorias);
          $crud->field_type('PRO_USER_CREADOR', 'hidden');
          $crud->field_type('PRO_AUTOR', 'hidden');

          // $crud->field_type('PRO_USER_CREADOR','hidden',$this->session->userdata('sadmin_user_id'));

          $crud->field_type('PRO_USER_ULTIMO','hidden',$this->session->userdata('sadmin_user_id')); //,
          $crud->field_type('PRO_USER_AUTORIZADOR','hidden',7); //,$this->session->userdata('sadmin_user_id')
          $crud->field_type('AUTORIZADO','dropdown',array('0'=>'Pendiente de aprobacion','1'=>'Aprobado','2'=>'Rechazado') );

          $crud->order_by('PRO_FECHA','DESC');
       
    
    $this->data['output'] = $output = $crud->render();
    $this->data['titulo']='Promociones pendientes';
    $this->data['encabezado']='Gestión de novedades';

    $breadcrums[]='<a class="current" href="'.site_url('main/pendientes').'">Promocines pendientes</a>'; 
    $this->salida('promociones',$this->data, $breadcrums);
  }


/******************************************************************************/
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
  if($post_array == 1){
    return 'General';
  }
  else{
    return 'Premium';
  }
}

  function send_rechazado($post_array,$primary_key){
      $this->load->model('pendientes_model');

        $titulo_promo =$post_array['PRO_NOMBRE'];
        $usuario_creador =$post_array['PRO_USER_CREADOR'];
        $autor=$post_array['PRO_AUTOR'];
        $motivo_rechazo = $post_array['PRO_MOTIVO_RECHAZO'];

      if($post_array['AUTORIZADO']==2 ){
        $asunto='Su promocion ha sido RECHAZADA';
        $datos= $this->pendientes_model->send_mail_rechazado($titulo_promo,$usuario_creador,$asunto,$autor, $post_array['AUTORIZADO'],$motivo_rechazo);
      }

       if($post_array['AUTORIZADO']==1 ){
        // $titulo_promo =$post_array['PRO_NOMBRE'];
        // $usuario_creador =$post_array['PRO_USER_CREADOR'];
        $asunto='Su promocion ha sido APROBADA';
        $datos= $this->pendientes_model->send_mail_rechazado($titulo_promo,$usuario_creador,$asunto,$autor,$post_array['AUTORIZADO']);
      }

      // return true;
  }




}

