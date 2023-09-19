
<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/Format.php';

class Master_jenis_penerima extends REST_Controller
{
    public function __construct($config = 'rest')
    {
        parent::__construct($config = 'rest');
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('api_referensi_model/master_jenis_penerima_model','modelnya');
        $this->load->library('Authorization_Token');  
        $this->load->library('form_validation');  
    }
    public function index_get()
    {
        $headers = $this->input->request_headers(); 

        if (isset($headers['Authorization'])) {

          $decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
          if ($decodedToken['status']) {
            
            $user = $decodedToken['data']->id_aktif;
            $res = $this->modelnya->get();
            if ($res) {
            $this->response([
                'status'=>true,
                'data'=>$res
                ],REST_Controller::HTTP_OK);
            
            }else{
            $this->response([
                'status'=>false,
                'message'=>'Data Not Found'
                ],REST_Controller::HTTP_NOT_FOUND);
            }

        }else{
            $this->response([
            'status'=>false,
            'message'=>'Request Gagal'
            ],REST_Controller::HTTP_BAD_REQUEST);
        }
        // end
        }else{
          $this->response(array('status'=> false, 'msg'=> 'Please Enter Your Authorization Token'));  
        }

      }

}