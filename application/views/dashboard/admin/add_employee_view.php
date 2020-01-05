<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->
<?php $this->load->viewD('inc/sidebar.php'); ?>
      <!-- partial -->
      <style type="text/css">
        .previewimg img {
          border: 1px solid black;
          padding: 1px;
          margin: 3px;
        }
      </style>
      <div class="main-panel">
        <div class="content-wrapper">
            <div class ="row">
              <div class="col-md-12 d-flex align-items-stretch grid-margin">
                <div class="row flex-grow">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Add Employee <a href="<?=DASHURL.'/'.$this->sessDashboard?>/employee/employeelist" class="btn btn-success pull-right">Employee List</a></h4>
                        <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateEmployee(this, event);">
                          <p class="msg"></p>
                          <div class="form-group">
                            <label for="vendorId">Employee Of:</label>
                            <select name="vendorId" id="employeeVendorId" class="form-control firstinput" required>
                              <option value="">Select Option</option>
                              <option value="0" <?=(isset($employeeData->vendorId) && $employeeData->vendorId == 0)?'selected':''?>>Admin</option>
                              <?php if (isset($vendorData) && !empty($vendorData)) {
                                foreach ($vendorData as $vendor) {
                                  echo '<option value="'.$vendor->vendorId.'" '.((isset($employeeData->vendorId) && $vendor->vendorId == $employeeData->vendorId)?'selected':'').'>'.$vendor->vendorName.'</option>';
                                }
                              }?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="roleId">Role:</label>
                            <select name="roleId" id="roleId" class="form-control" required>
                              <option value="">Select Role</option>
                              <?php if (isset($roleData) && !empty($roleData)) {
                                foreach ($roleData as $role) {
                                  echo '<option value="'.$role->roleId.'" '.((isset($employeeData->roleId) && $role->roleId == $employeeData->roleId)?'selected':'').'>'.$role->role.'</option>';
                                }
                              }?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="employeeName">Employee Name</label>
                            <input type="text" class="form-control" id="employeeName" name="employeeName" placeholder="Enter employee name" value="<?=isset($employeeData->employeeName)?$employeeData->employeeName:'';?>" required>
                          </div>
                          <div class="form-group">
                            <label for="email">Email ID</label>
                            <input type="text" class="form-control " id="email" name="email" placeholder="Enter email id" value="<?=isset($employeeData->email)?$employeeData->email:'';?>" required>
                          </div>
                          <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="text" class="form-control " id="mobile" name="mobile" placeholder="Enter mobile" value="<?=isset($employeeData->mobile)?$employeeData->mobile:'';?>" onkeypress="return OnlyInteger()" maxlength="10" required>
                          </div>
                          <div class="form-group">
                            <label for="uploadIcons">Upload Image</label>
                            <input type="file" name="uploadIcons" id="uploadIcons" value="" onchange="fileuploadpreview(this)" <?=(isset($employeeData->img) && !empty($employeeData->img))?'':'required';?>>
                            <div class="previewimg"><?=(isset($employeeData->img) && !empty($employeeData->img))?'<img src="'.$employeeData->img.'" width="70px" height="50px">':'';?></div> 
                          </div>



                          <?php if(!isset($employeeData->employeeId)){ ?>
                            <div class="form-group">
                              <label for="Password">Password </label>
                              <input type="password" class="form-control" value="" placeholder="Password" id="password" name="password" required>
                            </div>
                          <?php } ?>



                          <input type="hidden" name="action" value="addEmployee">
                          <input type="hidden" name="hiddenval" value="<?=isset($employeeData->employeeId)?$employeeData->employeeId:0;?>">
                          <input type="hidden" name="indexval" value="">
                          <button type="submit" class="btn btn-success mr-2 actionbtn">Submit</button>
                          <button type="button" class="btn btn-light">Cancel</button>
                        </form>
                      </div>
                    </div>
                  </div>                  
                </div>
              </div>
            </div> 
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->

<?php $this->load->viewD('inc/footer.php'); ?>

