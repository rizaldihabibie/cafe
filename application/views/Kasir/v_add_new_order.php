         <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    
                    <div class="col-md-12">
                  <!--   Kitchen Sink -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Data Meja
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $nomor = 1;
                                            foreach($listMeja as $row)
                                            {
                                            if($nomor%2){
                                              echo "<tr>
                                                <td class='warning'>".$row->id_meja."</td>
                                                <td class='warning'>Ready</td>
                                              </tr>";
                                            }else{
                                              echo "<tr>
                                                <td class='info'>".$row->id_meja."</td>
                                                <td class='info'>Ready</td>
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
       