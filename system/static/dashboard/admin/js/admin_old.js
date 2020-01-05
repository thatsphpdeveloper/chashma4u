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
	$(document).on('click', '.addNewSubCategory', function(){
		ResetTextBox('#addTabModel');
		$('#addTabModel').find('input[name=hiddenval]').val('');
		$('#addTabModel').modal('show');
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

/***************** End Zone Section *****************************/

/************Calling function according to current page**********/

function GetDataOfThisPage() {

  var uriArray=returnUriArray();

  if($.inArray( "category", uriArray ) > -1 && $.inArray( "product", uriArray ) > -1)

    GetCategoryList();
  else if($.inArray( "zone", uriArray ) > -1)

    GetZoneList();
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

    },error(d){}

  });

}



/********************** End Delete Records ************************/