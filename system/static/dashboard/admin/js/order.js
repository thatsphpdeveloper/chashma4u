var FRONTAJAX =  BASEURL+'/frontajax';
var FRONTSTATIC =  BASEURL+'/system/static/frontend';



var orderBtnText = 'Continue Without Add Ons';
var btnBuy = '<img src="'+FRONTSTATIC+'/img/product-detail/buy-icon.png" alt="">Buy Now';
var paymentBtnText = '';
$(document).ready(function () {
/**** product tabbing ****/
$(document).on('click','.btn-time-slot', function(){
  $('.btn-time-slot').removeClass('active-green');
  $(this).addClass('active-green');
  $("#timeslotId").val( $(this).attr('timeslotId'));
  $("#deliveryTimeSlotId").val( $(this).attr('deliveryTimeSlotId'));
  $("#pincodeId").val( $(this).attr('pincodeId'));
  $("#zoneId").val( $(this).attr('zoneId'));
  $("#requestedDeliveryDate").val( $(this).attr('slotDate'));
  changeFinalPrice();
})
/**** product tabbing ****/

  /*** delivery time detail show hide jquery ******/
  $(document).on('change','input:radio[name="del-time"]',function(){
  	if ($(this).is(":checked")) {
  		$(".delivery-detail-time-section li").find(".delivery-detail-content").slideUp();
  		$(this).closest("li").find(".delivery-detail-content").slideDown();

  	}
  });
   
  /*** delivery time detail show hide jquery ******/

  $(document).on('click','li.variable-item',function(){
    debugger;
    $(this).closest('div.pick-upgrade').find('li.variable-item').removeClass('active');
    $(this).addClass('active');
    $('#variableId').val($(this).attr('data-variableId'));
    let $actualPrice = $(this).attr('data-price');
    let $salePrice = $(this).attr('data-sale-price');
    // $('p.product-price-detail').html((parseFloat($salePrice) > 0)?'<span class="r-icon">₹</span><span class="now-price">'+$salePrice+'</span><span class="orignial-price">₹<del>'+$actualPrice+'</del></span><span class="offer-ratio"> &nbsp;'+(round((((parseFloat($actualPrice)-parseFloat($salePrice))*100)/parseFloat($actualPrice))))+'% OFF</span>':'<span class="r-icon">₹</span><span class="now-price">'+$actualPrice+'</span>');
    // setTimeout(function(){
      
    // }, 1000);
    changeFinalPrice();
  });

  $(document).on('change','input[name="attributeItem[]"]',function(){
    
    if($(this).attr('ismultiple') == 0){
      $(this).closest('ul').find('input[name="attributeItem[]"]:checked').not(this).prop('checked', false);

    }

    changeFinalPrice();
    
  });



  $(document).on("click", ".image-checkbox", function (e) {
    debugger;
    $(this).toggleClass('image-checkbox-checked');
    var $checkbox = $(this).find('input[type="checkbox"]');
    $checkbox.prop("checked",!$checkbox.prop("checked"))

    e.preventDefault();
    updateGiftPopup();
  });


        $( "#pnlEventCalendar" ).datepicker({
          minDate: "<?=$calenderStart;?>",        
            dateFormat: 'DD, d MM, yy',
          onSelect: function(dateStr) {
               if (dateStr) {
                    $('#lblEventCalendar').text(dateStr);
                    var preFinalDate = new Date(dateStr);
                    var datestring = preFinalDate.getFullYear()  + "-" + preFinalDate.getMonth() + "-" + preFinalDate.getDate();
                    $(this).closest('div.address-delivery-details').find('.btn-time-slot').attr('slotdate',datestring);
                    $('#requestedDeliveryDate').val(datestring);
                    if (!$('ul.futureTimeSlot').html())
                  $('#postal_code').trigger("change");
               }
          }
        });

});




function changeFinalPrice(){
  
  let deliveryPrice      = ($('.product-discription').find('button.btn.btn-time-slot.active-green').length)?parseFloat($('.product-discription').find('button.btn.btn-time-slot.active-green').data('price')):0;
   if($(".courierDeliveryAmt").length)
    deliveryPrice = parseFloat($(".courierDeliveryAmt").data('delivery-charge'));
  let productPrice       = parseFloat($('.product-discription').find('div.product-price').data('price'));
  let productSalePrice   = parseFloat($('.product-discription').find('div.product-price').data('sale-price'));
  let variablePrice      = parseFloat($('.product-discription').find('li.variable-item.active').data('price'));
  let variableSalePrice  = parseFloat($('.product-discription').find('li.variable-item.active').data('sale-price'));
  addonsPrice = attributePrice = finalPrice = salePrice = actualPrice = 0;
  $('input[name="attributeItem[]"]:checked').each(function(index){
    attributePrice += parseFloat($(this).data('price'));
  });
  $(".addonsProductId").each(function( index ) {
        if($(this).is(':checked')){
          addonPrice = parseFloat($(this).closest('.image-checkbox').find('b.addons-price').data('price'));
          addonsPrice += addonPrice;
        }
  });
  if (variablePrice > 0) {
    actualPrice = variablePrice;
    salePrice = variableSalePrice;

    if(variableSalePrice > 0){
      finalPrice += variableSalePrice;
    }else{
      finalPrice += variablePrice;
    }
  }else{
    actualPrice = productPrice;
    salePrice = productSalePrice;
    if(productSalePrice > 0){
      finalPrice += productSalePrice;
    }else{
      finalPrice += productPrice;
    }
  }

  let disscount = (salePrice > 0)?(100 - ((salePrice*100)/actualPrice)):0;
  finalPrice += (deliveryPrice > 0)?deliveryPrice:0;
  finalPrice += (attributePrice > 0)?attributePrice:0;
  $('.product-discription').find('p.product-price-detail').find('span.orignial-price, span.offer-ratio').remove();
  if(disscount > 0){
    $('.product-discription').find('p.product-price-detail').append('<span class="orignial-price">₹<del>'+actualPrice+'</del></span><span class="offer-ratio"> &nbsp;'+disscount.toFixed(0)+'% OFF</span>')
  }
  $('#baseItemPrice').val(finalPrice);
  // updateGiftPopup();
  $('.giftpopup-base-price').find('span').text(finalPrice-deliveryPrice);
  $('.giftpopup-total-price').find('span').text(finalPrice+addonsPrice);

  $('.giftpopup-shipping-price').find('span').text(deliveryPrice);
  odometer.innerHTML = finalPrice;
}


function showDeliverSlot(obj, productId){
  $(obj).closest('div.pro-delivery-address').find('p.error-pin').addClass('hide');
  checkPincode(obj, productId, $('#deliverTo').val());
}

/*-------- check Pincode  -----------*/
function checkPincode(obj, productId, deliverTo=''){
  $('.deliverTo-clear').removeClass('hide').html('<i class="fa fa-spinner fa-pulse icon"></i>');
  var dt = new Date();
  var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
  console.log(time);
  $.ajax({
    url: FRONTAJAX,
    type: "POST",
    data: {action:'checkPincode', pincode:$(obj).val(), state:$('#state_name').val(), country:$('#country_name').val(), pincode:$(obj).val(), productId:productId, deliverTo:deliverTo},
    success:function(response){
      var dt = new Date();
      var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
      console.log(time);;
      if(response.valid){
        $(obj).closest('div.pro-delivery-address').find('p.error-pin').removeClass('hide').text('PIN '+$(obj).val());
        let deliverySlotDiv = $(obj).closest('div.product-discription').find('div.delivery-date');
        deliverySlotDiv.removeClass('hide');
        if(response.todayTimeSlotData)
          deliverySlotDiv.find('ul.todayTimeSlot').html(response.todayTimeSlotData);
        
        if(response.tomorrowTimeSlotData)
          deliverySlotDiv.find('ul.tomorrowTimeSlot').html(response.tomorrowTimeSlotData);
        
        if(response.futureTimeSlotData)
          deliverySlotDiv.find('ul.futureTimeSlot').html(response.futureTimeSlotData);
        
        if (response.todayTimeSlotData) {
          $('.tab-tomorrow, .tab-calendar').removeClass('current');
          $('.tab-today').removeClass('hide').addClass('current');
        }else if(response.tomorrowTimeSlotData){
          $('.tab-today, .tab-calendar').removeClass('current');
          $('.tab-tomorrow').removeClass('hide').addClass('current');
        }else{          
          $('.tab-today, .tab-tomorrow').removeClass('current');
          $('.tab-calendar').removeClass('hide').addClass('current');
        }
        
        if (parseInt(response.isCourierDelivery)) {                    
          $('.tab-today, .tab-tomorrow').removeClass('current').addClass('hide');
          $('.tab-calendar').removeClass('hide').addClass('current');
          $('#pincodeId').val(response.courierDeliveryPincodeId);
          deliverySlotDiv.find('ul.futureTimeSlot').html('<h2 class="courierDeliveryAmt" data-delivery-charge="'+response.courierDeliveryAmt+'">Delivery Charge : ₹ '+response.courierDeliveryAmt+'</h2>');
        }

        $(obj).closest('div.product-discription').find('div.msg-img-section,div.bag-buy-section').removeClass('hide');

        $(obj).closest('div.pro-delivery-address').find('p.error1').addClass('hide');
        

      }else{
        $(obj).closest('div.pro-delivery-address').find('p.error1').removeClass('hide').addClass('text-danger').text(response.msg);
        $(obj).closest('div.pro-delivery-address').find('p.error-pin').addClass('hide');

        $(obj).closest('div.product-discription').find('div.delivery-date,div.msg-img-section,div.bag-buy-section').addClass('hide');


      }
    },
    error:function(response){
      $(obj).closest('div.pro-delivery-address').find('p.error-pin').addClass('hide');
      $(obj).closest('div.product-discription').find('div.delivery-date,div.msg-img-section,div.bag-buy-section').addClass('hide');
    },
    complete:function(response){
      $('.deliverTo-clear').removeClass('hide').html('<i class="fa fa-times-circle icon"></i>')
    }
  });
}
/*-------- get Future Deliver Slot  -----------*/
function getFutureDeliverSlot(obj, dateStr, productId, pincode){
  $.ajax({
    url: FRONTAJAX,
    type: "POST",
    data: {action:'getFutureDeliverSlot', dateStr:dateStr, productId:productId, pincode:pincode},
    async: false,
    cache: false,
    timeout: 3000,
    success:function(response){
      if(response.valid){
        $(obj).closest('div.pro-delivery-address').find('p.error-pin').removeClass('hide').text('PIN '+$(obj).val());
        let deliverySlotDiv = $(obj).closest('div.product-discription').find('div.delivery-date');
        deliverySlotDiv.removeClass('hide');
        if(response.futureTimeSlotData){
          $('.tab-tomorrow, .tab-today').removeClass('current');
          $('.tab-calendar').removeClass('hide').addClass('current');
          deliverySlotDiv.find('ul.futureTimeSlot').html(response.futureTimeSlotData);
        }
        
        $(obj).closest('div.product-discription').find('div.msg-img-section,div.bag-buy-section').removeClass('hide');

      }else{
        $(obj).closest('div.pro-delivery-address').find('p.error-pin').addClass('hide');

        $(obj).closest('div.product-discription').find('div.delivery-date,div.msg-img-section,div.bag-buy-section').addClass('hide');


      }
    },
    error:function(response){
      $(obj).closest('div.pro-delivery-address').find('p.error-pin').addClass('hide');
      $(obj).closest('div.product-discription').find('div.delivery-date,div.msg-img-section,div.bag-buy-section').addClass('hide');
    }
  });
}
