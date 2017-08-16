 
           

        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                 <div class="row">
                    <div class="col-md-12">
                     <div class="panel panel-default">
                        <div class="panel-heading">
                            DATA SALES HARIAN
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                   <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                  <tr>
                                    <th>NO</th>
                                    <th>TANGGAL</th>
                                    <th>TOTAL SALES</th>
                                    
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $nomor=1;
                                  for($i = 0; $i<sizeof($listSales); $i++)
                                  {
                                  if($nomor%2){
                                    echo "<tr>
                                      <td class='warning'>".$nomor."</td>
                                      <td class='warning'>".strftime("%d/%m/%Y",strtotime($listSales[$i]->date_pesanan))."</td>
                                      <td class='warning'> Rp. ".number_format($listSales[$i]->sales_harian,2,",",".")."</td>
                                      
                                    </tr>";
                                  }else{
                                    echo "<tr>
                                      <td class='warning'>".$nomor."</td>
                                      <td class='warning'>".strftime("%d/%m/%Y",strtotime($listSales[$i]->date_pesanan))."</td>
                                      <td class='warning'> Rp. ".number_format($listSales[$i]->sales_harian,2,",",".")."</td>
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
                    </div>
                    </div>
                </div>
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
       