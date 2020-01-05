<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->
<?php $this->load->viewD('inc/sidebar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class ="row">
            <div class="col-md-12 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Change Password</h4>
                      <p class="card-description">
                      </p>
                      <form method="POST" action="#" id="change-password" role="form" enctype="multipart/form-data" onsubmit="ChangeAdminUserPassword(this,event,'.btntext');">
                        <div class="col-md-12">
                          <h2 class="msg"></h2>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="email">Current password</label>
                            <div class="col-md-8">
                              <input type="password" class="form-control" id="form_current_password" name="form_current_password"  required="required">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="name">New password</label>
                            <div class="col-md-8">
                              <input type="password" class="form-control" id="form_password_1" name="password_1" required="required" minlength="6" maxlength="10">
                              <span id="passwordlength" style="color: #c73232;font-weight: bold;"></span>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="group">Confirm new password</label>
                            <div class="col-md-8">
                              <input type="password" class="form-control"  id="form_password_2" name="password_2" required="required">
                              <span id="passwordlength" style="color: #c73232;font-weight: bold;"></span>
                              <input name="action" value="update_login_password" type="hidden">
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group row">
                            <label class="col-md-4 col-form-label" for="group"></label>
                            <div class="col-md-8">
                              <button type="button" class="btn btn-primary validate-change-password btntext"><i class='fa fa-fw fa-lg fa-check-circle' ></i><span class="btntext">Submit</span></button>
                              <button class="btn btn-default" type="reset" onclick="window.location.href='<?php echo DASHURL.'/admin/welcome'; ?>'">
                                <i class='fa fa-fw fa-lg fa-times-circle'></i>Cancel
                              </button>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-10 col-md-offset-2">
                          </div>
                        </div>
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

