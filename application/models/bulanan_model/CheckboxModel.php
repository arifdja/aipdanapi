<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// application/models/CheckboxModel.php
class CheckboxModel extends CI_Model {
  
  private $table;
  function __construct(){
    parent::__construct();
    $this->table = 'bln_checkbox_lap';
    date_default_timezone_set('Asia/Jakarta');
  }

  public function updateCheckbox($checkboxValue, $isChecked) {
      // Ubah ini sesuai dengan nama tabel dan field di database Anda
      $this->db->where('Id_Checkbox', $checkboxValue);
      $this->db->update('bln_checkbox_lap', array('is_checked' => $isChecked ? 1 : 0));
  }
}
