<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Examples extends Main {

	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		
		$this->load->library('grocery_crud');	
		$this->load->helper('url');
	}
	
	function _example_output($output = null)
	{
		$this->load->view('example.php',$output);	
	}
	
	function offices()
	{
	//	echo 'Offices()<pre>';
		//print_r($this);

		$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			$crud->set_table('offices');
			$crud->set_subject('Office');
			$crud->required_fields('city');
			$crud->columns('city','country','phone','addressLine1','postalCode');
		
		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Oficinas';
		$this->data['encabezado']='Gestión de oficinas';

		$breadcrums[]='<a class="current" href="'.site_url('main/grocery').'">Oficinas</a>'; 
		$this->salida('example',$this->data, $breadcrums);
	}
	
	function index()
	{
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}	
	
	function offices_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			$crud->set_table('offices');
			$crud->set_subject('Office');
			$crud->required_fields('city');
			$crud->columns('city','country','phone','addressLine1','postalCode');
			
		
			$this->data['output'] = $output = $crud->render();
			//$output = $this->grocery_crud->render();
			$this->data['titulo']='Offices';
			$this->data['encabezado']='Offices management';
			$breadcrums[]='<a class="current" href="'.site_url('main/list_user').'">Usuarios</a>'; 
	
			$this->salida('example',$this->data, $breadcrums);
			
			
	}
	
	function employees_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			$crud->set_table('employees');
			$crud->set_relation('officeCode','offices','city');
			$crud->display_as('officeCode','Office City');
			$crud->set_subject('Employee');
			$crud->display_as('officeCode','Office City');
			$crud->required_fields('lastName');
			
			$crud->set_field_upload('file_url','assets/uploads/files');
			
			
			$this->data['output'] = $output = $crud->render();
			//$output = $this->grocery_crud->render();
			$this->data['titulo']='Empleados';
			$this->data['encabezado']='Gestión de empleados';
	
			$breadcrums[]='<a class="current" href="'.site_url('main/employees_management').'">Empleados</a>'; 
			$this->salida('example',$this->data, $breadcrums);
	}
	
	function customers_management()
	{
		$crud = new grocery_CRUD();
			$crud->set_theme('flexigrid');
			$crud->set_table('customers');
			$crud->set_subject('Clientes');
			$crud->required_fields('customerName', 'contactLastName', 'phone','addressLine1','postalCode','creditLimit');
			$crud->columns('customerName', 'contactLastName', 'phone','addressLine1','postalCode','creditLimit');
			$crud->add_action('Imágenes', ' ', 'main/customers_management_img','');
			$crud->set_relation('salesRepEmployeeNumber','employees','lastName');
			$crud->display_as('salesRepEmployeeNumber','Cod. Empleado')
				 ->display_as('customerName','Nombre')
				 ->display_as('contactLastName','Apellido')
				 ->display_as('contactFirstName','Imagen')
				 ->display_as('phone','Teléfono')
				 ->display_as('addressLine1','Dirección principal')
				 ->display_as('addressLine2','Dirección secundaria')
				 ->display_as('city','Ciudad')
				 ->display_as('state','Provincia')
				 ->display_as('postalCode','Cod. postal')
				 ->display_as('country','Pais')
				 ->display_as('creditLimit','Límite crédito');


			$crud->set_field_upload('contactFirstName','');


		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Clientes';
		$this->data['encabezado']='Gestión de clientes';

		$breadcrums[]='<a class="current" href="'.site_url('main/customers_management').'">Clientes</a>'; 
		$this->salida('example',$this->data, $breadcrums);
	}	

	
	
	function orders_management()
	{

		$crud = new grocery_CRUD();

			$crud->set_theme('flexigrid');
			$crud->set_table('orders');
			$crud->set_subject('orders');
			$crud->required_fields('customerNumber', 'orderDate');
//			$crud->columns('customerName', 'customerLastName', 'phone','addressLine1','postalCode','creditLimit');
		
			$crud->set_relation('customerNumber','customers','{contactLastName} {contactFirstName}');
			$crud->display_as('customerNumber','Customer');

		$this->data['output'] = $output = $crud->render();
		$this->data['titulo']='Ordenes';
		$this->data['encabezado']='Gestión de ordenes';
		$crud->field_type('orderDate','date');

		$breadcrums[]='<a class="current" href="'.site_url('main/orders_management').'">Ordenes</a>'; 
		$this->salida('example',$this->data, $breadcrums);
	}
	
	function products_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_table('products');
			$crud->set_subject('Product');
			$crud->unset_columns('productDescription');
			$crud->callback_column('buyPrice',array($this,'valueToEuro'));
			$crud->set_theme('flexigrid');
			$crud->required_fields('productCode', 'productName', 'buyPrice', 'productLine');
			$crud->set_relation('productLine','productlines','{productLine}');
			
			$this->data['output'] = $output = $crud->render();
			//$output = $this->grocery_crud->render();
			$this->data['titulo']='Productos';
			$this->data['encabezado']='Gestión de productos';
	
			$breadcrums[]='<a class="current" href="'.site_url('main/products_management').'">Productos</a>'; 
			$this->salida('example',$this->data, $breadcrums);
	}	
	
	function valueToEuro($value, $row)
	{
		return $value.' &euro;';
	}
	
	function film_management()
	{

			$crud = new grocery_CRUD();

			$crud->set_table('film');
			$crud->set_subject('film');

			$crud->set_theme('flexigrid');
			$crud->required_fields('title', 'description');
			$crud->set_relation_n_n('actors', 'film_actor', 'actor', 'film_id', 'actor_id', 'fullname','priority');
			$crud->set_relation_n_n('category', 'film_category', 'category', 'film_id', 'category_id', 'name');
			$crud->unset_columns('special_features','description','actors');
			$crud->fields('title', 'description', 'actors' ,  'category' ,'release_year', 'rental_duration', 'rental_rate', 'length', 'replacement_cost', 'rating', 'special_features');
			$crud->field_type('actors','set',array('banana','orange','apple','lemon'));		
			$this->data['output'] = $output = $crud->render();
			//$output = $this->grocery_crud->render();
			$this->data['titulo']='Peliculas';
			$this->data['encabezado']='Gestión de peliculas';
			$breadcrums[]='<a class="current" href="'.site_url('main/film_management').'">Peliculas</a>'; 
	
			$this->salida('example',$this->data, $breadcrums);
			

	}

	function customers_management_img($id = NULL)
	{

		$this->load->library('image_CRUD');
		$image_crud = new image_CRUD();
	
	
	
		$image_crud->set_primary_key_field('id');
		$image_crud->set_url_field('url');
		$image_crud->set_title_field('title');
		$image_crud->set_table('customers_img')
		->set_ordering_field('priority')
		->set_image_path('service/backend/assets/uploads')
		->set_relation_field('customers_id')
		->set_language('spanish');
		$this->data['output'] = $output = $image_crud->render();

		$this->data['titulo']='Imágenes por Cliente';
		$this->data['encabezado']='Gestión de clientes';

		$breadcrums[]='<a class="current" href="'.site_url('main/customers_management').'">Clientes</a>'; 
		$this->salida('example',$this->data, $breadcrums);
	}	
	
}