<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
   
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

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
                        <h4 class="card-title">Corporate Page Setting </h4>
                        <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateSetting(this, event);">
                          <p class="msg"></p>
                          <?php
                            if (isset($corporatePageSettingData->value) && !empty($corporatePageSettingData->value)) {
                              $corporateData = (object) unserialize($corporatePageSettingData->value);
                            }
                            $benefitArr = (isset($corporateData->benefit) && !empty($corporateData->benefit))?explode(',', $corporateData->benefit):array();
                            $personalised_gift_other_category = (isset($corporateData->personalised_gift_other_category) && !empty($corporateData->personalised_gift_other_category)) ? explode(',', $corporateData->personalised_gift_other_category):array();
                              /*print_r($personalised_gift_other_category);
                              exit();*/
                            $personalised_gift_other_category_options = '';
                            
                            if (isset($subCategoryItemData) && !empty($subCategoryItemData)) {
                                    foreach ($subCategoryItemData as $item) { 
                             $personalised_gift_other_category_options .='<option value="'.$item->subcategoryItemId.'" '.((in_array($item->subcategoryItemId, $personalised_gift_other_category))?'selected':'' ).' >'.$item->subcategoryItemName.'</option>';
                             }}
                              
                            
                            ?>

                          <p class="card-description">Banner Info</p>
                          <div class="row">
                            <div class="col-md-12">
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Banner Title</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control firstinput" id="banner_title" name="banner_title" placeholder="Enter banner title" value="<?=isset($corporateData->banner_title) ? $corporateData->banner_title:'';?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Banner Description</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control" id="banner_description" name="banner_description" placeholder="Enter banner description" value="<?=isset($corporateData->banner_description) ? $corporateData->banner_description:'';?>">
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Banner Button</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control" id="button_text" name="button_text" placeholder="Enter Button Text" value="<?=isset($corporateData->button_text) ? $corporateData->button_text:'';?>" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Button Url</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control" id="button_url" name="button_url" placeholder="Enter Button URL" value="<?=isset($corporateData->button_url) ? $corporateData->button_url:'';?>" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label for="uploadIcons" class="col-sm-12">Banner Image <span class="text-muted">( Image should be 1350*250 )</span></label>

                                <div class="col-sm-12">
                                  <input type="file" name="uploadIcons" id="uploadIcons" value="" onchange="fileuploadpreview(this)">
                                  <div class="previewimg"><?=isset($corporateData->banner_image) ? '<img src="'.UPLOADPATH.'/corporate_page_image/'.$corporateData->banner_image.'" width="70px" height="50px">':'';?></div> 
                                </div>
                              </div>
                            </div>
                          </div>  
                          <p class="card-description">Tab 1</p>
                          <div class="row">
                            <div class="col-md-12">
                              
                              <?php if (!empty($frontPageBenefitData)) {
                                    foreach ($frontPageBenefitData as $benefit) {
                                      echo '<div class="col-xs-4 col-sm-3 col-md-2 nopad text-center"> <label class="image-checkbox '.(in_array($benefit->benefitId, $benefitArr)?'image-checkbox-checked':'').'"> <img class="img-responsive" src="'.UPLOADPATH.'/benefit_images/'.$benefit->img.'" /> <input type="checkbox" name="benefitId[]" value="'.$benefit->benefitId.'" '.(in_array($benefit->benefitId, $benefitArr)?'checked':'').' /> <i class="fa fa-check hidden"></i> </label> </div>';
                                    }
                                  } ?>
                            </div>
                          </div> 

                          <p class="card-description">Tab 2</p>
                          <div class="row">
                            <div class="col-md-12">
                              
                              <div class="form-group">
                                    <label for="categories">Categories (Multiple, Max. 8):</label>
                                    <select class="livemultisearchmax8 form-control" name="personalised_gift_other_category[]" multiple style="width:400px;" required>
                                      <?=$personalised_gift_other_category_options;?>
                                    </select>
                                  </div>
                            </div>
                          </div> 
                          
                          <p class="card-description">Tab 3</p>
                           <div class="row">
                            <div class="col-md-12">
                             <div class="col-md-12 bg-light mt-3 mb-3 pt-2 pb-2">
                                    <div class="form-group">
                                    <label for="uploadIcons"> Image<span class="text-muted"></span></label>
                                    <input type="file" name="tab_3_steps1_img" id="tab_3_steps1_img" value="" onchange="fileuploadpreview(this)" >
                                            <div class="previewimg"><?=isset($corporateData->tab_3_steps1_img) ? '<img src="'.UPLOADPATH.'/corporate_page_image/'.$corporateData->tab_3_steps1_img.'" width="70px" height="50px">':'';?></div>
                                    </div>
                                    <div class="form-group">
                                      <label for="collection_tab_3">Title</label>
                                      <input type="text" name="tab_3_steps1_text1" class="form-control" placeholder="Enter Text 1" value="<?=isset($corporateData->tab_3_steps1_text1) ? $corporateData->tab_3_steps1_text1:'';?>" required>
                                    </div>
                                    <div class="form-group">
                                      <input type="text" name="tab_3_steps1_text2" class="form-control" placeholder="Enter Text 2" value="<?=isset($corporateData->tab_3_steps1_text2) ? $corporateData->tab_3_steps1_text2:'';?>" required>
                                    </div>
                                    <div class="form-group">
                                      <input type="text" name="tab_3_steps1_text3" class="form-control" placeholder="Enter Text 3" value="<?=isset($corporateData->tab_3_steps1_text3) ? $corporateData->tab_3_steps1_text3:'';?>" required>
                                    </div>
                             </div>
                             <div class="col-md-12 bg-light mt-3 mb-3 pt-2 pb-2">
                                    <div class="form-group">
                                    <label for="uploadIcons"> Image<span class="text-muted"></span></label>
                                    <input type="file" name="tab_3_steps2_img" id="tab_3_steps2_img" value="" onchange="fileuploadpreview(this)" >
                                            <div class="previewimg"><?=isset($corporateData->tab_3_steps2_img) ? '<img src="'.UPLOADPATH.'/corporate_page_image/'.$corporateData->tab_3_steps2_img.'" width="70px" height="50px">':'';?></div>
                                    </div>
                                    <div class="form-group">
                                      <label for="collection_tab_3">Title</label>
                                      <input type="text" name="tab_3_steps2_text1" class="form-control" placeholder="Enter Text 1" value="<?=isset($corporateData->tab_3_steps2_text1) ? $corporateData->tab_3_steps2_text1:'';?>" required>
                                    </div>
                                    <div class="form-group">
                                      <input type="text" name="tab_3_steps2_text2" class="form-control" placeholder="Enter Text 2" value="<?=isset($corporateData->tab_3_steps2_text2) ? $corporateData->tab_3_steps2_text2:'';?>" required>
                                    </div>

                             </div>
                             <div class="col-md-12 bg-light mt-3 mb-3 pt-2 pb-2">
                                    <div class="form-group">
                                    <label for="uploadIcons"> Image<span class="text-muted"></span></label>
                                    <input type="file" name="tab_3_steps3_img" id="tab_3_steps3_img" value="" onchange="fileuploadpreview(this)" >
                                            <div class="previewimg"><?=isset($corporateData->tab_3_steps3_img) ? '<img src="'.UPLOADPATH.'/corporate_page_image/'.$corporateData->tab_3_steps3_img.'" width="70px" height="50px">':'';?></div>
                                    </div>
                                    <div class="form-group">
                                      <label for="collection_tab_3">Title</label>
                                      <input type="text" name="tab_3_steps3_text1" class="form-control" placeholder="Enter Text 1" value="<?=isset($corporateData->tab_3_steps3_text1) ? $corporateData->tab_3_steps3_text1:'';?>" required>
                                    </div>
                                    <div class="form-group">
                                      <input type="text" name="tab_3_steps3_text2" class="form-control" placeholder="Enter Text 2" value="<?=isset($corporateData->tab_3_steps3_text2) ? $corporateData->tab_3_steps3_text2:'';?>" required>
                                    </div>

                             </div>
                            </div>
                          </div>
                          <p class="card-description">Tab 4</p>
                           <div class="form-group">
                                    <label for="email">Customer Review Section:</label>
                                    <select class="livesearch form-control firstinput" name="customer_review[]" multiple style="width:400px;" required>
                                      <?php 
                                       $customer_review = (isset($corporateData->customer_review) && !empty($corporateData->customer_review)) ? explode(',', $corporateData->customer_review):array();
 
                                      if (isset($reviewData) && !empty($reviewData)) {
                                        foreach ($reviewData as $item) {
                                          echo '<option value="'.$item->reviewId.'" '.((in_array($item->reviewId, $customer_review))?'selected':'' ).'>'.$item->firstName.' - '.$item->review.'</option>';
                                        }
                                      }
                                      ?>
                                    </select>
                                  </div> 
                          <p class="card-description">Tab 5</p>
                          <div class="row">
                            <div class="col-md-12">
                             <div class="col-md-12 bg-light mt-3 mb-3 pt-2 pb-2">
                                    <div class="form-group">
                                    <label for="uploadIcons"> Image<span class="text-muted"></span></label>
                                    <input type="file" name="tab_5_partners_img1" id="tab_5_partners_img1" value="" onchange="fileuploadpreview(this)" >
                                            <div class="previewimg"><?=isset($corporateData->tab_5_partners_img1) ? '<img src="'.UPLOADPATH.'/corporate_page_image/'.$corporateData->tab_5_partners_img1.'" width="70px" height="50px">':'';?></div>
                                    </div>
                                    <div class="form-group">
                                      <label for="collection_tab_3">Title</label>
                                      <input type="text" name="tab_5_partners_text1" class="form-control" placeholder="Enter Text 1" value="<?=isset($corporateData->tab_5_partners_text1) ? $corporateData->tab_5_partners_text1:'';?>" required>
                                    </div>
                                    
                             </div>
                             <div class="col-md-12 bg-light mt-3 mb-3 pt-2 pb-2">
                                    <div class="form-group">
                                    <label for="uploadIcons"> Image<span class="text-muted"></span></label>
                                    <input type="file" name="tab_5_partners_img2" id="tab_5_partners_img2" value="" onchange="fileuploadpreview(this)" >
                                            <div class="previewimg"><?=isset($corporateData->tab_5_partners_img2) ? '<img src="'.UPLOADPATH.'/corporate_page_image/'.$corporateData->tab_5_partners_img2.'" width="70px" height="50px">':'';?></div>
                                    </div>
                                    <div class="form-group">
                                      <label for="collection_tab_3">Title</label>
                                      <input type="text" name="tab_5_partners_text2" class="form-control" placeholder="Enter Text 2" value="<?=isset($corporateData->tab_5_partners_text2) ? $corporateData->tab_5_partners_text2:'';?>" required>
                                    </div>

                             </div>
                             <div class="col-md-12 bg-light mt-3 mb-3 pt-2 pb-2">
                                    <div class="form-group">
                                    <label for="uploadIcons"> Image<span class="text-muted"></span></label>
                                    <input type="file" name="tab_5_partners_img3" id="tab_5_partners_img3" value="" onchange="fileuploadpreview(this)" >
                                            <div class="previewimg"><?=isset($corporateData->tab_5_partners_img3) ? '<img src="'.UPLOADPATH.'/corporate_page_image/'.$corporateData->tab_5_partners_img3.'" width="70px" height="50px">':'';?></div>
                                    </div>
                                    <div class="form-group">
                                      <label for="collection_tab_3">Title</label>
                                      <input type="text" name="tab_5_partners_text3" class="form-control" placeholder="Enter Text 3" value="<?=isset($corporateData->tab_5_partners_text3) ? $corporateData->tab_5_partners_text3:'';?>" required>
                                    </div>

                             </div>
                             <div class="col-md-12 bg-light mt-3 mb-3 pt-2 pb-2">
                                    <div class="form-group">
                                    <label for="uploadIcons"> Image<span class="text-muted"></span></label>
                                    <input type="file" name="tab_5_partners_img4" id="tab_5_partners_img4" value="" onchange="fileuploadpreview(this)" >
                                            <div class="previewimg"><?=isset($corporateData->tab_5_partners_img4) ? '<img src="'.UPLOADPATH.'/corporate_page_image/'.$corporateData->tab_5_partners_img4.'" width="70px" height="50px">':'';?></div>
                                    </div>
                                    <div class="form-group">
                                      <label for="collection_tab_4">Title</label>
                                      <input type="text" name="tab_5_partners_text4" class="form-control" placeholder="Enter Text 4" value="<?=isset($corporateData->tab_5_partners_text4) ? $corporateData->tab_5_partners_text4:'';?>" required>
                                    </div>

                             </div>
                             <div class="col-md-12 bg-light mt-3 mb-3 pt-2 pb-2">
                                    <div class="form-group">
                                    <label for="uploadIcons"> Image<span class="text-muted"></span></label>
                                    <input type="file" name="tab_5_partners_img5" id="tab_5_partners_img5" value="" onchange="fileuploadpreview(this)" >
                                            <div class="previewimg"><?=isset($corporateData->tab_5_partners_img5) ? '<img src="'.UPLOADPATH.'/corporate_page_image/'.$corporateData->tab_5_partners_img5.'" width="70px" height="50px">':'';?></div>
                                    </div>
                                    <div class="form-group">
                                      <label for="collection_tab_5">Title</label>
                                      <input type="text" name="tab_5_partners_text5" class="form-control" placeholder="Enter Text 5" value="<?=isset($corporateData->tab_5_partners_text5) ? $corporateData->tab_5_partners_text5:'';?>" required>
                                    </div>

                             </div>
                            </div>
                          </div>                                                   
                          <p class="card-description">Tab 6</p>
                          <div class="row">
                            <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-sm-12 col-form-label">Description</label>
                                <div class="col-sm-12">
                                  <textarea class="form-control aboutus" id="extra_desc" rows="3" name="extra_desc" placeholder="Enter extra description" required><?=isset($corporateData->extra_desc) ? $corporateData->extra_desc:'';?></textarea>
                                </div>
                              </div>
                            </div>
                          </div>

                          <input type="hidden" name="action" value="addUpdateCorporateSetting">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>
<script type="text/javascript">
  $(".livesearch").chosen({
    disable_search_threshold: 5,
    no_results_text: "Oops, Vendor not found!",
    width: "100%"
  });
  $(".livemultisearchmax8").chosen({
    disable_search_threshold: 5,
    no_results_text: "Oops, Vendor not found!",
    width: "100%",
    max_selected_options: 8
  });
</script>