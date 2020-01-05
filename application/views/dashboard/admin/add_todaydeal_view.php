<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->
<link href="http://localhost/chashma4u/system/static/frontend/css/jquery-ui.min.css" rel="Stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo DASHSTATIC;?>/admin/css/multiselect.css">
<style type="text/css">
    .radio input[type="radio"], .radio-inline input[type="radio"], .checkbox input[type="checkbox"], .checkbox-inline input[type="checkbox"] {
    position: absolute;
    margin-left: -15px;
}.radio-inline + .radio-inline, .checkbox-inline + .checkbox-inline {
    margin-top: 2px;
    margin-left: 0px;
}
ul.multiselect-container.dropdown-menu li {
    min-height: 27px;
}
.multiselect-container>li>a {
    padding: 0;
    min-height: 27px;
}
ul.multiselect-container.dropdown-menu.show {
    width: 100%;
    background: #d8d9da;
    padding-right: 10px;
}
span.input-group-addon i {
    font-size: 18px;
    padding: 11px;
}
button.btn.btn-default.multiselect-clear-filter i {
    font-size: 23px;
}
.bg-warning {
    background-color: #f7d999 !important;
}
.bg-success {
    background-color: #a2daa3 !important;
}.bg-danger {
    background-color: #efabaa !important;
}
div#pnlEventCalendar {
    width: 40%;
    margin: 20px auto;

}
div#pnlEventCalendar .datepicker-inline{
  width: 100% !important;
}


</style>
    <?php $this->load->viewD('inc/sidebar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper"><?php echo $this->common_lib->showSessMsg(); ?>
            <div class ="row">
              <div class="col-md-12 d-flex align-items-stretch grid-margin">
                <div class="row flex-grow">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Today Deal <a href="<?=DASHURL.'/'.$this->sessDashboard?>/product/todaydeallist" class="btn btn-success pull-right">Today Deal List</a></h4>
                          <?php  
                             $times = array('00:00','00:30','01:00','01:30','02:00','02:30','03:00','03:30','04:00','04:30','05:00','05:30','06:00','06:30','07:00','07:30','08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30','12:00','12:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','16:30','17:00','17:30','18:00','18:30','19:00','19:30','20:00','20:30','21:00','21:30','22:00','22:30','23:00','23:30');
                            ?>
                        <form class="forms-sample formarea" method="post" action="#" novalidate enctype="multipart/form-data">
                          <p class="msg"></p>
                          <div class="form-group <?php echo (!isset($todaydealData->date))?'':'hide'; ?>">
                            <label for="categoryName">Date</label>
                            <div  id="pnlEventCalendar"></div>
                            <input type="hidden" class="form-control" name="date" value="<?=(isset($isError) && isset($_POST['date']))?$_POST['date']:(isset($todaydealData->date)? $todaydealData->date :date('Y-m-d')) ?>" required>
                          </div>
                          <div class="form-group <?php echo (!isset($todaydealData->date))?'hide':''; ?>" >
                              <p> <b> Date</b> : <?= @$todaydealData->date;?></p>
                          </div>
                          <div class="form-group">
                              <label >Start Time<span class="asterisk">*</span></label>
                              <select class="form-control firstinput" name="startTime" id="startTime" onchange="checkCloseTime(this,event,'#endTime')" required="required">
                                  <option value="">Select Option</option>
                                  <?php  
                                      foreach($times as $time) { 
                                          $isTimeSelected = (isset($isError) && isset($_POST['startTime']))?(($_POST['startTime'] == $time)?'Selected':""):((isset($todaydealData->startTime) && $todaydealData->startTime == $time) ? 'Selected' :'') ;
                                              ?>
                                          <option value="<?php echo $time?>" <?php echo $isTimeSelected; ?> ><?php echo $time;?></option>
                                    <?php }   ?>
                              </select>
                          </div><!-- /.form-group -->

                          <div class="form-group">
                              <label >End Time<span class="asterisk">*</span></label>
                              <select class="form-control" name="endTime" id="endTime" onchange="checkCloseTime(this,event,'#startTime')" required="required">
                                  <option value="">Select Option</option>
                                  <?php  
                                      foreach($times as $time) {
                                          $isTimeSelected = (isset($isError) && isset($_POST['endTime']))?(($_POST['endTime'] == $time)?'Selected':""):((isset($todaydealData->endTime) && $todaydealData->endTime == $time) ? 'Selected' :'') ;
                                              ?>
                                              ?>
                                          <option value="<?php echo $time?>" <?php echo $isTimeSelected; ?> ><?php echo $time;?></option>
                                    <?php }   ?>
                              </select>
                          </div><!-- /.form-group -->

                          <div class="form-group">
                              <label >product<span class="asterisk">*</span></label>
                              <br>
                              <select id="example-xss-html"  name="product[]" multiple="multiple" required="required">
                                <?php   

                                  if(isset($productData) && !empty($productData)) {
                                      $productIds = (isset($todaydealData->todaydealProductId) && !empty($todaydealData->todaydealProductId))?explode(',', $todaydealData->todaydealProductId):array();
                                      foreach($productData as $product) {
                                          if (isset($isError) && isset($_POST['discountedPrice'.$product->productId]) && !empty($_POST['discountedPrice'.$product->productId]) && isset($_POST['variableId'.$product->productId]) && !empty($_POST['variableId'.$product->productId]) && !empty($product->variableData)) {
                                              foreach ($product->variableData as $key => $variable) {
                                                  if (in_array($variable->variableId, $_POST['variableId'.$product->productId])) {
                                                      $vkey = array_search ($variable->variableId, $_POST['variableId'.$product->productId]);
                                                      $variable->discountedPrice = $_POST['discountedPrice'.$product->productId][$vkey];
                                                  }else
                                                      $variable->isNotRequired = 1;
                                              }
                                          }else if (isset($isError) && isset($_POST['discountedPrice']) && !empty($_POST['discountedPrice']) && isset($_POST['productId']) && !empty($_POST['productId'])) {
                                              if (in_array($product->productId, $_POST['productId'])) {
                                                  $pkey = array_search ($product->productId, $_POST['productId']);
                                                  $product->discountedPrice = $_POST['discountedPrice'][$pkey];
                                              }
                                          }
                                          $isSelected = (isset($isError) && isset($_POST['productId']))?((in_array($product->productId, $_POST['productId']))?'Selected':""):((in_array($product->productId, $productIds))?'selected':"");

                                          $html = '&lt;span  class="hide" data-name="'.$product->productName.'" data-price="'.$product->price.'" data-price2="'.$product->discountedPrice.'" data-variable=\''.((!empty($product->variableData))?json_encode($product->variableData):'').'\' &gt;Option 1&lt;/span&gt;';
                                          echo '<option value="'.$product->productId.'" '.$isSelected.'> '.$product->productName.$html.'  </option>';
                                      }
                                  }  ?>
                              </select>
                          </div><!-- /.form-group --> 

                          <div class="form-group product">
                          </div><!-- /.form-group --> 
                          <input type="hidden" name="action" value="addCategory">
                          <input type="hidden" name="hiddenval" value="">
                          <input type="hidden" name="indexval" value="">
                          <button type="submit" class="btn btn-success mr-2 actionbtn">Submit</button>
                          <button class="btn btn-light">Cancel</button>
                        </form>
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
<script src="http://localhost/chashma4u/system/static/frontend/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo DASHSTATIC;?>/admin/js/multiselect.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example-xss-html').multiselect({
                enableHTML: true, 
                includeSelectAllOption: true,
                buttonWidth: '100%',
                enableFiltering: true,
                enableFiltering: true,
                nonSelectedText: "Select Product",
                nSelectedText: " - product selected",
                allSelectedText: "All Product Selected",
                filterPlaceholder: "Search Product",
                selectAllText: "Select All",
                selectAllNumber: false,
                enableCaseInsensitiveFiltering: true
            });
            
            $('ul.multiselect-container').find('li.active').each(function (){
                appendThis($(this).find('input[type=checkbox]'));
            });

            $(document).on('change', 'ul.multiselect-container input[type=checkbox]',function(){
                var product = $(this).closest('label').text();
                var productName = product.split("(Rs");
                var price = parseInt(productName[1], 10);
                if ($(this).val() == 'multiselect-all') {
                    if($(this).prop("checked")){
                        $(this).closest( "li" ).nextAll('li.active').each(function (){
                                appendThis($(this).find('input[type=checkbox]'));
                        });
                    }
                    else{
                        $(this).closest( "li" ).nextAll().each(function (){
                            if ($(this).attr('style') != 'display: none;')
                                removeThis($('.details-'+$(this).find('input[type=checkbox]').val()));
                        });
                    }

                }else{
                    if($(this).prop("checked"))
                        appendThis($(this));                    
                    else
                        removeThis($('.details-'+$(this).val()));                    
                }
              
            });

        });
        function appendThis(productObj) {
            var variableHtmlData= '';
            var productId = productObj.val();
            var productName = productObj.closest('label.checkbox').find('span.hide').attr('data-name');
            var productPrice = productObj.closest('label.checkbox').find('span.hide').attr('data-price');
            var discountedPrice = productObj.closest('label.checkbox').find('span.hide').attr('data-price2');
            variableData = productObj.closest('label.checkbox').find('span.hide').attr('data-variable');
            if (variableData != '') {
                var todaydealId = $('#todaydealId').val();
                $.each(JSON.parse(variableData), function (key, variable) {
                    productId = variable.productId;
                    variable.discountedPrice = (parseFloat(variable.discountedPrice) > 0)?parseFloat(variable.discountedPrice).toFixed(2):0;
                    if (todaydealId > 0 && variable.isNotRequired == undefined && variable.discountedPrice == 0)
                        variable.isNotRequired = 1;                    
                    var isNotRequired = (variable.isNotRequired != undefined)?'':'required';
                    var isHide = (variable.isNotRequired != undefined)?'hide':'';
                    var isNotHide = (variable.isNotRequired != undefined)?'':'hide';
                    variableHtmlData += '<div class="col-md-12 variable-box bg-success" style="padding: 10px;margin-bottom: 10px;"><label class="control-label col-sm-3" for="email">'+variable.variableName+'(Rs '+variable.price+')'+' : </label><div class="col-sm-6 discountedPrice-box '+isHide+'"><input type="text" name="discountedPrice'+variable.productId+'[]" value="'+variable.discountedPrice+'" class="form-control discountedPrice" onkeydown="OnlyNumericKey(event)" '+isNotRequired+' placeholder="Discounted Price"><input type="hidden" name="variableId'+variable.productId+'[]" value="'+variable.variableId+'" class="variableId"><input type="hidden" name="variablePrice'+variable.productId+'[]" value="'+variable.price+'"></div><div class="col-md-3"><span class="btn btn-success edit-btn '+isNotHide+'" onclick="editVariable(this)"><i class="fa fa-pencil"></i></span><span class="btn btn-danger pull-right remove-btn '+isHide+'" onclick="removeVariable(this, '+variable.productId+')" style="margin-right: -10px;"><i class="fa fa-trash-o"></i></span></div></div>';

                });
                if (variableHtmlData) {
                    $('.product').append('<div class="product-box details-'+productId+'"><div class="col-md-12 bg-warning" style="padding: 10px;margin-bottom: 10px;"><h4>'+productName+'<span class="btn btn-warning pull-right" onclick="removeProduct(this, '+productId+')" style="margin: -5px 15px 10px 0px;"><i class="fa fa-trash-o"></i></span></h4><input type="hidden" name="productId[]" value="'+productId+'" class="productId"><input type="hidden" name="discountedPrice[]" value="0"><input type="hidden" name="price[]" value="0">'+variableHtmlData+'</div></div>');
                }

            }else if($('.product').find('div.details-'+productId).length == 0){
                discountedPrice = (parseFloat(discountedPrice) > 0)?parseFloat(discountedPrice).toFixed(2):0;
                $('.product').append('<div class="product-box details-'+productId+'"><div class="col-md-12 bg-danger" style="padding: 10px;margin-bottom: 10px;"><div class="form-group"><label class="control-label col-sm-3" for="email">'+productName+'(Rs '+productPrice+')'+' : </label><div class="col-sm-6"><input type="text" name="discountedPrice[]" value="'+discountedPrice+'" class="form-control discountedPrice" onkeydown="OnlyNumericKey(event)" required placeholder="Discounted Price"><input type="hidden" name="productId[]" value="'+productId+'" class="productId"><input type="hidden" name="price[]" value="'+productPrice+'"></div><div class="col-md-3"><span class="btn btn-warning pull-right" onclick="removeProduct(this, '+productId+')"><i class="fa fa-trash-o"></i></span></div></div></div></div>');
            }
            
              
        }
        function removeThis(obj) {
            $(obj).remove();
              
        }
        function checkCloseTime(obj, e, obj1) {
            if($(obj).val() == $(obj1).val())
                $(obj1).find('option:selected').removeAttr("selected");
              
        }
        function removeVariable(obj, productId) { 
            if($(obj).closest('div.product-box').find('div.variable-box').length == 1){
                removeProduct(obj, productId);
            }
            $(obj).closest('div.variable-box').remove();              
        }

        function removeProduct(obj, productId) {
            $(obj).closest('div.product-box').remove();
            $('#example-xss-html').multiselect('deselect', [productId]);              
        }
        function editVariable(obj) {
            $(obj).closest('div.variable-box').find('.discountedPrice-box, .remove-btn').removeClass('hide');
            $(obj).closest('div.variable-box').find('.edit-btn').addClass('hide');              
        }

        
    </script>

    <script>

      $(document).ready(function() {
        var selectedDate = "<?=(isset($isError) && isset($_POST['date']))?$_POST['date']:(isset($todaydealData->date)? $todaydealData->date :date('Y-m-d')) ?>";
        $( "#pnlEventCalendar" ).datepicker({
          minDate: new Date(selectedDate),        
            dateFormat: 'DD, d MM, yy',
          onSelect: function(dateStr) {
            debugger;
               if (dateStr) { 
                    var preFinalDate = new Date(dateStr);
                    var datestring = preFinalDate.getFullYear()  + "-" + (preFinalDate.getMonth() + 1) + "-" + preFinalDate.getDate();
                    $('input[name="date"]').val(datestring);
               }
          }
        });
      });
    </script>