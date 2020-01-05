<?php $this->load->viewD('inc/header.php'); ?>
<!-- partial -->
<?php $this->load->viewD('inc/sidebar.php'); ?>

<div class="main-panel">
	<div class="content-wrapper">
		<div class ="row">
			<div class="col-12 grid-margin">
				<div class="card">
					<div class="card-body">
						<div class="card-title text-warning mb-5">Order : <?=$orderData->generatedId;?>
							<div class="template-demo pull-right">
								<a href="javascript:" class="btn btn-primary" id="generate_pdf_btn" target="_blank" >Download</a>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">

																<?php 
								$orderItemHtml= '';
								$totalMrp = $totalAmt = 0; $deliveryAmt =  $grandTotalAmt = 0;
								if (isset($detailData) && !empty($detailData)) {
									foreach ($detailData as $detailKey => $detail) {
										$totalMrp +=$detail->price;
										$amount = round(($detail->price*$detail->qty),2);
										$totalAmt +=$amount;

										$detail->productName = $detail->productName.(($detail->variableTitle)?' - '.$detail->variableTitle.'':'');

 										if(!empty($detail->attributeData)){
			                              	foreach ($detail->attributeData as $attribute){
				                              	$totalMrp +=($attribute->qty*$attribute->price);
												$amount = ($attribute->qty*$attribute->price);
												$totalAmt +=$amount;

												$detail->productName = $detail->productName.', '.$attribute->attributeHeading.' - '.$attribute->attributeName;
			                              
			                            	}
 										}

 										$orderItemHtml .= '<tr> <td width="50%" style="border-bottom: 2px solid #c9d2da; padding: 7px 0; padding-left: 20px; padding-right: 10px; font-size: 15px;">'.$detail->productName.'</td> <td width="10%" style="border-bottom: 2px solid #c9d2da; padding: 7px 0; font-size: 16px; text-align: center;">'.$detail->qty.'</td></tr>';

			                           
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
												<center>
													<p style="background: #9a3334;text-align: center;padding: 10px;color: white;font-weight: 500;font-size: 17px;">SLIP - <?=$orderData->generatedId;?></p>
												</center>
											</td>
										</tr>

										<tr>
											<td style="background-color: #fbfbfb;-webkit-print-color-adjust: exact;">
												<table width="100%" cellpadding="0" cellspacing="0">

													<tr>
														<td style="border-bottom: 2px solid #000; padding: 0px 20px;">
															<table width="100%" cellspacing="0" cellpadding="0">
																<tr>
																	<td style="border-right: 1px solid #c9d2da; padding: 10px 0; padding-right: 20px; width: 50%;">
																		<h3 style="margin: 0; font-size: 17px; padding-bottom: 5px; font-weight: 600;font-family: 'Roboto', sans-serif;">Reciever Details</h3>
																		<p style="margin: 0; font-size: 15px;"><?=ucfirst($orderData->addressData->name).', '.$orderData->addressData->address.' '.$orderData->addressData->address2.', '.$orderData->addressData->city.' '.$orderData->addressData->pincode.' '.$orderData->addressData->mobile;?>
																			
																		</p>
																	</td>
																	<td style=" padding: 10px 0; padding-left: 20px; width: 50%;">
																		<h3 style="margin: 0; font-size: 17px; padding-bottom: 5px; font-weight: 600;font-family: 'Roboto', sans-serif;">Bill To</h3>
																		<p style="margin: 0; font-size: 15px;"><?=ucfirst($orderData->addressData->name).', '.$orderData->addressData->address.' '.$orderData->addressData->address2.', '.$orderData->addressData->city.' '.$orderData->addressData->pincode.' '.$orderData->addressData->mobile;?>>
																		</p>
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
													</tr>
													<?=$orderItemHtml?>
												</table>
											</td>
										</tr>

										<tr>
											<td style="text-align: center; padding-top: 20px;">
												<img src="<?=DASHSTATIC.'/admin/images//thank-you.png'?>" alt="" style="width: 192px;">
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