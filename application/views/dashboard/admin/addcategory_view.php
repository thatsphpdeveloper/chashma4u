<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->
    
    <?php $this->load->viewD('inc/sidebar.php'); ?>
      <!-- partial -->
      <style type="text/css">
        .previewimg img {
          border: 1px solid black;
          padding: 1px;
          margin: 3px;
        }
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
                    <h4 class="card-title">Category List <button type="button" class="btn btn-success pull-right newFormModalBtn" data-toggle="modal" data-target="#newFormModal">Add New</button></h4>                    
                    <div class="table-responsive">
                      <table class="table" id="tableDataList">
                        <thead>
                          <tr>
                            <th>Icons</th>
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
                  <div class="form-group  row hide">
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
        <!-- End Model Content -->

        <!-- zone modal start -->
        <div class="modal fade" id="newFormModal">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
            
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title"><span class="newFormModalTitle">Add New</span> Category</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              
              <!-- Modal body -->
              <div class="modal-body">
                <div class="col-md-12 d-flex align-items-stretch grid-margin">
                  <div class="row flex-grow">
                    <div class="col-12">
                      <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateCategory(this, event);">
                        <p class="msg"></p>
                        <div class="form-group col-lg-6">
                          <label for="categoryName">Category Name</label>
                          <input type="text" class="form-control firstinput" id="categoryName" name="categoryName" placeholder="Enter category name" required>
                        </div>
                        <div class="form-group col-lg-6">
                          <label for="slugName">Category Slug</label>
                          <input type="text" class="form-control firstinput" id="slugName" name="slugName" placeholder="Enter category slug name">
                        </div>
                        <div class="form-group col-lg-12">
                          <label for="description">Description</label>
                          <textarea class="form-control" id="description" rows="3" name="description" placeholder="Category Description"></textarea>
                        </div>
                        <div class="form-group col-lg-12">
                          <label>Extra Description</label>
                          <textarea class="form-control" name="extraDescription" id="aboutus" placeholder="Extra Description" tabindex="5" required></textarea>
                        </div>
                        <div class="col-lg-12 pl-0">
                        <div class="form-group col-lg-6">
                          <label for="uploadIcons" class="d-block">Upload Icons</label>
                          <input type="file" name="uploadIcons" id="uploadIcons" value="" onchange="fileuploadpreview(this)">
                          <div class="previewimg"></div> 
                        </div>

                        <div class="form-group col-lg-6">
                          <label for="bannerImg" class="d-block">Banner Image (1366*290)</label>
                          <input type="file" name="bannerImg" id="bannerImg" value="" onchange="fileuploadpreview(this)">
                          <div class="previewimg"></div> 
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
                          <div class="form-check form-check-flat mt-4 mb-4">
                            <label class="form-check-label">
                              <input type="checkbox" class="form-check-input menu-checkbox" name="isNew" id="isNew" value="1">Display as is new highlighter
                              <i class="input-helper"></i>
                            </label>
                          </div>
                        </div>
                        <div class="form-group col-lg-12">
                          <input type="hidden" name="action" value="addCategory">
                          <input type="hidden" name="hiddenval" value="">
                          <input type="hidden" name="indexval" value="">
                          <button type="submit" class="btn btn-success mr-2 actionbtn">Submit</button>
                          <button class="btn btn-light" data-dismiss="modal">Cancel</button>
                        </div>
                      </form>
                    </div>                  
                  </div>
                </div>
              </div>              
            </div>
          </div>
        </div>

        <!-- zone modal end -->
<?php $this->load->viewD('inc/footer.php'); ?>

<script type="text/javascript">
  $(document).ready(function(e) {
   

    // $(".aboutus, #aboutus").summernote({
    //               height: 100,  
    //               toolbar: [
    //                     ['style', ['bold', 'italic', 'underline', 'clear']],
    //                     ['fontsize', ['fontsize']],
    //                     ['color', ['color']],
    //                     ['para', ['ul','ol','paragraph']],
    //                     ["view", ["fullscreen", "codeview"]]
    //                 ],
    //             });

    //             $('i.note-recent-color').each(function(){
    //                $(this).attr('style','background-color: transparent;');
    //             });

    });
</script>