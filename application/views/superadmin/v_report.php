        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
                <div class="row">
                    <div class="col-md-12">
                     <div class="panel panel-default">
                        <div class="panel-heading">
                            Tambah Kategori Makanan
                        </div>
                        <form class="form"  role="form" action="<?php echo site_url('adminController/generateReport'); ?>" method="post">
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
                                    
                                        <div class="form-group">
                                          <label>Tanggal Pesanan</label>
                                          <input class="form-control" id="date" name="tanggalPesanan" placeholder="DD/MM/YYYY" type="text" required/>
                                        </div>
                                        <button type="submit" class="btn btn-success">SIMPAN</button>
                                                                   
                                </div>
                            </div>
                        </div>
                        </form>  
                    </div>
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
        </div>
        <!-- /. PAGE WRAPPER  -->
       