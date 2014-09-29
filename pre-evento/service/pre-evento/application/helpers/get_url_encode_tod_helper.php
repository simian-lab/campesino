<?php

if ( ! function_exists('get_url_encode_tod'))
{
  function get_url_encode_tod($url)
  {

        $base64string =base64_encode($url);
        $urlencode=rawurlencode($base64string);
      
        return $urlencode;
        
  }

}
?>