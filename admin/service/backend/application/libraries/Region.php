<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth
*
* Author: Ben Edmunds
*		  ben.edmunds@gmail.com
*         @benedmunds
*
* Added Awesomeness: Phil Sturgeon
*
* Location: http://github.com/benedmunds/CodeIgniter-Ion-Auth
*
* Created:  10.01.2009
*
* Description:  Modified auth system based on redux_auth with extensive customization.  This is basically what Redux Auth 2 should be.
* Original Author name has been kept but that does not mean that the method has not been modified.
*
* Requirements: PHP5 or above
*
*/

class Region
{
	public function __construct()
	{
		$this->ci =& get_instance();
		
echo		$this->input->get('lang');
		die('123');
		
		$this->load->config('ion_auth', TRUE);
		$this->load->library('email');
		$this->load->library('session');
		$this->lang->load('ion_auth');
		$this->load->helper('cookie');


		// Load IonAuth MongoDB model if it's set to use MongoDB,
		// We assign the model object to "ion_auth_model" variable.
		$this->config->item('use_mongodb', 'ion_auth') ?
			$this->load->model('ion_auth_mongodb_model', 'ion_auth_model') :
			$this->load->model('ion_auth_model');

		$this->_cache_user_in_group =& $this->ion_auth_model->_cache_user_in_group;
		//auto-login the user if they are remembered
		if (!$this->logged_in() && get_cookie('identity') && get_cookie('remember_code'))
		{
			$this->ion_auth_model->login_remembered_user();
		}


		$email_config = $this->config->item('email_config', 'ion_auth');

		if (isset($email_config) && is_array($email_config))
		{
			$this->email->initialize($email_config);
		}

		$this->ion_auth_model->trigger_events('library_constructor');
	}
	
}