         <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <form role="form" action="<?php echo site_url('KasirController/saveTable'); ?>" method="post">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Daftar Menu
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Jenis Makanan</label>
                                <select class="form-control" name = "namaKategori">
                                <option value="0-0">-- Makanan --</option>
                                <?php 
                                    foreach($listKategoriMakanan as $row){
                                        echo '<option value="'.$row->id_jenis_makanan.'">'.$row->nama_jenis_makanan.'</option>';
                                    }
                                ?>
                                 </select>
                            </div>
                            <div class="form-group">
                                <label>Jenis Minuman</label>
                                <select class="form-control" name = "namaKategori">
                                <option value="0-0">-- Minuman --</option>
                                <?php 
                                    foreach($listKategoriMinuman as $row){
                                        echo '<option value="'.$row->id_jenis_makanan.'">'.$row->nama_jenis_makanan.'</option>';
                                    }
                                ?>
                                 </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Daftar Menu
                                </div>
                            </div>
                        </div>
                        <button type="submit" class=" form-control btn btn-success ">TEST</button>
                    </div>
                     </form>
                </div>
                 <!-- /. ROW  -->
                 <hr />
            </div>
             <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
       