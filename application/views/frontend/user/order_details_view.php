<?php $this->load->viewF("inc/header.php"); ?>

    <div class="page-content">
        <div class="holder mt-0">
            <div class="container">
                <ul class="breadcrumbs">
                    <li><a href="<?=BASEURL?>">Home</a></li>
                    <li><span>Order Details</span></li>
                </ul>
            </div>
        </div>
        <div class="holder mt-0">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 aside aside--left">
                        <?php $this->load->viewF("user/sidebar.php"); ?>
                    </div>
                    <div class="col-md-9 aside">
                        <h2>Order Details</h2>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                      
                                      <?php

                                          if ($orderData->paymentStatus == 0) {
                                            $orderData->status = "Payment Pending";
                                            $orderData->class = "badge badge-warning";
                                          }elseif ($orderData->paymentStatus == 2) {
                                            $orderData->status = "Payment Failed";
                                            $orderData->class = "badge badge-danger";
                                          }elseif ($orderData->paymentStatus == 3) {
                                            $orderData->status = "Payment Cancelled";
                                            $orderData->class = "badge badge-danger";
                                          }elseif ($orderData->paymentStatus == 1 && $orderData->status == 0) {
                                            $orderData->status = "Order received";
                                            $orderData->class = "badge badge-dark";
                                          }elseif ($orderData->status == 1) {
                                            $orderData->status = "Vendor confirmed";
                                            $orderData->class = "badge badge-info";
                                          }elseif ($orderData->status == 2) {
                                            $orderData->status = "Processing";
                                            $orderData->class = "badge badge-primary";
                                          }elseif ($orderData->status == 3) {
                                            $orderData->status = "Ready to ship";
                                            $orderData->class = "badge badge-warning";
                                          }elseif ($orderData->status == 4) {
                                            $orderData->status = "Shipped";
                                            $orderData->class = "badge badge-light";
                                          }elseif ($orderData->status == 5) {
                                            $orderData->status = "Delivered";
                                            $orderData->class = "badge badge-success";
                                          }elseif ($orderData->status == 6) {
                                            $orderData->status = "Cancelled";
                                            $orderData->class = "badge badge-danger";
                                          }else {
                                            $orderData->status = "Unknown";
                                            $orderData->class = "badge badge-secondary";
                                          }
                                      ?>
                                        <h3>Order: <?=$orderData->generatedId.' <span class="'.$orderData->class.'">'.$orderData->status.'</span>';?></h3>
                                        <p>
                                          <b>Order Total:</b> ₹<?=$orderData->cartTotal;?><br>
                                          <b>Tax:</b> ₹<?=$orderData->tax;?><br>
                                          <b>Paid Total:</b> ₹<?=$orderData->paidAmt;?><br>
                                          <b>Payment Method:</b> <?=$orderData->paymentMethod;?><br>
                                          <b>Payment Status:</b> 
                                            <?php
                                              if ($orderData->paymentMethod=='cod' && $orderData->paymentStatus == 0) {
                                                $orderData->paymentStatus = "COD Payment Pending";
                                                $orderData->paymentClass = "badge badge-light text-danger";
                                              }elseif ($orderData->paymentStatus == 0) {
                                                $orderData->paymentStatus = "Payment Pending";
                                                $orderData->paymentClass = "badge badge-light text-danger";
                                              }elseif ($orderData->paymentStatus == 1) {
                                                $orderData->paymentStatus = "Payment Success";
                                                $orderData->paymentClass = "badge badge-success";
                                              }elseif ($orderData->paymentStatus == 2) {
                                                $orderData->paymentStatus = "Payment Failed";
                                                $orderData->paymentClass = "badge badge-danger";
                                              }elseif ($orderData->paymentStatus == 3) {
                                                $orderData->paymentStatus = "Payment Cancelled";
                                                $orderData->paymentClass = "badge badge-dark";
                                              }else {
                                                $orderData->paymentStatus = "Unknown";
                                                $orderData->paymentClass = "badge badge-warning";
                                              }
                                              echo '<span class="'.$orderData->paymentClass.'">'.$orderData->paymentStatus.'</span>';
                                            ?><br>
                                          <b>Delivery Address:</b> <?=$orderData->addressData->address.($orderData->addressData->address2?', '.$orderData->addressData->address2:'').', '.$orderData->addressData->city.', '.$orderData->addressData->state.', '.$orderData->addressData->pincode;?><br>

                                          </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3 profile-form">
                            <div class="card-body">
                                <h3>ORDER SUMMARY</h3>
                                <div class="row mt-2">
                                  <div class="col-md-12">
                                      <div class="cart-table cart-table--sm">
                                          <div class="cart-table-prd cart-table-prd-headings d-none d-lg-table">
                                              <div class="cart-table-prd-image"></div>
                                              <div class="cart-table-prd-name"><b>ITEM</b></div>
                                              <div class="cart-table-prd-qty"><b>QTY</b></div>
                                              <div class="cart-table-prd-price"><b>PRICE</b></div>
                                          </div>
                                         
                                        <?php if (isset($detailData) && !empty($detailData)) {
                                            foreach ($detailData as $key => $detail) {


                                              $categoryIds = array();
                                              if(isset($detail->categoryIds) && !empty($detail->categoryIds))
                                                $categoryIds = explode(',', $detail->categoryIds);

                                              $lensHtml = $detailHtml = '';

                                              if(in_array(1, $categoryIds)){
                                                if (!empty($detail->lensName)) {
                                                  $lensHtml = '<tr> <th>Lens</th> <td colspan="3">'.$detail->lensName.' (₹'.$detail->lensPrice.')</td></tr>';
                                                }

                                                if($detail->prescription_type =='single-vision' || $detail->prescription_type =='bifocal-progressive')
                                                    $detailHtml = '<tr> <th>Type</th> <td colspan="3">'.(($detail->prescription_type =='single-vision')?'Single Vision':'Bifocal Progressive').'</td></tr>';
                                                  if(($detail->rsph+$detail->rcyl+$detail->raxis+$detail->radd+$detail->lsph+$detail->lcyl+$detail->laxis+$detail->ladd) != 0)
                                                    $detailHtml .= '<tr> <th></th> <th>SPH</th> <th>CYL</th> <th>Axis</th> '.(($detail->prescription_type =='single-vision')?'':'<th>ADD</th>').' </tr> <tr> <td>Right(OD)</td> <td>'.$detail->rsph.'</td> <td>'.$detail->rcyl.'</td> <td>'.$detail->raxis.'</td> '.(($detail->prescription_type =='single-vision')?'':'<td>'.$detail->radd.'</td>').' </tr> <tr> <td>Left(OS)</td> <td>'.$detail->lsph.'</td> <td>'.$detail->lcyl.'</td> <td>'.$detail->laxis.'</td> '.(($detail->prescription_type =='single-vision')?'':'<td>'.$detail->ladd.'</td>').' </tr>'.(($detail->pd)?'<tr> <th>PD</th> <td colspan="3">'.$detail->pd.'</td></tr>':'');
                                                else if($detail->prescription_type =='zero-power')
                                                    $detailHtml = '<tr> <th>Type</th> <td colspan="3">Zero Power</td></tr>';
                                                else if($detail->prescription_type =='frame-only')
                                                    $detailHtml = '<tr> <th>Type</th> <td colspan="3">Frame only</td></tr>';

                                                $detailHtml = '<div class="sidebar-block collapsed "> <div class="sidebar-block_title py-0"><span>Details </span> <div class="toggle-arrow" style="top: 0px;"></div> </div> <div class="sidebar-block_content"> <table class="table table-bordere"><tbody>'.$lensHtml.$detailHtml.(($detail->message)?'<tr> <th>Additional Information</th> <td colspan="3">'.$detail->message.'</td></tr>':'').(($detail->prescription_image)?'<tr> <th>Prescription image</th> <td colspan="3"><img src="'.UPLOADPATH.'/prescription_images/'.$detail->prescription_image.'" class="cart-prescription-image"></td></tr>':'').' </tbody> </table> </div> </div>';
                                              }elseif(in_array(4, $categoryIds)){
                                                $detailHtml = '<div class="sidebar-block collapsed open"> <div class="sidebar-block_title py-0"><span>Details </span> <div class="toggle-arrow" style="top: 0px;"></div> </div> <div class="sidebar-block_content"> <table class="table table-bordere table-hover"><tbody><tr> <th>Number</th> <td colspan="3">+'.number_format((float)$detail->rgn, 2, '.', '').'</td></tr></tbody> </table> </div> </div>';
                                              }

                                                // $prescription_type = ($detail->prescription_type == 'single-vision')?'Single vision':(($detail->prescription_type == 'frame-only')?'Frame only':(($detail->prescription_type == 'zero-power')?'Zero power':(($detail->prescription_type == 'bifocal-progressive')?'Bifocal Progressive':$detail->prescription_type)));
                                                echo '<div class="cart-table-prd"> <div class="cart-table-prd-image"><a href="'.BASEURL.'/'.$detail->slug.'"><img src="'.getResizedImg($detail->img,'345_270').'" ></a></div> <div class="cart-table-prd-name"> <h5><a href="'.BASEURL.'/'.$detail->slug.'">'.$detail->brandName.'</a></h5><h2><a href="'.BASEURL.'/'.$detail->slug.'">'.$detail->productName.(($detail->variableTitle)?' - '.$detail->variableTitle:'').(($detail->lensName)?' - '.$detail->lensName:'').'</a></h2> '.$detailHtml.'</div> <div class="cart-table-prd-qty"><b>'.$detail->qty.'</b></div> <div class="cart-table-prd-price"><b>₹ '.$detail->subtotal.'</b></div> </div>';
                                            }
                                        }else{
                                            echo '<div class="minicart-prd">
                                            No items in your cart.</div>';
                                        }?>
                                          
                                      </div>
                                      <div class="card-total-sm">
                                          <div class="float-right">Subtotal <span class="card-total-price">₹ <?=$orderData->grandTotal;?></span></div>
                                      </div>
                                  </div>
                                    <div class="col-sm-12">
                                      <div class="minicart-drop-content">
                                      </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- End View Profile Details Section -->
<?php $this->load->viewF("inc/footer.php"); ?>