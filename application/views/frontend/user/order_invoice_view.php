<?php $this->load->viewF('inc/header.php'); ?>

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
                <li><a href="<?=BASEURL;?>/user/profile">My Profile</a></li>
                <li>></li>
                <li><a href="javascript:" class="active">Order Invoice</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!--===== End page Navigate =======-->

      <!--============= My order Section ================-->
      <div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<a href="javascript:" class="btn btn-primary pull-right" id="generate_pdf_btn" target="_blank" ><i class="fa fa-download"></i> Download Invoice</a>
							</div>
							<div class="col-md-12">

								<?php 
								$orderItemHtml= '';
								$totalMrp = $totalAmt = 0; $deliveryAmt =  $grandTotalAmt = 0;
								if (isset($detailData) && !empty($detailData)) {
									foreach ($detailData as $detailKey => $detail) {
										$totalMrp +=$detail->price;
										$amount = round(($detail->price*$detail->qty),2);
										$totalAmt +=$amount;
 										$orderItemHtml .= '<tr> <td width="50%" style="border-bottom: 2px solid #c9d2da; padding: 7px 0; padding-left: 20px; padding-right: 10px; font-size: 15px;">'.$detail->productName.'</td> <td width="10%" style="border-bottom: 2px solid #c9d2da; padding: 7px 0; font-size: 16px; text-align: center;">'.$detail->qty.'</td> <td width="20%" style="border-bottom: 2px solid #c9d2da; padding: 7px 0; padding-left: 20px; padding-right: 10px; font-size: 15px;">₹ '.$detail->price.'</td> <td width="20%" style="border-bottom: 2px solid #c9d2da; padding: 7px 0; padding-left: 20px; padding-right: 20px; font-size: 15px;">₹ '.$amount.'</td> </tr>';

			                            if(!empty($detail->attributeData)){
			                              	foreach ($detail->attributeData as $attribute){
				                              	$totalMrp +=$attribute->attributePrice;
												$amount = $attribute->attributePrice;
												$totalAmt +=$amount;
		 										$orderItemHtml .= '<tr> <td width="50%" style="border-bottom: 2px solid #c9d2da; padding: 7px 0; padding-left: 20px; padding-right: 10px; font-size: 15px;">'.$attribute->attributeName.'</td> <td width="10%" style="border-bottom: 2px solid #c9d2da; padding: 7px 0; font-size: 16px; text-align: center;">1</td> <td width="20%" style="border-bottom: 2px solid #c9d2da; padding: 7px 0; padding-left: 20px; padding-right: 10px; font-size: 15px;">₹ '.$attribute->attributePrice.'</td> <td width="20%" style="border-bottom: 2px solid #c9d2da; padding: 7px 0; padding-left: 20px; padding-right: 20px; font-size: 15px;">₹ '.$amount.'</td> </tr>';
			                              


			                              
			                            	}
 										}

			                            if(!empty($detail->addonsData)){
			                              	foreach ($detail->addonsData as $addons){
				                              	$totalMrp +=$addons->price;
												$amount = $addons->price;
												$totalAmt +=$amount;
		 										$orderItemHtml .= '<tr> <td width="50%" style="border-bottom: 2px solid #c9d2da; padding: 7px 0; padding-left: 20px; padding-right: 10px; font-size: 15px;">'.$addons->addonsName.'</td> <td width="10%" style="border-bottom: 2px solid #c9d2da; padding: 7px 0; font-size: 16px; text-align: center;">1</td> <td width="20%" style="border-bottom: 2px solid #c9d2da; padding: 7px 0; padding-left: 20px; padding-right: 10px; font-size: 15px;">₹ '.$addons->price.'</td> <td width="20%" style="border-bottom: 2px solid #c9d2da; padding: 7px 0; padding-left: 20px; padding-right: 20px; font-size: 15px;">₹ '.$amount.'</td> </tr>';
			                              


			                              
			                            	}
 										}
 									}

								}
								?>

								<div class="invoice-box" id="invoice-box">

									<style type="text/css">

										@import url('https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i');


										.invoice-box {
											max-width: 700px;
											margin: auto;
											padding: 20px 0px;
											color: #555;
											background-color: #f9f9f9;-webkit-print-color-adjust: exact;
										}

										.invoice-box table tr td{
											color: #000;
											font-family: "Roboto", sans-serif;
										}


									</style>
									<table width="100%" cellpadding="0" cellspacing="0" style="font-family: 'Roboto',sans-serif;">

										<tr>
											<td style="text-align: center; padding-bottom: 20px; border-bottom: 2px solid #000;">
												<img src="<?=FRONTSTATIC.'/img/invoice-title.png'?>" alt="" style="width: 187px;">
											</td>
										</tr>

										<tr>
											<td style="background-color: #fbfbfb;-webkit-print-color-adjust: exact;">
												<table width="100%" cellpadding="0" cellspacing="0">
													<tr>
														<td style="border-bottom: 2px solid #000; padding: 10px 20px;">
															<table width="100%" cellpadding="0" cellspacing="0">
																<tr>
																	<td style="padding-bottom: 8px;">
																		<p style="font-weight: 600; font-size: 20px; margin: 0;">Sold By: <span style="padding-left: 5px";> Chashma4u</span></p>
																	</td>
																</tr>
															</table>
															<table width="100%" cellpadding="0" cellspacing="0" style="vertical-align: top;">
																<tr>
																	<td style="vertical-align: top; font-weight: 600; font-size: 15px; width: 110px;">
																		Ship Address :
																	</td>
																	<td style="padding-left: 10px;vertical-align: top; font-size: 14px;">
																		Chashma4u and Gift India Pvt Ltd,312, 3rd Floor ,D-288-289/10, Wadhwa Business Complex Vikas Marg ,LAXMI NAGAR NEW DELHI 110092
																	</td>
																</tr>
															</table>
															<table width="100%" cellpadding="0" cellspacing="0" style="vertical-align: top;">
																<tr>
																	<td style="vertical-align: top; padding: 10px 0;">
																		<table cellpadding="0" cellspacing="0">
																			<tr>
																				<td style="padding-bottom: 5px;"><span style="font-size: 15px; font-weight: 600;">GSTIN</span></td>
																				<td style="padding: 0 10px;padding-bottom: 5px;">:</td>
																				<td style="font-size: 15px;padding-bottom: 5px;">06AAXCS0655F1Z2</td>
																			</tr>
																			<tr>
																				<td><span style="font-size: 15px; font-weight: 600;">PAN</span></td>
																				<td style="padding: 0 10px;">:</td>
																				<td style="font-size: 15px;">AAXCS0655F</td>
																			</tr>
																		</table>
																	</td>
																	<td style="vertical-align: top; text-align: right; padding: 10px 0;font-size: 15px;">
																		<p style="margin:0; font-size: 15px; "><span style="font-weight: 600;">GSTIN</span><span style="padding: 0 10px;font-size: 16px;">:</span> 06AAXCS0655F1Z2</p>
																	</td>
																</tr>
															</table>
														</td>
													</tr>

													<tr>
														<td style="border-bottom: 2px solid #000; padding: 0px 20px;">
															<table width="100%" cellspacing="0" cellpadding="0">
																<tr>
																	<td style="border-right: 1px solid #c9d2da; padding: 10px 0; padding-right: 20px; width: 50%;">
																		<h3 style="margin: 0; font-size: 17px; padding-bottom: 5px; font-weight: 600;font-family: 'Roboto', sans-serif;">Ship To</h3>
																		<p style="margin: 0; font-size: 15px;"><?=ucfirst($orderData->addressData->name).', '.$orderData->addressData->address.' '.$orderData->addressData->address2.', '.$orderData->addressData->city.' '.$orderData->addressData->pincode.$orderData->addressData->mobile;?>
																			
																		</p>
																	</td>
																	<td style=" padding: 10px 0; padding-left: 20px; width: 50%;">
																		<h3 style="margin: 0; font-size: 17px; padding-bottom: 5px; font-weight: 600;font-family: 'Roboto', sans-serif;">Bill To</h3>
																		<p style="margin: 0; font-size: 15px;"><?=ucfirst($orderData->addressData->name).', '.$orderData->addressData->address.' '.$orderData->addressData->address2.', '.$orderData->addressData->city.' '.$orderData->addressData->pincode.$orderData->addressData->mobile;?>
																		</p>
																	</td>
																</tr>
															</table>
														</td>
													</tr>

													<tr>
														<td style="border-bottom: 2px solid #000; padding: 0px 20px;">
															<table width="100%" cellspacing="0" cellpadding="0">
																<tr>
																	<td style="border-right: 1px solid #c9d2da; padding: 10px 0; padding-right: 30px; vertical-align: top; width: 50%;">
																		<p style="margin: 0; font-size: 15px;padding-bottom: 5px;"><span style="font-weight: 600; padding-right: 10px;">Order :</span> <?=$orderData->generatedId;?></p>
																		<p style="margin: 0; font-size: 15px;padding-bottom: 5px;"><span style="font-weight: 600; padding-right: 10px;">Invoice Number :</span>  <?=$orderData->orderId;?></p>
																		<p style="margin: 0; font-size: 15px;padding-bottom: 5px;"><span style="font-weight: 600; padding-right: 10px;">Payment method :</span> <?=ucfirst($orderData->paymentMethod);?></p>
																		<p style="margin: 0; font-size: 15px;padding-bottom: 5px;"><span style="font-weight: 600; padding-right: 10px;">Total Items :</span> <?=@($detailKey+1)?></p>
																	</td>
																	<td style=" padding: 10px 0; padding-left: 30px; vertical-align: top; width: 50%;">
																		<p style="margin: 0; font-size: 15px;padding-bottom: 5px;"><span style="font-weight: 600; padding-right: 10px;">Order Date :</span> <?=date('d-m-Y', strtotime($orderData->addedOn))?></p>
																		<p style="margin: 0; font-size: 15px;padding-bottom: 5px;"><span style="font-weight: 600; padding-right: 10px;">Invoice Date :</span>  <?=date('d-m-Y', strtotime($orderData->addedOn))?></p>
																		<p style="margin: 0; font-size: 15px;padding-bottom: 5px;"><span style="font-weight: 600; padding-right: 10px;">Tracking ID :</span> <?=$orderData->generatedId;?></p>
																	</td>
																</tr>
															</table>
														</td>
													</tr>

												</table>
											</td>
										</tr>

										<tr>
											<td>
												<table width="100%" cellspacing="0" cellpadding="0">
													<tr>
														<th width="50%" style="border-bottom: 2px solid #000; padding: 7px 0; padding-left: 20px; padding-right: 10px; font-size: 15px; text-align: left;">DESCRIPTION</th>
														<th width="10%" style="border-bottom: 2px solid #000; padding: 7px 0; font-size: 16px; text-align: center;">QTY</th>
														<th width="20%" style="border-bottom: 2px solid #000; padding: 7px 0; padding-left: 20px; padding-right: 10px; font-size: 15px; text-align: left;">MRP(Rs)</th>
														<th width="20%" style="border-bottom: 2px solid #000; padding: 7px 0; padding-left: 20px; padding-right: 30px; font-size: 15px; text-align: left;">AMOUNT</th>
													</tr>
													<?=$orderItemHtml?>
													<tr>
														<th width="50%" style="border-bottom: 2px solid #000; padding: 7px 0; padding-left: 20px; padding-right: 10px; background-color: #ededed;-webkit-print-color-adjust: exact; font-size: 15px; text-align: left;">SUMMARY</th>
														<th width="10%" style="border-bottom: 2px solid #000; padding: 7px 0; background-color: #ededed;-webkit-print-color-adjust: exact; font-size: 15px; text-align: center;"></th>
														<th width="20%" style="border-bottom: 2px solid #000; padding: 7px 0; padding-left: 20px; padding-right: 10px; background-color: #ededed;-webkit-print-color-adjust: exact; font-size: 15px; text-align: left;">₹ <?=$totalMrp?></th>
														<th width="20%" style="border-bottom: 2px solid #000; padding: 7px 0; padding-left: 20px; padding-right: 20px; background-color: #ededed;-webkit-print-color-adjust: exact; font-size: 15px; text-align: left;">₹ <?=$totalAmt ?></th>
													</tr>
												</table>
											</td>
										</tr>

										<tr>
											<td style="padding: 15px 0; padding-right: 20px; border-bottom: 2px solid #000;">
												<table width="40%" cellpadding="0" cellspacing="0" style="float: right; clear: both;">
													<tr>
														<td style="width: 50%; font-size: 15px; font-weight: 600;padding: 3px 0;">Total Amount</td>
														<td style="width: 10%; font-size: 15px; font-weight: 600; text-align: center;padding: 3px 0;">:</td>
														<td style="width: 40%; font-size: 15px; font-weight: 600;padding: 3px 0;">₹ <?=$totalAmt?> </td>
													</tr>
													<tr>
														<td style="width: 50%; font-size: 15px; font-weight: 600;padding: 3px 0;">Delivery Charges</td>
														<td style="width: 10%; font-size: 15px; font-weight: 600;padding: 3px 0; text-align: center;">:</td>
														<td style="width: 40%; font-size: 15px; font-weight: 600;padding: 3px 0;">₹ <?=$orderData->deliveryCharge ?></td>
													</tr>
													<tr>
														<td style="width: 50%; font-size: 15px; font-weight: 600;padding: 6px 0;">Grand Total</td>
														<td style="width: 10%; font-size: 15px; font-weight: 600;padding: 6px 0; text-align: center;">:</td>
														<td style="width: 40%; font-size: 15px; font-weight: 600;padding: 6px 0;">₹ <?=round(($totalAmt+$orderData->deliveryCharge),2)?> </td>
													</tr>
												</table>
											</td>
										</tr>

										<tr>
											<td style="padding: 10px 20px; border-bottom: 2px solid #000;">
												<h3 style="font-size: 16px;margin: 0;padding-bottom: 5px; font-weight: 600;font-family: 'Roboto', sans-serif;">Return Policy: </h3>
												<p style="font-size: 13px;margin: 0;">After placing the order customer can cancel the order within 1 hour if he/she wish to. And in case of customer request for Refund, it will be processed through same mode within 10 working days. Products cannot be returned.</p>
											</td>
										</tr>

										<tr>
											<td style="text-align: center; padding-top: 20px;">
												<img src="<?=FRONTSTATIC.'/img/thank-you.png'?>" alt="" style="width: 192px;">
											</td>
										</tr>

									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>





<?php $this->load->viewD('inc/footer.php'); ?>
<script type="text/javascript" src="<?=DASHSTATIC?>/admin/js/jspdf/jspdf.min.js"></script>
<script type="text/javascript" src="<?=DASHSTATIC?>/admin/js/jspdf/es6-promise.min.js"></script>
<script type="text/javascript" src="<?=DASHSTATIC?>/admin/js/jspdf/html2pdf.min.js"></script>
<script type="text/javascript" src="<?=DASHSTATIC?>/admin/js/jspdf/jspdf.debug.js"></script>
<script type="text/javascript">


$('#generate_pdf_btn').click(function(event){
  event.preventDefault();
  var element = document.getElementById('invoice-box');
  var opt = {
  margin:       0,
  filename:     "CHASHMA4U<?='_'.$orderData->generatedId?>.pdf",
  image:        { type: 'jpeg', quality: 1 },
  html2canvas:  { scale: 1 },
  jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
  };

  html2pdf().from(element).set(opt).save();
});
</script>

</body>

</html>