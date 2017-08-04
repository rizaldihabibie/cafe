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
                                    <form action="<?php echo site_url('UserController/savePass'); ?>" method="post">
                                        <input name = "idData" type="hidden" value="<?php if($user!="") echo $user->id_user; ?>"/>
                                         <div class="form-group">
                                            <label>Username</label>
                                            <input class="form-control" name = "username" value="<?php if($user!="") echo $user->username; ?>" placeholder="Username" disabled/>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input class="form-control" name = "namalengkap" value="<?php if($user!="") echo $user->nama_user; ?>" placeholder="Nama Lengkap" disabled/>
                                        </div>
                                        <div class="form-group">
                                            <label>Password Baru</label>
                                            <input class="form-control" name = "password_baru" type='password'  placeholder="Password Baru" required/>
                                        </div>
                                        <div class="form-group">
                                            <label>Ulangi Password Baru</label>
                                            <input class="form-control" name = "password_ulang" type='password'  placeholder="Ulang Password" required/>
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
       