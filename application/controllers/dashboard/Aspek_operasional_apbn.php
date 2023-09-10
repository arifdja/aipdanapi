<?php 
if ( !defined('BASEPATH')) exit('No direct script access allowed');

class Aspek_operasional_apbn extends CI_Controller {

	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
        $this->load->model('dashboard_model/aspek_operasional_model');
	}

	public function operasional_belanja()
	{
		$data['opt_dashboard'] = combo_dashboard2();
		$data['opt_bln'] = combo_bulan();
		$data['opt_user'] = dtuser();
		$data['bln'] = date('m');
		$data['bread'] = array('header'=>'Operasional Belanja', 'subheader'=>'Operasional Belanja');
		$data['view']  = "dashboardV2/dashboard_operasional_belanja";
		$this->load->view('main/utama', $data);
	}

	function getdisplay($type){
		switch($type){
			
			case 'get_operasional_belanja':

            	$param = $this->input->post('ds');

                if ($param == "SEMESTERAN") {

            		$current_year = date('Y');
            		$year = range($current_year, $current_year-2);
            		$smt = array('Semester I', 'Semester II');

                   
                    $datanya = $this->aspek_operasional_model->getdata('dashboard-smt-operasional', 'result_array','semester','1');
                    foreach ($datanya as $key => $value) {
                        $array['arr_data'][] = (int)$value['jml_pembayaran'];
                        $array['arr_periode'][] = "Semester $value[semester] - $value[tahun] ";
                    }

                    $datanya2 = $this->aspek_operasional_model->getdata('dashboard-smt-jenis', 'result_array','semester','1');
                    foreach ($datanya2 as $key => $value) {
                        $array['arr_jns'][] = $value['jenis_penerima'];
                        $array['arr_data_jns'][] = (int)$value['jml_penerima'];
                    }

                    $datanya3 = $this->aspek_operasional_model->getdata('dashboard-smt-kelompok', 'result_array','semester','1');
                    foreach ($datanya3 as $key => $value) {
                        $array['arr_kelompok'][] = $value['kelompok_penerima'];
                        $array['arr_data_kelompok'][] = (int)$value['jml_penerima'];
                    }

                    $array['tot_pembayaran'] = array_sum($array['arr_data']);
                    $array['tot_penerima'] = rupiah(array_sum($array['arr_data_jns']));

                } elseif ($param == "TAHUNAN")
                {
                    $datanya = $this->aspek_operasional_model->getdata('dashboard-smt-operasional', 'result_array','tahunan','1');
                    foreach ($datanya as $key => $value) {
                        $array['arr_data'][] = (int)$value['jml_pembayaran'];
                        $array['arr_periode'][] = "$value[tahun]";
                    }

                    $datanya2 = $this->aspek_operasional_model->getdata('dashboard-smt-jenis', 'result_array','tahunan','1');
                    foreach ($datanya2 as $key => $value) {
                        $array['arr_jns'][] = $value['jenis_penerima'];
                        $array['arr_data_jns'][] = (int)$value['jml_penerima'];
                    }

                    $datanya3 = $this->aspek_operasional_model->getdata('dashboard-smt-kelompok', 'result_array','tahunan','1');
                    foreach ($datanya3 as $key => $value) {
                        $array['arr_kelompok'][] = $value['kelompok_penerima'];
                        $array['arr_data_kelompok'][] = (int)$value['jml_penerima'];
                    }

                    $array['tot_pembayaran'] = array_sum($array['arr_data']);
                    $array['tot_penerima'] = rupiah(array_sum($array['arr_data_jns']));
                }

				echo json_encode($array);
			break;
		}
	}

}
