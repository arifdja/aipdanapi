 <!-- Main content -->
 <?php $level = $this->session->userdata('level');?>
            <?php $tahun = $this->session->userdata('tahun');?>
            <div class="row">
                <div class="col-xs-12">
				  <div class="nav-tabs-custom">
                    <?php $this->load->view('main/nav_tab_input'); ?>
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Peserta Aktif</h3>
 					        <p class="box-title pull-right" style="margin-right:20px"><i class="fa fa-calendar"></i>&nbsp;&nbsp; Semesteran</p>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example" class="table table-responsive table-bordered table-hover">
                                <thead>
									<tr>
                                        <th>No.</th>
                                        <th>Semester</th>
                                        <th>Kelompok</th>
    									<th>Jumlah</th>
									</tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i =1;
                                    foreach($data as $value):
                                    ?>
                                        <tr>
                                            <td style="text-align: left;"><?=$i;?></td>
                                            <td style="text-align: left;"><?=konversi_semester($value['semester'],"full")?></td>
                                            <td style="text-align: left;"><?=$value['id_kelompok']?> - <?=$value['kelompok_peserta']?></td>
                                            <td style="text-align: right;"><?=$value['jumlah']?></td>
                                        </tr>
                                    <?php $i++; endforeach;?>
                              </tbody>
                            </table>
                            <br>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- Modal input/edit -->
                    <!-- /.box -->
                	</div>
               </div>
               <!-- /.col -->
            </div>
            <!-- row -->
           

<script type="text/javascript">

    $('#example').DataTable({
        "paging":true,
        "searching": true,
        "ordering": true,
        "lengthChange": true,
    });
    
</script>

       
    