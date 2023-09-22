<ul class="nav nav-tabs">
	<li role="presentation" <?php if($this->uri->segment(1)=="pengajuan-nama-pihak"){echo 'class="active"';}?>><a href="<?php echo site_url('pengajuan-nama-pihak');?>">Pengajuan Nama Pihak</a></li>

	<li role="presentation" <?php if($this->uri->segment(1)=="pengajuan-nama-pihak" && $this->uri->segment(2)=="master_nama_pihak"){echo 'class="active"';}?>><a href="<?php echo site_url('master/pengajuan_nama_pihak/master_nama_pihak');?>">Nama Pihak Per Jenis Investasi</a></li>
	
</ul>