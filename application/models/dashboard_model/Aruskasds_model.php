<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aruskasds_model extends CI_Model {

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
					AND b.tahun = '".$tahun."'
					AND CAST(b.id_bulan AS UNSIGNED) = '".$p1."'
					AND b.jenis_kas = '".$p2."'
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
					AND b.tahun = '".$p1."'
					AND CAST(b.id_bulan AS UNSIGNED) = '".$p3."'
					AND b.jenis_kas = '".$p2."'
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