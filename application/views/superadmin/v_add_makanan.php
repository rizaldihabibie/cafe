         <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <div class="panel panel-default">
                        <div class="panel-heading">
                            Tambah Menu Makanan
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
                                    <form action="<?php echo site_url('MenuMakananController/saveMenu'); ?>" method="post">
                                        <div class="form-group">
                                            <label>Nama Makanan</label>
                                            <input class="form-control" name = "namaMakanan" placeholder="Nama Makanan" required/>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Jenis Makanan</label>
                                            <select class="form-control" name = "namaKategori">
                                                <option value="0-0">-- Pilih Kategori --</option>
                                                <?php 
                                                foreach($listKategori as $row){
                                                 echo '<option value="'.$row->id_jenis_makanan.'">'.$row->nama_jenis_makanan.'</option>';
                                                }
                                               ?>
                                            </select>
                                        </div>                        
                                </div>
                                <div class="col-md-6">
                                <br>
                                    <div class="form-group">
                                            <label>Harga Pokok Makanan</label>
                                            <input class="form-control" name = "hargaPokokMakanan" placeholder="Harga Makanan" required />
                                    </div>
                                    <div class="form-group">
                                            <label>Harga Jual Makanan</label>
                                            <input class="form-control" name = "hargaJualMakanan" placeholder="Harga Makanan" required/>
                                    </div>
                                    <div class="form-group">
                                         <button type="submit" class="btn btn-success">SIMPAN</button>
                                    </div>
                                </div> 
                                
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
                            Data Kategori Makanan
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover"  id='dataTables-menumakanan'>
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Menu</th>
                                            <th>Harga Pokok</th>
                                            <th>Harga Jual</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $nomor=1;
                                            foreach($listMakanan as $row)
                                            {
                                            if($nomor%2){
                                              echo "<tr>
                                                <td class='warning'>".$nomor."</td>
                                                <td class='warning'>".$row->nama_menu."</td>
                                                <td class='warning'>".$row->harga_pokok."</td>
                                                <td class='warning'>".$row->harga_jual."</td>
                                                <td class='warning'><button class='btn btn-primary btn-xs'  id = '".$row->id_menu."@".$row->nama_menu."@".$row->harga_pokok."@".$row->harga_jual."@".$row->id_jenis_makanan."' data-title='Edit' data-toggle='modal' data-target='#editMenuMakanan' ><span class='glyphicon glyphicon-pencil'></span></button> |  <button class='btn btn-danger btn-xs' id = '".$row->id_menu."' data-title='Edit' data-toggle='modal' data-target='#deleteMenuMakanan' ><span class='glyphicon glyphicon-trash'></span></button></td>

                                              </tr>";
                                            }else{
                                              echo "<tr>
                                                <td class='info'>".$nomor."</td>
                                                <td class='info'>".$row->nama_menu."</td>
                                                <td class='info'>".$row->harga_pokok."</td>
                                                <td class='info'>".$row->harga_jual."</td>
                                                <td class='info'><button class='btn btn-primary btn-xs'  id = '".$row->id_menu."@".$row->nama_menu."@".$row->harga_pokok."@".$row->harga_jual."@".$row->id_jenis_makanan."' data-title='Edit' data-toggle='modal' data-target='#editMenuMakanan' ><span class='glyphicon glyphicon-pencil'></span></button> |  <button class='btn btn-danger btn-xs' id = '".$row->id_menu."' data-title='Edit' data-toggle='modal' data-target='#deleteMenuMakanan' ><span class='glyphicon glyphicon-trash'></span></button></td>
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
<div id="deleteMenuMakanan" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">DELETE DATA</h4>
      </div>
      <div class="modal-body">
         <form id="demo-form2" role="form" method="post" action="<?php echo base_url()?>index.php/MenuMakananController/deleteMenuMakanan" data-parsley-validate class="form-horizontal form-label-left">
            <input type="hidden" name = "idDeleteMenuMakanan" id= "idDeleteMenuMakanan"/>
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

<div id="editMenuMakanan" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">EDIT DATA</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo site_url('MenuMakananController/saveUpdate'); ?>" method="post">
          <input name = "idData" id="idData" type="hidden"/>
          <div class="form-group">
            <label>Nama Menu</label>
            <input class="form-control" id="namaMakanan" name = "namaMakanan" placeholder="Nama Makanan" required/>
          </div>

          <div class="form-group">
            <label>Jenis Menu</label>
            <select class="form-control" id="namaKategori" name = "namaKategori">
              <option value="0-0">-- Pilih Kategori --</option>
              <?php
              foreach($listKategori as $row){
                echo '<option value="'.$row->id_jenis_makanan.'">'.$row->nama_jenis_makanan.'</option>';
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Harga Pokok Makanan</label>
            <input class="form-control" id ="hargaPokokMakanan" name = "hargaPokokMakanan" placeholder="Harga Makanan" required />
          </div>
          <div class="form-group">
            <label>Harga Jual Makanan</label>
            <input class="form-control" id="hargaJualMakanan" name = "hargaJualMakanan" placeholder="Harga Makanan" required/>
          </div>

          <div class="form-group">
            <button type="submit" class="btn btn-success">SIMPAN PERUBAHAN</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>