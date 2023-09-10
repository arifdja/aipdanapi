<style type="text/css">
	td.dataTables_empty{
		text-align: center;
	}
	/*.odd*/
</style>
<form id="form_<?=$acak;?>" method="post" url="<?php echo site_url(); ?>investasi-simpan/aset_investasi" enctype="multipart/form-data" >
	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
	<input type="hidden" name="id" value="<?php echo !empty($data) ? $data['id'] : '';?>">
	<input type="hidden" name="jns_form" id="jns_form" value="<?php echo !empty($data) ? $data['jns_form'] : '';?>">
	<input type="hidden" name="iduser" id="iduser" value="<?php echo !empty($data) ? $data['iduser'] : '';?>">
	<input type="hidden" name="editstatus" value="<?php echo !empty($editstatus) ? $editstatus : 'add';?>">
	<input type="hidden" id="bulan" name="id_bulan" value="<?=!empty($id_bulan) ? $id_bulan['id_bulan'] : $this->session->userdata('id_bulan');?>">

	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Detail Hasil Investasi</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Hasil Investasi<font color="red">&nbsp;*</font></label>
										<select class="form-control combo-invest" id="id_investasi" name="id_investasi" required="required">
											<option value="">
												-- Pilih Hasil Investasi --
											</option>
											<?php if(isset($data_jenis) && is_array($data_jenis)){?>
												<?php foreach($data_jenis as $jenis){?>
													<option value="<?php echo $jenis->id_investasi;?>" <?php if(!empty($data) && $jenis->id_investasi == $data['id_investasi']) echo 'selected="selected"';?>>
														<?php echo $jenis->jenis_investasi;?>
													</option>
												<?php }?>
											<?php }?>
										</select>
										<label class="validation_error_message" for="id_investasi"></label>
									</div>
								</div>
								<?php if($editstatus == "edit" && $data['filedata'] != ""){?>
								<div class="col-md-2">
									<div class="form-group">
										<label for="keterangan" class="lebel"></label>
										<a href="<?php echo site_url('bulanan/aset_investasi/get_file_jenis/'.(isset($data['id']) ? $data['id'] : '').get_uri());?>" class="btn btn-sm btn-primary btn-flat" style="margin-top:25px;" title="Lihat Dokumen"><i class="fa fa-file-o"></i></a>
									</div>
								</div>
								<?php } ?>
							</div>
							<!-- FORM - 1 -->
							<div class="row form-1" id="form-1">
								<div class='col-md-12'>
									<br/>
									<fieldset class='form-group'>
										<legend style='font-size:16px;border-width: 2px;border-color: #2f87b7;'>Detail (Form - 1)</legend>
										<div class="table-responsive">
											<table class="table table-bordered table-striped table-hover tbl-form" id="tbl-form" width="100%">
												<thead>
													<tr style='background-color:#3C8DBC;'>
														<th width="5%">No Urut</th>
														<th>Nama Pihak</th>
														<th>Seri</th>
														<th>Saldo Awal</th>
														<th>Mutasi</th>
														<th>Saldo Akhir</th>

													</tr>
												</thead>
												<tbody class="form_investasi_1 form_investasi_bln_lalu_1">
													<?php $no=1; ?>
													<?php if($editstatus == "edit" && $data['jns_form'] == "1") :?>
														<?php if(isset($data_detail) && is_array($data_detail)):?>
															<?php $idx=1;?>
															<?php foreach($data_detail as  $detail):?>
																<tr class="form_1" id="tr_inv_<?=$idx;?>" idx="<?=$idx;?>">
																	<td style="text-align: center"><?= $no++;?></td>
																	<td style="text-align: left"><?= $detail['nama_pihak'];?></td>
																	<td style="text-align: left"><?= $detail['uraian_hasil_investasi'];?></td>
																	<td><?= rupiah($detail['saldo_awal']);?></td>
																	<td><?= rupiah($detail['mutasi_hasil_investasi']);?></td>
																	<td><?= rupiah($detail['saldo_akhir']);?></td>
																</tr>
															<?php $idx++;?>
															<?php endforeach;?>
														<?php endif;?>
													<?php endif;?>
												</tbody>
											</table>
										</div>
									</fieldset>
								</div>
							</div>

							<!-- FORM - 2 -->
							<div class="row form-2" id="form-2">
								<div class='col-md-12'>
									<br/>
									<fieldset class='form-group'>
										<legend style='font-size:16px;border-width: 2px;border-color: #2f87b7;'>Detail (Form - 2)</legend>
										<div class="table-responsive">
											<table class="table table-bordered table-striped table-hover tbl-form" id="tbl-form" width="100%">
												<thead>
													<tr style='background-color:#3C8DBC;'>
														<th width="5%">No Urut</th>
														<th>Nama Pihak</th>
														<th>Saldo Awal</th>
														<th>Mutasi</th>
														<th>Saldo Akhir</th>

													</tr>
												</thead>
												<tbody class="form_investasi_2 form_investasi_bln_lalu_2">
													<?php $no=1; ?>
													<?php if($editstatus == "edit" && $data['jns_form'] == "2") :?>
														<?php if(isset($data_detail) && is_array($data_detail)):?>
															<?php $idx=1;?>
															<?php foreach($data_detail as  $detail):?>
																<tr class="form_2" id="tr_inv_<?=$idx;?>" idx="<?=$idx;?>">
																	<td style="text-align: center"><?= $no++;?></td>
																	<td style="text-align: left"><?= $detail['nama_pihak'];?></td>
																	<td><?= rupiah($detail['saldo_awal']);?></td>
																	<td><?= rupiah($detail['mutasi_hasil_investasi']);?></td>
																	<td><?= rupiah($detail['saldo_akhir']);?></td>
																</tr>
															<?php $idx++;?>
															<?php endforeach;?>
														<?php endif;?>
													<?php endif;?>
												</tbody>
											</table>
										</div>
									</fieldset>
								</div>
							</div>

							<!-- FORM - 3 -->
							<div class="row form-3" id="form-3">
								<div class='col-md-12'>
									<br/>
									<fieldset class='form-group'>
										<legend style='font-size:16px;border-width: 2px;border-color: #2f87b7;'>Detail (Form - 3)</legend>
										<div class="table-responsive">
											<table class="table table-bordered table-striped table-hover tbl-form" id="tbl-form" width="100%">
												<thead>
													<tr style='background-color:#3C8DBC;'>
														<th width="5%">No Urut</th>
														<th>Nama Pihak</th>
														<th>Uraian</th>
														<th>Saldo Awal</th>
														<th>Mutasi</th>
														<th>Saldo Akhir</th>
														
													</tr>
												</thead>
												<tbody class="form_investasi_3 form_investasi_bln_lalu_3">
													<?php $no=1; ?>
													<?php if($editstatus == "edit" && $data['jns_form'] == "3") :?>
														<?php if(isset($data_detail) && is_array($data_detail)):?>
															<?php $idx=1;?>
															<?php foreach($data_detail as  $detail):?>
																<tr class="form_3" id="tr_inv_<?=$idx;?>" idx="<?=$idx;?>">
																	<td style="text-align: center"><?= $no++;?></td>
																	<td style="text-align: left"><?= $detail['nama_pihak'];?></td>
																	<td style="text-align: left"><?= $detail['uraian_hasil_investasi'];?></td>
																	<td><?= rupiah($detail['saldo_awal']);?></td>
																	<td><?= rupiah($detail['mutasi_hasil_investasi']);?></td>
																	<td><?= rupiah($detail['saldo_akhir']);?></td>
																</tr>
															<?php $idx++;?>
															<?php endforeach;?>
														<?php endif;?>
													<?php endif;?>
												</tbody>
											</table>
										</div>		
									</fieldset>
								</div>
							</div>

							<!-- FORM - 4 -->
							<div class="row form-4" id="form-4">
								<div class='col-md-12'>
									<br/>
									<fieldset class='form-group'>
										<legend style='font-size:16px;border-width: 2px;border-color: #2f87b7;'>Detail (Form - 4)</legend>
										<div class="table-responsive">
											<table id="example" class="table table-bordered table-striped table-hover tbl-form" id="tbl-form" width="100%">
												<thead>
													<tr style='background-color:#3C8DBC;'>
														<th width="5%">No Urut</th>
														<th>Nama Pihak</th>
														<th>No Bilyet</th>
														<th>Saldo Awal</th>
														<th>Mutasi</th>
														<th>Saldo Akhir</th>
														
													</tr>
												</thead>
												<tbody class="form_investasi_4 form_investasi_bln_lalu_4">
													<?php $no=1; ?>
													<?php if($editstatus == "edit" && $data['jns_form'] == "4") :?>
														<?php if(isset($data_detail) && is_array($data_detail)):?>
															<?php $idx=1;?>
															<?php foreach($data_detail as  $detail):?>
																<tr class="form_4" id="tr_inv_<?=$idx;?>" idx="<?=$idx;?>">
																	<td style="text-align: center"><?= $no++;?></td>
																	<td style="text-align: left"><?= $detail['nama_pihak'];?></td>
																	<td style="text-align: left"><?= $detail['uraian_hasil_investasi'];?></td>
																	<td><?= rupiah($detail['saldo_awal']);?></td>
																	<td><?= rupiah($detail['mutasi_hasil_investasi']);?></td>
																	<td><?= rupiah($detail['saldo_akhir']);?></td>
																	
																</tr>
															<?php $idx++;?>
															<?php endforeach;?>
														<?php endif;?>
													<?php endif;?>
												</tbody>
											</table>
										</div>
												
									</fieldset>
								</div>
							</div>

							<!-- FORM - 5 -->
							<div class="row form-5" id="form-5">
								<div class='col-md-12'>
									<br/>
									<fieldset class='form-group'>
										<legend style='font-size:16px;border-width: 2px;border-color: #2f87b7;'>Detail (Form - 5)</legend>
										<div class="table-responsive">
											<table class="table table-bordered table-striped table-hover tbl-form" id="tbl-form" width="100%">
												<thead>
													<tr style='background-color:#3C8DBC;'>
														<th width="5%">No Urut</th>
														<th>Nama Pihak</th>
														<th>Uraian/Ket</th>
														<th>Saldo Awal</th>
														<th>Mutasi</th>
														<th>Saldo Akhir</th>
													</tr>
												</thead>
												<tbody class="form_investasi_5 form_investasi_bln_lalu_5">
													<?php $no=1; ?>
													<?php if($editstatus == "edit" && $data['jns_form'] == "5") :?>
														<?php if(isset($data_detail) && is_array($data_detail)):?>
															<?php $idx=1;?>
															<?php foreach($data_detail as  $detail):?>
																<tr class="form_5" id="tr_inv_<?=$idx;?>" idx="<?=$idx;?>">
																	<td style="text-align: center"><?= $no++;?></td>
																	<td style="text-align: left"><?= $detail['nama_pihak'];?></td>
																	<td style="text-align: left"><?= $detail['uraian_hasil_investasi'];?></td>
																	<td><?= rupiah($detail['saldo_awal']);?></td>
																	<td><?= rupiah($detail['mutasi_hasil_investasi']);?></td>
																	<td><?= rupiah($detail['saldo_akhir']);?></td>
																</tr>
															<?php $idx++;?>
															<?php endforeach;?>
														<?php endif;?>
													<?php endif;?>
												</tbody>
											</table>
										</div>		
									</fieldset>
								</div>
							</div>

							

			
							<hr />
							<div class="row">
								<div class="col-md-12">
									<a href="<?php echo site_url('bulanan/hasil_investasi').get_uri();?>" class="btn btn-danger btn-flat"></i>&nbsp;&nbsp;Kembali</a>
								</div>
							</div>
						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</form>

<script type="text/javascript">
	var idx_row = 1;
	var sts ='<?= !empty($editstatus) ? $editstatus: ''?>';
	var data_pihak ='<?= !empty($data) ? $data['id_investasi'] : ''?>';
	var iduser= $('#iduser').val();
	

	$(document).ready(function(){
		$('.format_number').number(true, 0, ',', '.');
		$('.rupiah').number(true,0);
		// $('.format_number').number(true, 0);
		$(".select2nya, .combo-invest").select2( { 'width':'100%' } );

		
		
		new AutoNumeric.multiple('.negative', {
			allowDecimalPadding: false,
			decimalCharacter: ",",
			digitGroupSeparator: ".",
			decimalPlaces: 0,
			negativeSignCharacter: "-"
		});

		

		// $('.format_number').keyup(function(){
		// 	let v = $(this).val();
		// 	const neg = v.startsWith('-');

		// 	v = v.replace(/[-\D]/g,'');

		// 	v = v != ''?''+v:'';
		// 	if(neg) v = '-'.concat(v);

		// 	$(this).val(v);
		// });


		// currency minus

		// $('.format_number').on('keyup',function(){
		// 	var customCurrency = value => currency(value, { pattern: '!#', negativePattern: '(!#)', separator: ".", precision: 0});
		// 	// customCurrency(1234567.89).format();  // => "$ 1,234,567.89"
		// 	let v = customCurrency($(this).val()).format(); // => "($ 1,234,567.89)"
		// 	$('#rka').val(v);
		// });


		$('.tbl-form').DataTable({
			"paging":false,
			"searching": false,
			"ordering": false,
			"lengthChange": false,
			"info": false,
		});

		$('.form-2,.form-3,.form-4,.form-5,.form-6,.form-7,.form-8,.form-9').css('display','none');
		// get data bulan lalu
		$('.bulan_lalu_form').on('click', function(){
			var form = $('#jns_form').val();
			if($('#id_investasi').val() == ""){
				$.messager.alert('SMART AIP','Pilih Jenis Investasi Terlebih Dahulu!','warning'); 
				return false;
			}
			if($('#rka').val() == ""){
				$.messager.alert('SMART AIP','Input RKA Terlebih Dahulu!','warning'); 
				return false;
			}
			if($('#bulan').val() == 1){
				$.messager.alert('SMART AIP','Tidak bisa generate data bulan Januari !','warning'); 
				return false;
			}

			$.LoadingOverlay("show");
			$.post(host+'investasi-display/data_bulan_lalu_form'+uri, { 'jns_form':form, 'jns_investasi':$('#id_investasi').val(), [csrf_token]:csrf_hash }, function(resp){

				parsing_bln_lalu = JSON.parse(resp)
				if(parsing_bln_lalu.length == '0'){
					$.messager.alert('SMART AIP','Data bulan lalu tidak ditemukan !','warning'); 
					$.LoadingOverlay("hide", true);
					return false;

				}

				$.LoadingOverlay("hide", true);
			});

		});


	});

	// edit
	if(sts == "edit"){
		$( document ).ready(function() {
			$('#id_investasi').val(data_pihak).trigger('change');
			$(".combo-invest").select2({'disabled': true,});

		});
	}


	

	// get combo nama pihak
	$('#id_investasi').on('change', function(){
		$('.tr_inv').remove();
		$.post(host+'investasi-display/cek_aset_investasi'+uri, { 'jns_investasi':$('#id_investasi').val(), [csrf_token]:csrf_hash }, function(resp){
			if(resp){
				parsing = JSON.parse(resp);
				if(parsing.total == '0'){
					$.post(host+'investasi-display/data_pihak'+uri, { 'jns_investasi':$('#id_investasi').val(), [csrf_token]:csrf_hash }, function(resp1){
						if(resp1){
							data_pihak = resp1;
							// console.log(data_pihak);
						}
					});
				}else{
					if(sts == "edit"){
						$.post(host+'investasi-display/data_pihak'+uri, { 'jns_investasi':$('#id_investasi').val(), [csrf_token]:csrf_hash }, function(resp1){
							if(resp1){
								data_pihak = resp1;
								// console.log(data_pihak);
							}
						});
					}else{
						$.messager.alert('SMART AIP','Anda sudah input data '+parsing.jenis_investasi+' !','warning');
						return false;
					}
				}
			}
		});

		$.post(host+'investasi-display/form_invest'+uri, { 'jns_investasi':$('#id_investasi').val(), 'iduser':iduser, [csrf_token]:csrf_hash }, function(resp){
			if(resp){
				parsing_form = JSON.parse(resp);
				$('#jns_form').val(parsing_form.jns_form);
				if(parsing_form.jns_form == 1) {
					$('.form-1').css('display','block');
					$('.form-2,.form-3,.form-4,.form-5,.form-6,.form-7,.form-8,.form-9').css('display','none');
				}else if(parsing_form.jns_form == 2){
					$('.form-2').css('display','block');
					$('.form-1,.form-3,.form-4,.form-5,.form-6,.form-7,.form-8,.form-9').css('display','none');
				}else if(parsing_form.jns_form == 3){
					$('.form-3').css('display','block');
					$('.form-1,.form-2,.form-4,.form-5,.form-6,.form-7,.form-8,.form-9').css('display','none');
				}else if(parsing_form.jns_form == 4){
					$('.form-4').css('display','block');
					$('.form-1,.form-2,.form-3,.form-5,.form-6,.form-7,.form-8,.form-9').css('display','none');
				}else if(parsing_form.jns_form == 5){
					$('.form-5').css('display','block');
					$('.form-1,.form-2,.form-4,.form-3,.form-6,.form-7,.form-8,.form-9').css('display','none');
				}else if(parsing_form.jns_form == 6){
					$('.form-6').css('display','block');
					$('.form-1,.form-2,.form-4,.form-3,.form-5,.form-7,.form-8,.form-9').css('display','none');
				}else if(parsing_form.jns_form == 7){
					$('.form-7').css('display','block');
					$('.form-1,.form-2,.form-4,.form-3,.form-5,.form-6,.form-8,.form-9').css('display','none');
				}else if(parsing_form.jns_form == 8){
					$('.form-8').css('display','block');
					$('.form-1,.form-2,.form-4,.form-3,.form-5,.form-6,.form-7,.form-9').css('display','none');
				}else if(parsing_form.jns_form == 9){
					$('.form-9').css('display','block');
					$('.form-1,.form-2,.form-4,.form-3,.form-5,.form-6,.form-7,.form-8').css('display','none');
				}else{
					$.messager.alert('SMART AIP','Form Input '+parsing_form.jenis_investasi+' belum tersedia !','warning');
					return false;
				}
			}
		});
	});



	// form action
	var rulesnya = {
		id_investasi : "required",
		rka : "required",
		
	};

	var messagesnya = {
		id_investasi : "<i style='color:red'>Harus Diisi</i>",
		rka : "<i style='color:red'>Harus Diisi</i>",
		
	}

	$( "#form_<?=$acak;?>" ).validate( {
		rules: rulesnya,
		messages: messagesnya,
		submitHandler: function(form) {
			$.LoadingOverlay("show");
			submit_form('form_<?=$acak;?>',function(r){
				if(r==1){ 
					$.messager.alert('SMART AIP','Data Tersimpan','info'); 
					$('#cancel').trigger('click');
					setTimeout(function(){
						window.location = host+'bulanan/aset_investasi'+uri;
					}, 2000);
				}else{ 
					$.messager.alert('SMART AIP','Proses Simpan Data Gagal '+r,'warning'); 
				}
				$.LoadingOverlay("hide", true);
			});
		
		},
		errorPlacement: function(error, element) {
	        var name = element.attr('name');
	        var errorSelector = '.validation_error_message[for="' + name + '"]';
	        var $element = $(errorSelector);
	        if ($element.length) { 
	            $(errorSelector).html(error.html());
	        } else {
	            error.insertAfter(element);
	        }
	    }
	} );


</script>