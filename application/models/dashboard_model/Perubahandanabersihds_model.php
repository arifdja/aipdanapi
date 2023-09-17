<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perubahandanabersihds_model extends CI_Model {

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
			case 'dashboard-perubahandanabersih':
			// kondisi bulan lalu
			if($id_bulan == 1){
				$bln_lalu = 12;
				$tahun_lalu = $tahun - 1;
			}else{
				$bln_lalu = $id_bulan -1;
				$tahun_lalu = $tahun;
			}
			$sql ="
				SELECT A.*, B.id_investasi, B.jenis_investasi, B.iduser, B.group, B.parent_id, 
				B.type_sub_jenis_investasi as type, 
				COALESCE(SUM(CASE WHEN B.group = 'HASIL INVESTASI' THEN C.mutasi else C.saldo_akhir end), 0) as saldo_akhir,
				COALESCE(SUM(CASE WHEN B.group = 'HASIL INVESTASI' THEN D.mutasi else D.saldo_akhir end), 0) as saldo_akhir_bln_lalu
				FROM mst_perubahan_danabersih A
				LEFT JOIN mst_investasi B ON A.id_perubahan_dana_bersih = B.id_perubahan_dana_bersih
				LEFT JOIN(
					SELECT id_investasi,saldo_akhir_invest as saldo_akhir, mutasi_invest as mutasi, id_bulan, tahun, iduser
					FROM bln_aset_investasi_header
					WHERE id_bulan = '".$id_bulan."'
					AND iduser = '".$iduser."'
					AND tahun = '".$tahun."'
				) C ON B.id_investasi = C.id_investasi

				LEFT JOIN(
					SELECT id_investasi,saldo_akhir_invest as saldo_akhir, mutasi_invest as mutasi, id_bulan, tahun, iduser
					FROM bln_aset_investasi_header
					WHERE id_bulan = '".$bln_lalu."'
					AND iduser = '".$iduser."'
					AND tahun = '".$tahun_lalu."'
				) D ON B.id_investasi = D.id_investasi

				WHERE B.iduser = '".$iduser."'
				GROUP BY A.uraian
			";
			break;

			case 'dashboard-smt-perubahandanabersih':
			$sql="SELECT
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
							a.id_dana_besih
						FROM
							mst_investasi a
						LEFT JOIN bln_aset_investasi_header b ON a.id_investasi = b.id_investasi
						$where
						AND b.tahun = '".$p1."'
			 			AND CAST(b.id_bulan AS UNSIGNED) = '".$p3."'
			 			AND a.`group` = '".$p2."'
			 			ORDER BY
			 			a.id_dana_besih ASC
					";
				// echo $sql;exit;
			break;
			
			case 'dashboard-thn-perubahandanabersih':
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
				a.id_dana_besih
			FROM
				mst_investasi a
			LEFT JOIN bln_aset_investasi_header b ON a.id_investasi = b.id_investasi
			$where
					AND b.tahun = '".$p1."'
					AND a.`group` = '".$p2."'
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