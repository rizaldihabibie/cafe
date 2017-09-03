         <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                  <!--   Kitchen Sink -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Daftar Pemesan
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>No Meja</th>
                                            <th>Nama Pemesan</th>
                                            <th>#</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $number = 1;
                                            foreach($listOrder as $row)
                                            {
                                            $date = date('d/m/Y',strtotime($row->date_pesanan));
                                            if($number %2 == 0){
                                              echo "<tr>
                                                <td class='bg-danger'>".$number."</td>
                                                <td class='bg-danger'>".$date."</td>
                                                <td class='bg-danger'>".$row->no_meja."</td>
                                                <td class='bg-danger'>".$row->nama_pemesan."</td>
                                                <td class='bg-danger'><a href = 'detailPesanan/$row->id_pesanan'>DETAIL</a></td>
                                                <td class='bg-danger'><a href = 'paymentPage/$row->id_pesanan'>BAYAR</a></td>
                                              </tr>";
                                            }else{
                                              echo "<tr>
                                                <td class='bg-success'>".$number."</td>
                                                <td class='bg-success'>".$date."</td>
                                                  <td class='bg-danger'>".$row->no_meja."</td>
                                                <td class='bg-success'>".$row->nama_pemesan."</td>
                                                <td class='bg-success'><a href = 'detailPesanan/$row->id_pesanan'>DETAIL</a></td>
                                                <td class='bg-success'><a href = 'paymentPage/$row->id_pesanan'>BAYAR</a></td>
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
                     <!-- End  Kitchen Sink -->
                </div>
                
                </form>
                </div>
                 <!-- /. ROW  -->
                 <hr />
            </div>
             <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
       