 <!-- Main content -->

 <?php $iduser = $this->session->userdata('idusergroup'); ?>
 <div class="row">
     <div class="col-xs-12">
         <div class="nav-tabs-custom">
            <?php $this->load->view('main/nav_tab_tmp_nama_pihak_dja'); ?>
             <div class="box box-default">
                 <div class="box-header with-border">
                     <h3 class="box-title">Approval Pengajuan Nama Pihak</h3>
                 </div>
                 <!-- /.box-header -->
                 <div class="box-body" style="overflow-x:auto;">
                     <div class="col-md-12">
                         <div class="row">
                             <div class="col-md-12">
                                 <div class="form-group pull-right">
                                     <button class="btn btn-sm btn-flat btn-primary" id="excel"><i class="fas fa-excel"></i>Download Excel</button>

                                 </div>
                             </div>
                         </div>
                     </div>
                     <table id="tbl-pihak" class="table table-responsive table-bordered table-hover">
                         <thead>
                             <tr>
                                 <th>No</th>
                                 <th>Kode Pihak</th>
                                 <th>Nama Pihak</th>
                                 <th>User</th>
                                 <th>Keterangan</th>
                                 <th>Status</th>
                                 <th width="100" class='noExl'>#</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php $no = 1; ?>
                             <?php if (isset($data_mst_pihak) && is_array($data_mst_pihak)) : ?>
                                 <?php foreach ($data_mst_pihak as $pihak) : ?>
                                     <tr>
                                         <td style="text-align: center;"><?= $no++; ?></td>
                                         <td style="text-align: center;"><?= $pihak['kode_pihak'] ?></td>
                                         <td style="text-align: left;"><?= $pihak['nama_pihak'] ?></td>
                                         <?php
                                            if ($pihak['iduser'] == 'TSN002') {
                                                $iduser = 'TASPEN';
                                            } elseif ($pihak['iduser'] == 'ASB003') {
                                                $iduser = 'ASABRI';
                                            }
                                            ?>
                                         <td style="text-align: left;"><?= $iduser; ?></td>
                                         <td style="text-align: left;"><?= $pihak['keterangan'] ?></td>
                                         <?php
                                            $tampil_status = '';
                                            if ($pihak['status'] == 0) {
                                                $tampil_status = "Menunggu Persetujuan";
                                            } elseif ($pihak['status'] == 2) {
                                                $tampil_status = "Ditolak";
                                            } else {
                                                $tampil_status = "Diterima";
                                            }

                                            ?>
                                         <td style="text-align: left;"><?= $tampil_status ?></td>
                                         <td>
                                             <?php if ($pihak['status'] == 0) : ?>
                                                 <a href="javascript:void(0)" title="Setuju" class="btn btn-success btn-sm btn-flat" onClick="genform('tmp_mst_pihak','tmp_mst_pihak','setuju','','<?= $pihak['id'] ?>','','','approval');">
                                                     <i class="fa fa-check"></i>
                                                 </a>
                                                 &nbsp;
                                                 <a href="javascript:void(0)" title="Tolak" class="btn btn-danger btn-sm btn-flat" onClick="genform('tmp_mst_pihak', 'tmp_mst_pihak','tolak','','<?= $pihak['id'] ?>','','','approval');">
                                                     <i class="fa fa-times"></i>
                                                 </a>
                                             <?php endif; ?>
                                         </td>
                                     </tr>
                                 <?php endforeach; ?>
                             <?php endif; ?>
                         </tbody>
                     </table>
                 </div>
                 <!-- /.box-body -->
                 <div class="box-footer with-border">
                     <div class="text-left">
                         <!-- <?php echo $paggination; ?> -->
                     </div>
                 </div>
                 <!-- Modal input/edit -->
                 <div id="modal_pihak" class="modal fade" data-refresh="true" class="modal fade" tabindex="-1" role="dialog">
                     <div class="modal-dialog">
                         <div class="modal-content">


                         </div>
                     </div>
                 </div>
             </div>
             <!-- /.box -->
         </div>
     </div>
     <!-- /.col -->
 </div>
 <!-- row -->

 <script type="text/javascript">
     $(".select2nya").select2({
         'width': '100%'
     });

     $('#tbl-pihak').DataTable({
         "paging": true,
         "searching": false,
         "ordering": false,
         "lengthChange": true,
         "lengthMenu": [
             [10, 25, 50, 100, -1],
             [10, 25, 50, 100, "All"]
         ],
         "iDisplayLength": 10
     });
 </script>


 <script>
     $(document).ready(function() {
         $("#excel").click(function() {
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