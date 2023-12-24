
<?php
use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/Format.php';

class Peserta_aktif extends REST_Controller
{
    public function __construct($config = 'rest')
    {
        // echo "tes";exit;
        parent::__construct($config = 'rest');
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('api_bulanan_model/peserta_aktif_model','modelnya');
        $this->load->library('Authorization_Token');  
        $this->load->library('form_validation');  
    }
    public function index_get()
    {
        $headers = $this->input->request_headers(); 


        if (isset($headers['Authorization'])) {

          $decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
          if ($decodedToken['status']) {

              // start
            if (isset($headers['bulan']) && isset($headers['tahun'])) {
              $bulan = $headers['bulan']==null?null:$headers['bulan'];  
              $tahun = $headers['tahun']==null?null:$headers['tahun'];  
              // get from token
              $user = $decodedToken['data']->id_aktif;

            //   var_dump($user);exit;
              $res = $this->modelnya->get($bulan,$tahun,$user);
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
            $this->response($decodedToken); 
          }
        }else{
          $this->response(array('status'=> false, 'msg'=> 'Please Enter Your Authorization Token'));  
        }
        

      }

    public function index_delete()
    {
        $headers = $this->input->request_headers(); 

        if (isset($headers['Authorization'])) {

          $decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
          if ($decodedToken['status']) {

              // start
            if (isset($headers['bulan']) && isset($headers['tahun'])) {
              $bulan = $headers['bulan']==null?null:$headers['bulan'];  
              $tahun = $headers['tahun']==null?null:$headers['tahun'];
              // get from token
              $user = $decodedToken['data']->id_aktif;
              $res = $this->modelnya->delete($bulan,$tahun,$user);
              $this->response([
                'status'=>true,
                'message'=>$res['msg']
                ],REST_Controller::HTTP_OK);

            }else{
              $this->response([
              'status'=>false,
              'message'=>'Request Gagal'
              ],REST_Controller::HTTP_BAD_REQUEST);
            }
            // end
            
          }else{
            $this->response($decodedToken); 
          }
        }else{
          $this->response(array('status'=> false, 'msg'=> 'Please Enter Your Authorization Token'));  
        }

      }



      public function index_post() {
        $headers = $this->input->request_headers(); 

        if (isset($headers['Authorization'])) {

          $decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
          if ($decodedToken['status']) {
            $data = (array)json_decode(file_get_contents('php://input'));
            $post = array();
            $user = $decodedToken['data']->id_aktif;

            foreach($data as $k=>$v){
              foreach ($v as $j => $y) {
                if($y!=""){
                  $post[$k][$j] = escape($y);
                }else{
                  $post[$k][$j] = null;
                }
              }
            }

            if ((is_countable($post)?$post:[])) { 
              $insert = $this->modelnya->insert($post,$user);
              if ($insert['error']===false) {
                $this->response([
                  'status'=>true,
                  'message'=> $insert['msg']
                  ],REST_Controller::HTTP_CREATED);
              }else{
                $this->response([
                    'status'=>false,
                    'message'=>$insert['msg']
                    ],REST_Controller::HTTP_BAD_REQUEST);
              }
            }else{
              $this->response([
                    'status'=>false,
                    'message'=>'Data Empty'
                    ],REST_Controller::HTTP_BAD_REQUEST);
            }

          }else{
            $this->response($decodedToken); 
          }
        }else{
          $this->response(array('status'=> false, 'msg'=> 'Please Enter Your Authorization Token'));  
        }


        
    }

}