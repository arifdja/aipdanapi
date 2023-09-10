<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Printall extends CI_Controller {
	function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('bulanan_model/Printall_model');
		$this->load->model('bulanan_model/arus_kas_model');
        $this->load->model('bulanan_model/pendahuluan_model');
        $this->load->model('bulanan_model/perubahan_dana_bersih_model');
        $this->load->model('bulanan_model/dana_bersih_model');
        $this->load->model('bulanan_model/aset_investasi_model');
        $this->load->model('bulanan_model/lap_bukan_investasi_model');
        $this->load->model('bulanan_model/posisi_investasi_model');
        $this->load->model('bulanan_model/hasil_investasi_model');
        $this->load->model('bulanan_model/rincian_model');
        

		$this->load->library('form_validation');
		$this->load->library('user_agent');
		// $this->load->library('pdf');
		$this->load->library('upload');
		$this->load->helper('download');

		$this->bulan=$this->session->userdata("id_bulan");
		$this->iduser=$this->session->userdata("iduser");
		$this->tahun=$this->session->userdata("tahun");		
		$this->idusergroup=$this->session->userdata("idusergroup");
		//cek login
		if (! $this->session->userdata('isLoggedIn') ) redirect("login/show_login");
		$userData=$this->session->userdata();
		//cek akses route
		// if($userData['idusergroup'] !== '001') show_404();
		$this->page_limit = 10;
		
	}
	
	public function index($id = ''){


		if(!($this->session->userdata("id_bulan"))){
			$data= array('id_bulan'=>$this->input->post('bulan'));
			$this->session->set_userdata($data);
		} else{
			$this->session->userdata('id_bulan');
		}

		$bln=$this->session->userdata('id_bulan');
		// var_dump($bln);exit;
		$data['bulan'] = bulan();
		$data['opt_user'] = dtuser();
        $data['data_print_all'] = $this->Printall_model->get_ket('ket_print_all');
		
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
            $data['data_print_all'] = $this->Printall_model->get_filter($filter);

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

    function laporan_ArusKas_PDF($mod="aruskas_cetak"){
        
        switch($mod){
            case "aruskas_cetak":
                $data['iduser'] = $this->input->post('iduser');
                $data['bulan'] = bulan();
                $data['arus_kas'] = $this->nilai_arus_kas();
                $data['kas_bank'] = $this->arus_kas_model->getdata('kas_bank', 'row_array');
                $data['data_arus_kas_ket'] = $this->arus_kas_model->get_ket('ket_arus_kas');
                $template=$this->load->view('bulanan/arus_kas/index_pdf_export', $data,true);  
                // print_r($data);exit;
                $this->hasil_output('pdf',$mod,'', $data, '', "A4", $template, "ya", "no");
            break;
        }
        
    }
        
    function laporan_AsetInvestasi_PDF($mod="aset_investasi_cetak"){
        
        switch($mod){
            case "aset_investasi_cetak":
                $data['iduser'] = $this->input->post('iduser');
                $data['bulan'] = bulan();
                $data['data_invest'] = $this->aset_investasi_front();
                $data['sum'] = $this->aset_investasi_model->getdataindex('aset_investasi_front_sum', 'row_array', 'INVESTASI');
                $template=$this->load->view('bulanan/aset_investasi/index_pdf_export', $data,true);  
                // print_r($data);exit;
                $this->hasil_output('pdf',$mod,'', $data, '', "A4", $template, "ya", "no");
            break;
        }
        
    }

    function laporan_BebanInvestasi_PDF($mod="beban_investasi_cetak"){

        switch($mod){
            case "beban_investasi_cetak":
                $data['iduser'] = $this->input->post('iduser');
                $data['bulan'] = bulan();
                $data['opt_user'] = dtuser();
                $data['data_beban'] = $this->nilai_beban_investasi();
                $data['sum'] = $this->perubahan_dana_bersih_model->getdata('aset_investasi_front_sum', 'row_array', 'BEBAN INVESTASI');

                $template=$this->load->view('bulanan/perubahan_dana_bersih/index_beban_pdf_export', $data,true);  
                // print_r($data);exit;
                $this->hasil_output('pdf',$mod,'', $data, '', "A4", $template, "ya", "no");
            break;
        }
        
    }
    
    function laporan_BukanInvestasi_PDF($mod="bukan_investasi_cetak"){
        
        switch($mod){
            case "bukan_investasi_cetak":
                $data['iduser'] = $this->input->post('iduser');
                $data['bulan'] = bulan();
                $data['data_bukan_investasi'] = $this->aset_bukan_investasi_front();
                $data['sum'] = $this->aset_investasi_model->getdataindex('aset_investasi_front_sum', 'row_array', 'BUKAN INVESTASI');
                $template=$this->load->view('bulanan/bukan_investasi/index_pdf_export', $data,true);  
                // print_r($data);exit;
                $this->hasil_output('pdf',$mod,'', $data, '', "A4", $template, "ya", "no");
            break;
        }
        
    }
    
    function laporan_DanaBersih_PDF($mod="dana_bersih_cetak"){
        
        switch($mod){
            case "dana_bersih_cetak":
                $data['iduser'] = $this->input->post('iduser');
                $data['bulan'] = bulan();
                $data['opt_user'] = dtuser();
                $data['data_dana_bersih'] = $this->nilai_all_dana_bersih();
                $data['total_bersih'] = $this->aset_investasi_model->getdata('dana_bersih_lv1','result');
                $data['data_dana_bersih_ket'] = $this->dana_bersih_model->get_ket('ket_dana_bersih');
                $template=$this->load->view('bulanan/dana_bersih/index_pdf_export', $data,true);  
                // print_r($data);exit;
                $this->hasil_output('pdf',$mod,'', $data, '', "A4", $template, "ya", "no");
            break;
        }
        
    }

    function laporan_HasilInvestasi_PDF($mod="hasil_investasi_cetak"){
        
        switch($mod){
            case "hasil_investasi_cetak":
                $data['iduser'] = $this->input->post('iduser');
                $data['bulan'] = bulan();
                // $data['data_hasil_investasi'] = $this->aset_investasi_model->getdata('data_hasil_investasi_header', 'result');
                $data['data_hasil_investasi'] = $this->hasil_investasi_front();
                $data['sum'] = $this->aset_investasi_model->getdataindex('aset_investasi_front_sum', 'row_array', 'HASIL INVESTASI');
                
                $data['data_hasil_investasi_ket'] = $this->hasil_investasi_model->get_ket('ket_hasil_investasi');
                $template=$this->load->view('bulanan/hasil_investasi/index_pdf_export', $data,true);  
                // print_r($data);exit;
                $this->hasil_output('pdf',$mod,'', $data, '', "A4", $template, "ya", "no");
            break;
        }
        
    }

    function laporan_Pendahuluan_PDF($mod="pendahuluan_cetak"){

    	switch($mod){
    		case "pendahuluan_cetak":
                $data['iduser'] = $this->input->post('iduser');
                $data['id_bulan'] = $this->bulan;
                $data['tahun'] = $this->tahun;
                $data['data_pendahuluan'] = $this->pendahuluan_model->get_ket($data['id_bulan'] );
                $data['opt_user'] = dtuser();
                $data['bulan'] = bulan();
                $template=$this->load->view('bulanan/pendahuluan/index_pdf_export', $data,true);  
                // print_r($data);exit;
                $this->hasil_output('pdf',$mod,'', $data, '', "A4", $template, "ya", "no");
            break;
    	}

    }
    
    function laporan_PerubahanDanaBersih_PDF($mod="perubahan_danabersih_cetak"){
        
        switch($mod){
            case "perubahan_danabersih_cetak":
                $data['iduser'] = $this->input->post('iduser');
                $data['bulan'] = bulan();
                $data['opt_user'] = dtuser();
                $data['data_perubahan_danabersih'] = $this->nilai_perubahan_danabersih();
                $data['data_perubahan_dana_bersih_ket'] = $this->perubahan_dana_bersih_model->get_ket('ket_perubahan_dana_bersih');
                $data['tot_perubahan'] = $this->aset_investasi_model->getdata('perubahan_danabersih_lv1','result');
                $data['total_bersih'] = $this->aset_investasi_model->getdata('dana_bersih_lv0','result');
                $template=$this->load->view('bulanan/perubahan_dana_bersih/index_pdf_export', $data,true);  
                // print_r($data);exit;
                $this->hasil_output('pdf',$mod,'', $data, '', "A4", $template, "ya", "no");
            break;
        }
        
    }

    function laporan_Rincian_PDF($mod="rincian_cetak"){
        
        switch($mod){
            case "rincian_cetak":
                $data['iduser'] = $this->input->post('iduser');
                $data['bulan'] = bulan();
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
                        $template=$this->load->view('bulanan/rincian/index_pdf_export_tsn', $data,true); 
                    }else if ($this->iduser == "ASB003") {
                        $template=$this->load->view('bulanan/rincian/index_pdf_export_asb', $data,true);
                    }
                }else{
                    if($data['iduser'] == "TSN002"){
                        $template=$this->load->view('bulanan/rincian/index_pdf_export_tsn', $data,true); 
                    }else if ($data['iduser'] == "ASB003") {
                        $template=$this->load->view('bulanan/rincian/index_pdf_export_asb', $data,true);
                    }
                }
                 // print_r($data);exit;
                $this->hasil_output('pdf',$mod,'', $data, '', "A4", $template, "ya", "no");
            break;
        }
        
    }

    function hasil_output($p1,$mod,$data_detail,$data,$filename="",$ukuran="A4",$template="",$footer="", $header=""){
        switch($p1){
            case "pdf":
                
                $pdf = new \Mpdf\Mpdf(['orientation' => 'L']);
                $pdf->WriteHTML($template, 2);

                $output_filename = 'output_' . $mod . '.pdf';
                $pdf->Output($output_filename, 'F');
                
                return $output_filename;
            break;
        }
    }
    
    function merge_pdfs($pdf_files,$output_filename){
        $pdf = new \Mpdf\Mpdf();

        foreach ($pdf_files as $pdf_file){
            $pdf_content = file_get_contents($pdf_file);
            $pdf->WriteHTML($pdf_content,2);
        }

        $pdf_files = [
            hasil_output('pdf','laporan1',$data_detail1,$data1,'output_laporan1.pdf','A4',$template1,'ya','no'),
            hasil_output('pdf','laporan1',$data_detail1,$data1,'output_laporan1.pdf','A4',$template1,'ya','no'),
        ];

        $output_filename = 'output_merge.pdf';

        merge_pdfs($pdf_file, $output_filename);
    }

    // private function call_pdf_function($report_name) {
    //     switch ($report_name) {
    //         case "Lap_ArusKas":
    //             $this->laporan_ArusKas_PDF();
    //             break;
    //         case "Lap_AsetInvestasi":
    //             $this->laporan_AsetInvestasi_PDF();
    //             break;
    //         case "Lap_BebanInvestasi":
    //             $this->laporan_BebanInvestasi_PDF();
    //             break;
    //         case "Lap_BukanInvestasi":
    //             $this->laporan_BukanInvestasi_PDF();
    //             break;
    //         case "Lap_DanaBersih":
    //             $this->laporan_DanaBersih_PDF();
    //             break;
    //         case "Lap_HasilInvestasi":
    //             $this->laporan_HasilInvestasi_PDF();
    //             break;
    //         case "Lap_IkhtisarKinerja":
    //             $this->laporan_DanaBersih_PDF();
    //             break;
    //         case "Lap_Pendahuluan":
    //             $this->laporan_Pendahuluan_PDF();
    //             break;
    //         case "Lap_Pernyataan":
    //             $this->laporan_Pernyataan_PDF();
    //             break;
    //         case "Lap_PerubahanDanaBersih":
    //             $this->laporan_PerubahanDanaBersih_PDF();
    //             break;
    //         case "Lap_Rincian":
    //             $this->laporan_Rincian_PDF();
    //             break;
    //         // Tambahkan kasus lainnya sesuai dengan nama laporan yang sesuai
    //         default:
    //             // Handle jika nama laporan tidak dikenali
    //             break;
    //     }
    // }
    
    public function generate_all_reports() {
        // Ambil data dari tabel bln_checkbox_lap yang is_checked = 1
        // $checked_reports = $this->Printall_model->get_checked_reports();
    
        // Loop melalui data dan panggil fungsi cetak PDF sesuai centangannya
        // foreach ($checked_reports as $report) {
        //     $mod = $report->Id_Checkbox; // Gantilah ini dengan nama field yang sesuai
            // $this->call_pdf_function($report_name);
            switch ($mod) {
                case "Lap_ArusKas":
                    $this->laporan_ArusKas_PDF();
                    break;
                case "Lap_AsetInvestasi":
                    $this->laporan_AsetInvestasi_PDF();
                    break;
                case "Lap_BebanInvestasi":
                    $this->laporan_BebanInvestasi_PDF();
                    break;
                case "Lap_BukanInvestasi":
                    $this->laporan_BukanInvestasi_PDF();
                    break;
                case "Lap_DanaBersih":
                    $this->laporan_DanaBersih_PDF();
                    break;
                case "Lap_HasilInvestasi":
                    $this->laporan_HasilInvestasi_PDF();
                    break;
                case "Lap_IkhtisarKinerja":
                    $this->laporan_DanaBersih_PDF();
                    break;
                case "Lap_Pendahuluan":
                    $this->laporan_Pendahuluan_PDF();
                    break;
                case "Lap_Pernyataan":
                    $this->laporan_Pernyataan_PDF();
                    break;
                case "Lap_PerubahanDanaBersih":
                    $this->laporan_PerubahanDanaBersih_PDF();
                    break;
                case "Lap_Rincian":
                    $this->laporan_Rincian_PDF();
                    break;
                // Tambahkan kasus lainnya sesuai dengan nama laporan yang sesuai
                default:
                    // Handle jika nama laporan tidak dikenali
                    break;
            }
        // }
    
        // Setelah semua laporan dibuat, gabungkan PDF-nya menjadi satu file
        $this->merge_pdfs();
    
        // Download file PDF yang sudah digabungkan
        // ... (gunakan metode yang sesuai untuk mengirimkan PDF ke pengguna)
    }
    

    function generate_AllPDF_Preview(){
        // Mendefinisikan daftar fungsi yang akan digunakan untuk menghasilkan laporan PDF
        $pdf_functions = array(
            'laporan_ArusKas_PDF',
            'laporan_AsetInvestasi_PDF',
            'laporan_BebanInvestasi_PDF',
            'laporan_BukanInvestasi_PDF',
            'laporan_DanaBersih_PDF',
            'laporan_HasilInvestasi_PDF',
            'laporan_Pendahuluan_PDF',
            'laporan_PerubahanDanaBersih_PDF',
            'laporan_Rincian_PDF'
        );
    
        
        // Menginisialisasi objek Mpdf
        $pdf = new \Mpdf\Mpdf();

        // Meloop melalui setiap fungsi laporan PDF
        foreach($pdf_functions as $pdf_function){
            // Memanggil fungsi laporan PDF
            $this->$pdf_function();
        
            // Mengambil isi output dari fungsi laporan PDF
            $output = $this->output->get_output();
            
            // Menambahkan halaman baru setelah setiap laporan PDF
            if($pdf_function !== reset($pdf_functions)){
                $pdf->AddPage();
            }
            
            // Menambahkan isi output ke PDF saat ini
            $pdf->WriteHTML($output);
        }

        // Membuat file PDF dan menampilkan preview
        $pdf->Output('preview.pdf', 'I');

    }
    

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
