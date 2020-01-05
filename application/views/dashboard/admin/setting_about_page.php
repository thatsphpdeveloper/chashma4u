<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->

<?php $this->load->viewD('inc/sidebar.php'); ?>
     
      <div class="main-panel">
        <div class="content-wrapper">
            <div class ="row">
              <div class="col-md-12 d-flex align-items-stretch grid-margin">
                <div class="row flex-grow">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">About Page Setting </h4>
                        <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateSetting(this, event);">
                          <div class="row">
                            <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-12 col-form-label">About</label>
                                <div class="col-sm-12">
                                  <textarea class="form-control aboutus" id="description" rows="10" name="description" placeholder="Enter extra description" required><?=isset($AboutPageSettingData->value) ? $AboutPageSettingData->value:'';?></textarea>
                                </div>
                              </div>
                            </div>
                          </div>

                          <input type="hidden" name="action" value="addUpdateAboutSetting">
                          <button type="submit" class="btn btn-success mr-2 actionbtn">Submit</button>
                          <button type="button" class="btn btn-light">Cancel</button>

                          <p class="msg"></p>
                        </form>
                      </div>
                    </div>
                  </div>                  
                </div>
              </div>
            </div> 
        </div>
       



<?php $this->load->viewD('inc/footer.php'); ?>
