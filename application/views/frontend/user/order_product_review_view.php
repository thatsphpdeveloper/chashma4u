<?php $this->load->viewF("inc/header.php"); ?>
<!-- Profile Banner Section -->
<style type="text/css">.review-item {background: whitesmoke;}</style>
<div class="profile-page">
  <!--===== page Navigate =======-->
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="page-navigate">
          <ul>
            <li><a href="<?=BASEURL;?>">Home</a></li>
            <li>></li>
            <li><a href="<?=BASEURL;?>/user/order" class="active">Order History</a></li>
            <li>></li>
            <li><a href="javascript:" class="active">Review Product</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!--===== End page Navigate =======-->
  <!--========= Signup Form section ========-->

  <div class="container-fluid">
    <div class="profile-page-section">
      <div class="profile-information">
        <div class="row">
          <div class="col-md-6 m-auto" id="review-model">
            <form class="form-row" onsubmit="addReview(this, event)">
              <h1>Review Product</h1>
              <?php if (isset($orderData->detailData) && !empty($orderData->detailData)) {
                foreach ($orderData->detailData as $detail) {
                ?>
              <div class="row review-item border mb-sm-2">
                <div class="form-group input-group-sm col-12">                
                  <div class="myimg-section">
                    <div class="profile-img-section">
                      <div class="profile-img">
                        <img src="<?=getResizedImg($detail->img,'200_200');?>" alt="<?=$detail->productName;?>">
                      </div>
                      <div class="profile-name">
                        <h2><?=$detail->productName;?></h2>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group input-group-sm col-12">
                  <label for="review">Review</label>
                  <textarea class="form-control" rows="2" id="review<?=$detail->productId;?>" name="review<?=$detail->productId;?>"></textarea>
                  <input type="hidden" name="productId[]" value="<?=$detail->productId;?>">
                </div>

                <div class="form-group input-group-sm col-12 rating-section">
                  <label>Rating</label>
                  <div class="rating custom-radio">
                    <input type="radio" id="value5-<?=$detail->productId;?>" name="rating<?=$detail->productId;?>" class="custom-control-input" value="5"/>
                    <label for="value5-<?=$detail->productId;?>" class="custom-control-label"></label>
                    <input type="radio" id="value4-<?=$detail->productId;?>" name="rating<?=$detail->productId;?>" class="custom-control-input" value="4"/>
                    <label for="value4-<?=$detail->productId;?>" class="custom-control-label"></label>
                    <input type="radio" id="value3-<?=$detail->productId;?>" name="rating<?=$detail->productId;?>" class="custom-control-input" value="3"/>
                    <label for="value3-<?=$detail->productId;?>" class="custom-control-label"></label>
                    <input type="radio" id="value2-<?=$detail->productId;?>" name="rating<?=$detail->productId;?>" class="custom-control-input" value="2"/>
                    <label for="value2-<?=$detail->productId;?>" class="custom-control-label"></label>
                    <input type="radio" id="value1-<?=$detail->productId;?>" name="rating<?=$detail->productId;?>" class="custom-control-input" value="1" />
                    <label for="value1-<?=$detail->productId;?>" class="custom-control-label"></label>
                  </div>
                </div>
              </div>
            <?php } }?>


              <div class="form-group">
                <button type="button" class="btn btn-primary profile-edit-btn validate-review">Submit</button>
                <input type="hidden" name="action" value="addReview">
                <input type="hidden" name="orderId" value="<?=isset($orderData->orderId)?$orderData->orderId:0?>">
              </div>              
              <div class="form-group  col-12 msg"></div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>


</div>
<!-- End View Profile Details Section -->
<?php $this->load->viewF("inc/footer.php"); ?>