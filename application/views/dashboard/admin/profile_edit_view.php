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
                        <h4 class="card-title">Edit Profile</h4>
                        <p class="card-description">
                        </p>
                        <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateProfile(this, event);">
                          <p class="msg"></p>
                          <div class="form-group">
                            <label for="employeeName">Employee Name</label>
                            <input type="text" class="form-control firstinput" id="employeeName" name="employeeName" placeholder="Enter employee name" value="<?=isset($employeeData->employeeName)?$employeeData->employeeName:'';?>" required>
                          </div>
                          <div class="form-group">
                            <label for="email">Email ID</label>
                            <input type="text" class="form-control " id="email" name="email" placeholder="Enter email id" value="<?=isset($employeeData->email)?$employeeData->email:'';?>" required>
                          </div>
                          <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="text" class="form-control " id="mobile" name="mobile" placeholder="Enter mobile" value="<?=isset($employeeData->mobile)?$employeeData->mobile:'';?>" required>
                          </div>
                          <div class="form-group">
                            <label for="uploadIcons">Upload Image</label>
                            <input type="file" name="uploadIcons" id="uploadIcons" value="" onchange="fileuploadpreview(this)" <?=(isset($employeeData->img) && !empty($employeeData->img))?'':'required';?>>
                            <div class="previewimg"><?=(isset($employeeData->img) && !empty($employeeData->img))?'<img src="'.$employeeData->img.'" width="70px" height="50px">':'';?></div> 
                          </div>
                          <input type="hidden" name="action" value="editProfile">
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

