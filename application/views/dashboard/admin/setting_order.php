<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
   
<link rel="stylesheet" href="https://www.jqueryscript.net/demo/Easy-Responsive-Tab-Accordion-Control-Plugin-For-jQuery/easy-responsive-tabs.css">
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">

<style type="text/css">
.nopad {
  padding-left: 0px !important;
  padding-right: 5px !important;
  padding-bottom: 5px !important;
}
/*image gallery*/
.image-checkbox {
  cursor: pointer;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  border: 4px solid transparent;
  margin-bottom: 0;
  outline: 0;
  width: 100%;
}
.image-checkbox input[type="checkbox"] {
  display: none;
}

.image-checkbox-checked {
  border-color: #4783B0;
}
.image-checkbox .fa {
  position: absolute;
  color: white;
  background-color: #fff;
  padding: 10px;
  top: 0;
  right: 5px;
  background: #4783b0;
}
.image-checkbox-checked .fa {
  display: block !important;
}
.hidden{
  display: none;
}
img.img-responsive {
    width: 100%;
}

</style>
    <style type="text/css">
      
    </style>
    <?php $this->load->viewD('inc/sidebar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <div class ="row">
              <div class="col-md-12 d-flex align-items-stretch grid-margin">
                <div class="row flex-grow">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Order Setting</h4>
                       

                        <div id="verticalTab">
                          <ul class="resp-tabs-list">
                            <li>Payment Methods</li>
                            <li>Holiday Calender</li>
                          </ul>
                          <div class="resp-tabs-container">

                            <?php
                            if (isset($frontPageSettingData->value) && !empty($frontPageSettingData->value)) {
                              $frontData = (object) unserialize($frontPageSettingData->value);
                               // v3print($frontData); exit;
                            }

                            $activePaymentMethods = (isset($frontData->activePaymentMethods) && !empty($frontData->activePaymentMethods))?explode(',', $frontData->activePaymentMethods):array();
                            ?>
                            <div class="payment-method-section">
                              <div class="container">
                                <h3 class="mb-3">Manage Payment Methods</h3>
                                <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateSetting(this, event);">
                                  <p class="msg"></p>
                                  <?php 
                                    $paymentMethods = array('paypal', 'payu', 'paytm', 'cod');
                                      foreach ($paymentMethods as $payment) {
                                        echo '<div class="col-xs-4 col-sm-3 col-md-6 nopad text-center"> <label class="image-checkbox bg-light p-3 '.(in_array($payment, $activePaymentMethods)?'image-checkbox-checked':'').'">'.ucfirst($payment).'<input type="checkbox" name="activePaymentMethods[]" value="'.$payment.'" '.(in_array($payment, $activePaymentMethods)?'checked':'').' /> <i class="fa fa-check hidden"></i> </label> </div>';
                                      }
                                   ?>
                                  <div class="col-md-12 mt-3 mb-3">
                                    <input type="hidden" name="action" value="addUpdateOrderSetting">
                                    <input type="hidden" name="indexval" value="">
                                    <button type="submit" class="btn btn-success mr-2 actionbtn">Save</button>
                                  </div>
                                </form>

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
        </div>
      </div>      
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
<?php $this->load->viewD('inc/footer.php'); ?>
<script src="https://www.jqueryscript.net/demo/Easy-Responsive-Tab-Accordion-Control-Plugin-For-jQuery/easy-responsive-tabs.js"></script>
<script type="text/javascript">
$(document).ready(function () {
$('#verticalTab').easyResponsiveTabs({
type: 'vertical',
width: 'auto',
fit: true
});
});




// image gallery
// init the state from the input
$(".image-checkbox").each(function () {
  if ($(this).find('input[type="checkbox"]').first().attr("checked")) {
    $(this).addClass('image-checkbox-checked');
  }
  else {
    $(this).removeClass('image-checkbox-checked');
  }
});

// sync the state to the input
$(".image-checkbox").on("click", function (e) {
  $(this).toggleClass('image-checkbox-checked');
  var $checkbox = $(this).find('input[type="checkbox"]');
  $checkbox.prop("checked",!$checkbox.prop("checked"))

  e.preventDefault();
});
</script>
