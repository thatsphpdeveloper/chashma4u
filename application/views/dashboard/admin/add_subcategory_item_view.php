<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->
    
    <?php $this->load->viewD('inc/sidebar.php'); ?>
      <!-- partial -->
      <style type="text/css">
        .note-toolbar-wrapper{
          min-height: 50px !important;
        }
      </style>
      <div class="main-panel">
        <div class="content-wrapper">
            <div class ="row">              
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Sub Category Item List</h4>  
                    <button type="button" class="btn btn-success btn-fw pull-right addNewSubCategory">Add New</button>
                    <div class="table-responsive">
                      <table class="table" id="tableDataList">
                        <thead>
                          <tr>
                            <th>Icons</th>
                            <th>SubCategory Item Name</th>
                            <th>SubCategory Name</th>
                            <th>Category Name</th>
                            <th>isNew</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div> 
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <!-- Model Content -->
        <div id="viewTabModel" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">View Details</h4>
              </div>
              <div class="modal-body">
                  <div class="form-group  row">
                    <label for="viewCategoryName" class="col-sm-5 col-form-label">Category Name</label>
                    <div class="col-sm-7" id="viewCategoryName">
                      
                    </div>
                  </div>
                  <div class="form-group  row">
                    <label for="viewDescription" class="col-sm-5 col-form-label">Description</label>
                    <div class="col-sm-7" id="viewDescription">
                      
                    </div>
                  </div>
                  <div class="form-group  row">
                    <label for="viewIsNew" class="col-sm-5 col-form-label">isNew</label>
                    <div class="col-sm-7" id="viewIsNew">
                      
                    </div>
                  </div>
                  <div class="form-group  row">
                    <label for="viewMetaTitle" class="col-sm-5 col-form-label">Meta Title</label>
                    <div class="col-sm-7" id="viewMetaTitle">
                      
                    </div>
                  </div>
                  <div class="form-group  row">
                    <label for="viewMetaDescription" class="col-sm-5 col-form-label">Meta Description</label>
                    <div class="col-sm-7" id="viewMetaDescription">
                      
                    </div>
                  </div>
                  <div class="form-group  row">
                    <label for="viewMetaKeywords" class="col-sm-5 col-form-label">Meta Keywords</label>
                    <div class="col-sm-7" id="viewMetaKeywords">
                      
                    </div>
                  </div>
                  <!-- <div class="form-group  row">
                    <label for="viewIcons" class="col-sm-3 col-form-label">Icons</label>
                    <div class="col-sm-9" id="viewIcons">
                      
                    </div>
                  </div> -->


              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>
        <div id="addTabModel" class="modal fade" role="dialog">
          <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New</h4>
              </div>
              <div class="modal-body">
                 <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateSubCategoryItem(this, event);">
                    <p class="msg"></p>
                    <div class="form-group col-lg-6">
                      <label for="categoryName">Category Name</label>
                      <select name="categoryName" class="form-control categoryName" id="categoryName" required>
                        <option value=""> Choose Category </option>
                        <?php echo @$categoryDropDown;?>
                      </select>
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="categoryName">Sub Category Name</label>
                      <select name="subcategoryName" class="form-control" id="subcategoryName" required>
                        <option value=""> Choose Sub Category </option>
                      </select>
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="subCategoryName">Sub Category Item Name</label>
                      <input type="text" class="form-control firstinput" id="subcategoryItemName" name="subcategoryItemName" placeholder="Enter sub category item name" required>
                    </div>
                    <div class="form-group col-lg-6">
                            <label for="categoryName">Sub Category Item Slug</label>
                            <input type="text" class="form-control firstinput" id="slugName" name="slugName" placeholder="Enter sub category item slug name">
                    </div>
                    <div class="form-group col-lg-12">
                      <label for="description">Description</label>
                      <textarea class="form-control" id="description" rows="3" name="description" placeholder="Category Description"></textarea>
                    </div>
                    <div class="form-group col-lg-12">
                            <label>Extra Description</label>
                            <textarea class="form-control" name="extraDescription" id="aboutus" placeholder="Extra Description" tabindex="5" required></textarea>
                    </div>
                    <div class="form-group col-lg-12 hide">
                      <label for="isNew">Display as is new Category highlighter</label>
                      <input type="checkbox" name="isNew" id="isNew" value="1"> 
                    </div>
                    <div class="col-lg-12 pl-0">
                    <div class="form-group col-lg-6">
                      <label for="uploadIcons" class="d-block">Upload Icons</label>
                      <input type="file" name="uploadIcons" id="uploadIcons" value="" onchange="fileuploadpreview(this)">
                      <div class="previewimg mt-2"></div> 
                    </div>

                    <div class="form-group col-lg-6">
                      <label for="bannerImg" class="d-block">Banner Image (1366*290)</label>
                      <input type="file" name="bannerImg" id="bannerImg" value="" onchange="fileuploadpreview(this)">
                      <div class="previewimg mt-2"></div> 
                    </div>
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="bannerTitle">Banner Title</label>
                      <input type="text" class="form-control" id="bannerTitle" name="bannerTitle" maxlength="65" placeholder="Enter banner title">
                    </div>
                    <div class="form-group col-lg-6">
                      <label for="bannerDescription">Banner Description</label>
                      <input type="text" class="form-control" id="bannerDescription" name="bannerDescription" placeholder="Enter banner description">
                    </div>
                    <div class="form-group col-lg-12">
                      <label for="metaTitle">Meta Title</label>
                      <input type="text" class="form-control" id="metaTitle" name="metaTitle" maxlength="65" placeholder="Enter meta title">
                    </div>
                    <div class="form-group col-lg-12">
                      <label for="metaDescription">Meta Description</label>
                      <textarea class="form-control" id="metaDescription" rows="3" name="metaDescription" maxlength="150" placeholder="Meta Description"></textarea>
                    </div>
                    <div class="form-group col-lg-12">
                      <label for="metaKeywords">Meta Keywords</label>
                      <textarea class="form-control" id="metaKeywords" rows="3" name="metaKeywords" placeholder="Meta Keywords"></textarea>
                    </div>
                    <div class="form-group col-lg-12">
                      <input type="hidden" name="action" value="addSubCategoryItem">
                      <input type="hidden" name="hiddenval" value="">
                      <input type="hidden" name="indexval" value="">
                      <button type="submit" class="btn btn-success mr-2 actionbtn">Submit</button>
                      <button class="btn btn-light" data-dismiss="modal" type="button" >Cancel</button>
                    </div>
                  </form>
              </div>
            </div>

          </div>
        </div>
        <!-- End Model Content -->
<?php $this->load->viewD('inc/footer.php'); ?>