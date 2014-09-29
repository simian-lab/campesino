<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class csrf_protection_session {

    private $CI;
    
    protected $_csrf_session_name = 'cicsrftoken';
    protected $_csrf_token_name = 'ses';
    protected $_csrf_hash = '';

    // -------------------------------------------------------------------------

    public function __construct() {
        $this->CI = & get_instance();
    }

    // -------------------------------------------------------------------------

    /**
     * Verify Cross Site Request Forgery Protection
     *
     * @return	object
     */
    public function csrf_verify() {
        
          if ($_SERVER['REQUEST_METHOD'] == 'POST'){
              // Is the token field set and valid?
              $posted_token = $this->CI->input->post($this->_csrf_token_name);

              if ($posted_token === FALSE || $posted_token != $this->CI->session->userdata($this->_csrf_session_name)){
                  // Invalid request, send error 400.
                  //show_error('Request was invalid. Tokens did not match.', 400);
                  $this->csrf_show_error();
              }

              if ($posted_token === FALSE){
                  // Invalid request, send error 400.
                  //show_error('Request was invalid. Tokens did not match.', 400);
                  $this->csrf_show_error();
              }
          }else{
              $this->csrf_show_error();
          }
        //  return true;
    }

    public function get_csrf_hash() {
        if ($this->CI->session->userdata($this->_csrf_session_name) === FALSE) {
            // Generate a token and store it on session, since old one appears to have expired.
            $msg = $_SERVER['REMOTE_ADDR'] . time() . $_SERVER['SERVER_NAME'];

            $this->_csrf_hash = md5(uniqid() . rand() . $msg);

            $this->CI->session->set_userdata($this->_csrf_session_name, $this->_csrf_hash);
        } else {
            // Set it to local variable for easy access
            $this->_csrf_hash = $this->CI->session->userdata($this->_csrf_session_name);
        }

        return $this->_csrf_hash;
    }

    // -------------------------------------------------------------------------
    /**
     * Show CSRF Error
     *
     * @return	void
     */
    public function csrf_show_error() {
        redirect('auth/user/session_caduco');
    }
}