 <!-- Main content -->
 <div class="row">
 	<div class="col-xs-12">
 		<div class="nav-tabs-custom">
            <?php $this->load->view('main/nav_tab_tmp_nama_pihak_dja'); ?>
 			<div class="box box-default">
 				<div class="box-header with-border">
 					<h3 class="box-title">Nama Pihak Per Jenis Investasi</h3>
 				</div>
 				<!-- /.box-header -->
 				<div class="box-body" style="overflow-x:auto;">	
 					<div class="col-md-12">
            <div class="row"> 
              <div  class="col-md-12"> 
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
 								<th>Group</th>
 								<th>Investasi</th>
 								<th>User</th>
 							</tr>
 						</thead>
 						<tbody>
 							<?php $no=1; ?>
              <?php if(isset($data_nama_pihak) && is_array($data_nama_pihak)):?>
              <?php foreach($data_nama_pihak as $pihak):?>
                <tr>
                  <td><?= $no++;?></td>
                  <td style="text-align: left;"><?=$pihak['kode_pihak']?></td>
                  <td style="text-align: left;"><?=$pihak['nama_pihak']?></td>
                  <td style="text-align: left;"><?=$pihak['group']?></td>
                  <td style="text-align: left;"><?=$pihak['jenis_investasi']?></td>
                  <?php 
                    if($pihak['iduser'] == 'TSN002'){
                      $iduser = 'TASPEN';
                    }elseif ($pihak['iduser'] == 'ASB003') {
                      $iduser = 'ASABRI';
                    }
                  ?>
                  <td style="text-align: left;"><?=$iduser;?></td>
                 
                </tr>
              <?php endforeach;?>
              <?php endif;?>
           </tbody>
         </table>
       </div>
       <!-- /.box-body -->
       <div class="box-footer with-border">
        <div class="text-left">
         <!-- <?php echo $paggination;?> -->
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
    $(".select2nya").select2( { 'width':'100%' } );

    $('#tbl-pihak').DataTable({
        "paging":true,
        "searching": true,
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