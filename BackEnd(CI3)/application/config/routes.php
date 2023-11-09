<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = '';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* API */
$route['product'] = 'api/Product';
$route['product/(:any)'] = 'api/Product/$1';
$route['product/(:num)']['PUT'] = 'api/Product/$1';
$route['product/(:num)']['DELETE'] = 'api/Product/$1';
$route['register'] = 'api/User/register';
$route['login'] = 'api/User/login';
$route['logout'] = 'api/User/logout';
$route['reGenToken'] = 'api/Token/reGenToken';

// product
// $route['api/products']                  = 'api/v1/Products/index';
// $route['api/products/(:num)']           = 'api/v1/Products/detail/$1';
// $route['api/products']['POST']          = 'api/v1/Products/create';
// $route['api/products/(:num)']['PUT']   = 'api/v1/Products/update/$1';
// $route['api/products/(:num)']['DELETE']   = 'api/v1/Products/delete/$1';

// category
// $route['api/category']                  = 'api/v1/Category';
// $route['api/category/(:num)']           = 'api/v1/Category/$1';
// $route['api/category']['POST']          = 'api/v1/Category';
// $route['api/category/(:num)']['PUT']   = 'api/v1/Category/$1';
// $route['api/category/(:num)']['DELETE']   = 'api/v1/Category/$1';