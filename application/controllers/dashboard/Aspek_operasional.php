<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Aspek_operasional extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('dashboard_model/aspek_operasional_model');
    }

    public function aspek_operasional()
    {
        $data['opt_dashboard'] = combo_dashboard2();
        $data['opt_bln'] = combo_bulan();
        $data['opt_user'] = dtuser();
        // $data['bln'] = date('m');
        $data['bread'] = array('header' => 'Aspek Operasional', 'subheader' => 'Aspek Operasional');
        $data['view']  = "dashboardV2/dashboard_aspek_operasional";
        $this->load->view('main/utama', $data);
    }

    function getdisplay($type)
    {
        switch ($type) {
            case 'get_operasional':

                $param = $this->input->post('ds');

                $array['tot_pembayaran'] = 0;
                $array['tot_penerima'] = 0;
                $array['arr_data'] = [];
                $array['arr_data_bayar'] = [];
                $array['arr_periode'] = [];
                $array['arr_jns'] = [];
                $array['arr_data_jns'] = [];
                $array['arr_data_jns_bayar'] = [];
                $array['arr_kelompok'] = [];
                $array['arr_data_kelompok'] = [];
                $array['arr_data_kelompok_bayar'] = [];

                if ($param == "SEMESTERAN") {

                    $current_year = date('Y');
                    $year = range($current_year, $current_year - 2);
                    $smt = array('Semester I', 'Semester II');


                    $datanya = $this->aspek_operasional_model->getdata('dashboard-smt-operasional', 'result_array', 'semester', '2');
                    foreach ($datanya as $key => $value) {
                        $array['arr_data'][] = (int)$value['jml_penerima'];
                        $array['arr_data_bayar'][] = (int)$value['jml_pembayaran'];
                        $array['arr_periode'][] = "Semester $value[semester] - $value[tahun] ";
                    }

                    $datanya2 = $this->aspek_operasional_model->getdata('dashboard-smt-jenis', 'result_array', 'semester', '2');
                    foreach ($datanya2 as $key => $value) {
                        $array['arr_jns'][] = $value['jenis_penerima'];
                        $array['arr_data_jns'][] = (int)$value['jml_penerima'];
                        $array['arr_data_jns_bayar'][] = (int)$value['jml_pembayaran'];
                    }

                    $datanya3 = $this->aspek_operasional_model->getdata('dashboard-smt-kelompok', 'result_array', 'semester', '2');
                    foreach ($datanya3 as $key => $value) {
                        $array['arr_kelompok'][] = $value['kelompok_penerima'];
                        $array['arr_data_kelompok'][] = (int)$value['jml_penerima'];
                        $array['arr_data_kelompok_bayar'][] = (int)$value['jml_pembayaran'];
                    }

                    $array['tot_pembayaran'] = rupiah(array_sum($array['arr_data_bayar']));
                    $array['tot_penerima'] = rupiah(array_sum($array['arr_data']));

                } elseif ($param == "TAHUNAN") {
                    $datanya = $this->aspek_operasional_model->getdata('dashboard-smt-operasional', 'result_array', 'tahunan', '2');
                    foreach ($datanya as $key => $value) {
                        $array['arr_data'][] = (int)$value['jml_penerima'];
                        $array['arr_data_bayar'][] = (int)$value['jml_pembayaran'];
                        $array['arr_periode'][] = "$value[tahun]";
                    }

                    $datanya2 = $this->aspek_operasional_model->getdata('dashboard-smt-jenis', 'result_array', 'tahunan', '2');
                    foreach ($datanya2 as $key => $value) {
                        $array['arr_jns'][] = $value['jenis_penerima'];
                        $array['arr_data_jns'][] = (int)$value['jml_penerima'];
                        $array['arr_data_jns_bayar'][] = (int)$value['jml_pembayaran'];
                    }

                    $datanya3 = $this->aspek_operasional_model->getdata('dashboard-smt-kelompok', 'result_array', 'tahunan', '2');
                    foreach ($datanya3 as $key => $value) {
                        $array['arr_kelompok'][] = $value['kelompok_penerima'];
                        $array['arr_data_kelompok'][] = (int)$value['jml_penerima'];
                        $array['arr_data_kelompok_bayar'][] = (int)$value['jml_pembayaran'];
                    }

                    $array['tot_pembayaran'] = rupiah(array_sum($array['arr_data_bayar']));
                    $array['tot_penerima'] = rupiah(array_sum($array['arr_data']));
                }

                echo json_encode($array);
                break;
        }
    }
}
