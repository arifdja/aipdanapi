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
    <div class="col-md-3">
        <div class="small-box colornya">
            <div class="inner">
              <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Aset Investasi</span>
              <p style="font-size: 20px; font-weight:bold;">Rp 200.000.000.000.000,-</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="small-box colornya">
            <div class="inner">
              <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Aset Bukan Investasi</span>
              <p style="font-size: 20px; font-weight:bold;">Rp 1.000.000.000.000,-</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="small-box colornya">
            <div class="inner">
              <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Kewajiban</span>
              <p style="font-size: 20px; font-weight:bold;">Rp 340.000.000.000.000,-</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="small-box colornya">
            <div class="inner">
               <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Dana Bersih</span>
              <p style="font-size: 20px; font-weight:bold;">Rp 147.000.000.000.000,-</p>
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
                              <p style="font-size: 20px; font-weight:bold;">1.870.980</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="small-box colornya2">
                            <div class="inner">
                              <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Jumlah Pensiunan</span>
                              <p style="font-size: 20px; font-weight:bold;">798.432</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="small-box colornya2">
                            <div class="inner">
                              <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Jumlah Pembayaran Belanja Pensiun</span>
                              <p style="font-size: 20px; font-weight:bold;">Rp 340.000.000.000.000,-</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    


$.post(host+'dashboard-tampil/get_executive_summary', {[csrf_token]:csrf_hash}, function(resp){
    if(resp){
        parsing = JSON.parse(resp);

        genGaugeChart(parsing.div_invest, parsing.judul_invest, parsing.nil_invest);
        genGaugeChart(parsing.div_hasil, parsing.judul_hasil, parsing.nil_hasil);
        genGaugeChart(parsing.div_yoi, parsing.judul_yoi, parsing.nil_yoi);
        genGaugeChart(parsing.div_pertumbuhan, parsing.judul_pertumbuhan, parsing.nil_pertumbuhan);
    }
});


</script>