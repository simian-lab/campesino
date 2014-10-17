<?php

if ( ! function_exists('get_app_data'))
{
  function get_app_data()
  {

          
      $CI = & get_instance();
            

      $fb_appid=$CI->config->item('FB_APPID');
      $fb_secret=$CI->config->item('FB_SECRET');


       $arrInfo = array(
            "status" => "0",
            "descripcion" => "0", 
            "app"  => array(
                   "fb_appid" => $fb_appid)
        );
         
//      echo '&hash='.$arrInfo['user']['hash'].'<br>&ses='.$arrInfo['user']['session'];
 
        $jsonParam = json_encode($arrInfo);
  
      return $jsonParam;
        
  }

}
?>