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

$route['default_controller'] = 'home/index';
$route['404_override'] = '';
$route['contenidos'] = "contenidos/todos";
$route['contenidos/(:num)'] = "contenidos/todos/$1";
$route['articulo/(:any)'] = "detalleArticulo/todos/$1";

$route['descuentos'] = 'descuentosfiltro/todos';
$route['descuentos/(:any)'] = 'descuentosfiltro/categoria/$1';

$route['marcas/(:any)'] = 'descuentosfiltro/marcas_por_tienda/$1';

$route['prueba'] = 'prueba_smart/index';
$route['prueba-promos'] = 'prueba_promos/todos';



/*

$route['mexico'] = 'home/mexico/';
$route['colombia'] = 'home/colombia/';

$route['visita-panama'] = 'home/panama/';

$route['vive-costa-rica'] = 'home/costa_rica/';

$route['vive-costa-rica'] = 'home/costa_rica/';

$route['vuelos'] = 'home/vuelos/';
$route['vuelos/(:any)'] = 'home/vuelos/$1';

$route['hoteles'] = 'home/hoteles/';
$route['hoteles/(:any)'] = 'home/hoteles/$1';

$route['paquetes'] = 'home/paquetes/';
$route['paquetes/(:any)'] = 'home/paquetes/$1';


$route['productos-y-servicios'] = 'home/productos_servicios/';
$route['productos-y-servicios/(:any)'] = 'home/productos_servicios/$1';

$route['lo-mejor-del-2013'] = 'pauta/mejor_2013/';

$route['lo-mejor-del-2013/(:any)'] = 'home/mejor_2013_filtro/$1';
*/
