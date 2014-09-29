<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_ion extends Main {

	function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
//		$this->data = array();
	}

	
	//redirect if needed, otherwise display the user list
	function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			$this->ion_auth->logged_in();
			//redirect them to the login page
			$this->login();
		}
		else
		{
			//set the flash data error message if there is one
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->salida('auth/index', $data);
		}
	}


	//log the user in
	function login()
	{
		$data['title'] = "Login";

		$this->form_validation->set_rules('identity', 'Identity', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == true)
		{ 
			//check to see if the user is logging in
			//check for "remember me"
			$remember = (bool) $this->input->post('remember');

/*			$post_array['password'] = $this->input->post('password');
			$ret_pass = $this->encrypt_password_callback($post_array);
			$pass = $ret_pass['password'];*/
			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
				//if the login is successful
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('/main/index/', 'refresh');
			}
			else
			{
				//if the login was un-successful
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('main/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			//the user is not logging in so display the login page
			//set the flash data error message if there is one
		// or unset the previous reference first
			if($this->ion_auth->logged_in())
				$this->logout();
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$data['identity'] = array('name' => 'identity',
				'id' => 'identity',
				'type' => 'text',
				'value' => $this->form_validation->set_value('identity'),
	            'style'       => 'width:150px',				
			);
			$data['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
	            'style'       => 'width:150px',				
			);

			$this->salida('auth/login',$data);
		}
	}

	//log the user out
	function logout()
	{
		//log the user out
		$logout = $this->ion_auth->logout();
		//redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('main/index', 'refresh');
	}

	//change password
	function change_password($id = NULL)
	{
		 
		//$this->form_validation->set_rules('old', 'Old password', 'required');
		$this->form_validation->set_rules('new', 'New Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', 'Confirm New Password', 'required');

		if (!$this->ion_auth->logged_in())
		{

			redirect('main/login', 'refresh');
		}
		$user = $this->ion_auth->user($id)->row();

		// print_r($user );
		// die();
		if ($this->form_validation->run() == false)
		{ 
			//display the form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			/*$this->data['old_password'] = array(
				'name' => 'old',
				'id'   => 'old',
				'type' => 'password',
			);*/
			$this->data['new_password'] = array(
				'name' => 'new',
				'id'   => 'new',
				'type' => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['new_password_confirm'] = array(
				'name' => 'new_confirm',
				'id'   => 'new_confirm',
				'type' => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['user_id'] = array(
				'name'  => 'user_id',
				'id'    => 'user_id',
				'type'  => 'hidden',
				'value' => $user->id,
			);

			//render
			$this->salida('auth/change_password', $this->data);
		}
		else
		{
			//$identity = $this->session->userdata($this->config->item('identity', 'ion_auth'));
			$identity = $id;

			$change = $this->ion_auth->change_password($identity, '', $this->input->post('new'));
			//$this->input->post('old')

			if ($change)
			{ 
				//if the password was successfully changed
			    $this->send_confirmacion($identity,$this->input->post('new'));

				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('main/list_user', 'refresh');
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('main/change_password/'.$id, 'refresh');
			}
		}
	}

	function send_confirmacion($ident,$nclave){
	    $this->load->model('ion_users_model');

	    $datos_envio['titulo'] = 'Usuario'; 
	    $datos_envio['clave'] = $nclave;
	    $datos_envio['ident'] = $ident;

	    $datos= $this->ion_users_model->send_mail_user_change_passwprd($datos_envio);
	    return true;

	}

	//forgot password
	function forgot_password()
	{

		$this->form_validation->set_rules('email', 'Email Address', 'required');
		if ($this->form_validation->run() == false)
		{
			
            

			//setup the input
			$this->data['email'] = array('name' => 'email',
				'id' => 'email',
				'style' => 'width:250px',				
			);

			//set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->salida('auth/forgot_password', $this->data);
		}
		else
		{
            
			//run the forgotten password method to email an activation code to the user
			
             // echo $this->input->post('email');
             // echo $this->session->userdata('pais_db');
             // die();
			$forgotten = $this->ion_auth->forgotten_password($this->input->post('email'), $this->session->userdata('pais_db'));
			// var_dump($forgotten);
		//	echo ($forgotten);
	//		die();

			if ($forgotten)
			{ 
				 
				//if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("main/login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{

				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("main/forgot_password", 'refresh');
			}
		}
	}

	//reset password - final step for forgotten password
	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{  
			//if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', 'New Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', 'Confirm New Password', 'required');

			if ($this->form_validation->run() == false)
			{
				//display the form

				//set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['new_password'] = array(
					'name' => 'new',
					'id'   => 'new',
				'type' => 'password',
					'style'       => 'width:150px',				
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				);

				$this->data['new_password_confirm'] = array(
					'name' => 'new_confirm',
					'id'   => 'new_confirm',
					'style'       => 'width:150px',				
					'type' => 'password',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				);
				$this->data['user_id'] = array(
					'name'  => 'user_id',
					'id'    => 'user_id',
					'type'  => 'hidden',
					'value' => $user->id,
				);
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;

				//render
				$this->salida('auth/reset_password', $this->data);
			}
			else
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id')) 
				{

					//something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);

					show_error('This form post did not pass our security checks.');

				} 
				else 
				{
					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};

					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));
					if ($change)
					{ 
						//if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						$this->logout();
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('main/reset_password/' . $code, 'refresh');
					}
				}
			}
		}
		else
		{ 
			//if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("main/forgot_password", 'refresh');
		}
	}


	//activate the user
	function activate($id, $code=false)
	{
		if ($code !== false)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else 
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			//redirect them to the auth page
			$this->session->set_flashdata('message', 'Usuario Activado correctamente');
			
			redirect("main/list_user", 'refresh');
		}
		else
		{
			//redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("main/forgot_password", 'refresh');
		}
	}

	//deactivate the user
	function deactivate($id = NULL)
	{
		$id = $this->config->item('use_mongodb', 'ion_auth') ? (string) $id : (int) $id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', 'confirmation', 'required');
		$this->form_validation->set_rules('id', 'user ID', 'required|alpha_numeric');

		if ($this->form_validation->run() == FALSE)
		{
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();

			$breadcrums[]='<a class="current" href="'.site_url('main/list_user').'">Usuarios</a>'; 

			$this->salida('auth/deactivate_user', $this->data, $breadcrums);
		}
		else
		{
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes')
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
				{				
					show_error('This form post did not pass our security checks.');
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
				{
					$this->ion_auth->deactivate($id);
				}
			}
			$this->session->set_flashdata('message', 'Usuario desactivado correctamente');
			//redirect them back to the auth page
			redirect('main/list_user', 'refresh');
		}
	}
	


	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}


	//USUARIOS
	function list_user()
	{
		

		if (!$this->ion_auth->logged_in())
		{

					//redirect them to the login page
			redirect('main/login', 'refresh');
		}
		else
		{

			if(!$this->ion_auth->in_group(array(1,4,3),$this->session->userdata('sadmin_user_id'))){ //array(1,3)
				// die('entro aca!');
				redirect('main/voucher', 'refresh');
			}

			$this->load->model('ion_users_model');
		    $result = $this->ion_users_model->get_grupo($this->session->userdata('sadmin_user_id'));//gruo del usurio actual
		    
		    // $usuarios= $this->ion_users_model->get_user_x_grupo('3');
		    $usuarios= $this->ion_users_model->get_user_x_grupo($result['group_id']);

			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$breadcrums[]='<a class="current" href="'.site_url('main/list_user').'">Usuarios</a>'; 

			$this->load->library('grocery_crud');	
			$crud = new grocery_CRUD();
			$crud->set_language("spanish"); //Defino el lenguaje
			$crud->set_theme('flexigrid'); // Defino el tema
			$crud->set_table('admin_users'); // Tabla a insertar/editar
			$crud->set_subject('Usuarios'); // Titulo
			// $crud->where('id',1);
			// echo $result['group_id'];

			if( $result['group_id']==4 ){
               $crud->where('id !=',1);
			}

			// echo $this->session->userdata('sadmin_user_id');

			 $q ='';
		 if($result['group_id']==3 || $result['group_id']==4 ){
		 	$i=1;
		 	$total_user=count($usuarios);
		 	foreach($usuarios as $key=>$valor){
		 		if($i<$total_user){
	 
		 			 $crud->or_where('id',$valor['user_id']);
		 		}else{
		 			$crud->where('id',$valor['user_id']);
		 		}
		 	 	$i++;
		 	}
			   }
		 

			// Defino titulos de los campos 
				$crud->display_as('active','Usuario Activo')
				->display_as('username','Nombre Usuario')
				->display_as('first_name','Nombres')
				->display_as('last_name','Apellido')
				->display_as('email2','Email corporativo')
				->display_as('phone','Teléfono');

		

			// Columnas que muestra la tabla
				$crud->columns('username','email','first_name','last_name','phone','active','users_groups');
			// Campos a validar
				$crud->required_fields('username','email','first_name','last_name','password','users_groups','active');
			// Agrego la opcion de modificar contraseña 
				$crud->add_action('Clave', base_url('/images/change-password.png'), 'main/change_password','');

			// Cuando solo quiero agregar estos campos
			    $crud->add_fields('username','email','email2','first_name','last_name','password', 'phone','organizacion','users_groups', 'active');
			    // $crud->add_fields('username','email','first_name','last_name','password', 'phone','users_groups', 'active');

			// Defino los campos que quiero editar solamente
		    	// $crud->edit_fields('username','first_name','last_name','phone','users_groups', 'active','group_id');
		    	$crud->edit_fields('username','first_name','last_name','phone','users_groups', 'active');
			// Defino el tipo de campo 
				$crud->field_type('password', 'password');

				$crud->field_type('active','dropdown',array('0' => 'No','1' => 'Si'));
//				$crud->change_field_type('company','text');//Cambio el tipo de campo
 			// Defino regla de validacion
				$crud->set_rules('email','Email','required|valid_email');
				$crud->set_rules('email2','Email','valid_email');
		 		
		 		$crud->unique_fields('username','email');
		 		

				 if($result['group_id']==3 ){
				    
				    $crud->set_relation_n_n('users_groups', 'admin_users_groups', 'admin_groups', 'user_id', 'group_id', 'name',null,'id = 2 OR id =5' );
				 }else{
				    $crud->set_relation_n_n('users_groups', 'admin_users_groups', 'admin_groups', 'user_id', 'group_id', 'name',null,array('id !='=>'1') );
				 }

			    
				$crud->callback_before_insert(array($this,'encrypt_password_callback'));
				$crud->callback_before_update(array($this,'encrypt_password_callback'));
				$crud->callback_edit_field('password',array($this,'decrypt_password_callback'));
				//$crud->callback_after_insert(array($this, 'insert_tienda'));	
				//$crud->callback_after_update(array($this, 'update_tienda'));	
				//$crud->callback_after_delete(array($this, 'delete_tienda'));		
				
			$this->data['output'] = $output = $crud->render();
			$this->salida('auth/list_user', $this->data, $breadcrums);
		}
	}

	
	
	/* /// NUEVO - PROCESOS */
	// LISTADO DE PROCESOS	
	function list_process()
	{
		if (!$this->ion_auth->logged_in())
		{

					//redirect them to the login page
			redirect('main/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin())
		{
			//redirect them to the home page because they must be an administrator to view this
			redirect('/', 'refresh');
		}
		else
		{
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			//list the users
			$breadcrums[]='<a class="current" href="'.site_url('main/list_process/').'">Procesos</a>'; 

			//set the flash data error message if there is one
			$this->load->library('grocery_crud');	
			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			$crud->set_table('admin_process');
			$crud->set_subject('Procesos');

		    $crud->display_as('process_id','Proceso Padre');
		    $crud->set_relation('process_id','admin_process','process',array('process_id' => NULL));
			
		    $crud->order_by('orden');
			// Validacion para el formulario
			$crud->required_fields('process');
			
			$crud->set_language("spanish"); //Defino el lenguaje
			
			// Columnas que muestra la tabla
				$crud->columns('process','method','process_id', 'orden');
			// Campos a validar
				$crud->required_fields('process','menu');
			// Defino el tipo de campo 
				$crud->field_type('menu','dropdown',array('1' => 'Si', '0' => 'No'));
				
 			// Defino regla de validacion
	//			$crud->set_rules('email','Email','required|valid_email');
				


			$this->data['output'] = $output = $crud->render();
			$this->salida('auth/list_process', $this->data, $breadcrums);
			
		}
	}






	/* /// NUEVO - GRUPOS */
	// LISTADO DE GRUPOS
	function list_groups()
	{
		if (!$this->ion_auth->logged_in())
		{
					//redirect them to the login page
			redirect('main/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin())
		{
			//redirect them to the home page because they must be an administrator to view this
			redirect('/', 'refresh');
		}
		else
		{
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			//list the users
			$breadcrums[]='<a class="current" href="'.site_url('main/list_groups').'">Grupos</a>'; 

			//set the flash data error message if there is one
			$this->load->library('grocery_crud');	
			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			$crud->set_table('admin_groups');
			$crud->set_subject('Grupos');

			$crud->columns('name','description');
			// Validacion para el formulario
			$crud->required_fields('name','description');
 
		    $crud->add_action('Permisos', base_url('/images/process.png'), 'main/add_process_groups','');
			
			$this->data['output'] = $output = $crud->render();
			$this->salida('auth/list_groups', $this->data, $breadcrums);
		}
	}



	//asignar procesos a grupo
	function add_process_groups($id = NULL)
	{
		$this->data['title'] = "Add process to groups";

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin() || !$id)
		{
			redirect('main', 'refresh');
		}

		$process_list = $this->ion_auth->get_process_list_groups();
		$process_groups = $this->ion_auth->get_process_groups($id);
		$procesos_en_grupos = array();
		$values=NULL;$groups=NULL;
		foreach ($process_groups as $datos){
			$procesos_en_grupos[]=$datos->process_id;
		}
		
		$this->form_validation->set_rules('id', 'ID', 'required|xss_clean');

		$c = 0;
		foreach ($process_list as $listado)
		{
			$style = NULL;
			$checked = NULL;
			if($listado->process_id != 0)
				$style = 'style="margin-left:50px";';
			if(in_array($listado->id,$procesos_en_grupos))
				$checked = 'checked="checked"';
				
			$this->data['proceso'][$c] = '
			<fieldset '.$style.'>
				<label>'.$listado->process.'</label>
				<input type="checkbox" name="proceso['.$c.']" id="proceso_'.$c.'" value="'.$listado->id.'" '.$checked.' />
			</fieldset>';
			
			$this->data['proceso_'.$c] = array(
				'name'  => 'proceso_'.$c,
				'id'    => 'proceso_'.$c,
				'type'  => 'checkbox',
				'value' => $this->form_validation->set_value('name', $listado->id),
			);
			$c++;
		}

		if ($this->form_validation->run() == true && $this->input->post('proceso')!=NULL)
		{
			$proceso    = $this->input->post('proceso');
			$groups    = $this->input->post('id');
			
			foreach ($proceso as $id_proceso){
				$values[]=array(
					  'process_id' => $id_proceso,
					  'group_id' => $groups
				   );
			}
		}
		
		if ($this->form_validation->run() == true && $this->ion_auth->add_process_groups_db($values, $groups))
		{ 
			//check to see if we are creating the user
			//redirect them back to the admin page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("main/list_groups", 'refresh');
		}
		else
		{ 
			$this->data['id'] = array(
				'name'  => 'id',
				'id'    => 'id',
				'type'  => 'hidden',
				'value' => $id,
			);
			//display the create user form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$groups_db = $this->ion_auth->get_groups($id);

			$this->data['groups']=$groups_db->name;

			$breadcrums[]='<a class="current" href="'.site_url('main/list_groups').'">Grupos</a>'; 
			$breadcrums[]='<a class="current" href="'.site_url('main/add_process_groups/'.$id).'">Agregar procesos al grupo</a>'; 
			$this->salida('auth/add_process_groups', $this->data, $breadcrums);
		}
	}

	function encrypt_password_callback($post_array, $primary_key = null)
	{

		$this->load->library('encrypt');
	 
		$key = 'super-secret-key';
		//$post_array['password'] = $this->encrypt->encode($post_array['password'], $key);
		$post_array['password'] = sha1($post_array['password']);

		return $post_array;
	}

	function insert_tienda($post_array){
		//print_r($post_array);die();
		if($post_array['users_groups'][0] == 5){
			$this->load->model('ion_users_model');
			$this->load->helper('url');
			$this->ion_users_model->insert_tienda($post_array['username'], $post_array['active']);
		}

	}

	function update_tienda($post_array){
		//print_r($post_array);die();
		if($post_array['users_groups'][0] == 5){
			$this->load->model('ion_users_model');
			$this->load->helper('url');
			$this->ion_users_model->update_tienda($post_array['username'], $post_array['active']);
		}

	}

	function delete_tienda($post_array){

		$this->load->model('ion_users_model');
		$this->load->helper('url');
		$this->ion_users_model->delete_tienda($post_array);

	}
	 
	function decrypt_password_callback($value)
	{
		$this->load->library('encrypt');
	 
		$key = 'super-secret-key';
		$decrypted_password = $this->encrypt->decode($value, $key);

		return "<input type='password' name='password' value='$decrypted_password' />";
	}	
	

}
