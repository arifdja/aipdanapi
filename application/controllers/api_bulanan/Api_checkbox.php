
<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/Format.php';

class Api_checkbox extends REST_Controller {

  public function __construct($config = 'rest')
    {
        parent::__construct($config = 'rest');
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('bulanan_model/CheckboxModel');
        // $this->methods['index_post']['limit'] = 12;
        // $this->methods['index_delete']['limit'] = 12;
    }

    public function index_post() {
      // Dapatkan data dari POST request
      // $data = $this->input->post();
      $checkboxValue = $this->post('checkboxValue');
      $isChecked = $this->post('isChecked');
  
      // Periksa apakah parameter checkboxValue dan isChecked ada dalam data
      if (isset($checkboxValue) && isset($isChecked)) {
          // $checkboxValue = $data['checkboxValue'];
          // $isChecked = $data['isChecked'];
  
          // Panggil fungsi updateCheckbox di model
          $this->CheckboxModel->updateCheckbox($checkboxValue, $isChecked);
  
          $response = [
              'status' => 'success',
              'message' => 'Checkbox status updated successfully'
          ];
  
          // Set header dan kirim respons dalam format JSON
          $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode($response));
      } else {
          // Jika parameter tidak lengkap, kirim respons dengan kode HTTP 400 (Bad Request)
          $this->output->set_status_header(400);
          $response = [
              'status' => 'error',
              'message' => 'Both checkboxValue and isChecked parameters are required'
          ];
          $this->output
              ->set_content_type('application/json')
              ->set_output(json_encode($response));
      }
  }
  
  
  
}