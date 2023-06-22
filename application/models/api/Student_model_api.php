<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Student_model_api extends MY_Model
{
  public function get_student()
  {
      $data = $this->db->get("student")->result();
      $this->response($data, REST_Controller::HTTP_OK);
  }
}