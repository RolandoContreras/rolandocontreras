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
$route['404_override'] = 'errors/error_404';

$route['contacto'] = "contact";
$route['contacto/send_messages'] = "contact/send_messages";

$route['paso2'] = "home/paso2";
$route['gracias'] = "home/gracias";
$route['masterclass'] = "home/masterclass";

$route['terminos-y-condiciones'] = "home/term_condition";
$route['politica-de-privacidad'] = "home/policy";

//enlaces de software
$route['inicio'] = 'home';
$route['home/boletin'] = 'home/boletin';
$route['email'] = 'register/validate_email';
$route['email/([0-9a-z_A-Z-=%+/]+)'] = 'register/validate_email/$1';
$route['home/sitemap'] = 'home/sitemap';

$route['admin'] = "dashboard";
$route['dashboard/panel'] = "panel";

$route['dashboard/boletin'] = "d_boletin";
$route['dashboard/boletin/load/([0-9]+)'] = "d_boletin/load/$1";
$route['dashboard/boletin/validate'] = "d_boletin/validate";
$route['dashboard/boletin/delete'] = "d_boletin/delete";

$route['dashboard/clientes'] = "d_customer";
$route['dashboard/clientes/load/([0-9]+)'] = "d_customer/load/$1";
$route['dashboard/clientes/validate'] = "d_customer/validate";
$route['dashboard/clientes/delete'] = "d_customer/delete";

$route['dashboard/comentarios'] = "d_comments";
$route['dashboard/comentarios/cambiar_status'] = "d_comments/change_status";
$route['dashboard/comentarios/cambiar_status_no'] = "d_comments/change_status_no";


$route['dashboard/reportes/asociados'] = "d_report_customer";
$route['dashboard/reportes/cuentas'] = "d_report_membership";
$route['dashboard/reportes/pagos'] = "d_report_pays";

$route['salir'] = "login/logout";

/* End of file routes.php */
/* Location: ./application/config/routes.php */