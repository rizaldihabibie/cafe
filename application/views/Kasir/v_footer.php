 </div>
    <script src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.js"></script>
            <script src="<?php echo base_url(); ?>assets/js/morris/morris.js"></script>

     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    
    <script src="<?php echo base_url(); ?>assets/js/jquery.metisMenu.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/morris/raphael-2.1.0.min.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
    <script type="text/Javascript">
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
