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
                        <a href="#">Menu Makanan<i class="fa fa-spoon fa-3x"></i><span class="fa arrow"></span></a>
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
                        <a href="#"></i>Menu Minuman<i class="fa fa-glass fa-3x"></i><span class="fa arrow"></span></a>
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