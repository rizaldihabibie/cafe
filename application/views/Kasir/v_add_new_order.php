         <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <form role="form" action="<?php echo site_url('KasirController/saveTable'); ?>" method="post">
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
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($listMeja as $row)
                                            {
                                            if($row->status == "DIPAKAI"){
                                              echo "<tr>
                                                <td class='bg-danger'>".$row->id_meja."</td>
                                                <td class='bg-danger'>".$row->status."</td>
                                                <td><input type='checkbox' name='$row->id_meja' value='$row->id_meja' disabled/></td>
                                              </tr>";
                                            }else{
                                              echo "<tr>
                                                <td class='bg-success'>".$row->id_meja."</td>
                                                <td class='bg-success'>".$row->status."</td>
                                                <td><input type='checkbox' name='$row->id_meja' value='$row->id_meja'/></td>
                                              </tr>";
                                            }
                                       
                                            }
                                          ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                     <!-- End  Kitchen Sink -->
                </div>
                <button type="submit" class=" form-control btn btn-success ">MUTASI</button>
                </form>
                </div>
                 <!-- /. ROW  -->
                 <hr />
            </div>
             <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
       