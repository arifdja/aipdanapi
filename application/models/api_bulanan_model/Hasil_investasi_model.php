<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hasil_investasi_model extends CI_Model {

  private $table;
  function __construct(){
    parent::__construct();
    $this->table = 'bln_aset_investasi_header';
    $this->tableDetail = 'bln_aset_investasi_detail';
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
    $id = $this->db->get_where('mst_investasi',array('mst_investasi.group'=>'HASIL INVESTASI','mst_investasi.iduser'=>$user))->result_array();

    $arrID = array();
    foreach ($id as $key => $value) {
      $arrID[] = $value['id_investasi'];
    }
    // var_dump($id);exit;

    $this->db->select('id,iduser,id_investasi,id_bulan,tahun,saldo_awal_invest,mutasi_invest,saldo_akhir_invest,rka,realisasi_rka,target_yoi,keterangan');
    $this->db->where('id_bulan',$bulan);
    $this->db->where('tahun',$tahun);
    $this->db->where('iduser',$user);
    $this->db->where_in('id_investasi',$arrID);
    $result = $this->db->get($this->table)->result_array();
    foreach ($result as $key => $value) {
      $idHeader = $value['id'];
      $this->db->select('kode_pihak,saldo_awal,mutasi_pembelian,mutasi_penjualan,mutasi_amortisasi,mutasi_pasar,mutasi_penanaman,mutasi_pencairan,mutasi_nilai_wajar,mutasi_diskonto,mutasi_hasil_investasi,yield_to_maturity,saldo_akhir,lembar_saham,manager_investasi,harga_saham,nama_reksadana,jml_unit_reksadana,persentase,peringkat,tgl_jatuh_tempo,r_kupon,nama_produk,jml_unit_penyertaan,cabang,bunga,nilai_perolehan,jenis_reksadana,nilai_kapitalisasi_pasar,nilai_dana_kelolaan');
      $this->db->where('id_bulan',$bulan);
      $this->db->where('tahun',$tahun);
      $this->db->where('iduser',$user);
      $this->db->where_in('bln_aset_investasi_header_id',$idHeader);
      $resultDetail = $this->db->get($this->tableDetail)->result_array();
      $result[$key]['detail'] = $resultDetail;
      unset($result[$key]['id']);
    }
    return $result;
  
  }

  
  private function getDetil($user=null,$tahun=null,$bulan=null,$id_investasi=null,$kode_pihak=null)
  {
    if (null === $bulan) {
      $bulan = 0;
    }

    if (null === $tahun) {
      $tahun = 0;
    }

    $bulan = $bulan - 1;
    
    $sql = "SELECT a.id_investasi,b.* FROM bln_aset_investasi_header a LEFT JOIN bln_aset_investasi_detail b ON a.id = b.bln_aset_investasi_header_id WHERE b.iduser = ? AND b.tahun = ? AND b.id_bulan = ? AND a.id_investasi = ? AND b.kode_pihak = ?";

    $query = $this->db->query($sql, array($user, $tahun, $bulan,$id_investasi,$kode_pihak));

    $result = $query->row_array();

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
    
    //Cari id_investasi untuk HASIL INVESTASI
    $this->db->select('id_investasi');
    $id = $this->db->get_where('mst_investasi',array('mst_investasi.group'=>'HASIL INVESTASI','mst_investasi.iduser'=>$user))->result_array();
    $arrID = array();
    foreach ($id as $key => $value) {
      $arrID[] = $value['id_investasi'];
    }

    $status_input = get_status_input($user,$tahun,$bulan);

    if($status_input == true){

      //Cari id tabel detil untuk HASIL INVESTASI
      $this->db->select('id');
      $this->db->where('id_bulan',$bulan);
      $this->db->where('tahun',$tahun);
      $this->db->where('iduser',$user);
      $this->db->where_in('id_investasi',$arrID);
      $detailID = $this->db->get('bln_aset_investasi_header')->result_array();
      $arrDetailID = array();
      foreach ($detailID as $key => $value) {
        $arrDetailID[] = $value['id'];
      }
      
      $this->db->where('id_bulan',$bulan);
      $this->db->where('tahun',$tahun);
      $this->db->where('iduser',$user);
      $this->db->where_in('id_investasi',$arrID);
      $this->db->delete($this->table);
      $del = $this->db->affected_rows();
      
      if ($del) {
        $this->db->where('id_bulan',$bulan);
        $this->db->where('tahun',$tahun);
        $this->db->where('iduser',$user);
        $this->db->where_in('bln_aset_investasi_header_id',$arrDetailID);
        $this->db->delete($this->tableDetail);
      }

      $res['msg'].= $this->db->affected_rows()." data deleted, ";
    
    } else {
      $res['msg'].= "Invalid status input $user $tahun $bulan, ";

    }

    return $res;

    
    
  }

  
  private function validasi_saldo_awal($id_user,$tahun,$id_bulan,$id_investasi,$detail)
  {

    foreach($detail as $keyDet => $v){

      $result = $this->getDetil($id_user,$tahun,$id_bulan,$id_investasi,$v->kode_pihak);

      if($result['saldo_akhir'] != $v->saldo_awal){
        $msg.="<< Saldo awal bulan ".$id_bulan." tahun ".$tahun."  id_investasi ".$id_investasi." kode pihak ".$v->kode_pihak." tidak sama dengan saldo akhir bulan sebelumnya yaitu sebesar ".$result['saldo_akhir']."  >>";
      }

      return $msg;
    }

    
  }

  public function insert($data,$tkn)
  {
    $tknid = $tkn->id_aktif;
    $dataInsert =array();
    $dataUpdate =array();
    $arrBulan = array(1,2,3,4,5,6,7,8,9,10,11,12,13);

    $this->db->select('id_investasi');
    $id = $this->db->get_where('mst_investasi',array('mst_investasi.group'=>'HASIL INVESTASI','mst_investasi.iduser'=>$tknid))->result_array();
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
    $noHeader = 0;

    foreach ($data as $key => $value) {
      $id_investasi = $value['id_investasi'];
      $id_bulan = $value['id_bulan'];
      $id_user = $value['iduser'];
      $tahun = $value['tahun'];
      
      // $this->delete($id_bulan,$tahun,$id_user);

      
      foreach ($data as $key => $value) {
        $noHeader++;
        $noDetail = 0;
        $id_investasi = $value['id_investasi'];
        $id_bulan = $value['id_bulan'];
        $id_user = $value['iduser'];
        $tahun = $value['tahun'];
        $detail = array();
        $detail = $value['detail'];

        if (in_array($id_investasi, $arrID) && in_array($id_user, $arrUSER) && in_array($id_bulan, $arrBulan)) {

          
          $status_input = get_status_input($id_user,$tahun,$id_bulan);
          // var_dump($status_input);exit;
          if($status_input == true)
          {

            if($id_bulan != 1){
              $return = $this->validasi_saldo_awal($id_user,$tahun,$id_bulan,$id_investasi,$detail);
              if($return){
                $msg.=$return;
              }
            }
          
            $return = $this->validasi_hasil_investasi($id_investasi,$key,$data,$detail);
            if($return){
              $status = 0;
              $res=array();
              $res['error']=true;
              $res['msg']=$return;
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
    
              $cekdataDetail = $this->db->get_where($this->tableDetail,array('iduser'=>$id_user,'bln_aset_investasi_header_id'=>$idDetail,'id_bulan'=>$id_bulan,'tahun'=>$tahun))->num_rows();
    
              if ($cekdataDetail>0) {
                $del = $this->db->delete($this->tableDetail,array('iduser'=>$id_user,'bln_aset_investasi_header_id'=>$idDetail,'id_bulan'=>$id_bulan,'tahun'=>$tahun));
    
                foreach($detail as $keyDet => $v){
                  $noDetail++;
                  $dataInsertDetail = array(
                    'bln_aset_investasi_header_id' => $idDetail,
                    'id_bulan' => $id_bulan,
                    'iduser' => $id_user,
                    'tahun' => $tahun,
                    'kode_pihak' => escape($v->kode_pihak),
                    'saldo_awal' => escape($v->saldo_awal),
                    'mutasi_pembelian' => escape($v->mutasi_pembelian),
                    'mutasi_penjualan' => escape($v->mutasi_penjualan),
                    'mutasi_amortisasi' => escape($v->mutasi_amortisasi),
                    'mutasi_pasar' => escape($v->mutasi_pasar),
                    'mutasi_penanaman' => escape($v->mutasi_penanaman),
                    'mutasi_nilai_wajar' => escape($v->mutasi_nilai_wajar),
                    'mutasi_pencairan' => escape($v->mutasi_pencairan),
                    'mutasi_diskonto' => escape($v->mutasi_diskonto),
                    'mutasi_hasil_investasi' => escape($v->mutasi_hasil_investasi),
                    'yield_to_maturity' => escape($v->yield_to_maturity),
                    'saldo_akhir' => escape($v->saldo_akhir),
                    'lembar_saham' => escape($v->lembar_saham),
                    'manager_investasi' => escape($v->manager_investasi),
                    'harga_saham' => escape($v->harga_saham),
                    'nama_reksadana' => escape($v->nama_reksadana),
                    'jml_unit_reksadana' => escape($v->jml_unit_reksadana),
                    'persentase' => escape($v->persentase),
                    'peringkat' => escape($v->peringkat),
                    'tgl_jatuh_tempo' => escape($v->tgl_jatuh_tempo),
                    'r_kupon' => escape($v->r_kupon),
                    'nama_produk' => escape($v->nama_produk),
                    'jml_unit_penyertaan' => escape($v->jml_unit_penyertaan),
                    'cabang' => escape($v->cabang),
                    'bunga' => escape($v->bunga),
                    'nilai_perolehan' => escape($v->nilai_perolehan),
                    'jenis_reksadana' => escape($v->jenis_reksadana),
                    'nilai_kapitalisasi_pasar' => escape($v->nilai_kapitalisasi_pasar),
                    'nilai_dana_kelolaan' => escape($v->nilai_dana_kelolaan),
                    'insert_at' => date('Y-m-d H:i:s'),
                  );
    
                  $this->db->insert('bln_aset_investasi_detail', $dataInsertDetail);
    
                  if ($jumlahUpdate>0) {
                      $msg.= '<< Data Detail ke-'.$noDetail.' Id Investasi '.$id_investasi.' Berhasil Diperbarui >>';
                  }
    
                }
    
              }
    
              if ($jumlahUpdate>0) {
                $msg.= '<< Data Header Id Investasi '.$id_investasi.' Berhasil Diperbarui >>';
              }
              
            } else {

              //INSERT HEADER DAN DETIL

              unset($data[$key]['detail']);
              unset($value['detail']);
              $dataInsert=$value;

              $insert = $this->db->insert($this->table, $dataInsert);
              $idDetail = $this->db->insert_id();
              $jumlahInsert = $this->db->affected_rows();
              if ($jumlahInsert>0) {
                $msg.= '<< Data Header Id Investasi '.$id_investasi.' Berhasil Ditambahkan >>';
              }
              if ($insert) {
                          
                foreach($detail as $keyDet => $v){

                  $dataInsertDetail = array(
                    'bln_aset_investasi_header_id' => $idDetail,
                    'id_bulan' => $id_bulan,
                    'iduser' => $id_user,
                    'tahun' => $tahun,
                    'kode_pihak' => escape($v->kode_pihak),
                    'saldo_awal' => escape($v->saldo_awal),
                    'mutasi_pembelian' => escape($v->mutasi_pembelian),
                    'mutasi_penjualan' => escape($v->mutasi_penjualan),
                    'mutasi_amortisasi' => escape($v->mutasi_amortisasi),
                    'mutasi_pasar' => escape($v->mutasi_pasar),
                    'mutasi_penanaman' => escape($v->mutasi_penanaman),
                    'mutasi_nilai_wajar' => escape($v->mutasi_nilai_wajar),
                    'mutasi_pencairan' => escape($v->mutasi_pencairan),
                    'mutasi_diskonto' => escape($v->mutasi_diskonto),
                    'mutasi_hasil_investasi' => escape($v->mutasi_hasil_investasi),
                    'yield_to_maturity' => escape($v->yield_to_maturity),
                    'saldo_akhir' => escape($v->saldo_akhir),
                    'lembar_saham' => escape($v->lembar_saham),
                    'manager_investasi' => escape($v->manager_investasi),
                    'harga_saham' => escape($v->harga_saham),
                    'nama_reksadana' => escape($v->nama_reksadana),
                    'jml_unit_reksadana' => escape($v->jml_unit_reksadana),
                    'persentase' => escape($v->persentase),
                    'peringkat' => escape($v->peringkat),
                    'tgl_jatuh_tempo' => escape($v->tgl_jatuh_tempo),
                    'r_kupon' => escape($v->r_kupon),
                    'nama_produk' => escape($v->nama_produk),
                    'jml_unit_penyertaan' => escape($v->jml_unit_penyertaan),
                    'cabang' => escape($v->cabang),
                    'bunga' => escape($v->bunga),
                    'nilai_perolehan' => escape($v->nilai_perolehan),
                    'jenis_reksadana' => escape($v->jenis_reksadana),
                    'nilai_kapitalisasi_pasar' => escape($v->nilai_kapitalisasi_pasar),
                    'nilai_dana_kelolaan' => escape($v->nilai_dana_kelolaan),
                    'insert_at' => date('Y-m-d H:i:s'),
                  );

                  $this->db->insert('bln_aset_investasi_detail', $dataInsertDetail);
                }

              }

            }

        
          }else{
            $status = 0;
            $msg.="<< Invalid status input $id_user $tahun $id_bulan >>";
            // jika key nya null maka error karna bukan INVESTASI
          }
  
        } else {
          $status = 0;
          $msg.='<< Invalid Id Investasi '.$id_investasi.' >>';
        }

      }

      $msg.='-- Trans End --';
  
      $res=array();
      $res['error']=false;
      $res['msg']=$msg;
  
      return $res;
    }

  }


  
  
  /**
   * function validasi_hasil_investasi
   * saldo akhir = saldo awal + mutasi
   */
  private function validasi_hasil_investasi($id_investasi,$key,$data,$detail)
  {

    foreach($detail as $keyDet => $v){

      $sum_saldo_awal += $v->saldo_awal;
      $sum_mutasi_hasil_investasi += $v->mutasi_hasil_investasi;
      $sum_saldo_akhir += $v->saldo_akhir;

    }

    $sum_mutasi = $sum_mutasi_hasil_investasi;

    unset($data[$key]['detail']);
    unset($value['detail']);
    $dataInsert=$data[$key];


    $header_saldo_awal = $dataInsert['saldo_awal_invest'];
    $header_mutasi = $dataInsert['mutasi_invest'];
    $header_saldo_akhir = $dataInsert['saldo_akhir_invest'];
    $header_rka = $dataInsert['rka'];
    $header_realisasi_rka = $dataInsert['realisasi_rka'];

    if ($header_saldo_awal != $sum_saldo_awal)          {
      $msg.= '<< Saldo awal header dan detil id_investasi '.$id_investasi.' tidak valid >>';
    } 
    if ($header_mutasi != $sum_mutasi){
      $msg.= '<< Mutasi header dan detil id_investasi '.$id_investasi.' tidak valid >>';
    } 
    if ($header_saldo_akhir != $sum_saldo_akhir){
      $msg.= '<< Saldo akhir header dan detil id_investasi '.$id_investasi.' tidak valid>>';
    }
    if ($header_saldo_akhir/$header_rka*100 != $header_realisasi_rka){
      $msg.= '<< RKA id_investasi '.$id_investasi.' tidak valid>>';
    }

    return $msg;

  }

}