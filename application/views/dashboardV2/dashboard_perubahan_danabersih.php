<style type="text/css">
    .colornya {
      background: linear-gradient(90deg, rgba(1,106,156,1) 0%, rgba(137,96,203,1) 0%, rgba(11,230,128,1) 100%);
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
                          <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Hasil Investasi </span>
                          <p style="font-size: 20px; font-weight:bold;" id="tot-hasil-investasi"></p>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div id="container-hasil-investasi"></div>
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
                          <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Premi Iuran</span>
                          <p style="font-size: 20px; font-weight:bold;" id="tot-iuran"></p>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                     <div id="container-iuran"></div>
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
                          <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Fee Pengelolaan AIP</span>
                          <p style="font-size: 20px; font-weight:bold;" id="tot-pengelolaan"></p>
                      </div>
                    </div>
                </div>
                <div class="box-body">
                    <div id="container-pengelolaan"></div>
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
                           <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Beban Operasional</span>
                          <p style="font-size: 20px; font-weight:bold;" id="tot-beban"></p>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                     <div id="container-beban-operasional"></div>
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
                    <div class="small-box colornya" style="height:30%;">
                        <div class="inner">
                           <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Nilai Tunai Iuran Pensiun (NTIP)</span>
                          <p style="font-size: 20px; font-weight:bold;" id="tot-nilai-tunai"></p>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div id="container-ntip"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="nav-tabs-custom">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="small-box colornya" style="height:30%;">
                        <div class="inner">
                         <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Kenaikan/Penurunan Nilai Pasar Aset Investasi</span>
                         <p style="font-size: 20px; font-weight:bold;" id="tot-nilai-pasar"></p>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                     <div id="container-nilai-pasar"></div>
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
    
    var par = {};
    par['iduser'] = "";
    par['ds'] = 'BULANAN';
    par['id_bulan'] = "";
    par[csrf_token] = csrf_hash;
    $.LoadingOverlay("show");
    $.post(host+'dashboard-tampil/get_perubahan_dana_bersih', par, function(resp){
        if(resp){
            $.LoadingOverlay("hide", true);
            parsing = JSON.parse(resp);
            var xChart = parsing.arr_bln;

            var yChart1 = [
            {
                name: 'Akumulasi Realisasi',
                type: 'column',
                color: {
                    linearGradient: {
                        x1: 0,
                        x2: 0,
                        y1: 1,
                        y2: 0
                    },
                    stops: [
                    [0, '#cee60b'],
                    [1, '#ff7c8f']
                    ]
                },
                data: parsing.arr_data_bar_hasil_invest,
            },
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
                data: parsing.arr_data_line_hasil_invest,
            }];




            var yChart2 = [
            {
                name: 'Akumulasi Realisasi',
                type: 'column',
                color: {
                    linearGradient: {
                        x1: 0,
                        x2: 0,
                        y1: 1,
                        y2: 0
                    },
                    stops: [
                    [0, '#cee60b'],
                    [1, '#0bcfe6']
                    ]
                },
                data: parsing.arr_data_bar_iuran,
            },
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
                    [0, '#ff7c8f']
                    ]
                },
                data: parsing.arr_data_line_iuran,
            }];


            var yChart3 = [
            {
                name: 'Akumulasi Realisasi',
                type: 'column',
                color: {
                    linearGradient: {
                        x1: 0,
                        x2: 0,
                        y1: 1,
                        y2: 0
                    },
                    stops: [
                    [0, '#0bcfe6'],
                    [1, '#ff7c8f']
                    ]
                },
                data: parsing.arr_data_bar_pengelolaan,
            },
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
                    [0, '#cee60b']
                    ]
                },
                data: parsing.arr_data_line_pengelolaan,
            }];

            var yChart4 = [
            {
                name: 'Akumulasi Realisasi',
                type: 'column',
                color: {
                    linearGradient: {
                        x1: 0,
                        x2: 0,
                        y1: 1,
                        y2: 0
                    },
                    stops: [
                    [0, '#0bcfe6'],
                    [1, '#ff7c8f']
                    ]
                },
                data: parsing.arr_data_bar_beban,
            },
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
                    [0, '#cee60b']
                    ]
                },
                data: parsing.arr_data_line_beban,
            }];

            var yChart5 = [
            {
                name: 'Akumulasi Realisasi',
                type: 'column',
                color: {
                    linearGradient: {
                        x1: 0,
                        x2: 0,
                        y1: 1,
                        y2: 0
                    },
                    stops: [
                    [0, '#0bcfe6'],
                    [1, '#ff7c8f']
                    ]
                },
                data: parsing.arr_data_bar_nilai_tunai,
            },
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
                    [0, '#cee60b']
                    ]
                },
                data: parsing.arr_data_line_nilai_tunai,
            }];

            var yChart6 = [
            {
                name: 'Akumulasi Realisasi',
                type: 'column',
                color: {
                    linearGradient: {
                        x1: 0,
                        x2: 0,
                        y1: 1,
                        y2: 0
                    },
                    stops: [
                    [0, '#0bcfe6'],
                    [1, '#ff7c8f']
                    ]
                },
                data: parsing.arr_data_bar_nilai_pasar,
            },
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
                    [0, '#cee60b']
                    ]
                },
                data: parsing.arr_data_line_nilai_pasar,
            }];


            var hasil_investasi = 'Rp '+parsing.tot_hasil_investasi+',-';
            var iuran = 'Rp '+parsing.tot_iuran+',-';
            var pengelolaan = 'Rp '+parsing.tot_pengelolaan+',-';
            var beban = 'Rp '+parsing.tot_beban+',-';
            var nilai_tunai = 'Rp '+parsing.tot_nilai_tunai+',-';
            var nilai_pasar = 'Rp '+parsing.tot_nilai_pasar+',-';
            $('#tot-hasil-investasi').html(hasil_investasi);
            $('#tot-iuran').html(iuran);
            $('#tot-pengelolaan').html(pengelolaan);
            $('#tot-beban').html(beban);
            $('#tot-nilai-tunai').html(nilai_tunai);
            $('#tot-nilai-pasar').html(nilai_pasar);

            genColumnChart("container-hasil-investasi", "", xChart, yChart1, "", "", "", false);
            genColumnChart("container-iuran", "", xChart, yChart2, "", "", "", false);
            genColumnChart("container-pengelolaan", "", xChart, yChart3, "", "", "", false);
            genColumnChart("container-beban-operasional", "", xChart, yChart4, "", "", "", false);
            genColumnChart("container-ntip", "", xChart, yChart5, "", "", "", false);
            genColumnChart("container-nilai-pasar", "", xChart, yChart6, "", "", "", false);
        }
    });


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

        $.post(host+'dashboard-tampil/get_perubahan_dana_bersih', param, function(resp){
            if(resp){
                $.LoadingOverlay("hide", true);
                parsing = JSON.parse(resp);
                var xChart = parsing.arr_bln;

                var yChart1 = [
                {
                    name: 'Akumulasi Realisasi',
                    type: 'column',
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 1,
                            y2: 0
                        },
                        stops: [
                        [0, '#cee60b'],
                        [1, '#ff7c8f']
                        ]
                    },
                    data: parsing.arr_data_bar_hasil_invest,
                },
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
                    data: parsing.arr_data_line_hasil_invest,
                }];


                var yChart2 = [
                {
                    name: 'Akumulasi Realisasi',
                    type: 'column',
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 1,
                            y2: 0
                        },
                        stops: [
                        [0, '#cee60b'],
                        [1, '#0bcfe6']
                        ]
                    },
                    data: parsing.arr_data_bar_iuran,
                },
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
                        [0, '#ff7c8f']
                        ]
                    },
                    data: parsing.arr_data_line_iuran,
                }];


                var yChart3 = [
                {
                    name: 'Akumulasi Realisasi',
                    type: 'column',
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 1,
                            y2: 0
                        },
                        stops: [
                        [0, '#0bcfe6'],
                        [1, '#ff7c8f']
                        ]
                    },
                    data: parsing.arr_data_bar_pengelolaan,
                },
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
                        [0, '#cee60b']
                        ]
                    },
                    data: parsing.arr_data_line_pengelolaan,
                }];

                var yChart4 = [
                {
                    name: 'Akumulasi Realisasi',
                    type: 'column',
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 1,
                            y2: 0
                        },
                        stops: [
                        [0, '#0bcfe6'],
                        [1, '#ff7c8f']
                        ]
                    },
                    data: parsing.arr_data_bar_beban,
                },
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
                        [0, '#cee60b']
                        ]
                    },
                    data: parsing.arr_data_line_beban,
                }];

                var yChart5 = [
                {
                    name: 'Akumulasi Realisasi',
                    type: 'column',
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 1,
                            y2: 0
                        },
                        stops: [
                        [0, '#0bcfe6'],
                        [1, '#ff7c8f']
                        ]
                    },
                    data: parsing.arr_data_bar_nilai_tunai,
                },
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
                        [0, '#cee60b']
                        ]
                    },
                    data: parsing.arr_data_line_nilai_tunai,
                }];

                var yChart6 = [
                {
                    name: 'Akumulasi Realisasi',
                    type: 'column',
                    color: {
                        linearGradient: {
                            x1: 0,
                            x2: 0,
                            y1: 1,
                            y2: 0
                        },
                        stops: [
                        [0, '#0bcfe6'],
                        [1, '#ff7c8f']
                        ]
                    },
                    data: parsing.arr_data_bar_nilai_pasar,
                },
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
                        [0, '#cee60b']
                        ]
                    },
                    data: parsing.arr_data_line_nilai_pasar,
                }];

                var hasil_investasi = 'Rp '+parsing.tot_hasil_investasi+',-';
                var iuran = 'Rp '+parsing.tot_iuran+',-';
                var pengelolaan = 'Rp '+parsing.tot_pengelolaan+',-';
                var beban = 'Rp '+parsing.tot_beban+',-';
                var nilai_tunai = 'Rp '+parsing.tot_nilai_tunai+',-';
                var nilai_pasar = 'Rp '+parsing.tot_nilai_pasar+',-';

                $('#tot-hasil-investasi').html(hasil_investasi);
                $('#tot-iuran').html(iuran);
                $('#tot-pengelolaan').html(pengelolaan);
                $('#tot-beban').html(beban);
                $('#tot-nilai-tunai').html(nilai_tunai);
                $('#tot-nilai-pasar').html(nilai_pasar);

                genColumnChart("container-hasil-investasi", "", xChart, yChart1, "", "", "", false);
                genColumnChart("container-iuran", "", xChart, yChart2, "", "", "", false);
                genColumnChart("container-pengelolaan", "", xChart, yChart3, "", "", "", false);
                genColumnChart("container-beban-operasional", "", xChart, yChart4, "", "", "", false);
                genColumnChart("container-ntip", "", xChart, yChart5, "", "", "", false);
                genColumnChart("container-nilai-pasar", "", xChart, yChart6, "", "", "", false);
            }
        });

    });
</script>