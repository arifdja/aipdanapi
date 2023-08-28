<?php 
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		
	}


	public function index()
	{
		$data['opt_dashboard'] = combo_dashboard();
        $data['opt_bln'] = combo_bulan();
		$data['opt_user'] = dtuser();
		$data['bln'] = date('m');
		$data['bread'] = array('header'=>'Dashboard', 'subheader'=>'Dashboard-1');
		$data['view']  = "dashboardV2/dashboard_1";
		$this->load->view('main/utama', $data);
	}


	public function executive_summary()
	{
		$data['opt_dashboard'] = combo_dashboard();
        $data['opt_bln'] = combo_bulan();
		$data['opt_user'] = dtuser();
		$data['bln'] = date('m');
		$data['bread'] = array('header'=>'Executive Summary', 'subheader'=>'Executive Summary');
		$data['view']  = "dashboardV2/dashboard_summary";
		$this->load->view('main/utama', $data);
	}


	public function dana_bersih()
	{
		$data['opt_dashboard'] = combo_dashboard();
        $data['opt_bln'] = combo_bulan();
		$data['opt_user'] = dtuser();
		$data['bln'] = date('m');
		$data['bread'] = array('header'=>'Dana Bersih', 'subheader'=>'Dana Bersih');
		$data['view']  = "dashboardV2/dashboard_dana_bersih";
		$this->load->view('main/utama', $data);
	}


	public function perubahan_danabersih()
	{
		$data['opt_dashboard'] = combo_dashboard();
        $data['opt_bln'] = combo_bulan();
		$data['opt_user'] = dtuser();
		$data['bln'] = date('m');
		$data['bread'] = array('header'=>'Perubahan Dana Bersih', 'subheader'=>'Perubahan Dana Bersih');
		$data['view']  = "dashboardV2/dashboard_perubahan_danabersih";
		$this->load->view('main/utama', $data);
	}

	public function arus_kas()
	{
		$data['opt_dashboard'] = combo_dashboard();
        $data['opt_bln'] = combo_bulan();
		$data['opt_user'] = dtuser();
		$data['bln'] = date('m');
		$data['bread'] = array('header'=>'Arus Kas', 'subheader'=>'Arus Kas');
		$data['view']  = "dashboardV2/dashboard_arus_kas";
		$this->load->view('main/utama', $data);
	}

	public function aspek_operasional()
	{
		$data['opt_dashboard'] = combo_dashboard();
		$data['opt_bln'] = combo_bulan();
		$data['opt_user'] = dtuser();
		$data['bln'] = date('m');
		$data['bread'] = array('header'=>'Aspek Operasional', 'subheader'=>'Aspek Operasional');
		$data['view']  = "dashboardV2/dashboard_aspek_operasional";
		$this->load->view('main/utama', $data);
	}


	public function operasional_belanja()
	{
		$data['opt_dashboard'] = combo_dashboard();
		$data['opt_bln'] = combo_bulan();
		$data['opt_user'] = dtuser();
		$data['bln'] = date('m');
		$data['bread'] = array('header'=>'Operasional Belanja', 'subheader'=>'Operasional Belanja');
		$data['view']  = "dashboardV2/dashboard_operasional_belanja";
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

				$level = $this->session->userdata("level");
				if ($level == 'DJA') {
					$iduser = $this->input->post('iduser');
				}else{
					$iduser = $this->session->userdata('iduser');
				}

			// echo "string";exit;

				$array['nil_invest'] = 98.73;
				$array['nil_hasil'] = 101.64;
				$array['nil_yoi'] = 103.14;
				$array['nil_pertumbuhan'] = 90.14;
				$array['div_invest'] = "container-invest";
				$array['div_hasil'] = "container-hasil";
				$array['div_yoi'] = "container-yoi";
				$array['div_pertumbuhan'] = "container-pertumbuhan";
				$array['judul_invest'] = "Nilai Aset Investasi";
				$array['judul_hasil'] = "Hasil Investasi";
				$array['judul_yoi'] = "Yield On Investment (YOI)";
				$array['judul_pertumbuhan'] = "Pertumbuhan Nilai Aset Investasi";
				// print($array);exit();
				// TOTAL
				$array['tot_investasi'] = "200.000.000.000.000";
				$array['tot_bukan_investasi'] = "130.000.000.000.000";
				$array['tot_kewajiban'] = "223.000.000.000.000";
				$array['tot_dana_bersih'] = "998.000.000.000.000";
				$array['tot_peserta'] = "1.870.980";
				$array['tot_pensiunan'] = "798.432";
				$array['tot_pembayaran'] = "340.000.000.000.000";

				echo json_encode($array);
			break;

			case 'get_dana_bersih':
				$level = $this->session->userdata("level");
				if ($level == 'DJA') {
					$iduser = $this->input->post('iduser');
				}else{
					$iduser = $this->session->userdata('iduser');
				}
				
            	$param = $this->input->post('ds');
            	$bln = $this->input->post('id_bulan');
            	if($bln != ''){
            		$param_bln = $bln;
            	}else{
            		$param_bln = date('m');
            	}

            	if ($param == 'BULANAN') {
            		$array['arr_bln'] = array(
            			'Jan',
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
            		$array['arr_data_line'] = array(49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4);
            		$array['arr_jns'] = array('Deposito', 'Surat Utang Negara', 'Obligasi Korporasi', 'Sukuk Korporasi', 'MTN', 'Reksadana');
            		$array['arr_data_pie'] = array(49.9, 71.5, 106.4, 129.2, 144.0, 176.0);

            		$array['tot_investasi'] = "200.000.000.000.000";
            		$array['tot_bukan_investasi'] = "130.000.000.000.000";
            		$array['tot_kewajiban'] = "223.000.000.000.000";
            		$array['tot_dana_bersih'] = "998.000.000.000.000";
            	}elseif ($param == 'SEMESTERAN') {
            		$array['arr_bln'] = array('Semester 1 - 2023', 'Semester 2 - 2023','Semester 1 - 2023', 'Semester 2 - 2023', 'Semester 1 - 2022', 'Semester 2 - 2022', 'Semester 1 - 2021', 'Semester 2 - 2021');
            		$array['arr_data_line'] = array(29.9, 74.5, 49.9, 71.5, 106.4, 129.2);

            		$array['arr_jns'] = array('Deposito', 'Surat Utang Negara', 'Obligasi Korporasi', 'Sukuk Korporasi', 'MTN', 'Reksadana');
            		$array['arr_data_pie'] = array(49.9, 71.5, 106.4, 129.2, 144.0, 176.0);

            		$array['tot_investasi'] = "200.000.000.000.000";
            		$array['tot_bukan_investasi'] = "130.000.000.000.000";
            		$array['tot_kewajiban'] = "223.000.000.000.000";
            		$array['tot_dana_bersih'] = "998.000.000.000.000";
            	}else{
            		$array['arr_bln'] = array('Tahun 2023', 'Tahun 2022', 'Tahun 2021', 'Tahun 2020', 'Tahun 2019');
            		$array['arr_data_line'] = array(29.9, 74.5, 106.4, 45.6, 32.5);

            		$array['arr_jns'] = array('Deposito', 'Surat Utang Negara', 'Obligasi Korporasi', 'Sukuk Korporasi', 'MTN', 'Reksadana');
            		$array['arr_data_pie'] = array(49.9, 71.5, 106.4, 129.2, 144.0, 176.0);

            		$array['tot_investasi'] = "200.000.000.000.000";
            		$array['tot_bukan_investasi'] = "130.000.000.000.000";
            		$array['tot_kewajiban'] = "223.000.000.000.000";
            		$array['tot_dana_bersih'] = "998.000.000.000.000";
            	}
				// print($array);exit();
				echo json_encode($array);
			break;

			case 'get_perubahan_dana_bersih':
				$level = $this->session->userdata("level");
				if ($level == 'DJA') {
					$iduser = $this->input->post('iduser');
				}else{
					$iduser = $this->session->userdata('iduser');
				}
				
            	$param = $this->input->post('ds');
            	$bln = $this->input->post('id_bulan');
            	if($bln != ''){
            		$param_bln = $bln;
            	}else{
            		$param_bln = date('m');
            	}

            	if ($param == 'BULANAN') {
            		$array['arr_bln'] = array(
            			'Jan',
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
            		$array['arr_data_bar'] = array(49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4);
            		$array['arr_data_line'] = array(29.9, 74.5, 106.4, 120.2, 144.0, 126.0, 105.6, 148.5, 216.4, 154.1, 95.6, 54.4);

            		$array['tot_hasil_investasi'] = "200.000.000.000.000";
            		$array['tot_iuran'] = "130.000.000.000.000";
            		$array['tot_pengelolaan'] = "223.000.000.000.000";
            		$array['tot_beban'] = "998.000.000.000.000";
            		$array['tot_nilai_tunai'] = "200.000.000.000.000";
            		$array['nilai_pasar'] = "870.000.000.000.000";

            	}elseif ($param == 'SEMESTERAN') {
            		$array['arr_bln'] = array('Semester 1 - 2023', 'Semester 2 - 2023','Semester 1 - 2023', 'Semester 2 - 2023', 'Semester 1 - 2022', 'Semester 2 - 2022', 'Semester 1 - 2021', 'Semester 2 - 2021');
            		$array['arr_data_bar'] = array(49.9, 71.5, 123.4, 87.7, 65.9,120.1);
            		$array['arr_data_line'] = array(29.9, 74.5, 49.9, 71.5, 106.4, 129.2);
            		

            		$array['tot_hasil_investasi'] = "200.000.000.000.000";
            		$array['tot_iuran'] = "130.000.000.000.000";
            		$array['tot_pengelolaan'] = "223.000.000.000.000";
            		$array['tot_beban'] = "998.000.000.000.000";
            		$array['tot_nilai_tunai'] = "200.000.000.000.000";
            		$array['nilai_pasar'] = "870.000.000.000.000";

            	}else {
            		$array['arr_bln'] = array('Tahun 2023', 'Tahun 2022', 'Tahun 2021', 'Tahun 2020', 'Tahun 2019');
            		$array['arr_data_bar'] = array(49.9, 71.5, 29.9, 74.5, 106.4);
            		$array['arr_data_line'] = array(29.9, 74.5, 106.4, 45.6, 32.5);


            		$array['tot_hasil_investasi'] = "200.000.000.000.000";
            		$array['tot_iuran'] = "130.000.000.000.000";
            		$array['tot_pengelolaan'] = "223.000.000.000.000";
            		$array['tot_beban'] = "998.000.000.000.000";
            		$array['tot_nilai_tunai'] = "200.000.000.000.000";
            		$array['nilai_pasar'] = "870.000.000.000.000";
            		
            	}

				echo json_encode($array);
			break;


			case 'get_arus_kas':
				$level = $this->session->userdata("level");
				if ($level == 'DJA') {
					$iduser = $this->input->post('iduser');
				}else{
					$iduser = $this->session->userdata('iduser');
				}
				
            	$param = $this->input->post('ds');
            	$bln = $this->input->post('id_bulan');
            	if($bln != ''){
            		$param_bln = $bln;
            	}else{
            		$param_bln = date('m');
            	}


            	// echo $param; exit;
            	if ($param == 'BULANAN') {

            		$array['arr_bln'] = array(
            			'Jan',
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
            		$array['arr_data_bar'] = array(49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4);

            		$array['arr_data_line'] = array(29.9, 74.5, 106.4, 120.2, 144.0, 126.0, 105.6, 148.5, 216.4, 154.1, 95.6, 54.4);

            		$array['tot_investasi'] = "200.000.000.000.000";
            		$array['tot_operasional'] = "1.000.000.000.000";
            		$array['tot_pendanaan'] =  "340.000.000.000.000";
            		
            	}elseif ($param == 'SEMESTERAN') {
            		$array['arr_bln'] = array('Semester 1 - 2023', 'Semester 2 - 2023','Semester 1 - 2023', 'Semester 2 - 2023', 'Semester 1 - 2022', 'Semester 2 - 2022', 'Semester 1 - 2021', 'Semester 2 - 2021');
            		$array['arr_data_bar'] = array(49.9, 71.5, 123.4, 87.7, 65.9,120.1);
            		$array['arr_data_line'] = array(29.9, 74.5, 49.9, 71.5, 106.4, 129.2);

            		$array['tot_investasi'] = "220.000.000.000.000";
            		$array['tot_operasional'] = "1.040.000.000.000";
            		$array['tot_pendanaan'] =  "340.000.000.000.000";
            		
            	}else {
            		$array['arr_bln'] = array('Tahun 2023', 'Tahun 2022', 'Tahun 2021', 'Tahun 2020', 'Tahun 2019');
            		$array['arr_data_bar'] = array(49.9, 71.5, 29.9, 74.5, 106.4);
            		$array['arr_data_line'] = array(29.9, 74.5, 106.4, 45.6, 32.5);

            		$array['tot_investasi'] = "400.000.000.000.000";
            		$array['tot_operasional'] = "3.000.000.000.000";
            		$array['tot_pendanaan'] =  "110.000.000.000.000";
            		
            	}
            	
				
            	echo json_encode($array);
				
			break;

			case 'get_operasional':
				$level = $this->session->userdata("level");
				if ($level == 'DJA') {
					$iduser = $this->input->post('iduser');
				}else{
					$iduser = $this->session->userdata('iduser');
				}
            	$param = $this->input->post('ds');


				$array['arr_data'] = array(49.9, 71.5, 106.4, 129.2, 123.4, 87.7, 65.9,120.1);
				$array['arr_periode'] = array('Semester 1 - 2023', 'Semester 2 - 2023', 'Semester 1 - 2022', 'Semester 2 - 2022', 'Semester 1 - 2021', 'Semester 2 - 2021','Semester 1 - 2020', 'Semester 2 - 2020');

				$array['arr_jns'] = array('Sendiri', 'Janda/Duda', 'Yatim/Piatu', 'Orang Tua');
				$array['arr_data_jns'] = array(49.9, 71.5, 106.4, 129.2);


				$array['arr_kelompok'] = array('PNS DO', 'Pejabat Negara', 'Hakim', 'PKRI/KNIP', 'Veteran', 'TNI/Polri', 'Pegadaian', 'Dana Kehormatan');
				$array['arr_data_kelompok'] = array(49.9, 71.5, 106.4, 129.2, 123.4, 87.7, 65.9,120.1);

				echo json_encode($array);
			break;


			case 'get_operasional_belanja':
				$level = $this->session->userdata("level");
				if ($level == 'DJA') {
					$iduser = $this->input->post('iduser');
				}else{
					$iduser = $this->session->userdata('iduser');
				}
            	$param = $this->input->post('ds');

            	if ($param == "SEMESTERAN") {
            		$array['arr_data'] = array(49.9, 71.5, 106.4, 129.2, 123.4, 87.7, 65.9,120.1);
            		$array['arr_periode'] = array('Semester 1 - 2023', 'Semester 2 - 2023', 'Semester 1 - 2022', 'Semester 2 - 2022', 'Semester 1 - 2021', 'Semester 2 - 2021','Semester 1 - 2020', 'Semester 2 - 2020');

            		$array['arr_jns'] = array('Sendiri', 'Janda/Duda', 'Yatim/Piatu', 'Orang Tua');
            		$array['arr_data_jns'] = array(49.9, 71.5, 106.4, 129.2);


            		$array['arr_kelompok'] = array('PNS DO', 'Pejabat Negara', 'Hakim', 'PKRI/KNIP', 'Veteran', 'TNI/Polri', 'Pegadaian', 'Dana Kehormatan');
            		$array['arr_data_kelompok'] = array(49.9, 71.5, 106.4, 129.2, 123.4, 87.7, 65.9,120.1);

            		$array['tot_pembayaran'] = "123.998.000.340";
            	}elseif ($param == "TAHUNAN") {
            		$array['arr_periode'] = array('Tahun 2023', 'Tahun 2022', 'Tahun 2021', 'Tahun 2020', 'Tahun 2019');
            		$array['arr_data'] = array(49.9, 71.5, 29.9, 74.5, 106.4);

            		$array['arr_jns'] = array('Sendiri', 'Janda/Duda', 'Yatim/Piatu', 'Orang Tua');
            		$array['arr_data_jns'] = array(49.9, 71.5, 106.4, 129.2);


            		$array['arr_kelompok'] = array('PNS DO', 'Pejabat Negara', 'Hakim', 'PKRI/KNIP', 'Veteran', 'TNI/Polri', 'Pegadaian', 'Dana Kehormatan');
            		$array['arr_data_kelompok'] = array(49.9, 71.5, 106.4, 129.2, 123.4, 87.7, 65.9,120.1);

            		$array['tot_pembayaran'] = "423.498.000.340";
            	}
				

				echo json_encode($array);
			break;
		}
	}



	function get_index($mod){
	{
		switch($mod){

			case 'index-aruskas':
				
			break;

		}

        $data['mod'] = $mod;
        $data['acak'] = md5(date('H:i:s'));
        // echo '<pre>';
        // print_r($data);exit;
        $dt = $this->load->view($data['view'], $data, TRUE);
        echo $dt;
    }
	}

}
