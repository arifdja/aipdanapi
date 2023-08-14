<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_cabang_model extends CI_Model {

  private $table;
  function __construct(){
    parent::__construct();
    $this->table = 'mst_cabang';
    date_default_timezone_set('Asia/Jakarta');
  }

  

  public function get($user=null)
  {
    $this->db->select('id_cabang,nama_cabang');
    $this->db->where('iduser',$user);
    return $this->db->get($this->table)->result_array();
  }

}