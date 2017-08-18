 </div>
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

    <script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/metisMenu.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/metisMenu.min.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.id.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/morris/raphael-2.1.0.min.js"></script>
      <!-- CUSTOM SCRIPTS -->
    
    <script src="<?php echo base_url(); ?>assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.js"></script>
    
    <script type="text/javascript">
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });

      $(document).ready(function(){
      var date_input=$('input[name="tanggalPesanan"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
       
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
    </script>
</body>
</html>
