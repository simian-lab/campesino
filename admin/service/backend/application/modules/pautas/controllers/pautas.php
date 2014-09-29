<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pautas extends Main {

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

		$this->load->model('pautas_model');

		$crud = new grocery_CRUD();

		$crud->set_theme('flexigrid');
		$crud->set_table('PAU_PAUTAS');
		$crud->set_subject('Pautas');
		$crud->where('PAU_EVENTO',1);
		$crud->or_where('PAU_EVENTO',null);

                $crud->display_as('PAU_NOMBRE','Nombre')
		        ->display_as('PAU_IMAGEN','Imagen destacada <br>(1280 x 426)')
		        ->display_as('PAU_MOVIL_IMAGEN','Imagen principal <br>(360 X 300)')
		        ->display_as('VISIBILITY','Visibilidad')
		        ->display_as('PAU_FECHA','Fecha')
		        ->display_as('PAU_USER_CREADOR','Creador')
		        ->display_as('PAU_DESTACADO','Destacado')
		        ->display_as('PAU_DESCRIPCION','Descripcion')
		        ->display_as('PAU_USER_ULTIMO','Utimo');
/*CONTROL*/
$result = $this->pautas_model->control_pauta($this->session->userdata('sadmin_user_id'));
// print_r($result);
	if($result[0]['RESPUESTA']!=0 ){
	          	$this->data['output'] =" <h1>No tenes permiso para acceder esta seccion</h1>" ;// $output = $crud->render();
	            $breadcrums[]='<a class="current" href="'.site_url('main/promociones').'">Promociones</a>'; 
	          	$this->data['titulo']='Permiso denegado';
	          	$this->data['encabezado']='Error';
	          	$this->error('example',$this->data,$breadcrums);
	          	die();
	          }
/*CONTROL*/



        //***************************	Relacion de tablas ***********************************************************	
        $crud->set_relation_n_n('Tags', 'TAG_PAUTAS', 'TAGS_NOMBRES', 'TAG_PAUTAS_ID', 'TAGS_ID', 'TAGS_NOMBRE');
  		//relacion con patrocinadores
        $crud->set_relation_n_n('Patrocinadores','PXP_PAUTAXPATROCINADOR', 'PAT_PATROCINADORES','PAU_ID', 'PAT_ID', 'PAT_NOMBRE');
        //***************************	Relacion de tablas ***********************************************************

		$crud->fields('PAU_EVENTO','PAU_DESTACADO','PAU_ID','PAU_NOMBRE','PAU_IMAGEN','PAU_MOVIL_IMAGEN','PAU_DESCRIPCION','VISIBILITY','Tags','Patrocinadores','PAU_FECHA','PAU_USER_CREADOR','PAU_USER_ULTIMO','PAU_SLUG');
        $crud->required_fields('PAU_NOMBRE','PAU_DESTACADO','PAU_IMAGEN','PAU_MOVIL_IMAGEN','VISIBILITY','PAU_FECHA','PAU_DESCRIPCION');
        $crud->columns('PAU_NOMBRE','Patrocinadores','VISIBILITY','PAU_FECHA');
		$this->data= array('autor'=>$this->session->userdata('username') . ' ('.$this->session->userdata('email').')' , 'ident'=>$this->session->userdata('sadmin_user_id') );

		$crud->unset_read();
		// $crud->add_action('Asignar pautas', base_url('/images/exchange.png'), 'main/asignar_pautas');
		//$crud->add_action('Agregar',base_url('/images/insert-image.png'),'','ui-icon-image',array($this,'Listar_items') );





		$crud->set_field_upload('PAU_IMAGEN','multimedia/pautas/');
		$crud->callback_after_upload(array($this,'mover_imagen_destacado'));
		
		$crud->set_field_upload('PAU_MOVIL_IMAGEN','multimedia/pautas/');
		$crud->callback_after_upload(array($this,'mover_imagen'));



	    
		$crud->field_type('PAU_NOMBRE','String');
		$crud->field_type('VISIBILITY','true_false');
		$crud->field_type('Tags','multiselect');    
		$crud->field_type('PAU_ID','invisible');    
		$crud->field_type('PAU_EVENTO','invisible' );    
		$crud->field_type('PAU_SLUG','invisible');    
		$crud->field_type('PAU_DESCRIPCION','text');    
		$crud->field_type('PAU_DESTACADO','dropdown',array('1'=>'Destacado','0'=>'No destacar') );    

		$crud->field_type('PAU_USER_CREADOR','invisible');
		$crud->field_type('PAU_USER_ULTIMO','invisible');
		$crud->field_type('Patrocinadores','dropdown');

		// $crud->callback_field('PAU_USER_CREADOR',array($this,'field_callback_user_creador'));
		// $crud->callback_field('PAU_USER_ULTIMO',array($this,'field_callback_user_ultimo'));


		$crud->callback_before_insert(array($this,'limpiar_textos_slug_insert')); //  antes de insertar
		$crud->callback_before_update(array($this,'limpiar_textos_slug'));

		// $crud->add_action('Imágenes', base_url('/images/insert-image.png'), 'main/imagenes_novedades','');
		$crud->set_language('spanish');
		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Pautas';
		$this->data['encabezado']='Gestión de novedades';

		$breadcrums[]='<a class="current" href="'.site_url('main/pautas').'">Pautas</a>'; 
		$this->salida('example',$this->data, $breadcrums);
	}

/* ******************************************************************************************************************* */


function limpiar_textos_slug($post_array){
		   $this->load->helper('htmlpurifier');
		   $this->load->helper('url');
		   

		   $post_array['PAU_SLUG'] = url_title($post_array['PAU_NOMBRE'], 'dash', TRUE );//url_title($this->input->post('PAU_SLUG'), 'dash', TRUE);
     		return $post_array;

		}

function limpiar_textos_slug_insert($post_array){
				   $this->load->helper('htmlpurifier');
				   $this->load->helper('url');
				   
				   $post_array['PAU_USER_CREADOR'] = $this->session->userdata('sadmin_user_id') ;
				   $post_array['PAU_USER_ULTIMO'] = $this->session->userdata('sadmin_user_id') ;
				   $post_array['PAU_EVENTO'] = 1 ;
				  

				   $post_array['PAU_SLUG'] = url_title($post_array['PAU_NOMBRE'], 'dash', TRUE );
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

function mover_imagen_destacado($uploader_response,$field_info, $files_to_upload){
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


	function Listar_items($primary_key , $row)
	{
	    return site_url('main/asignar_pautas').'/'.$row->PAU_ID;
	}


	// function field_callback_user_creador($value = '', $primary_key = null){
	// 	    return '<input type="text" maxlength="50" value="'.$this->data['ident'].'" name="PAU_USER_CREADOR" readonly style="display:none">';
	// 	}


	// function field_callback_user_ultimo($value = '', $primary_key = null){
	// 	    return '<input type="text" maxlength="50" value="'.$this->data['ident'].'" name="PAU_USER_ULTIMO" readonly style="display:none">';
	// 	}

		
	function cambiar_img($uploader_response,$field_info, $files_to_upload)
	{
		$this->load->library('image_moo');
	 
		//Is only one file uploaded so it ok to use it with $uploader_response[0].
		$file_uploaded = $field_info->upload_path.'/'.$uploader_response[0]->name; 
	 
		$this->image_moo->load($file_uploaded)->set_background_colour("#FFF")->resize(236,200,TRUE)->save($file_uploaded,true);
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
          


}