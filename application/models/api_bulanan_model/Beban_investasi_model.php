<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Beban_investasi_model extends CI_Model {

  private $table;
  function __construct(){
    parent::__construct();
    $this->table = 'bln_aset_investasi_header';
    $this->tableMaster = 'mst_investasi';
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
    

    $this->db->select('id_investasi');
    $id = $this->db->get_where('mst_investasi',array('mst_investasi.group'=>'BEBAN INVESTASI','mst_investasi.iduser'=>$user))->result_array();
    
    $arrID = array();
    foreach ($id as $key => $value) {
      $arrID[] = $value['id_investasi'];
    }

      $this->db->select('iduser,id_investasi,id_bulan,tahun,saldo_awal_invest,saldo_akhir_invest,rka,realisasi_rka,keterangan');
      $this->db->where('id_bulan',$bulan);
      $this->db->where('tahun',$tahun);
      $this->db->where('iduser',$user);
      $this->db->where_in('id_investasi',$arrID);
      return $this->db->get($this->table)->result_array();
    
  }

  public function delete($bulan=null,$tahun=null,$user=null)
  {
    if (null === $bulan) {
        $bulan = 0;
    }
    if (null === $tahun) {
        $tahun = 0;
    }
    
    $this->db->select('id_investasi');
    $id = $this->db->get_where('mst_investasi',array('mst_investasi.group'=>'BEBAN INVESTASI','mst_investasi.iduser'=>$user))->result_array();
    $arrID = array();
    foreach ($id as $key => $value) {
      $arrID[] = $value['id_investasi'];
    }

    
    $status_input = get_status_input($user,$tahun,$bulan);

    if($status_input == true){
      
      $this->db->where('id_bulan',$bulan);
      $this->db->where('tahun',$tahun);
      $this->db->where('iduser',$user);
      $this->db->where_in('id_investasi',$arrID);
      $this->db->delete($this->table);
      $res['msg'].= $this->db->affected_rows()." data deleted, ";

    } else {
      $res['msg'].= "Invalid status input $user $tahun $bulan, ";

    }
    return $res;
    
  }

  
  private function getHeader($user=null,$tahun=null,$bulan=null,$id_investasi=null)
  {
    if (null === $bulan) {
      $bulan = 0;
    }

    if (null === $tahun) {
      $tahun = 0;
    }

    $bulan = $bulan - 1;
    
    $sql = "SELECT * FROM bln_aset_investasi_header WHERE iduser = ? AND tahun = ? AND id_bulan = ? AND id_investasi = ?";

    $query = $this->db->query($sql, array($user, $tahun, $bulan,$id_investasi));

    $result = $query->row_array();

    return $result;
    
  }

  
  private function validasi_saldo_awal($id_user,$tahun,$id_bulan,$id_investasi,$saldo_awal_invest)
  {

    

      $result = $this->getHeader($id_user,$tahun,$id_bulan,$id_investasi);

      if($result['saldo_akhir_invest'] != $saldo_awal_invest){
        $msg.="<< Saldo awal bulan ".$id_bulan." tahun ".$tahun."  id_investasi ".$id_investasi." tidak sama dengan saldo akhir bulan sebelumnya yaitu sebesar ".$result['saldo_akhir_invest']."  >>";
      }

      return $msg;

    
  }

  public function insert($data,$tkn)
  {
    $tknid = $tkn->id_aktif;
    $dataInsert =array();
    $dataUpdate =array();
    $arrBulan = array(1,2,3,4,5,6,7,8,9,10,11,12,13);

    $this->db->select('id_investasi');
    $id = $this->db->get_where('mst_investasi',array('mst_investasi.group'=>'BEBAN INVESTASI','mst_investasi.iduser'=>$tknid))->result_array();
    $arrID = array();
    foreach ($id as $key => $value) {
      $arrID[] = $value['id_investasi'];
    }

    $this->db->select('iduser');
    $resUser = $this->db->get('t_user')->result_array();
    $arrUSER = array();
    foreach ($resUser as $key => $value) {
      $arrUSER[] = $value['iduser'];
    }

    $status = 1;
    $msg='-- Trans Begin --';
    foreach ($data as $key => $value) {
      $id_investasi = $value['id_investasi'];
      $id_bulan = $value['id_bulan'];
      $id_user = $value['iduser'];
      $tahun = $value['tahun'];
      $saldo_awal_invest = $value['saldo_awal_invest'];
      $saldo_akhir_invest = $value['saldo_akhir_invest'];
      $realisasi_rka = $value['realisasi_rka'];
      $rka = $value['rka'];
      

      // cek data id investasi
      if (in_array($id_investasi, $arrID) && in_array($id_user, $arrUSER) && in_array($id_bulan, $arrBulan)) {
        // jika key nya not null maka id investasi merupakan BEBAN INVESTASI

        
        $status_input = get_status_input($id_user,$tahun,$id_bulan);

        if($status_input == true){

          if ($saldo_akhir_invest/$rka*100 != $realisasi_rka) {
            $msg.= '<< RKA id_investasi '.$id_investasi.' tidak valid>>';
            $res['error']=true;
            $res['msg']=$msg;
          } else {
            

            if($id_bulan != 1){
              $return = $this->validasi_saldo_awal($id_user,$tahun,$id_bulan,$id_investasi,$saldo_awal_invest);
              if($return){
                $msg.=$return;
              }
            }

            $invalid_id_investasi = invalid_id_investasi($id_user);
            if(in_array($id_investasi,$invalid_id_investasi)){
              $status = 0;
              $res=array();
              $res['error']=true;
              $res['msg']="Id Investasi tidak valid";
              return $res;
            }
            
            $cekdata = $this->db->get_where($this->table,array('iduser'=>$id_user,'id_investasi'=>$id_investasi,'id_bulan'=>$id_bulan,'tahun'=>$tahun))->num_rows();
            
            if ($cekdata>0) {
              $getdata = $this->db->get_where($this->table,array('iduser'=>$id_user,'id_investasi'=>$id_investasi,'id_bulan'=>$id_bulan,'tahun'=>$tahun))->row();

              $idDetail = $getdata->id;

              // update header
              unset($data[$key]['detail']);
              unset($value['detail']);
              $dataUpdate=$value;

              $this->db->where('iduser',$value['iduser']);
              $this->db->where('id_investasi',$value['id_investasi']);
              $this->db->where('id_bulan',$value['id_bulan']);
              $this->db->where('tahun',$value['tahun']);
              $this->db->update($this->table , $dataUpdate);
              $jumlahUpdate = $this->db->affected_rows();

              if ($jumlahUpdate>0) {
                $msg.= '<< Data Header Id Investasi '.$id_investasi.' Berhasil Diperbarui >>';
              }

            }else{

              unset($data[$key]['detail']);
              unset($value['detail']);
              $dataInsert=$value;

              $insert = $this->db->insert($this->table, $dataInsert);
              $idDetail = $this->db->insert_id();
              $jumlahInsert = $this->db->affected_rows();

              if ($jumlahInsert>0) {
                $msg.= '<< Data Header Id Investasi '.$id_investasi.' Berhasil Ditambahkan >>';
              }
              
            }

          }

        } else {
          $status = 0;
          $msg.="Invalid status input $id_user $tahun $id_bulan, ";
        }

      }else{
        $status = 0;
        // jika key nya null maka error karna bukan BEBAN INVESTASI
      }
     
    }

    $msg.='-- Trans End --';
        
    $res=array();
    $res['error']=false;
    $res['msg']=$msg;

    return $res;
  }

}