<ul class="nav nav-tabs">
	<li role="presentation" <?php if($this->uri->segment(3)=="getdata_peserta_aktif_semester"){echo 'class="active"';}?>><a href="<?php echo site_url('semesteran/aspek_operasional/getdata_peserta_aktif_semester');?>">Peserta Aktif</a></li>
	<li role="presentation" <?php if($this->uri->segment(3)=="getdata_peserta_aktif_cabang_semester"){echo 'class="active"';}?>><a href="<?php echo site_url('semesteran/aspek_operasional/getdata_peserta_aktif_cabang_semester');?>">Peserta Aktif Cabang</a></li>
	
	<li role="presentation" <?php if($this->uri->segment(3)=="nilai_tunai" || $this->uri->segment(2)=="index-nilai-tunai"){echo 'class="active"';}?>><a href="<?php echo site_url('semesteran/aspek_operasional/nilai_tunai');?>">Nilai Tunai</a></li>
	
	<li role="presentation" <?php if($this->uri->segment(3)=="pembayaran_pensiun_aip" || $this->uri->segment(2)=="index-pembayaran-kelompok"){echo 'class="active"';}?>><a href="<?php echo site_url('semesteran/aspek_operasional/pembayaran_pensiun_aip');?>">Pembayaran Pensiun AIP</a></li>

	<li role="presentation" <?php if($this->uri->segment(3)=="pembayaran_pensiun_cabang" || $this->uri->segment(2)=="index-pembayaran-cabang"){echo 'class="active"';}?>><a href="<?php echo site_url('semesteran/aspek_operasional/pembayaran_pensiun_cabang');?>">Pembayaran Pensiun Cabang</a></li>

	<li role="presentation" <?php if($this->uri->segment(3)=="beban" || $this->uri->segment(2)=="index-beban"){echo 'class="active"';}?>><a href="<?php echo site_url('semesteran/aspek_operasional/beban');?>">Beban</a></li>
</ul>