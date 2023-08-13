<style type="text/css">
    .colornya {
      background: linear-gradient(90deg, rgba(1,106,156,1) 0%, rgba(96,203,202,1) 0%, rgba(252,122,100,1) 100%);
      color: #ffff;
    }
</style>
<div class="row">
    <div class="col-md-4">
        <div class="small-box colornya">
            <div class="inner">
              <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Arus Kas Dari Aktivitas Investasi</span>
              <p style="font-size: 20px; font-weight:bold;">Rp 200.000.000.000.000,-</p>
            </div>
            <!-- <div class="icon">
                <i class="fa fa-money"></i>
            </div> -->
        </div>
    </div>
    <div class="col-md-4">
        <div class="small-box colornya">
            <div class="inner">
              <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Arus Kas Dari Aktivitas Operasional</span>
              <p style="font-size: 20px; font-weight:bold;">Rp 1.000.000.000.000,-</p>
            </div>
            <!-- <div class="icon">
                <i class="fa fa-money"></i>
            </div> -->
        </div>
    </div>
    <div class="col-md-4">
        <div class="small-box colornya">
            <div class="inner">
              <span><i class="fa fa-money"></i>&nbsp;&nbsp;&nbsp;Arus Kas Dari Aktivitas Pendanaan</span>
              <p style="font-size: 20px; font-weight:bold;">Rp 340.000.000.000.000,-</p>
            </div>
            <!-- <div class="icon">
                <i class="fa fa-money"></i>
            </div> -->
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <div class="nav-tabs-custom">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Tren Arus Kas Dari Aktivitas Investasi</h3>
                </div>
                <div class="box-body">
                    <div id="container-d4"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="nav-tabs-custom">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Tren Arus Kas Dari Aktivitas Operasional</h3>
                </div>
                <div class="box-body">
                     <div id="container-d5"></div>
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
                    <h3 class="box-title">Tren Arus Kas Dari Aktivitas Pendanaan</h3>
                </div>
                <div class="box-body">
                    <div id="container-d6"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="col-md-6">
        <div class="nav-tabs-custom">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Grafik Tren Nilai Beban Operasional</h3>
                </div>
                <div class="box-body">
                     <div id="container-d7"></div>
                </div>
            </div>
        </div>
    </div> -->
</div>

<script type="text/javascript">
    $.post(host+'dashboard-tampil/testing_array', {[csrf_token]:csrf_hash}, function(resp){
        if(resp){
            parsing = JSON.parse(resp);
            var chartD1 = 
            [{
                name: 'Persentase',
                colorByPoint: true,
                data: 
                [{
                    name: 'Deposito',
                    y: parsing.nil1,
                    color:'#8c3f6f'
                },{
                    name: 'Surat Utang Negara',
                    y: parsing.nil2,
                    color:'#ff7c8f'
                },{
                    name: 'Obligasi korporasi',
                    y: parsing.nil3,
                    color:'#cee60b'
                },{
                    name: 'Sukuk Korporasi',
                    y: parsing.nil4,
                    color:'#0bcfe6'
                },{
                    name: 'MTN',
                    y: parsing.nil5,
                    color:'#0be680'
                },{
                    name: 'Reksadana',
                    y: parsing.nil6,
                    color:'#e60bda'
                }]
            }];


            genPieChart("container-d1", "", "", chartD1, '', 250);
            genPieChart("container-d2", "", "", chartD1, '', 250);
        }
    });

    $.post(host+'dashboard-tampil/testing_array_bar', {[csrf_token]:csrf_hash}, function(resp){
        if(resp){
            var param = {};
            parsing = JSON.parse(resp);
            var xChart = parsing.arr_bln;

            var yChart = [
            {
                name: 'NILAI',
                color: {
                    linearGradient: {
                        x1: 0,
                        x2: 0,
                        y1: 1,
                        y2: 0
                    },
                    stops: [
                    [0, '#e93981'],
                    [1, '#3058ac']
                    ]
                },
                data: parsing.arr_data,
            }];

            var yChart2 = [
            {
                name: 'NILAI',
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
                data: parsing.arr_data,
            }];


            var yChart3 = [
            {
                name: 'NILAI',
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
                data: parsing.arr_data,
            }];


            var yChart4 = [
            {
                name: 'NILAI',
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
                data: parsing.arr_data,
            }];
            // genColumnChart2("container-d3", "", xChart, yChart, "", "", "", false);
            genColumnChart("container-d4", "", xChart, yChart2, "", "", "", false);
            genColumnChart("container-d5", "", xChart, yChart2, "", "", "", false);
            genColumnChart("container-d6", "", xChart, yChart3, "", "", "", false);
            genColumnChart("container-d7", "", xChart, yChart3, "", "", "", false);
            genColumnChart("container-d8", "", xChart, yChart4, "", "", "", false);
            genColumnChart("container-d9", "", xChart, yChart4, "", "", "", false);
        }
    });





$.post(host+'dashboard-tampil/get_executive_summary', {[csrf_token]:csrf_hash}, function(resp){
    if(resp){
        parsing = JSON.parse(resp);

        genGaugeChart(parsing.div_invest, parsing.judul_invest, parsing.nil_invest);
        genGaugeChart(parsing.div_hasil, parsing.judul_hasil, parsing.nil_hasil);
        genGaugeChart(parsing.div_yoi, parsing.judul_yoi, parsing.nil_yoi);
    }
});

// var judul_hasil = 'Hasil Investasi';
// var judul_yoi = 'Target YOI';
// var judul_invest = 'Aset Investasi';

// // The speed gauge
// var chartSpeed = Highcharts.chart('container-hasil', Highcharts.merge(gaugeOptions, judul_hasil, {   
//     yAxis: {
//         min: 0,
//         max: 200,
//         title: {
//             text: judul_hasil
//         }
//     },

//     series: [{
//         name: judul_hasil,
//         data: [63.22],
//         dataLabels: {
//             format:
//                 '<div style="text-align:center">' +
//                 '<span style="font-size:25px">{y}</span>%<br/>' +
//                 '<span style="font-size:12px;opacity:0.4">Persentase</span>' +
//                 '</div>'
//         },
//         tooltip: {
//             valueSuffix: ' %'
//         }
//     }]

// }));


// // The speed gauge
// var chartSpeed2 = Highcharts.chart('container-yoi', Highcharts.merge(gaugeOptions, judul_yoi, {
//     yAxis: {
//         min: 0,
//         max: 200,
//         title: {
//             text: judul_yoi
//         }
//     },

//     series: [{
//         name: judul_yoi,
//         data: [70.22],
//         dataLabels: {
//             format:
//                 '<div style="text-align:center">' +
//                 '<span style="font-size:25px">{y}</span>%<br/>' +
//                 '<span style="font-size:12px;opacity:0.4">Persentase</span>' +
//                 '</div>'
//         },
//         tooltip: {
//             valueSuffix: ' %'
//         }
//     }]

// }));

// // The RPM gauge
// var chartRpm = Highcharts.chart('container-invest', Highcharts.merge(gaugeOptions, judul_invest, {
//     yAxis: {
//         min: 0,
//         max: 200,
//         title: {
//             text: judul_invest
//         }
//     },

//     series: [{
//         name: judul_invest,
//         data: [101.64],
//         dataLabels: {
//             format:
//                 '<div style="text-align:center">' +
//                 '<span style="font-size:25px">{y:.2f}</span>%<br/>' +
//                 '<span style="font-size:12px;opacity:0.4">' +
//                 'Persentase' +
//                 '</span>' +
//                 '</div>'
//         },
//         tooltip: {
//             valueSuffix: ' %'
//         }
//     }]

// }));

// // Bring life to the dials
// setInterval(function () {
//     // Speed
//     var point,
//         newVal,
//         inc;

//     if (chartSpeed) {
//         point = chartSpeed.series[0].points[0];
//         inc = Math.round((Math.random() - 0.5) * 100);
//         newVal = point.y + inc;

//         if (newVal < 0 || newVal > 200) {
//             newVal = point.y - inc;
//         }

//         point.update(newVal);
//     }

//     // RPM
//     if (chartRpm) {
//         point = chartRpm.series[0].points[0];
//         inc = Math.random() - 0.5;
//         newVal = point.y + inc;

//         if (newVal < 0 || newVal > 5) {
//             newVal = point.y - inc;
//         }

//         point.update(newVal);
//     }
// }, 2000);
</script>