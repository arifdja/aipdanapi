<style type="text/css">
   .colornya {
      background: linear-gradient(90deg, rgba(38,94,168,2) 0%, rgba(74,123,189,1) 0%, rgba(243,187,68,13) 100%);
      color: #ffff;
    }
</style>
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
          <div class="col-md-3">
            <div class="form-group">
              <select class="form-control select2nya" id="dashboard">
                <option value="">
                  -- Pilih Laporan --
                </option>
                <?php if(isset($opt_dashboard) && is_array($opt_dashboard)){?> 
                  <?php foreach($opt_dashboard as $k=>$v){?>
                    <option value="<?php echo $v['id'];?>" <?php if(!empty($iduser) && $v['id'] == $iduser) echo 'selected="selected"';?>>
                      <?php echo $v['txt'];?>
                    </option>
                  <?php }?>
                <?php }?>
              </select>
            </div>
          </div> 
          <div class="col-md-3 bln">
            <div class="form-group">
              <select class="form-control select2nya" id="id_bulan">
                <option value="">
                  -- Pilih Bulan --
                </option>
                <?php if(isset($opt_bln) && is_array($opt_bln)){?> 
                  <?php foreach($opt_bln as $k=>$v){?>
                    <option value="<?php echo $v['id'];?>" <?php if(!empty($id_bulan) && $v['id'] == $id_bulan) echo 'selected="selected"';?>>
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
    <div class="col-md-6">
        <div class="nav-tabs-custom">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="small-box colornya">
                        <div class="inner">
                          <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Arus Kas Dari Aktivitas Investasi</span>
                          <p style="font-size: 20px; font-weight:bold;" id="tot-investasi"></p>
                      </div>
                  </div>
                </div>
                <div class="box-body">
                    <div id="container-aruskas-investasi"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="nav-tabs-custom">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="small-box colornya">
                        <div class="inner">
                          <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Arus Kas Dari Aktivitas Operasional</span>
                          <p style="font-size: 20px; font-weight:bold;" id="tot-operasional"></p>
                      </div>
                  </div>
                </div>
                <div class="box-body">
                     <div id="container-aruskas-operasional"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="nav-tabs-custom">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="small-box colornya">
                        <div class="inner">
                          <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Arus Kas Dari Aktivitas Pendanaan</span>
                          <p style="font-size: 20px; font-weight:bold;" id="tot-pendanaan"></p>
                      </div>
                  </div>
                </div>
                <div class="box-body">
                    <div id="container-aruskas-pendanaan"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
  $('.bln').hide();
  $('.smt').hide();
  $('.thn').hide();

  $(".select2nya").select2( { 'width':'100%' } );


  $('#dashboard').on('change', function(){
    var val = $(this).val();
    console.log(val);
    if(val == 'BULANAN'){
        $('.bln').show();
        $('.smt').hide();
        $('.thn').hide();
    }else if(val == 'SEMESTERAN'){
        $('.bln').hide();
        $('.smt').show();
        $('.thn').hide();
    }else if(val == 'TAHUNAN'){
        $('.bln').hide();
        $('.smt').hide();
        $('.thn').show();
    }else{
        $('.bln').hide();
        $('.smt').hide();
        $('.thn').hide();
    }
    
});

$('.tahun').text(tahun);
</script>
<script type="text/javascript">

    $('.filter_data').on('click', function(){

        if ($('#iduser').val() == "") {
            $.messager.alert('SMART AIP','Pilih user terlebih dahulu !','warning');
            return false;
        }

        if ($('#dashboard').val() == "") {
            $.messager.alert('SMART AIP','Pilih jenis laporan terlebih dahulu !','warning');
            return false;
        }

        var param = {};
        param['iduser'] = $('#iduser').val();
        param['ds'] = $('#dashboard').val();
        param['id_bulan'] = $('#id_bulan').val();
        param[csrf_token] = csrf_hash;
        $.LoadingOverlay("show");
        $.post(host+'dashboard-tampil/get_arus_kas', param, function(resp){
            if(resp){
                $.LoadingOverlay("hide", true);
                parsing = JSON.parse(resp);
                var xChart = parsing.arr_bln;
                var yChart_invest = [
                {
                    name: 'Realisasi Bulanan',
                    type: 'line',
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 1,
                            y2: 0
                        },
                        stops: [
                        [0, '#0bcfe6']
                        ]
                    },
                    data: parsing.arr_data_line_invest,
                }];
                
                var yChart_operasioanl = [
                {
                    name: 'Realisasi Bulanan',
                    type: 'line',
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 1,
                            y2: 0
                        },
                        stops: [
                        [0, '#0bcfe6']
                        ]
                    },
                    data: parsing.arr_data_line_operasioanl,
                }];

                var yChart_pendanaan = [
                {
                    name: 'Realisasi Bulanan',
                    type: 'line',
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 1,
                            y2: 0
                        },
                        stops: [
                        [0, '#0bcfe6']
                        ]
                    },
                    data: parsing.arr_data_line_pendanaan,
                }];


                var investasi = 'Rp '+parsing.tot_investasi+',-';
                var operasional = 'Rp '+parsing.tot_operasional+',-';
                var pendanaan = 'Rp '+parsing.tot_pendanaan+',-';
                $('#tot-investasi').html(investasi);
                $('#tot-operasional').html(operasional);
                $('#tot-pendanaan').html(pendanaan);

                
                genColumnChart("container-aruskas-investasi", "", xChart, yChart_invest, "", "", "", false);
                genColumnChart("container-aruskas-operasional", "", xChart, yChart_operasioanl, "", "", "", false);
                genColumnChart("container-aruskas-pendanaan", "", xChart, yChart_pendanaan, "", "", "", false);

               
            }
        });
    
    });

    
    var par = {};
    par['iduser'] = "";
    par['ds'] = 'BULANAN';
    par['id_bulan'] = "";
    par[csrf_token] = csrf_hash;
    $.LoadingOverlay("show");
    $.post(host+'dashboard-tampil/get_arus_kas', par, function(resp){
        if(resp){
            $.LoadingOverlay("hide", true);
            parsing = JSON.parse(resp);
            var xChart = parsing.arr_bln;
            var yChart_invest = [
            {
                name: 'Realisasi Bulanan',
                type: 'line',
                color: {
                    linearGradient: {
                        x1: 0,
                        x2: 0,
                        y1: 1,
                        y2: 0
                    },
                    stops: [
                    [0, '#0bcfe6']
                    ]
                },
                data: parsing.arr_data_line_invest,
            }];

            var yChart_operasioanl = [
            {
                name: 'Realisasi Bulanan',
                type: 'line',
                color: {
                    linearGradient: {
                        x1: 0,
                        x2: 0,
                        y1: 1,
                        y2: 0
                    },
                    stops: [
                    [0, '#0bcfe6']
                    ]
                },
                data: parsing.arr_data_line_operasioanl,
            }];

            var yChart_pendanaan = [
            {
                name: 'Realisasi Bulanan',
                type: 'line',
                color: {
                    linearGradient: {
                        x1: 0,
                        x2: 0,
                        y1: 1,
                        y2: 0
                    },
                    stops: [
                    [0, '#0bcfe6']
                    ]
                },
                data: parsing.arr_data_line_pendanaan,
            }];


            var investasi = 'Rp '+parsing.tot_investasi+',-';
            var operasional = 'Rp '+parsing.tot_operasional+',-';
            var pendanaan = 'Rp '+parsing.tot_pendanaan+',-';
            $('#tot-investasi').html(investasi);
            $('#tot-operasional').html(operasional);
            $('#tot-pendanaan').html(pendanaan);

            genColumnChart("container-aruskas-investasi", "", xChart, yChart_invest, "", "", "", false);
            genColumnChart("container-aruskas-operasional", "", xChart, yChart_operasioanl, "", "", "", false);
            genColumnChart("container-aruskas-pendanaan", "", xChart, yChart_pendanaan, "", "", "", false);


        }
    });


</script>