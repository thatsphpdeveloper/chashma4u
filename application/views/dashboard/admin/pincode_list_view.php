<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->
    
    <?php $this->load->viewD('inc/sidebar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <div class ="row">
             
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Pincode List <a href="<?=DASHURL.'/'.$this->sessDashboard?>/zone/addpincode" class="btn btn-success pull-right">Add Pincode</a></h4>                    
                    <div class="table-responsive">
                      <table class="table table-striped" id="tableDataList">
                        <thead>
                          <tr>
                            <th>Zone Name</th>
                            <th>Pin code</th>
                            <th>Delivery Type</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div> 
        </div>
        <!-- content-wrapper ends -->

        <?php  $rolePermission = $this->common_lib->checkrolePermission(['can_manage_all_pincode','can_edit_pincode'],0);
          if($rolePermission['valid']){ ?>
            <!-- assign Vendor Model-->
            <div id="copyPincodeModel" class="modal fade" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <form onsubmit="copyPincode(this, event)">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="email">New Pincode:</label>
                        <input type="number" class="form-control" name="pincode" value="" min="0" required>
                      </div>
                      <h6 class="msg"></h6>
                      <input type="hidden" name="action" value="copyPincode">
                      <input type="hidden" name="pincodeId" value="0">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary">Copy Pincode</button>
                    </div>
                  </form>
                </div>

              </div>
            </div>
          <?php } ?>

        <!-- partial:partials/_footer.html -->
<?php $this->load->viewD('inc/footer.php'); ?>
        <script type="text/javascript">
          $(document).on('click','.copyPincodeBtn', function(){
            $('#copyPincodeModel').modal('show');
            $('#copyPincodeModel').find("input[name=pincodeId]").val($(this).data('pincode-id'));
          });
        </script>