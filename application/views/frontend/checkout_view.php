<?php $this->load->viewF('inc/header.php'); ?>
		<!--============= Checkout Section ================-->
		<div class="grey-background">
			<div class="cart-section">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-9">
							<form onsubmit="createOrder(this, event)">
								<div class="checkout-section">
									<ul>
										<li class="checkout-inner login-section">
											<!-- end login section -->
											<div class="chkout-btn" data-toggle="collapse" data-target="#chk-login"><span class="count">1</span> Login<span class="check-mark <?=(!empty($this->session->userdata(PREFIX.'userAuthId')))?'':'hide'?>"><img src="<?php echo FRONTSTATIC; ?>/img/checkout/check-mark.png" alt=""></span></div>
											<div class="collapse chk-inner-detail" id="chk-login">
												<!-- before login section -->
												<div class="before-login <?=(!empty($this->session->userdata(PREFIX.'userAuthId')))?'hide':''?>">
													<div class="row">
														<div class="col-md-6">
															<div class="social-login">
																<ul>
																	<li>
																		<a href="#"><i class="fa fa-facebook"></i> Login with Facebook</a>
																	</li>
																	<li>
																		<a href="#"><i class="fa fa-google-plus"></i> Login with Google Plus</a>
																	</li>
																</ul>
															</div>
															<div class="form-group chk-login-msg">
															</div>
															<div class="form-group">
																<input type="text" class="form-control" name="email" id
																="checkout-email" placeholder="Enter Email/Mobile Number" value="<?=(isset($visitorData->email) && !empty($visitorData->email))?$visitorData->email:''?>" required>
															</div>
															<div class="form-group">
																<input type="password" class="form-control" name="password" id
																="checkout-password" placeholder="Password" required>
															</div>

															<div class="row">
																<div class="col-md-12">
																	<button type="button" class="btn chk-login-btn">Continue</button>
																</div>
																<div class="col-md-12">
																	<p class="divider-heading">... OR ...</p>
																</div>
																<div class="col-md-12">
																	<button type="button" class="btn chk-signup-btn" data-toggle="modal" data-target="#signup-model">Sign Up</button>
																</div>
															</div>
														</div>
														<div class="col-md-6">
															<div class="login-notes">
																<div class="form-group">
																	<label class="container-chkbox">Login as Guest
																		<input type="checkbox" name="isGuest" id="isGuest" <?=(isset($visitorData->email) && !empty($visitorData->email))?'checked':''?>>
																		<span class="checkmark"></span>
																	</label>
																</div>
																<h2>Advantages of Our Secure Login</h2>
																<ul>
																	<li><span><img src="<?php echo FRONTSTATIC; ?>/img/checkout/track-icon.png" alt=""></span> Easily Track Orders</li>
																	<li><span><img src="<?php echo FRONTSTATIC; ?>/img/checkout/revelant-icon.png" alt=""></span> Get Relevant Alerts and Recommendation</li>
																	<li><span><img src="<?php echo FRONTSTATIC; ?>/img/checkout/wishlist-icon.png" alt=""></span> Wishlist, Reviews, Ratings and more</li>
																	
																</ul>
															</div>
														</div>
													</div>
												</div>
												<!-- end before login section -->

												<!-- after login section -->
												<div class="after-login <?=(!empty($this->session->userdata(PREFIX.'userAuthId')))?'':'hide'?>">
													<h4><span><?=$this->session->userdata(PREFIX.'userFirstName');?></span> -  <?=$this->session->userdata(PREFIX.'userMobile');?></h4>
													<button type="button" class="change-btn pull-right chk-change-login">Change</button>
												</div>
												<!-- end after login section -->

											</div>
											<!-- end login section -->
										</li>
										<?php 
											$cartHtml = '';
											$isAllCodProduct = 1;
											if (isset($cartData->detailData) && !empty($cartData->detailData)) {
												foreach ($cartData->detailData as $detail) {
													$isAllCodProduct = ($detail->isCod)?$isAllCodProduct:0;
													$discountPer = ($detail->price < $detail->actualPrice)?round((100 - (($detail->price*100)/$detail->actualPrice)),1):0;

													$datetime1 = date_create(date('Y-m-d', strtotime($detail->requestedDeliveryDate))); 
													$datetime2 = date_create(date('Y-m-d'));
													$interval = date_diff($datetime2, $datetime1)->format('%a');

													$pincode = $detail->pincode;
													$zoneName = $detail->zoneName;
													$deliveryMsg = ($interval) ? 'Delivery in '.$interval.' days':'Deliver between '.$detail->startTime.' hrs - '.$detail->endTime.' hrs';

													$attributeHtml = '';
													$attributeData = $this->Common_model->exequery("SELECT *,(SELECT attributeName FROM `ch_product_attributeinfo` WHERE attributeInfoId = ch_cart_attribute_detail.attributeId limit 0, 1) as attributeName FROM ".tablePrefix."cart_attribute_detail WHERE detailId = '".$detail->detailId."'");
													if (!empty($attributeData)) {
														foreach ($attributeData as $attribute) {
															$attributeHtml .= '<p class="attribute_price"><span class="now-price">₹'.$attribute->price.'</span><span class="attribute_title">Brown Bread </span></p>';
														}
													}
													$cartHtml .= '<div class="order-list checkout-item"> <ul> <li class="order-view"> <div class="order-img"> <img src="'.getResizedImg($detail->img,'148_122').'" alt="'.$detail->productName.'"> </div> <div class="order-detail"> <h5>'.$detail->productName.(!empty($detail->variableTitle)?' - '.$detail->variableTitle:'').'</h5> <p class="pirce-offer"><span class="now-price">₹'.$detail->price.'</span><span class="offer-price '.(($discountPer)?'':'hide').'"><del>₹'.$detail->actualPrice.'</del></span><span class="discount-ratio '.(($discountPer)?'':'hide').'">'.$discountPer.'% off 1 offer Available <img src="'.FRONTSTATIC.'/img/checkout/discount-icon.png" alt="info"></span></p>'.$attributeHtml.' <div class="increse-delete-order"> <div class="cartproduct-quantity"> <div class="button-container" onclick="incDscQty(this, event,\'dsc\')"> <button class="cart-qty-minus btn" type="button" value="-">-</button> </div> <input type="text" name="qty" class="qty" qty="'.$detail->qty.'" maxlength="12" value="'.$detail->qty.'" onkeypress="return OnlyInteger()" onchange="changeQty(this, event, '.$detail->detailId.')"> <div class="button-container" onclick="incDscQty(this, event,\'inc\')"> <button class="cart-qty-plus btn" type="button" value="+">+</button> </div> </div> <div class="delete-order"> <button type="button" class="btn"  onclick="removeItem(this, event, '.$detail->detailId.')"><i class="fa fa-trash"></i></button> </div> </div> </div> </li> <li class="delivery-time"> <h5>'.$deliveryMsg.'  ₹'.$detail->deliveryAmount.'</h5> </li> </ul> </div>';


													$addonsData = $this->Common_model->exequery("SELECT cad.*, pa.addonsName, pa.img, pa.price FROM ch_cart_addons_detail as cad left join ch_product_addons as pa on pa.addonsid = cad.addonsId WHERE detailId = '".$detail->detailId."'");

													if (!empty($addonsData)) {
														
														foreach ($addonsData as $addons) {
															$cartHtml .= '<div class="order-list checkout-item addons-of-'.$detail->detailId.'"> <ul> <li class="order-view"> <div class="order-img"> <img src="'.UPLOADPATH.'/addons_images/'.$addons->img.'" alt="'.$addons->addonsName.'"> </div> <div class="order-detail"> <h5>'.$addons->addonsName.'</h5> <p class="pirce-offer"><span class="now-price">₹'.$addons->price.'</span></p> <div class="increse-delete-order"> <div class="cartproduct-quantity"> <div class="button-container" onclick="incDscQty(this, event,\'dsc\')"> <button class="cart-qty-minus btn" type="button" value="-">-</button> </div> <input type="text" name="qty" class="qty" qty="'.$addons->qty.'" maxlength="12" value="'.$addons->qty.'" onkeypress="return OnlyInteger()" onchange="changeQty(this, event, '.$addons->addonsDetailId.',\'addons\')"> <div class="button-container" onclick="incDscQty(this, event,\'inc\')"> <button class="cart-qty-plus btn" type="button" value="+">+</button> </div> </div> <div class="delete-order"> <button type="button" class="btn"  onclick="removeItem(this, event, '.$addons->addonsDetailId.',\'addons\')"><i class="fa fa-trash"></i></button> </div> </div> </div> </li> <li class="delivery-time"> <h5>'.$deliveryMsg.'</h5> </li> </ul> </div>';
														}
													}
												}
											}

											$addressHtml = '';
											if (isset($addressData) && !empty($addressData) && isset($pincode) && !empty($pincode)) {
												$currentAddressId = isset($cartData->addressId)?$cartData->addressId:0;
												$newName = (isset($visitorData->name) && !empty($visitorData->name))?$visitorData->name:'';
												foreach ($addressData as $address) {
													if ($pincode == $address->pincode) {
														$isActiveAddress = ((empty($newName) && empty($currentAddressId) && empty($addressHtml))?'active':(($currentAddressId == $address->addressId)?'active':''));
														$addressHtml .= '<li class="address-item '.$isActiveAddress.'"> <input type="radio" class="chk-select-address" id="addressId-'.$address->addressId.'" name="addressId" value="'.$address->addressId.'" '.(($isActiveAddress)?'checked':'').'> <label for="addressId-'.$address->addressId.'"><span>'.$address->addressName.$currentAddressId.' - '.$address->name.'</span>  '.$address->mobile.'</label> <button type="button" class="edit-btn pull-right '.((empty($isActiveAddress))?'hide':'').'" data-addressName="'.$address->addressName.'" data-name="'.$address->name.'" data-mobile="'.$address->mobile.'" data-address="'.$address->address.'" data-address2="'.$address->address2.'" data-city="'.$address->city.'" data-state="'.$address->state.'" data-country="'.$address->country.'" data-pincode="'.$address->pincode.'" data-lat="'.$address->lat.'" data-lang="'.$address->lang.'" onclick="showAddressModel(this, event,'.$address->addressId.')">Edit</button> <div class="delivery-detail"> <p>'.$address->address.' '.$address->address2.' '.$address->city.' '.$address->pincode.'</p> <button type="button" class="delivery-here-btn '.((empty($isActiveAddress))?'hide':'').'" onclick="deliverHere(this)">Delivery Here</button> </div> </li>';
													}
												}
											}
										 ?>
	 


										<li class="checkout-inner address-section">
											<!-- Delivery address section -->
											<div class="chkout-btn" data-toggle="collapse" data-target="#chk-more-address"><span class="count">2</span> Delivery Address<span class="check-mark hide"><img src="<?php echo FRONTSTATIC; ?>/img/checkout/check-mark.png" alt=""></span></div>
											<div class="collapse chk-inner-detail" id="chk-more-address">
												<div class="address-details">
													<ul>
														
													<?=$addressHtml;?>
													</ul>


													<div class="add-new-field" data-toggle="collapse" data-target="#chk-new-address"><span>+</span> Add a new address</div>
													<div class="collapse form-field-section" id="chk-new-address">
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label>Address Type</label>
																	<select class="form-control chk-address" name="deliveryAddressName">
																		<option value="Work" <?=(isset($visitorData->addressName) && $visitorData->addressName == 'Work')?'selected':''?> >Work</option>
																		<option value="Home" <?=(isset($visitorData->addressName) && $visitorData->addressName == 'Home')?'selected':''?> >Home</option>
																		<option value="Other" <?=(isset($visitorData->addressName) && $visitorData->addressName == 'Other')?'selected':''?> >Other</option>
																	</select>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label>Receiver Name</label>
																	<input type="text" class="form-control chk-address" name="deliveryName" value="<?=(isset($visitorData->name) && !empty($visitorData->name))?$visitorData->name:''?>">
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label>Receiver Mobile</label>
																	<input type="text" class="form-control min-length-required chk-address" name="deliveryMobile" maxlength="12" value="<?=(isset($visitorData->mobile) && !empty($visitorData->mobile))?$visitorData->mobile:''?>" onkeypress="return OnlyInteger()">
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label>Alternate Mobile Number</label>
																	<input type="text" class="form-control chk-address" maxlength="12" name="deliveryAlternateMobile" value="<?=(isset($visitorData->alternateMobile) && !empty($visitorData->alternateMobile))?$visitorData->alternateMobile:''?>" onkeypress="return OnlyInteger()">
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label>Address</label>
																	<input type="text" class="form-control chk-address" name="deliveryAddress1" value="<?=(isset($visitorData->address) && !empty($visitorData->address))?$visitorData->address:''?>">
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label>Landmark</label>
																	<input type="text" class="form-control chk-address" name="deliveryAddress2" value="<?=(isset($visitorData->address2) && !empty($visitorData->address2))?$visitorData->address2:''?>">
																</div>
															</div>
														</div>

														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label>City</label>
																	<input type="text" class="form-control" name="deliveryCity" value="<?=(isset($visitorData->city) && !empty($visitorData->city))?$visitorData->city:''?>" >
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label>State</label>
																	<input type="text" class="form-control" name="deliveryState" value="<?=(isset($visitorData->state) && !empty($visitorData->state))?$visitorData->state:''?>">
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label>Pincode</label>
																	<input type="text" class="form-control" name="deliveryPincode" value="<?=(isset($cartData->pincode) && !empty($cartData->pincode))?$cartData->pincode:''?>"  onkeypress="return OnlyInteger()" maxlength="6" readonly>
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label>Country</label>
																	<input type="text" class="form-control" name="deliveryCountry" value="<?=(isset($visitorData->country) && !empty($visitorData->country))?$visitorData->country:''?>">
																	<input type="hidden" name="lat" value="<?=(isset($visitorData->lat) && !empty($visitorData->lat))?$visitorData->lat:'0'?>">
																	<input type="hidden" name="lang" value="<?=(isset($visitorData->lang) && !empty($visitorData->lang))?$visitorData->lang:'0'?>">
																</div>
															</div>
														</div>
														<hr/>
														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label>Sender Name</label>
																	<input type="text" class="form-control chk-address" name="senderName" value="<?=(isset($visitorData->senderName) && !empty($visitorData->senderName))?$visitorData->senderName:''?>">
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group">
																	<label>Sender Contact Number</label>
																	<input type="text" class="form-control min-length-required chk-address" name="senderNo" maxlength="12" value="<?=(isset($visitorData->senderNo) && !empty($visitorData->senderNo))?$visitorData->senderNo:''?>" onkeypress="return OnlyInteger()">
																</div>
															</div>
														</div>
														<div class="row">
															<div class="col-md-12">
																<div class="btn-section">
																	<button type="button" class="btn profile-edit-btn checkout-address">Deliver Here</button>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											<!-- end Delivery address section -->
										</li>

										<li class="checkout-inner order-section">
											<!-- end Order summery section -->
											<div class="chkout-btn" data-toggle="collapse" data-target="#chk-order-summery"><span class="count">3</span> Order Summary<span class="check-mark hide"><img src="<?php echo FRONTSTATIC; ?>/img/checkout/check-mark.png" alt=""></span></div>
											<div class="collapse chk-inner-detail" id="chk-order-summery">
												<div class="checkout-order-detail">

													<!-- order list -->
													<?=$cartHtml;?>
													<!-- end order list -->
													<div class="order-notes">
														<p>Order confirmation email will be sent to <span class="confirmation-mail"><?=(!empty($this->session->userdata(PREFIX.'userEmail')))?$this->session->userdata(PREFIX.'userEmail'):'?'?></span></p>
														<p><div class="form-group"> <label class="container-chkbox"> <input type="checkbox" name="isAgree" id="isAgreeToTerms" checked required> I Agree to the <a href="<?=BASEURL.'/terms'?>" target="_blank"> Terms of Service</a> </label> </div></p>
														<button type="button" class="button default-button btn-order-review" onclick="showHideCheckout($(this),'li.order-section','li.payment-section')">Continue</button>
													</div>
												</div>
											</div>
											<!-- end Order summery section -->
										</li>

										<li class="checkout-inner payment-section">
											<!-- Payment option section -->
											<div class="chkout-btn" data-toggle="collapse" data-target="#chk-payment"><span class="count">4</span> Payment Options<span class="check-mark hide"><img src="<?php echo FRONTSTATIC; ?>/img/checkout/check-mark.png" alt=""></span></div>

											<div class="collapse  chk-inner-detail" id="chk-payment">


												<div class="hide">
													<input type="hidden" name="action" value="createOrder">
													<input type="hidden" name="totalPayable" value="<?=$cartData->cartGrandtotal?>">

				                      				<input type="hidden" name="paymentMethod" id="paymentMethod" value="cod">
												</div>
												<div class="payment-link1">
													<ul>

							                            <?php
							                            if (isset($settingData->value) && !empty($settingData->value)) {
							                              $frontData = (object) unserialize($settingData->value);
							                            }

							                            $activePaymentMethods = (isset($frontData->activePaymentMethods) && !empty($frontData->activePaymentMethods))?explode(',', $frontData->activePaymentMethods):array();
							                            ?>
							                            <?php if(in_array('payu', $activePaymentMethods)){ ?>
															<li class="payumoney-list"><a href="javascript:" class="create-order-btn create-order-payumoney" data-payment-method="payumoney">Checkout with <img src="<?=FRONTSTATIC?>/img/payumoney-logo.png" alt=""></a></li>
														<?php } ?>

							                            <?php if(in_array('paytm', $activePaymentMethods)){ ?>
														<li class="paytm-list"><a href="javascript:" class="create-order-btn create-order-paytm" data-payment-method="paytm">Checkout with <img src="<?=FRONTSTATIC?>/img/paytm-logo.png" alt=""></a></li>
														<?php } ?>
														
							                            <?php if(in_array('paypal', $activePaymentMethods)){ ?>
														<li class="paypal-list"><a href="javascript:" class="create-order-btn create-order-paypal" data-payment-method="paypal">Checkout with <img src="<?=FRONTSTATIC?>/img/paypal-logo.png" alt=""></a></li>
														<?php } ?>
														
							                            <?php if(in_array('cod', $activePaymentMethods)){ ?>
														<?php if($isAllCodProduct != 0 && $cartData->isNoCod == 0){?>
														<li class="cash-delivery-list"><a href="javascript:" class="create-order-btn create-order-cod" data-payment-method="cod">Cash On Delivery</a></li>
														<?php }else{?>
														<li class="cash-delivery-list"><a href="javascript:" class="no-cod-available">Cash On Delivery Not Available</a></li>
														<?php } ?>

														<?php } ?>
													</ul>
												</div>
												<div class="order-msg"></div>
											</div>
										</li>

										<li class="checkout-inner giftcard-section hide">
											<!-- add gift card section -->
											<div class="chkout-btn add-new-field" data-toggle="collapse" data-target="#chk-gift-card"><span>+</span> Add Gift Card</div>
											<div class="collapse form-field-section chk-inner-detail" id="chk-gift-card">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Address Line1</label>
															<input type="text" class="form-control" value="Jhon" readonly>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Address Line2</label>
															<input type="text" class="form-control" value="Deo" readonly>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>City</label>
															<input type="text" class="form-control" value="info@johndeo.com" readonly>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>State</label>
															<input type="text" class="form-control" value="Delhi" readonly>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group">
															<label>Pincode</label>
															<input type="text" class="form-control" value="info@johndeo.com" readonly>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label>Country</label>
															<input type="text" class="form-control" value="Delhi" readonly>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<div class="btn-section">
															<button type="submit" class="btn profile-edit-btn">Edit</button>
															<button type="submit" class="btn btn-danger">Cancel</button>
															<button type="submit" class="btn profile-edit-btn">Update</button>
														</div>
													</div>
												</div>
											</div>
											<!-- end add gift card section -->
										</li>
									</ul>

								</div>
							</form>
						</div>
						<div class="col-md-3">
							<div class="price-detail-section">
								<h4>Price Details</h4>
								<div class="inner-price-detail">
									<h5 class="item-count"><?=$this->session->userdata(PREFIX.'cartItemsCount');?> Items</h5>
									<div class="ordered-price-list">
										<div class="list-price">
											<ul>
												<li>Cart Total</li>
												<li class="cart-total">Rs. <span><?=$cartData->cartTotal;?></span></li>
											</ul>
										</div>

										<div class="list-price applied-coupon-section">
											<?=($cartData->couponDiscount)?'<ul> <li>Coupon- <b>'.$cartData->coupon.'</b></li> <li class="discount-amount">Rs -'.$cartData->couponDiscount.'</li> </ul>':'';?></div>
										<div class="list-price">
											<ul>
												<li>Tax</li>
												<li class="order-total">Rs. <span><?=number_format((float)$cartData->tax, 2, '.', '');?></span></li>
											</ul>
										</div>
										<div class="list-price">
											<ul>
												<li>Delivery Charge</li>
												<li class="del-charge">
                                                    <?=($cartData->deliveryCharge == 0)?'<span class="text text-success">Free</span>':"Rs. ".$cartData->deliveryCharge;?>
													</li>
											</ul>
										</div>
									</div>
									<div class="total-payable">
										<ul>
											<li>Total Payable</li>
											<li class="total-payable">Rs. <?=$cartData->grandTotal;?>
											</li>
										</ul>
									</div>
								</div>
							</div>

							<div class="coupon-discount">
								<?php 
								$couponHtml = '';
								$appliedCouponCode = '';
								$appliedCouponMsg = '';
								$appliedCouponId = ($cartData->couponId > 0)?$cartData->couponId:0;
								if (isset($couponData) && !empty($couponData)) {
									foreach ($couponData as $coupon) {
										if($coupon->couponId  == $appliedCouponId){
											$appliedCouponCode = $coupon->couponCode;
											$appliedCouponMsg = (($coupon->discountType== 'flat')?'Flat Rs.'.$coupon->discount.' Off':'Flat '.$coupon->discount.'% Off');
										}

										$couponHtml .= '<div class="coupon-list"> <div class="coupon-title"> <h2>'.$coupon->couponCode.'</h2> <button type="button" class="applyCoupon-btn" onclick="applyCoupon(this, event,'.$coupon->couponId.')">Apply</button> </div> <div class="couponCode-description"> <h3>'.(($coupon->discountType== 'flat')?'Flat Rs.'.$coupon->discount.' Off':'Flat '.$coupon->discount.'% Off').'</h3> <p>'.(($coupon->maxUsagePerUser)?'Valid on '.$coupon->maxUsagePerUser.' orders':'Valid on all orders').'<br/>'.(($coupon->minOrderAmt)?'Applicable on orders above ₹'.$coupon->minOrderAmt:'No minimum order required').'</p> </div> </div>';
									}
								}  ?>
								
								<div class="coupon-msg"></div>
								<div class="promo-apply-field coupan-applied-section <?=($appliedCouponId > 0)?'':'hide'?>">
									<div class="applied_promo_section"><p class="icon11"><i class="fa fa-check"></i></p> <p class="promo_content"><b><?=$appliedCouponCode?></b> - Applied successfully.<span><?=$appliedCouponMsg?></span></p> </div> <div class="promo_discount1"><h4><?=$cartData->couponDiscount?></h4><button type="button" class="remove-btn" onclick="removeAppliedCoupon(this, event)">REMOVE</button></div>
								</div>
								<div class="coupon-form-field coupan-apply-section  <?=($appliedCouponId > 0)?'hide':''?>"> <input type="text" class="coupon-input" placeholder="Enter Promo Code"> <button type="button" class="applyCoupon-btn" onclick="applyCoupon(this, event)">Apply</button> </div>

								<?php if (!empty($couponHtml)) { ?>

								<div class="coupon-discount-inner">
									<h4>Available Coupon</h4>
									<?=$couponHtml  ?>

								</div>
								<?php 	}  ?>
							</div>
									
									
							<div class="secure-payment">
								<ul>
									<li><img src="<?php echo FRONTSTATIC; ?>/img/checkout/secure-icon.png" alt=""></li>
									<li class="text">Safe and Secure Payments. Easy returns. <br>100% Authentic Products.</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--============= Checkout Section ================-->


		<!-- address Popup -->
		<div class="modal" id="address-model">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">Edit Address</h4>
						<button type="button" class="close" data-dismiss="modal">×</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">
							
			            <form class="form-ad checkout-address-form" onsubmit="updateAddress(this, event)" >
							<div class="row">
			                  	<div class="col-md-12 msg"></div>
			                  	<div class="col-md-12">
			                    <div class="form-group">
			                      <label>Address Type</label>
			                      <select class="form-control" id="chk-addressName" name="addressName" value="" required>
			                      	<option value="Work">Work</option>
			                      	<option value="Home">Home</option>
			                      	<option value="Other">Other</option>
			                      </select>
			                    </div>
			                  </div>
			                </div>
			                <div class="row">
			                  <div class="col-md-6">
			                    <div class="form-group">
			                      <label>Reciever Name</label>
			                      <input type="text" class="form-control" name="name"  id="chk-name" value="" required>
			                    </div>
			                  </div>
			                  <div class="col-md-6">
			                    <div class="form-group">
			                      <label>Reciever Mobile</label>
			                      <input type="text" class="form-control" name="mobile" maxlength="12" onkeypress="return OnlyInteger()" id="chk-mobile" value="" required>
			                    </div>
			                  </div>
			                </div>
			                <div class="row">
			                  <div class="col-md-6">
			                    <div class="form-group">
			                      <label>Address</label>
			                      <input type="text" class="form-control" name="address" id="chk-address" value="" required>
			                    </div>
			                  </div>
			                  <div class="col-md-6">
			                    <div class="form-group">
			                      <label>Landmark</label>
			                      <input type="text" class="form-control" name="address2" id="chk-address2" value="" required>
			                    </div>
			                  </div>
			                </div>

			                <div class="row">
			                  <div class="col-md-6">
			                    <div class="form-group">
			                      <label>City</label>
			                      <input type="text" class="form-control" name="city" id="chk-city" value="" required>
			                    </div>
			                  </div>
			                  <div class="col-md-6">
			                    <div class="form-group">
			                      <label>State</label>
			                      <input type="text" class="form-control" name="state" id="chk-state" value="" required>
			                    </div>
			                  </div>
			                </div>
			                <div class="row">
			                  <div class="col-md-6">
			                    <div class="form-group">
			                      <label>Country</label>
			                      <input type="text" class="form-control"  name="country" id="chk-country" value="" required>
			                    </div>
			                  </div>
			                  <div class="col-md-6">
			                    <div class="form-group">
			                      <label>Pincode</label>
			                      <input type="text" class="form-control" name="pincode" id="chk-pincode" value="" required>
			                    </div>
			                  </div>
			                </div>
			                <div class="row">
			                  <div class="col-md-12">
			                    <div class="btn-section">
			                      <button type="button" class="btn profile-edit-btn btn-update validate-form">Update</button>
			                      <input type="hidden" name="action" value="updateAddress">
			                      <input type="hidden" name="lat" id="chk-lat" value="0">
			                      <input type="hidden" name="lang" id="chk-lang" value="0">
			                      <input type="hidden" name="addressId" id="chk-addressId" value="0">
			                      <input type="hidden" name="f" id="chk-address-index" value="0">
			                    </div>
			                  </div>
			                </div>
						</form>

					</div>
				</div>
			</div>
		</div>
		<!-- End address Popup -->

		<!-- address Popup -->
		<div class="modal" id="signup-model">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">Signup Here</h4>
						<button type="button" class="close" data-dismiss="modal">×</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">
						<form onsubmit="registration(this, event)">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>First Name</label>
										<input type="text" class="form-control" name="firstName" required>
							  		</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Last Name</label>
										<input type="text" class="form-control" name="lastName" required>
								  	</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Email</label>
										<input type="email" class="form-control" name="email" required>
							  		</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Phone No.</label>
										<input type="text" class="form-control" name="mobile" maxlength="12" minlength="6" onkeypress="return OnlyInteger()" required>
								  	</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Password</label>
										<input type="password" class="form-control" name="password" id="password" required>
							  		</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Confirm Password</label>
										<input type="password" class="form-control" name="confirmPassword" id="confirmPassword" required>
								  	</div>
								</div>
							</div>
							
							<button type="button" class="signup-submit validate-password">Sign Up</button>
							<input type="hidden" name="action" value="registration">

							<div class="row">
								<div class="col-md-12 msg">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- End address Popup -->
		<?php $this->load->viewF('inc/footer.php'); ?>

		<script>
			var isLoggedIn = "<?=(!empty($this->session->userdata(PREFIX.'userAuthId')))?1:0?>";
			$(document).ready(function(){
				$('#isGuest').change(function(){
					checkIsGuestUser();

				});
				$('input[name=addressId]').change(function(){
					sendAjaxRequest({"action" : "updateCartData", "addressId" : $('input[name=addressId]:checked').val()});

				});
				// $(document).on('click','.chk-login-btn',function(){
				$('.chk-login-btn').click(function(){
					var obj = this;
					$(obj).closest('li.login-section').find('.chk-login-msg').html('');
					$('.confirmation-mail').text($('#checkout-email').val());
					if($('#isGuest').is(':checked')){
						if (validateEmail($('#checkout-email').val().trim()) == false) {
				          	$('#checkout-email').addClass("error");
				          	($('#checkout-email').closest("div").find('label.error').length>0)?'':$('#checkout-email').closest("div").append('<label class="error text-danger">invalid email-id.</label>');
				            $('#checkout-email').closest('li.login-section').find('span.check-mark').addClass('hide');
				            return false;
				        }
				        else{            
			                $('#checkout-email').removeClass("error");
			                $('#checkout-email').closest("div").find('label.error').remove();
				            $('#checkout-email').closest('li.login-section').find('span.check-mark').removeClass('hide');

							showHideCheckout($('#checkout-email'),'li.login-section','li.address-section');
							sendAjaxRequest({"action" : "updateVisitorData", "email" : $('#checkout-email').val()});
				        }

					}else{

					  	$.ajax({
					      	url: FRONTAJAX,
					      	data: {"action" : "logincheck", "email" : $('#checkout-email').val(), "password" : $('#checkout-password').val(), "role" : "user", "addressRequested" : 1},
					      	type: "POST",				      
					        success:function(response){
					            if(response.valid && response.role == 'user'){
					            	
					                $(obj).closest('li.login-section').find('span.check-mark').removeClass('hide');
				                	$(obj).closest('li.login-section').find('div.before-login').addClass('hide');
				                	$(obj).closest('li.login-section').find('div.after-login').removeClass('hide');
				                	$(obj).closest('li.login-section').find('div.after-login').find('h4').html('<span>'+response.name+'</span> '+response.mobile);
				                	$(obj).closest('div.checkout-section').find('li.address-section').find('div.address-details').find('ul').html(response.addressHtml);
				                	$('.chk-address').val('');
				                	$('input[name="deliveryName"], input[name="senderName"]').val(response.name);
				                	$('input[name="deliveryMobile"], input[name="senderNo"]').val(response.mobile);
				                	$('li.signin-menu').removeClass('hide').find('h3').text('Hello, '+response.name);
				                	$('li.signout-menu').addClass('hide');

				                	setTimeout(function(){showHideCheckout($('#checkout-email'),'li.login-section','li.address-section');},1000);
							
					            }else
					                $(obj).closest('li.login-section').find('.chk-login-msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something is wrong',2)).css('display','block');
					            $(obj).closest('li.login-section').find('.chk-login-btn').text('Continue');
					            setTimeout(function(){$(obj).closest('li.login-section').find('.chk-login-msg').html('');},3000);       
					        },
					        error:function(response){
					            $(obj).closest('li.login-section').find('.chk-login-btn').text('Continue');
					            $(obj).closest('li.login-section').find('.chk-login-msg').html(getMsg('Something is wrong',2)).css('display','block');
					            setTimeout(function(){$(obj).closest('li.login-section').find('.chk-login-msg').html('');},3000);
					        }
					  	});
					}

				});
				$('.chk-change-login').click(function(){
					var obj = this;
				  	$.ajax({
				      	url: FRONTAJAX,
				      	data: {"action" : "logout"},
				      	type: "POST",				      
				        success:function(response){
		                	$(obj).closest('li.login-section').find('div.before-login').removeClass('hide');
		                	$(obj).closest('li.login-section').find('div.after-login').addClass('hide');
				            $(obj).closest('li.login-section').find('span.check-mark').addClass('hide');
				            $(obj).closest('div.checkout-section').find('li.address-section').find('div.address-details').find('ul').html('');
				            $('.chk-address').val('');				            
		                	$('li.signin-menu').addClass('hide').find('h3').text('Hello, User');
		                	$('li.signout-menu').removeClass('hide');
		                	showHideCheckout($('#checkout-email'),'li.address-section','li.login-section');
		                	var obj2 = $(obj).closest('div.checkout-section').find('li.address-section').find('div.chkout-btn');
		                	if(obj2.attr('aria-expanded') == 'true')
    							obj2.trigger('click');
		                },
				        error:function(response){
				        }
				  });

				});
				$('.checkout-address').click(function(){
					

					sendAjaxRequest({"action" : "updateVisitorData", "addressName" : $('#chk-new-address select[name="deliveryAddressName"]').val(), "name" : $('#chk-new-address input[name="deliveryName"]').val(), "mobile" : $('#chk-new-address input[name="deliveryMobile"]').val(), "alternateMobile" : $('#chk-new-address input[name="deliveryAlternateMobile"]').val(), "address" : $('#chk-new-address input[name="deliveryAddress1"]').val(), "address2" : $('#chk-new-address input[name="deliveryAddress2"]').val(), "city" : $('#chk-new-address input[name="deliveryCity"]').val(), "state" : $('#chk-new-address input[name="deliveryState"]').val(), "pincode" : $('#chk-new-address input[name="deliveryPincode"]').val(), "country" : $('#chk-new-address input[name="deliveryCountry"]').val(), "senderName" : $('#chk-new-address input[name="senderName"]').val(), "senderNo" : $('#chk-new-address input[name="senderNo"]').val()});

					$('input[name=addressId]').prop('checked', false);
					$('li.address-item').removeClass('active');
					$('li.address-item').find('.edit-btn.pull-right').addClass('hide');
					$('li.address-item').find('.delivery-here-btn').addClass('hide');

				});
				$('li.checkout-inner.address-section').find('.chkout-btn').trigger('click');

				checkIsGuestUser();

				setTimeout(function(){
					if(isLoggedIn == '0' && $('#isGuest').is(':checked')){
						$('.chk-login-btn').trigger('click');
						if($('#chk-more-address').find('input[name=senderName]').val().trim() != '' && $('#chk-more-address').find('input[name=senderNo]').val().trim() != ''){
							setTimeout(function(){
								$('.btn.profile-edit-btn.checkout-address').trigger('click');
								setTimeout(function(){
									$('.btn-order-review').trigger('click');
								},500);
							},500);
						}
					}else if(isLoggedIn == '1'){
						if($('input[name=addressId]:checked').length){
							setTimeout(function(){
								$('input[name=addressId]:checked').closest('li').find('.delivery-here-btn').trigger('click');
								setTimeout(function(){
									$('.btn-order-review').trigger('click');
								},500);
							},500);
						}else if($('#chk-more-address').find('input[name=senderName]').val().trim() != '' && $('#chk-more-address').find('input[name=senderNo]').val().trim() != ''){
							setTimeout(function(){
								$('.btn.profile-edit-btn.checkout-address').trigger('click');
								setTimeout(function(){
									$('.btn-order-review').trigger('click');
								},500);
							},500);
						}
					}
				},500);
				
			});



		</script>

		<script type="text/javascript">
			function showAddressModel(obj, e, addressId){
				e.preventDefault();
				$('#chk-addressName').val($(obj).data('addressname'));
				$('#chk-name').val($(obj).data('name'));
				$('#chk-mobile').val($(obj).data('mobile'));
				$('#chk-address').val($(obj).data('address'));
				$('#chk-address2').val($(obj).data('address2'));
				$('#chk-city').val($(obj).data('city'));
				$('#chk-state').val($(obj).data('state'));
				$('#chk-country').val($(obj).data('country'));
				$('#chk-pincode').val($(obj).data('pincode'));
				$('#chk-lat').val($(obj).data('lat'));
				$('#chk-lang').val($(obj).data('lang'));
				$('#chk-addressId').val(addressId);
				$('#chk-address-index').val($(obj).closest('li').index());
				$('#address-model').modal('show');


			}

			
			$('.chk-inner-detail').on('show.bs.collapse', function(e){
			    let remainsTabIndex = $(this).closest('.checkout-section').find('span.check-mark.hide:eq(0)').closest('li.checkout-inner').index();
			    let currentTabIndex = $(this).closest('li.checkout-inner').index();
			    if (remainsTabIndex < currentTabIndex) {
				    $('.chk-inner-detail').not($('.checkout-section').find('li.checkout-inner:eq('+remainsTabIndex+')').find('.chk-inner-detail')).collapse('hide');
				    $('.checkout-section').find('li.checkout-inner:eq('+remainsTabIndex+')').find('.chk-inner-detail').collapse("show");
				    e.preventDefault();
			    }
			});
		</script>

		<script type="text/javascript">

			function sendAjaxRequest(formData){
				$.ajax({
			      	url: FRONTAJAX,
			      	data: formData,
			      	type: "POST",				      
			        success:function(response){}
		        });
			}
		</script>

		<script type="text/javascript">

			function checkIsGuestUser(){

					if($('#isGuest').is(':checked')){
				        $('#checkout-email').prop('required', true);
				        $('#checkout-password').prop('required', false);
				        $('#checkout-password').closest('div.form-group').addClass('hide');
					}
				    else{
				        $('#checkout-email').prop('required', true);
				        $('#checkout-password').prop('required', true);
				        $('#checkout-password').closest('div.form-group').removeClass('hide');
				        $('#checkout-email').closest('li.login-section').find('span.check-mark').addClass('hide');
				    }
			}
		</script>
	</body>
</html>