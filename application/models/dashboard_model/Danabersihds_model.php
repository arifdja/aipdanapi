<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Danabersihds_model extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->tahun = $this->session->userdata('tahun');
		$this->iduser = $this->session->userdata('iduser');
	}

	

	function getdata($type="", $balikan="", $p1="", $p2="",$p3="",$p4=""){

		// print_r($_POST);exit;
		$array = array();
		$where  = " WHERE 1=1 ";
		$where2  = " WHERE 1=1 ";
		$where3 = "";
		
		$dbdriver = $this->db->dbdriver;
		if($dbdriver == "postgre"){
			$select = " ROW_NUMBER() OVER (ORDER BY A.id DESC) as rowID, ";
		}else{
			$select = "";
		}
		
		if($this->input->post('key')){
			$key = $this->input->post('key');
			$kat = $this->input->post('kat');
			$where .= " AND LOWER(".$kat.") like '%".strtolower(trim($key))."%' ";
		}
		

		$level = $this->session->userdata('level');
		$tahun = $this->session->userdata('tahun');
		$id_bulan = $this->session->userdata('id_bulan');

		if($level == 'DJA'){
			$iduser = $this->input->post('iduser');
			if ($iduser != "") {
				$iduser = $iduser;
				$where .= "
					AND b.iduser =  '".$iduser."'
				";
			}else{
				$iduser = 'TSN002';
				$where .= "
					AND b.iduser =  'TSN002'
				";
			}
			
		}

		if($level == 'TASPEN' || $level == 'ASABRI'){
			$iduser = $this->session->userdata('iduser');
			$where .= "
				AND b.iduser = '".$iduser."'
			";
		}

		switch($type){
			case 'dashboard-danabersih':
				
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
				// echo $sql;exit;
			break;

			case 'dashboard-danabersih-sum':
				
				$sql = "SELECT
				(SELECT COALESCE(SUM(b.saldo_akhir_invest), 0)
				FROM mst_investasi a
				LEFT JOIN bln_aset_investasi_header b ON a.id_investasi = b.id_investasi
				WHERE a.`group` = 'INVESTASI'
				AND CAST(b.id_bulan AS UNSIGNED) = '" . $p1 . "'
				AND b.tahun = '" . $tahun . "'
				ORDER BY a.id_dana_besih ASC) AS saldo_investasi,
				
				(SELECT COALESCE(SUM(b.saldo_akhir_invest), 0)
				FROM mst_investasi a
				LEFT JOIN bln_aset_investasi_header b ON a.id_investasi = b.id_investasi
				WHERE a.`group` = 'BUKAN INVESTASI'
				AND CAST(b.id_bulan AS UNSIGNED) = '" . $p1 . "'
				AND b.tahun = '" . $tahun . "'
				ORDER BY a.id_dana_besih ASC) AS saldo_bukan_investasi,
				
				(SELECT COALESCE(SUM(b.saldo_akhir_invest), 0)
				FROM mst_investasi a
				LEFT JOIN bln_aset_investasi_header b ON a.id_investasi = b.id_investasi
				WHERE a.`group` = 'KEWAJIBAN'
				AND CAST(b.id_bulan AS UNSIGNED) = '" . $p1 . "'
				AND b.tahun = '" . $tahun . "'
				ORDER BY a.id_dana_besih ASC) AS saldo_kewajiban,
				
				((SELECT COALESCE(SUM(b.saldo_akhir_invest), 0)
				FROM mst_investasi a
				LEFT JOIN bln_aset_investasi_header b ON a.id_investasi = b.id_investasi
				WHERE a.`group` = 'INVESTASI'
				AND CAST(b.id_bulan AS UNSIGNED) = '" . $p1 . "'
				AND b.tahun = '" . $tahun . "'
				ORDER BY a.id_dana_besih ASC) +
				
				(SELECT COALESCE(SUM(b.saldo_akhir_invest), 0)
				FROM mst_investasi a
				LEFT JOIN bln_aset_investasi_header b ON a.id_investasi = b.id_investasi
				WHERE a.`group` = 'BUKAN INVESTASI'
				AND CAST(b.id_bulan AS UNSIGNED) = '" . $p1 . "'
				AND b.tahun = '" . $tahun . "'
				ORDER BY a.id_dana_besih ASC) -
				
				(SELECT COALESCE(SUM(b.saldo_akhir_invest), 0)
				FROM mst_investasi a
				LEFT JOIN bln_aset_investasi_header b ON a.id_investasi = b.id_investasi
				WHERE a.`group` = 'KEWAJIBAN'
				AND CAST(b.id_bulan AS UNSIGNED) = '" . $p1 . "'
				AND b.tahun = '" . $tahun . "'
				ORDER BY a.id_dana_besih ASC)) AS saldo_dana_bersih		
				";
				// echo $sql;exit;
			break;

			case 'dashboard-danabersih-pie':
				$sql = "SELECT
						a.jenis_investasi,
						COALESCE (SUM(b.saldo_akhir_invest), 0) AS saldo_akhir
					FROM
						mst_investasi a
					LEFT JOIN bln_aset_investasi_header b ON a.id_investasi = b.id_investasi
					where
					b.tahun = '" . $tahun . "'
					AND CAST(b.id_bulan AS UNSIGNED) = '" . $p1 . "'
					AND a.`group` = 'INVESTASI'
					AND a.type_sub_jenis_investasi IN('P','C')
					GROUP BY a.jenis_investasi
					ORDER BY
					a.id_dana_besih ASC
				";
				// echo $sql;exit;
			break;

			case 'dashboard-smt-danabersih':
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
				AND a.`group` = '" . $p1 . "'
				AND CAST(b.id_bulan AS UNSIGNED) = '" . $p2 . "'
				AND b.tahun = '" . $tahun . "'
				ORDER BY
				a.id_dana_besih ASC 
				";

				// echo $sql;exit;
			break;
			
			case 'dashboard-thn-danabersih-sum':
				
				$sql = "SELECT
				(SELECT COALESCE(SUM(b.saldo_akhir_invest), 0)
				FROM mst_investasi a
				LEFT JOIN bln_aset_investasi_header b ON a.id_investasi = b.id_investasi
				WHERE a.`group` = 'INVESTASI'
				AND CAST(b.id_bulan AS UNSIGNED) = '" . $p2 . "'
				AND b.tahun = '" . $tahun . "'
				ORDER BY a.id_dana_besih ASC) AS saldo_investasi,
				
				(SELECT COALESCE(SUM(b.saldo_akhir_invest), 0)
				FROM mst_investasi a
				LEFT JOIN bln_aset_investasi_header b ON a.id_investasi = b.id_investasi
				WHERE a.`group` = 'BUKAN INVESTASI'
				AND CAST(b.id_bulan AS UNSIGNED) = '" . $p2 . "'
				AND b.tahun = '" . $tahun . "'
				ORDER BY a.id_dana_besih ASC) AS saldo_bukan_investasi,
				
				(SELECT COALESCE(SUM(b.saldo_akhir_invest), 0)
				FROM mst_investasi a
				LEFT JOIN bln_aset_investasi_header b ON a.id_investasi = b.id_investasi
				WHERE a.`group` = 'KEWAJIBAN'
				AND CAST(b.id_bulan AS UNSIGNED) = '" . $p2 . "'
				AND b.tahun = '" . $tahun . "'
				ORDER BY a.id_dana_besih ASC) AS saldo_kewajiban,
				
				((SELECT COALESCE(SUM(b.saldo_akhir_invest), 0)
				FROM mst_investasi a
				LEFT JOIN bln_aset_investasi_header b ON a.id_investasi = b.id_investasi
				WHERE a.`group` = 'INVESTASI'
				AND CAST(b.id_bulan AS UNSIGNED) = '" . $p2 . "'
				AND b.tahun = '" . $tahun . "'
				ORDER BY a.id_dana_besih ASC) +
				
				(SELECT COALESCE(SUM(b.saldo_akhir_invest), 0)
				FROM mst_investasi a
				LEFT JOIN bln_aset_investasi_header b ON a.id_investasi = b.id_investasi
				WHERE a.`group` = 'BUKAN INVESTASI'
				AND CAST(b.id_bulan AS UNSIGNED) = '" . $p2 . "'
				AND b.tahun = '" . $tahun . "'
				ORDER BY a.id_dana_besih ASC) -
				
				(SELECT COALESCE(SUM(b.saldo_akhir_invest), 0)
				FROM mst_investasi a
				LEFT JOIN bln_aset_investasi_header b ON a.id_investasi = b.id_investasi
				WHERE a.`group` = 'KEWAJIBAN'
				AND CAST(b.id_bulan AS UNSIGNED) = '" . $p2 . "'
				AND b.tahun = '" . $tahun . "'
				ORDER BY a.id_dana_besih ASC)) AS saldo_dana_bersih		
				";
				// echo $sql;exit;
			break;
			case 'dashboard-thn-danabersih':
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
				AND a.`group` = '" . $p1 . "'
				AND b.tahun = '" . $tahun . "'
				AND CAST(b.id_bulan AS UNSIGNED) = '" . $p3 . "'
				ORDER BY
				a.id_dana_besih ASC 
				";

				// echo $sql;exit;
			break;

		}

		if($balikan == 'json'){
			return $this->lib->json_grid($sql,$type);
		}elseif($balikan == 'row_array'){
			return $this->db->query($sql)->row_array();
		}elseif($balikan == 'result'){
			return $this->db->query($sql)->result();
		}elseif($balikan == 'result_array'){
			return $this->db->query($sql)->result_array();
		}elseif($balikan == 'json_variable'){
			return json_encode($array);
		}elseif($balikan == 'json_encode'){
			$data = $this->db->query($sql)->result_array(); 
			return json_encode($data);
		}elseif($balikan == 'variable'){
			return $array;
		}elseif($balikan == 'json_datatable'){
			return $this->lib->json_datatable($sql, $type);
		}
	}

}