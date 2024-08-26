<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Printall extends CI_Controller {
	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('bulanan_model/printall_model');
		$this->load->model('bulanan_model/arus_kas_model');
        $this->load->model('bulanan_model/pendahuluan_model');
        $this->load->model('bulanan_model/perubahan_dana_bersih_model');
        $this->load->model('bulanan_model/dana_bersih_model');
        $this->load->model('bulanan_model/aset_investasi_model');
        $this->load->model('bulanan_model/lap_bukan_investasi_model');
        $this->load->model('bulanan_model/posisi_investasi_model');
        $this->load->model('bulanan_model/hasil_investasi_model');
        $this->load->model('bulanan_model/rincian_model');
        
        // $perubahan_dana_bersih = new Perubahan_dana_bersih();

    
		$this->load->library('form_validation');
		$this->load->library('user_agent');
		// $this->load->library('pdf');
		// $this->load->library('upload');
		// $this->load->helper('download');

		$this->bulan=$this->session->userdata("id_bulan");
		$this->iduser=$this->session->userdata("iduser");
		$this->tahun=$this->session->userdata("tahun");		
		$this->idusergroup=$this->session->userdata("idusergroup");
		//cek login
		if (! $this->session->userdata('isLoggedIn') ) redirect("login/show_login");
		$userData=$this->session->userdata();
		//cek akses route
		// if($userData['idusergroup'] !== '001') show_404();
		$this->page_limit = 20;
		
	}
	
	public function index(){

        $bln=$this->session->userdata('id_bulan');
        $data['data_invest'] = $this->aset_investasi_front();
        $data['data_pendahuluan'] = $this->pendahuluan_model->get_ket($bln);
        $data['sum'] = $this->aset_investasi_model->getdataindex('aset_investasi_front_sum', 'row_array', 'INVESTASI');
        $data['data_posisi_investasi_ket'] = $this->aset_investasi_model->get_ket('ket_aset_investasi');
        $data['bulan'] = bulan();
        $data['status'] = pendahuluan_bln();
        $data['opt_user'] = dtuser();
		
		$data['bread'] = array('header'=>'Print All ('.(isset($data['bulan'][0]->nama_bulan) ? $data['bulan'][0]->nama_bulan : '').' - '. $this->tahun.')', 'subheader'=>'Print All');
		$data['view']  = "bulanan/printall/input_print_all";
		$this->load->view('main/utama', $data);
	}

	function get_index($mod){
		switch($mod){
			case 'index-print_all':
            $data['iduser'] =  $this->input->post('iduser');
            $data['id_bulan'] = $this->input->post('id_bulan');


            $filter['iduser'] =  $data['iduser'];
            $filter['id_bulan'] = $data['id_bulan'];
            $filter['tahun'] = $this->tahun;
            $data['data_print_all'] = $this->printall_model->get_filter($filter);

            $data['opt_user'] = dtuser();
            $data['bulan'] = bulan();
            $data['bread'] = array('header'=>'Print All ('.(isset($data['bulan'][0]->nama_bulan) ? $data['bulan'][0]->nama_bulan : '').' - '. $this->tahun.')', 'subheader'=>'Print All');
		    $data['view']  = "bulanan/printall/input_print_all";

                // print_r($data['data_invest']);exit;
            break;
            // case 'index-pernyataan':
			// $data['iduser'] =  $this->input->post('iduser');
			// $data['id_bulan'] = $this->input->post('id_bulan');


			// $filter['iduser'] =  $data['iduser'];
            // $filter['id_bulan'] = $data['id_bulan'];
			// $filter['tahun'] = $this->tahun;
			// $data['data_ikhtisar_kinerja'] = $this->ikhtisar_kinerja_model->get_filter($filter);

			// $data['opt_user'] = dtuser();
			// $data['bulan'] = bulan();
			// $data['bread'] = array('header'=>'Surat Pernyataan ('.(isset($data['bulan'][0]->nama_bulan) ? $data['bulan'][0]->nama_bulan : '').' - '. $this->tahun.')', 'subheader'=>'Surat Pernyataan');
            // $data['view']  = "bulanan/ikhtisar_kinerja/input_pernyataan";
			// break;
		}

		$data['mod'] = $mod;
		$data['acak'] = md5(date('H:i:s'));
        // echo '<pre>';
        // print_r($data);exit;
		$dt = $this->load->view($data['view'], $data, TRUE);
		echo $dt;
	}
    

    function hasil_output($p1,$mod,$data_detail,$data,$filename="",$ukuran="A4",$template="",$footer="", $header=""){
        switch($p1){
            case "pdf":
                $pdf = new \Mpdf\Mpdf();
                $pdf->WriteHTML($template);
                $pdf->Output(); // Menyimpan file PDF dengan nama yang telah ditentukan
                break;
        }
    }

    public function generate_all_reports() {
        $data['iduser'] = $this->input->post('iduser');
        $data['bulan'] = bulan();
        $data['tahun'] = $this->tahun;
        $data['id_bulan'] = $this->bulan;
        //Dana Bersih
        $data['data_dana_bersih'] = $this->nilai_all_dana_bersih();
        $data['total_danabersih'] = $this->aset_investasi_model->getdata('dana_bersih_lv1','result');
        $data['data_dana_bersih_ket'] = $this->dana_bersih_model->get_ket('ket_dana_bersih');
        //Perubahan Dana Bersih
        $data['data_perubahan_danabersih'] = $this->nilai_perubahan_danabersih();
        $data['data_perubahan_dana_bersih_ket'] = $this->perubahan_dana_bersih_model->get_ket('ket_perubahan_dana_bersih');
        $data['tot_perubahan'] = $this->aset_investasi_model->getdata('perubahan_danabersih_lv1','result');
        $data['total_bersih'] = $this->aset_investasi_model->getdata('dana_bersih_lv0','result');
        //Aset Investasi
        $data['data_aset_investasi'] = $this->aset_investasi_front();
        $data['sum_aset_investasi'] = $this->aset_investasi_model->getdataindex('aset_investasi_front_sum', 'row_array', 'INVESTASI');
        //Aset Bukan Investasi
        $data['data_bukan_investasi'] = $this->aset_bukan_investasi_front();
        $data['sum_bukan_investasi'] = $this->aset_investasi_model->getdataindex('aset_investasi_front_sum', 'row_array', 'BUKAN INVESTASI');
        //Hasil Investasi
        $data['data_hasil_investasi'] = $this->hasil_investasi_front();
        $data['sum'] = $this->aset_investasi_model->getdataindex('aset_investasi_front_sum', 'row_array', 'HASIL INVESTASI');
        $data['data_hasil_investasi_ket'] = $this->hasil_investasi_model->get_ket('ket_hasil_investasi');
        //Beban Investasi
        $data['data_beban'] = $this->nilai_beban_investasi();
        $data['sum_beban_investasi'] = $this->perubahan_dana_bersih_model->getdata('aset_investasi_front_sum', 'row_array', 'BEBAN INVESTASI');
        //Arus Kas
        $data['arus_kas'] = $this->nilai_arus_kas();
        $data['kas_bank'] = $this->arus_kas_model->getdata('kas_bank', 'row_array');
        $data['data_arus_kas_ket'] = $this->arus_kas_model->get_ket('ket_arus_kas');
        //Pendahuluan
        $data['data_pendahuluan'] = $this->pendahuluan_model->get_ket($data['id_bulan'] );
        // $data['opt_user'] = dtuser();
        //Rincian
        $data['opt_user'] = dtuser();
        $data['rincian_invest'] = $this->rincian_model->getdata('rincian_investasi', 'result_array');
        $data['sum_invest'] = $this->rincian_model->getdata('sum_rincian_investasi', 'row_array');
        $data['persen_sum_invest'] = $this->persen_sum_invest($data['iduser']);

        $data['rincian_bkn_invest'] = $this->rincian_model->getdata('rincian_bkn_investasi', 'result_array');
        $data['sum_bkn_invest'] = $this->rincian_model->getdata('sum_rincian_bkn_investasi', 'row_array');
        $data['persen_sum_bkn_invest'] = $this->persen_sum_bkn_invest($data['iduser']);
        $data['data_rincian_ket'] = $this->rincian_model->get_ket('ket_rincian');

        if($data['iduser'] == ""){
            if($this->iduser == "TSN002"){
                $xtemplate=$this->load->view('bulanan/rincian/index_pdf_export_tsn', $data,true); 
            }else if ($this->iduser == "ASB003") {
                $xtemplate=$this->load->view('bulanan/rincian/index_pdf_export_asb', $data,true);
            }
        }else{
            if($data['iduser'] == "TSN002"){
                $xtemplate=$this->load->view('bulanan/rincian/index_pdf_export_tsn', $data,true); 
            }else if ($data['iduser'] == "ASB003") {
                $xtemplate=$this->load->view('bulanan/rincian/index_pdf_export_asb', $data,true);
            }
        }

        // $invest_template = $this->load->view('bulanan/aset_investasi/index_pdf_export2', $data, true);
        // $bukan_invest_template = $this->load->view('bulanan/bukan_investasi/index_pdf_export2', $data, true);
        // $danabersih_template = $this->load->view('bulanan/dana_bersih/index_pdf_export2', $data,true);
        // $perubahandanabersih_template = $this->load->view('bulanan/perubahan_dana_bersih/index_pdf_export2', $data, true);
        // $hasil_invest_template = $this->load->view('bulanan/hasil_investasi/index_pdf_export', $data, true);
        // $beban_invest_template = $this->load->view('bulanan/perubahan_dana_bersih/index_beban_pdf_export2', $data,true);  
        // $arus_kas_template = $this->load->view('bulanan/arus_kas/index_pdf_export2', $data,true);  
        // $pendahuluan_template = $this->load->view('bulanan/pendahuluan/index_pdf_export2', $data,true);
        // $rincian_template = $xtemplate;   

        $templates = $this->input->post('templates'); // Ambil pilihan dari checkbox

    // Inisialisasi semua template dengan string kosong
        $danabersih_template = '';
        $perubahandanabersih_template = '';
        $invest_template = '';
        $bukan_invest_template = '';
        $hasil_invest_template = '';
        $beban_invest_template = '';
        $arus_kas_template = '';
        $pendahuluan_template = '';
        $rincian_template = '';

        // Cek pilihan dan isi template yang sesuai
        if (in_array('danabersih', $templates)) {
            $danabersih_template = $this->load->view('bulanan/dana_bersih/index_pdf_export2', $data, true);
        }
        if (in_array('perubahandanabersih', $templates)) {
            $perubahandanabersih_template = $this->load->view('bulanan/perubahan_dana_bersih/index_pdf_export2', $data, true);
        }
        if (in_array('asetinvest', $templates)) {
            $invest_template = $this->load->view('bulanan/aset_investasi/index_pdf_export2', $data, true);
        }
        if (in_array('bukaninvest', $templates)) {
            $bukan_invest_template = $this->load->view('bulanan/bukan_investasi/index_pdf_export2', $data, true);
        }
        if (in_array('hasilinvest', $templates)) {
            $hasil_invest_template = $this->load->view('bulanan/hasil_investasi/index_pdf_export', $data, true);
        }
        if (in_array('bebaninvest', $templates)) {
            $beban_invest_template = $this->load->view('bulanan/perubahan_dana_bersih/index_beban_pdf_export2', $data, true);
        }
        if (in_array('aruskas', $templates)) {
            $arus_kas_template = $this->load->view('bulanan/arus_kas/index_pdf_export2', $data, true);
        }
        if (in_array('pendahuluan', $templates)) {
            $pendahuluan_template = $this->load->view('bulanan/pendahuluan/index_pdf_export2', $data, true);
        }
        if (in_array('rincian', $templates)) {
            $rincian_template = $this->load->view('bulanan/rincian/index_pdf_export_tsn', $data, true);
        }

            $combined_template = $danabersih_template . $perubahandanabersih_template . $invest_template . $bukan_invest_template . $hasil_invest_template . $beban_invest_template . $arus_kas_template . $pendahuluan_template . $rincian_template;

            $this->hasil_output('pdf', $mod, '', $data, '', "A4", $combined_template, "ya", "no");
    }
    
    public function persen_sum_invest($iduser){
    	$sum_invest = $this->rincian_model->getdata('sum_rincian_investasi', 'row_array');
    	$tot_pihak = $sum_invest['total_perpihak'] ;
    	$dt['deposito'] = ($tot_pihak!=0)?($sum_invest['deposito']/$tot_pihak)*100:0;
    	$dt['sertifikat_deposito'] = ($tot_pihak!=0)?($sum_invest['sertifikat_deposito']/$tot_pihak)*100:0;
    	$dt['sun'] = ($tot_pihak!=0)?($sum_invest['sun']/$tot_pihak)*100:0;
    	$dt['sukuk_pemerintah'] = ($tot_pihak!=0)?($sum_invest['sukuk_pemerintah']/$tot_pihak)*100:0;
    	$dt['obligasi_korporasi'] = ($tot_pihak!=0)?($sum_invest['obligasi_korporasi']/$tot_pihak)*100:0;
    	$dt['sukuk_korporasi'] = ($tot_pihak!=0)?($sum_invest['sukuk_korporasi']/$tot_pihak)*100:0;
    	$dt['obligasi_mata_uang'] = ($tot_pihak!=0)?($sum_invest['obligasi_mata_uang']/$tot_pihak)*100:0;
    	$dt['mtn'] = ($tot_pihak!=0)?($sum_invest['mtn']/$tot_pihak)*100:0;
    	$dt['saham'] = ($tot_pihak!=0)?($sum_invest['saham']/$tot_pihak)*100:0;
    	$dt['reksadana'] = ($tot_pihak!=0)?($sum_invest['reksadana']/$tot_pihak)*100:0;
    	$dt['dana_invest_kik'] = ($tot_pihak!=0)?($sum_invest['dana_invest_kik']/$tot_pihak)*100:0;
    	$dt['penyertaan_langsung'] = ($tot_pihak!=0)?($sum_invest['penyertaan_langsung']/$tot_pihak)*100:0;
    	$dt['reksadana_pasar_uang'] = ($tot_pihak!=0)?($sum_invest['reksadana_pasar_uang']/$tot_pihak)*100:0;
    	$dt['reksadana_pendapatan_tetap'] = ($tot_pihak!=0)?($sum_invest['reksadana_pendapatan_tetap']/$tot_pihak)*100:0;
    	$dt['reksadana_campuran'] = ($tot_pihak!=0)?($sum_invest['reksadana_campuran']/$tot_pihak)*100:0;
    	$dt['reksadana_saham'] = ($tot_pihak!=0)?($sum_invest['reksadana_saham']/$tot_pihak)*100:0;
    	$dt['reksadana_terproteksi'] = ($tot_pihak!=0)?($sum_invest['reksadana_terproteksi']/$tot_pihak)*100:0;
    	$dt['reksadana_pinjaman'] = ($tot_pihak!=0)?($sum_invest['reksadana_pinjaman']/$tot_pihak)*100:0;
    	$dt['reksadana_index'] = ($tot_pihak!=0)?($sum_invest['reksadana_index']/$tot_pihak)*100:0;
    	$dt['reksadana_kik'] = ($tot_pihak!=0)?($sum_invest['reksadana_kik']/$tot_pihak)*100:0;
    	$dt['reksadana_penyertaaan_diperdagangkan'] = ($tot_pihak!=0)?($sum_invest['reksadana_penyertaaan_diperdagangkan']/$tot_pihak)*100:0;
    	
    	if ($iduser != 'ASB003') {
    		$dt['tanah_bangunan'] = ($tot_pihak!=0)?($sum_invest['tanah_bangunan']/$tot_pihak)*100:0;
    	}

    	$dt['total_perpihak'] = array_sum($dt);

    	// echo '<pre>';
    	// print_r($dt);exit;
    	return $dt;
    }
    public function persen_sum_bkn_invest($iduser){
    	$sum_bkn_invest = $this->rincian_model->getdata('sum_rincian_bkn_investasi', 'row_array');
    	$tot_pihak = $sum_bkn_invest['total_perpihak'] ;
    	$dt['kas_bank'] = ($tot_pihak!=0)?($sum_bkn_invest['kas_bank']/$tot_pihak)*100:0;

    	$dt['piutang_iuran'] = ($tot_pihak!=0)?($sum_bkn_invest['piutang_iuran']/$tot_pihak)*100:0;
    	$dt['piutang_investasi'] = ($tot_pihak!=0)?($sum_bkn_invest['piutang_investasi']/$tot_pihak)*100:0;
    	$dt['piutang_hasil_invest'] = ($tot_pihak!=0)?($sum_bkn_invest['piutang_hasil_invest']/$tot_pihak)*100:0;
    	$dt['piutang_lainnya'] = ($tot_pihak!=0)?($sum_bkn_invest['piutang_lainnya']/$tot_pihak)*100:0;
    	$dt['piutang_biaya_konpensasi_bank'] = ($tot_pihak!=0)?($sum_bkn_invest['piutang_biaya_konpensasi_bank']/$tot_pihak)*100:0;
    	$dt['uangmuka_pph'] = ($tot_pihak!=0)?($sum_bkn_invest['uangmuka_pph']/$tot_pihak)*100:0;
    	$dt['piutang_pihak_ketiga'] = ($tot_pihak!=0)?($sum_bkn_invest['piutang_pihak_ketiga']/$tot_pihak)*100:0;
    	$dt['piutang_denda'] = ($tot_pihak!=0)?($sum_bkn_invest['piutang_denda']/$tot_pihak)*100:0;
    	$dt['cadangan_penyisihan'] = ($tot_pihak!=0)?($sum_bkn_invest['cadangan_penyisihan']/$tot_pihak)*100:0;
    	$dt['bangunan'] = ($tot_pihak!=0)?($sum_bkn_invest['bangunan']/$tot_pihak)*100:0;
    	$dt['tanah_bangunan'] = ($tot_pihak!=0)?($sum_bkn_invest['tanah_bangunan']/$tot_pihak)*100:0;
    	$dt['aset_lainnya'] = ($tot_pihak!=0)?($sum_bkn_invest['aset_lainnya']/$tot_pihak)*100:0;
    	$dt['kendaraan'] = ($tot_pihak!=0)?($sum_bkn_invest['kendaraan']/$tot_pihak)*100:0;
    	$dt['komputer'] = ($tot_pihak!=0)?($sum_bkn_invest['komputer']/$tot_pihak)*100:0;
    	$dt['inventaris_kantor'] = ($tot_pihak!=0)?($sum_bkn_invest['inventaris_kantor']/$tot_pihak)*100:0;

    	$dt['hak_guna_bangunan'] = ($tot_pihak!=0)?($sum_bkn_invest['hak_guna_bangunan']/$tot_pihak)*100:0;
    	$dt['aset_tdk_berwujud'] = ($tot_pihak!=0)?($sum_bkn_invest['aset_tdk_berwujud']/$tot_pihak)*100:0;
    	$dt['aset_tetap'] = ($tot_pihak!=0)?($sum_bkn_invest['aset_tetap']/$tot_pihak)*100:0;
    	$dt['inventaris_kantor'] = ($tot_pihak!=0)?($sum_bkn_invest['inventaris_kantor']/$tot_pihak)*100:0;

    	if ($iduser == 'ASB003') {
    		$dt['piutang_bum_kpr'] = ($tot_pihak!=0)?($sum_bkn_invest['piutang_bum_kpr']/$tot_pihak)*100:0;
    		$dt['piutang_pum_kpr'] = ($tot_pihak!=0)?($sum_bkn_invest['piutang_pum_kpr']/$tot_pihak)*100:0;
    	}
    	
    	$dt['total_perpihak'] = array_sum($dt);

    	// echo '<pre>';
    	// print_r($dt);exit;
    	return $dt;
    }

    public function nilai_beban_investasi(){
        $param_jenis = 'BEBAN INVESTASI';
        $array = array();
        $invest = $this->aset_investasi_model->getdataindex('aset_investasi_front','result_array', $param_jenis);

        foreach ($invest as $k => $v) {
            $array[$k]['id'] = $v['id'];
            $array[$k]['id_investasi'] = $v['id_investasi'];
            $array[$k]['jenis_investasi'] = $v['jenis_investasi'];
            $array[$k]['saldo_akhir'] = (isset($v['saldo_akhir']) ? $v['saldo_akhir'] : 0) ;
            $array[$k]['saldo_awal'] = (isset($v['saldo_awal']) ? $v['saldo_awal'] : 0) ;
            $array[$k]['rka'] = $v['rka'];
            $pers_rka= ($v['rka']!=0)?($v['saldo_akhir']/$v['rka'])*100:0;
            $array[$k]['pers_rka'] = $pers_rka;
            $array[$k]['type'] = $v['type'];
            $array[$k]['nominal'] = $v['saldo_akhir'] - $v['saldo_awal'];
            $min1 = $v['saldo_akhir'] - $v['saldo_awal'];
            $array[$k]['persentase'] =($v['saldo_awal']!=0)?($min1/$v['saldo_awal'])*100:0;
            $array[$k]['jns_form'] = $v['jns_form'];
            $array[$k]['child'] = array();
            if($v['type'] == "PC"){
                $childinvest = $this->aset_investasi_model->getdataindex('aset_investasi_front_lv2','result_array', $v['id_investasi'], $param_jenis);
                foreach ($childinvest as $key => $val) {
                    $array[$k]['child'][$key]['id'] = $val['id'];
                    $array[$k]['child'][$key]['id_investasi'] = $val['id_investasi'];
                    $array[$k]['child'][$key]['jenis_investasi'] = $val['jenis_investasi'];
                    $array[$k]['child'][$key]['saldo_awal'] =  (isset($val['saldo_awal']) ? $val['saldo_awal'] : 0) ;
                    $array[$k]['child'][$key]['saldo_akhir'] = (isset($val['saldo_akhir']) ? $val['saldo_akhir'] : 0) ;
                    $array[$k]['child'][$key]['rka'] = $val['rka'];
                    $pers_rka1= ($val['rka']!=0)?($val['saldo_akhir']/$val['rka'])*100:0;
                    $array[$k]['child'][$key]['pers_rka'] = $pers_rka1;
                    $array[$k]['child'][$key]['type'] = $val['type'];
                    $array[$k]['child'][$key]['nominal'] = $val['saldo_akhir'] - $val['saldo_awal'];
                    $min2 = $val['saldo_akhir'] - $val['saldo_awal'];
                    $array[$k]['child'][$key]['persentase'] = ($val['saldo_awal']!=0)?($min2/$val['saldo_awal'])*100:0;
                    $array[$k]['child'][$key]['jns_form'] = $val['jns_form'];
                    $array[$k]['child'][$key]['subchild'] = array();

                    if($val['type'] == "PC"){
                        $childinvestlv3 = $this->aset_investasi_model->getdataindex('aset_investasi_front_lv3','result_array', $val['id_investasi'], $param_jenis);
                        foreach ($childinvestlv3 as $x => $y) {
                            $array[$k]['child'][$key]['subchild'][$x]['id'] = $y['id'];
                            $array[$k]['child'][$key]['subchild'][$x]['id_investasi'] = $y['id_investasi'];
                            $array[$k]['child'][$key]['subchild'][$x]['jenis_investasi'] = $y['jenis_investasi'];
                            $array[$k]['child'][$key]['subchild'][$x]['saldo_awal'] = (isset($y['saldo_awal']) ? $y['saldo_awal'] : 0);
                            $array[$k]['child'][$key]['subchild'][$x]['saldo_akhir'] = (isset($y['saldo_akhir']) ? $y['saldo_akhir'] : 0);
                            $array[$k]['child'][$key]['subchild'][$x]['rka'] = $y['rka'];
                            $pers_rka2= ($y['rka']!=0)?($y['saldo_akhir']/$y['rka'])*100:0;
                            $array[$k]['child'][$key]['subchild'][$x]['pers_rka'] = $pers_rka2;
                            $array[$k]['child'][$key]['subchild'][$x]['type'] = $y['type'];
                            $array[$k]['child'][$key]['subchild'][$x]['nominal'] = $y['saldo_akhir'] - $y['saldo_awal'];
                            $min3 = $y['saldo_akhir'] - $y['saldo_awal'];
                            $array[$k]['child'][$key]['subchild'][$x]['persentase'] =  ($y['saldo_awal']!=0)?($min3/$y['saldo_awal'])*100:0;
                            $array[$k]['child'][$key]['subchild'][$x]['jns_form'] = $y['jns_form'];
                        }
                    }
                }
            }
        }

        // echo '<pre>';
        // print_r($array);exit;
        return $array;
    }

    public function nilai_all_dana_bersih(){
        $array = array();
        $dana_bersih_lv1 = $this->aset_investasi_model->getdata('dana_bersih_lv1','result_array');
        foreach ($dana_bersih_lv1 as $k => $v) {

            if($v['jenis_laporan'] == 'ASET'){
                $judul_total = 'TOTAL ASET';
                $judul_head = 'ASET';
            }else if($v['jenis_laporan'] == 'KEWAJIBAN'){
                $judul_total = 'TOTAL KEWAJIBAN';
                $judul_head = 'KEWAJIBAN';
            }

            $array[$k]['jenis_laporan'] = $judul_head;
            $array[$k]['total'] = $judul_total;
            $array[$k]['sum_lvl1'] =  (isset($v['saldo_akhir']) ? $v['saldo_akhir'] : 0) ;
            $array[$k]['sum_prev_lvl1'] =  (isset($v['saldo_akhir_bln_lalu']) ? $v['saldo_akhir_bln_lalu'] : 0) ;
            $array[$k]['child'] = array();

            $dana_bersih_lv2 = $this->aset_investasi_model->getdata('dana_bersih_lv2','result_array', $v['jenis_laporan']);
            foreach ($dana_bersih_lv2 as $key => $val) {
                if($val['uraian'] == 'ASET INVESTASI'){
                    $judul_total = 'Total Aset Dalam Bentuk Investasi';
                    $judul_head = 'DALAM BENTUK INVESTASI';
                }else if($val['uraian'] == 'ASET BUKAN INVESTASI'){
                    $judul_total = 'Total Aset Bukan Investasi';
                    $judul_head = 'DALAM BENTUK BUKAN INVESTASI';
                }else if($val['uraian'] == 'KEWAJIBAN'){
                    $judul_total = 'Total Kewajiban';
                    $judul_head = 'KEWAJIBAN';
                }

                $array[$k]['child'][$key]['id_dana_bersih'] = $val['id_dana_bersih'];
                $array[$k]['child'][$key]['uraian'] = $val['uraian'];
                $array[$k]['child'][$key]['judul_total'] = $judul_total;
                $array[$k]['child'][$key]['judul_head'] = $judul_head;
                $array[$k]['child'][$key]['sum_lvl2'] =  (isset($val['saldo_akhir']) ? $val['saldo_akhir'] : 0) ;
                $array[$k]['child'][$key]['sum_prev_lvl2'] =  (isset($val['saldo_akhir_bln_lalu']) ? $val['saldo_akhir_bln_lalu'] : 0) ;
                $array[$k]['child'][$key]['subchild'] = array();

                $dana_bersih_lv3 = $this->aset_investasi_model->getdata('dana_bersih_lv3','result_array', $val['id_dana_bersih']);
                foreach ($dana_bersih_lv3 as $x => $y) {
                    $array[$k]['child'][$key]['subchild'][$x]['type'] = $y['type_sub_jenis_investasi'];
                    $array[$k]['child'][$key]['subchild'][$x]['id_investasi'] = $y['id_investasi'];
                    $array[$k]['child'][$key]['subchild'][$x]['jenis_investasi'] = $y['jenis_investasi'];
                    $array[$k]['child'][$key]['subchild'][$x]['saldo_akhir'] = (isset($y['saldo_akhir']) ? $y['saldo_akhir'] : 0) ;
                    $array[$k]['child'][$key]['subchild'][$x]['saldo_akhir_bln_lalu'] = (isset($y['saldo_akhir_bln_lalu']) ? $y['saldo_akhir_bln_lalu'] : 0) ;
                    $array[$k]['child'][$key]['subchild'][$x]['subchild_sub'] =  array();
                   
                    if($y['type_sub_jenis_investasi'] == 'PC'){
                        $type = 'C';
                        $dana_bersih_lv4 = $this->aset_investasi_model->getdata('dana_bersih_lv4','result_array', $y['id_investasi'], $type);
                        foreach ($dana_bersih_lv4 as $xx => $zz) {
                            $array[$k]['child'][$key]['subchild'][$x]['subchild_sub'][$xx]['type'] = $zz['type_sub_jenis_investasi'];
                            $array[$k]['child'][$key]['subchild'][$x]['subchild_sub'][$xx]['id_investasi'] = $zz['id_investasi'];
                            $array[$k]['child'][$key]['subchild'][$x]['subchild_sub'][$xx]['jenis_investasi'] = $zz['jenis_investasi'];
                            $array[$k]['child'][$key]['subchild'][$x]['subchild_sub'][$xx]['saldo_akhir'] = (isset($zz['saldo_akhir']) ? $zz['saldo_akhir'] : 0) ;
                            $array[$k]['child'][$key]['subchild'][$x]['subchild_sub'][$xx]['saldo_akhir_bln_lalu'] = (isset($zz['saldo_akhir_bln_lalu']) ? $zz['saldo_akhir_bln_lalu'] : 0) ;
                        }
                    }

                }
            }
        }
        // echo '<pre>';
        // print_r($array);exit;
        return $array;

        // $data['bread'] = array('header'=>'Arus Kas', 'subheader'=>'Arus Kas');
        // $data['view']  = "bulanan/arus_kas/data_aruskas";
        // $this->load->view('main/utama', $data);
    }
    
    public function nilai_perubahan_danabersih(){
        $array = array();
        $perubahan_lv1 = $this->aset_investasi_model->getdata('perubahan_danabersih_lv1','result_array');
        foreach ($perubahan_lv1 as $k => $v) {

            if($v['uraian'] == 'PENAMBAHAN'){
                $judul_total = 'Jumlah Penambahan';
                $judul_head = 'PENAMBAHAN';
            }else if($v['uraian'] == 'PENGURANGAN'){
                $judul_total = 'Jumlah Pengurangan';
                $judul_head = 'PENGURANGAN';
            }

            $array[$k]['judul_head'] = $judul_head;
            $array[$k]['judul_total'] = $judul_total;
            $array[$k]['uraian'] = $v['uraian'];
            $array[$k]['sum_lvl1'] =  (isset($v['saldo_akhir']) ? $v['saldo_akhir'] : 0) ;
            $array[$k]['sum_prev_lvl1'] =  (isset($v['saldo_akhir_bln_lalu']) ? $v['saldo_akhir_bln_lalu'] : 0) ;
            $array[$k]['child'] = array();

            $perubahan_lv2 = $this->aset_investasi_model->getdata('perubahan_danabersih_lv2','result_array', $v['uraian']);
            foreach ($perubahan_lv2 as $key => $val) {
                if($val['group'] == 'BEBAN'){
                    $judul_total = 'Total Beban';
                    $judul_head = 'BEBAN';
                }else if($val['group'] == 'HASIL INVESTASI'){
                    $judul_total = 'Total Hasil Investasi';
                    $judul_head = 'HASIL INVESTASI';
                }else if($val['group'] == 'IURAN'){
                    $judul_total = 'Total Iuran';
                    $judul_head = 'IURAN';
                }else if($val['group'] == 'NILAI INVESTASI'){
                    $judul_total = 'Jumlah Peningkatan(Penurunan)';
                    $judul_head = 'NILAI INVESTASI';
                }else if($val['group'] == 'ASET TETAP'){
                    $judul_total = 'Sub Jumlah Aset Tetap';
                    $judul_head = 'ASET TETAP';
                }

                $array[$k]['child'][$key]['judul_head'] =  $judul_head;
                $array[$k]['child'][$key]['judul_total'] = $judul_total;
                $array[$k]['child'][$key]['id_perubahan_dana_bersih'] = $val['id_perubahan_dana_bersih'];
                $array[$k]['child'][$key]['group'] = $val['group'];
                $array[$k]['child'][$key]['sum_lvl2'] =  (isset($val['saldo_akhir']) ? $val['saldo_akhir'] : 0) ;
                $array[$k]['child'][$key]['sum_prev_lvl2'] =  (isset($val['saldo_akhir_bln_lalu']) ? $val['saldo_akhir_bln_lalu'] : 0) ;
                $array[$k]['child'][$key]['subchild'] = array();

                $perubahan_lv3 = $this->aset_investasi_model->getdata('perubahan_danabersih_lv3','result_array', $val['group']);
                foreach ($perubahan_lv3 as $x => $y) {
                    $array[$k]['child'][$key]['subchild'][$x]['type'] = $y['type'];
                    $array[$k]['child'][$key]['subchild'][$x]['id_investasi'] = $y['id_investasi'];
                    $array[$k]['child'][$key]['subchild'][$x]['jenis_investasi'] = $y['jenis_investasi'];
                    $array[$k]['child'][$key]['subchild'][$x]['saldo_akhir'] = (isset($y['saldo_akhir']) ? $y['saldo_akhir'] : 0) ;
                    $array[$k]['child'][$key]['subchild'][$x]['saldo_akhir_bln_lalu'] = (isset($y['saldo_akhir_bln_lalu']) ? $y['saldo_akhir_bln_lalu'] : 0) ;
                    $array[$k]['child'][$key]['subchild'][$x]['subchild_sub'] =  array();
                   
                    if($y['type'] == 'PC'){
                        $type = 'C';
                        $perubahan_lv4 = $this->aset_investasi_model->getdata('perubahan_danabersih_lv4','result_array', $y['id_investasi'], $type);
                        foreach ($perubahan_lv4 as $xx => $zz) {
                            $array[$k]['child'][$key]['subchild'][$x]['subchild_sub'][$xx]['type'] = $zz['type'];
                            $array[$k]['child'][$key]['subchild'][$x]['subchild_sub'][$xx]['id_investasi'] = $zz['id_investasi'];
                            $array[$k]['child'][$key]['subchild'][$x]['subchild_sub'][$xx]['jenis_investasi'] = $zz['jenis_investasi'];
                            $array[$k]['child'][$key]['subchild'][$x]['subchild_sub'][$xx]['saldo_akhir'] = (isset($zz['saldo_akhir']) ? $zz['saldo_akhir'] : 0) ;
                            $array[$k]['child'][$key]['subchild'][$x]['subchild_sub'][$xx]['saldo_akhir_bln_lalu'] = (isset($zz['saldo_akhir_bln_lalu']) ? $zz['saldo_akhir_bln_lalu'] : 0) ;
                        }
                    }

                }
            }
        }
        // echo '<pre>';
        // print_r($array);exit;
        return $array;
    }
    public function hasil_investasi_front()
    {
        $param_jenis = 'HASIL INVESTASI';
        $array = array();
        $invest = $this->aset_investasi_model->getdataindex('aset_investasi_front', 'result_array', $param_jenis);

        foreach ($invest as $k => $v) {
            $array[$k]['id'] = $v['id'];
            $array[$k]['id_investasi'] = $v['id_investasi'];
            $array[$k]['jenis_investasi'] = $v['jenis_investasi'];
            $array[$k]['saldo_awal'] = $v['saldo_awal'];
            $array[$k]['saldo_akhir'] = $v['saldo_akhir'];
            $array[$k]['mutasi'] = $v['mutasi'];
            $array[$k]['rka'] = $v['rka'];
            $array[$k]['realisasi_rka'] = $v['realisasi_rka'];
            $array[$k]['target_yoi'] = $v['target_yoi'];
            $array[$k]['type'] = $v['type'];
            $array[$k]['jns_form'] = $v['jns_form'];
            $array[$k]['filedata'] = $v['filedata'];
            $array[$k]['child'] = array();
            if ($v['type'] == "PC") {
                $childinvest = $this->aset_investasi_model->getdataindex('aset_investasi_front_lv2', 'result_array', $v['id_investasi'], $param_jenis);
                foreach ($childinvest as $key => $val) {
                    $array[$k]['child'][$key]['id'] = $val['id'];
                    $array[$k]['child'][$key]['id_investasi'] = $val['id_investasi'];
                    $array[$k]['child'][$key]['jenis_investasi'] = $val['jenis_investasi'];
                    $array[$k]['child'][$key]['saldo_awal'] = $val['saldo_awal'];
                    $array[$k]['child'][$key]['saldo_akhir'] = $val['saldo_akhir'];
                    $array[$k]['child'][$key]['mutasi'] = $val['mutasi'];
                    $array[$k]['child'][$key]['rka'] = $val['rka'];
                    $array[$k]['child'][$key]['realisasi_rka'] = $val['realisasi_rka'];
                    $array[$k]['child'][$key]['target_yoi'] = $val['target_yoi'];
                    $array[$k]['child'][$key]['type'] = $val['type'];
                    $array[$k]['child'][$key]['jns_form'] = $val['jns_form'];
                    $array[$k]['child'][$key]['filedata'] = $val['filedata'];
                    $array[$k]['child'][$key]['subchild'] = array();

                    if ($val['type'] == "PC") {
                        $childinvestlv3 = $this->aset_investasi_model->getdataindex('aset_investasi_front_lv3', 'result_array', $val['id_investasi'], $param_jenis);
                        foreach ($childinvestlv3 as $x => $y) {
                            $array[$k]['child'][$key]['subchild'][$x]['id'] = $y['id'];
                            $array[$k]['child'][$key]['subchild'][$x]['id_investasi'] = $y['id_investasi'];
                            $array[$k]['child'][$key]['subchild'][$x]['jenis_investasi'] = $y['jenis_investasi'];
                            $array[$k]['child'][$key]['subchild'][$x]['saldo_awal'] = $y['saldo_awal'];
                            $array[$k]['child'][$key]['subchild'][$x]['saldo_akhir'] = $y['saldo_akhir'];
                            $array[$k]['child'][$key]['subchild'][$x]['mutasi'] = $y['mutasi'];
                            $array[$k]['child'][$key]['subchild'][$x]['rka'] = $y['rka'];
                            $array[$k]['child'][$key]['subchild'][$x]['realisasi_rka'] = $y['realisasi_rka'];
                            $array[$k]['child'][$key]['subchild'][$x]['target_yoi'] = $y['target_yoi'];
                            $array[$k]['child'][$key]['subchild'][$x]['jns_form'] = $y['jns_form'];
                            $array[$k]['child'][$key]['subchild'][$x]['filedata'] = $y['filedata'];
                        }
                    }
                }
            }
        }

        // echo '<pre>';
        // print_r($array);exit;
        return $array;
    }
    public function aset_investasi_front(){
        $param_jenis = 'INVESTASI';
        $array = array();
        $invest = $this->aset_investasi_model->getdataindex('aset_investasi_front','result_array', $param_jenis);

        foreach ($invest as $k => $v) {
            $array[$k]['id'] = $v['id'];
            $array[$k]['id_investasi'] = $v['id_investasi'];
            $array[$k]['jenis_investasi'] = $v['jenis_investasi'];
            $array[$k]['saldo_awal'] = $v['saldo_awal'];
            $array[$k]['saldo_akhir'] = $v['saldo_akhir'];
            $array[$k]['mutasi'] = $v['mutasi'];
            $array[$k]['rka'] = $v['rka'];
            $array[$k]['realisasi_rka'] = $v['realisasi_rka'];
            $array[$k]['type'] = $v['type'];
            $array[$k]['jns_form'] = $v['jns_form'];
            $array[$k]['child'] = array();
            if($v['type'] == "PC"){
                $childinvest = $this->aset_investasi_model->getdataindex('aset_investasi_front_lv2','result_array', $v['id_investasi'], $param_jenis);
                foreach ($childinvest as $key => $val) {
                    $array[$k]['child'][$key]['id'] = $val['id'];
                    $array[$k]['child'][$key]['id_investasi'] = $val['id_investasi'];
                    $array[$k]['child'][$key]['jenis_investasi'] = $val['jenis_investasi'];
                    $array[$k]['child'][$key]['saldo_awal'] = $val['saldo_awal'];
                    $array[$k]['child'][$key]['saldo_akhir'] = $val['saldo_akhir'];
                    $array[$k]['child'][$key]['mutasi'] = $val['mutasi'];
                    $array[$k]['child'][$key]['rka'] = $val['rka'];
                    $array[$k]['child'][$key]['realisasi_rka'] = $val['realisasi_rka'];
                    $array[$k]['child'][$key]['type'] = $val['type'];
                    $array[$k]['child'][$key]['jns_form'] = $val['jns_form'];
                    $array[$k]['child'][$key]['subchild'] = array();

                    if($val['type'] == "PC"){
                        $childinvestlv3 = $this->aset_investasi_model->getdataindex('aset_investasi_front_lv3','result_array', $val['id_investasi'], $param_jenis);
                        foreach ($childinvestlv3 as $x => $y) {
                            $array[$k]['child'][$key]['subchild'][$x]['id'] = $y['id'];
                            $array[$k]['child'][$key]['subchild'][$x]['id_investasi'] = $y['id_investasi'];
                            $array[$k]['child'][$key]['subchild'][$x]['jenis_investasi'] = $y['jenis_investasi'];
                            $array[$k]['child'][$key]['subchild'][$x]['saldo_awal'] = $y['saldo_awal'];
                            $array[$k]['child'][$key]['subchild'][$x]['saldo_akhir'] = $y['saldo_akhir'];
                            $array[$k]['child'][$key]['subchild'][$x]['mutasi'] = $y['mutasi'];
                            $array[$k]['child'][$key]['subchild'][$x]['rka'] = $y['rka'];
                            $array[$k]['child'][$key]['subchild'][$x]['realisasi_rka'] = $y['realisasi_rka'];
                            $array[$k]['child'][$key]['subchild'][$x]['jns_form'] = $y['jns_form'];
                        }
                    }
                }
            }
        }

        // echo '<pre>';
        // print_r($array);exit;
        return $array;
    }
    public function aset_bukan_investasi_front(){
        $param_jenis = 'BUKAN INVESTASI';
        $array = array();
        $invest = $this->aset_investasi_model->getdataindex('aset_investasi_front','result_array', $param_jenis);

        foreach ($invest as $k => $v) {
            $array[$k]['id'] = $v['id'];
            $array[$k]['id_investasi'] = $v['id_investasi'];
            $array[$k]['jenis_investasi'] = $v['jenis_investasi'];
            $array[$k]['saldo_awal'] = $v['saldo_awal'];
            $array[$k]['saldo_akhir'] = $v['saldo_akhir'];
            $array[$k]['mutasi'] = $v['mutasi'];
            $array[$k]['rka'] = $v['rka'];
            $array[$k]['realisasi_rka'] = $v['realisasi_rka'];
            $array[$k]['type'] = $v['type'];
            $array[$k]['jns_form'] = $v['jns_form'];
            $array[$k]['child'] = array();
            if($v['type'] == "PC"){
                $childinvest = $this->aset_investasi_model->getdataindex('aset_investasi_front_lv2','result_array', $v['id_investasi'], $param_jenis);
                foreach ($childinvest as $key => $val) {
                    $array[$k]['child'][$key]['id'] = $val['id'];
                    $array[$k]['child'][$key]['id_investasi'] = $val['id_investasi'];
                    $array[$k]['child'][$key]['jenis_investasi'] = $val['jenis_investasi'];
                    $array[$k]['child'][$key]['saldo_awal'] = $val['saldo_awal'];
                    $array[$k]['child'][$key]['saldo_akhir'] = $val['saldo_akhir'];
                    $array[$k]['child'][$key]['mutasi'] = $val['mutasi'];
                    $array[$k]['child'][$key]['rka'] = $val['rka'];
                    $array[$k]['child'][$key]['realisasi_rka'] = $val['realisasi_rka'];
                    $array[$k]['child'][$key]['type'] = $val['type'];
                    $array[$k]['child'][$key]['jns_form'] = $val['jns_form'];
                    $array[$k]['child'][$key]['subchild'] = array();

                    if($val['type'] == "PC"){
                        $childinvestlv3 = $this->aset_investasi_model->getdataindex('aset_investasi_front_lv3','result_array', $val['id_investasi'], $param_jenis);
                        foreach ($childinvestlv3 as $x => $y) {
                            $array[$k]['child'][$key]['subchild'][$x]['id'] = $y['id'];
                            $array[$k]['child'][$key]['subchild'][$x]['id_investasi'] = $y['id_investasi'];
                            $array[$k]['child'][$key]['subchild'][$x]['jenis_investasi'] = $y['jenis_investasi'];
                            $array[$k]['child'][$key]['subchild'][$x]['saldo_awal'] = $y['saldo_awal'];
                            $array[$k]['child'][$key]['subchild'][$x]['saldo_akhir'] = $y['saldo_akhir'];
                            $array[$k]['child'][$key]['subchild'][$x]['mutasi'] = $y['mutasi'];
                            $array[$k]['child'][$key]['subchild'][$x]['rka'] = $y['rka'];
                            $array[$k]['child'][$key]['subchild'][$x]['realisasi_rka'] = $y['realisasi_rka'];
                            $array[$k]['child'][$key]['subchild'][$x]['jns_form'] = $y['jns_form'];
                        }
                    }
                }
            }
        }

        // echo '<pre>';
        // print_r($array);exit;
        return $array;
    }
    // public function generate_all_reports() {
    //     // Ambil data dari tabel bln_checkbox_lap yang is_checked = 1
    //     // $checked_reports = $this->printall_model->get_checked_reports();
    
    //     // Loop melalui data dan panggil fungsi cetak PDF sesuai centangannya
    //     // foreach ($checked_reports as $report) {
    //     //     $mod = $report->Id_Checkbox; // Gantilah ini dengan nama field yang sesuai
    //         // $this->call_pdf_function($report_name);
    //         switch ($mod) {
    //             case "Lap_ArusKas":
    //                 $this->laporan_ArusKas_PDF();
    //                 break;
    //             case "Lap_AsetInvestasi":
    //                 $this->laporan_AsetInvestasi_PDF();
    //                 break;
    //             case "Lap_BebanInvestasi":
    //                 $this->laporan_BebanInvestasi_PDF();
    //                 break;
    //             case "Lap_BukanInvestasi":
    //                 $this->laporan_BukanInvestasi_PDF();
    //                 break;
    //             case "Lap_DanaBersih":
    //                 $this->laporan_DanaBersih_PDF();
    //                 break;
    //             case "Lap_HasilInvestasi":
    //                 $this->laporan_HasilInvestasi_PDF();
    //                 break;
    //             case "Lap_IkhtisarKinerja":
    //                 $this->laporan_DanaBersih_PDF();
    //                 break;
    //             case "Lap_Pendahuluan":
    //                 $this->laporan_Pendahuluan_PDF();
    //                 break;
    //             case "Lap_Pernyataan":
    //                 $this->laporan_Pernyataan_PDF();
    //                 break;
    //             case "Lap_PerubahanDanaBersih":
    //                 $this->laporan_PerubahanDanaBersih_PDF();
    //                 break;
    //             case "Lap_Rincian":
    //                 $this->laporan_Rincian_PDF();
    //                 break;
    //             // Tambahkan kasus lainnya sesuai dengan nama laporan yang sesuai
    //             default:
    //                 // Handle jika nama laporan tidak dikenali
    //                 break;
    //         }
    //     // }
    
    //     // Setelah semua laporan dibuat, gabungkan PDF-nya menjadi satu file
    //     $this->merge_pdfs();
    
    //     // Download file PDF yang sudah digabungkan
    //     // ... (gunakan metode yang sesuai untuk mengirimkan PDF ke pengguna)
    // }
    

    // function generate_AllPDF_Preview(){
    //     // Mendefinisikan daftar fungsi yang akan digunakan untuk menghasilkan laporan PDF
    //     $pdf_functions = array(
    //         'laporan_ArusKas_PDF',
    //         'laporan_AsetInvestasi_PDF',
    //         'laporan_BebanInvestasi_PDF',
    //         'laporan_BukanInvestasi_PDF',
    //         'laporan_DanaBersih_PDF',
    //         'laporan_HasilInvestasi_PDF',
    //         'laporan_Pendahuluan_PDF',
    //         'laporan_PerubahanDanaBersih_PDF',
    //         'laporan_Rincian_PDF'
    //     );
    
        
    //     // Menginisialisasi objek Mpdf
    //     $pdf = new \Mpdf\Mpdf();

    //     // Meloop melalui setiap fungsi laporan PDF
    //     foreach($pdf_functions as $pdf_function){
    //         // Memanggil fungsi laporan PDF
    //         $this->$pdf_function();
        
    //         // Mengambil isi output dari fungsi laporan PDF
    //         $output = $this->output->get_output();
            
    //         // Menambahkan halaman baru setelah setiap laporan PDF
    //         if($pdf_function !== reset($pdf_functions)){
    //             $pdf->AddPage();
    //         }
            
    //         // Menambahkan isi output ke PDF saat ini
    //         $pdf->WriteHTML($output);
    //     }

    //     // Membuat file PDF dan menampilkan preview
    //     $pdf->Output('preview.pdf', 'I');

    // }
    

	public function save(){
		$id_bulan = $this->session->userdata('id_bulan');
        $tahun = $this->session->userdata('tahun');
        $level = $this->session->userdata('level');

        $path = $_FILES['filedata']['name']; // file means your input type file name
        $ext = pathinfo($path, PATHINFO_EXTENSION);

        // if ( !file_exists($path))
        // {
        //     $this->session->set_flashdata('form_true',
        //         '<div class="alert alert-danger">
        //         <h4>GAGAL UPLOUD.</h4>
        //         <p>File upload tidak boleh kosong</p>
        //         </div>');
        //     redirect ($this->agent->referrer());
        //     return false;
        // }
        if ($ext=="pdf" OR $ext=="doc" OR $ext=="docx" OR $ext=="") {
            $upload_path   = './files/file_bulanan/ikhtisar_kinerja/'; //path folder
            $data['filedata_lama'] = escape($this->input->post('filedata_lama'));
            $data['nmdoc'] = escape($this->input->post('nmdok'));

            if(!empty($_FILES['filedata']['name'])){                  
                if(isset($data["filedata_lama"])){
                    if($data["filedata_lama"] != ""){
                        unlink($upload_path.$data["filedata_lama"]);
                    }
                }

                $file_data = $data['nmdoc'].'_'.$id_bulan.'_'.$tahun.'_'.$level;
                $filename_data =  $this->lib->uploadnong($upload_path, 'filedata', $file_data);
            }else{
                $filename_data = (isset($data["filedata_lama"]) ? $data["filedata_lama"] : null );
            }

            $data["file_lap"] = $filename_data;
            unset($data["filedata_lama"]);
            unset($data["upload_path_lama"]);
            unset($data["nmdoc"]);

            $data['id']                     = $this->input->post('id');
            $data['id_bulan']               = $this->bulan;
            $data['iduser']                 = $this->session->userdata('iduser');
            $data['tahun']                  = $this->session->userdata('tahun');
            $data['jenis_lap']              = $this->input->post('jenis_lap');
            $data['insert_at']              = date("Y-m-d H:i:s");


            $this->ikhtisar_kinerja_model->delete_ket($id_bulan);
            $this->ikhtisar_kinerja_model->insert_ket($data);

            $this->session->set_flashdata('form_true',
                '<div class="alert alert-success">
                <h4>Berhasil.</h4>
                <p>Data keterangan berhasil Disimpan.</p>
                </div>');
            redirect ($this->agent->referrer());
        }else{
            $this->session->set_flashdata('form_true',
                '<div class="alert alert-danger">
                <h4>GAGAL UPLOUD.</h4>
                <p>Format dokumen tidak sesuai ketentuan</p> <p>Format dokumen harus bertipe pdf,doc atau docx</p>
                </div>');
            redirect ($this->agent->referrer());
        }
    }


    public function update_status(){

    	$bulan 							= $this->bulan;
        $iduser                         = $this->session->userdata('iduser');
    	$tahun 						    = $this->session->userdata('tahun');
    	$data['status'] 				= escape($this->input->post('status'));
    	$data['nama_penandatangan'] 	= escape($this->input->post('nama_penandatangan'));
    	$data['jabatan'] 				= escape($this->input->post('jabatan'));
        $data['status_tgl']             = date("Y-m-d H:i:s");
        $id_ref                         = $iduser.'_'.date("Y-m-d H:i:s");
    	$data['id_ref'] 			    = str_replace('=','',base64_encode($id_ref));
		  // var_dump($data);exit;

        $filter['iduser'] =  $iduser;
        $filter['id_bulan'] = $bulan;
        $filter['tahun'] = $tahun;
        $data_ikhtisar_kinerja = $this->ikhtisar_kinerja_model->get_filter($filter);
        $jml =  count($data_ikhtisar_kinerja);
       // print_r($jml);exit();

        if ( $jml > 0 || $jml == 1) {
          $this->ikhtisar_kinerja_model->update($bulan,$iduser,$data);

          $this->session->set_flashdata('form_true',
            '<div class="alert alert-success">
            <h4>Berhasil.</h4>
            <p>Data berhasil Disimpan.</p>
            </div>');

          redirect ($this->agent->referrer());

        }else{
            $this->session->set_flashdata('form_true',
                '<div class="alert alert-danger">
                <h4>Gagal.</h4>
                <p>Anda Belum Input Pendahuluan.</p>
                </div>');

            redirect ($this->agent->referrer());
        }
    	
    }

    public function get_file(){
    	$id = $this->uri->segment(4);
    	$get_db = $this->ikhtisar_kinerja_model->get_by_id($id);
    	$file = $get_db[0]['file'];
    	$path = './files/file_bulanan/ikhtisar_kinerja/'.$file;
    	$data = file_get_contents($path);
    	$name = $file;
    	force_download($name,$data);
    }

    public function nilai_arus_kas(){
        $array = array();
        $aktivitas = $this->arus_kas_model->getdata('jenis_aktivitas','result_array');
        foreach ($aktivitas as $k => $v) {

            if($v['jenis_kas'] == 'INVESTASI'){
                $judul = 'Arus Kas Bersih Digunakan Untuk Aktivitas Investasi';
            }else if($v['jenis_kas'] == 'OPERASIONAL'){
                $judul = 'Arus Kas Bersih Diperoleh Dari Aktivitas Operasional';
            }else if($v['jenis_kas'] == 'PENDANAAN'){
                $judul = 'Arus Kas Bersih Diperoleh dari Aktivitas Pendanaan';
            }

            $array[$k]['judul_kas'] = 'ARUS KAS DARI AKTIVITAS '.$v['jenis_kas'];
            $array[$k]['jenis_kas'] = $v['jenis_kas'];
            $array[$k]['judul'] = $judul;
            $array[$k]['sum'] =  (isset($v['sum']) ? $v['sum'] : 0) ;
            $array[$k]['sumprev'] =(isset($v['sumprev']) ? $v['sumprev'] : 0) ;
            $array[$k]['child'] = array();

            $arus_kas = $this->arus_kas_model->getdata('jenis_aktivitas_by','result_array', $v['jenis_kas']);
            foreach ($arus_kas as $key => $val) {
                $array[$k]['child'][$key]['id_aruskas'] = $val['id_aruskas'];
                $array[$k]['child'][$key]['arus_kas'] = $val['arus_kas'];
                $array[$k]['child'][$key]['subchild'] = array();

                $nilai_arus_kas = $this->arus_kas_model->getdata('nilai_arus_kas','result_array', $val['id_aruskas']);
                foreach ($nilai_arus_kas as $x => $y) {
                    $array[$k]['child'][$key]['subchild'][$x]['id_aruskas'] = $y['id_aruskas'];
                    $array[$k]['child'][$key]['subchild'][$x]['saldo_bulan_berjalan'] = (isset($y['saldo_bulan_berjalan']) ? $y['saldo_bulan_berjalan'] : 0) ;
                    $array[$k]['child'][$key]['subchild'][$x]['saldo_bulan_lalu'] = (isset($y['saldo_bulan_lalu']) ? $y['saldo_bulan_lalu'] : 0) ;

                    

                }
            }
        }
        // echo '<pre>';
        // print_r($array);exit;
        return $array;

        // $data['bread'] = array('header'=>'Arus Kas', 'subheader'=>'Arus Kas');
        // $data['view']  = "bulanan/arus_kas/data_aruskas";
        // $this->load->view('main/utama', $data);
    }

}
