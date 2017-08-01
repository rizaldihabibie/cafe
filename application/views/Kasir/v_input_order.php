         <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <form role="form" action="<?php echo site_url('KasirController/savePesanan'); ?>" method="post">
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Kategori
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Jenis Makanan</label>
                                <select class="form-control" id="kategoriMakanan" name = "namaKategori" onChange="showMenu()">
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
                                <select class="form-control" id="kategoriMinuman" name = "kategoriMinuman" onChange="showMenu()">
                                <option value="0-0">-- Minuman --</option>
                                <?php 
                                    foreach($listKategoriMinuman as $row){
                                        echo '<option value="'.$row->id_jenis_makanan.'">'.$row->nama_jenis_makanan.'</option>';
                                    }
                                ?>
                                 </select>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Daftar Menu
                                </div>
                                <div class="panel-body">
                                <div class="table-responsive">
                                    <table id="tabel"  class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Menu</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bookMenu">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                            <button type="button" id="buttonAdd" class=" form-control btn btn-success " onclick = "addOrder()">TAMBAH PESANAN</button>
                            
                        </div>
                        
                    </div>
                     </form>
                </div>
                <br>
                <br>
                <div class="row">
                    <form role="form" action="<?php echo site_url('KasirController/savePesanan'); ?>" method="post">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Daftar Pesanan
                                </div>
                                <div class="panel-body">
                                <div class="table-responsive">
                                    <table id="tabelOrder"  class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Menu</th>
                                                <th>Jumlah</th>
                                                <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody id="listOrder">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                            <button type="button" id="buttonAdd" class=" form-control btn btn-success " onclick = "addOrder()">SIMPAN PESANAN</button>
                            
                        </div>
                        
                    </div>
                     </form>
                </div>
                 <!-- /. ROW  -->
                 <hr />
            </div>
             <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
        
<script type="text/Javascript">
var order = [];
function showMenu(){
    var e = document.getElementById("kategoriMakanan");
    var f = document.getElementById("kategoriMinuman");

    var idKategori;
    if(e.options[e.selectedIndex].value != "0-0"){
        idKategori = e.options[e.selectedIndex].value;
    }else{
        idKategori = f.options[f.selectedIndex].value;
    }
    // console.log(idKategori);
    var myTable = document.getElementById('tabel');
    while(myTable.rows.length > 1) {
      myTable.deleteRow(1);
    }
    var obj = <?php echo json_encode($menuArray); ?>;
    var x;
    var indexRow = 1;

    x = document.getElementById('bookMenu').insertRow(0);
    x.insertCell(0);
    x.insertCell(1);
    x.insertCell(2);
    for (var i = 0; i < obj.length; i++) {
        if(obj[i][2]==idKategori){
            x = document.getElementById('bookMenu').insertRow(indexRow);
            x.insertCell(0);
            x.insertCell(1);
            x.insertCell(2);
            indexRow++;
        }
    }

    indexRow = 1;

    for (var i = 0; i < obj.length; i++) {
        if(obj[i][2]==idKategori){
            myTable.rows[indexRow].cells[0].innerHTML = obj[i][0];
            myTable.rows[indexRow].cells[1].innerHTML = obj[i][1];
            var input = document.createElement("input");
            input.type = "text";
            input.id = obj[i][0];
            input.value = "0";
            input.name = obj[i][0];
            input.className = "form-controlg"; // set the CSS class
            myTable.rows[indexRow].cells[2].appendChild(input); 
            indexRow++;
        }
        
    }

    e.selectedIndex = 0;
    f.selectedIndex = 0;

  }

function addOrder() {
    var obj = <?php echo json_encode($menuArray); ?>;
    var listInput = null;
    var jml = 0;

    var index = order.length;
    for (var i = 0; i < obj.length; i++) {
        listInput = document.getElementById(obj[i][0]);
        if(listInput != null){
            if(listInput.value){
                if(listInput.value !== "0"){
                    var arr1 = [obj[i][0],obj[i][1],listInput.value];
                    order [index] = arr1;
                    index++;
                }
            }
        }

    }
    // console.log(order.length);
    var myTable = document.getElementById('tabelOrder');
    while(myTable.rows.length > 1) {
      myTable.deleteRow(1);
    }
    var x;
    var indexRow = 1;
    
    x = document.getElementById('listOrder').insertRow(0);
    x.insertCell(0);
    x.insertCell(1);
    x.insertCell(2);
    x.insertCell(3);

    for (var i = 0; i < order.length; i++) {
            x = document.getElementById('listOrder').insertRow(indexRow);
            x.insertCell(0);
            x.insertCell(1);
            x.insertCell(2);
            x.insertCell(3);
            indexRow++;
    }
    var indexRow = 1;
    for (var i = 0; i < order.length; i++) {
            myTable.rows[indexRow].cells[0].innerHTML = indexRow;
            myTable.rows[indexRow].cells[1].innerHTML = order[i][1]; 
            myTable.rows[indexRow].cells[2].innerHTML = order[i][2];
            var input = document.createElement("button");
            input.type = "button";
            input.id = indexRow;
            input.innerHTML = "X";
            input.name = "buttonRemove";
            input.className = "form-control  btn btn-danger"; // set the CSS class
            myTable.rows[indexRow].cells[3].appendChild(input);
            indexRow++;
    }
 }
 
</script>
       