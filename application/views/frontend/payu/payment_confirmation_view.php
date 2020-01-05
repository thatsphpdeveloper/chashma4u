<?php $this->load->viewF("inc/header.php"); ?>
<div class="container">


  <div class="row">
    <div class="col-md-12" style="min-height: 500px;">
      <center style="padding: 30px;"><h1>Redirecting to payu...</h1></center>

        <form action="<?= $action; ?>" method="post" id="payuForm" name="payuForm" class="hide">
          <input type="hidden" name="key" value="<?= $mkey ?>" />
          <input type="hidden" name="hash" value="<?= $hash ?>"/>
          <input type="hidden" name="txnid" value="<?= $tid ?>" />
          <div class="form-group">
            <label class="control-label">Total Payable Amount</label>
            <input class="form-control" name="amount" value="<?= $amount ?>"  readonly/>
          </div>
          <div class="form-group">
            <label class="control-label">Your Name</label>
            <input class="form-control" name="firstname" id="firstname" value="<?= $name ?>" readonly/>
          </div>
          <div class="form-group">
            <label class="control-label">Email</label>
            <input class="form-control" name="email" id="email" value="<?= $mailid ?>" readonly/>
          </div>
          <div class="form-group">
            <label class="control-label">Phone</label>
            <input class="form-control" name="phone" value="<?= $phoneno ?>" readonly />
          </div>
          <div class="form-group">
            <label class="control-label"> Booking Info</label>
            <textarea class="form-control" name="productinfo" readonly><?= $productinfo ?></textarea>
          </div>
          <div class="form-group">
            <label class="control-label">Address</label>
            <input class="form-control" name="address1" value="<?= $address ?>" readonly/>     
          </div>
          <div class="form-group">
            <input name="surl" value="<?= $sucess ?>" size="64" type="hidden" />
            <input name="furl" value="<?= $failure ?>" size="64" type="hidden" />                             
            <input type="hidden" name="service_provider" value="payu_paisa" size="64" /> 
            <input name="curl" value="<?= $cancel ?> " type="hidden" />
          </div>
          <div class="form-group text-center">
            <input type="submit" value="Pay Now" class="btn btn-success" /></td>
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