<style type="text/css">
	td.dataTables_empty{
		text-align: center;
	}
	/*.odd*/
</style>
<form id="form_<?=$acak;?>" method="post" url="<?php echo site_url(); ?>pengajuan-master-simpan/tmp_mst_pihak" enctype="multipart/form-data" >
	<input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
	<input type="hidden" name="editstatus" value="<?php echo !empty($editstatus) ? $editstatus : 'add';?>">
	<input type="hidden" name="id" value="<?php echo !empty($data) ? $data['id'] : '';?>">
	<input type="hidden" name="iduser" value="<?= $this->session->userdata('iduser');?>">
	<input type="hidden" name="status" value="<?php echo !empty($data) ? $data['status'] : '0';?>">
	<input type="hidden" name="insert_at" value="<?php echo date('Y-m-d H:i:s');?>">

	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Form Pengajuan Nama Pihak</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-3">
									<div class="form-group">
										<label>Kode Pihak<font color="red">&nbsp;*</font></label>
										<input type="text" placeholder="Kode Pihak" class="form-control" id="kode_pihak" name="kode_pihak" value="<?php echo !empty($data) ? $data['kode_pihak'] : '';?>" required="required" <?php if ($editstatus == 'edit'){ echo 'readonly';}?>>
									</div>
								</div>
								<div class="col-md-7">
									<div class="form-group">
										<label>Nama Pihak<font color="red">&nbsp;*</font></label>
										<input type="text" placeholder="Nama Pihak" class="form-control" id="nama_pihak" name="nama_pihak" value="<?php echo !empty($data) ? $data['nama_pihak'] : '';?>" required="required">
									</div>
								</div>
							</div>	
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label for="">Keterangan<font color="red">&nbsp;*</font></label>
										<textarea type="text" placeholder="Keterangan" class="form-control" id="keterangan" name="keterangan" required="required" rows="3"><?php echo !empty($data) ? $data['keterangan'] : '';?></textarea>
									</div>
								</div>
							</div>	
							<hr />
							<div class="row">
								<div class="col-md-12">
									<button href="javascript:void(0);" id="save" class="btn btn-primary btn-flat" type="submit">
										Simpan
									</button>	
									<button type="reset" class="btn btn-danger btn-flat"  data-dismiss="modal" aria-hidden="true">
										Kembali
									</button>
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
	var iduser = '<?= $this->session->userdata('iduser');?>'
	

	$(document).ready(function(){
		$(".select2nya, .combo-invest").select2( { 'width':'100%' } );

		$("#kode_pihak").on("blur", function(){
			var kode = $('#kode_pihak').val();
			$.post(host+'pengajuan-master-display/cek_kode_pihak', { 'kode_pihak':$('#kode_pihak').val(),'iduser':iduser, [csrf_token]:csrf_hash }, function(resp1){
				if(resp1){
					parsing_cek = JSON.parse(resp1)
					console.log(parsing_cek);
					if(parsing_cek.total != 0){
						$.messager.alert('SMART AIP','Kode Pihak '+kode+' Sudah digunakan !','warning'); 
						$('#kode_pihak').val('');
						return false;

					}
				}
			});
		});

		$("#nama_pihak").on("blur", function(){
			var kode = $('#nama_pihak').val();
			$.post(host+'pengajuan-master-display/cek_nama_pihak', { 'nama_pihak':$('#nama_pihak').val(),'iduser':iduser, [csrf_token]:csrf_hash }, function(resp1){
				if(resp1){
					parsing_cek = JSON.parse(resp1)
					console.log(parsing_cek);
					if(parsing_cek.total != 0){
						$.messager.alert('SMART AIP','Nama Pihak '+kode+' Sudah digunakan !','warning'); 
						$('#nama_pihak').val('');
						return false;

					}
				}
			});
		});

	});

	
	// form action
	var rulesnya = {
		iduser : "required",
		kode_pihak : "required",
		nama_pihak : "required",
		keterangan : "required",
		
	};

	var messagesnya = {
		iduser : "<i style='color:red'>Harus Diisi</i>",
		kode_pihak : "<i style='color:red'>Harus Diisi</i>",
		nama_pihak : "<i style='color:red'>Harus Diisi</i>",
		keterangan : "<i style='color:red'>Harus Diisi</i>",
		
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
						window.location = host+'pengajuan-nama-pihak';
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