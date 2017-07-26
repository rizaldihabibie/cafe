 
           
<div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> Last access : 30 May 2014 &nbsp; <a href="login.html" class="btn btn-danger square-btn-adjust">Logout</a> </div> 
</nav>
<!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                <li class="text-center">
                    <img src="<?php echo base_url(); ?>assets/images/find_user.png" class="user-image img-responsive"/>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-spoon fa-3x"></i> Menu Makanan<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a  href="<?php echo site_url('MenuMakananController/index'); ?>"><i class="fa fa-plus-circle fa-3x"></i>Tambah Makanan</a>
                            </li>
                            <li>
                                <a  href="<?php echo site_url('KategoriMakananController/index'); ?>"><i class="fa fa-info fa-3x"></i>Kategori Makanan</a>
                            </li>
                        </ul>
                    </li> 
                     <li>
                        <a href="#"><i class="fa fa-glass fa-3x"></i> Menu Minuman<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a  href="<?php echo site_url('MenuMinumanController/index'); ?>"><i class="fa fa-plus-circle fa-3x"></i>Tambah Minuman</a>
                            </li>
                            <li>
                                <a  href="<?php echo site_url('KategoriMinumanController/index'); ?>"><i class="fa fa-info fa-3x"></i>Kategori Minuman</a>
                            </li>
                        </ul>
                    </li>
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
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
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kategori</th>
                                            <th>Edit</th>
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
                                                <td class='warning'><a href = 'editKategori/$row->id_jenis_makanan'>EDIT</a></td>
                                              </tr>";
                                            }else{
                                              echo "<tr>
                                                <td class='info'>".$nomor."</td>
                                                <td class='info'>".$row->nama_jenis_makanan."</td>
                                                <td class='info'><a href = 'editKategori/$row->id_jenis_makanan'>EDIT</a></td>
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
       