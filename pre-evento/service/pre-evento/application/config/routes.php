<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['home2'] = "home/home/home2";
$route['gracias'] = "home/home/gracias";

$route['404_override'] = ''; 
$route['(:num)'] = "home/index/$1";
$route['detalle/(:any)'] = "home/detalle/$1";
$route['setCookie'] = "home/home/setCookie";
$route['formulario/sorteo'] = 'formulario_sorteo/formulario_sorteo/index';
$route['formulario/sorteo/send'] = 'formulario_sorteo/formulario_sorteo/send';
$route['formulario/sorteo/success'] = 'formulario_sorteo/formulario_sorteo/index/success';
$route['formulario/participacion'] = 'formulario_participacion/formulario_participacion/index';
$route['formulario/participacion/send'] = 'formulario_participacion/formulario_participacion/send';
$route['formulario/participacion/success'] = 'formulario_participacion/formulario_participacion/index/success';
$route['prueba'] = 'home/prueba';
$route['prueba2'] = 'home/prueba2';
