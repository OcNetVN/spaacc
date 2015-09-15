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

$route['default_controller'] = "spaman/home_controller/spa_info";
//$route['home_controller'] = "spaman/home_controller/";
$route['404_override'] = '';

/* 
| custom url for spa management
*/
$route['spaman/spa_info']					=		"spaman/home_controller/spa_info";
$route['spaman/spa_hour']					=		"spaman/home_controller/spa_hour";
$route['spaman/spa_policy']					=		"spaman/home_controller/spa_policy";
$route['spaman/spa_util']					=		"spaman/home_controller/spa_util";
$route['spaman/spa_product']				=		"spaman/home_controller/spa_product";
$route['spaman/spa_price']					=		"spaman/home_controller/spa_price";
$route['spaman/spa_km']						=		"spaman/home_controller/spa_km";
$route['spaman/spa_dt']						=		"spaman/home_controller/spa_dt";
$route['spaman/spa_cal']					=		"spaman/home_controller/spa_cal";
$route['spaman/spa_booking']				=		"spaman/home_controller/spa_booking";
$route['spaman/spa_notify']					=		"spaman/home_controller/spa_notify";
$route['spaman/spa_report']					=		"spaman/home_controller/spa_report";

$route['spaman/thoat_info']					=		"spaman/home_controller/thoat_info";

$route['spaman/spa_user']					=		"spaman/home_controller/spa_user";
$route['home_controller/getlocation_by_spa']=        "spaman/home_controller/getlocation_by_spa";
$route['home_controller/load_location_child_by_location_parent']      =        "spaman/home_controller/load_location_child_by_location_parent";

//$route['quan-tri'] = 'nguoi_dung';

/* 
| end custom url for spa management
*/

/* End of file routes.php */
/* Location: ./application/config/routes.php */