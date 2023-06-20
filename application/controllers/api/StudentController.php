<?php defined( 'BASEPATH' )OR exit( 'No direct script access allowed' );

require APPPATH . 'libraries/RestController.php';
// use chriskacerguis\RestServer\RestController;

class StudentController extends RestController {

	function __construct() {
		parent::__construct();
    }
    public function getstudent()
    {
        $students = new Student_model_api;
        $students = $students->student_get();
        $this->response($students, 200);
    }
}
