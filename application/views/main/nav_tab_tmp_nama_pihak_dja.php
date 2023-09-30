<ul class="nav nav-tabs">
	<li role="presentation" <?php if($this->uri->segment(2)=="master_data" && $this->uri->segment(3)=="tmp_mst_pihak"){echo 'class="active"';}?>><a href="<?php echo site_url('master/master_data/tmp_mst_pihak');?>">Pengajuan Nama Pihak</a></li>

	<li role="presentation" <?php if($this->uri->segment(2)=="master_data" && $this->uri->segment(3)=="master_tmp_nama_pihak"){echo 'class="active"';}?>><a href="<?php echo site_url('master/master_data/master_tmp_nama_pihak');?>">Nama Pihak Per Jenis Investasi</a></li>
	
</ul>