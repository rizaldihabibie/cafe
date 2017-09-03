        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <div class="panel panel-default">
                        <div class="panel-heading">
                            Tambah Kategori Minuman
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                <br>
                                 <?php if($this->session->flashdata('error')): ?>
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                   <div class="fa fa-info-circle"></div>&nbsp;<?php echo $this->session->flashdata('error'); ?>
                                                </div>
                                    <?php endif; ?>
                                    <?php if($this->session->flashdata('success')): ?>
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                   <div class="fa fa-info-circle"></div>&nbsp;<?php echo $this->session->flashdata('success'); ?>
                                                </div>
                                    <?php endif; ?>
                                    
                                    <form role="form" action="<?php echo site_url('KategoriMinumanController/saveCategory'); ?>" method="post">
                                        <div class="form-group">
                                            <label>Nama Kategori</label>
                                            <input class="form-control" name = "namaKategori" placeholder="Kategori Minuman" />
                                        </div>
                                        <button type="submit" class="btn btn-success">SIMPAN</button>
                                    </form>                                 
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-12">
                  <!--   Kitchen Sink -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Kategori Minuman
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id='dataTables-katminuman'>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kategori</th>
                                            <th>&nbsp;</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $nomor=1;
                                            foreach($listKategori as $row)
                                            {
                                            if($nomor%2){
                                              echo "<tr>
                                                <td class='warning'>".$nomor."</td>
                                                <td class='warning'>".$row->nama_jenis_makanan."</td>
                                                <td class='warning'><a href = 'editKategori/$row->id_jenis_makanan'>EDIT</a> |   <a id = '".$row->id_jenis_makanan."' data-title='Edit' data-toggle='modal' data-target='#deleteKatMinuman'   >HAPUS</a></td>
                                             
                                              </tr>";
                                            }else{
                                              echo "<tr>
                                                <td class='info'>".$nomor."</td>
                                                <td class='info'>".$row->nama_jenis_makanan."</td>
                                                <td class='info'><a href = 'editKategori/$row->id_jenis_makanan'>EDIT</a> |  <a id = '".$row->id_jenis_makanan."' data-title='Edit' data-toggle='modal' data-target='#deleteKatMinuman'   >HAPUS</a></td>
                                                
                                              </tr>";
                                            }
                                              $nomor++;
                                            }
                                          ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                     <!-- End  Kitchen Sink -->
                </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
            </div>
             <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
       
            <!-- Modal -->
<div id="deleteKatMinuman" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">DELETE DATA</h4>
      </div>
      <div class="modal-body">
         <form id="demo-form2" role="form" method="post" action="<?php echo base_url()?>index.php/KategoriMinumanController/deleteKategoriMinuman" data-parsley-validate class="form-horizontal form-label-left">
            <input type="hidden" name = "idDeleteKategoriMinuman" id= "idDeleteKategoriMinuman"/>
            <p>Yakin ingin menghapus ?</p>
            <div class="form-group">
              <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-6">
                <button type="submit" class="btn btn-success">YA</button>
              </div>
            </div>
          </form>
      </div>
    </div>
  </div>
</div>

