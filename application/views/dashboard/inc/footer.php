        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © <?php echo date('Y');?>
              <a href="<?=BASEURL?>" target="_blank">Chashma4u</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
              <i class="mdi mdi-heart text-danger"></i>
            </span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="<?php echo base_url(); ?>system/static/dashboard/admin/vendors/js/vendor.bundle.base.js"></script>
  <script type="text/javascript" src="<?php echo DASHSTATIC; ?>/admin/js/plugins/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="<?php echo DASHSTATIC; ?>/admin/js/plugins/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo DASHSTATIC; ?>/admin/dist/summernote-bs4.js"></script>
  <script src="<?php echo base_url(); ?>system/static/dashboard/admin/js/validate.js"></script>
  <script src="<?php echo base_url(); ?>system/static/dashboard/admin/js/admin.js"></script>
  <?php echo (isset($footerScript) && !empty($footerScript)) ? $footerScript : '';?>
  <script src="<?php echo base_url(); ?>system/static/dashboard/admin/vendors/js/vendor.bundle.addons.js"></script>
   <script type="text/javascript">
    $(document).ready(function(e) {
    $('.aboutus, #aboutus').summernote({
      height: 100,
        
    });
    
  });


</script>
</body>

</html>