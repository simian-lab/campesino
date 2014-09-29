<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function encrypt_creditcard($creditcard = '', $subFolder_key = 'actual') {
    $CI = & get_instance();
    $CI->load->library('encrypt');

    $key = _getPrivateKey($subFolder_key);

    if ($key) {
        if (!function_exists('mcrypt_encrypt')) {
            $encrypt_cc = $CI->encrypt->encode($creditcard, $key);
        } else {
            $CI->encrypt->set_cipher(MCRYPT_RIJNDAEL_256);
            $CI->encrypt->set_mode(MCRYPT_MODE_CFB);
            $encrypt_cc = $CI->encrypt->encode($creditcard, $key);
        }

        return $encrypt_cc;
    }
}

function decrypt_creditcard($encrypt_cc = '', $subFolder_key = 'actual') {
    $CI = & get_instance();
    $CI->load->library('encrypt');

    $key = _getPrivateKey($subFolder_key);

    if (!function_exists('mcrypt_encrypt')) {
        $creditcard = $CI->encrypt->decode($encrypt_cc, $key);
    } else {
        $CI->encrypt->set_cipher(MCRYPT_RIJNDAEL_256);
        $CI->encrypt->set_mode(MCRYPT_MODE_CFB);
        $creditcard = $CI->encrypt->decode($encrypt_cc, $key);
    }

    return $creditcard;
}

function _getPrivateKey($subFolder_key) {
    $CI = & get_instance();

    $filename = 'key.pem';
    $fileurl = $CI->config->item('encryption_folder') . $subFolder_key . '/' . $filename;

    if (file_exists($fileurl) && is_readable($fileurl)) {
        $handle = @fopen($fileurl, "r");
        if ($handle) {
            $key = fread($handle, 8192);
            fclose($handle);
            return $key;
        } else {
            fclose($handle);
            //log
            log_message('ERROR', 'CRON - FAIL TO OPEN THE FILE ');
            return FALSE;
        }
    } else {
        //log            
        log_message('ERROR', 'CRON - THE FILE ' . $fileurl . ' WAS NOT FOUND');
        return FALSE;
    }
}
