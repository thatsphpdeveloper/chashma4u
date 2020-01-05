<?php $this->load->viewF("inc/header.php"); ?>
<!-- Profile Banner Section -->

    <div class="page-content">
        <div class="holder mt-0">
            <div class="container">
                <ul class="breadcrumbs">
                    <li><a href="<?=BASEURL?>">Home</a></li>
                    <li><span>My account</span></li>
                </ul>
            </div>
        </div>
        <div class="holder mt-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 aside aside--left">
                        <?php $this->load->viewF("user/sidebar.php"); ?>
                    </div>
                    <div class="col-md-9 aside">
                        <h2>Change Password</h2>
                        <div class="card mt-3 profile-form">
                            <div class="card-body">
                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                      <form onsubmit="changeUserPassword(this, event)">
                                        <div class="form-field-section">
                                          <div class="row">
                                              <div class="col-md-12">
                                                <div class="form-group">
                                                  <label>Current Password</label>
                                                  <input type="password" class="form-control" name="currentPassword" required>
                                                </div>
                                              </div>
                                              <div class="col-md-12">
                                                <div class="form-group">
                                                  <label>New Password</label>
                                                  <input type="password" class="form-control" name="password" required>
                                                </div>
                                              </div>
                                              <div class="col-md-12">
                                                <div class="form-group">
                                                  <label>Confirm Password</label>
                                                  <input type="password" class="form-control" name="confirmPassword" required>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="row mt-2">
                                              <div class="col-md-12">
                                                <div class="btn-section">
                                                  <button type="button" class="btn profile-edit-btn btn-update validate-password">Change Password</button>
                                                  <input type="hidden" name="action" value="changeUserPassword">
                                                </div>
                                              </div>

                                              <div class="col-md-12 msg"></div>
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
        </div>
    </div>
<!-- End View Profile Details Section -->
<?php $this->load->viewF("inc/footer.php"); ?>