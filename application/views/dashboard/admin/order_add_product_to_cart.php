<link rel='stylesheet' href='<?php echo DASHSTATIC; ?>/admin/css/order.css'>
<div class="row">
	<div class="col-md-12">
		<form onsubmit="addUpdateCart(this, event)" enctype="multipart/form-data">
			<!-- Product Description section -->
			<div class="product-discription">
				<h3><?=$productData->productName;?></h3>

				<?php
				$variableHtml = $isActiveVariable = '';
				$actualPrice = $productData->actualPrice;
				$salePrice = $productData->salePrice;
				$variableId = 0;
				if (isset($variableData) && !empty($variableData)) {

					foreach ($variableData as $variable) {
						if(empty($isActiveVariable)){
							$actualPrice = $variable->actualPrice;
							$salePrice = $variable->salePrice;
							$variableId = $variable->variableId;
						}
						$variableHtml .= '<li class="variable-item '.(empty($isActiveVariable)?'active':'').'" data-price="'.$variable->actualPrice.'" data-sale-price="'.$variable->salePrice.'" data-variableId="'.$variable->variableId.'"><img src="'.getResizedImg($variable->img,'200_200').'" alt="'.$variable->variableTitle.'" /><h4>'.$variable->variableTitle.'</h4>'.(($variable->salePrice > 0)?'<h5><span>₹</span>'.$variable->salePrice.' <span class="orignial-price">₹<del>'.$variable->actualPrice.'</del></span></h5>':'<h5><span>₹</span>'.$variable->actualPrice.'</h5>').'</li>';
						$isActiveVariable = 'active';
						}
					}
				 ?>


				<!--Product Price section -->
				<div class="product-price" data-price="<?=$actualPrice?>" data-sale-price="<?=$salePrice?>">
					<?=($salePrice > 0)?'<p class="product-price-detail"><span class="r-icon">₹</span><span id="odometer" class="now-price odometer">'.$salePrice.'</span><span class="orignial-price">₹<del>'.$actualPrice.'</del></span><span class="offer-ratio"> &nbsp;'.(round(((($actualPrice-$salePrice)*100)/$actualPrice))).'% OFF</span></p>':'<p class="product-price-detail"><span class="r-icon">₹</span><span id="odometer" class="now-price odometer">'.$actualPrice.'</span></p>';?>

					<p>Inclusive of all taxes</p>
				</div>
				<!-- end Product Price Section -->

				<?php if (isset($variableData) && !empty($variableData)) { ?>
				<!-- Pick an order section -->
				<div class="pick-upgrade">
					<h3>Pick an uprade</h3>
					<ul>
						<?=$variableHtml?>
					</ul>
				</div>
				<!-- end Pick an order section -->

		 		<?php } ?>

				<?php if (isset($attributeData) && !empty($attributeData)) { ?>
				<!-- cake type section -->
				<div class="cake-type">

						<?php foreach ($attributeData as $attribute) {
							if (!empty($attribute->attributeItems)) {
								echo '<h5>'.$attribute->attributeHeading.'</h5><ul>';
								foreach ($attribute->attributeItems as $attributeItem) {
									echo '<li><div class="eggless-box"><label class="cake-checkbox">'.$attributeItem->attributeName.'<input type="checkbox" name="attributeItem[]" value="'.$attributeItem->attributeInfoId.'" data-price="'.$attributeItem->attributePrice.'" ismultiple="'.$attribute->isMultiple.'"><span class="checkmark"></span></label></div></li>';
								}
								echo '</ul>';
							}
						}


						 ?>
				</div>
				<?php } ?>


				<!-- Special Gift Section -->
		
				<?php 
				$addonCounter = 0;
				$giftpopupHtml = '';
				if(isset($addonsData) && !empty($addonsData)){
					echo '<div class="special-gift " > <h3>Make Your Loved One Feel Special</h3> <ul class="special-gift-slider">';
				 	foreach ($addonsData as $addons) {
				 		$htmml = '<li> <div class="gift-checkbox"> <label class="image-checkbox"> <img src="'.UPLOADPATH.'/addons_images/'.$addons->img.'" alt="'.$addons->addonsName.'"> <p class="gift-name">'.$addons->addonsName.'</p> <p class="giftPrice"><b class="addons-price" data-price="'.$addons->price.'"><span>₹</span>'.$addons->price.'</b></p> <input type="checkbox" name="addonsProductId[]" class="addonsProductId" value="'.$addons->addonsId.'"> <div class="check-icon"><i class="fa fa-check hidden"></i></div> </label> </div> </li>';

				 		if ($addonCounter > 2) {
				 			$giftpopupHtml = $htmml;
				 		}else
				 			echo $htmml;
				 		$addonCounter++;
				 	}
				 	echo '</ul> </div>';
				}

				?>
				
				
			<!-- end special gift section -->

				<div class="pro-delivery-detail"><?=getLimitedWords($productData->description , 15, "#myTabContent", "Read More") ?>


					<div class="pro-delivery-address">
						<label>Deliver To</label>
						<div class="input-container">
							<input class="input-field" type="text" placeholder="110092" name="deliverTo" id="deliverTo" value="<?=$this->session->userdata(PREFIX.'currentDeliverTo')?>" title="Select Delivery Area.">
							<i class="fa fa-map-marker icon"></i>
							<a href="javascript:" onclick="$('#deliverTo').val('');$(this).addClass('hide');$('p.error1').addClass('text-danger').removeClass('hide').text('While adding item in cart by diffrent pincode, Items in cart from other pincode will be removed automatically.');" class="deliverTo-clear <?=(!empty($this->session->userdata(PREFIX.'currentDeliverTo')))?'':''?>"><i class="fa fa-times-circle icon"></i></a>
							<input type="hidden" name="postal_code"  id="postal_code" value="<?=$this->session->userdata(PREFIX.'currentPincode')?>" class="hide" onchange="showDeliverSlot(this, <?=$productData->productId;?>)">
						</div>
						<div class="error-address">
							<p class="error1">Enter correct Pincode for hassle free timely delivery.</p>
							<p class="error-pin <?=(!empty($this->session->userdata(PREFIX.'currentPincode')))?'':'hide'?>">PIN <?=$this->session->userdata(PREFIX.'currentPincode')?></p>
						</div>
					</div>
				</div>

				<div class="delivery-date hide" >
					<h3>Delivery Date</h3>
					<?php
						$sameDay = ($productData->isSameDayDelivery)?'current':'hide';
						$tomorrow = ($productData->isSameDayDelivery)?'':(($productData->minDayReqtoDeliver == 1)?'current':(($productData->minDayReqtoDeliver != 1)?'hide':''));
						$calenderStart = ($productData->isSameDayDelivery || ($productData->minDayReqtoDeliver <= 2 && $productData->isCourierDelivery == 0))?'+2':'+'.$productData->minDayReqtoDeliver;
					?>
					<ul class="tabs">
						<li class="tab-link tab-today <?=$sameDay?>" data-tab="tab-1">Today</li>
						<li class="tab-link tab-tomorrow <?=$tomorrow?>" data-tab="tab-2">Tomorrow</li>
						<li class="tab-link tab-calendar <?=($tomorrow == 'hide')?'current':''?>" data-tab="tab-3">Calendar</li>
					</ul>

					<div id="tab-1" class="tab-content tab-today <?=$sameDay?>">

						<div class="address-delivery-details">
							<h3>Delivery Options for: <span><?=date('d M l Y')?></span></h3>
							<h3>100% Smile Guaranteed   |  100% Safe and Secure Payments</h3>


							<div class="delivery-detail-time-section">
								<ul class="todayTimeSlot">
								</ul>

							</div>


						</div>
					</div>



					<div id="tab-2" class="tab-content tab-tomorrow <?=$tomorrow?>">

						<div class="address-delivery-details">
							<h3>Delivery Options for: <span><?=date('d M l Y', strtotime(' +1 day'))?></span></h3>
							<h3>100% Smile Guaranteed   |  100% Safe and Secure Payments</h3>


							<div class="delivery-detail-time-section">
								<ul class="tomorrowTimeSlot">
								</ul>

							</div>


						</div>
					</div>
					<div id="tab-3" class="tab-content tab-calendar <?=($tomorrow == 'hide')?'current':''?>">

						<div class="address-delivery-details">
							<div id="pnlEventCalendar"></div>

							<h3 class="mt-2 <?=($productData->isCourierDelivery)?'':'hide'?>">100% Smile Guaranteed   |  100% Safe and Secure Payments</h3>
							<h3 class="calender-date <?=($productData->isCourierDelivery)?'text-success':''?>"><?=($productData->isCourierDelivery)?'This is courier product approx delivery date:':'Delivery Options for:'?> <span id="lblEventCalendar"><?=date('d M l Y', strtotime($calenderStart.' day'))?></span></h3>
							<h3 class="<?=($productData->isCourierDelivery)?'hide':''?>">100% Smile Guaranteed   |  100% Safe and Secure Payments</h3>


							<div class="delivery-detail-time-section">
								<ul class="futureTimeSlot">
								</ul>

							</div>


						</div>
					</div>



				</div>
				<!-- end cake type section -->

				<div class="msg-img-section hide">
					<div class="input-field <?=($productData->isMessageReq)?'':'hide'?>">
						<div class="img-text1"><img src="<?php echo FRONTSTATIC; ?>/img/product-detail/msg-icon.png" alt=""></div>
						<input type="text" class="form-control msg-cake" name="message" placeholder="<?=$productData->messagePlaceholder?>"id="msg_cake"  maxlength="30" >
					</div>
					<div class="upload-cake <?=($productData->isPhotoReq)?'':'hide'?>">
						<button class="btn"><i class="fa fa-camera"></i> Upload image</button>
						<input type="file" name="uploadImg" onchange="fileuploadpreview(this)" />
					</div>
				</div>
				<div id="msg_cake_limit" class="hide"></div>
				<div class="msg-img-section hide">
					<div class="upload-cake">
							<div class="profile-img preview-img hide"><img src="" alt="upload Image" class="thumbnail"></div>
					</div>
				</div>
				
				<div class="bag-buy-section">
					<ul>
						<li><a href="javascript:" class="buy-btn"><img src="<?php echo FRONTSTATIC; ?>/img/product-detail/buy-icon.png" alt="">Add to Cart</a></li>
						<li>
							<input type="hidden" name="action" value="addProductToCart">
							<input type="hidden" name="action-btn" id="action-btn" value="add-bag">
							<input type="hidden" name="productId" id="productId" value="<?=$productData->productId?>">
							<input type="hidden" name="variableId" id="variableId" value="<?=$variableId?>">
							<input type="hidden" name="timeslotId" id="timeslotId" value="0">
							<input type="hidden" name="deliveryTimeSlotId" id="deliveryTimeSlotId" value="0">
							<input type="hidden" name="pincodeId" id="pincodeId" value="0">
							<input type="hidden" name="zoneId" id="zoneId" value="0">
							<input type="hidden" name="requestedDeliveryDate" id="requestedDeliveryDate" value="<?=date('Y-m-d', strtotime($calenderStart.' day'))?>">
							<input type="hidden" name="baseItemPrice" id="baseItemPrice" value="<?=($salePrice > 0)?$salePrice:$actualPrice?>">
						</li>
					</ul>
					<div class="msg"></div>
				</div>
				<!--========== gift popup ========-->

				<div id="giftpopup" class="modal fade" role="dialog">
					<div class="modal-dialog city-popup">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<h2>Make Your Gift More Special With</h2>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<div class="city-list giftcard-popup">
									<ul>
										<?php echo $giftpopupHtml; ?>
				                      

									</ul>
								</div>
							</div>
							<div class="modal-footer">
								<div class="price-section">
									<ul>
										<li>
											<h4>Price<br>Details</h4>
										</li>
										<li>
											<p class="item">1 Base Item</p>
											<p class="price giftpopup-base-price">₹ <span><?=($salePrice > 0)?$salePrice:$actualPrice?></span></p>
										</li>
										<li class="add-icon">+</li>
										<li>
											<p class="item giftpopup-addons-qty">0 Add-ons</p>
											<p class="price giftpopup-addons-price">₹ <span>0</span></p>
										</li>
										<li class="add-icon">+</li>
										<li>
											<p class="item">Shipping</p>
											<p class="price giftpopup-shipping-price">₹ <span>200</span></p>
										</li>
										<li class="add-icon">=</li>
										<li>
											<p class="item">Total</p>
											<p class="total giftpopup-total-price">₹ <span>799</span></p>
										</li>
									</ul>
									<button type="button" class="btn continue-btn btn-add-to-cart">Continue Without Add Ons</button>
								</div>
							</div>
						</div>

					</div>
				</div>


				<!--======== end gift popup section ==========-->

			</div>
			<!-- end Product description section -->
		</form>
	</div>
		
</div>
