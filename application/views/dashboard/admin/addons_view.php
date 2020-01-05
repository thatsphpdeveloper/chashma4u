<?php $this->load->viewD('inc/header.php'); ?>  
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
</style>
    <!-- partial -->
<?php $this->load->viewD('inc/sidebar.php'); ?>
 
  <div class="main-panel">
        <div class="content-wrapper">
            <div class ="row">
              <div class="col-md-12 d-flex align-items-stretch grid-margin">
                <div class="row flex-grow">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Add Addons <a href="<?=DASHURL.'/'.$this->sessDashboard?>/product/productlist" class="btn btn-success pull-right">Product List</a></h4>
                        <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateAddons(this, event);">
                          <p class="msg"></p>
                          
                          <div class="form-group">
                              <label >product<span class="asterisk">*</span></label>
                              <br>
                              <select id="example-xss-html"  name="product[]" multiple="multiple" required="required">
                                <?php   
                                   if(isset($selectedAddons) && !empty($selectedAddons)){
                                      $selectedAddons->addonsId;
                                     $addonsId = explode(',', $selectedAddons->addonsId); 
                                     
                                   }
                                  if(isset($productData) && !empty($productData)) {
                                      
                                      foreach($productData as $product) {
                                            
                                          $isSelected = (isset($selectedAddons))?((in_array($product->productId, $addonsId))?'Selected':""):((in_array($product->productId, $addonsId))?'selected':"");
                                          
                                          $html = '&lt;span  class="hide" data-name="'.$product->productName.'" &gt;Option 1&lt;/span&gt;';
                                          echo '<option value="'.$product->productId.'" '.$isSelected.'> '.$product->productName.$html.'  </option>';
                                      }
                                  }  ?>
                              </select>
                          </div><!-- /.form-group --> 

                          <div class="form-group product">
                          </div><!-- /.form-group -->

                          <input type="hidden" name="action" value="addAddons">
                          <input type="hidden" name="productId" value="<?=isset($productId) ? $productId:'';?>">
                          <input type="hidden" name="hiddenval" value="">
                          <input type="hidden" name="indexval" value="">
                          <button type="submit" class="btn btn-success mr-2 actionbtn">Submit</button>
                          <a href="<?=DASHURL.'/'.$this->sessDashboard?>/product/productlist" class="btn btn-light">Cancel</a>
                        </form>
                      </div>
                    </div>
                  </div>                  
                </div>
              </div>
            </div> 
        </div>


<?php $this->load->viewD('inc/footer.php'); ?>
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
              debugger;
                var product = $(this).closest('label').text();
                var productName = product.split("(Rs");
                //var price = parseInt(productName[1], 10);
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
          debugger;
            var variableHtmlData= '';
            var productId = productObj.val();
            var productName = productObj.closest('label.checkbox').find('span.hide').attr('data-name');
            
            
              
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