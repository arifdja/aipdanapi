  <!-- Main content -->
  <?php $level = $this->session->userdata('level');?>
  <?php $tahun = $this->session->userdata('tahun');?>
  <style type="text/css">
    .lebel{
      font-weight: bold;
      font-size: 16px;
    }
  </style>
  <div class="row">
    <div class="col-xs-12">
      <div class="nav-tabs-custom">
        <?php $this->load->view('main/nav_tab_view'); ?>
        <div class="box box-default">
          <div class="box-header with-border">
            <h3 class="box-title">Ikhtisar Kinerja</h3>
            <p class="box-title pull-right" style="margin-right:40px"><i class="fa fa-calendar"></i>&nbsp;&nbsp;<?php echo (isset($bulan[0]->nama_bulan) ? $bulan[0]->nama_bulan : '').' - '. $tahun;?></p>
          </div>
          <br>
          <!-- /.box-header -->                        
          <div class="box-body">
          <div class="col-md-12">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group adm">
                    <select class="form-control select2nya" id="iduser">
                      <option value="">
                        -- Pilih --
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
                <div class="col-md-1">
                  <div class="form-group adm">
                    <a href="javascript:void(0)" title="Add" class="btn btn-primary btn-sm btn-flat" onClick="gensearch('index-ikhtisar_kinerja','index-ikhtisar_kinerja');">
                      <i class="fa fa-search"></i>
                    </a> 
                  </div>
                </div>
                
              </div>
            </div>
            <hr>
            <?php if($this->session->flashdata('form_true')){?>
              <div id="notif">               
                <?php echo $this->session->flashdata('form_true');?>               
              </div>
            <?php } ?>

            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo site_url('bulanan/ikhtisar_kinerja/save');?>">
              <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-12" style="background-color: #dae7ef;">
                    <div class="form-group" style="margin-left: 20px;">
                      <label for="keterangan" class="lebel">Unggah Dokumen</label>
                      <input type="hidden" name="file_lap" value="<?php echo (isset($data_ikhtisar_kinerja[0]->file) ? $data_ikhtisar_kinerja[0]->file : '');?>">
                      <input type="hidden" name="nmdok" value="Ikhtisar_kinerja">
                      <input type="hidden" name="jenis_lap" value="ket_ikhtisar_kinerja">
                      <input type="file" name="filedata">
                      <p style="margin-top:15px;">Dokumen harus bertipe pdf,doc atau docx</p>
                      <a href="<?php echo site_url('bulanan/ikhtisar_kinerja/get_file/'.(isset($data_ikhtisar_kinerja[0]->id) ? $data_ikhtisar_kinerja[0]->id : '').get_uri());?>"><p><?php echo (isset($data_ikhtisar_kinerja[0]->file) ? $data_ikhtisar_kinerja[0]->file : '');?></p></a>
                      <button class="btn btn-primary btn-flat pull-left user-bln" type="submit" style="margin-right:50px">
                        Upload
                      </button>
                    </div>
                  </div>
                </div>
              </div>
          </form>
          <br>
          <center>
            <embed type="application/pdf" src="<?php echo site_url('files/file_bulanan/ikhtisar_kinerja/'.(isset($data_ikhtisar_kinerja[0]->file_lap) ? $data_ikhtisar_kinerja[0]->file_lap : 'x'));?>" width="100%" height="700">
              <!-- <p>Unable to display PDF file. <a href="/uploads/media/default/0001/01/540cb75550adf33f281f29132dddd14fded85bfc.pdf">Download</a> instead.</p> -->
            </embed>
          </center>
        </div>
        <!-- /.col -->

      </div>
    </div>
    <!-- /.box -->
  </div>
</div>

<script type="text/javascript">
   $(".select2nya").select2( { 'width':'100%' } );

   $(".ckeditor").each(function () {
     CKEDITOR.replace( $(this).attr("name") );
   })

   CKEDITOR.config.toolbar = [
    ['Styles','Format','Font','FontSize'],
    '/',
    ['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
    ];
</script>

