var DASHURL =  BASEURL+'/dashboard';

var DASHSTATIC =  BASEURL+'/system/static/dashboard';

var COMMONAJAX =DASHURL+'/admin/commonajax';

var currentAjax = 0 ;
var btnText = 'Submit';
$(document).ready(function(){
	GetDataOfThisPage();

	// setInterval(function () { if(currentAjax == 0) GetAdminNotification() } , 2000);

	  //validate Form with including inpute type email
	  $('.validate-form').unbind("click").click(function(e){
	    e.stopPropagation();
	    var btnText = $(this).html();
	    if($(this).html()=='<i class="fa fa-spinner fa-spin"></i>')
	      return false;
	    $(this).html('<i class="fa fa-spinner fa-spin"></i>');
	    var chk=0;
	    var obj=$(this).closest('form');
	    if(TextBoxValidation(obj)==false)
	      chk=1;
	    if(chk===1){
	      $(this).html(btnText);
	      return false;
	    }
	    obj.submit();
	  });

	/**************** Product Section *****************/
	$(document).on('click', '.editLensCategory', function() {
		openpoploader();
		var categoryId = $(this).attr("data-id");
		if( categoryId < 1 ) {
			removepoploader();
			return false;
		}
		currentAjax = 1 ;
		$.ajax({
			url: COMMONAJAX,
			type: "POST",
			data: {"action" : "gettabRecords", "tab" : "lens_category", "key" : "categoryId", "value" : categoryId},
			success:function(response){
				currentAjax = 0 ;
			 	removepoploader();  
			  	if( response.valid ) {
			  		
			  		$('.formarea').find('#categoryName').val(response.data.categoryName);
			  		$('.formarea').find('input[name=hiddenval]').val(response.data.categoryId);
			  		$('.formarea').find('#uploadIcons').next('div.previewimg').html((response.data.img)?'<img src="'+response.data.img+'" width="70px" height="50px">':'');
			  		$('.formarea').find('.firstinput').focus();
			  		$('#newFormModal').modal('show');
			  		$('#newFormModal').find('.newFormModalTitle').text('Update');
			  	}
			},
			error:function(response){
				currentAjax = 0 ;
			  	removepoploader();
			}
		});
	});
	$(document).on('click', '.editLens', function() {
		openpoploader();
		var lensId  = $(this).attr("data-id");
		if( lensId  < 1 ) {
			removepoploader();
			return false;
		}
		currentAjax = 1 ;
		$.ajax({
			url: COMMONAJAX,
			type: "POST",
			data: {"action" : "gettabRecords", "tab" : "lens", "key" : "lensId", "value" : lensId},
			success:function(response){
				currentAjax = 0 ;
			 	removepoploader();  
			  	if( response.valid ) {
			  		
			  		$('.formarea').find('#categoryId').val(response.data.categoryId);
			  		$('.formarea').find('#lensName').val(response.data.name);
			  		$('.formarea').find('input[name=hiddenval]').val(response.data.lensId);
			  		$('.formarea').find('#lensIndex').val(response.data.lensIndex);
			  		$('.formarea').find('#antiReflectiveCoating').val(response.data.antiReflectiveCoating);
			  		$('.formarea').find('#actualPrice').val(response.data.actualPrice);
			  		$('.formarea').find('#salePrice').val(response.data.salePrice);
			  		debugger;
			  		$('.formarea').find('#scratchResistant').prop('checked', (response.data.scratchResistant == "1")?true:false);
			  		$('.formarea').find('#waterDustRepellent').prop('checked', (response.data.waterDustRepellent == "1")?true:false);
			  		$('.formarea').find('#uv400Protection').prop('checked', (response.data.uv400Protection == "1")?true:false);
			  		$('.formarea').find('#blueLightBlocker').prop('checked', (response.data.blueLightBlocker == "1")?true:false);
			  		
			  		$('.formarea').find('.firstinput').focus();
			  		$('#newFormModal').modal('show');
			  		$('#newFormModal').find('.newFormModalTitle').text('Update');
			  	}
			},
			error:function(response){
				currentAjax = 0 ;
			  	removepoploader();
			}
		});
	});
	$(document).on('click', '.editCategory', function() {
		openpoploader();
		var categoryId = $(this).attr("data-id");
		if( categoryId < 1 ) {
			removepoploader();
			return false;
		}
		currentAjax = 1 ;
		$.ajax({
			url: COMMONAJAX,
			type: "POST",
			data: {"action" : "gettabRecords", "tab" : "category", "key" : "categoryId", "value" : categoryId},
			success:function(response){
				currentAjax = 0 ;
			 	removepoploader();  
			  	if( response.valid ) {
			  		
			  		$('.formarea').find('#categoryName').val(response.data.categoryName);
			  		$('.formarea').find('input[name=hiddenval]').val(response.data.categoryId);
			  		$('.formarea').find('#slugName').val(response.data.slug);
			  		$('.formarea').find('#metaTitle').val(response.data.metaTitle);
			  		$('.formarea').find('#metaDescription').val(response.data.metaDescription);
			  		$('.formarea').find('#description').html(response.data.description);
			  		$('.formarea').find('#aboutus').html(response.data.extraDescription);
			  		$('.formarea').find('div.note-editable.card-block').html(response.data.extraDescription);
			  		$('.formarea').find('#metaKeywords').val(response.data.keywords);
			  		$('.formarea').find('#categoryName').val(response.data.categoryName);
			  		$('.formarea').find('#uploadIcons').next('div.previewimg').html((response.data.img)?'<img src="'+response.data.img+'" width="70px" height="50px">':'');

			  		$('.formarea').find('#bannerDescription').val(response.data.bannerDescription);
			  		$('.formarea').find('#bannerTitle').val(response.data.bannerTitle);
			  		$('.formarea').find('#bannerImg').next('div.previewimg').html((response.data.bannerImg)?'<img src="'+UPLOADPATH+'/category_images/'+response.data.bannerImg+'" width="70px" height="50px">':'');

			  		if( response.data.isNew == 1 )
			  			$('.formarea').find('#isNew').prop("checked", true);
			  		$('.formarea').find('.firstinput').focus();

			  		$('#newFormModal').modal('show');
			  		$('#newFormModal').find('.newFormModalTitle').text('Update');
			  	}
			},
			error:function(response){
				currentAjax = 0 ;
			  	removepoploader();
			}
		});
	});

	// $(document).on('shown','#viewTabModel', function() {
	// 	debugger;
	// 	if($('#aboutus').length)
 //  			$('#aboutus').summernote();
	// });
	// $('#myModal').on('shown.bs.modal', function() {
	//   	$('#summernote').summernote();
	// })
	$(document).on('click', '.viewCategory', function() {
		openpoploader();
		var categoryId = $(this).attr("data-id");
		if( categoryId < 1 ) {
			removepoploader();
			return false;
		}
		
		currentAjax = 1 ;
		$.ajax({
			url: COMMONAJAX,
			type: "POST",
			data: {"action" : "gettabRecords", "tab" : "category", "key" : "categoryId", "value" : categoryId},
			success:function(response){
				currentAjax = 0 ;
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
				currentAjax = 0 ;
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
		
		currentAjax = 1 ;
		$.ajax({
			url: COMMONAJAX,
			type: "POST",
			data: {"action" : "gettabSubRecords", "tab" : "subcategory", "key" : "subcategoryId", "value" : subcategoryId},
			success:function(response){
				currentAjax = 0 ;
				
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
			  		$('.formarea').find('#uploadIcons').next('div.previewimg').html((response.data.img)?'<img src="'+response.data.img+'" width="70px" height="50px">':'');

			  		$('.formarea').find('#aboutus').html(response.data.extraDescription);
			  		$('.formarea').find('div.note-editable.card-block').html(response.data.extraDescription);
			  		$('.formarea').find('#bannerDescription').val(response.data.bannerDescription);
			  		$('.formarea').find('#bannerTitle').val(response.data.bannerTitle);
			  		$('.formarea').find('#bannerImg').next('div.previewimg').html((response.data.bannerImg)?'<img src="'+UPLOADPATH+'/category_images/'+response.data.bannerImg+'" width="70px" height="50px">':'');

			  		if( response.data.isNew == 1 )
			  			$('.formarea').find('#isNew').prop("checked", true);
			  		$('.formarea').find('.firstinput').focus();
			  	}
			},
			error:function(response){
				currentAjax = 0 ;				
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
		
		currentAjax = 1 ;
		$.ajax({
			url: COMMONAJAX,
			type: "POST",
			data: {"action" : "gettabSubItemRecords", "tab" : "subcategoryitem", "key" : "subcategoryItemId", "value" : subcategoryItemId},
			success:function(response){
				currentAjax = 0 ;
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
			  		$('.formarea').find('#uploadIcons').next('div.previewimg').html((response.data.info.img)?'<img src="'+response.data.info.img+'" width="70px" height="50px">':'');

			  		$('.formarea').find('#aboutus').html(response.data.info.extraDescription);
			  		$('.formarea').find('div.note-editable.card-block').html(response.data.info.extraDescription);
			  		$('.formarea').find('#bannerDescription').val(response.data.info.bannerDescription);
			  		$('.formarea').find('#bannerTitle').val(response.data.info.bannerTitle);
			  		$('.formarea').find('#bannerImg').next('div.previewimg').html((response.data.info.bannerImg)?'<img src="'+UPLOADPATH+'/category_images/'+response.data.info.bannerImg+'" width="70px" height="50px">':'');
			  		
			  		if( response.data.info.isNew == 1 )
			  			$('.formarea').find('#isNew').prop("checked", true);
			  		$('.formarea').find('.firstinput').focus();
			  	}
			},
			error:function(response){
				currentAjax = 0 ;
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
			currentAjax = 1 ;
		  $.ajax({
			type: 'POST',
			url: DASHURL+'/admin/commonajax',
			data: formData,
			async :false,
			success: function(data){
				currentAjax = 0 ;
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
				currentAjax = 0 ;
			}
		  });
	});
	$(document).on('click', '.addNewSubCategory, .addNewAttributeOption', function(){
		ResetTextBox('#addTabModel');
		$('#addTabModel').find('input[name=hiddenval]').val('');
		$('#addTabModel').modal('show');
	});

	/******************* Zone Section **********************/

	/**************** Zone Section *****************/
	$(document).on('click', '.newFormModalBtn', function() {
		ResetTextBox("#newFormModal");
		$("#newFormModal").find('.previewimg').html('');
		$('#newFormModal').find('.newFormModalTitle').text('Add New');
	});

	$(document).on('click', '.editZone', function() {
		
		openpoploader();
		var zoneId = $(this).attr("data-id");
		if( zoneId < 1 ) {
			removepoploader();
			return false;
		}
		currentAjax = 1 ;
		$.ajax({
			url: COMMONAJAX,
			type: "POST",
			data: {"action" : "gettabRecords", "tab" : "zone", "key" : "zoneId", "value" : zoneId},
			success:function(response){
				currentAjax = 0 ;
			 	removepoploader();  
			  	if( response.valid ) {
			  		$('.formarea').find('#zoneName').val(response.data.zoneName);
			  		$('.formarea').find('input[name=hiddenval]').val(response.data.zoneId);
			  		$('.formarea').find('#zoneName').val(response.data.zoneName);
			  		$('.formarea').find('#slugName').val(response.data.slug);
			  		$('.formarea').find('#uploadIcons').next('div.previewimg').html((response.data.img)?'<img src="'+response.data.img+'" width="70px" height="50px">':'');
			  		$('.formarea').find('#lastDeliveryTime option:selected').removeAttr('selected');
			  		$('.formarea').find('#lastDeliveryTime option[value="'+response.data.lastDeliveryTime+'"]').attr('selected','selected');
			  		if( response.data.isPopular == 1 )
			  			$('.formarea').find('#isPopular').prop("checked", true);
			  		$('.formarea').find('.firstinput').focus();
			  		$('#newFormModal').modal('show');
			  		$('#newFormModal').find('.newFormModalTitle').text('Update');
			  	}
			},
			error:function(response){
				currentAjax = 0 ;
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
		var newDeliverySection = '<div class="deliverySection" data-counter="'+deliveryCount+'"><div class="form-group col-md-6"><label for="deliveryType">Delivery Type</label><input type="email" class="form-control" id="deliveryType" placeholder="Delivery Type" name="deliveryType['+deliveryCount+']" required></div><div class="form-group col-md-6"><label for="deliveryAmount">Delivery Amount</label><input type="text" class="form-control" onkeypress="return OnlyFloat()" name="deliveryAmount['+deliveryCount+']" placeholder="Delivery Amount" required></div><div class="col-md-12 timeslotsSection"><div class="slotsItems"><div class="form-group col-md-3"><label for="startTime">Start Time</label><input type="text" class="form-control timePicker"  placeholder="Start Time" name="startTime['+deliveryCount+']['+pincodeCount+']" required></div><div class="form-group col-md-3"><label for="endTime">End Time</label>  <input type="text" class="form-control timePicker"  placeholder="End Time" name="endTime['+deliveryCount+']['+pincodeCount+']" required></div><div class="form-group col-md-4"><label for="numberOfDelivery">Number of Delivery</label><input type="text" name="numberOfDelivery['+deliveryCount+']['+pincodeCount+']" class="form-control"  placeholder="Number of Delivery" onkeydown="OnlyNumericKey(event)" required></div><div class="form-group col-md-2">&nbsp;</div><div class="clearfix"></div>  </div>  <button type="button" class="btn btn-success addMoreSlots"><i class="fa fa-plus"></i> Add More</button></div><button type="button" class="btn btn-success removeDeliverySection"><i class="fa fa-times"></i> Remove</button></div>';
		$(newDeliverySection).insertBefore($(this));
		$(".timePicker").datetimepicker({
	        format: "LT"
	    });
	    
	});
	
	$(document).on('click', '.removeDeliverySection', function() {
		$(this).closest('.deliverySection').remove();
	});
	$(document).on('change', '.bindconditionGroup', function() {
		if($(this).val() != '')
			$('.copyDeliveryInformation').show();
		else
			$('.copyDeliveryInformation').hide();
	});
	$(document).on('click', '.copyDeliveryInformation', function(e){

		if($('.bindconditionGroup').val() == '')
			return false;
		e.preventDefault();
		currentAjax = 1 ;
		$.ajax({
			url: COMMONAJAX,
			type: "POST",
			data: { action : "copyZoneDelivery", zoneId : $('.bindconditionGroup').val() },			
			success:function(response){
				currentAjax = 0 ;
				deliveryCount = response.data.countDelivery;
				pincodeCount = response.data.countTimeSlots;
				$('.deliverySectionArea').html(response.data.deliverySectionHtml);
			},
			error:function(response){
				currentAjax = 0 ;
			}
		});

	});
	/******************* End Zone Section ******************/



  	$('.validate-change-password').on('click', function(){

		if($(this).find('span').html()=='<i class="fa fa-spinner fa-spin"></i>')
			return false;
      	var btnObj = $(this);
      	var btn = $(this).find('span.btntext').text();
		$(this).find('span').html('<i class="fa fa-spinner fa-spin"></i>');
      	var chk=0;
      	var obj=$(this).closest('form');
      	if( TextBoxValidation(obj) === false){
          	obj.find('.error:eq(0)').focus();
          	chk=1;      
      	}
        obj.find('input[type=password]').not("input[name='form_current_password']").each(function () {
        
          	if (!validatePassword($(this).val())) {     
             	$(this).addClass("error");
              	($(this).closest("div").find('label.error').length>0)?"":$(this).closest("div").append('<label class="error text-danger">Password must contain at least 8 characters including one lowercase letter, one uppercase letter, one numeric digit, and one special character.</label>');
               	chk = 1;
          	}else{
              	if(!$(this).hasClass('more_error')){            
                  	$(this).removeClass("error");
                  	$(this).closest("div").find('label.error').remove();
              	}
          	}
      	});

      	if(chk == 0){
          	if(obj.find('#form_password_1').val() != obj.find('#form_password_2').val()){
              	var pasObj = ('#form_password_2');
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

       	if(chk===1){
       		btnObj.find('span.btntext').text(btn);
            return false;
        }else
          obj.submit();
      
  	});
});

function GetAdminNotification() {


  currentAjax = 1;

  $.ajax({

    type: "POST",

    url: COMMONAJAX,

    data: {action : "getAdminNotification"},

    success: function (response) {
      	currentAjax = 0;

      	if( parseInt(response.totalRows) > 0 ){
          	var notificationhtml='<a class="dropdown-item" href="'+DASHURL+'/admin/notification/notificationlist"> <p class="mb-0 font-weight-normal float-left">You have '+response.totalRows+' new notifications </p> <span class="badge badge-pill badge-warning float-right">View all</span> </a><div class="dropdown-divider"></div>';
			$('.notification-bell').find('span.count').text(response.totalRows);
			$('.notification-bell').find('.dropdown-menu-right').removeClass('hide').html(notificationhtml+response.notificationHtml);

      	}else{
      		$('.notification-bell').find('span.count').text('0');
      		$('.notification-bell').find('.dropdown-menu-right').addClass('hide');
      	}

    }, error: function(data){
		currentAjax = 0 ;

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

/***************** Product Section ***************************/
function validateLens(obj, e){
	
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
	
		currentAjax = 1 ;
		$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
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
			currentAjax = 0 ;
			
		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('.msg').html("Something went wrong!");
		  $(obj).find('.msg').css({'display':'block','color':'red'});
		  $('html, body').animate({scrollTop:0}, 'slow');
		}
	});
}
function validateBrand(obj, e){
	
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
	
		currentAjax = 1 ;
		$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
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
			currentAjax = 0 ;
			
		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('.msg').html("Something went wrong!");
		  $(obj).find('.msg').css({'display':'block','color':'red'});
		  $('html, body').animate({scrollTop:0}, 'slow');
		}
	});
}
function validateAttribute(obj, e){
	
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
	
		currentAjax = 1 ;
		$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
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
			currentAjax = 0 ;
			
		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('.msg').html("Something went wrong!");
		  $(obj).find('.msg').css({'display':'block','color':'red'});
		  $('html, body').animate({scrollTop:0}, 'slow');
		}
	});
}

function validateAttributeOption(obj, e){
        	
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
	
		currentAjax = 1 ;
		$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
			
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
			currentAjax = 0 ;
			
		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('.msg').html("Something went wrong!");
		  $(obj).find('.msg').css({'display':'block','color':'red'});
		  $('html, body').animate({scrollTop:0}, 'slow');
		}
	});
}



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
	if(validateSlug($(obj).find('input[name=slugName]').val()) == false &&  $(obj).find('input[name=slugName]').val() != '') {
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
	
		currentAjax = 1 ;
		$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
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
			currentAjax = 0 ;
			
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
	e.preventDefault();
	var baseurl=DASHURL+'/admin/commonajax';
	
		currentAjax = 1 ;
		$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
			
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
			currentAjax = 0 ;
			
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
	if(validateSlug($(obj).find('input[name=slugName]').val()) == false &&  $(obj).find('input[name=slugName]').val() != '') {
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
	
		currentAjax = 1 ;
		$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
			
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
			currentAjax = 0 ;
			
		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('.msg').html("Something went wrong!");
		  $(obj).find('.msg').css({'display':'block','color':'red'});
		  $('html, body').animate({scrollTop:0}, 'slow');
		}
	});
}
function validateProduct(obj, e) {
	//e.preventDefault();
	$(obj).find('.msg').html('');
	$(obj).find('.msg').css('display','none');
	var btnText = $(obj).find('.actionbtn').text().trim();
	if( btnText == "Processing..." )
		return false;
	$(obj).find('.actionbtn').text("Processing...");
	if( TextBoxValidation(obj) == false ) {
		$(obj).find('.actionbtn').text(btnText);
		$('html, body').animate({scrollTop: $("label.error:eq(0)").offset().top-150 }, 1000);
		return false;
	}
	if(validateSlug($(obj).find('input[name=slugName]').val()) == false && $(obj).find('input[name=slugName]').val() != '') {
		$(obj).find('input[name=slugName]').addClass("error");
        $(obj).find('input[name=slugName]').closest("div").find('label.error').length>0 ? "" : $(obj).find('input[name=slugName]').closest("div").append( '<label class="error text-danger">Invalid slug format!</label>');
		$(obj).find('input[name=slugName]').focus();
		$(obj).find('.actionbtn').text(btnText);
		$('html, body').animate({scrollTop: $("label.error:eq(0)").offset().top-150 }, 1000);
		return false;
	}
	else {
		$(obj).find('input[name=slugName]').removeClass("error");
		$(obj).find('input[name=slugName]').closest("div").find('label.error').remove();
	}
	if($(obj).find('.category-checkbox:checked').length == 0 && $(obj).find('.subcategory-checkbox:checked').length == 0 && $(obj).find('.subcategoryItem-checkbox:checked').length == 0) {
		$(obj).find('.categoryArea').find('label.error').length > 0 ? "" : $(obj).find('.categoryArea').append( '<label class="error text-danger">Choose Category!</label>');
		$(obj).find('.actionbtn').text(btnText);
		$('html, body').animate({scrollTop: $("label.error:eq(0)").offset().top-150 }, 1000);
		return false;
	}
	else
		$(obj).find('.categoryArea').find('label.error').remove();

	// if($("input[name='issameDayDelivery']:checked"). val() == 0) {
	// 	if ($('#minDayReqtoDeliver').val() > 0)			
	// 		$(obj).find('div.futureDayDelivery').find('label.error').remove();
	// 	else{

	// 		$(obj).find('div.futureDayDelivery').find('label.error').length > 0 ? "" : $(obj).find('div.futureDayDelivery').append( '<label class="error text-danger">Day should be greater than 0.</label>');
	// 		$(obj).find('.actionbtn').text(btnText);
	// 		$(obj).find('#minDayReqtoDeliver').focus();
	// 		return false;
	// 	}

	// }else{

	// 	if ($('#minHourReqtoDeliver').val() == 0 && $('#minMinuteReqtoDeliver').val() == 0)
	// 	{

	// 		$(obj).find('div.futureTimeDelivery:last').find('label.error').length > 0 ? "" : $(obj).find('div.futureTimeDelivery:last').append( '<label class="error text-danger">Time should be greater than 0.</label>');
	// 		$(obj).find('.actionbtn').text(btnText);
	// 		$(obj).find('#minHourReqtoDeliver').focus();
	// 		return false;
	// 	}else
	// 		$(obj).find('div.futureTimeDelivery:last').find('label.error').remove();
	// }
	if(parseFloat($('#actualPrice').val()) < parseFloat($('#salePrice').val())){

		$(obj).find('div.salePrice').find('label.error').length > 0 ? "" : $(obj).find('div.salePrice').append( '<label class="error text-danger">Sale Price should be less than or equal to actual price.</label>');
		$(obj).find('.actionbtn').text(btnText);
		$(obj).find('#salePrice').focus();
		$('html, body').animate({scrollTop: $("label.error:eq(0)").offset().top-150 }, 1000);
		return false;
	}else
		$(obj).find('div.salePrice').find('label.error').remove();

	var baseurl=DASHURL+'/admin/commonajax';
	
		currentAjax = 1 ;
		$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
		  $(obj).unbind('submit');
		  $(obj).find('.msg').html(response.msg);
		  if(response.valid)
		    $(obj).find('.msg').css({'display':'block','color':'green'});
		  else
		    $(obj).find('.msg').css({'display':'block','color':'red'});
		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('html, body').animate({scrollTop:0}, 'slow');
		  $(obj).find(".firstinput").focus();
		  if(response.valid) {
			  // setTimeout(function(){
			  // 	window.location.href = DASHURL+'/admin/product';
			  // }, 1000);	
			  setTimeout(function(){
			  	window.location.href = window.location.href;
			  }, 1000);	
		  }	  
		  
		},
		error:function(response){
		currentAjax = 0 ;			
		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('.msg').html("Something went wrong!");
		  $(obj).find('.msg').css({'display':'block','color':'red'});
		  $('html, body').animate({scrollTop:0}, 'slow');
		}
	});
	return false;
	
}

function GetLensCategoryList(){

  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{

          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{'action' : 'getLensCategoryList' }

      },

      "columns": [

            {"data": "icons"},

            {"data": "categoryName"},           

            {"data": "status"},

            {"data": "action"},

         ],

         "order": [[0, 'desc']]



  });

}
function GetLensList(){

  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{

          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{'action' : 'getLensList' }

      },

      "columns": [

            {"data": "name"},           

            {"data": "price"},           

            {"data": "categoryId"},          

            {"data": "status"},

            {"data": "action"},

         ],

         "order": [[4, 'desc']]



  });

}
function GetBrandList(){

  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{

          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{'action' : 'getBrandList' }

      },

      "columns": [

            {"data": "brandName"},           

            {"data": "status"},

            {"data": "action"},

         ],

         "order": [[2, 'desc']]



  });

}
function GetShapeList(){

  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{

          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{'action' : 'getShapeList' }

      },

      "columns": [

            {"data": "shapeName"},           

            {"data": "status"},

            {"data": "action"},

         ],

         "order": [[2, 'desc']]



  });

}
function GetAttributeList(){

  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{

          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{'action' : 'getAttributeList' }

      },

      "columns": [

            {"data": "attributeName"},           

            {"data": "status"},

            {"data": "action"},

         ],

         "order": [[2, 'desc']]



  });

}
function GetAttributeOptionList(){

  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{

          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{'action' : 'getAttributeOptionList' }

      },

      "columns": [

            {"data": "name"},

            {"data": "attributeName"},           

            {"data": "status"},

            {"data": "action"},

         ],

         "order": [[3, 'desc']]



  });

}
function GetCategoryList(){

  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

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

         "order": [[0, 'desc']]



  });

}
function GetSubCategoryList(){

  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

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

         "order": [[0, 'desc']]



  });

}
function GetSubCategoryItemList(){
    
  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

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

         "order": [[0, 'desc']]



  });

}
function GetProductList(){
    
  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{
             
          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{"action" : "getProductList" }

      },
          
      "columns": [
            
            {"data": "sku"},
            
            {"data": "icons"},
            
            {"data": "productName"},

            {"data": "category", "className": "width200"},

            {"data": "price"},

            {"data": "action"},

         ],

         "order": [[1, 'desc']]



  });

}
function GetTodaydealList(){
    
  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{
             
          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{"action" : "GetTodaydealList" }

      },
          
      "columns": [
            
            {"data": "date"},
            
            {"data": "startTime"},
            
            {"data": "endTime"},

            {"data": "totalProduct"},
            
            {"data": "status"},

            {"data": "action"},

         ],

         "order": [[0, 'desc']]



  });

}

function completedOrderList(){
	$('#tableDataList').DataTable({
		"processing": true,
		"serverSide": true,
		"pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},
		"ajax":{
			"url": DASHURL+'/admin/commonajax',
			"dataType": "json",
			"type": "POST",
			"data":{"action" : "completedOrderList" }
		},
		"columns": [
		{"data": "generatedId"},
		{"data": "user"},
		{"data": "vendor"},
		{"data": "paidTotal"},
		{"data": "itemCount"},
		{"data": "addedOn"},
		{"data": "status"},
		{"data": "action"},
		],
		"order": [[7, 'desc']]
	});
}

function orderHistory(){
	if($('#tableDataList').length){
		$('#tableDataList').DataTable({
			"processing": true,
			"serverSide": true,
			"pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
			$('.template-demo .btn:eq(0)').text('New ('+oSettings.jqXHR.responseJSON.tabStatistics.new+')');
			$('.template-demo .btn:eq(1)').text('Ongoing ('+oSettings.jqXHR.responseJSON.tabStatistics.ongoing+')');
			$('.template-demo .btn:eq(2)').text('Completed ('+oSettings.jqXHR.responseJSON.tabStatistics.completed+')');
			$('.template-demo .btn:eq(3)').text('All ('+oSettings.jqXHR.responseJSON.tabStatistics.total+')');
			
		},
	        scrollX:        true,
	        scrollCollapse: true,
			"ajax":{
				"url": DASHURL+'/admin/commonajax',
				"dataType": "json",
				"type": "POST",
				"data":{"action" : "orderHistory", "filterOrder": $('.template-demo .btn.btn-primary').data('filter'), "filterDateRange": $('#reportrange').val(), "vendorId": $('#vendorId').val()}
			},
			"columns": [
			{"data": "generatedId"},
			{"data": "user"},
			{"data": "city"},
			{"data": "grandTotal"},
			{"data": "status"},
			{"data": "paymentStatus"},
			{"data": "addedOn"},
			{"data": "action"},
			],
	    	"scrollX": false,
	    	"autoWidth": false,
	    	"fixedHeader": {
		        "header": false,
		        "footer": false
	    	},
	    	"columnDefs": [
		      { "width": "70px", "targets": 0 },
		      { "width": "50px", "targets": 1 },
		      { "width": "50px", "targets": 2 },
		      { "width": "30px", "targets": 3 },
		      { "width": "70px", "targets": 4 },
		      { "width": "80px", "targets": 5 },
		      { "width": "40px", "targets": 6 },
		      { "width": "10px", "targets": 7 }
	    	],
			"order": [[7, 'desc']]
		});
	}
}

function visitorHistory(){
	if($('#tableDataList').length){
		$('#tableDataList').DataTable({
			"processing": true,
			"serverSide": true,
			"pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},
			"ajax":{
				"url": DASHURL+'/admin/commonajax',
				"dataType": "json",
				"type": "POST",
				"data":{"action" : "visitorHistory"}
			},
			"columns": [
			{"data": "senderName"},
			{"data": "senderNo"},
			{"data": "name"},
			{"data": "mobile"},
			{"data": "itemTotal"},
			{"data": "action"},
			],	    	
			"order": [[5, 'desc']]
		});
	}
}


function exportOrderCsv(obj, e){
	var btnText = $(obj).text().trim();
	if( btnText == "Processing" )
		return false;
	$(obj).text("Processing");	
	e.preventDefault();
	currentAjax = 1 ;
	$.ajax({
		url: COMMONAJAX,
		type: "POST",
		data: {"action" : "exportOrderCsv", "filterOrder": $('.template-demo .btn.btn-primary').data('filter'), "filterDateRange": $('#reportrange').val(), "search": $('#tableDataList_filter').find('input').val(), "vendorId": $('#vendorId').val()},
		success:function(response){
			currentAjax = 0 ;
			
		  	if(response.valid){
		    	$(obj).text("Exported");
		    	$('#download_csv').trigger('click');
		  	}
		  	else
		    	$(obj).text("Failed");
		 
		  	setTimeout(function(){
		  		$(obj).text('Export');
		  	}, 1000);	
		},
		error:function(response){
			currentAjax = 0 ;
			$(obj).text('Export');
		}
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
		if(validateSlug($(obj).find('input[name=slugName]').val()) == false &&  $(obj).find('input[name=slugName]').val() != '') {
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
	
		currentAjax = 1 ;
		$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
			
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
			currentAjax = 0 ;
			
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
	
		currentAjax = 1 ;
		$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
		  	if(response.valid){
		    	$(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
				  setTimeout(function(){
				  	location.reload();
				  }, 2000);
				  
			}else
		    	$(obj).find('.msg').html(getMsg(response.msg,2)).css('display','block');
		  	$(obj).find('.actionbtn').text(btnText);
			$(obj).find('html, body').animate({scrollTop:0}, 'slow');
			$(obj).find(".firstinput").focus();	  
		  	
			setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 2000);	
		  		  
		  
		},
		error:function(response){
		currentAjax = 0 ;			
		  	$(obj).find('.actionbtn').text(btnText);
		  	$(obj).find('.msg').html(getMsg("Something went wrong!",2)).css({'display':'block'});
		  	$('html, body').animate({scrollTop:0}, 'slow');
		 	setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 2000);
		}

	});
}
function GetZoneList(){
 
  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

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

      	"pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

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
  
  if($.inArray( "lenscategory", uriArray ) > -1 && $.inArray( "product", uriArray ) > -1)
    GetLensCategoryList();
  else if($.inArray( "lens", uriArray ) > -1 && $.inArray( "product", uriArray ) > -1)
    GetLensList();
  else if($.inArray( "brand", uriArray ) > -1 && $.inArray( "product", uriArray ) > -1)
    GetBrandList();
  else if($.inArray( "shape", uriArray ) > -1 && $.inArray( "product", uriArray ) > -1)
    GetShapeList();
  else if($.inArray( "attribute", uriArray ) > -1 && $.inArray( "product", uriArray ) > -1)
    GetAttributeList();
  else if($.inArray("attributeoption", uriArray) > -1 && $.inArray( "product",uriArray) > -1)
  	GetAttributeOptionList();
  else if($.inArray( "category", uriArray ) > -1 && $.inArray( "product", uriArray ) > -1)
    GetCategoryList();
  else if($.inArray("subcategory", uriArray) > -1 && $.inArray( "product",uriArray) > -1)
  	GetSubCategoryList();
  else if($.inArray("subcategoryitem",uriArray) > -1 && $.inArray("product",uriArray) > -1)
  	GetSubCategoryItemList();
  else if($.inArray("productlist",uriArray) > -1 && $.inArray("product",uriArray) > -1)
  	GetProductList();
  else if($.inArray("todaydeallist",uriArray) > -1 && $.inArray("product",uriArray) > -1)
  	GetTodaydealList();
  else if($.inArray( "zone", uriArray ) > -1 && $.inArray( "pincode", uriArray ) < 0 && $.inArray( "addpincode", uriArray ) < 0 )
    GetZoneList();
  else if($.inArray( "zone", uriArray ) > -1 && $.inArray( "pincode", uriArray ) > -1 )
    GetPincodeList();
  else if($.inArray( "order", uriArray ) > -1 && $.inArray( "completed", uriArray ) > -1 )
    completedOrderList();
  else if($.inArray( "order", uriArray ) > -1 && $.inArray( 'visitors', uriArray ) == -1)
    orderHistory();
  else if($.inArray( "order", uriArray ) > -1 && $.inArray( 'visitors', uriArray ) > -1)
    visitorHistory();
  else if($.inArray("vendorlist",uriArray) > -1 && $.inArray("vendor",uriArray) > -1)
  	GetVendorList();
  else if($.inArray("employeelist",uriArray) > -1 && $.inArray("employee",uriArray) > -1)
  	GetEmployeeList();
  else if($.inArray("role",uriArray) > -1 )
  	GetRoleList();
  else if($.inArray( "setting", uriArray ) > -1 && $.inArray( "front_slider", uriArray ) > -1)
    GetSliderList();
  else if($.inArray( "setting", uriArray ) > -1 && $.inArray( "front_shaking_category", uriArray ) > -1)
    GetShakingCategoryList();
  else if($.inArray( "setting", uriArray ) > -1 && $.inArray( "front_benefit", uriArray ) > -1)
    GetBenefitList();
  else if($.inArray( "setting", uriArray ) > -1 && $.inArray( "front_sale_banner", uriArray ) > -1)
    GetSaleBannerList();
  else if($.inArray( "setting", uriArray ) > -1 && $.inArray( "front_photo_gallery", uriArray ) > -1)
    GetPhotoGalleryList();
  else if($.inArray( "user", uriArray ) > -1 && $.inArray( "share_moment", uriArray ) > -1)
    GetShareMomentList();
  else if($.inArray("userlist",uriArray) > -1 && $.inArray("user",uriArray) > -1)
  	GetUserList();
  else if($.inArray("bloglist",uriArray) > -1 && $.inArray("blog",uriArray) > -1)
  	GetBlogList();
  else if($.inArray("comments",uriArray) > -1 && $.inArray("blog",uriArray) > -1)
  	GetBlogCommentsList();
  else if($.inArray( "tag", uriArray ) > -1) 
    GetTagList();
  // else if($.inArray( "frenchise", uriArray ) > -1 && $.inArray("enquiry",uriArray) > -1) 
  //   GetFrenchiseEnquiryList();
  else if($.inArray("reviewlist",uriArray) > -1 && $.inArray("review", uriArray ) > -1) 
    GetReviewList(); 
  else if($.inArray("newreviewlist",uriArray) > -1 && $.inArray("review", uriArray ) > -1) 
    GetNewReviewList();   
  else if($.inArray("coupon",uriArray) > -1 && $.inArray("couponlist", uriArray ) > -1) 
    GetCouponList();   
  else if($.inArray("product",uriArray) > -1 && $.inArray("addons", uriArray ) > -1) 
    GetAddonsList();  
  else if($.inArray("setting",uriArray) > -1 && $.inArray("social_icons", uriArray ) > -1) 
    GetFrontSocialIconsList();
  else if($.inArray( "enquiry", uriArray ) > -1 && $.inArray("frenchise_enquiry",uriArray) > -1) 
    GetFrenchiseEnquiryList();

  else if($.inArray("corporate_enquiry",uriArray) > -1) 
    GetCorporateEnquiryList();
  else if($.inArray("contact_enquiry",uriArray) > -1) 
    GetContactEnquiryList();
  else if($.inArray("notification",uriArray) > -1 && $.inArray("notificationlist",uriArray) > -1) 
    GetNotificationList();
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

	removePopover();
	$(obj).popover({
	    placement : 'top',
	    html : true,
	    title : 'Active/DeActive <a href="javascript:" onclick="removePopover();" class="close" data-dismiss="alert">&times;</a>',
	    content : '<div class="row" id="popover-section"><div class="col-sm-12"><p>' + $msg + '</p><p class=msg></p></div><div class="col-sm-12"><a href="javascript:void(0)" id="deleteyes" onclick="' + action + '" class="btn btn-primary mr-1 btn-popover pull-right">Yes</a><a href="javascript:void(0)" onclick="removePopover();" class="btn btn-danger mr-1 pull-right">No</a></div></div>'
	}).popover('show');

}


function CallHandlerForActivatedRecord(id,index, tab,status) {

  $('#deleteyes').html("Processing..");
  $('#popover-section').find('.msg').html('').css('display','none');

  
		currentAjax = 1 ;
		$.ajax({

    url: DASHURL+'/admin/commonajax', 

    type: "POST",

    data: {action:'changeStatus', id: id, tab: tab, status: status },

    dataType: "text",

    success: function (response) {
    	response = JSON.parse(response);
    	if(response.valid){

	      $newindex=$('.table').find('tbody tr:eq('+parseInt(index)+')').find('td:last').index();

	      /*Change Status Text*/

	      $objstatustxt=$('.table').find('tbody tr:eq('+parseInt(index)+')').find('td:eq('+parseInt($newindex-1)+')');

	      var statustxt=( status == 0 ) ? 'Active' : 'DeActive';
	      if(tab != 'product' && tab != 'addons')
	      	$objstatustxt.html(( status == 0 ) ? "Active" : "DeActive");

	      /*Change Class*/

	      $('.table').find('tbody tr:eq('+parseInt(index)+')').find('td:last').find('button').attr('data-status',statustxt);
	      if( status == 0 )
	      	$('.table').find('tbody tr:eq('+parseInt(index)+')').find('td:last').find('button.text-danger').addClass('text-success').removeClass('text-danger');
	      else      	
	      	$('.table').find('tbody tr:eq('+parseInt(index)+')').find('td:last').find('button.text-success').addClass('text-danger').removeClass('text-success');
	      removePopover();
	  	}else
	  		$('#popover-section').find('.msg').html(getMsg(((response.msg)?response.msg:"Something went wrong!"),2)).css('display','block');
	  		
		  	$('#deleteyes').html('Yes');
		  	
			setTimeout(function(){$('#popover-section').find('.msg').html('').css('display','none');}	, 2000);	
		  		  
		  
		},
		error:function(response){
		currentAjax = 0 ;			
		  	$('#deleteyes').html('Yes');
		  	$('#popover-section').find('.msg').html(getMsg("Something went wrong!",2)).css({'display':'block'});
		 	setTimeout(function(){$('#popover-section').find('.msg').html('').css('display','none');}	, 2000);
		}

  });

}


function removePopover(){
	$('.popover').popover('dispose');
}

/***************** End Active DeActive records ****************/
/*********************** Delete Records ***********************/

function delete_row(obj,tab,id){  

  var  $tr=$(obj).closest('tr');

  var index=$tr.index();

  var action = "CallHandlerForDeleteRecord(" + id + "," + index + ",'" + tab + "');";

	removePopover();
	$(obj).popover({
	    placement : 'top',
	    html : true,
	    title : 'Active/DeActive <a href="javascript:" onclick="removePopover();" class="close" data-dismiss="alert">&times;</a>',
	    content : '<div class="row" id="popover-section"><div class="col-sm-12"><p>Are You Sure Want To Delete This Record ?</p><p class=msg></p></div><div class="col-sm-12"><a href="javascript:void(0)" id="deleteyes" onclick="' + action + '" class="btn btn-primary mr-1 btn-popover pull-right">Yes</a><a href="javascript:void(0)" onclick="removePopover();" class="btn btn-danger mr-1 pull-right">No</a></div></div>'
	}).popover('show');

}

function CallHandlerForDeleteRecord(id,index, tab) {

  $('#deleteyes').html("Processing");

  var formData={action:"deleteRecord",tab:tab,id:id};

  
		currentAjax = 1 ;
		$.ajax({

    url: DASHURL+'/admin/commonajax',

    type: "POST",

    data: formData,

    success: function (d) {

      var $ntr = $('.table').find('tbody').find('tr:eq(' + index + ')');

      $ntr.remove();

      removePopover();

    },
    error : function(d) {}

  });

}

function approveReview(obj,tab,id){  

  var  $tr=$(obj).closest('tr');

  var index=$tr.index();

  var action = "CallHandlerForApproveReview(" + id + "," + index + ",'" + tab + "');";

	removePopover();
	$(obj).popover({
	    placement : 'top',
	    html : true,
	    title : 'Active/DeActive <a href="javascript:" onclick="removePopover();" class="close" data-dismiss="alert">&times;</a>',
	    content : '<div class="row" id="popover-section"><div class="col-sm-12"><p>Are You Sure Want To make public this review ?</p><p class=msg></p></div><div class="col-sm-12"><a href="javascript:void(0)" id="deleteyes" onclick="' + action + '" class="btn btn-primary mr-1 btn-popover pull-right">Yes</a><a href="javascript:void(0)" onclick="removePopover();" class="btn btn-danger mr-1 pull-right">No</a></div></div>'
	}).popover('show');

}

function CallHandlerForApproveReview(id,index, tab) {

  $('#deleteyes').html("Processing");
  
	currentAjax = 1 ;
	$.ajax({

    url: DASHURL+'/admin/commonajax',

    type: "POST",

    data: {action:'changeStatus', id: id, tab: tab, status: 0 },

    success: function (d) {

      var $ntr = $('.table').find('tbody').find('tr:eq(' + index + ')');

      $ntr.remove();

      removePopover();

    },
    error : function(d) {}

  });

}

function delete_image(obj, tab, id){  

  var  $tr=$(obj).closest('div.gallery-image');

  var index=$tr.index();

  var action = "CallHandlerForDeleteImage(" + id + ",'" + tab + "'," + index + ");";

      action = '"' + action + '"';

  var msg = "Are You Sure Want To Delete This Image?";

  var $div = "<div id='sb-containerDel'><div id='sb-wrapper' style='width:425px'><h1 style='font-size: 20.5px;'>"+msg+"</h1><hr/><table><tr><td><a href='javascript:void(0)' id='deleteyes' onclick=" + action + " class='button'>Yes</a></td><td><a href='javascript:void(0)' onclick='RemoveDelConfirmDiv();' class='button_deact fr'>No</a></td></tr></table></div></div>";

    $('body').append($div);

    $('#sb-containerDel').show('slow');

}

function CallHandlerForDeleteImage(id, tab, index) {

  $('#deleteyes').html("Processing..");

  var formData={action:"deleteRecord", tab:tab, id:id};

  
		currentAjax = 1 ;
		$.ajax({

    url: DASHURL+'/admin/commonajax',

    type: "POST",

    data: formData,

    success: function (d) {

      var $ntr = $('div.galleryImagesArea').find('div.gallery-image:eq(' + index + ')');

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


function changeOrderStatus(obj, e){
	e.preventDefault();
	$(obj).find('.msg').html('').css('display','none');
	var btnText = $(obj).find('.actionbtn').text().trim();
	if( btnText == "Processing..." )
		return false;
	$(obj).find('.actionbtn').text("Processing...");
	var baseurl=DASHURL+'/admin/commonajax';
	
		currentAjax = 1 ;
		$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
		  	if(response.valid){
		    	$(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
				  setTimeout(function(){
				  	location.reload();
				  }, 1000);
				  
			}else
		    	$(obj).find('.msg').html(getMsg(response.msg,2)).css('display','block');
		  	$(obj).find('.actionbtn').text(btnText);
		  	
			setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 2000);	
		  		  
		  
		},
		error:function(response){
		currentAjax = 0 ;			
		  	$(obj).find('.actionbtn').text(btnText);
		  	$(obj).find('.msg').html(getMsg("Something went wrong!",2)).css({'display':'block'});
		 	setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 2000);
		}
	});
}


/***************** start vendor Section ***************************/
function validateVendor(obj, e){
	
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
	var baseurl=DASHURL+'/admin/commonajax';
	
		currentAjax = 1 ;
		$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
		  	if(response.valid){
		    	$(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
			}else
		    	$(obj).find('.msg').html(getMsg(response.msg,2)).css('display','block');


			$(obj).find('.actionbtn').text(btnText);
			$(obj).find('html, body').animate({scrollTop:0}, 'slow');
			$(obj).find(".firstinput").focus();	  
		  	
			setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 3000);
		},
		error:function(response){
		currentAjax = 0 ;			
		  	$(obj).find('.actionbtn').text(btnText);
		  	$(obj).find('.msg').html(getMsg("Something went wrong!",2)).css({'display':'block'});
		  	$('html, body').animate({scrollTop:0}, 'slow');
		 	setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 3000);
		}
	});
}

function GetVendorList(){
    
  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{
             
          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{"action" : "getVendorList" }

      },
          
      "columns": [
            
            {"data": "icons"},
            
            {"data": "vendorName"},
            
            {"data": "mobile"},

            {"data": "email"},

            {"data": "city"},
            
            {"data": "status"},

            {"data": "action"},

         ],

         "order": [[6, 'desc']]



  });

}


/***************** End vendor Section ***************************/


/***************** start employee Section ***************************/
function validateEmployee(obj, e){
	
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
	var baseurl=DASHURL+'/admin/commonajax';
	
		currentAjax = 1 ;
		$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
		  	if(response.valid){
		    	$(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
			}else
		    	$(obj).find('.msg').html(getMsg(response.msg,2)).css('display','block');


			$(obj).find('.actionbtn').text(btnText);
			$(obj).find('html, body').animate({scrollTop:0}, 'slow');
			$(obj).find(".firstinput").focus();	  
		  	
			setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 3000);
		},
		error:function(response){
		currentAjax = 0 ;			
		  	$(obj).find('.actionbtn').text(btnText);
		  	$(obj).find('.msg').html(getMsg("Something went wrong!",2)).css({'display':'block'});
		  	$('html, body').animate({scrollTop:0}, 'slow');
		 	setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 3000);
		}
	});
}

function GetEmployeeList(){
  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{
             
          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{"action" : "GetEmployeeList" }

      },
          
      "columns": [
            
            {"data": "icons"},
            
            {"data": "employeeName"},
            
            {"data": "mobile"},

            {"data": "email"},

            {"data": "vendorName"},
            
            {"data": "status"},

            {"data": "action"},

         ],

         "order": [[6, 'desc']]



  });

}

$(document).on('change', '#employeeVendorId', function() {

	var subcategoryItemId = $(this).attr("data-id");
	if($(this).val() =='' ) {
		return false;
	}
	$('#roleId').html('<option value="">Select Role</option>').focus();
	openpoploader();
	var baseurl=DASHURL+'/admin/commonajax';
	
		currentAjax = 1 ;
		$.ajax({
		url: baseurl,
		type: "POST",
		data: {"action" : "gettabSubItemRecords", "tab" : "role", "key" : "addedById", "value" : $(this).val()},
		success:function(response){
		currentAjax = 0 ;	    	
		  	  
		  	if( response.valid ) 
		  		$('#roleId').html(response.data.roleDropDown).focus();
		  		
		  	setTimeout(function() {removepoploader();}, 200);
		},
		error:function(response){
			currentAjax = 0 ;
		  removepoploader();
		}
	});
});


/***************** End employee Section ***************************/


/***************** start role Section ***************************/
function validateRole(obj, e){
	
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
	var baseurl=DASHURL+'/admin/commonajax';
	
		currentAjax = 1 ;
		$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
		  	if(response.valid){
		    	$(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
		    	$('#tableDataList').DataTable().ajax.reload();
		    	ResetTextBox(obj);
			}else
		    	$(obj).find('.msg').html(getMsg(response.msg,2)).css('display','block');


			$(obj).find('.actionbtn').text(btnText);
			$(obj).find('html, body').animate({scrollTop:0}, 'slow');
			$(obj).find(".firstinput").focus();	  
		  	
			setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 3000);
		},
		error:function(response){
		currentAjax = 0 ;			
		  	$(obj).find('.actionbtn').text(btnText);
		  	$(obj).find('.msg').html(getMsg("Something went wrong!",2)).css({'display':'block'});
		  	$('html, body').animate({scrollTop:0}, 'slow');
		 	setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 3000);
		}
	});
}
function validateRolePermission(obj, e){
	
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
	var baseurl=DASHURL+'/admin/commonajax';
	
		currentAjax = 1 ;
		$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
		  	if(response.valid){
		    	$(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
			}else
		    	$(obj).find('.msg').html(getMsg(response.msg,2)).css('display','block');

			$(obj).find('.actionbtn').text(btnText);
			setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 3000);
		},
		error:function(response){
		currentAjax = 0 ;			
		  	$(obj).find('.actionbtn').text(btnText);
		  	$(obj).find('.msg').html(getMsg("Something went wrong!",2)).css({'display':'block'});
		 	setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 3000);
		}
	});
}

function GetRoleList(){
  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{
             
          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{"action" : "GetRoleList" }

      },
          
      "columns": [
            
            {"data": "role"},
            
            {"data": "vendorName"},
            
            {"data": "totalEmp"},

            {"data": "addedOn"},

            {"data": "action"},

         ],

         "order": [[4, 'desc']]



  });

}


/***************** End role Section ***************************/

function ChangeAdminUserPassword(obj,e,btn){
	e.preventDefault();
	$(obj).find('.msg').html('').css('display','none');	
	
		currentAjax = 1 ;
		$.ajax({
		type: "POST",
		data: new FormData(obj),
		url: DASHURL+'/admin/commonajax',
		contentType: false,
		cache: false,
		processData:false,
		success: function(response) {
			$(btn).html('<i class="fa fa-fw fa-lg fa-check-circle" ></i>Submit');
			if(response.valid==true){
				$(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
				ResetTextBox(obj);
				setTimeout(function(){window.location.href=DASHURL+'/admin/welcome';},3000);
			}
			else{
				$('#form_current_password').focus();
				$(obj).find('.msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something is wrong',2)).css('display','block');

			}
			setTimeout(function(){$(obj).find('.msg').html('').css('display','none');},4000);
		} ,
		error:function(response){
			currentAjax = 0 ;
			setTimeout(function(){$(obj).find('.msg').html('').css('display','none');},4000);
			$(btn).html('<i class="fa fa-fw fa-lg fa-check-circle" ></i>Submit');
			$(obj).find('.msg').html(getMsg('Something is wrong',2)).css('display','block');
		}          
	});
}

function validateProfile(obj, e){
	
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
	var baseurl=DASHURL+'/admin/commonajax';
	
		currentAjax = 1 ;
		$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
		  	if(response.valid){
		    	$(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
			}else
		    	$(obj).find('.msg').html(getMsg(response.msg,2)).css('display','block');


			$(obj).find('.actionbtn').text(btnText);
			$(obj).find('html, body').animate({scrollTop:0}, 'slow');
			$(obj).find(".firstinput").focus();	  
		  	
			setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 3000);
		},
		error:function(response){
		currentAjax = 0 ;			
		  	$(obj).find('.actionbtn').text(btnText);
		  	$(obj).find('.msg').html(getMsg("Something went wrong!",2)).css({'display':'block'});
		  	$('html, body').animate({scrollTop:0}, 'slow');
		 	setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 3000);
		}
	});
}

function copyPincode(obj, e){
	
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
	var baseurl=DASHURL+'/admin/commonajax';
	
		currentAjax = 1 ;
		$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
		  	if(response.valid){
		    	$(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
		    	$('#tableDataList').DataTable().ajax.reload();
			}else
		    	$(obj).find('.msg').html(getMsg(response.msg,2)).css('display','block');


			$(obj).find('.actionbtn').text(btnText)
			$(obj).find(".firstinput").focus();	  
		  	
			setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 3000);
		},
		error:function(response){
		currentAjax = 0 ;			
		  	$(obj).find('.actionbtn').text(btnText);
		  	$(obj).find('.msg').html(getMsg("Something went wrong!",2)).css({'display':'block'});		  	
		 	setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 3000);
		}
	});
}

function validateSetting(obj, e){
	
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
	
		currentAjax = 1 ;
		$.ajax({
		url: COMMONAJAX,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
		  	if(response.valid){
		    	$(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
		    	
			}else
		    	$(obj).find('.msg').html(getMsg(response.msg,2)).css('display','block');


			$(obj).find('.actionbtn').text(btnText)
			$(obj).find(".firstinput").focus();	  
		  	
			setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 3000);
		},
		error:function(response){
		currentAjax = 0 ;			
		  	$(obj).find('.actionbtn').text(btnText);
		  	$(obj).find('.msg').html(getMsg("Something went wrong!",2)).css({'display':'block'});		  	
		 	setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 3000);
		}
	});
}

function intervalProgress(obj, progressUpTo,intervalTime,msg=''){
	var interval = setInterval(function(){
		var progress = parseInt($(obj).find('#myBar').text());
		if(progress < progressUpTo){
			$(obj).find('#myBar').text(++progress+'%');
			$(obj).find('#myBar').css('width',++progress+'%');
		}else{
			clearInterval(interval);
			$(obj).find('.btntext').text('Upload');
			$(obj).find('.msg').html(getMsg((msg)?msg:'Uploaded Successfully.',1)).css('display','block');
		}
	},intervalTime);
	return interval;
}

function addZoneCSV(obj,e){
	e.preventDefault();
	$(obj).find('.msg').html('');
	$(obj).find('.msg').css('display','none');
	var btnText = $(obj).find('.btntext').text().trim();
	if( btnText == "Processing..." )
		return false;
	$(obj).find('.btntext').text("Processing...");

	if( TextBoxValidation(obj) == false ) {
		$(obj).find('.btntext').text(btnText);
		return false;
	}
	$(obj).find('#myProgress').css('display','block');
	$(obj).find('#myBar').text('0%');
	$(obj).find('#myBar').css({'width':'10%','background-color':'#4CAF50'});
    var fileSize = document.getElementById('csvfile').files[0].size; 
    var fileSizeKb = (fileSize/1024).toFixed(2);  
    var intervalTime = parseInt(((fileSizeKb * 2)/90)*1000); 
	var interval = intervalProgress(obj,90,intervalTime);
	
		currentAjax = 1 ;
		$.ajax({
		url: COMMONAJAX,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
		currentAjax = 0 ;			
			if( !response.valid ) {
				clearInterval(interval);
				$(obj).find('#myBar').css({'background-color':'#c34444'});
				$(obj).find('.btntext').text('Upload');
				$(obj).find('.msg').html(getMsg((response.msg)?response.msg:'Something went wrong',2)).css('display','block');
			}
			else
				intervalProgress(obj,100,100,response.msg);


			// $(obj).find('.btntext').text('Upload');
			setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 5000);			
		},
		error:function(response){
			currentAjax = 0 ;
			clearInterval(interval);
			$(obj).find('#myBar').css({'background-color':'#c34444'});
			$(obj).find('.btntext').text('Upload');
		  	$(obj).find('.msg').html(getMsg("Something went wrong!",2)).css({'display':'block'});		  	
		 	setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 3000);
		}
	});
}

function addPincodeCSV(obj,e){
	e.preventDefault();
	$(obj).find('.msg').html('');
	$(obj).find('.msg').css('display','none');
	var btnText = $(obj).find('.btntext').text().trim();
	if( btnText == "Processing..." )
		return false;
	$(obj).find('.btntext').text("Processing...");

	if( TextBoxValidation(obj) == false ) {
		$(obj).find('.btntext').text(btnText);
		return false;
	}
	$(obj).find('#myProgress').css('display','block');
	$(obj).find('#myBar').text('0%');
	$(obj).find('#myBar').css({'width':'10%','background-color':'#4CAF50'});
    var fileSize = document.getElementById('csvfile').files[0].size; 
    var fileSizeKb = (fileSize/1024).toFixed(2);  
    var intervalTime = parseInt(((fileSizeKb * 2)/90)*1000); 
	var interval = intervalProgress(obj,90,intervalTime);
	
		currentAjax = 1 ;
		$.ajax({
		url: COMMONAJAX,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
		currentAjax = 0 ;			
			if( !response.valid ) {
				clearInterval(interval);
				$(obj).find('#myBar').css({'background-color':'#c34444'});
				$(obj).find('.btntext').text('Upload');
				$(obj).find('.msg').html(getMsg((response.msg)?response.msg:'Something went wrong',2)).css('display','block');
			}
			else
				intervalProgress(obj,100,100,response.msg);
			

			// $(obj).find('.btntext').text('Upload');
			setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 5000);			
		},
		error:function(response){
			currentAjax = 0 ;
			clearInterval(interval);
			$(obj).find('#myBar').css({'background-color':'#c34444'});
			$(obj).find('.btntext').text('Upload');
		  	$(obj).find('.msg').html(getMsg("Something went wrong!",2)).css({'display':'block'});		  	
		 	setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 3000);
		}
	});
}



function validateFrontSlider(obj, e){
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
	
	
		currentAjax = 1 ;
		$.ajax({
		url: COMMONAJAX,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
			
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
			currentAjax = 0 ;
			
		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('.msg').html("Something went wrong!");
		  $(obj).find('.msg').css({'display':'block','color':'red'});
		  $('html, body').animate({scrollTop:0}, 'slow');
		}
	});
}



function GetSliderList(){
 
  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{

          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{'action' : 'getSliderList' }

      },

      "columns": [

            {"data": "img"},

            {"data": "title"},            

            {"data": "description"},

            {"data": "status"},

            {"data": "action"},

         ],

         "order": [[1, 'desc']]



  });

}

$(document).on('click', '.editSlider', function() {
		
	openpoploader();
	var sliderId = $(this).attr("data-id");
	if( sliderId < 1 ) {
		removepoploader();
		return false;
	}

	
		currentAjax = 1 ;
		$.ajax({
		url: COMMONAJAX,
		type: "POST",
		data: {"action" : "gettabRecords", "tab" : "front_page_slider", "key" : "sliderId", "value" : sliderId},
		success:function(response){
			currentAjax = 0 ;
			
		 	removepoploader();  
		  	if( response.valid ) {
		  		$('.formarea').find('#title').val(response.data.title);
		  		$('.formarea').find('input[name=hiddenval]').val(response.data.sliderId);
		  		$('.formarea').find('#text1').val(response.data.text1);
		  		$('.formarea').find('#text2').val(response.data.text2);
		  		$('.formarea').find('#btnText').val(response.data.btnText);
		  		$('.formarea').find('#btnUrl').val(response.data.btnUrl);
		  		$('.formarea').find('#position').val(response.data.position);
		  		$('.formarea').find('#uploadIcons').removeAttr('required').next('div.previewimg').html((response.data.img)?'<img src="'+BASEURL+'/system/static/uploads/slider_images/'+response.data.img+'" width="70px" height="50px">':'');
		  		$('.formarea').find('.firstinput').focus();
		  		$('#newFormModal').modal('show');
		  		$('#newFormModal').find('.newFormModalTitle').text('Update');
		  	}
		},
		error:function(response){
			currentAjax = 0 ;
			
		  removepoploader();
		}
	});
});

function validatePopupFrom(obj, e){
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
	
	
		currentAjax = 1 ;
		$.ajax({
		url: COMMONAJAX,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
			
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
			currentAjax = 0 ;
			
		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('.msg').html("Something went wrong!");
		  $(obj).find('.msg').css({'display':'block','color':'red'});
		  $('html, body').animate({scrollTop:0}, 'slow');
		}
	});
}

function GetShakingCategoryList(){
 
  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{

          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{'action' : 'getShakingCategoryList' }

      },

      "columns": [

            {"data": "img"},

            {"data": "title"},   

            {"data": "btnUrl"},            

            {"data": "status"},

            {"data": "action"},

         ],

         "order": [[0, 'desc']]



  });

}

$(document).on('click', '.editShakingCategory', function() {
		
	var categoryId = $(this).attr("data-id");

  	if( categoryId > 0 ) {
  		let obj = $(this).closest('tr');
  		$('.formarea').find('#title').val(obj.find('td:eq(1)').text());
  		$('.formarea').find('input[name=hiddenval]').val(categoryId);
  		$('.formarea').find('#btnUrl').val(obj.find('td:eq(2)').text());
  		$('.formarea').find('#uploadIcons').next('div.previewimg').html((obj.find('td:eq(0)').html())?'<img src="'+obj.find('td:eq(0)').find('img').attr('src')+'" width="70px" height="50px">':'');
  		$('.formarea').find('.firstinput').focus();
  		$('#newFormModal').modal('show');
  		$('#newFormModal').find('.newFormModalTitle').text('Update');
  	}
});

function GetFrontSocialIconsList(){
 
  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{

          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{'action' : 'getFrontSocialIconsList' }

      },

      "columns": [

            {"data": "img"},
            {"data": "btnUrl"},            

            {"data": "status"},

            {"data": "action"},

         ],

         "order": [[1, 'desc']]



  });

}


$(document).on('click', '.editSocialIcon', function() {
		
	var socialId = $(this).attr("data-id");

  	if( socialId > 0 ) {
  		let obj = $(this).closest('tr');
  		$('.formarea').find('input[name=hiddenval]').val(socialId);
  		$('.formarea').find('#btnUrl').val(obj.find('td:eq(1)').text());
  		$('.formarea').find('#uploadIcons').next('div.previewimg').html((obj.find('td:eq(0)').html())?'<img src="'+obj.find('td:eq(0)').find('img').attr('src')+'" width="70px" height="50px" style="background: #747777; ">':'');
  		$('.formarea').find('.firstinput').focus();
  		$('#newFormModal').modal('show');
  		$('#newFormModal').find('.newFormModalTitle').text('Update');
  	}
});

function GetBenefitList(){
 
  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{

          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{'action' : 'getBenefitList' }

      },

      "columns": [

            {"data": "img"},

            {"data": "text1"},   

            {"data": "text2"},            

            {"data": "status"},

            {"data": "action"},

         ],

         "order": [[1, 'desc']]



  });

}


$(document).on('click', '.editBenefit', function() {
		
	var benefitId = $(this).attr("data-id");

  	if( benefitId > 0 ) {
  		let obj = $(this).closest('tr');
  		$('.formarea').find('#text1').val(obj.find('td:eq(1)').text());
  		$('.formarea').find('input[name=hiddenval]').val(benefitId);
  		$('.formarea').find('#text2').val(obj.find('td:eq(2)').text());
  		$('.formarea').find('#uploadIcons').next('div.previewimg').html((obj.find('td:eq(0)').html())?'<img src="'+obj.find('td:eq(0)').find('img').attr('src')+'" width="70px" height="50px">':'');
  		$('.formarea').find('.firstinput').focus();
  		$('#newFormModal').modal('show');
  		$('#newFormModal').find('.newFormModalTitle').text('Update');
  	}
});

function GetSaleBannerList(){
 
  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{

          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{'action' : 'getSaleBannerList' }

      },

      "columns": [

            {"data": "img"},

            {"data": "text1"},   

            {"data": "text2"},            

            {"data": "status"},

            {"data": "action"},

         ],

         "order": [[1, 'desc']]



  });

}


$(document).on('click', '.editSaleBanner', function() {
		
	openpoploader();
	var bannerId = $(this).attr("data-id");
	if( bannerId < 1 ) {
		removepoploader();
		return false;
	}

	
		currentAjax = 1 ;
		$.ajax({
		url: COMMONAJAX,
		type: "POST",
		data: {"action" : "gettabRecords", "tab" : "front_page_sale_banner", "key" : "bannerId", "value" : bannerId},
		success:function(response){
			currentAjax = 0 ;
			
		 	removepoploader();  
		  	if( response.valid ) {
		  		$('.formarea').find('#text1').val(response.data.text1);
		  		$('.formarea').find('#text2').val(response.data.text2);
		  		$('.formarea').find('#text3').val(response.data.text3);
		  		$('.formarea').find('input[name=hiddenval]').val(response.data.bannerId);
		  		$('.formarea').find('#btnText').val(response.data.btnText);
		  		$('.formarea').find('#btnUrl').val(response.data.btnUrl);
		  		$('.formarea').find('#uploadIcons').next('div.previewimg').html((response.data.img)?'<img src="'+BASEURL+'/system/static/uploads/sale_banner_images/'+response.data.img+'" width="70px" height="50px">':'');
		  		$('.formarea').find('.firstinput').focus();
		  		$('#newFormModal').modal('show');
		  		$('#newFormModal').find('.newFormModalTitle').text('Update');
		  	}
		},
		error:function(response){
			currentAjax = 0 ;
			
		  removepoploader();
		}
	});
});

function GetPhotoGalleryList(){
 
  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{

          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{'action' : 'getPhotoGalleryList' }

      },

      "columns": [

            {"data": "img"},

            {"data": "description"},   

            {"data": "btnUrl"},            

            {"data": "status"},

            {"data": "action"},

         ],

         "order": [[0, 'desc']]



  });

}


$(document).on('click', '.editPhotoGallery', function() {
		
	openpoploader();
	var galleryId = $(this).attr("data-id");
	if( galleryId < 1 ) {
		removepoploader();
		return false;
	}

	
		currentAjax = 1 ;
		$.ajax({
		url: COMMONAJAX,
		type: "POST",
		data: {"action" : "gettabRecords", "tab" : "front_page_photo_gallery", "key" : "galleryId", "value" : galleryId},
		success:function(response){
			currentAjax = 0 ;
			
		 	removepoploader();  
		  	if( response.valid ) {
		  		$('.formarea').find('#description').val(response.data.description);
		  		$('.formarea').find('input[name=hiddenval]').val(response.data.galleryId);
		  		$('.formarea').find('#btnUrl').val(response.data.btnUrl);
		  		$('.formarea').find('#uploadIcons').next('div.previewimg').html((response.data.img)?'<img src="'+BASEURL+'/system/static/uploads/photo_gallery_images/'+response.data.img+'" width="70px" height="50px">':'');
		  		$('.formarea').find('.firstinput').focus();
		  		$('#newFormModal').modal('show');
		  		$('#newFormModal').find('.newFormModalTitle').text('Update');
		  	}
		},
		error:function(response){
			currentAjax = 0 ;
			
		  removepoploader();
		}
	});
});

function GetShareMomentList(){
 
  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{

          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{'action' : 'getShareMomentList' }

      },

      "columns": [

            {"data": "img"},           

            {"data": "status"},

            {"data": "action"},

         ],

         "order": [[1, 'desc']]



  });

}

/*********************Start User Section*************************/
function GetUserList(){
    
  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{
             
          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{"action" : "getUserList" }

      },
          
      "columns": [
            
            {"data": "img"},
            
            {"data": "userName"},
            
            {"data": "email"},

            {"data": "mobile"},

            {"data": "status"},

            {"data": "action"},

         ],

         "order": [[5, 'desc']]



  });

}

function validateUser(obj, e){
	
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
	var baseurl=DASHURL+'/admin/commonajax';
	
	currentAjax = 1 ;
	$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
			
		  	if(response.valid){
		    	$(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
			}else
		    	$(obj).find('.msg').html(getMsg(response.msg,2)).css('display','block');


			$(obj).find('.actionbtn').text(btnText);
			$(obj).find('html, body').animate({scrollTop:0}, 'slow');
			$(obj).find(".firstinput").focus();	  
		  	
			setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 3000);
		},
		error:function(response){
			currentAjax = 0 ;
					
		  	$(obj).find('.actionbtn').text(btnText);
		  	$(obj).find('.msg').html(getMsg("Something went wrong!",2)).css({'display':'block'});
		  	$('html, body').animate({scrollTop:0}, 'slow');
		 	setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 3000);
		}
	});
}

$(document).on('click', '.addMoreAddressSection', function() {
	
	deliveryCount = parseInt(deliveryCount) + 1;
	var newDeliverySection = '<div class="AddressSection address_row1 row" data-counter="'+deliveryCount+'"><div class="form-group col-md-6"><label for="addressType">Address Type</label><input type="text" class="form-control" id="addressType" placeholder="Adress Type" name="addressType['+deliveryCount+']" required></div><div class="form-group col-md-6"><label for="address">Address</label><input type="text" class="form-control" id="address" placeholder="Delivery Address" name="address['+deliveryCount+']" required></div><div class="form-group col-md-6"><label for="address">Address2</label><input type="text" class="form-control" id="addresss" placeholder="Delivery Address2" name="addresss['+deliveryCount+']" required></div><div class="form-group col-md-6"><label for="city">City</label><input type="text" class="form-control" id="city" placeholder="Delivery City" name="city['+deliveryCount+']" required></div><div class="form-group col-md-6"><label for="state">State</label><input type="text" class="form-control" id="state" placeholder="Delivery State" name="state['+deliveryCount+']" required></div><div class="form-group col-md-6"><label for="country">Country</label><input type="text" class="form-control" id="country" placeholder="Delivery Country" name="country['+deliveryCount+']" required></div><div class="form-group col-md-6"><label for="pincode">Pincode</label><input type="text" class="form-control" id="pincode" placeholder="Delivery Pincode" onkeypress="return OnlyInteger()" maxlength="6" name="pincode['+deliveryCount+']" required></div><button type="button" class="btn btn-success removeAddressSection"><i class="fa fa-times"></i> Remove</button></div>';
	$(newDeliverySection).insertBefore($(this));
    
});

$(document).on('click', '.removeAddressSection', function() {
	$(this).closest('.AddressSection').remove();
});
/************************End User Section************************/
/************************Start Review Section************************/
function validateReview(obj, e){
	
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
	var baseurl=DASHURL+'/admin/commonajax';
	
		currentAjax = 1 ;
		$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
			
		  	if(response.valid){
		    	$(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
			}else
		    	$(obj).find('.msg').html(getMsg(response.msg,2)).css('display','block');


			$(obj).find('.actionbtn').text(btnText);
			$(obj).find('html, body').animate({scrollTop:0}, 'slow');
			$(obj).find(".firstinput").focus();	  
		  	
			setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 3000);
		},
		error:function(response){
			currentAjax = 0 ;
					
		  	$(obj).find('.actionbtn').text(btnText);
		  	$(obj).find('.msg').html(getMsg("Something went wrong!",2)).css({'display':'block'});
		  	$('html, body').animate({scrollTop:0}, 'slow');
		 	setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 3000);
		}
	});
}
/************************End Review Section************************/
/*********************Start Blog Section****************************/
 function validateBlog(obj, e){
     	
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
	var baseurl=DASHURL+'/admin/commonajax';
	
		currentAjax = 1 ;
		$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
			
		  	if(response.valid){
		    	$(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
			}else
		    	$(obj).find('.msg').html(getMsg(response.msg,2)).css('display','block');


			$(obj).find('.actionbtn').text(btnText);
			$(obj).find('html, body').animate({scrollTop:0}, 'slow');
			$(obj).find(".firstinput").focus();	  
		  	
			setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 3000);
		},
		error:function(response){
			currentAjax = 0 ;
					
		  	$(obj).find('.actionbtn').text(btnText);
		  	$(obj).find('.msg').html(getMsg("Something went wrong!",2)).css({'display':'block'});
		  	$('html, body').animate({scrollTop:0}, 'slow');
		 	setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 3000);
		}
	});
}

function GetBlogList(){
  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{
             
          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{"action" : "GetBlogList" }

      },
          
      "columns": [
            
            {"data": "icons"},
            
            {"data": "blogTitle"},
            
            {"data": "addedOn"},
            
            {"data": "status"},

            {"data": "action"},

         ],

         "order": [[4, 'desc']]



  });

}

function GetBlogCommentsList(){
  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{
             
          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{"action" : "GetBlogCommentsList" }

      },
          
      "columns": [
            
            {"data": "firstName"},

            {"data": "blogTitle"},

            {"data": "message"},            
            
            {"data": "addedOn"},
            
            {"data": "status"},

            {"data": "action"},

         ],

         "order": [[5, 'desc']]



  });

}

/*********************End Blog Section****************************/


/**********************Tags Section******************************/
function validateTag(obj, e){
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
	
		currentAjax = 1 ;
		$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
			
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
			currentAjax = 0 ;
			
		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('.msg').html("Something went wrong!");
		  $(obj).find('.msg').css({'display':'block','color':'red'});
		  $('html, body').animate({scrollTop:0}, 'slow');
		}
	});
}


$(document).on('click', '.editTag', function() {
	
	openpoploader();
	var tagId = $(this).attr("data-id");
	if( tagId < 1 ) {
		removepoploader();
		return false;
	}
	var baseurl=DASHURL+'/admin/commonajax';
	
		currentAjax = 1 ;
		$.ajax({
		url: baseurl,
		type: "POST",
		data: {"action" : "gettabRecords", "tab" : "tags", "key" : "tagId", "value" : tagId},
		success:function(response){
			currentAjax = 0 ;
			
		 	removepoploader();  
		  	if( response.valid ) {
		  		$('.formarea').find('#tagName').val(response.data.tag);
		  		$('.formarea').find('input[name=hiddenval]').val(response.data.tagId);
		  		$('.formarea').find('#tagName').val(response.data.tag);
		  		$('.formarea').find('.firstinput').focus();
		  		$('#newFormModal').modal('show');
		  		$('#newFormModal').find('.newFormModalTitle').text('Update');
		  	}
		},
		error:function(response){
			currentAjax = 0 ;
			
		  removepoploader();
		}
	});
});


function GetTagList(){
    
  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{

          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{'action' : 'getTagList' }

      },

      "columns": [

            {"data": "tag"},
            
            {"data":"addedOn"},

            {"data": "status"},

            {"data": "action"},

         ],

         "order": [[1, 'desc']]



  });

}
/**********************End Tags Section******************************/
/**********************Frenchise Section******************************/
function validateFrenchise(obj, e){
	
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
	
		currentAjax = 1 ;
		$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
			
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
			currentAjax = 0 ;
			
		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('.msg').html("Something went wrong!");
		  $(obj).find('.msg').css({'display':'block','color':'red'});
		  $('html, body').animate({scrollTop:0}, 'slow');
		}
	});
}

$(document).on('click', '.editFrenchise', function() {

	openpoploader();
	var frenchiseId = $(this).attr("data-id");
	if( frenchiseId < 1 ) {
		removepoploader();
		return false;
	}
	var baseurl=DASHURL+'/admin/commonajax';
	
		currentAjax = 1 ;
		$.ajax({
		url: baseurl,
		type: "POST",
		data: {"action" : "gettabRecords", "tab" : "front_page_frenchise", "key" : "Id", "value" : frenchiseId},
		success:function(response){
			currentAjax = 0 ;
			
		 	removepoploader();  
		  	if( response.valid ) {
		  		$('Select.Frenchise').val(response.data.type);
		  		$('.formarea').find('input[name=hiddenval]').val(response.data.Id);
		  		if(response.data.type=='faqs'){
	            $('.formarea').find('#frenchise_title_faq').val(response.data.title);
	            $('.formarea').find('textarea#description').val(response.data.description);       
		  		$('.frenchise_faqs').show();
	            $('.frenchise_Nfaqs').hide();
	            $('input.nfaqs').prop("required", false);
	            $('input.faqs').prop("required", true);
	            $('textarea.faqs').prop("required",true);
		  		}
		  		else{
		  		$('.formarea').find('#frenchise_title').val(response.data.title);
	            $('.frenchise_Nfaqs').show();
	            $('.frenchise_faqs').hide();
	            $('input.nfaqs').prop("required",true);
		        $('input.faqs').prop("required",false);
		        $('textarea.faqs').prop("required",false); 
		  		}
		  		$('.formarea').find('.firstinput').focus();
		  		$('#newFormModal').modal('show');
		  		$('#newFormModal').find('.newFormModalTitle').text('Update');
		  	}
		},
		error:function(response){
			currentAjax = 0 ;
			
		  removepoploader();
		}
	});
});

function GetFrenchiseEnquiryList(){
    
  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{

          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{'action' : 'GetFrenchiseEnquiryList' }

      },

      "columns": [

            {"data": "name"},
            
            {"data":"email"},

            {"data":"mobile"},

            {"data": "addedOn"},

            {"data": "action"},

         ],

         "order": [[4, 'desc']]



  });

}
/*****************End Frenchise Section *********************************/
/************************Start Review Section****************************/
function GetReviewList(){
    
  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{

          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{'action' : 'getReviewList' }

      },

      "columns": [
            
            {"data":"userName"},

            {"data": "productName"},

            {"data":"rating"},

            {"data":"review"},

            {"data": "status"},

            {"data": "action"},

         ],

         "order": [[5, 'desc']]



  });

}
function GetNewReviewList(){
    
  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{

          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{'action' : 'newReviewList' }

      },

      "columns": [
            
            {"data":"userName"},

            {"data": "productName"},

            {"data":"rating"},

            {"data":"review"},

            {"data": "status"},

            {"data": "action"},

         ],

         "order": [[5, 'desc']]



  });

}
/*********************End Review Section***********************/


/**********************Coupon Section******************************/

function validateCoupon(obj, e){
	
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
	
		currentAjax = 1 ;
		$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
			
		  if(response.valid){
		    $(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
		    setTimeout(function(){window.location.href = window.location.href; }, 1000);
		  }else
		    $(obj).find('.msg').html(getMsg(response.msg,2)).css('display','block');

		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('html, body').animate({scrollTop:0}, 'slow');
		  $(obj).find(".firstinput").focus();	  
		  
		},
		error:function(response){
			currentAjax = 0 ;
			
		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('.msg').html(getMsg("Something went wrong!",2)).css({'display':'block'});
		  $('html, body').animate({scrollTop:0}, 'slow');
		}
	});
}

function GetCouponList(){
    
  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{

          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{'action' : 'getCouponList' }

      },

      "columns": [
            
            {"data":"couponCode"},

            {"data": "discountType"},

            {"data":"discount"},

            {"data":"startDate"},

            {"data":"endDate"},

            {"data": "status"},

            {"data": "action"},

         ],

         "order": [[6, 'desc']]



  });

}

/*********************End Coupon Section***********************/


/**********************Menu Section******************************/

function validateMenu(obj, e){
	
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
	
		currentAjax = 1 ;
		$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
			
		  if(response.valid){
		    $(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
		    setTimeout(function(){window.location.href = window.location.href; }, 1000);
		  }else
		    $(obj).find('.msg').html(getMsg(response.msg,2)).css('display','block');

		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('html, body').animate({scrollTop:0}, 'slow');
		  $(obj).find(".firstinput").focus();	  
		  setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}, 3000);
		},
		error:function(response){
			currentAjax = 0 ;
			
		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('.msg').html(getMsg("Something went wrong!",2)).css({'display':'block'});
		  $('html, body').animate({scrollTop:0}, 'slow');
		  setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}, 3000);
		}
	});
}


/*********************End Coupon Section***********************/


/************************Start Validate Addons***********************/

function validateAddons(obj, e){
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

	
		currentAjax = 1 ;
		$.ajax({
		url: COMMONAJAX,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
			
		  if(response.valid){
		    $(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
		    setTimeout(function(){window.location.href = window.location.href; }, 1000);
		  }else
		    $(obj).find('.msg').html(getMsg(response.msg,2)).css('display','block');

		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('html, body').animate({scrollTop:0}, 'slow');
		  $(obj).find(".firstinput").focus();	  
		  setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}, 3000);
		},
		error:function(response){
			currentAjax = 0 ;
			
		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('.msg').html(getMsg("Something went wrong!",2)).css({'display':'block'});
		  $('html, body').animate({scrollTop:0}, 'slow');
		  setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}, 3000);
		}
	});
}

function editAddons(obj, e, addonsId) {
	
	openpoploader();
	
	if( addonsId < 1 ) {
		removepoploader();
		return false;
	}
	
	
		currentAjax = 1 ;
		$.ajax({
		url: COMMONAJAX,
		type: "POST",
		data: {"action" : "gettabRecords", "tab" : "product_addons", "key" : "addonsId", "value" : addonsId},
		success:function(response){
			currentAjax = 0 ;
			
		 	removepoploader();  
		  	if( response.valid ) {
		  		$('.formarea').find('#addonsName').val(response.data.addonsName);
		  		$('.formarea').find('input[name=hiddenval]').val(response.data.addonsId);
		  		$('.formarea').find('#price').val(response.data.price);
		  		$('.formarea').find('#uploadIcons').next('div.previewimg').html((response.data.img)?'<img src="'+BASEURL+'/system/static/uploads/addons_images/'+response.data.img+'" width="70px" height="50px">':'');
		  		$('.formarea').find('.firstinput').focus();
		  		$('#newFormModal').modal('show');
		  		$('#newFormModal').find('.newFormModalTitle').text('Update');
		  	}
		},
		error:function(response){
			currentAjax = 0 ;
			
		  removepoploader();
		}
	});
}


function GetAddonsList(){
 
  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{

          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{'action' : 'getAddonsList' }

      },

      "columns": [

            {"data": "img"},

            {"data": "addonsName"},

            {"data": "price"},

            {"data": "action"},

         ],

         "order": [[0, 'desc']]



  });

}

/************************End Validate Addons************************/


/**************************GetCorporateEnquiryList*****************/
function GetCorporateEnquiryList(){
    
  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{

          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{'action' : 'GetCorporateEnquiryList' }

      },

      "columns": [

            {"data": "name"},
            
            {"data":"email"},

            {"data":"mobile"},

            {"data": "addedOn"},

            {"data": "action"},

         ],

         "order": [[4, 'desc']]



  });

}
/***********************End GetCorporateEnquiryList*****************/
/**************************GetCorporateEnquiryList*****************/
function GetContactEnquiryList(){

  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		},

      "ajax":{

          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{'action' : 'GetContactEnquiryList' }

      },

      "columns": [

            {"data": "name"},
            
            {"data":"email"},

            {"data":"mobile"},

            {"data": "addedOn"},

            {"data": "action"},

         ],

         "order": [[4, 'desc']]



  });

}
/***********************End GetCorporateEnquiryList*****************/
/**************************GetNotificationList*****************/
function GetNotificationList(){

  $('#tableDataList').DataTable({

      "processing": true,

      "serverSide": true,

      "pageLength": 10,
      	"preDrawCallback": function (settings) {                
			currentAjax = 1 ;
        },
        "fnDrawCallback": function( oSettings ) {
			currentAjax = 0 ;
		}, 

      "ajax":{

          "url": DASHURL+'/admin/commonajax',

          "dataType": "json",

          "type": "POST",

          "data":{'action' : 'GetNotificationList' }

      },

      "columns": [

            {"data": "notification"},
            
            {"data":"time"},

            {"data":"status"},

            {"data": "action"},

         ],

         "order": [[3, 'desc']]



  });

}
/***********************End GetNotificationList*****************/


function updateOrderDetails(obj, e){
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

	
		currentAjax = 1 ;
		$.ajax({
		url: COMMONAJAX,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
			currentAjax = 0 ;
			
		  if(response.valid){
		    $(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
		    setTimeout(function(){window.location.href = window.location.href; }, 1000);
		  }else
		    $(obj).find('.msg').html(getMsg(response.msg,2)).css('display','block');

		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find(".firstinput").focus();	  
		  setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}, 3000);
		},
		error:function(response){
			currentAjax = 0 ;
			
		  $(obj).find('.actionbtn').text(btnText);
		  $(obj).find('.msg').html(getMsg("Something went wrong!",2)).css({'display':'block'});
		  setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}, 3000);
		}
	});
}

/*-------- update Address  -----------*/
function updateAddress(obj,e) {
  $(obj).find('.msg').html('');
	e.preventDefault();
	currentAjax = 1 ;
	$.ajax({
    	url:COMMONAJAX,
    	method:'POST',
    	data: new FormData(obj),
    	contentType: false,
    	cache: false,
    	processData:false,
		success:function(response){
			currentAjax = 0 ;
			
		  if(response.valid){
		    $(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
		    setTimeout(function(){window.location.href = window.location.href; }, 2000);
		  }else
		    $(obj).find('.msg').html(getMsg(response.msg,2)).css('display','block');

		  $(obj).find('.validate-form').html(btnText);
		  $(obj).find(".firstinput").focus();	  
		  setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}, 3000);
		},
		error:function(response){
			currentAjax = 0 ;
			
		  $(obj).find('.validate-form').html(btnText);
		  $(obj).find('.msg').html(getMsg("Something went wrong!",2)).css({'display':'block'});
		  setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}, 3000);
		}
  	});
}

/*-------- getDashboardfilterData  -----------*/
function getDashboardfilterData(obj,e) {
	e.preventDefault();
	currentAjax = 1 ;
	$.ajax({
    	url:COMMONAJAX,
    	method:'POST',
    	data: new FormData(obj),
    	contentType: false,
    	cache: false,
    	processData:false,
		success:function(response){
			currentAjax = 0 ;
			
		  if(response.valid){
		    $('.filter-section').find('.font-weight-medium:eq(0)').html('<i class="fa fa-inr" aria-hidden="true"></i>'+response.data.totalRevenue);
		    $('.filter-section').find('.font-weight-medium:eq(1)').html(response.data.totalOrder);
		    $('.filter-section').find('.font-weight-medium:eq(2)').html(response.data.totalSuccess);
		    $('.filter-section').find('.font-weight-medium:eq(3)').html(response.data.totalFailed);
		  }
		  $(obj).find('.validate-form').html('Filter');	  
		  
		},
		error:function(response){
			currentAjax = 0 ;
		  $(obj).find('.validate-form').html('Filter');
		  
		}
  	});
}

