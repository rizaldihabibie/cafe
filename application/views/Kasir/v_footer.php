 </div>
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.js"></script>
            <!-- <script src="<?php echo base_url(); ?>assets/js/morris/morris.js"></script> -->

     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
      <!-- BOOTSTRAP SCRIPTS -->
	 <script src="<?php echo base_url(); ?>assets/js/metisMenu.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
	  <script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    
    <script src="<?php echo base_url(); ?>assets/js/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/morris/raphael-2.1.0.min.js"></script>
      <!-- CUSTOM SCRIPTS -->
      <script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.js"></script>
     <script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.js"></script>
      <script>
      $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
	$(document).ready(function() {
        $('#dataTables-example2').DataTable({
            responsive: true
        });
    });
	
      $(document).ready(function(){
      var date_input=$('input[name="tanggalPesanan"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        language: 'id',
        format: 'dd MM yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
      function Timer() {
         var dt=new Date()
         document.getElementById('time').innerHTML=dt.getHours()+":"+dt.getMinutes()+":"+dt.getSeconds()+"&nbsp;";
         setTimeout("Timer()",1000);
      }
      window.onload = function() {
        Timer();
      };
    </script>
   
</body>
</html>
