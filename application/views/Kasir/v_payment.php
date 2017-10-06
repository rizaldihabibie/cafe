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
                            <div class="col-md-12">
                                <div class="col-md-4">
                                <?php if($this->session->flashdata('error')): ?>
                                  <div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                 <div class="fa fa-info-circle"></div>&nbsp;<?php echo $this->session->flashdata('error'); ?>
                                              </div>
                                  <?php endif; ?>
                                    <div class="form-group">
                                        <label>waitress</label>
                                        <input class="form-control" name = "namaWaitress"  value = "<?php if($waitress!="") echo $waitress->nama_user; ?>" readonly/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
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
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label >Sub Total :</label>
                                        <input class="form-control" type="text" id="subTotal" name="subTotal" value = "<?php if($subTotal!="") echo $subTotal; ?>" name = "idPesanan"  readonly/>
                                    </div>
                                    <div class="form-group">
                                        <label>DISKON :</label>
                                        <input class="form-control" type="text" id="diskon" onChange = "countDiskon()" name = "diskon" />
                                    </div>
                                    <div class="form-group">
                                        <label>Grand Total :</label>
                                        <input class="form-control" type="text" value = "<?php if($subTotal!="") echo $subTotal; ?>" id="grandTotal" name = "grandTotal" readonly />
                                    </div>
                                    <div class="form-group">
                                      <div class="radio">
                                        <label>
                                            <input type="radio" name="paymentOption" id="cash" value="CASH" onClick='selectPayment()' checked>Tunai
                                        </label>
                                        <label>
                                            <input type="radio" name="paymentOption" id="debit" value="DEBIT" onClick='selectPayment()'>Debit
                                        </label>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Kartu :</label>
                                        <input class="form-control" type="text" id="cardNumber" name = "cardNumber" required/>
                                    </div>
                                    <div class="form-group">
                                        <label>Tunai :</label>
                                        <input class="form-control" type="text" onChange = "countChange()" id="tunai" name = "tunai" required/>
                                    </div>
                                    <div class="form-group">
                                        <label>Kembali :</label>
                                        <input class="form-control" type="text" id = "kembalian" name = "kembalian" readonly />
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
<script>
    var rad = document.myForm.paymentO;
    var prev = null;
    for(var i = 0; i < rad.length; i++) {
        rad[i].onclick = function() {
            (prev)? console.log(prev.value):null;
            if(this !== prev) {
                prev = this;
            }
            console.log(this.value)
        };
    }
</script>

<script type="text/Javascript">
      window.onload = selectPayment();
      function selectPayment(){
        if (document.getElementById("cash").checked == true) {
          document.getElementById("cardNumber").disabled = true; 
          document.getElementById("tunai").readOnly = false; 
          document.getElementById('tunai').value = '';
          document.getElementById('kembalian').value = '';
        }else{
          document.getElementById("cardNumber").disabled = false; 
        }

        if (document.getElementById("debit").checked == true) {
          
          document.getElementById("cardNumber").disabled = false; 
          document.getElementById('tunai').value = document.getElementById('grandTotal').value;
          document.getElementById("tunai").readOnly = true; 
          countChange();
        }else{
          document.getElementById("tunai").readOnly = false; 
          document.getElementById("cardNumber").disabled = true; 
        }
      }
      function countDiskon() {
       var diskon = document.getElementById('diskon').value;
       diskon = diskon.replace('%','');
       var subTotal = document.getElementById('subTotal').value;
       var total = subTotal-((diskon/100)*subTotal);
       total = total.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
       document.getElementById('grandTotal').value = total;
      }

      function countChange(){
       var tunai = document.getElementById('tunai').value;
       tunai = tunai.replace('.','');
       var grandTotal = document.getElementById('grandTotal').value;
       grandTotal = grandTotal.replace('.','');
       var kembalian = tunai - grandTotal;
       kembalian = kembalian.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
       tunai = tunai.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
       document.getElementById('kembalian').value = kembalian;
       document.getElementById('tunai').value = tunai;
      }

      function numberWithCommas(name) {
        var numb = document.getElementById(""+name).value
        var result = numb.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        $('input[name="'+name+'"]').val(result).val();
      }
</script>
       