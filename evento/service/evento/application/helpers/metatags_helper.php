<?php

function add_meta_tags($meta_title, $meta_descripcion, $meta_imagen, $meta_keys) {
    $data = array();
    $metatag = new MyMetatag();
    $data['metatag'] = $metatag;

    $data['metatag']->add('description', array($meta_descripcion, null));
    $data['metatag']->add('keywords',array($meta_keys,null) ); //array($meta_keys,null)

    $data['metatag']->add('og:title', array($meta_title, 'property'));
    $data['metatag']->add('og:url', array(current_url(), 'property'));
    $data['metatag']->add('og:description', array($meta_descripcion, 'property'));
    $data['metatag']->add('og:image', array($meta_imagen, 'property'));

    return $data;
}

class MyMetatag{
   
   private $_CI;
   private $_metatags = array();

   function __construct(){
      $this->_CI = get_instance();
      $this->_CI->load->config('metatag');
      $this->_metatags = $this->_CI->config->item('metatag');
  //    die('hola');
   }

   public function add($name,$content=null){
        /*if exist $name as  key then overwriting*/
        $this->_metatags [$name] = $content ;        
   }

   function  __toString(){
        $meta = array();


        foreach ($this->_metatags as $name => $content){          
            if ($content[1] == null){
                $meta[] = array('name' => $name,'content' => $content[0]);
            } elseif ($content[1] == 'property') {
              $meta[] = array('name' => $name,'content' => $content[0], 'type' => $content[1]);
            } else {
                $meta[] = array('name' => $name,'content' => $content[0], 'type' => 'equiv');
            }
        }
        return meta($meta);
   }
}


function print_metatags($meta){
    if ( $meta  instanceof MyMetatag ){
        echo $meta;
    }else{
        echo '';
    }
}

/*
 * array('name' => 'description', 'content' => 'My Great Site'),
 * array('name' => 'title' , 'content' => 'Aquí el título'),
 * array('name' => 'keywords', 'content' => 'love, passion, intrigue, deception')
 */

