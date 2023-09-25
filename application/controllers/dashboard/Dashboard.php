<?php 
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
        $this->load->model('dashboard_model/aruskasds_model');
				$this->load->model('dashboard_model/danabersihds_model');
				$this->load->model('dashboard_model/perubahandanabersihds_model');
        $this->load->model('dashboard_model/executivesummary_model', 'executivesummary');
		
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

		// $data_bln = array();
		// $bulan = array(1,2,3,4,5,6,7,8,9,10,11,12);
		// $jenis = array('INVESTASI', 'BUKAN INVESTASI', 'KEWAJIBAN');
		// foreach ($bulan as $key => $bln) {
		// 	foreach ($jenis as $k => $jns) {
		// 		$data_bln[$jns]['arr_bln'][$key] = konversi_bln($bln);
		// 		$datanya = $this->executivesummary->getdata('summary-bulanan', 'result_array', $bln, $jns);
		// 		foreach ($datanya as $ky => $value) {
		// 			$data_bln[$jns]['arr_data'][$key] = (float)$value['saldo_akhir'];
		// 		}
		// 	}
		// }

		// echo "<pre>";
		// print_r($data_bln);exit;

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

		// $bln_indo = array();
		// $data_bln = array();
		// $bulan = array(6,12);
		// $jenis = array('INVESTASI', 'OPERASIONAL', 'PENDANAAN');
		// foreach ($bulan as $key => $val) {
		// 	foreach ($jenis as $k => $v) {
		// 		$data_bln[$v]['arr_bln'][$key] = konversi_bln($val);
		// 		$datanya = $this->aruskasds_model->getdata('dashboard-aruskas', 'result_array', $val, $v);
		// 		foreach ($datanya as $ky => $value) {
		// 			$data_bln[$v]['arr_data'][$key] = $value['saldo_akhir'];
		// 		}
		// 	}
		// }
		// // echo "<pre>";
		// // print_r($data_bln);exit;

		// $data_bln = array();
		// $current_year = date('Y');
		// $year = range($current_year, $current_year-4);
		// $jenis = array('INVESTASI', 'OPERASIONAL', 'PENDANAAN');
		// foreach ($year as $key => $thn) {
		// 	foreach ($jenis as $ky => $jns) {
		// 		$data_bln[$jns]['arr_bln'][] = $thn;
		// 		$datanya = $this->aruskasds_model->getdata('dashboard-thn-aruskas', 'result_array', $thn, $jns);
		// 		foreach ($datanya as $ky => $value) {
		// 			$data_bln[$jns]['arr_data'][] = $value['saldo_akhir'];
		// 		}
		// 	}
		// }

		// echo "<pre>";
		// print_r($data_bln);exit;




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
					$idusernya = $this->input->post('iduser');
				}else{
					$idusernya = $this->session->userdata('iduser');
				}
				$param_bln = intval(date('m'));
				if ($param_bln > 1 && $param_bln <= 6) {
					$semester = 1;
				}else if ($param_bln > 7 && $param_bln <= 12) {
					$semester = 2;
				}

				$data_bln = array();
				$bulan = array(1,2,3,4,5,6,7,8,9,10,11,12);
				$jenis = array('INVESTASI', 'BUKAN INVESTASI', 'KEWAJIBAN', 'HASIL INVESTASI');
				foreach ($bulan as $key => $bln) {
					foreach ($jenis as $k => $jns) {
						$data_bln[$jns]['arr_bln'][$key] = konversi_bln($bln);
						$datanya = $this->executivesummary->getdata('summary-bulanan', 'result_array', $bln, $jns);
						foreach ($datanya as $ky => $value) {
							$data_bln[$jns]['arr_data'][$bln] = (float)$value['saldo_akhir'];
							$data_bln[$jns]['arr_persen'][$bln] = (float)$value['persen_rka'];
						}
					}
				}

				$datanya_operasional = $this->executivesummary->getdata('aspek_operasional', 'row_array', $semester);
				$pertumbuhan_invest = $this->executivesummary->getdata('nilai_pertumbuhan_investasi', 'row_array', $param_bln);

				$array['nil_invest'] = $data_bln['INVESTASI']['arr_persen'][$param_bln];
				$array['nil_hasil'] = $data_bln['HASIL INVESTASI']['arr_persen'][$param_bln];
				$array['nil_yoi'] = $this->nilai_yoi($idusernya, $param_bln);
				$array['nil_pertumbuhan'] = round($pertumbuhan_invest['pertumbuhan'],2); 

				$array['div_invest'] = "container-invest";
				$array['div_hasil'] = "container-hasil";
				$array['div_yoi'] = "container-yoi";
				$array['div_pertumbuhan'] = "container-pertumbuhan";
				$array['judul_invest'] = "Nilai Aset Investasi";
				$array['judul_hasil'] = "Hasil Investasi";
				$array['judul_yoi'] = "Yield On Investment (YOI)";
				$array['judul_pertumbuhan'] = "Pertumbuhan Nilai Aset Investasi";
				$array['semester'] = $semester;
				// print($array);exit();
				// TOTAL
				$array['tot_investasi'] = rupiah($data_bln['INVESTASI']['arr_data'][$param_bln]);
				$array['tot_bukan_investasi'] = rupiah($data_bln['BUKAN INVESTASI']['arr_data'][$param_bln]);
				$array['tot_kewajiban'] = rupiah($data_bln['KEWAJIBAN']['arr_data'][$param_bln]);

				$danabersih = ($data_bln['INVESTASI']['arr_data'][$param_bln]) + ($data_bln['BUKAN INVESTASI']['arr_data'][$param_bln]) - ($data_bln['KEWAJIBAN']['arr_data'][$param_bln]);
				$array['tot_dana_bersih'] = rupiah($danabersih);

				$array['tot_peserta'] = "-";
				$array['tot_pensiunan'] = rupiah($datanya_operasional['jml_penerima']);
				$array['tot_pembayaran'] = rupiah($datanya_operasional['jml_pembayaran']);

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
							
								// $data_bln = array();
								// // $bulan = array(1,2,3,4,5,6,7,8,9,10,11,12);
								// $bulan = range(1, $param_bln);
								// $jenis = array('INVESTASI', 'BUKAN INVESTASI', 'KEWAJIBAN');
								
								// foreach ($bulan as $key => $bln) {
								// 	foreach ($jenis as $k => $jns) {
								// 		$data_bln[$jns]['arr_bln'][$key] = konversi_bln($bln);
								// 		$datanya = $this->danabersihds_model->getdata('dashboard-danabersih', 'result_array', $bln, $jns);
								// 		foreach ($datanya as $ky => $value) {
								// 			$data_bln[$jns]['arr_data'][$key] = (float)$value['saldo_akhir'];
								// 		}
								// 	}
								// }

								$data_bln = array();
								$bulan = range(1, $param_bln);
								$jenis = array('INVESTASI', 'BUKAN INVESTASI', 'KEWAJIBAN');

								foreach ($bulan as $key => $bln) {
										foreach ($jenis as $k => $jns) {
												$data_bln[$jns]['arr_bln'][$key] = konversi_bln($bln);
												
												// if ($bln == $param_bln) {
														$datanya = $this->danabersihds_model->getdata('dashboard-danabersih', 'result_array', $bln, $jns);
														foreach ($datanya as $ky => $value) {
																$data_bln[$jns]['arr_data'][$key] = (float)$value['saldo_akhir'];
														}
												// }
										}
								}


								// echo "<pre>";
            		// print_r($data_bln['PENDANAAN']['arr_data']);exit;								
								
								$monthName = date('M', mktime(0, 0, 0, $param_bln, 1));
								$array['arr_bln'] = array($monthName);

            		$array['arr_data_line_invest'] = $data_bln['INVESTASI']['arr_data'];
            		$array['arr_data_line_bukan_invest'] = $data_bln['BUKAN INVESTASI']['arr_data'];
								$array['arr_data_line_kewajiban'] = $data_bln['KEWAJIBAN']['arr_data'];

								$array['arr_jns'] = array('Deposito', 'Surat Utang Negara', 'Obligasi Korporasi', 'Sukuk Korporasi', 'MTN', 'Reksadana');
            		$array['arr_data_pie'] = $data_bln['INVESTASI']['arr_data'];

								$array['tot_investasi'] = rupiah(array_sum($data_bln['INVESTASI']['arr_data']));
								$array['tot_bukan_investasi'] = rupiah(array_sum($data_bln['BUKAN INVESTASI']['arr_data']));
								$array['tot_kewajiban'] = rupiah(array_sum($data_bln['KEWAJIBAN']['arr_data']));

								
								$danabersih = (array_sum($data_bln['INVESTASI']['arr_data']) + array_sum($data_bln['BUKAN INVESTASI']['arr_data']) - array_sum($data_bln['KEWAJIBAN']['arr_data']));
								$array['tot_dana_bersih'] = rupiah($danabersih);

								$array['arr_data_line_dana_bersih'] = array($danabersih);
								// print_r($danabersih);exit;

        }	elseif ($param == 'SEMESTERAN') {
								$data_bln = array();
								$current_year = date('Y');
								$year = range($current_year, $current_year-3);
								sort($year);
								$smt = array('Semester I', 'Semester II');
								$jenis = array('INVESTASI', 'BUKAN INVESTASI', 'KEWAJIBAN');
								foreach ($year as $key => $thn) {
									foreach ($smt as $k => $sem) {
										foreach ($jenis as $ky => $jns) {
											$data_bln[$jns]['arr_bln'][] = $sem.'-'.$thn;
											if ($sem == "Semester I") {
												$blnnya = 6 ;
											}else{
												$blnnya = 12 ;
											}
											$datanya = $this->danabersihds_model->getdata('dashboard-smt-danabersih', 'result_array', $thn, $jns, $blnnya);
											foreach ($datanya as $ky => $value) {
												$data_bln[$jns]['arr_data'][] = (float)$value['saldo_akhir'];
											}
										}
									}
								}

            		// $array['arr_bln'] = array('Semester 1 - 2021', 'Semester 2 - 2021', 'Semester 1 - 2022', 'Semester 2 - 2022', 'Semester 1 - 2023', 'Semester 2 - 2023','Semester 1 - 2023', 'Semester 2 - 2023');
            		$array['arr_bln'] = $data_bln['INVESTASI']['arr_bln'];
								$array['arr_data_line_invest'] = $data_bln['INVESTASI']['arr_data'];
            		$array['arr_data_line_bukan_invest'] = $data_bln['BUKAN INVESTASI']['arr_data'];
								$array['arr_data_line_kewajiban'] = $data_bln['KEWAJIBAN']['arr_data'];

            		$array['arr_jns'] = array('Deposito', 'Surat Utang Negara', 'Obligasi Korporasi', 'Sukuk Korporasi', 'MTN', 'Reksadana');
            		$array['arr_data_pie'] = $data_bln['INVESTASI']['arr_data'];

            		$array['tot_investasi'] = rupiah(array_sum($data_bln['INVESTASI']['arr_data']));
								$array['tot_bukan_investasi'] = rupiah(array_sum($data_bln['BUKAN INVESTASI']['arr_data']));
								$array['tot_kewajiban'] = rupiah(array_sum($data_bln['KEWAJIBAN']['arr_data']));
								
								$danabersih = (array_sum($data_bln['INVESTASI']['arr_data']) + array_sum($data_bln['BUKAN INVESTASI']['arr_data']) + array_sum($data_bln['KEWAJIBAN']['arr_data']));
								$array['tot_dana_bersih'] = rupiah($danabersih);

								$array['arr_data_line_dana_bersih'] = array($danabersih);

        }	else	{
								$data_bln = array();
								$current_year = date('Y');
								$year = range($current_year, $current_year-4);
								$jenis = array('INVESTASI', 'BUKAN INVESTASI', 'KEWAJIBAN');
								foreach ($year as $key => $thn) {
									foreach ($jenis as $ky => $jns) {
										$data_bln[$jns]['arr_bln'][] = $thn;
										$datanya = $this->danabersihds_model->getdata('dashboard-thn-danabersih', 'result_array', $thn, $jns, '13');
										foreach ($datanya as $ky => $value) {
											$data_bln[$jns]['arr_data'][] = (float)$value['saldo_akhir'];
										}
									}
								}
            		$array['arr_bln'] = array('Tahun 2019','Tahun 2020', 'Tahun 2021', 'Tahun 2022', 'Tahun 2023');
            		$array['arr_data_line_invest'] = $data_bln['INVESTASI']['arr_data'];
            		$array['arr_data_line_bukan_invest'] = $data_bln['BUKAN INVESTASI']['arr_data'];
								$array['arr_data_line_kewajiban'] = $data_bln['KEWAJIBAN']['arr_data'];

            		$array['arr_jns'] = array('Deposito', 'Surat Utang Negara', 'Obligasi Korporasi', 'Sukuk Korporasi', 'MTN', 'Reksadana');
            		$array['arr_data_pie'] = $data_bln['INVESTASI']['arr_data'];

            		$array['tot_investasi'] = rupiah(array_sum($data_bln['INVESTASI']['arr_data']));
								$array['tot_bukan_investasi'] = rupiah(array_sum($data_bln['BUKAN INVESTASI']['arr_data']));
								$array['tot_kewajiban'] = rupiah(array_sum($data_bln['KEWAJIBAN']['arr_data']));
								
								$danabersih = (array_sum($data_bln['INVESTASI']['arr_data']) + array_sum($data_bln['BUKAN INVESTASI']['arr_data']) + array_sum($data_bln['KEWAJIBAN']['arr_data']));
								$array['tot_dana_bersih'] = rupiah($danabersih);

								$array['arr_data_line_dana_bersih'] = array($danabersih);
          }

				// print($array);exit();
				echo json_encode($array);
			break;

			case 'get_perubahan_dana_bersih':

				// IURAN - INVESTASI -
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

							
								$data_bln = array();
								$bulan = range(1, $param_bln);
								$jenis = array('HASIL INVESTASI', 'IURAN', 'INVESTASI');

								foreach ($bulan as $key => $bln) {
										foreach ($jenis as $k => $jns) {
												$data_bln[$jns]['arr_bln'][$key] = konversi_bln($bln);
												
												
												// if ($bln == $param_bln) {
														$datanya = $this->perubahandanabersihds_model->getdata('dashboard-perubahandanabersih', 'result_array', $bln, $jns);
														foreach ($datanya as $ky => $value) {
																$data_bln[$jns]['arr_data'][$key] = (float)$value['saldo_akhir'];
														}
												// }
						
												// Fee Pengelolaan AIP
												$jns2 = 'BEBAN'; 
												$datanya2 = $this->perubahandanabersihds_model->getdata('dashboard-perubahandanabersih2', 'result_array', $bln, $jns2);
												foreach ($datanya2 as $ky => $value) {
														$data_bln[$jns2]['arr_data_pengelolaan'][$key] = (float)$value['saldo_akhir'];
												}

												// Beban Operasional
												$datanya3 = $this->perubahandanabersihds_model->getdata('dashboard-perubahandanabersih3', 'result_array', $bln, $jns2);
												foreach ($datanya3 as $ky => $value) {
														$data_bln[$jns2]['arr_data_beban'][$key] = (float)$value['saldo_akhir'];
												}

												// Nilai Tunai Iuran Pensiun (NTIP)
												$datanya4 = $this->perubahandanabersihds_model->getdata('dashboard-perubahandanabersih4', 'result_array', $bln, $jns2);
												foreach ($datanya4 as $ky => $value) {
														$data_bln[$jns2]['arr_data_nilai_tunai'][$key] = (float)$value['saldo_akhir'];
												}

												// Kenaikan/Penurunan Nilai Pasar Aset Investasi
												$datanya5 = $this->perubahandanabersihds_model->getdata('dashboard-perubahandanabersih5', 'result_array', $bln);
												foreach ($datanya5 as $ky => $value) {
														$data_bln['arr_data_nilai_pasar'][$key] = (float)$value['saldo_awal'];
												}
										}
								}

								


            		$monthName = date('M', mktime(0, 0, 0, $param_bln, 1));
								$array['arr_bln'] = array($monthName);

								$array['arr_data_bar_hasil_invest'] = $data_bln['HASIL INVESTASI']['arr_data'];
								$array['arr_data_line_hasil_invest'] = $data_bln['HASIL INVESTASI']['arr_data'];

								$array['arr_data_bar_iuran'] = $data_bln['IURAN']['arr_data'];
								$array['arr_data_line_iuran'] = $data_bln['IURAN']['arr_data'];

								// Ubah array pengelolaan
								$array['arr_data_bar_pengelolaan'] = $data_bln['BEBAN']['arr_data_pengelolaan'];
								$array['arr_data_line_pengelolaan'] = $data_bln['BEBAN']['arr_data_pengelolaan'];
								$array['tot_pengelolaan'] = rupiah(array_sum($data_bln['BEBAN']['arr_data_pengelolaan']));
								//======================================
								
								// Ubah array Beban Operasional
								$array['arr_data_bar_beban'] = $data_bln['BEBAN']['arr_data_beban'];
								$array['arr_data_line_beban'] = $data_bln['BEBAN']['arr_data_beban'];
								$array['tot_beban'] = rupiah(array_sum($data_bln['BEBAN']['arr_data_beban']));
								//======================================

								// Ubah array Nilai Tunai Iuran Pensiun (NTIP)
								$array['arr_data_bar_nilai_tunai'] = $data_bln['BEBAN']['arr_data_nilai_tunai'];
								$array['arr_data_line_nilai_tunai'] = $data_bln['BEBAN']['arr_data_nilai_tunai'];
								$array['tot_nilai_tunai'] = rupiah(array_sum($data_bln['BEBAN']['arr_data_nilai_tunai']));
								//======================================

								// Ubah array Kenaikan/Penurunan Nilai Pasar Aset Investasi
								$array['arr_data_bar_nilai_pasar'] = $data_bln['arr_data_nilai_pasar'];
								$array['arr_data_line_nilai_pasar'] = $data_bln['arr_data_nilai_pasar'];
								$array['tot_nilai_pasar'] = rupiah(array_sum($data_bln['arr_data_nilai_pasar']));
								//======================================

								$array['tot_hasil_investasi'] = rupiah(array_sum($data_bln['HASIL INVESTASI']['arr_data']));
								$array['tot_iuran'] = rupiah(array_sum($data_bln['IURAN']['arr_data']));
							

            	}elseif ($param == 'SEMESTERAN') {

								$data_bln = array();
								$current_year = date('Y');
								$year = range($current_year, $current_year-3);
								sort($year);
								$smt = array('Semester I', 'Semester II');
								$jenis = array('HASIL INVESTASI', 'IURAN', 'BEBAN', 'BEBAN INVESTASI', 'NILAI INVESTASI', 'INVESTASI');
								foreach ($year as $key => $thn) {
									foreach ($smt as $k => $sem) {
										foreach ($jenis as $ky => $jns) {
											$data_bln[$jns]['arr_bln'][] = $sem.'-'.$thn;
											if ($sem == "Semester I") {
												$blnnya = 6 ;
											}else{
												$blnnya = 12 ;
											}
											$datanya = $this->perubahandanabersihds_model->getdata('dashboard-smt-perubahandanabersih', 'result_array', $thn, $jns, $blnnya);
											foreach ($datanya as $ky => $value) {
												$data_bln[$jns]['arr_data'][] = (float)$value['saldo_akhir'];
											}
										}
									}
								}

								$array['arr_bln'] = $data_bln['INVESTASI']['arr_bln'];
            		$array['arr_data_bar_hasil_invest'] = $data_bln['HASIL INVESTASI']['arr_data'];
            		$array['arr_data_line_hasil_invest'] = $data_bln['HASIL INVESTASI']['arr_data'];

								$array['arr_data_bar_iuran'] = $data_bln['IURAN']['arr_data'];
            		$array['arr_data_line_iuran'] = $data_bln['IURAN']['arr_data'];

								$array['arr_data_bar_pengelolaan'] = $data_bln['BEBAN']['arr_data'];
            		$array['arr_data_line_pengelolaan'] = $data_bln['BEBAN']['arr_data'];

								$array['arr_data_bar_beban'] = $data_bln['BEBAN INVESTASI']['arr_data'];
            		$array['arr_data_line_beban'] = $data_bln['BEBAN INVESTASI']['arr_data'];

								$array['arr_data_bar_nilai_tunai'] = $data_bln['NILAI INVESTASI']['arr_data'];
            		$array['arr_data_line_nilai_tunai'] = $data_bln['NILAI INVESTASI']['arr_data'];

								$array['arr_data_bar_nilai_pasar'] = $data_bln['INVESTASI']['arr_data'];
            		$array['arr_data_line_nilai_pasar'] = $data_bln['INVESTASI']['arr_data'];

            		$array['tot_hasil_investasi'] = rupiah(array_sum($data_bln['HASIL INVESTASI']['arr_data']));
            		$array['tot_iuran'] = rupiah(array_sum($data_bln['IURAN']['arr_data']));
            		$array['tot_pengelolaan'] = rupiah(array_sum($data_bln['BEBAN']['arr_data']));
            		$array['tot_beban'] = rupiah(array_sum($data_bln['BEBAN INVESTASI']['arr_data']));
            		$array['tot_nilai_tunai'] = rupiah(array_sum($data_bln['NILAI INVESTASI']['arr_data']));
            		$array['tot_nilai_pasar'] = rupiah(array_sum($data_bln['INVESTASI']['arr_data']));

            	} else {

								$data_bln = array();
								$current_year = date('Y');
								$year = range($current_year, $current_year-4);
								$jenis = array('HASIL INVESTASI', 'IURAN', 'BEBAN', 'BEBAN INVESTASI', 'NILAI INVESTASI', 'INVESTASI');
								foreach ($year as $key => $thn) {
									foreach ($jenis as $ky => $jns) {
										$data_bln[$jns]['arr_bln'][] = $thn;
										$datanya = $this->perubahandanabersihds_model->getdata('dashboard-thn-perubahandanabersih', 'result_array', $thn, $jns, '13');
										foreach ($datanya as $ky => $value) {
											$data_bln[$jns]['arr_data'][] = (float)$value['saldo_akhir'];
										}
									}
								}

            		$array['arr_bln'] = array('Tahun 2019','Tahun 2020', 'Tahun 2021', 'Tahun 2022', 'Tahun 2023');
            		$array['arr_data_bar_hasil_invest'] = $data_bln['HASIL INVESTASI']['arr_data'];
            		$array['arr_data_line_hasil_invest'] = $data_bln['HASIL INVESTASI']['arr_data'];

								$array['arr_data_bar_iuran'] = $data_bln['IURAN']['arr_data'];
            		$array['arr_data_line_iuran'] = $data_bln['IURAN']['arr_data'];

								$array['arr_data_bar_pengelolaan'] = $data_bln['BEBAN']['arr_data'];
            		$array['arr_data_line_pengelolaan'] = $data_bln['BEBAN']['arr_data'];

								$array['arr_data_bar_beban'] = $data_bln['BEBAN INVESTASI']['arr_data'];
            		$array['arr_data_line_beban'] = $data_bln['BEBAN INVESTASI']['arr_data'];

								$array['arr_data_bar_nilai_tunai'] = $data_bln['NILAI INVESTASI']['arr_data'];
            		$array['arr_data_line_nilai_tunai'] = $data_bln['NILAI INVESTASI']['arr_data'];

								$array['arr_data_bar_nilai_pasar'] = $data_bln['INVESTASI']['arr_data'];
            		$array['arr_data_line_nilai_pasar'] = $data_bln['INVESTASI']['arr_data'];

            		$array['tot_hasil_investasi'] = rupiah(array_sum($data_bln['HASIL INVESTASI']['arr_data']));
            		$array['tot_iuran'] = rupiah(array_sum($data_bln['IURAN']['arr_data']));
            		$array['tot_pengelolaan'] = rupiah(array_sum($data_bln['BEBAN']['arr_data']));
            		$array['tot_beban'] = rupiah(array_sum($data_bln['BEBAN INVESTASI']['arr_data']));
            		$array['tot_nilai_tunai'] = rupiah(array_sum($data_bln['NILAI INVESTASI']['arr_data']));
            		$array['tot_nilai_pasar'] = rupiah(array_sum($data_bln['INVESTASI']['arr_data']));
            		
            	}

				echo json_encode($array);
			break;


			case 'get_arus_kas':
				
            	$param = $this->input->post('ds');
            	$bln = $this->input->post('id_bulan');
            	if($bln != ''){
            		$param_bln = $bln;
            	}else{
            		$param_bln = intval(date('m'));
            	}

            	// echo $param; exit;
            	if ($param == 'BULANAN') {


            		$data_bln = array();
            		$bulan = array(1,2,3,4,5,6,7,8,9,10,11,12);
            		$jenis = array('INVESTASI', 'OPERASIONAL', 'PENDANAAN');
            		foreach ($bulan as $key => $bln) {
            			foreach ($jenis as $k => $jns) {
            				$data_bln[$jns]['arr_bln'][$key] = konversi_bln($bln);
            				$datanya = $this->aruskasds_model->getdata('dashboard-aruskas', 'result_array', $bln, $jns);
            				foreach ($datanya as $ky => $value) {
            					$data_bln[$jns]['arr_data'][$key] = (float)$value['saldo_akhir'];
            				}
            			}
            		}
            		// echo "<pre>";
            		// print_r($data_bln['PENDANAAN']['arr_data']);exit;


            		$array['arr_bln'] = $data_bln['INVESTASI']['arr_bln'];
            		$array['arr_data_line_invest'] = $data_bln['INVESTASI']['arr_data'];
            		$array['arr_data_line_operasioanl'] = $data_bln['OPERASIONAL']['arr_data'];
            		$array['arr_data_line_pendanaan'] = $data_bln['PENDANAAN']['arr_data'];

            		$array['tot_investasi'] = rupiah(array_sum($data_bln['INVESTASI']['arr_data']));
            		$array['tot_operasional'] = rupiah(array_sum($data_bln['OPERASIONAL']['arr_data']));
            		$array['tot_pendanaan'] =  rupiah(array_sum($data_bln['PENDANAAN']['arr_data']));
            		
            	}elseif ($param == 'SEMESTERAN') {
            		$data_bln = array();
            		$current_year = date('Y');
            		$year = range($current_year, $current_year-2);

            		$smt = array('Semester I', 'Semester II');
            		$jenis = array('INVESTASI', 'OPERASIONAL', 'PENDANAAN');
            		foreach ($year as $key => $thn) {
            			foreach ($smt as $k => $sem) {
            				foreach ($jenis as $ky => $jns) {
            					$data_bln[$jns]['arr_bln'][] = $sem.'-'.$thn;
            					if ($sem == "Semester I") {
            						$blnnya = 6 ;
            					}else{
            						$blnnya = 12 ;
            					}
            					$datanya = $this->aruskasds_model->getdata('dashboard-smt-aruskas', 'result_array', $thn, $jns, $blnnya);
            					foreach ($datanya as $ky => $value) {
            						$data_bln[$jns]['arr_data'][] = (float)$value['saldo_akhir'];
            					}
            				}
            			}
            		}

            		$array['arr_bln'] = $data_bln['INVESTASI']['arr_bln'];
            		$array['arr_data_line_invest'] = $data_bln['INVESTASI']['arr_data'];
            		$array['arr_data_line_operasioanl'] = $data_bln['OPERASIONAL']['arr_data'];
            		$array['arr_data_line_pendanaan'] = $data_bln['PENDANAAN']['arr_data'];

            		$array['tot_investasi'] = rupiah(array_sum($data_bln['INVESTASI']['arr_data']));
            		$array['tot_operasional'] = rupiah(array_sum($data_bln['OPERASIONAL']['arr_data']));
            		$array['tot_pendanaan'] =  rupiah(array_sum($data_bln['PENDANAAN']['arr_data']));
            		
            	}else {
            		$data_bln = array();
            		$current_year = date('Y');
            		$year = range($current_year, $current_year-4);
            		$jenis = array('INVESTASI', 'OPERASIONAL', 'PENDANAAN');
            		foreach ($year as $key => $thn) {
            			foreach ($jenis as $ky => $jns) {
            				$data_bln[$jns]['arr_bln'][] = $thn;
            				$datanya = $this->aruskasds_model->getdata('dashboard-smt-aruskas', 'result_array', $thn, $jns, '13');
            				foreach ($datanya as $ky => $value) {
            					$data_bln[$jns]['arr_data'][] = (float)$value['saldo_akhir'];
            				}
            			}
            		}

            		$array['arr_bln'] = $data_bln['INVESTASI']['arr_bln'];
            		$array['arr_data_line_invest'] = $data_bln['INVESTASI']['arr_data'];
            		$array['arr_data_line_operasioanl'] = $data_bln['OPERASIONAL']['arr_data'];
            		$array['arr_data_line_pendanaan'] = $data_bln['PENDANAAN']['arr_data'];

            		$array['tot_investasi'] = rupiah(array_sum($data_bln['INVESTASI']['arr_data']));
            		$array['tot_operasional'] = rupiah(array_sum($data_bln['OPERASIONAL']['arr_data']));
            		$array['tot_pendanaan'] =  rupiah(array_sum($data_bln['PENDANAAN']['arr_data']));
            		
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


	public function nilai_yoi($param="", $bln=""){
		error_reporting(0);
        if ($param != "") {
            $idusernya = $param;
        }else{ 
            $idusernya = $this->session->userdata('iduser');
        }

        $hasil_investasi = $this->executivesummary->getdata('yoi_hasil_investasi','row_array', $bln);
        $array1a = array();
        $array1b = array();

        
        $investasi = $this->executivesummary->getdata('yoi_investasi','result_array', $bln);
        foreach ($investasi as $ky => $vy) {
            $array1a[$ky] = $vy['saldo_akhir'];
            $array1b[$ky] = $vy['rka'];
        }

        
        
        if($this->level == 'DJA'){
            if($param != ""){
                $saldo_akhir = geometric_average($array1a);

            }else{
                $saldo_akhir = 0;
            }
        }else{
            $saldo_akhir = geometric_average($array1a);

        }

        // echo "<pre>";
        // print_r($investasi);exit();
        // print_r(geometric_average($array2a));exit;

        $yoi= ($saldo_akhir!=0)?($hasil_investasi['saldo_akhir']/$saldo_akhir)*100:0;
        $data = round($yoi,2);
        

        return $data;
    }

}
