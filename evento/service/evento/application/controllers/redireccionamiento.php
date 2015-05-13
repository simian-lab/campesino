<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Redireccionamiento extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->helper('string');
    $this->load->helper('get_url_base');
    $this->load->library('memcached_library');
  }

  public function externo() {
    $get_url_base = get_url_base();
    $data['url']  = $get_url_base;

    $pagehash = $this->input->get('url', TRUE);

    $this->load->library('form_validation');

    if(!$this->form_validation->required($pagehash)) {
      $this->enviar_email('parametro url no válido', $pagehash);
      show_404();
      return;
    }
    else {
      if(!$this->form_validation->exact_length($pagehash, 40)) {
        $this->enviar_email('parametro url no válido', $pagehash);
        show_404();
        return;
      }
    }

    $key_memcached_novalida = 'lista_no_valida_url_'.$pagehash;
    $result_memcached_novalida = $this->memcached_library->get($key_memcached_novalida);

    if($result_memcached_novalida) {
      $this->enviar_email('nuevo intento de promoción con dominio no habilitado, ya en la lista memcache de no válidas', $pagehash, $result_memcached_novalida, NULL);
      show_404();
      return;
    }

    $key_memcached='lista_valida_url_'.$pagehash;
    $result_memcached = $this->memcached_library->get($key_memcached);

    if(!$result_memcached) {
      $result_base = $this->_getPromocionbd($pagehash);

      if(!$result_base) {
        // If we didn't find a promotion, we look for a sponsor
        $result_base = $this->_getPatrocinadorBd($pagehash);

        if(!$result_base) {
          $this->enviar_email('patrocinador o promoción no válida, inexistente o inhabilitada', $pagehash);
          $this->memcached_library->add($key_memcached_novalida, $pagehash, 300);
          show_404();
          return;
        }
      }

      /* Heads up!
      Both Patrocinadores and Promociones will have a PRO_URL at this point
      (that is, if they have a valid URL). The fields are named differently
      in the DB, but we set an alias in promocion_model so that it's easier
      to handle in here (we're saving ourselves a bunch of if statements)
      */
      $result_base['PRO_URL']= $this->_sanitiseURL($result_base['PRO_URL']);

      if (!$result_base['PRO_URL']) {
        $this->memcached_library->add($key_memcached_novalida, $result_base, 300);
        $this->enviar_email('promoción url no válida', $pagehash, $result_base);
        show_404();
        return;
      }

      $listaBlancaDominios = $this->_getListaBlanca();
      $dominio_redirect = $this->_getDomain($result_base['PRO_URL']);

      if (!in_array($dominio_redirect, $listaBlancaDominios)) {
        $this->memcached_library->add($key_memcached_novalida, $result_base,150);
        $this->enviar_email('promoción con dominio no habilitado',$pagehash,$result_base,$dominio_redirect);
        show_404();
        return;
      }

      $this->memcached_library->add($key_memcached, $result_base);
      $url_redirect=$result_base['PRO_URL'];

      // die('base_datos = '.$url_redirect);
    }
    else {
      $url_redirect=$result_memcached['PRO_URL'];
      // die('memcached = '.$url_redirect);
    }

    if(empty($url_redirect)) {
      $this->enviar_email('promoción url no válida',$pagehash,$result_base,$url_redirect);
      show_404();
      return;
    }

    /*
    $url_redirect=$this->_sanitiseURL($url_redirect);

    if (!$url_redirect) {
    redirect('/', 'refresh');
    return;
    }
    */
    $data['url_redirect']=$url_redirect;
    //    echo($url_redirect);

    $this->load->view('redirect',$data);
    return;
  }

  private function _getListaBlanca() {
    $key_memcached='lista_blanca_dominio';
    $result_memcached = $this->memcached_library->get($key_memcached);

    if(!$result_memcached) {
      $this->load->database();
      $this->load->model('lista_blanca_model');
      $result = $this->lista_blanca_model->get();
      $idpromos=array();

      foreach ($result as $value) {
        $idpromos[]=$value['LBD_DOMINIO'];
      }

      $this->memcached_library->add($key_memcached, $idpromos,300);
      return $idpromos;
    }
    else {
      return $result_memcached;
    }
  }

  private function _getPromocionbd($pagehash) {
    $this->load->database();
    $this->load->model('promociones/promocion_model');
    $result = $this->promocion_model->getByHash($pagehash);
    return $result;
  }

  private function _getPatrocinadorBd($pagehash) {
    $this->load->database();
    $this->load->model('home/home_model');
    $result = $this->home_model->getByHash($pagehash);
    return $result;
  }

  function _sanitiseURL($url) {
    //$url = htmlspecialchars($url, ENT_QUOTES | ENT_HTML401, 'UTF-8');
    $url = htmlspecialchars($url, ENT_QUOTES, 'UTF-8');
    $url = strip_quotes($url);
    $url = str_replace('http ', 'http:', $url);
    $url = str_replace('https ', 'https:', $url);
    $url = filter_var($url, FILTER_SANITIZE_URL,FILTER_SANITIZE_SPECIAL_CHARS);

    if (! filter_var($url, FILTER_VALIDATE_URL))
      return false;

    return $url;
  }


  function _getDomain($url) {
    $pieces = parse_url($url);
    $domain = isset($pieces['host']) ? $pieces['host'] : '';

    if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
      return $regs['domain'];
    }

    return false;
  }


  public function enviar_email($motivo,$pagehash,$result_base=NULL,$url_redirect=NULL) {
    $this->load->helper('get_url_base');
    $url = get_url_base();
    $data['url'] = $url;
    $this->load->helper('date');

    $config_email = $this->config->load('email', TRUE);

    $this->load->library('email');

    $datestring = "%d-%m-%Y a las %h:%i %a";
    $time = time();

    $mensaje  = 'Motivo: '.$motivo.' <br><br>';
    $mensaje .= 'Url : '.current_url().'?url='. $pagehash .' <br>';

    if(!empty($result_base)) {
      $mensaje  .= '*************************************<br>';
      $mensaje  .= 'PROMOCIÓN: <br>';
      if(!empty($result_base['PRO_ID']))
        $mensaje  .= 'id : '.$result_base['PRO_ID'].' <br>';
      if(!empty($result_base['PRO_NOMBRE']))
        $mensaje  .= 'nombre : '.$result_base['PRO_NOMBRE'].' <br>';
      if(!empty($result_base['PRO_URL']))
        $mensaje  .= 'url : '.$result_base['PRO_URL'].' <br>';
      $mensaje  .= '*************************************<br>';
    }

    if(!empty($url_redirect)){
      $mensaje  .= 'Dominio no válido : '.$url_redirect.' <br>';
    }

    $mensaje .= 'fecha: '.mdate($datestring, $time).' <br>';
    $config = Array(
      'protocol' => 'smtp',
      'smtp_host' => $config_email['smtp_host'],
      'mailtype' => 'html',
      'charset' => 'utf-8',
      'newline' => '\r\n'
      //'smtp_crypto' =>'tls'
    );

    $this->email->initialize($config);
    $this->email->from($config_email['website_sender'], 'Cyberlunes');
    $this->email->to($config_email['email_to']);
    //$this->email->cc('yohmor@eltiempo.com','cargue@eltiempo.com');
    //$this->email->bcc('ggiorda@brandigital.com','npiazza@brandigital.com');
    $this->email->subject('Cyberlunes: alerta Redireccionamiento/externo');
    $this->email->message($mensaje);
    $this->email->send();
  }
}