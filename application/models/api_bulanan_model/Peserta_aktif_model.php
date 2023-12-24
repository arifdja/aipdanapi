<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peserta_aktif_model extends CI_Model {

  private $table;
  function __construct(){
    parent::__construct();
    $this->table = 'tbl_lkao_peserta_aktif';
    date_default_timezone_set('Asia/Jakarta');
  }

  

  public function get($bulan=null,$tahun=null,$user=null)
  {
    if (null === $bulan) {
      $bulan = 0;
    }

    if (null === $tahun) {
      $tahun = 0;
    }
    
      $this->db->select('id,iduser,bulan,tahun,jml_peserta_aktif,jml_pensiunan,jml_pembayaran');
      $this->db->where('bulan',$bulan);
      $this->db->where('tahun',$tahun);
      $this->db->where('iduser',$user);
      $result = $this->db->get($this->table)->row_array();
      // penghubungnya
      // -iduser, bulan,tahun, id_penerima,id_kelompok,sumber_dana
    //   foreach ($result as $key => $value) {
    //     $idHeader = $value['id'];
    //     $userHeader = $value['iduser'];
    //     $bulanHeader = $value['bulan'];
    //     $tahunHeader = $value['tahun'];
    //     $penerimaHeader = $value['id_penerima'];
    //     $kelompokHeader = $value['id_kelompok'];
    //     $sdHeader = $value['sumber_dana'];

    //     $this->db->select('id_cabang,jml_penerima,jml_pembayaran');
    //     $this->db->where('iduser',$userHeader);
    //     $this->db->where('bulan',$bulanHeader);
    //     $this->db->where('tahun',$tahunHeader);
    //     $this->db->where('id_penerima',$penerimaHeader);
    //     $this->db->where('id_kelompok',$kelompokHeader);
    //     $this->db->where('sumber_dana',$sdHeader);
    //     $resultDetail = $this->db->get($this->tableDetail)->result_array();
        
    //     $result[$key]['detail'] = $resultDetail;
    //     unset($result[$key]['id']);
    //   }
    // var_dump($result);exit;
      return $result;
    
  }

  public function delete($bulan=null,$tahun=null,$user=null)
  {
    if (null === $bulan) {
        $bulan = 0;
    }
    if (null === $tahun) {
        $tahun = 0;
    }
    
    $this->db->select('id');
    $this->db->where('iduser',$user);
    // echo "tes";exit;
    $status_input = get_status_input($user,$tahun,$bulan);

    // var_dump($status_input);exit;

    if($status_input == true){
    
    $this->db->where('bulan',$bulan);
    $this->db->where('tahun',$tahun);
    $this->db->delete($this->table);
    $del = $this->db->affected_rows();
    
    $res['msg'].= $this->db->affected_rows()." data deleted, ";

    } else {
    $res['msg'].= "Invalid status input $user $tahun $bulan, ";

    }
    return $res;
    
  }

  public function insert($data,$user)
  {

    $dataInsert =array();
    $dataUpdate =array();

    $arrBulan = array(1,2,3,4,5,6,7,8,9,10,11,12,13);
    $insert_at = date('Y-m-d H:i:s');

    // master user
    $this->db->select('iduser');
    $resUser = $this->db->get('t_user')->result_array();
    $arrUSER = array();
    foreach ($resUser as $key => $value) {
      $arrUSER[] = $value['iduser'];
    }

    $msg='';
    foreach ($data as $key => $value) {

      $id_user = $user;
      $bln = $value['bulan'];
      $tahun = $value['tahun'];
      $jml_peserta_aktif = $value['jml_peserta_aktif'];
      $jml_pensiunan = $value['jml_pensiunan'];
      $jml_pembayaran = $value['jml_pembayaran'];


      // cek data id investasi
      if (in_array($id_user, $arrUSER) && in_array($bln, $arrBulan)) {
        // jika key nya not null maka id investasi merupakan INVESTASI
        
        $status_input = get_status_input($id_user,$tahun,$bln);

        if($status_input == true){

          $cekdata = $this->db->get_where($this->table,array('iduser'=>$id_user,'bulan'=>$bln,'tahun'=>$tahun))->num_rows();
          
          if ($cekdata>0) {
            $getdata = $this->db->get_where($this->table,array('iduser'=>$id_user,'bulan'=>$bln,'tahun'=>$tahun))->row();

            
            // update header
            // $detail = $value['detail'];
            // unset($data[$key]['detail']);
            // unset($value['detail']);
            $dataUpdate=$value;
            $dataUpdate['insert_at']=$getdata->insert_at;
            $dataUpdate['update_at']=$insert_at;
            

            $this->db->where('iduser',$user);
            $this->db->where('bulan',$value['bulan']);
            $this->db->where('tahun',$value['tahun']);
            $this->db->update($this->table , $dataUpdate);
            $jumlahUpdate = $this->db->affected_rows();
          
            
            if ($jumlahUpdate>0) {
              $msg.= '<< Data Berhasil Diperbarui >>';
            }
          }else{

            $value['iduser']=$user;
            $dataInsert=$value;
        // var_dump($value);exit;
            $dataInsert['insert_at']=$insert_at;
            
            $insert = $this->db->insert($this->table, $dataInsert);
            $jumlahInsert = $this->db->affected_rows();
            if ($jumlahInsert>0) {
              $msg.= '<< Data Berhasil Ditambahkan >>';
            }
            
          }

        }else{
          $status = 0;
          $msg.="<< Invalid status input $id_user $tahun $bln >>";
          // jika key nya null maka error karna bukan INVESTASI
        }

      } else {
        $status = 0;
        $msg.='<< Invalid Id Investasi '.$id_investasi.' >>';
      }
    }

    $res=array();
    $res['error']=false;
    $res['msg']=$msg;

    return $res;
  }

}