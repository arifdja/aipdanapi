<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master_aruskas_model extends CI_Model {

  private $table;
  function __construct(){
    parent::__construct();
    $this->table = 'mst_aruskas';
    date_default_timezone_set('Asia/Jakarta');
  }

  

  public function get($user=null)
  {
    $this->db->select('id_aruskas,jenis_kas,arus_kas');
    $this->db->where('iduser',$user);
    return $this->db->get($this->table)->result_array();
  }

}