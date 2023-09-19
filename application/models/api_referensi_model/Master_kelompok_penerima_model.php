<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_kelompok_penerima_model extends CI_Model {

  private $table;
  function __construct(){
    parent::__construct();
    $this->table = 'mst_kelompok_penerima';
    date_default_timezone_set('Asia/Jakarta');
  }

  

  public function get()
  {
    $this->db->select('id_kelompok,kelompok_penerima');
    return $this->db->get($this->table)->result_array();
  }

}