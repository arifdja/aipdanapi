<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Peserta_aktif_semester_cabang_vTIP_model extends CI_Model
{

    private $table;
    function __construct()
    {
        parent::__construct();
        $this->table = 'tbl_lkao_peserta_aktif_cabang_semester';
        date_default_timezone_set('Asia/Jakarta');
    }

    public function get($semester = null, $tahun = null, $user = null)
    {
        if (null === $semester) {
            $semester = 0;
        }

        if (null === $tahun) {
            $tahun = 0;
        }

        $this->db->select('id,iduser,semester,tahun,id_cabang,id_kelompok,jumlah');
        $this->db->where('semester', $semester);
        $this->db->where('tahun', $tahun);
        $this->db->where('iduser', $user);
        $result = $this->db->get($this->table)->result_array();
        return $result;

    }

    public function delete($semester = null, $tahun = null, $user = null)
    {

        $res = array();

        if (null === $semester) {
            $semester = 0;
        }
        if (null === $tahun) {
            $tahun = 0;
        }

        $this->db->select('id');
        $this->db->where('iduser', $user);
        $this->db->where('semester', $semester);
        $this->db->where('tahun', $tahun);
        $this->db->delete($this->table);
        $del = $this->db->affected_rows();
        $res['msg'] = $this->db->affected_rows() . " data deleted, ";

        return $res;

    }

    public function insert($data, $user)
    {

        $dataInsert = array();
        $dataUpdate = array();

        $arrSemester = array(1, 2);
        $insert_at = date('Y-m-d H:i:s');

        $this->db->select('iduser');
        $resUser = $this->db->get('t_user')->result_array();
        $arrUSER = array();
        foreach ($resUser as $key => $value) {
            $arrUSER[] = $value['iduser'];
        }

        $this->db->select('id_kelompok');
        $id = $this->db->get_where('mst_kelompok_peserta_aktif', array('mst_kelompok_peserta_aktif.iduser' => $user))->result_array();
        $arrIDKelompok = array();
        foreach ($id as $key => $value) {
            $arrIDKelompok[] = $value['id_kelompok'];
        }

        $this->db->select('id_cabang');
        $id = $this->db->get_where('mst_cabang', array('mst_cabang.iduser' => $user))->result_array();
        $arrIDCabang = array();
        foreach ($id as $key => $value) {
            $arrIDCabang[] = $value['id_cabang'];
        }

        $msg = '';
        $totalJumlahUpdate = 0;
        $totalJumlahInsert = 0;

        $jumlahUpdate = 0;
        $jumlahInsert = 0;

        foreach ($data as $key => $value) {

            $id_user = $user;
            $semester = $value['semester'];
            $tahun = $value['tahun'];
            $id_kelompok = $value['id_kelompok'];
            $id_cabang = $value['id_cabang'];

            $cekdata = $this->db->get_where($this->table, array('iduser' => $id_user, 'semester' => $semester, 'tahun' => $tahun, 'id_kelompok' => $id_kelompok))->num_rows();

            if ($cekdata > 0) {
                $getdata = $this->db->get_where($this->table, array('iduser' => $id_user, 'semester' => $semester, 'tahun' => $tahun, 'id_kelompok' => $id_kelompok))->row();

                $dataUpdate = $value;
                $dataUpdate['insert_at'] = $getdata->insert_at;
                $dataUpdate['update_at'] = $insert_at;
                $simpan = false;

                if (in_array($value['id_kelompok'], $arrIDKelompok)) {
                    $simpan = true;
                } else {
                    $simpan = false;
                    $msg .= '<< Index ' . $key . ' Id Kelompok ' . $value['id_kelompok'] . ' tidak valid >>';
                }

                if (in_array($value['id_cabang'], $arrIDCabang)) {
                    $simpan = true;
                } else {
                    $simpan = false;
                    $msg .= '<< Index ' . $key . ' Id Cabang ' . $value['id_cabang'] . ' tidak valid >>';
                }

                if($simpan == true){
                    $this->db->where('iduser', $user);
                    $this->db->where('semester', $value['semester']);
                    $this->db->where('tahun', $value['tahun']);
                    $this->db->where('id_cabang', $value['id_cabang']);
                    $this->db->where('id_kelompok', $value['id_kelompok']);
                    $this->db->update($this->table, $dataUpdate);

                    $jumlahUpdate = $this->db->affected_rows();
                    $totalJumlahUpdate += $jumlahUpdate;

                }

            } else {

                $value['iduser'] = $user;
                $dataInsert = $value;

                $dataInsert['insert_at'] = $insert_at;
                $simpan = false;

                if (in_array($value['id_kelompok'], $arrIDKelompok)) {
                    $simpan = true;
                } else {
                    $simpan = false;
                    $msg .= '<< Index ' . $key . ' Id Kelompok ' . $value['id_kelompok'] . ' tidak valid >>';
                }
                
                if (in_array($value['id_cabang'], $arrIDCabang)) {
                    $simpan = true;
                } else {
                    $simpan = false;
                    $msg .= '<< Index ' . $key . ' Id Cabang ' . $value['id_cabang'] . ' tidak valid >>';
                }

                if($simpan == true){
                    $this->db->insert($this->table, $dataInsert);
                    
                    $jumlahInsert = $this->db->affected_rows();
                    $totalJumlahInsert += $jumlahInsert;

                }


            }

        }

        if ($totalJumlahUpdate > 0) {
            $msg .= '<< ' . $totalJumlahUpdate . ' Data Berhasil Diperbarui >>';
        }

        if ($totalJumlahInsert > 0) {
            $msg .= '<< ' . $totalJumlahInsert . ' Data Berhasil Ditambahkan >>';
        }

        $res = array();
        $res['error'] = false;
        $res['msg'] = $msg;

        return $res;
    }

}