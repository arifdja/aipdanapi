<?php 
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard_summary extends CI_Controller {

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
		$data['bln_head'] = konversi_bln(intval(date('m')), 'fullbulan');
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
		// $num = 900000000;
		// $angka = number_shorten($num);
		// echo $angka;exit;
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

				$datanya_operasional = $this->executivesummary->getdata('aspek_operasional', 'row_array', $param_bln);
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

				$array['tot_peserta'] = rupiah($datanya_operasional['jml_peserta']);;
				$array['tot_pensiunan'] = rupiah($datanya_operasional['jml_pensiunan']);
				$array['tot_pembayaran'] = rupiah($datanya_operasional['jml_pembayaran']);

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
            		// $bulan = array(1,2,3,4,5,6,7,8,9,10,11,12);
            		$bulan = range(1, $param_bln);

            		// bulan($pr);exit;

            		$jenis = array('INVESTASI', 'OPERASIONAL', 'PENDANAAN');
            		foreach ($bulan as $key => $bln) {
            			foreach ($jenis as $k => $jns) {
            				$data_bln[$jns]['arr_bln'][$key] = konversi_bln($bln);
            				$datanya = $this->aruskasds_model->getdata('dashboard-aruskas', 'result_array', $bln, $jns);
            				$datanya_sum = $this->aruskasds_model->getdata('dashboard-aruskas-sum', 'result_array', $bln, $jns);
            				foreach ($datanya as $ky => $value) {
            					$data_bln[$jns]['arr_data'][$key] = (float)$value['saldo_akhir'];
            				}

            				foreach ($datanya_sum as $kyx => $v) {
            					$data_bln[$jns]['arr_data_bar'][$key] = (float)$v['saldo_akhir'];
            				}
            			}
            		}
            		// echo "<pre>";
            		// print_r($data_bln['PENDANAAN']['arr_data_bar']);exit;


            		$array['arr_bln'] = $data_bln['INVESTASI']['arr_bln'];
            		$array['arr_data_line_invest'] = $data_bln['INVESTASI']['arr_data'];
            		$array['arr_data_line_operasioanl'] = $data_bln['OPERASIONAL']['arr_data'];
            		$array['arr_data_line_pendanaan'] = $data_bln['PENDANAAN']['arr_data'];

            		$array['arr_data_bar_invest'] = $data_bln['INVESTASI']['arr_data_bar'];
            		$array['arr_data_bar_operasioanl'] = $data_bln['OPERASIONAL']['arr_data_bar'];
            		$array['arr_data_bar_pendanaan'] = $data_bln['PENDANAAN']['arr_data_bar'];

            		$array['tot_investasi'] = rupiah(array_sum($data_bln['INVESTASI']['arr_data']));
            		$array['tot_operasional'] = rupiah(array_sum($data_bln['OPERASIONAL']['arr_data']));
            		$array['tot_pendanaan'] =  rupiah(array_sum($data_bln['PENDANAAN']['arr_data']));
            		
            	}elseif ($param == 'SEMESTERAN') {
            		$data_bln = array();
            		$current_year = date('Y');
            		$year = range($current_year, $current_year-3);

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

            		$array['arr_data_bar_invest'] = $data_bln['INVESTASI']['arr_data'];
            		$array['arr_data_bar_operasioanl'] = $data_bln['OPERASIONAL']['arr_data'];
            		$array['arr_data_bar_pendanaan'] = $data_bln['PENDANAAN']['arr_data'];

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

            		$array['arr_data_bar_invest'] = $data_bln['INVESTASI']['arr_data'];
            		$array['arr_data_bar_operasioanl'] = $data_bln['OPERASIONAL']['arr_data'];
            		$array['arr_data_bar_pendanaan'] = $data_bln['PENDANAAN']['arr_data'];

            		$array['tot_investasi'] = rupiah(array_sum($data_bln['INVESTASI']['arr_data']));
            		$array['tot_operasional'] = rupiah(array_sum($data_bln['OPERASIONAL']['arr_data']));
            		$array['tot_pendanaan'] =  rupiah(array_sum($data_bln['PENDANAAN']['arr_data']));
            		
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
