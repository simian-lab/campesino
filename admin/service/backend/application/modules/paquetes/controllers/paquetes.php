<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paquetes extends Main {

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

		$crud = new grocery_CRUD();

		$crud->set_theme('flexigrid');
		$crud->set_table('PAQUETES_NOMBRES');
		$crud->set_subject('Paquetes');
		
		// $this->data= array('autor'=>$this->session->userdata('username') . ' ('.$this->session->userdata('email').')' , 'ident'=>$this->session->userdata('sadmin_user_id') );

                $crud->display_as('PAQ_NOMBRE','Nombre paquete')
                ->display_as('PAQ_MONTO_PREMIUN','Monto Premium Home')
                ->display_as('PAQ_MONTO_PREMIUN_CATEGORIA', 'Monto Premium Categorías')
		        ->display_as('PAQ_MONTO_BASICO','Monto Básico')
		        ->display_as('PAQ_FECHA','Fecha');
		        // ->display_as('VISIBILITY','Visibilidad');

					$crud->fields('PAQ_NOMBRE','PAQ_MONTO_PREMIUN','PAQ_MONTO_PREMIUN_CATEGORIA','PAQ_MONTO_BASICO','PAQ_FECHA','PAQ_USER_CREADOR');
                    $crud->required_fields('PAQ_NOMBRE','PAQ_MONTO_PREMIUN','PAQ_MONTO_PREMIUN_CATEGORIA','PAQ_MONTO_BASICO');
                    $crud->columns('PAQ_NOMBRE','PAQ_MONTO_PREMIUN','PAQ_MONTO_PREMIUN_CATEGORIA','PAQ_MONTO_BASICO','PAQ_FECHA');
                    $crud->unset_read();
                    $crud->field_type('PAQ_NOMBRE','String');
                    $crud->field_type('PAQ_MONTO_PREMIUN','integer');
                    $crud->field_type('PAQ_MONTO_PREMIUN_CATEGORIA','integer');
                    $crud->field_type('PAQ_MONTO_BASICO','integer');
                    $crud->field_type('PAQ_USER_CREADOR','invisible' );
                    $crud->field_type('PAQ_FECHA','datetime');

            
                    $crud->callback_before_insert(array($this,'limpiar_datos'));
                    $crud->callback_before_update(array($this,'limpiar_datos'));

		$crud->set_language('spanish');
		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Paquetes';
		$this->data['encabezado']='Paquetes';

		$breadcrums[]='<a class="current" href="'.site_url('main/Paquetes').'">Paquetes</a>'; 
		$this->salida('example',$this->data, $breadcrums);
	}

function limpiar_cadena_titulo($texto){
	 $texto=strip_tags($texto);
		return $texto;
	}


/**************** METODOS CALLBACK ****************/
function limpiar_datos($post_array){

       	    $post_array['PAQ_USER_CREADOR'] = $this->session->userdata('sadmin_user_id');
       	    // $post_array['TAGS_USER_ULTIMO'] =$this->session->userdata('sadmin_user_id');
       	    $post_array['PAQ_NOMBRE'] =$this->limpiar_cadena_titulo($post_array['PAQ_NOMBRE']);
       	    // $post_array['AUTORIZADO'] =$this->session->userdata('sadmin_user_id');

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