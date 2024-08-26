<meta charset="UTF-8">
<title>SMART</title>
<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<link rel="icon" href="<?=base_url('files/favicon.ico');?>" />

<!-- jQUery 3.3.1 -->
<script src="<?=base_url('assets/plugins/jquery/jquery-3.6.0.min.js');?>" type="text/javascript"></script>
<!-- <script src="<?=base_url('assets/plugins/tableau/tableau-2.min.js');?>" type="text/javascript"></script>
<script src="<?=base_url('assets/plugins/tableau/tableau-2.9.1.min.js');?>" type="text/javascript"></script> -->
<!-- Bootstrap 3.3.2 -->
<link href="<?=base_url('assets/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
<!-- Font Awesome Icons -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

<link href="<?=base_url('assets/plugins/fontawesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="<?=base_url('assets/plugins/ionicons/css/ionicons.min.css');?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/plugins/easyui/themes/metro-gray/easyui.css');?>" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="<?=base_url('assets/dist/css/AdminLTE.css');?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/dist/css/select2.css');?>" rel="stylesheet" type="text/css" />
<link href="<?=base_url('assets/dist/css/skins/skin-blue.css');?>" rel="stylesheet" type="text/css" />
<!-- Data Table -->
<link href="<?=base_url('assets/plugins/datatables/dataTables.bootstrap.css');?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?=base_url('assets/plugins/datepicker/datepicker3.css');?>" type="text/css"/>
<!-- Daterange picker -->
<link rel="stylesheet" href="<?=base_url('assets/plugins/daterangepicker/daterangepicker-bs3.css');?>" type="text/css"/>
<link rel="stylesheet" href="<?=base_url('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css');?>" type="text/css"/>
<style type="text/css">
  .treeview-menu {
    display: block;
}
</style>
<style>
	#notif{
		display:none;
		position:fixed;
		right:0px;
		z-index:9999;
		top:70px;
		margin-bottom:22px;
		margin-right:22px;
		min-width:300px;
		max-width:800px;
	}
</style>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script> -->
<!-- <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/solid-gauge.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script> -->
<!-- <script src="https://code.highcharts.com/modules/accessibility.js"></script> -->
<!-- <script src='<?=base_url('assets/plugins/highcharts_lama/series-label.js');?>'></script> -->
 <!-- <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script> -->

<script src='<?=base_url('assets/plugins/highcharts/highcharts.js');?>'></script>
<script src='<?=base_url('assets/plugins/highcharts/highcharts-more.js');?>'></script>
<script src='<?=base_url('assets/plugins/highcharts/exporting.js');?>'></script>
<script src='<?=base_url('assets/plugins/highcharts/export-data.js');?>'></script>
<script src='<?=base_url('assets/plugins/highcharts/series-label.js');?>'></script>
<script src='<?=base_url('assets/plugins/highcharts/solid-gauge.js');?>'></script>
<!-- <script src='<?=base_url('assets/plugins/currency/currency.js');?>'></script> -->
<!-- Bootstrap 3.3.2 JS -->
<script src="<?=base_url('assets/bootstrap/js/bootstrap.min.js');?>" type="text/javascript"></script>
<!-- FastClick -->
<script src='<?=base_url('assets/plugins/fastclick/fastclick.min.js');?>'></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets/dist/js/app.min.js');?>" type="text/javascript"></script>
<!-- <script src="<?=base_url('assets/dist/js/adminlte.min.js');?>" type="text/javascript"></script> -->
<!-- <script src="<?=base_url('assets/dist/js/app.js');?>" type="text/javascript"></script> -->
<script src="<?=base_url('assets/plugins/slimScroll/jquery.slimscroll.js');?>" type="text/javascript"></script>
<script src="<?=base_url('assets/dist/js/fungsi.js');?>" type="text/javascript"></script>
<script src="<?=base_url('assets/dist/js/loading-overlay.js');?>" type="text/javascript"></script>
<script src="<?=base_url('assets/dist/js/AutoNumeric.js');?>" type="text/javascript"></script>

<script src="<?=base_url('assets/plugins/daterangepicker/daterangepicker.js');?>" type="text/javascript"></script>
<script src="<?=base_url('assets/plugins/rowspanizer/jquery.rowspanizer.js');?>" type="text/javascript"></script>
<!-- datepicker -->
<script src="<?=base_url('assets/plugins/datepicker/bootstrap-datepicker.js');?>" type="text/javascript"></script>
<script src="<?=base_url('assets/plugins/ckeditor/ckeditor.js');?>" type="text/javascript"></script>
<script src="<?=base_url('assets/plugins/jquery-validation/dist/jquery.validate.js');?>" type="text/javascript"></script>
<script src="<?=base_url('assets/plugins/easyui/jquery.easyui.min.js');?>" type="text/javascript"></script>
<script src="<?=base_url('assets/plugins/maskmoney/jquery.maskMoney.js');?>" type="text/javascript"></script>
<!-- datepicker -->
<script src="<?=base_url('assets/jquery.maskedinput.js');?>" type="text/javascript"></script>
<script src="<?=base_url('assets/jquery.number.min.js');?>" type="text/javascript"></script>
<script src="<?=base_url('assets/select2.js');?>" type="text/javascript"></script>

<script src="<?=base_url('assets/dist/js/table2excel.js');?>" type="text/javascript"></script>
<script src="<?=base_url('assets/plugins/datatable/datatables.js');?>" type="text/javascript"></script>
<!-- <script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.js');?>" type="text/javascript"></script> -->
<!-- <script src="<?=  base_url('assets/plugins/datatables/jquery.dataTables.min.js');?>" type="text/javascript"></script> -->

<script type="text/javascript">
	$(document).ready(function(){setTimeout(function(){$("#notif").fadeIn('slow');},400);});
	setTimeout(function(){$("#notif").fadeOut('slow');},3000);

	var host='<?php echo base_url(); ?>';
	var uri='<?php echo get_uri(); ?>';
	var iduser='<?=$this->session->userdata('iduser'); ?>';
	var id_bulan='<?=$this->session->userdata('id_bulan'); ?>';
	var tahun='<?=$this->session->userdata('tahun'); ?>';
	var csrf_token='<?=$this->security->get_csrf_token_name();?>';
	var csrf_hash='<?=$this->security->get_csrf_hash();?>';

</script>

<script type="text/javascript">
	$(document).ready(function(){
		$("#myTab").click(function(e){
			e.preventDefault();
			$(this).tab('show');
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.tanggal').datepicker({
			format:"yy-mm-dd",
			autoclose:true
		});
	});
</script>
<!-- Data Table -->
<script type="text/javascript">
	// $(document).ready(function(){
	// 	$('#example').DataTable({
	// 		"pagging":false,
	// 		"searching": false,
	// 		"ordering": false,
	// 		"lengthChange": false,
	// 	});
	// });
</script>
<!-- reload modal -->
<script type="text/javascript">
	$(document).on('hidden.bs.modal', function (e) {
		if ($(e.target).attr('data-refresh') == 'true') {
			// Remove modal data
			$(e.target).removeData('bs.modal');
		}
	});
</script>
<script>
	function confirm_delete(delete_url){
		$("#modal_delete").modal('show', {backdrop: 'static'});
			document.getElementById('delete_link').setAttribute('href', delete_url);
	}
</script>
<script type="text/javascript">
	$(document).ready(function(){
		// $('.format_number').number(true,0);
		$(".select2nya").select2( { 'width':'100%' } );

	});
	
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-LLH4MCY461"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-LLH4MCY461');
</script>
