         <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                <form role="form" action="<?php echo site_url('KasirController/bayar'); ?>" method="post">
                <div class = "col-md-12">
                    <div class="col-md-12">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                Data Pemesan
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Pemesan</label>
                                    <input class="form-control" name = "namaPemesan"  value = "<?php if($pemesan!="") echo $pemesan->nama_pemesan; ?>" readonly/>
                                    <input type="hidden" name = "idPesanan"  value = "<?php if($pemesan!="") echo $pemesan->id_pesanan; ?>" readonly/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Pesanan</label>
                                    <input class="form-control" name = "tanggalPesanan" value= "<?php if($pemesan!="") echo date('d/m/Y',strtotime($pemesan->date_pesanan)); ?>" readonly/>
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
                        <form role="form" action="<?php echo site_url('KasirController/cancelOrder'); ?>" method="post">
                        <input type="hidden" value = "<?php if($pemesan!="") echo $pemesan->id_pesanan; ?>"name = "idPesanan"  readonly/>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Menu</th>
                                            <th>Jumlah</th>
                                            <th>Total</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $number = 1;
                                            $subTotal = 0;
                                            foreach($listDetailMenu as $row)
                                            {
                                            $amountPerMenu = ($row->jumlah) * ($row->harga_jual);
                                            $subTotal = $subTotal + $amountPerMenu;
                                            if($number %2 == 0){
                                              echo "<tr>
                                                <td class='bg-info'>".$number."</td>
                                                <td class='bg-info'>".$row->nama_menu."</td>
                                                <td class='bg-info'>".$row->jumlah."</td>
                                                <td class='bg-info'>".$amountPerMenu."</td>
                                              </tr>";
                                            }else{
                                              echo "<tr>
                                                <td class='bg-warning'>".$number."</td>
                                                <td class='bg-warning'>".$row->nama_menu."</td>
                                                <td class='bg-warning'>".$row->jumlah."</td>
                                                <td class='bg-warning'>".$amountPerMenu."</td>
                                              </tr>";
                                            }
                                                $number++;
                                            }
                                          ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-12">
                           
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label >Sub Total :</label>
                                        <input class="form-control" type="text" name="subTotal" value = "<?php if($subTotal!="") echo $subTotal; ?>"name = "idPesanan"  readonly/>
                                    </div>
                                    <div class="form-group">
                                        <label>PPN :</label>
                                        <input class="form-control" type="text" value = "10%" name = "ppn"  readonly/>
                                    </div>
                                    <div class="form-group">
                                        <label>DISKON :</label>
                                        <input class="form-control" type="text" name = "diskon" />
                                    </div>
                                </div>
                            <button type="submit" class=" form-control btn btn-success ">BAYAR</button>
                            </div>
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
       