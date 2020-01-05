<?php $this->load->viewF("inc/header.php"); ?>
<div class="container">

     
    <div class="row">
        <div class="col-md-12">

                <?php if(isset($paytmParams) && !empty($paytmParams)){ ?>
                    
                    <center><h1>Please do not refresh this page...</h1></center>
                    <form method='post' action='<?php echo $transactionURL; ?>' name='f1'>
                        <?php
                            foreach($paytmParams as $name => $value) {
                                echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
                            }
                        ?>
                    </form>
                    <script type="text/javascript">
                        document.f1.submit();
                    </script>
                <?php }elseif($result=='order_success'){ ?>
                <div class="payment-success-section">
                    <div class="success-page">
                        <i class="fa fa-check font-icon"></i>
                        <h2>Payment Successful !</h2>
                        <p>We are delighted to inform you that we received your payments.</p>
                        <div class="btn-section">                              
                            <a href="<?=BASEURL?>/user/order" class="btn-view-orders">View Orders</a>
                            <a href="<?=BASEURL?>" class="btn-continue-shopping">Continue Shopping</a>
                        </div>
                    </div>
                </div>
            <?php }elseif ($result=='payment_success') {?>
                <div class="payment-success-section">
                    <div class="success-page">
                        <i class="fa fa-times font-icon"></i>
                        <h2>Payment Success !</h2>
                        <p>Payment Success but we have some issue with your order , Our team will confirm your order soon.</p>
                        <div class="btn-section">
                            <a href="<?=BASEURL?>/user/order" class="btn-view-orders">View Orders</a>
                            <a href="<?=BASEURL?>" class="btn-continue-shopping">Continue Shopping</a>
                        </div>
                    </div>
                </div>

            <?php }elseif ($result=='payment_Failed') {?>
                <div class="payment-success-section">
                    <div class="success-page">
                        <i class="fa fa-times font-icon"></i>
                        <h2>Payment Failed !</h2>
                        <p>We are sorry to inform you that we did not receive your payments.</p>
                        <div class="btn-section">
                            <a href="<?=BASEURL?>/user/order" class="btn-view-orders">View Orders</a>
                            <a href="<?=BASEURL?>" class="btn-continue-shopping">Continue Shopping</a>
                        </div>
                    </div>
                </div>

            <?php }elseif ($result=='unauthorized') {?>
                <div class="payment-success-section">
                    <div class="success-page">
                        <i class="fa fa-times font-icon"></i>
                        <h2>Unauthrized Access!</h2>
                        <p>You are not authorized for this page. Go back to home.</p>
                        <div class="btn-section">
                            <a href="<?=BASEURL?>" class="btn-continue-shopping">Home Page</a>
                        </div>
                    </div>
                </div>                    
            <?php }elseif ($result=='payment_Cancel') {?>
                <div class="payment-success-section">
                    <div class="success-page">
                        <i class="fa fa-times font-icon"></i>
                        <h2>Payment Cancelled !</h2>
                        <p>You have just cancel your payment. If you have any query please contact us.</p>
                        <div class="btn-section">
                            <a href="<?=BASEURL?>/user/order" class="btn-view-orders">View Orders</a>
                            <a href="<?=BASEURL?>" class="btn-continue-shopping">Continue Shopping</a>
                        </div>
                    </div>
                </div>

            <?php }else{?>
                <div class="payment-success-section">
                    <div class="success-page">
                        <i class="fa fa-times font-icon"></i>
                        <h2>Payment Failed !</h2>
                        <p><?=$result?></p>
                        <div class="btn-section">
                            <a href="<?=BASEURL?>/user/order" class="btn-view-orders">View Orders</a>
                            <a href="<?=BASEURL?>" class="btn-continue-shopping">Continue Shopping</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>         
</div>

<?php $this->load->viewF("inc/footer.php"); ?>
