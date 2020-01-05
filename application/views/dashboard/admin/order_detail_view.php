<?php $this->load->viewD('inc/header.php'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
    <!-- partial -->
    <?php $this->load->viewD('inc/sidebar.php'); ?>
    <style type="text/css">
      .badge-secondary {
        border: 1px solid #e5e5e5;
        color: #1b1919;
      }
      .badge-light {
        border: 1px solid #f3f5f6;
        color: #757575;
      }
    </style>
    <style>
      .order-inner-section1 {
        border: 1px solid #e5e5e5;
        padding: 11px;
        border-radius: 5px;
        margin-bottom: 5px;
      }
      .order-section1 .img img {
        width: 100%;
      }

      .order-section1 .img img {
        width: 100%;
      }
      .multiple-img ul{
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        list-style: none;
        padding-left: 0.3rem;
      }

      .multiple-img ul li{
        width: 48%;
        margin-bottom: 7px;
      }

      .multiple-img li img{
        width: 100%;
      }

      .heading12 {
        display: flex;
        align-items: center;
        margin-bottom:18px;
      }

      .heading12 h3 {
        font-size: 24px;
        color: #000;
        display: flex;
        align-items: center;
        margin-bottom: 0px;
      }

      .heading12 span.item-status {
        margin-left: 10px;
        padding: 6px 7px;
        min-width: auto;
        font-size: 0.85rem;
        font-weight: 500;
      }

      .ordered-discription table.table {
        width: 100%;
      }

      .ordered-discription {
        overflow: hidden;
      }

      .ordered-discription table.table td, .ordered-discription table.table th {white-space: unset;
        padding: 0px 15px 5px 15px;
        font-size: 14px;
        line-height: 1.3em;
        height: auto;border: 0;
        color: #7a7a7a;
      }

      .ordered-discription table.table th {
        padding-left: 0;
        width: 120px;
        font-weight: 600;
      }

      .ordered-discription table.attr {
        width: 100%;
      }

      .ordered-discription table.attr td {
        font-weight: 400;
      }

      .ordered-discription table.attr h2 {
        font-size: 18px;
        font-weight: 900;
        margin-bottom: 0;
        margin-top: 4px;
        font-family: inherit;
      }
      .ordered-discription table.table td p {
        margin: 0;
      }

      .ordered-discription table.table td p span {
        font-weight: 600;
      }





      .image-download {
        position: relative;
        margin-top: 3px;
        width: 100px;
        height: 100px;
      }

      .image-download .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0);
        transition: background 0.5s ease;
      }

      .image-download:hover .overlay {
        display: block;
        background: rgba(0, 0, 0, .3);
      }

      .image-download img {
        position: absolute;
        width: 100px;
        height: 100px;
        left: 0;
        border: 2px solid #dad7d7;
        padding: 2px;
      }


      .image-download .button {
        position: absolute;
        width: 100px;
        left:0;
        top: 40px;
        text-align: center;
        opacity: 0;
        transition: opacity .35s ease;
      }

      .image-download .button a {
        width: 50px;
        padding: 5px 10px;
        text-align: center;
        color: white;
        border: solid 2px white;
        z-index: 1;
        border-radius:50px;
      }

      .image-download:hover .button {
        opacity: 1;
      }
      tr.bg-prescription th {
          padding: 6px;
      }



      tr.bg-prescription th {
          padding: 5px!important;
      }
      tr.bg-prescription {
          background-color: #efefef !important;
      }



    </style>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class ="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <div class="card-title text-warning mb-5">Order : <?=$orderData->generatedId;?>
                    <div class="template-demo pull-right">
                      <a href="<?=DASHURL.'/'.$this->sessDashboard?>/order" class="btn btn-info">Order List</a>
                      <a href="<?=DASHURL.'/'.$this->sessDashboard.'/order/invoice/'.$orderData->orderId?>" class="btn btn-primary" target="_blank" >Invoice</a>
                      <a href="<?=DASHURL.'/'.$this->sessDashboard.'/order/slip/'.$orderData->orderId?>" class="btn btn-dark" target="_blank" >Slip</a>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <h4>User Details</h4>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">IP Address : </div>
                        <div class="col-sm-8">
                          <?=$orderData->ip;?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">User Name : </div>
                        <div class="col-sm-8">
                          <?=$orderData->firstName;?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">User Number : </div>
                        <div class="col-sm-8">
                          <?=$orderData->mobile;?>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <h4 class="mt-4">Reciever Details</h4>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Reciever Name : </div>
                        <div class="col-sm-8">
                          <?=ucfirst($orderData->addressData->name);?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Reciever Number : </div>
                        <div class="col-sm-8">
                          <?=$orderData->addressData->mobile;?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Delivery Address : </div>
                        <div class="col-sm-8">

                          <?=$orderData->addressData->address.($orderData->addressData->address2?', '.$orderData->addressData->address2:'').', '.$orderData->addressData->city.', '.$orderData->addressData->state.', '.$orderData->addressData->pincode;?>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-md-12">
                      <h4 class="mt-4">Payment Details</h4>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Cart Total : </div>
                        <div class="col-sm-8">
                          <?=$orderData->cartTotal;?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Tax : </div>
                        <div class="col-sm-8">
                          <?=$orderData->tax;?>
                        </div>
                      </div>
                    </div>
                   <!--  <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Delivery Charge : </div>
                        <div class="col-sm-8">
                          <?=($orderData->deliveryCharge == 0)?'<span class="text text-success">Free</span>':$orderData->deliveryCharge;?>
                        </div>
                      </div>
                    </div>
                  </div> -->

                  <!-- <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Coupon Discount : </div>
                        <div class="col-sm-8">
                          <?=$orderData->couponDiscount.(($orderData->discountType)?' (<b>'.$orderData->couponCode.' - </b>'.(($orderData->discountType== 'flat')?'Flat Rs.'.$orderData->discount.' Off':'Flat '.$orderData->discount.'% Off').')':'');?>
                        </div>
                      </div>
                    </div> -->
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Paid Total : </div>
                        <div class="col-sm-8">
                          <?=$orderData->paidAmt;?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Payment Method : </div>
                        <div class="col-sm-8">
                          <?=$orderData->paymentMethod;?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Payment Status: </div>
                        <div class="col-sm-8">
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
                      ?>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Payment message: </div>
                        <div class="col-sm-8">
                          <?=$orderData->paymentMessage;?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Status : </div>
                        <div class="col-sm-8">
                          <?php

                          if ($orderData->status == 0 && $orderData->paymentStatus=='COD Payment Pending') {
                            $orderData->status = "Order received";
                            $orderData->class = "badge badge-dark";
                          }elseif ($orderData->status == 0 && $orderData->paymentStatus == "Payment Pending") {
                            $orderData->status = "Payment Pending";
                            $orderData->class = "badge badge-light text-danger";
                          }elseif ($orderData->status == 0 && $orderData->paymentStatus == "Payment Success") {
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
                          echo '<span class="'.$orderData->class.'">'.$orderData->status.'</span>';
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                   <!--  <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Payer Mail : </div>
                        <div class="col-sm-8">
                          <?=$orderData->payerMail;?>
                        </div>
                      </div>
                    </div> -->
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Txn ID : </div>
                        <div class="col-sm-8">
                          <?=$orderData->paymentTrxId;?>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title mb-4">Manage Products</h5>
                  <div class="fluid-container">
                    <div class="order-section1">

                        <?php  if (isset($detailData) && !empty($detailData)) {
                          foreach ($detailData as $detail) {
                            // image details
                            $imagesData = '';
                            if (!empty($detail->img)) {
                              $detail->img = explode(',', $detail->img);
                              foreach ( $detail->img as $img){
                                $image = UPLOADPATH.'/prescription_images/'.$img;
                                if(urlExist($image))
                                  $imagesData .= '<li class="image-download"> <img src="'.$image.'" alt="Uploaded Image" /> <div class="overlay"></div> <div class="button"><a href="'.$image.'" download="orderimage"> <i class="fa fa-download"></i> </a></div> </li>';
                              }
                            }

                            $categoryIds = array();
                            if(isset($detail->categoryIds) && !empty($detail->categoryIds))
                              $categoryIds = explode(',', $detail->categoryIds);


                            // $vendorHtml = '';
                            $actionBtns = '';

                            // if (!empty($detail->vendorName)) {
                            //   $vendorHtml = '<div class="vendor-detail-section"> <h4> <span> Vendor : </span> <b>'.$detail->vendorName.'</b> </h4> <h4> <span>Vendor Amount : </span> <b>Rs. '.$detail->vendorAmt.'</b> </h4><h4> <span>Payment Status : </span> <b>'.(($detail->status == 6)?'<span class="badge badge-danger">Cancelled</span>':(($detail->isPaidToVendor)?'<span class="badge badge-success">Success</span>':'<span class="badge badge-warning">Pending</span>')).'</b> </h4> </div>';
                            // }
                            
                            $rolePermission = $this->common_lib->checkrolePermission(['can_manage_all_order','can_edit_order'],0);

                            if($rolePermission['valid']){
                              // if (!empty($detail->vendorName)) {

                                if ($detail->status < 5)
                                  $actionBtns .= '<a href="javascript:" class="btn btn-success btn-rounded btn-fw pull-right changeOrderStatusBtn" data-detail-id="'.$detail->detailId.'" data-order-id="'.$detail->orderId.'">Change Status</a>';
                                //<a href="javascript:" class="btn btn-primary btn-rounded btn-fw pull-right assignVendorBtn" data-detail-id="'.$detail->detailId.'" data-price="'.$detail->price.'" data-subtotal="'.$detail->subtotal.'" data-order-id="'.$detail->orderId.'">Change Vendor</a>

                                // else if($detail->status == 5 && $detail->isPaidToVendor == 0)
                                //   $actionBtns .= '<a href="javascript:" class="btn btn-info btn-rounded btn-fw pull-right changeVendorPaymentStatusBtn" data-detail-id="'.$detail->detailId.'" data-order-id="'.$detail->orderId.'">Change Vendor Payment Status</a>';
                              // }else{
                              //   if ($detail->status < 5)
                              //     $actionBtns .= '<a href="javascript:" class="btn btn-primary btn-rounded btn-fw pull-right assignVendorBtn" data-detail-id="'.$detail->detailId.'" data-price="'.$detail->price.'" data-subtotal="'.$detail->subtotal.'" data-order-id="'.$detail->orderId.'">Assign Vendor</a>';
                              // }

                              if ($detail->status < 5)
                                $actionBtns .= '<a href="javascript:" class="btn btn-danger btn-rounded btn-fw pull-right cancelOrderBtn" data-detail-id="'.$detail->detailId.'" data-order-id="'.$detail->orderId.'">Cancel</a>';

                              //<a href="'.DASHURL.'/admin/order/edit/'.$detail->detailId.'" class="btn btn-dark btn-rounded btn-fw pull-right">Edit Details</a>
                            }
                          

                          if ($detail->status == 0) {
                            $detail->status = "Order received";
                            $detail->class = "badge badge-dark";
                          }elseif ($detail->status == 1) {
                            $detail->status = "Vendor confirmed";
                            $detail->class = "badge badge-info";
                          }elseif ($detail->status == 2) {
                            $detail->status = "Processing";
                            $detail->class = "badge badge-primary";
                          }elseif ($detail->status == 3) {
                            $detail->status = "Ready to ship";
                            $detail->class = "badge badge-warning";
                          }elseif ($detail->status == 4) {
                            $detail->status = "Shipped";
                            $detail->class = "badge badge-light";
                          }elseif ($detail->status == 5) {
                            $detail->status = "Delivered";
                            $detail->class = "badge badge-success";
                          }elseif ($detail->status == 6) {
                            $detail->status = "Cancelled";
                            $detail->class = "badge badge-danger";
                          }else {
                            $detail->status = "Unknown";
                            $detail->class = "badge badge-secondary";
                          }
                          // $deliveryTimeDetail = ($detail->isCourierDelivery)?'Courier Delivery - Rs <span>'.$detail->deliveryAmount.'</span> On <span>'.date('d-m-Y', strtotime($detail->requestedDeliveryDate)).'</span> ':$detail->deliveryType.' - Rs <span>'.$detail->deliveryAmount.'</span> On <span>'.date('d-m-Y', strtotime($detail->requestedDeliveryDate)).'</span> between <span>'.$detail->startTime.' hrs - '.$detail->endTime.' hrs</span>';
                            
                            $lensHtml = $detailHtml = '';
                            if(in_array(1, $categoryIds)){
                              if (!empty($detail->lensName)) {
                                $lensHtml = '<tr> <th>Lens</th> <td colspan="3">'.$detail->lensName.' (₹'.$detail->lensPrice.')</td></tr>';
                              }

                              if($detail->prescription_type =='single-vision' || $detail->prescription_type =='bifocal-progressive')
                                  $detailHtml = '<tr class=""> <th>Type</th> <td colspan="3">'.(($detail->prescription_type =='single-vision')?'Single Vision':'Bifocal Progressive').'</td></tr>';
                                if(($detail->rsph+$detail->rcyl+$detail->raxis+$detail->radd+$detail->lsph+$detail->lcyl+$detail->laxis+$detail->ladd) != 0)
                                  $detailHtml .='<tr class="bg-prescription"> <th></th> <th>SPH</th> <th>CYL</th> <th>Axis</th> '.(($detail->prescription_type =='single-vision')?'':'<th>ADD</th>').' </tr> <tr class="bg-prescription"> <th>Right(OD)</th> <td>'.$detail->rsph.'</td> <td>'.$detail->rcyl.'</td> <td>'.$detail->raxis.'</td> '.(($detail->prescription_type =='single-vision')?'':'<td>'.$detail->radd.'</td>').' </tr> <tr class="bg-prescription"> <th>Left(OS)</th> <td>'.$detail->lsph.'</td> <td>'.$detail->lcyl.'</td> <td>'.$detail->laxis.'</td> '.(($detail->prescription_type =='single-vision')?'':'<td>'.$detail->ladd.'</td>').' </tr>'.(($detail->pd)?'<tr> <th>PD</th> <td colspan="3">'.$detail->pd.'</td></tr>':'');
                              else if($detail->prescription_type =='zero-power')
                                  $detailHtml = '<tr> <th>Type</th> <td colspan="3">Zero Power</td></tr>';
                              else if($detail->prescription_type =='frame-only' && (in_array(1, $categoryIds) || in_array(4, $categoryIds)))
                                  $detailHtml = '<tr> <th>Type</th> <td colspan="3">Frame only</td></tr>';
                                $detailHtml = $lensHtml.$detailHtml;
                            }elseif(in_array(4, $categoryIds)){
                              $detailHtml = '<tr> <th>Number</th> <td colspan="3">+'.number_format((float)$detail->rgn, 2, '.', '').'</td></tr>';
                            }

                            echo '<div class="order-inner-section1"> <div class="row"> <div class="col-md-3"> <div class="img"> <img src="'.(( $detail->productImg != '' ) ? getResizedImg($detail->productImg,'200_200') : NOIMAGE).'" alt="Product Image"> </div> </div> <div class="col-md-6"> <div class="ordered-discription"> <div class="heading12"> <h3><a href="'.BASEURL.'/'.$detail->slug.'" target="_blank">'.$detail->productName.(!empty($detail->variableTitle)?' ('.$detail->variableTitle.')':'').'</a></h3> <span class="item-status '.$detail->class.'">'.$detail->status.'</span> </div> <table class="table"> <tr> <th>Final Price</th> <td>Rs. '.$detail->subtotal.'</td> </tr> <tr> <th>Quantity</th> <td>'.$detail->qty.'</td></tr>'.$detailHtml.(($detail->message)?'<tr> <th>User Message</th> <td colspan="3">'.$detail->message.'</td> </tr>':'').'</table> </div> </div> <div class="col-md-3"> <div class="multiple-img">'.(($imagesData)?'<h4>Prescription Images</h4><ul>'.$imagesData.'</ul>':'').' </ul> </div> </div><div class="col-md-12 pt-3"> <div class="details">  <div class="soft_skills"><div class="template-demo">'.$actionBtns.'</div></div> </div> </div></div> </div>';
                          }
                        }?>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php if($rolePermission['valid']){ ?>
          <!-- assign Vendor Model-->
          <div id="assignVendor" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <form onsubmit="changeOrderStatus(this, event)">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="email">Vendor:</label>
                      <select class="livesearch form-control" name="vendorId" style="width:400px;" required>
                        <?php if (isset($vendorData) && !empty($vendorData)) {
                          foreach ($vendorData as $vendor) {
                            echo '<option value="'.$vendor->vendorId.'" data-subtext="'.$vendor->city.'">'.$vendor->vendorName.'</option>';
                          }
                        }?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="email">Vendor Amount:</label>
                      <input type="number" class="form-control" name="vendorAmt" id="vendorAmt" value="0" min="0" max="1000" required>
                    </div>
                    <h6 class="msg"></h6>
                    <input type="hidden" name="action" value="changeOrderStatus">
                    <input type="hidden" name="detailId" id="changeOrderStatusId" value="0">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Assign</button>
                  </div>
                </form>
              </div>

            </div>
          </div>
          <!-- change order status Model-->
          <div id="cancelOrderModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <form onsubmit="changeOrderStatus(this, event)">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                      <p>Are you sure want to cancel this item ?</p>
                      <h6 class="msg"></h6>
                      <input type="hidden" name="action" value="changeOrderStatus">
                      <input type="hidden" name="detailId" id="changeOrderStatusId" value="0">
                      <input type="hidden" name="status" value="6">
                  </div>
                  <div class="modal-footer">
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="form-check form-check-flat">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="orderId" value="0"> Cancel Order
                            <i class="input-helper"></i>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <button type="button" class="btn btn-default pull-right ml-1" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary pull-right actionbtn">Yes</button>
                    </div>
                  </div>
                </form>
              </div>

            </div>
          </div>

          <div id="changeOrderStatusModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <!-- Modal content-->
              <div class="modal-content">
                <form onsubmit="changeOrderStatus(this, event)">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="email">Status:</label>
                      <select name="status" class="form-control">
                        <option value="2">Processing</option>
                        <option value="3">Ready to ship</option>
                        <option value="4">Shipped</option>
                        <option value="5">Delivered</option>
                        <option value="6">Cancel</option>
                      </select>
                    </div>
                      <h6 class="msg"></h6>
                      <input type="hidden" name="action" value="changeOrderStatus">
                      <input type="hidden" name="detailId" id="changeOrderStatusId" value="0">
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary actionbtn">Update</button>
                  </div>
                </form>
              </div>

            </div>
          </div>

          <div id="changeVendorPaymentStatusModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <form onsubmit="changeOrderStatus(this, event)">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                      <p>Are you sure want to change payment status as completed ?</p>
                      <h6 class="msg"></h6>
                      <input type="hidden" name="action" value="changeOrderStatus">
                      <input type="hidden" name="detailId" id="changeVendorPaymentStatusId" value="0">
                      <input type="hidden" name="paymentStatus" value="1">
                  </div>
                  <div class="modal-footer">
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="form-check form-check-flat">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="orderId" value="0"> Update same to whole order
                            <i class="input-helper"></i>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <button type="button" class="btn btn-default pull-right ml-1" data-dismiss="modal">No</button>
                      <button type="submit" class="btn btn-primary pull-right actionbtn">Yes</button>
                    </div>
                  </div>
                </form>
              </div>

            </div>
          </div>
        <?php } ?>

<?php $this->load->viewD('inc/footer.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>
<script type="text/javascript">
  $(".livesearch").chosen({
    disable_search_threshold: 5,
    no_results_text: "Oops, Vendor not found!",
    width: "100%"
  });
</script>
<script type="text/javascript">
  $(document).on('click','.assignVendorBtn', function(){
    $('#assignVendor').modal('show');
    $('#assignVendor').find("input[name=detailId]").val($(this).data('detail-id'));
    $('#assignVendor').find("#vendorAmt").val(0).attr('max',$(this).data('subtotal'));
  });
  $(document).on('click','.cancelOrderBtn', function(){    
    $('#cancelOrderModal').modal('show');
    $('#cancelOrderModal').find("input[name=detailId]").val($(this).data('detail-id'));
    $('#cancelOrderModal').find("input[name=orderId]").val($(this).data('order-id'));
  });
  $(document).on('click','.changeOrderStatusBtn', function(){    
    $('#changeOrderStatusModal').modal('show');
    $('#changeOrderStatusModal').find("input[name=detailId]").val($(this).data('detail-id'));
  });
  $(document).on('click','.changeVendorPaymentStatusBtn', function(){    
    $('#changeVendorPaymentStatusModal').modal('show');
    $('#changeVendorPaymentStatusModal').find("input[name=detailId]").val($(this).data('detail-id'));
    $('#changeVendorPaymentStatusModal').find("input[name=orderId]").val($(this).data('order-id'));
  });


$('#vendorAmt').restrict();
</script>


