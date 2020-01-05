<?php $this->load->viewF("inc/header.php"); ?>
<div class="container">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<style type="text/css">
    .payment-success-section {
        margin: auto;
        text-align: center;
        padding: 24px 0 60px 0;
    }
    i.fa.fa-times.font-icon {
        color: white;
        font-size: 30px;
        background: red;
        padding: 12px 16px;
        border-radius: 47px;
        margin: 20px;
    }
    i.fa.fa-check.font-icon {
        color: white;
        font-size: 30px;
        background: green;
        padding: 12px 16px;
        border-radius: 47px;
        margin: 20px;
    }

    .payment-success-section h2 {
        font-size: 25px;
    }
</style>

     
    <div class="row">
        <div class="col-md-12">
            <?php 
            if($result=='order_success'){ ?>
                <div class="payment-success-section">
                    <div class="success-page">
                        <i class="fa fa-check font-icon"></i>
                        <h2>Payment Successful !</h2>
                        <p>We are delighted to inform you that we received your payments.</p>
                        <div class="btn-section">                              
                            <a href="<?=BASEURL?>/user/order" class="btn btn-primary">View Orders</a>
                            <a href="<?=BASEURL?>" class="btn btn-info">Continue Shopping</a>
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
                            <a href="<?=BASEURL?>/user/order" class="btn btn-primary">View Orders</a>
                            <a href="<?=BASEURL?>" class="btn btn-info">Continue Shopping</a>
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
                            <a href="<?=BASEURL?>/user/order" class="btn btn-primary">View Orders</a>
                            <a href="<?=BASEURL?>/cart" class="btn btn-info">Try To Pay Again</a>
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
                            <a href="<?=BASEURL?>" class="btn btn-info">Home Page</a>
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
                            <a href="<?=BASEURL?>/user/order" class="btn btn-primary">View Orders</a>
                            <a href="<?=BASEURL?>/cart" class="btn btn-info">Try To Pay Again</a>
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
                            <a href="<?=BASEURL?>/user/order" class="btn btn-primary">View Orders</a>
                            <a href="<?=BASEURL?>/cart" class="btn btn-info">Try To Pay Again</a>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>         
</div>

<?php $this->load->viewF("inc/footer.php"); ?>

<script type="text/javascript">
    var generatedId = "<?=(isset($generatedId) && !empty($generatedId) && empty($this->session->userdata(PREFIX.'userRoleId')))?$generatedId:''?>";
    $(document).on('click', '.btn btn-primary', function(){
        if(generatedId){
            event.preventDefault();
            submitTrackOrderForm(generatedId)
        }
    });
</script>
