<?php $this->load->viewF("inc/header.php"); ?>
<!-- Profile Banner Section -->
  <style type="text/css">
    .profile-img.preview-img img {
        width: 100px;
        border: 1px solid grey;
        margin: 5px 0;
        border-radius: 3px;
        padding: 1px;
        height: 80px;
    }
    select.form-control:not([size]):not([multiple]) {
      height: 100%;
  }
</style>
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
                        <h2>Account Details</h2>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h3>Personal Info</h3>
                                        <p><b>First Name:</b><?=(isset($userData->firstName))?$userData->firstName:'';?><br><b>Last Name:</b> <?=(isset($userData->lastName))?$userData->lastName:'';?><br><b>E-mail:</b> <?=(isset($userData->email))?$userData->email:'';?><br><b>Phone:</b> <?=(isset($userData->mobile))?$userData->mobile:'';?></p>
                                        <div class="mt-2 clearfix"><a href="javascript:" class="link-icn js-show-form" onclick="$('.profile-form').removeClass('hide')"><i class="icon-pencil"></i>Edit</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3 profile-form hide">
                            <div class="card-body">
                                <h3>Update Account Details</h3>
                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                      <form onsubmit="updateUserDetails(this, event)">
                                        <div class="form-field-section">
                                          <div class="row">
                                            <div class="col-md-12 msg"></div>
                                            <div class="col-md-6">
                                              <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" value="<?=(isset($userData->firstName))?$userData->firstName:'';?>" name="firstName" require>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" value="<?=(isset($userData->lastName))?$userData->lastName:'';?>" name="lastName" require>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="form-group">
                                                <label>Email Address</label>
                                                <input type="email" class="form-control" value="<?=(isset($userData->email))?$userData->email:'';?>" name="email" require>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="form-group">
                                                <label>Mobile Number</label>
                                                <input type="text" class="form-control" value="<?=(isset($userData->mobile))?$userData->mobile:'';?>" name="mobile" maxlength="12" onkeypress="return OnlyInteger()" require>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row">
                                            <div class="col-md-6">
                                              <div class="form-group">
                                                <label>Your Gender</label>
                                                <select class="form-control" name="gender">
                                                  <option value="Male" <?=(isset($userData->gender) && $userData->gender == 'Male')?'selected':'';?>>Male</option>
                                                  <option value="Female" <?=(isset($userData->gender) && $userData->gender == 'Female')?'selected':'';?>>Female</option>
                                                  <option value="Other" <?=(isset($userData->gender) && $userData->gender == 'Other')?'selected':'';?>>Other</option>
                                                </select>
                                              </div>
                                            </div>
                                            <div class="col-md-6">
                                              <div class="form-group">
                                                <label>Your Image</label>
                                                <input type="file" class="form-control" name="uploadImg" class="uploadImg" onchange="fileuploadpreview(this)">
                                                <div class="profile-img preview-img"><img src="<?=$userData->img?>" alt="User Image" class="thumbnail"></div>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="row">
                                            <div class="col-md-12">
                                              <div class="btn-section">
                                                <button type="button" class="btn profile-edit-btn btn-update validate-form">Update</button>
                                                <button type="button" class="btn btn-danger profile-cancel-btn" onclick="$('.profile-form').addClass('hide')">Cancel</button>
                                                <input type="hidden" name="action" value="updateUserDetails">
                                              </div>
                                            </div>
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