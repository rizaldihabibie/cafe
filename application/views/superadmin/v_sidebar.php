<div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"><span><a id="time">ahahah &nbsp;</a></span><a href="<?php echo site_url('Welcome/logout'); ?>" class="btn btn-danger square-btn-adjust">Logout</a> </div> 
 </nav>
<!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                <li class="text-center">
                    <img src="<?php echo base_url(); ?>assets/images/find_user.png" class="user-image img-responsive"/>
                </li>
                
                   <li>
                        <a href="#">Menu Makanan<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a  href="<?php echo site_url('MenuMakananController/index'); ?>">Tambah Makanan</a>
                            </li>
                            <li>
                                <a  href="<?php echo site_url('KategoriMakananController/index'); ?>">Kategori Makanan</a>
                            </li>
                        </ul>
                    </li> 
                     <li>
                        <a href="#">Menu Minuman<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a  href="<?php echo site_url('MenuMinumanController/index'); ?>">Tambah Minuman</a>
                            </li>
                            <li>
                                <a  href="<?php echo site_url('KategoriMinumanController/index'); ?>">Kategori Minuman</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Pesanan<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a  href="<?php echo site_url('PesanMejaController/index'); ?>">Buat Pesanan Baru</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Pembayaran<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a  href="<?php echo site_url('PembayaranController/index'); ?>">Tutup Pesanan</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">Utilitas<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a  href="<?php echo site_url('UserController/index'); ?>">Manajemen User</a>
                            </li>
                            <li>
                                <a  href="<?php echo site_url('AdminController/reportPage'); ?>">Report</a>
                            </li>
                        </ul>
                    </li>
                </ul>
               
            </div>
            
        </nav>  