<?php
function escape($string) { 
    if(!empty($string) && is_string($string)) { 
		$string = trim($string);
        $string = str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $string);
        // var_dump($string);exit;
        return strip_tags($string);
    }else{
      return $string;
    }
} 

function get_user($arg = false){
	$ci = &get_instance();
	$ci->load->model('auth_model');
	$user_data = false;
	if(isset($_SESSION['id'])){
		$user_data = $ci->auth_model->get_profile($_SESSION['id']);
	}
	if($user_data && $arg){
		$user_data = $user_data[0]->{$arg};
	}
	return $user_data;
}

function is_menu($slug_1 = '',$slug_2 = '',$slug_3 = ''){
	$ci = &get_instance();
	$ci->load->helper('url');
	$active = false;
	if($slug_1 == $ci->uri->segment(1)){
		$active = true;
	}
	if($active && $slug_2 && $slug_2 == $ci->uri->segment(2)){
		$active = true;
	}
	if($active && $slug_3 && $slug_3 == $ci->uri->segment(3)){
		$active = true;
	}
	if($active){
		$active = "active";
	}
	return $active;
}
function generate_code($prefix,$num,$length = 3){
	$add_code = (int)filter_var($num, FILTER_SANITIZE_NUMBER_INT) + 1;
	$num_code = str_pad($add_code,$length,"0",STR_PAD_LEFT);
	return $prefix.$num_code;
}

function get_paggination($total_row,$search = array()){
	$ci = &get_instance();
	$ci->load->library('pagination');


	$current_url = reconstruct_url("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
	if(!empty($search)){
		$config['base_url'] = $current_url.'?'.http_build_query($search);
	}else{
		$config['base_url'] = $current_url;
	}
	$config['page_query_string'] = true;
	$config['query_string_segment'] = 'page';
	$config['total_rows'] = $total_row;
	$config['per_page'] = $ci->page_limit;

	$config['full_tag_open'] = '<ul class="pagination">';
	$config['full_tag_close'] = '</ul>';
	$config['first_link'] = false;
	$config['last_link'] = false;
	// $config['num_links'] = 6;
	$config['first_tag_open'] = '<li>';
	$config['first_tag_close'] = '</li>';
	$config['prev_link'] = '&laquo';
	$config['prev_tag_open'] = '<li class="prev">';
	$config['prev_tag_close'] = '</li>';
	$config['next_link'] = '&raquo';
	$config['next_tag_open'] = '<li>';
	$config['next_tag_close'] = '</li>';
	$config['last_tag_open'] = '<li>';
	$config['last_tag_close'] = '</li>';
	$config['cur_tag_open'] = '<li class="active"><a href="#">';
	$config['cur_tag_close'] = '</a></li>';
	$config['num_tag_open'] = '<li>';
	$config['num_tag_close'] = '</li>';

	$ci->pagination->initialize($config);

	return $ci->pagination->create_links();
}


function get_paggination_1($total_row1,$search = array()){
	$ci = &get_instance();
	$ci->load->library('pagination');


	$current_url = reconstruct_url("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
	if(!empty($search)){
		$config['base_url'] = $current_url.'?'.http_build_query($search);
	}else{
		$config['base_url'] = $current_url;
	}
	$config['page_query_string'] = true;
	$config['query_string_segment'] = 'page';
	$config['total_rows'] = $total_row1;
	$config['per_page'] = $ci->page_limit;

	$config['full_tag_open'] = '<ul class="pagination">';
	$config['full_tag_close'] = '</ul>';
	$config['first_link'] = false;
	$config['last_link'] = false;
	$config['first_tag_open'] = '<li>';
	$config['first_tag_close'] = '</li>';
	$config['prev_link'] = '&laquo';
	$config['prev_tag_open'] = '<li class="prev">';
	$config['prev_tag_close'] = '</li>';
	$config['next_link'] = '&raquo';
	$config['next_tag_open'] = '<li>';
	$config['next_tag_close'] = '</li>';
	$config['last_tag_open'] = '<li>';
	$config['last_tag_close'] = '</li>';
	$config['cur_tag_open'] = '<li class="active"><a href="#">';
	$config['cur_tag_close'] = '</a></li>';
	$config['num_tag_open'] = '<li>';
	$config['num_tag_close'] = '</li>';

	$ci->pagination->initialize($config);

	return $ci->pagination->create_links();
}

function url_param(){
	// get limit offset
	$ci = &get_instance();
	$page = 0;
	if(!empty($_GET['page'])){
		$page = $_GET['page'];
	}
	$result = array("limit" => $ci->page_limit , "offset" => $page);
	return $result;
}
function get_search(){
	$search = $_GET;
	if(isset($search['page'])){
		unset($search['page']);
	}
	return $search;
}
function reconstruct_url($url){
	$url_parts = parse_url($url);
	$constructed_url = $url_parts['scheme'] . '://' . $url_parts['host'] . (isset($url_parts['path'])?$url_parts['path']:'');

	return $constructed_url;
}
function search_form($module){
	$search = !empty($_GET["search_by"]) && $_GET["search_by"] == "id" ? "selected" : "";
	$by = !empty($_GET['search_by']) && $_GET['search_by'] == $module.'_name' ? 'selected' : '';
	$value = !empty($_GET['value']) ? $_GET['value'] : '';

	$s = '<div class="col-md-3">';
	$s .=    '<div class="form-group">';
	$s .=       '<label for="id">Search by</label>';
	$s .=			'<select name="search_by" class="form-control">';
   $s .= 		        '<option value="id" '.$search.'>ID</option>';
	$s .= 				'<option value="'.$module.'_name" '.$by.'>Nama '.ucfirst($module).'</option>';
	$s .= 			'</select>';
	$s .=		'</div>';
	$s .= 	'</div>';
	$s .=	'<div class="col-md-3">';
	$s .=		'<div class="form-group">';
	$s .=			'<label for="customer_name">Value</label>';
	$s .=			'<input type="text" class="form-control" name="value" value="'.$value.'"/>';
	$s .=		'</div>';
	$s .=	'</div>';

	return $s;
}

function get_uri(){
	// return "?".$_SERVER['QUERY_STRING'];
	return "".$_SERVER['QUERY_STRING'];
}

function rupiah($angka){
	$hasil= number_format($angka,0,',','.');
	return $hasil;
	
}

function persen($angka){
	$hasil= number_format($angka,2,',','.');
	return $hasil;
	
}

function bulan(){
	$ci = & get_instance();
	$ci->load->database();
	$thang = $ci->session->userdata('tahun');
	$bulan = $ci->session->userdata('id_bulan');

	$where  = " WHERE 1=1 ";
	if ($bulan != "") {
		$where .= "
			AND id_bulan = '".$bulan."'
		";
	}

	$sql = "SELECT id_bulan,nama_bulan FROM t_bulan ".$where;
	$query = $ci->db->query($sql);
	return $query->result();

}

function bulan_prev(){
	$ci = & get_instance();
   $ci->load->database();

   $thang = $ci->session->userdata('tahun');
   $bulan = $ci->session->userdata('id_bulan');

   		if($bulan == 1){
				$bulan_prev = $bulan = 12;
			}else{
				$bulan_prev = $bulan -1;
			}

	$sql = "SELECT id_bulan,nama_bulan FROM t_bulan WHERE id_bulan = ".$bulan_prev;
   $query = $ci->db->query($sql);
   return $query->result();

}


function pendahuluan_bln(){
	$ci = & get_instance();
	$ci->load->database();

	$tahun = $ci->session->userdata('tahun');
	$bulan = $ci->session->userdata('id_bulan');
	$iduser = $ci->session->userdata('iduser');

	$where  = " WHERE 1=1 ";
	if ($bulan != "") {
		$where .= "
			AND id_bulan = '".$bulan."'
		";
	}

	$sql = "SELECT status FROM bln_pendahuluan 
			$where 
			AND iduser='".$iduser."' 
			AND tahun='".$tahun."' 
			";

			// echo $sql; exit();
	$query = $ci->db->query($sql);
	return $query->row_array();

}

function pendahuluan_smt($smt=""){
	$ci = & get_instance();
	$ci->load->database();

	$tahun = $ci->session->userdata('tahun');
	$semester = $smt;
	$iduser = $ci->session->userdata('iduser');

	$where  = " WHERE 1=1 ";
	if ($semester != "") {
		$where .= "
			AND semester = '".$semester."'
		";
	}

	$sql = "SELECT status FROM tb_pendahuluan_semesteran 
			$where
			AND iduser='".$iduser."' 
			AND tahun='".$tahun."' 
			";
	$query = $ci->db->query($sql);
	return $query->row_array();

}

function pendahuluan_thn(){
	$ci = & get_instance();
	$ci->load->database();

	$tahun = $ci->session->userdata('tahun');
	$iduser = $ci->session->userdata('iduser');

	$sql = "SELECT status 
			FROM tb_pendahuluan_tahunan 
			WHERE iduser='".$iduser."'
			AND tahun='".$tahun."' 
			";
	$query = $ci->db->query($sql);
	return $query->row_array();

}


function get_pihak($id_investasi){
	$ci = & get_instance();
	$ci->load->database();

	$tahun = $ci->session->userdata('tahun');
	$ci->db->select('*');
	$ci->db->from('mst_nama_pihak');
	$ci->db->join('mst_pihak', 'mst_nama_pihak.kode_pihak = mst_pihak.kode_pihak');
	$ci->db->where('id_investasi' , $id_investasi);
	$query = $ci->db->get();
	return $query->result();
}

function get_pihakBknInvest($id_jns_aset){
	$ci = & get_instance();
   $ci->load->database();
   
   $tahun = $ci->session->userdata('tahun');
   $ci->db->select('*');
   $ci->db->from('mst_pihak_aset');
   $ci->db->join('mst_pihak', 'mst_pihak_aset.kode_pihak = mst_pihak.kode_pihak');
   $ci->db->where('id_jns_aset' , $id_jns_aset);
   $query = $ci->db->get();
	return $query->result();
}

function getAll_JenisInvest(){
	$ci = & get_instance();
	$ci->load->database();

	$tahun = $ci->session->userdata('tahun');
	$ci->db->select('*');
	$ci->db->from('mst_jenis_investasi');
	$query = $ci->db->get();
	return $query->result();
}


function getAll_nmPihak(){
	$ci = & get_instance();
	$ci->load->database();

	$tahun = $ci->session->userdata('tahun');
	$ci->db->select('*');
	$ci->db->from('mst_pihak');
	$query = $ci->db->get();
	return $query->result();
}


function filter_AsetBknInvest($id_jns_aset){
	$ci = & get_instance();
	$ci->load->database();

	$tahun = $ci->session->userdata('tahun');
	$ci->db->select('nama_aset');
	$ci->db->from('mst_aset_bukan_investasi');
	$ci->db->where('id_jns_aset' , $id_jns_aset);
	$query = $ci->db->get();
	return $query->result();
}

function getAll_AsetBknInvest(){
	$ci = & get_instance();
	$ci->load->database();

	$tahun = $ci->session->userdata('tahun');
	$ci->db->select('*');
   // $ci->db->from('mst_pihak');
	$ci->db->from('mst_aset_bukan_investasi');
	$query = $ci->db->get();
	return $query->result();
}

// format tanggal indonesia
function indo_tgl($tanggal){
	$bulan = array(1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
	$split = explode('-', $tanggal);
	return $split[2].' '.$bulan[(int)$split[1]].' '.$split[0];

}

function check_access($role_id, $menu_id){
	$ci = get_instance();

	$ci->db->where('idusergroup', $role_id);
	$ci->db->where('tbl_menu_id', $menu_id);
	$result = $ci->db->get('tbl_access_menu');

	if ($result->num_rows() > 0) {
		return "checked='checked'";
	}
}


	function sidebar_menu(){
		$ci = get_instance();
		$idusergroup = $ci->session->userdata('idusergroup');
		$tahun = $ci->session->userdata('tahun');
		
		$sql = "
			SELECT A.idusergroup, B.menu, B.url, B.icon, B.is_active, B.type_menu, B.id as tbl_menu_id
			FROM tbl_access_menu A
			LEFT JOIN tbl_menu B ON B.id = A.tbl_menu_id
			WHERE A.idusergroup= '".$idusergroup."'  
			AND (B.type_menu='P' OR B.type_menu='PC') 
			AND B.is_active='1'
			ORDER BY B.no_urut ASC
		";

		$parent = $ci->db->query($sql)->result_array();
		$menu = array();
		foreach($parent as $v){
			$menu[$v['tbl_menu_id']]=array();
			$menu[$v['tbl_menu_id']]['parent']=$v['menu'];
			$menu[$v['tbl_menu_id']]['icon_menu']=$v['icon'];
			$menu[$v['tbl_menu_id']]['url']=$v['url'];
			$menu[$v['tbl_menu_id']]['type_menu']=$v['type_menu'];
			$menu[$v['tbl_menu_id']]['child']=array();
			$sql="
				SELECT A.idusergroup, B.menu, B.url, B.icon, B.is_active, B.type_menu, B.id as tbl_menu_id
				FROM tbl_access_menu A
				LEFT JOIN tbl_menu B ON B.id = A.tbl_menu_id
				WHERE A.idusergroup= '".$idusergroup."' 
				AND (B.type_menu='C' OR B.type_menu='CH') 
				AND B.is_active='1' 
				AND B.parent_id='".$v['tbl_menu_id']."'
				ORDER BY B.no_urut ASC
			";
			$child = $ci->db->query($sql)->result_array();
			foreach($child as $x){
				$menu[$v['tbl_menu_id']]['child'][$x['tbl_menu_id']]=array();
				$menu[$v['tbl_menu_id']]['child'][$x['tbl_menu_id']]['menu']=$x['menu'];
				$menu[$v['tbl_menu_id']]['child'][$x['tbl_menu_id']]['type_menu']=$x['type_menu'];
				$menu[$v['tbl_menu_id']]['child'][$x['tbl_menu_id']]['url']=$x['url'];
				$menu[$v['tbl_menu_id']]['child'][$x['tbl_menu_id']]['icon_menu']=$x['icon'];

		        //level 3......

		        if($x['type_menu'] == 'CHC'){
		          $menu[$v['tbl_menu_id']]['child'][$x['tbl_menu_id']]['sub_child'] = array();
		          $sqlSubChild="
		             SELECT A.idusergroup, B.tbl_menu_id, B.menu, B.url, B.icon, B.is_active, B.type_menu, B.id as tbl_menu_id
		             FROM tbl_access_menu A
		             LEFT JOIN tbl_menu B ON B.id = A.tbl_menu_id
		             WHERE A.idusergroup='".$idusergroup."'  
		             AND B.type_menu='CC' 
		             AND B.is_active='1' 
		             AND B.parent_id_2=".$v['tbl_menu_id']."
		             ORDER BY B.tbl_menu_id ASC
		         ";
		          $SubChild = $ci->db->query($sqlSubChild)->result_array();
		          foreach($SubChild as $z){
		            $menu[$v['tbl_menu_id']]['child'][$x['tbl_menu_id']]['sub_child'][$z['tbl_menu_id']]['sub_menu'] = $z['menu'];
		            $menu[$v['tbl_menu_id']]['child'][$x['tbl_menu_id']]['sub_child'][$z['tbl_menu_id']]['type_menu'] = $z['type_menu'];
		            $menu[$v['tbl_menu_id']]['child'][$x['tbl_menu_id']]['sub_child'][$z['tbl_menu_id']]['url'] = $z['url'];
		            $menu[$v['tbl_menu_id']]['child'][$x['tbl_menu_id']]['sub_child'][$z['tbl_menu_id']]['icon_menu'] = $z['icon'];
		          }
		        }

			}
		}

		// echo "<pre>"; print_r($menu);exit;
		return $menu;
	}


	function Encrypt($link='')
	{
		$res = str_replace('=','',base64_encode($link));
		return $res;
	}


	function dtuser(){
		$data = array(
			'0' => array('id'=>'TSN002','txt'=>'TASPEN'),
			'1' => array('id'=>'ASB003','txt'=>'ASABRI'),

		);
		return $data;
	}

	function group_investasi(){
		$data = array(
			'0' => array('id'=>'INVESTASI','txt'=>'INVESTASI'),
			'1' => array('id'=>'BUKAN INVESTASI','txt'=>'BUKAN INVESTASI'),
			'2' => array('id'=>'KEWAJIBAN','txt'=>'KEWAJIBAN'),
			'3' => array('id'=>'HASIL INVESTASI','txt'=>'HASIL INVESTASI'),
			'4' => array('id'=>'IURAN','txt'=>'IURAN'),
			'5' => array('id'=>'BEBAN','txt'=>'BEBAN'),
			'6' => array('id'=>'BEBAN INVESTASI','txt'=>'BEBAN INVESTASI'),
			'7' => array('id'=>'NILAI INVESTASI','txt'=>'NILAI INVESTASI'),
			'8' => array('id'=>'ASET TETAP','txt'=>'ASET TETAP'),

		);
		return $data;
	}

	function group_pihak_investasi(){
		$data = array(
			'0' => array('id'=>'INVESTASI','txt'=>'INVESTASI'),
			'1' => array('id'=>'BUKAN INVESTASI','txt'=>'BUKAN INVESTASI'),
			'2' => array('id'=>'HASIL INVESTASI','txt'=>'HASIL INVESTASI'),

		);
		return $data;
	}

	function typeParent(){
		$data = array(
			'0' => array('id'=>'P','txt'=>'P'),
			'1' => array('id'=>'PC','txt'=>'PC'),

		);
		return $data;
	}

	function semester(){
		$data = array(
			'0' => array('id'=>'1','txt'=>'Semester I'),
			'1' => array('id'=>'2','txt'=>'Semester II'),

		);
		return $data;
	}


	function aruskas(){
		$data = array(
			'0' => array('id'=>'INVESTASI','txt'=>'INVESTASI'),
			'1' => array('id'=>'OPERASIONAL','txt'=>'OPERASIONAL'),
			'2' => array('id'=>'PENDANAAN','txt'=>'PENDANAAN'),

		);
		return $data;
	}

	function flag_kelompok(){
		$data = array(
			'0' => array('id'=>'1','txt'=>'TASPEN'),
			'1' => array('id'=>'2','txt'=>'ASABRI'),

		);
		return $data;
	}

	function form(){
		$data = array(
			'0' => array('id'=>'1','txt'=>'Form-1'),
			'1' => array('id'=>'2','txt'=>'Form-2'),
			'2' => array('id'=>'3','txt'=>'Form-3'),
			'3' => array('id'=>'4','txt'=>'Form-4'),
			'4' => array('id'=>'5','txt'=>'Form-5'),
			'5' => array('id'=>'6','txt'=>'Form-6'),
			'6' => array('id'=>'7','txt'=>'Form-7'),
			'7' => array('id'=>'8','txt'=>'Form-8'),
			'8' => array('id'=>'9','txt'=>'Form-9'),
			'9' => array('id'=>'10','txt'=>'Form-10'),
			'10' => array('id'=>'11','txt'=>'Form-11'),

		);
		return $data;
	}


	function geometric_average($a) {  
		// $mul=0;
       	foreach($a as $i=>$n) $mul = $i == 0 ? $n : $mul*$n;  
       	return pow($mul,1/count($a));  

    }

    function beban_investasi(){
		$data = array(
			'0' => array('id'=>'INVESTASI','txt'=>'INVESTASI'),
			'1' => array('id'=>'OPERASIONAL','txt'=>'OPERASIONAL'),
			'2' => array('id'=>'PENDANAAN','txt'=>'PENDANAAN'),

		);
		return $data;
	}

	function combo_audit(){
		$data = array(
			'0' => array('id'=>'ASLI','txt'=>'Laporan Asli'),
			'1' => array('id'=>'AUDIT','txt'=>'Laporan Audit'),

		);
		return $data;
	}


	function combo_dashboard(){
		$data = array(
			'0' => array('id'=>'BULANAN','txt'=>'BULANAN'),
			'1' => array('id'=>'SEMESTERAN','txt'=>'SEMESTERAN'),
			'2' => array('id'=>'TAHUNAN','txt'=>'TAHUNAN'),

		);
		return $data;
	}

	function combo_dashboard2(){
		$data = array(
			'0' => array('id'=>'SEMESTERAN','txt'=>'SEMESTERAN'),
			'1' => array('id'=>'TAHUNAN','txt'=>'TAHUNAN'),

		);
		return $data;
	}


	function combo_danabersih(){
		$data = array(
			'0' => array('id'=>'1','txt'=>'ASET INVESTASI'),
			'1' => array('id'=>'2','txt'=>'ASET BUKAN INVESTASI'),
			'2' => array('id'=>'3','txt'=>'KEWAJIBAN'),

		);
		return $data;
	}

	function combo_perubahandanabersih(){
		$data = array(
			'0' => array('id'=>'PENAMBAHAN','txt'=>'PENAMBAHAN'),
			'1' => array('id'=>'PENGURANGAN','txt'=>'PENGURANGAN'),

		);
		return $data;
	}


	function combo_bulan(){
		$data = array(
			'0' => array('id'=>'1','txt'=>'Januari'),
			'1' => array('id'=>'2','txt'=>'Februari'),
			'2' => array('id'=>'3','txt'=>'Maret'),
			'3' => array('id'=>'4','txt'=>'April'),
			'4' => array('id'=>'5','txt'=>'Mei'),
			'5' => array('id'=>'6','txt'=>'Juni'),
			'6' => array('id'=>'7','txt'=>'Juli'),
			'7' => array('id'=>'8','txt'=>'Agustus'),
			'8' => array('id'=>'9','txt'=>'September'),
			'9' => array('id'=>'10','txt'=>'Oktober'),
			'10' => array('id'=>'11','txt'=>'November'),
			'11' => array('id'=>'12','txt'=>'Desember'),

		);
		return $data;
	}

	function konversi_bln($bln,$type=""){
		if($type == 'fullbulan'){
			switch($bln){
				case 1:$bulan='Januari';break;
				case 2:$bulan='Februari';break;
				case 3:$bulan='Maret';break;
				case 4:$bulan='April';break;
				case 5:$bulan='Mei';break;
				case 6:$bulan='Juni';break;
				case 7:$bulan='Juli';break;
				case 8:$bulan='Agustus';break;
				case 9:$bulan='September';break;
				case 10:$bulan='Oktober';break;
				case 11:$bulan='November';break;
				case 12:$bulan='Desember';break;
			}
		}else{
			switch($bln){
				case 1:$bulan='Jan';break;
				case 2:$bulan='Feb';break;
				case 3:$bulan='Mar';break;
				case 4:$bulan='Apr';break;
				case 5:$bulan='Mei';break;
				case 6:$bulan='Jun';break;
				case 7:$bulan='Jul';break;
				case 8:$bulan='Ags';break;
				case 9:$bulan='Sep';break;
				case 10:$bulan='Okt';break;
				case 11:$bulan='Nov';break;
				case 12:$bulan='Des';break;
			}
		}
		
		return $bulan;
	}

	
	function getSemester(){
		$bulan = date("m");

		switch($bulan){
			case 1:$semester=1;break;
			case 2:$semester=1;break;
			case 3:$semester=1;break;
			case 4:$semester=1;break;
			case 5:$semester=1;break;
			case 6:$semester=1;break;
			case 7:$semester=2;break;
			case 8:$semester=2;break;
			case 9:$semester=2;break;
			case 10:$semester=2;break;
			case 11:$semester=2;break;
			case 12:$semester=2;break;
		}
		
		return $semester;
	}

	function konversi_semester($semester,$type=""){
		if($type == 'full'){
			switch($semester){
				case 1:$semester='Semester I';break;
				case 2:$semester='Semester II';break;
			}
		}else{
			switch($semester){
				case 1:$semester='I';break;
				case 2:$semester='II';break;
			}
		}
		
		return $semester;
	}



	function tgl_format($date){
		return date('d-m-Y', strtotime($date));
	}
	
	function tgl_format_default($date){
		return date('Y-m-d', strtotime($date));
	}

	function getJenisInvest($p1){
	$ci = & get_instance();
	$ci->load->database();

	$ci->db->select('jenis_investasi');
	$ci->db->from('mst_investasi');
	$ci->db->where('id_investasi' , $p1);
	$query = $ci->db->get();
	return $query->row_array();
}


function get_status_input($id_user="", $tahun="", $id_bulan=""){
	$ci = & get_instance();
	$ci->load->database();

		
	$sql = "
		SELECT A.iduser,A.tahun,A.id_bulan,A.status
		FROM bln_pendahuluan A
		WHERE A.iduser = '".$id_user."'
		AND A.tahun = '".$tahun."'
		AND A.id_bulan = '".$id_bulan."'
	";

	$balikan = false;
	$var =  $ci->db->query($sql)->row_array();
	if ($var) {
		if($var['status'] == 'Selesai'){
			$balikan = false;
		} else {
			$balikan = true;
		}
	  } else {
		$balikan = true;
	  }

	return $balikan;

}


function get_status_input_semester($id_user="", $tahun="", $id_semester=""){
	$ci = & get_instance();
	$ci->load->database();

		
	$sql = "
		SELECT A.iduser,A.tahun,A.semester,A.status
		FROM tb_pendahuluan_semesteran A
		WHERE A.iduser = '".$id_user."'
		AND A.tahun = '".$tahun."'
		AND A.semester = '".$id_semester."'
	";

	$balikan = false;
	$var =  $ci->db->query($sql)->row_array();
	if ($var) {
		if($var['status'] == 'Selesai'){
			$balikan = false;
		} else {
			$balikan = true;
		}
	  } else {
		$balikan = true;
	  }

	return $balikan;

}


function invalid_id_investasi($id_user){
	$ci = & get_instance();
	$ci->load->database();

		
	$sql = "
		SELECT A.id_investasi, A.jenis_investasi
		FROM mst_investasi A
		WHERE A.iduser = '".$id_user."'
		AND A.type_sub_jenis_investasi = 'PC'
	";
	// var_dump($sql);exit;
	$result = $ci->db->query($sql)->result_array();
	$invalid_id = [];
	foreach ($result as $row)
	{
		$invalid_id[] = $row['id_investasi'];
	}
	// var_dump($invalid_id);exit;
	return $invalid_id;

}


function get_invalid_pihak($id_user,$detail){
	$ci = & get_instance();
	$ci->load->database();
	$msg_pihak = [];
	foreach($detail as $keyDet => $v)
	{
		$sql = "
			SELECT kode_pihak, nama_pihak
			FROM mst_pihak
			WHERE iduser = '".$id_user."'
			AND kode_pihak = '".$v->kode_pihak."'
		";

		$result = $ci->db->query($sql)->row_array();
		if(empty($result))
		{
			$msg_pihak[]= $v->kode_pihak;
		}
		
	}

	return $msg_pihak;

}

function valid_id_aruskas($id_user){
	$ci = & get_instance();
	$ci->load->database();

		
	$sql = "
		SELECT A.id_aruskas, A.jenis_kas
		FROM mst_aruskas A
		WHERE A.iduser = '".$id_user."'
	";
	// var_dump($sql);exit;
	$result = $ci->db->query($sql)->result_array();
	$valid_id = [];
	foreach ($result as $row)
	{
		$valid_id[] = $row['id_aruskas'];
	}
	// var_dump($invalid_id);exit;
	return $valid_id;

}

function get_group($id_investasi){
	$ci = & get_instance();
	$ci->load->database();

	$sql = "SELECT `group` FROM mst_investasi where id_investasi = '".$id_investasi."' ";
	// echo $sql;exit;
	$query = $ci->db->query($sql);
	$string = $query->row_array();
	// echo $string;exit;
	return $string['group'];

}


function get_kode_pihak($id){
	$ci = & get_instance();
	$ci->load->database();

	$sql = "SELECT kode_pihak FROM tmp_mst_pihak where id = '".$id."' ";
	// echo $sql;exit;
	$query = $ci->db->query($sql);
	$string = $query->row_array();
	// echo $string;exit;
	return $string['kode_pihak'];

}




function terbilang($x) {
  $angka = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];

  if ($x < 12)
    return " " . $angka[$x];
  elseif ($x < 20)
    return terbilang($x - 10) . " belas";
  elseif ($x < 100)
    return terbilang($x / 10) . " puluh" . terbilang($x % 10);
  elseif ($x < 200)
    return "seratus" . terbilang($x - 100);
  elseif ($x < 1000)
    return terbilang($x / 100) . " ratus" . terbilang($x % 100);
  elseif ($x < 2000)
    return "seribu" . terbilang($x - 1000);
  elseif ($x < 1000000)
    return terbilang($x / 1000) . " ribu" . terbilang($x % 1000);
  elseif ($x < 1000000000)
    return terbilang($x / 1000000) . " juta" . terbilang($x % 1000000);
}
	




	// Shortens a number and attaches K, M, B, etc. accordingly
function number_shorten($number, $precision = 3, $divisors = null) {

    // Setup default $divisors if not provided
    if (!isset($divisors)) {
        $divisors = array(
            pow(1000, 0) => '', // 1000^0 == 1
            pow(1000, 1) => 'K', // Thousand
            pow(1000, 2) => 'M', // Million
            pow(1000, 3) => 'B', // Billion
            pow(1000, 4) => 'T', // Trillion
            pow(1000, 5) => 'Qa', // Quadrillion
            pow(1000, 6) => 'Qi', // Quintillion
        );    
    }

    // Loop through each $divisor and find the
    // lowest amount that matches
    foreach ($divisors as $divisor => $shorthand) {
        if (abs($number) < ($divisor * 1000)) {
            // We found a match!
            break;
        }
    }

    // We found our match, or there were no matches.
    // Either way, use the last defined value for $divisor.
    return number_format($number / $divisor, $precision) . $shorthand;
}

function getTableauToken(){

		$ci = & get_instance();
		$ci->load->database();

		$idusergroup = $ci->session->userdata('idusergroup');
		// idusergroup dja = 1, taspen = 2, asabri = 3
		if ($idusergroup == 1) {
			$userTableau = 'djav3';
		} else if($idusergroup == 3){
			$userTableau = 'djav4';
		} else if($idusergroup == 2){
			$userTableau = 'djav1';
		} else {
			$userTableau = '';
		}

	 $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => "username=user.".$userTableau."&target_site=DJA"
            ),
            'ssl'=>array(
                'verify_peer'=>false,
                'verify_peer_name'=>false
            ),
        );

    $context  = stream_context_create($opts);
    $ticket = file_get_contents('https://dashboard-sldk.kemenkeu.go.id/trusted', false, $context);     

    return $ticket;
}