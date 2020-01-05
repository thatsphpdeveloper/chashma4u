<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->
<?php $this->load->viewD('inc/sidebar.php'); ?>
      <!-- partial -->
      <style type="text/css">
        .previewimg img {
          border: 1px solid black;
          padding: 1px;
          margin: 3px;
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
                      <h4 class="card-title">Edit Order <a href="<?=DASHURL.'/'.$this->sessDashboard.'/order/detail/'.$detailData->orderId?>" class="btn btn-success pull-right">Back to order</a></h4>

                      <form class="forms-sample formarea <?=(isset($orderData->userId) && ($orderData->userId > 0))?'hide':''?>" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return updateOrderDetails(this, event);">
                        <p class="card-description">Guest User Info</p>

                        
                        <div class="form-group">
                          <label for="guestEmail">Email ID</label>
                          <input type="email" class="form-control" name="guestEmail" id="guestEmail" value="<?=(isset($orderData->guestEmail) && !empty($orderData->guestEmail))?$orderData->guestEmail:'';?>" placeholder="Ex: abc@mail.com" required>
                        </div>
                        <div class="form-group">
                          <label for="senderName">Sender Name</label>
                          <input type="text" class="form-control" name="senderName" id="senderName" value="<?=(isset($orderData->senderName) && !empty($orderData->senderName))?$orderData->senderName:'';?>" placeholder="Ex: Jhon" required>
                        </div>
                        <div class="form-group">
                          <label for="senderNo">Sender Number</label>
                          <input type="text" class="form-control" name="senderNo" id="senderNo" value="<?=(isset($orderData->senderNo) && !empty($orderData->senderNo))?$orderData->senderNo:'';?>" placeholder="Ex: 09999999999" onkeypress="return OnlyInteger()" required>
                        </div>

                        <input type="hidden" name="action" value="updateOrderDetails">
                        <input type="hidden" name="hiddenval" value="<?=$orderData->orderId;?>">
                        <button type="submit" class="btn btn-success mr-2 actionbtn">Submit</button>
                        <a href="<?=DASHURL.'/'.$this->sessDashboard.'/order/detail/'.$detailData->orderId?>" class="btn btn-light">Cancel</a>
                        <p class="msg"></p>
                      </form>


                      <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return updateOrderDetails(this, event);">
                        <p class="card-description">Address Info</p>

                        <div class="form-group">
                          <label for="addressId">Address:</label>
                          <select name="addressId" id="addressId" class="form-control" required>
                            <option value="">Select Address</option>
                            <?php
                            if (isset($addressData) && !empty($addressData)) {
                              foreach ($addressData as $address) {
                                echo '<option value="'.$address->addressId.'" '.((isset($orderData->addressId) && $address->addressId == $orderData->addressId)?'selected':'').' data-addressName="'.$address->addressName.'" data-name="'.$address->name.'" data-mobile="'.$address->mobile.'" data-address="'.$address->address.'" data-address2="'.$address->address2.'" data-city="'.$address->city.'" data-state="'.$address->state.'" data-country="'.$address->country.'" data-pincode="'.$address->pincode.'" data-lat="'.$address->lat.'" data-lang="'.$address->lang.'" >'.$address->addressName.' - '.$address->name.' - '.$address->mobile.'</option>';
                              }
                            }?>
                          </select>
                        </div>

                        <input type="hidden" name="action" value="updateOrderDetails">
                        <input type="hidden" name="hiddenval" value="<?=$detailData->orderId;?>">
                        <button type="button" class="btn btn-info mr-2 btn-edit-address" onclick="showAddressModel()">Edit Addrees</button>
                        <button type="submit" class="btn btn-success mr-2 actionbtn">Submit</button>
                        <a href="<?=DASHURL.'/'.$this->sessDashboard.'/order/detail/'.$detailData->orderId?>" class="btn btn-light">Cancel</a>
                        <p class="msg"></p>
                      </form>




                      <form class="forms-sample formarea mt-4 <?=($detailData->isMessageReq)?'':'hide'?>" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return updateOrderDetails(this, event);">
                        <p class="card-description">Message</p>



                        <div class="form-group">
                          <label for="message">Message</label>
                          <input type="text" class="form-control" name="message" placeholder="<?=$detailData->messagePlaceholder?>" id="msg_cake"  maxlength="30" value="<?=isset($detailData->message)?$detailData->message:'';?>" <?=($detailData->isMessageReq)?'required':''?>>
                        </div>


                        <input type="hidden" name="action" value="updateOrderDetails">
                        <input type="hidden" name="hiddenval" value="<?=$this->uri->segment(5);?>">
                        <button type="submit" class="btn btn-success mr-2 actionbtn">Submit</button>
                        <a href="<?=DASHURL.'/'.$this->sessDashboard.'/order/detail/'.$detailData->orderId?>" class="btn btn-light">Cancel</a>
                        <p class="msg"></p>
                      </form>



                      
                      <form class="forms-sample formarea mt-4 <?=($detailData->isPhotoReq)?'':'hide'?>" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return updateOrderDetails(this, event);">
                        <p class="card-description">Image</p>

                        
                        <div class="form-group">
                          <label for="uploadIcons">Upload Image</label>
                          <input type="file" name="uploadIcons" id="uploadIcons" value="" onchange="fileuploadpreview(this)" <?=(isset($detailData->img) && !empty($detailData->img))?'':'required';?>>
                          <div class="previewimg"><?=(isset($detailData->img) && !empty($detailData->img))?'<img src="'.UPLOADPATH.'/order_images/'.$detailData->img.'" width="70px" height="50px">':'';?></div> 
                        </div>


                        <input type="hidden" name="action" value="updateOrderDetails">
                        <input type="hidden" name="hiddenval" value="<?=$this->uri->segment(5);?>">
                        <button type="submit" class="btn btn-success mr-2 actionbtn">Submit</button>
                        <a href="<?=DASHURL.'/'.$this->sessDashboard.'/order/detail/'.$detailData->orderId?>" class="btn btn-light">Cancel</a>
                        <p class="msg"></p>
                      </form>



                      
                      <form class="forms-sample formarea mt-4" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return updateOrderDetails(this, event);">
                        <p class="card-description">  <?=($detailData->isCourierDelivery)?'Courier Delivery Date':'Delivery time'?></p>
                        <div class="form-group">
                          <label for="requestedDeliveryDate">Delivery Date</label>
                          <input type="date" class="form-control" name="requestedDeliveryDate" id="requestedDeliveryDate" value="<?=(isset($detailData->requestedDeliveryDate) && !empty($detailData->requestedDeliveryDate))?$detailData->requestedDeliveryDate:'';?>" min="<?=date('Y-m-d')?>" onchange="getTimeSlotOfDate()" required>
                        </div>

                        <div class="form-group  <?=($detailData->isCourierDelivery)?'hide':''?>">
                          <label for="timeslotId">Time slot:</label>
                          <select name="timeslotId" id="timeslotId" class="form-control"  <?=($detailData->isCourierDelivery)?'':'required'?>>
                            <option value="">Select time slot</option>
                          </select>
                        </div>

                        <input type="hidden" name="action" value="updateOrderDetails">
                        <input type="hidden" name="hiddenval" value="<?=$this->uri->segment(5);?>">
                        <button type="submit" class="btn btn-success mr-2 actionbtn">Submit</button>
                        <a href="<?=DASHURL.'/'.$this->sessDashboard.'/order/detail/'.$detailData->orderId?>" class="btn btn-light">Cancel</a>
                        <p class="msg"></p>
                      </form>



                      
                      <form class="forms-sample formarea mt-4" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return updateOrderDetails(this, event);">
                        <p class="card-description">Payment Details</p>
                        <div class="form-group">
                          <label for="paymentMethod">Payment Method</label>
                          <input type="text" class="form-control" name="paymentMethod" id="paymentMethod" value="<?=(isset($paymentData->paymentMethod) && !empty($paymentData->paymentMethod))?$paymentData->paymentMethod:'';?>" placeholder="Ex: paypal, cod" required>
                        </div>
                        <div class="form-group">
                          <label for="paymentTrxId">Transaction ID</label>
                          <input type="text" class="form-control" name="paymentTrxId" id="paymentTrxId" value="<?=(isset($paymentData->paymentTrxId) && !empty($paymentData->paymentTrxId))?$paymentData->paymentTrxId:'';?>" placeholder="Ex: tx_125486566546545">
                        </div>
                        <div class="form-group">
                          <label for="payerMail">Payer Mail</label>
                          <input type="text" class="form-control" name="payerMail" id="payerMail" value="<?=(isset($paymentData->payerMail) && !empty($paymentData->payerMail))?$paymentData->payerMail:'';?>" placeholder="Paid by mail id">
                        </div>
                        <div class="form-group">
                          <label for="paidAmt">Paid Amt</label>
                          <input type="text" class="form-control" name="paidAmt" id="paidAmt" value="<?=(isset($paymentData->paidAmt) && !empty($paymentData->paidAmt))?$paymentData->paidAmt:'';?>" placeholder="Ex: 9999" onkeydown="OnlyNumericKey(event)" required>
                        </div>
                        <div class="form-group">
                          <label for="paymentMessage">Payment Message</label>
                          <input type="text" class="form-control" name="paymentMessage" id="paymentMessage" value="<?=(isset($paymentData->paymentMessage) && !empty($paymentData->paymentMessage))?$paymentData->paymentMessage:'';?>" placeholder="Ex: success">
                        </div>

                        <div class="form-group">
                          <label for="paymentStatus">Payment Status:</label>
                          <select name="paymentStatus" id="paymentStatus" class="form-control" required>
                            <option value="">Select Payment Status</option>
                            <option value="0" <?=(isset($paymentData->paymentStatus) && $paymentData->paymentStatus==0)?'selected':'';?>>Pending</option>
                            <option value="1" <?=(isset($paymentData->paymentStatus) && $paymentData->paymentStatus==1)?'selected':'';?>>Success</option>
                            <option value="2" <?=(isset($paymentData->paymentStatus) && $paymentData->paymentStatus==2)?'selected':'';?>>Failed</option>
                            <option value="3" <?=(isset($paymentData->paymentStatus) && $paymentData->paymentStatus==3)?'selected':'';?>>Cancelled</option>
                          </select>
                        </div>

                        <input type="hidden" name="action" value="updateOrderDetails">
                        <input type="hidden" name="hiddenval" value="<?=isset($paymentData->transactionId)?$paymentData->transactionId:0;?>">
                        <button type="submit" class="btn btn-success mr-2 actionbtn">Submit</button>
                        <a href="<?=DASHURL.'/'.$this->sessDashboard.'/order/detail/'.$paymentData->orderId?>" class="btn btn-light">Cancel</a>
                        <p class="msg"></p>
                      </form>

                    </div>
                  </div>
                </div>                  
              </div>
            </div>
          </div> 
        </div>
      </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
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
                            <button type="button" class="btn btn-primary validate-form">Update</button>
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

<?php $this->load->viewD('inc/footer.php'); ?>
<script type="text/javascript">
  $(document).ready(function(){
    getTimeSlotOfDate();
    toggoleEditAdrress();
  });

  $(document).on('change', '#addressId', function(){
    toggoleEditAdrress();
  });
  function toggoleEditAdrress(){
    if($('#addressId').val())
        $('.btn-edit-address').removeClass('hide');
      else
        $('.btn-edit-address').addClass('hide');
  }

  function getTimeSlotOfDate(){
    if ($('#requestedDeliveryDate').val()) {
      currentAjax = 1 ;
      $.ajax({
        url: COMMONAJAX,
        data: {"action" : "getTimeSlotOfDate", "detailId" : "<?=$detailData->detailId?>", "requestedDeliveryDate" : $('#requestedDeliveryDate').val()},
        type: "POST",             
        success:function(response){
          currentAjax = 0 ;
          $('#timeslotId').html(response.deliverySlotOptions);

        },
        error:function(response){
          currentAjax = 0;
          $('#timeslotId').html('<option value=""> Select time slot</option>');
        }
      });
    }
  }
</script>

<script type="text/javascript">
  function showAddressModel(){
    var obj = $('#addressId').find(':selected');
    if($('#addressId').val()){
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
      $('#chk-addressId').val($('#addressId').val());
      $('#address-model').modal('show');
    }


  }
</script>

