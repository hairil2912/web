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
// $route['default_controller'] = 'site/home';
// $route['404_override'] = '';
// $route['translate_uri_dashes'] = FALSE;

// $route['admin'] = "admin/home";
// $route['admin/(:any)'] = "admin/$1";

// $route['home'] = "site/home";
// $route['detail/(:any)'] = "site/home/detail/$1";
// $route['page/(:any)'] = "site/home/page/$1";
// $route['category/(:any)'] = "site/home/category/$1";
// $route['service/(:any)'] = "site/home/service/$1";
// $route['event/(:any)'] = "site/home/event/$1";
// $route['spesialis/(:any)'] = "site/home/spesialis/$1";
// $route['posts'] = "site/home/posts";

// $route['dokter'] = "site/home/dokter";
// $route['dokter/(:any)'] = "site/home/dokter/$1";


// $route['kamar'] = "site/home/kamar";
// $route['kamar/(:any)'] = "site/home/kamar/$1";

// $route['poli'] = "site/home/poli";
// $route['poli/(:any)'] = "site/home/poli/$1";

// $route['dokter_poli'] = "site/home/dokter_poli";
// $route['dokter_poli/(:any)'] = "site/home/dokter_poli/$1";

// $route['antrian'] = "site/home/antrian";
// $route['antrian/(:any)'] = "site/home/antrian/$1";

// $route['testimoni'] = "site/home/testimoni";
// $route['dokter/detail/(:any)'] = "site/home/dokter_detail/$1";

// $route['register'] = "site/register";
// $route['register/kabupaten/(:any)'] = "site/register/kabupaten/$1";
// $route['register/kecamatan/(:any)'] = "site/register/kecamatan/$1";
// $route['register/desa/(:any)'] = "site/register/desa/$1";
// $route['register/prodi/(:any)'] = "site/register/prodi/$1";
// $route['register/asuransi'] = "site/register/asuransi";

// $route['sitemap\.xml'] = "site/home/sitemap";

$route['default_controller'] = 'site/home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['admin'] = "admin/home";
$route['admin/(:any)'] = "admin/$1";

$route['home'] = "site/home";
$route['detail/(:any)'] = "site/home/detail/$1";
$route['page/(:any)'] = "site/home/page/$1";
$route['category/(:any)'] = "site/home/category/$1";
$route['service/(:any)'] = "site/home/service/$1";
$route['event/(:any)'] = "site/home/event/$1";
$route['spesialis/(:any)'] = "site/home/spesialis/$1";
$route['posts'] = "site/home/posts";

$route['dokter'] = "site/dokter";
$route['dokter/(:any)'] = "site/dokter/$1";

$route['dokter_poli'] = "site/home/dokter_poli";
$route['dokter_poli/(:any)'] = "site/home/dokter_poli/$1";

$route['antrian'] = "site/antrian";
$route['antrian/(:any)'] = "site/antrian/$1";

$route['kamar'] = "site/kamar";
$route['kamar/(:any)'] = "site/kamar/$1";

$route['poli'] = "site/poli";
$route['poli/(:any)'] = "site/poli/$1";

$route['testimoni'] = "site/home/testimoni";
$route['dokter/detail/(:any)'] = "site/home/dokter_detail/$1";

$route['register'] = "site/register";
$route['register/kabupaten/(:any)'] = "site/register/kabupaten/$1";
$route['register/kecamatan/(:any)'] = "site/register/kecamatan/$1";
$route['register/desa/(:any)'] = "site/register/desa/$1";
$route['register/prodi/(:any)'] = "site/register/prodi/$1";
$route['register/asuransi'] = "site/register/asuransi";

$route['sitemap\.xml'] = "site/home/sitemap";