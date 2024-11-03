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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['login'] = 'login_controller/login_view';
$route['logout'] = 'login_controller/logout';

$route['validation'] = 'Login_controller/login_validation';
$route['registration'] = 'Login_controller/registration';
$route['check_email_exist'] = 'Login_controller/check_email_exist';
$route['register/(:any)'] = 'Login_controller/add_student_view/$1';
// $route['register_teacher/(:any)'] = 'Login_controller/add_student_view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//For student
$route['dashbaord'] = 'login_controller/dashboard';
$route['profile'] = 'login_controller/profile';
$route['attendance'] = 'login_controller/attendance';
$route['add_attendance'] = 'login_controller/add_attendance';
$route['save_attendance'] = 'login_controller/save_attendance';
$route['delete_attendance'] = 'login_controller/delete_attendance';
$route['edit_user'] = 'login_controller/edit_user';

// For teacher view  
$route['student'] = 'login_controller/student';
$route['delete_user'] = 'login_controller/delete_user';

// For Admin
$route['teacher'] = 'login_controller/teacher_list_view';

