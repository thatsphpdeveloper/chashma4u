var FRONTAJAX =  BASEURL+'/frontajax';


var orderBtnText = 'Continue Without Add Ons';
var btnBuy = '<img src="'+FRONTSTATIC+'/img/product-detail/buy-icon.png" alt="">Buy Now';
var paymentBtnText = '';
/****** jquery stater ****/

function GetDataOfThisPage() {
  var _location=document.location.toString();

  var uriArray= _location.split('/');

  if($.inArray( "photo-gallery", uriArray ) > -1){
    $('.viewMorePhotoGallery').trigger('click');
  }
  // else if($.inArray("subcategory", uriArray) > -1 && $.inArray( "product",uriArray) > -1)
  //   GetSubCategoryList();

}
  // document.onkeydown = function(e) {
  //   if(e.keyCode == 123) {
  //     return false;
  //   }
  //   if(e.button == 2) {
  //     return false;
  //   }
  //   if(e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)){
  //     return false;
  //   }
  //   if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
  //     return false;
  //   }
  //   if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
  //     return false;
  //   }
  //   if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
  //     return false;
  //   }
  //   if(e.ctrlKey && e.keyCode == 'S'.charCodeAt(0)){
  //     return false;
  //   }
  //   if(e.ctrlKey && e.keyCode == 'H'.charCodeAt(0)){
  //     return false;
  //   }
  //   if(e.ctrlKey && e.keyCode == 'A'.charCodeAt(0)){
  //     return false;
  //   }
  //   if(e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)){
  //     return false;
  //   }
  // }
$(document).ready(function () {
   // $(document)[0].oncontextmenu = function() { return false; }

    // $(document).mousedown(function(e) {
    //     if( e.button == 2 ) {
    //         alert('Sorry, this functionality is disabled!');
    //         return false;
    //     } else {
    //         return true;
    //     }
    // });
  getFooterhtml();
  GetDataOfThisPage();


/**** product tabbing ****/
$('ul.tabs li').click(function(){
    var tab_id = $(this).attr('data-tab');

    $('ul.tabs li').removeClass('current');
    $('.tab-content').removeClass('current');

    $(this).addClass('current');
    $("#"+tab_id).addClass('current');
})

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
  $(document).on('change','.chk-select-address',function(){
    
    if ($(this).is(":checked")) {
      $(this).closest(".address-details").find('li').removeClass('active');
      $(this).closest(".address-details").find("button.edit-btn.pull-right, button.delivery-here-btn").addClass('hide');
      $(this).closest('li').addClass('active').find("button.edit-btn.pull-right, button.delivery-here-btn").removeClass('hide');

    }
  });
  

});
/**** end jquery stater ****/



var FRONTSTATIC = BASEURL+'/system/static/frontend';
$(document).ready(function(){
  if ($('#currentCity').attr('zoneId') == '0')
    $('#cityPopup').modal('show');

  //validate Form with including inpute type email
  $('.validate-form').unbind("click").click(function(e){
    e.stopPropagation();
    var btntext = $(this).html();
    if($(this).html()=='Processing..')
      return false;
    $(this).html('Processing..');
    var chk=0;
    var obj=$(this).closest('form');
    if(TextBoxValidation(obj)==false)
      chk=1;
    if(chk===1){
      $(this).text(btntext);
      return false;
    }
    obj.submit();
  });

  $('.validate-password').on('click', function(){
      if($(this).html()== 'Processing..')
         return false;
      var btnObj = $(this);
      var btn = $(this).html();
      $(this).html('Processing..');
      var chk=0;
      var obj=$(this).closest('form');
      if( TextBoxValidation(obj) === false){
          obj.find('.error:eq(0)').focus();
          chk=1;      
      }
        obj.find('input[type=password]').not("input[name='currentPassword']").each(function () {
        
          if (!validatePassword($(this).val())) {

              $(this).css("border", "solid 1px #DC3C1E");       
              $(this).addClass("error");
              ($(this).closest("div").find('label.error').length>0)?"":$(this).closest("div").append('<label class="error text-danger">Password must contain at least 6 characters.</label>');
               chk = 1;
          }else{
              if(!$(this).hasClass('more_error')){            
                  $(this).removeClass("error");
                  $(this).closest("div").find('label.error').remove();
              }
          }
      });

      if(obj.find("input[name='password']").length > 0 && obj.find("input[name='confirmPassword']").length > 0 && obj.find("input[name='password']").val().length > 5){
          if(obj.find("input[name='password']").val() != obj.find("input[name='confirmPassword']").val()){
              var pasObj = ("input[name='confirmPassword']");
              $(pasObj).addClass("error");
              ($(pasObj).closest("div").find('label.error').length>0)?"":$(pasObj).closest("div").append('<label class="error text-danger">Password and confirm password does not match.</label>');
               
                chk = 1;
          }else{
              if(!$(pasObj).hasClass('more_error')){            
                  $(pasObj).removeClass("error");
                  $(pasObj).closest("div").find('label.error').remove();
              }
          }
      }

      if(obj.find("input[name='mobile']").length > 0){
          var mobObj = obj.find("input[name='mobile']");
          if(mobObj.val().length < 10){
              mobObj.addClass("error");
              (mobObj.closest("div").find('label.error').length>0)?"":mobObj.closest("div").append('<label class="error text-danger">Please enter valid number.</label>');
               
                chk = 1;
          }else{
              if(!mobObj.hasClass('more_error')){            
                  mobObj.removeClass("error");
                  mobObj.closest("div").find('label.error').remove();
              }
          }
      }

       if(chk===1){
            btnObj.html(btn);
            return false;
        }else
          obj.submit();
      
  });



  //validate Form of order
  $('.validate-order-form').unbind("click").click(function(e){
    e.stopPropagation();
    var btntext = $(this).html();
    if($(this).html()=='Processing..')
      return false;
    $(this).html('Processing..');
    var chk=0;
    var obj=$(this).closest('form');
    if(formValidation(obj)==false)
      chk=1;
    if(chk===1){
      $(this).text(btntext);
      return false;
    }
    obj.submit();
  });


  //validate Form of order
  // $('.validate-review').unbind("click").click(function(e){
  //   e.stopPropagation();
  //   var btntext = $(this).html();
  //   if($(this).html()=='Processing..')
  //     return false;
  //   $(this).html('Processing..');
  //   var chk=0;
  //   var obj=$(this).closest('form');
  //   if(TextBoxValidation(obj)==false)
  //     chk=1;

  //   if ($('div.rating.custom-radio').length) {
  //     $( "div.rating.custom-radio" ).each(function( index ) {
  //       if($( this ).find("input[type='radio']:checked").length)
  //         $(this).closest('div.rating-section').find('label.error').remove();
  //       else{
  //         $(this).closest('div.rating-section').find('label.error').length > 0 ? "" : $(this).closest('div.rating-section').append( '<label class="error text-danger">Rating is required.</label>');
  //         chk=1;
  //       }
  //     });
  //   }
  //   // if($('div.rating.custom-radio').find("input[type='radio']").checked)    
  //   //   $(obj).find('div.rating-section').find('label.error').remove();
  //   // else{
  //   //   $(obj).find('div.rating-section').find('label.error').length > 0 ? "" : $(obj).find('div.rating-section').append( '<label class="error text-danger">Rating is required.</label>');
  //   //   $(obj).find('#value1').focus();
  //   //   chk=1;
  //   // }

  
  //   if(chk===1){
  //     $(this).text(btntext);
  //     return false;
  //   }
  //   obj.submit();
  // });


  // $(document).on('click','.validate-blog',function(e){

  //   e.stopPropagation();
  //   var btntext = $(this).html();
  //   if($(this).html()=='Processing..')
  //     return false;
  //   $(this).html('Processing..');
  //   var chk=0;
  //   var obj=$(this).closest('form');
  //   if(TextBoxValidation(obj)==false)
  //     chk=1;
  //   if(chk===1){
  //     $(this).text(btntext);
  //     return false;
  //   }
  //   obj.submit();
  // });

  // $('.btn-edit').unbind("click").click(function(e){
  //   var obj=$(this).closest('form');
  //   obj.find('.btn-update').removeClass('hide');
  //   obj.find('.btn-edit').addClass('hide');
  //   obj.find('input[type=text], input[type=email], input[type=file], input[type=radio], input[type=checkbox]').each(function () {
  //     $(this).removeAttr('disabled');
  //   });
  // });

  // $('.profile-cancel-btn').unbind("click").click(function(e){

  //   var obj=$(this).closest('form');
  //   obj.find('.msg').html('');
  //   obj.find('.btn-update').addClass('hide');
  //   obj.find('.btn-edit').removeClass('hide');
  //   obj.find('input[type=text], input[type=email], input[type=file], input[type=radio], input[type=checkbox]').each(function () {
  //     $(this).attr('disabled','disabled');
  //   });
  // });


// if ($('#deliverTo').length){ 
//   $( "#deliverTo" ).tooltip({
//     position: { my: "left+15 center", at: "right center" },
//     disabled: true
//   });
// }
  //validate Form of order
  $('.buy-btn').unbind("click").click(function(e){
    e.preventDefault();
    let btnObj = $(this);
    let btnBuy = $(this).html();
    if(btnObj.html()=='Processing..')
      return false;
    btnObj.html('Processing..');
    
    var chk=0;
    var obj=$(this).closest('form');
    if(TextBoxValidation(obj)==false)
      chk=1;
    
    var prescription_type = $("input[name=prescription_type]:checked").val();
    if(chk==0 && (prescription_type == 'single-vision' || prescription_type == 'bifocal-progressive' )){
      if($("input[name=lens-option]:checked").val() === undefined) {   
        obj.find('.msg').html(getMsg('Please choose a lens.',2)).css('display','block');
        chk=1;
      }

      if(chk==0 && $("#rsph").val() == '' && $("#rcyl").val() == '' && $("input[name=raxis]").val() == 0 && $("#radd").val() == '' && $("#lsph").val() == '' && $("#lcyl").val() == '' && $("input[name=laxis]").val() == 0 && $("#ladd").val() == '' && $("#prescriptionImg").val() == ''){      
        obj.find('.msg').html(getMsg('Please upload or enter your prescription.',2)).css('display','block');
        chk=1;
      }
    }
      
    if(chk===1){      
      btnObj.html(btnBuy);
       $('html, body').animate({
          scrollTop: (obj.find(".msg").offset().top - 300)
        }, 2000);
      return false;
    }
   
      obj.submit();
  });


  //validate Form of order
  $('button.checkout-address').unbind("click").click(function(e){
    var chk = 0;
    var obj =$(this);
    $(this).closest('div.form-field-section').find('input[type=text]').not('input[name=deliveryAddress2]').each(function () {
      $(this).css("border", "solid 1px #c9cfd4");
      if ($(this).val().trim() == '') {
        $(this).css("border", "solid 1px #DC3C1E");
        chk = 1;
      } 

    });
    $(this).closest('div.form-field-section').find('.min-length-required').each(function () {
      $(this).css("border", "solid 1px #c9cfd4");
      if ($(this).val().trim().length < 10) {
        $(this).css("border", "solid 1px #DC3C1E");
        chk = 1;
      } 

    });
  
    if(chk===1)
      return false;
    
    showHideCheckout(obj,'li.address-section','li.order-section');
  });


  //validate Form of order
  $('.create-order-btn').unbind("click").click(function(e){
    e.preventDefault();
    paymentBtnText = $(this).html();
    if($(this).html()=='Processing..')
      return false;
    var btnObj = $(this);
    $(this).html('Processing..');
    var chk=0;
    var obj=$(this).closest('form');
    
    if(TextBoxValidation(obj)==false)
      chk=1;

    if (obj.find('.error').length && chk===1) {
      errorObj = obj.find('.error:eq(0)');
      errorObj.focus();

      window.scroll({
          top: errorObj.scrollTop,
          behavior: 'smooth',
      }); 

    }
  
    if(chk===1){
      btnObj.html(paymentBtnText); 
      return false;
    }
    if(btnObj.hasClass('cod')){
      $('#paymentMethod').val('cod');
      setTimeout(function(){$('#paymentMethod').val('payu');},3000);
    }

    obj.submit();
  });

});


function changeFinalPrice(){
  let deliveryPrice = ($('.product-discription').find('button.btn.btn-time-slot.active-green').length)?parseFloat($('.product-discription').find('button.btn.btn-time-slot.active-green').data('price')):0;
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

function showHideCheckout(obj, div1, div2) {
  // event.preventDefault();
 
  obj.closest(div1).find('span.check-mark').removeClass('hide'); 
  obj.closest(div1).find('div.chkout-btn').trigger('click');
  var obj2 = obj.closest('div.checkout-section').find(div2).find('div.chkout-btn');
  if(obj2.attr('aria-expanded') != 'true'){
    obj2.trigger('click');
    var obj3 = obj.closest('div.checkout-section').find(div2).find('.add-new-field');
    if(obj3.length && obj.closest('div.checkout-section').find(div2).find('input[name=addressId]').length ==0){
      if(obj3.attr('aria-expanded') != 'true')
        obj3.trigger('click');
    }
  }
}

function deliverHere(obj) {
  $(obj).closest('li.address-section').find('input[name="addressId"]').prop('checked', false);
  $(obj).closest('li.address-item').find('input[name="addressId"]').prop('checked', true);
  showHideCheckout($(obj),'li.address-section','li.order-section');
}

// function showCouponFrom(obj) {
//   $(obj).closest('div.coupon-section').addClass('hide');
//   $(obj).closest('div.ordered-price-list').find('div.add-coupon-section').removeClass('hide');
//   $(obj).closest('div.ordered-price-list').find('div.applied-coupon-section').addClass('hide');
//   $('#couponApplied').val('');
// }

// function cancelCoupon(obj) {
//   $(obj).closest('div.add-coupon-section').addClass('hide');
//   $(obj).closest('div.ordered-price-list').find('div.coupon-section').removeClass('hide');
//   $(obj).closest('div.ordered-price-list').find('div.applied-coupon-section').addClass('hide');
// }
// function applyCoupon(obj) {
//   $(obj).closest('div.coupon-section').addClass('hide');
//   $(obj).closest('div.ordered-price-list').find('div.add-coupon-section').addClass('hide');
//   $(obj).closest('div.ordered-price-list').find('div.applied-coupon-section').removeClass('hide');
// }


function TextBoxValidation(obj) {
  var check = true;
  $(obj).find('input[type=text],input[type=password],input[type=email],input[type=file],input[type=date],textarea,select').each(function () {
    var c = $(this).attr('required');
    if($(this).prop("tagName").toLowerCase() == 'select' && $(this).prop('multiple'))
      var v = 'check';
    else
      var v = $(this).val().trim();
    $(this).css("border", "solid 1px #c9cfd4");
    if (c == 'required' && v == '') {
      $(this).css("border", "solid 1px #DC3C1E");
      check = false;
    }      
    if (c == 'required' && v == '') {
      $(this).addClass("error");
      ($(this).closest("div").find('label.error').length>0)?"":$(this).closest("div").append('<label class="error text-danger">This field is required.</label>');
      check = false;
    }
    else if ($(this).attr('type')=='email' && validateEmail($(this).val().trim()) == false) {
      
      $(this).css("border", "solid 1px #DC3C1E");
      $(this).addClass("error");
      ($(this).closest("div").find('label.error').length>0)?$(this).closest("div").find('label.error').text('invalid email-id.'):$(this).closest("div").append('<label class="error text-danger">invalid email-id.</label>');
      check = false;
    }
    else{
      if(!$(this).hasClass('more_error')){            
        $(this).removeClass("error");
        $(this).closest("div").find('label.error').remove();
      }
    }
  });
  return check;
}
function formValidation(obj) {
    var check = true;
    $(obj).find('input[type=text],input[type=password],input[type=email],input[type=file],input[type=date],textarea,select').each(function () {
    var c = $(this).attr('required');
    if($(this).prop("tagName").toLowerCase() == 'select' && $(this).prop('multiple'))
      var v = 'check';
    else
    var v = $(this).val().trim();
    $(this).css("border", "solid 1px #c9cfd4");
    if (c == 'required' && v == '') {
            $(this).css("border", "solid 1px #DC3C1E");
            check = false;
        }else if ($(this).attr('type')=='email' && validateEmail($(this).val().trim()) == false) {
          $(this).addClass("error");
          $(this).css("border", "solid 1px #DC3C1E");
            check = false;
        }
        else{
            if(!$(this).hasClass('more_error')){            
                $(this).removeClass("error");
                $(this).closest("div").find('label.error').remove();
            }
        }
    });
    return check;
}

/*----------------------------Email Validation-------------------------------------------------*/
function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\.+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function ResetTextBox(obj) {
  $(obj).find('input[type=text]').val('');
  $(obj).find('input[type=password]').val('');
  $(obj).find('input[type=email]').val('');
  $(obj).find('input[type=checkbox]').prop('checked',false);
  $(obj).find('input[type=radio]').prop('checked',false);
  $(obj).find('textarea').val('');
  $(obj).find('select').prop('selected',false);  
}
 
function OnlyAlphabet() {
     var charCode = (event.which) ? event.which : event.keyCode;
     if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123))
     return true;
     else
    return false
}
 
function OnlyFloat() {
    var value = $(event.target).val()
    var charCode = (event.which) ? event.which : event.keyCode;
    if((value.indexOf('.')!=-1) && (charCode < 48 || charCode > 57))
        return false;
    else if((charCode != 46 || $(event.target).val().indexOf('.') != -1) && (charCode < 48 || charCode > 57))
        return false;
    return true;
}

function OnlyInteger() {
    if (String.fromCharCode(event.keyCode).match(/[^0-9]/g)) return false;
}

function limitText(obj, maxChar){
        val = $(obj).val();
    if ( val.length >= maxChar ){
        return false;
    }
}
function validatePassword(str = '', lngth = 6 , isUpper = true , isLower = true , isNumber = true) {

  // if(isUpper == true && !str.match(/[A-Z]/g) )
  //   return false;
  // else if(isLower == true && !str.match(/[a-z]/g) )
  //   return false;
  // else if(isNumber == true && !str.match(/[0-9]/g) )
  //   return false;
  // else
  if(str.length < lngth)
    return false;
  else
    return true
  return true;
}

function fileuploadpreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $(input).closest('form').find('div.preview-img').removeClass('hide').find('img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);       
    } else 
        $(input).closest('form').find('div.preview-img').addClass('hide');
}

/*********************** Delete Records ***********************/

function delete_row(obj,tab,id){  
  event.preventDefault();
  if (tab == 'address')
    var  index=$(obj).closest('.address-item').index();
  else
    var  index=$(obj).closest('tr').index();

  var action = "CallHandlerForDeleteRecord(" + id + "," + index + ",'" + tab + "');";

      action = '"' + action + '"';

  var msg = "Are You Sure Want To Delete This Record";

  var $div = "<div id='sb-containerDel'><div id='sb-wrapper' style='width:425px'><h1 style='font-size: 20.5px;'>"+msg+"</h1><div class=msg></div><hr/><table><tr><td><a href='javascript:void(0)' id='deleteyes' onclick=" + action + " class='btn btn-success'>Yes</a></td><td><a href='javascript:void(0)' onclick='RemoveDelConfirmDiv();' class='btn btn-danger'>No</a></td></tr></table></div></div>";

    $('body').append($div);

    $('#sb-containerDel').show('slow');

}

function CallHandlerForDeleteRecord(id,index, tab) {

  $('#deleteyes').html("Processing");

  var formData={action:"deleteRecord",tab:tab,id:id};

  $.ajax({

    url: FRONTAJAX,

    type: "POST",

    data: formData,

    success: function (response) {
      if (response.valid) {
        if (tab == 'address')
          var $ntr = $('div.address-box').find('.address-item:eq(' + index + ')');
        else
          var $ntr = $('.table').find('tbody').find('tr:eq(' + index + ')');

        $ntr.remove();

        RemoveDelConfirmDiv();
      }else{
        $(this).text('Yes').closest('div.sb-wrapper').find('div.msg').html();
      }

    },
    error : function(d) {}

  });

}

/*-------- check Pincode  -----------*/
function checkPincode(obj, productId, deliverTo=''){
  $('.deliverTo-clear').removeClass('hide').html('<i class="fa fa-spinner fa-pulse icon"></i>');

  $.ajax({
    url: FRONTAJAX,
    type: "POST",
    data: {action:'checkPincode', pincode:$(obj).val(), state:$('#state_name').val(), country:$('#country_name').val(), pincode:$(obj).val(), productId:productId, deliverTo:deliverTo},
    success:function(response){

      if(response.valid){
        $(obj).closest('div.pro-delivery-address').find('p.error-pin').removeClass('hide').text('PIN '+$(obj).val());
            let deliverySlotDiv = $(obj).closest('div.product-discription').find('div.delivery-date');
            deliverySlotDiv.removeClass('hide');
        if(response.todayTimeSlotData)
              deliverySlotDiv.find('ul.todayTimeSlot').html(response.todayTimeSlotData);
        else
          $('.tab-today').addClass('hide');
        
        if(response.tomorrowTimeSlotData)
          deliverySlotDiv.find('ul.tomorrowTimeSlot').html(response.tomorrowTimeSlotData);
        else
          $('.tab-tomorrow').addClass('hide');
        
        if(response.futureTimeSlotData)
          deliverySlotDiv.find('ul.futureTimeSlot').html(response.futureTimeSlotData);
        else
            deliverySlotDiv.find('ul.futureTimeSlot').html('Delivery slots not available, Try another date.');
        
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
          if(response.courierDeliveryAmt=="0")
           var courierDeliveryAmt1 =  "Free";
           else
            var courierDeliveryAmt1 =  '₹ '+response.courierDeliveryAmt;
          deliverySlotDiv.find('ul.futureTimeSlot').html('<h2 class="courierDeliveryAmt" data-delivery-charge="'+response.courierDeliveryAmt+'">Delivery Charge : '+courierDeliveryAmt1+'</h2>');
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
function getFutureDeliverSlot(){
  var deliverySlotDiv = $('.tab-calendar');
  var dateStr = $('#requestedDeliveryDate').val();
  var productId = $('#productId').val();
  var pincode = $('#postal_code').val();

  deliverySlotDiv.find('ul.futureTimeSlot').html('<i class="fa fa-spinner fa-pulse icon"></i>');
  $.ajax({
    url: FRONTAJAX,
    type: "POST",
    data: {action:'getFutureDeliverSlot', dateStr:dateStr, productId:productId, pincode:pincode},
    success:function(response){

      if(response.valid){
        if (parseInt(response.isCourierDelivery)) {
          $('.tab-today, .tab-tomorrow').removeClass('current').addClass('hide');
          $('.tab-calendar').removeClass('hide').addClass('current');
          $('#pincodeId').val(response.courierDeliveryPincodeId);
          if(response.courierDeliveryAmt=="0")
           var courierDeliveryAmt1 =  "Free";
           else
            var courierDeliveryAmt1 =  '₹ '+response.courierDeliveryAmt;
          deliverySlotDiv.find('ul.futureTimeSlot').html('<h2 class="courierDeliveryAmt" data-delivery-charge="'+courierDeliveryAmt1+'">Delivery Charge : ₹ '+response.courierDeliveryAmt+'</h2>');
        }else if(response.futureTimeSlotData)
          deliverySlotDiv.find('ul.futureTimeSlot').html(response.futureTimeSlotData);
          else
            deliverySlotDiv.find('ul.futureTimeSlot').html('Slot not available.');

      }else{
        deliverySlotDiv.find('ul.futureTimeSlot').html('Delivery slots not available, Try another date.');
      }
    },
    error:function(response){
      deliverySlotDiv.find('ul.futureTimeSlot').html('Something went wrong.');
    }
  });
}

/*-------- Sending mail of equiry  -----------*/
function sendEnquiry(obj,e) {
  e.preventDefault();
  $(obj).find('.msg').html('').css('display','none');
  $.ajax({
    url:FRONTAJAX,
    method:'POST',
    data: new FormData(obj),
    contentType: false,
    cache: false,
    processData:false,
    success:function(response){
      if(response.valid){
        $(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
        ResetTextBox(obj);
        setTimeout(function(){window.location.reload(); },5000);
      }else
        $(obj).find('.msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something went wrong.',2)).css('display','block');
      
      $(obj).find('.validate-form').html('Submit');
      $(obj).find('input[name=name]').focus();
      setTimeout(function(){$(obj).find('.msg').html('').css('display','none'); },5000);
                     
    },
    error:function(response){
      $(obj).find('.validate-form').html('Submit');
      $(obj).find('.msg').html(getMsg('Something went wrong.',2)).css('display','block');
    }
  });
}
/*-------- Sending mail of fanchise equiry  -----------*/
function sendFanchiseEnquiry(obj,e) {
  e.preventDefault();
  $(obj).find('.msg').html('').css('display','none');
  $.ajax({
    url:FRONTAJAX,
    method:'POST',
    data: new FormData(obj),
    contentType: false,
    cache: false,
    processData:false,
    success:function(response){
      if(response.valid){
        $(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
        ResetTextBox(obj);
        setTimeout(function(){window.location.reload(); },5000);
      }else
        $(obj).find('.msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something went wrong.',2)).css('display','block');
      
      $(obj).find('.validate-form').html('Submit');
      setTimeout(function(){$(obj).find('.msg').html('').css('display','none'); },5000);
      grecaptcha.reset();          
    },
    error:function(response){
      $(obj).find('.validate-form').html('Submit');
      $(obj).find('.msg').html(getMsg('Something went wrong.',2)).css('display','block');
      grecaptcha.reset();
    }
  });
}

// set up message html
function getMsg(message="", msgtype=1){
    if(msgtype == 1){ //success message
        msg = '<div onclick="javascript:$(this).fadeOut(500)" style="list-style: none;overflow: hidden; margin: 4px 0px; border-radius: 2px; border-width: 2px; border-style: solid; border-color: rgb(124, 221, 119); box-shadow: rgba(0, 0, 0, 0.1) 0px 2px 4px; background-color: rgb(188, 245, 188); color: darkgreen; cursor: pointer;" class="animated flipInX"><div class="noty_bar noty_type_success" id="noty_1432600013676628200"><div class="noty_message" style="font-size: 14px; line-height: 16px; text-align: center; padding: 10px; width: auto; position: relative;"><div class="noty_text" style="font-family: Nunito Sans, sans-serif;">'+message+'</div></div></div></div>';
    } else if(msgtype == 2){ //Error message
        msg ='<div onclick="javascript:$(this).fadeOut(500)" style="list-style: none;overflow: hidden; margin: 4px 0px; border-radius: 2px; border-width: 2px; border-style: solid; border-color: rgb(226, 83, 83); box-shadow: rgba(0, 0, 0, 0.1) 0px 2px 4px; background-color: rgb(255, 129, 129); color: rgb(255, 255, 255); cursor: pointer;" class="animated flipInX"><div class="noty_bar noty_type_error" id="noty_505214828237683140"><div class="noty_message" style="font-size: 14px; line-height: 16px; text-align: center; padding: 10px; width: auto; position: relative; font-weight: bold;"><div class="noty_text" style="font-family: Nunito Sans, sans-serif;">'+message+'</div></div></div></div>';
    } else if(msgtype == 3){ //Warning message
        msg ='<div onclick="javascript:$(this).fadeOut(500)" style="list-style: none;overflow: hidden; margin: 4px 0px; border-radius: 2px; border-width: 2px; border-style: solid; border-color: rgb(255, 194, 55); box-shadow: rgba(0, 0, 0, 0.1) 0px 2px 4px; background-color: rgb(255, 234, 168); color: rgb(130, 98, 0); cursor: pointer;" class="animated flipInX"><div class="noty_bar noty_type_warning" id="noty_140323524152335250"><div class="noty_message" style="font-size: 14px; line-height: 16px; text-align: center; padding: 10px; width: auto; position: relative;"><div class="noty_text" style="font-family: Nunito Sans, sans-serif;"><strong>Warning!</strong> <br> '+message+'</div></div></div></div>';
    }
    return msg;      
}

/*------check login of User----*/
function forgotcheck(obj,e){
    e.preventDefault();
    $(obj).find('.msg').html('').css('display','none');
    $.ajax({
        url: FRONTAJAX,
        type: "POST",
        data: new FormData(obj),
        contentType: false,
        cache: false,
        processData:false,
        success:function(response){
            if(response.valid){              
                $(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
            }else
                $(obj).find('.msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something is wrong',2)).css('display','block');     
        },
        error:function(response){
            $(obj).find('.msg').html(getMsg('Something is wrong',2)).css('display','block');
        },
        complete:function(response){
          $(obj).find('.validate-form').text('Submit');
          setTimeout(function(){$(obj).find('.msg').html('').css('display','none');},2000);
        }
    });

}
/*------set new password of User----*/
function setnewpassword(obj,e){
  e.preventDefault();
  $(obj).find('.msg').html('').css('display','none');
  $.ajax({
        url: BASEURL+'/index/setnewpassword',
        type: "POST",
        data: new FormData(obj),
        contentType: false,
        cache: false,
        processData:false,
        success:function(response){
            if(response.valid){
                $(obj).find('.form_holder').html('<div class="form-group msg">'+getMsg(response.msg,1)+'</div>');
                setTimeout(function(){(window.location.href=BASEURL);},10000);
            }
            else{
                $(obj).find('.msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something went wrong.',2)).css('display','block');
                $(obj).find('.validate-model-form').html('Submit');
                $(obj).find('#password21').focus();
            }           
        },
        error:function(response){
            $(obj).find('.validate-model-form').html('Submit');
            $(obj).find('.msg').html(getMsg('Something went wrong.',2)).css('display','block');
        }
    });
}


/*------registration of User----*/
function registration(obj,e){
    e.preventDefault();
    $(obj).find('.msg').html('').css('display','none');
    $.ajax({
        url: FRONTAJAX,
        type: "POST",
        data: new FormData(obj),
        contentType: false,
        cache: false,
        processData:false,
        success:function(response){
            if(response.valid){
                $(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
                ResetTextBox(obj);

                setTimeout(function(){
                  if($(document).find('#redirectType').val())
                    window.location.href=BASEURL+'/cart?process='+$(document).find('#redirectType').val();
                  else if($(document).find('#redirectUrl').val())
                    window.location.href=$(document).find('#redirectUrl').val();
                  else
                    window.location.href = BASEURL+'/user/address?success=1';
                },3000);
            }else
                $(obj).find('.msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something is wrong',2)).css('display','block');
            $(obj).find('.validate-password').html('create an account'); 
            
            // $('html, body').animate({
            //       scrollTop: 0
            //   }, 500);       
        },
        error:function(response){
            $(obj).find('.validate-password').html('create an account');
            $(obj).find('.msg').html(getMsg('Something is wrong',2)).css('display','block');
        },complete(res){

          grecaptcha.reset(); 
        }
    });
}
/*------check login of User----*/
function logincheck(obj,e){
    e.preventDefault();
    $(obj).find('.msg').html('').css('display','none');
    $.ajax({
        url: FRONTAJAX,
        type: "POST",
        data: new FormData(obj),
        contentType: false,
        cache: false,
        processData:false,
        success:function(response){
            if(response.valid){
              
                $(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
                if(response.role == 'admin' || response.role == 'vendor')
                  setTimeout(function(){(window.location.href=DASHURL+'/'+response.role+'/welcome');},1000);
                else if(response.role == 'user') {
                  setTimeout(function(){
                    if($(document).find('#redirectType').val())
                      window.location.href=BASEURL+'/cart?login='+$(document).find('#redirectType').val();
                    else if($(document).find('#redirectUrl').val())
                      window.location.href=$(document).find('#redirectUrl').val();
                    else
                      window.location.href=BASEURL;
                  },2000);
                  
                }else
                  setTimeout(function(){(window.location.href=location.href);},2000);
            }else
                $(obj).find('.msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something is wrong',2)).css('display','block');
            $(obj).find('.validate-form').text('Sign in');        
        },
        error:function(response){
            $(obj).find('.validate-form').text('Sign in');
            $(obj).find('.msg').html(getMsg('Something is wrong',2)).css('display','block');
        }
    });
}

/*------update details of User----*/
function updateUserDetails(obj,e){
    e.preventDefault();
    $(obj).find('.msg').html('').css('display','none');
    $.ajax({
        url: FRONTAJAX,
        type: "POST",
        data: new FormData(obj),
        contentType: false,
        cache: false,
        processData:false,
        success:function(response){
            if(response.valid){
                $(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
                $(document).find('div.profile-img').find('img').attr('src', $(obj).find('.profile-img.preview-img').find('img').attr('src'));
                setTimeout(function(){$(obj).find('.profile-cancel-btn').trigger('click');},3000);
            }else
                $(obj).find('.msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something is wrong',2)).css('display','block');
            $(obj).find('.validate-form').text('Update'); 

            $('html, body').animate({
                  scrollTop: 0
              }, 500);       
        },
        error:function(response){
            $(obj).find('.validate-form').text('Update');
            $(obj).find('.msg').html(getMsg('Something is wrong',2)).css('display','block');
        }
    });
}

/*------chnage password of User----*/
function changeUserPassword(obj,e){
    e.preventDefault();
    $(obj).find('.msg').html('').css('display','none');
    $.ajax({
        url: FRONTAJAX,
        type: "POST",
        data: new FormData(obj),
        contentType: false,
        cache: false,
        processData:false,
        success:function(response){
            if(response.valid){
                $(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
              setTimeout(function(){(window.location.href=location.href);},1000);
            }else
                $(obj).find('.msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something is wrong',2)).css('display','block');

            $(obj).find('.validate-password').html('Change Password'); 
               
        },
        error:function(response){
            $(obj).find('.validate-password').html('Change Password');
            $(obj).find('.msg').html(getMsg('Something is wrong',2)).css('display','block');
        }
    });
}

/*------Create Order----*/
function createOrder(obj,e){
    e.preventDefault();
    let paymentMethod = $(obj).find('#paymentMethod').val();
    $(obj).find('.order-msg').html('').css('display','none');
    
    $.ajax({
        url: FRONTAJAX,
        type: "POST",
        data: new FormData(obj),
        contentType: false,
        cache: false,
        processData:false,
        success:function(response){
          if(response.valid){
              // paymentMethodSection.find('.'+paymentMethod).find('.create-order-btn').attr('disabled','disabled');
              let redirect = BASEURL+'/user/order';
              if(paymentMethod == 'payu'){
                let redirect = BASEURL+'/payu/create_payment/'+response.generatedId;
                window.location.href=redirect;
              }
              
              $(obj).find('.order-msg').html(getMsg(response.msg,1)).css('display','block');
              setTimeout(function(){window.location.href=redirect;},2000);
          }else
            $(obj).find('.order-msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something is wrong',2)).css('display','block');

          $(obj).find('.create-order-btn').html(paymentBtnText); 
          setTimeout(function(){$(obj).find('.order-msg').html('').css('display','none');},4000);  
        },
        error:function(response){
            $(obj).find('.create-order-btn').html(paymentBtnText);
            $(obj).find('.order-msg').html(getMsg('Something is wrong',2)).css('display','block'); 
          setTimeout(function(){$(obj).find('.order-msg').html('').css('display','none');},4000);  
        }
    });
}

/*-------- cancel Order -----------*/
function cancelOrder(obj, orderId) {
  var $tr = $(obj).closest('tr');
  var index = $tr.index();
  $tableobj=$('.table');
  $newindex=$tableobj.find('tbody tr:eq('+parseInt(index)+')').find('td:last').index();

  var action = "CallHandlerForActivatedRecord(" + orderId + "," + index + ");";
  action = '"' + action + '"';
  var msg='Are you sure want to cancel this order ?';
  var $div = "<div id='sb-containerDel'><div id='sb-wrapper' style='width:425px'><h1 style='font-size: 20.5px;'>"+msg+"</h1><p class=msg></p><hr/><table><tr class='confaction'><td><a href='javascript:void(0)' id='deleteyes' onclick=" + action + " class='btn btn-primary icon-btn'>"
  + "<i class='fa fa-fw fa-lg fa-check-circle'></i>Yes</a></td><td><a href='javascript:void(0)' onclick='RemoveDelConfirmDiv();' class='btn btn-default icon-btn fr'><i class='fa fa-fw fa-lg fa-times-circle'></i>No</a></td></tr></table></div></div>";
  $('body').append($div);
  $('#sb-containerDel').show('slow');
}
function CallHandlerForActivatedRecord(orderId,index) {
  $('#deleteyes').html('..Processing');
  var formData={action:"cancelOrder",orderId:orderId};
  $.ajax({
    url: FRONTAJAX,
    type: "POST",
    data: formData,
    success: function (response) {
      
      $obj=$('#sampleTable');
      $newindex=$obj.find('tbody tr:eq('+parseInt(index)+')').find('td:last').index();
      /*Change Status Text*/
      $objstatustxt=$obj.find('tbody tr:eq('+parseInt(index)+')').find('td:eq('+parseInt($newindex-1)+')');
      $objstatustxt.html('<span class="label label-danger">Cancelled</span>');
      /*Change Class*/
      $objlast=$obj.find('tbody tr:eq('+parseInt(index)+')').find('td:last').find('button:eq(0)').remove();
      if (response.valid) {
        $('#sb-containerDel').find('.msg').html(getMsg(response.msg,1)).css('display','block');
        setTimeout(function(){RemoveDelConfirmDiv();},2000);
      }else
        $('#sb-containerDel').find('.msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something is wrong',2)).css('display','block');
      $('#deleteyes').html('<i class="fa fa-fw fa-lg fa-check-circle"></i>Yes');      
       setTimeout(function(){$('#sb-containerDel').find('.msg').find('div.flipInX').fadeOut(500);},3000);
    },error(d){
      $('#sb-containerDel').find('.msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something is wrong',2)).css('display','block');
      $('#deleteyes').html('<i class="fa fa-fw fa-lg fa-check-circle"></i>Yes');
    }
  });
}


function removeWishlistItem(obj,wishlistId) {  

  var  $tr=$(obj).closest('div.cart-table-prd');
  $.ajax({
    url: FRONTAJAX,
    type: "POST",
    data: {action:"deleteRecord", tab:'wishlist', id:wishlistId},
    success: function (d) {
      $tr.remove();
      if($('div.cart-table.cart-table--wishlist').find('div.cart-table-prd').length == 0)
        window.location.reload();
    },
    error : function(d) {}
  });

}


function RemoveDelConfirmDiv() {
    $('#sb-containerDel').fadeOut(700);
    $('#sb-containerDel').remove();
}


/*-------- add review  -----------*/
function addReview(obj,e) {
  $(obj).find('.msg').html('');
    e.preventDefault();
    $.ajax({
      url:FRONTAJAX,
      method:'POST',
      data: new FormData(obj),
      contentType: false,
      cache: false,
      processData:false,
      success: function(response){
        if (response.valid) {
          $(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
          setTimeout(function(){
            location.reload();
            // ResetTextBox(obj);
            // $('#review-model').modal('hide');
          },3000);
        }else
          $(obj).find('.msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something is wrong',2)).css('display','block');     
         setTimeout(function(){$(obj).find('.msg').find('div.flipInX').fadeOut(500).html('');},3000);

        $(obj).find('.validate-review').html('Submit');
        },error(response){
        $(obj).find('.msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something is wrong',2)).css('display','block');
        $(obj).find('.validate-review').html('Submit');
        setTimeout(function(){$(obj).find('.msg').find('div.flipInX').fadeOut(500).html('');},3000);
      
      }
    });
}

/*-------- update Address  -----------*/
function updateAddress(obj,e) {
  $(obj).find('.msg').html('');
  e.preventDefault();
  $.ajax({
    url:FRONTAJAX,
    method:'POST',
    data: new FormData(obj),
    contentType: false,
    cache: false,
    processData:false,
    success: function(response){
      if (response.valid) {
        $(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
        // setTimeout(function(){
          if (response.isNew && response.addressId > 0) {
            var newAddress = '<form class="form-ad address-new" onsubmit="updateAddress(this, event)">'+$(obj).html()+'</form>';
            $(obj).closest('div.col-md-6').append(newAddress);
            $(obj).find('input[name="addressId"]').val(response.addressId);
            $(obj).find('div.del-ad').removeClass('hide').attr('onclick','delete_row(this,\'address\','+response.addressId+')');
            $(obj).find('button.validate-form').html('Update');
            $(obj).find('div.delivery-address-btn').attr('data-target','#delivery-form-'+response.addressId);
            $(obj).find('div.collapse.form-field-section').attr('id','delivery-form-'+response.addressId);
            $(obj).removeClass('address-new');
            var newObj = $(document).find('form.address-new');
            ResetTextBox(newObj);
            newObj.find('div.msg').html('');
            newObj.find('div.delivery-address-btn').trigger('click');
            newObj.find('button.validate-form').html('Submit');

          }

        $(obj).find('div.delivery-address-btn').text($(obj).find('input[name="addressName"]').val());
        $(obj).find('button.profile-cancel-btn').trigger('click');
        
        if ($(obj).hasClass('checkout-address-form')) {
          
          $(document).find('div.address-details ul').find('li:eq('+$('#chk-address-index').val()+')').html('<input type="radio" class="chk-select-address" id="addressId-'+$('#chk-addressId').val()+'" name="addressId" value="'+$('#chk-addressId').val()+'"> <label for="addressId-'+$('#chk-addressId').val()+'"><span>'+$('#chk-addressName').val()+' - '+$('#chk-name').val()+'</span>  '+$('#chk-mobile').val()+'</label> <button type="button" class="edit-btn pull-right" data-addressName="'+$('#chk-addressName').val()+'" data-name="'+$('#chk-name').val()+'" data-mobile="'+$('#chk-mobile').val()+'" data-address="'+$('#chk-address').val()+'" data-address2="'+$('#chk-address2').val()+'" data-city="'+$('#chk-city').val()+'" data-state="'+$('#chk-state').val()+'" data-country="'+$('#chk-country').val()+'" data-pincode="'+$('#chk-pincode').val()+'" data-lat="'+$('#chk-lat').val()+'" data-lang="'+$('#chk-lang').val()+'" onclick="showAddressModel(this, event,'+$('#chk-addressId').val()+')">Edit</button> <div class="delivery-detail"> <p>'+$('#chk-address').val()+' '+$('#chk-address2').val()+' '+$('#chk-city').val()+' '+$('#chk-pincode').val()+'</p> <button type="button" class="delivery-here-btn" onclick="deliverHere(this)">Delivery Here</button> </div>');

            $(obj).find('.validate-form').html('Update');
            $('#address-model').modal('hide');
        }
        // },2000);
      }else
        $(obj).find('.msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something is wrong',2)).css('display','block');

       setTimeout(function(){$(obj).find('.msg').find('div.flipInX').fadeOut(500).html('');},5000);
       $(obj).find('.validate-form').html(($(obj).find('input[name="addressId"]').val())?'Update':'Submit');
      
      },error(response){
        $(obj).find('.msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something is wrong',2)).css('display','block');
        $(obj).find('.validate-form').html(($(obj).find('input[name="addressId"]').val())?'Update':'Submit');
        setTimeout(function(){$(obj).find('.msg').find('div.flipInX').fadeOut(500).html('');},5000);
      
      }
  });
}

function setUserZone(zoneId, value){
  $('#currentCity').text(value).attr('zoneId',zoneId);
  $('#cityPopup').modal('hide');
  $.ajax({
      url: FRONTAJAX,
      data: {"action" : "setZone", "zone" : value, "zoneId" : zoneId},
      type: "POST",
      success: function(data){window.location.reload();}
  });
}

function addUpdateCart(obj, e) {
    e.preventDefault();
    $(obj).find('.msg').html('').css('display','none');
    $.ajax({
        url: FRONTAJAX,
        type: "POST",
        data: new FormData(obj),
        contentType: false,
        cache: false,
        processData:false,
        success:function(response){
          // debugger;
          // let actionbtn = $('#action-btn').val();
          if(response.valid){
              // if($('#action-btn').val() == 'buy-btn')
               window.location.href=BASEURL+'/cart';
              // $(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
              $('p.cart-info').text(response.cartItemsCount+' Items - ₹'+((response.cartGrandtotal)?Math.round(parseFloat(response.cartGrandtotal), 2):'0.00'));
          }else
              $(obj).find('.msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something is wrong',2)).css('display','block');

          $(obj).find('.btn-add-to-cart').html(orderBtnText); 
          $(obj).find('.buy-btn').html(btnBuy);
          $(obj).find('#giftpopup').modal('hide');

          setTimeout(function(){$(obj).find('.msg').html('').css('display','none');},5000);
                 
        },
        error:function(response){
          $(obj).find('.btn-add-to-cart').html(orderBtnText); 
          $(obj).find('.buy-btn').html(btnBuy); 
          $(obj).find('.msg').html(getMsg('Something is wrong',2)).css('display','block');
          setTimeout(function(){$(obj).find('.msg').html('').css('display','none');},5000);
        }
    });
}

function changeQty(obj, e, detailId, ptype='product'){

  e.preventDefault();
  let qty = $(obj).val();
  if (parseInt(qty) > 0) {
    $.ajax({
        url: FRONTAJAX,
        data: {"action" : "updateCart", "detailId" : detailId, "qty" : qty, "ptype" : ptype, "changeQty" : 1},
        type: "POST",
        success: function(response){
          if(response.valid){
            var amt = (response.cartGrandtotal)?Math.round(parseFloat(response.cartGrandtotal), 2):'0.00';
            $('p.cart-info').text(response.cartItemsCount+' Items - ₹'+amt);

          if ($(obj).closest('div.checkout-section').length){

            if (!parseInt(response.cartItemsCount))
              window.location.href = BASEURL+'/cart';
                     
            $(obj).closest('div.cart-section').find('h5.item-count').text(response.cartItemsCount+' items');
            $(obj).closest('div.cart-section').find('li.cart-total').text('Rs. '+response.cartTotal);
            // $(obj).closest('div.cart-section').find('li.order-total').text('Rs. '+response.cartTotal);
            $(obj).closest('div.cart-section').find('li.del-charge').text('Rs. '+response.deliveryChargeTotal);
            $(obj).closest('div.cart-section').find('li.total-payable').text('Rs. '+amt);

            
            debugger;
            if (parseInt(response.couponId)) {              
              $(document).find('.discount-amount').text('Rs -'+response.discount);
              $(document).find('.promo_discount1 h4').text(response.discount);
            }else{
              $('.coupan-applied-section').addClass('hide');
              $('.coupan-apply-section').removeClass('hide');
              $('div.list-price.applied-coupon-section').addClass('hide').html('');
            }
            
          }else{
            if(parseInt(response.qty) > 0){
              $(obj).val(response.qty).attr('qty',response.qty);
              $(obj).closest('tr.cart-item').find('.subtotal').text(response.subtotal);
              $('li.total-price').find('span').text(amt);
              $(obj).closest('table.cart-table').find('span.cart-item-count').text(parseInt(response.cartItemsCount));
            }
            if (!parseInt(response.cartItemsCount))
              window.location.reload();
          }
            
          }
          else
            $(obj).val($(obj).attr('qty'));
        },error(response){
          $(obj).val($(obj).attr('qty'));
        }
    });

  }else
    $(obj).val($(obj).attr('qty'));

}

function incDscQty(obj, e, btn = 'inc'){
  e.preventDefault();
  if ($(obj).closest('div.checkout-section').length)    
    var inpt = $(obj).closest('div.checkout-item').find('input.qty');
  else
    var inpt = $(obj).closest('tr.cart-item').find('input.qty');
  inpt.val((btn == 'inc')?(parseInt(inpt.val())+1):parseInt(inpt.val())-1).trigger('change');
  

}

function removeItem(obj, e, detailId, ptype='product'){
  $.ajax({
      url: FRONTAJAX,
      data: {"action" : "updateCart", "detailId" : detailId, "ptype" : ptype, "removeItem" : 1},
      type: "POST",
      success: function(response){

        if(response.valid){
            $(document).find('.my-cart-sub-total').text('₹ '+response.cartTotal);
            $(document).find('.my-cart-tax').text('₹ '+response.taxTotal);
            $(document).find('.my-cart-grand-total').text('₹ '+response.cartGrandtotal);
            $(document).find('.my-cart-item-count').text(response.cartItemsCount);
            $(document).find('.my-cart-item-'+detailId).remove();

            if (!parseInt(response.cartItemsCount))
              window.location.reload();
        }       
      },error(response){        
      }
  });
  
}
function updateCartMsg(obj, e){
  e.preventDefault();
  if($(obj).html()== 'Processing..')
    return false;
  var btnObj = $(obj);
  var btn = $(obj).html();
  $(obj).html('Processing..');
  $.ajax({
      url: FRONTAJAX,
      data: {"action" : "updateCart", "detailId" : $('#detailId').val(), "message" : $('#message').val(), "updateCartMsg" : 1},
      type: "POST",
      success: function(response){
        if(response.valid){
          $(obj).closest('form').find('.msg').html(getMsg(response.msg,1)).css('display','block');
          setTimeout(function(){window.location.reload();},2000);        
        }else
          $(obj).closest('form').find('.msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something is wrong',2)).css('display','block');
       setTimeout(function(){$(obj).closest('form').find('.msg').find('div.flipInX').fadeOut(500).html('');},5000);
       $(obj).html(btn);
      },error(response){

        $(obj).closest('form').find('.msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something is wrong',2)).css('display','block');
        $(obj).html(btn);
        setTimeout(function(){$(obj).closest('form').find('.msg').find('div.flipInX').fadeOut(500).html('');},5000);       
      }
  });
  
}


function applyCoupon(obj, e, couponId='') {
  $('.coupon-msg').html('').css('display','none');
  $.ajax({
    url: FRONTAJAX,
    data: {"action" : "applyCoupon", "couponId" : couponId, "coupon" : $('.coupon-input').val() },
    type: "POST",              
    success:function(response){

      $('.applyCoupon-btn').text('Apply');
      setTimeout(function(){$('.coupon-msg').html('').css('display','none');},5000);
      if (response.valid) {
        $(obj).text('Applied');
        $('div.list-price.applied-coupon-section').removeClass('hide').html('<ul> <li>Coupon- <b>'+((couponId)?$(obj).closest('.coupon-title').find('h2').text():$('.coupon-input').val())+'</b></li> <li class="discount-amount">Rs -'+response.discount+'</li> </ul>');

        $(obj).closest('div.cart-section').find('li.total-payable').text('Rs. '+response.cartGrandtotal);
        $('p.cart-info').text(response.cartItemsCount+' Items - ₹'+response.cartGrandtotal);
        $('.coupan-apply-section').addClass('hide');
        $('.coupan-applied-section').find('.promo_content b').text(response.appliedCouponCode);
        $('.coupan-applied-section').find('.promo_content span').text(response.appliedCouponMsg);
        $('.coupan-applied-section').find('.promo_discount1 h4').text(response.discount);
        $('.coupan-applied-section').removeClass('hide');

      }else
        $('.coupon-msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something went wrong.',2)).css('display','block');
    },
    error:function(response){
      $('.applyCoupon-btn').text('Apply');   
      $('.coupon-msg').html(getMsg('Something went wrong.',2)).css('display','block');
      setTimeout(function(){$('.coupon-msg').html('').css('display','none');},5000);
    }
  });
}

function removeAppliedCoupon(obj, e) {
  $('.coupon-msg').html('').css('display','none');
  $.ajax({
    url: FRONTAJAX,
    data: {"action" : "removeAppliedCoupon"},
    type: "POST",              
    success:function(response){

      if (response.valid) {
        $('.coupan-applied-section').addClass('hide');
        $('.coupan-apply-section').removeClass('hide');
        $('div.list-price.applied-coupon-section').addClass('hide').html('');

        var amt = (response.cartGrandtotal)?Math.round(parseFloat(response.cartGrandtotal), 2):'0.00';
        $('p.cart-info').text(response.cartItemsCount+' Items - ₹'+amt);
        $(obj).closest('div.cart-section').find('li.total-payable').text('Rs. '+amt);

      }else
        $('.coupon-msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something went wrong.',2)).css('display','block');
      

      $('.applyCoupon-btn').text('Apply');
      setTimeout(function(){$('.coupon-msg').html('').css('display','none');},5000);
    },
    error:function(response){  
      $('.applyCoupon-btn').text('Apply');   
      $('.coupon-msg').html(getMsg('Something went wrong.',2)).css('display','block');
      setTimeout(function(){$('.coupon-msg').html('').css('display','none');},5000);
    }
  });
}





function trackOrderCheck(btn, e) {
    e.preventDefault();
    let obj = $(btn).closest('form');
    $(obj).find('.msg').html('').css('display','none');
    let btnText = $(obj).find('.btn-track').text();
    if($(obj).find('.btn-track').text()=='Proccessing..')
      return false;
    $(obj).find('.btn-track').text('Proccessing..');
    $.ajax({
        url: BASEURL+'/track_order',
        type: "POST",
        data: {"checkOnly" : 1, "orderId" : $(obj).find('input[name=orderId]').val(), "email" : $(obj).find('input[name=email]').val()},
        success:function(response){
          if(response.valid){
            obj.submit();
            // window.location.href=BASEURL+'/track_order?'+response.generatedId;
          }else
              $(obj).find('.msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something is wrong',2)).css('display','block');

          $(obj).find('.btn-track').text(btnText); 
          setTimeout(function(){$(obj).find('.msg').html('').css('display','none');},5000);
                 
        },
        error:function(response){
          $(obj).find('.btn-track').text(btnText);
          $(obj).find('.msg').html(getMsg('Something is wrong',2)).css('display','block');
          setTimeout(function(){$(obj).find('.msg').html('').css('display','none');},5000);
        }
    });
}


// $('.main-banner-slider').flexslider({
//   animation: "slide",
//   controlNav: false,
//   autoplay: true
// });



/******** changes */


 // SLICK
 $('#product-slider__main').slick({
  asNavFor: '#product-slider__nav',
  rows: 0,
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  prevArrow: '<span class="slick-prev"><</span>',
  nextArrow: '<span class="slick-next">></span>',
  fade: true,
  adaptiveHeight: false,
  autoplay: false,
  autoplaySpeed: 4000
});

$('#product-slider__nav').slick({
  asNavFor: '#product-slider__main',
  slidesToShow: 4,
  slidesToScroll: 1,
  focusOnSelect: true,
  dots: false,
  arrows: false,
  vertical: true,
  verticalSwiping: true
});

// ZOOM
// if($('.zoom').length){
//   $('.zoom').zoom();

//   // STYLE GRAB
//   $('.zoom--grab').zoom({ on:'grab' });

//   // STYLE CLICK
//   $('.zoom--click').zoom({ on:'click' }); 

//   // STYLE TOGGLE
//   $('.zoom--toggle').zoom({ on:'toggle' });
//   $('#product-slider__main').slickLightbox({
//     itemSelector        : '.zoom img',
//     navigateByKeyboard  : true,
//     src: 'src',
//     lazy: true
//   });
// }



/* character count for cake msg */
$( document ).ready(function() {
  var maxChars = 30;
  var textLength = 0;
  var comment = "";
  var outOfChars = 'You have reached the limit of ' + maxChars + ' characters';

  /* initalize for when no data is in localStorage */
  var count = maxChars;
  $('#msg_cake_limit').text(count + ' characters left');

  function checkCount() {
    textLength = $('#msg_cake').val().length;
    if (textLength >= maxChars) {
      $('#msg_cake_limit').text(outOfChars);
    }
    else {
      count = maxChars - textLength;
      $('#msg_cake_limit').removeClass('hide').text(count + ' characters left');
    }
  }

  /* on keyUp: update #msg_cake_limit as well as count & comment in localStorage */
  $('#msg_cake').keyup(function() {
    checkCount();
    comment = $(this).val();
    localStorage.setItem("comment", comment);
  });

});

/* end character count for cake msg */



function getFrontPagehtml() {
    $.ajax({
        url: FRONTAJAX,
        type: "POST",
        data: {"action" : 'getFrontPagehtml'},
        success:function(response){          
             $(response.data).insertBefore('.social-statistics');
             resetProductSlider();
             getFrontFooterDescription();
                           
        },
        error:function(response){         
        }
    });
}

function getFrontFooterDescription() {

    $.ajax({
        url: FRONTAJAX,
        type: "POST",
        data: {"action" : 'getFrontFooterDescription'},
        success:function(response){       
          $(response.data).insertBefore('footer');
                           
        },
        error:function(response){         
        }
    });
}

function getFooterhtml() {


    $.ajax({
        url: FRONTAJAX,
        type: "POST",
        data: {"action" : 'getFrontFooterhtml'},
        success:function(response){       
          $(response.data).insertBefore('.footer-copyright');
                           
        },
        error:function(response){         
        }
    });
}



function resetProductSlider(){
   var owl = $(document).find('.owl-carousel');
              owl.owlCarousel({
                items: 4,
                loop: true,
                margin: 10,
                autoplay: true,
                autoplayTimeout: 1000,
                autoplayHoverPause: true
              });
              $(document).find('.play').on('click', function() {
                owl.trigger('play.owl.autoplay', [1000])
              });
              $(document).find('.stop').on('click', function() {
                owl.trigger('stop.owl.autoplay')
              });
  // $(document).find('.responsive-carousel1').slick({
  //   autoplay:true,
  //   dots: false,
  //   infinite: true,
  //   speed: 300,
  //   slidesToShow: 5,
  //   slidesToScroll: 1,
  //   responsive: [
  //   {
  //     breakpoint: 1300,
  //     settings: {
  //       slidesToShow: 5,
  //       slidesToScroll: 1,
  //       infinite: true,
  //       dots: false
  //     }
  //   },
  //   {
  //     breakpoint: 1024,
  //     settings: {
  //       slidesToShow: 4,
  //       slidesToScroll: 1,
  //       infinite: true,
  //       dots: false
  //     }
  //   },
  //   {
  //     breakpoint: 966,
  //     settings: {
  //       slidesToShow: 3,
  //       slidesToScroll: 1
  //     }
  //   },
  //   {
  //     breakpoint: 600,
  //     settings: {
  //       slidesToShow: 2,
  //       slidesToScroll: 1
  //     }
  //   },
  //   {
  //     breakpoint: 485,
  //     settings: {
  //       slidesToShow: 1,
  //       slidesToScroll: 1
  //     }
  //   }

  //   ]
  // });
  // $(document).find('.center-slider-front').slick({
  //   autoplay:true,  
  //   dots: true,
  //   infinite: true,
  //   speed: 300,
  //   slidesToShow: 3,
  //   slidesToScroll: 1,
  //   responsive: [
  //   {
  //     breakpoint: 1024,
  //     settings: {
  //       slidesToShow: 2,
  //       slidesToScroll: 1,
  //       infinite: true,
  //       dots: false
  //     }
  //   },
  //   {
  //     breakpoint: 600,
  //     settings: {
  //       slidesToShow: 2,
  //       slidesToScroll: 1
  //     }
  //   },
  //   {
  //     breakpoint: 485,
  //     settings: {
  //       slidesToShow: 1,
  //       slidesToScroll: 1
  //     }
  //   },
  //   ]
  // });
}


function showShareMomentModel(obj , e, orderId) {
  $('#shareMomentModel').find('input[name=orderId]').val(orderId);
}



function uploadSharedMoment(obj, e) {
    e.preventDefault();
    $(obj).find('.msg').html('').css('display','none');
    $.ajax({
        url: FRONTAJAX,
        type: "POST",
        data: new FormData(obj),
        contentType: false,
        cache: false,
        processData:false,
        success:function(response){
          if(response.valid){
              $(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
              setTimeout(function(){(window.location.href=location.href);},3000);           
          }else
              $(obj).find('.msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something is wrong',2)).css('display','block');

          $(obj).find('.validate-form').html('Submit');
          setTimeout(function(){$(obj).find('.msg').html('').css('display','none');},5000);
                 
        },
        error:function(response){
          $(obj).find('.validate-form').html('Submit'); 
          $(obj).find('.msg').html(getMsg('Something is wrong',2)).css('display','block');
          setTimeout(function(){$(obj).find('.msg').html('').css('display','none');},5000);
        }
    });
}



/*-------- View More Blog Comment --------*/
function viewMoreBlogComment(obj,e){
  
  e.preventDefault();
    //var formData={action:"viewMoreBlog"};
    var blogId = $('.blogIdmore').val();
    var countMsg = $(".blogComment").not('.blogComment-reply').length;
    $.ajax({
        url: FRONTAJAX,
        type: "POST",
        data: {"action":"viewMoreBlogComment","blogId":blogId,"countMsg":countMsg},
        
        success:function(response){
          
          if(response.data){
          $(response.data).insertBefore('.viewMoreBlogComment');
          if (parseInt(response.totalBlogComment) <= (parseInt(countMsg)+10));
            $('.viewMoreBlogComment').css('display','none');
          }
          else{
            $('.viewMoreBlogComment').css('display','none');
          }   
    }
  });
}

/*-------- View More Blog --------*/
function viewMoreReply(obj,e, replyId){
  
  e.preventDefault();
    //var formData={action:"viewMoreBlog"};
    var blogId = $('.blogIdmore').val();
    var countMsg = $(obj).closest(".reply-again").find('.blogComment').length;
    if(countMsg <=0 ){
      
      $(obj).closest('.reply-again').find('.viewMoreReply').css('display','none');
      return false;
    }
    $.ajax({
        url: FRONTAJAX,
        type: "POST",
        data: {"action":"viewMoreReply","blogId":blogId,"replyId":replyId,"countMsg":countMsg},
        
        success:function(response){
          
          if(response.data){
          //$(response.data).insertBefore('.viewMoreReply');
          $(response.data).insertBefore($(obj).closest('.reply-again').find('.viewMoreReply'));
          if (parseInt(response.totalReply) <= (parseInt(countMsg)+10))
            $(obj).closest('.reply-again').find('.viewMoreReply').css('display','none');

          }
          else{
            $(obj).closest('.reply-again').find('.viewMoreReply').css('display','none');
          }   
    }
  });
}

/*------check login of User----*/
function blogcheck(obj,e){

    e.preventDefault();
    $(obj).find('.msg').html('').css('display','none');
    var blogId = $('.blogId').val();
    var action = $('.action').val();
    var message = $('.message').val();
    var commentId = $('.commentId').val();
    var formData={action:action,blogId:blogId,message:message,commentId:commentId};
    $.ajax({
        url: FRONTAJAX,
        type: "POST",
        data: formData,
        
        success:function(response){
            if(response.valid){
              $(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
              $(obj).find('.message').val('');
            }else
              $(obj).find('.msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something is wrong',2)).css('display','block');   
             
            $(obj).find('.validate-blog').text('Submit');
            setTimeout(function(){ $(obj).find('.msg').html('').css('display','none');},5000); 
        },
        error:function(response){          
            $(obj).find('.validate-form').text('Submit');
            $(obj).find('.msg').html(getMsg('Something is wrong',2)).css('display','block');
            setTimeout(function(){ $(obj).find('.msg').html('').css('display','none');},5000); 
        }
    });
}


/*-------- Sending mail of fanchise equiry  -----------*/
function sendCorporateEnquiry(obj,e) {

  e.preventDefault();
  $(obj).find('.msg').html('').css('display','none');
  $.ajax({
    url:FRONTAJAX,
    method:'POST',
    data: new FormData(obj),
    contentType: false,
    cache: false,
    processData:false,
    success:function(response){

      if(response.valid){
        $(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
        ResetTextBox(obj);
        setTimeout(function(){window.location.reload(); },5000);
      }else
        $(obj).find('.msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something went wrong.',2)).css('display','block');
      
      $(obj).find('.validate-form').html('Submit');
      $(obj).find('input[name=name]').focus();
      setTimeout(function(){$(obj).find('.msg').html('').css('display','none'); },5000);
                     
    },
    error:function(response){

      $(obj).find('.validate-form').html('Submit');
      $(obj).find('.msg').html(getMsg('Something went wrong.',2)).css('display','block');
    }
  });
}

/*------get photo gallery----*/
function viewMorePhotoGalleryImages(obj,e){

  e.preventDefault();
  $('.viewMorePhotoGallery').text('Loading Images..'); 
  var imageCount = $('.photo-gallery-details').length;
  $.ajax({
    url: FRONTAJAX,
    type: "POST",
    data: {"action":"viewMorePhotoGalleryImages","imageCount":imageCount},
    success:function(response){
      $('.viewMorePhotoGallery').text('View More Images'); 
      if(response.valid){
        $('.photo-gallery-section').append(response.data);
      }
      if (parseInt(response.remainsCount) == 0)
        $('.viewMorePhotoGallery').addClass('hide');  
    }
  });
}

function submitTrackOrderForm(generatedId){
  var obj = $('#trackOrderModel');
  obj.find('input[name="orderId"]').val(generatedId);
  obj.find('form').submit();
}

function addRemoveFromWishlist(obj, e, productId){
  
  e.preventDefault();
  var variableId = $('#variableId').val();
  $.ajax({
    url: FRONTAJAX,
    type: "POST",
    data: {"action":"addRemoveFromWishlist", "productId":productId, "variableId":variableId},
    success:function(response){
      if(response.valid){
        if(response.wishlistId > 0)
          $(obj).addClass('active');
        else
          $(obj).removeClass('active');
        $(obj).data('wishlistid',response.wishlistId);
        $(obj).closest('form').find('.msg').html(getMsg(response.msg,1)).css('display','block');
      }else{
        if(response.notLoggedin)
          window.location=BASEURL+'/login';
        $(obj).closest('form').find('.msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something is wrong',2)).css('display','block');
      }
      
    },error:function(response){
      $(obj).closest('form').find('.msg').html(getMsg('Something is wrong',2)).css('display','block');
    },complete:function(response){
      setTimeout(function(){ $(obj).find('.msg').html('').css('display','none');},3000); 
    }
  });
}

function sendMe(obj, url){
  // debugger;
  var status = $(obj).attr('data-status');
  if($(obj).attr('data-status') == 0)
    $('.navbar-nav').find('a').attr('data-status','0');

  $(obj).attr('data-status',(( status == '1')?'0':'1') );
  var windowsize = $(window).width();

  $(window).resize(function() {
    var windowsize = $(window).width();
  });

  if (windowsize > 768 || $(obj).closest('li').find('.dropdown-navigate-list').length ==0 ) {
    window.location=url;
  }else{
    if($(obj).attr('data-status') == '0') {
        // $(obj).closest('li').toggle();
        // $(obj).closest('li').attr('style','');
        $(obj).closest('li').removeClass('show');
        $(obj).closest('li').find('.sm-menu').removeClass('show');
    }else{
        $(obj).closest('li').addClass('show');
        $(obj).closest('li').find('.sm-menu').addClass('show');
    }
      
      
  }
}

/*-------- update Address  -----------*/
function addUpdateAddress(obj,e) {
    $(obj).find('.msg').html('');
    e.preventDefault();
    $.ajax({
        url:FRONTAJAX,
        method:'POST',
        data: new FormData(obj),
        contentType: false,
        cache: false,
        processData:false,
        success: function(response){
            if (response.valid) {
                $(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
                setTimeout(function(){window.location.reload(); },2000);
            }else
            $(obj).find('.msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something is wrong',2)).css('display','block');

        },error(response){
            $(obj).find('.msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something is wrong',2)).css('display','block');
        },complete(response){

            $(obj).find('.validate-form').html(($(obj).find('input[name="addressId"]').val())?'Update':'Submit');
            setTimeout(function(){$(obj).find('.msg').find('div.flipInX').fadeOut(500).html('');},3000);

        }
    });
}

function checkLoggedIn(obj, e, paymentMethod) {
  if(!$(document).find('#userId').val())
    window.location.href=BASEURL+"/login?redirect="+document.location.toString()+'&p='+paymentMethod;
}




