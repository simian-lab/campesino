<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Main extends MX_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');

/*		if($this->input->get('lang')){
			$session_data = array(
				'pais_db' => $this->input->get('lang')
				);
				// Destrullo cualquier session creada
				$this->session->sess_destroy();
				// Inicializo la neva sessión.
				$this->session->sess_create();
				$this->session->set_userdata($session_data);

				header("Location: /admin");
				exit;
		}else{
			if($this->session->userdata('pais_db'))
				$pais = $this->session->userdata('pais_db');
			else{
				$pais = 'cl';
				$session_data = array(
					'pais_db' => $pais
					);
					// Destrullo cualquier session creada
					$this->session->sess_destroy();
					// Inicializo la neva sessión.
					$this->session->sess_create();
					$this->session->set_userdata($session_data);
			}
			$this->load->database($pais);
		}
*/
		$this->load->library('ion_auth');
		$this->data = array();
		$this->checkProcess();
		

	}

// METODO PARA IMPRIMIR EL MENU.
	public function print_menu(){
//		die('>>'.$this->session->userdata('sadmin_user_id'));
		$process_list = $this->ion_auth->consulta_menu($this->session->userdata('sadmin_user_id'));
		$menu_list= '<ul class="toggle">';
		$cierra = false;
		foreach ($process_list as $listado)
		{
			if($listado->process_id == 0){	
				if($cierra == TRUE)
					$menu_list.= '</ul>';
				$menu_list.= '<h3>'.$listado->process.'</h3><ul class="toggle">';
				$cierra = TRUE;
			}else{
				$icono = 'icn_tags';
				if($listado->style)
					$icono = $listado->style;

				if($listado->menu == 'Si')
					$menu_list.= '<li class="'.$icono.'"><a href="'.site_url($listado->method).'">'.$listado->process.'</a></li>';
			}
		}
		if($cierra == TRUE)
			$menu_list.= '</ul>';

		$menu_list.= '</ul>';
		return $menu_list;
	}

// METODO OUTPUT - SALIDA A NAVEGADOR.
	function salida($plantilla, $datos = array(), $breadcrumbs = array()){
		// Si existen datos en $datos['output'] los asignos para pasarlos al header
		if(isset($datos['output'])){
			$data['output'] = $datos['output'];
		}

		$data['activa_menu']= NULL;

		// Pregunto si existe session activa, si no mostramos el formulario login
		if($this->ion_auth->logged_in()==1){
			$data['activa_menu']= 1;
			$data['user']= $this->session->userdata('username');
			$data['email']= $this->session->userdata('email');
			$id = $this->session->userdata('sadmin_user_id');
		
		}elseif($plantilla == 'auth/forgot_password' || $plantilla == 'auth/reset_password'){
			
		}else{
			if(uri_string()!='main/login')
				redirect('main/login', 'refresh');
		}
		
		// Recupero el menu del usuario
		$data['menu_usuario'] = $this->print_menu();
		// Cargo los breacrumbs
		$data['breadcrumbs']= implode('<div class="breadcrumb_divider"></div>',$breadcrumbs);

		$this->load->view('default/header', $data);
		$this->load->view($plantilla, $datos);
		$this->load->view('default/pie');
                    
	}

// METODO OUTPUT - SALIDA A NAVEGADOR.
	function error($plantilla, $datos = array(), $breadcrumbs = array()){

			$data['output'] = $datos['output'];;
		$data['activa_menu']= NULL;
		if($this->ion_auth->logged_in()==1){
			$data['activa_menu']= 1;
			$data['user']= $this->session->userdata('username');
			$data['email']= $this->session->userdata('email');
			$id = $this->session->userdata('sadmin_user_id');
		
		}elseif($plantilla == 'auth/forgot_password' || $plantilla == 'auth/reset_password'){
			
		}else{
			if(uri_string()!='main/login')
				redirect('main/login', 'refresh');
		}

		// Recupero el menu del usuario
		$data['menu_usuario'] = $this->print_menu();
		// Cargo los breacrumbs
		$data['breadcrumbs']= implode('<div class="breadcrumb_divider"></div>',$breadcrumbs);
		$this->load->view('default/header_error', $data);
		$this->load->view($plantilla, $datos);
		$this->load->view('default/pie');
                    
	}

	function index(){
		
		$process_list = $this->ion_auth->consulta_menu($this->session->userdata('sadmin_user_id'));
		$ir='list_user';
		foreach ($process_list as $listado)
		{
			if($listado->process_id != 0){

				if($listado->menu == 'Si'){
					$ir = str_replace('main/','',$listado->method);
					break;
				}
			}
		}

		$this->$ir();
	}

	
	/* FUNCIONES DE ION_AUTH */
		function login(){
			$auth = $this->load->module('auth_ion');
			echo $retorno = modules::run('modules/auth_ion/login');
		}
		function logout(){
			$auth = $this->load->module('auth_ion');
			echo $retorno = modules::run('modules/auth_ion/logout');
		}
		
		function list_user(){
			$auth = $this->load->module('auth_ion');
			echo $retorno = modules::run('modules/auth_ion/list_user');
		}

		function list_process(){
			$auth = $this->load->module('auth_ion');
			echo $retorno = modules::run('modules/auth_ion/list_process');
		}

		function list_groups(){
			$auth = $this->load->module('auth_ion');
			echo $retorno = modules::run('modules/auth_ion/list_groups');
		}

		function forgot_password(){
			$auth = $this->load->module('auth_ion');
			echo $retorno = modules::run('modules/auth_ion/forgot_password');
		}
	
		function reset_password($pais=NULL, $key=NULL){
			if(!in_array($pais,array('cl','ar','pe')))
				$key = $pais;		
			else{
				$this->load->database($pais);
			}
			$auth = $this->load->module('auth_ion');
			echo $retorno = modules::run('modules/auth_ion/reset_password',$key);
		}
	
		function change_password($id){
			$auth = $this->load->module('auth_ion');
			echo $retorno = modules::run('modules/auth_ion/change_password',$id);
		}
	
	
		function add_process_groups($id=NULL){
			$auth = $this->load->module('auth_ion');
			echo $retorno = modules::run('modules/auth_ion/add_process_groups',$id);
		}
	
		function checkProcess(){
			$this->load->model('ion_auth_model');
	
			$accesos_predeterminados = array('main/index','main/logout','main/login','');
			$segment= 'main/'.$this->uri->segment(2);
			if(in_array($segment,$accesos_predeterminados))
				return true;
			if(!$segment || !$this->session->userdata('sadmin_user_id'))
				return false;
			
			if(!$this->ion_auth_model->access($segment,$this->session->userdata('sadmin_user_id'))){
				redirect('main/logout', 'refresh');
			}/**/
		}

	/* FUNCIONES DE Noticias */
		function noticia(){
			$auth = $this->load->module('noticia');
			echo $retorno = modules::run('modules/noticia/list_noticias');
		}
		function imagenes_noticia($id=NULL){
			$auth = $this->load->module('noticia');
			echo $retorno = modules::run('modules/noticia/imagenes',$id);
		}


              /* FUNCION DE NOVEDADES */ 
      function articulos(){
			$auth = $this->load->module('articulos');
			echo $retorno = modules::run('modules/articulos/index');
		}  
        function promociones(){
			$auth = $this->load->module('promociones');
			echo $retorno = modules::run('modules/promociones/index');
		} 

		function promociones_premium(){
			$auth = $this->load->module('promociones_premium');
			echo $retorno = modules::run('modules/promociones_premium/index');
		} 

		function promociones_premium_home(){
			$auth = $this->load->module('promociones_premium_home');
			echo $retorno = modules::run('modules/promociones_premium_home/index');
		} 

		function promociones_generales(){
			$auth = $this->load->module('promociones_generales');
			echo $retorno = modules::run('modules/promociones_generales/index');
		} 

		function pautas(){
			$auth = $this->load->module('pautas');
			echo $retorno = modules::run('modules/pautas/index');
		}

		function tags(){
			$auth = $this->load->module('tags');
			echo $retorno = modules::run('modules/tags/index');
		}
		function tags_categorias(){
			$auth = $this->load->module('tags_categorias');
			echo $retorno = modules::run('modules/tags_categorias/index');
		}

		function tags_subcategorias(){
			$auth = $this->load->module('tags_subcategorias');
			echo $retorno = modules::run('modules/tags_subcategorias/index');
		}

		function pendientes(){
		$auth = $this->load->module('pendientes');
			echo $retorno = modules::run('modules/pendientes/index');	
		}

		function aliados(){
			$auth = $this->load->module('aliados');
			echo $retorno = modules::run('modules/aliados/index');
		}
		function destinos(){
			$auth = $this->load->module('destinos');
			echo $retorno = modules::run('modules/destinos/index');
		}

		function Paquetes(){
			$auth = $this->load->module('paquetes');
			echo $retorno = modules::run('modules/paquetes/index');
		}

		function asignar_pautas($id=NULL){
			$auth = $this->load->module('asignar_pautas');
		 // Imprimo el valor obtenido
		    // echo $retorno = modules::run('modules/tabla_nutricional/index');
			echo $retorno = modules::run('modules/asignar_pautas/index',$id);
		}

		function asignar_paquetes_aliados(){
			$auth = $this->load->module('asignar_paquetes_aliados');
		 // Imprimo el valor obtenido
			echo $retorno = modules::run('modules/asignar_paquetes_aliados/index');
		}

		function pautas_pre_evento(){
			$auth = $this->load->module('pautas_pre_evento');
		 // Imprimo el valor obtenido
			echo $retorno = modules::run('modules/pautas_pre_evento/index');
		}

		function formulario_sorteo(){

			$auth = $this->load->module('formulario_sorteo');
		 	// Imprimo el valor obtenido
			echo $retorno = modules::run('modules/formulario_sorteo/index');
			
			
		}

		function formulario_participacion(){
			$auth = $this->load->module('formulario_participacion');
		 	// Imprimo el valor obtenido
			echo $retorno = modules::run('modules/formulario_participacion/index');
		}

		function marcas(){
			
			$auth = $this->load->module('marcas');
		 	// Imprimo el valor obtenido
			echo $retorno = modules::run('modules/marcas/index');
			
		}

		function asignar_tiendas(){
			$auth = $this->load->module('asignar_tiendas');
		 	// Imprimo el valor obtenido
			echo $retorno = modules::run('modules/asignar_tiendas/index');
		}

		function get_subcategorias_promociones($cat_id){
			$this->db->select('SUB_SUBCATEGORIA.SUB_ID, SUB_NOMBRE');
			$this->db->from('SUB_SUBCATEGORIA');
			$this->db->join('SXC_SUBCATEGORIAXCATEGORIA', 'SXC_SUBCATEGORIAXCATEGORIA.SUB_ID = SUB_SUBCATEGORIA.SUB_ID');
			$this->db->where('SXC_SUBCATEGORIAXCATEGORIA.CAT_ID',$cat_id);

			$query = $this->db->get();
			if ($query->num_rows() > 0)  {
				foreach ($query->result() as $row){
	            	$salida[$row->SUB_ID]=$row->SUB_NOMBRE;
	        	}
	        }
	        else{
	        	$salida = ' ';
	        }
        	echo json_encode($salida);
		}

		function vista_previa_promociones(/*$nombre_promocion, $descripcion_promocion, $precio_inicial_promocion, $precio_final_promocion, $descuento_promocion, $url_promocion*/){
			//$this->load->library('security');

			$data['id_user'] = $this->input->post('id');
			$data['nombre_promocion'] = filter_var($this->input->post('nombre'),FILTER_SANITIZE_SPECIAL_CHARS);
			$data['descripcion_promocion'] = filter_var($this->input->post('descripcion'),FILTER_SANITIZE_SPECIAL_CHARS);
			$data['precio_inicial_promocion'] = filter_var($this->input->post('precio_inicial'),FILTER_SANITIZE_SPECIAL_CHARS);
			$data['precio_final_promocion'] = filter_var($this->input->post('precio_final'),FILTER_SANITIZE_SPECIAL_CHARS);
			$data['descuento_promocion'] = filter_var($this->input->post('descuento'),FILTER_SANITIZE_SPECIAL_CHARS);
			$data['url_promocion'] = filter_var($this->input->post('url'),FILTER_VALIDATE_URL);
			//var_dump();die();
			$data['imagen_premium_promocion'] = filter_var($this->input->post('imagen_premium'),FILTER_SANITIZE_SPECIAL_CHARS);
			$data['imagen_general_promocion'] = filter_var($this->input->post('imagen_general'),FILTER_SANITIZE_SPECIAL_CHARS);
			$data['seccion'] = $this->input->post('seccion');
			$data['tipo_moneda_promocion'] = filter_var($this->input->post('tipo_moneda'),FILTER_SANITIZE_SPECIAL_CHARS);
//print_r($this->input->post('url',true));die();
			$this->load->database();
			$this->db->select('TIE_NOMBRE, TIE_TEXTO_VISA, TIE_LOGO_VISA,TIE_ID_USER');
			$this->db->from('TIE_TIENDAS');
			$this->db->where('TIE_ID_USER', $data['id_user']);

			$query = $this->db->get();
			//PRINT_R($query);die();
			$result = $query->row_array();
			$data['logo_visa'] = $result['TIE_LOGO_VISA'];
			$data['nombre_tienda'] = $result['TIE_NOMBRE'];
			$data['texto_visa'] = $result['TIE_TEXTO_VISA'];
			//print_r($data);die();
			$this->load->helper('get_url_base');
			$url = get_url_base();

			$data['url_static'] = $url['base_url_static_evento'];
			$this->load->view('vista_previa_promociones',$data);
		}

		function aceptar_promocion(){
			$id_promocion = $this->input->post('id_promocion');
			$user_autorizador = $this->input->post('user_autorizador');
			$data = array(
	                'AUTORIZADO' => 1,
	                'PRO_USER_AUTORIZADOR' => $user_autorizador
	            );
	        $this->db->where('PRO_ID', $id_promocion);
	        $this->db->update('PRO_PROMOCIONES', $data);

	        $this->send_mail($id_promocion);
		}

		function rechazar_promocion(){
			$id_promocion = $this->input->post('id_promocion');
			$motivo = $this->input->post('motivo');
			$user_autorizador = $this->input->post('user_autorizador');
			$data = array(
	                'AUTORIZADO' => 2,
	                'PRO_USER_AUTORIZADOR' => $user_autorizador
	            );
	        $this->db->where('PRO_ID', $id_promocion);
	        $this->db->update('PRO_PROMOCIONES', $data);

	        $this->send_mail($id_promocion, $motivo);
		}

		function send_mail($id_promocion, $motivo = ''){
			$this->db->select('PRO_ID,PRO_NOMBRE,PRO_USER_CREADOR,PRO_AUTOR,AUTORIZADO,PRO_USER_AUTORIZADOR');
			$this->db->from('PRO_PROMOCIONES');
			$this->db->where('PRO_ID', $id_promocion);
			$query = $this->db->get();
			$promocion = $query->result();

			$this->db->select('id, email');
			$this->db->from('admin_users');
			$this->db->where('id', $promocion[0]->PRO_USER_CREADOR);
			$query2 = $this->db->get();
			$user = $query2->result();

			$this->load->library('email');
			$config['protocol'] = 'sendmail';
			$config['smtp_host'] = 'localhost';
			$config['charset'] = 'utf-8';
			$config['wordwrap'] = TRUE;

			$this->email->initialize($config);

			$this->email->from('no-reply@cyberlunes.com.co', 'Promociones');
			$this->email->to($user[0]->email); 

			if($promocion[0]->AUTORIZADO == 1){
				$asunto='Su promoción ha sido APROBADA';
				$this->email->subject($asunto);
				$this->email->message('Se ha aprobado la promoción:<br> Promoción: '.$promocion[0]->PRO_NOMBRE.'<br> Autor: '.$promocion[0]->PRO_AUTOR);
			}

			if($promocion[0]->AUTORIZADO == 2){
				$this->db->insert('CXP_COMENTARIOSXPROMOCION', array('PRO_ID' => $id_promocion, 'CXP_DESCRIPCION' => $motivo, 'CXP_USER_ID' => $promocion[0]->PRO_USER_AUTORIZADOR));
				$asunto='Su promoción ha sido RECHAZADA';
				$this->email->subject($asunto);
				$this->email->message('Se ha rechazado la promoción:<br> Promoción: '.$promocion[0]->PRO_NOMBRE.'<br> Autor: '.$promocion[0]->PRO_AUTOR.'<br> Motivo: '.$motivo);	
			}

			$this->email->send();

		}

		function get_motivo_rechazo(){
			$id_pro = $this->input->post('id_promo');
	    	$this->db->select('CXP_DESCRIPCION, PRO_ID, CXP_FECHA');
	    	$this->db->from('CXP_COMENTARIOSXPROMOCION');
	    	$this->db->where('PRO_ID', $id_pro);
	    	$this->db->order_by("CXP_FECHA", "desc");

	    	$query = $this->db->get();
	    	$result = '';
	    	foreach ($query->result() as $row) {
	    		$result .= '- '.$row->CXP_DESCRIPCION.' <br /> ';
	    	}
	    	//$result = $query->row_array();
	    	echo $result;
	    }

	    function promociones_aprobadas(){
	    	$auth = $this->load->module('promociones_aprobadas');
			echo $retorno = modules::run('modules/promociones_aprobadas/index');	
	    }

	    function promociones_rechazadas(){
	    	$auth = $this->load->module('promociones_rechazadas');
			echo $retorno = modules::run('modules/promociones_rechazadas/index');	
	    }

	    function prueba_mail(){
	    	$this->load->library('email');
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'localhost';
			//$config['smtp_timeout'] = '90';
			

			$this->email->initialize($config);

			$this->email->from('no-reply@cyberlunes.com.co');
			$this->email->to('mcisneros@brandigital.com,icano@brandigital.com,ggiorda@brandigital.com'); 
			$this->email->subject('mail de prueba');
			$this->email->message('Esto es un asunto de prueba ' . base_url());	

			if($this->email->send()){
				echo 'Mensaje enviado';
			}
				
				echo('<br>');
				 echo $this->email->print_debugger();
	    }



		// function novedades(){
		// 	$auth = $this->load->module('novedades');
		// 	echo $retorno = modules::run('modules/novedades/index');
		// }
  //                   function novedades_home(){
		// 	$auth = $this->load->module('novedades');
		// 	echo $retorno = modules::run('modules/novedades/novedades_home');
		// }

  //                   function imagenes_novedades($id=NULL){
		// 	$auth = $this->load->module('novedades');
		// 	echo $retorno = modules::run('modules/novedades/imagenes',$id);
		// }

  //                   function imagenes_locales($id=NULL){
		// 	$auth = $this->load->module('locales');
		// 	echo $retorno = modules::run('modules/locales/imagenes',$id);
		// }
	
}
