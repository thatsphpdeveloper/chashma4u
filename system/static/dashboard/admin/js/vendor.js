var DASHURL =  BASEURL+'/dashboard';

var DASHSTATIC =  BASEURL+'/system/static/dashboard';

var baseurl=DASHURL+'/vendor/commonajax';

$(document).ready(function(){
	GetDataOfThisPage();


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


/************Calling function according to current page**********/

function GetDataOfThisPage() {

  var uriArray=returnUriArray();

  if($.inArray( "order", uriArray ) > -1)
    orderHistory();
  else if($.inArray("employeelist",uriArray) > -1 && $.inArray("employee",uriArray) > -1)
  	GetEmployeeList();
  else if($.inArray("role",uriArray) > -1 )
  	GetRoleList();
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

  $('#deleteyes').html("Processing..");

  $.ajax({

    url: baseurl, 

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
      if( status == 0 )
      	$('.table').find('tbody tr:eq('+parseInt(index)+')').find('td:last').find('button.text-danger').addClass('text-success').removeClass('text-danger');
      else      	
      	$('.table').find('tbody tr:eq('+parseInt(index)+')').find('td:last').find('button.text-success').addClass('text-danger').removeClass('text-success');
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

    url: baseurl,

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

  $.ajax({

    url: baseurl,

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



/***************** Order Section ***************************/


function completedOrderList(){
	$('#tableDataList').DataTable({
		"processing": true,
		"serverSide": true,
		"pageLength": 20,
		"ajax":{
			"url": baseurl,
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


function changeOrderStatus(obj, e){
	e.preventDefault();
	$(obj).find('.msg').html('').css('display','none');
	var btnText = $(obj).find('.actionbtn').text().trim();
	if( btnText == "Processing..." )
		return false;
	$(obj).find('.actionbtn').text("Processing...");
	var baseurl=DASHURL+'/vendor/commonajax';
	$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
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
		  	$(obj).find('.actionbtn').text(btnText);
		  	$(obj).find('.msg').html(getMsg("Something went wrong!",2)).css({'display':'block'});
		 	setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 2000);
		}
	});
}


/***************** End Order Section ***************************/

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
	
	$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
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
		  	$(obj).find('.actionbtn').text(btnText);
		  	$(obj).find('.msg').html(getMsg("Something went wrong!",2)).css({'display':'block'});
		  	$('html, body').animate({scrollTop:0}, 'slow');
		 	setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 3000);
		}
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
	
	$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
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

      "pageLength": 20,

      "ajax":{
             
          "url": baseurl,

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
	
	$.ajax({
		url: baseurl,
		type: "POST",
		data: {"action" : "gettabSubItemRecords", "tab" : "role", "key" : "addedById", "value" : $(this).val()},
		success:function(response){	    	
		  	  
		  	if( response.valid ) 
		  		$('#roleId').html(response.data.roleDropDown).focus();
		  		
		  	setTimeout(function() {removepoploader();}, 200);
		},
		error:function(response){
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
	
	$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
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
	
	$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
		  	if(response.valid){
		    	$(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
			}else
		    	$(obj).find('.msg').html(getMsg(response.msg,2)).css('display','block');

			$(obj).find('.actionbtn').text(btnText);
			setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 3000);
		},
		error:function(response){			
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

      "pageLength": 20,

      "ajax":{
             
          "url": baseurl,

          "dataType": "json",

          "type": "POST",

          "data":{"action" : "GetRoleList" }

      },
          
      "columns": [
            
            {"data": "role"},
            
            {"data": "totalEmp"},

            {"data": "addedOn"},

            {"data": "action"},

         ],

         "order": [[3, 'desc']]



  });

}


/***************** End role Section ***************************/


/***************** End role Section ***************************/

function ChangeUserPassword(obj,e,btn){
	e.preventDefault();
	$(obj).find('.msg').html('').css('display','none');	
	$.ajax({
		type: "POST",
		data: new FormData(obj),
		url: baseurl,
		contentType: false,
		cache: false,
		processData:false,
		success: function(response) {
			$(btn).html('<i class="fa fa-fw fa-lg fa-check-circle" ></i>Submit');
			if(response.valid==true){
				$(obj).find('.msg').html(getMsg(response.msg,1)).css('display','block');
				ResetTextBox(obj);
				setTimeout(function(){window.location.href=DASHURL+'/vendor/welcome';},3000);
			}
			else{
				$('#form_current_password').focus();
				$(obj).find('.msg').html((response.msg)?getMsg(response.msg,2):getMsg('Something is wrong',2)).css('display','block');

			}
			setTimeout(function(){$(obj).find('.msg').html('').css('display','none');},4000);
		} ,
		error:function(response){
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
	debugger;
	$.ajax({
		url: baseurl,
		type: "POST",
		data: new FormData(obj),
		contentType: false,
		cache: false,
		processData:false,
		success:function(response){
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
		  	$(obj).find('.actionbtn').text(btnText);
		  	$(obj).find('.msg').html(getMsg("Something went wrong!",2)).css({'display':'block'});
		  	$('html, body').animate({scrollTop:0}, 'slow');
		 	setTimeout(function(){$(obj).find('.msg').html('').css('display','none');}	, 3000);
		}
	});
}


function orderHistory(){
    var fiterTab =$('.template-demo .btn.btn-primary').data('filter');
  if($('#tableDataList'+fiterTab).length){
  	let coloums = '';
    let orderBy = 5;
    if(fiterTab == 'Ongoing'){

	    $('#tableDataList'+fiterTab).DataTable({
	      "processing": true,
	      "serverSide": true,
	      "pageLength": 10,
	      "ajax":{
	        "url": baseurl,
	        "dataType": "json",
	        "type": "POST",
	        "data":{"action" : "orderHistory", "filterOrder": fiterTab}
	      },
	      "columns": [
          {"data": "generatedId"},
          {"data": "totalProduct"},
          {"data": "city"},
          {"data": "vendorAmt"},
          {"data": "status"},
          {"data": "isPaidToVendor"},
          {"data": "addedOn"},
          {"data": "deliveryDate"},
          {"data": "action"}
        ],
	      "order": [[7, 'desc']]
	    });

    }else if(fiterTab == 'Completed'){

	    $('#tableDataList'+fiterTab).DataTable({
	      "processing": true,
	      "serverSide": true,
	      "pageLength": 10,
	      "ajax":{
	        "url": baseurl,
	        "dataType": "json",
	        "type": "POST",
	        "data":{"action" : "orderHistory", "filterOrder": fiterTab}
	      },
	      "columns": [
          {"data": "generatedId"},
          {"data": "totalProduct"},
          {"data": "city"},
          {"data": "vendorAmt"},
          {"data": "status"},
          {"data": "isPaidToVendor"},
          {"data": "addedOn"},
          {"data": "deliveryDate"},
          {"data": "action"}
        ],
	      "order": [[7, 'desc']]
	    });

    }else if(fiterTab == 'History'){ 

	    $('#tableDataList'+fiterTab).DataTable({
	      "processing": true,
	      "serverSide": true,
	      "pageLength": 10,
	      "ajax":{
	        "url": baseurl,
	        "dataType": "json",
	        "type": "POST",
	        "data":{"action" : "orderHistory", "filterOrder": fiterTab}
	      },
	      "columns": [
          {"data": "generatedId"},
          {"data": "totalProduct"},
          {"data": "city"},
          {"data": "vendorAmt"},
          {"data": "status"},
          {"data": "isPaidToVendor"},
          {"data": "addedOn"},
          {"data": "deliveryDate"},
          {"data": "action"}
        ],
	      "order": [[7, 'desc']]
	    });

    }else{

	    $('#tableDataList'+fiterTab).DataTable({
	      	"processing": true,
	      	"serverSide": true,
	      	"pageLength": 10,
	      "ajax":{
	        "url": baseurl,
	        "dataType": "json",
	        "type": "POST",
	        "data":{"action" : "orderHistory", "filterOrder": fiterTab}
	      },
	      "columns": [
	        {"data": "generatedId"},
	        {"data": "totalProduct"},
	        {"data": "vendorAmt"},
	        {"data": "addedOn"},
	        {"data": "deliveryDate"},
	        {"data": "action"},
	      ],
	      "order": [[5, 'desc']]
	    });
    }
  }
}