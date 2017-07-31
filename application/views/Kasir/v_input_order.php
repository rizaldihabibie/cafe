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
                            <button type="submit" class=" form-control btn btn-success ">SIMPAN PESANAN</button>
                            
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
        // console.log(obj[i][1]);
    }

    indexRow = 1;

    for (var i = 0; i < obj.length; i++) {
        if(obj[i][2]==idKategori){
            myTable.rows[indexRow].cells[0].innerHTML = obj[i][0];
            myTable.rows[indexRow].cells[1].innerHTML = obj[i][1];
            var input = document.createElement("input");
            input.type = "text";
            input.name = obj[i][0];
            input.className = "form-control"; // set the CSS class
            myTable.rows[indexRow].cells[2].appendChild(input); 
            indexRow++;
        }
        
    }

    e.selectedIndex = 0;
    f.selectedIndex = 0;

  }

  // function numberWithCommas(name) {
  //   var numb = document.getElementById(""+name).value
  //   var result = numb.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
  //   $('input[name="'+name+'"]').val(result).val();
  // }
 
</script>
       