<?php $this->load->viewD('inc/header.php'); ?>  
    <!-- partial -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
   
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
                    <h4 class="card-title">Share Moment List <button type="button" class="btn btn-success pull-right newFormModalBtn" data-toggle="modal" data-target="#newFormModal">Add New</button></h4>                    
                    <div class="table-responsive">
                      <table class="table" id="tableDataList">
                        <thead>
                          <tr>
                            <th class="text-center">Image</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
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
                <h4 class="modal-title"><span class="newFormModalTitle">Add New</span> Share Moment</h4>
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
                          <label>User</label>
                            <select class="livesearch form-control firstinput" data-placeholder="Choose a user" name="userId">
                              <option value="0">Choose a user</option>
                              <?php 
                              if (isset($userData) && !empty($userData)) {
                                foreach ($userData as $user) {
                                  echo '<option value="'.$user->userId.'">'.$user->firstName.'</option>';
                                }
                              }
                              ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                          <label>Title</label>
                          <input type="text" class="form-control" name="title" required="" placeholder="Enter title for your moment">
                        </div>
                        <div class="form-group">
                          <label>Description</label>
                          <textarea class="form-control" name="description" required="" placeholder="Enter description for your moment"></textarea>
                        </div>
                        <div class="form-group">
                          <label for="uploadIcons">Upload Image <span class="text-muted">( Image should be 300*300 )</span></label>
                          <input type="file" name="uploadIcons" id="uploadIcons" onchange="fileuploadpreview(this)" required>
                          <div class="previewimg"></div> 
                        </div>
                        <input type="hidden" name="action" value="addShareMoment">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>
<script type="text/javascript">
  $(".livesearch").chosen({
    disable_search_threshold: 5,
    no_results_text: "Oops, Vendor not found!",
    width: "100%"
  });
</script>