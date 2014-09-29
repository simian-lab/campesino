<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    //Checks if a string represents an integer value even if the variable represents a string.
    function check_int($str) {
        return is_numeric($str) && intval($str) - $str == 0;
    }
?>
