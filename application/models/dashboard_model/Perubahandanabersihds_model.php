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
			// if($id_bulan == 1){
			// 	$bln_lalu = 12;
			// 	$tahun_lalu = $tahun - 1;
			// }else{
			// 	$bln_lalu = $id_bulan -1;
			// 	$tahun_lalu = $tahun;
			// }
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
						AND b.tahun = '".$tahun."'
			 			AND CAST(b.id_bulan AS UNSIGNED) = '".$p1."'
			 			AND a.`group` = '".$p2."'
			 			ORDER BY
			 			a.id_dana_besih ASC
					";
			break;

			case 'dashboard-perubahandanabersih2':
			
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
							AND b.tahun = '".$tahun."'
							 AND CAST(b.id_bulan AS UNSIGNED) = '".$p1."'
							 AND a.`group` = '".$p2."'
							 AND a.jenis_investasi = 'Pengelolaan Akumulasi Iuran Pensiun'
							 ORDER BY
							 a.id_dana_besih ASC
						";
				break;
			
				case 'dashboard-perubahandanabersih3':
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
								AND b.tahun = '".$tahun."'
								 AND CAST(b.id_bulan AS UNSIGNED) = '".$p1."'
								 AND a.`group` = '".$p2."'
								 AND a.jenis_investasi IN('BOP Pembayaran Manfaat Pensiun','Pengelolaan Akumulasi Iuran Pensiun','Beban Penyusutan dan Amortisasi')
								 ORDER BY
								 a.id_dana_besih ASC
							";
					break;
				
					case 'dashboard-perubahandanabersih4':
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
									AND b.tahun = '".$tahun."'
									 AND CAST(b.id_bulan AS UNSIGNED) = '".$p1."'
									 AND a.`group` = '".$p2."'
									 AND a.jenis_investasi = 'Manfaat Nilai Tunai (SP3IP)'
									 ORDER BY
									 a.id_dana_besih ASC
								";
						break;
					
						case 'dashboard-perubahandanabersih5':
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
										AND b.tahun = '".$tahun."'
										 AND CAST(b.id_bulan AS UNSIGNED) = '".$p1."'
										 AND a.jenis_investasi IN('Peningkatan/Penurunan Nilai Surat Utang Negara','Peningkatan/Penurunan Nilai Sukuk Pemerintah','Peningkatan/Penurunan Nilai Obligasi Korporasi','Peningkatan/Penurunan Nilai Sukuk Korporasi','Peningkatan/Penurunan Nilai Medium Term Notes','Peningkatan/Penurunan Nilai Saham','Peningkatan/Penurunan NAB Reksadana','Peningkatan/Penurunan Nilai Penyertaan Langsung','Pendapatan Investasi Lainnya')
										 ORDER BY
										 a.id_dana_besih ASC
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