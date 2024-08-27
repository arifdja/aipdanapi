<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peserta_aktif extends CI_Controller {
	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('bulanan_model/peserta_aktif_model');
		
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
	
	public function index(){
        $data['data'] = $this->peserta_aktif_model->getdata();
        // $data['data_arus_kas_ket'] = $this->arus_kas_model->get_ket('ket_arus_kas');
        $data['bulan'] = bulan();
        // $data['bulan_prev'] = bulan_prev();
        // $data['status'] = pendahuluan_bln();
        // $data['opt_user'] = dtuser();
  //       echo "<pre>";
		// print_r($data);exit;
		$data['bread'] = array('header'=>'Peserta Aktif ', 'subheader'=>'Bulanan');
		$data['view']  = "bulanan/peserta_aktif/data_peserta_aktif";
		$this->load->view('main/utama', $data);
    }

}
