<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->
    
    <?php $this->load->viewD('inc/sidebar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <div class ="row">
              <div class="col-md-4 d-flex align-items-stretch grid-margin">
                <div class="row flex-grow">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Add New Role</h4>
                        <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateRole(this, event);">
                          <p class="msg"></p>
                          <div class="form-group">
                            <label for="vendorId">Role Of:</label>
                            <select name="vendorId" id="vendorId" class="form-control firstinput" required>
                              <option value="">Select Option</option>
                              <option value="0">Admin</option>
                              <?php if (isset($vendorData) && !empty($vendorData)) {
                                foreach ($vendorData as $vendor) {
                                  echo '<option value="'.$vendor->vendorId.'" '.((isset($employeeData->vendorId) && $vendor->vendorId == $employeeData->vendorId)?'selected':'').'>'.$vendor->vendorName.'</option>';
                                }
                              }?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="role">Role</label>
                            <input type="text" class="form-control firstinput" id="role" name="role" placeholder="Enter role" required>
                          </div>
                          
                          <input type="hidden" name="action" value="addRole">
                          <button type="submit" class="btn btn-success mr-2 actionbtn">Submit</button>
                          <button class="btn btn-light">Cancel</button>
                        </form>
                      </div>
                    </div>
                  </div>                  
                </div>
              </div>
              <div class="col-lg-8 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Role List</h4>                    
                    <div class="table-responsive">
                      <table class="table" id="tableDataList">
                        <thead>
                          <tr>
                            <th>Role</th>
                            <th>Role Of</th>
                            <th>No. Of Employee</th>
                            <th>Create Date</th>
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
        <!-- partial:partials/_footer.html -->
<?php $this->load->viewD('inc/footer.php'); ?>