<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class CollectorPromo{

  private $_promos = array();
  private $_key='PRO_ID';
  private $_key_memcached='key_memcached';
  private $_time_memcached='3600'; // 1 hora
  public function __construct()
    {

       $this->CI =& get_instance();

    }
    public function set($pArray=array(),$session_id){
      $this->_key_memcached =$session_id;

      $newArray=array();
      $idPromos=array();
        if(is_array($pArray)){
           
              foreach ($pArray as $k => $val) {
               if(!isset($val[$this->_key])){                
                       return null;
               }

               $newArray[]=$val[$this->_key];   
           }
       }

       $idPromos = $this->CI->memcached_library->get($this->_key_memcached);

       //if(!$idPromos){
       if (!empty($idPromos)) {

          $this->_promos=  array_unique(array_merge($newArray, $idPromos));    
       }else{
          $this->_promos=  $newArray;    
       }

       log_message('DEBUG','set:  '. $this->_key_memcached);
       log_message('DEBUG','value:  '. print_r($this->_promos));
       $this->CI->memcached_library->set($this->_key_memcached,$this->_promos,$this->_time_memcached);
     
    }

    public function get($session_id){
      $this->_key_memcached = $session_id;

        log_message('DEBUG','get:  '. $this->_key_memcached);
     
      $idPromos = $this->CI->memcached_library->get($this->_key_memcached);
      return $idPromos;
    //  return implode(",", $idPromos);
    }

    public function int($session_id){   
     $this->_key_memcached = $session_id;
      //die($this->_key_memcached);
          log_message('DEBUG','int:  '. $this->_key_memcached);
      $this->CI->memcached_library->set($this->_key_memcached,array(),$this->_time_memcached);
    
    }
}