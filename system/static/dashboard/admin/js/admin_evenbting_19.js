var DASHURL =  BASEURL+'/dashboard';

var DASHSTATIC =  BASEURL+'/system/static/dashboard';

$(document).ready(function(){
	GetDataOfThisPage();

	/**************** Product Section *****************/
	$(document).on('click', '.editCategory', function() {
		openpoploader();
		var categoryId = $(this).attr("data-id");
		if( categoryId < 1 ) {
			removepoploader();
			return false;
		}
		var baseurl=DASHURL+'/admin/commonajax';
		$.ajax({
			url: baseurl,
			type: "POST",
			data: {"action" : "gettabRecords", "tab" : "category", "key" : "categoryId", "value" : categoryId},
			success:function(response){
			 	removepoploader();  
			  	if( response.valid ) {
			  		$('.formarea').find('#categoryName').val(response.data.categoryName);
			  		$('.formarea').find('input[name=hiddenval]').val(response.data.categoryId);
			  		$('.formarea').find('#slugName').val(response.data.slug);
			  		$('.formarea').find('#metaTitle').val(response.data.metaTitle);
			  		$('.formarea').find('#metaDescription').val(response.data.metaDescription);
			  		$('.formarea').find('#description').val(response.data.description);
			  		$('.formarea').find('#metaKeywords').val(response.data.keywords);
			  		$('.formarea').find('#categoryName').val(response.data.categoryName);
			  		if( response.data.isNew == 1 )
			  			$('.formarea').find('#isNew').prop("checked", true);
			  		$('.formarea').find('.firstinput').focus();
			  	}
			},
			error:function(response){
			  removepoploader();
			}
		});
	});
	$(document).on('click', '.viewCategory', function() {
		openpoploader();
		var categoryId = $(this).attr("data-id");
		if( categoryId < 1 ) {
			removepoploader();
			return false;
		}
		var baseurl=DASHURL+'/admin/commonajax';
		$.ajax({
			url: baseurl,
			type: "POST",
			data: {"action" : "gettabRecords", "tab" : "category", "key" : "categoryId", "value" : categoryId},
			success:function(response){
			 	removepoploader();  
			  	if( response.valid ) {
			  		$('#viewTabModel').find('#viewCategoryName').text(response.data.categoryName);
			  		$('#viewTabModel').find('input[name=hiddentext]').text(response.data.categoryId);
			  		$('#viewTabModel').find('#viewMetaTitle').text(response.data.metaTitle);
			  		$('#viewTabModel').find('#viewMetaDescription').text(response.data.metaDescription);
			  		$('#viewTabModel').find('#viewDescription').text(response.data.description);
			  		$('#viewTabModel').find('#viewMetaKeywords').text(response.data.keywords);
			  		$('#viewTabModel').find('#viewcategoryName').text(response.data.categoryName);
			  		var isNewtext = ( response.data.isNew == 1 ) ? "Yes" : "No";
			  		$('#viewTabModel').find('#viewIsNew').text(isNewtext);
			  		$('#viewTabModel').modal('show');
			  	}
			},
			error:function(response){
			  removepoploader();
			}
		});
	});
	$(document).on('click', '.editSubCategory', function() {
		
		$('#addTabModel').modal('show');
		openpoploader();
		var subcategoryId = $(this).attr("data-id");
		if( subcategoryId < 1 ) {
			removepoploader();
			return false;
		}
		var baseurl=DASHURL+'/admin/commonajax';
		$.ajax({
			url: baseurl,
			type: "POST",
			data: {"action" : "gettabSubRecords", "tab" : "subcategory", "key" : "subcategoryId", "value" : subcategoryId},
			success:function(response){
				
			 	removepoploader();  
			  	if( response.valid ) {
			  		$('.formarea').find('#categoryName').val(response.data.categoryId);
			  		$('.formarea').find('#subCategoryName').val(response.data.subcategoryName);
			  		$('.formarea').find('input[name=hiddenval]').val(response.data.subcategoryId);
			  		$('.formarea').find('#slugName').val(response.data.slug);
			  		$('.formarea').find('#metaTitle').val(response.data.metaTitle);
			  		$('.formarea').find('#metaDescription').val(response.data.metaDescription);
			  		$('.formarea').find('#description').val(response.data.Description);
			  		$('.formarea').find('#metaKeywords').val(response.data.keywords);
			  		$('.formarea').find('#subcategoryName').val(response.data.subcategoryName);
			  		if( response.data.isNew == 1 )
			  			$('.formarea').find('#isNew').prop("checked", true);
			  		$('.formarea').find('.firstinput').focus();
			  	}
			},
			error:function(response){
			  removepoploader();
			}
		});
	});
	
	$(document).on('click', '.editSubCategoryItem', function() {

		$('#addTabModel').modal('show');
		openpoploader();
		var subcategoryItemId = $(this).attr("data-id");
		if( subcategoryItemId < 1 ) {
			removepoploader();
			return false;
		}
		var baseurl=DASHURL+'/admin/commonajax';
		$.ajax({
			url: baseurl,
			type: "POST",
			data: {"action" : "gettabSubItemRecords", "tab" : "subcategoryitem", "key" : "subcategoryItemId", "value" : subcategoryItemId},
			success:function(response){
			    	
			  	removepoploader();  
			  	if( response.valid ) {
			  		$('.formarea').find('#categoryName').html(response.data.categoryDropDown);
			  		$('.formarea').find('#subcategoryName').html(response.data.subCategoryDropDown);
			  		$('.formarea').find('#subcategoryItemName').val(response.data.info.subcategoryItemName);
			  		$('.formarea').find('input[name=hiddenval]').val(response.data.info.subcategoryItemId);
			  		$('.formarea').find('#slugName').val(response.data.info.slug);
			  		$('.formarea').find('#metaTitle').val(response.data.info.metaTitle);
			  		$('.formarea').find('#metaDescription').val(response.data.info.metaDescription);
			  		$('.formarea').find('#description').val(response.data.info.Description);
			  		$('.formarea').find('#metaKeywords').val(response.data.info.keywords);
			  		//$('.formarea').find('#subcategoryName').val(response.data.info.subcategoryItemName);
			  		if( response.data.info.isNew == 1 )
			  			$('.formarea').find('#isNew').prop("checked", true);
			  		$('.formarea').find('.firstinput').focus();
			  	}
			},
			error:function(response){
			  removepoploader();
			}
		});
	});
	$(document).on('change', '.categoryName', function() {
		
		  if($(this).val() == '') {
			$('#subcategoryName').html('<option value="">Choose Sub Category</option>');
			return false;
		  }
		  var formData = {action:'getsubcategoryName',categoryId:$(this).val()};
		  $.ajax({
			type: 'POST',
			url: DASHURL+'/admin/commonajax',
			data: formData,
			async :false,
			success: function(data){
				
			  if(data.length > 0 ){
				var optionHtml = '<option value="0">Choose Sub Category</option>';
				$(data).each(function(key,value){
					
					optionHtml += '<option value="'+value.subcategoryId+'">'+value.subcategoryName+'</option>';
				});
				$('#subcategoryName').html(optionHtml);
			  } 
			  else
				$('#subcategoryName').html('<option value="">Choose Sub Category</option>');

			},error:function(data){
			 
			}
		  });
	});
	$(document).on('click', '.addNewSubCategory', function(){
		ResetTextBox('#addTabModel');
		$('#addTabModel').find('input[name=hiddenval]').val('');
		$('#addTabModel').modal('show');
	});
	/******************* Variation Section*******************/
	$(document).on('click', '.addMoreVariations', function(){
		$('<div class="col-md-12 borderClass variationInfo"><div class="variationItems"><div class="form-group"><label for="variationTitle">Variation Title</label><input type="text" class="form-control"placeholder="Variation Title" name="variationTitle[]" required></div><div class="form-group col-md-6"><label for="actualPrice">Actual Price</label><input type="text" class="form-control" value="" name="variationActualPrice[]" onkeydown="OnlyNumericKey(event)" placeholder="Enter Product Actual Price" required></div><div class="form-group col-md-6"><label for="salePrice">Sale Price</label><input type="text" class="form-control" value="" name="variationSalePrice[]" onkeydown="OnlyNumericKey(event)" placeholder="Enter Product Sale Price" required></div><div class="clearfix"></div><div class="form-group"><label for="variationImages">Upload Image</label><input type="file" name="variationImages[]" value=""></div><div class="clearfix"></div></div><button class="btn btn-icons btn-rounded btn-light removeVariationItem pull-right" title="Remove" type="button"><i class="fa fa-times"></i></button></div>').insertBefore($(this));
	});
	$(document).on('click', '.removeVariationItem', function(){
		$(this).closest('.variationInfo').remove();
	});
	$(document).on('click', '.addMoreAttributes', function() {
		$('<div class="col-md-12 borderClass attributeInfo"> <div class="attributeItems"><div class="form-group"><label for="attributeHeading">Attribute Heading</label><input type="text" class="form-control"  placeholder="Attribute Heading" name="attributeHeading[]" ></div><div class="attributesOptionsSection"><div class="form-group col-md-6 nopadding"><label for="attributesOptions">Attributes Options</label><input type="text" class="form-control" value="" name="attributesOptions[]" placeholder="Enter Attributes Options" ></div><div class="form-group col-md-6"><label for="attributesPrice">Attributes Price</label><input type="text" class="form-control" value="" name="attributesPrice[]" placeholder="Enter Attributes Price" ></div><div class="clearfix"></div></div><button type="button" class="btn btn-success addMoreAttributesOptions pull-right"><i class="fa fa-plus"></i> Add More</button></div><button class="btn btn-icons btn-rounded btn-light removeAttributesItem pull-left" title="Remove" type="button"><i class="fa fa-times"></i></button></div>').insertBefore($(this));
		//$(".tagInputs").tagsinput({ });
	});
	$(document).on('click', '.addMoreAttributesOptions', function() {
		$('<div class="attributesOptionsSection"><div class="form-group col-md-6 nopadding"><label for="attributesOptions">Attributes Options</label><input type="text" class="form-control" value="" name="attributesOptions[]" placeholder="Enter Attributes Options" ></div><div class="form-group col-md-6"><label for="attributesPrice">Attributes Price</label><input type="text" class="form-control" value="" name="attributesPrice[]" placeholder="Enter Attributes Price" ></div><button type="button" class="btn btn-icons btn-rounded btn-light removeAttributesOptions pull-right"><i class="fa fa-times"></i></button><div class="clearfix"></div></div>').insertBefore($(this));
	});
	$(document).on('click', '.removeAttributesOptions', function() {
		$(this).closest('.attributesOptionsSection').remove();
	});
	$(document).on('click', '.removeAttributesItem', function() {
		$(this).closest('.attributeInfo').remove();
	});
	$(document).on('change', '.productType', function() {
		if( $(this).val() == 0 ) {
			$('.simpleProductSection').show();
			$('.simpleProductSection').find('input[type=text]').each(function(){
				$(this).prop('required', true);
			});
			$('.variationProductSection').find('input[type=text]').each(function(){
				$(this).prop('required', false);
			});
			$('.variationProductSection').hide();
		}
		else {
			$('.simpleProductSection').hide();
			$('.variationProductSection').show();
			$('.simpleProductSection').find('input[type=text]').each(function(){
				$(this).prop('required', false);
			});
			$('.variationProductSection').find('input[type=text]').each(function(){
				$(this).prop('required', true);
			});
		}
	});
	$(document).on('change', '.issameDayDelivery', function() {
		if( $(this).val() == 0 ) {
			$('.futureDayDelivery').show();
			$('#numberOfDaysRequired').prop('required', true);
		}
		else {
			$('.futureDayDelivery').hide();
			$('#numberOfDaysRequired').prop('required', false);
		}
	});
	$(document).on('change', '.isPhotoReq', function(){
		if($(this).prop("checked") == true) {
			$('.isPhotoReqInfo').show();
			$('#isPhotoReqInfo').prop("required", true);
		}
		else {
			$('.isPhotoReqInfo').hide();
			$('#isPhotoReqInfo').prop("required", false);
		}
	});
	$(document).on('change', '.deliveryCities', function() {
		if( $(this).val() == 1 ) {
			$('.specificCities').show();
			$('.excludedCities').hide();
			$('#specificCities').prop('required', true);
		}
		else {
			$('.specificCities').hide();
			$('.excludedCities').show();
			$('#specificCities').prop('required', false);
		}
	});
	$(document).on('click', '.addMoreImages', function(){
		$('<div class="col-md-3 imageSection"><input type="file"  value="" name="galleryImage[]"><button class="btn btn-icons btn-rounded btn-light removeImages pull-right" title="Remove" type="button"><i class="fa fa-times"></i></button></div>').insertBefore($(this));
	});
	$(document).on('click', '.removeImages', function(){
		$(this).closest('.imageSection').remove();
	});
	/******************* End Product Section ***************/
	/******************* Zone Section **********************/

	/**************** Zone Section *****************/
	$(document).on('click', '.editZone', function() {
		
		openpoploader();
		var zoneId = $(this).attr("data-id");
		if( zoneId < 1 ) {
			removepoploader();
			return false;
		}
		var baseurl=DASHURL+'/admin/commonajax';
		$.ajax({
			url: baseurl,
			type: "POST",
			data: {"action" : "gettabRecords", "tab" : "zone", "key" : "zoneId", "value" : zoneId},
			success:function(response){
				
			 	removepoploader();  
			  	if( response.valid ) {
			  		$('.formarea').find('#zoneName').val(response.data.zoneName);
			  		$('.formarea').find('input[name=hiddenval]').val(response.data.zoneId);
			  		$('.formarea').find('#zoneName').val(response.data.zoneName);
			  		$('.formarea').find('#slugName').val(response.data.slug);
			  		if(response.data.lastDeliveryTime != '')
			  			$('.formarea').find('#lastDeliveryTime').val(tConvert(response.data.lastDeliveryTime));
			  		if( response.data.isPopular == 1 )
			  			$('.formarea').find('#isPopular').prop("checked", true);
			  		$('.formarea').find('.firstinput').focus();
			  	}
			},
			error:function(response){
				
			  removepoploader();
			}
		});
	});

	$(document).on('click', '.addMoreSlots', function() {
		pincodeCount = parseInt(pincodeCount) + 1;
		var mainSection = $(this).closest('.deliverySection').attr("data-counter");
		var newTimeSlots = '<div class="slotsItems"><div class="form-group col-md-3"><label for="startTime">Start Time</label><input type="text" class="form-control timePicker"  placeholder="Start Time" name="startTime['+mainSection+']['+pincodeCount+']" required></div><div class="form-group col-md-3"><label for="endTime">End Time</label>  <input type="text" class="form-control timePicker"  placeholder="End Time" name="endTime['+mainSection+']['+pincodeCount+']" required></div><div class="form-group col-md-4"><label for="numberOfDelivery">Number of Delivery</label><input type="text" name="numberOfDelivery['+mainSection+']['+pincodeCount+']" class="form-control"  placeholder="Number of Delivery" onkeydown="OnlyNumericKey(event)" required></div><div class="form-group col-md-2"><button class="btn btn-icons btn-rounded btn-light removeSlotsItem" title="Remove" type="button"><i class="fa fa-times"></i></button></div><div class="clearfix"></div></div>';
		$(newTimeSlots).insertBefore($(this));
		$(".timePicker").datetimepicker({
	        format: "LT"
	    });
	    
	});
	$(document).on('click', '.removeSlotsItem', function(){
		$(this).closest('.slotsItems').remove();
	});
	$(document).on('click', '.addMoreDeliverySection', function() {
		deliveryCount = parseInt(deliveryCount) + 1;
		var newDeliverySection = '<div class="deliverySection" data-counter="'+deliveryCount+'"><div class="form-group col-md-6"><label for="deliveryType">Delivery Type</label><input type="email" class="form-control" id="deliveryType" placeholder="Delivery Type" name="deliveryType['+deliveryCount+']" required></div><div class="form-group col-md-6"><label for="deliveryAmount">Delivery Amount</label><input type="text" class="form-control" name="deliveryAmount['+deliveryCount+']" placeholder="Delivery Amount" required></div><div class="col-md-12 timeslotsSection"><div class="slotsItems"><div class="form-group col-md-3"><label for="startTime">Start Time</label><input type="text" class="form-control timePicker"  placeholder="Start Time" name="startTime['+deliveryCount+']['+pincodeCount+']" required></div><div class="form-group col-md-3"><label for="endTime">End Time</label>  <input type="text" class="form-control timePicker"  placeholder="End Time" name="endTime['+deliveryCount+']['+pincodeCount+']" required></div><div class="form-group col-md-4"><label for="numberOfDelivery">Number of Delivery</label><input type="text" name="numberOfDelivery['+deliveryCount+']['+pincodeCount+']" class="form-control"  placeholder="Number of Delivery" onkeydown="OnlyNumericKey(event)" required></div><div class="form-group col-md-2">&nbsp;</div><div class="clearfix"></div>  </div>  <button type="button" class="btn btn-success addMoreSlots"><i class="fa fa-plus"></i> Add More</button></div><button type="button" class="btn btn-success removeDeliverySection"><i class="fa fa-times"></i> Remove</button></div>';
		$(newDeliverySection).insertBefore($(this));
		$(".timePicker").datetimepicker({
	        format: "LT"
	    });
	    
	});
	
	$(document).on('click', '.removeDeliverySection', function() {
		$(this).closest('.deliverySection').remove();
	});
	/******************* End Zone Section ******************/
});
/***************** Product Section ***************************/
function validateCategory(obj, e){
	
	$(obj).find('.msg').html('');
	$(obj).find('.msg').css('display','none');
	var btnText = $(obj).find('.actionbtn').text().trim();
	if( btnText == "Processing..." )
		return false;
	$(obj).find('.actionbtn').text("Processing...");
	if( TextBoxValidation(obj) == false ) {
		$(obj).find('.actionbtn').text(btnText);
		return false;
	}
	if(validateSlug($(obj).find('input[name=slugName]').val()) == false ) {
		$(obj).find('input[name=slugName]').addClass("error");
        $(obj).find('input[name=slugName]').closest("div").find('label.error').length>0 ? "" : $(obj).find('input[name=slugName]').closest("div").append( '<label class="error text-danger">Invalid slug format!</label>');
		$(obj).find('input[name=slugName]').focus();
		$(obj).find('.actionbtn').text(btnText);
		return false;
	}
	else {
		$(obj).find('input[name=slugName]').removeClass("error");
		$(obj).find('input[name=slugName]').closest("div").find('label.error').remove();
	}
	e.preventDefault();
	var baseurl=DASHURL+'/admin/commonajax';
	$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			
		  $(obj).find('.msg').html(response.msg);
		  if(response.valid)
		    $(obj).find('.msg').css({'display':'block','color':'green'});
		  else
		    $(obj).find('.msg').css({'display':'block','color':'red'});
		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('html, body').animate({scrollTop:0}, 'slow');
		  $(obj).find(".firstinput").focus();
		  if(response.valid) {
			  setTimeout(function(){
			  	window.location.href = window.location.href;
			  }, 1000);	
		  }	  
		  
		},
		error:function(response){
			
		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('.msg').html("Something went wrong!");
		  $(obj).find('.msg').css({'display':'block','color':'red'});
		  $('html, body').animate({scrollTop:0}, 'slow');
		}
	});
}

function validateSubCategory(obj, e){
	
	$(obj).find('.msg').html('');
	$(obj).find('.msg').css('display','none');
	var btnText = $(obj).find('.actionbtn').text().trim();
	if( btnText == "Processing..." )
		return false;
	$(obj).find('.actionbtn').text("Processing...");
	if( TextBoxValidation(obj) == false ) {
		$(obj).find('.actionbtn').text(btnText);
		return false;
	}
	if(validateSlug($(obj).find('input[name=slugName]').val()) == false ) {
		$(obj).find('input[name=slugName]').addClass("error");
        $(obj).find('input[name=slugName]').closest("div").find('label.error').length>0 ? "" : $(obj).find('input[name=slugName]').closest("div").append( '<label class="error text-danger">Invalid slug format!</label>');
		$(obj).find('input[name=slugName]').focus();
		$(obj).find('.actionbtn').text(btnText);
		return false;
	}
	else {
		$(obj).find('input[name=slugName]').removeClass("error");
		$(obj).find('input[name=slugName]').closest("div").find('label.error').remove();
	}
	e.preventDefault();
	var baseurl=DASHURL+'/admin/commonajax';
	$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			
		  $(obj).find('.msg').html(response.msg);
		  if(response.valid)
		    $(obj).find('.msg').css({'display':'block','color':'green'});
		  else
		    $(obj).find('.msg').css({'display':'block','color':'red'});
		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('html, body').animate({scrollTop:0}, 'slow');
		  $(obj).find(".firstinput").focus();
		  if(response.valid) {
			  setTimeout(function(){
			  	window.location.href = window.location.href;
			  }, 1000);	
		  }	  
		  
		},
		error:function(response){
			
		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('.msg').html("Something went wrong!");
		  $(obj).find('.msg').css({'display':'block','color':'red'});
		  $('html, body').animate({scrollTop:0}, 'slow');
		}
	});
}

function validateSubCategoryItem(obj, e){
	
	$(obj).find('.msg').html('');
	$(obj).find('.msg').css('display','none');
	var btnText = $(obj).find('.actionbtn').text().trim();
	if( btnText == "Processing..." )
		return false;
	$(obj).find('.actionbtn').text("Processing...");
	if( TextBoxValidation(obj) == false ) {
		$(obj).find('.actionbtn').text(btnText);
		return false;
	}
	if(validateSlug($(obj).find('input[name=slugName]').val()) == false ) {
		$(obj).find('input[name=slugName]').addClass("error");
        $(obj).find('input[name=slugName]').closest("div").find('label.error').length>0 ? "" : $(obj).find('input[name=slugName]').closest("div").append( '<label class="error text-danger">Invalid slug format!</label>');
		$(obj).find('input[name=slugName]').focus();
		$(obj).find('.actionbtn').text(btnText);
		return false;
	}
	else {
		$(obj).find('input[name=slugName]').removeClass("error");
		$(obj).find('input[name=slugName]').closest("div").find('label.error').remove();
	}
	e.preventDefault();
	var baseurl=DASHURL+'/admin/commonajax';
	$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			
		  $(obj).find('.msg').html(response.msg);
		  if(response.valid)
		    $(obj).find('.msg').css({'display':'block','color':'green'});
		  else
		    $(obj).find('.msg').css({'display':'block','color':'red'});
		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('html, body').animate({scrollTop:0}, 'slow');
		  $(obj).find(".firstinput").focus();
		  if(response.valid) {
			  setTimeout(function(){
			  	window.location.href = window.location.href;
			  }, 1000);	
		  }	  
		  
		},
		error:function(response){
			
		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('.msg').html("Something went wrong!");
		  $(obj).find('.msg').css({'display':'block','color':'red'});
		  $('html, body').animate({scrollTop:0}, 'slow');
		}
	});
}
function validateProduct(obj, e) {
	e.preventDefault();
	$(obj).find('.msg').html('');
	$(obj).find('.msg').css('display','none');
	var btnText = $(obj).find('.actionbtn').text().trim();
	if( btnText == "Processing..." )
		return false;
	$(obj).find('.actionbtn').text("Processing...");
	if( TextBoxValidation(obj) == false ) {
		$(obj).find('.actionbtn').text(btnText);
		return false;
	}
	if(validateSlug($(obj).find('input[name=slugName]').val()) == false && $(obj).find('input[name=slugName]').val() != '') {
		$(obj).find('input[name=slugName]').addClass("error");
        $(obj).find('input[name=slugName]').closest("div").find('label.error').length>0 ? "" : $(obj).find('input[name=slugName]').closest("div").append( '<label class="error text-danger">Invalid slug format!</label>');
		$(obj).find('input[name=slugName]').focus();
		$(obj).find('.actionbtn').text(btnText);
		return false;
	}
	else {
		$(obj).find('input[name=slugName]').removeClass("error");
		$(obj).find('input[name=slugName]').closest("div").find('label.error').remove();
	}
	if($(obj).find('.mainCategory:checked').length == 0 && $(obj).find('.subCategory:checked').length == 0 && $(obj).find('.subCategoryItem:checked').length == 0) {
		$(obj).find('.categoryArea').find('label.error').length > 0 ? "" : $(obj).find('.categoryArea').append( '<label class="error text-danger">Choose Category!</label>');
		$(obj).find('.actionbtn').text(btnText);
		return false;
	}
	else
		$(obj).find('.categoryArea').remove();
	var baseurl=DASHURL+'/admin/commonajax';
	$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			
		  $(obj).find('.msg').html(response.msg);
		  if(response.valid)
		    $(obj).find('.msg').css({'display':'block','color':'green'});
		  else
		    $(obj).find('.msg').css({'display':'block','color':'red'});
		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('html, body').animate({scrollTop:0}, 'slow');
		  $(obj).find(".firstinput").focus();
		  if(response.valid) {
			  setTimeout(function(){
			  	window.location.href = DASHURL+'/admin/product';
			  }, 1000);	
		  }	  
		  
		},
		error:function(response){
			
		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('.msg').html("Something went wrong!");
		  $(obj).find('.msg').css({'display':'block','color':'red'});
		  $('html, body').animate({scrollTop:0}, 'slow');
		}
	});
	
}
function GetCategoryList(){

  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 20,

      "ajax":{

          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{'action' : 'getCategoryList' }

      },

      "columns": [

            {"data": "icons"},

            {"data": "categoryName"},

            {"data": "isNew"},            

            {"data": "status"},

            {"data": "action"},

         ],

         "order": [[1, 'desc']]



  });

}
function GetSubCategoryList(){

  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 20,

      "ajax":{

          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{'action' : 'getSubCategoryList' }

      },

      "columns": [

            {"data": "icons"},

            {"data": "subcategoryName"},

            {"data": "categoryName"},

            {"data": "isNew"},            

            {"data": "status"},

            {"data": "action"},

         ],

         "order": [[1, 'desc']]



  });

}
function GetSubCategoryItemList(){
    
  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 20,

      "ajax":{

          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{'action' : 'getSubCategoryItemList' }

      },

      "columns": [

            {"data": "icons"},
            
            {"data": "subcategoryItemName"},

            {"data": "subcategoryName"},

            {"data": "categoryName"},

            {"data": "isNew"},            

            {"data": "status"},

            {"data": "action"},

         ],

         "order": [[1, 'desc']]



  });

}
/***************** End Product Section ***************************/

/***************** Zone Section *********************************/

function validateZone(obj, e){
	$(obj).find('.msg').html('');
	$(obj).find('.msg').css('display','none');
	var btnText = $(obj).find('.actionbtn').text().trim();
	if( btnText == "Processing..." )
		return false;
	$(obj).find('.actionbtn').text("Processing...");
	if( TextBoxValidation(obj) == false ) {
		$(obj).find('.actionbtn').text(btnText);
		return false;
	}
		if(validateSlug($(obj).find('input[name=slugName]').val()) == false ) {
		$(obj).find('input[name=slugName]').addClass("error");
        $(obj).find('input[name=slugName]').closest("div").find('label.error').length>0 ? "" : $(obj).find('input[name=slugName]').closest("div").append( '<label class="error text-danger">Invalid slug format!</label>');
		$(obj).find('input[name=slugName]').focus();
		$(obj).find('.actionbtn').text(btnText);
		return false;
	}
	else {
		$(obj).find('input[name=slugName]').removeClass("error");
		$(obj).find('input[name=slugName]').closest("div").find('label.error').remove();
	}
	e.preventDefault();
	var baseurl=DASHURL+'/admin/commonajax';
	$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			
		  $(obj).find('.msg').html(response.msg);
		  if(response.valid)
		    $(obj).find('.msg').css({'display':'block','color':'green'});
		  else
		    $(obj).find('.msg').css({'display':'block','color':'red'});
		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('html, body').animate({scrollTop:0}, 'slow');
		  $(obj).find(".firstinput").focus();
		  if(response.valid) {
			  setTimeout(function(){
			  	window.location.href = window.location.href;
			  }, 1000);	
		  }	  
		  
		},
		error:function(response){
			
		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('.msg').html("Something went wrong!");
		  $(obj).find('.msg').css({'display':'block','color':'red'});
		  $('html, body').animate({scrollTop:0}, 'slow');
		}
	});
}

function validatePinCode(obj, e){
	$(obj).find('.msg').html('');
	$(obj).find('.msg').css('display','none');
	var btnText = $(obj).find('.actionbtn').text().trim();
	if( btnText == "Processing..." )
		return false;
	$(obj).find('.actionbtn').text("Processing...");
	if( TextBoxValidation(obj) == false ) {
		$(obj).find('.actionbtn').text(btnText);
		return false;
	}
	e.preventDefault();
	var baseurl=DASHURL+'/admin/commonajax';
	$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			
		  $(obj).find('.msg').html(response.msg);
		  if(response.valid)
		    $(obj).find('.msg').css({'display':'block','color':'green'});
		  else
		    $(obj).find('.msg').css({'display':'block','color':'red'});
		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('html, body').animate({scrollTop:0}, 'slow');
		  $(obj).find(".firstinput").focus();
		  if(response.valid) {
			  setTimeout(function(){
			  	window.location.href = window.location.href;
			  }, 1000);	
		  }	  
		  
		},
		error:function(response){			
		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('.msg').html("Something went wrong!");
		  $(obj).find('.msg').css({'display':'block','color':'red'});
		  $('html, body').animate({scrollTop:0}, 'slow');
		}
	});
}
function GetZoneList(){
 
  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 20,

      "ajax":{

          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{'action' : 'getZoneList' }

      },

      "columns": [

            {"data": "zoneName"},

            {"data": "isPopular"},            

            {"data": "noOfPincode"},

            {"data": "status"},

            {"data": "action"},

         ],

         "order": [[1, 'desc']]



  });

}
function GetPincodeList(){
	
	$('#tableDataList').DataTable({

      	"processing": true,

      	"serverSide": true,

      	"pageLength": 20,

      	"ajax":{

          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{'action' : 'getPinCodeList' }

       	},

      	"columns": [

            {"data": "zoneName"},

            {"data": "pincode"},

            {"data": "deliveryType"},  

            {"data": "status"},

            {"data": "action"},

        ],

        "order": [[1, 'desc']]
  });	
}

/***************** End Zone Section *****************************/

/************Calling function according to current page**********/

function GetDataOfThisPage() {

  var uriArray=returnUriArray();

  if($.inArray( "category", uriArray ) > -1 && $.inArray( "product", uriArray ) > -1)

    GetCategoryList();
  else if($.inArray("subcategory", uriArray) > -1 && $.inArray( "product",uriArray) > -1)
  	GetSubCategoryList();
  else if($.inArray("subcategoryitem",uriArray) > -1 && $.inArray("product",uriArray) > -1)
  	GetSubCategoryItemList();
  else if($.inArray( "zone", uriArray ) > -1 && $.inArray( "pincode", uriArray ) < 0 && $.inArray( "addpincode", uriArray ) < 0 )
    GetZoneList();
  else if($.inArray( "zone", uriArray ) > -1 && $.inArray( "pincode", uriArray ) > -1 )
    GetPincodeList();
}

/************ End Calling function according to current page**********/

/************ active deactive records **********/

function ActivateDeActivateThisRecord(obj, tableName,id) {

  var $tr = $(obj).closest('tr');

  var index = $tr.index();

  $newindex=$('.table').find('tbody tr:eq('+parseInt(index)+')').find('td:last').index();

  $status=$(obj).attr('data-status');

  $status=($status.trim()=='Active')?1:0;



  $msg=($status==1) ? "Do You Want To Make This As DeActive" : "Do You Want To Make This As Active";

  var action = "CallHandlerForActivatedRecord(" + id + "," + index + ",'" + tableName + "',"+$status+");";

    action = '"' + action + '"';

  

   var $div = "<div id='sb-containerDel'><div id='sb-wrapper' style='width:425px'><h1 style='font-size: 20.5px;'>"+$msg+"</h1><hr/><table><tr><td><a href='javascript:void(0)' id='deleteyes' onclick=" + action + " class='button'>Yes</a></td><td><a href='javascript:void(0)' onclick='RemoveDelConfirmDiv();' class='button_deact fr'>No</a></td></tr></table></div></div>";

    

    $('body').append($div);

    $('#sb-containerDel').show('slow');

}

function CallHandlerForActivatedRecord(id,index, tab,status) {

  $('#deleteyes').html("Processing");

  $.ajax({

    url: DASHURL+'/admin/commonajax', 

    type: "POST",

    data: {action:'changeStatus', id: id, tab: tab, status: status },

    dataType: "text",

    success: function (d) {

      // $('#deleteyes').html(d);

      $newindex=$('.table').find('tbody tr:eq('+parseInt(index)+')').find('td:last').index();

      /*Change Status Text*/

      $objstatustxt=$('.table').find('tbody tr:eq('+parseInt(index)+')').find('td:eq('+parseInt($newindex-1)+')');

      var statustxt=( status == 0 ) ? 'Active' : 'DeActive';      

      $objstatustxt.html(( status == 0 ) ? "Active" : "DeActive");

      /*Change Class*/

      $('.table').find('tbody tr:eq('+parseInt(index)+')').find('td:last').find('button').attr('data-status',statustxt);

      $objlast=$('.table').find('tbody tr:eq('+parseInt(index)+')').find('td:last').find('span:eq(0)');

      var statuscls=( status == 0 )? 'fa fa-circle' : 'fa fa-circle-o';

      $objlast.removeClass('class');

      $objlast.attr('class',statuscls);
      RemoveDelConfirmDiv();

    }

  });

}

/***************** End Active DeActive records ****************/
/*********************** Delete Records ***********************/

function delete_row(obj,tab,id){  

  var  $tr=$(obj).closest('tr');

  var index=$tr.index();

  var action = "CallHandlerForDeleteRecord(" + id + "," + index + ",'" + tab + "');";

      action = '"' + action + '"';

  var msg = "Are You Sure Want To Delete This Record";

  var $div = "<div id='sb-containerDel'><div id='sb-wrapper' style='width:425px'><h1 style='font-size: 20.5px;'>"+msg+"</h1><hr/><table><tr><td><a href='javascript:void(0)' id='deleteyes' onclick=" + action + " class='button'>Yes</a></td><td><a href='javascript:void(0)' onclick='RemoveDelConfirmDiv();' class='button_deact fr'>No</a></td></tr></table></div></div>";

    $('body').append($div);

    $('#sb-containerDel').show('slow');

}

function CallHandlerForDeleteRecord(id,index, tab) {

  $('#deleteyes').html("Processing");

  var formData={action:"deleteRecord",tab:tab,id:id};

  $.ajax({

    url: DASHURL+'/admin/commonajax',

    type: "POST",

    data: formData,

    success: function (d) {

      var $ntr = $('.table').find('tbody').find('tr:eq(' + index + ')');

      $ntr.remove();

      RemoveDelConfirmDiv();

    },
    error : function(d) {}

  });

}



/********************** End Delete Records ************************/

/********************** Time Convert ******************************/
function tConvert (time) {
  // Check correct time format and split into components
  time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];

  if (time.length > 1) { // If time format correct
    time = time.slice (1);  // Remove full string match value
    time[5] = +time[0] < 12 ? ' AM' : ' PM'; // Set AM/PM
    time[0] = +time[0] % 12 || 12; // Adjust hours
  }
  return time.join (''); // return adjusted time or original string
}