<ul class="nav nav-tabs">
	<li role="presentation" <?php if($this->uri->segment(2)=="pendahuluan" && $this->uri->segment(3)=="" ||  $this->uri->segment(2)=="index-pendahuluan"){echo 'class="active"';}?>><a href="<?php echo site_url('bulanan/pendahuluan').get_uri();?>"><input type="checkbox" id="CbPendahuluan" name="testx" value="Lap_Pendahuluan"/>&nbsp;Pendahuluan</a></li>

	<li role="presentation" <?php if($this->uri->segment(2)=="ikhtisar_kinerja" && $this->uri->segment(3)=="" ||  $this->uri->segment(2)=="index-ikhtisar_kinerja"){echo 'class="active"';}?>><a href="<?php echo site_url('bulanan/ikhtisar_kinerja').get_uri();?>">
    <!-- <input type="checkbox" id="CbIkhtisarKinerjaa" name="testx" value="Lap_IkhtisarKinerja"/>&nbsp; -->
    Ikhtisar Kinerja</a></li>

	<li role="presentation" <?php if($this->uri->segment(2)=="aset_investasi" ||  $this->uri->segment(2)=="index-investasi"){echo 'class="active"';}?>><a href="<?php echo site_url('bulanan/aset_investasi').get_uri();?>"><input type="checkbox" id="CbAsetInvestasi" name="testx" value="Lap_AsetInvestasi"/>&nbsp;Aset Investasi</a></li>

	<li role="presentation" <?php if($this->uri->segment(2)=="hasil_investasi" ||  $this->uri->segment(2)=="index-hasil-investasi"){echo 'class="active"';}?>><a href="<?php echo site_url('bulanan/hasil_investasi').get_uri();?>"><input type="checkbox" id="CbHasilInvestasi" name="testx" value="Lap_HasilInvestasi"/>&nbsp;Hasil Investasi</a></li>

	<li role="presentation" <?php if($this->uri->segment(1)=="beban-investasi" ||  $this->uri->segment(2)=="index-beban-investasi"){echo 'class="active"';}?>><a href="<?php echo site_url('beban-investasi').get_uri();?>"><input type="checkbox" id="CbBebanInvestasi" name="testx" value="Lap_BebanInvestasi"/>&nbsp;Beban Investasi</a></li>

	<li role="presentation" <?php if($this->uri->segment(2)=="bukan_investasi" ||  $this->uri->segment(2)=="index-bukan-investasi"){echo 'class="active"';}?>><a href="<?php echo site_url('bulanan/bukan_investasi').get_uri();?>"><input type="checkbox" id="CbBukanInvestasi" name="testx" value="Lap_BukanInvestasi"/>&nbsp;Aset Bukan Investasi</a></li>

	<li role="presentation" <?php if($this->uri->segment(2)=="dana_bersih" ||  $this->uri->segment(2)=="index-danabersih"){echo 'class="active"';}?>><a href="<?php echo site_url('bulanan/dana_bersih').get_uri();?>"><input type="checkbox" id="CbDanaBersih" name="testx" value="Lap_DanaBersih"/>&nbsp;Dana Bersih</a></li>

	<li role="presentation" <?php if($this->uri->segment(2)=="perubahan_dana_bersih" ||  $this->uri->segment(2)=="index-perubahan-danabersih"){echo 'class="active"';}?>><a href="<?php echo site_url('bulanan/perubahan_dana_bersih').get_uri();?>"><input type="checkbox" id="CbPerubahanDanaBersih" name="testx" value="Lap_PerubahanDanaBersih"/>&nbsp;Perubahan Dana Bersih</a></li>

	<li role="presentation" <?php if($this->uri->segment(2)=="arus_kas" ||  $this->uri->segment(2)=="index-aruskas"){echo 'class="active"';}?>><a href="<?php echo site_url('bulanan/arus_kas').get_uri();?>"><input type="checkbox" id="CbArusKas" name="testx" value="Lap_ArusKas"/>&nbsp;Arus Kas</a></li>

	<li role="presentation" <?php if($this->uri->segment(2)=="rincian" ||  $this->uri->segment(2)=="index-rincian"){echo 'class="active"';}?>><a href="<?php echo site_url('bulanan/rincian').get_uri();?>"><input type="checkbox" id="CbRincian" name="testx" value="Lap_Rincian"/>&nbsp;Rincian</a></li>

	<li role="presentation" <?php if($this->uri->segment(3)=="pernyataan_direksi" || $this->uri->segment(2)=="index-pernyataan"){echo 'class="active"';}?>><a href="<?php echo site_url('bulanan/pendahuluan/pernyataan_direksi').get_uri();?>">
    <!-- <input type="checkbox" id="CbPernyataan" name="testx" value="Lap_Pernyataan"/>&nbsp; -->
    Pernyataan</a></li>

	<li role="presentation" <?php if($this->uri->segment(2)=="printall" && $this->uri->segment(3)=="" ||  $this->uri->segment(2)=="index-print_all"){echo 'class="active"';}?>><a href="<?php echo site_url('bulanan/printall').get_uri();?>">Print All</a></li>

</ul>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const isChecked = this.checked;
            const checkboxValue = this.value;

						console.log(checkboxValue);
						console.log(isChecked);
            // Kirim data ke server menggunakan Fetch API
            fetch('/api_update_checkbox', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ checkboxValue, isChecked })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
            });
        });
    });
});
</script>