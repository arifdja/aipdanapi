<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Executivesummary_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->tahun = $this->session->userdata('tahun');
		$this->iduser = $this->session->userdata('iduser');
	}



	function getdata($type = "", $balikan = "", $p1 = "", $p2 = "", $p3 = "", $p4 = "")
	{

		// print_r($_POST);exit;
		$array = array();
		$where  = " WHERE 1=1 ";
		$where2  = " WHERE 1=1 ";
		$where3 = "";

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
		$id_bulan = $this->session->userdata('id_bulan');

		if ($level == 'DJA') {
			$iduser = $this->input->post('iduser');
			if ($iduser != "") {
				$iduser = $iduser;
				$where .= "
					AND b.iduser =  '" . $iduser . "'
				";
				$where2 .= "
					AND A.iduser =  '" . $iduser . "'
				";
			} else {
				$iduser = 'TSN002';
				$where .= "
					AND b.iduser =  'TSN002'
				";
				$where2 .= "
					AND A.iduser =  'TSN002'
				";
			}
		}

		if ($level == 'TASPEN' || $level == 'ASABRI') {
			$iduser = $this->session->userdata('iduser');
			$where .= "
				AND b.iduser = '" . $iduser . "'
			";

			$where2 .= "
				AND A.iduser =  '" . $iduser . "'
			";
		}

		switch ($type) {
			case 'nilai_pertumbuhan_investasi':
				$tahun_filter = $tahun - 1;
				$sql = "
					SELECT A.iduser, A.`group`,
						B.id_bulan, COALESCE(sum(B.saldo_akhir), 0) AS saldo_akhir, 
						COALESCE(sum(C.saldo_akhir), 0) AS  saldo_akhir_lalu,
						COALESCE((sum(B.saldo_akhir) - sum(C.saldo_akhir))/sum(C.saldo_akhir),0) AS pertumbuhan
						FROM mst_investasi A
						LEFT JOIN(
							SELECT id_investasi, id, keterangan, filedata, tahun,
							saldo_akhir_invest as saldo_akhir, rka, id_bulan, iduser
							FROM bln_aset_investasi_header
							WHERE id_bulan = '" . $p1 . "'
							AND iduser =  '" . $iduser . "'
							AND tahun =  '" . $tahun . "'
						) B ON A.id_investasi = B.id_investasi
						LEFT JOIN(
							SELECT id_investasi, tahun,
							saldo_akhir_invest as saldo_akhir, rka, id_bulan, iduser
							FROM bln_aset_investasi_header
							WHERE id_bulan = '12'
							AND iduser =  '" . $iduser . "'
							AND tahun =  '" . $tahun_filter . "'
						) C ON A.id_investasi = C.id_investasi
					WHERE 1=1
					AND A.`group`='INVESTASI'
					AND A.iduser = '" . $iduser . "'
					ORDER BY A.no_urut ASC
				";
				break;
			case 'aspek_operasional':
				$sql = "
					SELECT
					A.semester,
					A.tahun,
					COALESCE (SUM(A.jml_penerima), 0) AS jml_penerima,
					COALESCE (SUM(A.jml_pembayaran), 0) AS jml_pembayaran
					FROM
					tbl_lkao_pembayaran_pensiun_detail A
					$where2
					AND A.sumber_dana = '1'
					AND A.tahun = '" . $tahun . "'
					AND A.semester = '" . $p1 . "'
				";
				// echo $sql;exit();
				break;
			case 'yoi_hasil_investasi':
				$sql = "
					SELECT
					A.id_bulan,
					A.tahun,
					B.`group`,
					COALESCE(sum(A.saldo_akhir_invest), 0) as saldo_akhir,
					COALESCE(A.rka, 0) as rka,
					COALESCE(sum(A.mutasi_invest), 0) as mutasi,
					A.iduser
					FROM
					bln_aset_investasi_header A
					LEFT JOIN mst_investasi B ON A.id_investasi = B.id_investasi
					$where2
					AND A.tahun = '" . $tahun . "'
					AND B.`group` = 'HASIL INVESTASI'
					AND A.id_bulan = '" . $p1 . "'
				";
				// echo $sql;exit();
				break;
			case 'yoi_investasi':

				$sql = "
					SELECT
					A.id_bulan,
					A.tahun,
					B.`group`,
					COALESCE(sum(A.saldo_akhir_invest), 0) as saldo_akhir,
					COALESCE(A.rka, 0) as rka,
					COALESCE(sum(A.mutasi_invest), 0) as mutasi,
					A.iduser
					FROM
					bln_aset_investasi_header A
					LEFT JOIN mst_investasi B ON A.id_investasi = B.id_investasi
					$where2
					AND A.tahun = '" . $tahun . "'
					AND B.`group` = 'INVESTASI'
					AND A.id_bulan BETWEEN 1 AND '" . $p1 . "'
					GROUP BY A.id_bulan
				";
				// echo $sql;exit();
				break;

			case 'summary-bulanan':
				$sql = "SELECT
					b.id_bulan,
					b.tahun,
					b.iduser,
					a.`group`,
					b.id_investasi,
					a.jenis_investasi,
					MAX(b.mutasi_invest) AS mutasi_invest,
					MAX(b.realisasi_rka) AS realisasi_rka,
					MAX(b.rka) AS rka,
					COALESCE (SUM(b.saldo_awal_invest), 0) AS saldo_awal,
					COALESCE (SUM(b.saldo_akhir_invest), 0) AS saldo_akhir,
					ROUND(COALESCE ((SUM(b.saldo_akhir_invest)/SUM(b.rka))*100, 0),2) AS persen_rka,
					a.id_dana_besih
				FROM
					mst_investasi a
				LEFT JOIN bln_aset_investasi_header b ON a.id_investasi = b.id_investasi
				$where
				AND a.`group` = '" . $p2 . "'
				AND CAST(b.id_bulan AS UNSIGNED) = '" . $p1 . "'
				AND b.tahun = '" . $tahun . "'
				ORDER BY
				a.id_dana_besih ASC 
				";
				// echo $sql;exit();
				break;
			case 'dashboard-aruskas':
				$sql = "
					SELECT
					b.iduser,
					b.id_bulan,
					a.nama_bulan,
					b.jenis_kas,
					b.tahun,
					COALESCE (SUM(B.saldo_bulan_berjalan), 0) AS saldo_akhir
					FROM
					t_bulan a
					LEFT JOIN bln_arus_kas b ON a.id_bulan = b.id_bulan
					LEFT JOIN mst_aruskas c ON b.id_aruskas = c.id_aruskas
					$where
					AND b.tahun = '" . $tahun . "'
					AND CAST(b.id_bulan AS UNSIGNED) = '" . $p1 . "'
					AND b.jenis_kas = '" . $p2 . "'
				";

				// echo $sql;exit;
				break;

			case 'dashboard-smt-aruskas':
				$sql = "
					SELECT
					b.iduser,
					b.id_bulan,
					a.nama_bulan,
					b.jenis_kas,
					b.tahun,
					COALESCE (SUM(B.saldo_bulan_berjalan), 0) AS saldo_akhir
					FROM
					t_bulan a
					LEFT JOIN bln_arus_kas b ON a.id_bulan = b.id_bulan
					LEFT JOIN mst_aruskas c ON b.id_aruskas = c.id_aruskas
					$where
					AND b.tahun = '" . $p1 . "'
					AND CAST(b.id_bulan AS UNSIGNED) = '" . $p3 . "'
					AND b.jenis_kas = '" . $p2 . "'
				";

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
