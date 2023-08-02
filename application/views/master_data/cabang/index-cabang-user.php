 <!-- Main content -->
 <?php $level = $this->session->userdata('level');?>
            <?php $tahun = $this->session->userdata('tahun');?>
            <?php $iduser= $this->session->userdata('idusergroup');?>
            <style type="text/css">
                td.subchild{
                    padding-left: 50px;
                }
            </style>
            <div class="row">
                <div class="col-xs-12">
				  <div class="nav-tabs-custom">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Cabang</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="overflow-x:auto;">
                            <div class="col-md-12">
                                <div class="row">
                                    <div  class="col-md-12"> 
                                        <div class="form-group pull-right">
                                            <a href="javascript:void(0)" title="Add" class="btn btn-primary btn-sm btn-flat" onClick="
                                            genform('master_cabang_user','master_cabang_user','master_cabang_user','','','','','add');">
                                                <i class="fa fa-plus"></i>&nbsp;&nbsp;Tambah
                                            </a>  
                                            <button class="btn btn-sm btn-flat btn-primary" id="excel"><i class="fas fa-excel"></i>Download Excel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<?php if($this->session->flashdata('form_true')){?>
							<div id="notif">               
								<?php echo $this->session->flashdata('form_true');?>               
							</div>
							<?php } ?>
                            <table id="tbl-invest" class="table table-bordered table-striped table-hover tbl-form">
                                <thead>
									<tr>
                                        <th>No</th>
                                        <th>ID Cabang</th>
                                        <th>Nama Cabang</th>
                                        <th>User</th>
                                        <th>Status</th>
                                        <th>Keterangan</th>
									</tr>
								
                                </thead>
                                <tbody>
                                <?php $no=1; ?>
                                <?php if(isset($data_cabang) && is_array($data_cabang)):?>
                                    <?php foreach($data_cabang as $cabang):?>
                                        <tr>
                                            <td style="text-align: center;"><?= $no++;?></td>
                                            <td style="text-align: left;"><?=$cabang['id_cabang']?></td>
                                            <td style="text-align: left;"><?=$cabang['nama_cabang']?></td>
                                            <?php 
                                            if($cabang['iduser'] == 'TSN002'){
                                                $iduser = 'TASPEN';
                                              }elseif ($cabang['iduser'] == 'ASB003') {
                                                $iduser = 'ASABRI';
                                            }
                                            ?>
                                            <td style="text-align: left;"><?=$iduser;?></td>
                                            <td style="text-align: left;">
                                            <?php
                                            if ($cabang['approval'] == '1'){ 
                                                echo 'Diajukan';
                                            }elseif ($cabang['approval'] == '2') {
                                                echo 'Ditolak';
                                            }elseif ($cabang['approval'] == '3') {
                                                echo 'Diterima';
                                            }elseif ($cabang['approval'] == '') {
                                                echo 'Data Awal';
                                            }
                                            ?>
                                            </td>
                                            <td style="text-align: left;"><?=$cabang['keterangan']?></td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                                </tbody>  
                            </table>
                            <br>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer with-border">
                           <div class="text-left">
                              <!--  <?php echo $paggination;?> -->
                           </div>
                        </div>
                        <div id="modal_invest1" class="modal fade" data-refresh="true" class="modal fade" tabindex="-1" role="dialog">
                           <div class="modal-dialog modal-lg">
                              <div class="modal-content">

                              </div>
                          </div>
                        </div>
                    </div>
                    <!-- Modal input/edit -->
                    <!-- /.box -->
                	</div>
               </div>
               <!-- /.col -->
            </div>
            <!-- row -->
   <!-- MODAL KETERANGAN -->



<script type="text/javascript">
    $(".select2nya").select2( { 'width':'100%' } );

    $('#tbl-invest').DataTable({
        "paging":true,
        "searching": false,
        "ordering": false,
        "lengthChange": true,
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "iDisplayLength": 10
    });
    
</script>

<script>
  $(document).ready(function () {
    $("#excel").click(function(){
      $(".table").table2excel({
        // exclude CSS class
        exclude: ".noExl",
        name: "cabang",
        filename: "data_cabang", //do not include extension
        fileext: ".xls" // file extension
      }); 
    });
  });
</script>
       
    