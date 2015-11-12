<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
New constants to define the number of promotions per page.

— Added on Apr 16, 2015 by ivan@simian.co
*/
define('NUMERO_PROMOCIONES_PREMIUM',    36);
define('NUMERO_PROMOCIONES_GENERALES',    36);

/*Deinfe una constante para el tage line segun el evento*/

require_once( BASEPATH .'database/DB'. EXT );
$db =& DB();
$db->select('*');
$db->from('EVE_EVENTOS');
$db->where('EVE_PREFIJO', EVENTO);
$db->limit(1);

$query = $db->get();
$eve_result = $query->row_array();

define('TAG_LINE',    $eve_result["EVE_TAG_LINE"];
define('TITLE',    $eve_result["EVE_TITLE"];
define('META_KEY',	'');
define('ID_EVENTO',   $eve_result["EVE_ID"]);
define('META_DESCRIPTION', $eve_result["EVE_META_DESCRIPTION"]);
define('TAG_FACEBOOK', $eve_result["EVE_FACEBOOK"]);
define('TAG_TWITTER', $eve_result["EVE_TWITTER"]);

/* End of file constants.php */
/* Location: ./application/config/constants.php */