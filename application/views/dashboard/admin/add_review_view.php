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
                        <h4 class="card-title">Add Review<a href="<?=DASHURL.'/'.$this->sessDashboard?>/review/reviewlist" class="btn btn-success pull-right">Review List</a></h4>
                        <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateReview(this, event);">
                          <p class="msg"></p>

                          <p class="card-description">Review Info</p>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">User Name</label>
                                <div class="col-sm-9">
                                  <select class="form-control bindOrder" name="userId" id="userId" required="required">
                                          <option value="">Select User</option>
                                          <?php 
                                         if(!empty($userData))

                                          foreach( $userData as $userVal ){
                                            $selected = (isset($userId))?(($userId==$userVal->userId)?'Selected':''):'';
                                            echo '<option value="'.$userVal->userId.'" '.$selected.'>'.$userVal->firstName.' '.$userVal->lastName.'</option>';
                                          }
                                          ?>
                                  </select>
                                </div>
                              </div>
                            
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Product Name</label>
                                <div class="col-sm-9">
                                  <select class="form-control" name="productId" id="productId" required="required">
                                          <option value="">Select Product</option>
                                          <?php 
                                         if(!empty($productData))
                                          foreach( $productData as $productVal ) {
                                            $selected = (isset($productId))?(($productId==$productVal->productId)?'Selected':''):'';
                                            echo '<option value="'.$productVal->productId.'" '.$selected.'>'.$productVal->productName.'</option>';
                                          }
                                          ?>
                                  </select>
                                </div>
                              </div>
                            
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Rating</label>
                                <div class="col-sm-9">
                                  <select class="form-control Frenchise" name="rating" id="rating" required="required">
                                    <option value="">Select Rating</option>
                                    <option value="0" <?=isset($reviewData->rating)?(($reviewData->rating=='0')?'Selected':''):'';?>>0</option>
                                    <option value="1" <?=isset($reviewData->rating)?(($reviewData->rating=='1')?'Selected':''):'';?>>1</option>
                                    <option value="2" <?=isset($reviewData->rating)?(($reviewData->rating=='2')?'Selected':''):'';?>>2</option>
                                    <option value="3" <?=isset($reviewData->rating)?(($reviewData->rating=='3')?'Selected':''):'';?>>3</option>
                                    <option value="4" <?=isset($reviewData->rating)?(($reviewData->rating=='4')?'Selected':''):'';?>>4</option>
                                    <option value="5" <?=isset($reviewData->rating)?(($reviewData->rating=='5')?'Selected':''):'';?>>5</option>
                                  </select>
                                </div>
                              </div>
                             <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Review</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control firstinput" id="review" name="review" placeholder="Enter Review" value="<?=isset($reviewData->review)?$reviewData->review:'';?>" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Reviewer Name</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control firstinput" id="reviewerName" name="reviewerName" placeholder="Enter Reviewer Name" value="<?=isset($reviewData->reviewerName)?$reviewData->reviewerName:'';?>" required>
                                </div>
                              </div>
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Reviewer Email</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control firstinput" id="reviewerEmail" name="reviewerEmail" placeholder="Enter Reviewer Email" value="<?=isset($reviewData->reviewerEmail)?$reviewData->reviewerEmail:'';?>" required>
                                </div>
                              </div>
                              <div class="clearfix"></div>
                          
                          <input type="hidden" name="action" value="addReview">
                          <input type="hidden" name="hiddenval" value="<?=isset($reviewData->reviewId)?$reviewData->reviewId:0;?>">
                          <input type="hidden" name="indexval" value="">
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


<?php $this->load->viewD('inc/footer.php'); ?>
