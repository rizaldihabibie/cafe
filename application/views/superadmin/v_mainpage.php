 
           

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
                                <div class="col-md-12">
                                   <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                  <tr>
                                     <th>NO</th>
                                    <th>TANGGAL</th>
                                    <th>SALES QTY</th>
                                    <th>SALES BRUTO</th>
                                    <th>DISCOUNT</th>
                                    <th>NET SALES</th>
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
                                       <td class='warning'>".$listSales[$i]->jml_pesanan."</td>
                                      <td class='warning'> Rp. ".number_format($listSales[$i]->sales_harian,2,",",".")."</td>";
                                    
                                      if(($listDiskon[$i]->tot_dis == NULL) && ($listDiskon[$i]->diskonan == NULL) )
                                       {
                                       $diskon=0;
                                       }
                                       else
                                       {
                                        $diskon=$listDiskon[$i]->diskonan; 
                                       }
                                        $net_sales=$listSales[$i]->sales_harian-$diskon;
                                    echo
                                    "<td class='warning'>Rp. ".number_format($diskon,2,",",".")."</td>
                                     <td class='warning'>Rp. ".number_format($net_sales,2,",",".")."</td>  
                                    </tr>";
                                  }else{
                                    echo "<tr>
                                      <td class='info'>".$nomor."</td>
                                      <td class='info'>".strftime("%d/%m/%Y",strtotime($listSales[$i]->date_pesanan))."</td>
                                        <td class='info'>".$listSales[$i]->jml_pesanan."</td>
                                      <td class='info'> Rp. ".number_format($listSales[$i]->sales_harian,2,",",".")."</td>";
                                       if(($listDiskon[$i]->tot_dis == NULL) && ($listDiskon[$i]->diskonan == NULL) )
                                       {
                                       $diskon=0;
                                       }
                                       else
                                       {
                                        $diskon=$listDiskon[$i]->diskonan; 
                                       }
                                        $net_sales=$listSales[$i]->sales_harian-$diskon;
                                    echo
                                    "<td class='info'>Rp. ".number_format($diskon,2,",",".")."</td>
                                     <td class='info'>Rp. ".number_format($net_sales,2,",",".")."</td>  
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
                    <div class="col-md-12">
                     <div class="panel panel-default">
                        <div class="panel-heading">
                        <?php
                        $akhir=date("Y/m/d");
                        $akhir=strftime("%d/%m/%Y",strtotime($akhir));
                        $awal= date('Y/m/d', strtotime("-30 days"));
                        $awal=strftime("%d/%m/%Y",strtotime($awal));
                        ?>
                            MAKANAN MINUMAN TERLARIS periode <?php echo $awal.' - '.$akhir; ?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                   <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                <thead>
                                  <tr>
                                     <th>NO</th>
                                    <th>MAKANAN</th>
                                    <th>QTY</th>
                                  
                                    
                                  </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $nomor=1;
                                  for($i = 0; $i<sizeof($listFavMakanan); $i++)
                                  {
                                   
                                  if($nomor%2){
                                    echo "<tr>
                                      <td class='warning'>".$nomor."</td>
                                      <td class='warning'>".$listFavMakanan[$i]->nama_menu."</td>
                                       <td class='warning'>".$listFavMakanan[$i]->jml."</td>
                                       
                                    </tr>";
                                  }else{
                                    echo "<tr>
                                       <td class='info'>".$nomor."</td>
                                      <td class='info'>".$listFavMakanan[$i]->nama_menu."</td>
                                       <td class='info'>".$listFavMakanan[$i]->jml."</td>
                                      
                                    </tr>";
                                    
                                  }
                                    $nomor++;
                                  }
                                  
                                ?>
                                </tbody>
                            </table>                                 
                                </div>

                                           <div class="col-md-6">
                                   <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                <thead>
                                  <tr>
                                     <th>NO</th>
                                    <th>MINUMAN</th>
                                    <th>QTY</th>
                                  
                                    
                                  </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $nomor=1;
                                  for($i = 0; $i<sizeof($listFavMinuman); $i++)
                                  {
                                   
                                  if($nomor%2){
                                    echo "<tr>
                                      <td class='warning'>".$nomor."</td>
                                      <td class='warning'>".$listFavMinuman[$i]->nama_minum."</td>
                                       <td class='warning'>".$listFavMinuman[$i]->jml2."</td>
                                       
                                    </tr>";
                                  }else{
                                    echo "<tr>
                                       <td class='info'>".$nomor."</td>
                                      <td class='info'>".$listFavMinuman[$i]->nama_minum."</td>
                                       <td class='info'>".$listFavMinuman[$i]->jml2."</td>
                                      
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
       