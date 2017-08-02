 <style>



.toggle-btn-grp { 
    margin:3px 0; 
}
.toggle-btn { 
    text-align:centre; 
    margin:5px 2px;
    padding:0.4em 3em; 
    color:#000; 
    background-color:#FFF; 
    border-radius:10px; 
    display:inline-block; 
    border:solid 1px #CCC; 
    cursor:pointer;
}

.toggle-btn-grp.joint-toggle .toggle-btn { 
    margin:5px 0; 
    padding:0.4em 2em; 
    border-radius:0;
    border-right-color:white;
}
.toggle-btn-grp.joint-toggle .toggle-btn:first-child { 
    margin-left:2px; 
    border-radius: 10px 0px 0px 10px; 
}
.toggle-btn-grp.joint-toggle .toggle-btn:last-child { 
    margin-right:2px;  
    border-radius: 0px 10px 10px 0px;
    border-right:solid 1px #CCC;
}


.toggle-btn:hover { 
    border:solid 1px #a0d5dc !important; 
    background:#f1fdfe;
}


.toggle-btn.success { 
    background:lightgreen;
    border:solid 1px green !important; 
}


.visuallyhidden { 
    border: 0; 
    clip: rect(0 0 0 0); 
    height: 1px; 
    margin: -1px; 
    overflow: hidden; 
    padding: 0; 
    position: absolute; 
    width: 1px; 
}
.visuallyhidden.focusable:active, .visuallyhidden.focusable:focus { 
    clip: auto; 
    height: auto; 
    margin: 0; 
    overflow: visible; 
    position: static; 
    width: auto; 
}


/* CSS only version */
.toggle-btn-grp.cssonly * {
    width:80px;
    height:30px;
    line-height:30px;
}
.toggle-btn-grp.cssonly div {
    display:inline-block;
    position:relative;
    margin:5px 2px;
}

.toggle-btn-grp.cssonly div label {
    position:absolute;
    z-index:0;
    padding:0;
    text-align:center;
}

.toggle-btn-grp.cssonly div input {
    position:absolute;
    z-index:1;
    cursor:pointer;
    opacity:0;
}

.toggle-btn-grp.cssonly div:hover label {
    border:solid 1px #a0d5dc !important; 
    background:#f1fdfe;
}

.toggle-btn-grp.cssonly div input:checked + label {
    background:lightgreen;
    border:solid 1px green !important; 
}

.toggle-btn-grp.cssonly div input:disabled + label {
	
    background:red;
    border:solid 1px red !important; 
	
}

.toggle-btn-grp.cssonly.shaon div input:disabled + label {
	
    background:yellow;
    border:solid 1px red !important; 
	
}
.toggle-btn-grp.cssonly.reserved div input:disabled + label {
	
    background:blue;
    border:solid 1px green !important; 
	
}





</style>   
           
   
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <div class="panel panel-default">
                        <div class="panel-heading">
                            Tambah Menu Makanan
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                 <form method="post" action="books.php">
                                   <table border=0 width='100%'>			
				                     <tr>
                                      <td>  <div class="pull-right">Pilih Meja Kemudian Tekan Selanjutnya.<br><input type="submit" class="btn btn-lg btn-success btn-block" value="Selanjutnya"/></div></td>
                                     </tr>
                                   </table> 
                                 <br><br><br>

                                <div class="col-md-6">
                                  
                                 
                                  <table  border='0'  width='100%' cellspacing='0' cellpadding='0'>
                                  <tr>
                                  <td> 
                                   <table  border='0'  width='100%' cellspacing='0' cellpadding='0'>
                                      <tr><td><h2>LANTAI 1</h2></td></tr>
                                    </table>
                                    <table  border='0'  width='100%' cellspacing='0' cellpadding='0'>
                                  <tr><BR><BR><br> <br>
                                   <?php
                                        foreach($listMeja1 as $row1)
                                              {
                                        if($row1->status == "1"){
                                    ?>
                                  <td> 
                                    <div class="toggle-btn-grp cssonly shaon" id="no_meja"> 
	                                  <div><input type="checkbox" name="meja[]" value=<?php echo $row1->no_meja ?> disabled/>
	                                    <label onclick=\"\" class="toggle-btn" ><?php echo $row1->no_meja ?></label>
	                                  </div>
                                    </div>
                                   </td>
                                   <?php
                                       }
                                       else if ($row1->status == "0"){
                                      //     echo $row1->no_meja;
                                   ?>
                                   <td>
                                  <div class="toggle-btn-grp cssonly" id="no_meja">  
	                                 <div><input type="checkbox" name="meja[]" value=<?php echo $row1->no_meja ?> />
	                                  <label onclick=\"\" class="toggle-btn" > <?php echo $row1->no_meja; ?></label>
	                                </div>
                                 </div>
                                 
                                 </td>
                                 <?php
                                       }
                                           else if ($row1->status == "2"){
                                      //     echo $row1->no_meja;      
                                 ?>
                                    <td>
                                  <div class="toggle-btn-grp cssonly reserved" id="no_meja">  
	                                 <div><input type="checkbox" name="meja[]" value=<?php echo $row1->no_meja ?> />
	                                  <label onclick=\"\" class="toggle-btn" > <?php echo $row1->no_meja; ?></label>
	                                </div>
                                 </div>
                                 
                                 </td>
                                   <?php
                                           }
                                        } 
                                   ?>

                                   </tr>
                                   <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                   <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                   <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                   <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                   <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                   </table>
                                   </td>
                                   <!-- akhir td lantai !-->
                                  
                                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <!-- baris kosong antara lantai 1 dan 2-->

                                    <td> 
                                   <table  border='0'  width='100%' cellspacing='0' cellpadding='0'>
                                      <tr><td><h2>LANTAI 2</h2></td></tr>
                                    </table>
                                    <table  border='0'  width='100%' cellspacing='0' cellpadding='0'>
                                  <tr><BR><BR><br> <br>
                                   <?php
                                    $no=1;
                                        foreach($listMeja2 as $row2)
                                              {
                                        if($no%5 == 0)
                                          {
                                            echo '</tr><tr>';  
                                        if($row2->status == "1"){
                                    ?>
                                  <td> 
                                    <div class="toggle-btn-grp cssonly shaon" id="no_meja"> 
	                                  <div><input type="checkbox" name="meja[]" value=<?php echo $row2->no_meja ?> disabled/>
	                                    <label onclick=\"\" class="toggle-btn" ><?php echo $row2->no_meja ?></label>
	                                  </div>
                                    </div>
                                   </td>
                                   <?php
                                       }
                                       else if ($row2->status == "0"){
                                      //     echo $row1->no_meja;
                                   ?>
                                   <td>
                                  <div class="toggle-btn-grp cssonly" id="no_meja">  
	                                 <div><input type="checkbox" name="meja[]" value=<?php echo $row2->no_meja ?> />
	                                  <label onclick=\"\" class="toggle-btn" > <?php echo $row2->no_meja; ?></label>
	                                </div>
                                 </div>
                                 </td>
                                 <?php
                                       } 
                                         else if ($row2->status == "2"){    
                                            
                                    ?>
                                   <td>
                                  <div class="toggle-btn-grp cssonly reserved" id="no_meja">  
	                                 <div><input type="checkbox" name="meja[]" value=<?php echo $row2->no_meja ?> />
	                                  <label onclick=\"\" class="toggle-btn" > <?php echo $row2->no_meja; ?></label>
	                                </div>
                                 </div> 
                                 </td>
                                  <?php
                                         }
                                    } 
                                       
                                          else if($no%5 != 0)
                                          {
                                           if($row2->status == "1"){     
                                ?>
                                 <td> 
                                    <div class="toggle-btn-grp cssonly shaon" id="no_meja"> 
	                                  <div><input type="checkbox" name="meja[]" value=<?php echo $row2->no_meja ?> disabled/>
	                                    <label onclick=\"\" class="toggle-btn" ><?php echo $row2->no_meja ?></label>
	                                  </div>
                                    </div>
                                   </td>
                                   <?php
                                       }
                                       else if ($row2->status == "0"){
                                      //     echo $row1->no_meja;
                                   ?>
                                   <td>
                                  <div class="toggle-btn-grp cssonly" id="no_meja">  
	                                 <div><input type="checkbox" name="meja[]" value=<?php echo $row2->no_meja ?> />
	                                  <label onclick=\"\" class="toggle-btn" > <?php echo $row2->no_meja; ?></label>
	                                </div>
                                 </div>
                                 </td> 
                                <?php
                                       }
                                      else if($row2->status == "2"){ 
                                   ?>
                                   <td>
                                  <div class="toggle-btn-grp cssonly reserved" id="no_meja">  
	                                 <div><input type="checkbox" name="meja[]" value=<?php echo $row2->no_meja ?> />
	                                  <label onclick=\"\" class="toggle-btn" > <?php echo $row2->no_meja; ?></label>
	                                </div>
                                 </div>
                                 </td> 
                                 <?php
                                      }    
                                          } // akhir %5 
                                       $no++;
                                              } // akhir foreach
                                 ?>
                                   </tr>
                                   </table>
                                   </td>
                                
                                </tr>
                              </table>
                                &nbsp;&nbsp; 

                            </div>
                        </div>
                    </div> 
                    </div>
                </form> 
                </div><!--akhir form--> 
                 <!-- /. ROW  -->
                 <hr />
            </div>
             <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
       