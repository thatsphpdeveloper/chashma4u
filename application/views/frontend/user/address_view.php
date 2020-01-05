<?php $this->load->viewF("inc/header.php"); ?>
<!-- Profile Banner Section -->
<style type="text/css">
  .col-sm-6.mb-2.mb-sm-0.address-item .card {
    background-color: #ebf1f1;
    margin-bottom: 5px;
}
</style>
    <div class="page-content">
        <div class="holder mt-0">
            <div class="container">
                <ul class="breadcrumbs">
                    <li><a href="<?=BASEURL?>">Home</a></li>
                    <li><span>My account</span></li>
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
                        <h2>My Addresses <button type="button" class="btn btn-primary float-right mb-1" data-toggle="modal" data-target="#address-model"> New Address </button></h2>
                        <div class="row address-box">

                        <?php if (isset($addressData) && !empty($addressData)) {
                          foreach ($addressData as $key=>$address) { ?>
                            <div class="col-sm-6 mb-2 mb-sm-0 address-item">
                                <div class="card">
                                    <div class="card-body">
                                        <h3>Address <?=$key+1?></h3>
                                        <p><?=$address->addressName;?>, <?=$address->contact;?><br><?=$address->address1;?>, <?=$address->address2;?><br><?=$address->city;?>, <?=$address->state;?>, <?=$address->country;?>, <?=$address->zipcode;?></p>
                                        <div class="mt-2 clearfix"><a href="#" class="link-icn js-show-form" onclick="editAddress(this, event)"><i class="icon-pencil"></i>Edit <span class="jsondata"></span></a> <a href="javascript:" class="link-icn ml-1 float-right" onclick="delete_row(this,'address',<?=$address->id;?>)"><i class="icon-cross"></i>Delete</a></div>
                                    </div>
                                </div>
                            </div>

                        <?php } }else{
                          echo '<span class="row alert alert-danger">Address not fond. </span>';
                        } ?>
                        </div>
                        <div class="card mt-3 d-none" id="updateAddress">
                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $this->load->viewF('inc/user-address'); ?>
<!-- End View Profile Details Section -->
<?php $this->load->viewF("inc/footer.php"); ?>
<script type="text/javascript">
  var addressData = <?=json_encode((isset($addressData) && !empty($addressData))?$addressData:array())?>;
  var isOpenModel = "<?=@$_GET['success']?>";
  $(document).ready(function (e) {
    if(isOpenModel)
      $('#address-model').modal('show');
      $('#formCheckbox1').prop('checked', true);
  });
  function editAddress(obj, e) {
    var addressIndx = $(obj).closest('.address-item').index();
    if(addressData[addressIndx] !== undefined && addressData[addressIndx] !=''){

      $('#address-model').modal('show');
      $('#chk-name').val(addressData[addressIndx].addressName); 
      $('#chk-mobile').val(addressData[addressIndx].contact);
      $('#chk-address').val(addressData[addressIndx].address1);
      $('#chk-address2').val(addressData[addressIndx].address2); 
      $('#chk-city').val(addressData[addressIndx].city);
      $('#state').val(addressData[addressIndx].state);
      $('#chk-country').val(addressData[addressIndx].country);
      $('#chk-pincode').val(addressData[addressIndx].zipcode);
      $('#formCheckbox1').prop('checked', (parseInt(addressData[addressIndx].isPrimary))?true:false);
      $('#addressId').val(addressData[addressIndx].id);
    }
  }
  $(document).on('show.bs.modal','#address-model', function (e) {
      $('#chk-name').val(''); 
      $('#chk-mobile').val('');
      $('#chk-address').val('');
      $('#chk-address2').val(''); 
      $('#chk-city').val('');
      $('#state').val('');
      $('#chk-country').val('');
      $('#chk-pincode').val('');
      $('#formCheckbox1').prop('checked', false);
      $('#addressId').val(0);
  });
</script>