<?php $this->load->viewF('inc/header.php'); ?>

<style type="text/css">
    .cart-prescription-image{
        max-width: 90px;
        width: 100%;
        border: 2px solid #e4d7d7;
        padding: 2px;
    }
</style>
   <div class="page-content">
        <div class="holder mt-0">
            <div class="container">
                <ul class="breadcrumbs">
                    <li><a href="<?=BASEURL?>">Home</a></li>
                    <li><span>Cart</span></li>
                </ul>
            </div>
        </div>
        <div class="holder mt-0">
            <div class="container">
                <h1 class="text-center">Shopping Cart</h1>
                <div class="row">
                    <div class="col-md-8">
                        <div class="cart-table">
                            
                        <?php if (isset($cartData->detailData) && !empty($cartData->detailData)) {
                            $grandTotal = 0;
                            foreach ($cartData->detailData as $detail) {

                                $categoryIds = (isset($detail->categoryIds) && !empty($detail->categoryIds))?explode(',', $detail->categoryIds):array();

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

                                    $detailHtml = '<div class="sidebar-block collapsed open"> <div class="sidebar-block_title py-0"><span>Details </span> <div class="toggle-arrow" style="top: 0px;"></div> </div> <div class="sidebar-block_content"> <table class="table table-bordere table-hover"><tbody>'.$lensHtml.$detailHtml.(($detail->message)?'<tr> <th>Additional Information</th> <td colspan="3">'.$detail->message.'</td></tr>':'').(($detail->prescription_image)?'<tr> <th>Prescription image</th> <td colspan="3"><img src="'.UPLOADPATH.'/prescription_images/'.$detail->prescription_image.'" class="cart-prescription-image"></td></tr>':'').' </tbody> </table> </div> </div>';

                                }else if(in_array(4, $categoryIds)){

                                    $detailHtml = '<div class="sidebar-block collapsed open"> <div class="sidebar-block_title py-0"><span>Details </span> <div class="toggle-arrow" style="top: 0px;"></div> </div> <div class="sidebar-block_content"> <table class="table table-bordere table-hover"><tbody><tr> <th>Number</th> <td colspan="3">+'.number_format((float)$detail->rgn, 2, '.', '').'</td></tr></tbody> </table> </div> </div>';
                                }

                            echo '<div class="d-block cart-item my-cart-item-'.$detail->detailId.'"> <div class="cart-table-prd"> <div class="cart-table-prd-image"><a href="'.BASEURL.'/'.$detail->slug.'"><img src="'.getResizedImg($detail->img,'200_200').'" alt="'.$detail->productName.'"></a></div> <div class="cart-table-prd-name"> <h2><a href="'.BASEURL.'/'.$detail->slug.'">'.$detail->productName.(($detail->variableTitle)?' - '.$detail->variableTitle:'').'</a></h2> </div> <div class="cart-table-prd-qty"><span>qty:</span> <b>'.$detail->qty.'</b></div> <div class="cart-table-prd-price"><span>price:</span> <b>₹ '.round($detail->subtotal).'</b></div> <div class="cart-table-prd-action"><a href="'.BASEURL.'/'.$detail->slug.'?cdi='.$detail->detailId.'" class="icon-pencil"></a> <a href="javascript:" class="icon-cross" onclick="removeItem(this, event, \''.$detail->detailId.'\', \'product\')"></a></div> </div>'.$detailHtml.' </div>';
                            }
                        }
                            ?>
                           
                            <div class="cart-table-total">
                                <div class="row">
                                    <div class="col-sm hide"><a href="#" class="btn btn--alt"><i class="icon-cross"></i><span>clear shopping cart</span></a> <a href="#" class="btn btn--grey"><i class="icon-repeat"></i><span>update cart</span></a></div>
                                    <div class="col-sm-auto"><a href="<?=BASEURL?>" class="btn"><i class="icon-angle-left"></i><span>continue shopping</span></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <form onsubmit="createOrder(this, event)">
                            <div class="sidebar-block">
                                <div class="card-total text-uppercase">Subtotal <span class="card-total-price  my-cart-sub-total">₹ <?=(isset($cartData->cartTotal) && $cartData->cartTotal>0)?$cartData->cartTotal:'0.00'?></span></div>
                                <div class="card-total text-uppercase">GST <span class="card-total-price my-cart-tax">₹ <?=(isset($cartData->tax) && $cartData->tax>0)?$cartData->tax:'0'?></span></div>
                                <div class="card-total text-uppercase">Grand Total <span class="card-total-price my-cart-grand-total">₹ <?=(isset($cartData->grandTotal) && $cartData->grandTotal>0)?$cartData->grandTotal:'0.00'?></span></div>
                                <button class="btn btn--full btn--lg create-order-btn btn-checkout"  onclick="checkLoggedIn(this, event, 1)" >proceed to checkout</button>
                                <button type="button" class="btn btn--full btn--lg cod  create-order-btn btn-cod" onclick="checkLoggedIn(this, event , 2)" >Cash on delivery</button>
                                <input type="hidden" name="action" value="createOrder">
                                <input type="hidden" name="paymentMethod" id="paymentMethod" value="payu">
                                <div class="form-group  col-12 order-msg"></div>
                            </div>
                            <div class="sidebar-block open hide">
                                <div class="sidebar-block_title"><span>APPLY PROMOCODE</span>
                                    <div class="toggle-arrow"></div>
                                </div>
                                <div class="sidebar-block_content"><label class="text-uppercase">promo/student code:</label>
                                    <div class="form-flex">
                                        <div class="form-group"><input type="text" class="form-control"></div><button type="submit" class="btn btn--form btn--alt">Apply</button>
                                    </div>
                                </div>
                            </div>
                            <div class="sidebar-block open">
                                <div class="sidebar-block_title"><span>SHIPPING ESTIMATES</span>
                                    <div class="toggle-arrow"></div>
                                </div>
                               <div class="sidebar-block_content">
                                <label class="text-uppercase">Address:</label>
                                    <div class="form-group select-wrapper">

                                          <select class="form-control" name="addressId" id="addressId" required>
                                            <option value="">Select Address</option>

                                            <?php
                                            $addressId = isset($cartData->addressId)?$cartData->addressId:0;
                                            if (!empty($addressData)) {

                                                foreach ($addressData as $key => $address) {
                                                    if($cartData->addressId > 0)
                                                        $isSelected = ($address->addressId == $cartData->addressId)?'selected':'';
                                                    else
                                                        $isSelected = ($address->isDefault)?'selected':'';
                                                    echo '<option value="'.$address->addressId.'" '.$isSelected.'>'.$address->name.','.$address->mobile.','.$address->address.','.$address->pincode.'</option>';

                                                }

                                            }

                                            ?>

                                          </select>
                                    </div>

                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#address-model" onclick="checkLoggedIn(this, event , 0)"> New Address </button>

                               </div>
                            </div>
                            <div class="sidebar-block collapsed">
                                <div class="sidebar-block_title"><span>ORDER COMMENT</span>
                                    <div class="toggle-arrow"></div>
                                </div>
                                <div class="sidebar-block_content">
                                    <label class="text-uppercase">Write a comment here:</label>
                                    <textarea class="form-control textarea--height-200" name="message"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="processAI" id="processAI" value="<?=@$_GET['process']?>">
    <input type="hidden" name="processAI" id="processLoginAI" value="<?=@$_GET['login']?>">
    <?php $this->load->viewF('inc/user-address'); ?>
    <?php $this->load->viewF('inc/footer'); ?>
    <script type="text/javascript">
        $(document).ready(function (e) {
            if($('#processAI').val()){
                if($('#addressId').val()){
                    if($('#processAI').val() == 1)
                        $('.btn-checkout').trigger('click');
                    else
                        $('.btn-cod').trigger('click');

                }else{
                    $('#address-model').modal('show');
                    $('#formCheckbox1').prop('checked', true);
                }
            }else if($('#processLoginAI').val()){
                if(!$('#addressId').val()){
                    $('#address-model').modal('show');
                    $('#formCheckbox1').prop('checked', true);
                }
            }
        });
    </script>

	</body>
</html>