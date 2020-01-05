<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->
<?php $this->load->viewD('inc/sidebar.php'); ?>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.0/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css"/>
<style type="text/css">
  /*.navbar {
    margin-bottom: 0px;
}

.page-body-wrapper:not(.auth-page) {
    padding-top: 0px;
}*/
.fixed-top {
    position: fixed;
    top: 0;
    right: 0;
    left: 0;
    z-index: 1030;
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
                        <h4 class="card-title">Add Coupon <a href="<?=DASHURL.'/'.$this->sessDashboard?>/coupon/couponlist" class="btn btn-success pull-right">Coupon List</a></h4>
                        <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateCoupon(this, event);">
                          <p class="msg"></p>                         
                            <div class="row pb-5">
                              <div class="col-md-6">
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">Coupon Code</label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control firstinput" id="couponCode" name="couponCode" placeholder="Enter Coupon Code" value="<?=isset($couponData->couponCode)?$couponData->couponCode:'';?>" required>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">Discount Type</label>
                                  <div class="col-sm-9">
                                    <select class="form-control" id="discountType" name="discountType">
                                      <option value="flat" <?=(isset($couponData->discountType) && $couponData->discountType =='flat')?'selected':'';?>>Flat</option>
                                      <option value="percentage" <?=(isset($couponData->discountType) && $couponData->discountType =='percentage')?'selected':'';?>>Percentage</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6 discount-section">
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label"><?=(isset($couponData->discountType) && $couponData->discountType =='percentage')?'Discount Percentage':'Flat Discount Amt';?></label>
                                  <div class="col-sm-9">
                                    <input type="number" class="form-control" min="0"  id="discount" name="discount" placeholder="Enter <?=(isset($couponData->discountType) && $couponData->discountType =='flat')?'Flat Discount Amt':'Discount Percentage';?>" value="<?=isset($couponData->discount)?$couponData->discount:0;?>" required>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6 max-discount-section hide">
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">Max Discount Amt</label>
                                  <div class="col-sm-9">
                                    <input type="number" class="form-control" min="0"  id="maxDiscountAmt" name="maxDiscountAmt" placeholder="Enter Max Discount Amt" value="<?=isset($couponData->maxDiscountAmt)?$couponData->maxDiscountAmt:0;?>" required>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">Min Order Amt</label>
                                  <div class="col-sm-9">
                                    <input type="number" class="form-control" min="0"  id="minOrderAmt" name="minOrderAmt" placeholder="Enter Min Order Amt" value="<?=isset($couponData->minOrderAmt)?$couponData->minOrderAmt:0;?>" required>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">Start Date Time</label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control" id="startDate" name="startDate" placeholder="Choose Start Date Time" value="<?=isset($couponData->startDate)?date('m-d-Y h:i A',strtotime($couponData->startDate)):'';?>" required>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">End Date Time</label>
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control" id="endDate" name="endDate" placeholder="Choose End Date Time" value="<?=isset($couponData->endDate)?date('m-d-Y h:i A',strtotime($couponData->endDate)):'';?>" required>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">Max Usage per User</label>
                                  <div class="col-sm-9">
                                    <input type="number" class="form-control" min="0" id="maxUsagePerUser" name="maxUsagePerUser" placeholder="Max Usage Per User" value="<?=isset($couponData->maxUsagePerUser)?$couponData->maxUsagePerUser:0;?>" required>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="form-group row">
                                  <label class="col-sm-12 col-form-label">Message to be displayed on the website</label>
                                  <div class="col-sm-12">
                                    <textarea class="form-control" id="description" rows="3" name="description" placeholder="Enter Message to be displayed on the website"><?=isset($couponData->description)?$couponData->description:'';?></textarea>
                                  </div>
                                </div>
                              </div>

                              <div class="col-md-12">
                                  <div class="form-check form-check-flat">
                                    <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" name="isVisibleInCouponPage" value="1" <?=(isset($couponData->isVisibleInCouponPage) && $couponData->isVisibleInCouponPage == 1) ? 'checked':'';?>> Is visible in coupon page ?
                                    <i class="input-helper"></i></label>
                                  </div>
                              </div>

                              <div class="col-md-12">
                                  <div class="form-check form-check-flat">
                                    <label class="form-check-label">
                                      <input type="checkbox" class="form-check-input" name="isVisibleInCheckoutPage" value="1" <?=(isset($couponData->isVisibleInCheckoutPage) && $couponData->isVisibleInCheckoutPage == 1) ? 'checked':'';?>> Is visible in checkout page ?
                                    <i class="input-helper"></i></label>
                                  </div>
                              </div>

                            </div>
                            
                            
                              
                          <input type="hidden" name="action" value="addCoupon">
                          <input type="hidden" name="hiddenval" value="<?=isset($couponData->couponId)?$couponData->couponId:0;?>">
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
<script src=""></script>

<!-- <script type="text/javascript" src="<?php echo DASHSTATIC; ?>/admin/js/jquery.datetimepicker.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#discountType").change(function(){
      if($(this).val() == 'flat'){
        $(".discount-section").find('.col-form-label').text('Flat Discount Amt');
        $(".discount-section").find('#discount').attr('placeholder','Enter Flat Discount Amt');
        // $(".max-discount-section").addClass('hide');
      }else{
        $(".discount-section").find('.col-form-label').text('Discount Percentage');
        $(".discount-section").find('#discount').attr('placeholder','Enter Discount Percentage');
        // $(".max-discount-section").removeClass('hide');
      }
    });
  });


$(function () {
  $('#endDate').datetimepicker({ 
  });
  $('#startDate').datetimepicker({ 
  });

});


</script>