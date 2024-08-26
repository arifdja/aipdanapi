<style type="text/css">
  .colornya {
    background: linear-gradient(90deg, rgba(1, 106, 156, 1) 0%, rgba(137, 96, 203, 1) 0%, rgba(11, 163, 230, 1) 100%);
    color: #ffff;
  }

  .colornya2 {
    background: linear-gradient(90deg, rgba(1, 106, 156, 1) 0%, rgba(137, 96, 203, 1) 0%, rgba(11, 230, 128, 1) 100%);
    color: #ffff;
  }
</style>
<?php
$level = $this->session->userdata('level');
$tahun = $this->session->userdata('tahun');

?>
<!-- <img src="" id="image3-nya" class="img" style="width: auto; height: 35px;" /> -->
<div class="row adm">
  <div class="col-md-12">
    <div class="nav-tabs-custom">
      <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Pilihan</h3>
          <p class="box-title pull-right" style="margin-right:20px"><i class="fa fa-calendar"></i>&nbsp;&nbsp;<?php echo $bln_head.' - '. $tahun;?></p>
        </div>
        <div class="box-body">
          <div class="col-md-3">
            <div class="form-group">
              <select class="form-control select2nya" id="iduser">
                <option value="">
                  -- Pilih User--
                </option>
                <?php if (isset($opt_user) && is_array($opt_user)) { ?>
                  <?php foreach ($opt_user as $k => $v) { ?>
                    <option value="<?php echo $v['id']; ?>" <?php if (!empty($iduser) && $v['id'] == $iduser) echo 'selected="selected"'; ?>>
                      <?php echo $v['txt']; ?>
                    </option>
                  <?php } ?>
                <?php } ?>
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
        <p style="font-size: 18px; font-weight:bold;" id="tot-investasi"></p>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="small-box colornya">
      <div class="inner">
        <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Aset Bukan Investasi</span>
        <p style="font-size: 18px; font-weight:bold;" id="tot-bukan-investasi"></p>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="small-box colornya">
      <div class="inner">
        <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Kewajiban</span>
        <p style="font-size: 18px; font-weight:bold;" id="tot-kewajiban"></p>
      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="small-box colornya">
      <div class="inner">
        <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Dana Bersih</span>
        <p style="font-size: 18px; font-weight:bold;" id="tot-dana-bersih"></p>
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
          <h3 class="box-title">Aspek Operasional - Semester <span id="semester"></span></h3>
        </div>
        <div class="box-body">
          <div class="col-md-4">
            <div class="small-box colornya2">
              <div class="inner">
                <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Jumlah Peserta Aktif</span>
                <p style="font-size: 18px; font-weight:bold;" id="tot-peserta"></p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="small-box colornya2">
              <div class="inner">
                <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Jumlah Pensiunan</span>
                <p style="font-size: 18px; font-weight:bold;" id="tot-pensiunan"></p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="small-box colornya2">
              <div class="inner">
                <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Jumlah Pembayaran Belanja Pensiun</span>
                <p style="font-size: 18px; font-weight:bold;" id="tot-pembayaran"></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div>
  <button id="tampilkan">tes</button>
</div>
<div id="tableau">
  
</div>
<script type="text/javascript">

  jQuery(document).ready(function($) {

    $(document).on( "click","#tampilkan", function() {

        alert('work');


        $.ajax({
           type: "post",
           headers: {'X-Requested-With': 'XMLHttpRequest'},
           url: "<?= base_url(); ?>/dashboard-tableau",
           dataType:'json',
           data: {
              kdsatker:'tes',
              bulan:'tes2'
            },
           success: function (response) {
            console.log(response.data.body[0][0]);

            $("#tableau").html(response.data.body[0][0].value);
             // if (response.error) {
             //    if (response.error.info) {
             //      toastr.warning(response.error.info);
             //    }
             //    if (response.error.bulan) {
             //      toastr.warning(response.error.bulan);
             //    }
             //    if (response.error.kdsatker) {
             //      toastr.warning(response.error.kdsatker);
             //    }
             //    $("#ajaxbody").html(response.html); 
             //    $(".csrf").val(response.csrf);
             // } else {
             //    $("#ajaxbody").html(response.html);
             //    toastr.success(response.success);
             //  }

             },
           error:function(xhr,ajaxOptions,thrownError){
              alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
           }
         });

    });

  });


  $(".select2nya").select2({
    'width': '100%'
  });
  $('.tahun').text(tahun);
  var levelnya = '<?php echo $this->session->userdata('level'); ?>';
  // if (levelnya == 'TASPEN') {
  //   var image = document.getElementById("image-nya").src = host + "files/profiles/TASPEN.png";
  // } else if (levelnya == 'ASABRI') {
  //   var image = document.getElementById("image-nya").src = host + "files/profiles/logo-asabri-v2.png";
  // }else{
  //   var image = document.getElementById("image-nya").src = host + "files/profiles/TASPEN.png";
  // }

  $('#iduser').on('change', function() {
    if (levelnya == 'TASPEN') {
      var val = 'TSN002';
    } else if (levelnya == 'ASABRI') {
      var val = 'ASB003';
    }else{
      var val = $(this).val();
    }
    
    console.log(val);
    if (val == 'TSN002') {
      var image = document.getElementById("image-nya").src = host + "files/profiles/TASPEN.png";
      console.log(image);
    } else if (val == 'ASB003') {
      var image = document.getElementById("image-nya").src = host + "files/profiles/logo-asabri-v2.png";
    } else {
      var image = document.getElementById("image-nya").src = host + "files/profiles/TASPEN.png";

      
    }
  });


  var par = {};
  // var idnya = $('#iduser').val('TSN002').trigger("change");
  console.log(levelnya);

  if (levelnya == 'TASPEN') {
    var userid = 'TSN002';
  } else if (levelnya == 'ASABRI') {
    var userid = 'ASB003';
  }else{
    var userid = 'TSN002';
  }
  par['iduser'] = userid;
  par[csrf_token] = csrf_hash;
  $.LoadingOverlay("show");
  $.post(host + 'dashboard-tampil-summary/get_executive_summary', par, function(resp) {
    if (resp) {
      $.LoadingOverlay("hide", true);

      parsing = JSON.parse(resp);

      var investasi = 'Rp ' + parsing.tot_investasi + ',-';
      var bukan_investasi = 'Rp ' + parsing.tot_bukan_investasi + ',-';
      var kewajiban = 'Rp ' + parsing.tot_kewajiban + ',-';
      var dana_bersih = 'Rp ' + parsing.tot_dana_bersih + ',-';
      var peserta = parsing.tot_peserta;
      var pensiunan = parsing.tot_pensiunan;
      var pembayaran = 'Rp ' + parsing.tot_pembayaran + ',-';
      var smt = parsing.semester;

      $('#tot-investasi').html(investasi);
      $('#tot-bukan-investasi').html(bukan_investasi);
      $('#tot-kewajiban').html(kewajiban);
      $('#tot-dana-bersih').html(dana_bersih);
      $('#tot-peserta').html(peserta);
      $('#tot-pensiunan').html(pensiunan);
      $('#tot-pembayaran').html(pembayaran);
      $('#semester').html(smt);

      genGaugeChart(parsing.div_invest, parsing.judul_invest, parsing.nil_invest);
      genGaugeChart(parsing.div_hasil, parsing.judul_hasil, parsing.nil_hasil);
      genGaugeChart(parsing.div_yoi, parsing.judul_yoi, parsing.nil_yoi);
      genGaugeChart(parsing.div_pertumbuhan, parsing.judul_pertumbuhan, parsing.nil_pertumbuhan);
    }
  });



  $('.filter_data').on('click', function() {
    var level = '<?php echo $this->session->userdata('level'); ?>';
    if (level == "DJA") {
      if ($('#iduser').val() == "") {
        $.messager.alert('SMART AIP', 'Pilih user terlebih dahulu !', 'warning');
        return false;
      }
    }

    var param = {};
    param['iduser'] = $('#iduser').val();
    param[csrf_token] = csrf_hash;
    $.LoadingOverlay("show");

    $.post(host + 'dashboard-tampil-summary/get_executive_summary', param, function(resp) {
      if (resp) {
        $.LoadingOverlay("hide", true);

        parsing = JSON.parse(resp);

        var investasi = 'Rp ' + parsing.tot_investasi + ',-';
        var bukan_investasi = 'Rp ' + parsing.tot_bukan_investasi + ',-';
        var kewajiban = 'Rp ' + parsing.tot_kewajiban + ',-';
        var dana_bersih = 'Rp ' + parsing.tot_dana_bersih + ',-';
        var peserta = parsing.tot_peserta;
        var pensiunan = parsing.tot_pensiunan;
        var pembayaran = 'Rp ' + parsing.tot_pembayaran + ',-';
        var smt = parsing.semester;

        $('#tot-investasi').html(investasi);
        $('#tot-bukan-investasi').html(bukan_investasi);
        $('#tot-kewajiban').html(kewajiban);
        $('#tot-dana-bersih').html(dana_bersih);
        $('#tot-peserta').html(peserta);
        $('#tot-pensiunan').html(pensiunan);
        $('#tot-pembayaran').html(pembayaran);
        $('#semester').html(smt);

        genGaugeChart(parsing.div_invest, parsing.judul_invest, parsing.nil_invest);
        genGaugeChart(parsing.div_hasil, parsing.judul_hasil, parsing.nil_hasil);
        genGaugeChart(parsing.div_yoi, parsing.judul_yoi, parsing.nil_yoi);
        genGaugeChart(parsing.div_pertumbuhan, parsing.judul_pertumbuhan, parsing.nil_pertumbuhan);
      }
    });
  });
</script>