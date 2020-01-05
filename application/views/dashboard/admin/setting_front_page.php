<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
   
<link rel="stylesheet" href="https://www.jqueryscript.net/demo/Easy-Responsive-Tab-Accordion-Control-Plugin-For-jQuery/easy-responsive-tabs.css">
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
    <style type="text/css">
      
    </style>
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
                        <h4 class="card-title">Front Page Setting</h4>
                       

                        <div id="verticalTab">
                          <ul class="resp-tabs-list">
                            <li>Header Footer Script</li>
                            <li>Main Slider</li>
                            <li>Category Section</li>
                            <li>Product Slider 1</li>
                            <li>Product Slider 2</li>
                            <li>Product Slider 3</li>
                            <li>Product Slider 4</li>
                            <li>Product Slider 5</li>
                            <li>Product Slider 6</li>
                            <li>Product Slider 7</li>
                            <li>Product Slider 8</li>
                            <li>Product Slider 9</li>
                            <li>Sale Section</li>
                          </ul>
                          <div class="resp-tabs-container">

                            <?php
                            if (isset($frontPageSettingData->value) && !empty($frontPageSettingData->value)) {
                              $frontData = (object) unserialize($frontPageSettingData->value);
                               // v3print($frontData); exit;
                            }

                            $mainSliderArr = (isset($frontData->slider) && !empty($frontData->slider))?explode(',', $frontData->slider):array();
                            

                            $category_section_category = (isset($frontData->category_section_category) && !empty($frontData->category_section_category)) ? explode(',', $frontData->category_section_category):array();
                            $category_section_category_options = '';


                            if (isset($subcategoryData) && !empty($subcategoryData)) {
                              foreach ($subcategoryData as $item) {

                                $category_section_category_options .='<option value="'.$item->subcategoryId.'" '.((in_array($item->subcategoryId, $category_section_category))?'selected':'' ).' >'.$item->subcategoryName.'</option>';


                              }
                            }
                            ?>
                            <div class="header-section">                              
                              <h3 class="mb-3">Header Footer Script And Offer Slider</h3>
                              <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateSetting(this, event);">
                                <p class="msg"></p>

                                <div class="form-group">
                                  <label for="header_script">Page Header Tag</label>
                                  <textarea class="form-control textEditor firstinput" name="header_script" placeholder="Front Page Header script"  tabindex="5"><?=isset($frontData->header_script) ? $frontData->header_script:'';?></textarea>
                                </div>
                                <div class="form-group">
                                  <label for="footer_script">Page Footer Tag</label>
                                  <textarea class="form-control textEditor" name="footer_script" placeholder="Front Page Footer script" tabindex="5"><?=isset($frontData->footer_script) ? $frontData->footer_script:'';?></textarea>
                                </div>
                                <div class="form-group">
                                  <label for="offer_slider">Offer Slider</label>
                                  <textarea class="form-control textEditor" name="offer_slider" placeholder="Front Page Offer Slider" tabindex="5"><?=isset($frontData->offer_slider) ? $frontData->offer_slider:'';?></textarea>
                                </div>
                                <input type="hidden" name="action" value="addUpdateSetting">
                                <input type="hidden" name="indexval" value="">
                                <button type="submit" class="btn btn-success mr-2 actionbtn">Save</button>
                              </form>
                            </div>
                            <div class="slider-section">
                              <div class="container">
                                <h3 class="mb-3">Main Slider Images</h3>
                                <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateSetting(this, event);">
                                  <p class="msg"></p>
                                  <?php if (!empty($frontPageSliderData)) {
                                      foreach ($frontPageSliderData as $slider) {
                                        echo '<div class="col-xs-4 col-sm-3 col-md-6 nopad text-center"> <label class="image-checkbox '.(in_array($slider->sliderId, $mainSliderArr)?'image-checkbox-checked':'').'"> <img class="img-responsive" src="'.UPLOADPATH.'/slider_images/'.$slider->img.'" /> <input type="checkbox" name="sliderId[]" value="'.$slider->sliderId.'" '.(in_array($slider->sliderId, $mainSliderArr)?'checked':'').' /> <i class="fa fa-check hidden"></i> </label> </div>';
                                      }
                                  } ?>
                                  <div class="col-md-12 mt-3 mb-3">
                                    <input type="hidden" name="action" value="addUpdateSetting">
                                    <input type="hidden" name="indexval" value="">
                                    <button type="submit" class="btn btn-success mr-2 actionbtn">Save</button>
                                  </div>
                                </form>

                              </div>
                            </div>

                            

                            <div class="category-section">
                              <div class="container">
                                <h3 class="mb-3">Category Section</h3>
                                <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateSetting(this, event);">
                                  <p class="msg"></p>
                                  <div class="form-group">
                                    <label for="email">Categories (Multiple, Max. 8):</label>
                                    <select class="livesearch form-control" name="category_section_category[]" multiple style="width:400px;" required>
                                      <?=$category_section_category_options;?>
                                    </select>
                                  </div>
                                  <div class="col-md-12 mt-3 mb-3">
                                    <input type="hidden" name="action" value="addUpdateSetting">
                                    <input type="hidden" name="indexval" value="">
                                    <button type="submit" class="btn btn-success mr-2 actionbtn">Save</button>
                                  </div>
                                </form>
                              </div>
                            </div>

                            

                            <div class="product-slider-1-section">
                              <div class="container">
                                <h3 class="mb-3">Product Slider 1</h3>
                                <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateSetting(this, event);">
                                  <p class="msg"></p>
                                  
                                  
                                  <div class="form-group">
                                    <label for="product_slider_1_title">Section Title</label>
                                    <input type="text" name="product_slider_1_title" class="form-control" placeholder="Enter Title" value="<?=isset($frontData->product_slider_1_title) ? $frontData->product_slider_1_title:'';?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="product_slider_1_btn_title">View All Button Title</label>
                                    <input type="text" name="product_slider_1_btn_title" class="form-control" placeholder="Enter Button Title" value="<?=isset($frontData->product_slider_1_btn_title) ? $frontData->product_slider_1_btn_title:'View All';?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="product_slider_1_btn_url">View All Button URL</label>
                                    <input type="text" name="product_slider_1_btn_url" class="form-control" placeholder="Enter Title" value="<?=isset($frontData->product_slider_1_btn_url) ? $frontData->product_slider_1_btn_url:BASEURL;?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="email">Product:</label>
                                    <select class="livesearch form-control" name="product_slider_1_product[]" multiple style="width:400px;" required>

                                      <?php 
                                       $product_slider_1_product = (isset($frontData->product_slider_1_product) && !empty($frontData->product_slider_1_product)) ? explode(',', $frontData->product_slider_1_product):array();
                                       $product_slider_2_product = (isset($frontData->product_slider_2_product) && !empty($frontData->product_slider_2_product)) ? explode(',', $frontData->product_slider_2_product):array();
                                       $product_slider_3_product = (isset($frontData->product_slider_3_product) && !empty($frontData->product_slider_3_product)) ? explode(',', $frontData->product_slider_3_product):array();
                                       $product_slider_4_product = (isset($frontData->product_slider_4_product) && !empty($frontData->product_slider_4_product)) ? explode(',', $frontData->product_slider_4_product):array();
                                       $product_slider_5_product = (isset($frontData->product_slider_5_product) && !empty($frontData->product_slider_5_product)) ? explode(',', $frontData->product_slider_5_product):array();
                                       $product_slider_6_product = (isset($frontData->product_slider_6_product) && !empty($frontData->product_slider_6_product)) ? explode(',', $frontData->product_slider_6_product):array();
                                       $product_slider_7_product = (isset($frontData->product_slider_7_product) && !empty($frontData->product_slider_7_product)) ? explode(',', $frontData->product_slider_7_product):array();
                                       $product_slider_8_product = (isset($frontData->product_slider_8_product) && !empty($frontData->product_slider_8_product)) ? explode(',', $frontData->product_slider_8_product):array();
                                       $product_slider_9_product = (isset($frontData->product_slider_9_product) && !empty($frontData->product_slider_9_product)) ? explode(',', $frontData->product_slider_9_product):array();

                                       $product_slider_2_product_options = $product_slider_3_product_options = $product_slider_4_product_options = $product_slider_5_product_options = $product_slider_6_product_options = $product_slider_7_product_options = $product_slider_8_product_options = $product_slider_9_product_options = '';
                                      if (isset($productData) && !empty($productData)) {
                                        foreach ($productData as $product) {
                                          echo '<option value="'.$product->productId.'" '.((in_array($product->productId, $product_slider_1_product))?'selected':'' ).'>'.$product->productName.' - Rs '.$product->price.'</option>';
                                          $product_slider_2_product_options .= '<option value="'.$product->productId.'" '.((in_array($product->productId, $product_slider_2_product))?'selected':'' ).'>'.$product->productName.' - Rs '.$product->price.'</option>';
                                          $product_slider_3_product_options .= '<option value="'.$product->productId.'" '.((in_array($product->productId, $product_slider_3_product))?'selected':'' ).'>'.$product->productName.' - Rs '.$product->price.'</option>';
                                          $product_slider_4_product_options .= '<option value="'.$product->productId.'" '.((in_array($product->productId, $product_slider_4_product))?'selected':'' ).'>'.$product->productName.' - Rs '.$product->price.'</option>';
                                          $product_slider_5_product_options .= '<option value="'.$product->productId.'" '.((in_array($product->productId, $product_slider_5_product))?'selected':'' ).'>'.$product->productName.' - Rs '.$product->price.'</option>';
                                          $product_slider_6_product_options .= '<option value="'.$product->productId.'" '.((in_array($product->productId, $product_slider_6_product))?'selected':'' ).'>'.$product->productName.' - Rs '.$product->price.'</option>';
                                          $product_slider_7_product_options .= '<option value="'.$product->productId.'" '.((in_array($product->productId, $product_slider_7_product))?'selected':'' ).'>'.$product->productName.' - Rs '.$product->price.'</option>';
                                          $product_slider_8_product_options .= '<option value="'.$product->productId.'" '.((in_array($product->productId, $product_slider_8_product))?'selected':'' ).'>'.$product->productName.' - Rs '.$product->price.'</option>';
                                          $product_slider_9_product_options .= '<option value="'.$product->productId.'" '.((in_array($product->productId, $product_slider_9_product))?'selected':'' ).'>'.$product->productName.' - Rs '.$product->price.'</option>';
                                        }
                                      }
                                      ?>
                                    </select>
                                  </div>
                                  <div class="col-md-12 mt-3 mb-3">
                                    <input type="hidden" name="action" value="addUpdateSetting">
                                    <input type="hidden" name="indexval" value="">
                                    <button type="submit" class="btn btn-success mr-2 actionbtn">Save</button>
                                  </div>
                                </form>
                              </div>
                            </div>

                            <div class="product-slider-2-section">
                              <div class="container">
                                <h3 class="mb-3">Product Slider 2</h3>
                                <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateSetting(this, event);">
                                  <p class="msg"></p>
                                  
                                  
                                  <div class="form-group">
                                    <label for="product_slider_2_title">Section Title</label>
                                    <input type="text" name="product_slider_2_title" class="form-control" placeholder="Enter Title" value="<?=isset($frontData->product_slider_2_title) ? $frontData->product_slider_2_title:'';?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="product_slider_2_btn_title">View All Button Title</label>
                                    <input type="text" name="product_slider_2_btn_title" class="form-control" placeholder="Enter Button Title" value="<?=isset($frontData->product_slider_2_btn_title) ? $frontData->product_slider_2_btn_title:'View All';?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="product_slider_2_btn_url">View All Button URL</label>
                                    <input type="text" name="product_slider_2_btn_url" class="form-control" placeholder="Enter Title" value="<?=isset($frontData->product_slider_2_btn_url) ? $frontData->product_slider_2_btn_url:BASEURL;?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="email">Product:</label>
                                    <select class="livesearch form-control" name="product_slider_2_product[]" multiple style="width:400px;" required>

                                      <?=$product_slider_2_product_options;?>
                                    </select>
                                  </div>
                                  <div class="col-md-12 mt-3 mb-3">
                                    <input type="hidden" name="action" value="addUpdateSetting">
                                    <input type="hidden" name="indexval" value="">
                                    <button type="submit" class="btn btn-success mr-2 actionbtn">Save</button>
                                  </div>
                                </form>
                              </div>
                            </div>

                            <div class="product-slider-3-section">
                              <div class="container">
                                <h3 class="mb-3">Product Slider 3</h3>
                                <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateSetting(this, event);">
                                  <p class="msg"></p>
                                  
                                  
                                  <div class="form-group">
                                    <label for="product_slider_3_title">Section Title</label>
                                    <input type="text" name="product_slider_3_title" class="form-control" placeholder="Enter Title" value="<?=isset($frontData->product_slider_3_title) ? $frontData->product_slider_3_title:'';?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="product_slider_3_btn_title">View All Button Title</label>
                                    <input type="text" name="product_slider_3_btn_title" class="form-control" placeholder="Enter Button Title" value="<?=isset($frontData->product_slider_3_btn_title) ? $frontData->product_slider_3_btn_title:'View All';?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="product_slider_3_btn_url">View All Button URL</label>
                                    <input type="text" name="product_slider_3_btn_url" class="form-control" placeholder="Enter Title" value="<?=isset($frontData->product_slider_3_btn_url) ? $frontData->product_slider_3_btn_url:BASEURL;?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="email">Product:</label>
                                    <select class="livesearch form-control" name="product_slider_3_product[]" multiple style="width:400px;" required>

                                      <?=$product_slider_3_product_options;?>
                                    </select>
                                  </div>
                                  <div class="col-md-12 mt-3 mb-3">
                                    <input type="hidden" name="action" value="addUpdateSetting">
                                    <input type="hidden" name="indexval" value="">
                                    <button type="submit" class="btn btn-success mr-2 actionbtn">Save</button>
                                  </div>
                                </form>
                              </div>
                            </div>

                            <div class="product-slider-4-section">
                              <div class="container">
                                <h3 class="mb-3">Product Slider 4</h3>
                                <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateSetting(this, event);">
                                  <p class="msg"></p>
                                  
                                  
                                  <div class="form-group">
                                    <label for="product_slider_4_title">Section Title</label>
                                    <input type="text" name="product_slider_4_title" class="form-control" placeholder="Enter Title" value="<?=isset($frontData->product_slider_4_title) ? $frontData->product_slider_4_title:'';?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="product_slider_4_btn_title">View All Button Title</label>
                                    <input type="text" name="product_slider_4_btn_title" class="form-control" placeholder="Enter Button Title" value="<?=isset($frontData->product_slider_4_btn_title) ? $frontData->product_slider_4_btn_title:'View All';?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="product_slider_4_btn_url">View All Button URL</label>
                                    <input type="text" name="product_slider_4_btn_url" class="form-control" placeholder="Enter Title" value="<?=isset($frontData->product_slider_4_btn_url) ? $frontData->product_slider_4_btn_url:BASEURL;?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="email">Product:</label>
                                    <select class="livesearch form-control" name="product_slider_4_product[]" multiple style="width:400px;" required>

                                      <?=$product_slider_4_product_options;?>
                                    </select>
                                  </div>
                                  <div class="col-md-12 mt-3 mb-3">
                                    <input type="hidden" name="action" value="addUpdateSetting">
                                    <input type="hidden" name="indexval" value="">
                                    <button type="submit" class="btn btn-success mr-2 actionbtn">Save</button>
                                  </div>
                                </form>
                              </div>
                            </div>

                            <div class="product-slider-5-section">
                              <div class="container">
                                <h3 class="mb-3">Product Slider 5</h3>
                                <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateSetting(this, event);">
                                  <p class="msg"></p>
                                  
                                  
                                  <div class="form-group">
                                    <label for="product_slider_5_title">Section Title</label>
                                    <input type="text" name="product_slider_5_title" class="form-control" placeholder="Enter Title" value="<?=isset($frontData->product_slider_5_title) ? $frontData->product_slider_5_title:'';?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="product_slider_5_btn_title">View All Button Title</label>
                                    <input type="text" name="product_slider_5_btn_title" class="form-control" placeholder="Enter Button Title" value="<?=isset($frontData->product_slider_5_btn_title) ? $frontData->product_slider_5_btn_title:'View All';?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="product_slider_5_btn_url">View All Button URL</label>
                                    <input type="text" name="product_slider_5_btn_url" class="form-control" placeholder="Enter Title" value="<?=isset($frontData->product_slider_5_btn_url) ? $frontData->product_slider_5_btn_url:BASEURL;?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="email">Product:</label>
                                    <select class="livesearch form-control" name="product_slider_5_product[]" multiple style="width:400px;" required>

                                      <?=$product_slider_5_product_options;?>
                                    </select>
                                  </div>
                                  <div class="col-md-12 mt-3 mb-3">
                                    <input type="hidden" name="action" value="addUpdateSetting">
                                    <input type="hidden" name="indexval" value="">
                                    <button type="submit" class="btn btn-success mr-2 actionbtn">Save</button>
                                  </div>
                                </form>
                              </div>
                            </div>

                            <div class="product-slider-6-section">
                              <div class="container">
                                <h3 class="mb-3">Product Slider 6</h3>
                                <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateSetting(this, event);">
                                  <p class="msg"></p>
                                  
                                  
                                  <div class="form-group">
                                    <label for="product_slider_6_title">Section Title</label>
                                    <input type="text" name="product_slider_6_title" class="form-control" placeholder="Enter Title" value="<?=isset($frontData->product_slider_6_title) ? $frontData->product_slider_6_title:'';?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="product_slider_6_btn_title">View All Button Title</label>
                                    <input type="text" name="product_slider_6_btn_title" class="form-control" placeholder="Enter Button Title" value="<?=isset($frontData->product_slider_6_btn_title) ? $frontData->product_slider_6_btn_title:'View All';?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="product_slider_6_btn_url">View All Button URL</label>
                                    <input type="text" name="product_slider_6_btn_url" class="form-control" placeholder="Enter Title" value="<?=isset($frontData->product_slider_6_btn_url) ? $frontData->product_slider_6_btn_url:BASEURL;?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="email">Product:</label>
                                    <select class="livesearch form-control" name="product_slider_6_product[]" multiple style="width:400px;" required>

                                      <?=$product_slider_6_product_options;?>
                                    </select>
                                  </div>
                                  <div class="col-md-12 mt-3 mb-3">
                                    <input type="hidden" name="action" value="addUpdateSetting">
                                    <input type="hidden" name="indexval" value="">
                                    <button type="submit" class="btn btn-success mr-2 actionbtn">Save</button>
                                  </div>
                                </form>
                              </div>
                            </div>

                            <div class="product-slider-7-section">
                              <div class="container">
                                <h3 class="mb-3">Product Slider 7</h3>
                                <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateSetting(this, event);">
                                  <p class="msg"></p>
                                  
                                  
                                  <div class="form-group">
                                    <label for="product_slider_7_title">Section Title</label>
                                    <input type="text" name="product_slider_7_title" class="form-control" placeholder="Enter Title" value="<?=isset($frontData->product_slider_7_title) ? $frontData->product_slider_7_title:'';?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="product_slider_7_btn_title">View All Button Title</label>
                                    <input type="text" name="product_slider_7_btn_title" class="form-control" placeholder="Enter Button Title" value="<?=isset($frontData->product_slider_7_btn_title) ? $frontData->product_slider_7_btn_title:'View All';?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="product_slider_7_btn_url">View All Button URL</label>
                                    <input type="text" name="product_slider_7_btn_url" class="form-control" placeholder="Enter Title" value="<?=isset($frontData->product_slider_7_btn_url) ? $frontData->product_slider_7_btn_url:BASEURL;?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="email">Product:</label>
                                    <select class="livesearch form-control" name="product_slider_7_product[]" multiple style="width:400px;" required>

                                      <?=$product_slider_7_product_options;?>
                                    </select>
                                  </div>
                                  <div class="col-md-12 mt-3 mb-3">
                                    <input type="hidden" name="action" value="addUpdateSetting">
                                    <input type="hidden" name="indexval" value="">
                                    <button type="submit" class="btn btn-success mr-2 actionbtn">Save</button>
                                  </div>
                                </form>
                              </div>
                            </div>

                            <div class="product-slider-8-section">
                              <div class="container">
                                <h3 class="mb-3">Product Slider 8</h3>
                                <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateSetting(this, event);">
                                  <p class="msg"></p>
                                  
                                  
                                  <div class="form-group">
                                    <label for="product_slider_8_title">Section Title</label>
                                    <input type="text" name="product_slider_8_title" class="form-control" placeholder="Enter Title" value="<?=isset($frontData->product_slider_8_title) ? $frontData->product_slider_8_title:'';?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="product_slider_8_btn_title">View All Button Title</label>
                                    <input type="text" name="product_slider_8_btn_title" class="form-control" placeholder="Enter Button Title" value="<?=isset($frontData->product_slider_8_btn_title) ? $frontData->product_slider_8_btn_title:'View All';?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="product_slider_8_btn_url">View All Button URL</label>
                                    <input type="text" name="product_slider_8_btn_url" class="form-control" placeholder="Enter Title" value="<?=isset($frontData->product_slider_8_btn_url) ? $frontData->product_slider_8_btn_url:BASEURL;?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="email">Product:</label>
                                    <select class="livesearch form-control" name="product_slider_8_product[]" multiple style="width:400px;" required>

                                      <?=$product_slider_8_product_options;?>
                                    </select>
                                  </div>
                                  <div class="col-md-12 mt-3 mb-3">
                                    <input type="hidden" name="action" value="addUpdateSetting">
                                    <input type="hidden" name="indexval" value="">
                                    <button type="submit" class="btn btn-success mr-2 actionbtn">Save</button>
                                  </div>
                                </form>
                              </div>
                            </div>

                            <div class="product-slider-9-section">
                              <div class="container">
                                <h3 class="mb-3">Product Slider 9</h3>
                                <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateSetting(this, event);">
                                  <p class="msg"></p>
                                  
                                  
                                  <div class="form-group">
                                    <label for="product_slider_9_title">Section Title</label>
                                    <input type="text" name="product_slider_9_title" class="form-control" placeholder="Enter Title" value="<?=isset($frontData->product_slider_9_title) ? $frontData->product_slider_9_title:'';?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="product_slider_9_btn_title">View All Button Title</label>
                                    <input type="text" name="product_slider_9_btn_title" class="form-control" placeholder="Enter Button Title" value="<?=isset($frontData->product_slider_9_btn_title) ? $frontData->product_slider_9_btn_title:'View All';?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="product_slider_9_btn_url">View All Button URL</label>
                                    <input type="text" name="product_slider_9_btn_url" class="form-control" placeholder="Enter Title" value="<?=isset($frontData->product_slider_9_btn_url) ? $frontData->product_slider_9_btn_url:BASEURL;?>" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="email">Product:</label>
                                    <select class="livesearch form-control" name="product_slider_9_product[]" multiple style="width:400px;" required>

                                      <?=$product_slider_9_product_options;?>
                                    </select>
                                  </div>
                                  <div class="col-md-12 mt-3 mb-3">
                                    <input type="hidden" name="action" value="addUpdateSetting">
                                    <input type="hidden" name="indexval" value="">
                                    <button type="submit" class="btn btn-success mr-2 actionbtn">Save</button>
                                  </div>
                                </form>
                              </div>
                            </div>


                            <div class="sale-section">
                              <div class="container">
                                <h3 class="mb-3">Sale Section</h3>
                                <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateSetting(this, event);">
                                  <p class="msg"></p>
                                  <div class="form-group">
                                    <label for="sale_banner_title">Title</label>
                                    <input type="text" class="form-control" value="<?=isset($frontData->sale_banner_title) ? $frontData->sale_banner_title:'';?>" name="sale_banner_title" placeholder="Enter title">
                                  </div>
                                  <div class="form-group">
                                    <label for="sale_banner_text1">Text 1</label>
                                    <input type="text" class="form-control" value="<?=isset($frontData->sale_banner_text1) ? $frontData->sale_banner_text1:'';?>" name="sale_banner_text1" placeholder="Enter text 1">
                                  </div>
                                  <div class="form-group">
                                    <label for="sale_banner_text2">Text 2</label>
                                    <input type="text" class="form-control" value="<?=isset($frontData->sale_banner_text2) ? $frontData->sale_banner_text2:'';?>" name="sale_banner_text2" placeholder="Enter text 2">
                                  </div>
                                  <div class="form-group">
                                    <label for="sale_banner_btn_text">Button Text</label>
                                    <input type="text" class="form-control" value="<?=isset($frontData->sale_banner_btn_text) ? $frontData->sale_banner_btn_text:'Shop Now';?>" name="sale_banner_btn_text" placeholder="Enter button text">
                                  </div>
                                  <div class="form-group">
                                    <label for="sale_banner_btn_url">Button Url</label>
                                    <input type="text" class="form-control" value="<?=isset($frontData->sale_banner_btn_url) ? $frontData->sale_banner_btn_url:BASEURL;?>" name="sale_banner_btn_url" placeholder="Enter button url"> 
                                  </div>
                                  <div class="form-group">
                                    <label for="uploadIcons">Upload Image <span class="text-muted">( Image should be 950*550 )</span></label>
                                    <input type="file" name="uploadIcons" value="" onchange="fileuploadpreview(this)" >
                                    <div class="previewimg"><?=(isset($frontData->sale_banner_img) && !empty($frontData->sale_banner_img))?'<img src="'.UPLOADPATH.'/setting_images/'.$frontData->sale_banner_img.'" width="70px" height="50px">':'';?></div> 
                                  </div>
                                  <div class="col-md-12 mt-3 mb-3">
                                    <input type="hidden" name="action" value="addUpdateSetting">
                                    <input type="hidden" name="indexval" value="">
                                    <button type="submit" class="btn btn-success mr-2 actionbtn">Save</button>
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
            </div> 
        </div>
      </div>      
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
<?php $this->load->viewD('inc/footer.php'); ?>
<script src="https://www.jqueryscript.net/demo/Easy-Responsive-Tab-Accordion-Control-Plugin-For-jQuery/easy-responsive-tabs.js"></script>
<script type="text/javascript">
$(document).ready(function () {
$('#verticalTab').easyResponsiveTabs({
type: 'vertical',
width: 'auto',
fit: true
});
});




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
  // $(".livemultisearchmax8").chosen({
  //   disable_search_threshold: 5,
  //   no_results_text: "Oops, Vendor not found!",
  //   width: "100%",
  //   max_selected_options: 8
  // });
</script>