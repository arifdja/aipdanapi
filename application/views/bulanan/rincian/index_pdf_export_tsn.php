<p style="margin-left:0px;margin-top:10px;margin-bottom:10px;font-weight: bold;font-size: 14px">     
    Rincian - <?php echo (isset($bulan[0]->nama_bulan) ? $bulan[0]->nama_bulan : '');?>
</p>
<p style="margin-left:0px;margin-top:10px;margin-bottom:10px;font-weight: bold">     
    a) Rincian Investasi Per Pihak
</p>
<table cellpadding="4px" cellspacing="0px" border="1" autosize="1" style="color:#000;background:#fff;font-size: 12px;">
    <thead>
        <tr>
            <th rowspan="2" style="width:3%;">No.</th>
            <th rowspan="2" width="20%">Nama Pihak</th>
            <th colspan="22">Jenis Investasi</th>
            <th rowspan="2" style="width:13%">Total Per Pihak</th>
            <th rowspan="2" style="width:13%">% Per Pihak</th>
        </tr>
        <tr>
            <th>Deposito</th>
            <th>Sertifikat Deposito</th>
            <th>Surat Utang Negara</th>
            <th>Sukuk Pemerintah</th>
            <th>Obligasi Korporasi</th>
            <th>Sukuk Korporasi</th>
            <th>Obligasi Mata Uang Asing</th>
            <th>Medium Term Notes</th>
            <th>Saham</th>
            <th>Reksadana</th>
            <th>Dana Investasi KIK</th>
            <th>Penyertaan Langsung</th>
            <th>Tanah dan Bangunan</th>
            <th>Reksadana Pasar Uang</th>
            <th>Reksadana Pendapatan Tetap</th>
            <th>Reksadana Campuran</th>
            <th>Reksadana Saham</th>
            <th>Reksadana Terproteksi</th>
            <th>Reksadana Pinjaman</th>
            <th>Reksadana Index</th>
            <th>Reksadana KIK</th>
            <th>Reksadana Penyertaan</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no=1; 
        $tot_persen_pihak = 0;
        ?>
        <?php if(isset($rincian_invest) && is_array($rincian_invest)):?>
        <?php foreach($rincian_invest as $invest):?>
            <tr>
                <td><?= $no++;?></td>
                <td style="text-align: left;"><?=$invest['nama_pihak']?></td>
                <td style="text-align: right;"><?= (isset($invest['deposito'])) ? (($invest['deposito'] != 0 ) ? rupiah($invest['deposito']) : '-') : '-';?></td>
                <td style="text-align: right;"><?= (isset($invest['sertifikat_deposito'])) ? (($invest['sertifikat_deposito'] != 0 ) ? rupiah($invest['sertifikat_deposito']) : '-') : '-';?></td>
                <td style="text-align: right;"><?= (isset($invest['sun'])) ? (($invest['sun'] != 0 ) ? rupiah($invest['sun']) : '-') : '-';?></td>
                <td style="text-align: right;"><?= (isset($invest['sukuk_pemerintah'])) ? (($invest['sukuk_pemerintah'] != 0 ) ? rupiah($invest['sukuk_pemerintah']) : '-') : '-';?></td>
                <td style="text-align: right;"><?= (isset($invest['obligasi_korporasi'])) ? (($invest['obligasi_korporasi'] != 0 ) ? rupiah($invest['obligasi_korporasi']) : '-') : '-';?></td>
                <td style="text-align: right;"><?= (isset($invest['sukuk_korporasi'])) ? (($invest['sukuk_korporasi'] != 0 ) ? rupiah($invest['sukuk_korporasi']) : '-') : '-';?></td>
                <td style="text-align: right;"><?= (isset($invest['obligasi_mata_uang'])) ? (($invest['obligasi_mata_uang'] != 0 ) ? rupiah($invest['obligasi_mata_uang']) : '-') : '-';?></td>
                <td style="text-align: right;"><?= (isset($invest['mtn'])) ? (($invest['mtn'] != 0 ) ? rupiah($invest['mtn']) : '-') : '-';?></td>
                <td style="text-align: right;"><?= (isset($invest['saham'])) ? (($invest['saham'] != 0 ) ? rupiah($invest['saham']) : '-') : '-';?></td>
                <td style="text-align: right;"><?= (isset($invest['reksadana'])) ? (($invest['reksadana'] != 0 ) ? rupiah($invest['reksadana']) : '-') : '-';?></td>
                <td style="text-align: right;"><?= (isset($invest['dana_invest_kik'])) ? (($invest['dana_invest_kik'] != 0 ) ? rupiah($invest['dana_invest_kik']) : '-') : '-';?></td>
                <td style="text-align: right;"><?= (isset($invest['penyertaan_langsung'])) ? (($invest['penyertaan_langsung'] != 0 ) ? rupiah($invest['penyertaan_langsung']) : '-') : '-';?></td>
                <td style="text-align: right;"><?= (isset($invest['tanah_bangunan'])) ? (($invest['tanah_bangunan'] != 0 ) ? rupiah($invest['tanah_bangunan']) : '-') : '-';?></td>
                <td style="text-align: right;"><?= (isset($invest['reksadana_pasar_uang'])) ? (($invest['reksadana_pasar_uang'] != 0 ) ? rupiah($invest['reksadana_pasar_uang']) : '-') : '-';?></td>
                <td style="text-align: right;"><?= (isset($invest['reksadana_pendapatan_tetap'])) ? (($invest['reksadana_pendapatan_tetap'] != 0 ) ? rupiah($invest['reksadana_pendapatan_tetap']) : '-') : '-';?></td>
                <td style="text-align: right;"><?= (isset($invest['reksadana_campuran'])) ? (($invest['reksadana_campuran'] != 0 ) ? rupiah($invest['reksadana_campuran']) : '-') : '-';?></td>
                <td style="text-align: right;"><?= (isset($invest['reksadana_saham'])) ? (($invest['reksadana_saham'] != 0 ) ? rupiah($invest['reksadana_saham']) : '-') : '-';?></td>
                <td style="text-align: right;"><?= (isset($invest['reksadana_terproteksi'])) ? (($invest['reksadana_terproteksi'] != 0 ) ? rupiah($invest['reksadana_terproteksi']) : '-') : '-';?></td>
                <td style="text-align: right;"><?= (isset($invest['reksadana_pinjaman'])) ? (($invest['reksadana_pinjaman'] != 0 ) ? rupiah($invest['reksadana_pinjaman']) : '-') : '-';?></td>
                <td style="text-align: right;"><?= (isset($invest['reksadana_index'])) ? (($invest['reksadana_index'] != 0 ) ? rupiah($invest['reksadana_index']) : '-') : '-';?></td>
                <td style="text-align: right;"><?= (isset($invest['reksadana_kik'])) ? (($invest['reksadana_kik'] != 0 ) ? rupiah($invest['reksadana_kik']) : '-') : '-';?></td>
                <td style="text-align: right;"><?= (isset($invest['reksadana_penyertaaan_diperdagangkan'])) ? (($invest['reksadana_penyertaaan_diperdagangkan'] != 0 ) ? rupiah($invest['reksadana_penyertaaan_diperdagangkan']) : '-') : '-';?></td>
                <td style="text-align: right;"><?= (isset($invest['total_perpihak'])) ? (($invest['total_perpihak'] != 0 ) ? rupiah($invest['total_perpihak']) : '-') : '-';?></td>
                <?php
                $persen_pihak['persen'] = ($sum_invest['total_perpihak']!=0)?($invest['total_perpihak']/$sum_invest['total_perpihak'])*100:0;

                $tot_persen_pihak += $persen_pihak['persen'];
                ?>
                <td style="text-align: right;"><?=($persen_pihak['persen'] != 0 ) ? persen($persen_pihak['persen']).'%' : '-';?></td>
            </tr>
        <?php endforeach;?>
    <?php endif;?>
</tbody>
<tr style="background-color: #d8d8d8; font-weight: bold;">
    <tr>
        <td style="text-align: left;" colspan="2">Total Per Jenis Investasi</td>
        <td style="text-align: right;"><?=($sum_invest['deposito'] != 0 ) ? rupiah($sum_invest['deposito']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_invest['sertifikat_deposito'] != 0 ) ? rupiah($sum_invest['sertifikat_deposito']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_invest['sun'] != 0 ) ? rupiah($sum_invest['sun']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_invest['sukuk_pemerintah'] != 0 ) ? rupiah($sum_invest['sukuk_pemerintah']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_invest['obligasi_korporasi'] != 0 ) ? rupiah($sum_invest['obligasi_korporasi']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_invest['sukuk_korporasi'] != 0 ) ? rupiah($sum_invest['sukuk_korporasi']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_invest['obligasi_mata_uang'] != 0 ) ? rupiah($sum_invest['obligasi_mata_uang']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_invest['mtn'] != 0 ) ? rupiah($sum_invest['mtn']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_invest['saham'] != 0 ) ? rupiah($sum_invest['saham']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_invest['reksadana'] != 0 ) ? rupiah($sum_invest['reksadana']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_invest['dana_invest_kik'] != 0 ) ? rupiah($sum_invest['dana_invest_kik']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_invest['penyertaan_langsung'] != 0 ) ? rupiah($sum_invest['penyertaan_langsung']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_invest['tanah_bangunan'] != 0 ) ? rupiah($sum_invest['tanah_bangunan']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_invest['reksadana_pasar_uang'] != 0 ) ? rupiah($sum_invest['reksadana_pasar_uang']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_invest['reksadana_pendapatan_tetap'] != 0 ) ? rupiah($sum_invest['reksadana_pendapatan_tetap']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_invest['reksadana_campuran'] != 0 ) ? rupiah($sum_invest['reksadana_campuran']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_invest['reksadana_saham'] != 0 ) ? rupiah($sum_invest['reksadana_saham']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_invest['reksadana_terproteksi'] != 0 ) ? rupiah($sum_invest['reksadana_terproteksi']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_invest['reksadana_pinjaman'] != 0 ) ? rupiah($sum_invest['reksadana_pinjaman']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_invest['reksadana_index'] != 0 ) ? rupiah($sum_invest['reksadana_index']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_invest['reksadana_kik'] != 0 ) ? rupiah($sum_invest['reksadana_kik']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_invest['reksadana_penyertaaan_diperdagangkan'] != 0 ) ? rupiah($sum_invest['reksadana_penyertaaan_diperdagangkan']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_invest['total_perpihak'] != 0 ) ? rupiah($sum_invest['total_perpihak']) : '-';?></td>
        <td style="text-align: right;"><?=($tot_persen_pihak != 0 ) ? persen($tot_persen_pihak).'%' : '-';?></td>
    </tr>
    <tr>
        <td style="text-align: left;" colspan="2">% Persen Per Jenis Investasi</td>
        <td style="text-align: right;"><?=(isset($persen_sum_invest['deposito'])) ? (($persen_sum_invest['deposito'] != 0 ) ? persen($persen_sum_invest['deposito']).'%' : '-') : '-';?></td>
        <td style="text-align: right;"><?=(isset($persen_sum_invest['sertifikat_deposito'])) ? (($persen_sum_invest['sertifikat_deposito'] != 0 ) ? persen($persen_sum_invest['sertifikat_deposito']).'%' : '-') : '-';?></td>
        <td style="text-align: right;"><?=(isset($persen_sum_invest['sun'])) ? (($persen_sum_invest['sun'] != 0 ) ? persen($persen_sum_invest['sun']).'%' : '-') : '-';?></td>
        <td style="text-align: right;"><?=(isset($persen_sum_invest['sukuk_pemerintah'])) ? (($persen_sum_invest['sukuk_pemerintah'] != 0 ) ? persen($persen_sum_invest['sukuk_pemerintah']).'%' : '-') : '-';?></td>
        <td style="text-align: right;"><?=(isset($persen_sum_invest['obligasi_korporasi'])) ? (($persen_sum_invest['obligasi_korporasi'] != 0 ) ? persen($persen_sum_invest['obligasi_korporasi']).'%' : '-') : '-';?></td>
        <td style="text-align: right;"><?=(isset($persen_sum_invest['sukuk_korporasi'])) ? (($persen_sum_invest['sukuk_korporasi'] != 0 ) ? persen($persen_sum_invest['sukuk_korporasi']).'%' : '-') : '-';?></td>
        <td style="text-align: right;"><?=(isset($persen_sum_invest['obligasi_mata_uang'])) ? (($persen_sum_invest['obligasi_mata_uang'] != 0 ) ? persen($persen_sum_invest['obligasi_mata_uang']).'%' : '-') : '-';?></td>
        <td style="text-align: right;"><?=(isset($persen_sum_invest['mtn'])) ? (($persen_sum_invest['mtn'] != 0 ) ? persen($persen_sum_invest['mtn']).'%' : '-') : '-';?></td>
        <td style="text-align: right;"><?=(isset($persen_sum_invest['saham'])) ? (($persen_sum_invest['saham'] != 0 ) ? persen($persen_sum_invest['saham']).'%' : '-') : '-';?></td>
        <td style="text-align: right;"><?=(isset($persen_sum_invest['reksadana'])) ? (($persen_sum_invest['reksadana'] != 0 ) ? persen($persen_sum_invest['reksadana']).'%' : '-') : '-';?></td>
        <td style="text-align: right;"><?=(isset($persen_sum_invest['dana_invest_kik'])) ? (($persen_sum_invest['dana_invest_kik'] != 0 ) ? persen($persen_sum_invest['dana_invest_kik']).'%' : '-') : '-';?></td>
        <td style="text-align: right;"><?=(isset($persen_sum_invest['penyertaan_langsung'])) ? (($persen_sum_invest['penyertaan_langsung'] != 0 ) ? persen($persen_sum_invest['penyertaan_langsung']).'%' : '-') : '-';?></td>
        <td style="text-align: right;"><?=(isset($persen_sum_invest['tanah_bangunan'])) ? (($persen_sum_invest['tanah_bangunan'] != 0 ) ? persen($persen_sum_invest['tanah_bangunan']).'%' : '-') : '-';?></td>
        <td style="text-align: right;"><?=(isset($persen_sum_invest['reksadana_pasar_uang'])) ? (($persen_sum_invest['reksadana_pasar_uang'] != 0 ) ? persen($persen_sum_invest['reksadana_pasar_uang']).'%' : '-') : '-';?></td>
        <td style="text-align: right;"><?=(isset($persen_sum_invest['reksadana_pendapatan_tetap'])) ? (($persen_sum_invest['reksadana_pendapatan_tetap'] != 0 ) ? persen($persen_sum_invest['reksadana_pendapatan_tetap']).'%' : '-') : '-';?></td>
        <td style="text-align: right;"><?=(isset($persen_sum_invest['reksadana_campuran'])) ? (($persen_sum_invest['reksadana_campuran'] != 0 ) ? persen($persen_sum_invest['reksadana_campuran']).'%' : '-') : '-';?></td>
        <td style="text-align: right;"><?=(isset($persen_sum_invest['reksadana_saham'])) ? (($persen_sum_invest['reksadana_saham'] != 0 ) ? persen($persen_sum_invest['reksadana_saham']).'%' : '-') : '-';?></td>
        <td style="text-align: right;"><?=(isset($persen_sum_invest['reksadana_terproteksi'])) ? (($persen_sum_invest['reksadana_terproteksi'] != 0 ) ? persen($persen_sum_invest['reksadana_terproteksi']).'%' : '-') : '-';?></td>
        <td style="text-align: right;"><?=(isset($persen_sum_invest['reksadana_pinjaman'])) ? (($persen_sum_invest['reksadana_pinjaman'] != 0 ) ? persen($persen_sum_invest['reksadana_pinjaman']).'%' : '-') : '-';?></td>
        <td style="text-align: right;"><?=(isset($persen_sum_invest['reksadana_index'])) ? (($persen_sum_invest['reksadana_index'] != 0 ) ? persen($persen_sum_invest['reksadana_index']).'%' : '-') : '-';?></td>
        <td style="text-align: right;"><?=(isset($persen_sum_invest['reksadana_kik'])) ? (($persen_sum_invest['reksadana_kik'] != 0 ) ? persen($persen_sum_invest['reksadana_kik']).'%' : '-') : '-';?></td>
        <td style="text-align: right;"><?=(isset($persen_sum_invest['reksadana_penyertaaan_diperdagangkan'])) ? (($persen_sum_invest['reksadana_penyertaaan_diperdagangkan'] != 0 ) ? persen($persen_sum_invest['reksadana_penyertaaan_diperdagangkan']).'%' : '-') : '-';?></td>
        <td style="text-align: right;"><?=(isset($persen_sum_invest['total_perpihak'])) ? (($persen_sum_invest['total_perpihak'] != 0 ) ? persen($persen_sum_invest['total_perpihak']).'%' : '-') : '-';?></td>
        <td></td>
    </tr>
</tr>    
</table>
<pagebreak></pagebreak>
<p style="margin-left:0px;margin-top:10px;margin-bottom:10px;font-weight: bold">     
    b) Rincian Bukan Investasi
</p>
<table cellpadding="4px" cellspacing="0px" border="1" autosize="1" style="color:#000;background:#fff;font-size: 12px;">
    <thead>
        <tr>
            <th rowspan="2" style="width:3%;">No.</th>
            <th rowspan="2" width="20%">Nama Pihak</th>
            <th colspan="19">Jenis Investasi</th>
            <th rowspan="2" style="width:13%">Total Per Pihak</th>
            <th rowspan="2" style="width:13%">% Per Pihak</th>
        </tr>
        <tr>
            <th>Kas dan Bank</th>
            <th>Piutang Iuran</th>
            <th>Piutang Investasi</th>
            <th>Piutang Hasil Investasi</th>
            <th>Piutang Lainnya</th>
            <th>Piutang Biaya Konpensasi Bank</th>
            <th>Uang Muka PPH</th>
            <th>Piutang Pihak Ke tiga</th>
            <th>Piutang Denda</th>
            <th>Cadangan Penyisihan</th>
            <th>Bangunan</th>
            <th>Tanah dan Bangunan</th>
            <th>Aset Lainnya</th>
            <th>Kendaraan</th>
            <th>Komputer</th>
            <th>Inventaris Kantor</th>
            <th>Hak Guna Bangunan</th>
            <th>Aset Tidak Berwujud</th>
            <th>Aset Tetap</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no=1; 
        $tot_persen_pihak = 0;
        ?>
        <?php if(isset($rincian_bkn_invest) && is_array($rincian_bkn_invest)):?>
        <?php foreach($rincian_bkn_invest as $bkninvest):?>
            <tr>
                <td><?= $no++;?></td>
                <td style="text-align: left;"><?=$bkninvest['nama_pihak']?></td>
                <td style="text-align: right;"><?=($bkninvest['kas_bank'] != 0 ) ? rupiah($bkninvest['kas_bank']) : '-';?></td>
                <td style="text-align: right;"><?=($bkninvest['piutang_iuran'] != 0 ) ? rupiah($bkninvest['piutang_iuran']) : '-';?></td>
                <td style="text-align: right;"><?=($bkninvest['piutang_investasi'] != 0 ) ? rupiah($bkninvest['piutang_investasi']) : '-';?></td>
                <td style="text-align: right;"><?=($bkninvest['piutang_hasil_invest'] != 0 ) ? rupiah($bkninvest['piutang_hasil_invest']) : '-';?></td>
                <td style="text-align: right;"><?=($bkninvest['piutang_lainnya'] != 0 ) ? rupiah($bkninvest['piutang_lainnya']) : '-';?></td>
                <td style="text-align: right;"><?=($bkninvest['piutang_biaya_konpensasi_bank'] != 0 ) ? rupiah($bkninvest['piutang_biaya_konpensasi_bank']) : '-';?></td>
                <td style="text-align: right;"><?=($bkninvest['uangmuka_pph'] != 0 ) ? rupiah($bkninvest['uangmuka_pph']) : '-';?></td>
                <td style="text-align: right;"><?=($bkninvest['piutang_pihak_ketiga'] != 0 ) ? rupiah($bkninvest['piutang_pihak_ketiga']) : '-';?></td>
                <td style="text-align: right;"><?=($bkninvest['piutang_denda'] != 0 ) ? rupiah($bkninvest['piutang_denda']) : '-';?></td>
                <td style="text-align: right;"><?=($bkninvest['cadangan_penyisihan'] != 0 ) ? rupiah($bkninvest['cadangan_penyisihan']) : '-';?></td>
                <td style="text-align: right;"><?=($bkninvest['bangunan'] != 0 ) ? rupiah($bkninvest['bangunan']) : '-';?></td>
                <td style="text-align: right;"><?=($bkninvest['tanah_bangunan'] != 0 ) ? rupiah($bkninvest['tanah_bangunan']) : '-';?></td>
                <td style="text-align: right;"><?=($bkninvest['aset_lainnya'] != 0 ) ? rupiah($bkninvest['aset_lainnya']) : '-';?></td>
                <td style="text-align: right;"><?=($bkninvest['kendaraan'] != 0 ) ? rupiah($bkninvest['kendaraan']) : '-';?></td>
                <td style="text-align: right;"><?=($bkninvest['komputer'] != 0 ) ? rupiah($bkninvest['komputer']) : '-';?></td>
                <td style="text-align: right;"><?=($bkninvest['inventaris_kantor'] != 0 ) ? rupiah($bkninvest['inventaris_kantor']) : '-';?></td>
                <td style="text-align: right;"><?=($bkninvest['hak_guna_bangunan'] != 0 ) ? rupiah($bkninvest['hak_guna_bangunan']) : '-';?></td>
                <td style="text-align: right;"><?=($bkninvest['aset_tdk_berwujud'] != 0 ) ? rupiah($bkninvest['aset_tdk_berwujud']) : '-';?></td>
                <td style="text-align: right;"><?=($bkninvest['aset_tetap'] != 0 ) ? rupiah($bkninvest['aset_tetap']) : '-';?></td>
                <td style="text-align: right;"><?=($bkninvest['total_perpihak'] != 0 ) ? rupiah($bkninvest['total_perpihak']) : '-';?></td>
                <?php
                $persen_pihak['persen'] = ($sum_bkn_invest['total_perpihak']!=0)?($bkninvest['total_perpihak']/$sum_bkn_invest['total_perpihak'])*100:0;

                $tot_persen_pihak += $persen_pihak['persen'];
                ?>
                <td style="text-align: right;"><?=($persen_pihak['persen'] != 0 ) ? persen($persen_pihak['persen']).'%' : '-';?></td>
            </tr>
        <?php endforeach;?>
    <?php endif;?>
</tbody>
<tr style="background-color: #d8d8d8; font-weight: bold;">
    <tr>
        <td style="text-align: left;" colspan="2">Total Per Jenis Bukan Investasi</td>
        <td style="text-align: right;"><?=($sum_bkn_invest['kas_bank'] != 0 ) ? rupiah($sum_bkn_invest['kas_bank']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_bkn_invest['piutang_iuran'] != 0 ) ? rupiah($sum_bkn_invest['piutang_iuran']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_bkn_invest['piutang_investasi'] != 0 ) ? rupiah($sum_bkn_invest['piutang_investasi']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_bkn_invest['piutang_hasil_invest'] != 0 ) ? rupiah($sum_bkn_invest['piutang_hasil_invest']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_bkn_invest['piutang_lainnya'] != 0 ) ? rupiah($sum_bkn_invest['piutang_lainnya']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_bkn_invest['piutang_biaya_konpensasi_bank'] != 0 ) ? rupiah($sum_bkn_invest['piutang_biaya_konpensasi_bank']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_bkn_invest['uangmuka_pph'] != 0 ) ? rupiah($sum_bkn_invest['uangmuka_pph']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_bkn_invest['piutang_pihak_ketiga'] != 0 ) ? rupiah($sum_bkn_invest['piutang_pihak_ketiga']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_bkn_invest['piutang_denda'] != 0 ) ? rupiah($sum_bkn_invest['piutang_denda']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_bkn_invest['cadangan_penyisihan'] != 0 ) ? rupiah($sum_bkn_invest['cadangan_penyisihan']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_bkn_invest['bangunan'] != 0 ) ? rupiah($sum_bkn_invest['bangunan']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_bkn_invest['tanah_bangunan'] != 0 ) ? rupiah($sum_bkn_invest['tanah_bangunan']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_bkn_invest['aset_lainnya'] != 0 ) ? rupiah($sum_bkn_invest['aset_lainnya']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_bkn_invest['kendaraan'] != 0 ) ? rupiah($sum_bkn_invest['kendaraan']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_bkn_invest['komputer'] != 0 ) ? rupiah($sum_bkn_invest['komputer']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_bkn_invest['inventaris_kantor'] != 0 ) ? rupiah($sum_bkn_invest['inventaris_kantor']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_bkn_invest['hak_guna_bangunan'] != 0 ) ? rupiah($sum_bkn_invest['hak_guna_bangunan']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_bkn_invest['aset_tdk_berwujud'] != 0 ) ? rupiah($sum_bkn_invest['aset_tdk_berwujud']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_bkn_invest['aset_tetap'] != 0 ) ? rupiah($sum_bkn_invest['aset_tetap']) : '-';?></td>
        <td style="text-align: right;"><?=($sum_bkn_invest['total_perpihak'] != 0 ) ? rupiah($sum_bkn_invest['total_perpihak']) : '-';?></td>
        <td style="text-align: right;"><?=($tot_persen_pihak != 0 ) ? persen($tot_persen_pihak).'%' : '-';?></td>
    </tr>
    <tr>
        <td style="text-align: left;" colspan="2">% Persen Per Jenis Bukan Investasi</td>
        <td style="text-align: right;"><?=($persen_sum_bkn_invest['kas_bank'] != 0 ) ? persen($persen_sum_bkn_invest['kas_bank']).'%' : '-';?></td>
        <td style="text-align: right;"><?=($persen_sum_bkn_invest['piutang_iuran'] != 0 ) ? persen($persen_sum_bkn_invest['piutang_iuran']).'%' : '-';?></td>
        <td style="text-align: right;"><?=($persen_sum_bkn_invest['piutang_investasi'] != 0 ) ? persen($persen_sum_bkn_invest['piutang_investasi']).'%' : '-';?></td>
        <td style="text-align: right;"><?=($persen_sum_bkn_invest['piutang_hasil_invest'] != 0 ) ? persen($persen_sum_bkn_invest['piutang_hasil_invest']).'%' : '-';?></td>
        <td style="text-align: right;"><?=($persen_sum_bkn_invest['piutang_lainnya'] != 0 ) ? persen($persen_sum_bkn_invest['piutang_lainnya']).'%' : '-';?></td>
        <td style="text-align: right;"><?=($persen_sum_bkn_invest['piutang_biaya_konpensasi_bank'] != 0 ) ? persen($persen_sum_bkn_invest['piutang_biaya_konpensasi_bank']).'%' : '-';?></td>
        <td style="text-align: right;"><?=($persen_sum_bkn_invest['uangmuka_pph'] != 0 ) ? persen($persen_sum_bkn_invest['uangmuka_pph']).'%' : '-';?></td>
        <td style="text-align: right;"><?=($persen_sum_bkn_invest['piutang_pihak_ketiga'] != 0 ) ? persen($persen_sum_bkn_invest['piutang_pihak_ketiga']).'%' : '-';?></td>
        <td style="text-align: right;"><?=($persen_sum_bkn_invest['piutang_denda'] != 0 ) ? persen($persen_sum_bkn_invest['piutang_denda']).'%' : '-';?></td>
        <td style="text-align: right;"><?=($persen_sum_bkn_invest['cadangan_penyisihan'] != 0 ) ? persen($persen_sum_bkn_invest['cadangan_penyisihan']).'%' : '-';?></td>
        <td style="text-align: right;"><?=($persen_sum_bkn_invest['bangunan'] != 0 ) ? persen($persen_sum_bkn_invest['bangunan']).'%' : '-';?></td>
        <td style="text-align: right;"><?=($persen_sum_bkn_invest['tanah_bangunan'] != 0 ) ? persen($persen_sum_bkn_invest['tanah_bangunan']).'%' : '-';?></td>
        <td style="text-align: right;"><?=($persen_sum_bkn_invest['aset_lainnya'] != 0 ) ? persen($persen_sum_bkn_invest['aset_lainnya']).'%' : '-';?></td>
        <td style="text-align: right;"><?=($persen_sum_bkn_invest['kendaraan'] != 0 ) ? persen($persen_sum_bkn_invest['kendaraan']).'%' : '-';?></td>
        <td style="text-align: right;"><?=($persen_sum_bkn_invest['komputer'] != 0 ) ? persen($persen_sum_bkn_invest['komputer']).'%' : '-';?></td>
        <td style="text-align: right;"><?=($persen_sum_bkn_invest['inventaris_kantor'] != 0 ) ? persen($persen_sum_bkn_invest['inventaris_kantor']).'%' : '-';?></td>
        <td style="text-align: right;"><?=($persen_sum_bkn_invest['hak_guna_bangunan'] != 0 ) ? persen($persen_sum_bkn_invest['hak_guna_bangunan']).'%' : '-';?></td>
        <td style="text-align: right;"><?=($persen_sum_bkn_invest['aset_tdk_berwujud'] != 0 ) ? persen($persen_sum_bkn_invest['aset_tdk_berwujud']).'%' : '-';?></td>
        <td style="text-align: right;"><?=($persen_sum_bkn_invest['aset_tetap'] != 0 ) ? persen($persen_sum_bkn_invest['aset_tetap']).'%' : '-';?></td>
        <td style="text-align: right;"><?=($persen_sum_bkn_invest['total_perpihak'] != 0 ) ? persen($persen_sum_bkn_invest['total_perpihak']).'%' : '-';?></td>
        <td></td>
    </tr>
</tr>
</table>
<pagebreak></pagebreak>
<p style="margin-left:0px;margin-top:10px;margin-bottom:10px;font-weight: bold">     
    c) Rincian Hasil Investasi
</p>
<table cellpadding="4px" cellspacing="0px" border="1" autosize="1" style="color:#000;background:#fff;font-size: 12px;">
    <thead>
        <tr>
            <th rowspan="2" style="width:3%;">No.</th>
            <th rowspan="2" width="20%">Nama Pihak</th>
            <th colspan="30">Jenis Investasi</th>
            <th rowspan="2" style="width:13%">Total Per Pihak</th>
            <th rowspan="2" style="width:13%">% Per Pihak</th>
        </tr>
        <tr>
            <th>Bunga Deposito</th>
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
            <th>Pendapatan Investasi Lainnya </th>
            <th>Laba Rugi Selisih Kurs</th>
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
                <td style="text-align: right;"><?= (isset($hasilinvest['bunga_deposito'])) ? (($hasilinvest['bunga_deposito'] != 0 ) ? rupiah($hasilinvest['bunga_deposito']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['bunga_surat_utang_negara'])) ? (($hasilinvest['bunga_surat_utang_negara'] != 0 ) ? rupiah($hasilinvest['bunga_surat_utang_negara']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['imbal_hasil_sukuk_pemerintah'])) ? (($hasilinvest['imbal_hasil_sukuk_pemerintah'] != 0 ) ? rupiah($hasilinvest['imbal_hasil_sukuk_pemerintah']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['bunga_obligasi_korporasi'])) ? (($hasilinvest['bunga_obligasi_korporasi'] != 0 ) ? rupiah($hasilinvest['bunga_obligasi_korporasi']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['imbal_hasil_sukuk_korporasi'])) ? (($hasilinvest['imbal_hasil_sukuk_korporasi'] != 0 ) ? rupiah($hasilinvest['imbal_hasil_sukuk_korporasi']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['bunga_medium_term_notes'])) ? (($hasilinvest['bunga_medium_term_notes'] != 0 ) ? rupiah($hasilinvest['bunga_medium_term_notes']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['deviden_saham'])) ? (($hasilinvest['deviden_saham'] != 0 ) ? rupiah($hasilinvest['deviden_saham']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['deviden_reksadana'])) ? (($hasilinvest['deviden_reksadana'] != 0 ) ? rupiah($hasilinvest['deviden_reksadana']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['nt_nilai_surat_utang_negara'])) ? (($hasilinvest['nt_nilai_surat_utang_negara'] != 0 ) ? rupiah($hasilinvest['nt_nilai_surat_utang_negara']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['nt_nilai_sukuk_pemerintah'])) ? (($hasilinvest['nt_nilai_sukuk_pemerintah'] != 0 ) ? rupiah($hasilinvest['nt_nilai_sukuk_pemerintah']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['nt_nilai_obligasi_korporasi'])) ? (($hasilinvest['nt_nilai_obligasi_korporasi'] != 0 ) ? rupiah($hasilinvest['nt_nilai_obligasi_korporasi']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['nt_nilai_sukuk_korporasi'])) ? (($hasilinvest['nt_nilai_sukuk_korporasi'] != 0 ) ? rupiah($hasilinvest['nt_nilai_sukuk_korporasi']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['nt_nilai_mtn'])) ? (($hasilinvest['nt_nilai_mtn'] != 0 ) ? rupiah($hasilinvest['nt_nilai_mtn']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['nt_nilai_saham'])) ? (($hasilinvest['nt_nilai_saham'] != 0 ) ? rupiah($hasilinvest['nt_nilai_saham']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['nt_nab_reksadana'])) ? (($hasilinvest['nt_nab_reksadana'] != 0 ) ? rupiah($hasilinvest['nt_nab_reksadana']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['laba_rugi_pelepasan_investasi'])) ? (($hasilinvest['laba_rugi_pelepasan_investasi'] != 0 ) ? rupiah($hasilinvest['laba_rugi_pelepasan_investasi']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['pendapatan_investasi_lainnya'])) ? (($hasilinvest['pendapatan_investasi_lainnya'] != 0 ) ? rupiah($hasilinvest['pendapatan_investasi_lainnya']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['laba_rugi_selisih_kurs'])) ? (($hasilinvest['laba_rugi_selisih_kurs'] != 0 ) ? rupiah($hasilinvest['laba_rugi_selisih_kurs']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['laba_rugi_pelepasan_sertifikat_deposito'])) ? (($hasilinvest['laba_rugi_pelepasan_sertifikat_deposito'] != 0 ) ? rupiah($hasilinvest['laba_rugi_pelepasan_sertifikat_deposito']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['laba_rugi_pelepasan_sun'])) ? (($hasilinvest['laba_rugi_pelepasan_sun'] != 0 ) ? rupiah($hasilinvest['laba_rugi_pelepasan_sun']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['laba_rugi_pelepasan_sukuk_pemerintah'])) ? (($hasilinvest['laba_rugi_pelepasan_sukuk_pemerintah'] != 0 ) ? rupiah($hasilinvest['laba_rugi_pelepasan_sukuk_pemerintah']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['laba_rugi_pelepasan_obligasi_korporasi'])) ? (($hasilinvest['laba_rugi_pelepasan_obligasi_korporasi'] != 0 ) ? rupiah($hasilinvest['laba_rugi_pelepasan_obligasi_korporasi']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['laba_rugi_pelepasan_sukuk_korporasi'])) ? (($hasilinvest['laba_rugi_pelepasan_sukuk_korporasi'] != 0 ) ? rupiah($hasilinvest['laba_rugi_pelepasan_sukuk_korporasi']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['laba_rugi_pelepasan_mtn'])) ? (($hasilinvest['laba_rugi_pelepasan_mtn'] != 0 ) ? rupiah($hasilinvest['laba_rugi_pelepasan_mtn']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['laba_rugi_pelepasan_saham'])) ? (($hasilinvest['laba_rugi_pelepasan_saham'] != 0 ) ? rupiah($hasilinvest['laba_rugi_pelepasan_saham']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['laba_rugi_pelepasan_reksadana'])) ? (($hasilinvest['laba_rugi_pelepasan_reksadana'] != 0 ) ? rupiah($hasilinvest['laba_rugi_pelepasan_reksadana']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['laba_rugi_pelepasan_penyertaan_langsung'])) ? (($hasilinvest['laba_rugi_pelepasan_penyertaan_langsung'] != 0 ) ? rupiah($hasilinvest['laba_rugi_pelepasan_penyertaan_langsung']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['laba_rugi_pelepasan_tanah_bangunan'])) ? (($hasilinvest['laba_rugi_pelepasan_tanah_bangunan'] != 0 ) ? rupiah($hasilinvest['laba_rugi_pelepasan_tanah_bangunan']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['deviden_penyertaan_langsung'])) ? (($hasilinvest['deviden_penyertaan_langsung'] != 0 ) ? rupiah($hasilinvest['deviden_penyertaan_langsung']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['imbal_hasil_reksadana'])) ? (($hasilinvest['imbal_hasil_reksadana'] != 0 ) ? rupiah($hasilinvest['imbal_hasil_reksadana']) : '-') : '-'; ?></td>
                <td style="text-align: right;"><?= (isset($hasilinvest['total_perpihak'])) ? (($hasilinvest['total_perpihak'] != 0 ) ? rupiah($hasilinvest['total_perpihak']) : '-') : '-';?></td>
                <?php
                $persen_pihak['persen'] = ($sum_hasil_invest['total_perpihak']!=0)?($hasilinvest['total_perpihak']/$sum_hasil_invest['total_perpihak'])*100:0;

                $tot_persen_pihak += $persen_pihak['persen'];
                ?>
                <td style="text-align: right;"><?=($persen_pihak['persen'] != 0 ) ? persen($persen_pihak['persen']).'%' : '-';?></td>
            </tr>
        <?php endforeach;?>
        <?php endif;?>
    </tbody>
        <tr>

            <td style="text-align: left;" colspan="2">Total Per Jenis Hasil Investasi</td>
            <td style="text-align: right;"><?=($sum_hasil_invest['bunga_deposito'] != 0 ) ? rupiah($sum_hasil_invest['bunga_deposito']) : '-'; ?></td>
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
            <td style="text-align: right;"><?=($sum_hasil_invest['pendapatan_investasi_lainnya'] != 0 ) ? rupiah($sum_hasil_invest['pendapatan_investasi_lainnya']) : '-'; ?></td>
            <td style="text-align: right;"><?=($sum_hasil_invest['laba_rugi_selisih_kurs'] != 0 ) ? rupiah($sum_hasil_invest['laba_rugi_selisih_kurs']) : '-'; ?></td>
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
            <td style="text-align: right;"><?=($sum_hasil_invest['deviden_penyertaan_langsung'] != 0 ) ? rupiah($sum_hasil_invest['deviden_penyertaan_langsung']) : '-'; ?></td>
            <td style="text-align: right;"><?=($sum_hasil_invest['imbal_hasil_reksadana'] != 0 ) ? rupiah($sum_hasil_invest['imbal_hasil_reksadana']) : '-'; ?></td>
            <td style="text-align: right;"><?=($sum_hasil_invest['total_perpihak'] != 0 ) ? rupiah($sum_hasil_invest['total_perpihak']) : '-';?></td>
            <td style="text-align: right;"><?=($tot_persen_pihak != 0 ) ? persen($tot_persen_pihak).'%' : '-';?></td>
        </tr>
        <tr>
            <td style="text-align: left;" colspan="2">% Persen Per Jenis Hasil Investasi</td>
            <td style="text-align: right;"><?=($persen_sum_hasil_invest['bunga_deposito'] != 0 ) ? persen($persen_sum_hasil_invest['bunga_deposito']) : '-'; ?></td>
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
            <td style="text-align: right;"><?=($persen_sum_hasil_invest['pendapatan_investasi_lainnya'] != 0 ) ? persen($persen_sum_hasil_invest['pendapatan_investasi_lainnya']) : '-'; ?></td>
            <td style="text-align: right;"><?=($persen_sum_hasil_invest['laba_rugi_selisih_kurs'] != 0 ) ? persen($persen_sum_hasil_invest['laba_rugi_selisih_kurs']) : '-'; ?></td>
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
            <td style="text-align: right;"><?=($persen_sum_hasil_invest['deviden_penyertaan_langsung'] != 0 ) ? persen($persen_sum_hasil_invest['deviden_penyertaan_langsung']) : '-'; ?></td>
            <td style="text-align: right;"><?=($persen_sum_hasil_invest['imbal_hasil_reksadana'] != 0 ) ? persen($persen_sum_hasil_invest['imbal_hasil_reksadana']) : '-'; ?></td>
            <td style="text-align: right;"><?=($persen_sum_hasil_invest['total_perpihak'] != 0 ) ? persen($persen_sum_hasil_invest['total_perpihak']).'%' : '-';?></td>
            <td></td>
        </tr>
</table>
<!-- <br> -->
<!-- data keterangan  -->
<!-- <div>
    <p style="margin-left:15px;font-size: 14px;font-weight: bold">Keterangan :</p>
    <p style="margin-left:10px;font-size: 12px;margin-right: 15px;margin-left: 15px;text-align: justify;"><?php echo (isset($data_hasil_investasi_ket[0]->keterangan_lap) ? $data_hasil_investasi_ket[0]->keterangan_lap : '');?></p>
</div> -->
<!-- end keterangan -->