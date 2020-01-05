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
                        <h4 class="card-title">Franchise Page Setting </h4>
                        <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateSetting(this, event);">
                          <p class="msg"></p>
                          <?php
                            if (isset($franchisePageSettingData->value) && !empty($franchisePageSettingData->value)) {
                              $franchiseData = (object) unserialize($franchisePageSettingData->value);
                            }
                            ?>

                          <p class="card-description">Banner Info</p>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Banner Title</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control firstinput" id="banner_title" name="banner_title" placeholder="Enter banner title" value="<?=isset($franchiseData->banner_title) ? $franchiseData->banner_title:'';?>" >
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Banner Description</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control" id="banner_description" name="banner_description" placeholder="Enter banner description" value="<?=isset($franchiseData->banner_description) ? $franchiseData->banner_description:'';?>" >
                                </div>
                              </div>

                              <div class="form-group row">
                                <label for="uploadIcons" class="col-sm-12">Banner Image <span class="text-muted">( Image should be 1350*250 )</span></label>

                                <div class="col-sm-12">
                                  <input type="file" name="uploadIcons" id="uploadIcons" value="" onchange="fileuploadpreview(this)">
                                  <div class="previewimg"><?=isset($franchiseData->banner_image) ? '<img src="'.UPLOADPATH.'/franchise_banner_image/'.$franchiseData->banner_image.'" width="70px" height="50px">':'';?></div> 
                                </div>
                              </div>
                            </div>
                          </div>  
                          <p class="card-description">Tab 1</p>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Title</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control firstinput" id="tab_1_title" name="tab_1_title" placeholder="Enter tab 1 title" value="<?=isset($franchiseData->tab_1_title) ? $franchiseData->tab_1_title:'';?>" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Description</label>
                                <div class="col-sm-12">
                                  <textarea class="form-control aboutus" id="tab_1_description" rows="3" name="tab_1_description" placeholder="Enter tab 1 description" required><?=isset($franchiseData->tab_1_description) ? $franchiseData->tab_1_description:'';?></textarea>
                                </div>
                              </div>
                            </div>
                          </div> 
                          <p class="card-description">Tab 2</p>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Title</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control firstinput" id="tab_2_title" name="tab_2_title" placeholder="Enter tab 2 title" value="<?=isset($franchiseData->tab_2_title) ? $franchiseData->tab_2_title:'';?>" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Description</label>
                                <div class="col-sm-12">
                                  <textarea class="form-control aboutus" id="tab_2_description" rows="3" name="tab_2_description" placeholder="Enter tab 2 description" required><?=isset($franchiseData->tab_2_description) ? $franchiseData->tab_2_description:'';?></textarea>
                                </div>
                              </div>
                            </div>
                          </div> 
                          <p class="card-description">Tab 3</p>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Title</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control firstinput" id="tab_3_title" name="tab_3_title" placeholder="Enter tab 3 title" value="<?=isset($franchiseData->tab_3_title) ? $franchiseData->tab_3_title:'';?>" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Description</label>
                                <div class="col-sm-12">
                                  <textarea class="form-control aboutus" id="tab_3_description" rows="3" name="tab_3_description" placeholder="Enter tab 3 description" required><?=isset($franchiseData->tab_3_description) ? $franchiseData->tab_3_description:'';?></textarea>
                                </div>
                              </div>
                            </div>
                          </div> 
                          <p class="card-description">Tab 4</p>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Title</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control firstinput" id="tab_4_title" name="tab_4_title" placeholder="Enter tab 4 title" value="<?=isset($franchiseData->tab_4_title) ? $franchiseData->tab_4_title:'';?>" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Description</label>
                                <div class="col-sm-12">
                                  <textarea class="form-control aboutus" id="tab_4_description" rows="3" name="tab_4_description" placeholder="Enter tab 4 description" required><?=isset($franchiseData->tab_4_description) ? $franchiseData->tab_4_description:'';?></textarea>
                                </div>
                              </div>
                            </div>
                          </div>                       

                          <input type="hidden" name="action" value="addUpdateFranchiseSetting">
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
