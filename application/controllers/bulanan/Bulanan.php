<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bulanan extends CI_Controller {

  function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('bulanan_model/CheckboxModel');
		
        $this->load->library('form_validation');
        $this->load->library('user_agent');
		// $this->load->library('pdf');
		//cek login
		if (! $this->session->userdata('isLoggedIn') ) redirect("login/show_login");
		$userData=$this->session->userdata();
		//cek akses route
		//if($userData['idusergroup'] !== '001') show_404();
        $this->iduser = $this->session->userdata('iduser');
        $this->tahun = $this->session->userdata('tahun');
		$this->page_limit = 10;
		
	}

  public function update_checkbox() {
      $checkboxValue = $this->input->post('checkboxValue');
      $isChecked = $this->input->post('isChecked');

      $this->load->model('CheckboxModel');
      $this->CheckboxModel->updateCheckbox($checkboxValue, $isChecked);

      $response = ['status' => 'success'];
      echo json_encode($response);
  }

  // ...
}
