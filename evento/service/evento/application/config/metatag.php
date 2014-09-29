<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*$config['metatag'][name_of_metatag] = array(value_of_metatag, is_type_equiv=null)*/

$config = array();
//$config['metatag']['google-site-verification']  = array('',null);
//$config['metatag']['Content-type']  = array('text/html; charset=utf-8','equiv');
//$config['metatag']['viewport']  = array('width=device-width',null);
$config['metatag']['robots']    = array('index,follow',null);
/*
$config['metatag']['keywords']  = array('skin care, skincare,AVON, avon,products,cosmetics,Latest launch,ANEW,Clinical,Clearskin,Solutions,cosmetic products,cosmetic news,my skin profile,most woman say,cosmetic’s answers,Cleanser,Toner,Eye Cream,Serum,Day/Night Moisturizer,BB Cream,Scrub
',null); // array('cadena',null);
*/


//$config['metatag']['keywords']  = array(,null); // array('cadena',null);
         


$keywords  = array('');

$config['metatag']['keywords']  = array(implode(",",$keywords) ,null); // array('cadena',null);
