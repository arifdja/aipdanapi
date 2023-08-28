<style type="text/css">
    .colornya {
      background: linear-gradient(90deg, rgba(1,106,156,1) 0%, rgba(137,96,203,1) 0%, rgba(11,163,230,1) 100%);
      color: #ffff;
    }

    .colornya2 {
      background: linear-gradient(90deg, rgba(1,106,156,1) 0%, rgba(137,96,203,1) 0%, rgba(11,230,128,1) 100%);
      color: #ffff;
    }
</style>
<?php
$level = $this->session->userdata('level');
if ($level == 'DJA') { 
  $foto_profile="files/profiles/logo-dja.jpg";
}elseif ($level == 'TASPEN') {
  $foto_profile="files/profiles/logo-taspen.jpg";
}elseif ($level == 'ASABRI') {
  $foto_profile="files/profiles/logo-asabri.jpg";
}else{
  $foto_profile="files/profiles/_noprofile.jpg";
}
?>
<!-- <img src="<?php echo site_url($foto_profile); ?>" class="img-circle" style="width: auto; height: 70px;"/> -->
<div class="row">
  <div class="col-md-12">
    <div class="nav-tabs-custom">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Pilihan</h3>
        </div>
        <div class="box-body">
          <div class="col-md-3">
            <div class="form-group">
              <select class="form-control select2nya" id="iduser">
                <option value="">
                  -- Pilih User--
                </option>
                <?php if(isset($opt_user) && is_array($opt_user)){?> 
                  <?php foreach($opt_user as $k=>$v){?>
                    <option value="<?php echo $v['id'];?>" <?php if(!empty($iduser) && $v['id'] == $iduser) echo 'selected="selected"';?>>
                      <?php echo $v['txt'];?>
                    </option>
                  <?php }?>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="col-md-1">
            <div class="form-group">
              <a href="javascript:void(0)" title="search" class="btn btn-primary btn-sm btn-flat filter_data">
                <i class="fa fa-search"></i>
              </a> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="small-box colornya">
            <div class="inner">
              <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Aset Investasi</span>
              <p style="font-size: 20px; font-weight:bold;" id="tot-investasi"></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="small-box colornya">
            <div class="inner">
              <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Aset Bukan Investasi</span>
              <p style="font-size: 20px; font-weight:bold;" id="tot-bukan-investasi"></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="small-box colornya">
            <div class="inner">
              <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Kewajiban</span>
              <p style="font-size: 20px; font-weight:bold;" id="tot-kewajiban"></p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="small-box colornya">
            <div class="inner">
               <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Dana Bersih</span>
              <p style="font-size: 20px; font-weight:bold;" id="tot-dana-bersih"></p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Capaian IKU</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div id="container-invest"></div>
                        </div>
                        <div class="col-md-3">
                            <div id="container-hasil"></div>
                        </div>
                        <div class="col-md-3">
                            <div id="container-yoi"></div>
                        </div>
                        <div class="col-md-3">
                            <div id="container-pertumbuhan"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
</div>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Aspek Operasional - Per Semester</h3>
                </div>
                <div class="box-body">
                    <div class="col-md-4">
                        <div class="small-box colornya2">
                            <div class="inner">
                              <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Jumlah Peserta Aktif</span>
                              <p style="font-size: 20px; font-weight:bold;" id="tot-peserta"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="small-box colornya2">
                            <div class="inner">
                              <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Jumlah Pensiunan</span>
                              <p style="font-size: 20px; font-weight:bold;" id="tot-pensiunan"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="small-box colornya2">
                            <div class="inner">
                              <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Jumlah Pembayaran Belanja Pensiun</span>
                              <p style="font-size: 20px; font-weight:bold;" id="tot-pembayaran"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    
    $(".select2nya").select2( { 'width':'100%' } );
    $('.tahun').text(tahun);


    var par = {};
    par['iduser'] = "";
    par[csrf_token] = csrf_hash;
    $.LoadingOverlay("show");
    $.post(host+'dashboard-tampil/get_executive_summary', par, function(resp){
        if(resp){
            $.LoadingOverlay("hide", true);

            parsing = JSON.parse(resp);

            var investasi = 'Rp '+parsing.tot_investasi+',-';
            var bukan_investasi = 'Rp '+parsing.tot_bukan_investasi+',-';
            var kewajiban = 'Rp '+parsing.tot_kewajiban+',-';
            var dana_bersih = 'Rp '+parsing.tot_dana_bersih+',-';
            var peserta = parsing.tot_peserta;
            var pensiunan = parsing.tot_pensiunan;
            var pembayaran = 'Rp '+parsing.tot_pembayaran+',-';

            $('#tot-investasi').html(investasi);
            $('#tot-bukan-investasi').html(bukan_investasi);
            $('#tot-kewajiban').html(kewajiban);
            $('#tot-dana-bersih').html(dana_bersih);
            $('#tot-peserta').html(peserta);
            $('#tot-pensiunan').html(pensiunan);
            $('#tot-pembayaran').html(pembayaran);

            genGaugeChart(parsing.div_invest, parsing.judul_invest, parsing.nil_invest);
            genGaugeChart(parsing.div_hasil, parsing.judul_hasil, parsing.nil_hasil);
            genGaugeChart(parsing.div_yoi, parsing.judul_yoi, parsing.nil_yoi);
            genGaugeChart(parsing.div_pertumbuhan, parsing.judul_pertumbuhan, parsing.nil_pertumbuhan);
        }
    });



    $('.filter_data').on('click', function(){
        var level = '<?php echo $this->session->userdata('level'); ?>';
        if (level == "DJA") {
            if ($('#iduser').val() == "") {
                $.messager.alert('SMART AIP','Pilih user terlebih dahulu !','warning');
                return false;
            }  
        }
        
        var param = {};
        param['iduser'] = $('#iduser').val();
        param[csrf_token] = csrf_hash;
        $.LoadingOverlay("show");

        $.post(host+'dashboard-tampil/get_executive_summary', param, function(resp){
            if(resp){
                $.LoadingOverlay("hide", true);

                parsing = JSON.parse(resp);

                var investasi = 'Rp '+parsing.tot_investasi+',-';
                var bukan_investasi = 'Rp '+parsing.tot_bukan_investasi+',-';
                var kewajiban = 'Rp '+parsing.tot_kewajiban+',-';
                var dana_bersih = 'Rp '+parsing.tot_dana_bersih+',-';
                var peserta = parsing.tot_peserta;
                var pensiunan = parsing.tot_pensiunan;
                var pembayaran = 'Rp '+parsing.tot_pembayaran+',-';

                $('#tot-investasi').html(investasi);
                $('#tot-bukan-investasi').html(bukan_investasi);
                $('#tot-kewajiban').html(kewajiban);
                $('#tot-dana-bersih').html(dana_bersih);
                $('#tot-peserta').html(peserta);
                $('#tot-pensiunan').html(pensiunan);
                $('#tot-pembayaran').html(pembayaran);

                genGaugeChart(parsing.div_invest, parsing.judul_invest, parsing.nil_invest);
                genGaugeChart(parsing.div_hasil, parsing.judul_hasil, parsing.nil_hasil);
                genGaugeChart(parsing.div_yoi, parsing.judul_yoi, parsing.nil_yoi);
                genGaugeChart(parsing.div_pertumbuhan, parsing.judul_pertumbuhan, parsing.nil_pertumbuhan);
            }
        });
    });
</script>