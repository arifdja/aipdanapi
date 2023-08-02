<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aset_investasi_model extends CI_Model {

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
    $id = $this->db->get_where('mst_investasi',array('mst_investasi.group'=>'INVESTASI','mst_investasi.iduser'=>$user))->result_array();
    
    $arrID = array();
    foreach ($id as $key => $value) {
      $arrID[] = $value['id_investasi'];
    }

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
    
    $this->db->select('id_investasi');
    $id = $this->db->get_where('mst_investasi',array('mst_investasi.group'=>'INVESTASI','mst_investasi.iduser'=>$user))->result_array();
    $arrID = array();
    foreach ($id as $key => $value) {
      $arrID[] = $value['id_investasi'];
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
        $this->db->delete($this->tableDetail);
      }

      return $this->db->affected_rows();
    
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

  public function insert($data)
  {
    $dataInsert =array();
    $dataUpdate =array();
    $arrBulan = array(1,2,3,4,5,6,7,8,9,10,11,12,13);

    $this->db->select('id_investasi');
    $id = $this->db->get_where('mst_investasi',array('mst_investasi.group'=>'INVESTASI'))->result_array();
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
      $id_bulan = $value['id_bulan'];
      $id_user = $value['iduser'];
      $tahun = $value['tahun'];
    }

    foreach ($data as $key => $value) {
      $noHeader++;
      $noDetail = 0;
      $id_investasi = $value['id_investasi'];
      $id_bulan = $value['id_bulan'];
      $id_user = $value['iduser'];
      $tahun = $value['tahun'];
      $detail = array();
      $detail = $value['detail'];

      // cek data id investasi
      if (in_array($id_investasi, $arrID) && in_array($id_user, $arrUSER) && in_array($id_bulan, $arrBulan)) {
        // jika key nya not null maka id investasi merupakan INVESTASI

        if($id_bulan != 1){
          $return = $this->validasi_saldo_awal($id_user,$tahun,$id_bulan,$id_investasi,$detail);
          if($return){
            $msg.=$return;
          }
        }
        
        // untuk mencari id investasi dari jenis form
        // Contoh data group 1 = '1','88'
        $where_group1 = array('1');
        $this->db->select('id_investasi');
        $this->db->where('mst_investasi.group','INVESTASI');
        $this->db->where_in('jns_form',$where_group1);
        $group1 = $this->db->get('mst_investasi')->result_array();
        foreach($group1 as $g) {
          $arr_group[1][] = $g['id_investasi'];
        }

        // Contoh data group 2 = '2','3','4','6','10','11','14','15','16','17','18','19','20','21','22'
        $where_group2 = array('2','8','4');
        $this->db->select('id_investasi');
        $this->db->where('mst_investasi.group','INVESTASI');
        $this->db->where_in('jns_form',$where_group2);
        $group2 = $this->db->get('mst_investasi')->result_array();
        foreach($group2 as $g) {
          $arr_group[2][] = $g['id_investasi'];
        }

        // Contoh data group 3 = '5','7','8'
        $where_group3 = array('7','9');
        $this->db->select('id_investasi');
        $this->db->where('mst_investasi.group','INVESTASI');
        $this->db->where_in('jns_form',$where_group3);
        $group3 = $this->db->get('mst_investasi')->result_array();
        foreach($group3 as $g) {
          $arr_group[3][] = $g['id_investasi'];
        }

        // Contoh data group 4 = '9','12'
        $where_group4 = array('3','5');
        $this->db->select('id_investasi');
        $this->db->where('mst_investasi.group','INVESTASI');
        $this->db->where_in('jns_form',$where_group4);
        $group4 = $this->db->get('mst_investasi')->result_array();
        foreach($group4 as $g) {
          $arr_group[4][] = $g['id_investasi'];
        }

        // Contoh data group 5 = '13'
        $where_group5 = array('6');
        $this->db->select('id_investasi');
        $this->db->where('mst_investasi.group','INVESTASI');
        $this->db->where_in('jns_form',$where_group5);
        $group5 = $this->db->get('mst_investasi')->result_array();
        foreach($group5 as $g) {
          $arr_group[5][] = $g['id_investasi'];
        }
        
        if(in_array($id_investasi,$arr_group[1])){
          //saldo akhir = saldo awal + penanaman - pencairan
          $return = $this->validasi_form_1($id_investasi,$key,$data,$detail);
          if($return){
            $status = 0;
            $res=array();
            $res['error']=true;
            $res['msg']=$return;
            return $res;
          }
          
        } elseif (in_array($id_investasi,['2','3','4','6','10','11','14','15','16','17','18','19','20','21','22'])) {
          //saldo akhir = saldo awal + pembelian - penjualan + diskonto/premium + kenaikan/penurunan harga pasar
          $return = $this->validasi_form_2($id_investasi,$key,$data,$detail);
          if($return){
            $status = 0;
            $res=array();
            $res['error']=true;
            $res['msg']=$return;
            return $res;
          }
        } elseif (in_array($id_investasi,['5','7','8'])) {
          //saldo akhir = saldo awal + pembelian - penjualan + amortisasi + mutasi pasar
          $return = $this->validasi_form_3($id_investasi,$key,$data,$detail);
          if($return){
            $status = 0;
            $res=array();
            $res['error']=true;
            $res['msg'].=$return;
            return $res;
          }
        } elseif (in_array($id_investasi,['9','12'])) {
          //saldo akhir = saldo awal + pembelian - penjualan + harga pasar
          $return = $this->validasi_form_4($id_investasi,$key,$data,$detail);
          if($return){
            $status = 0;
            $res=array();
            $res['error']=true;
            $res['msg']=$return;
            return $res;
          }
        } elseif (in_array($id_investasi,['13'])) {
          //saldo akhir = saldo awal + pembelian - penjualan + nilai wajar
          $return = $this->validasi_form_5($id_investasi,$key,$data,$detail);
          if($return){
            $status = 0;
            $res=array();
            $res['error']=true;
            $res['msg']=$return;
            return $res;
          }
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
          
          // insert detail
        }
        
      }else{
        $status = 0;
        // jika key nya null maka error karna bukan INVESTASI
      }

    }

    $msg.='-- Trans End --';

    $res=array();
    $res['error']=false;
    $res['msg']=$msg;

    return $res;
  }

  /**
   * saldo akhir = saldo awal + penanaman - pencairan
   */
  private function validasi_form_1($id_investasi,$key,$data,$detail)
  {

    foreach($detail as $keyDet => $v){

      $sum_saldo_awal += $v->saldo_awal;
      $sum_mutasi_penanaman += $v->mutasi_penanaman;
      $sum_mutasi_pencairan += $v->mutasi_pencairan;
      $sum_saldo_akhir += $v->saldo_akhir;

    }

    $sum_mutasi = $sum_mutasi_penanaman - $sum_mutasi_pencairan;

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

  
  /**
   * Saldo akhir = Saldo awal + pembelian - penjualan + diskonto/premium + kenaikan/penurunan harga pasar
   */
  private function validasi_form_2($id_investasi,$key,$data,$detail)
  {

    foreach($detail as $keyDet => $v){

      $sum_saldo_awal += $v->saldo_awal;
      $sum_mutasi_pembelian += $v->mutasi_pembelian;
      $sum_mutasi_penjualan += $v->mutasi_penjualan;
      $sum_mutasi_diskonto += $v->mutasi_diskonto;
      $sum_mutasi_pasar += $v->mutasi_pasar;
      $sum_saldo_akhir += $v->saldo_akhir;

    }

    $sum_mutasi = $sum_mutasi_pembelian - $sum_mutasi_penjualan + $sum_mutasi_diskonto + $sum_mutasi_pasar;

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

  /**
   * Saldo akhir = saldo awal + pembelian - penjualan + amortisasi + mutasi pasar
   */
  private function validasi_form_3($id_investasi,$key,$data,$detail)
  {

    foreach($detail as $keyDet => $v){

      $sum_saldo_awal += $v->saldo_awal;
      $sum_mutasi_pembelian += $v->mutasi_pembelian;
      $sum_mutasi_penjualan += $v->mutasi_penjualan;
      $sum_mutasi_amortisasi += $v->mutasi_amortisasi;
      $sum_mutasi_pasar += $v->mutasi_pasar;
      $sum_saldo_akhir += $v->saldo_akhir;

    }

    $sum_mutasi = $sum_mutasi_pembelian - $sum_mutasi_penjualan + $sum_mutasi_amortisasi + $sum_mutasi_pasar;

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

  
  /**
   * saldo akhir = saldo awal + pembelian - penjualan + harga pasar
   */
  private function validasi_form_4($id_investasi,$key,$data,$detail)
  {

    foreach($detail as $keyDet => $v){

      $sum_saldo_awal += $v->saldo_awal;
      $sum_mutasi_pembelian += $v->mutasi_pembelian;
      $sum_mutasi_penjualan += $v->mutasi_penjualan;
      $sum_mutasi_pasar += $v->mutasi_pasar;
      $sum_saldo_akhir += $v->saldo_akhir;
    }

    $sum_mutasi = $sum_mutasi_pembelian - $sum_mutasi_penjualan + $sum_mutasi_pasar;

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


  /**
   * saldo awal + pembelian - penjualan + nilai wajar
   */
  private function validasi_form_5($id_investasi,$key,$data,$detail)
  {

    foreach($detail as $keyDet => $v){

      $sum_saldo_awal += $v->saldo_awal;
      $sum_mutasi_pembelian += $v->mutasi_pembelian;
      $sum_mutasi_penjualan += $v->mutasi_penjualan;
      $sum_mutasi_nilai_wajar += $v->mutasi_nilai_wajar;
      $sum_saldo_akhir += $v->saldo_akhir;
    }

    $sum_mutasi = $sum_mutasi_pembelian - $sum_mutasi_penjualan + $sum_mutasi_nilai_wajar;

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