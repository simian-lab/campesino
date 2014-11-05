<?php

if ( ! function_exists('get_url_promocion'))
{
  function get_url_promocion($url,$text, $promo_general = 0, $arrayOmniture = array())
  {
        if(isset($arrayOmniture[0])){
          $posicion = $arrayOmniture[0];
        }
        else{
          $posicion = '';
        }

        if(isset($arrayOmniture[1])){
          $creador = $arrayOmniture[1];
        }
        else{
          $creador = '';
        }

        if(isset($arrayOmniture[2])){
          $id = $arrayOmniture[2];
        }
        else{
          $id = '';
        }


        $atts = array('target'      => '_blank',
                      'class'      => 'link red',
                      'onClick'    => "onClickOferta('".$id."', '".$posicion."', '".$creador."')"
                      );

        if($promo_general == 1){
          $atts = array('target'      => '_blank',
                      'class'      => 'link orange',
                      'onClick'    => "onClickOferta('".$id."', '".$posicion."', '".$creador."')"
                      );
        }


        $url=site_url('redireccionamiento/externo/?url=' .$url);


        $strAnchor=anchor($url, $text, $atts);

        return $strAnchor;
        
  }

  function get_url_encrypt($url){
       $search = array('"',"'");
       $url=str_replace($search, '',$url);

       $url=prep_url($url);        


       $base64string =base64_encode($url);
       $base64string = strtr($base64string, '+/=', '-_,');
       $urlencode=rawurlencode($base64string);

       $url=site_url('redireccionamiento/externo/?url=' .$urlencode);

       return $url;
  }

}
?>
