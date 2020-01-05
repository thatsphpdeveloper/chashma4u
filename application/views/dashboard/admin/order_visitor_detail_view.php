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

      .vendor-detail-section h4:nth-child(2){
        border-left: 1px solid #e5e5e5;
        padding-left: 15px;
        border-right: 1px solid #e5e5e5;
        padding-right: 15px;
        margin: 0 10px
      }
      .vendor-detail-section h4{
        /*color: #308ee0;*/
        font-size: 15px;
        color: #7a7a7a;
        height: 12px;
      }
      .vendor-detail-section h4:last-child{
        border-right: none;
      }
      .vendor-detail-section {
        width: 100%;
        margin: 0;
        text-align: left;
        display: flex;
        font-family: 'Roboto', sans-serif;
        /*justify-content: space-between;*/
        border: 1px solid #c1b9b9;
        padding: 10px 20px;
      }
      .vendor-detail-section span img{
        margin-right: 0.3em
      }
      .vendor-detail-section h4 b{
        margin-left: 25px
      }



      .addons-detail-section {background: #9fc7ce;padding: 9px 4px 3px 4px;}

      .addons-detail-section h3 {
          padding-left: 4px;
      }

      .addons-detail-section span.profile-text {
          margin-left: 7px;
      }
    </style>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class ="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <div class="card-title text-warning mb-5">Visitor Details
                    <div class="template-demo pull-right">
                      <a href="<?=DASHURL.'/'.$this->sessDashboard?>/order" class="btn btn-info">Order List</a>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <h4>Sender Details</h4>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Last Update : </div>
                        <div class="col-sm-8">
                          <?=$visitorData->updatedOn;?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">IP Address : </div>
                        <div class="col-sm-8">
                          <?=$visitorData->ip;?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Sender Name : </div>
                        <div class="col-sm-8">
                          <?=$visitorData->senderName;?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Sender Number : </div>
                        <div class="col-sm-8">
                          <?=$visitorData->senderNo;?>
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
                        <div class="col-sm-4 font-weight-bold">Address Type : </div>
                        <div class="col-sm-8">
                          <?=ucfirst($visitorData->addressName);?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Reciever Name : </div>
                        <div class="col-sm-8">
                          <?=ucfirst($visitorData->name);?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Reciever Number : </div>
                        <div class="col-sm-8">
                          <?=$visitorData->mobile;?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Alternate Number : </div>
                        <div class="col-sm-8">
                          <?=$visitorData->alternateMobile;?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Delivery Address : </div>
                        <div class="col-sm-8">

                          <?=$visitorData->address.($visitorData->address2?', '.$visitorData->address2:'').', '.$visitorData->city.', '.$visitorData->state.', '.$visitorData->pincode;?>
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
                          <?=$visitorData->cartTotal;?>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="row">
                        <div class="col-sm-4 font-weight-bold">Delivery Charge : </div>
                        <div class="col-sm-8">
                          <?=($visitorData->deliveryCharge == 0)?'<span class="text text-success">Free</span>':$visitorData->deliveryCharge;?>
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
                            $attributes = '';
                            $attr = array();
                            if(!empty($detail->attributeData)){
                              foreach ($detail->attributeData as $attribute)
                                $attr['<th>'.$attribute->attributeHeading.'</th>'] = ((empty($attr['<th>'.$attribute->attributeHeading.'</th>']))?$attribute->attributeName:$attr['<th>'.$attribute->attributeHeading.'</th>'].', '.$attribute->attributeName).' ( Rs. '.$attribute->price.', Qty - '.$attribute->qty.' )';
                              

                              $attributes = '<tr> <th colspan="2"> <table class="attr"> <tr> <th colspan="2"><h2>Attributes</h2></th> </tr>';
                              foreach ( $attr as $key => $value)
                                $attributes .= '<tr>'.$key.'<td>'.$value.'</td></tr>';

                              $attributes .= '</table> </th> </tr>';
                              
                            }


                            // image details
                            $imagesData = '';
                            if (!empty($detail->img)) {
                              $detail->img = explode(',', $detail->img);
                              foreach ( $detail->img as $img){
                                $image = UPLOADPATH.'/order_images/'.$img;
                                if(urlExist($image))
                                  $imagesData .= '<li class="image-download"> <img src="'.$image.'" alt="Uploaded Image" /> <div class="overlay"></div> <div class="button"><a href="'.$image.'" download="orderimage"> <i class="fa fa-download"></i> </a></div> </li>';
                              }
                            }


                            // addedons details
                            $addonsHtml = '';
                            if(!empty($detail->addonsData)){
                              foreach ($detail->addonsData as $addons){
                                $addonsHtml .= '<p class="m-1 p-1 border"> <img class="img-xs rounded-circle" src="'.UPLOADPATH.'/addons_images/'.$addons->img.'" alt="Addons"> <span class="profile-text">'.$addons->addonsName.'</span>  ( Rs. '.$addons->price.', Qty - '.$addons->qty.' ) </p>';    
                              }

                              $addonsHtml = '<div class="col-md-12"><div class="addons-detail-section"><h3>Addons</h3>'.$addonsHtml.'</div></div>';
                            }

                            $vendorHtml = '';
                            $actionBtns = '';

                            if (!empty($detail->vendorName)) {
                              $vendorHtml = '<div class="vendor-detail-section"> <h4> <span> Vendor : </span> <b>'.$detail->vendorName.'</b> </h4> <h4> <span>Vendor Amount : </span> <b>Rs. '.$detail->vendorAmt.'</b> </h4><h4> <span>Payment Status : </span> <b>'.(($detail->status == 6)?'<span class="badge badge-danger">Cancelled</span>':(($detail->isPaidToVendor)?'<span class="badge badge-success">Success</span>':'<span class="badge badge-warning">Pending</span>')).'</b> </h4> </div>';
                            }
                            
                            $rolePermission = $this->common_lib->checkrolePermission(['can_manage_all_order','can_edit_order'],0);

                          $deliveryTimeDetail = ($detail->isCourierDelivery)?'Courier Delivery - Rs <span>'.$detail->deliveryAmount.'</span> On <span>'.date('d-m-Y', strtotime($detail->requestedDeliveryDate)).'</span> ':$detail->deliveryType.' - Rs <span>'.$detail->deliveryAmount.'</span> On <span>'.date('d-m-Y', strtotime($detail->requestedDeliveryDate)).'</span> between <span>'.$detail->startTime.' hrs - '.$detail->endTime.' hrs</span>';
                            
                            echo '<div class="order-inner-section1"> <div class="row"> <div class="col-md-3"> <div class="img"> <img src="'.(( $detail->productImg != '' ) ? getResizedImg($detail->productImg,'200_200') : NOIMAGE).'" alt="Product Image"> </div> </div> <div class="col-md-6"> <div class="ordered-discription"> <div class="heading12"> <h3><a href="'.BASEURL.'/'.$detail->slug.'" target="_blank">'.$detail->productName.(!empty($detail->variableTitle)?' ('.$detail->variableTitle.')':'').'</a></h3> </div> <table class="table"> <tr> <th>Price</th> <td>Rs. '.$detail->price.'</td> </tr> <tr> <th>Quantity</th> <td>'.$detail->qty.'</td></tr>'.$attributes.''.(($detail->message)?'<tr> <th>User Message</th> <td>'.$detail->message.'</td> </tr>':'').'<tr> <th>Delivery Slot</th> <td><p>'.$deliveryTimeDetail.'</p></td> </tr> </table> </div> </div> <div class="col-md-3"> <div class="multiple-img">'.(($imagesData)?'<h4>Order Images</h4><ul>'.$imagesData.'</ul>':'').' </ul> </div> </div>'.$addonsHtml.'<div class="col-md-12 pt-3"> <div class="details">  <div class="soft_skills">'.$vendorHtml.'<div class="template-demo">'.$actionBtns.'</div></div> </div> </div></div> </div>';
                          }
                        }?>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
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


