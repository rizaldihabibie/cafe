        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit Kategori Makanan
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
                                    <form role="form" action="<?php echo site_url('KategoriMakananController/saveUpdate'); ?>" method="post">
                                    <input name = "idData" type="hidden" value="<?php if($kategori!="") echo $kategori->id_jenis_makanan; ?>"/>
                                        <div class="form-group">
                                            <label>Nama Kategori</label>
                                            <input class="form-control" value="<?php if($kategori!="") echo $kategori->nama_jenis_makanan; ?>" name = "namaKategori" placeholder="Kategori Makanan" />
                                        </div>
                                      <?php
                                        if($kategori->status == 'AKTIF')
                                        {
                                        ?>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status" id="status" value="AKTIF" checked />AKTIF
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status" id="status" value="PASIF"/>NON AKTIF
                                                </label>
                                            </div>
                                        </div>
                                      <?php
                                        }
                                       else if($kategori->status=='PASIF')
                                       { 
                                      ?> 
                                       <div class="form-group">
                                            <label>Status</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status" id="status" value="AKTIF"  />AKTIF
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status" id="status" value="PASIF" checked/>NON AKTIF
                                                </label>
                                            </div>
                                        </div>
                                        <?php
                                       }
                                        ?> 
                                </div>  
                                                                       
                                </div>
                                <button type="submit" class="btn btn-success">SIMPAN PERUBAHAN</button>
                                    </form> 
                            </div>
                            
                        </div>
                         
                    </div>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
            </div>
             <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
       