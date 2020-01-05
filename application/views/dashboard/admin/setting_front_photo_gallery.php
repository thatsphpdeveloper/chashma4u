<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->
    
    <?php $this->load->viewD('inc/sidebar.php'); ?>
      <style type="text/css">
        .previewimg img {
          border: 1px solid black;
          padding: 1px;
          margin: 3px;
        }
      </style>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <div class ="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Front Page Photo Gallery List <button type="button" class="btn btn-success pull-right newFormModalBtn" data-toggle="modal" data-target="#newFormModal">Add New</button></h4>                    
                    <div class="table-responsive">
                      <table class="table" id="tableDataList">
                        <thead>
                          <tr>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Button Url</th>
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
        <!-- zone modal start -->
        <div class="modal fade" id="newFormModal">
          <div class="modal-dialog">
            <div class="modal-content">
            
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title"><span class="newFormModalTitle">Add New</span> Photo Gallery</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              
              <!-- Modal body -->
              <div class="modal-body">
                <div class="col-md-12 d-flex align-items-stretch grid-margin">
                  <div class="row flex-grow">
                    <div class="col-12">
                      <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validatePopupFrom(this, event);">
                        <p class="msg"></p>
                        <div class="form-group">
                          <label for="description">Description</label>
                          <input type="text" class="form-control firstinput" id="description" name="description" placeholder="Enter description" required>
                        </div>
                        <div class="form-group">
                          <label for="btnUrl">Button Url</label>
                          <input type="text" class="form-control firstinput" id="btnUrl" name="btnUrl" placeholder="Enter button url" required> 
                        </div>
                        <div class="form-group">
                          <label for="uploadIcons">Upload Image <span class="text-muted">( Image should be 300*300)</span></label>
                          <input type="file" name="uploadIcons" id="uploadIcons" value="" onchange="fileuploadpreview(this)">
                          <div class="previewimg"></div> 
                        </div>
                        <input type="hidden" name="action" value="addPhotoGallery">
                        <input type="hidden" name="hiddenval" value="">
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

        <!-- partial:partials/_footer.html -->
<?php $this->load->viewD('inc/footer.php'); ?>
