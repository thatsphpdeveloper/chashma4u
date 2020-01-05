<?php $this->load->viewF("inc/header.php"); ?>
<div class="container">

     
    <div class="row">
        <div class="col-md-12" style="min-height: 500px;">
            <center style="padding: 30px;"><h1>Please do not refresh this page...</h1></center>
            <form method="post" name="payuForm" enctype="multipart/form-data" action="<?= BASEURL?>/payu/check" class="hide">                                                                  
                <div class="form-group">                      
                  <input type="text"  name="payble_amount" id="payble_amount" class="form-control" placeholder="Enter Payble Amount" value="<?php echo (isset($orderData->grandTotal))?$orderData->grandTotal:0 ?>"/>
                </div>
                <div class="form-group">
                    <input type="text" name="product_info" id="product_info" class="form-control"  Placehosder="Product info" value="<?php echo (isset($orderData->products))?$orderData->products:'' ?>" />
                </div>
               <div class="form-group">                      
                  <input type="text"  name="customer_name" id="customer_name" class="form-control" placeholder="Full Name (Only alphabets)" value="<?php echo (isset($orderData->user))?$orderData->user:'' ?>"/>
                </div>
                <div class="form-group">                                   
                  <input type="number"  name="mobile_number" id="mobile_number" class="form-control" placeholder="Mobile Number(10 digits)" value="<?php echo (isset($orderData->mobile))?$orderData->mobile:'' ?>"/>
                </div>
                <div class="form-group">                                   
                  <input type="email"  name="customer_email" id="customer_email" class="form-control" placeholder="Email" value="<?php echo (isset($orderData->email))?$orderData->email:'' ?>" />
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="customer_address" id="customer_address" placeholder="Address">India</textarea>
                </div>
                <div class="form-group text-right">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button class="btn btn-default"  data-dismiss="modal" >Cancel</button>
                </div>
            </form>
        </div>
    </div>         
</div>

<?php $this->load->viewF("inc/footer.php"); ?>
<script type="text/javascript">
    $(document).ready(function(){
        document.forms.payuForm.submit();
    });
</script>