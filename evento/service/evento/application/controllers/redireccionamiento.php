<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Redireccionamiento extends CI_Controller 
{
   function __construct()
   {
       parent::__construct();
       $this->load->helper('string');
   }

   public function externo(){

        $data = null;               
        $data = get_url_base();
       	//die(rawurlencode(base64_encode("http://us2.php.net/manual/en/function.rawurlencode.php")));
        $page=$this->input->get('url', TRUE);

       	if(empty($page)) {

       		    redirect('/', 'refresh');
              return;
        } 

         $base64url=rawurldecode($page);
         $base64url = strtr($base64url, '-_,', '+/=');

         $data['url_redirect']=base64_decode($base64url);
         //print_r(filter_var($data['url_redirect'], FILTER_VALIDATE_URL));
         $data['url_redirect'] = $this->security->xss_clean($data['url_redirect']);
         // $data['url_redirect'] = htmlspecialchars($data['url_redirect'], ENT_QUOTES | ENT_HTML401, 'UTF-8');
         $data['url_redirect'] = strip_quotes($data['url_redirect']);
         $data['url_redirect'] = str_replace('http ', 'http:', $data['url_redirect']);
         $data['url_redirect'] = str_replace('https ', 'https:', $data['url_redirect']);
         //print_r($data['url_redirect']);die();
         //print_r(strip_quotes(($this->security->xss_clean($data['url_redirect']))));
         /*if (!filter_var($data['url_redirect'], FILTER_VALIDATE_URL)) {
              redirect('/', 'refresh');
              return;
          }*/

         $this->load->view('redirect',$data);
    	
   }
  
    	
}
