        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit Data User
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
                                    <form action="<?php echo site_url('UserController/saveUpdate'); ?>" method="post">
                                        <input name = "idData" type="hidden" value="<?php if($user!="") echo $user->id_user; ?>"/>
                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input class="form-control" name = "namalengkap" value="<?php if($user!="") echo $user->nama_user; ?>" placeholder="Nama Lengkap" required/>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Alamat User</label>
                                            <textarea  name='alamat' class="form-control" rows="3" value="<?php if($user!="") echo $user->alamat_user; ?>" required></textarea>
                                        </div>
                                </div>
                                <div class="col-md-6">
                                <br>
                                    <div class="form-group">
                                            <label>No HP</label>
                                            <input class="form-control" name = "notelepon" placeholder="No Telepon" value="<?php if($user!="") echo $user->no_telp; ?>" required />
                                        </div>
                                      <div class="form-group">
                                            <label>No KTP</label>
                                            <input class="form-control" name = "noktp" placeholder="No KTP" value="<?php if($user!="") echo $user->no_ktp; ?>"  required />
                                        </div>
                                         <div class="form-group">
                                            <label>Jabatan</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="jabatan" id="jabatan" value="super" checked />Admin
                                                </label>
                                             </div>
                                             <div class="radio">   
                                                <label>
                                                    <input type="radio" name="jabatan" id="jabatan" value="kasir"/>Kasir
                                                </label>
                                              </div>
                                              <div class="radio">
                                                <label>
                                                    <input type="radio" name="jabatan" id="jabatan" value="waitress"/>Waitress
                                                </label>
                                            </div>
                                        </div>
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
                                    <div class="form-group">
                                         <button type="submit" class="btn btn-success">SIMPAN PERUBAHAN</button>
                                    </div>
                                </div> 
                                
                                </form>
                                </div>
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
       