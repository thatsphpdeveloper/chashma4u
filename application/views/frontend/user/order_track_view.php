<?php $this->load->viewF("inc/header.php"); ?>
<!-- Profile Banner Section -->

    <!--============= Cart Section ================-->
    <div class="grey-background">
      <!--===== page Navigate =======-->
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="page-navigate">
              <ul>
                <li><a href="<?=BASEURL;?>">Home</a></li>
                <li>></li>
                <?php if($this->session->userdata(PREFIX.'userRoleId')){ ?>
                <li><a href="<?=BASEURL;?>/user/profile">My Profile</a></li>
                <li>></li>
                <li><a href="<?=BASEURL;?>/user/order">Order History</a></li>
                <li>></li>
              <?php }else{ ?>

                <li><a href="<?=BASEURL;?>/contact">Track Order</a></li>
                <li>></li> 
              <?php } ?> 
                <li><a href="javascript:" class="active"><?=$orderData->generatedId;?></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!--===== End page Navigate =======-->

      <!--============= My order Section ================-->

          <?php 

              $productName = $img = $requestedDeliveryDate = $otherProducts = '';
              $totalItem = 0; 
              $isReviewRequired = '';
              if (isset($orderData->detailData) && !empty($orderData->detailData)) {
                foreach ($orderData->detailData as $key => $detail) {
                  
                  if(!$img)
                    $img = $detail->img;
                  if(!$requestedDeliveryDate)
                    $requestedDeliveryDate = $detail->requestedDeliveryDate;
                 
                  $totalItem =$totalItem+1;

                  if(empty($isReviewRequired) && $orderData->status == 4 && !$detail->reviewId)
                    $isReviewRequired = '<button type="button" class="rate-product" onclick="window.location.href=\''.BASEURL.'/user/review_product/'.$orderData->generatedId.'\';"><span><i class="fa fa-star"></i></span>RATE & REVIEW PRODUCT</button>';

                  if(!$productName)
                    $productName = $detail->productName;
                  else
                    $otherProducts .='<div class="my-order-details track-pro-list"> <div class="main-product-details"> <div class="pro-img"> <img src="'.getResizedImg($detail->img,'200_200').'" alt="'.$detail->productName.'"> </div> <div class="pro-content"> <h3>'.$detail->productName.'</h3> <p>Seller: CHASHMA4U</p> <p class="pro-price">₹'.$detail->price.'</p> </div> </div> </div>';
                }
              }

              ?>
      <!--============= Track Order Section ================-->
      <div class="container-fluid">
        <div class="billing-address-section">
          <div class="row">
            <div class="col-md-12">
              <h2>Delivery Address</h2>
              <div class="billing-address-details">
                <h3><?=ucfirst($orderData->addressData->name); ?></h3>
                <p><?=$orderData->addressData->address.' '.$orderData->addressData->address2.' '.$orderData->addressData->city.' '.$orderData->addressData->pincode;?></p>
                <p><span>Phone :</span> <?=$orderData->addressData->mobile;?></p>
              </div>
            </div>
          </div>
        </div> 

        <div class="tacking-order-product">
          <div class="row">
            <div class="col-md-12">
              <div class="my-order-top">
                <ul>
                  <li>
                    <button type="button" class="order-number"><?=$orderData->generatedId;?></button>
                  </li>
                  <li>
                    <div><button type="button" class="grey-button"><img src="<?php echo FRONTSTATIC; ?>/img/my-order/help-icon.png" alt=""> Need Help?</button></div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="product-tracking-details">
            <div class="ordered-details">
              <div class="row">
                <div class="col-md-5 my-order-details">
                  <div class="main-product-details">
                    <div class="pro-img">
                      <img src="<?=getResizedImg($img,'200_200')?>" alt="<?=$productName;?>">
                    </div>
                    <div class="pro-content">
                      <h3><?=$productName;?></h3>
                      <p>Seller: CHASHMA4U</p>
                      <p><?=$totalItem?> items</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- <p class=""><span>Message on cake -</span> sdfgdfsgdfg</p> -->
                </div>
                <div class="col-md-3 text-right">
                  <h4>₹<?=$orderData->grandTotal;?></h4>
                </div>
              </div>
            </div>
            <div class="tracking-detail">
              <div class="initial-track">
                <h4><?=($orderData->status == 0)?'Your order is pending for confirmation.':(($orderData->status == 1)?'Your order is accepted.':(($orderData->status == 2)?'Your order is processing.':(($orderData->status == 3)?'Your order has been shipped.':(($orderData->status == 4)?'Your order has been delivered.':''))))?></h4>
              </div>
              <div class="tracking-chart">

                <ul class="list-unstyled multi-steps">
                  <li <?=$orderData->status < 2? ' class="is-active"':'';?> >
                    <i class="fa fa-thumbs-up"></i>
                    <p>Orderd</p>
                  </li>
                  <li <?=$orderData->status == 2? ' class="is-active"':'';?> >
                    <i class="fa fa-dropbox"></i>
                    <p>Processing</p>
                  </li>
                  <li  <?=$orderData->status == 3? ' class="is-active"':'';?> >
                    <i class="fa fa-car"></i>
                    <p>Shipped</p>
                  </li>
                  <li <?=$orderData->status ==4? ' class="is-active"':'';?> >
                    <i class="fa fa-smile-o"></i>
                    <p>Delivered</p>
                  </li>
                </ul>

              </div>

              <div class="final-del-notification">
                <h3>Delivery on <?=($requestedDeliveryDate)?date('D M d\' y', strtotime($requestedDeliveryDate)):'Unknown'?></h3>
                <p>Product has no-return policy</p>
                <?=$isReviewRequired?>
              </div>
            </div>
          </div>
          <div class="all-ordered-product <?=$totalItem>1?'':'hide'?>">
            <div class="all-btn" data-toggle="collapse" data-target="#all-ordered-product">
              <span>All Items</span>
              <span><i class="fa fa-angle-down"></i></span>
            </div>


            <div class="collapse" id="all-ordered-product">
              <?=$otherProducts?>

            </div>
          </div>
        </div>
        <div class="total-saving-section">
          <ul>
            <li>Total ₹<?=$orderData->grandTotal;?></li>
            <li class="<?=$orderData->couponDiscount>0?'':'hide';?>">Savings ₹<?=$orderData->couponDiscount;?></li>
          </ul>
        </div>
      </div>


      <!--============= End My order Section ================-->

    </div>

<!-- End View Profile Details Section -->
<?php $this->load->viewF("inc/footer.php"); ?>
