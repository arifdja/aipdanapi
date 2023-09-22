<div class="tab-content">
    <div id="rincian_investasi_pihak" class="tab-pane fade in active">
        <div class="box-body" style="overflow-x:auto;">
            <p style="margin-left:0px;margin-top:10px;margin-bottom:10px;font-weight: bold">     
                Rincian Hasil Investasi Per Pihak
            </p>

            <?php if($this->session->flashdata('form_true')){?>
                <div id="notif">
                    <?php echo $this->session->flashdata('form_true');?>
                </div
            <?php } ?>

            <table id="tab_rincian_invest3" class="table table-responsive table-bordered table-hover">
                <thead>
                    <tr>
                        <th rowspan="2" style="width:3%;">No.</th>
                        <th rowspan="2" width="20%">Nama Pihak</th>
                        <th colspan="29">Jenis Investasi</th>
                        <th rowspan="2" style="width:13%">Total Per Pihak</th>
                        <th rowspan="2" style="width:13%">% Per Pihak</th>
                    </tr>
                    <tr>
                        <th>Bunga Surat Utang Negara</th>
                        <th>Imbal Hasil Sukuk Pemerintah</th>
                        <th>Bunga Obligasi Korporasi</th>
                        <th>Imbal Hasil Sukuk Korporasi</th>
                        <th>Bunga Medium Term Notes</th>
                        <th>Deviden Saham</th>
                        <th>Deviden Reksadana</th>
                        <th>Naik Turun Nilai Surat Utang Negara</th>
                        <th>Naik Turun Nilai Sukuk Pemerintah</th>
                        <th>Naik Turun Nilai Obligasi Korporasi</th>
                        <th>Naik Turun Nilai Sukuk Korporasi</th>
                        <th>Naik Turun Nilai Medium Term Notes</th>
                        <th>Naik Turun Nilai Saham</th>
                        <th>Naik Turun NAB Reksadana </th>
                        <th>Naik Turun Laba Rugi Pelepasan Investasi </th>
                        <th>Laba Rugi Pelepasan Sertifikat Deposito</th>
                        <th>Laba Rugi Pelepasan SUN</th>
                        <th>Laba Rugi Pelepasan Sukuk Pemerintah</th>
                        <th>Laba Rugi Pelepasan Obligasi Korporasi</th>
                        <th>Laba Rugi Pelepasan Sukuk Korporasi</th>
                        <th>Laba Rugi Pelepasan Medium Term Notes</th>
                        <th>Laba Rugi Pelepasan Saham</th>
                        <th>Laba Rugi Pelepasan Reksadana</th>
                        <th>Laba Rugi Pelepasan Penyertaan Langsung</th>
                        <th>Laba Rugi Pelepasan Tanah Bangunan</th>
                        <th>Pendapatan Investasi Lainnya</th>
                        <th>Laba Rugi Selisih Kurs</th>
                        <th>Bunga Deposito</th>
                        <th>Deviden Penyertaan Langsung</th>
                        <th>Imbal Hasil Reksadana</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $no=1; 
                        $tot_persen_pihak = 0;
                    ?>
                    <?php if(isset($rincian_hasil_invest) && is_array($rincian_hasil_invest)):?>
                    <?php foreach($rincian_hasil_invest as $hasilinvest):?>
                        <tr>
                            <td><?= $no++;?></td>
                            <td style="text-align: left;"><?=$hasilinvest['nama_pihak']?></td>
                            <td style="text-align: right;"><?=($hasilinvest['bunga_surat_utang_negara'] != 0 ) ? rupiah($hasilinvest['bunga_surat_utang_negara']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['imbal_hasil_sukuk_pemerintah'] != 0 ) ? rupiah($hasilinvest['imbal_hasil_sukuk_pemerintah']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['bunga_obligasi_korporasi'] != 0 ) ? rupiah($hasilinvest['bunga_obligasi_korporasi']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['imbal_hasil_sukuk_korporasi'] != 0 ) ? rupiah($hasilinvest['imbal_hasil_sukuk_korporasi']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['bunga_medium_term_notes'] != 0 ) ? rupiah($hasilinvest['bunga_medium_term_notes']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['deviden_saham'] != 0 ) ? rupiah($hasilinvest['deviden_saham']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['deviden_reksadana'] != 0 ) ? rupiah($hasilinvest['deviden_reksadana']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['nt_nilai_surat_utang_negara'] != 0 ) ? rupiah($hasilinvest['nt_nilai_surat_utang_negara']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['nt_nilai_sukuk_pemerintah'] != 0 ) ? rupiah($hasilinvest['nt_nilai_sukuk_pemerintah']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['nt_nilai_obligasi_korporasi'] != 0 ) ? rupiah($hasilinvest['nt_nilai_obligasi_korporasi']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['nt_nilai_sukuk_korporasi'] != 0 ) ? rupiah($hasilinvest['nt_nilai_sukuk_korporasi']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['nt_nilai_mtn'] != 0 ) ? rupiah($hasilinvest['nt_nilai_mtn']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['nt_nilai_saham'] != 0 ) ? rupiah($hasilinvest['nt_nilai_saham']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['nt_nab_reksadana'] != 0 ) ? rupiah($hasilinvest['nt_nab_reksadana']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['laba_rugi_pelepasan_investasi'] != 0 ) ? rupiah($hasilinvest['laba_rugi_pelepasan_investasi']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['laba_rugi_pelepasan_sertifikat_deposito'] != 0 ) ? rupiah($hasilinvest['laba_rugi_pelepasan_sertifikat_deposito']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['laba_rugi_pelepasan_sun'] != 0 ) ? rupiah($hasilinvest['laba_rugi_pelepasan_sun']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['laba_rugi_pelepasan_sukuk_pemerintah'] != 0 ) ? rupiah($hasilinvest['laba_rugi_pelepasan_sukuk_pemerintah']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['laba_rugi_pelepasan_obligasi_korporasi'] != 0 ) ? rupiah($hasilinvest['laba_rugi_pelepasan_obligasi_korporasi']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['laba_rugi_pelepasan_sukuk_korporasi'] != 0 ) ? rupiah($hasilinvest['laba_rugi_pelepasan_sukuk_korporasi']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['laba_rugi_pelepasan_mtn'] != 0 ) ? rupiah($hasilinvest['laba_rugi_pelepasan_mtn']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['laba_rugi_pelepasan_saham'] != 0 ) ? rupiah($hasilinvest['laba_rugi_pelepasan_saham']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['laba_rugi_pelepasan_reksadana'] != 0 ) ? rupiah($hasilinvest['laba_rugi_pelepasan_reksadana']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['laba_rugi_pelepasan_penyertaan_langsung'] != 0 ) ? rupiah($hasilinvest['laba_rugi_pelepasan_penyertaan_langsung']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['laba_rugi_pelepasan_tanah_bangunan'] != 0 ) ? rupiah($hasilinvest['laba_rugi_pelepasan_tanah_bangunan']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['pendapatan_investasi_lainnya'] != 0 ) ? rupiah($hasilinvest['pendapatan_investasi_lainnya']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['laba_rugi_selisih_kurs'] != 0 ) ? rupiah($hasilinvest['laba_rugi_selisih_kurs']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['bunga_deposito'] != 0 ) ? rupiah($hasilinvest['bunga_deposito']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['deviden_penyertaan_langsung'] != 0 ) ? rupiah($hasilinvest['deviden_penyertaan_langsung']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['imbal_hasil_reksadana'] != 0 ) ? rupiah($hasilinvest['imbal_hasil_reksadana']) : '-'; ?></td>
                            <td style="text-align: right;"><?=($hasilinvest['total_perpihak'] != 0 ) ? rupiah($hasilinvest['total_perpihak']) : '-';?></td>
                            <?php
                            $persen_pihak['persen'] = ($sum_hasil_invest['total_perpihak']!=0)?($hasilinvest['total_perpihak']/$sum_hasil_invest['total_perpihak'])*100:0;

                            $tot_persen_pihak += $persen_pihak['persen'];
                            ?>
                            <td style="text-align: right;"><?=($persen_pihak['persen'] != 0 ) ? persen($persen_pihak['persen']).'%' : '-';?></td>
                        </tr>
                    <?php endforeach;?>
                    <?php endif;?>
                </tbody>
                <tfoot style="background-color: #d8d8d8; font-weight: bold;">
                    <tr>
                        <td style="text-align: left;" colspan="2">Total Per Jenis Hasil Investasi</td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['bunga_surat_utang_negara'] != 0 ) ? rupiah($sum_hasil_invest['bunga_surat_utang_negara']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['imbal_hasil_sukuk_pemerintah'] != 0 ) ? rupiah($sum_hasil_invest['imbal_hasil_sukuk_pemerintah']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['bunga_obligasi_korporasi'] != 0 ) ? rupiah($sum_hasil_invest['bunga_obligasi_korporasi']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['imbal_hasil_sukuk_korporasi'] != 0 ) ? rupiah($sum_hasil_invest['imbal_hasil_sukuk_korporasi']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['bunga_medium_term_notes'] != 0 ) ? rupiah($sum_hasil_invest['bunga_medium_term_notes']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['deviden_saham'] != 0 ) ? rupiah($sum_hasil_invest['deviden_saham']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['deviden_reksadana'] != 0 ) ? rupiah($sum_hasil_invest['deviden_reksadana']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['nt_nilai_surat_utang_negara'] != 0 ) ? rupiah($sum_hasil_invest['nt_nilai_surat_utang_negara']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['nt_nilai_sukuk_pemerintah'] != 0 ) ? rupiah($sum_hasil_invest['nt_nilai_sukuk_pemerintah']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['nt_nilai_obligasi_korporasi'] != 0 ) ? rupiah($sum_hasil_invest['nt_nilai_obligasi_korporasi']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['nt_nilai_sukuk_korporasi'] != 0 ) ? rupiah($sum_hasil_invest['nt_nilai_sukuk_korporasi']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['nt_nilai_mtn'] != 0 ) ? rupiah($sum_hasil_invest['nt_nilai_mtn']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['nt_nilai_saham'] != 0 ) ? rupiah($sum_hasil_invest['nt_nilai_saham']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['nt_nab_reksadana'] != 0 ) ? rupiah($sum_hasil_invest['nt_nab_reksadana']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['laba_rugi_pelepasan_investasi'] != 0 ) ? rupiah($sum_hasil_invest['laba_rugi_pelepasan_investasi']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['laba_rugi_pelepasan_sertifikat_deposito'] != 0 ) ? rupiah($sum_hasil_invest['laba_rugi_pelepasan_sertifikat_deposito']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['laba_rugi_pelepasan_sun'] != 0 ) ? rupiah($sum_hasil_invest['laba_rugi_pelepasan_sun']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['laba_rugi_pelepasan_sukuk_pemerintah'] != 0 ) ? rupiah($sum_hasil_invest['laba_rugi_pelepasan_sukuk_pemerintah']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['laba_rugi_pelepasan_obligasi_korporasi'] != 0 ) ? rupiah($sum_hasil_invest['laba_rugi_pelepasan_obligasi_korporasi']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['laba_rugi_pelepasan_sukuk_korporasi'] != 0 ) ? rupiah($sum_hasil_invest['laba_rugi_pelepasan_sukuk_korporasi']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['laba_rugi_pelepasan_mtn'] != 0 ) ? rupiah($sum_hasil_invest['laba_rugi_pelepasan_mtn']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['laba_rugi_pelepasan_saham'] != 0 ) ? rupiah($sum_hasil_invest['laba_rugi_pelepasan_saham']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['laba_rugi_pelepasan_reksadana'] != 0 ) ? rupiah($sum_hasil_invest['laba_rugi_pelepasan_reksadana']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['laba_rugi_pelepasan_penyertaan_langsung'] != 0 ) ? rupiah($sum_hasil_invest['laba_rugi_pelepasan_penyertaan_langsung']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['laba_rugi_pelepasan_tanah_bangunan'] != 0 ) ? rupiah($sum_hasil_invest['laba_rugi_pelepasan_tanah_bangunan']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['pendapatan_investasi_lainnya'] != 0 ) ? rupiah($sum_hasil_invest['pendapatan_investasi_lainnya']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['laba_rugi_selisih_kurs'] != 0 ) ? rupiah($sum_hasil_invest['laba_rugi_selisih_kurs']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['bunga_deposito'] != 0 ) ? rupiah($sum_hasil_invest['bunga_deposito']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['deviden_penyertaan_langsung'] != 0 ) ? rupiah($sum_hasil_invest['deviden_penyertaan_langsung']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['imbal_hasil_reksadana'] != 0 ) ? rupiah($sum_hasil_invest['imbal_hasil_reksadana']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($sum_hasil_invest['total_perpihak'] != 0 ) ? rupiah($sum_hasil_invest['total_perpihak']) : '-';?></td>
                        <td style="text-align: right;"><?=($tot_persen_pihak != 0 ) ? persen($tot_persen_pihak).'%' : '-';?></td>
                    </tr>
                    <tr>
                        <td style="text-align: left;" colspan="2">% Persen Per Jenis Hasil Investasi</td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['bunga_surat_utang_negara'] != 0 ) ? persen($persen_sum_hasil_invest['bunga_surat_utang_negara']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['imbal_hasil_sukuk_pemerintah'] != 0 ) ? persen($persen_sum_hasil_invest['imbal_hasil_sukuk_pemerintah']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['bunga_obligasi_korporasi'] != 0 ) ? persen($persen_sum_hasil_invest['bunga_obligasi_korporasi']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['imbal_hasil_sukuk_korporasi'] != 0 ) ? persen($persen_sum_hasil_invest['imbal_hasil_sukuk_korporasi']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['bunga_medium_term_notes'] != 0 ) ? persen($persen_sum_hasil_invest['bunga_medium_term_notes']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['deviden_saham'] != 0 ) ? persen($persen_sum_hasil_invest['deviden_saham']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['deviden_reksadana'] != 0 ) ? persen($persen_sum_hasil_invest['deviden_reksadana']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['nt_nilai_surat_utang_negara'] != 0 ) ? persen($persen_sum_hasil_invest['nt_nilai_surat_utang_negara']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['nt_nilai_sukuk_pemerintah'] != 0 ) ? persen($persen_sum_hasil_invest['nt_nilai_sukuk_pemerintah']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['nt_nilai_obligasi_korporasi'] != 0 ) ? persen($persen_sum_hasil_invest['nt_nilai_obligasi_korporasi']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['nt_nilai_sukuk_korporasi'] != 0 ) ? persen($persen_sum_hasil_invest['nt_nilai_sukuk_korporasi']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['nt_nilai_mtn'] != 0 ) ? persen($persen_sum_hasil_invest['nt_nilai_mtn']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['nt_nilai_saham'] != 0 ) ? persen($persen_sum_hasil_invest['nt_nilai_saham']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['nt_nab_reksadana'] != 0 ) ? persen($persen_sum_hasil_invest['nt_nab_reksadana']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['laba_rugi_pelepasan_investasi'] != 0 ) ? persen($persen_sum_hasil_invest['laba_rugi_pelepasan_investasi']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['laba_rugi_pelepasan_sertifikat_deposito'] != 0 ) ? persen($persen_sum_hasil_invest['laba_rugi_pelepasan_sertifikat_deposito']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['laba_rugi_pelepasan_sun'] != 0 ) ? persen($persen_sum_hasil_invest['laba_rugi_pelepasan_sun']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['laba_rugi_pelepasan_sukuk_pemerintah'] != 0 ) ? persen($persen_sum_hasil_invest['laba_rugi_pelepasan_sukuk_pemerintah']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['laba_rugi_pelepasan_obligasi_korporasi'] != 0 ) ? persen($persen_sum_hasil_invest['laba_rugi_pelepasan_obligasi_korporasi']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['laba_rugi_pelepasan_sukuk_korporasi'] != 0 ) ? persen($persen_sum_hasil_invest['laba_rugi_pelepasan_sukuk_korporasi']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['laba_rugi_pelepasan_mtn'] != 0 ) ? persen($persen_sum_hasil_invest['laba_rugi_pelepasan_mtn']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['laba_rugi_pelepasan_saham'] != 0 ) ? persen($persen_sum_hasil_invest['laba_rugi_pelepasan_saham']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['laba_rugi_pelepasan_reksadana'] != 0 ) ? persen($persen_sum_hasil_invest['laba_rugi_pelepasan_reksadana']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['laba_rugi_pelepasan_penyertaan_langsung'] != 0 ) ? persen($persen_sum_hasil_invest['laba_rugi_pelepasan_penyertaan_langsung']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['laba_rugi_pelepasan_tanah_bangunan'] != 0 ) ? persen($persen_sum_hasil_invest['laba_rugi_pelepasan_tanah_bangunan']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['pendapatan_investasi_lainnya'] != 0 ) ? persen($persen_sum_hasil_invest['pendapatan_investasi_lainnya']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['laba_rugi_selisih_kurs'] != 0 ) ? persen($persen_sum_hasil_invest['laba_rugi_selisih_kurs']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['bunga_deposito'] != 0 ) ? persen($persen_sum_hasil_invest['bunga_deposito']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['deviden_penyertaan_langsung'] != 0 ) ? persen($persen_sum_hasil_invest['deviden_penyertaan_langsung']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['imbal_hasil_reksadana'] != 0 ) ? persen($persen_sum_hasil_invest['imbal_hasil_reksadana']) : '-'; ?></td>
                        <td style="text-align: right;"><?=($persen_sum_hasil_invest['total_perpihak'] != 0 ) ? persen($persen_sum_hasil_invest['total_perpihak']).'%' : '-';?></td>
                        <td></td>
                    </tr>
                </tfoot>  
            </table>

            <!-- data keterangan  -->
            <div style="padding:4px;">
                <p style="margin-left:15px;font-size: 18px;font-weight: bold">Keterangan :
                </p>
                <div style="padding:4px;border-style:groove;border-color:lightblue;">
                    <p style="margin-left:10px;font-size: 14px;margin-right: 15px;margin-left: 15px;text-align: justify;"><?php echo (isset($data_rincian_ket[0]->keterangan_lap) ? $data_rincian_ket[0]->keterangan_lap : '');?></p>

                    <p style="margin-left:15px;font-size: 14px;font-weight: bold">Dokumen : 
                        <a href="<?php echo site_url('bulanan/rincian/get_file/'.(isset($data_rincian_ket[0]->id) ? $data_rincian_ket[0]->id : ''));?>"><?php echo (isset($data_rincian_ket[0]->file_lap) ? $data_rincian_ket[0]->file_lap : '');?></a>
                    </p>

                </div>
            </div>
            <!-- end keterangan -->
        </div>
    </div>
</div>

<script type="text/javascript">
    $(".select2nya").select2( { 'width':'100%' } );

    $('#tab_rincian_invest3').DataTable({
        "paging":true,
        "searching": false,
        "ordering": false,
        "lengthChange": false,
    });
    
</script>