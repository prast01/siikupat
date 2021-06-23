<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
$route['default_controller'] = 'login';
$route['404_override'] = 'dashboard/error';
$route['translate_uri_dashes'] = FALSE;
$route['realisasi-rok'] = "laporan/realisasiRok";
$route['verifikasi-spj'] = "laporan/verifikasiSpj";
$route['pembukuan-spj'] = "laporan/pembukuanSpj";
$route['transfer-spj'] = "laporan/transferSpj";
$route['lihat-spj/(:any)/(:any)'] = "laporan/lihat/$1/$2";
$route['realisasi/(:any)'] = "dashboard/sub_kegiatan/$1";
$route['rekening/(:any)/(:any)'] = "dashboard/rekening/$1/$2";
$route['detail-rekening/(:any)/(:any)/(:any)'] = "dashboard/detail_rekening/$1/$2/$3";
$route['bk-1'] = "laporan/bk_1";
$route['bk-2'] = "laporan/bk_2";
$route['bk-2/(:any)/(:any)/(:any)/(:any)'] = "laporan/bk_2_2/$1/$2/$3/$4";
$route['pulihkan-spj'] = "lain/pulih";
$route['bk-0'] = "laporan/bk_0";
$route['laporan-rak'] = "laporan/rak";
$route['laporan-rok'] = "laporan/rok";
$route['laporan-kinerja'] = "laporan/kinerja";
$route['laporan-kinerja/(:any)'] = "laporan/kinerja/$1";
$route['laporan-kinerja/detail/(:any)'] = "laporan/kinerja_sub_kegiatan/$1";
$route['grafik-kinerja'] = "laporan/grafik_kinerja";
$route['grafik-kinerja-akumulasi'] = "laporan/grafik_kinerja_akumulasi";
$route['laporan-sub-kegiatan'] = "laporan/sub_kegiatan";
