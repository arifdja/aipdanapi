<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aspek_operasional_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->tahun = $this->session->userdata('tahun');
		$this->iduser = $this->session->userdata('iduser');
	}

	function getdata($type = "", $balikan = "", $p1 = "tahunan", $p2 = "1", $p3 = "", $p4 = "")
	{

		// print_r($_POST);exit;
		$array = array();
		$where  = " WHERE 1=1 ";
		$where2  = "";
		$where3 = "";
		$group1 = "";
		$group2 = "";
		$group3 = "";

		$dbdriver = $this->db->dbdriver;
		if ($dbdriver == "postgre") {
			$select = " ROW_NUMBER() OVER (ORDER BY A.id DESC) as rowID, ";
		} else {
			$select = "";
		}

		if ($this->input->post('key')) {
			$key = $this->input->post('key');
			$kat = $this->input->post('kat');
			$where .= " AND LOWER(" . $kat . ") like '%" . strtolower(trim($key)) . "%' ";
		}


		$level = $this->session->userdata('level');
		$tahun = $this->session->userdata('tahun');

		if ($level == 'DJA') {
			$iduser = $this->input->post('iduser');
			if ($iduser != "") {
				$iduser = $iduser;
				$where .= "
					AND tlppd.iduser =  '" . $iduser . "'
				";
			}
		}

		if ($level == 'TASPEN' || $level == 'ASABRI') {
			$iduser = $this->session->userdata('iduser');
			$where .= "
				AND tlppd.iduser = '" . $iduser . "'
			";
		}

		if (isset($p1)) {
			if ($p1 == "semester") {
				$group1 .= "group by tlppd.iduser, tlppd.tahun, tlppd.semester, tlppd.sumber_dana ";
			} elseif ($p1 == "tahunan") {
				$group1 .= "group by tlppd.iduser, tlppd.tahun, tlppd.sumber_dana ";
			} else {
				$group1 .= "group by tlppd.iduser, tlppd.tahun, tlppd.sumber_dana ";
			}
		} else {
			$group1 .= "group by tlppd.iduser, tlppd.tahun, tlppd.sumber_dana ";
		}

		if (isset($p2)) {
			if ($p2 == "1") {
				$where2 .= " and tlppd.sumber_dana = '1' ";
			} elseif ($p2 == "2") {
				$where2 .= " and tlppd.sumber_dana = '2' ";
			} else {
				$where2 .= " and tlppd.sumber_dana = '1' ";
			}
		} else {
			$where2 .= " and tlppd.sumber_dana = '1' ";
		}

		switch ($type) {

			case 'dashboard-smt-operasional':
				$sql = "
				select tlppd.iduser, tlppd.tahun, tlppd.semester, tlppd.sumber_dana, sum(tlppd.jml_penerima) as jml_penerima , sum(tlppd.jml_pembayaran) as jml_pembayaran  from tbl_lkao_pembayaran_pensiun_detail tlppd 
				$where
				$where2
				$group1 
				order by tlppd.tahun, tlppd.semester
				";

				// echo $sql;exit;
				break;

			case 'dashboard-smt-jenis':
				$sql = "
				select tlppd.iduser, tlppd.tahun, tlppd.semester, tlppd.id_penerima, mjp.jenis_penerima, tlppd.sumber_dana, sum(tlppd.jml_penerima) as jml_penerima ,
				sum(tlppd.jml_pembayaran) as jml_pembayaran  from tbl_lkao_pembayaran_pensiun_detail tlppd left join mst_jenis_penerima mjp on (tlppd.id_penerima = mjp.id_penerima)
				$where
				$where2
				group by tlppd.iduser, tlppd.tahun, tlppd.sumber_dana, tlppd.id_penerima
				";

				// $sql = "
				// select a.id_penerima, a.jenis_penerima , IFNULL(b.jml_penerima, 0) as jml_penerima, IFNULL(b.jml_pembayaran, 0) as jml_pembayaran from mst_jenis_penerima a left join (
				// 	select tlppd.iduser, tlppd.tahun, tlppd.semester, tlppd.id_penerima, tlppd.sumber_dana, sum(tlppd.jml_penerima) as jml_penerima , 
				// 	sum(tlppd.jml_pembayaran) as jml_pembayaran  from tbl_lkao_pembayaran_pensiun_detail tlppd left join mst_jenis_penerima mjp on (tlppd.id_penerima = mjp.id_penerima)
				// 	$where
				// 	$where2
				// 	group by tlppd.iduser, tlppd.tahun, tlppd.sumber_dana, tlppd.id_penerima
				// 	) b on (a.id_penerima = b.id_penerima)
				// ";

				// echo $sql;exit;
				break;

			case 'dashboard-smt-kelompok':
				$sql = "
				select tlppd.iduser, tlppd.tahun, tlppd.semester, tlppd.id_kelompok, mkp.kelompok_penerima, tlppd.sumber_dana, sum(tlppd.jml_penerima) as jml_penerima , 
				sum(tlppd.jml_pembayaran) as jml_pembayaran  from tbl_lkao_pembayaran_pensiun_detail tlppd left join mst_kelompok_penerima mkp on (tlppd.id_kelompok = mkp.id_kelompok)
				$where
				$where2
				group by tlppd.iduser, tlppd.tahun, tlppd.sumber_dana, tlppd.id_kelompok
				";
				// $sql = "
				// select a.id_kelompok,a.kelompok_penerima ,IFNULL(b.jml_penerima, 0) as jml_penerima, IFNULL(b.jml_pembayaran, 0) as jml_pembayaran from mst_kelompok_penerima a left join (
				// 	select tlppd.iduser, tlppd.tahun, tlppd.semester, tlppd.id_kelompok, tlppd.sumber_dana, sum(tlppd.jml_penerima) as jml_penerima , 
				// 	sum(tlppd.jml_pembayaran) as jml_pembayaran  from tbl_lkao_pembayaran_pensiun_detail tlppd 
				// 	$where
				// 	$where2
				// 	group by tlppd.iduser, tlppd.tahun, tlppd.sumber_dana, tlppd.id_kelompok
				// ) b on (a.id_kelompok = b.id_kelompok)
				// ";
				// echo $sql;exit;
				break;
		}

		if ($balikan == 'json') {
			return $this->lib->json_grid($sql, $type);
		} elseif ($balikan == 'row_array') {
			return $this->db->query($sql)->row_array();
		} elseif ($balikan == 'result') {
			return $this->db->query($sql)->result();
		} elseif ($balikan == 'result_array') {
			return $this->db->query($sql)->result_array();
		} elseif ($balikan == 'json_variable') {
			return json_encode($array);
		} elseif ($balikan == 'json_encode') {
			$data = $this->db->query($sql)->result_array();
			return json_encode($data);
		} elseif ($balikan == 'variable') {
			return $array;
		} elseif ($balikan == 'json_datatable') {
			return $this->lib->json_datatable($sql, $type);
		}
	}
}
