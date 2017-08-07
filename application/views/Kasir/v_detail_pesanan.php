         <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                <div class = "col-md-12">
                    <div class="col-md-12">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                Data Pemesan
                            </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama Pemesan</label>
                                    <input class="form-control" name = "namaPemesan"  value = "<?php if($pemesan!="") echo $pemesan->nama_pemesan; ?>" readonly/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tanggal Pesanan</label>
                                    <input class="form-control" name = "tanggalPesanan" value= "<?php if($pemesan!="") echo date('d/m/Y',strtotime($pemesan->date_pesanan)); ?>" readonly/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nomor Meja</label>
                                    <input class="form-control" name = "nomorMeja"  value = "<?php if($noMeja!="") echo $noMeja; ?>" readonly/>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-12">
                  <!--   Kitchen Sink -->
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            Detail Pesanan
                        </div>
                        <div class="col-md-12">
                        <div class="panel-heading">
                        </div>
                        <div class="col-md-6">
                                <div class="form-group">
                                </div>
                        </div>
                        <div class="col-md-6">
                        <form role="form" action="<?php echo site_url('KasirController/addOrderPage'); ?>" method="post">
                            <div class="form-group">
                                <input type="hidden" value = "<?php if($pemesan!="") echo $pemesan->id_pesanan; ?>"name = "idPesanan"  readonly/>
                                <button type="submit" class=" form-control btn btn-success ">Tambah Pesanan</button>
                            </div>
                        </form>
                        </div>
                        </div>
                        <div class="col-md-12">
                        <form role="form" action="<?php echo site_url('KasirController/cancelOrder'); ?>" method="post">
                        <input type="hidden" value = "<?php if($pemesan!="") echo $pemesan->id_pesanan; ?>"name = "idPesanan"  readonly/>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>No</th>
                                            <th>Nama Menu</th>
                                            <th>Jumlah</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $number = 1;
                                            foreach($listDetailMenu as $row)
                                            {

                                            if($number %2 == 0){
                                              echo "<tr>
                                                <td class='bg-info'><input type='checkbox' name='$row->id_detail_pesanan' value='$row->id_detail_pesanan'/></td>
                                                <td class='bg-info'>".$number."</td>
                                                <td class='bg-info'>".$row->nama_menu."</td>
                                                <td class='bg-info'>".$row->jumlah."</td>
                                              </tr>";
                                            }else{
                                              echo "<tr>
                                              <td class='bg-warning'><input type='checkbox' name='$row->id_detail_pesanan' value='$row->id_detail_pesanan'/></td>
                                                <td class='bg-warning'>".$number."</td>
                                                <td class='bg-warning'>".$row->nama_menu."</td>
                                                <td class='bg-warning'>".$row->jumlah."</td>
                                              </tr>";
                                            }
                                                $number++;
                                            }
                                          ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <button type="submit" class=" form-control btn btn-success ">BATAL</button>
                        </div>
                        </form>
                    </div>
                     <!-- End  Kitchen Sink -->
                </div>
                </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
            </div>
             <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
       