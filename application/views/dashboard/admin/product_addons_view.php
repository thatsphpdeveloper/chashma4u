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

      <style type="text/css">
        .mssg {
          background-color: #538e5a;
          color: #fff;
          padding: 6px 14px;
          width: 100%;
          font-size: 12pt;
          display: none;
        }
        #myProgress {
          width: 100%;
          background-color: #ddd;
          display: none;
        }

        #myBar {
          width: 10%;
          height: 30px;
          background-color: #4CAF50;
          text-align: center;
          line-height: 30px;
          color: white;
        }
      </style>
<!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
            <div class ="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Lens List <button type="button" class="btn btn-success pull-right newFormModalBtn" data-toggle="modal" data-target="#newFormModal">Add New</button></h4>                    
                    <div class="table-responsive">
                      <table class="table" id="tableDataList">
                        <thead>
                          <tr>
                            <th>Image</th>
                            <th>Lens Name</th>
                            <th>Price</th>
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
        <!-- addons modal start -->
        <div class="modal fade" id="newFormModal">
          <div class="modal-dialog">
            <div class="modal-content">
            
              <!-- Modal Header -->
              <div class="modal-header">
                <h4 class="modal-title"><span class="newFormModalTitle">Add New</span> Lens</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              
              <!-- Modal body -->
              <div class="modal-body">
                <div class="col-md-12 d-flex align-items-stretch grid-margin">
                  <div class="row flex-grow">
                    <div class="col-12">
                      <form class="forms-sample formarea" method="post" action="" novalidate enctype="multipart/form-data" onSubmit="return validateAddons(this, event);">
                        <p class="msg"></p>
                        <div class="form-group">
                          <label for="addonsName">Lens Name</label>
                          <input type="text" class="form-control firstinput" id="addonsName" name="addonsName" placeholder="Enter lense name" required>
                        </div>
                        <div class="form-group">
                          <label for="description">Description</label>
                          <textarea class="form-control" id="description" name="description" placeholder="Enter description"></textarea>
                        </div>
                        <div class="form-group">
                          <label for="slugName">Lens Price</label>
                          <input type="text" class="form-control" id="price" name="price" placeholder="Enter addons price" value="<?=isset($addonsData->price) ? $addonsData->price:0;?>" onkeydown="OnlyNumericKey(event)" required>
                        </div>
                        <div class="form-group">
                          <label for="uploadIcons">Upload Icons <span class="text-muted">( Image should be 100*100 )</span></label>
                          <input type="file" name="uploadIcons" id="uploadIcons" value="" accept="image/*" onchange="fileuploadpreview(this)">
                          <div class="previewimg"></div> 
                        </div>

                          <div class="col-md-12 nopadding mb-5">
                              <div class="form-check form-check-flat">
                                <label class="form-check-label">
                                  <input type="checkbox" class="form-check-input" name="zeroPower" value="1" > Zero power (Lenses without any prescription)
                                <i class="input-helper"></i></label>
                              </div>
                          </div>

                        <input type="hidden" name="action" value="addAddons">
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

        <!-- addons modal end -->
        <!-- partial:partials/_footer.html -->
<?php $this->load->viewD('inc/footer.php'); ?>
