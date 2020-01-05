<?php $this->load->viewF('inc/header.php'); ?>
		<!--============= Cart Section ================-->
		<div class="grey-background">
			<div class="cart-section">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<h1>Express Delivery Products</h1>
						</div>
					</div>
				
					<div class="row">
						<div class="col-md-9">
							<div class="cart-detail">
								<table class="table table-bordered cart-table">
									<tr>
										<th>Products in Cart (<span class="cart-item-count"><?=(isset($cartData->cartItemsCount) && !empty($cartData->cartItemsCount)) ?$cartData->cartItemsCount:0 ?></span>)</th>
										<th>Qty.</th>
										<th>Delivery Options</th>
										<th>Subtotal</th>
										<th>Remove</th>
									</tr>
									<?php if (isset($cartData->detailData) && !empty($cartData->detailData)) {
										$grandTotal = 0;
										foreach ($cartData->detailData as $detail) { 
											$grandTotal += $detail->subtotal;
											?>

									<tr class="cart-item">
										<td>
											<div class="cart-product-detail">
											<div class="cart-img" onclick="window.location.href='<?=BASEURL.'/'.$detail->slug;?>';">
												<img src="<?=getResizedImg($detail->img,'200_200')?>" alt="<?=$detail->productName?>">
											</div>
											<div class="cart-content">
												<h4><?=$detail->productName?></h4>
												<ul>
													<?=($detail->variableTitle)?'<li>'.$detail->variableTitle.'</li>':''?>
													
													<?=($detail->message)?'<li onclick="showMessageModel(this, event,'.$detail->detailId.')"><span class="msgg">'.$detail->message.'</span><span><i class="fa fa-pencil"></i></span></li>':''?>
												</ul>
											</div>
											</div>	
										</td>
										<td>
											<div class="cartproduct-quantity processing-parent">
												<div class="button-container" title="Decrease Quantity">
													<button class="cart-qty-minus btn" type="button" value="-" onclick="incDscQty(this, event,'dsc')">-</button>
												</div>
												
												<input type="text" name="qty" class="qty" maxlength="12" value="<?=$detail->qty?>" qty="<?=$detail->qty?>" class="input-text qty" onkeypress="return OnlyInteger()" onchange="changeQty(this, event, '<?=$detail->detailId?>', 'product')"/>
												<div class="button-container" title="Increase Quantity">
													<button class="cart-qty-plus btn" type="button" value="+" onclick="incDscQty(this, event,'inc')">+</button>
												</div>
											</div>
										</td>
										<td>
											<?php 
												if($detail->isCourierDelivery){
                                                   if($detail->deliveryAmount == "0")
                                                   	$detail->deliveryAmount = 'Free';
                                                   else
                                                   	$detail->deliveryAmount = ' Rs. '.$detail->deliveryAmount;
													?>
													<h4>Delivery  Charge - <?=$detail->deliveryAmount?> <span title="This is delivery charge.">(?)</span></h4>
													<p>On <?=date('d-m-Y', strtotime($detail->requestedDeliveryDate))?> at pincode - <?=$detail->pincode?></p>


												<?php }else{
                                                    if($detail->deliveryAmount == "0")
                                                   	$detail->deliveryAmount = 'Free';
                                                   else
                                                   	$detail->deliveryAmount = ' Rs. '.$detail->deliveryAmount;
												 ?>
													<h4><?=$detail->deliveryType?> - <?=$detail->deliveryAmount?> <span title="This is delivery type with specific delivery charge.">(?)</span></h4>
													<p>On <?=date('d-m-Y', strtotime($detail->requestedDeliveryDate))?> between <?=$detail->startTime?> hrs - <?=$detail->endTime?> hrs at pincode - <?=$detail->pincode?></p>

												<?php } ?>

											
										</td>
										<td class="cart-product-price">
											<h4>Rs. <span class="subtotal"><?=$detail->subtotal?></span></h4>
										</td>
										<td>
											<div class="remove-icon" title="Remove from cart" onclick="removeItem(this, event, '<?=$detail->detailId?>', 'product')">
												<a href="javascript:"><i class="fa fa-trash"></i></a>
											</div>
										</td>
									</tr>




									<?php 	
									$addonsData = $this->Common_model->exequery("SELECT cad.*, pa.addonsName, pa.img, pa.price FROM oc_cart_addons_detail as cad left join oc_product_addons as pa on pa.addonsid = cad.addonsId WHERE detailId = '".$detail->detailId."'");

									if (!empty($addonsData)) {
										
										foreach ($addonsData as $addons) {

											?>

									<tr class="cart-item addons-of-<?=$detail->detailId?>">
										<td>
											<div class="cart-product-detail">
											<div class="cart-img">
												<img src="<?=UPLOADPATH.'/addons_images/'.$addons->img?>" alt="<?=$addons->addonsName?>">
											</div>
											<div class="cart-content">
												<h4><?=$addons->addonsName?></h4>
											</div>
											</div>	
										</td>
										<td>
											<div class="cartproduct-quantity processing-parent">
												<div class="button-container" title="Decrease Quantity">
													<button class="cart-qty-minus btn" type="button" value="-" onclick="incDscQty(this, event,'dsc')">-</button>
												</div>
												
												<input type="text" name="qty" class="qty" maxlength="12" value="<?=$addons->qty?>" qty="<?=$addons->qty?>" class="input-text qty" onkeypress="return OnlyInteger()" onchange="changeQty(this, event, '<?=$addons->addonsDetailId?>', 'addons')"/>
												<div class="button-container" title="Increase Quantity">
													<button class="cart-qty-plus btn" type="button" value="+" onclick="incDscQty(this, event,'inc')">+</button>
												</div>
											</div>
										</td>
										<td>
											<h4><?=$detail->deliveryType?></h4>
											<p>On <?=date('d-m-Y', strtotime($detail->requestedDeliveryDate))?> between <?=$detail->startTime?> hrs - <?=$detail->endTime?> hrs at pincode - <?=$detail->pincode?></p>
										</td>
										<td class="cart-product-price">
											<h4>Rs. <span class="subtotal"><?=$addons->qty*$addons->price?></span></h4>
										</td>
										<td>
											<div class="remove-icon" title="Remove from cart" onclick="removeItem(this, event, '<?=$addons->addonsDetailId?>', 'addons')">
												<a href="javascript:"><i class="fa fa-trash"></i></a>
											</div>
										</td>
									</tr>

									


								<?php	} }



								} }else{ ?>
									<tr>
										<td colspan="5">
											<div class="cart-product-detail">
												<div class="cart-content">
													<h4>No Items in your cart !</h4>
												</div>

												<div class="place-order-section" style="margin-left: 40px; padding: unset; box-shadow: unset;">
													<div class="btn-group">
														<a href="<?=BASEURL?>" class="btn shopping-btn">Continue Shopping</a>
													</div>
												</div>
											</div>	
										</td>
										
									</tr>

									<?php 	}  ?>

								</table>
							</div>
						</div>
						<div class="col-md-3">
							<div class="place-order-section <?=(isset($grandTotal))?'':'hide'?>">
								<p>Have a Coupon Code? You can apply the discount coupon in the Checkout Process</p>
								<ul>
									<li class="total-title">Grand Total</li>
									<li class="total-price">₹<span><?=(isset($cartData->grandTotal) && !empty($cartData->grandTotal)) ?$cartData->grandTotal:'0.00' ?></span></li>
								</ul>
								<div class="btn-group">
									<a href="<?=BASEURL.'/cart/checkout'?>" class="btn order-place-btn">Place Order</a>
									<a href="<?=BASEURL?>" class="btn shopping-btn">Continue Shopping</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--============= Cart Section ================-->


		<!-- message Popup -->
		<div class="modal" id="message-model">
			<div class="modal-dialog">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header">
						<h1 class="modal-title">Change Message</h1>
						<button type="button" class="close" data-dismiss="modal">×</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">
						<form class="form-row">
							<div class="form-group  col-12 msg"></div>

							<div class="form-group input-group-sm col-12">
								<label for="review">Message</label>
								<textarea class="form-control" rows="2" id="message" name="message"><?=$detail->message?></textarea>
							</div>


							<div class="form-group">
								<button type="button" class="btn btn-primary" onclick="updateCartMsg(this, event)">Submit</button>
								<input type="hidden" name="detailId" id="detailId" value="$detail->detailId">
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
		<!-- End message Popup -->

		<?php $this->load->viewF('inc/footer.php'); ?>
		<script type="text/javascript">
			function showMessageModel(obj, e, detailId){
				e.preventDefault();
				$('#message').html($(obj).find('span.msgg').html());
				$('#detailId').val(detailId);
				$('#message-model').modal('show');
			}
		</script>

	</body>
</html>