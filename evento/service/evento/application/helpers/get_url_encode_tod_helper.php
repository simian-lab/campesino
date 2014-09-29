<?php

if ( ! function_exists('get_url_encode_tod'))
{
  function get_url_encode_tod($url)
  {

/*
 	   $base64string =base64_encode($url);
        $base64string = strtr($base64string, '+/=', '-_,');
        $url=rawurlencode($base64string);
*/
        $base64string =base64_encode($url);
        $url=rawurlencode($base64string);
      
        return $url;
        
  }

}
?>