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
$route['default_controller'] = 'home';
$route['tugas'] = 'Tugas/index';
$route['video'] = 'Video/index';
$route['login_page'] = 'Auth/index';
$route['register_page'] = 'Auth/registerPage';
$route['login/(:any)'] = 'Auth/login/$1';
$route['register/(:any)'] = 'Auth/register/$1';
$route['logout'] = 'Auth/logout';
$route['add_video'] = 'Video/create';
$route['video/store'] = 'Video/store';
$route['upload_video/(:any)'] = 'Video/uploadPage/$1';
$route['video/upload/(:any)'] = 'Video/upload/$1';
$route['watch/(:any)'] = 'Video/watch/$1';
$route['cari_video'] = 'Video/cari';
$route['delete_video/(:any)'] = 'Video/destroy/$1';
$route['edit_video/(:any)'] = 'Video/edit/$1';
$route['video/update/(:any)'] = 'Video/update/$1';
$route['add_task'] = 'Tugas/create';
$route['tugas/store'] = 'Tugas/store';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
