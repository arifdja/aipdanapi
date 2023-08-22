<?php 
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		
	}


	public function index()
	{
		$data['bread'] = array('header'=>'Dashboard', 'subheader'=>'Dashboard-1');
		$data['view']  = "dashboard/dashboard_1";
		$this->load->view('main/utama', $data);
	}


	public function executive_summary()
	{
		$data['bread'] = array('header'=>'Executive Summary', 'subheader'=>'Executive Summary');
		$data['view']  = "dashboard/dashboard_2";
		$this->load->view('main/utama', $data);
	}


	public function dana_bersih()
	{
		$data['bread'] = array('header'=>'Dana Bersih', 'subheader'=>'Dana Bersih');
		$data['view']  = "dashboard/dashboard_3";
		$this->load->view('main/utama', $data);
	}


	public function perubahan_danabersih()
	{
		$data['bread'] = array('header'=>'Perubahan Dana Bersih', 'subheader'=>'Perubahan Dana Bersih');
		$data['view']  = "dashboard/dashboard_4";
		$this->load->view('main/utama', $data);
	}

	public function arus_kas()
	{
		$data['bread'] = array('header'=>'Arus Kas', 'subheader'=>'Arus Kas');
		$data['view']  = "dashboard/dashboard_5";
		$this->load->view('main/utama', $data);
	}


	function getdisplay($type){
		switch($type){
			case 'testing_array':

				$array['nil1'] = 10;
				$array['nil2'] = 15;
				$array['nil3'] = 40;
				$array['nil4'] = 28;
				$array['nil5'] = 11;
				$array['nil6'] = 12;

				echo json_encode($array);
			break;
			case 'testing_array_bar':

				$array['arr_bln'] = array('Jan',
					'Feb',
					'Mar',
					'Apr',
					'May',
					'Jun',
					'Jul',
					'Aug',
					'Sep',
					'Oct',
					'Nov',
					'Dec');
				$array['arr_data'] = array(49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4);

				$array['arr_jns'] = array('Deposito', 'Surat Utang Negara', 'Obligasi Korporasi', 'Sukuk Korporasi', 'MTN', 'Reksadana');
				$array['arr_data2'] = array(49.9, 71.5, 106.4, 129.2, 144.0, 176.0);

				$array['arr_jns2'] = array('Tanah dan Bangunan', 'Penyertaan Langsung', 'Saham', 'Reksadana', 'MTN', 'Sukuk Korporasi');
				$array['arr_data3'] = array(49.9, 71.5, 106.4, 129.2, 144.0, 176.0);

				
				$array['color'] = array('#FFF1C9', '#F7B7A3', '#EA5F89','#9B3192', '#57167E', '#2B0B3F');
				// print($array);exit();
				echo json_encode($array);
			break;

			case 'get_executive_summary':

			// echo "string";exit;

				$array['nil_invest'] = 98.73;
				$array['nil_hasil'] = 101.64;
				$array['nil_yoi'] = 103.14;
				$array['div_invest'] = "container-invest";
				$array['div_hasil'] = "container-hasil";
				$array['div_yoi'] = "container-yoi";
				$array['judul_invest'] = "Aset Investasi";
				$array['judul_hasil'] = "Hasil Investasi";
				$array['judul_yoi'] = "Target YOI";
				// print($array);exit();
				echo json_encode($array);
			break;
		}
	}

}
