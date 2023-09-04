<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_jenis_penerima_model extends CI_Model {

  private $table;
  function __construct(){
    parent::__construct();
    $this->table = 'mst_jenis_penerima';
    date_default_timezone_set('Asia/Jakarta');
  }

  

  public function get()
  {
    $this->db->select('id_penerima,jenis_penerima');
    return $this->db->get($this->table)->result_array();
  }

}