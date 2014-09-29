<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    
function encrypt_creditcard($creditcard = ''){
    $CI=& get_instance();
    $CI->load->library('encrypt');

    if(!function_exists('mcrypt_encrypt')){
        $encrypt_cc = $CI->encrypt->encode($creditcard);
    }else{
        $CI->encrypt->set_cipher(MCRYPT_RIJNDAEL_256);
        $CI->encrypt->set_mode(MCRYPT_MODE_CFB);         
        $encrypt_cc = $CI->encrypt->encode($creditcard);       
    }

    return $encrypt_cc;
}  

function decrypt_creditcard($encrypt_cc = ''){
    $CI=& get_instance();
    $CI->load->library('encrypt');

    if(!function_exists('mcrypt_encrypt')){
        $creditcard = $CI->encrypt->decode($encrypt_cc);
    }else{
        $CI->encrypt->set_cipher(MCRYPT_RIJNDAEL_256);
        $CI->encrypt->set_mode(MCRYPT_MODE_CFB);
        $creditcard = $CI->encrypt->decode($encrypt_cc);
    }

    return $creditcard;
}  
