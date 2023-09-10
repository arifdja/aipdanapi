<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Combined_pdf extends CI_Controller {
  function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('bulanan_model/pendahuluan_model');
		$this->load->model('bulanan_model/lap_bukan_investasi_model');
		$this->load->model('bulanan_model/arus_kas_model');
    $this->load->model('bulanan_model/perubahan_dana_bersih_model');
		$this->load->model('bulanan_model/aset_investasi_model');
		$this->load->model('bulanan_model/posisi_investasi_model');
    $this->load->model('bulanan_model/dana_bersih_model');
		$this->load->model('bulanan_model/hasil_investasi_model');
		$this->load->model('bulanan_model/ikhtisar_kinerja_model');
		$this->load->model('bulanan_model/bulan_model');
		$this->load->model('bulanan_model/perubahan_dana_bersih_model');
		$this->load->model('bulanan_model/rincian_model');

    $this->load->library('form_validation');
    $this->load->library('user_agent');
		// $this->load->library('pdf');
		//cek login
		if (! $this->session->userdata('isLoggedIn') ) redirect("login/show_login");
		$userData=$this->session->userdata();
		//cek akses route
		// if($userData['idusergroup'] !== '001') show_404();
    $this->iduser = $this->session->userdata('iduser');
		$this->tahun = $this->session->userdata('tahun');
		$this->idusergroup=$this->session->userdata("idusergroup");
		$this->page_limit = 10;
	}

	function cetak($mod = "") {
    switch($mod) {
        case "combined_pdf":
            $data['iduser'] = $this->input->post('iduser');
            $data['bulan'] = bulan();
            $data['data_aset_investasi'] = $this->aset_investasi_front();
            $data['data_bukan_investasi'] = $this->aset_bukan_investasi_front();
            $data['sum_aset_investasi'] = $this->aset_investasi_model->getdataindex('aset_investasi_front_sum', 'row_array', 'INVESTASI');
            $data['sum_bukan_investasi'] = $this->aset_investasi_model->getdataindex('aset_investasi_front_sum', 'row_array', 'BUKAN INVESTASI');

            $invest_template = $this->load->view('bulanan/aset_investasi/index_pdf_export', $data, true);
            $bukan_invest_template = $this->load->view('bulanan/bukan_investasi/index_pdf_export', $data, true);

            $combined_template = $invest_template . $bukan_invest_template;

            $this->hasil_output('pdf', $mod, '', $data, '', "A4", $combined_template, "ya", "no");
        break;
    }
}

function hasil_output($p1, $mod, $data_detail, $data, $filename = "", $ukuran = "A4", $template = "", $footer = "", $header = "") {
    switch($p1) {
        case "pdf":
            $pdf = new \Mpdf\Mpdf();
            $pdf->WriteHTML($template, 2);
            $pdf->Output();
        break;
    }
}


	
}