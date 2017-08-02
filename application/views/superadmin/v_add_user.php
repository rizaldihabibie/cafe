         <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <div class="panel panel-default">
                        <div class="panel-heading">
                            Tambah User Baru
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
                                    <form action="<?php echo site_url('UserController/saveUser'); ?>" method="post">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input class="form-control" name = "username" placeholder="Username" required/>
                                        </div>
                                          <div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control" type='password' name = "password" placeholder="Password" required/>
                                        </div>
                                         <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input class="form-control" name = "namalengkap" placeholder="Nama Lengkap" required/>
                                        </div>
                                          <div class="form-group">
                                            <label>Alamat User</label>
                                            <textarea  name='alamat' class="form-control" rows="3" required></textarea>
                                        </div>
                                        
                                             
                                </div>
                                <div class="col-md-6">
                                <br>
                                  <div class="form-group">
                                            <label>No HP</label>
                                            <input class="form-control" name = "notelepon" placeholder="No Telepon" required />
                                        </div>
                                         <div class="form-group">
                                            <label>No KTP</label>
                                            <input class="form-control" name = "noktp" placeholder="No KTP"  required />
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
                            Data List User
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                             <th>Nama Lengkap</th>
                                            <th>Alamat User</th>
                                            <th>No HP</th>
                                            <th>No KTP</th>
                                            <th>Jabatan</th>
                                            <th>Status</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $nomor=1;
                                            foreach($listUser as $row)
                                            {
                                            if($nomor%2){
                                              echo "<tr>
                                                <td class='warning'>".$nomor."</td>
                                                <td class='warning'>".$row->username."</td>
                                                <td class='warning'>".$row->nama_user. "</td>
                                                <td class='warning'>".$row->alamat_user."</td>
                                                <td class='warning'>".$row->no_ktp."</td>
                                                <td class='warning'>".$row->no_telp."</td>
                                                <td class='warning'>".$row->privilege."</td>
                                                <td class='warning'>".$row->status."</td> 
                                                <td class='warning'><a href = 'editUser/$row->id_user'>EDIT</a></td>
                                              </tr>";
                                            }else{
                                              echo "<tr>
                                                <td class='warning'>".$nomor."</td>
                                                <td class='warning'>".$row->username."</td>
                                                <td class='warning'>".$row->nama_user. "</td>
                                                <td class='warning'>".$row->alamat_user."</td>
                                                <td class='warning'>".$row->no_ktp."</td>
                                                <td class='warning'>".$row->no_telp."</td>
                                                <td class='warning'>".$row->privilege."</td>
                                                <td class='warning'>".$row->status."</td> 
                                                <td class='warning'><a href = 'editUser/$row->id_user'>EDIT</a></td>
                                              </tr>";                                            }
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
       