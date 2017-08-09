        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <div class="panel panel-default">
                        <div class="panel-heading">
                            Edit Data Menu
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
                                    <form action="<?php echo site_url('MenuMakananController/saveUpdate'); ?>" method="post">
                                        <input name = "idData" type="hidden" value="<?php if($menu!="") echo $menu->id_menu; ?>"/>
                                        <div class="form-group">
                                            <label>Nama Menu</label>
                                            <input class="form-control" name = "namaMakanan" value="<?php if($menu!="") echo $menu->nama_menu; ?>" placeholder="Nama Makanan" required/>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Jenis Menu</label>
                                            <select class="form-control" name = "namaKategori">
                                                <option value="0-0">-- Pilih Kategori --</option>
                                                <?php 
                                                foreach($listKategori as $row){
                                                if ($row->id_jenis_makanan === $menu->id_jenis_makanan) {
                                                     $selected = 'selected';
                                                } else {
                                                     $selected = '';
                                                }
                                                 echo '<option value="'.$row->id_jenis_makanan.'"'.$selected.'>'.$row->nama_jenis_makanan.'</option>';
                                                }
                                               ?>
                                            </select>
                                        </div>                        
                                </div>
                                <div class="col-md-6">
                                <br>
                                    <div class="form-group">
                                            <label>Harga Pokok Makanan</label>
                                            <input class="form-control" value="<?php if($menu!="") echo $menu->harga_pokok; ?>"name = "hargaPokokMakanan" placeholder="Harga Makanan" required />
                                    </div>
                                    <div class="form-group">
                                            <label>Harga Jual Makanan</label>
                                            <input class="form-control" value="<?php if($menu!="") echo $menu->harga_jual; ?>"name = "hargaJualMakanan" placeholder="Harga Makanan" required/>
                                    </div>
                                  <?php
                                        if($menu->status == 'AKTIF')
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
                                       else if($menu->status=='PASIF')
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
       