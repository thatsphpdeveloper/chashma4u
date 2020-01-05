<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->
    <style type="text/css">
      .accordion-checkbox {
          width: 20px;
      }

      div#accordion {
          width: 100%;
      }

      div#accordion .form-check.form-check-flat {
          margin: 0px;
      }

      div#accordion .submenuItem-body .form-check.form-check-flat {
        margin: 8px 0;
      }

      div#accordion h5.mb-0 {
          display: flex;
          justify-content: left;
          align-items: center;
      }

      div#accordion h5.mb-0 a {
          padding-left: 15px;
      }

      div#accordion .card-header {
        background-color: rgb(221, 218, 218);
      }
      div#accordion .card .card-body {
          box-shadow: 0px 0px 0px #0000004d;
      }

      div#accordion .card .card-body {
          padding: 0.58rem 1.81rem;
      }

      div#accordion .card .submenuItem-body {
          background: #b2b6ba;
      }
      div#accordion a {
          width: 100%;
      }
      div#accordion a.edit-btn {
          width: 20px;
          padding-left: 0px !important;
          margin-right: 8px;
      }
    </style>
    
    <?php $this->load->viewD('inc/sidebar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <div class ="row">
              <div class="col-md-12 d-flex align-items-stretch grid-margin">
                <div class="row flex-grow">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Front Menu Setting <button type="button" class="btn btn-success mr-2 edit-btn pull-right menuFormModalBtn" data-toggle="modal" data-target="#menuFormModal" onclick="resetmenu(this)">Add New Menu</button><button type="button" class="btn btn-success mr-2 pull-right submenuFormModalBtn" data-toggle="modal" data-target="#submenuFormModal" onclick="resetSubmenu(this)">Add New Sub Menu</button>
                          <!-- <button type="button" class="btn btn-success mr-2 pull-right submenuItemFormModalBtn" data-toggle="modal" data-target="#submenuItemFormModal" onclick="resetSubmenuItem(this)">Add New Sub Menu Item</button> -->
                        </h4>
                        <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateMenu(this, event);">
                          <p class="msg"></p>
                 
                          
                          <div class="form-group">
                            <label for="productCategory">Menu</label>
                            <div class="categoryArea mt-1 mb-4">
                              <?php

                              $categoryOptions = '';
                              if(isset($categoryList) && !empty($categoryList)) {
                                foreach( $categoryList as $categoryVal ) {
                                  $categoryOptions .= '<option value="'.$categoryVal->categoryId.'" data-slug="'.$categoryVal->slug.'">'.$categoryVal->categoryName.'</option>';
                                }
                              }


                                $menuOptions = $menuHtml = '';

                                if(isset($menuList) && !empty($menuList)) {

                                  $countCatSection = 0;
                                  $menuHtml .='<div id="accordion">';
                                  foreach( $menuList as $menuVal ) {
                                   $menuHtml .='<div class="card menu-card">
                                    <div class="card-header" id="heading-'.$menuVal->menuId.'">
                                    <h5 class="mb-0">
                                      <div class="accordion-checkbox">
                                        <div class="form-check form-check-flat">
                                          <label class="form-check-label">
                                            <input type="checkbox" class="form-check-input menu-checkbox" name="mainMenu[]" value="'.$menuVal->menuId.'" '.(($menuVal->status == 0)?'checked':'').'>&nbsp;
                                            <i class="input-helper"></i>
                                          </label>
                                        </div>
                                      </div>
                                      <a role="button" data-toggle="collapse" href="#collapse-'.$menuVal->menuId.'" aria-expanded="false" aria-controls="collapse-'.$menuVal->menuId.'" class="collapsed">
                                        '.$menuVal->title.'
                                      </a>
                                      <a class="edit-btn pull-right" href="javascript:" data-type="'.$menuVal->type.'" data-category="'.$menuVal->categoryId.'" data-title="'.$menuVal->title.'" data-url="'.$menuVal->url.'" data-id="'.$menuVal->menuId.'" data-new="'.$menuVal->isNew.'" onclick="editMenu(this, event)">
                                        <i class="menu-icon mdi mdi-pencil pull-right"></i>
                                      </a>
                                    </h5>
                                    </div>
                                    <div id="collapse-'.$menuVal->menuId.'" class="collapse" data-parent="#accordion" aria-labelledby="heading-'.$menuVal->menuId.'">
                                    <div class="card-body">';

                                    $menuOptions .= '<option value="'.$menuVal->menuId.'">'.$menuVal->title.'</option>';

                                    if(isset($menuVal->subMenuList) && !empty($menuVal->subMenuList)) {
                                      $menuHtml .='<div id="accordion-'.$menuVal->menuId.'">';
                                      foreach( $menuVal->subMenuList as $subMenuVal) {
                                        $menuHtml .='
                                        <div class="card submenu-card">
                                        <div class="card-header" id="heading-'.$menuVal->menuId.'-'.$subMenuVal->submenuId.'">
                                        <h5 class="mb-0">

                                          <div class="accordion-checkbox">
                                            <div class="form-check form-check-flat">
                                              <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input submenu-checkbox" name="subMenu[]" value="'.$subMenuVal->submenuId.'"'.(($subMenuVal->status == 0)?'checked':'').' />&nbsp;
                                                <i class="input-helper"></i>
                                              </label>
                                            </div>
                                          </div>
                                          <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-'.$menuVal->menuId.'-'.$subMenuVal->submenuId.'" aria-expanded="false" aria-controls="collapse-'.$menuVal->menuId.'-'.$subMenuVal->submenuId.'">'.$subMenuVal->title.'
                                          </a>
                                          <a class="edit-btn pull-right" href="javascript:" data-id="'.$subMenuVal->submenuId.'" data-new="'.$subMenuVal->isNew.'" onclick="editSubmenu(this, event)">
                                            <i class="menu-icon mdi mdi-pencil pull-right"></i>
                                          </a>
                                        </h5>
                                        </div>
                                        <div id="collapse-'.$menuVal->menuId.'-'.$subMenuVal->submenuId.'" class="collapse" data-parent="#accordion-'.$menuVal->menuId.'" aria-labelledby="heading-'.$menuVal->menuId.'-'.$subMenuVal->submenuId.'">
                                        <div class="card-body submenuItem-body">';

                                    

                                        

                                        if(isset($subMenuVal->submenuItemList) && !empty($subMenuVal->submenuItemList)) {
                                          $menuHtml .='<div class="row">
                                          <div class="col-md-12"><div class="form-group">';
                                          foreach( $subMenuVal->submenuItemList as $subMenuItemVal) {
                                            $menuHtml .='
                                                    <div class="form-check form-check-flat">
                                                      <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input submenuItem-checkbox" name="subMenuItem[]" value="'.$subMenuItemVal->submenuItemId.'"'.(($subMenuItemVal->status == 0)?'checked':'').'> '.$subMenuItemVal->title.'
                                                        <i class="input-helper"></i>

                                                        <a class="edit-btn pull-right" href="javascript:" data-id="'.$subMenuItemVal->submenuItemId.'" data-new="'.$subMenuItemVal->isNew.'" onclick="editSubmenuItem(this, event)">
                                                          <i class="menu-icon mdi mdi-pencil pull-right"></i>
                                                        </a>
                                                        </label>
                                                    </div>';


                                            

                                          }
                                          $menuHtml .='</div></div></div>';

                                        }

                                        $menuHtml .='</div>
                                        </div>
                                        </div>';
                                      }
                                      $menuHtml .='</div>';
                                    }
                                    $menuHtml .='</div>
                                    </div>
                                    </div>';
                                  }
                                  $menuHtml .='</div>';                            
                                }
                                echo $menuHtml;
                              ?>
                             
                          </div>
                          </div>
                          <div class="clearfix"></div>
                          
                          <input type="hidden" name="action" value="updateMenuSetting">
                          <input type="hidden" name="hiddenval" value="<?=isset($productData->productId)? $productData->productId:0;?>">
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
        <!-- menu modal start -->
        <div class="modal fade" id="menuFormModal">
          <div class="modal-dialog">
            <div class="modal-content">
            
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title"><span class="newFormModalTitle">Add New</span> Menu</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              
              <!-- Modal body -->
              <div class="modal-body">
                <div class="col-md-12 d-flex align-items-stretch grid-margin">
                  <div class="row flex-grow">
                    <div class="col-12">
                      <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateMenu(this, event);">
                        <p class="msg"></p>
                        <div class="form-group">
                          <label for="menuType">Type</label>
                          <select class="form-control firstinput" id="menuType" name="menuType" placeholder="Select menu type">
                            <option value="1"> Category wise</option>
                            <option value="0"> Custom</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="categoryId">Category</label>
                          <select class="form-control" id="categoryId" name="categoryId" placeholder="Select category" required>
                            <option value="">Choose Category</option>
                            <?=$categoryOptions; ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="title">Title</label>
                          <input type="text" class="form-control" id="title" name="title" placeholder="Enter menu name" required>
                        </div>
                        <div class="form-group">
                          <label for="url">Url</label>
                          <input type="text" class="form-control" id="url" name="url" placeholder="Enter url" required>
                        </div>
                        <div class="form-check form-check-flat mt-4 mb-4">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input menu-checkbox" name="isNew" id="menuIsNew" value="1" >Display as new
                            <i class="input-helper"></i>
                          </label>
                        </div>
                        <input type="hidden" name="action" value="addMenu">
                        <input type="hidden" name="hiddenval" value="" id="mId">
                        <input type="hidden" name="indexval" value="">
                        <button type="submit" class="btn btn-success mr-2 actionbtn">Submit</button>
                        <button class="btn btn-light" data-dismiss="modal">Cancel</button>
                      </form>
                    </div>                  
                  </div>
                </div>
              </div>              
            </div>
          </div>
        </div>

        <!-- menu modal end -->

        <!-- submenu modal start -->
        <div class="modal fade" id="submenuFormModal">
          <div class="modal-dialog">
            <div class="modal-content">
            
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title"><span class="newFormModalTitle">Add New</span> Sub Menu</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              
              <!-- Modal body -->
              <div class="modal-body">
                <div class="col-md-12 d-flex align-items-stretch grid-margin">
                  <div class="row flex-grow">
                    <div class="col-12">
                      <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateMenu(this, event);">
                        <p class="msg"></p>
                        <div class="form-group">
                          <label for="submenuType">Type</label>
                          <select class="form-control firstinput" id="submenuType" name="submenuType" placeholder="Select submenu type">
                            <option value="1"> Category wise</option>
                            <option value="0"> Custom</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="menuId">Menu</label>
                          <select class="form-control" id="menuId" name="menuId" placeholder="Select menu" required>
                            <option value="">Choose Menu</option>
                            <?=$menuOptions; ?>
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="submenuCategoryId">Category</label>
                          <select class="form-control categoryName" id="submenuCategoryId" name="submenuCategoryId" placeholder="Select sub menu category" required>
                            <option value="">Choose Category</option>
                            <?=$categoryOptions; ?>
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="submenuSubCategoryId">Sub Category</label>
                          <select class="form-control subcategoryName" id="submenuSubCategoryId" name="submenuSubCategoryId" placeholder="Select sub menu subcategory" required>
                            <option value="">Choose Sub Category</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="submenuTitle">Title</label>
                          <input type="text" class="form-control" id="submenuTitle" name="submenuTitle" placeholder="Enter sub menu name" required>
                        </div>
                        <div class="form-group">
                          <label for="submenuUrl">Url</label>
                          <input type="text" class="form-control" id="submenuUrl" name="submenuUrl" placeholder="Enter sub menu url" required>
                        </div>
                        <div class="form-group">
                          <label for="uploadIcons">Upload Icons <span class="text-muted">( Image should be 100*100 )</span></label>
                          <input type="file" name="uploadIcons" id="uploadIcons" value="" accept="image/*" onchange="fileuploadpreview(this)">
                          <div class="previewimg"></div> 
                        </div>

                        <div class="form-check form-check-flat mt-4 mb-4">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input menu-checkbox" name="isNew" id="submenuIsNew" value="1" >Display as new
                            <i class="input-helper"></i>
                          </label>
                        </div>

                        <input type="hidden" name="action" value="addSubMenu">
                        <input type="hidden" name="hiddenval" id="smId" value="">
                        <input type="hidden" name="indexval" value="">
                        <button type="submit" class="btn btn-success mr-2 actionbtn">Submit</button>
                        <button class="btn btn-light" data-dismiss="modal">Cancel</button>
                      </form>
                    </div>                  
                  </div>
                </div>
              </div>              
            </div>
          </div>
        </div>

        <!-- submenu modal end -->

        <!-- submenuitem modal start -->
        <div class="modal fade" id="submenuItemFormModal">
          <div class="modal-dialog">
            <div class="modal-content">
            
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title"><span class="newFormModalTitle">Add New</span> Sub Menu Item</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              
              <!-- Modal body -->
              <div class="modal-body">
                <div class="col-md-12 d-flex align-items-stretch grid-margin">
                  <div class="row flex-grow">
                    <div class="col-12">
                      <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateMenu(this, event);">
                        <p class="msg"></p>
                        <div class="form-group">
                          <label for="submenuType">Type</label>
                          <select class="form-control firstinput" id="submenuItemType" name="submenuItemType" placeholder="Select submenuItem type">
                            <option value="1"> Category wise</option>
                            <option value="0"> Custom</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="submenuItemMenuId">Menu</label>
                          <select class="form-control" id="submenuItemMenuId" name="submenuItemMenuId" placeholder="Select menu" required>
                            <option value="">Choose Menu</option>
                            <?=$menuOptions; ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="submenuItemSubmenuId">Sub Menu</label>
                          <select class="form-control" id="submenuItemSubmenuId" name="submenuItemSubmenuId" placeholder="Select submenu" required>
                            <option value="">Choose Sub Menu</option>
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="submenuItemCategoryId">Category</label>
                          <select class="form-control categoryName" id="submenuItemCategoryId" name="submenuItemCategoryId" placeholder="Select sub menu category" required>
                            <option value="">Choose Category</option>
                            <?=$categoryOptions; ?>
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="submenuItemSubCategoryId">Sub Category</label>
                          <select class="form-control subcategoryName" id="submenuItemSubCategoryId" name="submenuItemSubCategoryId" placeholder="Select subcategory" required>
                            <option value="">Choose Sub Category</option>
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="submenuItemSubCategoryItemId">Sub Category Item</label>
                          <select class="form-control subcategoryItemName" id="submenuItemSubCategoryItemId" name="submenuItemSubCategoryItemId" placeholder="Select subcategory item" required>
                            <option value="">Choose Sub Category Item</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="submenuItemTitle">Title</label>
                          <input type="text" class="form-control" id="submenuItemTitle" name="submenuItemTitle" placeholder="Enter submenu item name" required>
                        </div>
                        <div class="form-group">
                          <label for="submenuItemUrl">Url</label>
                          <input type="text" class="form-control" id="submenuItemUrl" name="submenuItemUrl" placeholder="Enter submenu item url" required>
                        </div>

                        <div class="form-check form-check-flat mt-4 mb-4">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input menu-checkbox" name="isNew" id="submenuItemIsNew" value="1" >Display as new
                            <i class="input-helper"></i>
                          </label>
                        </div>

                        <input type="hidden" name="action" value="addSubMenuItem">
                        <input type="hidden" name="hiddenval" id="smiId" value="">
                        <input type="hidden" name="indexval" value="">
                        <button type="submit" class="btn btn-success mr-2 actionbtn">Submit</button>
                        <button class="btn btn-light" data-dismiss="modal">Cancel</button>
                      </form>
                    </div>                  
                  </div>
                </div>
              </div>              
            </div>
          </div>
        </div>

        <!-- menu modal end -->
        <!-- partial:partials/_footer.html -->
<?php $this->load->viewD('inc/footer.php'); ?>


<script type="text/javascript">



  $(document).on('change', '.submenuItem-checkbox', function(){
    if($(this).is(':checked')){
      $(this).closest('.submenu-card').find('.submenu-checkbox').prop('checked', true);
      $(this).closest('.menu-card').find('.menu-checkbox').prop('checked', true);
    }else{
      if(!$(this).closest('.submenu-card').find('.submenuItem-checkbox:checked').length){
        $(this).closest('.submenu-card').find('.submenu-checkbox').prop('checked', false);
      }
      if(!$(this).closest('.menu-card').find('.submenu-checkbox:checked').length){
        $(this).closest('.menu-card').find('.menu-checkbox').prop('checked', false);
      }
    }
  });

  $(document).on('change', '.submenu-checkbox', function(){
    if($(this).is(':checked')){
      $(this).closest('.submenu-card').find('.submenuItem-checkbox').prop('checked', true);
      $(this).closest('.menu-card').find('.menu-checkbox').prop('checked', true);
    }else{
      $(this).closest('.submenu-card').find('.submenuItem-checkbox').prop('checked', false);

      if(!$(this).closest('.menu-card').find('.submenu-checkbox:checked').length){
        $(this).closest('.menu-card').find('.menu-checkbox').prop('checked', false);
      }
    }
  });

  $(document).on('change', '.menu-checkbox', function(){
    if($(this).is(':checked')){
      $(this).closest('.menu-card').find('.submenu-checkbox, .submenuItem-checkbox').prop('checked', true);
    }else{
      $(this).closest('.menu-card').find('.submenu-checkbox, .submenuItem-checkbox').prop('checked', false);
    }
  });

  // menu script
  $(document).on('change', '#menuType', function(){
    if($(this).val() == '1'){
      $('#categoryId').attr('required','required').closest('div').removeClass('hide');
    }else{
      $('#categoryId').removeAttr('required').closest('div').addClass('hide');
    }
  });

  $(document).on('change', '#categoryId', function(){

    $('#title').val($("#categoryId option:selected").html());
    $('#url').val(BASEURL+'/'+$("#categoryId option:selected").attr('data-slug'));
    
  });

  /// sub category 
  $(document).on('change', '#submenuType', function(){
    if($(this).val() == '1'){
      $('#submenuCategoryId,#submenuSubCategoryId').attr('required','required').closest('div').removeClass('hide');
    }else{
      $('#submenuCategoryId,#submenuSubCategoryId').removeAttr('required').closest('div').addClass('hide');
    }
  });

  $(document).on('change', '#submenuSubCategoryId', function(){

    $('#submenuTitle').val($("#submenuSubCategoryId option:selected").html());
    $('#submenuUrl').val(BASEURL+'/'+$("#submenuSubCategoryId option:selected").attr('data-slug'));
    
  });


  $(document).on('change', '.categoryName', function() {
    
      if($(this).val() == '') {
      $('.subcategoryName').html('<option value="">Choose Sub Category</option>');
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
        var optionHtml = '<option value="">Choose Sub Category</option>';
        $(data).each(function(key,value){
          
          optionHtml += '<option value="'+value.subcategoryId+'" data-slug="'+value.slug+'">'+value.subcategoryName+'</option>';
        });
        $('.subcategoryName').html(optionHtml);
        } 
        else
        $('.subcategoryName').html('<option value="">Choose Sub Category</option>');

      },error:function(data){
       
      }
      });
  });


  /// sub category item 
  $(document).on('change', '#submenuItemType', function(){
    if($(this).val() == '1'){
      $('#submenuItemCategoryId,#submenuItemSubCategoryId,#submenuItemSubCategoryItemId').attr('required','required').closest('div').removeClass('hide');
    }else{
      $('#submenuItemCategoryId,#submenuItemSubCategoryId,#submenuItemSubCategoryItemId').removeAttr('required').closest('div').addClass('hide');
    }
  });

  $(document).on('change', '#submenuItemSubCategoryItemId', function(){

    $('#submenuItemTitle').val($("#submenuItemSubCategoryItemId option:selected").html());
    $('#submenuItemUrl').val(BASEURL+'/'+$("#submenuItemSubCategoryItemId option:selected").attr('data-slug'));
    
  });


  $(document).on('change', '.subcategoryName', function() {
    
      if($(this).val() == '') {
      $('.subcategoryItemName').html('<option value="">Choose Sub Category Item</option>');
      return false;
      }
      var formData = {action:'getsubcategoryItemName',subcategoryId:$(this).val()};
      $.ajax({
      type: 'POST',
      url: DASHURL+'/admin/commonajax',
      data: formData,
      async :false,
      success: function(data){
        
        if(data.length > 0 ){
        var optionHtml = '<option value="">Choose Sub Category Item</option>';
        $(data).each(function(key,value){
          
          optionHtml += '<option value="'+value.subcategoryItemId+'" data-slug="'+value.slug+'">'+value.subcategoryItemName+'</option>';
        });
        $('.subcategoryItemName').html(optionHtml);
        } 
        else
        $('.subcategoryItemName').html('<option value="">Choose Sub Category Item</option>');

      },error:function(data){
       
      }
      });
  });

  $(document).on('change', '#submenuItemMenuId', function() {
    
      if($(this).val() == '') {
      $('#submenuItemSubmenuId').html('<option value="">Choose Sub Menu</option>');
      return false;
      }
      var formData = {action:'getsubmenu',menuId:$(this).val()};
      $.ajax({
      type: 'POST',
      url: DASHURL+'/admin/commonajax',
      data: formData,
      async :false,
      success: function(data){
        
        if(data.length > 0 ){
        var optionHtml = '<option value="">Choose Sub Menu</option>';
        $(data).each(function(key,value){
          
          optionHtml += '<option value="'+value.submenuId+'">'+value.title+'</option>';
        });
        $('#submenuItemSubmenuId').html(optionHtml);
        } 
        else
        $('#submenuItemSubmenuId').html('<option value="">Choose Sub Menu</option>');

      },error:function(data){
       
      }
      });
  });


  //edit section
  // menu 
  function resetmenu(obj) {
    $("#menuType option").removeAttr("selected");
    $("#categoryId option").removeAttr("selected");
    $("#url").val('');
    $("#title").val('');
    $("#md").val('0');
  }

  function editMenu(obj, e){
    $("#menuType option[value='"+$(obj).data('type')+"']").attr("selected","selected");
    $("#categoryId option[value='"+$(obj).data('category')+"']").attr("selected","selected");
    $("#title").val($(obj).data('title'));
    $("#url").val($(obj).data('url'));
    $("#mId").val($(obj).data('id'));
    $("#menuIsNew").prop('checked', ($(obj).data('new') == '1')?true:false);

    if($(obj).data('type') == '1')
      $('#categoryId').closest('div').removeClass('hide').attr('required','required');
    else
      $('#categoryId').closest('div').addClass('hide').removeAttr('required');
    

    $('#menuFormModal').modal('show');
  }

  // sub menu 
  function resetSubmenu(obj) {
    $("#submenuType option").removeAttr("selected");
    $("#menuId option").removeAttr("selected");
    $("#submenuCategoryId option").removeAttr("selected");
    $("#submenuSubCategoryId option").removeAttr("selected");
    $("#submenuUrl").val('');
    $("#submenuTitle").val('');
    $("#smId").val('0');
  }
  function editSubmenu(obj, e){
    resetSubmenu(obj);
    let submenuId = $(obj).data('id');
    
    var formData = {action:'editSubmenu',submenuId:submenuId};
    $.ajax({
      type: 'POST',
      url: DASHURL+'/admin/commonajax',
      data: formData,
      async :false,
      success: function(response){

        if(response.valid){
          $("#submenuType option[value='"+response.submenuData.type+"']").attr("selected","selected");
          $("#menuId option[value='"+response.submenuData.menuId+"']").attr("selected","selected");
          $("#submenuCategoryId option[value='"+response.submenuData.categoryId+"']").attr("selected","selected");
          $("#submenuSubCategoryId").html(response.submenuData.subcategoryOptions);
          $("#submenuUrl").val(response.submenuData.url);
          $("#submenuTitle").val(response.submenuData.title);
          $("#smId").val(response.submenuData.submenuId);
          $("#submenuIsNew").prop('checked', (response.submenuData.isNew == '1')?true:false);
          if(response.submenuData.img)
            $(".previewimg").html('<img src="'+UPLOADPATH+'/menu_images/'+response.submenuData.img+'" height="70px" width="70px">');

          if(response.submenuData.type == '1')
            $('#submenuCategoryId, #submenuSubCategoryId').attr('required','required').closest('div').removeClass('hide');
          else
            $('#submenuCategoryId, #submenuSubCategoryId').removeAttr('required').closest('div').addClass('hide');

          $('#submenuFormModal').modal('show');
        }

      },error:function(data){
       
      }
    });    

  }


  // sub menu item
  function resetSubmenuItem(obj) {
    $("#submenuItemType option").removeAttr("selected");
    $("#submenuItemMenuId option").removeAttr("selected");
    $("#submenuItemSubmenuId option").removeAttr("selected");
    $("#submenuItemCategoryId option").removeAttr("selected");
    $("#submenuItemSubCategoryId option").removeAttr("selected");
    $("#submenuItemSubCategoryItemId option").removeAttr("selected");
    $("#submenuItemUrl").val('');
    $("#submenuItemTitle").val('');
    $("#smiId").val('0');
  }
  function editSubmenuItem(obj, e){
    resetSubmenu(obj);
    let submenuItemId = $(obj).data('id');
    
    var formData = {action:'editSubmenuItem',submenuItemId:submenuItemId};
    $.ajax({
      type: 'POST',
      url: DASHURL+'/admin/commonajax',
      data: formData,
      async :false,
      success: function(response){

        if(response.valid){
          $("#submenuItemType option[value='"+response.submenuItemData.type+"']").attr("selected","selected");
          $("#submenuItemMenuId option[value='"+response.submenuItemData.menuId+"']").attr("selected","selected");
          $("#submenuItemCategoryId option[value='"+response.submenuItemData.categoryId+"']").attr("selected","selected");
          $("#submenuItemSubmenuId").html(response.submenuItemData.submenuOptions);
          $("#submenuItemSubCategoryId").html(response.submenuItemData.subcategoryOptions);
          $("#submenuItemSubCategoryItemId").html(response.submenuItemData.subcategoryItemOptions);
          $("#submenuItemUrl").val(response.submenuItemData.url);
          $("#submenuItemTitle").val(response.submenuItemData.title);
          $("#smiId").val(response.submenuItemData.submenuItemId);
          $("#submenuItemIsNew").prop('checked', (response.submenuItemData.isNew == '1')?true:false);

          if(response.submenuItemData.type == '1')
            $('#submenuItemCategoryId, #submenuItemSubCategoryId, #submenuItemSubCategoryItemId').attr('required','required').closest('div').removeClass('hide');
          else
            $('#submenuItemCategoryId, #submenuItemSubCategoryId, #submenuItemSubCategoryItemId').removeAttr('required').closest('div').addClass('hide');

          $('#submenuItemFormModal').modal('show');
        }

      },error:function(data){
       
      }
    });    

  }

</script>