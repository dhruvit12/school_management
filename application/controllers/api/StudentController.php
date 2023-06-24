<?php defined( 'BASEPATH' )OR exit( 'No direct script access allowed' );

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class StudentController extends REST_Controller {

	function __construct() {
        $this->load->library('Authorization_Token');	
        $this->load->model('user_model');
		parent::__construct();
    }
    
    public function login_post() {
		echo "hi";exit;
		// set validation rules
		$this->form_validation->set_rules('email', 'email', 'required|email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == false) {
			
			// validation not ok, send validation errors to the view
            $this->response(['Validation rules violated'], REST_Controller::HTTP_OK);

		} else {
			
			// set variables from the form
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			
			if ($this->user_model->resolve_user_login($email, $password)) {
				
				$user_id = $this->user_model->get_user_id_from_username($email);
				$user    = $this->user_model->get_user($user_id);
				
				// set session user datas
				$_SESSION['user_id']      = (int)$user->id;
				$_SESSION['email']     = (string)$user->email;
				$_SESSION['logged_in']    = (bool)true;
				$_SESSION['is_confirmed'] = (bool)$user->is_confirmed;
				$_SESSION['is_admin']     = (bool)$user->is_admin;
				
				// user login ok
                $token_data['uid'] = $user_id;
                $token_data['email'] = $user->email; 
                $tokenData = $this->authorization_token->generateToken($token_data);
                $final = array();
                $final['access_token'] = $tokenData;
                $final['status'] = true;
                $final['message'] = 'Login success!';
                $final['note'] = 'You are now logged in.';

                $this->response($final, REST_Controller::HTTP_OK); 
				
			} else {
				
				// login failed
                $this->response(['Wrong email or password.'], REST_Controller::HTTP_OK);
				
			}
			
		}
		
	}
	
}
