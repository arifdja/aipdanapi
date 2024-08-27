<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'login';

$route['api-auth'] 						= 'Auth_api';
$route['api-aset-tetap-bulanan'] 		= 'api_bulanan/aset_tetap';
$route['api-beban-bulanan'] 		  	= 'api_bulanan/beban';
$route['api-beban-investasi-bulanan'] 	= 'api_bulanan/beban_investasi';
$route['api-hasil-investasi-bulanan'] 	= 'api_bulanan/hasil_investasi';
$route['api-iuran-bulanan'] 			= 'api_bulanan/iuran';
$route['api-kewajiban-bulanan'] 		= 'api_bulanan/kewajiban';
$route['api-nilai-investasi-bulanan'] 	= 'api_bulanan/nilai_investasi';
$route['api-arus-kas-bulanan'] 			= 'api_bulanan/arus_kas';
$route['api-aset-investasi-bulanan'] 	= 'api_bulanan/aset_investasi';
$route['api-bukan-aset-investasi-bulanan'] 	= 'api_bulanan/bukan_aset_investasi';
$route['api_update_checkbox'] 	= 'api_bulanan/Api_checkbox';
$route['api-master-investasi'] 		  	= 'api_referensi/master_investasi';
$route['api-master-nama-pihak'] 		= 'api_referensi/master_nama_pihak';
$route['api-master-cabang'] 		  	= 'api_referensi/master_cabang';
$route['api-master-klaim'] 		  	    = 'api_referensi/master_klaim';
$route['api-master-aruskas'] 		  	= 'api_referensi/master_aruskas';
$route['api-master-kelompok-penerima'] 	= 'api_referensi/master_kelompok_penerima';
$route['api-master-jenis-penerima'] 	= 'api_referensi/master_jenis_penerima';
$route['api-peserta-aktif'] 	= 'api_bulanan/peserta_aktif';
$route['api-peserta-aktif-bulanan'] 	= 'api_bulanan/peserta_aktif_vTIP';
$route['api-peserta-aktif-semester'] 	= 'api_semesteran/peserta_aktif_semester_vTIP';
$route['api-peserta-aktif-cabang-semester'] 	= 'api_semesteran/peserta_aktif_semester_cabang_vTIP';


// API SEMESTERAN
$route['api-pembayaran-pensiun-semesteran'] 		= 'api_semesteran/pembayaran_pensiun';
$route['api-nilai-tunai-semesteran'] 				= 'api_semesteran/nilai_tunai';
$route['api-beban-semesteran'] 						= 'api_semesteran/beban';
$route['api-klaim-semesteran'] 						= 'api_semesteran/klaim';


// INVESTASI
$route['investasi-display/(:any)'] = 'bulanan/aset_investasi/getdisplay/$1';
$route['investasi-simpan/(:any)'] = 'bulanan/aset_investasi/simpandata/$1';
$route['investasi-form/(:any)/(:any)/(:any)'] = 'bulanan/aset_investasi/get_form/$1/$2/$3';
$route['investasi-form/(:any)'] = 'bulanan/aset_investasi/get_form/$1';
$route['investasi-form/(:any)/(:any)'] = 'bulanan/aset_investasi/get_form/$1/$2';
$route['investasi-index/(:any)'] = 'bulanan/aset_investasi/get_index/$1';
$route['investasi-cetak/(:any)/(:any)'] = 'bulanan/aset_investasi/cetak/$1/$2';

// ARUS KAS
$route['arus-kas-display/(:any)'] = 'bulanan/arus_kas/getdisplay/$1';
$route['arus-kas-form/(:any)/(:any)'] = 'bulanan/arus_kas/get_form/$1/$2';
$route['arus-kas-form/(:any)'] = 'bulanan/arus_kas/get_form/$1';
$route['arus-kas-simpan/(:any)'] = 'bulanan/arus_kas/simpandata/$1';
$route['aruskas-index/(:any)'] = 'bulanan/arus_kas/get_index/$1';
$route['aruskas-cetak/(:any)/(:any)'] = 'bulanan/arus_kas/cetak/$1/$2';

// USER & ROLE
$route['user-display/(:any)'] = 'user/getdisplay/$1';
$route['user-form/(:any)/(:any)'] = 'user/get_form/$1/$2';
$route['user-form/(:any)'] = 'user/get_form/$1';
$route['user-simpan/(:any)'] = 'user/simpandata/$1';
$route['role-app/(:any)'] = 'user/roleaccess/$1';
// $route['(.*)'] = "error404";

// DANA BERSIH
$route['danabersih-index/(:any)'] = 'bulanan/dana_bersih/get_index/$1';
$route['rincian-index/(:any)'] = 'bulanan/rincian/get_index/$1';
$route['rincian-cetak/(:any)/(:any)'] = 'bulanan/rincian/cetak/$1/$2';
$route['danabersih-cetak/(:any)/(:any)'] = 'bulanan/dana_bersih/cetak/$1/$2';


// PERUBAHAN DANA BERSIH
$route['perubahan-danabersih-index/(:any)'] = 'bulanan/perubahan_dana_bersih/get_index/$1';
$route['perubahan-danabersih-cetak/(:any)/(:any)'] = 'bulanan/perubahan_dana_bersih/cetak/$1/$2';
$route['beban-investasi'] = 'bulanan/perubahan_dana_bersih/beban_investasi';
$route['perubahan-danabersih-form/(:any)/(:any)'] = 'bulanan/perubahan_dana_bersih/get_form/$1/$2';
$route['perubahan-danabersih-form/(:any)'] = 'bulanan/perubahan_dana_bersih/get_form/$1';

// HASIL INVESTASI
$route['hasil-investasi-index/(:any)'] = 'bulanan/hasil_investasi/get_index/$1';
$route['hasil-investasi-cetak/(:any)/(:any)'] = 'bulanan/hasil_investasi/cetak/$1/$2';

// BUKAN INVESTASI
$route['bukan-investasi-index/(:any)'] = 'bulanan/bukan_investasi/get_index/$1';
$route['bukan-investasi-cetak/(:any)/(:any)'] = 'bulanan/bukan_investasi/cetak/$1/$2';

// PENDAHULUAN - BULANAN
$route['pendahuluan-index/(:any)'] = 'bulanan/pendahuluan/get_index/$1';
$route['pendahuluan-cetak/(:any)/(:any)'] = 'bulanan/pendahuluan/cetak/$1/$2';

$route['pendahuluan-semester-index/(:any)'] = 'semesteran/pendahuluan/get_index/$1';
$route['pendahuluan-semester-cetak/(:any)/(:any)'] = 'semesteran/pendahuluan/cetak/$1/$2';

$route['pendahuluan-thn-index/(:any)'] = 'tahunan/pendahuluan/get_index/$1';
$route['pendahuluan-thn-cetak/(:any)/(:any)'] = 'tahunan/pendahuluan/cetak/$1/$2';

// IKHTISAR KINERJA - BULANAN
$route['ikhtisar_kinerja-index/(:any)'] = 'bulanan/ikhtisar_kinerja/get_index/$1';
$route['ikhtisar_kinerja-cetak/(:any)/(:any)'] = 'bulanan/ikhtisar_kinerja/cetak/$1/$2';

// PRINT ALL - BULANAN
$route['print_all-index/(:any)'] = 'bulanan/printall/get_index/$1';
$route['printall-cetak/(:any)/(:any)'] = 'bulanan/printall_cetak/cetak/$1/$2';
$route['print_all/generate_AllPDF_Preview'] = 'bulanan/printall/generate_all_reports';


// $route['pendahuluan-semester-index/(:any)'] = 'semesteran/get_index/$1';
// $route['pendahuluan-semester-cetak/(:any)/(:any)'] = 'semesteran/pendahuluan/cetak/$1/$2';

// $route['pendahuluan-thn-index/(:any)'] = 'tahunan/pendahuluan/get_index/$1';
// $route['pendahuluan-thn-cetak/(:any)/(:any)'] = 'tahunan/pendahuluan/cetak/$1/$2';


// MASTER DATA
$route['master-display/(:any)'] = 'master/master_data/getdisplay/$1';
$route['master-simpan/(:any)'] = 'master/master_data/simpandata/$1';
$route['master-form/(:any)/(:any)/(:any)'] = 'master/master_data/get_form/$1/$2/$3';
$route['master-form/(:any)/(:any)/(:any)/(:any)'] = 'master/master_data/get_form/$1/$2/$3/$4';
$route['master-form/(:any)'] = 'master/master_data/get_form/$1';
$route['master-form/(:any)/(:any)'] = 'master/master_data/get_form/$1/$2';
$route['master-index/(:any)'] = 'master/master_data/get_index/$1';

$route['pengajuan-nama-pihak'] = 'master/pengajuan_nama_pihak/tmp_mst_pihak';
$route['pengajuan-master-display/(:any)'] = 'master/pengajuan_nama_pihak/getdisplay/$1';
$route['pengajuan-master-form/(:any)'] = 'master/pengajuan_nama_pihak/get_form/$1';
$route['pengajuan-master-form/(:any)/(:any)'] = 'master/pengajuan_nama_pihak/get_form/$1/$2';
$route['pengajuan-master-form/(:any)/(:any)/(:any)'] = 'master/pengajuan_nama_pihak/get_form/$1/$2/$3';
$route['pengajuan-master-form/(:any)/(:any)/(:any)/(:any)'] = 'master/pengajuan_nama_pihak/get_form/$1/$2/$3/$4';
$route['pengajuan-master-simpan/(:any)'] = 'master/pengajuan_nama_pihak/simpandata/$1';
$route['pengajuan-master-index/(:any)'] = 'master/pengajuan_nama_pihak/get_index/$1';

$route['approval-nama-pihak/(:any)/(:any)'] = 'master/master_data/approval_nama_pihak/$1/$2';


// ASPEK OPERASIONAL
$route['aspek-operasional-display/(:any)'] = 'semesteran/aspek_operasional/getdisplay/$1';
$route['aspek-operasional-simpan/(:any)'] = 'semesteran/aspek_operasional/simpandata/$1';
$route['aspek-operasional-form/(:any)/(:any)/(:any)'] = 'semesteran/aspek_operasional/get_form/$1/$2/$3';
$route['aspek-operasional-form/(:any)'] = 'semesteran/aspek_operasional/get_form/$1';
$route['aspek-operasional-form/(:any)/(:any)'] = 'semesteran/aspek_operasional/get_form/$1/$2';
$route['aspek-operasional-index/(:any)'] = 'semesteran/aspek_operasional/get_index/$1';
$route['aspek-operasional-cetak/(:any)/(:any)'] = 'semesteran/aspek_operasional/cetak/$1/$2';

// OPERASIONAL BELANJA
$route['operasional-belanja-display/(:any)'] = 'semesteran/operasional_belanja/getdisplay/$1';
$route['operasional-belanja-simpan/(:any)'] = 'semesteran/operasional_belanja/simpandata/$1';
$route['operasional-belanja-form/(:any)/(:any)/(:any)'] = 'semesteran/operasional_belanja/get_form/$1/$2/$3';
$route['operasional-belanja-form/(:any)'] = 'semesteran/operasional_belanja/get_form/$1';
$route['operasional-belanja-form/(:any)/(:any)'] = 'semesteran/operasional_belanja/get_form/$1/$2';
$route['operasional-belanja-index/(:any)'] = 'semesteran/operasional_belanja/get_index/$1';
$route['operasional-belanja-cetak/(:any)/(:any)'] = 'semesteran/operasional_belanja/cetak/$1/$2';

// ASPEK INVESTASI
$route['aspek-investasi-display/(:any)'] = 'semesteran/aspek_investasi/getdisplay/$1';
$route['aspek-investasi-simpan/(:any)'] = 'semesteran/aspek_investasi/simpandata/$1';
$route['aspek-investasi-form/(:any)/(:any)/(:any)'] = 'semesteran/aspek_investasi/get_form/$1/$2/$3';
$route['aspek-investasi-form/(:any)'] = 'semesteran/aspek_investasi/get_form/$1';
$route['aspek-investasi-form/(:any)/(:any)'] = 'semesteran/aspek_investasi/get_form/$1/$2';
$route['aspek-investasi-index/(:any)'] = 'semesteran/aspek_investasi/get_index/$1';
$route['aspek-investasi-cetak/(:any)/(:any)'] = 'semesteran/aspek_investasi/cetak/$1/$2';


// ASPEK KEUANGAN
$route['aspek-keuangan-display/(:any)'] = 'semesteran/aspek_keuangan/getdisplay/$1';
$route['aspek-keuangan-simpan/(:any)'] = 'semesteran/aspek_keuangan/simpandata/$1';
$route['aspek-keuangan-form/(:any)/(:any)/(:any)'] = 'semesteran/aspek_keuangan/get_form/$1/$2/$3';
$route['aspek-keuangan-form/(:any)'] = 'semesteran/aspek_keuangan/get_form/$1';
$route['aspek-keuangan-form/(:any)/(:any)'] = 'semesteran/aspek_keuangan/get_form/$1/$2';
$route['aspek-keuangan-index/(:any)'] = 'semesteran/aspek_keuangan/get_index/$1';
$route['aspek-keuangan-cetak/(:any)/(:any)'] = 'semesteran/aspek_keuangan/cetak/$1/$2';

// LAMPIRAN 
$route['lampiran-index/(:any)'] = 'semesteran/lampiran/get_index/$1';
$route['lampiran-cetak/(:any)/(:any)'] = 'semesteran/lampiran/cetak/$1/$2';

// TAHUNAN INDEX
$route['aspek-investasi-thn-index/(:any)'] = 'tahunan/aspek_investasi/get_index/$1';
$route['aspek-keuangan-thn-index/(:any)'] = 'tahunan/aspek_keuangan/get_index/$1';
$route['operasional-belanja-thn-index/(:any)'] = 'tahunan/operasional_belanja/get_index/$1';
$route['aspek-operasional-thn-index/(:any)'] = 'tahunan/aspek_operasional/get_index/$1';

$route['lampiran-thn-index/(:any)'] = 'tahunan/lampiran/get_index/$1';


$route['master-pihak'] = 'master/master_data/master_nama_pihak';
$route['master-nama-pihak'] = 'master/master_data/mst_pihak';

$route['aspek-keuangan-thn-cetak/(:any)/(:any)'] = 'tahunan/aspek_keuangan/cetak/$1/$2';
$route['aspek-investasi-thn-cetak/(:any)/(:any)'] = 'tahunan/aspek_investasi/cetak/$1/$2';
$route['lampiran-thn-cetak/(:any)/(:any)'] = 'tahunan/lampiran/cetak/$1/$2';
$route['aspek-investasi-thn-cetak/(:any)/(:any)'] = 'tahunan/aspek_investasi/cetak/$1/$2';
$route['operasional-belanja-thn-cetak/(:any)/(:any)'] = 'tahunan/operasional_belanja/cetak/$1/$2';
$route['aspek-operasional-thn-cetak/(:any)/(:any)'] = 'tahunan/aspek_operasional/cetak/$1/$2';

$route['botdetect/captcha-handler'] = 'botdetect/captcha_handler/index';
$route['change-password'] 			= 'login/change_password';

// ASPEK KEUANGAN TAHUNAN
$route['aspek-keuangan-thn-display/(:any)'] = 'tahunan/aspek_keuangan/getdisplay/$1';
$route['aspek-keuangan-thn-simpan/(:any)'] = 'tahunan/aspek_keuangan/simpandata/$1';
$route['aspek-keuangan-thn-form/(:any)/(:any)/(:any)'] = 'tahunan/aspek_keuangan/get_form/$1/$2/$3';
$route['aspek-keuangan-thn-form/(:any)'] = 'tahunan/aspek_keuangan/get_form/$1';
$route['aspek-keuangan-thn-form/(:any)/(:any)'] = 'tahunan/aspek_keuangan/get_form/$1/$2';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


// DASHBOARD
$route['dashboard-display/(:any)'] = 'dashboard/analisis/getdisplay/$1';
$route['dashboard-index/(:any)'] = 'dashboard/analisis/get_index/$1';


$route['dashboard-tampil/(:any)'] = 'dashboard/dashboard/getdisplay/$1';
$route['dashboard-tampil-summary/(:any)'] = 'dashboard/dashboard_summary/getdisplay/$1';
$route['dashboard-tampil-operasional/(:any)'] = 'dashboard/aspek_operasional/getdisplay/$1';
$route['dashboard-tampil-operasional-apbn/(:any)'] = 'dashboard/aspek_operasional_apbn/getdisplay/$1';
$route['dashboardv2-index/(:any)'] = 'dashboard/dashboard/get_index/$1';

$route['dashboard-executive-summary'] = 'dashboard/dashboard_summary/executive_summary';
$route['dashboard-danabersih'] = 'dashboard/dashboard/dana_bersih';
$route['dashboard-perubahan-danabersih'] = 'dashboard/dashboard/perubahan_danabersih';
$route['dashboard-arus-kas'] = 'dashboard/dashboard_summary/arus_kas';
$route['dashboard-aspek-operasional'] = 'dashboard/aspek_operasional/aspek_operasional';
$route['dashboard-operasional-belanja'] = 'dashboard/aspek_operasional_apbn/operasional_belanja';
