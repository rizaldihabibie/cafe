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
                                <div class="col-md-6">
                                  <table  border='1'  width='50%' cellspacing='5' cellpadding='40'>
                                  <tr>
                                  <td> 
                                   LANTAI 1
                                     <table  border='1'  width='50%' cellspacing='0' cellpadding='0'>
                                  <tr>
                                  <td> 
                                    <div class="toggle-btn-grp cssonly shaon" id="no_meja"> 
	                                  <div><input type="checkbox" name="meja[]" value="table1" disabled/>
	                                    <label onclick=\"\" class="toggle-btn" >01</label>
	                                  </div>
                                    </div>
                                   </td>
                                   <td>
                                  <div class="toggle-btn-grp cssonly" id="no_meja"> 
	                                 <div><input type="checkbox" name="meja[]" value="table2" />
	                                  <label onclick=\"\" class="toggle-btn" >02</label>
	                                </div>
                                 </div>
                                 </td>
                                   </tr>
                                   </table>
                                   </td>
                                  
                                  <td>
                                  <div class="toggle-btn-grp cssonly" id="no_meja"> 
	                                 <div><input type="checkbox" name="meja[]" value="table3" />
	                                  <label onclick=\"\" class="toggle-btn" >03</label>
	                                </div>
                                 </div>
                                 </td>
                                  <td>
                                  <div class="toggle-btn-grp cssonly" id="no_meja"> 
	                                 <div><input type="checkbox" name="meja[]" value="table4" />
	                                  <label onclick=\"\" class="toggle-btn" >02</label>
	                                </div>
                                 </div>
                                 </td>
                                  <td>
                                  <div class="toggle-btn-grp cssonly" id="no_meja"> 
	                                 <div><input type="checkbox" name="meja[]" value="table5" />
	                                  <label onclick=\"\" class="toggle-btn" >02</label>
	                                </div>
                                 </div>
                                 </td>
                                </tr>
                              </table>
                            </div>
                        </div>
                    </div> 
                    </div>
                </div>
                 <!-- /. ROW  -->
                 <hr />
            </div>
             <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
       