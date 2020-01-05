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

<style type="text/css">
.nopad {
  padding-left: 0px !important;
  padding-right: 5px !important;
  padding-bottom: 5px !important;
}
/*image gallery*/
.image-checkbox {
  cursor: pointer;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  border: 4px solid transparent;
  margin-bottom: 0;
  outline: 0;
  width: 100%;

  background: slategrey;
}
.image-checkbox input[type="checkbox"] {
  display: none;
}

.image-checkbox-checked {
  border-color: #4783B0;
}
.image-checkbox .fa {
  position: absolute;
  color: white;
  background-color: #fff;
  padding: 10px;
  top: 0;
  right: 5px;
  background: #4783b0;
}
.image-checkbox-checked .fa {
  display: block !important;
}
.hidden{
  display: none;
}
img.img-responsive {
    width: 100%;
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
                        <h4 class="card-title">Front Footer Setting </h4>
                        <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateSetting(this, event);">
                          <?php
                            if (isset($frontFooterSettingData->value) && !empty($frontFooterSettingData->value)) {
                              $footerData = (object) unserialize($frontFooterSettingData->value);
                            }

                            $socialIconsArr = (isset($footerData->social_icon_ids) && !empty($footerData->social_icon_ids))?explode(',', $footerData->social_icon_ids):array();
                            ?>
 
                          <p class="card-description">Column 1</p>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Title</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control firstinput" id="column_1_title" name="column_1_title" placeholder="Enter column 1 title" value="<?=isset($footerData->column_1_title) ? $footerData->column_1_title:'';?>" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Description</label>
                                <div class="col-sm-12">
                                  <textarea class="form-control aboutus" id="column_1_description" rows="3" name="column_1_description" placeholder="Enter column 1 description" required><?=isset($footerData->column_1_description) ? $footerData->column_1_description:'';?></textarea>
                                </div>
                              </div>
                            </div>
                          </div> 
                          <p class="card-description">Column 2</p>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Title</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control firstinput" id="column_2_title" name="column_2_title" placeholder="Enter column 2 title" value="<?=isset($footerData->column_2_title) ? $footerData->column_2_title:'';?>" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Description</label>
                                <div class="col-sm-12">
                                  <textarea class="form-control aboutus" id="column_2_description" rows="3" name="column_2_description" placeholder="Enter column 2 description" required><?=isset($footerData->column_2_description) ? $footerData->column_2_description:'';?></textarea>
                                </div>
                              </div>
                            </div>
                          </div> 
                          <p class="card-description">Column 3</p>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Title</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control firstinput" id="column_3_title" name="column_3_title" placeholder="Enter column 3 title" value="<?=isset($footerData->column_3_title) ? $footerData->column_3_title:'';?>" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Description</label>
                                <div class="col-sm-12">
                                  <textarea class="form-control aboutus" id="column_3_description" rows="3" name="column_3_description" placeholder="Enter column 3 description" required><?=isset($footerData->column_3_description) ? $footerData->column_3_description:'';?></textarea>
                                </div>
                              </div>
                            </div>
                          </div> 
                          <p class="card-description">Column 4</p>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Title</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control firstinput" id="column_4_title" name="column_4_title" placeholder="Enter column 4 title" value="<?=isset($footerData->column_4_title) ? $footerData->column_4_title:'';?>" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Description</label>
                                <div class="col-sm-12">
                                  <textarea class="form-control aboutus" id="column_4_description" rows="3" name="column_4_description" placeholder="Enter column 4 description" required><?=isset($footerData->column_4_description) ? $footerData->column_4_description:'';?></textarea>
                                </div>
                              </div>
                            </div>
                          </div> 
                          <p class="card-description">Column 5</p>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Title</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control firstinput" id="column_5_title" name="column_5_title" placeholder="Enter column 5 title" value="<?=isset($footerData->column_5_title) ? $footerData->column_5_title:'';?>" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Description</label>
                                <div class="col-sm-12">
                                  <textarea class="form-control aboutus" id="column_5_description" rows="3" name="column_5_description" placeholder="Enter column 5 description" required><?=isset($footerData->column_5_description) ? $footerData->column_5_description:'';?></textarea>
                                </div>
                              </div>
                            </div>
                          </div> 
                          <p class="card-description">Social Column</p>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Title</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control firstinput" id="social_title" name="social_title" placeholder="Enter column 5 title" value="<?=isset($footerData->social_title) ? $footerData->social_title:'';?>" required>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12 mb-5">
                              
                                <?php if (!empty($frontSocialIconsData)) {
                                    foreach ($frontSocialIconsData as $icon) {
                                      echo '<div class="col-xs-1 col-sm-1 col-md-1 nopad text-center"> <label class="image-checkbox '.(in_array($icon->socialId, $socialIconsArr)?'image-checkbox-checked':'').'"> <img class="img-responsive" src="'.UPLOADPATH.'/social_images/'.$icon->img.'" /> <input type="checkbox" name="social_icon_ids[]" value="'.$icon->socialId.'" '.(in_array($icon->socialId, $socialIconsArr)?'checked':'').' /> <i class="fa fa-check hidden"></i> </label> </div>';
                                    }
                                  } ?>
                            </div>
                          </div>                       

                          <input type="hidden" name="action" value="addUpdateFooterSetting">
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
<script type="text/javascript">
// image gallery
// init the state from the input
$(".image-checkbox").each(function () {
  if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
    $(this).addClass('image-checkbox-checked');
  }
  else {
    $(this).removeClass('image-checkbox-checked');
  }
});

// sync the state to the input
$(".image-checkbox").on("click", function (e) {
  $(this).toggleClass('image-checkbox-checked');
  var $checkbox = $(this).find('input[type="checkbox"]');
  $checkbox.prop("checked",!$checkbox.prop("checked"))

  e.preventDefault();
});
</script>