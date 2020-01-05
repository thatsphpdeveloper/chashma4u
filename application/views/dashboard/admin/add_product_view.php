<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->
    <link rel="stylesheet" type="text/css" href="<?php echo DASHSTATIC;?>/admin/css/multiselect.css">
    <style type="text/css">
      .accordion-checkbox {
          width: 20px;
      }

      div#accordion {
          width: 100%;
      }

      div#accordion .form-check.form-check-flat {
          margin: 0px;
      }

      div#accordion .subcategoryItem-body .form-check.form-check-flat {
        margin: 8px 0;
      }

      div#accordion h5.mb-0 {
          display: flex;
          justify-content: left;
          align-items: center;
      }

      div#accordion h5.mb-0 a {
          padding-left: 15px;
      }

      div#accordion .card-header {
        background-color: rgb(221, 218, 218);
      }
      div#accordion .card .card-body {
          box-shadow: 0px 0px 0px #0000004d;
      }

      div#accordion .card .card-body {
          padding: 0.58rem 1.81rem;
      }

      div#accordion .card .subcategoryItem-body {
          background: #b2b6ba;
      }
      div#accordion a {
          width: 100%;
      }

      ul.multiselect-container.dropdown-menu li {
          min-height: 27px;
      }
      .multiselect-container>li>a {
          padding: 0;
          min-height: 27px;
      }
      ul.multiselect-container.dropdown-menu.show {
          width: 100%;
          background: #d8d9da;
          padding-right: 10px;
      }
      span.input-group-addon i {
          font-size: 18px;
          padding: 11px;
      }
      button.btn.btn-default.multiselect-clear-filter i {
          font-size: 23px;
      }
      ul.multiselect-container .input-group-addon, .input-group-btn {
        width: 5%;
      }
      .multiselect-native-select .dropdown-toggle::after {
        display: none;
      }
      .multiselect-container>li>a>label {
        line-height: 1.7;
      }
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
                        <h4 class="card-title">Add Product <a href="<?=DASHURL.'/'.$this->sessDashboard?>/product/productlist" class="btn btn-success pull-right">Product List</a></h4>
                        <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateProduct(this, event);">
                          <p class="msg"></p>
                          <div class="form-group">
                            <label for="productName">Name</label>
                            <input type="text" class="form-control firstinput" id="productName" value="<?=isset($productData->productName) ? $productData->productName:'';?>" name="productName" placeholder="Enter Product Name" required>
                          </div>
                          <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control firstinput" id="slug" value="<?=isset($productData->slug) ? $productData->slug:'';?>" name="slug" placeholder="Enter slug">
                          </div>
                          <div class="form-group">
                            <label for="productName">SKU Code</label>
                            <input type="text" class="form-control firstinput" id="sku" value="<?=isset($productData->sku) ? $productData->sku:'';?>" name="sku" placeholder="Enter SKU code">
                          </div>
                          <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control textEditor aboutus" name="description" value="" tabindex="5" required><?=isset($productData->description) ? $productData->description:'';?></textarea>
                          </div>                          
                          <div class="form-group">
                            <label for="productCategory">Category</label>
                            <div class="categoryArea mt-1 mb-4">
                              
                              <?php 
                              $selectedCategory =  $selectedSubcategory = $selectedSubcategoryItem = array();
                                if(isset($productSelectedCategory) && !empty($productSelectedCategory)) {
                                  foreach( $productSelectedCategory as $categorySelectedVal ) {
                                    if (isset($categorySelectedVal->categoryType) && $categorySelectedVal->categoryType == 'category' && !empty($categorySelectedVal->categoryIds)) {
                                      $selectedCategory = explode(',', $categorySelectedVal->categoryIds);
                                    }else if (isset($categorySelectedVal->categoryType) && $categorySelectedVal->categoryType == 'subcategory' && !empty($categorySelectedVal->categoryIds)) {
                                      $selectedSubcategory = explode(',', $categorySelectedVal->categoryIds);
                                    }else if (isset($categorySelectedVal->categoryType) && $categorySelectedVal->categoryType == 'subcategoryItem' && !empty($categorySelectedVal->categoryIds)) {
                                      $selectedSubcategoryItem = explode(',', $categorySelectedVal->categoryIds);
                                    }
                                  }
                                }
                                $categoryHtml = '';

                                if(isset($categoryList) && !empty($categoryList)) {

                                  $countCatSection = 0;
                                  $categoryHtml .='<div id="accordion">';
                                  foreach( $categoryList as $categoryVal ) {
                                   $categoryHtml .='<div class="card category-card">
                                    <div class="card-header" id="heading-'.$categoryVal->categoryId.'">
                                    <h5 class="mb-0">
                                      <div class="accordion-checkbox">
                                        <div class="form-check form-check-flat">
                                          <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input category-checkbox" name="mainCategory[]" value="'.$categoryVal->categoryId.'" '.((in_array($categoryVal->categoryId, $selectedCategory))?'checked':'').'>&nbsp;
                                            <i class="input-helper"></i>
                                          </label>
                                        </div>
                                      </div>
                                      <a role="button" data-toggle="collapse" href="#collapse-'.$categoryVal->categoryId.'" aria-expanded="false" aria-controls="collapse-'.$categoryVal->categoryId.'" class="collapsed">
                                        '.$categoryVal->categoryName.'
                                      </a>
                                    </h5>
                                    </div>
                                    <div id="collapse-'.$categoryVal->categoryId.'" class="collapse" data-parent="#accordion" aria-labelledby="heading-'.$categoryVal->categoryId.'">
                                    <div class="card-body">';
                                    if(isset($categoryVal->subCategoryList) && !empty($categoryVal->subCategoryList)) {
                                      $categoryHtml .='<div id="accordion-'.$categoryVal->categoryId.'">';
                                      foreach( $categoryVal->subCategoryList as $subCategoryVal) {
                                        $categoryHtml .='
                                        <div class="card subcategory-card">
                                        <div class="card-header" id="heading-'.$categoryVal->categoryId.'-'.$subCategoryVal->subcategoryId.'">
                                        <h5 class="mb-0">

                                          <div class="accordion-checkbox">
                                            <div class="form-check form-check-flat">
                                              <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input subcategory-checkbox" name="subCategory[]" value="'.$subCategoryVal->subcategoryId.'"'.((in_array($subCategoryVal->subcategoryId, $selectedSubcategory))?'checked':'').' />&nbsp;
                                                <i class="input-helper"></i>
                                              </label>
                                            </div>
                                          </div>
                                          <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-'.$categoryVal->categoryId.'-'.$subCategoryVal->subcategoryId.'" aria-expanded="false" aria-controls="collapse-'.$categoryVal->categoryId.'-'.$subCategoryVal->subcategoryId.'">'.$subCategoryVal->subcategoryName.'
                                          </a>
                                        </h5>
                                        </div>
                                        <div id="collapse-'.$categoryVal->categoryId.'-'.$subCategoryVal->subcategoryId.'" class="collapse" data-parent="#accordion-'.$categoryVal->categoryId.'" aria-labelledby="heading-'.$categoryVal->categoryId.'-'.$subCategoryVal->subcategoryId.'">
                                        <div class="card-body subcategoryItem-body">';
                                        if(isset($subCategoryVal->subcategoryItemList) && !empty($subCategoryVal->subcategoryItemList)) {
                                          $categoryHtml .='<div class="row">
                                          <div class="col-md-12"><div class="form-group">';
                                          foreach( $subCategoryVal->subcategoryItemList as $subCategoryItemVal) {
                                            $categoryHtml .='
                                                    <div class="form-check form-check-flat">
                                                      <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input subcategoryItem-checkbox" name="subCategoryItem[]" value="'.$subCategoryItemVal->subcategoryItemId.'"'.((in_array($subCategoryItemVal->subcategoryItemId, $selectedSubcategoryItem))?'checked':'').'> '.$subCategoryItemVal->subcategoryItemName.'
                                                        <i class="input-helper"></i></label>
                                                    </div>';
                                          }
                                          $categoryHtml .='</div></div></div>';

                                        }

                                        $categoryHtml .='</div>
                                        </div>
                                        </div>';
                                      }
                                      $categoryHtml .='</div>';
                                    }
                                    $categoryHtml .='</div>
                                    </div>
                                    </div>';
                                  }
                                  $categoryHtml .='</div>';                            
                                }
                                echo $categoryHtml;
                              ?>
                          </div>
                          </div>
                          <div class="clearfix"></div>
                           <div class="form-group hide">
                            <label> Product Type </label>
                            <!-- <div class="form-radio form-radio-flat ">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input productType" name="productType" value="0" <?=(isset($productData->productType) && $productData->productType != 1) ? 'checked':((!isset($productData->productType)) ? 'checked':'');?>> Simple
                              <i class="input-helper"></i></label>
                            </div> -->
                            <div class="form-radio form-radio-flat">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input productType" name="productType" value="1" <?=(isset($productData->productType) && $productData->productType == 1) ? 'checked':'checked';?>> Variable 
                              <i class="input-helper"></i></label>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                          <div class="simpleProductSection hide" style="<?=(isset($productData->productType) && $productData->productType == 1) ? 'display: none;':'';?>">
                            <div class="form-group col-md-6 nopadding">
                              <label for="actualPrice">Actual Price</label>
                              <input type="text" class="form-control" id="actualPrice" value="<?=isset($productData->actualPrice) ? $productData->actualPrice:0;?>" name="actualPrice" placeholder="Enter Product Actual Price" onkeydown="OnlyNumericKey(event)" required>
                            </div>
                            <div class="form-group col-md-6 salePrice">
                              <label for="salePrice">Sale Price</label>
                              <input type="text" class="form-control" id="salePrice" value="<?=isset($productData->salePrice) ? $productData->salePrice:0;?>" name="salePrice" placeholder="Enter Product Sale Price" data-previousValue="<?=isset($productData->salePrice) ? $productData->salePrice:0;?>" onkeyup="checkActualPrice(this)" onkeydown="OnlyNumericKey(event)" required>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                         
                            <?php                                
                               $colorOptions = $sizeOptions = '';
                              if(isset($attributeData) && !empty($attributeData)) {
                                  
                                  foreach($attributeData as $attribute) {
                                      
                                    $options = '<option value="'.$attribute->name.'"> '.$attribute->name.'</option>';
                                    if($attribute->attributeId == 1)
                                      $colorOptions .= $options;
                                    else if($attribute->attributeId == 2)
                                      $sizeOptions .= $options;
                                  }
                              } 

                              $rgnOptions ='';
                              for ($i= 1.00; $i <= 4.00; $i += 0.50) {
                                  $j = number_format((float)$i, 2, '.', '');
                                  $j = ($j > 0)? '+'.$j:$j;
                                  $rgnOptions .= '<option value="'.$j.'">'.$j.'</option>';
                                  
                              }


                              ?>
                          <div class="card variationProductSection">
                            <div class="card-body">
                              <h4 class="card-title">Variation</h4>                             
                              <div class="col-md-12 borderClass variationSection">
                                <?php if(isset($variableData) && !empty($variableData)){
                                  foreach ($variableData as $vkey => $variable) {
                                    echo ' <div class="col-md-12 borderClass variationInfo">
                                    <button class="btn btn-icons btn-rounded btn-light removeVariationItem pull-right mb-2" title="Remove" type="button"><i class="fa fa-times"></i></button>
                                    <div class="variationItems">
                                      <div class="form-group">
                                        <label for="variationTitle">Variation Title</label>
                                        <input type="text" class="form-control"  placeholder="Variation Title" name="variationTitle[]" value="'.(isset($variable->variableTitle)?$variable->variableTitle:'').'">
                                        <input type="hidden" name="variableId[]" value="'.$variable->variableId.'" />
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label for="color">Color</label>
                                        <select class="form-control selectbyvalue" name="color[]" data-value="'.$variable->color.'">
                                          <option value="">Select Color</option>
                                          '.$colorOptions.'
                                        </select>
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label for="size">Size</label>
                                        <select class="form-control selectbyvalue" name="size[]" data-value="'.$variable->size.'">
                                          <option value="">Select Size</option>
                                          '.$sizeOptions.'
                                        </select>
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label for="rgn">Number</label>
                                        <select class="form-control selectbyvalue" name="rgn[]" data-value="+'.number_format((float)$variable->rgn, 2, '.', '').'">
                                          <option value="">Select Number</option>
                                          '.$rgnOptions.'
                                        </select>
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label for="qty">Quantity</label>
                                        <input type="text" class="form-control"  value="'.(isset($variable->qty)?$variable->qty:0).'" name="qty[]" onkeydown="OnlyNumericKey(event)" placeholder="Enter Product Quantity" >
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label for="actualPrice">Actual Price</label>
                                        <input type="text" class="form-control"  value="'.(isset($variable->actualPrice)?$variable->actualPrice:0).'" name="variationActualPrice[]" onkeydown="OnlyNumericKey(event)" placeholder="Enter Product Actual Price" >
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label for="salePrice">Sale Price</label>
                                        <input type="text" class="form-control"  value="'.(isset($variable->salePrice)?$variable->salePrice:0).'" name="variationSalePrice[]" onkeydown="OnlyNumericKey(event)" placeholder="Enter Product Sale Price" >
                                      </div>
                                      <div class="clearfix"></div>
                                      <div class="form-group">
                                        <label for="variationImages">Upload Image</label>
                                        <input type="file" name="variationImages[]" value=""> '.((isset($variable->img) && urlExist($variable->img))?'<img src="'.$variable->img.'" class="preview_img">':'').'
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>
                                  </div>';
                                  }
                                }else{?> 
                                  <div class="col-md-12 borderClass variationInfo"><button class="btn btn-icons btn-rounded btn-light removeVariationItem pull-right mb-2" title="Remove" type="button"><i class="fa fa-times"></i></button>
                                    <div class="variationItems">
                                      <div class="form-group">
                                        <label for="variationTitle">Variation Title</label>
                                        <input type="text" class="form-control"  placeholder="Variation Title" name="variationTitle[]" >
                                        <input type="hidden" name="variableId[]" value="0" />
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label for="color">Color</label>
                                        <select class="form-control" name="color[]">
                                          <option value="">Select Color</option>
                                          <?=$colorOptions?>
                                        </select>
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label for="size">Size</label>
                                        <select class="form-control" name="size[]">
                                          <option value="">Select Size</option>
                                          <?=$sizeOptions?>
                                        </select>
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label for="size">Number</label>
                                        <select class="form-control" name="rgn[]" >
                                          <option value="">Select Number</option>
                                          <?=$rgnOptions?>
                                        </select>
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label for="qty">Quantity</label>
                                        <input type="text" class="form-control"  value="0" name="qty[]" onkeydown="OnlyNumericKey(event)" placeholder="Enter Product Quantity" >
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label for="actualPrice">Actual Price</label>
                                        <input type="text" class="form-control" value="" name="variationActualPrice[]" onkeydown="OnlyNumericKey(event)" placeholder="Enter Product Actual Price" >
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label for="salePrice">Sale Price</label>
                                        <input type="text" class="form-control" value="" name="variationSalePrice[]" onkeydown="OnlyNumericKey(event)" placeholder="Enter Product Sale Price" >
                                      </div>
                                      <div class="clearfix"></div>
                                      <div class="form-group">
                                        <label for="variationImages">Upload Image</label>
                                        <input type="file" name="variationImages[]" value=""> 
                                      </div>
                                      <div class="clearfix"></div>
                                    </div>
                                  </div>
                                <?php } ?>
                                  <button type="button" class="btn btn-success addMoreVariations"><i class="fa fa-plus"></i> Add More</button>
                              </div>  
                            </div>
                          </div>
                          <div class="clearfix"></div>
                          <div class="form-group">
                              <label for="brandId">Brand</label>
                              <select class="form-control" name="brandId" id="brandId" required>
                                <option value="">Select Brand</option>
                                <?php 
                                  $selectedBrandId = (isset($productData->brandId) && !empty($productData->brandId))?$productData->brandId:0;

                                  if(isset($brandData) && !empty($brandData)) {
                                      foreach($brandData as $brand) {          
                                          echo '<option value="'.$brand->brandId.'" '.(($selectedBrandId == $brand->brandId)?'selected':"").'> '.$brand->brandName.'</option>';
                                      }
                                  }  ?>
                              </select>
                          </div>
                          <div class="form-group">
                              <label for="shapeId">Shape</label>
                              <select class="form-control" name="shapeId" id="shapeId" required>
                                <option value="">Select Shape</option>
                                <?php 
                                  $selectedShapeId = (isset($productData->shapeId) && !empty($productData->shapeId))?$productData->shapeId:0;

                                  if(isset($shapeData) && !empty($shapeData)) {
                                      foreach($shapeData as $shape) {          
                                          echo '<option value="'.$shape->shapeId.'" '.(($selectedShapeId == $shape->shapeId)?'selected':"").'> '.$shape->shapeName.'</option>';
                                      }
                                  }  ?>
                              </select>
                          </div>



                          <div class="form-group col-md-6 nopadding hide">
                            <label> Is Same Day Delivery </label>
                            <div class="form-radio form-radio-flat ">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input issameDayDelivery" name="issameDayDelivery" value="1" <?=(!isset($productData->isSameDayDelivery) || $productData->isSameDayDelivery == 1) ? 'checked':'';?>> Yes
                              <i class="input-helper"></i></label>
                            </div>
                            <div class="form-radio form-radio-flat">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input issameDayDelivery" name="issameDayDelivery" value="0" <?=(isset($productData->isSameDayDelivery) && $productData->isSameDayDelivery == 0) ? 'checked':'';?>> No 
                              <i class="input-helper"></i></label>
                            </div>
                          </div>
                          <div class="form-group col-md-3 futureTimeDelivery hide" style="<?=(isset($productData->isSameDayDelivery) && $productData->isSameDayDelivery == 0) ? 'display: none':'';?>">

                              <label for="minHourReqtoDeliver"> Minimum Hour Required  </label>
                              <select class="form-control" name="minHourReqtoDeliver" id="minHourReqtoDeliver">
                                  <option value="">Select Hour</option>
                                  <?php 
                                      for($i = 0; $i < 24; $i++) { 
                                          $isHourSelected = (isset($productData->minHourReqtoDeliver) && $productData->minHourReqtoDeliver == $i) ? 'Selected' :'' ;
                                              ?>
                                          <option value="<?php echo $i?>" <?php echo $isHourSelected; ?> ><?php echo $i;?></option>
                                    <?php }   ?>
                              </select>
                          </div>
                          <div class="form-group col-md-3 futureTimeDelivery hide" style="<?=(isset($productData->isSameDayDelivery) && $productData->isSameDayDelivery == 0) ? 'display: none':'';?>">

                              <label for="minMinuteReqtoDeliver"> Minimum Minute Required  </label>
                              <select class="form-control" name="minMinuteReqtoDeliver" id="minMinuteReqtoDeliver">
                                  <option value="">Select Minute</option>
                                  <?php 
                                      for($i = 0; $i < 60; $i++) { 
                                          $isMinuteSelected = (isset($productData->minMinuteReqtoDeliver) && $productData->minMinuteReqtoDeliver == $i) ? 'Selected' :'' ;
                                              ?>
                                          <option value="<?php echo $i?>" <?php echo $isMinuteSelected; ?> ><?php echo ($i<10)?'0'.$i:$i;?></option>
                                    <?php }   ?>
                              </select>
                          </div>
                          <div class="form-group col-md-6 futureDayDelivery hide" style="<?=(isset($productData->isSameDayDelivery) && $productData->isSameDayDelivery == 0) ? '':'display: none';?>">
                              <label for="minDayReqtoDeliver"> Number of Days Required </label>
                              <input type="text" class="form-control" id="minDayReqtoDeliver" value="<?=isset($productData->minDayReqtoDeliver)? $productData->minDayReqtoDeliver:'';?>" name="minDayReqtoDeliver" placeholder="Number of Days Required" onkeydown="OnlyNumericKey(event)" >
                          </div>

                          <div class="col-md-12 courier-delivery-box hide" style="<?=(isset($productData->isSameDayDelivery) && $productData->isSameDayDelivery == 0) ? '':'display: none';?>">
                              <label>&nbsp;</label>
                              <div class="form-check form-check-flat">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input isCod" name="isCourierDelivery" id="isCourierDelivery" value="1" > Is Courier Delivery?
                                <i class="input-helper"></i></label>
                              </div>
                          </div>

                          <div class="clearfix"></div>
                          <div class="form-group col-md-6 nopadding hide">
                            <label> Delivery Cities </label>
                            <div class="form-radio form-radio-flat ">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input deliveryCities" name="deliveryCities" value="0" <?=(!isset($productData->isSpecificDeliverCity) || $productData->isSpecificDeliverCity == 0) ? 'checked':'';?>> All Cities with Exception
                              <i class="input-helper"></i></label>
                            </div>
                            <div class="form-radio form-radio-flat">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input deliveryCities" name="deliveryCities" value="1" <?=(isset($productData->isSpecificDeliverCity) && $productData->isSpecificDeliverCity == 1) ? 'checked':'';?>> Specific Cities 
                              <i class="input-helper"></i></label>
                            </div>
                          </div>
                          <div class="form-group col-md-6 excludedCities  hide" style="<?=(isset($productData->isSpecificDeliverCity) && $productData->isSpecificDeliverCity == 1) ? 'display: none':'';?>">
                              <label for="excludedCities"> Exclude Cities </label>
                              <input type="text" class="form-control tagCitiesInputs" id="excludedCities" value="<?=isset($productData->undeliverCityId)? $productData->undeliverCityId:'';?>" name="excludedCities"  placeholder="Exclude Cities">
                          </div>
                          <div class="form-group col-md-6 specificCities hide" style="<?=(isset($productData->isSpecificDeliverCity) && $productData->isSpecificDeliverCity == 1) ? '':'display: none';?>">
                              <label for="specificCities"> Specific Cities </label>
                              <input type="text" class="form-control tagCitiesInputs" id="specificCities" value="<?=isset($productData->deliveryCityId)? $productData->deliveryCityId:'';?>" name="specificCities" placeholder="Specific Cities"  >
                          </div>
                          <div class="clearfix"></div>
                          <div class="form-group excludePinCodes hide">
                              <label for="excludePinCodes">Exclude Pincodes </label>
                              <input type="text" class="form-control tagPincodeInputs" id="excludePinCodes" value="" name="excludePinCodes" placeholder="Exclude Pincodes" autocomplete="off" >
                          </div>
                          <div class="col-md-12 nopadding hide">
                              <div class="form-check form-check-flat">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input isCod" name="isCod" value="1" <?=(isset($productData->isCod) && $productData->isCod == 1) ? 'checked':'';?>> Is cash on delivery available ?
                                <i class="input-helper"></i></label>
                              </div>
                          </div>
                          <div class="clearfix"></div>
                          <div class="form-group">
                            <?php $featuredImage = ((isset($productData->img) && urlExist($productData->img))?'<div class="featured-image"><img src="'.$productData->img.'" class=""></div>':'');?>
                            <label for="featuredImage">Featured Image</label>
                            <input type="file" id="productName" value="" name="featuredImage" <?=(!empty($featuredImage)?'':'required')?>>
                            <?=(!empty($featuredImage)?$featuredImage:'')?>
                          </div>
                          <div class="form-group">
                            <label for="galleryImage">Gallery Image</label>
                            <div class="col-md-12 gallerySectionArea">
                              <div class="col-md-3 imageSection">
                                <input type="file"  value="" name="galleryImage[]">
                                <button class="btn btn-icons btn-rounded btn-light removeImages pull-right" title="Remove" type="button"><i class="fa fa-times"></i></button>
                              </div>
                              <button type="button" class="btn btn-success addMoreImages pull-right"><i class="fa fa-plus"></i> Add More</button>
                            </div>
                            <div class="col-md-12 galleryImagesArea">
                              <?php if(isset($productgalleryImage) && !empty($productgalleryImage)){
                                    foreach ($productgalleryImage as $gallery) {
                                      if (isset($gallery->iconsUrl) && urlExist($gallery->iconsUrl)) {
                                        echo '<div class="col-md-2 gallery-image"><img src="'.$gallery->iconsUrl.'" class=""><button type="button" class="btn btn-icons btn-rounded btn-danger btn-remove-image pull-right" onclick="delete_image(this,\'product-gallery-image\', '.$gallery->productImageId.')"><i class="fa fa-trash-o"></i></button></div>';
                                      }
                                    }
                                  }

                              ?>
                            </div>
                          </div>
                          <div class="clearfix"></div>
                          <div class="form-group">
                            <label for="videoLink">Video Link</label>
                            <input type="text" class="form-control" id="videoLink" name="videoLink" placeholder="Enter video link" value="<?=isset($productData->videoLink)? $productData->videoLink:'';?>">
                          </div>
                          <div class="form-group">
                            <label for="metaTitle">Meta Title</label>
                            <input type="text" class="form-control" id="metaTitle" name="metaTitle" placeholder="Enter meta title" maxlength="65" value="<?=isset($productData->metaTitle)? $productData->metaTitle:'';?>">
                          </div>
                          <div class="form-group">
                            <label for="metaDescription">Meta Description</label>
                            <textarea class="form-control" id="metaDescription" rows="3" name="metaDescription" maxlength="150" placeholder="Meta Description"><?=isset($productData->metaDescription)? $productData->metaDescription:'';?></textarea>
                          </div>
                          <div class="form-group">
                            <label for="metaKeywords">Meta Keywords</label>
                            <textarea class="form-control" id="metaKeywords" rows="3" name="metaKeywords" placeholder="Meta Keywords"><?=isset($productData->keywords)? $productData->keywords:'';?></textarea>
                          </div>
                          <input type="hidden" name="action" value="addProduct">
                          <input type="hidden" name="hiddenval" value="<?=isset($productData->productId)? $productData->productId:0;?>">
                          <input type="hidden" name="indexval" value="">
                          <button type="submit" class="btn btn-success mr-2 actionbtn">Submit</button>
                          <button class="btn btn-light">Cancel</button>
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
<style type="text/css">
  button.btn.btn-icons.btn-rounded.btn-light.removeAttributesOptions {
    position: absolute;
    right: 2px;
    top: 19px;
  }
  .removeVariationItem {
    position: absolute;
    right: 2px;
    top: 2px;
  }
  .preview_img{
    width: 100px;
  }
  .gallery-image img{
    width: 100%;
    border: 1px solid black;
    padding: 2px;
    margin-bottom: 10px;
    max-height: 100px;
  }
  .btn-remove-image{
    position: absolute;
    top: -9px;
    right: 0px;
  }
  .col-md-12.galleryImagesArea {
    margin-top: 25px;
    margin-bottom: 25px;
  }
  .featured-image img {
    width: 100%;
    border: 1px solid black;
    padding: 2px;
    height: 100%;
  }
  .featured-image {
    margin: 12px 0 12px 0;
    max-width: 140px;
    height: 100px;
  }
</style>

<script type="text/javascript">
  
  var deliverCityData = <?=(isset($deliverCityData) && !empty($deliverCityData))? json_encode($deliverCityData):json_encode(array());?>;
  var undeliverCityData = <?=(isset($undeliverCityData) && !empty($undeliverCityData))? json_encode($undeliverCityData):json_encode(array());?>;
  var undeliverPincodeData = <?=(isset($undeliverPincodeData) && !empty($undeliverPincodeData))? json_encode($undeliverPincodeData):json_encode(array());?>;


  $(document).ready(function() {
    // if (deliverCityData) {
    //   $.each(deliverCityData, function(i, item) {
    //     $("#specificCities").tagsinput('add', { "value": item.zoneId , "text": item.zoneName });
    //   });
    // }
    // if (undeliverCityData) {
    //   $.each(undeliverCityData, function(i, item) {
    //     $("#excludedCities").tagsinput('add', { "value": item.zoneId , "text": item.zoneName });
    //   });
    // }
    // if (undeliverPincodeData) {
    //   $.each(undeliverPincodeData, function(i, item) {
    //     $("#excludePinCodes").tagsinput('add', { "value": item.pincodeId , "text": item.pincode });
    //   });
    // }

    if ($(".selectbyvalue").length) {
      $(".selectbyvalue").each(function(i) {
        $( this ).val($( this ).data('value'));
      });
    }
    
    $('.variationProductSection').find('input[type=text], select').not('input[name="variationSalePrice[],input[name="rgn[]"]').each(function(){
        $(this).prop('required', true);
      });



});

                                      
  /******************* Variation Section*******************/
  $(document).on('click', '.addMoreVariations', function(){
    $('<div class="col-md-12 borderClass variationInfo"><button class="btn btn-icons btn-rounded btn-light removeVariationItem pull-right mb-2" title="Remove" type="button"><i class="fa fa-times"></i></button><div class="variationItems"><div class="form-group"><label for="variationTitle">Variation Title</label><input type="text" class="form-control"placeholder="Variation Title" name="variationTitle[]" required><input type="hidden" name="variableId[]" value="0" /></div><div class="form-group col-md-6"> <label for="color">Color</label> <select class="form-control" name="color[]"> <option value="">Select Color</option> <?=$colorOptions?> </select> </div> <div class="form-group col-md-6"> <label for="size">Size</label> <select class="form-control" name="size[]"> <option value="">Select Size</option> <?=$sizeOptions?> </select> </div><div class="form-group col-md-6"> <label for="size">rgn</label> <select class="form-control" name="rgn[]"> <option value="">Select number</option> <?=$rgnOptions?></select> </div> <div class="form-group col-md-6"> <label for="qty">Quantity</label> <input type="text" class="form-control"  value="0" name="qty[]" onkeydown="OnlyNumericKey(event)" placeholder="Enter Product Quantity" > </div><div class="form-group col-md-6"><label for="actualPrice">Actual Price</label><input type="text" class="form-control" value="" name="variationActualPrice[]" onkeydown="OnlyNumericKey(event)" placeholder="Enter Product Actual Price" required></div><div class="form-group col-md-6"><label for="salePrice">Sale Price</label><input type="text" class="form-control" value="" name="variationSalePrice[]" onkeydown="OnlyNumericKey(event)" placeholder="Enter Product Sale Price" required></div><div class="clearfix"></div><div class="form-group"><label for="variationImages">Upload Image</label><input type="file" name="variationImages[]" value=""></div><div class="clearfix"></div></div></div>').insertBefore($(this));
  });
  $(document).on('click', '.removeVariationItem', function(){   
    if ($(this).closest('div.variationSection').find('div.variationInfo').length == 1){
      $(this).closest('div.variationSection').find('button.addMoreVariations').trigger( "click" );
      $(this).closest('div.variationSection').find('button.removeVariationItem:last').remove();
    }
    $(this).closest('.variationInfo').remove();
  });
  
  // $(document).on('change', '.productType', function() {
  //   if( $(this).val() == 0 ) {
  //     $('.simpleProductSection').show();
  //     $('.simpleProductSection').find('input[type=text]').each(function(){
  //       $(this).prop('required', true);
  //     });
  //     $('.variationProductSection').find('input[type=text]').each(function(){
  //       $(this).prop('required', false);
  //     });
  //     $('.variationProductSection').hide();
  //   }
  //   else {
  //     $('.simpleProductSection').hide();
  //     $('.variationProductSection').show();
  //     $('.simpleProductSection').find('input[type=text]').each(function(){
  //       $(this).prop('required', false);
  //     });
  //     $('.variationProductSection').find('input[type=text]').each(function(){
  //       $(this).prop('required', true);
  //     });
  //   }
  // });
  // $(document).on('change', '.issameDayDelivery', function() {
  //   if( $(this).val() == 0 ) {
  //     $('.futureDayDelivery, .courier-delivery-box').show();
  //     $('#minDayReqtoDeliver').prop('required', true);
  //     $('.futureTimeDelivery').hide();
  //     $('#minHourReqtoDeliver').prop('required', false);
  //     $('#minMinuteReqtoDeliver').prop('required', false);
  //   }
  //   else {
  //     $('.futureTimeDelivery').show();
  //     $('#minHourReqtoDeliver').prop('required', true);
  //     $('#minMinuteReqtoDeliver').prop('required', true);
  //     $('.futureDayDelivery, .courier-delivery-box').hide();
  //     $('#numberOfDaysRequired, #isCourierDelivery').prop('required', false);
  //   }
  // });

  // $(document).on('change', '#isMessageReq', function(){

  //   if($(this).prop("checked") == true) {
  //     $('.messagePlaceholder').removeClass('hide');
  //   }
  //   else {
  //     $('.messagePlaceholder').addClass('hide');
  //   }
  // });

  // $(document).on('change', '.isPhotoReq', function(){
  //   if($(this).prop("checked") == true) {
  //     $('.isPhotoReqInfo').removeClass('hide');
  //     $('#isPhotoReqInfo').prop("required", true);
  //   }
  //   else {
  //     $('.isPhotoReqInfo').addClass('hide');
  //     $('#isPhotoReqInfo').prop("required", false);
  //   }
  // });
  // $(document).on('change', '.deliveryCities', function() {
  //   if( $(this).val() == 1 ) {
  //     $('.specificCities').show();
  //     $('.excludedCities').hide();
  //     $('#specificCities').prop('required', true);
  //   }
  //   else {
  //     $('.specificCities').hide();
  //     $('.excludedCities').show();
  //     $('#specificCities').prop('required', false);
  //   }
  // });
  $(document).on('click', '.addMoreImages', function(){
    $('<div class="col-md-3 imageSection"><input type="file"  value="" name="galleryImage[]"><button class="btn btn-icons btn-rounded btn-light removeImages pull-right" title="Remove" type="button"><i class="fa fa-times"></i></button></div>').insertBefore($(this));

  });
  $(document).on('click', '.removeImages', function(){
    $(this).closest('.imageSection').remove();
  });
  /******************* End Product Section ***************/


  function checkActualPrice(obj){
    if(parseFloat($('#actualPrice').val()) <= parseFloat($(obj).val())){
      if(parseFloat($(obj).attr('data-previousValue')) <= parseFloat($('#actualPrice').val()))
        $(obj).val($(obj).attr('data-previousValue'));
      else
        $(obj).val($('#actualPrice').val());

      $(obj).closest('div').find('label.error').length > 0 ? "" : $(obj).closest('div').append( '<label class="error text-danger">Sale price must be less than actual price.</label>');
    
    }
    else{
      $(obj).closest('div').find('label.error').remove();
      $(obj).attr('data-previousValue', $(obj).val());
    }
  }

  $(document).on('change', '.subcategoryItem-checkbox', function(){
    if($(this).is(':checked')){
      $(this).closest('.subcategory-card').find('.subcategory-checkbox').prop('checked', true);
      $(this).closest('.category-card').find('.category-checkbox').prop('checked', true);
    }else{
      if(!$(this).closest('.subcategory-card').find('.subcategoryItem-checkbox:checked').length){
        $(this).closest('.subcategory-card').find('.subcategory-checkbox').prop('checked', false);
      }
      if(!$(this).closest('.category-card').find('.subcategory-checkbox:checked').length){
        $(this).closest('.category-card').find('.category-checkbox').prop('checked', false);
      }
    }
  });

  $(document).on('change', '.subcategory-checkbox', function(){
    if($(this).is(':checked')){
      $(this).closest('.subcategory-card').find('.subcategoryItem-checkbox').prop('checked', true);
      $(this).closest('.category-card').find('.category-checkbox').prop('checked', true);
    }else{
      $(this).closest('.subcategory-card').find('.subcategoryItem-checkbox').prop('checked', false);

      if(!$(this).closest('.category-card').find('.subcategory-checkbox:checked').length){
        $(this).closest('.category-card').find('.category-checkbox').prop('checked', false);
      }
    }
  });

  $(document).on('change', '.category-checkbox', function(){
    if($(this).is(':checked')){
      $(this).closest('.category-card').find('.subcategory-checkbox, .subcategoryItem-checkbox').prop('checked', true);
    }else{
      $(this).closest('.category-card').find('.subcategory-checkbox, .subcategoryItem-checkbox').prop('checked', false);
    }
  });

</script>


