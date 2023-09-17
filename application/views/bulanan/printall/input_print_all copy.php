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
            <h3 class="box-title">Print All</h3>
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
                    <a href="javascript:void(0)" title="Generate" class="btn btn-primary btn-sm btn-flat" onClick="gensearch('index-print_all','index-print_all');">
                      <i class="fa fa-file-pdf-o"></i>
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

            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo site_url('bulanan/printall/generate_all_reports');?>">
              <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-12" style="background-color: #dae7ef;">
                    <div class="form-group" style="margin-left: 20px;">
                      <!-- <label for="keterangan" class="lebel">Generate PDF</label> -->
                      <br><button class="btn btn-primary btn-flat pull-left user-bln" type="submit" style="margin-right:50px">
                        Generate
                      </button>
                      <a href="<?php echo base_url('generate_AllPDF_Preview'); ?>" class="btn btn-danger btn-sm btn-flat" target="_blank">
                        <i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Generate Preview PDF
                      </a>
                      <!-- <a href="javascript:void(0)" title="Add" class="btn btn-danger btn-sm btn-flat" onClick="genform('print-all', 'perubahan_danabersih_cetak','perubahan_danabersih_cetak');">
                        <i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Cetak PDF
                      </a>  -->
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

