<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'install';
$route['404_override'] = 'errors';
$route['translate_uri_dashes'] = FALSE;

$route['api/students'] = 'api/StudentController/getstudent';