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
        .product-section .card.product-box {
            margin-bottom: 10px;
        }

        .product-section .card.product-box .card-body {
            box-shadow: 0 0 2px #d4d4d4;
        }
        .product-section .form-check.form-check-flat label .input-helper:before {
            border: 2px solid #736a6a;
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
                      <h4 class="card-title">Create New Order <a href="<?=DASHURL.'/'.$this->sessDashboard.'/order'?>" class="btn btn-success pull-right">Back to orders</a></h4>

                      <form class="forms-sample formarea <?php//(isset($orderData->userId) && ($orderData->userId > 0))?'hide':''?>" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return updateOrderDetails(this, event);">
                        <p class="card-description">Product Info</p>

                        
                        <div class="form-group">
                          <label for="guestEmail">Product</label>
                          <input type="text" class="form-control" name="product_search" id="product_search" onkeyup="showResult(this.value)">
                          <div id="livesearch"></div>
                        </div>
                        <div class="form-group product-section" id="accordion">
                        </div>
                        <!-- <div class="form-group">
                          <label for="senderName">Sender Name</label>
                          <input type="text" class="form-control" name="senderName" id="senderName" value="<?=(isset($orderData->senderName) && !empty($orderData->senderName))?$orderData->senderName:'';?>" placeholder="Ex: Jhon" required>
                        </div>
                        <div class="form-group">
                          <label for="senderNo">Sender Number</label>
                          <input type="text" class="form-control" name="senderNo" id="senderNo" value="<?=(isset($orderData->senderNo) && !empty($orderData->senderNo))?$orderData->senderNo:'';?>" placeholder="Ex: 09999999999" onkeypress="return OnlyInteger()" required>
                        </div> -->

                        <input type="hidden" name="action" value="updateOrderDetails">
                        <input type="hidden" name="hiddenval" value="<?php //$orderData->orderId;?>">
                        <button type="submit" class="btn btn-success mr-2 actionbtn">Submit</button>
                        <a href="<?=DASHURL.'/'.$this->sessDashboard.'/order/detail/'?>" class="btn btn-light">Cancel</a>
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
  


            <!-- The Modal -->
            <div class="modal fade" id="product-model">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">

                  <!-- Modal Header -->
                  <div class="modal-header">
                    <h4 class="modal-title">Add Product To Cart</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>

                  <!-- Modal body -->
                  <div class="modal-body">
                    Product Details..
                  </div>

                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="hidden" name="currentPincode" id="currentPincode" value="<?=$this->session->userdata(PREFIX.'currentPincode')?>">
                  </div>

                </div>
              </div>
            </div>

    <!-- End address Popup -->

<?php $this->load->viewD('inc/footer.php'); ?>

  <script src="<?=FRONTSTATIC?>/js/odometer.js"></script>
  <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAXJ-mvlpHWOPcISLr9UW21Ox7AgTpwEVk&libraries=places&sensor=false"></script>

<script type="text/javascript" src="<?php echo DASHSTATIC; ?>/admin/js/order.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    getTimeSlotOfDate();
    toggoleEditAdrress();
  });
  productCounter = 1;
  $(document).on('change', '#addressId', function(){
    toggoleEditAdrress();
  });
  $(document).on('click', '.search-product', function(){

    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    $("#product_search").val('');
    getProductData($(this).data('id'));
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
        data: {"action" : "getTimeSlotOfDate", "detailId" : "", "requestedDeliveryDate" : $('#requestedDeliveryDate').val()},
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

  function getProductData(productId){
      currentAjax = 1 ;
      productHtml = '';
      addonsHtml = '';
      variableHtml = '';
      attributeHtml = '';
      $.ajax({
        url: COMMONAJAX,
        data: {"action" : "getProductData", "productId" : productId},
        type: "POST",             
        success:function(response){
          currentAjax = 0 ;
             debugger;
          if(response.valid){
            $('#product-model').modal('show').find('.modal-body').html(response.data);
            
          initilizeAutoComplete();
            // if(response.productData){
            //   if (response.productData.variableData) {
            //     $.each(response.productData.variableData, function(k, variable){
            //       variableHtml += '<div class="col-md-3"><div class="form-check-inline"> <label class="form-check-label"> <input type="radio" name="variableId" class="form-check-input" value="'+variable.variableId+'">'+variable.variableTitle+'</label> </div></div>';
            //     });
            //     variableHtml = '<div class="row variable-box"><div class="col-md-12"><h5>PICK AN UPRADE</h5>'+variableHtml+'</div></div>';
            //   }

            //   if (response.productData.addonsData) {
            //     $.each(response.productData.addonsData, function(k, addons){
            //       addonsHtml += '<div class="col-md-3"><div class="form-check form-check-flat"> <label class="form-check-label"> <input type="checkbox" class="form-check-input category-checkbox" name="addonsProductId[]" value="'+addons.addonsId+'">'+addons.addonsName+' <i class="input-helper"></i> </label> </div> </div>';
            //     });
            //     addonsHtml = '<div class="row addons-box"><div class="col-md-12"><h5>Choose Addons </h5>'+addonsHtml+'</div></div>';
            //   }

            //   if (response.productData.attributeData) {
            //     $.each(response.productData.attributeData, function(k, attribute){
            //       let attributeItemHtml = '';
            //       if (attribute.attributeItems) {
            //         $.each(attribute.attributeItems, function(k, attributeItem){
                      
            //           attributeItemHtml += '<div class="col-md-3"><div class="form-check form-check-flat"> <label class="form-check-label"> <input type="checkbox" class="form-check-input category-checkbox" name="attributeItem[]" value="'+attributeItem.attributeInfoId+'" data-price="'+attributeItem.attributePrice+'" ismultiple="'+attribute.isMultiple+'">'+attributeItem.attributeName+' <i class="input-helper"></i> </label> </div> </div>';
            //         });
            //       }
            //       attributeHtml += (attributeItemHtml)?'<div class="col-md-12 attribute-item-box"><h6>'+attribute.attributeHeading+'</h6>'+attributeItemHtml+'</div>':'';
            //     });
            //     attributeHtml = '<div class="row attribute-box"><h5>Attributes</h5>'+attributeHtml+'</div>';
            //   }

              
            //   productHtml += '<div class="card product-box"> <div class="card-header"> <a class="card-link" data-toggle="collapse" href="#collapse_'+response.productData.productId+'_'+productCounter+'">'+response.productData.productName+'</a> <span class="pull-right" onclick="$(this).closest(\'.product-box\').remove()"><i class="fa fa-trash"></i></span> </div> <div id="collapse_'+response.productData.productId+'_'+productCounter+'" class="collapse show" data-parent="#accordion"> <div class="card-body"><form class="forms-sample formarea" method="post" action="#" novalidate enctype="multipart/form-data" onSubmit="return addProductToCart(this, event);"><input type="hidden" name="productId[]" value="'+response.productData.productId+'">'+variableHtml+' '+attributeHtml+' '+addonsHtml+'</form></div> </div> </div>';
            // }
            // $.each(response.productData, function(k, product){
            //   debugger;
            //   productHtml += '<div class="panel panel-primary"> <div class="panel-heading"> <h3 class="panel-title">'+product.productName+'</h3> <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-down"></i></span> </div> <div class="panel-body" style="display: block;">Panel content</div> </div>';
            // });
            // $('.product-section').append(productHtml);
          }else
            alert('Details not found.');

        },
        error:function(response){
          currentAjax = 0;
          alert('Details not found.');
         
        }
      });
    
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

<script>
// function showResult(str) {
//   if (str.length==0) { 
//     document.getElementById("livesearch").innerHTML="";
//     document.getElementById("livesearch").style.border="0px";
//     return;
//   }
//   if (window.XMLHttpRequest) {
//     // code for IE7+, Firefox, Chrome, Opera, Safari
//     xmlhttp=new XMLHttpRequest();
//   } else {  // code for IE6, IE5
//     xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
//   }
//   xmlhttp.onreadystatechange=function() {
//     if (this.readyState==4 && this.status==200) {
//       document.getElementById("livesearch").innerHTML=this.responseText;
//       document.getElementById("livesearch").style.border="1px solid #A5ACB2";
//     }
//   }
//   xmlhttp.open("GET","livesearch.php?q="+str,true);
//   xmlhttp.send();
// }

function showResult(str){

  if (str.length==0) { 
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  currentAjax = 1;
  $.ajax({
    url: COMMONAJAX,
    type: "POST",
    data: {"action" : "searchProduct", "str": str},
    success:function(response){
      currentAjax = 0 ;
      
        if(response.valid){
          document.getElementById("livesearch").innerHTML=response.data;
          document.getElementById("livesearch").style.border="1px solid #A5ACB2";
        }
        else{
          document.getElementById("livesearch").innerHTML="";
          document.getElementById("livesearch").style.border="0px";
        }
         
    },
    error:function(response){
      currentAjax = 0 ;
      document.getElementById("livesearch").innerHTML="";
      document.getElementById("livesearch").style.border="0px";
    }
  });
}


  $(document).on('change','input[name="attributeItem[]"]',function(){
    
    if($(this).attr('ismultiple') == 0){
      $(this).closest('.attribute-item-box').find('input[name="attributeItem[]"]:checked').not(this).prop('checked', false);

    }
    
  });
</script>

<script type="text/javascript">
      function initilizeAutoComplete() {
        //Array of input fields ID. 
        var gacFields = ["deliverTo"];

        $.each( gacFields, function( key, field ) {
          var input = document.getElementById(field);
          // console.log(input);
          //varify the field
          if ( input != null ) {
            var options = {
              types: ['geocode'],
              componentRestrictions: {country: 'IN'}
            };

            var autocomplete = new google.maps.places.Autocomplete(input, options);

            google.maps.event.addListener(autocomplete, 'place_changed', function(e) {
              $(document).find('.deliverTo-clear').removeClass('hide');
              var place = autocomplete.getPlace();

                for (var i = 0; i < place.address_components.length; i++) {
                  for (var j = 0; j < place.address_components[i].types.length; j++) {
                    if (place.address_components[i].types[j] == "administrative_area_level_1") {
                      document.getElementById('state_name').value = place.address_components[i].long_name;

                    }
                    if (place.address_components[i].types[j] == "country") {
                      document.getElementById('country_name').value = place.address_components[i].long_name;

                      $(document).find('#postal_code').trigger("change");

                    }
                    if (place.address_components[i].types[j] == "postal_code") {
                      document.getElementById('postal_code').value = place.address_components[i].long_name;

                    }
                  }
                }

              if (!place.geometry) {
                return;
              }
            });
          }
            
        });

        if ($(document).find('#currentPincode').val()) {
          $('#postal_code').trigger("change");
        }
      }
</script>
