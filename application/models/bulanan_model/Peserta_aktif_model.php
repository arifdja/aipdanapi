<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peserta_aktif_model extends CI_Model {
	private $table;
	function __construct(){
      parent::__construct();
      $this->tahun = $this->session->userdata('tahun');
      $this->iduser = $this->session->userdata('iduser');
	  $this->table = 'tbl_lkao_peserta_aktif_bulanan';
	}
	
	function getdata(){
        $tahun = $this->session->userdata('tahun');
		$iduser = $this->session->userdata('iduser');

        $sql ="
                SELECT * FROM tbl_lkao_peserta_aktif_bulanan a 
                LEFT JOIN  mst_kelompok_peserta_aktif b USING (id_kelompok,iduser)
                WHERE a.iduser = '$iduser' AND a.tahun = '$tahun'
            ";
            
        return $this->db->query($sql)->result_array();
	}
	
}